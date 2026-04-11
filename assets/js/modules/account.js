/**
 * Account Module — /mon-compte
 * Gestion connexion, inscription, commandes, profil, RGPD
 */

const AJAX = () => (typeof klipss_stripe !== 'undefined' ? klipss_stripe.ajax_url : '');
const NONCE_AUTH = () => (typeof klipss_stripe !== 'undefined' ? klipss_stripe.nonce_auth : '');
const NONCE_ACCOUNT = () => (typeof klipss_stripe !== 'undefined' ? klipss_stripe.nonce_account : '');

export function init() {
    if (!document.querySelector('.account-page')) return;

    initAuthTabs();
    initLogin();
    initRegister();
    initNavPanels();
    initLogout();
    initDashboard();
    initOrders();
    initProfile();
    initPreferences();
    initDeleteAccount();
}

/* ─── Onglets Connexion / Inscription ──────────────────────── */

function initAuthTabs() {
    const tabs = document.querySelectorAll('.account-auth__tab');
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('is-active'));
            tab.classList.add('is-active');
            document.querySelectorAll('.account-auth__panel').forEach(p => p.classList.remove('is-active'));
            const target = document.getElementById('tab' + capitalize(tab.dataset.tab));
            target?.classList.add('is-active');
        });
    });
}

/* ─── Connexion ─────────────────────────────────────────────── */

function initLogin() {
    const btn = document.getElementById('loginBtn');
    if (!btn) return;
    btn.addEventListener('click', async () => {
        const email    = document.getElementById('loginEmail')?.value.trim()    || '';
        const password = document.getElementById('loginPassword')?.value || '';
        const errorEl  = document.getElementById('loginError');
        clearMsg(errorEl);

        if (!email || !password) { showMsg('Veuillez remplir tous les champs.', errorEl, 'error'); return; }

        btn.disabled = true; btn.textContent = 'Connexion…';

        const data = await post({ action: 'klipss_login', email, password });
        if (data.success) {
            window.location.reload();
        } else {
            showMsg(data.data?.message || 'Identifiants incorrects.', errorEl, 'error');
            btn.disabled = false; btn.textContent = 'Se connecter';
        }
    });
}

/* ─── Inscription ───────────────────────────────────────────── */

function initRegister() {
    const btn = document.getElementById('registerBtn');
    if (!btn) return;
    btn.addEventListener('click', async () => {
        const firstName = document.getElementById('regFirstName')?.value.trim() || '';
        const lastName  = document.getElementById('regLastName')?.value.trim()  || '';
        const email     = document.getElementById('regEmail')?.value.trim()     || '';
        const password  = document.getElementById('regPassword')?.value         || '';
        const errorEl   = document.getElementById('registerError');
        clearMsg(errorEl);

        if (!firstName || !lastName || !email || !password) {
            showMsg('Veuillez remplir tous les champs.', errorEl, 'error'); return;
        }
        if (password.length < 8) {
            showMsg('Le mot de passe doit contenir au moins 8 caractères.', errorEl, 'error'); return;
        }

        btn.disabled = true; btn.textContent = 'Création…';

        const data = await post({ action: 'klipss_register', first_name: firstName, last_name: lastName, email, password });
        if (data.success) {
            window.location.reload();
        } else {
            showMsg(data.data?.message || 'Erreur lors de la création.', errorEl, 'error');
            btn.disabled = false; btn.textContent = 'Créer mon compte';
        }
    });
}

/* ─── Navigation entre panneaux ────────────────────────────── */

function navigateToPanel(panelKey) {
    const navItems = document.querySelectorAll('.account-nav__item[data-panel]');
    navItems.forEach(n => n.classList.remove('is-active'));
    const active = document.querySelector('.account-nav__item[data-panel="' + panelKey + '"]');
    active?.classList.add('is-active');
    document.querySelectorAll('.account-panel').forEach(p => p.classList.remove('is-active'));
    const panelId = 'panel' + capitalize(panelKey);
    document.getElementById(panelId)?.classList.add('is-active');
}

function initNavPanels() {
    const navItems = document.querySelectorAll('.account-nav__item[data-panel]');
    navItems.forEach(item => {
        item.addEventListener('click', () => navigateToPanel(item.dataset.panel));
    });
}

/* ─── Dashboard ─────────────────────────────────────────────── */

function initDashboard() {
    // Quick-action buttons in dashboard panel trigger panel navigation
    const quickActions = document.querySelectorAll('.account-quick-action[data-panel]');
    quickActions.forEach(btn => {
        btn.addEventListener('click', () => navigateToPanel(btn.dataset.panel));
    });

    const container = document.getElementById('dashboardLastOrder');
    if (!container) return;

    post({ action: 'klipss_get_my_orders' }).then(data => {
        container.replaceChildren();

        if (!data.success || !data.data?.orders?.length) {
            // Empty state premium
            const wrap = document.createElement('div');
            wrap.className = 'account-empty-state';

            const svgNS = 'http://www.w3.org/2000/svg';
            const svg = document.createElementNS(svgNS, 'svg');
            svg.setAttribute('width', '64'); svg.setAttribute('height', '64');
            svg.setAttribute('viewBox', '0 0 24 24'); svg.setAttribute('fill', 'none');
            svg.setAttribute('stroke', '#810D22'); svg.setAttribute('stroke-width', '1.5');
            svg.setAttribute('stroke-linecap', 'round'); svg.setAttribute('stroke-linejoin', 'round');
            const p1 = document.createElementNS(svgNS, 'path');
            p1.setAttribute('d', 'M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z');
            const l1 = document.createElementNS(svgNS, 'line');
            l1.setAttribute('x1', '3'); l1.setAttribute('y1', '6'); l1.setAttribute('x2', '21'); l1.setAttribute('y2', '6');
            const p2 = document.createElementNS(svgNS, 'path');
            p2.setAttribute('d', 'M16 10a4 4 0 0 1-8 0');
            svg.append(p1, l1, p2);

            const h3 = document.createElement('h3');
            h3.textContent = 'Soyez parmi les premières à recevoir votre Klipss';

            const p = document.createElement('p');
            p.textContent = 'Votre commande apparaîtra ici dès confirmation.';

            const cta = document.createElement('a');
            cta.className = 'account-empty-state__cta';
            cta.href = '/#configurator';
            cta.textContent = 'Pré-commander';

            wrap.append(svg, h3, p, cta);
            container.appendChild(wrap);
            return;
        }

        const order = data.data.orders[0];
        const statusLabels = {
            received:   'Reçue',
            processing: 'En préparation',
            shipped:    'Expédiée',
            delivered:  'Livrée',
            cancelled:  'Annulée',
            pending:    'En attente',
            paid:       'Payée',
        };
        const statusLabel = statusLabels[order.status] || order.status;
        const amountEur = (parseFloat(order.amount) / 100).toLocaleString('fr-FR', { style: 'currency', currency: 'EUR' });

        const card = document.createElement('div');
        card.className = 'account-dashboard-order';

        const label = document.createElement('div');
        label.className = 'account-dashboard-order__label';
        label.textContent = 'Dernière commande';

        const row = document.createElement('div');
        row.className = 'account-dashboard-order__row';

        const ref = document.createElement('span');
        ref.className = 'account-dashboard-order__ref';
        ref.textContent = order.order_ref;

        const product = document.createElement('div');
        product.className = 'account-dashboard-order__product';
        product.textContent = [order.style, order.option_name].filter(Boolean).join(' — ');

        const dateEl = document.createElement('div');
        dateEl.className = 'account-dashboard-order__date';
        dateEl.textContent = formatDate(order.created_at);

        const badge = document.createElement('span');
        badge.className = 'account-order-card__badge account-order-card__badge--' + (order.status || 'received');
        badge.textContent = statusLabel;

        row.append(ref, product, dateEl, badge);
        card.append(label, row);
        container.appendChild(card);
    });
}

/* ─── Déconnexion ───────────────────────────────────────────── */

function initLogout() {
    document.getElementById('logoutBtn')?.addEventListener('click', async () => {
        await post({ action: 'klipss_logout' });
        window.location.reload();
    });
}

/* ─── Mes commandes ─────────────────────────────────────────── */

function buildOrderCard(order) {
    const statusLabels = {
        received:   'Reçue',
        processing: 'En préparation',
        shipped:    'Expédiée',
        delivered:  'Livrée',
        cancelled:  'Annulée',
        pending:    'En attente',
        paid:       'Payée',
    };
    const statusLabel = statusLabels[order.status] || order.status;
    const amountEur = (parseFloat(order.amount) / 100).toLocaleString('fr-FR', { style: 'currency', currency: 'EUR' });
    const statusKey = order.status || 'received';

    const card = document.createElement('div');
    card.className = 'account-order-card';

    // ── Top ──
    const top = document.createElement('div');
    top.className = 'account-order-card__top';

    const refBlock = document.createElement('div');
    refBlock.className = 'account-order-card__ref-block';

    const ref = document.createElement('span');
    ref.className = 'account-order-card__ref';
    ref.textContent = order.order_ref;

    const dateEl = document.createElement('div');
    dateEl.className = 'account-order-card__date';
    dateEl.textContent = formatDate(order.created_at);

    refBlock.append(ref, dateEl);

    const badge = document.createElement('span');
    badge.className = 'account-order-card__badge account-order-card__badge--' + statusKey;
    badge.textContent = statusLabel;

    top.append(refBlock, badge);

    // ── Middle ──
    const middle = document.createElement('div');
    middle.className = 'account-order-card__middle';

    const product = document.createElement('div');
    product.className = 'account-order-card__product';
    product.textContent = [order.style, order.option_name].filter(Boolean).join(' — ');

    const amount = document.createElement('div');
    amount.className = 'account-order-card__amount';
    amount.textContent = amountEur;

    middle.append(product, amount);

    card.append(top, middle);

    // ── Progress timeline (not for cancelled) ──
    if (statusKey !== 'cancelled') {
        const steps = ['received', 'processing', 'shipped', 'delivered'];
        const stepLabels = ['Confirmée', 'En préparation', 'Expédiée', 'Livrée'];
        const activeIndex = steps.indexOf(statusKey);

        const progress = document.createElement('div');
        progress.className = 'account-order-card__progress';

        stepLabels.forEach((label, i) => {
            const step = document.createElement('span');
            let cls = 'account-order-card__step';
            if (i < activeIndex) cls += ' is-done';
            else if (i === activeIndex) cls += ' is-active';
            step.className = cls;
            step.textContent = label;
            progress.appendChild(step);
        });

        card.appendChild(progress);
    }

    // ── Tracking ──
    if (order.tracking_number) {
        const track = document.createElement('div');
        track.className = 'account-order-card__tracking';
        const trackText = document.createTextNode('\uD83D\uDCE6 ' + order.tracking_number + (order.carrier ? ' \u00B7 ' + order.carrier : ''));
        track.appendChild(trackText);
        card.appendChild(track);
    }

    return card;
}

function initOrders() {
    const container = document.getElementById('ordersList');
    if (!container) return;

    post({ action: 'klipss_get_my_orders' }).then(data => {
        container.replaceChildren();

        if (!data.success || !data.data?.orders?.length) {
            // Empty state premium
            const wrap = document.createElement('div');
            wrap.className = 'account-empty-state';

            const svgNS = 'http://www.w3.org/2000/svg';
            const svg = document.createElementNS(svgNS, 'svg');
            svg.setAttribute('width', '64'); svg.setAttribute('height', '64');
            svg.setAttribute('viewBox', '0 0 24 24'); svg.setAttribute('fill', 'none');
            svg.setAttribute('stroke', '#810D22'); svg.setAttribute('stroke-width', '1.5');
            svg.setAttribute('stroke-linecap', 'round'); svg.setAttribute('stroke-linejoin', 'round');
            const p1 = document.createElementNS(svgNS, 'path');
            p1.setAttribute('d', 'M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z');
            const l1 = document.createElementNS(svgNS, 'line');
            l1.setAttribute('x1', '3'); l1.setAttribute('y1', '6'); l1.setAttribute('x2', '21'); l1.setAttribute('y2', '6');
            const p2 = document.createElementNS(svgNS, 'path');
            p2.setAttribute('d', 'M16 10a4 4 0 0 1-8 0');
            svg.append(p1, l1, p2);

            const h3 = document.createElement('h3');
            h3.textContent = 'Aucune commande pour l\'instant';

            const p = document.createElement('p');
            p.textContent = 'Votre première commande Klipss apparaîtra ici.';

            const cta = document.createElement('a');
            cta.className = 'account-empty-state__cta';
            cta.href = '/#configurator';
            cta.textContent = 'Pré-commander mon Klipss';

            wrap.append(svg, h3, p, cta);
            container.appendChild(wrap);
            return;
        }

        data.data.orders.forEach(order => {
            container.appendChild(buildOrderCard(order));
        });
    });
}

/* ─── Profil ────────────────────────────────────────────────── */

function initProfile() {
    const btn = document.getElementById('saveProfileBtn');
    if (!btn) return;

    btn.addEventListener('click', async () => {
        const msgEl = document.getElementById('profileMsg');
        clearMsg(msgEl);

        const params = {
            action:        'klipss_update_profile',
            first_name:    document.getElementById('profFirstName')?.value.trim() || '',
            last_name:     document.getElementById('profLastName')?.value.trim()  || '',
            email:         document.getElementById('profEmail')?.value.trim()     || '',
            phone:         document.getElementById('profPhone')?.value.trim()     || '',
            address:       document.getElementById('profAddress')?.value.trim()   || '',
            zip:           document.getElementById('profZip')?.value.trim()       || '',
            city:          document.getElementById('profCity')?.value.trim()      || '',
            new_password:  document.getElementById('profPasswordNew')?.value      || '',
        };

        if (!params.email) { showMsg('L\'email est requis.', msgEl, 'error'); return; }

        btn.disabled = true; btn.textContent = 'Enregistrement…';

        const data = await post(params);
        if (data.success) {
            showMsg('Modifications enregistrées.', msgEl, 'success');
        } else {
            showMsg(data.data?.message || 'Erreur.', msgEl, 'error');
        }
        btn.disabled = false; btn.textContent = 'Enregistrer les modifications';
    });
}

/* ─── Préférences de contact ────────────────────────────────── */

function initPreferences() {
    const btn = document.getElementById('savePrefsBtn');
    if (!btn) return;

    btn.addEventListener('click', async () => {
        const msgEl = document.getElementById('prefsMsg');
        clearMsg(msgEl);
        btn.disabled = true; btn.textContent = 'Enregistrement…';

        const data = await post({
            action:     'klipss_update_preferences',
            pref_email: document.getElementById('prefEmail')?.checked ? '1' : '0',
            pref_sms:   document.getElementById('prefSms')?.checked   ? '1' : '0',
        });

        if (data.success) {
            showMsg('Préférences enregistrées.', msgEl, 'success');
        } else {
            showMsg('Erreur.', msgEl, 'error');
        }
        btn.disabled = false; btn.textContent = 'Enregistrer mes préférences';
    });
}

/* ─── Suppression compte (RGPD) ─────────────────────────────── */

function initDeleteAccount() {
    const deleteBtn  = document.getElementById('deleteAccountBtn');
    const confirmBox = document.getElementById('deleteConfirmBox');
    const cancelBtn  = document.getElementById('deleteCancelBtn');
    const confirmBtn = document.getElementById('deleteConfirmBtn');

    deleteBtn?.addEventListener('click', () => {
        confirmBox.style.display = '';
        deleteBtn.style.display  = 'none';
    });

    cancelBtn?.addEventListener('click', () => {
        confirmBox.style.display = 'none';
        deleteBtn.style.display  = '';
        if (document.getElementById('deleteConfirmInput')) {
            document.getElementById('deleteConfirmInput').value = '';
        }
        clearMsg(document.getElementById('deleteError'));
    });

    confirmBtn?.addEventListener('click', async () => {
        const input   = document.getElementById('deleteConfirmInput')?.value.trim() || '';
        const errorEl = document.getElementById('deleteError');
        clearMsg(errorEl);

        if (input !== 'SUPPRIMER') {
            showMsg('Tapez exactement SUPPRIMER pour confirmer.', errorEl, 'error');
            return;
        }

        confirmBtn.disabled = true; confirmBtn.textContent = 'Suppression…';

        const data = await post({ action: 'klipss_delete_account' });
        if (data.success) {
            window.location.href = '/';
        } else {
            showMsg(data.data?.message || 'Erreur.', errorEl, 'error');
            confirmBtn.disabled = false; confirmBtn.textContent = 'Confirmer la suppression';
        }
    });
}

/* ─── Utilitaires ───────────────────────────────────────────── */

async function post(params) {
    const authActions = ['klipss_login', 'klipss_register', 'klipss_logout'];
    params.nonce = authActions.includes(params.action) ? NONCE_AUTH() : NONCE_ACCOUNT();
    try {
        const res = await fetch(AJAX(), {
            method:  'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body:    new URLSearchParams(params),
        });
        return await res.json();
    } catch {
        return { success: false, data: { message: 'Erreur réseau.' } };
    }
}

function showMsg(msg, el, type) {
    if (!el) return;
    el.textContent = msg;
    el.className   = 'account-form__msg account-form__msg--' + type;
    el.style.display = 'block';
}

function clearMsg(el) {
    if (el) { el.textContent = ''; el.style.display = 'none'; }
}

function capitalize(str) {
    return str ? str.charAt(0).toUpperCase() + str.slice(1) : '';
}

function formatDate(dateStr) {
    if (!dateStr) return '';
    return new Date(dateStr).toLocaleDateString('fr-FR', { day: 'numeric', month: 'long', year: 'numeric' });
}
