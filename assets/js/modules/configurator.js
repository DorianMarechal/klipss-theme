/**
 * Configurator Module
 * Progressive disclosure: ① Couleur → ② Compatibilité → ③ Commander
 */

import { mountPaymentForm } from './stripe-checkout.js';

const ecosystemNames = {
    'apple':   'Apple Find My',
    'android': 'Google Find My Device',
};

export function init() {
    const configuratorImage       = document.getElementById('configuratorImage');
    const configuratorPlaceholder = document.getElementById('configuratorPlaceholder');
    const configuratorBuyBtn      = document.getElementById('configuratorBuyBtn');

    if (!configuratorImage || !configuratorBuyBtn) return;

    const steps = {
        1: document.querySelector('[data-step="1"]'),
        2: document.querySelector('[data-step="2"]'),
        3: document.querySelector('[data-step="3"]'),
    };

    const hasSteps = steps[1] && steps[2] && steps[3];

    initStyleSelection(configuratorImage, configuratorPlaceholder, hasSteps ? steps : null);
    initEcosystemSelection(configuratorBuyBtn, hasSteps ? steps : null);
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

function initStyleSelection(configuratorImage, placeholder, steps) {
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

            if (!steps) return;

            // Mark step 1 complete
            if (!steps[1].classList.contains('is-completed')) {
                completeStep(steps[1]);
            }
            // Unlock step 2 if still locked
            if (steps[2].classList.contains('is-locked')) {
                unlockStep(steps[2]);
            }
        });
    });
}

/* ─── Ecosystem selection (Apple Find My / Google Find My Device) */

function initEcosystemSelection(configuratorBuyBtn, steps) {
    const featureInputs          = document.querySelectorAll('.configurator__feature-input');
    const configuratorEcosystem  = document.getElementById('configuratorEcosystemLabel');

    featureInputs.forEach(input => {
        input.addEventListener('change', () => {
            const ecosystem = input.value;

            if (configuratorEcosystem) {
                configuratorEcosystem.textContent = ecosystemNames[ecosystem] || ecosystem;
            }

            configuratorBuyBtn.disabled = false;

            if (!steps) return;

            // Mark step 2 complete
            if (!steps[2].classList.contains('is-completed')) {
                completeStep(steps[2]);
            }
            // Unlock step 3 (commander)
            if (steps[3].classList.contains('is-locked')) {
                unlockStep(steps[3]);
            }
        });
    });
}

/* ─── Bouton Commander → Stripe ─────────────────────────────── */

function initStripeButton() {
    const buyBtn = document.getElementById('configuratorBuyBtn');
    if (!buyBtn) return;

    buyBtn.addEventListener('click', () => {
        const checkedInput = document.querySelector('.configurator__feature-input:checked');
        const activeStyle  = document.querySelector('.configurator__style-btn.is-active');

        const ecosystem     = checkedInput ? checkedInput.value : '';
        const styleName     = activeStyle  ? (activeStyle.querySelector('.configurator__style-name')?.textContent || '') : '';
        const ecosystemLabel = ecosystemNames[ecosystem] || ecosystem;

        const summary = styleName + ' · ' + ecosystemLabel + ' · 60€';

        mountPaymentForm('pack', styleName, summary, ecosystem);
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
