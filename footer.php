<!-- ========================================
        FOOTER
    ======================================== -->
    <?php $socials = klipss_get_socials(); ?>
    <footer>
        <div class="container">

            <!-- ── 4 colonnes ─────────────────────────────── -->
            <div class="footer__grid">

                <!-- Colonne brand -->
                <div class="footer__col footer__col--brand">
                    <a href="<?php echo esc_url( home_url('/') ); ?>" class="footer__logo-link">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg"
                             alt="Klipss" class="footer__logo-img">
                    </a>
                    <p class="footer__tagline">L'accroche-sac connecté 3-en-1.</p>
                    <?php if ( $socials ) : ?>
                    <div class="footer__socials">
                        <?php foreach ( $socials as $s ) : ?>
                        <a href="<?php echo esc_url( $s['url'] ); ?>" class="footer__social-link"
                           aria-label="<?php echo esc_attr( $s['label'] ); ?>"
                           target="_blank" rel="noopener noreferrer">
                            <?php echo klipss_svg_icon( $s['icon'] ); ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Colonne navigation -->
                <div class="footer__col">
                    <h4 class="footer__col-title">Navigation</h4>
                    <?php wp_nav_menu( array(
                        'theme_location' => 'footer',
                        'container'      => false,
                        'menu_class'     => 'footer__links',
                        'link_before'    => '',
                        'link_after'     => '',
                    ) ); ?>
                </div>

                <!-- Colonne légal -->
                <div class="footer__col">
                    <h4 class="footer__col-title">Légal</h4>
                    <?php wp_nav_menu( array(
                        'theme_location' => 'footer_legal',
                        'container'      => false,
                        'menu_class'     => 'footer__links',
                        'fallback_cb'    => false,
                    ) ); ?>
                    <ul class="footer__links">
                        <li><button type="button" class="footer__cookie-btn js-cookie-settings">Gérer mes cookies</button></li>
                    </ul>
                </div>

                <!-- Colonne contact -->
                <div class="footer__col">
                    <h4 class="footer__col-title">Contact</h4>
                    <ul class="footer__links">
                        <li>
                            <a href="mailto:contact@klipss.fr" class="footer__contact-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                                contact@klipss.fr
                            </a>
                        </li>
                        <li>
                            <span class="footer__contact-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                Perpignan, France
                            </span>
                        </li>
                    </ul>
                </div>

            </div>

            <!-- ── Newsletter ──────────────────────────────── -->
            <div class="footer__newsletter">
                <div class="footer__newsletter-text">
                    <h4 class="footer__newsletter-title">Restez informé</h4>
                    <p class="footer__newsletter-desc">Nouveautés, offres exclusives et conseils style — directement dans votre boîte mail.</p>
                </div>
                <div class="footer__newsletter-form-wrapper">
                    <form class="footer__newsletter-form" id="newsletterForm">
                        <input type="email" name="newsletter_email" id="newsletterEmail"
                               class="footer__newsletter-input"
                               placeholder="Votre adresse e-mail"
                               required autocomplete="email">
                        <button type="submit" class="footer__newsletter-btn" id="newsletterBtn">S'inscrire</button>
                    </form>
                    <label class="footer__newsletter-consent">
                        <input type="checkbox" id="newsletterConsent" name="newsletter_consent" required>
                        <span>J'accepte de recevoir la newsletter de KLIPSS. Désinscription possible à tout moment.
                            <a href="<?php echo esc_url( home_url('/politique-de-confidentialite/') ); ?>">En savoir plus</a>.</span>
                    </label>
                    <p class="footer__newsletter-error" id="newsletterError"></p>
                </div>

                <!-- Modale confirmation newsletter -->
                <div class="nl-modal" id="newsletterModal" aria-hidden="true">
                    <div class="nl-modal__overlay" id="newsletterModalOverlay"></div>
                    <div class="nl-modal__box">
                        <button class="nl-modal__close" id="newsletterModalClose" aria-label="Fermer">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18"/><path d="M6 6l12 12"/></svg>
                        </button>
                        <svg class="nl-modal__icon" xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="#2a9659" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        <h3 class="nl-modal__title">Bienvenue !</h3>
                        <p class="nl-modal__msg" id="newsletterModalMsg"></p>
                    </div>
                </div>

                <script>
                (function() {
                    const form  = document.getElementById('newsletterForm');
                    const modal = document.getElementById('newsletterModal');
                    if (!form || !modal) return;

                    const btn      = document.getElementById('newsletterBtn');
                    const errorEl  = document.getElementById('newsletterError');
                    const modalMsg = document.getElementById('newsletterModalMsg');

                    function openModal(msg) {
                        modalMsg.textContent = msg;
                        modal.classList.add('is-open');
                        modal.setAttribute('aria-hidden', 'false');
                        document.body.style.overflow = 'hidden';
                    }
                    function closeModal() {
                        modal.classList.remove('is-open');
                        modal.setAttribute('aria-hidden', 'true');
                        document.body.style.overflow = '';
                    }
                    document.getElementById('newsletterModalClose')?.addEventListener('click', closeModal);
                    document.getElementById('newsletterModalOverlay')?.addEventListener('click', closeModal);
                    document.addEventListener('keydown', function(e) { if (e.key === 'Escape' && modal.classList.contains('is-open')) closeModal(); });

                    form.addEventListener('submit', async function(e) {
                        e.preventDefault();
                        const email   = document.getElementById('newsletterEmail')?.value;
                        const consent = document.getElementById('newsletterConsent');
                        if (!email) return;
                        if (consent && !consent.checked) {
                            errorEl.textContent = 'Veuillez cocher la case pour accepter de recevoir nos communications.';
                            errorEl.style.display = 'block';
                            return;
                        }

                        btn.disabled = true; btn.textContent = 'Envoi…';
                        errorEl.style.display = 'none';

                        try {
                            const res = await fetch(klipss_stripe.ajax_url, {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                                body: new URLSearchParams({ action: 'klipss_newsletter_subscribe', nonce: klipss_stripe.nonce_newsletter, email, consent: '1' }),
                            });
                            const data = await res.json();

                            if (data.success) {
                                document.getElementById('newsletterEmail').value = '';
                                openModal(data.data?.message || 'Merci pour votre inscription !');
                            } else {
                                errorEl.textContent = data.data?.message || 'Une erreur est survenue.';
                                errorEl.style.display = 'block';
                            }
                        } catch {
                            errorEl.textContent = 'Erreur réseau. Veuillez réessayer.';
                            errorEl.style.display = '';
                        }
                        btn.disabled = false; btn.textContent = "S'inscrire";
                    });
                })();
                </script>
            </div>

            <!-- ── Barre du bas ────────────────────────────── -->
            <div class="footer__bottom">
                <p class="footer__copyright">&copy; <?php echo date('Y'); ?> Klipss. Tous droits réservés.</p>
            </div>

        </div>
    </footer>

    <?php if ( function_exists('klipss_render_cookie_banner') ) klipss_render_cookie_banner(); ?>

    <?php wp_footer(); ?>
</body>

</html>
