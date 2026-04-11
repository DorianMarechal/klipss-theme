/**
 * Cart Module
 * Handles WooCommerce cart integration
 *
 * All configuration comes from WordPress via klipss_cart object:
 * - klipss_cart.product_id: The WooCommerce product ID
 * - klipss_cart.variations: Object mapping "style_option" to variation IDs
 * - klipss_cart.is_simple: Boolean, true if simple product (no variations)
 * - klipss_cart.ajax_url: WordPress AJAX URL
 * - klipss_cart.nonce: Security nonce
 * - klipss_cart.checkout_url: Checkout page URL
 */

export function init() {
    const buyBtn = document.getElementById('configuratorBuyBtn');
    const ctaButtons = document.querySelectorAll('.cta__btn');

    if (buyBtn) {
        buyBtn.addEventListener('click', handleConfiguratorBuy);
    }

    // CTA buttons redirect to configurator section
    ctaButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const configuratorSection = document.getElementById('configurator');
            if (configuratorSection) {
                configuratorSection.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
}

/**
 * Handle configurator buy button click
 */
async function handleConfiguratorBuy(e) {
    e.preventDefault();

    const btn = e.target;
    const originalText = btn.textContent;

    // Check if WooCommerce cart data is available
    if (typeof klipss_cart === 'undefined') {
        showNotification('Configuration WooCommerce requise. Contactez l\'administrateur.', 'error');
        return;
    }

    // Check if product ID is set
    if (!klipss_cart.product_id) {
        showNotification('Produit non configuré. Allez dans Klipss > Paramètres.', 'error');
        return;
    }

    // Get selected style from configurator
    const activeStyleBtn = document.querySelector('.configurator__style-btn.is-active');
    const selectedStyle = activeStyleBtn ? activeStyleBtn.dataset.style : '1';
    const styleName = activeStyleBtn ? activeStyleBtn.querySelector('.configurator__style-name')?.textContent : '';

    // Get selected option from configurator
    const selectedOption = document.querySelector('.configurator__feature-input:checked');
    const optionValue = selectedOption ? selectedOption.value : 'pack';

    // Disable button and show loading state
    btn.disabled = true;
    btn.textContent = 'Ajout en cours...';

    try {
        // Build request data
        const requestData = {
            action: 'klipss_add_to_cart',
            nonce: klipss_cart.nonce,
            product_id: klipss_cart.product_id,
            quantity: 1
        };

        // If it's a variable product, find the variation
        if (!klipss_cart.is_simple && klipss_cart.variations) {
            const variationId = findVariationId(selectedStyle, optionValue);
            if (variationId) {
                requestData.variation_id = variationId;
            }
        }

        const response = await fetch(klipss_cart.ajax_url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams(requestData)
        });

        const data = await response.json();

        if (data.success) {
            showNotification('Produit ajouté au panier !', 'success');
            btn.textContent = 'Ajouté ✓';

            // Redirect to checkout after short delay
            setTimeout(() => {
                window.location.href = data.data.checkout_url;
            }, 1000);
        } else {
            showNotification(data.data?.message || 'Erreur lors de l\'ajout', 'error');
            btn.disabled = false;
            btn.textContent = originalText;
        }
    } catch (error) {
        console.error('Cart error:', error);
        showNotification('Erreur de connexion', 'error');
        btn.disabled = false;
        btn.textContent = originalText;
    }
}

/**
 * Find variation ID from the variations object
 * Tries multiple key formats to match WooCommerce attribute slugs
 */
function findVariationId(style, option) {
    if (!klipss_cart.variations) return 0;

    const variations = klipss_cart.variations;

    // Try different key combinations
    // WooCommerce stores attributes as slugs, so we try various formats
    const possibleKeys = [
        `${style}_${option}`,
        `style-${style}_${option}`,
        `${style}_option-${option}`,
    ];

    for (const key of possibleKeys) {
        if (variations[key]) {
            return variations[key];
        }
    }

    // Try to find a partial match
    for (const [key, variationId] of Object.entries(variations)) {
        if (key.includes(style) && key.includes(option)) {
            return variationId;
        }
    }

    return 0;
}

/**
 * Show notification message
 */
function showNotification(message, type = 'info') {
    // Remove existing notification
    const existingNotif = document.querySelector('.klipss-notification');
    if (existingNotif) {
        existingNotif.remove();
    }

    // Create notification element
    const notif = document.createElement('div');
    notif.className = `klipss-notification klipss-notification--${type}`;
    notif.innerHTML = `
        <span class="klipss-notification__message">${message}</span>
        <button class="klipss-notification__close" aria-label="Fermer">&times;</button>
    `;

    document.body.appendChild(notif);

    // Add close functionality
    notif.querySelector('.klipss-notification__close').addEventListener('click', () => {
        notif.remove();
    });

    // Auto-remove after 5 seconds
    setTimeout(() => {
        if (notif.parentNode) {
            notif.remove();
        }
    }, 5000);

    // Trigger animation
    requestAnimationFrame(() => {
        notif.classList.add('is-visible');
    });
}
