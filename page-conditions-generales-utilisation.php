<?php
/**
 * Template Name: Conditions Générales d'Utilisation
 * Description: Page des conditions générales d'utilisation
 */

    get_header();
    include get_template_directory() . '/inc/nav.php';
?>

<!-- ========================================
    MAIN CONTENT
======================================== -->
<main class="main">

    <!-- ========================================
        CGU SECTION
    ======================================== -->
    <section class="cgv">
        <div class="container">
            <div class="cgv__header">
                <h1 class="cgv__title">Conditions Générales d'Utilisation</h1>
                <p class="cgv__subtitle">Dernière mise à jour : Janvier 2025</p>
            </div>

            <div class="cgv__content">

                <article class="cgv__article">
                    <h2 class="cgv__article-title">1. Objet</h2>
                    <p class="cgv__article-text">
                        Les présentes Conditions Générales d'Utilisation (CGU) ont pour objet de définir les modalités et conditions d'utilisation du site internet Klipss ainsi que les services qui y sont proposés. En accédant au site, vous acceptez sans réserve les présentes CGU.
                    </p>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">2. Accès au site</h2>
                    <p class="cgv__article-text">
                        Le site Klipss est accessible gratuitement à tout utilisateur disposant d'un accès à Internet. Tous les frais supportés par l'utilisateur pour accéder au service (matériel informatique, logiciels, connexion Internet, etc.) sont à sa charge.
                    </p>
                    <p class="cgv__article-text">
                        Klipss met en œuvre tous les moyens raisonnables à sa disposition pour assurer un accès de qualité au site, mais n'est tenu à aucune obligation d'y parvenir. Klipss ne peut être tenu responsable de tout dysfonctionnement du réseau ou des serveurs, ou de tout autre événement échappant à son contrôle raisonnable, qui empêcherait ou dégraderait l'accès au site.
                    </p>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">3. Compte utilisateur</h2>
                    <p class="cgv__article-text">
                        Pour accéder à certains services, l'utilisateur doit créer un compte. Lors de la création de son compte, l'utilisateur s'engage à fournir des informations exactes et à jour.
                    </p>
                    <div class="cgv__article-highlight">
                        <h3 class="cgv__article-highlight-title">Responsabilités de l'utilisateur :</h3>
                        <ul class="cgv__article-list">
                            <li class="cgv__article-list-item">Maintenir la confidentialité de ses identifiants de connexion</li>
                            <li class="cgv__article-list-item">Informer immédiatement Klipss de toute utilisation non autorisée de son compte</li>
                            <li class="cgv__article-list-item">Être responsable de toute activité effectuée depuis son compte</li>
                            <li class="cgv__article-list-item">Mettre à jour ses informations personnelles en cas de changement</li>
                        </ul>
                    </div>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">4. Utilisation du site</h2>
                    <p class="cgv__article-text">
                        L'utilisateur s'engage à utiliser le site conformément à sa destination et aux lois en vigueur. Il est strictement interdit d'utiliser le site de manière à :
                    </p>
                    <ul class="cgv__article-list">
                        <li class="cgv__article-list-item">Porter atteinte aux droits de propriété intellectuelle de Klipss ou de tiers</li>
                        <li class="cgv__article-list-item">Diffuser des contenus illicites, diffamatoires, racistes, violents ou pornographiques</li>
                        <li class="cgv__article-list-item">Perturber ou interrompre le fonctionnement du site ou des serveurs</li>
                        <li class="cgv__article-list-item">Tenter d'accéder de manière non autorisée aux systèmes informatiques</li>
                        <li class="cgv__article-list-item">Collecter des données personnelles d'autres utilisateurs</li>
                    </ul>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">5. Contenu utilisateur</h2>
                    <p class="cgv__article-text">
                        Si le site permet aux utilisateurs de publier du contenu (commentaires, avis, photos, etc.), l'utilisateur garantit qu'il dispose de tous les droits nécessaires sur ce contenu et qu'il ne porte pas atteinte aux droits de tiers.
                    </p>
                    <p class="cgv__article-text">
                        Klipss se réserve le droit de modérer, modifier ou supprimer tout contenu qui ne respecterait pas les présentes CGU ou la législation en vigueur, sans préavis et sans justification.
                    </p>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">6. Propriété intellectuelle</h2>
                    <p class="cgv__article-text">
                        L'ensemble des éléments du site Klipss (structure, design, textes, images, logos, vidéos, bases de données, etc.) sont protégés par le droit d'auteur, le droit des marques et/ou tout autre droit de propriété intellectuelle.
                    </p>
                    <p class="cgv__article-text">
                        Toute reproduction, représentation, modification, publication, adaptation de tout ou partie des éléments du site, quel que soit le moyen ou le procédé utilisé, est interdite, sauf autorisation écrite préalable de Klipss.
                    </p>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">7. Données personnelles</h2>
                    <p class="cgv__article-text">
                        Klipss collecte et traite des données personnelles dans le respect du Règlement Général sur la Protection des Données (RGPD) et de la loi Informatique et Libertés.
                    </p>
                    <div class="cgv__article-highlight">
                        <p class="cgv__article-text">
                            Pour plus d'informations sur la collecte, l'utilisation et la protection de vos données personnelles, veuillez consulter notre <a href="<?php echo home_url('/mentions-legales/'); ?>" class="cgv__link">Politique de Confidentialité</a>.
                        </p>
                    </div>
                    <p class="cgv__article-text">
                        Conformément au RGPD, vous disposez des droits suivants concernant vos données personnelles :
                    </p>
                    <ul class="cgv__article-list">
                        <li class="cgv__article-list-item"><strong>Droit d'accès :</strong> obtenir la confirmation que vos données sont traitées et y accéder</li>
                        <li class="cgv__article-list-item"><strong>Droit de rectification :</strong> corriger vos données inexactes ou incomplètes</li>
                        <li class="cgv__article-list-item"><strong>Droit à l'effacement :</strong> demander la suppression de vos données</li>
                        <li class="cgv__article-list-item"><strong>Droit à la limitation :</strong> limiter le traitement de vos données</li>
                        <li class="cgv__article-list-item"><strong>Droit à la portabilité :</strong> recevoir vos données dans un format structuré</li>
                        <li class="cgv__article-list-item"><strong>Droit d'opposition :</strong> vous opposer au traitement de vos données</li>
                    </ul>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">8. Cookies</h2>
                    <p class="cgv__article-text">
                        Le site utilise des cookies pour améliorer l'expérience utilisateur, analyser le trafic et personnaliser le contenu. En poursuivant votre navigation sur le site, vous acceptez l'utilisation de cookies.
                    </p>
                    <p class="cgv__article-text">
                        Vous pouvez à tout moment désactiver les cookies dans les paramètres de votre navigateur. Toutefois, certaines fonctionnalités du site peuvent être altérées.
                    </p>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">9. Liens hypertextes</h2>
                    <p class="cgv__article-text">
                        Le site peut contenir des liens vers des sites tiers. Klipss n'exerce aucun contrôle sur ces sites et décline toute responsabilité quant à leur contenu, leur disponibilité ou leurs pratiques en matière de protection des données.
                    </p>
                    <p class="cgv__article-text">
                        La création de liens hypertextes vers le site Klipss est soumise à l'autorisation préalable écrite de Klipss.
                    </p>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">10. Limitation de responsabilité</h2>
                    <p class="cgv__article-text">
                        Klipss s'efforce d'assurer l'exactitude et la mise à jour des informations diffusées sur le site, mais ne peut garantir l'exactitude, la précision ou l'exhaustivité des informations mises à disposition.
                    </p>
                    <p class="cgv__article-text">
                        Klipss ne pourra être tenu responsable des dommages directs ou indirects résultant de l'accès au site ou de son utilisation, notamment :
                    </p>
                    <ul class="cgv__article-list">
                        <li class="cgv__article-list-item">Perte de données ou de profits</li>
                        <li class="cgv__article-list-item">Interruption d'activité</li>
                        <li class="cgv__article-list-item">Dommages résultant de virus informatiques</li>
                        <li class="cgv__article-list-item">Dysfonctionnements ou interruptions du site</li>
                    </ul>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">11. Modification des CGU</h2>
                    <p class="cgv__article-text">
                        Klipss se réserve le droit de modifier les présentes CGU à tout moment. Les modifications entrent en vigueur dès leur publication sur le site. Il est conseillé aux utilisateurs de consulter régulièrement cette page.
                    </p>
                    <p class="cgv__article-text">
                        L'utilisation du site après la modification des CGU vaut acceptation des nouvelles conditions.
                    </p>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">12. Droit applicable et juridiction</h2>
                    <p class="cgv__article-text">
                        Les présentes CGU sont régies par le droit français. En cas de litige relatif à l'interprétation ou l'exécution des présentes, et à défaut d'accord amiable, les tribunaux français seront seuls compétents.
                    </p>
                    <p class="cgv__article-text">
                        Conformément aux articles L.611-1 et R.612-1 du Code de la consommation, vous pouvez recourir à un médiateur de la consommation en cas de litige.
                    </p>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">13. Contact</h2>
                    <p class="cgv__article-text">
                        Pour toute question concernant les présentes CGU ou l'utilisation du site, vous pouvez nous contacter :
                    </p>
                    <div class="cgv__contact">
                        <p class="cgv__contact-item"><strong>Email :</strong> <a href="mailto:contact@klipss.fr" class="cgv__link">contact@klipss.fr</a></p>
                        <p class="cgv__contact-item"><strong>Téléphone :</strong> +33 (0)1 23 45 67 89</p>
                        <p class="cgv__contact-item"><strong>Adresse :</strong> Klipss, 123 Rue de l'Audio, 75001 Paris, France</p>
                    </div>
                </article>

            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
