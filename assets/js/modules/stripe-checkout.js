/**
 * Stripe Checkout Module — 2-step modal
 * Étape 1 : infos livraison  |  Étape 2 : paiement Stripe
 */

const STRIPE_JS_URL = 'https://js.stripe.com/v3/';

let stripeInstance   = null;
let elementsInstance = null;
let clientSecret     = null;
let currentAmount    = 0;
let currentOption    = '';
let currentStyle     = '';
let currentEcosystem = '';

// Données de livraison collectées à l'étape 1
let shippingData = {};

/* ─── Init ──────────────────────────────────────────────────── */

export function init() {
    if (typeof klipss_stripe === 'undefined' || !klipss_stripe.pk) return;

    // Retour après 3D Secure (redirect flow)
    if (new URLSearchParams(window.location.search).get('payment') === 'success') {
        showSuccessScreen();
        return;
    }

    // Stripe.js chargé à la demande (au premier clic Pré-commander) pour éviter ~200 Ko inutiles

    // Fermeture modale
    document.getElementById('paymentModalClose')?.addEventListener('click', closeModal);
    document.getElementById('paymentModalOverlay')?.addEventListener('click', closeModal);
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });

    // Navigation entre étapes
    document.getElementById('step1NextBtn')?.addEventListener('click', onStep1Next);
    document.getElementById('paymentStep2Back')?.addEventListener('click', goToStep1);

    // Afficher/masquer le champ mot de passe selon la case à cocher
    document.getElementById('shipCreateAccount')?.addEventListener('change', function () {
        const pwField = document.getElementById('shipPasswordField');
        if (pwField) pwField.style.display = this.checked ? '' : 'none';
    });

    // Pré-remplissage si connecté
    if (klipss_stripe.is_logged_in && klipss_stripe.customer) {
        prefillShippingFields(klipss_stripe.customer);
    }
}

/* ─── Nonce frais ───────────────────────────────────────────── */

// Le nonce localisé est figé par le cache full-page (LiteSpeed) et finit par
// expirer → "Erreur de sécurité". On récupère des nonces frais via AJAX
// (jamais mis en cache) juste avant d'ouvrir la modale.
async function refreshNonces() {
    try {
        const res = await fetch(klipss_stripe.ajax_url, {
            method:  'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body:    new URLSearchParams({ action: 'klipss_refresh_nonce' }),
        });
        const data = await res.json();
        if (data.success) {
            if (data.data.nonce_payment) klipss_stripe.nonce_payment = data.data.nonce_payment;
            if (data.data.nonce_auth)    klipss_stripe.nonce_auth    = data.data.nonce_auth;
        }
    } catch {}
}

/* ─── Ouvrir la modale ──────────────────────────────────────── */

export async function mountPaymentForm(option, style, summaryText, ecosystem = '') {
    // Rafraîchir les nonces avant tout appel AJAX (register, payment intent, commande)
    await refreshNonces();

    // Charger Stripe.js à la demande si pas encore initialisé
    if (!stripeInstance) {
        await loadScript(STRIPE_JS_URL);
        stripeInstance = window.Stripe(klipss_stripe.pk);
    }

    currentOption    = option;
    currentStyle     = style;
    currentEcosystem = ecosystem;

    // Résumé commande dans l'en-tête
    const summaryEl = document.getElementById('paymentModalSummary');
    if (summaryEl) summaryEl.textContent = summaryText || '';

    // Toujours repartir de l'étape 1
    goToStep1(false);
    openModal();
}

/* ─── Étape 1 — Valider les infos de livraison ──────────────── */

async function onStep1Next() {
    const errorEl = document.getElementById('step1Error');
    clearError(errorEl);

    // Collecte des champs
    const firstName = document.getElementById('shipFirstName')?.value.trim() || '';
    const lastName  = document.getElementById('shipLastName')?.value.trim()  || '';
    const email     = document.getElementById('shipEmail')?.value.trim()     || '';
    const phone     = document.getElementById('shipPhone')?.value.trim()     || '';
    const address   = document.getElementById('shipAddress')?.value.trim()   || '';
    const zip       = document.getElementById('shipZip')?.value.trim()       || '';
    const city      = document.getElementById('shipCity')?.value.trim()      || '';
    const country   = document.getElementById('shipCountry')?.value         || 'France';
    const createAccount = document.getElementById('shipCreateAccount')?.checked || false;
    const password  = createAccount ? (document.getElementById('shipPassword')?.value || '') : '';

    // Validations
    if (!firstName || !lastName) {
        showError('Veuillez entrer votre prénom et nom.', errorEl); return;
    }
    if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        showError('Veuillez entrer une adresse email valide.', errorEl); return;
    }
    if (!address) {
        showError('Veuillez entrer votre adresse.', errorEl); return;
    }
    if (!zip) {
        showError('Veuillez entrer votre code postal.', errorEl); return;
    }
    if (!city) {
        showError('Veuillez entrer votre ville.', errorEl); return;
    }
    if (createAccount && password.length < 8) {
        showError('Le mot de passe doit contenir au moins 8 caractères.', errorEl); return;
    }

    shippingData = { firstName, lastName, email, phone, address, zip, city, country, createAccount };

    // [C-3] Créer le compte AVANT le paiement (mot de passe jamais dans processOrder)
    if (createAccount && password) {
        const btn = document.getElementById('step1NextBtn');
        if (btn) { btn.disabled = true; btn.textContent = 'Création du compte…'; }
        try {
            const res = await fetch(klipss_stripe.ajax_url, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({
                    action: 'klipss_register',
                    nonce: klipss_stripe.nonce_auth,
                    email, password, first_name: firstName, last_name: lastName,
                }),
            });
            const data = await res.json();
            if (!data.success) {
                showError(data.data?.message || 'Erreur lors de la création du compte.', errorEl);
                if (btn) { btn.disabled = false; btn.textContent = 'Continuer'; }
                return;
            }
        } catch {
            showError('Erreur de connexion. Veuillez réessayer.', errorEl);
            if (btn) { btn.disabled = false; btn.textContent = 'Continuer'; }
            return;
        }
        if (btn) { btn.disabled = false; btn.textContent = 'Continuer'; }
    }

    goToStep2();
}

/* ─── Étape 2 — Charger Stripe et afficher le paiement ─────── */

async function goToStep2() {
    // Mettre à jour l'indicateur d'étapes
    document.getElementById('modalStepIndicator1')?.classList.remove('is-active');
    document.getElementById('modalStepIndicator1')?.classList.add('is-done');
    document.getElementById('modalStepIndicator2')?.classList.add('is-active');

    document.getElementById('paymentStep1').style.display = 'none';
    document.getElementById('paymentStep2').style.display = '';

    // Récapitulatif adresse
    const recap = document.getElementById('shippingRecap');
    if (recap) {
        recap.textContent = `${shippingData.firstName} ${shippingData.lastName} · ${shippingData.address}, ${shippingData.zip} ${shippingData.city}`;
    }

    const payBtn  = document.getElementById('stripePayBtn');
    const errorEl = document.getElementById('stripeError');
    clearError(errorEl);

    // Si Payment Element déjà monté, juste rebrancher le bouton
    if (elementsInstance) {
        const amountEur = formatEur(currentAmount);
        payBtn.textContent = 'Payer ' + amountEur;
        payBtn.disabled    = false;
        payBtn.onclick     = onPayClick;
        return;
    }

    // Première ouverture : créer le PaymentIntent
    payBtn.textContent = 'Chargement…';
    payBtn.disabled    = true;

    try {
        const res  = await fetch(klipss_stripe.ajax_url, {
            method:  'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
                action:    'klipss_create_payment_intent',
                nonce:     klipss_stripe.nonce_payment,
                option:    currentOption,
                style:     currentStyle,
                email:     shippingData.email,
                ecosystem: currentEcosystem,
            }),
        });
        const data = await res.json();

        if (!data.success) {
            showError(data.data?.message || 'Erreur de connexion.', errorEl);
            payBtn.textContent = 'Réessayer';
            payBtn.disabled    = false;
            payBtn.onclick     = () => { elementsInstance = null; goToStep2(); };
            return;
        }

        currentAmount = data.data.amount;
        clientSecret  = data.data.client_secret;

        // Monter le Payment Element
        elementsInstance = stripeInstance.elements({
            clientSecret,
            appearance: {
                theme: 'flat',
                variables: {
                    colorPrimary:    '#FD920D',
                    colorBackground: '#ffffff',
                    colorText:       '#1a0509',
                    colorDanger:     '#CA4D26',
                    fontFamily:      '"gotham", sans-serif',
                    borderRadius:    '8px',
                    spacingUnit:     '4px',
                },
                rules: {
                    '.Input':         { border: '1px solid rgba(0,0,0,0.15)', padding: '12px' },
                    '.Input:focus':   { borderColor: '#FD920D', boxShadow: '0 0 0 3px rgba(253,146,13,0.15)' },
                    '.Label':         { fontWeight: '500', fontSize: '13px', marginBottom: '6px', color: '#1a0509' },
                    '.Tab':           { border: '1px solid rgba(0,0,0,0.12)' },
                    '.Tab--selected': { borderColor: '#FD920D', boxShadow: '0 0 0 2px rgba(253,146,13,0.2)' },
                },
            },
        });

        const paymentEl = elementsInstance.create('payment', {
            layout: { type: 'accordion', defaultCollapsed: false, radios: true, spacedAccordionItems: false },
        });
        paymentEl.mount('#stripePaymentElement');

        const amountEur = formatEur(currentAmount);
        paymentEl.on('ready', () => {
            payBtn.textContent = 'Payer ' + amountEur;
            payBtn.disabled    = false;
            payBtn.onclick     = onPayClick;
        });

        // Fallback si ready ne se déclenche pas (ex: bloqueur pub)
        setTimeout(() => {
            if (payBtn.disabled) {
                payBtn.textContent = 'Payer ' + amountEur;
                payBtn.disabled    = false;
                payBtn.onclick     = onPayClick;
            }
        }, 4000);

    } catch {
        showError('Une erreur est survenue. Veuillez réessayer.', errorEl);
        payBtn.textContent = 'Réessayer';
        payBtn.disabled    = false;
    }
}

function goToStep1(resetElements = true) {
    document.getElementById('modalStepIndicator1')?.classList.add('is-active');
    document.getElementById('modalStepIndicator1')?.classList.remove('is-done');
    document.getElementById('modalStepIndicator2')?.classList.remove('is-active');

    document.getElementById('paymentStep1').style.display = '';
    document.getElementById('paymentStep2').style.display = 'none';

    // Si on revient depuis l'étape 2, on réinitialise le Payment Element
    // pour qu'il puisse être recréé si l'email change
    if (resetElements) {
        elementsInstance = null;
    }
}

/* ─── Clic sur Payer ────────────────────────────────────────── */

async function onPayClick() {
    const payBtn  = document.getElementById('stripePayBtn');
    const errorEl = document.getElementById('stripeError');

    clearError(errorEl);
    payBtn.disabled    = true;
    payBtn.textContent = 'Traitement en cours…';

    const { error } = await stripeInstance.confirmPayment({
        elements: elementsInstance,
        confirmParams: {
            return_url:    klipss_stripe.return_url,
            receipt_email: shippingData.email,
            shipping: {
                name:    shippingData.firstName + ' ' + shippingData.lastName,
                phone:   shippingData.phone || undefined,
                address: {
                    line1:       shippingData.address,
                    city:        shippingData.city,
                    postal_code: shippingData.zip,
                    country:     'FR',
                },
            },
        },
        redirect: 'if_required',
    });

    if (error) {
        showError(error.message, errorEl);
        payBtn.textContent = 'Payer ' + formatEur(currentAmount);
        payBtn.disabled    = false;
        return;
    }

    await processOrder();
    closeModal();
    showSuccessScreen();
}

/* ─── Enregistrement commande & emails ──────────────────────── */

async function processOrder() {
    let paymentIntentId = '';
    try {
        const result = await stripeInstance.retrievePaymentIntent(clientSecret);
        paymentIntentId = result.paymentIntent?.id || '';
    } catch {}

    const params = {
        action:            'klipss_process_order',
        nonce:             klipss_stripe.nonce_payment,
        payment_intent_id: paymentIntentId,
        email:             shippingData.email,
        first_name:        shippingData.firstName,
        last_name:         shippingData.lastName,
        phone:             shippingData.phone,
        address:           shippingData.address,
        zip:               shippingData.zip,
        city:              shippingData.city,
        country:           shippingData.country,
        style:             currentStyle,
        option:            currentOption,
        ecosystem:         currentEcosystem,
        amount:            currentAmount,
    };

    await fetch(klipss_stripe.ajax_url, {
        method:  'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body:    new URLSearchParams(params),
    });
}

/* ─── Écran de succès ───────────────────────────────────────── */

function showSuccessScreen() {
    const stepCheckout = document.querySelector('[data-step="2"]');
    if (!stepCheckout) return;

    stepCheckout.replaceChildren();
    const wrap = document.createElement('div');
    wrap.className = 'stripe-success';

    const iconWrap = document.createElement('div');
    iconWrap.className = 'stripe-success__icon';
    const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
    svg.setAttribute('width', '48'); svg.setAttribute('height', '48');
    svg.setAttribute('viewBox', '0 0 24 24'); svg.setAttribute('fill', 'none');
    svg.setAttribute('stroke', 'currentColor'); svg.setAttribute('stroke-width', '1.5');
    svg.setAttribute('stroke-linecap', 'round'); svg.setAttribute('stroke-linejoin', 'round');
    const p1 = document.createElementNS('http://www.w3.org/2000/svg', 'path');
    p1.setAttribute('d', 'M22 11.08V12a10 10 0 1 1-5.93-9.14');
    const p2 = document.createElementNS('http://www.w3.org/2000/svg', 'polyline');
    p2.setAttribute('points', '22 4 12 14.01 9 11.01');
    svg.append(p1, p2);
    iconWrap.appendChild(svg);

    const title = document.createElement('h3');
    title.className   = 'stripe-success__title';
    title.textContent = 'Pré-commande confirmée !';

    const text = document.createElement('p');
    text.className   = 'stripe-success__text';
    text.textContent = 'Merci pour votre pré-commande. Un email de confirmation a été envoyé à ';
    const strong = document.createElement('strong');
    strong.textContent = shippingData.email || 'votre adresse';
    text.append(strong, document.createTextNode('. Vous serez informé(e) dès que votre Klipss sera prêt à être expédié.'));

    // Lien vers le compte si créé ou déjà connecté
    const hasAccount = shippingData.createAccount || klipss_stripe.is_logged_in;
    if (hasAccount) {
        const accountLink = document.createElement('a');
        accountLink.href      = klipss_stripe.account_url;
        accountLink.className = 'stripe-success__account-link';
        accountLink.textContent = 'Suivre ma commande →';
        wrap.append(iconWrap, title, text, accountLink);
    } else {
        wrap.append(iconWrap, title, text);
    }

    stepCheckout.appendChild(wrap);

    // Redirection automatique vers le compte après 2.5s (si compte)
    if (hasAccount && klipss_stripe.account_url) {
        setTimeout(() => { window.location.href = klipss_stripe.account_url; }, 2500);
    }
}

/* ─── Pré-remplissage depuis le compte connecté ─────────────── */

function prefillShippingFields(customer) {
    const set = (id, val) => {
        const el = document.getElementById(id);
        if (el && val) el.value = val;
    };
    set('shipFirstName', customer.first_name);
    set('shipLastName',  customer.last_name);
    set('shipEmail',     customer.email);
    set('shipPhone',     customer.phone);
    set('shipAddress',   customer.address);
    set('shipZip',       customer.zip);
    set('shipCity',      customer.city);
}

/* ─── Modale ────────────────────────────────────────────────── */

function openModal() {
    const modal = document.getElementById('paymentModal');
    if (!modal) return;
    modal.classList.add('is-open');
    modal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    const modal = document.getElementById('paymentModal');
    if (!modal) return;
    modal.classList.remove('is-open');
    modal.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
}

/* ─── Utilitaires ───────────────────────────────────────────── */

function formatEur(cents) {
    return (cents / 100).toLocaleString('fr-FR', { style: 'currency', currency: 'EUR' });
}

function showError(msg, el) {
    if (el) { el.textContent = msg; el.style.display = 'block'; }
}

function clearError(el) {
    if (el) { el.textContent = ''; el.style.display = 'none'; }
}

function loadScript(src) {
    return new Promise((resolve, reject) => {
        if (document.querySelector(`script[src="${src}"]`)) { resolve(); return; }
        const s = document.createElement('script');
        s.src = src; s.onload = resolve; s.onerror = reject;
        document.head.appendChild(s);
    });
}
