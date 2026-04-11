/**
 * Modals Module
 * Handles tech spec modals and features video modal
 */

export function init() {
    const techModals         = initTechModals();
    const featuresVideoModal = initFeaturesVideoModal();

    // Single shared ESC listener for all modals (replaces two separate keydown handlers)
    document.addEventListener('keydown', (e) => {
        if (e.key !== 'Escape') return;

        // Close any open tech modal
        if (techModals) {
            Object.values(techModals).forEach(modal => {
                if (modal && modal.classList.contains('is-active')) {
                    closeTechModal(modal);
                }
            });
        }

        // Close features video modal
        if (featuresVideoModal && featuresVideoModal.modal.classList.contains('is-active')) {
            featuresVideoModal.close();
        }
    });
}

/* ─── Tech modals ───────────────────────────────────────────── */

function closeTechModal(modal) {
    modal.classList.remove('is-active');
    document.body.style.overflow = '';
}

function initTechModals() {
    const techSpecItems = document.querySelectorAll('.tech-spec__item');
    const techModals = {
        0: document.getElementById('modal-battery'),
        1: document.getElementById('modal-wireless'),
        2: document.getElementById('modal-gps'),
        3: document.getElementById('modal-dimensions'),
        4: document.getElementById('modal-eco'),
        5: document.getElementById('modal-app')
    };

    if (techSpecItems.length === 0) return null;

    function openTechModal(modalId) {
        const modal = techModals[modalId];
        if (modal) {
            modal.classList.add('is-active');
            document.body.style.overflow = 'hidden';
        }
    }

    techSpecItems.forEach((item, index) => {
        item.addEventListener('click', () => openTechModal(index));
    });

    Object.values(techModals).forEach(modal => {
        if (!modal) return;

        const closeBtn = modal.querySelector('.tech-modal__close');
        if (closeBtn) {
            closeBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                closeTechModal(modal);
            });
        }

        const overlay = modal.querySelector('.tech-modal__overlay');
        if (overlay) {
            overlay.addEventListener('click', () => closeTechModal(modal));
        }
    });

    return techModals;
}

/* ─── Features video modal ──────────────────────────────────── */

function initFeaturesVideoModal() {
    const featuresVideoModal  = document.getElementById('featuresVideoModal');
    const featuresVideoBtn    = document.querySelector('.features-showcase__btn');
    const featuresVideoPlayer = document.getElementById('featuresVideoPlayer');
    const closeFeaturesModalBtn  = document.querySelector('.features-video-modal__close');
    const featuresModalOverlay   = document.querySelector('.features-video-modal__overlay');

    if (!featuresVideoModal) return null;

    function open() {
        featuresVideoModal.classList.add('is-active');
        if (featuresVideoPlayer) featuresVideoPlayer.play();
        document.body.style.overflow = 'hidden';
    }

    function close() {
        featuresVideoModal.classList.remove('is-active');
        if (featuresVideoPlayer) {
            featuresVideoPlayer.pause();
            featuresVideoPlayer.currentTime = 0;
        }
        document.body.style.overflow = '';
    }

    if (featuresVideoBtn)       featuresVideoBtn.addEventListener('click', open);
    if (closeFeaturesModalBtn)  closeFeaturesModalBtn.addEventListener('click', close);
    if (featuresModalOverlay)   featuresModalOverlay.addEventListener('click', close);

    return { modal: featuresVideoModal, close };
}
