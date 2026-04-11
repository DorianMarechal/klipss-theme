/**
 * Animations Module
 *
 * Elements are hidden synchronously via vanilla JS in init() — before GSAP
 * loads asynchronously — to eliminate the flash-of-visible-content.
 * GSAP + ScrollTrigger take full control once loaded.
 */

const GSAP_CDN          = 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js';
const SCROLLTRIGGER_CDN = 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js';

// Every selector that will be animated.
// Used to pre-hide elements before GSAP loads (prevents flash).
const WILL_ANIMATE = [
    '.hero__subtitle', '.hero__title', '.hero__cta-text', '.hero__cta-text--right',
    '.cta__action',
    '.video-section__title', '.video-section__btn', '.video-section__slider',
    '.ideas__title', '.ideas__subtitle', '.ideas_quote',
    '.details__item',
    '.tech-spec__title', '.tech-spec__item',
    '.testimonials__title', '.testimonials__slider',
    '.configurator__title', '.configurator__product-label',
    '.configurator__product-image', '.configurator__options', '.configurator__box-content',
    '.faq__title', '.faq__item',
    '.how-it-works__title', '.how-it-works__subtitle', '.how-it-works__step',
    '.comparison__title', '.comparison__subtitle', '.comparison__table-wrap',
];

export function init() {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    // Synchronously hide all animated elements before GSAP loads.
    // This is the single fix for the "elements visible before animation" issue.
    WILL_ANIMATE.forEach(sel => {
        document.querySelectorAll(sel).forEach(el => { el.style.opacity = '0'; });
    });

    Promise.all([loadScript(GSAP_CDN), loadScript(SCROLLTRIGGER_CDN)])
        .then(() => {
            window.gsap.registerPlugin(window.ScrollTrigger);
            initAnimations();
        })
        .catch(() => {
            // GSAP unavailable — restore visibility so content isn't stuck hidden
            WILL_ANIMATE.forEach(sel => {
                document.querySelectorAll(sel).forEach(el => { el.style.opacity = ''; });
            });
        });
}

/* ─── Script loader ─────────────────────────────────────────── */

function loadScript(src) {
    return new Promise((resolve, reject) => {
        const script = document.createElement('script');
        script.src    = src;
        script.onload = resolve;
        script.onerror = reject;
        document.head.appendChild(script);
    });
}

/* ─── Shared animation vars ─────────────────────────────────── */

const D = { duration: 0.65, ease: 'power2.out', clearProps: 'transform', force3D: true, overwrite: 'auto' };

// Plays immediately (no ScrollTrigger) — for hero elements already in viewport
function fadeUpNow(selector, delay = 0) {
    const el = typeof selector === 'string' ? document.querySelector(selector) : selector;
    if (!el) return;
    window.gsap.fromTo(el, { opacity: 0, y: 40 }, { ...D, opacity: 1, y: 0, delay });
}

// Scroll-triggered fade-up
function fadeUp(selector, delay = 0) {
    const el = typeof selector === 'string' ? document.querySelector(selector) : selector;
    if (!el) return;
    window.gsap.fromTo(el, { opacity: 0, y: 40 }, { ...D, opacity: 1, y: 0, delay,
        scrollTrigger: { trigger: el },
    });
}

function fadeLeft(selector, delay = 0) {
    const el = typeof selector === 'string' ? document.querySelector(selector) : selector;
    if (!el) return;
    window.gsap.fromTo(el, { opacity: 0, x: -40 }, { ...D, opacity: 1, x: 0, delay,
        scrollTrigger: { trigger: el },
    });
}

function scaleIn(selector, delay = 0) {
    const el = typeof selector === 'string' ? document.querySelector(selector) : selector;
    if (!el) return;
    window.gsap.fromTo(el, { opacity: 0, scale: 0.95 }, { ...D, opacity: 1, scale: 1, delay,
        scrollTrigger: { trigger: el },
    });
}

// ScrollTrigger.batch — one listener for many elements, fires stagger when group enters
function batchFadeUp(selector, stagger = 0.1) {
    window.ScrollTrigger.batch(selector, {
        onEnter: batch => window.gsap.fromTo(batch,
            { opacity: 0, y: 30 },
            { ...D, opacity: 1, y: 0, duration: 0.55, stagger }
        ),
    });
}

/* ─── Main animation setup ──────────────────────────────────── */

function initAnimations() {
    const gsap = window.gsap;
    const ST   = window.ScrollTrigger;

    // Shared defaults for all fade/entry animations
    ST.defaults({ once: true, start: 'top 88%' });

    // ── Hero v1 ───────────────────────────────────────────────────
    // In viewport on load → no ScrollTrigger, play immediately with delays
    fadeUpNow('.hero__subtitle');
    fadeUpNow('.hero__title',           0.1);
    fadeUpNow('.hero__cta-text',        0.2);
    fadeUpNow('.hero__cta-text--right', 0.4);

    // ── CTA buttons (scroll-triggered per element) ────────────────
    document.querySelectorAll('.cta__action').forEach(el => fadeUp(el));

    // ── Video section ─────────────────────────────────────────────
    fadeUp('.video-section__title');
    fadeUp('.video-section__btn',     0.1);
    scaleIn('.video-section__slider', 0.2);

    // ── Ideas section ─────────────────────────────────────────────
    fadeUp('.ideas__title',    0.1);
    fadeUp('.ideas__subtitle', 0.2);
    fadeUp('.ideas_quote');

    // ── Details section ───────────────────────────────────────────
    batchFadeUp('.details__item');

    // ── Tech specs ────────────────────────────────────────────────
    fadeUp('.tech-spec__title', 0.1);
    batchFadeUp('.tech-spec__item');

    // ── Testimonials ──────────────────────────────────────────────
    fadeUp('.testimonials__title',  0.1);
    fadeUp('.testimonials__slider', 0.2);

    // ── Configurator ──────────────────────────────────────────────
    fadeUp('.configurator__title',         0.1);
    fadeUp('.configurator__product-label', 0.2);
    fadeUp('.configurator__product-image', 0.3);
    fadeLeft('.configurator__options',     0.3);
    fadeUp('.configurator__box-content',   0.4);

    // ── How it works ──────────────────────────────────────────────
    fadeUp('.how-it-works__title');
    fadeUp('.how-it-works__subtitle', 0.1);
    batchFadeUp('.how-it-works__step');

    // ── Comparison ────────────────────────────────────────────────
    fadeUp('.comparison__title');
    fadeUp('.comparison__subtitle', 0.1);
    scaleIn('.comparison__table-wrap', 0.15);

    // ── FAQ ───────────────────────────────────────────────────────
    fadeUp('.faq__title', 0.1);
    batchFadeUp('.faq__item', 0.08);

    // ── Parallax (Ideas section images) ──────────────────────────
    // Replaces the getBoundingClientRect scroll loop in parallax.js
    // ScrollTrigger scrub handles this on the compositor thread with no reflow
    initParallax(gsap);
}

/* ─── GSAP-based parallax ───────────────────────────────────── */
// Replaces parallax.js's getBoundingClientRect + rAF loop.
// scrub: true links the animation directly to the scroll position,
// removing the need for any scroll event listener or layout reads.

function initParallax(gsap) {
    const wrap  = document.querySelector('.idea-image-wrap');
    const items = document.querySelectorAll('.ideas__item');
    if (!wrap || items.length < 2) return;

    // Pure scroll listener — no ScrollTrigger bounds, always follows scroll.
    function update() {
        const rect    = wrap.getBoundingClientRect();
        const viewH   = window.innerHeight;
        const center  = rect.top + rect.height / 2;
        const start   = viewH * 0.8;
        const end     = viewH * 0.2;

        let progress = (start - center) / (start - end);
        progress = Math.max(0, Math.min(1, progress));

        // Center at 0.5: item[0] goes -40→+40, item[1] goes +40→-40 — perfectly symmetric
        const offset = (progress - 0.5) * 80;
        gsap.set(items[0], { y: offset });
        gsap.set(items[1], { y: -offset });
    }

    let ticking = false;
    window.addEventListener('scroll', () => {
        if (ticking) return;
        ticking = true;
        requestAnimationFrame(() => { update(); ticking = false; });
    }, { passive: true });

    window.addEventListener('resize', update, { passive: true });
    update();
}
