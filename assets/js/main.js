/**
 * Klipss - Main JavaScript Entry Point
 *
 * This file imports and initializes all modules.
 * Each module is responsible for a specific feature of the site.
 * v2 — configurator: couleur + compatibilité (Apple/Android)
 */

import * as Navigation from './modules/navigation.js';
import * as HeroSlider from './modules/hero-slider.js';
import * as VideoSection from './modules/video-section.js';
import * as Modals from './modules/modals.js';
import * as Sliders from './modules/sliders.js';
import * as Configurator from './modules/configurator.js';
import * as StripeCheckout from './modules/stripe-checkout.js';
import * as FAQ from './modules/faq.js';
// parallax.js supprimé — doublon avec animations.js (GSAP ScrollTrigger)
import * as Animations from './modules/animations.js';
import * as StickyBar from './modules/sticky-bar.js';
import * as Account from './modules/account.js';
import * as CookieConsent from './modules/cookie-consent.js';

/**
 * Initialize all modules when DOM is ready
 */
function initApp() {
    // Core navigation
    Navigation.init();

    // Sliders
    HeroSlider.init();
    VideoSection.init();
    Sliders.init();

    // Modals
    Modals.init();

    // Interactive sections
    Configurator.init();
    StripeCheckout.init();
    FAQ.init();

    // Visual effects
    Animations.init();
    StickyBar.init();

    // Account / Mon Compte
    Account.init();

    // Bannière cookies / consentement RGPD
    CookieConsent.init();
}

// Initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initApp);
} else {
    initApp();
}
