<?php
/**
 * Klipss Theme Functions
 */

// Empecher l'acces direct
if (!defined('ABSPATH')) {
    exit;
}

// Comptes clients & gestion des commandes
require_once get_template_directory() . '/inc/klipss-customer.php';
require_once get_template_directory() . '/inc/klipss-admin-orders.php';

// Masquer la barre d'administration WordPress sur le front-end
add_filter('show_admin_bar', '__return_false', 9999);
add_action('wp_head', function() {
    echo '<style>#wpadminbar{display:none!important}html{margin-top:0!important}</style>';
});

/**
 * Stop WordPress from redirecting static image files
 */
function klipss_allow_static_files($redirect_url, $requested_url) {
    $image_extensions = ['webp', 'svg', 'png', 'jpg', 'jpeg', 'gif', 'ico'];
    $path = parse_url($requested_url, PHP_URL_PATH);
    $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

    if (in_array($extension, $image_extensions)) {
        return false;
    }
    return $redirect_url;
}
add_filter('redirect_canonical', 'klipss_allow_static_files', 10, 2);

/**
 * Serve WebP/SVG images through PHP to fix MIME type issues
 */
function klipss_rewrite_image_urls($buffer) {
    $theme_url = get_template_directory_uri();
    $serve_url = $theme_url . '/serve-image.php?img=';

    // Replace webp and svg URLs in theme assets
    $buffer = preg_replace(
        '#' . preg_quote($theme_url, '#') . '/assets/images/([^"\']+\.(?:webp|svg))#',
        $serve_url . '$1',
        $buffer
    );

    return $buffer;
}

function klipss_start_buffer() {
    // Proxy WebP/SVG uniquement en local dev (Local by Flywheel)
    // En production le serveur web sert correctement ces types MIME
    if (defined('WP_DEBUG') && WP_DEBUG) {
        ob_start('klipss_rewrite_image_urls');
    }
}

function klipss_end_buffer() {
    if (ob_get_level() > 0) {
        ob_end_flush();
    }
}
add_action('template_redirect', 'klipss_start_buffer');
add_action('shutdown', 'klipss_end_buffer');

/**
 * Enqueue scripts and styles
 */
function klipss_enqueue_assets() {
    // Adobe Fonts (Typekit) - Gotham
    wp_enqueue_style(
        'klipss-typekit',
        'https://use.typekit.net/agy8wyb.css',
        array(),
        null
    );

    // Main CSS — minifié en production, source en dev
    $css_file = (defined('WP_DEBUG') && WP_DEBUG) ? '/assets/css/main.css' : '/assets/css/main.min.css';
    wp_enqueue_style(
        'klipss-main-style',
        get_template_directory_uri() . $css_file,
        array('klipss-typekit'),
        filemtime(get_template_directory() . $css_file)
    );

    // Main JS (ES6 modules) — GSAP chargé dynamiquement depuis le module
    wp_enqueue_script(
        'klipss-main-script',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        filemtime(get_template_directory() . '/assets/js/main.js'),
        true
    );

    // Ionicons supprimé — remplacé par SVG inline (voir klipss_svg_icon())
}

/**
 * Add type="module" and nomodule attributes to scripts
 */
function klipss_add_script_attributes($tag, $handle, $src) {
    // Scripts with type="module"
    if ('klipss-main-script' === $handle) {
        $tag = '<script type="module" src="' . esc_url($src) . '"></script>';
    }

    return $tag;
}
add_filter('script_loader_tag', 'klipss_add_script_attributes', 10, 3);
add_action('wp_enqueue_scripts', 'klipss_enqueue_assets');

/**
 * Import map — cache-busting pour les sous-modules ES.
 * Ajoute ?ver=<filemtime> à chaque import de module JS,
 * pour que le CDN/LSADC serve la bonne version après chaque déploiement.
 */
function klipss_output_importmap() {
    $theme_dir = get_template_directory();
    $theme_uri = get_template_directory_uri();
    $mod_dir   = $theme_dir . '/assets/js/modules';
    $mod_uri   = $theme_uri . '/assets/js/modules';

    $files = glob($mod_dir . '/*.js');
    if (!$files) return;

    $main_scope = [];
    $mod_scope  = [];

    foreach ($files as $file) {
        $name = basename($file);
        $ver  = filemtime($file);
        $url  = $mod_uri . '/' . $name . '?ver=' . $ver;

        $main_scope['./modules/' . $name] = $url;
        $mod_scope['./' . $name]          = $url;
    }

    $map = [
        'imports' => new \stdClass(),
        'scopes'  => [
            $theme_uri . '/assets/js/' => $main_scope,
            $mod_uri . '/'             => $mod_scope,
        ],
    ];

    echo '<script type="importmap">' . wp_json_encode($map, JSON_UNESCAPED_SLASHES) . "</script>\n";
}
add_action('wp_head', 'klipss_output_importmap', 3);

/**
 * Theme setup
 */
function klipss_theme_setup() {
    // Support pour le titre du site
    add_theme_support('title-tag');

    // Support pour les images mises en avant
    add_theme_support('post-thumbnails');

    // Support pour le logo personnalise
    add_theme_support('custom-logo', array(
        'width'       => 130,
        'height'      => 50,
        'flex-width'  => true,
        'flex-height' => true,
    ));

    // Enregistrer les menus
    register_nav_menus(array(
        'primary'      => __('Menu Principal', 'klipss'),
        'footer'       => __('Menu Footer Navigation', 'klipss'),
        'footer_legal' => __('Menu Footer Légal', 'klipss'),
    ));
}
add_action('after_setup_theme', 'klipss_theme_setup');

/**
 * Customizer — Réseaux sociaux
 */
function klipss_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'klipss_social', array(
        'title'       => __( 'Réseaux sociaux', 'klipss' ),
        'description' => __( 'Laissez vide pour masquer le réseau.', 'klipss' ),
        'priority'    => 120,
    ) );

    $socials = array(
        'instagram' => 'Instagram',
        'tiktok'    => 'TikTok',
        'facebook'  => 'Facebook',
        'twitter'   => 'Twitter / X',
        'youtube'   => 'YouTube',
        'pinterest' => 'Pinterest',
        'linkedin'  => 'LinkedIn',
    );

    foreach ( $socials as $key => $label ) {
        $wp_customize->add_setting( 'klipss_social_' . $key, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( 'klipss_social_' . $key, array(
            'label'   => $label,
            'section' => 'klipss_social',
            'type'    => 'url',
        ) );
    }
}
add_action( 'customize_register', 'klipss_customize_register' );

/**
 * Retourne la liste des réseaux sociaux configurés
 * Chaque entrée : ['url' => '...', 'icon' => 'logo-xxx', 'label' => '...']
 */
function klipss_get_socials() {
    $networks = array(
        'instagram' => array( 'label' => 'Instagram', 'icon' => 'logo-instagram' ),
        'tiktok'    => array( 'label' => 'TikTok',    'icon' => 'logo-tiktok' ),
        'facebook'  => array( 'label' => 'Facebook',  'icon' => 'logo-facebook' ),
        'twitter'   => array( 'label' => 'Twitter',   'icon' => 'logo-twitter' ),
        'youtube'   => array( 'label' => 'YouTube',   'icon' => 'logo-youtube' ),
        'pinterest' => array( 'label' => 'Pinterest', 'icon' => 'logo-pinterest' ),
        'linkedin'  => array( 'label' => 'LinkedIn',  'icon' => 'logo-linkedin' ),
    );

    $result = array();
    foreach ( $networks as $key => $data ) {
        $url = get_theme_mod( 'klipss_social_' . $key, '' );
        if ( $url ) {
            $result[] = array_merge( $data, array( 'url' => $url ) );
        }
    }
    return $result;
}

/**
 * Inline SVG icons — remplace Ionicons (supprime ~80 Ko JS cross-origin)
 */
function klipss_svg_icon($name, $size = 20) {
    $icons = [
        'logo-instagram'  => '<path d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25 22h-8.5A5.75 5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75 2Zm0 1.5A4.25 4.25 0 0 0 3.5 7.75v8.5A4.25 4.25 0 0 0 7.75 20.5h8.5a4.25 4.25 0 0 0 4.25-4.25v-8.5A4.25 4.25 0 0 0 16.25 3.5ZM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10Zm0 1.5a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm5.25-2.5a1 1 0 1 1 0 2 1 1 0 0 1 0-2Z"/>',
        'logo-tiktok'     => '<path d="M16.6 5.82A4.28 4.28 0 0 1 13.4 3h-3v12.4a2.6 2.6 0 1 1-1.8-2.47V9.47A6.07 6.07 0 1 0 16.6 15V8.74a7.69 7.69 0 0 0 4.4 1.38V6.7a4.28 4.28 0 0 1-4.4-.88Z"/>',
        'logo-facebook'   => '<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>',
        'logo-twitter'    => '<path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/>',
        'logo-youtube'    => '<path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19.1c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.35 29 29 0 0 0-.46-5.33ZM9.75 15.02V8.48l5.75 3.27Z"/>',
        'logo-pinterest'  => '<path d="M12 2a10 10 0 0 0-3.64 19.33c-.1-.83-.18-2.1.04-3l1.3-5.52s-.33-.66-.33-1.64c0-1.54.89-2.69 2-2.69.95 0 1.4.71 1.4 1.56 0 .95-.6 2.37-.91 3.69-.26 1.1.55 1.99 1.63 1.99 1.96 0 3.46-2.07 3.46-5.05 0-2.64-1.9-4.49-4.6-4.49-3.14 0-4.98 2.35-4.98 4.79 0 .95.36 1.96.82 2.51.09.11.1.21.08.32l-.31 1.24c-.05.2-.16.24-.37.14-1.39-.65-2.26-2.68-2.26-4.31 0-3.51 2.55-6.74 7.36-6.74 3.86 0 6.86 2.75 6.86 6.43 0 3.84-2.42 6.92-5.78 6.92-1.13 0-2.19-.59-2.55-1.28l-.69 2.64c-.25.97-.93 2.19-1.39 2.93A10 10 0 1 0 12 2Z"/>',
        'logo-linkedin'   => '<path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/>',
    ];
    $path = $icons[$name] ?? '';
    if (!$path) return '';
    return '<svg xmlns="http://www.w3.org/2000/svg" width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="currentColor">' . $path . '</svg>';
}

/**
 * Preconnect hints for external resources
 */
function klipss_preconnect_hints() {
    echo '<link rel="preconnect" href="https://use.typekit.net" crossorigin>' . "\n";
    echo '<link rel="preconnect" href="https://p.typekit.net" crossorigin>' . "\n";
    echo '<link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>' . "\n";
    echo '<link rel="preload" as="image" href="' . esc_url(get_template_directory_uri() . '/assets/images/klipss/1-desktop.webp') . '" type="image/webp">' . "\n";
}
add_action('wp_head', 'klipss_preconnect_hints', 1);

add_filter('show_admin_bar', function($show) {
    return current_user_can('manage_options');
});

/**
 * [C-2] Headers de sécurité HTTP
 */
function klipss_security_headers() {
    if (is_admin()) return;
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
}
add_action('send_headers', 'klipss_security_headers');

/**
 * Critical CSS inline — above-the-fold (header + hero) pour un premier rendu rapide
 */
function klipss_critical_css() {
    if (!is_front_page()) return;
    ?>
    <style id="critical-css">
    *,*::before,*::after{box-sizing:border-box}*{margin:0;padding:0}ul,ol{list-style:none}body{min-height:100vh;line-height:1.5;-webkit-font-smoothing:antialiased;overflow-x:hidden;font-family:"gotham",sans-serif;background-color:#fffbf7;color:#000;font-size:16px;font-weight:400}a{text-decoration:none;color:inherit}button{background:none;border:none;cursor:pointer;font:inherit;color:inherit}h1,h2,h3,h4,h5,h6{margin:0;font-family:"gotham",sans-serif;font-weight:700;font-style:normal}h1{font-size:32px;line-height:1.2;letter-spacing:-0.015em}
    .container{max-width:1440px;width:100%;margin-left:auto;margin-right:auto;padding-left:20px;padding-right:20px}
    .header{background-color:transparent;color:#1a0509;display:flex;flex-direction:column;position:fixed;top:0;width:100%;z-index:1000}
    .header__banner{display:flex;justify-content:center;align-items:center;padding:4px 12px;background-color:#CA4D26;color:#fffbf7;height:40px;overflow:hidden;position:relative;z-index:999}
    .header__banner-text{margin:0;font-size:14px;text-align:center;position:absolute;width:100%;opacity:0;animation:slideText 9s infinite}
    .header__banner-text:nth-child(1){animation-delay:0s}.header__banner-text:nth-child(2){animation-delay:3s}.header__banner-text:nth-child(3){animation-delay:6s}
    @keyframes slideText{0%{opacity:0;transform:translateY(100%)}10%{opacity:1;transform:translateY(0)}33%{opacity:1;transform:translateY(0)}43%{opacity:0;transform:translateY(-100%)}100%{opacity:0;transform:translateY(-100%)}}
    .header__nav{width:100%;padding:12px 0;position:relative;z-index:100;background-color:transparent}
    .header__nav .container{display:flex;justify-content:space-between;align-items:center}
    .header__logo{display:flex;width:130px;height:50px}.header__logo img{display:block}.header__logo-img{width:130px;height:auto}
    .hero{width:100%;display:flex;flex-direction:column;justify-content:center;align-items:center;gap:12px;padding-top:130px}
    .hero__header{display:flex;flex-direction:column;justify-content:center;align-items:center;gap:8px}
    .hero__subtitle{font-weight:500;font-size:20px;text-transform:capitalize;text-align:center;color:#810D22}
    .hero__title{font-weight:600;font-size:24px;text-align:center;color:#1a0509;line-height:1.2;padding:0 12px}
    .hero__slider{width:100%;flex:1;position:relative;overflow:hidden;display:flex;align-items:center;height:auto}
    .hero__slider-track{display:flex;gap:4px;transition:transform .6s cubic-bezier(.4,0,.2,1);align-items:center}
    .hero__slide{flex-shrink:0}
    .hero__slide-img{display:block;width:85vw;max-width:550px;height:100%;opacity:.4;transition:transform .6s cubic-bezier(.4,0,.2,1),opacity .6s cubic-bezier(.4,0,.2,1);transform:scale(1)}
    .hero__gradient{position:absolute;top:0;width:50px;height:100%;z-index:100;pointer-events:none}
    .hero__gradient--left{left:0;background:linear-gradient(to right,#fffbf7,transparent)}
    .hero__gradient--right{right:0;background:linear-gradient(to left,#fffbf7,transparent)}
    </style>
    <?php
}
add_action('wp_head', 'klipss_critical_css', 2);

/**
 * Stripe — passer la clé publique et l'URL AJAX au JS
 */
function klipss_enqueue_stripe_data() {
    $data = array(
        'pk'            => defined('KLIPSS_STRIPE_PK') ? KLIPSS_STRIPE_PK : '',
        'ajax_url'      => admin_url('admin-ajax.php'),
        'nonce_payment'    => wp_create_nonce('klipss_nonce_payment'),
        'nonce_auth'       => wp_create_nonce('klipss_nonce_auth'),
        'nonce_account'    => wp_create_nonce('klipss_nonce_account'),
        'nonce_newsletter' => wp_create_nonce('klipss_nonce_newsletter'),
        'return_url'    => home_url('/?payment=success'),
        'is_logged_in'  => is_user_logged_in(),
        'account_url'   => home_url('/mon-compte/'),
    );
    // [M-5] N'exposer les données client que si connecté
    if (is_user_logged_in()) {
        $customer_data = klipss_customer_data_for_js();
        $data['customer'] = $customer_data['customer'] ?? null;
    }
    wp_localize_script('klipss-main-script', 'klipss_stripe', $data);
}
add_action('wp_enqueue_scripts', 'klipss_enqueue_stripe_data', 20);

/**
 * Stripe — Créer un PaymentIntent
 * Les montants sont calculés côté serveur, jamais côté client.
 */
function klipss_create_payment_intent() {
    if (!wp_verify_nonce($_POST['nonce'] ?? '', 'klipss_nonce_payment')) {
        wp_send_json_error(['message' => 'Erreur de sécurité.']);
    }

    $option    = sanitize_text_field($_POST['option'] ?? '');
    $style     = sanitize_text_field($_POST['style']  ?? '');
    $email     = sanitize_email($_POST['email']        ?? '');
    $ecosystem = sanitize_text_field($_POST['ecosystem'] ?? '');

    // Tarifs officiels en centimes — seule source de vérité
    $tarifs = [
        'pack' => ['amount' => 4500, 'label' => 'Klipss — Bijou de sac connecté 3-en-1', 'shipping' => 0],
    ];

    if (!isset($tarifs[$option])) {
        wp_send_json_error(['message' => 'Option invalide.']);
    }

    $tarif = $tarifs[$option];

    $response = wp_remote_post('https://api.stripe.com/v1/payment_intents', [
        'headers' => [
            'Authorization' => 'Basic ' . base64_encode(KLIPSS_STRIPE_SK . ':'),
            'Content-Type'  => 'application/x-www-form-urlencoded',
        ],
        'body' => http_build_query(array_filter([
            'amount'                    => $tarif['amount'],
            'currency'                  => 'eur',
            'description'               => $tarif['label'],
            'receipt_email'             => $email ?: null,
            'metadata[style]'           => $style,
            'metadata[option]'          => $option,
            'metadata[ecosystem]'       => $ecosystem ?: null,
            'metadata[customer_email]'  => $email ?: null,
            'automatic_payment_methods[enabled]' => 'true',
        ])),
        'timeout' => 15,
    ]);

    if (is_wp_error($response)) {
        wp_send_json_error(['message' => 'Impossible de contacter Stripe.']);
    }

    $body = json_decode(wp_remote_retrieve_body($response), true);

    if (!empty($body['error'])) {
        wp_send_json_error(['message' => $body['error']['message']]);
    }

    wp_send_json_success([
        'client_secret' => $body['client_secret'],
        'amount'        => $tarif['amount'],
        'shipping'      => $tarif['shipping'],
    ]);
}
add_action('wp_ajax_klipss_create_payment_intent',        'klipss_create_payment_intent');
add_action('wp_ajax_nopriv_klipss_create_payment_intent', 'klipss_create_payment_intent');

/**
 * Renvoie un nonce frais via admin-ajax (jamais mis en cache).
 * Contourne le full-page cache (LiteSpeed) qui fige le nonce inline et
 * provoque une "Erreur de sécurité" quand le nonce caché a expiré.
 */
function klipss_refresh_nonce() {
    wp_send_json_success([
        'nonce_payment' => wp_create_nonce('klipss_nonce_payment'),
        'nonce_auth'    => wp_create_nonce('klipss_nonce_auth'),
    ]);
}
add_action('wp_ajax_klipss_refresh_nonce',        'klipss_refresh_nonce');
add_action('wp_ajax_nopriv_klipss_refresh_nonce', 'klipss_refresh_nonce');

// [H-3] klipss_send_order_confirmation supprimé — doublon de klipss_process_order, exposé publiquement

/**
 * Newsletter — Inscription via MailPoet API
 */
function klipss_newsletter_subscribe() {
    check_ajax_referer('klipss_nonce_newsletter', 'nonce');

    $email = sanitize_email($_POST['email'] ?? '');
    if (!$email || !is_email($email)) {
        wp_send_json_error(['message' => 'Adresse email invalide.']);
    }

    if (!class_exists(\MailPoet\API\API::class)) {
        wp_send_json_error(['message' => 'Service newsletter indisponible.']);
    }

    try {
        $mailpoet = \MailPoet\API\API::MP('v1');
        $lists = $mailpoet->getLists();
        // S'abonner à la première liste (newsletter par défaut)
        $list_id = !empty($lists) ? $lists[0]['id'] : null;
        if (!$list_id) {
            wp_send_json_error(['message' => 'Aucune liste newsletter configurée.']);
        }

        $mailpoet->addSubscriber(
            ['email' => $email],
            [$list_id],
            ['send_confirmation_email' => true, 'schedule_welcome_email' => true]
        );

        wp_send_json_success(['message' => 'Merci ! Vérifiez votre boîte mail pour confirmer votre inscription.']);
    } catch (\Exception $e) {
        $msg = $e->getMessage();
        // L'abonné a été ajouté mais l'email de confirmation a échoué (normal en local)
        if (strpos($msg, 'ajouté') !== false || strpos($msg, 'added') !== false) {
            wp_send_json_success(['message' => 'Merci pour votre inscription !']);
        }
        if (strpos($msg, 'already exists') !== false || strpos($msg, 'existe déjà') !== false) {
            wp_send_json_error(['message' => 'Cette adresse est déjà inscrite.']);
        }
        wp_send_json_error(['message' => 'Une erreur est survenue. Réessayez.']);
    }
}
add_action('wp_ajax_klipss_newsletter_subscribe',        'klipss_newsletter_subscribe');
add_action('wp_ajax_nopriv_klipss_newsletter_subscribe', 'klipss_newsletter_subscribe');

/**
 * Add Klipss Settings Page in Admin
 */
function klipss_add_admin_menu() {
    add_menu_page(
        'Klipss Settings',
        'Klipss',
        'manage_options',
        'klipss-settings',
        'klipss_settings_page',
        'dashicons-cart',
        30
    );

    // Sous-menu Commandes — enregistré ici pour garantir que le parent existe
    add_submenu_page(
        'klipss-settings',
        'Commandes Klipss',
        'Commandes',
        'manage_options',
        'klipss-commandes',
        'klipss_admin_orders_page'
    );
}
add_action('admin_menu', 'klipss_add_admin_menu');

/**
 * Register Klipss Settings
 */
function klipss_register_settings() {
    register_setting('klipss_settings_group', 'klipss_product_id');
}
add_action('admin_init', 'klipss_register_settings');

/**
 * Klipss Settings Page HTML
 */
function klipss_settings_page() {
    $product_id = get_option('klipss_product_id', '');
    ?>
    <div class="wrap">
        <h1>Klipss - Paramètres</h1>

        <form method="post" action="options.php">
            <?php settings_fields('klipss_settings_group'); ?>

            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="klipss_product_id">ID du Produit WooCommerce</label>
                    </th>
                    <td>
                        <input type="number"
                               id="klipss_product_id"
                               name="klipss_product_id"
                               value="<?php echo esc_attr($product_id); ?>"
                               class="regular-text"
                               placeholder="Ex: 123">
                        <p class="description">
                            Entrez l'ID du produit Klipss créé dans WooCommerce.<br>
                            Vous pouvez trouver l'ID en éditant le produit (visible dans l'URL: post=<strong>123</strong>).
                        </p>
                    </td>
                </tr>
            </table>

            <?php submit_button('Enregistrer'); ?>
        </form>

        <hr>

        <h2>Instructions</h2>
        <ol>
            <li><strong>Créez un produit WooCommerce</strong> de type "Variable"</li>
            <li><strong>Ajoutez les attributs</strong> :
                <ul>
                    <li>Style : cuir-marron, bois, rose, noir-mat</li>
                    <li>Compatibilité : apple, android (informative, prix identique)</li>
                </ul>
            </li>
            <li><strong>Créez les variations</strong> au prix unique de 45€</li>
            <li><strong>Entrez l'ID du produit</strong> ci-dessus</li>
            <li><strong>Configurez les paiements</strong> dans WooCommerce > Réglages > Paiements</li>
        </ol>
    </div>
    <?php
}