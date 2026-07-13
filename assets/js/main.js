// Main JS file for Blockbiva
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initDarkMode);
} else {
    initDarkMode();
}

/**
 * Dark Mode Logic
 * - Supports system preference detection (prefers-color-scheme)
 * - Persists user choice in localStorage
 * - Handles sun/moon icon swap with smooth transition
 */
function initDarkMode() {
    const toggle = document.getElementById('dark-mode-toggle');
    const body = document.body;
    const storageKey = 'blockbiva_dark_mode';

    // 1. Determine initial mode: saved preference > system preference > light default
    const savedMode = localStorage.getItem(storageKey);
    const systemPrefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
    const defaultDark = (typeof blockbivaSettings !== 'undefined' && blockbivaSettings.darkModeDefault);

    let isDark = false;

    if (savedMode !== null) {
        // User has explicitly chosen a mode
        isDark = savedMode === 'dark';
    } else if (defaultDark) {
        // Theme admin has set dark mode as default
        isDark = true;
    } else if (systemPrefersDark) {
        // Follow system preference
        isDark = true;
    }

    // Apply initial mode
    if (isDark) {
        body.classList.add('is-dark-theme');
    } else {
        body.classList.remove('is-dark-theme');
    }

    // Update icon state
    updateToggleIcon(isDark);

    if (!toggle) return;

    // 2. Toggle Event
    toggle.addEventListener('click', () => {
        body.classList.toggle('is-dark-theme');
        const nowDark = body.classList.contains('is-dark-theme');
        localStorage.setItem(storageKey, nowDark ? 'dark' : 'light');
        updateToggleIcon(nowDark);

        // Add spin animation class
        toggle.classList.add('is-animating');
        setTimeout(() => toggle.classList.remove('is-animating'), 500);
    });

    // 3. Listen for system preference changes (when no user override exists)
    if (window.matchMedia) {
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
            // Only react if user hasn't made an explicit choice
            if (localStorage.getItem(storageKey) === null) {
                const dark = e.matches;
                body.classList.toggle('is-dark-theme', dark);
                updateToggleIcon(dark);
            }
        });
    }
}

/**
 * Update the sun/moon icon visibility based on dark mode state
 */
function updateToggleIcon(isDark) {
    const sunIcon = document.querySelector('#dark-mode-toggle .sun');
    const moonIcon = document.querySelector('#dark-mode-toggle .moon');

    if (!sunIcon || !moonIcon) return;

    if (isDark) {
        sunIcon.style.display = 'none';
        moonIcon.style.display = 'block';
    } else {
        sunIcon.style.display = 'block';
        moonIcon.style.display = 'none';
    }
}
