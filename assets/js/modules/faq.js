/**
 * FAQ Module
 * Handles FAQ accordion functionality
 */

export function init() {
    // Single delegated listener on the container instead of N individual listeners
    const container = document.querySelector('.faq__list') || document.querySelector('.faq__items');

    if (!container) return;

    container.addEventListener('click', (e) => {
        const question = e.target.closest('.faq__question');
        if (!question) return;

        const item   = question.closest('.faq__item');
        if (!item) return;

        const isOpen = item.classList.contains('is-open');

        // Close all open items (accordion behavior)
        container.querySelectorAll('.faq__item.is-open').forEach(openItem => {
            openItem.classList.remove('is-open');
            openItem.querySelector('.faq__question').setAttribute('aria-expanded', 'false');
        });

        // Toggle current item (re-open if it wasn't open)
        if (!isOpen) {
            item.classList.add('is-open');
            question.setAttribute('aria-expanded', 'true');
        }
    });
}
