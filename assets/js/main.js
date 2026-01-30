// Main JS file for Blockbiva
document.addEventListener('DOMContentLoaded', () => {
    initDarkMode();
});

/**
 * Dark Mode Logic
 */
function initDarkMode() {
    const toggle = document.getElementById('dark-mode-toggle');
    const body = document.body;
    const storageKey = 'blockbiva_dark_mode';

    // 1. Check for saved preference.
    // DEFAULT: Light Mode (if no storage found, remove class)
    const savedMode = localStorage.getItem(storageKey);

    if (savedMode === 'dark') {
        body.classList.add('is-dark-theme');
    } else {
        // Explicitly remove it to ensure Light Mode is default
        body.classList.remove('is-dark-theme');
    }

    if (!toggle) return;

    // 2. Toggle Event
    toggle.addEventListener('click', () => {
        body.classList.toggle('is-dark-theme');
        const isDark = body.classList.contains('is-dark-theme');
        localStorage.setItem(storageKey, isDark ? 'dark' : 'light');
    });
}
