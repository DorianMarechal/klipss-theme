<?php
/**
 * Template Name: Mon Compte
 * Page client : connexion, inscription, commandes, profil, RGPD
 */

if (!defined('ABSPATH')) exit;

get_header();
include get_template_directory() . '/inc/nav.php';
?>
<main class="account-page">
    <div class="account-page__container">

        <?php if (!is_user_logged_in()): ?>
        <!-- ── FORMULAIRES CONNEXION / INSCRIPTION ── -->
        <div class="account-auth" id="accountAuth">
            <div class="account-auth__tabs">
                <button class="account-auth__tab is-active" data-tab="login">Se connecter</button>
                <button class="account-auth__tab" data-tab="register">Créer un compte</button>
            </div>

            <!-- Connexion -->
            <div class="account-auth__panel is-active" id="tabLogin">
                <h1 class="account-auth__title">Heureux de vous revoir</h1>
                <p class="account-auth__subtitle">Connectez-vous pour suivre vos commandes.</p>

                <div class="account-auth__field">
                    <label for="loginEmail">Email</label>
                    <input type="email" id="loginEmail" placeholder="vous@exemple.fr" autocomplete="email">
                </div>
                <div class="account-auth__field">
                    <label for="loginPassword">Mot de passe</label>
                    <input type="password" id="loginPassword" placeholder="••••••••" autocomplete="current-password">
                </div>

                <p id="loginError" class="account-auth__error" style="display:none;"></p>

                <button class="account-auth__btn" id="loginBtn" type="button">Se connecter</button>
            </div>

            <!-- Inscription -->
            <div class="account-auth__panel" id="tabRegister">
                <h1 class="account-auth__title">Créer mon compte</h1>
                <p class="account-auth__subtitle">Pour suivre vos commandes et gérer vos préférences.</p>

                <div class="account-auth__row">
                    <div class="account-auth__field">
                        <label for="regFirstName">Prénom</label>
                        <input type="text" id="regFirstName" placeholder="Marie" autocomplete="given-name">
                    </div>
                    <div class="account-auth__field">
                        <label for="regLastName">Nom</label>
                        <input type="text" id="regLastName" placeholder="Dupont" autocomplete="family-name">
                    </div>
                </div>
                <div class="account-auth__field">
                    <label for="regEmail">Email</label>
                    <input type="email" id="regEmail" placeholder="vous@exemple.fr" autocomplete="email">
                </div>
                <div class="account-auth__field">
                    <label for="regPassword">Mot de passe</label>
                    <input type="password" id="regPassword" placeholder="8 caractères minimum" autocomplete="new-password">
                </div>

                <p id="registerError" class="account-auth__error" style="display:none;"></p>

                <button class="account-auth__btn" id="registerBtn" type="button">Créer mon compte</button>
            </div>
        </div>

        <?php else:
            $raw      = klipss_customer_data_for_js();
            $customer = $raw['customer'] ?? [];
        ?>
        <!-- ── DASHBOARD CLIENT CONNECTÉ ── -->
        <div class="account-dashboard">

            <!-- Sidebar navigation -->
            <nav class="account-nav">
                <button type="button" class="account-nav__toggle" id="accountNavToggle" aria-expanded="false" aria-controls="accountNavList">
                    <span class="account-nav__toggle-label">Tableau de bord</span>
                    <svg class="account-nav__toggle-chevron" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
                <ul class="account-nav__list" id="accountNavList">
                    <li><button class="account-nav__item is-active" data-panel="dashboard">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                        Tableau de bord
                    </button></li>
                    <li><button class="account-nav__item" data-panel="orders">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                        Mes commandes
                    </button></li>
                    <li><button class="account-nav__item" data-panel="profile">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        Mon profil
                    </button></li>
                    <li><button class="account-nav__item" data-panel="rgpd">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        Confidentialité
                    </button></li>
                    <li><button class="account-nav__item account-nav__item--logout" id="logoutBtn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                        Se déconnecter
                    </button></li>
                </ul>
            </nav>

            <!-- Panneaux principaux -->
            <div class="account-content">

                <!-- Tableau de bord -->
                <div class="account-panel is-active" id="panelDashboard">
                    <div class="account-welcome">
                        <div class="account-welcome__avatar"><?php echo esc_html(strtoupper(substr($customer['first_name'] ?? 'K', 0, 1))); ?></div>
                        <div>
                            <div class="account-welcome__greeting">Heureux de vous revoir, <?php echo esc_html($customer['first_name'] ?? 'vous'); ?></div>
                            <div class="account-welcome__sub">Bienvenue dans votre espace Klipss</div>
                        </div>
                    </div>
                    <div class="account-quick-actions">
                        <button class="account-quick-action" data-panel="orders">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                            Mes commandes
                        </button>
                        <button class="account-quick-action" data-panel="profile">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            Mon profil
                        </button>
                        <a class="account-quick-action" href="/#configurator">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                            Pré-commander
                        </a>
                    </div>
                    <div id="dashboardLastOrder"></div>
                </div>

                <!-- Commandes -->
                <div class="account-panel" id="panelOrders">
                    <h2 class="account-panel__title">Mes commandes</h2>
                    <div id="ordersList" class="account-orders">
                        <p class="account-orders__loading">Chargement…</p>
                    </div>
                </div>

                <!-- Profil -->
                <div class="account-panel" id="panelProfile">
                    <h2 class="account-panel__title">Mon profil</h2>

                    <div class="account-form">
                        <div class="account-form__row">
                            <div class="account-form__field">
                                <label for="profFirstName">Prénom</label>
                                <input type="text" id="profFirstName" value="<?php echo esc_attr($customer['first_name'] ?? ''); ?>" autocomplete="given-name">
                            </div>
                            <div class="account-form__field">
                                <label for="profLastName">Nom</label>
                                <input type="text" id="profLastName" value="<?php echo esc_attr($customer['last_name'] ?? ''); ?>" autocomplete="family-name">
                            </div>
                        </div>
                        <div class="account-form__field">
                            <label for="profEmail">Email</label>
                            <input type="email" id="profEmail" value="<?php echo esc_attr($customer['email'] ?? ''); ?>" autocomplete="email">
                        </div>
                        <div class="account-form__field">
                            <label for="profPhone">Téléphone</label>
                            <input type="tel" id="profPhone" value="<?php echo esc_attr($customer['phone'] ?? ''); ?>" autocomplete="tel">
                        </div>

                        <h3 class="account-form__section-title">Adresse de livraison</h3>

                        <div class="account-form__field">
                            <label for="profAddress">Adresse</label>
                            <input type="text" id="profAddress" value="<?php echo esc_attr($customer['address'] ?? ''); ?>">
                        </div>
                        <div class="account-form__row">
                            <div class="account-form__field account-form__field--zip">
                                <label for="profZip">Code postal</label>
                                <input type="text" id="profZip" value="<?php echo esc_attr($customer['zip'] ?? ''); ?>">
                            </div>
                            <div class="account-form__field">
                                <label for="profCity">Ville</label>
                                <input type="text" id="profCity" value="<?php echo esc_attr($customer['city'] ?? ''); ?>">
                            </div>
                        </div>

                        <h3 class="account-form__section-title">Changer de mot de passe</h3>
                        <div class="account-form__field">
                            <label for="profPasswordNew">Nouveau mot de passe <span class="account-form__optional">(laisser vide pour ne pas changer)</span></label>
                            <input type="password" id="profPasswordNew" placeholder="8 caractères minimum" autocomplete="new-password">
                        </div>

                        <p id="profileMsg" class="account-form__msg" style="display:none;"></p>
                        <button class="account-form__btn" id="saveProfileBtn" type="button">Enregistrer les modifications</button>
                    </div>
                </div>

                <!-- Confidentialité / RGPD -->
                <div class="account-panel" id="panelRgpd">
                    <h2 class="account-panel__title">Confidentialité & RGPD</h2>

                    <div class="account-rgpd">
                        <section class="account-rgpd__section">
                            <h3>Préférences de contact</h3>
                            <p>Choisissez comment nous pouvons vous contacter pour nos communications marketing. Vous pouvez vous opposer au traitement de vos données à des fins de prospection commerciale en décochant les cases ci-dessous.</p>
                            <div class="account-rgpd__prefs">
                                <label class="account-rgpd__pref-label">
                                    <input type="checkbox" id="prefEmail"
                                        <?php echo !empty($customer['pref_email']) ? 'checked' : ''; ?>>
                                    <span>Emails promotionnels et nouveautés</span>
                                </label>
                                <label class="account-rgpd__pref-label">
                                    <input type="checkbox" id="prefSms"
                                        <?php echo !empty($customer['pref_sms']) ? 'checked' : ''; ?>>
                                    <span>SMS et notifications mobiles</span>
                                </label>
                            </div>
                            <p id="prefsMsg" class="account-form__msg" style="display:none;"></p>
                            <button class="account-form__btn account-form__btn--secondary" id="savePrefsBtn" type="button">Enregistrer mes préférences</button>
                        </section>

                        <section class="account-rgpd__section">
                            <h3>Accéder à mes données et les exporter</h3>
                            <p>Conformément à vos droits d'accès (article 15 du RGPD) et à la portabilité (article 20), vous pouvez télécharger l'ensemble des données que nous détenons à votre sujet (profil, commandes, préférences, historique de consentement) dans un fichier structuré et lisible par machine.</p>
                            <p id="exportMsg" class="account-form__msg" style="display:none;"></p>
                            <button class="account-form__btn account-form__btn--secondary" id="exportDataBtn" type="button">Télécharger mes données (JSON)</button>
                        </section>

                        <section class="account-rgpd__section">
                            <h3>Limitation du traitement</h3>
                            <p>Conformément à l'article 18 du RGPD, vous pouvez demander la limitation du traitement de vos données dans certains cas. Pour exercer ce droit, contactez notre DPO par email à <a href="mailto:contact@klipss.fr?subject=Demande%20de%20limitation%20du%20traitement%20RGPD">contact@klipss.fr</a> (objet : « Demande de limitation du traitement RGPD »).</p>
                            <p>Pour en savoir plus sur le traitement de vos données, consultez notre <a href="<?php echo esc_url(home_url('/politique-de-confidentialite/')); ?>">Politique de confidentialité</a>.</p>
                        </section>

                        <section class="account-rgpd__section account-rgpd__section--danger">
                            <h3>Supprimer mon compte</h3>
                            <p>Cette action est <strong>irréversible</strong>. Vos informations personnelles seront anonymisées. Les données de commande sont conservées à des fins légales (comptabilité).</p>
                            <button class="account-form__btn account-form__btn--danger" id="deleteAccountBtn" type="button">Supprimer mon compte</button>
                            <div class="account-rgpd__delete-confirm" id="deleteConfirmBox" style="display:none;">
                                <p>Pour confirmer, tapez <strong>SUPPRIMER</strong> ci-dessous :</p>
                                <input type="text" id="deleteConfirmInput" placeholder="SUPPRIMER">
                                <p id="deleteError" class="account-form__msg account-form__msg--error" style="display:none;"></p>
                                <button class="account-form__btn account-form__btn--danger" id="deleteConfirmBtn" type="button">Confirmer la suppression</button>
                                <button class="account-form__btn account-form__btn--secondary" id="deleteCancelBtn" type="button">Annuler</button>
                            </div>
                        </section>
                    </div>
                </div>

            </div><!-- /.account-content -->
        </div><!-- /.account-dashboard -->
        <?php endif; ?>

    </div><!-- /.account-page__container -->
</main>

<?php get_footer(); ?>
