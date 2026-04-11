<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title>Klipss | Accroche-sac connecté 3-en-1 — Batterie, Tracker, Qi | 60€</title>
    <meta name="description" content="Klipss : l'accroche-sac connecté 3-en-1. Batterie 3000mAh, charge Qi 7.5W, tracker Bluetooth. Design joaillier, 6 coloris. 60€, livraison gratuite.">
    <meta name="author" content="Klipss">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo esc_url(home_url('/')); ?>">

    <!-- Theme Color -->
    <meta name="theme-color" content="#5784BA">
    <meta name="msapplication-TileColor" content="#5784BA">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="product">
    <meta property="og:url" content="<?php echo esc_url(home_url('/')); ?>">
    <meta property="og:title" content="Klipss — L'accroche-sac connecté 3-en-1 qui libère votre quotidien">
    <meta property="og:description" content="Batterie 3000mAh, charge sans fil Qi 7.5W, Tracker Bluetooth 5.0 et crochet antirayures. Design joaillier en 6 coloris exclusifs. Dès 60€.">
    <meta property="og:image" content="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/og-image.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="fr_FR">
    <meta property="og:site_name" content="Klipss">
    <meta property="product:price:amount" content="60.00">
    <meta property="product:price:currency" content="EUR">

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="<?php echo esc_url(home_url('/')); ?>">
    <meta name="twitter:title" content="Klipss — L'accroche-sac connecté 3-en-1">
    <meta name="twitter:description" content="Batterie 3000mAh, charge sans fil Qi 7.5W, Tracker Bluetooth 5.0. Design joaillier, 6 coloris. Dès 60€.">
    <meta name="twitter:image" content="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/og-image.jpg">

    <!-- Structured Data - Product -->
    <?php
    $theme_uri = get_template_directory_uri();
    $home_url  = home_url('/');
    $product_schema = array(
        '@context'    => 'https://schema.org',
        '@type'       => 'Product',
        'name'        => 'Klipss',
        'description' => "Klipss est l'accroche-sac connecté 3-en-1 : batterie 3000mAh, charge sans fil Qi 7.5W, Tracker Bluetooth 5.0 et crochet antirayures. Design joaillier en 6 coloris exclusifs, environ 150g, acier inoxydable recyclé.",
        'image'       => array(
            $theme_uri . '/assets/images/klipss/1-desktop.webp',
            $theme_uri . '/assets/images/klipss/2-desktop.webp',
            $theme_uri . '/assets/images/klipss/3-desktop.webp',
        ),
        'brand'  => array( '@type' => 'Brand', 'name' => 'Klipss' ),
        'offers' => array(
            '@type'            => 'Offer',
            'url'              => $home_url,
            'priceCurrency'    => 'EUR',
            'price'            => '60.00',
            'priceValidUntil'  => '2026-12-31',
            'availability'     => 'https://schema.org/InStock',
            'itemCondition'    => 'https://schema.org/NewCondition',
            'shippingDetails'  => array(
                '@type'        => 'OfferShippingDetails',
                'shippingRate' => array( '@type' => 'MonetaryAmount', 'value' => '0', 'currency' => 'EUR' ),
                'deliveryTime' => array(
                    '@type'       => 'ShippingDeliveryTime',
                    'handlingTime' => array( '@type' => 'QuantitativeValue', 'minValue' => 1, 'maxValue' => 2, 'unitCode' => 'DAY' ),
                    'transitTime'  => array( '@type' => 'QuantitativeValue', 'minValue' => 2, 'maxValue' => 5, 'unitCode' => 'DAY' ),
                ),
            ),
            'hasMerchantReturnPolicy' => array(
                '@type'                => 'MerchantReturnPolicy',
                'returnPolicyCategory' => 'https://schema.org/MerchantReturnFiniteReturnWindow',
                'merchantReturnDays'   => 30,
                'returnMethod'         => 'https://schema.org/ReturnByMail',
                'returnFees'           => 'https://schema.org/FreeReturn',
            ),
        ),
    );
    ?>
    <script type="application/ld+json"><?php echo wp_json_encode( $product_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ); ?></script>

    <!-- Structured Data - Organization -->
    <?php
    $org_schema = array(
        '@context'     => 'https://schema.org',
        '@type'        => 'Organization',
        'name'         => 'Klipss',
        'url'          => $home_url,
        'logo'         => $theme_uri . '/assets/images/logo.svg',
        'sameAs'       => array(
            'https://www.facebook.com/klipss',
            'https://www.instagram.com/klipss',
        ),
        'contactPoint' => array(
            '@type'             => 'ContactPoint',
            'email'             => 'contact@klipss.fr',
            'contactType'       => 'customer service',
            'availableLanguage' => 'French',
        ),
    );
    ?>
    <script type="application/ld+json"><?php echo wp_json_encode( $org_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ); ?></script>

    <!-- Structured Data - FAQ -->
    <?php
    // FAQ — synchronisé avec les questions visibles sur la page
    $faq_schema = array(
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'mainEntity' => array(
            array(
                '@type'          => 'Question',
                'name'           => 'Comment fonctionne la livraison ?',
                'acceptedAnswer' => array( '@type' => 'Answer', 'text' => 'La livraison est effectuée sous 2 à 5 jours ouvrés en France métropolitaine. Livraison gratuite.' ),
            ),
            array(
                '@type'          => 'Question',
                'name'           => 'Quelle est la politique de retour ?',
                'acceptedAnswer' => array( '@type' => 'Answer', 'text' => 'Vous disposez de 30 jours pour retourner le produit s\'il ne vous convient pas. Retour gratuit, remboursement intégral.' ),
            ),
            array(
                '@type'          => 'Question',
                'name'           => 'Quelle est l\'autonomie de la batterie ?',
                'acceptedAnswer' => array( '@type' => 'Answer', 'text' => 'La batterie de 3000mAh offre environ 30 à 40% de charge pour un smartphone standard. En mode tracking seul, l\'autonomie atteint jusqu\'à 30 jours.' ),
            ),
            array(
                '@type'          => 'Question',
                'name'           => 'Comment configurer le tracker ?',
                'acceptedAnswer' => array( '@type' => 'Answer', 'text' => 'Activez le Bluetooth sur votre smartphone, puis ajoutez Klipss dans Apple Find My (iOS) ou Google Find My Device (Android). La configuration prend moins de 2 minutes.' ),
            ),
            array(
                '@type'          => 'Question',
                'name'           => 'Le Klipss est-il garanti ?',
                'acceptedAnswer' => array( '@type' => 'Answer', 'text' => 'Oui, Klipss est garanti 2 ans. La garantie couvre tous les défauts de fabrication et de fonctionnement.' ),
            ),
            array(
                '@type'          => 'Question',
                'name'           => 'Quels sont les délais de livraison ?',
                'acceptedAnswer' => array( '@type' => 'Answer', 'text' => 'Expédition sous 24-48h ouvrées. Livraison en 2 à 5 jours ouvrés en France métropolitaine.' ),
            ),
        ),
    );
    ?>
    <script type="application/ld+json"><?php echo wp_json_encode( $faq_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ); ?></script>

    <!-- Structured Data - BreadcrumbList -->
    <?php
    $breadcrumb_schema = array(
        '@context' => 'https://schema.org',
        '@type'    => 'BreadcrumbList',
        'itemListElement' => array(
            array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Accueil', 'item' => $home_url ),
        ),
    );
    ?>
    <script type="application/ld+json"><?php echo wp_json_encode( $breadcrumb_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ); ?></script>

    <!-- Stylesheets -->
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico" type="image/x-icon">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php wp_body_open(); ?>
