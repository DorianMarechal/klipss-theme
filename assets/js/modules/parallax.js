/**
 * Parallax Module
 * Handles parallax scroll effect for Ideas section
 */

export function init() {
    const ideasSection = document.querySelector('.ideas__section');
    const ideasImageWrap = document.querySelector('.idea-image-wrap');
    const ideasItems = document.querySelectorAll('.ideas__item');

    if (!ideasSection || !ideasImageWrap || ideasItems.length < 2) return;

    const firstImage = ideasItems[0];
    const secondImage = ideasItems[1];

    function updateParallax() {
        // GSAP ScrollTrigger handles parallax once loaded — stop this loop
        if (window.ScrollTrigger) return;

        const imageWrapRect = ideasImageWrap.getBoundingClientRect();
        const windowHeight = window.innerHeight;

        // Start effect when images are 30% visible from bottom
        // End effect when images are 30% from top
        const startPoint = windowHeight * 0.7;
        const endPoint = windowHeight * 0.3;

        const imageWrapCenter = imageWrapRect.top + (imageWrapRect.height / 2);

        let progress = (startPoint - imageWrapCenter) / (startPoint - endPoint);
        progress = Math.max(0, Math.min(1, progress));

        const maxOffset = 80;

        // First image: starts at 0, moves down
        const firstImageOffset = progress * maxOffset;
        // Second image: starts at padding, moves up
        const secondImageOffset = -progress * maxOffset;

        firstImage.style.transform = `translateY(${firstImageOffset}px)`;
        secondImage.style.transform = `translateY(${secondImageOffset}px)`;
    }

    // Initial call
    updateParallax();

    // Update on scroll with requestAnimationFrame
    let ticking = false;
    window.addEventListener('scroll', () => {
        if (!ticking) {
            requestAnimationFrame(() => {
                updateParallax();
                ticking = false;
            });
            ticking = true;
        }
    }, { passive: true });

    // Update on resize
    window.addEventListener('resize', updateParallax, { passive: true });
}
