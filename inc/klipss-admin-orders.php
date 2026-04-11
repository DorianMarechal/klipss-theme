<?php
/**
 * Klipss — Admin Commandes
 * Liste en cards, détail, mise à jour statut, numéro de suivi, export CSV
 */

if (!defined('ABSPATH')) exit;

/* ─── Export CSV — traité avant tout output HTML ─────────────── */

function klipss_admin_handle_csv_export() {
    if (
        !isset($_GET['page'], $_GET['action']) ||
        $_GET['page']   !== 'klipss-commandes' ||
        $_GET['action'] !== 'export_csv'
    ) return;

    if (!current_user_can('manage_options')) wp_die('Accès refusé.');

    // [H-2] Vérification nonce CSRF
    if (!wp_verify_nonce($_GET['_wpnonce'] ?? '', 'klipss_export_csv')) {
        wp_die('Erreur de sécurité.');
    }

    klipss_export_orders_csv();
    exit;
}
add_action('admin_init', 'klipss_admin_handle_csv_export');

/* ─── Styles admin inline ────────────────────────────────────── */

function klipss_admin_orders_styles($hook) {
    if (strpos($hook, 'klipss') === false) return;
    echo '<style>
        /* ── Layout général ── */
        #wpcontent { background:#f4f4f6; }
        .klipss-wrap { max-width:1200px; padding-top:16px; }

        /* ── En-tête page ── */
        .klipss-page-header { display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px; margin-bottom:24px; }
        .klipss-page-header h1 { margin:0; font-size:22px; color:#1a1a1a; display:flex; align-items:center; gap:10px; }
        .klipss-page-header h1::before { content:""; display:inline-block; width:4px; height:26px; background:linear-gradient(180deg,#810D22,#FD920D); border-radius:3px; }

        /* ── Stat cards ── */
        .klipss-stat-cards { display:grid; grid-template-columns:repeat(auto-fit,minmax(190px,1fr)); gap:16px; margin-bottom:28px; }
        .klipss-stat-card { border-radius:14px; padding:22px 24px; position:relative; overflow:hidden; box-shadow:0 4px 16px rgba(0,0,0,.10); }
        .klipss-stat-card--total   { background:linear-gradient(135deg,#810D22 0%,#b01830 100%); color:#fff; }
        .klipss-stat-card--revenue { background:linear-gradient(135deg,#FD920D 0%,#e07800 100%); color:#fff; }
        .klipss-stat-card--pending { background:#fff; border:2px solid #fbe8ec; }
        .klipss-stat-card--shipped { background:#fff; border:2px solid #d4edda; }
        .klipss-stat-card::after { content:""; position:absolute; right:-20px; top:-20px; width:90px; height:90px; border-radius:50%; background:rgba(255,255,255,.12); }
        .klipss-stat-card__icon { font-size:24px; margin-bottom:12px; }
        .klipss-stat-card__num { font-size:36px; font-weight:900; line-height:1; letter-spacing:-1px; }
        .klipss-stat-card--total .klipss-stat-card__num,
        .klipss-stat-card--revenue .klipss-stat-card__num { color:#fff; }
        .klipss-stat-card--pending .klipss-stat-card__num { color:#810D22; }
        .klipss-stat-card--shipped .klipss-stat-card__num { color:#155724; }
        .klipss-stat-card__label { font-size:12px; margin-top:8px; font-weight:600; text-transform:uppercase; letter-spacing:.06em; }
        .klipss-stat-card--total .klipss-stat-card__label,
        .klipss-stat-card--revenue .klipss-stat-card__label { color:rgba(255,255,255,.7); }
        .klipss-stat-card--pending .klipss-stat-card__label { color:#c04060; }
        .klipss-stat-card--shipped .klipss-stat-card__label { color:#2f9e44; }

        /* ── Filtres ── */
        .klipss-filters { display:flex; gap:10px; align-items:center; flex-wrap:wrap; margin-bottom:20px; background:#fff; padding:14px 18px; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,.06); }
        .klipss-filters input[type=text] { flex:1; min-width:220px; padding:9px 14px; border-radius:8px; border:1.5px solid #e8e8e8; font-size:13px; }
        .klipss-filters input[type=text]:focus { border-color:#810D22; outline:none; box-shadow:0 0 0 3px rgba(129,13,34,.1); }
        .klipss-filters select { padding:9px 14px; border-radius:8px; border:1.5px solid #e8e8e8; font-size:13px; background:#fff; }

        /* ── Boutons ── */
        .klipss-btn { display:inline-flex; align-items:center; gap:6px; padding:9px 18px; border-radius:8px; font-size:13px; font-weight:700; cursor:pointer; border:none; text-decoration:none; transition:all .15s; line-height:1; }
        .klipss-btn--primary   { background:#810D22; color:#fff; box-shadow:0 3px 10px rgba(129,13,34,.35); }
        .klipss-btn--primary:hover { background:#6a0b1c; color:#fff; transform:translateY(-1px); }
        .klipss-btn--secondary { background:#fff; color:#555; border:1.5px solid #e0e0e0; }
        .klipss-btn--secondary:hover { background:#f8f8f8; color:#222; }
        .klipss-btn--export    { background:linear-gradient(135deg,#FD920D,#d97000); color:#fff; box-shadow:0 3px 10px rgba(253,146,13,.35); }
        .klipss-btn--export:hover { opacity:.9; color:#fff; transform:translateY(-1px); }
        .klipss-btn--sm { padding:6px 13px; font-size:12px; }

        /* ── Order cards (liste) ── */
        .klipss-orders-grid { display:flex; flex-direction:column; gap:12px; }
        .klipss-order-card { background:#fff; border-radius:14px; box-shadow:0 2px 10px rgba(0,0,0,.07); overflow:hidden; transition:box-shadow .15s, transform .15s; border-left:4px solid transparent; }
        .klipss-order-card:hover { box-shadow:0 6px 24px rgba(0,0,0,.12); transform:translateY(-2px); }
        .klipss-order-card--pending    { border-left-color:#9c36b5; }
        .klipss-order-card--processing { border-left-color:#1971c2; }
        .klipss-order-card--shipped    { border-left-color:#2f9e44; }
        .klipss-order-card--delivered  { border-left-color:#1a7531; }
        .klipss-order-card--cancelled  { border-left-color:#c92a2a; }

        .klipss-order-card__inner { display:flex; align-items:center; gap:0; }
        .klipss-order-card__main { flex:1; padding:16px 20px; display:grid; grid-template-columns:180px 1fr 1fr auto; align-items:center; gap:16px; }
        .klipss-order-card__ref { font-family:monospace; font-weight:800; font-size:13px; color:#810D22; background:#fdf5f6; padding:5px 10px; border-radius:6px; display:inline-block; white-space:nowrap; }
        .klipss-order-card__date { font-size:11px; color:#aaa; margin-top:5px; }
        .klipss-order-card__name { font-weight:700; font-size:14px; color:#1a1a1a; }
        .klipss-order-card__email { font-size:11px; color:#aaa; margin-top:3px; }
        .klipss-order-card__product { font-size:13px; color:#555; }
        .klipss-order-card__option { font-size:11px; color:#aaa; margin-top:3px; }
        .klipss-order-card__right { display:flex; flex-direction:column; align-items:flex-end; gap:10px; padding:16px 20px; border-left:1px solid #f5f5f5; min-width:180px; }
        .klipss-order-card__amount { font-size:20px; font-weight:900; color:#1a1a1a; letter-spacing:-0.5px; }
        .klipss-order-card__actions { display:flex; align-items:center; gap:8px; }

        /* ── Badges statut ── */
        .klipss-badge { display:inline-flex; align-items:center; gap:5px; padding:5px 11px; border-radius:20px; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.05em; white-space:nowrap; }
        .klipss-badge::before { content:""; width:6px; height:6px; border-radius:50%; flex-shrink:0; }
        .klipss-badge--pending    { background:#f8f0fc; color:#9c36b5; }
        .klipss-badge--pending::before { background:#9c36b5; animation:klipss-pulse 1.5s infinite; }
        .klipss-badge--processing { background:#e8f4fd; color:#1971c2; }
        .klipss-badge--processing::before { background:#1971c2; box-shadow:0 0 0 2px rgba(25,113,194,.25); animation:klipss-pulse 1.5s infinite; }
        .klipss-badge--shipped    { background:#ebfbee; color:#2f9e44; }
        .klipss-badge--shipped::before { background:#2f9e44; }
        .klipss-badge--delivered  { background:#d3f9d8; color:#1a7531; }
        .klipss-badge--delivered::before { background:#1a7531; }
        .klipss-badge--cancelled  { background:#fff5f5; color:#c92a2a; }
        .klipss-badge--cancelled::before { background:#c92a2a; }
        @keyframes klipss-pulse { 0%,100%{opacity:1} 50%{opacity:.4} }

        /* ── Notice ── */
        .klipss-notice { padding:13px 18px; border-radius:10px; font-size:13px; margin-bottom:20px; display:flex; align-items:center; gap:10px; font-weight:600; }
        .klipss-notice--success { background:#ebfbee; color:#2f9e44; border-left:4px solid #2f9e44; }
        .klipss-notice--error   { background:#fff5f5; color:#c92a2a; border-left:4px solid #c92a2a; }

        /* ── Vide ── */
        .klipss-empty { text-align:center; padding:60px 24px; color:#bbb; background:#fff; border-radius:14px; }
        .klipss-empty svg { display:block; margin:0 auto 16px; opacity:.25; }
        .klipss-empty p { font-size:15px; margin:0; }
        .klipss-count { font-size:12px; color:#bbb; margin-top:12px; font-weight:500; }

        /* ── Tracking chip ── */
        .klipss-tracking-chip { display:inline-flex; align-items:center; gap:5px; font-size:11px; color:#555; background:#f5f5f5; padding:3px 9px; border-radius:5px; font-family:monospace; }

        /* ── DETAIL VIEW ── */
        .klipss-detail-box { background:transparent; max-width:820px; }

        /* Header gradient */
        .klipss-detail-header { background:linear-gradient(135deg,#810D22 0%,#b01830 100%); border-radius:14px; padding:28px 32px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:16px; box-shadow:0 6px 24px rgba(129,13,34,.3); margin-bottom:16px; }
        .klipss-detail-header-left { }
        .klipss-detail-header-eyebrow { font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.1em; color:rgba(255,255,255,.55); margin-bottom:6px; }
        .klipss-detail-header-ref { font-size:26px; font-weight:900; color:#fff; font-family:monospace; letter-spacing:-0.5px; }
        .klipss-detail-header-date { font-size:13px; color:rgba(255,255,255,.6); margin-top:8px; }

        /* Info cards grid */
        .klipss-info-grid { display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:16px; }
        .klipss-info-card { background:#fff; border-radius:12px; padding:18px 20px; box-shadow:0 2px 8px rgba(0,0,0,.06); }
        .klipss-info-card--full { grid-column:1 / -1; }
        .klipss-info-card__label { font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:.1em; color:#bbb; margin-bottom:8px; }
        .klipss-info-card__value { font-size:14px; color:#1a1a1a; font-weight:500; line-height:1.6; }
        .klipss-info-card__sub { font-size:12px; color:#aaa; margin-top:3px; }
        .klipss-amount-big { font-size:32px; font-weight:900; color:#810D22; letter-spacing:-1px; line-height:1; }

        /* Formulaire de mise à jour */
        .klipss-update-card { background:#fff; border-radius:12px; padding:24px; box-shadow:0 2px 8px rgba(0,0,0,.06); }
        .klipss-update-card__title { font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.1em; color:#810D22; margin-bottom:18px; display:flex; align-items:center; gap:8px; }
        .klipss-update-card__title::before { content:""; display:inline-block; width:3px; height:14px; background:#810D22; border-radius:2px; }
        .klipss-form-row { display:flex; gap:12px; align-items:flex-end; flex-wrap:wrap; }
        .klipss-form-field { display:flex; flex-direction:column; gap:6px; flex:1; min-width:140px; }
        .klipss-form-field label { font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.06em; color:#999; }
        .klipss-form-field input, .klipss-form-field select, .klipss-form-field textarea { padding:10px 13px; border:1.5px solid #eee; border-radius:8px; font-size:13px; font-family:inherit; background:#fafafa; transition:border-color .15s,box-shadow .15s; }
        .klipss-form-field input:focus, .klipss-form-field select:focus, .klipss-form-field textarea:focus { border-color:#810D22; outline:none; background:#fff; box-shadow:0 0 0 3px rgba(129,13,34,.08); }
        .klipss-form-field textarea { resize:vertical; min-height:70px; }
        .klipss-send-label { display:flex; align-items:center; gap:8px; font-size:13px; color:#666; cursor:pointer; accent-color:#810D22; }
        .klipss-form-footer { display:flex; align-items:center; gap:16px; flex-wrap:wrap; margin-top:20px; padding-top:20px; border-top:1px solid #f0f0f0; }
    </style>';
}
add_action('admin_enqueue_scripts', 'klipss_admin_orders_styles');

/* ─── Page principale ────────────────────────────────────────── */

function klipss_admin_orders_page() {
    global $wpdb;
    $table = $wpdb->prefix . 'klipss_orders';

    // Action : mise à jour d'une commande
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['klipss_update_order_nonce'])) {
        if (!wp_verify_nonce($_POST['klipss_update_order_nonce'], 'klipss_update_order')) {
            wp_die('Erreur de sécurité.');
        }

        $order_id       = intval($_POST['order_id'] ?? 0);
        $new_status     = sanitize_text_field($_POST['order_status']      ?? '');
        $tracking       = sanitize_text_field($_POST['tracking_number']   ?? '');
        $carrier        = sanitize_text_field($_POST['carrier']           ?? '');
        $notes          = sanitize_textarea_field($_POST['notes']         ?? '');
        $send_ship_mail = !empty($_POST['send_ship_email']);

        // [H-1] Whitelist des statuts de commande
        $allowed_statuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
        if (!in_array($new_status, $allowed_statuses, true)) {
            wp_die('Statut de commande invalide.');
        }

        $old_status = $wpdb->get_var($wpdb->prepare("SELECT status FROM $table WHERE id = %d", $order_id));

        $wpdb->update($table,
            ['status' => $new_status, 'tracking_number' => $tracking, 'carrier' => $carrier, 'notes' => $notes, 'updated_at' => current_time('mysql')],
            ['id' => $order_id],
            ['%s', '%s', '%s', '%s', '%s'],
            ['%d']
        );

        if ($send_ship_mail && $new_status === 'shipped' && $old_status !== 'shipped') {
            $order = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id = %d", $order_id), ARRAY_A);
            if ($order && $order['customer_email']) {
                klipss_send_shipping_email($order);
            }
        }

        echo '<div class="klipss-notice klipss-notice--success">✓ Commande mise à jour avec succès.</div>';
    }

    // Vue détail ?
    $view_id = isset($_GET['view']) ? intval($_GET['view']) : 0;
    if ($view_id) {
        $order = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id = %d", $view_id), ARRAY_A);
        if ($order) {
            klipss_admin_order_detail($order);
            return;
        }
    }

    // ─── Vue liste ─────────────────────────────────────────────

    $filter_status = sanitize_text_field($_GET['status'] ?? '');
    $filter_search = sanitize_text_field($_GET['s']      ?? '');

    $where  = 'WHERE 1=1';
    $params = [];

    if ($filter_status) {
        $where   .= ' AND status = %s';
        $params[] = $filter_status;
    }
    if ($filter_search) {
        $where   .= ' AND (customer_email LIKE %s OR customer_name LIKE %s OR order_ref LIKE %s)';
        $like     = '%' . $wpdb->esc_like($filter_search) . '%';
        $params   = array_merge($params, [$like, $like, $like]);
    }

    $query  = "SELECT * FROM $table $where ORDER BY created_at DESC";
    $orders = $params
        ? $wpdb->get_results($wpdb->prepare($query, ...$params), ARRAY_A)
        : $wpdb->get_results($query, ARRAY_A);

    // Stats globales
    $stats = $wpdb->get_results("SELECT status, COUNT(*) as cnt, SUM(amount) as total FROM $table GROUP BY status", ARRAY_A);
    $stats_map   = [];
    $grand_total = 0;
    $grand_count = 0;
    foreach ($stats as $s) {
        $stats_map[$s['status']] = $s;
        $grand_total += $s['total'];
        $grand_count += $s['cnt'];
    }

    $status_labels = [
        'pending'    => 'En attente',
        'processing' => 'En préparation',
        'shipped'    => 'Expédiée',
        'delivered'  => 'Livrée',
        'cancelled'  => 'Annulée',
    ];

    $current_url = admin_url('admin.php?page=klipss-commandes');
    ?>

    <div class="wrap klipss-wrap">

        <!-- En-tête -->
        <div class="klipss-page-header">
            <h1>Commandes Klipss</h1>
            <a href="<?php echo esc_url(wp_nonce_url(add_query_arg(['action' => 'export_csv'], $current_url), 'klipss_export_csv')); ?>" class="klipss-btn klipss-btn--export">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                Exporter CSV
            </a>
        </div>

        <!-- Stat cards -->
        <div class="klipss-stat-cards">
            <div class="klipss-stat-card klipss-stat-card--total">
                <div class="klipss-stat-card__icon">🛍️</div>
                <div class="klipss-stat-card__num"><?php echo $grand_count; ?></div>
                <div class="klipss-stat-card__label">Total commandes</div>
            </div>
            <div class="klipss-stat-card klipss-stat-card--revenue">
                <div class="klipss-stat-card__icon">💰</div>
                <div class="klipss-stat-card__num"><?php echo number_format($grand_total / 100, 2, ',', ' ') . ' €'; ?></div>
                <div class="klipss-stat-card__label">Chiffre d'affaires</div>
            </div>
            <div class="klipss-stat-card klipss-stat-card--pending">
                <div class="klipss-stat-card__icon">⏳</div>
                <div class="klipss-stat-card__num"><?php echo intval($stats_map['processing']['cnt'] ?? 0); ?></div>
                <div class="klipss-stat-card__label">En préparation</div>
            </div>
            <div class="klipss-stat-card klipss-stat-card--shipped">
                <div class="klipss-stat-card__icon">📦</div>
                <div class="klipss-stat-card__num"><?php echo intval($stats_map['shipped']['cnt'] ?? 0); ?></div>
                <div class="klipss-stat-card__label">Expédiées</div>
            </div>
        </div>

        <!-- Filtres -->
        <form method="get" action="<?php echo esc_url($current_url); ?>" class="klipss-filters">
            <input type="hidden" name="page" value="klipss-commandes">
            <input type="text" name="s" placeholder="🔍  Rechercher par email, nom ou référence…" value="<?php echo esc_attr($filter_search); ?>">
            <select name="status">
                <option value="">Tous les statuts</option>
                <?php foreach ($status_labels as $val => $lbl): ?>
                <option value="<?php echo esc_attr($val); ?>" <?php selected($filter_status, $val); ?>><?php echo esc_html($lbl); ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="klipss-btn klipss-btn--primary">Filtrer</button>
            <?php if ($filter_status || $filter_search): ?>
            <a href="<?php echo esc_url($current_url); ?>" class="klipss-btn klipss-btn--secondary">✕ Effacer</a>
            <?php endif; ?>
        </form>

        <!-- Commandes en cards -->
        <?php if (empty($orders)): ?>
        <div class="klipss-empty">
            <svg width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
            <p>Aucune commande trouvée.</p>
        </div>
        <?php else: ?>
        <div class="klipss-orders-grid">
            <?php foreach ($orders as $o): ?>
            <div class="klipss-order-card klipss-order-card--<?php echo esc_attr($o['status']); ?>">
                <div class="klipss-order-card__inner">
                    <div class="klipss-order-card__main">

                        <!-- Ref + date -->
                        <div>
                            <span class="klipss-order-card__ref"><?php echo esc_html($o['order_ref']); ?></span>
                            <div class="klipss-order-card__date"><?php echo esc_html(date_i18n('d/m/Y · H:i', strtotime($o['created_at']))); ?></div>
                        </div>

                        <!-- Client -->
                        <div>
                            <div class="klipss-order-card__name"><?php echo esc_html($o['customer_name']); ?></div>
                            <div class="klipss-order-card__email"><?php echo esc_html($o['customer_email']); ?></div>
                        </div>

                        <!-- Produit -->
                        <div>
                            <div class="klipss-order-card__product"><?php echo esc_html($o['style']); ?></div>
                            <div class="klipss-order-card__option"><?php echo esc_html($o['option_name']); ?></div>
                            <?php if ($o['tracking_number']): ?>
                            <div class="klipss-tracking-chip" style="margin-top:6px;">📦 <?php echo esc_html($o['tracking_number']); ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Badge statut -->
                        <div>
                            <span class="klipss-badge klipss-badge--<?php echo esc_attr($o['status']); ?>">
                                <?php echo esc_html($status_labels[$o['status']] ?? $o['status']); ?>
                            </span>
                        </div>

                    </div><!-- /.klipss-order-card__main -->

                    <div class="klipss-order-card__right">
                        <div class="klipss-order-card__amount"><?php echo esc_html(number_format($o['amount'] / 100, 2, ',', ' ') . ' €'); ?></div>
                        <div class="klipss-order-card__actions">
                            <a href="<?php echo esc_url(add_query_arg(['view' => $o['id']], $current_url)); ?>" class="klipss-btn klipss-btn--primary klipss-btn--sm">
                                Gérer →
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <p class="klipss-count"><?php echo count($orders); ?> commande(s) affichée(s)</p>
        <?php endif; ?>
    </div>
    <?php
}

/* ─── Vue détail d'une commande ──────────────────────────────── */

function klipss_admin_order_detail($order) {
    $status_labels = [
        'pending'    => 'En attente',
        'processing' => 'En préparation',
        'shipped'    => 'Expédiée',
        'delivered'  => 'Livrée',
        'cancelled'  => 'Annulée',
    ];
    $carrier_options = ['', 'Colissimo', 'Chronopost', 'Colis Privé', 'Mondial Relay', 'DPD', 'Autre'];
    $back_url = admin_url('admin.php?page=klipss-commandes');
    ?>
    <div class="wrap klipss-wrap">

        <!-- Retour -->
        <div style="margin-bottom:20px;">
            <a href="<?php echo esc_url($back_url); ?>" class="klipss-btn klipss-btn--secondary">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                Retour aux commandes
            </a>
        </div>

        <div class="klipss-detail-box">

            <!-- Header gradient -->
            <div class="klipss-detail-header">
                <div class="klipss-detail-header-left">
                    <div class="klipss-detail-header-eyebrow">Commande</div>
                    <div class="klipss-detail-header-ref"><?php echo esc_html($order['order_ref']); ?></div>
                    <div class="klipss-detail-header-date"><?php echo esc_html(date_i18n('d/m/Y à H:i', strtotime($order['created_at']))); ?></div>
                </div>
                <span class="klipss-badge klipss-badge--<?php echo esc_attr($order['status']); ?>" style="font-size:13px;padding:8px 16px;">
                    <?php echo esc_html($status_labels[$order['status']] ?? $order['status']); ?>
                </span>
            </div>

            <!-- Grid de cards infos -->
            <div class="klipss-info-grid">

                <!-- Client -->
                <div class="klipss-info-card">
                    <div class="klipss-info-card__label">👤 Client</div>
                    <div class="klipss-info-card__value" style="font-weight:700;font-size:15px;"><?php echo esc_html($order['customer_name']); ?></div>
                    <div class="klipss-info-card__sub"><?php echo esc_html($order['customer_email']); ?></div>
                    <?php if ($order['customer_phone']): ?>
                    <div class="klipss-info-card__sub"><?php echo esc_html($order['customer_phone']); ?></div>
                    <?php endif; ?>
                </div>

                <!-- Adresse livraison -->
                <div class="klipss-info-card">
                    <div class="klipss-info-card__label">📍 Adresse de livraison</div>
                    <div class="klipss-info-card__value">
                        <?php echo esc_html($order['shipping_address']); ?><br>
                        <?php echo esc_html($order['shipping_postal_code'] . ' ' . $order['shipping_city']); ?><br>
                        <?php echo esc_html($order['shipping_country']); ?>
                    </div>
                </div>

                <!-- Produit -->
                <div class="klipss-info-card">
                    <div class="klipss-info-card__label">🛍️ Produit commandé</div>
                    <div class="klipss-info-card__value" style="font-weight:700;"><?php echo esc_html($order['style']); ?></div>
                    <div class="klipss-info-card__sub"><?php echo esc_html($order['option_name']); ?></div>
                </div>

                <!-- Montant -->
                <div class="klipss-info-card">
                    <div class="klipss-info-card__label">💳 Montant payé</div>
                    <div class="klipss-amount-big"><?php echo esc_html(number_format($order['amount'] / 100, 2, ',', ' ') . ' €'); ?></div>
                    <?php if ($order['stripe_payment_intent_id']): ?>
                    <div class="klipss-info-card__sub" style="margin-top:8px;">
                        <a href="https://dashboard.stripe.com/<?php echo (defined('WP_DEBUG') && WP_DEBUG) ? 'test/' : ''; ?>payment_intents/<?php echo esc_attr($order['stripe_payment_intent_id']); ?>" target="_blank" style="color:#810D22;font-family:monospace;font-size:11px;">
                            <?php echo esc_html(substr($order['stripe_payment_intent_id'], 0, 24) . '…'); ?> ↗
                        </a>
                    </div>
                    <?php endif; ?>
                </div>

                <?php if ($order['tracking_number']): ?>
                <!-- Suivi -->
                <div class="klipss-info-card klipss-info-card--full">
                    <div class="klipss-info-card__label">📦 Suivi expédition</div>
                    <div class="klipss-info-card__value">
                        <span class="klipss-tracking-chip" style="font-size:14px;padding:6px 14px;">
                            <?php echo esc_html($order['tracking_number']); ?>
                            <?php if ($order['carrier']): ?> · <?php echo esc_html($order['carrier']); ?><?php endif; ?>
                        </span>
                    </div>
                </div>
                <?php endif; ?>

            </div><!-- /.klipss-info-grid -->

            <!-- Card mise à jour -->
            <div class="klipss-update-card">
                <div class="klipss-update-card__title">Mettre à jour la commande</div>

                <form method="post">
                    <?php wp_nonce_field('klipss_update_order', 'klipss_update_order_nonce'); ?>
                    <input type="hidden" name="order_id" value="<?php echo esc_attr($order['id']); ?>">

                    <div class="klipss-form-row">
                        <div class="klipss-form-field">
                            <label>Statut</label>
                            <select name="order_status">
                                <?php foreach ($status_labels as $val => $lbl): ?>
                                <option value="<?php echo esc_attr($val); ?>" <?php selected($order['status'], $val); ?>><?php echo esc_html($lbl); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="klipss-form-field">
                            <label>Transporteur</label>
                            <select name="carrier">
                                <?php foreach ($carrier_options as $c): ?>
                                <option value="<?php echo esc_attr($c); ?>" <?php selected($order['carrier'], $c); ?>><?php echo esc_html($c ?: '— Choisir —'); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="klipss-form-field" style="flex:2;">
                            <label>Numéro de suivi</label>
                            <input type="text" name="tracking_number" value="<?php echo esc_attr($order['tracking_number']); ?>" placeholder="Ex: 1A234567890FR">
                        </div>
                    </div>

                    <div class="klipss-form-row" style="margin-top:14px;">
                        <div class="klipss-form-field" style="flex:1 1 100%;">
                            <label>Notes internes</label>
                            <textarea name="notes" rows="3"><?php echo esc_textarea($order['notes'] ?? ''); ?></textarea>
                        </div>
                    </div>

                    <div class="klipss-form-footer">
                        <label class="klipss-send-label">
                            <input type="checkbox" name="send_ship_email" value="1" checked>
                            Envoyer l'email d'expédition au client (si passage à "Expédiée")
                        </label>
                        <button type="submit" class="klipss-btn klipss-btn--primary" style="margin-left:auto;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            Enregistrer les modifications
                        </button>
                    </div>
                </form>
            </div><!-- /.klipss-update-card -->

        </div><!-- /.klipss-detail-box -->
    </div>
    <?php
}

/* ─── Email expédition ───────────────────────────────────────── */

function klipss_send_shipping_email($order) {
    $tracking_info = '';
    if ($order['tracking_number']) {
        $tracking_info = "\n\nNuméro de suivi : " . $order['tracking_number'];
        if ($order['carrier']) {
            $tracking_info .= ' (' . $order['carrier'] . ')';
        }
    }

    $subject = 'Votre Klipss est en route ! 📦';
    $body    = "Bonjour " . $order['customer_name'] . ",\n\n"
        . "Bonne nouvelle ! Votre commande " . $order['order_ref'] . " a été expédiée."
        . $tracking_info . "\n\n"
        . "Vous recevrez votre Klipss dans les prochains jours.\n\n"
        . "Suivez votre commande sur votre espace client :\n" . home_url('/mon-compte') . "\n\n"
        . "L'équipe Klipss\nhttps://www.klipss.fr";

    wp_mail($order['customer_email'], $subject, $body);
}

/* ─── Export CSV ─────────────────────────────────────────────── */

function klipss_export_orders_csv() {
    if (!current_user_can('manage_options')) wp_die('Accès refusé.');

    global $wpdb;
    $orders = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}klipss_orders ORDER BY created_at DESC", ARRAY_A);

    $filename = 'klipss-commandes-' . date('Y-m-d') . '.csv';
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    $out = fopen('php://output', 'w');
    fprintf($out, chr(0xEF) . chr(0xBB) . chr(0xBF)); // BOM UTF-8 pour Excel

    fputcsv($out, [
        'Référence', 'Date', 'Statut',
        'Nom', 'Email', 'Téléphone',
        'Adresse', 'Code postal', 'Ville', 'Pays',
        'Style', 'Option', 'Montant (€)',
        'Transporteur', 'Numéro de suivi',
        'Stripe PI', 'Notes',
    ], ';');

    $status_labels = [
        'pending'    => 'En attente',
        'processing' => 'En préparation',
        'shipped'    => 'Expédiée',
        'delivered'  => 'Livrée',
        'cancelled'  => 'Annulée',
    ];

    foreach ($orders as $o) {
        fputcsv($out, [
            $o['order_ref'],
            $o['created_at'],
            $status_labels[$o['status']] ?? $o['status'],
            $o['customer_name'],
            $o['customer_email'],
            $o['customer_phone'],
            $o['shipping_address'],
            $o['shipping_postal_code'],
            $o['shipping_city'],
            $o['shipping_country'],
            $o['style'],
            $o['option_name'],
            number_format($o['amount'] / 100, 2, ',', ' '),
            $o['carrier'],
            $o['tracking_number'],
            $o['stripe_payment_intent_id'],
            $o['notes'],
        ], ';');
    }

    fclose($out);
}
