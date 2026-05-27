/**
 * Configurator Module
 * Progressive disclosure: ① Couleur → ② Commander
 */

import { mountPaymentForm } from './stripe-checkout.js';

export function init() {
    const configuratorImage       = document.getElementById('configuratorImage');
    const configuratorPlaceholder = document.getElementById('configuratorPlaceholder');
    const configuratorBuyBtn      = document.getElementById('configuratorBuyBtn');

    if (!configuratorImage || !configuratorBuyBtn) return;

    const steps = {
        1: document.querySelector('[data-step="1"]'),
        2: document.querySelector('[data-step="2"]'),
    };

    const hasSteps = steps[1] && steps[2];

    initStyleSelection(configuratorImage, configuratorPlaceholder, configuratorBuyBtn, hasSteps ? steps : null);
    initOverviewAccordion();
    initStripeButton();
}

/* ─── Step helpers ──────────────────────────────────────────── */

function completeStep(stepEl) {
    stepEl.classList.add('is-completed');
}

function unlockStep(stepEl, instant = false) {
    stepEl.classList.remove('is-locked');
    const body = stepEl.querySelector('.configurator__step-body');
    if (!body) return;

    if (instant || !window.gsap) {
        body.style.cssText = '';
        return;
    }

    // Animate body open
    window.gsap.from(body, {
        height:   0,
        opacity:  0,
        overflow: 'hidden',
        duration: 0.45,
        ease:     'power2.out',
        clearProps: 'height,opacity,overflow',
    });

    // Pulse the step border to draw attention
    stepEl.classList.add('is-unlocking');
    setTimeout(() => stepEl.classList.remove('is-unlocking'), 700);

    // Smooth scroll to newly revealed step
    setTimeout(() => stepEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' }), 150);
}

/* ─── Style/color selection ─────────────────────────────────── */

function initStyleSelection(configuratorImage, placeholder, configuratorBuyBtn, steps) {
    const styleButtons = document.querySelectorAll('.configurator__style-btn');

    styleButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            styleButtons.forEach(b => b.classList.remove('is-active'));
            btn.classList.add('is-active');

            const newImage = btn.dataset.image;
            if (newImage) {
                // Première sélection : masquer le placeholder, révéler l'image
                if (placeholder && placeholder.style.display !== 'none') {
                    placeholder.style.display = 'none';
                    configuratorImage.style.display = '';
                }
                configuratorImage.style.opacity = '0';
                setTimeout(() => {
                    configuratorImage.src = newImage;
                    configuratorImage.style.opacity = '1';
                }, 200);
            }

            configuratorBuyBtn.disabled = false;

            if (!steps) return;

            // Mark step 1 complete
            if (!steps[1].classList.contains('is-completed')) {
                completeStep(steps[1]);
            }
            // Unlock step 2 (commander) right away
            if (steps[2].classList.contains('is-locked')) {
                unlockStep(steps[2]);
            }
        });
    });
}

/* ─── Bouton Commander → Stripe ─────────────────────────────── */

function initStripeButton() {
    const buyBtn = document.getElementById('configuratorBuyBtn');
    if (!buyBtn) return;

    buyBtn.addEventListener('click', () => {
        const activeStyle = document.querySelector('.configurator__style-btn.is-active');
        const styleName   = activeStyle ? (activeStyle.querySelector('.configurator__style-name')?.textContent || '') : '';

        const summary = styleName + ' · Apple & Android · 45€';

        mountPaymentForm('pack', styleName, summary, 'both');
    });
}

/* ─── Overview accordion ────────────────────────────────────── */

function initOverviewAccordion() {
    const overviewToggle = document.querySelector('.configurator__overview-toggle');
    if (overviewToggle) {
        overviewToggle.addEventListener('click', () => {
            const isExpanded = overviewToggle.getAttribute('aria-expanded') === 'true';
            overviewToggle.setAttribute('aria-expanded', !isExpanded);
        });
    }
}
