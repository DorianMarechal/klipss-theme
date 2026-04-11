/**
 * Sticky Bar Module
 * Shows a fixed purchase bar after the hero scrolls out of view.
 * Hides when the configurator section is fully visible.
 */

export function init() {
    const bar          = document.getElementById('stickyBar');
    const hero         = document.querySelector('.hero');
    const configurator = document.getElementById('configurator');
    if (!bar || !hero) return;

    let ticking = false;
    function update() {
        const heroBottom   = hero.getBoundingClientRect().bottom;
        const configTop    = configurator ? configurator.getBoundingClientRect().top : Infinity;
        const configBottom = configurator ? configurator.getBoundingClientRect().bottom : Infinity;

        const heroGone      = heroBottom < 0;
        const configVisible = configTop < window.innerHeight * 0.5 && configBottom > 0;
        const configPassed  = configurator && configBottom < 0;

        if (heroGone && !configVisible && !configPassed) {
            bar.classList.add('is-visible');
            bar.setAttribute('aria-hidden', 'false');
        } else {
            bar.classList.remove('is-visible');
            bar.setAttribute('aria-hidden', 'true');
        }
        ticking = false;
    }

    window.addEventListener('scroll', () => {
        if (!ticking) { requestAnimationFrame(update); ticking = true; }
    }, { passive: true });
    update();
}
