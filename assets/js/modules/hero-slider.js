/**
 * Hero Slider Module
 * Infinite loop slider for hero section
 */

let heroSlider      = null;
let slidesContainer = null;
let allSlides       = [];
let totalSlides     = 0;
let currentSlideIndex = 0;
let isTransitioning = false;

export function init() {
    heroSlider      = document.querySelector('.hero__slider');
    slidesContainer = document.querySelector('.hero__slider-track');
    const originalSlides = Array.from(document.querySelectorAll('.hero__slider .hero__slide'));

    if (!heroSlider || !slidesContainer || originalSlides.length === 0) return;

    totalSlides = originalSlides.length;

    // Clone slides twice for smooth infinite loop
    for (let i = 0; i < 2; i++) {
        originalSlides.forEach(slide => {
            slidesContainer.appendChild(slide.cloneNode(true));
        });
    }

    allSlides = Array.from(document.querySelectorAll('.hero__slider .hero__slide'));

    window.addEventListener('load', () => {
        currentSlideIndex = totalSlides;
        setPosition(currentSlideIndex, true);
        let timerId = setInterval(nextSlide, 3000);
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) { clearInterval(timerId); }
            else { timerId = setInterval(nextSlide, 3000); }
        });
    }, { once: true });

    window.addEventListener('resize', () => {
        setPosition(currentSlideIndex, true);
    }, { passive: true });

    // Use transitionend to trigger loop reset instead of setTimeout
    slidesContainer.addEventListener('transitionend', onTransitionEnd);
}

function getSlideWidth() {
    const computedStyle = window.getComputedStyle(slidesContainer);
    const gap = parseInt(computedStyle.gap) || (window.innerWidth <= 768 ? 4 : (window.innerWidth <= 960 ? 15 : 12));
    return allSlides[0].offsetWidth + gap;
}

function getCenterOffset() {
    const slideWidth     = allSlides[0].offsetWidth;
    const containerWidth = heroSlider.offsetWidth;
    return (containerWidth - slideWidth) / 2;
}

function setPosition(index, instant = false) {
    const slideWidth   = getSlideWidth();
    const centerOffset = getCenterOffset();
    const position     = (index * slideWidth) - centerOffset;

    slidesContainer.style.transition = instant ? 'none' : 'transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
    slidesContainer.style.transform  = `translateX(-${position}px)`;

    allSlides.forEach((s, i) => {
        s.classList.toggle('is-active', i === index);
    });
}

function onTransitionEnd(e) {
    // Ignore bubbled transitionend events from child elements (e.g. slide img scale/opacity)
    if (e.target !== slidesContainer) return;

    // If we've gone past the last cloned set, jump back silently
    if (currentSlideIndex >= totalSlides * 2) {
        isTransitioning = true;
        currentSlideIndex = totalSlides;

        const slideWidth   = getSlideWidth();
        const centerOffset = getCenterOffset();
        const position     = (currentSlideIndex * slideWidth) - centerOffset;

        slidesContainer.style.transition = 'none';
        slidesContainer.style.transform  = `translateX(-${position}px)`;

        // Disable img transitions during snap so the active slide snaps
        // directly to scale(1.15) without dipping back to scale(1)
        allSlides.forEach(s => {
            const img = s.querySelector('.hero__slide-img');
            if (img) img.style.transition = 'none';
            s.classList.remove('is-active');
        });

        allSlides[currentSlideIndex].classList.add('is-active');

        // Re-enable img transitions after the browser has painted the snapped state
        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                allSlides.forEach(s => {
                    const img = s.querySelector('.hero__slide-img');
                    if (img) img.style.transition = '';
                });
                isTransitioning = false;
            });
        });
    }
}

function nextSlide() {
    if (isTransitioning) return;
    currentSlideIndex++;
    setPosition(currentSlideIndex, false);
}
