/**
 * Cookie Consent Module — conforme CNIL
 *
 * - Bannière au premier accès (Tout accepter / Tout refuser / Personnaliser).
 * - Aucun script tiers (GA4, Meta, TikTok, Pinterest) chargé avant consentement.
 * - Choix conservé 13 mois dans le cookie klipss_cookie_consent.
 * - Journalisation côté serveur via AJAX (wp_klipss_consent_log).
 */

const COOKIE_NAME = 'klipss_cookie_consent';
const COOKIE_MAX_AGE = 60 * 60 * 24 * 395; // ~13 mois en secondes

let cfg = null;

export function init() {
    cfg = window.klipss_consent;
    if (!cfg) return;

    const banner = document.getElementById('klipssCookieBanner');
    const modal  = document.getElementById('klipssCookieModal');
    if (!banner && !modal) return;

    // Mesure d'audience
    // En mode GTM, le conteneur et le Consent Mode v2 sont déjà amorcés dans le
    // <head> (klipss_output_gtm_head), avec l'état de consentement initial lu côté
    // serveur. Le module se contente de pousser les mises à jour au clic.
    // En mode direct (sans GTM), on charge les scripts selon un choix déjà enregistré.
    if (!cfg.gtm_id && cfg.saved && typeof cfg.saved === 'object') {
        applyConsent(cfg.saved);
    }

    // Bannière
    document.getElementById('cookieAcceptAll')?.addEventListener('click', () =>
        save({ analytics: true, functional: true, marketing: true }));
    document.getElementById('cookieRejectAll')?.addEventListener('click', () =>
        save({ analytics: false, functional: false, marketing: false }));
    document.getElementById('cookieCustomize')?.addEventListener('click', openModal);

    // Modale
    document.getElementById('cookieModalClose')?.addEventListener('click', closeModal);
    document.getElementById('cookieModalOverlay')?.addEventListener('click', closeModal);
    document.getElementById('cookieModalReject')?.addEventListener('click', () =>
        save({ analytics: false, functional: false, marketing: false }));
    document.getElementById('cookieModalSave')?.addEventListener('click', () => save(readToggles()));

    // Lien « Gérer mes cookies » (footer + politiques)
    document.querySelectorAll('.js-cookie-settings').forEach((el) =>
        el.addEventListener('click', (e) => { e.preventDefault(); openModal(); }));

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal?.classList.contains('is-open')) closeModal();
    });
}

/* ─── Lecture / écriture des choix ──────────────────────────────────── */

function readToggles() {
    return {
        analytics:  !!document.getElementById('cookieToggleAnalytics')?.checked,
        functional: !!document.getElementById('cookieToggleFunctional')?.checked,
        marketing:  !!document.getElementById('cookieToggleMarketing')?.checked,
    };
}

function prefillToggles() {
    const s = cfg.saved || {};
    const set = (id, val) => { const el = document.getElementById(id); if (el) el.checked = !!val; };
    set('cookieToggleAnalytics', s.analytics);
    set('cookieToggleFunctional', s.functional);
    set('cookieToggleMarketing', s.marketing);
}

function save(choices) {
    cfg.saved = choices;
    writeCookie(choices);
    logConsent(choices);
    applyConsent(choices);
    hideBanner();
    closeModal();
}

function writeCookie(choices) {
    const payload = {
        v: cfg.version,
        analytics: !!choices.analytics,
        functional: !!choices.functional,
        marketing: !!choices.marketing,
        ts: Date.now(),
    };
    const value = encodeURIComponent(JSON.stringify(payload));
    const secure = location.protocol === 'https:' ? '; Secure' : '';
    document.cookie = `${COOKIE_NAME}=${value}; Max-Age=${COOKIE_MAX_AGE}; Path=/; SameSite=Lax${secure}`;
}

function logConsent(choices) {
    try {
        fetch(cfg.ajax_url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
                action: 'klipss_log_consent',
                nonce: cfg.nonce,
                choices: JSON.stringify({
                    analytics: !!choices.analytics,
                    functional: !!choices.functional,
                    marketing: !!choices.marketing,
                }),
            }),
            keepalive: true,
        });
    } catch (_) {}
}

/* ─── Application des choix → chargement gated des scripts tiers ─────── */

function applyConsent(choices) {
    // Si GTM est configuré, il pilote tous les tags via Consent Mode v2.
    if (cfg.gtm_id) {
        applyGtmConsent(choices);
        if (choices.functional) window.klipssFunctionalCookies = true;
        return;
    }

    // Sinon : chargement direct des outils (gated)
    if (choices.analytics && cfg.ga_id) loadGA(cfg.ga_id);
    if (choices.marketing) {
        if (cfg.meta_id) loadMetaPixel(cfg.meta_id);
        if (cfg.tiktok_id) loadTikTok(cfg.tiktok_id);
        if (cfg.pinterest_id) loadPinterest(cfg.pinterest_id);
    }
    if (choices.functional) window.klipssFunctionalCookies = true;
}

/* Google Tag Manager + Consent Mode v2.
   Le conteneur et les valeurs par défaut sont posés dans le <head>
   (klipss_output_gtm_head). Au clic sur la bannière, on pousse seulement la
   mise à jour des signaux de consentement. */
function applyGtmConsent(choices) {
    window.dataLayer = window.dataLayer || [];
    window.gtag = window.gtag || function () { window.dataLayer.push(arguments); };
    window.gtag('consent', 'update', {
        analytics_storage:       choices.analytics ? 'granted' : 'denied',
        ad_storage:              choices.marketing ? 'granted' : 'denied',
        ad_user_data:            choices.marketing ? 'granted' : 'denied',
        ad_personalization:      choices.marketing ? 'granted' : 'denied',
        functionality_storage:   choices.functional ? 'granted' : 'denied',
        personalization_storage: choices.functional ? 'granted' : 'denied',
    });
}

/* Google Analytics 4 — anonymisation IP, pas de partage Google Ads */
function loadGA(id) {
    if (window.__klipssGaLoaded) return;
    window.__klipssGaLoaded = true;

    const s = document.createElement('script');
    s.async = true;
    s.src = 'https://www.googletagmanager.com/gtag/js?id=' + encodeURIComponent(id);
    document.head.appendChild(s);

    window.dataLayer = window.dataLayer || [];
    function gtag() { window.dataLayer.push(arguments); }
    window.gtag = gtag;
    gtag('js', new Date());
    gtag('config', id, {
        anonymize_ip: true,
        allow_google_signals: false,
        allow_ad_personalization_signals: false,
    });
}

function loadMetaPixel(id) {
    if (window.__klipssMetaLoaded) return;
    window.__klipssMetaLoaded = true;
    /* eslint-disable */
    !function (f, b, e, v, n, t, s) {
        if (f.fbq) return; n = f.fbq = function () { n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments) };
        if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0'; n.queue = [];
        t = b.createElement(e); t.async = !0; t.src = v; s = b.getElementsByTagName(e)[0]; s.parentNode.insertBefore(t, s);
    }(window, document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');
    /* eslint-enable */
    window.fbq('init', id);
    window.fbq('track', 'PageView');
}

function loadTikTok(id) {
    if (window.__klipssTtLoaded) return;
    window.__klipssTtLoaded = true;
    /* eslint-disable */
    !function (w, d, t) {
        w.TiktokAnalyticsObject = t; var ttq = w[t] = w[t] || [];
        ttq.methods = ['page', 'track', 'identify', 'instances', 'debug', 'on', 'off', 'once', 'ready', 'alias', 'group', 'enableCookie', 'disableCookie'];
        ttq.setAndDefer = function (t, e) { t[e] = function () { t.push([e].concat(Array.prototype.slice.call(arguments, 0))) } };
        for (var i = 0; i < ttq.methods.length; i++) ttq.setAndDefer(ttq, ttq.methods[i]);
        ttq.load = function (e) {
            var n = 'https://analytics.tiktok.com/i18n/pixel/events.js';
            ttq._i = ttq._i || {}; ttq._i[e] = []; ttq._i[e]._u = n; ttq._t = ttq._t || {}; ttq._t[e] = +new Date; ttq._o = ttq._o || {}; ttq._o[e] = {};
            var o = d.createElement('script'); o.type = 'text/javascript'; o.async = !0; o.src = n + '?sdkid=' + e;
            var a = d.getElementsByTagName('script')[0]; a.parentNode.insertBefore(o, a);
        };
        ttq.load(id); ttq.page();
    }(window, document, 'ttq');
    /* eslint-enable */
}

function loadPinterest(id) {
    if (window.__klipssPinLoaded) return;
    window.__klipssPinLoaded = true;
    /* eslint-disable */
    !function (e) {
        if (!window.pintrk) {
            window.pintrk = function () { window.pintrk.queue.push(Array.prototype.slice.call(arguments)) };
            var n = window.pintrk; n.queue = []; n.version = '3.0';
            var t = document.createElement('script'); t.async = !0; t.src = e;
            var r = document.getElementsByTagName('script')[0]; r.parentNode.insertBefore(t, r);
        }
    }('https://s.pinimg.com/ct/core.js');
    /* eslint-enable */
    window.pintrk('load', id);
    window.pintrk('page');
}

/* ─── UI ────────────────────────────────────────────────────────────── */

function openModal() {
    prefillToggles();
    const modal = document.getElementById('klipssCookieModal');
    if (!modal) return;
    modal.classList.add('is-open');
    modal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    const modal = document.getElementById('klipssCookieModal');
    if (!modal) return;
    modal.classList.remove('is-open');
    modal.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
}

function hideBanner() {
    document.getElementById('klipssCookieBanner')?.classList.remove('is-visible');
}
