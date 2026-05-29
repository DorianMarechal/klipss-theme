<?php
/**
 * Klipss — Conformité RGPD / CNIL
 * Bannière cookies, journalisation des consentements, chargement gated des
 * scripts tiers (GA4, Meta, TikTok, Pinterest), preuve de consentement
 * newsletter et CGV.
 */

if (!defined('ABSPATH')) exit;

/* ─── Versions des documents (surchargées possibles via wp-config) ──── */

if (!defined('KLIPSS_CONSENT_VERSION')) define('KLIPSS_CONSENT_VERSION', '1.0');
if (!defined('KLIPSS_CGV_VERSION'))     define('KLIPSS_CGV_VERSION', '2026-05');

// IDs des outils tiers — surchargables dans wp-config.php.
// Tant qu'ils sont vides, aucun script tiers n'est chargé.
// Si KLIPSS_GTM_ID est défini, GTM gère l'ensemble des tags (GA4, Meta, etc.)
// via Consent Mode v2, et les chargeurs directs ci-dessous sont ignorés.
if (!defined('KLIPSS_GTM_ID'))        define('KLIPSS_GTM_ID', 'GTM-NG5TL8W7');
if (!defined('KLIPSS_GA4_ID'))        define('KLIPSS_GA4_ID', '');
if (!defined('KLIPSS_META_PIXEL_ID')) define('KLIPSS_META_PIXEL_ID', '');
if (!defined('KLIPSS_TIKTOK_ID'))     define('KLIPSS_TIKTOK_ID', '');
if (!defined('KLIPSS_PINTEREST_ID'))  define('KLIPSS_PINTEREST_ID', '');

/* ─── Journalisation d'un consentement ──────────────────────────────── */

/**
 * Enregistre une preuve de consentement dans wp_klipss_consent_log.
 *
 * @param string $type    cookies | newsletter | cgv
 * @param array  $choices ex. ['analytics'=>true,'functional'=>false,'marketing'=>false]
 * @param string $version version du document/texte accepté
 */
function klipss_log_consent($type, array $choices, $version) {
    global $wpdb;

    $ip = $_SERVER['REMOTE_ADDR'] ?? '';
    $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
    // Hash IP + UA : conserve une preuve sans stocker de donnée identifiante en clair.
    $consent_hash = hash('sha256', $ip . '|' . $ua);

    $user_id = get_current_user_id();

    $wpdb->insert($wpdb->prefix . 'klipss_consent_log', [
        'user_id'           => $user_id ?: null,
        'consent_type'      => $type,
        'consent_hash'      => $consent_hash,
        'consent_choices'   => wp_json_encode($choices),
        'consent_version'   => $version,
        'consent_timestamp' => current_time('mysql'),
    ]);
}

/* ─── AJAX : journalisation du consentement cookies ─────────────────── */

function klipss_ajax_log_consent() {
    check_ajax_referer('klipss_nonce_consent', 'nonce');

    $raw = $_POST['choices'] ?? '';
    $decoded = is_string($raw) ? json_decode(wp_unslash($raw), true) : null;
    if (!is_array($decoded)) {
        wp_send_json_error(['message' => 'Choix invalides.']);
    }

    $choices = [
        'analytics'  => !empty($decoded['analytics']),
        'functional' => !empty($decoded['functional']),
        'marketing'  => !empty($decoded['marketing']),
    ];

    klipss_log_consent('cookies', $choices, KLIPSS_CONSENT_VERSION);
    wp_send_json_success(['logged' => true]);
}
add_action('wp_ajax_klipss_log_consent',        'klipss_ajax_log_consent');
add_action('wp_ajax_nopriv_klipss_log_consent', 'klipss_ajax_log_consent');

/* ─── Données pour le JS (module cookie-consent.js) ─────────────────── */

function klipss_consent_localize() {
    $saved = null;
    if (isset($_COOKIE['klipss_cookie_consent'])) {
        $decoded = json_decode(wp_unslash($_COOKIE['klipss_cookie_consent']), true);
        if (is_array($decoded)) {
            $saved = $decoded;
        }
    }

    wp_localize_script('klipss-main-script', 'klipss_consent', [
        'ajax_url'      => admin_url('admin-ajax.php'),
        'nonce'         => wp_create_nonce('klipss_nonce_consent'),
        'version'       => KLIPSS_CONSENT_VERSION,
        'gtm_id'        => KLIPSS_GTM_ID,
        'ga_id'         => KLIPSS_GA4_ID,
        'meta_id'       => KLIPSS_META_PIXEL_ID,
        'tiktok_id'     => KLIPSS_TIKTOK_ID,
        'pinterest_id'  => KLIPSS_PINTEREST_ID,
        'saved'         => $saved,
    ]);
}
add_action('wp_enqueue_scripts', 'klipss_consent_localize', 20);

/* ─── Google Tag Manager + Consent Mode v2 (dans le <head>) ─────────── */

function klipss_output_gtm_head() {
    if (!KLIPSS_GTM_ID) return;

    // État de consentement initial lu depuis le cookie (pour cette page)
    $saved = null;
    if (isset($_COOKIE['klipss_cookie_consent'])) {
        $decoded = json_decode(wp_unslash($_COOKIE['klipss_cookie_consent']), true);
        if (is_array($decoded)) $saved = $decoded;
    }
    $g = static function ($b) { return $b ? 'granted' : 'denied'; };
    $analytics  = $g(!empty($saved['analytics']));
    $marketing  = $g(!empty($saved['marketing']));
    $functional = $g(!empty($saved['functional']));
    $gtm_id     = esc_js(KLIPSS_GTM_ID);
    ?>
    <!-- Google Consent Mode v2 + Google Tag Manager (Klipss) -->
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('consent','default',{ad_storage:'denied',ad_user_data:'denied',ad_personalization:'denied',analytics_storage:'denied',functionality_storage:'denied',personalization_storage:'denied',security_storage:'granted',wait_for_update:500});
    gtag('set','url_passthrough',true);
    gtag('set','ads_data_redaction',true);
    <?php if ($saved) : ?>
    gtag('consent','update',{analytics_storage:'<?php echo $analytics; ?>',ad_storage:'<?php echo $marketing; ?>',ad_user_data:'<?php echo $marketing; ?>',ad_personalization:'<?php echo $marketing; ?>',functionality_storage:'<?php echo $functional; ?>',personalization_storage:'<?php echo $functional; ?>'});
    <?php endif; ?>
    (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','<?php echo $gtm_id; ?>');
    </script>
    <!-- End Google Tag Manager -->
    <?php
}
add_action('wp_head', 'klipss_output_gtm_head', 1);

/* ─── Rendu de la bannière + modale de préférences ──────────────────── */

function klipss_render_cookie_banner() {
    // La bannière n'est visible qu'en l'absence de choix enregistré.
    $needs_choice = !isset($_COOKIE['klipss_cookie_consent']);
    $cookies_url  = home_url('/politique-cookies/');
    ?>
    <!-- ── Bannière cookies (RGPD/CNIL) ───────────────────────────── -->
    <div class="cookie-banner<?php echo $needs_choice ? ' is-visible' : ''; ?>"
         id="klipssCookieBanner" role="dialog" aria-live="polite"
         aria-label="Gestion des cookies" aria-describedby="cookieBannerText">
        <div class="cookie-banner__inner">
            <div class="cookie-banner__text" id="cookieBannerText">
                <h2 class="cookie-banner__title">Nous respectons votre vie privée</h2>
                <p>
                    Nous utilisons des cookies pour assurer le bon fonctionnement du site,
                    mesurer son audience et, avec votre accord, vous proposer des contenus adaptés.
                    Vous pouvez accepter, refuser ou personnaliser vos choix.
                    <a href="<?php echo esc_url($cookies_url); ?>" class="cookie-banner__link">En savoir plus</a>.
                </p>
            </div>
            <div class="cookie-banner__actions">
                <button type="button" class="cookie-btn" id="cookieRejectAll">Tout refuser</button>
                <button type="button" class="cookie-btn" id="cookieCustomize">Personnaliser</button>
                <button type="button" class="cookie-btn" id="cookieAcceptAll">Tout accepter</button>
            </div>
        </div>
    </div>

    <!-- ── Modale de personnalisation ─────────────────────────────── -->
    <div class="cookie-modal" id="klipssCookieModal" aria-hidden="true" role="dialog"
         aria-modal="true" aria-labelledby="cookieModalTitle">
        <div class="cookie-modal__overlay" id="cookieModalOverlay"></div>
        <div class="cookie-modal__box">
            <div class="cookie-modal__head">
                <h2 class="cookie-modal__title" id="cookieModalTitle">Préférences de cookies</h2>
                <button type="button" class="cookie-modal__close" id="cookieModalClose" aria-label="Fermer">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </button>
            </div>

            <div class="cookie-modal__body">
                <div class="cookie-cat">
                    <div class="cookie-cat__head">
                        <span class="cookie-cat__name">Strictement nécessaires</span>
                        <span class="cookie-cat__always">Toujours actifs</span>
                    </div>
                    <p class="cookie-cat__desc">Indispensables au fonctionnement du site (session, panier, sécurité du paiement, mémorisation de vos choix). Ils ne nécessitent pas de consentement.</p>
                </div>

                <div class="cookie-cat">
                    <div class="cookie-cat__head">
                        <span class="cookie-cat__name">Mesure d'audience</span>
                        <label class="cookie-switch">
                            <input type="checkbox" id="cookieToggleAnalytics">
                            <span class="cookie-switch__slider"></span>
                        </label>
                    </div>
                    <p class="cookie-cat__desc">Statistiques de visite anonymisées (Google Analytics 4) pour améliorer le site.</p>
                </div>

                <div class="cookie-cat">
                    <div class="cookie-cat__head">
                        <span class="cookie-cat__name">Fonctionnels</span>
                        <label class="cookie-switch">
                            <input type="checkbox" id="cookieToggleFunctional">
                            <span class="cookie-switch__slider"></span>
                        </label>
                    </div>
                    <p class="cookie-cat__desc">Mémorisation de vos préférences (dernier coloris configuré, affichage de la pop-up newsletter).</p>
                </div>

                <div class="cookie-cat">
                    <div class="cookie-cat__head">
                        <span class="cookie-cat__name">Publicité &amp; réseaux sociaux</span>
                        <label class="cookie-switch">
                            <input type="checkbox" id="cookieToggleMarketing">
                            <span class="cookie-switch__slider"></span>
                        </label>
                    </div>
                    <p class="cookie-cat__desc">Mesure des campagnes et publicité ciblée (Meta, TikTok, Pinterest).</p>
                </div>
            </div>

            <div class="cookie-modal__foot">
                <a href="<?php echo esc_url($cookies_url); ?>" class="cookie-modal__more">Politique de cookies</a>
                <div class="cookie-modal__foot-actions">
                    <button type="button" class="cookie-btn" id="cookieModalReject">Tout refuser</button>
                    <button type="button" class="cookie-btn cookie-btn--primary" id="cookieModalSave">Enregistrer mes choix</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}
