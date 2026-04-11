/**
 * Sliders Module
 * Handles features showcase and testimonials sliders
 */

export function init() {
    initSlider('.features-showcase__grid', '.features-showcase__nav--prev', '.features-showcase__nav--next');
    initSlider('.testimonials__grid', '.testimonials__nav--prev', '.testimonials__nav--next');
}

/**
 * Generic slider with prev/next navigation
 */
function initSlider(gridSelector, prevSelector, nextSelector) {
    const sliderGrid = document.querySelector(gridSelector);
    const prevBtn    = document.querySelector(prevSelector);
    const nextBtn    = document.querySelector(nextSelector);

    if (!sliderGrid || !prevBtn || !nextBtn) return;

    const items = sliderGrid.querySelectorAll(':scope > *');
    let currentIndex = 0;
    const totalItems = items.length;

    function getItemWidth() {
        if (items.length === 0) return 454;
        const itemWidth   = items[0].offsetWidth;
        const itemStyle   = window.getComputedStyle(items[0]);
        const marginRight = parseInt(itemStyle.marginRight) || 24;
        return itemWidth + marginRight;
    }

    function getMaxOffset() {
        const containerWidth = sliderGrid.offsetWidth;
        const itemWidth      = getItemWidth();
        const lastItemWidth  = items[items.length - 1].offsetWidth;
        const totalWidth     = (itemWidth * (totalItems - 1)) + lastItemWidth;
        return Math.max(0, totalWidth - containerWidth);
    }

    function getMaxIndex() {
        const containerWidth = sliderGrid.offsetWidth;
        const itemWidth      = getItemWidth();
        const totalWidth     = itemWidth * totalItems;
        const maxScroll      = totalWidth - containerWidth;
        return Math.max(0, Math.ceil(maxScroll / itemWidth));
    }

    function updatePosition() {
        const itemWidth = getItemWidth();
        const maxOffset = getMaxOffset();
        let offset      = currentIndex * itemWidth;

        if (offset > maxOffset) offset = maxOffset;

        sliderGrid.style.transform  = `translateX(-${offset}px)`;
        sliderGrid.style.transition = 'transform 0.4s ease';
    }

    function updateNavButtons() {
        const maxIndex = getMaxIndex();
        prevBtn.classList.toggle('is-disabled', currentIndex <= 0);
        nextBtn.classList.toggle('is-disabled', currentIndex >= maxIndex);
    }

    updateNavButtons();

    prevBtn.addEventListener('click', () => {
        if (!prevBtn.classList.contains('is-disabled')) {
            currentIndex--;
            updatePosition();
            updateNavButtons();
        }
    });

    nextBtn.addEventListener('click', () => {
        if (!nextBtn.classList.contains('is-disabled')) {
            currentIndex++;
            updatePosition();
            updateNavButtons();
        }
    });

    // Debounced resize — DOM reads batched in a single rAF frame
    let resizeTimer = null;
    window.addEventListener('resize', () => {
        if (resizeTimer) cancelAnimationFrame(resizeTimer);
        resizeTimer = requestAnimationFrame(() => {
            const maxIndex = getMaxIndex();
            if (currentIndex > maxIndex) currentIndex = maxIndex;
            updatePosition();
            updateNavButtons();
            resizeTimer = null;
        });
    }, { passive: true });
}
