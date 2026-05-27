<!-- ========================================
    HEADER
======================================== -->
<header class="header">
    <div class="header__banner">
        <p class="header__banner-text">Livraison gratuite dès le Pack Complet — Expédié sous 24h</p>
        <p class="header__banner-text">Satisfaite ou remboursée — 30 jours pour changer d'avis</p>
        <p class="header__banner-text">3-en-1 : Batterie 3000mAh · Charge sans fil Qi · Tracker Bluetooth · Accroche-sac</p>
    </div>

    <div class="header__nav">
        <div class="container">
            <a href="<?php echo home_url("/"); ?>" class="header__logo">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg" alt="Klipss Logo" class="header__logo-img">
            </a>
            <nav class="header__menu">
                <div class="header__menu-wrapper">
                    <?php wp_nav_menu( array(
                            'theme_location' => 'primary',
                            'container' => false,
                            'menu_class' => 'header__menu-list'
                        )
                    ); ?>
                    <div class="header__menu-account">
                        <a href="<?php echo esc_url(home_url('/mon-compte/')); ?>" class="header__menu-account-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            Mon compte
                        </a>
                    </div>
                    <div class="header__menu-cta">
                        <a href="#configurator" class="header__menu-cta-btn">Pré-commander</a>
                    </div>
                </div>
            </nav>
            <div class="header__cta">
                <a href="<?php echo esc_url(home_url('/mon-compte/')); ?>" class="header__account-btn" aria-label="Mon compte">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </a>
                <a href="#configurator" class="header__cta-btn">Pré-commander</a>
            </div>
            <div class="header__mobile-toggle">
                <button class="header__hamburger" aria-label="Toggle navigation menu">
                    <span class="header__hamburger-bar"></span>
                    <span class="header__hamburger-bar"></span>
                    <span class="header__hamburger-bar"></span>
                </button>
            </div>
        </div>
    </div>
</header>