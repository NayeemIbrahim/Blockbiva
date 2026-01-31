# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.1.0] - 2026-01-31

### Added
- **Scroll to Top Customization**:
    - Complete control over button size (width/height).
    - Adjustable border radius (square to circle).
    - Precise positioning (bottom and side offsets).
    - Configurable scroll threshold (distance before button appears).
    - Live preview support in Customizer.
- **Template Improvements**:
    - Enhanced block structure for `single-product`, `archive-product`, and `blog-left-sidebar`.
    - Better mobile responsiveness for sidebar layouts.

### Fixed
- **Scroll to Top Button**:
    - Resolved issue where dynamic CSS was not loading (hook changed to `wp_enqueue_scripts`).
    - Fixed `position: static` bug; button is now correctly `fixed`.
    - Corrected stylesheet handle reference for inline styles.
- **General**:
    - Minor CSS fixes for responsive layouts.

## [1.0.0] - 2026-01-30


### Added
- Initial Release of Blockbiva Pro.
- Full Site Editing (FSE) support with templates and parts.
- Advanced Customizer controls (Range, Responsive, Color).
- Custom Gutenberg Block styles (Blockbiva Glass, Soft Card).
- Header auto-hide functionality on scroll.
- Responsive "Back to Top" button with multiple icons.
- Global Design Tokens (Radius, Spacing, Widths).
- Dark Mode toggle and automatic preferred-color-scheme support.
- Performance optimizations:
    - 0 jQuery dependency on frontend.
    - Optimized Google Fonts loading (preconnect).
    - Lightweight CSS architecture.
- Full WooCommerce compatibility with custom layouts.
- JSON-LD Schema integration for SEO.
- Demo import system (One Click Demo Import support).
- Theme Dashboard with setup instructions.
