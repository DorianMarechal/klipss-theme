# Mise en conformité RGPD / CNIL — klipss.fr

Récapitulatif de l'implémentation technique réalisée dans le thème `klipss`.
Versions : consentement `1.0` (`KLIPSS_CONSENT_VERSION`), CGV `2026-05` (`KLIPSS_CGV_VERSION`).

## Vue d'ensemble par priorité

| # | Sujet | Statut | Où |
|---|---|---|---|
| 1 | Bannière cookies CNIL | ✅ | `inc/klipss-consent.php`, `assets/js/modules/cookie-consent.js`, `footer.php`, `assets/css/main.css` |
| 2 | Page Politique de confidentialité | ✅ | `page-politique-confidentialite.php` |
| 3 | Page Politique cookies | ✅ | `page-politique-cookies.php` |
| 4 | Consentement newsletter | ✅ | `footer.php`, `functions.php` |
| 5 | Acceptation CGV au checkout | ✅ | `front-page.php`, `assets/js/modules/stripe-checkout.js`, `functions.php`, `inc/klipss-customer.php` |
| 6 | GA4 gated consent | ✅ | `cookie-consent.js` (`loadGA`), `inc/klipss-consent.php` |
| 7 | Droits RGPD espace compte | ✅ | `page-mon-compte.php`, `inc/klipss-customer.php`, `account.js` |
| 8 | Sous-traitants & transferts | ✅ | `page-politique-confidentialite.php` (§6, §7) |
| 9 | Durées de conservation | ✅ | `page-politique-confidentialite.php` (§5) |
| 10 | Opt-in décoché par défaut | ✅ (déjà conforme) | voir note ci-dessous |
| 11 | Mention CNIL | ✅ | confidentialité (§10) + `page-mentions-legales.php` (§5) |
| 12 | Responsable / DPO | ✅ | confidentialité (§2, §3) |

## Détails

### P1 — Bannière cookies
- Rendu serveur dans `footer.php` via `klipss_render_cookie_banner()` (pas de flash : visible uniquement si le cookie `klipss_cookie_consent` est absent, détecté côté PHP).
- 3 boutons de **même taille / même style** (`.cookie-btn`) : Tout refuser · Personnaliser · Tout accepter. Le refus n'a aucune friction supplémentaire ni couleur grisée.
- Modale granulaire (4 catégories) avec interrupteurs accessibles (clavier + ARIA).
- **Blocage avant consentement** : aucun script tiers n'est émis côté serveur ; GA4/Meta/TikTok/Pinterest ne sont injectés par `cookie-consent.js` qu'après acceptation de la catégorie correspondante.
- Cookie `klipss_cookie_consent` : durée **13 mois** (`Max-Age`), `SameSite=Lax`, `Secure` en HTTPS.
- Lien **« Gérer mes cookies »** dans le footer (`.js-cookie-settings`) + dans la politique cookies → ré-ouvre la modale.
- **Journalisation** : table `wp_klipss_consent_log`, AJAX `klipss_log_consent` (hash SHA-256 de IP+UA, pas de donnée identifiante en clair).
- Performance : module ES chargé via le bundle `defer` existant, CSS dans `main.css`/`main.min.css`.

### P2 / P3 — Pages légales dédiées
- `page-politique-confidentialite.php` → slug `/politique-de-confidentialite/`, reprend intégralement le doc `04`.
- `page-politique-cookies.php` → slug `/politique-cookies/`, reprend le doc `05`.
- Pages WP auto-créées dans `klipss_setup()` (db version `1.3`).
- `header.php` : `noindex, follow` + `<title>` dédié + `canonical` pour ces deux pages.
- Schema.org `PrivacyPolicy` injecté dans la page de confidentialité.
- Liens ajoutés dans le footer (colonne Légal).

### P4 — Newsletter
- Case à cocher **non pré-cochée** + lien vers la politique de confidentialité (`footer.php`).
- Soumission JS bloquée si la case n'est pas cochée.
- Serveur (`klipss_newsletter_subscribe`) : refuse l'inscription sans `consent`, journalise la preuve (`type=newsletter`).
- Double opt-in MailPoet : `send_confirmation_email => true` (déjà actif). Message post-inscription : « Un email de confirmation a été envoyé… ».

### P5 — CGV au checkout
- Case « J'accepte les CGV + Politique de confidentialité » avant le bouton de paiement (`front-page.php`, étape 2).
- Bouton de paiement désactivé tant que la case n'est pas cochée (`stripe-checkout.js`, gating `payReady && cgvChecked`).
- Validation **côté serveur** : `klipss_create_payment_intent` refuse si `cgv_accepted !== 'true'`.
- Preuve stockée sur la commande : colonnes `cgv_accepted_version` + `cgv_accepted_at` dans `wp_klipss_orders` + log `type=cgv`.

### P6 — Mesure d'audience / Tag management
Deux modes, mutuellement exclusifs :

**Mode GTM (actif — `KLIPSS_GTM_ID = GTM-NG5TL8W7`)**
- Google Tag Manager pilote l'ensemble des tags (GA4, Meta, TikTok, Pinterest…) que l'on configure dans l'interface GTM.
- **Google Consent Mode v2** : valeurs par défaut `denied` posées avant le conteneur, puis `gtag('consent','update',…)` selon les catégories de la bannière :
  - `analytics_storage` ← catégorie « mesure d'audience »
  - `ad_storage` / `ad_user_data` / `ad_personalization` ← catégorie « publicité »
  - `functionality_storage` / `personalization_storage` ← catégorie « fonctionnels »
- **Conteneur GTM chargé uniquement après au moins un consentement non nécessaire** (`loadGTM`). Refus total → GTM jamais chargé (vérifié : 0 appel `googletagmanager.com` avant consentement).
- ⚠️ Le `<noscript>` GTM **n'a volontairement pas été ajouté** : il chargerait GTM sans JS, donc sans pouvoir respecter le consentement. Notre dispositif de consentement nécessite JS ; sans JS, aucun traçage ne doit avoir lieu. À ajouter seulement si un arbitrage différent est décidé.

**Mode direct (fallback si `KLIPSS_GTM_ID` vide)**
- GA4 chargé après consentement « mesure d'audience » (`loadGA`) : `anonymize_ip: true`, `allow_google_signals: false`, `allow_ad_personalization_signals: false`. ID via `KLIPSS_GA4_ID`.
- Pixels Meta/TikTok/Pinterest chargés après consentement « publicité » (IDs dédiés).

> Conservation 13 mois : à régler dans l'interface GA4 (paramètre côté Google, non codable).
> Dans GTM, configurer chaque tag avec « consentement requis » correspondant pour bénéficier du Consent Mode.

### P7 — Espace compte
- **Export des données (Art. 15 & 20)** : bouton « Télécharger mes données (JSON) » → AJAX `klipss_export_data` → fichier `klipss-mes-donnees-AAAAMMJJ.json` (profil, commandes, préférences, consentements).
- **Limitation (Art. 18)** : mention + contact DPO.
- **Opposition** : libellé explicite sur la prospection commerciale au-dessus des cases.
- Lien direct vers la politique de confidentialité.

### P10 — Opt-in
Déjà conforme : `klipss_pref_email` / `klipss_pref_sms` valent `'0'` par défaut → cases décochées. L'inscription (`klipss_register`) ne force aucune préférence. Le checkout custom (Stripe direct) ne comporte aucune case marketing pré-cochée ; WooCommerce checkout n'est pas utilisé.

## Schéma de la table de journalisation

```sql
CREATE TABLE wp_klipss_consent_log (
    id                BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id           BIGINT UNSIGNED NULL,
    consent_type      VARCHAR(30)  NOT NULL DEFAULT 'cookies', -- cookies | newsletter | cgv
    consent_hash      VARCHAR(64)  NOT NULL DEFAULT '',         -- SHA-256(IP|UA)
    consent_choices   TEXT,                                     -- JSON
    consent_version   VARCHAR(20)  NOT NULL DEFAULT '',
    consent_timestamp DATETIME     NOT NULL
);
```

> Note : `consent_choices` est en `TEXT` (JSON encodé) plutôt qu'en type `JSON` natif pour
> rester compatible avec `dbDelta`/MySQL des installs O2Switch. Une colonne `consent_type`
> a été ajoutée pour distinguer cookies / newsletter / CGV.

## Constantes à définir dans `wp-config.php` (production)

```php
define('KLIPSS_GTM_ID', 'GTM-NG5TL8W7');         // GTM actif (défaut du thème)
// Si KLIPSS_GTM_ID est défini, les chargeurs directs ci-dessous sont ignorés :
define('KLIPSS_GA4_ID', 'G-XXXXXXXXXX');         // utilisé seulement si GTM vide
define('KLIPSS_META_PIXEL_ID', '');              // utilisé seulement si GTM vide
define('KLIPSS_TIKTOK_ID', '');                  // utilisé seulement si GTM vide
define('KLIPSS_PINTEREST_ID', '');               // utilisé seulement si GTM vide
// KLIPSS_CONSENT_VERSION / KLIPSS_CGV_VERSION surchargables si besoin
```

## TODO résiduels / hors périmètre technique

- **mentions-legales** : les données éditeur fictives existantes (nom du dirigeant, adresse, SIRET, hébergeur) n'ont **pas** été modifiées (règle projet). Seuls le lien vers la politique de confidentialité et la mention CNIL ont été ajoutés. → Harmoniser un jour avec l'identité réelle (KLIPSS SAS / Perpignan / O2Switch) si la règle évolue.
- Renseigner l'ID GA4 et régler la conservation 13 mois dans GA4.
- Configurer/vérifier le double opt-in MailPoet en production (Réglages MailPoet).
- Procédures administratives (hors code) : adhésion médiateur CM2C, éco-organisme DEEE, déclaration DPO à la CNIL, assurance RC pro.

## Tests d'acceptation (à rejouer en navigation réelle)

- [ ] Premier accès : bannière visible, aucun cookie tiers déposé.
- [ ] Refus : aucun GA/Meta/TikTok/Pinterest, navigation OK.
- [ ] Acceptation totale : scripts chargés (si IDs définis).
- [ ] Personnalisation : respect granulaire.
- [ ] « Gérer mes cookies » (footer) ré-ouvre la modale.
- [ ] Choix conservé 13 mois + log en BDD.
- [ ] Newsletter : case non cochée → blocage ; cochée → email de confirmation + log.
- [ ] Checkout : bouton payer inactif tant que CGV non cochées ; PaymentIntent refusé côté serveur sans CGV.
- [ ] Compte : export JSON téléchargé ; mentions limitation/opposition/confidentialité visibles.
