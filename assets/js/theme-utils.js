/**
 * Theme Utilities: Smooth Scroll & Header Auto-hide (Vanilla JS)
 */
document.addEventListener('DOMContentLoaded', function () {
    'use strict';

    const header = document.querySelector('header, .site-header, .wp-block-template-part-header');
    const scrollTopBtn = document.querySelector('.blockbiva-scroll-to-top');
    let lastScrollTop = 0;
    const scrollThreshold = 100;

    // Check if auto-hide is enabled via Customizer setting (passed from PHP)
    const isAutoHideEnabled = (typeof blockbivaSettings !== 'undefined' && blockbivaSettings.headerAutoHide);

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

            // Update scroll progress ring if present
            updateScrollProgress();
        }

        // 2. Header Auto-hide Logic — only when enabled in Customizer
        if (isAutoHideEnabled && header && st > scrollThreshold) {
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

    /**
     * 4. Update Scroll Progress Ring on scroll-to-top button
     */
    function updateScrollProgress() {
        const circle = document.querySelector('.blockbiva-scroll-to-top .progress-ring__circle');
        if (!circle) return;

        const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;
        const scrolled = window.scrollY;
        const progress = scrollHeight > 0 ? scrolled / scrollHeight : 0;

        const radius = circle.r.baseVal.value;
        const circumference = 2 * Math.PI * radius;
        circle.style.strokeDasharray = circumference;
        circle.style.strokeDashoffset = circumference - (progress * circumference);
    }

    /**
     * 5. Card Entrance Animations (Intersection Observer)
     */
    function initCardAnimations() {
        // Respect prefers-reduced-motion
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

        const animatedElements = document.querySelectorAll(
            '.is-style-blockbiva-card-soft, ' +
            '.is-style-blockbiva-glass, ' +
            '.wp-block-post'
        );

        if (!animatedElements.length) return;

        if (!('IntersectionObserver' in window)) {
            // Fallback for browsers without observer support
            animatedElements.forEach(el => el.classList.add('blockbiva-animate-in'));
            return;
        }

        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('blockbiva-animate-in');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.01,
            rootMargin: '0px 0px -20px 0px'
        });

        animatedElements.forEach(function (el) {
            el.classList.add('blockbiva-will-animate');
            observer.observe(el);

            // Safety timeout: ensure element becomes visible after 1.5 seconds if observer fails
            setTimeout(function () {
                if (!el.classList.contains('blockbiva-animate-in')) {
                    el.classList.add('blockbiva-animate-in');
                }
            }, 1500);
        });
    }

    initCardAnimations();
});
