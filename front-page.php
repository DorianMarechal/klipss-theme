
    <?php get_header(); ?>
    <?php include get_template_directory() . '/inc/nav.php'; ?>
    <!-- ========================================
        MAIN CONTENT
    ======================================== -->
    <main class="main">

        <!-- ========================================
            HERO SECTION
        ======================================== -->
        <section class="hero" id="hero">
            <div class="container">
                <div class="hero__header">
                    <p class="hero__subtitle">Le bijou de sac connecté <span style="white-space:nowrap">3-en-1</span></p>
                    <h1 class="hero__title">Le bijou de sac connecté
                        qui recharge votre quotidien.</h1>
                </div>
            </div>

            <div class="hero__slider">
                <ul class="hero__slider-track">
                    <li class="hero__slide">
                        <img fetchpriority="high" src="<?php echo get_template_directory_uri(); ?>/assets/images/klipss/1-desktop.webp" alt="Accroche-sac connecté Klipss coloris Rose"
                            class="hero__slide-img" width="600" height="600">
                    </li>
                    <li class="hero__slide">
                        <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/klipss/2-desktop.webp" alt="Klipss Cuir Marron — accroche-sac avec batterie intégrée"
                            class="hero__slide-img" width="600" height="600">
                    </li>
                    <li class="hero__slide">
                        <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/klipss/3-desktop.webp" alt="Klipss Bois — accroche-sac design joaillier"
                            class="hero__slide-img" width="600" height="600">
                    </li>
                    <li class="hero__slide">
                        <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/klipss/4-desktop.webp" alt="Klipss Noir Mat — accroche-sac connecté premium"
                            class="hero__slide-img" width="600" height="600">
                    </li>
                </ul>
                <div class="hero__gradient hero__gradient--right"></div>
                <div class="hero__gradient hero__gradient--left"></div>
            </div>

            <div class="container">
                <div class="hero__cta-wrapper">
                    <div class="hero__cta-text">
                        <p class="hero__cta-label">Design Joaillier</p>
                        <p class="hero__cta-description">4 coloris exclusifs.</p>
                    </div>
                    <a href="#configurator" class="cta__action">
                        <p class="cta__price">45€</p>
                        <span class="cta__btn">Pré-commander</span>
                    </a>
                    <div class="hero__cta-text hero__cta-text--right">
                        <p class="hero__cta-label">Bijou Intelligent</p>
                        <p class="hero__cta-description">Charge · Tracker · Style</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ========================================
            HOW IT WORKS SECTION
        ======================================== -->
        <section class="how-it-works" id="how-it-works">
            <div class="container">
                <div class="how-it-works__header">
                    <h2 class="how-it-works__title">Aussi simple qu'intuitif</h2>
                    <p class="how-it-works__subtitle">Klipss s'installe en 3 secondes, s'utilise au quotidien.</p>
                </div>
                <div class="how-it-works__steps">
                    <div class="how-it-works__step">
                        <div class="how-it-works__step-number">1</div>
                        <div class="how-it-works__step-content">
                            <h3 class="how-it-works__step-title">Accrochez</h3>
                            <p class="how-it-works__step-desc">Glissez l'accroche-sac Klipss sur le rebord d'une table, d'un bar ou d'un bureau. Votre sac ne touche plus jamais le sol.</p>
                        </div>
                    </div>
                    <div class="how-it-works__step">
                        <div class="how-it-works__step-number">2</div>
                        <div class="how-it-works__step-content">
                            <h3 class="how-it-works__step-title">Chargez</h3>
                            <p class="how-it-works__step-desc">Posez votre smartphone sur la surface Qi intégrée ou branchez le câble USB-C. 3000mAh pour recharger votre téléphone jusqu'à 40%.</p>
                        </div>
                    </div>
                    <div class="how-it-works__step">
                        <div class="how-it-works__step-number">3</div>
                        <div class="how-it-works__step-content">
                            <h3 class="how-it-works__step-title">Géolocalisez</h3>
                            <p class="how-it-works__step-desc">Connectez Klipss à Apple Find My ou Google Find My Device. Localisez votre sac en temps réel depuis votre smartphone.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ========================================
            VIDEO SECTION
        ======================================== -->
        <section class="video-section" id="video-section">
            <div class="container">
                <div class="video-section__header">
                    <div class="video-section__text-group">
                        <h2 class="video-section__title">Klipss s'adapte à chaque instant</h2>
                    </div>
                    <button class="video-section__btn" aria-label="view video">
                        Voir la vidéo
                        <svg class="video-section__btn-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>
                    </button>
                </div>

                <div class="video-section__slider">
                    <div class="video-section__track">
                        <div class="video-section__progress-bar"></div>
                        <div class="video-section__progress-bar"></div>
                        <div class="video-section__progress-bar"></div>
                        <div class="video-section__progress-bar"></div>
                    </div>
                    <div class="video-section__slider-container">
                        <ul class="video-section__slider-list">
                            <li class="video-section__slider-item">
                                <picture>
                                    <source media="(max-width: 768px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/slider-highlight/1.webp">
                                    <source media="(max-width: 960px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/slider-highlight/1.webp">
                                    <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/slider-highlight/1.webp" alt="Klipss accroche-sac connecté utilisé au restaurant">
                                </picture>

                                <div class="video-section__slider-item__legend">
                                    <h3 class="video-section__slider-item__title">Au restaurant</h3>
                                    <p class="video-section__slider-item__description">Votre sac suspendu, votre table préservée. Fini les sacs posés au sol. Klipss s'accroche discrètement à la table en quelques secondes.</p>
                                </div>
                            </li>
                            <li class="video-section__slider-item">
                                <picture>
                                    <source media="(max-width: 768px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/slider-highlight/2.webp">
                                    <source media="(max-width: 960px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/slider-highlight/2.webp">
                                    <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/slider-highlight/2.webp" alt="Klipss accroche-sac connecté en déplacement">
                                </picture>
                                <div class="video-section__slider-item__legend">
                                    <h3 class="video-section__slider-item__title">En déplacement</h3>
                                    <p class="video-section__slider-item__description">La charge, toujours avec vous. Jusqu'à 40% de batterie en plus, sans chercher de prise.</p>
                                </div>
                            </li>
                            <li class="video-section__slider-item">
                                <picture>
                                    <source media="(max-width: 768px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/slider-highlight/3.webp">
                                    <source media="(max-width: 960px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/slider-highlight/3.webp">
                                    <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/slider-highlight/3.webp" alt="Klipss accroche-sac connecté en shopping">
                                </picture>
                                <div class="video-section__slider-item__legend">
                                    <h3 class="video-section__slider-item__title">En shopping</h3>
                                    <p class="video-section__slider-item__description">Votre sac toujours dans votre rayon. Le Tracker Bluetooth vous alerte en temps réel dès que vous vous en éloignez.</p>
                                </div>
                            </li>
                            <li class="video-section__slider-item">
                                <picture>
                                    <source media="(max-width: 768px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/slider-highlight/4.webp">
                                    <source media="(max-width: 960px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/slider-highlight/4.webp">
                                    <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/slider-highlight/4.webp" alt="Klipss accroche-sac connecté au bureau">
                                </picture>
                                <div class="video-section__slider-item__legend">
                                    <h3 class="video-section__slider-item__title">Au bureau</h3>
                                    <p class="video-section__slider-item__description">Discret, élégant, fonctionnel. Klipss s'intègre à votre quotidien comme un bijou, sans jamais sacrifier ses performances.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- ========================================
                VIDEO MODAL
            ======================================== -->
            <div class="video-modal" id="videoModal">
                <div class="video-modal__overlay"></div>
                <button class="video-modal__close" aria-label="Close video">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
                <div class="video-modal__content">
                    <div class="video-modal__video-wrapper">
                        <video id="videoPlayer" controls preload="none">
                            <source src="<?php echo get_template_directory_uri(); ?>/assets/videos/klipss-pub.mp4" type="video/mp4">
                            Votre navigateur ne supporte pas la lecture de vidéos.
                        </video>
                    </div>
                </div>
            </div>
        </section>

        <!-- ========================================
            IDEAS SECTION
        ======================================== -->
        <section class="ideas__section" id="ideas">
            <div class="container">
                <div class="ideas__header">
                    <h2 class="ideas__title">Le style rencontre
                        la technologie</h2>
                    <p class="ideas__subtitle">Pour les femmes qui n'ont jamais
                        à choisir entre élégance et praticité</p>
                </div>

                <div class="ideas__content">
                    <div class="idea-image-wrap">
                        <div class="ideas__item">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/klipss/bar.webp" alt="Klipss accroche-sac utilisé au bar — sac suspendu à la table" class="ideas__item-image">
                        </div>
                        <div class="ideas__item">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/klipss/friends.webp" alt="Femmes utilisant l'accroche-sac connecté Klipss entre amies"
                                class="ideas__item-image">
                        </div>
                    </div>
                </div>

                <p class="ideas_quote">
                    Le bijou de sac connecté 3-en-1 pensé pour elle. Batterie 3000mAh, charge sans fil Qi, Tracker Bluetooth, le tout suspendu à l'anse de votre sac. Disponible en 4 coloris exclusifs.
                </p>

                <a href="#configurator" class="cta__action">
                    <p class="cta__price">45€</p>
                    <span class="cta__btn">Pré-commander</span>
                </a>
            </div>
        </section>

        <!-- ========================================
            TESTIMONIALS SECTION
        ======================================== -->
        <section class="testimonials" id="avis">
            <div class="container">
                <!-- Header -->
                <div class="testimonials__header">
                    <h2 class="testimonials__title">Elles ont adopté Klipss</h2>
                    <div class="testimonials__aggregate">
                        <div class="testimonials__aggregate-stars">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-star"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-star"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-star"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-star"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-star"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" /></svg>
                        </div>
                        <span class="testimonials__aggregate-score">5 / 5</span>
                        <span class="testimonials__aggregate-label">— Avis clients vérifiés</span>
                    </div>
                </div>

                <!-- Testimonials Slider -->
                <div class="testimonials__slider">
                    <div class="testimonials__grid">
                        <!-- Testimonial 1 -->
                        <div class="testimonials__item">
                            <div class="testimonials__quote">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-quote">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M9 5a2 2 0 0 1 2 2v6c0 3.13 -1.65 5.193 -4.757 5.97a1 1 0 1 1 -.486 -1.94c2.227 -.557 3.243 -1.827 3.243 -4.03v-1h-3a2 2 0 0 1 -1.995 -1.85l-.005 -.15v-3a2 2 0 0 1 2 -2z" />
                                    <path
                                        d="M18 5a2 2 0 0 1 2 2v6c0 3.13 -1.65 5.193 -4.757 5.97a1 1 0 1 1 -.486 -1.94c2.227 -.557 3.243 -1.827 3.243 -4.03v-1h-3a2 2 0 0 1 -1.995 -1.85l-.005 -.15v-3a2 2 0 0 1 2 -2z" />
                                </svg>
                            </div>
                            <div class="testimonials__stars">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-star"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" /></svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-star"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" /></svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-star"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" /></svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-star"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" /></svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-star"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" /></svg>
                            </div>
                            <p class="testimonials__text">Klipss a changé ma façon de sortir. Plus besoin de poser mon
                                sac par terre au restaurant, et la fonction de recharge est un vrai plus au quotidien.
                            </p>
                            <div class="testimonials__author">
                                <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/testimonials/1.jpg" alt="Sophie Martin"
                                    class="testimonials__avatar">
                                <div class="testimonials__author-info">
                                    <p class="testimonials__author-name">Sophie Martin</p>
                                    <p class="testimonials__author-role">Consultante</p>
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial 2 -->
                        <div class="testimonials__item">
                            <div class="testimonials__quote">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-quote">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M9 5a2 2 0 0 1 2 2v6c0 3.13 -1.65 5.193 -4.757 5.97a1 1 0 1 1 -.486 -1.94c2.227 -.557 3.243 -1.827 3.243 -4.03v-1h-3a2 2 0 0 1 -1.995 -1.85l-.005 -.15v-3a2 2 0 0 1 2 -2z" />
                                    <path
                                        d="M18 5a2 2 0 0 1 2 2v6c0 3.13 -1.65 5.193 -4.757 5.97a1 1 0 1 1 -.486 -1.94c2.227 -.557 3.243 -1.827 3.243 -4.03v-1h-3a2 2 0 0 1 -1.995 -1.85l-.005 -.15v-3a2 2 0 0 1 2 -2z" />
                                </svg>
                            </div>
                            <div class="testimonials__stars">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-star"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" /></svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-star"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" /></svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-star"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" /></svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-star"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" /></svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-star"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" /></svg>
                            </div>
                            <p class="testimonials__text">Le tracker Bluetooth m'a sauvé plusieurs fois. J'ai tendance à
                                oublier mon sac partout, maintenant je suis alertée dès que je m'éloigne.</p>
                            <div class="testimonials__author">
                                <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/testimonials/2.jpg" alt="Marie Dubois"
                                    class="testimonials__avatar">
                                <div class="testimonials__author-info">
                                    <p class="testimonials__author-name">Marie Dubois</p>
                                    <p class="testimonials__author-role">Directrice Marketing</p>
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial 3 -->
                        <div class="testimonials__item">
                            <div class="testimonials__quote">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-quote">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M9 5a2 2 0 0 1 2 2v6c0 3.13 -1.65 5.193 -4.757 5.97a1 1 0 1 1 -.486 -1.94c2.227 -.557 3.243 -1.827 3.243 -4.03v-1h-3a2 2 0 0 1 -1.995 -1.85l-.005 -.15v-3a2 2 0 0 1 2 -2z" />
                                    <path
                                        d="M18 5a2 2 0 0 1 2 2v6c0 3.13 -1.65 5.193 -4.757 5.97a1 1 0 1 1 -.486 -1.94c2.227 -.557 3.243 -1.827 3.243 -4.03v-1h-3a2 2 0 0 1 -1.995 -1.85l-.005 -.15v-3a2 2 0 0 1 2 -2z" />
                                </svg>
                            </div>
                            <div class="testimonials__stars">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-star"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" /></svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-star"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" /></svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-star"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" /></svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-star"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" /></svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-star"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" /></svg>
                            </div>
                            <p class="testimonials__text">Un design élégant qui s'accorde avec tous mes sacs. Mes amies
                                me demandent toujours où je l'ai trouvé. Un accessoire indispensable.</p>
                            <div class="testimonials__author">
                                <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/testimonials/3.jpg" alt="Camille Laurent"
                                    class="testimonials__avatar">
                                <div class="testimonials__author-info">
                                    <p class="testimonials__author-name">Camille Laurent</p>
                                    <p class="testimonials__author-role">Architecte d'intérieur</p>
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial 4 -->
                        <div class="testimonials__item">
                            <div class="testimonials__quote">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-quote">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M9 5a2 2 0 0 1 2 2v6c0 3.13 -1.65 5.193 -4.757 5.97a1 1 0 1 1 -.486 -1.94c2.227 -.557 3.243 -1.827 3.243 -4.03v-1h-3a2 2 0 0 1 -1.995 -1.85l-.005 -.15v-3a2 2 0 0 1 2 -2z" />
                                    <path
                                        d="M18 5a2 2 0 0 1 2 2v6c0 3.13 -1.65 5.193 -4.757 5.97a1 1 0 1 1 -.486 -1.94c2.227 -.557 3.243 -1.827 3.243 -4.03v-1h-3a2 2 0 0 1 -1.995 -1.85l-.005 -.15v-3a2 2 0 0 1 2 -2z" />
                                </svg>
                            </div>
                            <div class="testimonials__stars">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-star"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" /></svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-star"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" /></svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-star"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" /></svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-star"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" /></svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-star"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" /></svg>
                            </div>
                            <p class="testimonials__text">La batterie tient vraiment ses promesses. Je recharge mon
                                téléphone en déplacement sans problème. Qualité au rendez-vous.</p>
                            <div class="testimonials__author">
                                <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/testimonials/4.jpg" alt="Léa Bernard"
                                    class="testimonials__avatar">
                                <div class="testimonials__author-info">
                                    <p class="testimonials__author-name">Léa Bernard</p>
                                    <p class="testimonials__author-role">Entrepreneuse</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slider Navigation Buttons -->
                <div class="testimonials__nav-wrapper">
                    <button class="testimonials__nav testimonials__nav--prev is-disabled" aria-label="Précédent">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                    </button>
                    <button class="testimonials__nav testimonials__nav--next" aria-label="Suivant">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                    </button>
                </div>
            </div>
        </section>

        <!-- ========================================
            COMPARISON SECTION
        ======================================== -->
        <section class="comparison" id="comparison">
            <div class="container">
                <div class="comparison__header">
                    <h2 class="comparison__title">45€ pour 3 innovations en 1</h2>
                    <p class="comparison__subtitle">Trois essentiels réunis en un seul objet. Klipss coûte moins que l'addition.</p>
                </div>
                <div class="comparison__table-wrap">
                    <table class="comparison__table">
                        <thead>
                            <tr>
                                <th class="comparison__th--feature"></th>
                                <th class="comparison__th--klipss">Klipss<br><span>45€</span></th>
                                <th class="comparison__th--separate">Achat séparé<br><span>~95€</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Accroche-sac antirayures</td>
                                <td class="comparison__yes">✓</td>
                                <td class="comparison__price-cell">~15€</td>
                            </tr>
                            <tr>
                                <td>Batterie externe 3000mAh</td>
                                <td class="comparison__yes">✓</td>
                                <td class="comparison__price-cell">~25€</td>
                            </tr>
                            <tr>
                                <td>Charge sans fil Qi 7.5W</td>
                                <td class="comparison__yes">✓</td>
                                <td class="comparison__price-cell">~20€</td>
                            </tr>
                            <tr>
                                <td>Tracker Bluetooth 5.0</td>
                                <td class="comparison__yes">✓</td>
                                <td class="comparison__price-cell">~35€</td>
                            </tr>
                            <tr>
                                <td>Design joaillier · 4 coloris</td>
                                <td class="comparison__yes">✓</td>
                                <td class="comparison__no">—</td>
                            </tr>
                            <tr>
                                <td>Certifié CE · Acier inox recyclé</td>
                                <td class="comparison__yes">✓</td>
                                <td class="comparison__no">—</td>
                            </tr>
                            <tr class="comparison__total-row">
                                <td><strong>Total</strong></td>
                                <td class="comparison__total--klipss"><strong>45€</strong></td>
                                <td class="comparison__total--separate"><strong>~95€</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- ========================================
            TECH SPEC SECTION
        ======================================== -->
        <section class="tech-spec__section" id="specifications">
            <div class="container">
                <div class="tech-spec__header">
                    <h2 class="tech-spec__title">3 innovations.
                        1 accessoire. Aucun compromis.</h2>
                </div>

                <div class="tech-spec__content">
                    <ul class="tech-spec__list">
                        <li class="tech-spec__item">
                            <div class="tech-spec__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-battery-4">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M6 7h11a2 2 0 0 1 2 2v.5a.5 .5 0 0 0 .5 .5a.5 .5 0 0 1 .5 .5v3a.5 .5 0 0 1 -.5 .5a.5 .5 0 0 0 -.5 .5v.5a2 2 0 0 1 -2 2h-11a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2" />
                                    <path d="M7 10l0 4" />
                                    <path d="M10 10l0 4" />
                                    <path d="M13 10l0 4" />
                                    <path d="M16 10l0 4" />
                                </svg>
                            </div>

                            <p class="tech-spec__item__description">Batterie 3000mAh, jusqu'à 40% de recharge</p>

                            <div class="tech-spec__open-modal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                            </div>
                        </li>
                        <li class="tech-spec__item">
                            <div class="tech-spec__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-comet">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M15.5 18.5l-3 1.5l.5 -3.5l-2 -2l3 -.5l1.5 -3l1.5 3l3 .5l-2 2l.5 3.5l-3 -1.5" />
                                    <path d="M4 4l7 7" />
                                    <path d="M9 4l3.5 3.5" />
                                    <path d="M4 9l3.5 3.5" />
                                </svg>
                            </div>

                            <p class="tech-spec__item__description">Charge sans fil Qi 7.5W, posez votre téléphone et c'est chargé</p>

                            <div class="tech-spec__open-modal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                            </div>
                        </li>
                        <li class="tech-spec__item">
                            <div class="tech-spec__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="currentColor"
                                    class="icon icon-tabler icons-tabler-filled icon-tabler-shield-half">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M11.998 2l.032 .002l.086 .005a1 1 0 0 1 .342 .104l.105 .062l.097 .076l.016 .015l.247 .21a11 11 0 0 0 7.189 2.537l.342 -.01a1 1 0 0 1 1.005 .717a13 13 0 0 1 -9.208 16.25a1 1 0 0 1 -.502 0a13 13 0 0 1 -9.209 -16.25a1 1 0 0 1 1.005 -.717a11 11 0 0 0 7.791 -2.75l.046 -.036l.053 -.041a1 1 0 0 1 .217 -.112l.075 -.023l.036 -.01a1 1 0 0 1 .12 -.022l.086 -.005zm.002 2.296l-.176 .135a13 13 0 0 1 -7.288 2.572l-.264 .006l-.064 .31a11 11 0 0 0 1.064 7.175l.17 .314a11 11 0 0 0 6.49 5.136l.068 .019z" />
                                </svg>
                            </div>

                            <p class="tech-spec__item__description">Tracker Bluetooth 5.0, localisez votre sac en temps réel</p>

                            <div class="tech-spec__open-modal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                            </div>
                        </li>
                        <li class="tech-spec__item">
                            <div class="tech-spec__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-dimensions">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 5h11" />
                                    <path d="M12 7l2 -2l-2 -2" />
                                    <path d="M5 3l-2 2l2 2" />
                                    <path d="M19 10v11" />
                                    <path d="M17 19l2 2l2 -2" />
                                    <path d="M21 12l-2 -2l-2 2" />
                                    <path
                                        d="M3 12a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v7a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2l0 -7" />
                                </svg>
                            </div>

                            <p class="tech-spec__item__description">Accroche-sac antirayures, votre sac ne touche plus jamais le sol</p>

                            <div class="tech-spec__open-modal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                            </div>
                        </li>
                        <li class="tech-spec__item">
                            <div class="tech-spec__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-recycle">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 17l-2 2l2 2" />
                                    <path d="M10 19h9a2 2 0 0 0 1.75 -2.75l-.55 -1" />
                                    <path d="M8.536 11l-.732 -2.732l-2.732 .732" />
                                    <path d="M7.804 8.268l-4.5 7.794a2 2 0 0 0 1.506 2.89l1.141 .024" />
                                    <path d="M15.464 11l2.732 .732l.732 -2.732" />
                                    <path d="M18.196 11.732l-4.5 -7.794a2 2 0 0 0 -3.256 -.14l-.591 .976" />
                                </svg>
                            </div>

                            <p class="tech-spec__item__description">Acier inox recyclé, finition PVD joaillerie</p>

                            <div class="tech-spec__open-modal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                            </div>
                        </li>
                        <li class="tech-spec__item">
                            <div class="tech-spec__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-bag-edit">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M11 21h-2.426a3 3 0 0 1 -2.965 -2.544l-1.255 -8.152a2 2 0 0 1 1.977 -2.304h11.339a2 2 0 0 1 1.977 2.304l-.109 .707" />
                                    <path d="M9 11v-5a3 3 0 0 1 6 0v5" />
                                    <path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39" />
                                </svg>
                            </div>

                            <p class="tech-spec__item__description">Compatible Apple Find My et Google Find My Device</p>

                            <div class="tech-spec__open-modal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
        </section>

        <!-- ========================================
            CONFIGURATOR SECTION
        ======================================== -->
        <section class="configurator" id="configurator">
            <div class="container">
                <div class="configurator__header">
                    <h2 class="configurator__title">Créez votre Klipss</h2>
                </div>

                <div class="configurator__content">
                    <!-- Product Image -->
                    <div class="configurator__product">
                        <div class="configurator__product-label">Klipss</div>
                        <div class="configurator__product-image">
                            <div class="configurator__placeholder" id="configuratorPlaceholder">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z" opacity=".2"/><path d="M12 7a5 5 0 1 1 0 10A5 5 0 0 1 12 7z" opacity=".4"/></svg>
                                <p>Choisissez votre coloris</p>
                            </div>
                            <img src="" alt="Klipss" id="configuratorImage" style="display:none;">
                        </div>

                        <!-- Product Overview Accordion -->
                        <div class="configurator__overview">
                            <button class="configurator__overview-toggle" aria-expanded="false">
                                <span class="configurator__overview-title">Présentation du produit</span>
                                <svg class="configurator__overview-icon" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-down">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M6 9l6 6l6 -6" />
                                </svg>
                            </button>
                            <div class="configurator__overview-content">
                                <p class="configurator__overview-desc">
                                    Le bijou de sac connecté 3-en-1 : batterie 3000mAh, charge sans fil Qi 7.5W, Tracker Bluetooth 5.0, crochet d'accroche antirayures. Suspendu en permanence à l'anse de votre sac, en environ 150g. Choisissez votre coloris.
                                </p>
                            </div>
                        </div>

                    </div>

                    <!-- Options Panel -->
                    <div class="configurator__options">

                        <!-- Step 1 – Couleur -->
                        <div class="configurator__step" data-step="1">
                            <div class="configurator__step-header">
                                <span class="configurator__step-number">1</span>
                                <span class="configurator__step-title">Choisissez votre couleur</span>
                                <span class="configurator__step-check">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M3 8l4 4 6-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </span>
                            </div>
                            <div class="configurator__step-body">
                                <div class="configurator__styles">
                                    <button class="configurator__style-btn" data-style="1"
                                        data-image="<?php echo get_template_directory_uri(); ?>/assets/images/klipss/1-desktop.svg">
                                        <span class="configurator__style-color" style="background: linear-gradient(135deg, #FFB6C1 0%, #FF69B4 50%, #FFD700 100%);"></span>
                                        <span class="configurator__style-name">Rose</span>
                                    </button>
                                    <button class="configurator__style-btn" data-style="2"
                                        data-image="<?php echo get_template_directory_uri(); ?>/assets/images/klipss/2-desktop.svg">
                                        <span class="configurator__style-color" style="background: linear-gradient(135deg, #5C3317 0%, #8B5A2B 50%, #A0522D 100%);"></span>
                                        <span class="configurator__style-name">Cuir Marron</span>
                                    </button>
                                    <button class="configurator__style-btn" data-style="3"
                                        data-image="<?php echo get_template_directory_uri(); ?>/assets/images/klipss/3-desktop.svg">
                                        <span class="configurator__style-color" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 50%, #DEB887 100%);"></span>
                                        <span class="configurator__style-name">Bois</span>
                                    </button>
                                    <button class="configurator__style-btn" data-style="4"
                                        data-image="<?php echo get_template_directory_uri(); ?>/assets/images/klipss/4-desktop.svg">
                                        <span class="configurator__style-color" style="background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 50%, #1a1a1a 100%);"></span>
                                        <span class="configurator__style-name">Noir Mat</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2 – Pré-commander -->
                        <div class="configurator__step is-locked" data-step="2">
                            <div class="configurator__step-header">
                                <span class="configurator__step-number">2</span>
                                <span class="configurator__step-title">Pré-commander</span>
                                <span class="configurator__step-check">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M3 8l4 4 6-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </span>
                            </div>
                            <div class="configurator__step-body">
                                <div class="configurator__pricing">
                                    <div class="configurator__price-details">
                                        <div class="configurator__price-row">
                                            <span class="configurator__price-label">Klipss 3-en-1</span>
                                            <span class="configurator__price-item">45€</span>
                                        </div>
                                        <div class="configurator__price-row">
                                            <span class="configurator__price-label">Livraison</span>
                                            <span class="configurator__price-item configurator__price-item--free">Gratuite</span>
                                        </div>
                                    </div>
                                    <div class="configurator__price-total">
                                        <span class="configurator__price-total-label">Total</span>
                                        <span class="configurator__price-total-value" id="configuratorTotal">45€</span>
                                    </div>
                                    <button class="configurator__buy-btn" id="configuratorBuyBtn" disabled>
                                        Pré-commander
                                    </button>
                                    <div class="configurator__trust">
                                        <span class="configurator__trust-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                            Paiement sécurisé SSL
                                        </span>
                                        <span class="configurator__trust-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                                            Garantie 2 ans
                                        </span>
                                        <span class="configurator__trust-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 3 4 7l4 4"/><path d="M4 7h16"/><path d="m16 21 4-4-4-4"/><path d="M20 17H4"/></svg>
                                            30 jours satisfaite ou remboursée
                                        </span>
                                        <div class="configurator__cards">
                                            <span class="configurator__card configurator__card--visa">VISA</span>
                                            <span class="configurator__card configurator__card--mc">
                                                <span class="configurator__card-mc-left"></span>
                                                <span class="configurator__card-mc-right"></span>
                                            </span>
                                            <span class="configurator__card configurator__card--cb">CB</span>
                                            <span class="configurator__card configurator__card--amex">AMEX</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- What's in the Box -->
                <div class="configurator__box-content">
                    <h3 class="configurator__box-title">Contenu de la boîte</h3>
                    <ul class="configurator__box-list">
                        <li class="configurator__box-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            Klipss dans le style choisi
                        </li>
                        <li class="configurator__box-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            Câble de charge USB-C
                        </li>
                        <li class="configurator__box-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            Guide de démarrage rapide
                        </li>
                        <li class="configurator__box-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            Pochette de protection
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- ========================================
            SECTION DETAILS
        ======================================== -->
        <section class="details__section" id="details">
            <div class="container">
                <div class="details__header">
                    <h2 class="details__title">Commandez en toute sérénité</h2>
                    <p class="details__subtitle">
                        Livraison gratuite, retours sans frais, garantie 2 ans. L'exigence Klipss ne s'arrête pas au produit.
                    </p>
                </div>

                <div class="details__content">
                    <ul class="details__list">
                        <li class="details__item">
                            <div class="details__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-truck">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    <path d="M5 17h-2v-11a1 1 0 0 1 1 -1h9v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5" />
                                </svg>
                            </div>
                            <div class="details__item__text">
                                <h3 class="details__item__title">Livraison gratuite</h3>
                                <p class="details__item__description">Expédié sous 24h, livré en 3 à 5 jours ouvrés partout en France.</p>
                            </div>
                        </li>
                        <li class="details__item">
                            <div class="details__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-boxes-icon lucide-boxes">
                                    <path
                                        d="M2.97 12.92A2 2 0 0 0 2 14.63v3.24a2 2 0 0 0 .97 1.71l3 1.8a2 2 0 0 0 2.06 0L12 19v-5.5l-5-3-4.03 2.42Z" />
                                    <path d="m7 16.5-4.74-2.85" />
                                    <path d="m7 16.5 5-3" />
                                    <path d="M7 16.5v5.17" />
                                    <path
                                        d="M12 13.5V19l3.97 2.38a2 2 0 0 0 2.06 0l3-1.8a2 2 0 0 0 .97-1.71v-3.24a2 2 0 0 0-.97-1.71L17 10.5l-5 3Z" />
                                    <path d="m17 16.5-5-3" />
                                    <path d="m17 16.5 4.74-2.85" />
                                    <path d="M17 16.5v5.17" />
                                    <path
                                        d="M7.97 4.42A2 2 0 0 0 7 6.13v4.37l5 3 5-3V6.13a2 2 0 0 0-.97-1.71l-3-1.8a2 2 0 0 0-2.06 0l-3 1.8Z" />
                                    <path d="M12 8 7.26 5.15" />
                                    <path d="m12 8 4.74-2.85" />
                                    <path d="M12 13.5V8" />
                                </svg>
                            </div>
                            <div class="details__item__text">
                                <h3 class="details__item__title">Retrait en Point Relais</h3>
                                <p class="details__item__description">Disponible en point relais partout en France métropolitaine.</p>
                            </div>
                        </li>
                        <li class="details__item">
                            <div class="details__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="lucide lucide-arrow-left-right-icon lucide-arrow-left-right">
                                    <path d="M8 3 4 7l4 4" />
                                    <path d="M4 7h16" />
                                    <path d="m16 21 4-4-4-4" />
                                    <path d="M20 17H4" />
                                </svg>
                            </div>
                            <div class="details__item__text">
                                <h3 class="details__item__title">Satisfaite ou Remboursée</h3>
                                <p class="details__item__description">30 jours pour changer d'avis. Retour sans frais, remboursement sous 14 jours.</p>
                            </div>
                        </li>
                        <li class="details__item">
                            <div class="details__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                </svg>
                            </div>
                            <div class="details__item__text">
                                <h3 class="details__item__title">Certifié CE · Garantie 2 ans</h3>
                                <p class="details__item__description">Conforme aux normes européennes de sécurité. Couverture complète contre tout défaut de fabrication.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- ========================================
            FAQ SECTION
        ======================================== -->
        <section class="faq__section" id="faq">
            <div class="container">
                <div class="faq__header">
                    <h2 class="faq__title">Questions fréquentes</h2>
                </div>

                <div class="faq__content">
                    <div class="faq__list">
                        <div class="faq__item">
                            <button class="faq__question" aria-expanded="false">
                                <span class="faq__question-text">Comment fonctionne la livraison ?</span>
                                <div class="faq__toggle">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg>
                                </div>
                            </button>
                            <div class="faq__answer">
                                <p>Nous livrons dans toute la France métropolitaine sous 3 à 5 jours ouvrés. La livraison est gratuite.</p>
                            </div>
                        </div>
                        <div class="faq__item">
                            <button class="faq__question" aria-expanded="false">
                                <span class="faq__question-text">Quelle est la politique de retour ?</span>
                                <div class="faq__toggle">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg>
                                </div>
                            </button>
                            <div class="faq__answer">
                                <p>Vous disposez de 30 jours après réception pour retourner votre Klipss. Le produit doit être dans son état d'origine et dans son emballage. Le remboursement est effectué sous 14 jours après réception du retour.</p>
                            </div>
                        </div>
                        <div class="faq__item">
                            <button class="faq__question" aria-expanded="false">
                                <span class="faq__question-text">Quelle est l'autonomie de la batterie ?</span>
                                <div class="faq__toggle">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg>
                                </div>
                            </button>
                            <div class="faq__answer">
                                <p>La batterie 3000mAh de Klipss permet de recharger votre smartphone jusqu'à 40%. En mode tracking seul, l'autonomie atteint jusqu'à 30 jours. La batterie se recharge via USB-C en environ 2 heures.</p>
                            </div>
                        </div>
                        <div class="faq__item">
                            <button class="faq__question" aria-expanded="false">
                                <span class="faq__question-text">Comment configurer le tracker ?</span>
                                <div class="faq__toggle">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg>
                                </div>
                            </button>
                            <div class="faq__answer">
                                <p>Activez le Bluetooth sur votre smartphone, puis ajoutez Klipss dans Apple Find My (iOS) ou Google Find My Device (Android). Suivez les instructions de l'app native pour appairer votre Klipss. La configuration prend moins de 2 minutes.</p>
                            </div>
                        </div>
                        <div class="faq__item">
                            <button class="faq__question" aria-expanded="false">
                                <span class="faq__question-text">Le Klipss est-il garanti ?</span>
                                <div class="faq__toggle">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg>
                                </div>
                            </button>
                            <div class="faq__answer">
                                <p>Oui, le Klipss bénéficie d'une garantie de 2 ans couvrant tous les défauts de fabrication. Notre service client est disponible pour vous accompagner en cas de problème.</p>
                            </div>
                        </div>
                        <div class="faq__item">
                            <button class="faq__question" aria-expanded="false">
                                <span class="faq__question-text">Quels sont les délais de livraison ?</span>
                                <div class="faq__toggle">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg>
                                </div>
                            </button>
                            <div class="faq__answer">
                                <p>Klipss est en pré-commande. Les premières expéditions sont prévues dès la production lancée. Vous recevrez un email de confirmation avec le suivi de votre commande dès l'expédition.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="faq__cta">
                    <p class="faq__cta-text">Une autre question ? <a href="mailto:contact@klipss.fr" class="faq__cta-link">Contactez-nous</a></p>
                </div>
            </div>
        </section>

    </main>

    <!-- ========================================
        TECH SPEC MODALS
    ======================================== -->

    <!-- Modal 1: Batterie -->
    <div class="tech-modal" id="modal-battery">
        <div class="tech-modal__overlay"></div>
        <div class="tech-modal__content">
            <button class="tech-modal__close" aria-label="Close modal">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6L6 18" />
                    <path d="M6 6l12 12" />
                </svg>
            </button>
            <h3 class="tech-modal__title">Batterie 3000mAh, jusqu'à 40% de recharge</h3>
            <p class="tech-modal__description">
                La batterie lithium-polymère de 3000mAh intégrée dans Klipss vous offre jusqu'à 40% de recharge pour votre smartphone. Compatible avec tous les smartphones. La batterie se recharge via USB-C en environ 2 heures. Des indicateurs LED discrets vous signalent le niveau de charge restant. Plus besoin de chercher une prise en déplacement.
            </p>
        </div>
    </div>

    <!-- Modal 2: Chargeur sans fil -->
    <div class="tech-modal" id="modal-wireless">
        <div class="tech-modal__overlay"></div>
        <div class="tech-modal__content">
            <button class="tech-modal__close" aria-label="Close modal">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6L6 18" />
                    <path d="M6 6l12 12" />
                </svg>
            </button>
            <h3 class="tech-modal__title">Charge sans fil Qi 7.5W, compatible tous smartphones</h3>
            <p class="tech-modal__description">
                Le module de charge sans fil Qi 7.5W est compatible avec tous les smartphones certifiés Qi (iPhone 8+, Android compatible Qi). Posez simplement votre téléphone sur la surface de charge de Klipss, sans câble ni manipulation. La détection intelligente s'adapte automatiquement à la puissance optimale de votre appareil.
            </p>
        </div>
    </div>

    <!-- Modal 3: GPS/Bluetooth -->
    <div class="tech-modal" id="modal-gps">
        <div class="tech-modal__overlay"></div>
        <div class="tech-modal__content">
            <button class="tech-modal__close" aria-label="Close modal">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6L6 18" />
                    <path d="M6 6l12 12" />
                </svg>
            </button>
            <h3 class="tech-modal__title">Tracker Bluetooth 5.0, votre sac toujours localisé</h3>
            <p class="tech-modal__description">
                Ne perdez plus jamais votre sac à main. Le tracker Bluetooth 5.0 de Klipss localise votre accessoire en temps réel via Apple Find My (iOS) et Google Find My Device (Android). Recevez une alerte instantanée dès que vous vous éloignez au-delà d'une distance que vous paramétrez vous-même. Portée Bluetooth de 10 à 30 mètres en direct, étendue par les réseaux maillés Apple Find My et Google Find My Device pour une couverture mondiale. Consultez l'historique complet des déplacements directement depuis votre smartphone.
            </p>
        </div>
    </div>

    <!-- Modal 4: Poids et dimensions -->
    <div class="tech-modal" id="modal-dimensions">
        <div class="tech-modal__overlay"></div>
        <div class="tech-modal__content">
            <button class="tech-modal__close" aria-label="Close modal">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6L6 18" />
                    <path d="M6 6l12 12" />
                </svg>
            </button>
            <h3 class="tech-modal__title">Accroche-sac antirayures, votre sac suspendu en un geste</h3>
            <p class="tech-modal__description">
                Le système d'accroche de Klipss se fixe en quelques secondes sur le rebord d'une table, d'un bar ou d'un bureau. Le revêtement antirayures protège toutes les surfaces, même les plus délicates. Testé pour supporter plus de 20 kg, il maintient votre sac stable et à portée de main sans jamais le poser au sol. Compact et léger, il s'oublie dans votre sac et se sort quand vous en avez besoin.
            </p>
        </div>
    </div>

    <!-- Modal 5: Matériaux recyclés -->
    <div class="tech-modal" id="modal-eco">
        <div class="tech-modal__overlay"></div>
        <div class="tech-modal__content">
            <button class="tech-modal__close" aria-label="Close modal">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6L6 18" />
                    <path d="M6 6l12 12" />
                </svg>
            </button>
            <h3 class="tech-modal__title">Acier inoxydable recyclé et finitions nobles</h3>
            <p class="tech-modal__description">
                Le boîtier de Klipss est fabriqué en acier inoxydable recyclé, traité en surface par procédé PVD (Physical Vapour Deposition), le même utilisé en joaillerie pour une finition durable, résistante aux rayures et sans oxydation. Selon le coloris, l'acier brossé s'associe à un gainage cuir véritable (Cuir Marron), à un placage bois (Bois) ou à un revêtement laqué mat (Noir Mat). Le coloris Rose joue la carte de l'acier brossé pur. L'emballage est 100% recyclable, composé de carton FSC sans plastique superflu. Choisir Klipss, c'est choisir un accessoire responsable, sans compromis sur la qualité ni sur l'impact.
            </p>
        </div>
    </div>

    <!-- Modal 6: Application -->
    <div class="tech-modal" id="modal-app">
        <div class="tech-modal__overlay"></div>
        <div class="tech-modal__content">
            <button class="tech-modal__close" aria-label="Close modal">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6L6 18" />
                    <path d="M6 6l12 12" />
                </svg>
            </button>
            <h3 class="tech-modal__title">Compatible Apple Find My et Google Find My Device</h3>
            <p class="tech-modal__description">
                Klipss fonctionne avec les applications natives de votre smartphone : Apple Find My sur iOS et Google Find My Device sur Android.
                Localisez votre sac en temps réel, configurez les alertes de distance et recevez des notifications instantanées.
                Aucune application supplémentaire à télécharger, aucun abonnement requis.
                Le tracker Bluetooth 5.0 s'appuie sur les réseaux maillés Find My et Google Find My Device pour une couverture étendue.
                Portée directe de 10 à 30 mètres en espace ouvert, étendue par les réseaux maillés Apple Find My et Google Find My Device pour une couverture mondiale.
            </p>
        </div>
    </div>

    <!-- ========================================
        FAQ MODALS
    ======================================== -->

    <!-- FAQ Modal 1: Livraison -->
    <div class="tech-modal" id="faq-modal-0">
        <div class="tech-modal__overlay"></div>
        <div class="tech-modal__content">
            <button class="tech-modal__close" aria-label="Close modal">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6L6 18" />
                    <path d="M6 6l12 12" />
                </svg>
            </button>
            <h3 class="tech-modal__title">Comment fonctionne la livraison ?</h3>
            <p class="tech-modal__description">
                Nous livrons partout en France métropolitaine.
                Une fois votre commande passée, vous recevrez un email de confirmation avec un numéro de suivi.
                La livraison est assurée par Colissimo ou Chronopost selon l'option choisie.
                Vous pouvez également opter pour un retrait en point relais près de chez vous.
                La livraison est gratuite pour tous les Klipss.
            </p>
        </div>
    </div>

    <!-- FAQ Modal 2: Retour -->
    <div class="tech-modal" id="faq-modal-1">
        <div class="tech-modal__overlay"></div>
        <div class="tech-modal__content">
            <button class="tech-modal__close" aria-label="Close modal">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6L6 18" />
                    <path d="M6 6l12 12" />
                </svg>
            </button>
            <h3 class="tech-modal__title">Quelle est la politique de retour ?</h3>
            <p class="tech-modal__description">
                Vous disposez de 30 jours après réception pour retourner votre Klipss.
                Le produit doit être retourné dans son emballage d'origine et en parfait état.
                Le retour est sans frais. Nous vous envoyons l'étiquette de retour par email.
                Le remboursement est effectué sous 14 jours après réception du retour.
            </p>
        </div>
    </div>

    <!-- FAQ Modal 3: Autonomie -->
    <div class="tech-modal" id="faq-modal-2">
        <div class="tech-modal__overlay"></div>
        <div class="tech-modal__content">
            <button class="tech-modal__close" aria-label="Close modal">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6L6 18" />
                    <path d="M6 6l12 12" />
                </svg>
            </button>
            <h3 class="tech-modal__title">Quelle est l'autonomie de la batterie ?</h3>
            <p class="tech-modal__description">
                La batterie intégrée de 3000mAh offre jusqu'à 30 jours d'autonomie en mode tracking.
                En utilisation intensive (charge sans fil + tracker), l'autonomie est d'environ 7 jours.
                La recharge complète du Klipss prend environ 2 heures via USB-C.
                Un indicateur LED vous permet de connaître le niveau de batterie restant.
            </p>
        </div>
    </div>

    <!-- FAQ Modal 4: Application -->
    <div class="tech-modal" id="faq-modal-3">
        <div class="tech-modal__overlay"></div>
        <div class="tech-modal__content">
            <button class="tech-modal__close" aria-label="Close modal">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6L6 18" />
                    <path d="M6 6l12 12" />
                </svg>
            </button>
            <h3 class="tech-modal__title">Comment configurer le tracker ?</h3>
            <p class="tech-modal__description">
                Activez le Bluetooth sur votre smartphone et ouvrez Apple Find My (iOS) ou Google Find My Device (Android).
                Appuyez sur le bouton de votre Klipss pendant 3 secondes pour l'activer.
                L'app native détectera automatiquement votre Klipss et vous guidera pour la configuration.
                Vous pourrez ensuite personnaliser les alertes de distance et les notifications.
                Aucun compte supplémentaire à créer, aucun abonnement requis.
            </p>
        </div>
    </div>

    <!-- FAQ Modal 5: Garantie -->
    <div class="tech-modal" id="faq-modal-4">
        <div class="tech-modal__overlay"></div>
        <div class="tech-modal__content">
            <button class="tech-modal__close" aria-label="Close modal">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6L6 18" />
                    <path d="M6 6l12 12" />
                </svg>
            </button>
            <h3 class="tech-modal__title">Le Klipss est-il garanti ?</h3>
            <p class="tech-modal__description">
                Tous nos produits bénéficient d'une garantie constructeur de 2 ans.
                Cette garantie couvre tous les défauts de fabrication et les dysfonctionnements.
                En cas de problème, contactez notre service client avec votre numéro de commande.
                Nous vous enverrons un produit de remplacement ou procéderons au remboursement.
                La garantie ne couvre pas les dommages causés par une mauvaise utilisation.
            </p>
        </div>
    </div>

    <!-- FAQ Modal 6: Délais -->
    <div class="tech-modal" id="faq-modal-5">
        <div class="tech-modal__overlay"></div>
        <div class="tech-modal__content">
            <button class="tech-modal__close" aria-label="Close modal">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6L6 18" />
                    <path d="M6 6l12 12" />
                </svg>
            </button>
            <h3 class="tech-modal__title">Quels sont les délais de livraison ?</h3>
            <p class="tech-modal__description">
                Les commandes sont expédiées sous 24 à 48h ouvrées.
                La livraison standard (Colissimo) prend 3 à 5 jours ouvrés.
                La livraison express (Chronopost) est disponible en 24h pour les commandes passées avant 14h.
                Le retrait en point relais prend généralement 3 à 5 jours ouvrés.
                Vous recevrez un email avec le numéro de suivi dès l'expédition de votre colis.
            </p>
        </div>
    </div>

    <!-- ========================================
        FEATURES VIDEO MODAL
    ======================================== -->
    <div class="features-video-modal" id="featuresVideoModal">
        <div class="features-video-modal__overlay"></div>
        <div class="features-video-modal__content">
            <button class="features-video-modal__close" aria-label="Close modal">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6L6 18" />
                    <path d="M6 6l12 12" />
                </svg>
            </button>
            <div class="features-video-modal__video-wrapper">
                <video id="featuresVideoPlayer" controls preload="none">
                    <source src="<?php echo get_template_directory_uri(); ?>/assets/videos/klipss-pub.mp4" type="video/mp4">
                    Votre navigateur ne supporte pas la lecture de vidéos.
                </video>
            </div>
        </div>
    </div>

    <!-- ========================================
        PAYMENT MODAL (2 étapes)
    ======================================== -->
    <div class="payment-modal" id="paymentModal" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="paymentModalTitle">
        <div class="payment-modal__overlay" id="paymentModalOverlay"></div>
        <div class="payment-modal__content">

            <button class="payment-modal__close" id="paymentModalClose" aria-label="Fermer">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6L6 18"/><path d="M6 6l12 12"/>
                </svg>
            </button>

            <!-- En-tête avec indicateur d'étapes -->
            <div class="payment-modal__header">
                <h3 class="payment-modal__title" id="paymentModalTitle">Finaliser votre commande</h3>
                <div class="payment-modal__summary" id="paymentModalSummary"></div>
                <div class="payment-modal__steps">
                    <div class="payment-modal__step is-active" id="modalStepIndicator1">
                        <span class="payment-modal__step-num">1</span>
                        <span class="payment-modal__step-label">Livraison</span>
                    </div>
                    <div class="payment-modal__step-sep"></div>
                    <div class="payment-modal__step" id="modalStepIndicator2">
                        <span class="payment-modal__step-num">2</span>
                        <span class="payment-modal__step-label">Paiement</span>
                    </div>
                </div>
            </div>

            <!-- ÉTAPE 1 — Informations de livraison -->
            <div class="payment-modal__body" id="paymentStep1">

                <?php if (!is_user_logged_in()): ?>
                <div class="payment-modal__login-hint">
                    <p>Déjà client ? <button type="button" class="payment-modal__link-btn" id="modalShowLogin">Connectez-vous</button> pour pré-remplir vos informations.</p>
                </div>
                <?php endif; ?>

                <div class="payment-modal__row">
                    <div class="payment-modal__field">
                        <label class="payment-modal__label" for="shipFirstName">Prénom</label>
                        <input class="payment-modal__input" type="text" id="shipFirstName" name="first_name"
                            placeholder="Marie" autocomplete="given-name" required>
                    </div>
                    <div class="payment-modal__field">
                        <label class="payment-modal__label" for="shipLastName">Nom</label>
                        <input class="payment-modal__input" type="text" id="shipLastName" name="last_name"
                            placeholder="Dupont" autocomplete="family-name" required>
                    </div>
                </div>

                <div class="payment-modal__field">
                    <label class="payment-modal__label" for="shipEmail">Adresse email</label>
                    <input class="payment-modal__input" type="email" id="shipEmail" name="email"
                        placeholder="vous@exemple.fr" autocomplete="email" required>
                </div>

                <div class="payment-modal__field">
                    <label class="payment-modal__label" for="shipPhone">Téléphone <span class="payment-modal__optional">(optionnel)</span></label>
                    <input class="payment-modal__input" type="tel" id="shipPhone" name="phone"
                        placeholder="+33 6 00 00 00 00" autocomplete="tel">
                </div>

                <div class="payment-modal__field">
                    <label class="payment-modal__label" for="shipAddress">Adresse</label>
                    <input class="payment-modal__input" type="text" id="shipAddress" name="address"
                        placeholder="12 rue de la Paix" autocomplete="street-address" required>
                </div>

                <div class="payment-modal__row">
                    <div class="payment-modal__field payment-modal__field--zip">
                        <label class="payment-modal__label" for="shipZip">Code postal</label>
                        <input class="payment-modal__input" type="text" id="shipZip" name="zip"
                            placeholder="75001" autocomplete="postal-code" required>
                    </div>
                    <div class="payment-modal__field">
                        <label class="payment-modal__label" for="shipCity">Ville</label>
                        <input class="payment-modal__input" type="text" id="shipCity" name="city"
                            placeholder="Paris" autocomplete="address-level2" required>
                    </div>
                </div>

                <div class="payment-modal__field">
                    <label class="payment-modal__label" for="shipCountry">Pays</label>
                    <select class="payment-modal__input payment-modal__select" id="shipCountry" name="country" autocomplete="country-name">
                        <option value="France" selected>France</option>
                        <option value="Belgique">Belgique</option>
                        <option value="Suisse">Suisse</option>
                        <option value="Luxembourg">Luxembourg</option>
                        <option value="Canada">Canada</option>
                    </select>
                </div>

                <?php if (!is_user_logged_in()): ?>
                <div class="payment-modal__field payment-modal__checkbox-field">
                    <label class="payment-modal__checkbox-label">
                        <input type="checkbox" id="shipCreateAccount" name="create_account">
                        <span>Créer un compte pour suivre mes commandes</span>
                    </label>
                </div>
                <div class="payment-modal__field" id="shipPasswordField" style="display:none;">
                    <label class="payment-modal__label" for="shipPassword">Choisir un mot de passe</label>
                    <input class="payment-modal__input" type="password" id="shipPassword" name="password"
                        placeholder="8 caractères minimum" autocomplete="new-password">
                </div>
                <?php endif; ?>

                <!-- Erreur étape 1 -->
                <p id="step1Error" class="stripe-error" style="display:none;"></p>

                <button class="payment-modal__pay-btn" id="step1NextBtn" type="button">
                    Continuer vers le paiement →
                </button>
            </div>

            <!-- ÉTAPE 2 — Paiement Stripe -->
            <div class="payment-modal__body" id="paymentStep2" style="display:none;">

                <button type="button" class="payment-modal__back-btn" id="paymentStep2Back">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
                    Modifier la livraison
                </button>

                <!-- Récap adresse -->
                <div class="payment-modal__shipping-recap" id="shippingRecap"></div>

                <!-- Stripe Payment Element -->
                <div id="stripePaymentElement"></div>

                <!-- Erreur -->
                <p id="stripeError" class="stripe-error" style="display:none;"></p>

                <!-- Bouton payer -->
                <button class="payment-modal__pay-btn" id="stripePayBtn" type="button" disabled>
                    Chargement…
                </button>

                <p class="payment-modal__secure">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    Paiement sécurisé par Stripe · SSL 256-bit
                </p>
            </div>

        </div>
    </div>

    <!-- ========================================
        STICKY BAR
    ======================================== -->
    <div class="sticky-bar" id="stickyBar" aria-hidden="true">
        <div class="container">
            <div class="sticky-bar__content">
                <div class="sticky-bar__info">
                    <span class="sticky-bar__name">Klipss</span>
                    <span class="sticky-bar__tagline">Le bijou de sac connecté 3-en-1</span>
                </div>
                <div class="sticky-bar__right">
                    <span class="sticky-bar__price">À partir de 45€</span>
                    <a href="#configurator" class="sticky-bar__btn">Pré-commander</a>
                </div>
            </div>
        </div>
    </div>

    <?php get_footer(); ?>