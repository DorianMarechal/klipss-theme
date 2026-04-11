/**
 * Navigation Module
 * Handles mobile menu toggle and header scroll effects
 */

export function init() {
    initMobileMenu();
    initHeaderScroll();
}

/**
 * Mobile menu toggle functionality
 */
function initMobileMenu() {
    const menuToggle = document.querySelector('.header__hamburger');
    const navigation = document.querySelector('.header__menu');

    if (!menuToggle || !navigation) return;

    menuToggle.addEventListener('click', () => {
        menuToggle.classList.toggle('is-active');
        navigation.classList.toggle('is-active');
    });

    // Close menu when clicking on a link
    const navLinks = document.querySelectorAll('.header__menu-list a');
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            menuToggle.classList.remove('is-active');
            navigation.classList.remove('is-active');
        });
    });

    // Close menu when clicking on mobile CTA button
    const mobileCta = document.querySelector('.header__menu-cta-btn');
    if (mobileCta) {
        mobileCta.addEventListener('click', () => {
            menuToggle.classList.remove('is-active');
            navigation.classList.remove('is-active');
        });
    }
}

/**
 * Header scroll effect — RAF-throttled to max 1 update per frame
 */
function initHeaderScroll() {
    const navPrimary = document.querySelector('.header__nav');
    if (!navPrimary) return;

    let ticking      = false;
    let scrollingTimer = null;

    function onScroll() {
        if (ticking) return;
        ticking = true;

        requestAnimationFrame(() => {
            if (window.scrollY > 0) {
                navPrimary.classList.add('is-scrolled', 'is-scrolling');

                clearTimeout(scrollingTimer);
                scrollingTimer = setTimeout(() => {
                    navPrimary.classList.remove('is-scrolling');
                }, 150);
            } else {
                navPrimary.classList.remove('is-scrolled', 'is-scrolling');
                clearTimeout(scrollingTimer);
            }

            ticking = false;
        });
    }

    window.addEventListener('scroll', onScroll, { passive: true });
}
