/**
 * Theme Utilities: Smooth Scroll & Header Auto-hide (Vanilla JS)
 */
document.addEventListener('DOMContentLoaded', function () {
    'use strict';

    const header = document.querySelector('header, .site-header, .wp-block-template-part-header');
    const scrollTopBtn = document.querySelector('.blockbiva-scroll-to-top');
    let lastScrollTop = 0;
    const scrollThreshold = 100;

    // Detect if auto-hide is enabled (based on transition property set via dynamic CSS)
    const isAutoHideEnabled = header && getComputedStyle(header).transitionProperty.includes('transform');

    // 1. Back to Top Visibility
    const threshold = (typeof blockbivaSettings !== 'undefined' && blockbivaSettings.scrollThreshold) ? parseInt(blockbivaSettings.scrollThreshold) : 300;
    
    window.addEventListener('scroll', function () {
        const st = window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTopBtn) {
            if (st > threshold) {
                scrollTopBtn.classList.add('is-visible');
            } else {
                scrollTopBtn.classList.remove('is-visible');
            }
        }

        // 2. Header Auto-hide Logic
        if (header && st > scrollThreshold) {
            if (st > lastScrollTop) {
                // Scrolling Down
                header.classList.add('header-hidden');
            } else {
                // Scrolling Up
                header.classList.remove('header-hidden');
            }
        } else if (header) {
            header.classList.remove('header-hidden');
        }

        lastScrollTop = st <= 0 ? 0 : st;
    }, { passive: true });

    // 3. Smooth Scroll to Top Click
    if (scrollTopBtn) {
        scrollTopBtn.addEventListener('click', function (e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

});
