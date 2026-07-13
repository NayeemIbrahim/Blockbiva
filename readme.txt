=== Blockbiva ===
Contributors: Nayeem Ibrahim
Requires at least: 6.4
Tested up to: 6.7
Requires PHP: 8.1
Stable tag: 1.1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

Blockbiva is a fast, flexible & Gutenberg-first WordPress theme designed for the modern web. Built with Full Site Editing (FSE) at its core, it offers unparalleled performance and speed.

== Features ==

* Full Site Editing (FSE) Ready
* Performance Optimized (No jQuery, Optimized Assets)
* Accessibility Ready (WCAG 2.1)
* WooCommerce Compatible
* Dark Mode Support
* Custom Gutenberg Blocks (Hero, CTA, Pricing, Features)
* SEO Friendly with JSON-LD Schema

== Installation ==

1. In your WordPress dashboard, go to Appearance > Themes > Add New.
2. Click Upload Theme and choose the `blockbiva.zip` file.
3. Click Install Now and activate the theme.

== Changelog ==

= 1.1.0 =
* Fixed PHP notice due to missing secondary_color Customizer setting registration.
* Fixed duplicate variable assignment for global_border_radius in Customizer.
* Fixed version constant mismatch in functions.php.
* Deregistered duplicate emoji cleanup logic inside compatibility.php.
* Fixed jQuery deregistration filtering to support plugin overrides.
* Replaced deprecated get_page_by_title() with WP_Query in demo importer.
* Fixed language switcher shortcode layout placement by buffering output.
* Fixed header auto-hide Customizer toggle integration.
* Fixed header menu wrapping and vertical alignment.
* Fixed white logo contrast in light mode with a sharp, solid black inversion filter.
* Resolved blurry text inside animated card elements.
* Added native dark mode support with localStorage persistence.
* Added Pricing Plans homepage section.
* Added Frequently Asked Questions accordion section.
* Centered footer copyright notice.

= 1.0.0 =
* Initial Release.
