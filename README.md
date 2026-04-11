# Klipss — Thème WordPress Custom

Landing page e-commerce one-product pour Klipss, accroche-sac connecté 3-en-1.
Site en production : https://klipss.fr

## Stack technique
- WordPress (sans WooCommerce)
- Thème custom développé from scratch (PHP, CSS, JavaScript vanilla)
- Configurateur produit interactif (choix coloris, compatibilité Apple/Android)
- Intégration Stripe directe (Stripe.js + webhooks PHP) sans plugin
- Tunnel de pré-commande custom

## Structure du thème

```
klipss-theme/
├── assets/
│   ├── css/
│   │   ├── main.css              # Styles principaux
│   │   └── main.min.css          # Version minifiée
│   ├── icons/                    # Icônes SVG (réseaux sociaux, play)
│   ├── images/
│   │   ├── klipss/               # Photos produit (6 coloris, desktop)
│   │   ├── slider-highlight/     # Images slider mise en avant
│   │   ├── testimonials/         # Photos témoignages
│   │   ├── details/              # Illustrations détails produit
│   │   ├── logo.svg              # Logo Klipss
│   │   └── favicon.*             # Favicons
│   ├── js/
│   │   ├── main.js               # Entry point ES6 modules
│   │   └── modules/
│   │       ├── navigation.js     # Menu mobile, scroll
│   │       ├── hero-slider.js    # Slider hero auto-scroll
│   │       ├── configurator.js   # Sélecteur coloris/options
│   │       ├── stripe-checkout.js # Paiement Stripe direct
│   │       ├── cart.js           # Logique panier (legacy)
│   │       ├── account.js        # Espace client
│   │       ├── sticky-bar.js     # Barre sticky CTA
│   │       ├── modals.js         # Modales
│   │       ├── sliders.js        # Sliders génériques
│   │       ├── faq.js            # Accordéon FAQ
│   │       ├── parallax.js       # Effets parallaxe
│   │       ├── animations.js     # Animations au scroll
│   │       └── video-section.js  # Autoplay vidéo
│   └── videos/
│       └── klipss-pub.mp4        # Vidéo promotionnelle
├── inc/
│   ├── nav.php                   # Header / navigation
│   ├── klipss-customer.php       # Commandes client, AJAX Stripe
│   └── klipss-admin-orders.php   # Gestion commandes admin
├── front-page.php                # Landing page principale
├── page-mon-compte.php           # Page espace client
├── page-conditions-generales-de-vente.php
├── page-conditions-generales-utilisation.php
├── page-mentions-legales.php
├── header.php                    # <head>, SEO, structured data
├── footer.php                    # Footer
├── functions.php                 # Enqueue scripts, AJAX, config
├── style.css                     # Métadonnées thème WordPress
├── screenshot.png                # Aperçu thème WP Admin
└── serve-image.php               # Proxy images (fix MIME Local)
```

## Installation

1. Cloner le repo dans `wp-content/themes/`
2. Activer le thème depuis l'admin WordPress
3. Définir les constantes suivantes dans `wp-config.php` :
   ```php
   define('KLIPSS_STRIPE_PK', 'pk_live_...');
   define('KLIPSS_STRIPE_SK', 'sk_live_...');
   define('KLIPSS_SHOP_EMAIL', 'contact@klipss.fr');
   ```
