<?php
/**
 * Template Name: Politique de cookies
 * Description: Politique de gestion des cookies (RGPD/CNIL).
 */

if (!defined('ABSPATH')) exit;

get_header();
include get_template_directory() . '/inc/nav.php';
?>
<main class="main">
    <section class="cgv">
        <div class="container">
            <div class="cgv__header">
                <h1 class="cgv__title">Politique de gestion des cookies</h1>
                <p class="cgv__subtitle">Dernière mise à jour : 29 mai 2026</p>
            </div>

            <div class="cgv__content">

                <article class="cgv__article">
                    <h2 class="cgv__article-title">1. Qu'est-ce qu'un cookie ?</h2>
                    <p class="cgv__article-text">
                        Un cookie est un petit fichier texte déposé sur votre terminal (ordinateur, tablette, smartphone) lors de la consultation d'un site internet. Il permet au site de mémoriser des informations sur votre visite, telles que vos préférences de navigation, votre langue, vos données de connexion, ou encore les pages consultées.
                    </p>
                    <p class="cgv__article-text">
                        Les cookies remplissent diverses fonctions : faciliter votre navigation, assurer la sécurité du site, mesurer l'audience, personnaliser les contenus affichés, ou proposer de la publicité ciblée.
                    </p>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">2. Cookies utilisés sur klipss.fr</h2>
                    <p class="cgv__article-text">
                        Le Site utilise différents types de cookies, classés en quatre catégories selon leur finalité. En cas d'incohérence entre les cookies effectivement déposés et la présente liste, les modalités de consentement appliquées via le bandeau du Site prévalent. Un audit cookies est réalisé semestriellement.
                    </p>

                    <h3 class="cgv__article-highlight-title">2.1 Cookies strictement nécessaires (obligatoires)</h3>
                    <p class="cgv__article-text">
                        Indispensables au fonctionnement du Site, ils ne peuvent pas être désactivés. <strong>Base légale :</strong> intérêt légitime / exécution du contrat. Le consentement n'est pas requis.
                    </p>
                    <div class="cgv__table-wrap">
                        <table class="cgv__table">
                            <thead><tr><th>Nom</th><th>Finalité</th><th>Durée</th></tr></thead>
                            <tbody>
                                <tr><td>PHPSESSID</td><td>Identifiant de session utilisateur</td><td>Durée de la session</td></tr>
                                <tr><td>wp_woocommerce_session_*</td><td>Gestion du panier WooCommerce</td><td>48 heures</td></tr>
                                <tr><td>wordpress_logged_in_*</td><td>Maintien de la connexion utilisateur</td><td>14 jours</td></tr>
                                <tr><td>klipss_cookie_consent</td><td>Mémorisation de vos préférences cookies</td><td>13 mois</td></tr>
                            </tbody>
                        </table>
                    </div>

                    <h3 class="cgv__article-highlight-title">2.2 Cookies de mesure d'audience (statistiques)</h3>
                    <p class="cgv__article-text">
                        Ils mesurent l'audience du Site et analysent le comportement des visiteurs. <strong>Base légale :</strong> consentement (art. 6.1.a RGPD). Déposés uniquement avec votre accord.
                    </p>
                    <div class="cgv__table-wrap">
                        <table class="cgv__table">
                            <thead><tr><th>Nom</th><th>Émetteur</th><th>Finalité</th><th>Durée</th></tr></thead>
                            <tbody>
                                <tr><td>_ga</td><td>Google Analytics</td><td>Distinction des utilisateurs uniques</td><td>13 mois</td></tr>
                                <tr><td>_ga_*</td><td>Google Analytics</td><td>Stockage de l'état de la session</td><td>13 mois</td></tr>
                                <tr><td>_gid</td><td>Google Analytics</td><td>Distinction des utilisateurs</td><td>24 heures</td></tr>
                            </tbody>
                        </table>
                    </div>

                    <h3 class="cgv__article-highlight-title">2.3 Cookies fonctionnels (préférences)</h3>
                    <p class="cgv__article-text">
                        Ils mémorisent vos choix et préférences. <strong>Base légale :</strong> consentement (art. 6.1.a RGPD).
                    </p>
                    <div class="cgv__table-wrap">
                        <table class="cgv__table">
                            <thead><tr><th>Nom</th><th>Finalité</th><th>Durée</th></tr></thead>
                            <tbody>
                                <tr><td>klipss_configurator_pref</td><td>Mémorisation du dernier coloris configuré</td><td>30 jours</td></tr>
                                <tr><td>klipss_newsletter_dismissed</td><td>Mémorisation du refus d'affichage de la pop-up newsletter</td><td>30 jours</td></tr>
                            </tbody>
                        </table>
                    </div>

                    <h3 class="cgv__article-highlight-title">2.4 Cookies publicitaires et de réseaux sociaux</h3>
                    <p class="cgv__article-text">
                        Ils permettent la publicité ciblée et la mesure de l'efficacité des campagnes. <strong>Base légale :</strong> consentement (art. 6.1.a RGPD).
                    </p>
                    <div class="cgv__table-wrap">
                        <table class="cgv__table">
                            <thead><tr><th>Nom</th><th>Émetteur</th><th>Finalité</th><th>Durée</th></tr></thead>
                            <tbody>
                                <tr><td>_fbp</td><td>Meta (Facebook/Instagram)</td><td>Suivi des conversions publicitaires</td><td>90 jours</td></tr>
                                <tr><td>_ttp</td><td>TikTok</td><td>Suivi des conversions publicitaires</td><td>13 mois</td></tr>
                                <tr><td>_pin_unauth</td><td>Pinterest</td><td>Suivi des conversions publicitaires</td><td>12 mois</td></tr>
                            </tbody>
                        </table>
                    </div>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">3. Gestion de vos préférences</h2>
                    <h3 class="cgv__article-highlight-title">3.1 Bandeau de consentement</h3>
                    <p class="cgv__article-text">
                        Lors de votre première visite, un bandeau vous propose d'<strong>accepter</strong>, de <strong>refuser</strong> ou de <strong>personnaliser</strong> le dépôt des cookies non strictement nécessaires. Votre choix est mémorisé pendant 13 mois. À l'issue de cette période, ou en cas de modification substantielle, le bandeau réapparaît.
                    </p>
                    <h3 class="cgv__article-highlight-title">3.2 Modification de vos préférences à tout moment</h3>
                    <p class="cgv__article-text">
                        Vous pouvez à tout moment modifier vos préférences :
                        <button type="button" class="cgv__link js-cookie-settings" style="background:none;border:none;padding:0;cursor:pointer;font:inherit;text-decoration:underline;">Gérer mes cookies</button>.
                    </p>
                    <h3 class="cgv__article-highlight-title">3.3 Configuration de votre navigateur</h3>
                    <p class="cgv__article-text">Vous pouvez aussi configurer votre navigateur pour refuser les cookies :</p>
                    <ul class="cgv__article-list">
                        <li class="cgv__article-list-item"><a href="https://support.google.com/chrome/answer/95647" class="cgv__link" target="_blank" rel="noopener noreferrer">Google Chrome</a></li>
                        <li class="cgv__article-list-item"><a href="https://support.mozilla.org/fr/kb/cookies-informations-sites-enregistrent" class="cgv__link" target="_blank" rel="noopener noreferrer">Mozilla Firefox</a></li>
                        <li class="cgv__article-list-item"><a href="https://support.apple.com/fr-fr/guide/safari/sfri11471/mac" class="cgv__link" target="_blank" rel="noopener noreferrer">Safari</a></li>
                        <li class="cgv__article-list-item"><a href="https://support.microsoft.com/fr-fr/microsoft-edge/supprimer-les-cookies-dans-microsoft-edge" class="cgv__link" target="_blank" rel="noopener noreferrer">Microsoft Edge</a></li>
                    </ul>
                    <p class="cgv__article-text">Le refus de l'ensemble des cookies peut altérer certaines fonctionnalités (panier, processus de commande).</p>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">4. Cookies des partenaires</h2>
                    <p class="cgv__article-text">Certains cookies sont déposés par nos partenaires, soumis à leurs propres politiques :</p>
                    <ul class="cgv__article-list">
                        <li class="cgv__article-list-item"><a href="https://policies.google.com/privacy" class="cgv__link" target="_blank" rel="noopener noreferrer">Google</a></li>
                        <li class="cgv__article-list-item"><a href="https://www.facebook.com/privacy/policy" class="cgv__link" target="_blank" rel="noopener noreferrer">Meta</a></li>
                        <li class="cgv__article-list-item"><a href="https://www.tiktok.com/legal/privacy-policy" class="cgv__link" target="_blank" rel="noopener noreferrer">TikTok</a></li>
                        <li class="cgv__article-list-item"><a href="https://policy.pinterest.com/fr/privacy-policy" class="cgv__link" target="_blank" rel="noopener noreferrer">Pinterest</a></li>
                        <li class="cgv__article-list-item"><a href="https://stripe.com/fr/privacy" class="cgv__link" target="_blank" rel="noopener noreferrer">Stripe</a></li>
                    </ul>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">5. Durée de conservation</h2>
                    <p class="cgv__article-text">
                        Les données collectées via les cookies sont conservées pour une durée maximale de 13 mois à compter de leur collecte, conformément aux recommandations de la CNIL. À l'issue de cette période, elles sont supprimées ou anonymisées.
                    </p>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">6. Vos droits</h2>
                    <p class="cgv__article-text">
                        Vous disposez de droits sur vos données (accès, rectification, effacement, opposition, limitation, portabilité). Pour les exercer, contactez notre DPO : <a href="mailto:contact@klipss.fr" class="cgv__link">contact@klipss.fr</a> (objet : « À l'attention du DPO »). Plus de détails dans notre <a href="<?php echo esc_url(home_url('/politique-de-confidentialite/')); ?>" class="cgv__link">Politique de confidentialité</a>. Vous pouvez aussi saisir la CNIL : <a href="https://www.cnil.fr" class="cgv__link" target="_blank" rel="noopener noreferrer">www.cnil.fr</a>.
                    </p>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">7. Modification de la présente politique</h2>
                    <p class="cgv__article-text">
                        KLIPSS se réserve le droit de modifier la présente politique à tout moment, notamment pour tenir compte des évolutions législatives, réglementaires ou techniques. Les modifications entrent en vigueur dès leur publication sur le Site.
                    </p>
                </article>

            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
