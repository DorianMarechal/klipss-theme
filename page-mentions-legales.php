<?php
/**
 * Template Name: Mentions Légales
 * Description: Page des mentions légales
 */

    get_header();
    include get_template_directory() . '/inc/nav.php';
?>

<!-- ========================================
    MAIN CONTENT
======================================== -->
<main class="main">

    <!-- ========================================
        MENTIONS LÉGALES SECTION
    ======================================== -->
    <section class="cgv">
        <div class="container">
            <div class="cgv__header">
                <h1 class="cgv__title">Mentions Légales</h1>
                <p class="cgv__subtitle">Informations légales obligatoires</p>
            </div>

            <div class="cgv__content">

                <article class="cgv__article">
                    <h2 class="cgv__article-title">1. Éditeur du site</h2>
                    <div class="cgv__contact">
                        <p class="cgv__contact-item"><strong>Raison sociale :</strong> Klipss SAS</p>
                        <p class="cgv__contact-item"><strong>Forme juridique :</strong> Société par Actions Simplifiée</p>
                        <p class="cgv__contact-item"><strong>Capital social :</strong> 50 000 €</p>
                        <p class="cgv__contact-item"><strong>Siège social :</strong> 123 Rue de l'Audio, 75001 Paris, France</p>
                        <p class="cgv__contact-item"><strong>RCS :</strong> Paris B 123 456 789</p>
                        <p class="cgv__contact-item"><strong>SIRET :</strong> 123 456 789 00012</p>
                        <p class="cgv__contact-item"><strong>TVA Intracommunautaire :</strong> FR 12 123456789</p>
                        <p class="cgv__contact-item"><strong>Email :</strong> <a href="mailto:contact@klipss.fr" class="cgv__link">contact@klipss.fr</a></p>
                        <p class="cgv__contact-item"><strong>Téléphone :</strong> +33 (0)1 23 45 67 89</p>
                    </div>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">2. Directeur de la publication</h2>
                    <p class="cgv__article-text">
                        Le directeur de la publication du site est Monsieur Jean Dupont, en sa qualité de Président de la société Klipss SAS.
                    </p>
                    <div class="cgv__contact">
                        <p class="cgv__contact-item"><strong>Email :</strong> <a href="mailto:direction@klipss.fr" class="cgv__link">direction@klipss.fr</a></p>
                    </div>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">3. Hébergeur du site</h2>
                    <p class="cgv__article-text">
                        Le site Klipss est hébergé par :
                    </p>
                    <div class="cgv__contact">
                        <p class="cgv__contact-item"><strong>Raison sociale :</strong> OVH SAS</p>
                        <p class="cgv__contact-item"><strong>Siège social :</strong> 2 rue Kellermann, 59100 Roubaix, France</p>
                        <p class="cgv__contact-item"><strong>Téléphone :</strong> +33 (0)9 72 10 10 07</p>
                        <p class="cgv__contact-item"><strong>Site web :</strong> <a href="https://www.ovh.com" class="cgv__link" target="_blank" rel="noopener noreferrer">www.ovh.com</a></p>
                    </div>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">4. Propriété intellectuelle</h2>
                    <p class="cgv__article-text">
                        L'ensemble du contenu du site Klipss (structure, textes, logos, images, vidéos, icônes, sons, logiciels, bases de données, etc.) est la propriété exclusive de Klipss SAS ou de ses partenaires, et est protégé par les lois françaises et internationales relatives à la propriété intellectuelle.
                    </p>
                    <p class="cgv__article-text">
                        Toute reproduction, représentation, modification, publication, transmission, dénaturation, totale ou partielle du site ou de son contenu, par quelque procédé que ce soit, et sur quelque support que ce soit est interdite sans l'autorisation écrite préalable de Klipss SAS.
                    </p>
                    <div class="cgv__article-highlight">
                        <h3 class="cgv__article-highlight-title">Marques déposées</h3>
                        <p class="cgv__article-text">
                            Les marques, logos et autres signes distinctifs reproduits sur le site sont des marques déposées de Klipss SAS. Toute reproduction ou utilisation de ces marques sans autorisation expresse est prohibée et constituerait une contrefaçon sanctionnée par les articles L.713-2 et suivants du Code de la propriété intellectuelle.
                        </p>
                    </div>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">5. Protection des données personnelles</h2>
                    <p class="cgv__article-text">
                        Conformément à la loi n°78-17 du 6 janvier 1978 modifiée relative à l'informatique, aux fichiers et aux libertés, et au Règlement Général sur la Protection des Données (RGPD) n°2016/679 du 27 avril 2016, vous disposez d'un droit d'accès, de rectification, de suppression et d'opposition aux données personnelles vous concernant.
                    </p>
                    <p class="cgv__article-text">
                        Pour exercer ces droits, vous pouvez nous contacter :
                    </p>
                    <ul class="cgv__article-list">
                        <li class="cgv__article-list-item">Par email : <a href="mailto:dpo@klipss.fr" class="cgv__link">dpo@klipss.fr</a></li>
                        <li class="cgv__article-list-item">Par courrier : Klipss SAS - DPO, 123 Rue de l'Audio, 75001 Paris, France</li>
                    </ul>
                    <p class="cgv__article-text">
                        Pour plus d'informations sur la protection de vos données personnelles, consultez notre <a href="<?php echo home_url('/conditions-generales-utilisation/'); ?>" class="cgv__link">Politique de Confidentialité</a>.
                    </p>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">6. Cookies</h2>
                    <p class="cgv__article-text">
                        Le site utilise des cookies pour améliorer l'expérience utilisateur et réaliser des statistiques de visites. Conformément à la réglementation en vigueur, nous recueillons votre consentement avant le dépôt de cookies non essentiels.
                    </p>
                    <p class="cgv__article-text">
                        Vous pouvez à tout moment modifier vos préférences en matière de cookies dans les paramètres de votre navigateur ou via notre bandeau de gestion des cookies.
                    </p>
                    <div class="cgv__article-highlight">
                        <h3 class="cgv__article-highlight-title">Types de cookies utilisés :</h3>
                        <ul class="cgv__article-list">
                            <li class="cgv__article-list-item"><strong>Cookies essentiels :</strong> nécessaires au fonctionnement du site</li>
                            <li class="cgv__article-list-item"><strong>Cookies analytiques :</strong> mesure d'audience et statistiques (Google Analytics)</li>
                            <li class="cgv__article-list-item"><strong>Cookies fonctionnels :</strong> mémorisation de vos préférences</li>
                        </ul>
                    </div>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">7. Liens hypertextes</h2>
                    <p class="cgv__article-text">
                        Le site Klipss peut contenir des liens hypertextes vers d'autres sites internet. Klipss SAS n'exerce aucun contrôle sur ces sites et décline toute responsabilité quant à leur contenu, leur disponibilité, leurs pratiques en matière de protection des données personnelles ou les dommages pouvant résulter de leur utilisation.
                    </p>
                    <p class="cgv__article-text">
                        La création de liens hypertextes vers le site Klipss est soumise à l'autorisation préalable et écrite de Klipss SAS. Pour toute demande, veuillez nous contacter à l'adresse : <a href="mailto:contact@klipss.fr" class="cgv__link">contact@klipss.fr</a>
                    </p>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">8. Limitation de responsabilité</h2>
                    <p class="cgv__article-text">
                        Klipss SAS s'efforce d'assurer au mieux de ses possibilités l'exactitude et la mise à jour des informations diffusées sur ce site, dont elle se réserve le droit de corriger, à tout moment et sans préavis, le contenu.
                    </p>
                    <p class="cgv__article-text">
                        Toutefois, Klipss SAS ne peut garantir l'exactitude, la précision ou l'exhaustivité des informations mises à disposition sur ce site. En conséquence, Klipss SAS décline toute responsabilité pour :
                    </p>
                    <ul class="cgv__article-list">
                        <li class="cgv__article-list-item">Toute imprécision, inexactitude ou omission portant sur des informations disponibles sur le site</li>
                        <li class="cgv__article-list-item">Les dommages résultant d'une intrusion frauduleuse d'un tiers ayant entraîné une modification des informations mises à disposition</li>
                        <li class="cgv__article-list-item">Les virus informatiques ou tout autre dysfonctionnement technique</li>
                        <li class="cgv__article-list-item">L'indisponibilité temporaire ou totale du site</li>
                    </ul>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">9. Droit applicable et juridiction compétente</h2>
                    <p class="cgv__article-text">
                        Les présentes mentions légales sont régies par le droit français. En cas de litige et à défaut d'accord amiable, le litige sera porté devant les tribunaux français conformément aux règles de compétence en vigueur.
                    </p>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">10. Médiation et règlement des litiges</h2>
                    <p class="cgv__article-text">
                        Conformément aux articles L.612-1 et suivants du Code de la consommation, nous proposons un dispositif de médiation de la consommation.
                    </p>
                    <p class="cgv__article-text">
                        En cas de litige, vous pouvez déposer votre réclamation sur la plateforme de résolution des litiges mise en ligne par la Commission Européenne : <a href="https://ec.europa.eu/consumers/odr/" class="cgv__link" target="_blank" rel="noopener noreferrer">ec.europa.eu/consumers/odr/</a>
                    </p>
                    <div class="cgv__contact">
                        <p class="cgv__contact-item"><strong>Médiateur de la consommation :</strong></p>
                        <p class="cgv__contact-item">Centre de Médiation et de Règlement Amiable des Huissiers de Justice (CMRHJ)</p>
                        <p class="cgv__contact-item">18 Boulevard Adolphe Pinard</p>
                        <p class="cgv__contact-item">75014 Paris</p>
                        <p class="cgv__contact-item"><a href="https://www.cnhj-mediation.fr" class="cgv__link" target="_blank" rel="noopener noreferrer">www.cnhj-mediation.fr</a></p>
                    </div>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">11. Contact</h2>
                    <p class="cgv__article-text">
                        Pour toute question concernant les présentes mentions légales ou le site en général, vous pouvez nous contacter :
                    </p>
                    <div class="cgv__contact">
                        <p class="cgv__contact-item"><strong>Email :</strong> <a href="mailto:contact@klipss.fr" class="cgv__link">contact@klipss.fr</a></p>
                        <p class="cgv__contact-item"><strong>Téléphone :</strong> +33 (0)1 23 45 67 89</p>
                        <p class="cgv__contact-item"><strong>Adresse :</strong> Klipss SAS, 123 Rue de l'Audio, 75001 Paris, France</p>
                    </div>
                </article>

            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
