/**
 * Video Section Module
 * Handles video slider and video modal
 */

export function init() {
    initVideoSlider();
    initVideoModal();
}

/**
 * Video slider with auto-rotation
 */
function initVideoSlider() {
    const videoSliderItems = document.querySelectorAll('.video-section__slider-item');
    const progressBars = document.querySelectorAll('.video-section__progress-bar');

    if (videoSliderItems.length === 0) return;

    let currentVideoSlide = 0;
    const slideDuration = 5000;

    function showVideoSlide(index) {
        videoSliderItems.forEach(item => item.classList.remove('is-active'));
        progressBars.forEach(bar => bar.classList.remove('is-active'));

        videoSliderItems[index].classList.add('is-active');
        progressBars[index].classList.add('is-active');
    }

    function nextVideoSlide() {
        currentVideoSlide = (currentVideoSlide + 1) % videoSliderItems.length;
        showVideoSlide(currentVideoSlide);
    }

    showVideoSlide(0);
    let intervalId = setInterval(nextVideoSlide, slideDuration);
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) { clearInterval(intervalId); }
        else { intervalId = setInterval(nextVideoSlide, slideDuration); }
    });
}

/**
 * Video modal functionality
 */
function initVideoModal() {
    const videoModal = document.getElementById('videoModal');
    const videoBtn = document.querySelector('.video-section__btn');
    const videoPlayer = document.getElementById('videoPlayer');
    const closeModalBtn = document.querySelector('.video-modal__close');
    const modalOverlay = document.querySelector('.video-modal__overlay');

    if (!videoModal) return;

    function openVideoModal() {
        videoModal.classList.add('is-active');
        if (videoPlayer) {
            videoPlayer.play();
        }
        document.body.style.overflow = 'hidden';
    }

    function closeVideoModal() {
        videoModal.classList.remove('is-active');
        if (videoPlayer) {
            videoPlayer.pause();
            videoPlayer.currentTime = 0;
        }
        document.body.style.overflow = '';
    }

    if (videoBtn) {
        videoBtn.addEventListener('click', openVideoModal);
    }

    if (closeModalBtn) {
        closeModalBtn.addEventListener('click', closeVideoModal);
    }

    if (modalOverlay) {
        modalOverlay.addEventListener('click', closeVideoModal);
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && videoModal.classList.contains('is-active')) {
            closeVideoModal();
        }
    });
}
