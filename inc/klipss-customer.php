<?php
/**
 * Klipss Customer System
 * Role, table commandes, inscription, connexion, profil, RGPD, traitement commandes
 */

if (!defined('ABSPATH')) exit;

/* ─── Setup : rôle + table + page ──────────────────────────── */

function klipss_setup() {
    if (get_option('klipss_db_version') === '1.2') return;

    // Rôle client (sans accès wp-admin)
    if (!get_role('klipss_customer')) {
        add_role('klipss_customer', 'Client Klipss', ['read' => true]);
    }

    // Table commandes
    global $wpdb;
    $table   = $wpdb->prefix . 'klipss_orders';
    $charset = $wpdb->get_charset_collate();
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta("CREATE TABLE IF NOT EXISTS $table (
        id                       BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        order_ref                VARCHAR(25)  NOT NULL DEFAULT '',
        stripe_payment_intent_id VARCHAR(100) NOT NULL DEFAULT '',
        user_id                  BIGINT UNSIGNED NOT NULL DEFAULT 0,
        customer_email           VARCHAR(255) NOT NULL DEFAULT '',
        customer_name            VARCHAR(255) NOT NULL DEFAULT '',
        customer_phone           VARCHAR(20)  NOT NULL DEFAULT '',
        shipping_address         VARCHAR(255) NOT NULL DEFAULT '',
        shipping_city            VARCHAR(100) NOT NULL DEFAULT '',
        shipping_postal_code     VARCHAR(10)  NOT NULL DEFAULT '',
        shipping_country         VARCHAR(100) NOT NULL DEFAULT '',
        style                    VARCHAR(100) NOT NULL DEFAULT '',
        option_name              VARCHAR(100) NOT NULL DEFAULT '',
        amount                   INT          NOT NULL DEFAULT 0,
        status                   VARCHAR(20)  NOT NULL DEFAULT 'received',
        tracking_number          VARCHAR(100) NOT NULL DEFAULT '',
        carrier                  VARCHAR(50)  NOT NULL DEFAULT '',
        notes                    TEXT,
        created_at               DATETIME     NOT NULL,
        updated_at               DATETIME     NOT NULL
    ) $charset;");

    // Auto-créer la page /mon-compte
    if (!get_page_by_path('mon-compte')) {
        wp_insert_post([
            'post_title'     => 'Mon Compte',
            'post_name'      => 'mon-compte',
            'post_status'    => 'publish',
            'post_type'      => 'page',
            'post_content'   => '',
            'page_template'  => 'page-mon-compte.php',
        ]);
    }

    // Migrer la colonne shipping_country si trop courte (VARCHAR 5 → 100)
    $wpdb->query("ALTER TABLE {$wpdb->prefix}klipss_orders MODIFY COLUMN shipping_country VARCHAR(100) NOT NULL DEFAULT ''");

    update_option('klipss_db_version', '1.2');
}
add_action('after_switch_theme', 'klipss_setup');
add_action('admin_init', 'klipss_setup');

/* ─── Données client pour le JS ─────────────────────────────── */

function klipss_customer_data_for_js() {
    $data = ['is_logged_in' => false, 'customer' => null, 'account_url' => home_url('/mon-compte')];

    if (is_user_logged_in()) {
        $user    = wp_get_current_user();
        $user_id = $user->ID;
        $data['is_logged_in'] = true;
        $data['customer'] = [
            'first_name' => get_user_meta($user_id, 'klipss_firstname', true)    ?: $user->first_name,
            'last_name'  => get_user_meta($user_id, 'klipss_lastname', true)     ?: $user->last_name,
            'email'      => $user->user_email,
            'phone'      => get_user_meta($user_id, 'klipss_phone', true)        ?: '',
            'address'    => get_user_meta($user_id, 'klipss_address', true)      ?: '',
            'city'       => get_user_meta($user_id, 'klipss_city', true)         ?: '',
            'zip'        => get_user_meta($user_id, 'klipss_postal_code', true)  ?: '',
            'country'    => get_user_meta($user_id, 'klipss_country', true)      ?: 'France',
            'pref_email' => get_user_meta($user_id, 'klipss_pref_email', true)   ?: '0',
            'pref_sms'   => get_user_meta($user_id, 'klipss_pref_sms', true)     ?: '0',
        ];
    }

    return $data;
}

/* ─── Rate limiting helper ────────────────────────────────────── */

function klipss_check_rate_limit($action, $max = 5, $window = 300) {
    $ip  = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $key = 'klipss_rl_' . $action . '_' . md5($ip);
    $attempts = (int) get_transient($key);
    if ($attempts >= $max) {
        wp_send_json_error(['message' => 'Trop de tentatives. Réessayez dans quelques minutes.']);
    }
    set_transient($key, $attempts + 1, $window);
}

/* ─── AJAX : inscription ─────────────────────────────────────── */

function klipss_ajax_register() {
    check_ajax_referer('klipss_nonce_auth', 'nonce');
    klipss_check_rate_limit('register', 5, 300);

    $email     = sanitize_email($_POST['email']       ?? '');
    $password  = $_POST['password']                   ?? '';
    $firstname = sanitize_text_field($_POST['first_name'] ?? '');
    $lastname  = sanitize_text_field($_POST['last_name']  ?? '');

    if (!$email || !$password || !$firstname || !$lastname) {
        wp_send_json_error(['message' => 'Tous les champs sont requis.']);
    }
    if (strlen($password) < 8) {
        wp_send_json_error(['message' => 'Le mot de passe doit contenir au moins 8 caractères.']);
    }
    if (email_exists($email)) {
        wp_send_json_error(['message' => 'Cette adresse email est déjà utilisée.']);
    }

    $user_id = wp_create_user($email, $password, $email);
    if (is_wp_error($user_id)) {
        wp_send_json_error(['message' => $user_id->get_error_message()]);
    }

    $user = new WP_User($user_id);
    $user->set_role('klipss_customer');
    wp_update_user(['ID' => $user_id, 'first_name' => $firstname, 'last_name' => $lastname, 'display_name' => $firstname . ' ' . $lastname]);
    update_user_meta($user_id, 'klipss_firstname', $firstname);
    update_user_meta($user_id, 'klipss_lastname',  $lastname);

    wp_set_current_user($user_id);
    wp_set_auth_cookie($user_id, true);

    wp_send_json_success(['message' => 'Compte créé !', 'redirect' => home_url('/mon-compte')]);
}
add_action('wp_ajax_nopriv_klipss_register', 'klipss_ajax_register');

/* ─── AJAX : connexion ───────────────────────────────────────── */

function klipss_ajax_login() {
    check_ajax_referer('klipss_nonce_auth', 'nonce');
    klipss_check_rate_limit('login', 5, 300);

    $email    = sanitize_email($_POST['email']   ?? '');
    $password = $_POST['password']               ?? '';

    $user = wp_authenticate($email, $password);
    if (is_wp_error($user)) {
        wp_send_json_error(['message' => 'Email ou mot de passe incorrect.']);
    }

    wp_set_current_user($user->ID);
    wp_set_auth_cookie($user->ID, true);

    $meta = [
        'first_name' => get_user_meta($user->ID, 'klipss_firstname', true)   ?: $user->first_name,
        'last_name'  => get_user_meta($user->ID, 'klipss_lastname', true)    ?: $user->last_name,
        'email'      => $user->user_email,
        'phone'      => get_user_meta($user->ID, 'klipss_phone', true)       ?: '',
        'address'    => get_user_meta($user->ID, 'klipss_address', true)     ?: '',
        'city'       => get_user_meta($user->ID, 'klipss_city', true)        ?: '',
        'zip'        => get_user_meta($user->ID, 'klipss_postal_code', true) ?: '',
        'country'    => get_user_meta($user->ID, 'klipss_country', true)     ?: 'France',
    ];

    wp_send_json_success(['message' => 'Connecté !', 'customer' => $meta]);
}
add_action('wp_ajax_nopriv_klipss_login', 'klipss_ajax_login');

/* ─── AJAX : déconnexion ─────────────────────────────────────── */

function klipss_ajax_logout() {
    check_ajax_referer('klipss_nonce_auth', 'nonce');
    wp_logout();
    wp_send_json_success(['redirect' => home_url('/mon-compte')]);
}
add_action('wp_ajax_klipss_logout', 'klipss_ajax_logout');

/* ─── AJAX : mise à jour profil ─────────────────────────────── */

function klipss_ajax_update_profile() {
    check_ajax_referer('klipss_nonce_account', 'nonce');
    if (!is_user_logged_in()) wp_send_json_error(['message' => 'Non connecté.']);

    $user_id   = get_current_user_id();
    $field_map = [
        'first_name' => 'klipss_firstname',
        'last_name'  => 'klipss_lastname',
        'phone'      => 'klipss_phone',
        'address'    => 'klipss_address',
        'city'       => 'klipss_city',
        'zip'        => 'klipss_postal_code',
        'country'    => 'klipss_country',
    ];

    foreach ($field_map as $post_key => $meta_key) {
        if (isset($_POST[$post_key])) {
            update_user_meta($user_id, $meta_key, sanitize_text_field($_POST[$post_key]));
        }
    }

    if (!empty($_POST['first_name']) && !empty($_POST['last_name'])) {
        wp_update_user([
            'ID'           => $user_id,
            'first_name'   => sanitize_text_field($_POST['first_name']),
            'last_name'    => sanitize_text_field($_POST['last_name']),
            'display_name' => sanitize_text_field($_POST['first_name'] . ' ' . $_POST['last_name']),
        ]);
    }

    if (!empty($_POST['new_password'])) {
        $new_pw = $_POST['new_password'];
        if (strlen($new_pw) < 8) {
            wp_send_json_error(['message' => 'Le mot de passe doit contenir au moins 8 caractères.']);
        }
        wp_set_password($new_pw, $user_id);
        wp_set_auth_cookie($user_id, true);
    }

    wp_send_json_success(['message' => 'Profil mis à jour.']);
}
add_action('wp_ajax_klipss_update_profile', 'klipss_ajax_update_profile');

/* ─── AJAX : préférences de contact ─────────────────────────── */

function klipss_ajax_update_preferences() {
    check_ajax_referer('klipss_nonce_account', 'nonce');
    if (!is_user_logged_in()) wp_send_json_error(['message' => 'Non connecté.']);

    $user_id = get_current_user_id();
    update_user_meta($user_id, 'klipss_pref_email', !empty($_POST['pref_email']) ? '1' : '0');
    update_user_meta($user_id, 'klipss_pref_sms',   !empty($_POST['pref_sms'])   ? '1' : '0');

    wp_send_json_success(['message' => 'Préférences enregistrées.']);
}
add_action('wp_ajax_klipss_update_preferences', 'klipss_ajax_update_preferences');

/* ─── AJAX : suppression compte (RGPD) ──────────────────────── */

function klipss_ajax_delete_account() {
    check_ajax_referer('klipss_nonce_account', 'nonce');
    if (!is_user_logged_in()) wp_send_json_error(['message' => 'Non connecté.']);

    $user_id = get_current_user_id();
    global $wpdb;

    // Anonymiser les commandes (conserver pour compta, effacer données personnelles)
    $wpdb->update(
        $wpdb->prefix . 'klipss_orders',
        ['user_id' => 0, 'customer_email' => 'supprimé@rgpd.fr', 'customer_name' => 'Anonyme', 'customer_phone' => '', 'shipping_address' => '', 'shipping_city' => '', 'shipping_postal_code' => ''],
        ['user_id' => $user_id]
    );

    wp_logout();
    require_once ABSPATH . 'wp-admin/includes/user.php';
    wp_delete_user($user_id);

    wp_send_json_success(['message' => 'Compte supprimé.', 'redirect' => home_url()]);
}
add_action('wp_ajax_klipss_delete_account', 'klipss_ajax_delete_account');

/* ─── AJAX : traitement commande (paiement confirmé) ────────── */

function klipss_ajax_process_order() {
    check_ajax_referer('klipss_nonce_payment', 'nonce');

    global $wpdb;

    $pi_id       = sanitize_text_field($_POST['payment_intent_id'] ?? '');

    // [C-1] Vérifier le PaymentIntent Stripe server-side avant tout enregistrement
    if (!$pi_id || !defined('KLIPSS_STRIPE_SK')) {
        wp_send_json_error(['message' => 'Paiement non vérifié.']);
    }
    $stripe_response = wp_remote_get(
        'https://api.stripe.com/v1/payment_intents/' . $pi_id,
        ['headers' => ['Authorization' => 'Basic ' . base64_encode(KLIPSS_STRIPE_SK . ':')], 'timeout' => 15]
    );
    if (is_wp_error($stripe_response)) {
        wp_send_json_error(['message' => 'Impossible de vérifier le paiement.']);
    }
    $pi_data = json_decode(wp_remote_retrieve_body($stripe_response), true);
    if (empty($pi_data['status']) || $pi_data['status'] !== 'succeeded') {
        wp_send_json_error(['message' => 'Paiement non confirmé.']);
    }

    $email       = sanitize_email($_POST['email']        ?? '');
    $firstname   = sanitize_text_field($_POST['first_name']   ?? '');
    $lastname    = sanitize_text_field($_POST['last_name']    ?? '');
    $phone       = sanitize_text_field($_POST['phone']        ?? '');
    $address     = sanitize_text_field($_POST['address']      ?? '');
    $city        = sanitize_text_field($_POST['city']         ?? '');
    $postal      = sanitize_text_field($_POST['zip']          ?? '');
    $country     = sanitize_text_field($_POST['country']      ?? 'France');
    $style       = sanitize_text_field($_POST['style']        ?? '');
    $option      = sanitize_text_field($_POST['option']       ?? '');
    $ecosystem   = sanitize_text_field($_POST['ecosystem']    ?? '');
    $amount      = intval($_POST['amount']                    ?? 0);

    $name        = trim("$firstname $lastname");
    $order_ref   = 'KLP-' . date('Ymd') . '-' . strtoupper(wp_generate_password(5, false));
    $user_id     = get_current_user_id(); // déjà connecté si compte créé à l'étape 1

    $ecosystem_labels = [
        'apple'   => 'Apple Find My',
        'android' => 'Google Find My Device',
        'both'    => 'Apple Find My & Google Find My Device',
    ];
    $ecosystem_label  = $ecosystem_labels[$ecosystem] ?? $ecosystem;
    $option_label     = 'Pack Complet 3-en-1' . ($ecosystem_label ? ' · ' . $ecosystem_label : '');

    // Sauvegarder adresse sur le compte
    if ($user_id) {
        update_user_meta($user_id, 'klipss_firstname',    $firstname);
        update_user_meta($user_id, 'klipss_lastname',     $lastname);
        update_user_meta($user_id, 'klipss_phone',        $phone);
        update_user_meta($user_id, 'klipss_address',      $address);
        update_user_meta($user_id, 'klipss_city',         $city);
        update_user_meta($user_id, 'klipss_postal_code',  $postal);
        update_user_meta($user_id, 'klipss_country',      $country);
    }

    // Enregistrer la commande
    $wpdb->insert($wpdb->prefix . 'klipss_orders', [
        'order_ref'                => $order_ref,
        'stripe_payment_intent_id' => $pi_id,
        'user_id'                  => $user_id,
        'customer_email'           => $email,
        'customer_name'            => $name,
        'customer_phone'           => $phone,
        'shipping_address'         => $address,
        'shipping_city'            => $city,
        'shipping_postal_code'     => $postal,
        'shipping_country'         => $country,
        'style'                    => $style,
        'option_name'              => $option_label,
        'amount'                   => $amount,
        'status'                   => 'pending',
        'created_at'               => current_time('mysql'),
        'updated_at'               => current_time('mysql'),
    ]);

    $amount_eur = number_format($amount / 100, 2, ',', ' ') . ' €';

    // Email client
    if ($email) {
        $account_note = $user_id
            ? "\nSuivez votre pré-commande sur " . home_url('/mon-compte')
            : '';
        wp_mail($email, 'Votre pré-commande Klipss est confirmée !',
            "Bonjour $firstname,\n\nMerci pour votre pré-commande Klipss !\n\nRéférence : $order_ref\nProduit : Klipss $style\nOption : $option_label\nMontant : $amount_eur\n\nLivraison à :\n$name\n$address\n$postal $city, $country\n\nVous serez informé(e) dès que votre Klipss sera prêt à être expédié.$account_note\n\nL'équipe Klipss\nhttps://www.klipss.fr"
        );
    }

    // Email boutique
    wp_mail(KLIPSS_SHOP_EMAIL, "Nouvelle commande $order_ref — $amount_eur",
        "Nouvelle commande !\n\nRéf. : $order_ref\nClient : $name\nEmail : $email\nTél : $phone\nAdresse : $address, $postal $city, $country\nProduit : Klipss $style\nOption : $option_label\nMontant : $amount_eur\nStripe PI : $pi_id\n\nStripe Dashboard : https://dashboard.stripe.com/" . (defined('WP_DEBUG') && WP_DEBUG ? 'test/' : '') . "payment_intents/$pi_id"
    );

    wp_send_json_success([
        'order_ref'       => $order_ref,
        'account_created' => (bool) $user_id,
        'account_url'     => home_url('/mon-compte'),
    ]);
}
add_action('wp_ajax_klipss_process_order',        'klipss_ajax_process_order');
add_action('wp_ajax_nopriv_klipss_process_order', 'klipss_ajax_process_order');

/* ─── AJAX : mes commandes (espace client) ───────────────────── */

function klipss_ajax_get_my_orders() {
    check_ajax_referer('klipss_nonce_account', 'nonce');
    if (!is_user_logged_in()) wp_send_json_error(['message' => 'Non connecté.']);

    global $wpdb;
    $orders = $wpdb->get_results($wpdb->prepare(
        "SELECT order_ref, style, option_name, amount, status, tracking_number, carrier, created_at FROM {$wpdb->prefix}klipss_orders WHERE user_id = %d ORDER BY created_at DESC",
        get_current_user_id()
    ), ARRAY_A);

    // Labels de statut
    $labels = [
        'pending'    => 'En attente',
        'processing' => 'En préparation',
        'shipped'    => 'Expédiée',
        'delivered'  => 'Livrée',
        'cancelled'  => 'Annulée',
    ];

    foreach ($orders as &$o) {
        $o['status_label'] = $labels[$o['status']] ?? $o['status'];
        $o['amount_eur']   = number_format($o['amount'] / 100, 2, ',', ' ') . ' €';
    }

    wp_send_json_success(['orders' => $orders]);
}
add_action('wp_ajax_klipss_get_my_orders', 'klipss_ajax_get_my_orders');
