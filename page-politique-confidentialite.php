<?php
/**
 * Template Name: Politique de confidentialité
 * Description: Politique de confidentialité RGPD dédiée (distincte des CGU).
 */

if (!defined('ABSPATH')) exit;

get_header();
include get_template_directory() . '/inc/nav.php';

// Schema.org — page de politique de confidentialité
$privacy_schema = array(
    '@context' => 'https://schema.org',
    '@type'    => 'PrivacyPolicy',
    'name'     => 'Politique de confidentialité — KLIPSS',
    'url'      => home_url('/politique-de-confidentialite/'),
    'inLanguage' => 'fr-FR',
    'publisher'  => array('@type' => 'Organization', 'name' => 'KLIPSS'),
);
?>
<script type="application/ld+json"><?php echo wp_json_encode($privacy_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?></script>

<main class="main">
    <section class="cgv">
        <div class="container">
            <div class="cgv__header">
                <h1 class="cgv__title">Politique de confidentialité</h1>
                <p class="cgv__subtitle">Protection de vos données personnelles — Dernière mise à jour : 29 mai 2026</p>
            </div>

            <div class="cgv__content">

                <article class="cgv__article">
                    <h2 class="cgv__article-title">1. Introduction</h2>
                    <p class="cgv__article-text">
                        KLIPSS SAS (ci-après « KLIPSS », « nous », « notre » ou « nos ») attache une importance fondamentale au respect de la vie privée et à la protection des données personnelles des utilisateurs de son site klipss.fr (ci-après « le Site »).
                    </p>
                    <p class="cgv__article-text">
                        La présente Politique de Confidentialité a pour objet de vous informer, en toute transparence et conformément au Règlement (UE) 2016/679 du 27 avril 2016 (ci-après « RGPD ») ainsi qu'à la loi Informatique et Libertés du 6 janvier 1978 modifiée, sur la manière dont nous collectons, utilisons, conservons et protégeons vos données personnelles.
                    </p>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">2. Identité du responsable de traitement</h2>
                    <div class="cgv__contact">
                        <p class="cgv__contact-item"><strong>KLIPSS SAS</strong></p>
                        <p class="cgv__contact-item">Société par Actions Simplifiée au capital social de 1 000 €</p>
                        <p class="cgv__contact-item"><strong>Siège social :</strong> 12 Rue des Cordonniers, 66000 Perpignan, France</p>
                        <p class="cgv__contact-item"><strong>RCS Perpignan :</strong> En cours d'immatriculation</p>
                        <p class="cgv__contact-item"><strong>Email :</strong> <a href="mailto:contact@klipss.fr" class="cgv__link">contact@klipss.fr</a></p>
                        <p class="cgv__contact-item"><strong>Téléphone :</strong> 04 68 12 34 56</p>
                        <p class="cgv__contact-item">Le responsable de traitement est KLIPSS SAS, représentée par Madame Macha Daubord, en sa qualité de Présidente.</p>
                    </div>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">3. Délégué à la Protection des Données (DPO)</h2>
                    <h3 class="cgv__article-highlight-title">3.1 Désignation</h3>
                    <p class="cgv__article-text">
                        Conformément à l'article 37 du RGPD et compte tenu du fait que les activités de base de KLIPSS impliquent un suivi régulier et systématique à grande échelle des personnes concernées (e-commerce avec mesure d'audience, profilage marketing, tracking de campagnes publicitaires sur Meta, TikTok, Pinterest et Google), KLIPSS a désigné un Délégué à la Protection des Données.
                    </p>
                    <div class="cgv__contact">
                        <p class="cgv__contact-item"><strong>DPO : Monsieur Dorian Maréchal</strong></p>
                        <p class="cgv__contact-item">Contact : <a href="mailto:contact@klipss.fr" class="cgv__link">contact@klipss.fr</a> (objet : « À l'attention du DPO »)</p>
                    </div>
                    <h3 class="cgv__article-highlight-title">3.2 Déclaration auprès de la CNIL</h3>
                    <p class="cgv__article-text">
                        La désignation du DPO a été déclarée auprès de la Commission Nationale de l'Informatique et des Libertés (CNIL) conformément à l'article 37.7 du RGPD. Numéro de déclaration CNIL : à compléter après déclaration effective.
                    </p>
                    <h3 class="cgv__article-highlight-title">3.3 Missions du DPO</h3>
                    <ul class="cgv__article-list">
                        <li class="cgv__article-list-item">informer et conseiller KLIPSS et ses collaborateurs sur leurs obligations RGPD ;</li>
                        <li class="cgv__article-list-item">contrôler le respect du RGPD et de la loi Informatique et Libertés ;</li>
                        <li class="cgv__article-list-item">dispenser des conseils sur les analyses d'impact (AIPD) et en vérifier l'exécution ;</li>
                        <li class="cgv__article-list-item">coopérer avec la CNIL et constituer son point de contact ;</li>
                        <li class="cgv__article-list-item">tenir le registre des activités de traitement (article 30 du RGPD).</li>
                    </ul>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">4. Données collectées</h2>
                    <h3 class="cgv__article-highlight-title">4.1 Données collectées directement auprès de vous</h3>
                    <ul class="cgv__article-list">
                        <li class="cgv__article-list-item"><strong>Données d'identification :</strong> nom, prénom, civilité ;</li>
                        <li class="cgv__article-list-item"><strong>Données de contact :</strong> adresse email, numéro de téléphone, adresse postale ;</li>
                        <li class="cgv__article-list-item"><strong>Données de commande :</strong> produits commandés, montants, dates ;</li>
                        <li class="cgv__article-list-item"><strong>Données de paiement :</strong> les coordonnées bancaires sont collectées et traitées directement par notre prestataire Stripe et ne sont pas stockées sur nos serveurs ;</li>
                        <li class="cgv__article-list-item"><strong>Données de compte :</strong> identifiant, mot de passe (stocké sous forme chiffrée) ;</li>
                        <li class="cgv__article-list-item"><strong>Données de communication :</strong> contenu des échanges avec le service client.</li>
                    </ul>
                    <h3 class="cgv__article-highlight-title">4.2 Données collectées automatiquement</h3>
                    <ul class="cgv__article-list">
                        <li class="cgv__article-list-item"><strong>Données techniques :</strong> adresse IP, type et version du navigateur, système d'exploitation, résolution d'écran ;</li>
                        <li class="cgv__article-list-item"><strong>Données de navigation :</strong> pages consultées, durée de visite, parcours, source du trafic ;</li>
                        <li class="cgv__article-list-item"><strong>Données de cookies :</strong> conformément à notre <a href="<?php echo esc_url(home_url('/politique-cookies/')); ?>" class="cgv__link">Politique de Gestion des Cookies</a>.</li>
                    </ul>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">5. Finalités du traitement, bases légales et durées de conservation</h2>
                    <p class="cgv__article-text">Nous traitons vos données personnelles pour les finalités suivantes :</p>
                    <div class="cgv__table-wrap">
                        <table class="cgv__table">
                            <thead>
                                <tr><th>Finalité</th><th>Base légale</th><th>Durée de conservation</th></tr>
                            </thead>
                            <tbody>
                                <tr><td>Gestion des commandes et exécution du contrat</td><td>Exécution du contrat (art. 6.1.b)</td><td>5 ans après la dernière commande</td></tr>
                                <tr><td>Gestion du compte client</td><td>Exécution du contrat (art. 6.1.b)</td><td>Jusqu'à suppression du compte ou 3 ans d'inactivité</td></tr>
                                <tr><td>Facturation et obligations comptables</td><td>Obligation légale (art. 6.1.c)</td><td>10 ans (Code de commerce)</td></tr>
                                <tr><td>Service client et SAV</td><td>Exécution du contrat (art. 6.1.b)</td><td>3 ans après le dernier contact</td></tr>
                                <tr><td>Newsletter et communications marketing</td><td>Consentement (art. 6.1.a)</td><td>Jusqu'au retrait du consentement ou 3 ans d'inactivité</td></tr>
                                <tr><td>Mesure d'audience et analyse statistique</td><td>Consentement (art. 6.1.a)</td><td>13 mois maximum</td></tr>
                                <tr><td>Lutte contre la fraude</td><td>Intérêt légitime (art. 6.1.f)</td><td>5 ans</td></tr>
                                <tr><td>Respect des obligations légales</td><td>Obligation légale (art. 6.1.c)</td><td>Durée prévue par la loi</td></tr>
                            </tbody>
                        </table>
                    </div>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">6. Destinataires et sous-traitants</h2>
                    <p class="cgv__article-text">
                        Vos données peuvent être communiquées au personnel habilité de KLIPSS (services client, marketing, technique), aux autorités administratives et judiciaires en cas de demande légale, ainsi qu'aux sous-traitants suivants, liés par des contrats garantissant la confidentialité et la sécurité de vos données (articles 28 et 29 du RGPD) :
                    </p>
                    <div class="cgv__table-wrap">
                        <table class="cgv__table">
                            <thead>
                                <tr><th>Prestataire</th><th>Finalité</th><th>Pays</th><th>Encadrement transfert hors UE</th></tr>
                            </thead>
                            <tbody>
                                <tr><td>O2Switch</td><td>Hébergement</td><td>France</td><td>Aucun</td></tr>
                                <tr><td>Stripe</td><td>Paiement</td><td>États-Unis</td><td>Clauses Contractuelles Types + DPF</td></tr>
                                <tr><td>MailPoet</td><td>Emailing</td><td>France</td><td>Aucun</td></tr>
                                <tr><td>Bigblue</td><td>Logistique</td><td>France</td><td>Aucun</td></tr>
                                <tr><td>Google (GA4)</td><td>Mesure d'audience</td><td>États-Unis</td><td>Clauses Contractuelles Types</td></tr>
                                <tr><td>Meta, TikTok, Pinterest</td><td>Publicité</td><td>États-Unis / Irlande / Singapour</td><td>CCT selon plateforme</td></tr>
                            </tbody>
                        </table>
                    </div>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">7. Transferts hors Union Européenne</h2>
                    <p class="cgv__article-text">
                        Certains de nos prestataires (notamment Google, Stripe, Meta, TikTok, Pinterest) peuvent traiter vos données en dehors de l'Union Européenne. Dans ce cas, nous nous assurons que ces transferts sont encadrés par des garanties appropriées au sens du RGPD :
                    </p>
                    <ul class="cgv__article-list">
                        <li class="cgv__article-list-item">Clauses Contractuelles Types adoptées par la Commission Européenne ;</li>
                        <li class="cgv__article-list-item">adhésion à des cadres de protection reconnus (Data Privacy Framework) ;</li>
                        <li class="cgv__article-list-item">décisions d'adéquation de la Commission Européenne.</li>
                    </ul>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">8. Sécurité des données</h2>
                    <p class="cgv__article-text">
                        KLIPSS met en œuvre des mesures techniques et organisationnelles appropriées pour garantir un niveau de sécurité adapté au risque, conformément à l'article 32 du RGPD :
                    </p>
                    <ul class="cgv__article-list">
                        <li class="cgv__article-list-item">chiffrement des communications (HTTPS/TLS) ;</li>
                        <li class="cgv__article-list-item">stockage chiffré des mots de passe ;</li>
                        <li class="cgv__article-list-item">headers HTTP de sécurité (CSP, HSTS, X-Frame-Options) ;</li>
                        <li class="cgv__article-list-item">rate limiting sur les endpoints sensibles ;</li>
                        <li class="cgv__article-list-item">validation des données côté serveur ;</li>
                        <li class="cgv__article-list-item">sauvegardes régulières et accès restreint aux seules personnes habilitées.</li>
                    </ul>
                    <p class="cgv__article-text">
                        En cas de violation de données susceptible d'engendrer un risque pour vos droits et libertés, KLIPSS s'engage à notifier la CNIL dans un délai de 72 heures et à vous en informer si le risque est élevé.
                    </p>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">9. Vos droits</h2>
                    <p class="cgv__article-text">Conformément aux articles 15 à 22 du RGPD, vous disposez des droits suivants :</p>
                    <ul class="cgv__article-list">
                        <li class="cgv__article-list-item"><strong>Droit d'accès</strong> (art. 15) : obtenir la confirmation que vos données sont traitées et en obtenir une copie ;</li>
                        <li class="cgv__article-list-item"><strong>Droit de rectification</strong> (art. 16) : faire corriger des données inexactes ou incomplètes ;</li>
                        <li class="cgv__article-list-item"><strong>Droit à l'effacement</strong> (art. 17), sous réserve des obligations légales pesant sur KLIPSS ;</li>
                        <li class="cgv__article-list-item"><strong>Droit à la limitation</strong> (art. 18) : demander la suspension du traitement dans certains cas ;</li>
                        <li class="cgv__article-list-item"><strong>Droit à la portabilité</strong> (art. 20) : recevoir vos données dans un format structuré et lisible par machine ;</li>
                        <li class="cgv__article-list-item"><strong>Droit d'opposition</strong> (art. 21), notamment sans motif en cas de prospection commerciale ;</li>
                        <li class="cgv__article-list-item"><strong>Droit de retirer votre consentement</strong> à tout moment ;</li>
                        <li class="cgv__article-list-item"><strong>Droit de définir des directives post-mortem.</strong></li>
                    </ul>
                    <p class="cgv__article-text">
                        Vous pouvez exercer ces droits en contactant notre DPO à <a href="mailto:contact@klipss.fr" class="cgv__link">contact@klipss.fr</a> (objet : « À l'attention du DPO »), en joignant une copie d'une pièce d'identité en cas de doute raisonnable sur votre identité. Si vous disposez d'un compte client, vous pouvez exercer directement plusieurs de ces droits depuis votre <a href="<?php echo esc_url(home_url('/mon-compte/')); ?>" class="cgv__link">espace personnel</a> (accès, portabilité, rectification, effacement, opposition). KLIPSS s'engage à répondre dans un délai d'un mois, prolongeable de deux mois en cas de complexité.
                    </p>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">10. Réclamation auprès de la CNIL</h2>
                    <p class="cgv__article-text">
                        Si vous estimez, après nous avoir contactés, que vos droits ne sont pas respectés, vous pouvez introduire une réclamation auprès de la Commission Nationale de l'Informatique et des Libertés (CNIL) :
                    </p>
                    <div class="cgv__contact">
                        <p class="cgv__contact-item"><strong>CNIL</strong></p>
                        <p class="cgv__contact-item">3 Place de Fontenoy, TSA 80715, 75334 Paris Cedex 07</p>
                        <p class="cgv__contact-item">Téléphone : 01 53 73 22 22</p>
                        <p class="cgv__contact-item"><a href="https://www.cnil.fr" class="cgv__link" target="_blank" rel="noopener noreferrer">www.cnil.fr</a></p>
                    </div>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">11. Cookies et traceurs</h2>
                    <p class="cgv__article-text">
                        L'utilisation des cookies et autres traceurs est détaillée dans notre <a href="<?php echo esc_url(home_url('/politique-cookies/')); ?>" class="cgv__link">Politique de Gestion des Cookies</a>, accessible depuis le pied de page du Site. Vous pouvez modifier vos choix à tout moment via le lien « Gérer mes cookies ».
                    </p>
                </article>

                <article class="cgv__article">
                    <h2 class="cgv__article-title">12. Modification de la Politique de Confidentialité</h2>
                    <p class="cgv__article-text">
                        KLIPSS se réserve le droit de modifier la présente Politique à tout moment, notamment pour se conformer à toute évolution législative, réglementaire, jurisprudentielle ou technique. Toute modification substantielle vous sera notifiée par email ou par une notification visible sur le Site avant son entrée en vigueur.
                    </p>
                </article>

            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
