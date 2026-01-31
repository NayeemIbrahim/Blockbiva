<?php
/**
 * Main theme setup and theme supports.
 *
 * @package Blockbiva
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup Class
 */
final class Blockbiva_Setup
{
    /**
     * Instance of the class
     */
    private static $instance = null;

    /**
     * Get instance of the class
     */
    public static function get_instance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor
     */
    private function __construct()
    {
        add_action('after_setup_theme', array($this, 'setup'));
        add_action('after_setup_theme', array($this, 'content_width'), 0);
    }

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     */
    public function setup()
    {
        // 1. Setup text domain for translation.
        load_theme_textdomain('blockbiva', get_template_directory() . '/languages');

        // 2. Setup theme supports.

        // Let WordPress manage the document title.
        add_theme_support('title-tag');

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support('post-thumbnails');

        // Set up custom logo support.
        add_theme_support('custom-logo', array(
            'height' => 100,
            'width' => 400,
            'flex-width' => true,
            'flex-height' => true,
        ));

        // Add support for site icon (favicon).
        add_theme_support('site-icon');

        // Switch default core markup to output valid HTML5.
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ));

        // Add support for full and wide align images.
        add_theme_support('align-wide');

        // Add support for responsive embeds.
        add_theme_support('responsive-embeds');

        // Additional Block Editor Supports
        add_theme_support('editor-styles');
        add_editor_style('assets/css/editor-style.css');
        add_theme_support('wp-block-styles');

        // WooCommerce Support (if plugin is active)
        if (class_exists('WooCommerce')) {
            add_theme_support('woocommerce');
            add_theme_support('wc-product-gallery-zoom');
            add_theme_support('wc-product-gallery-lightbox');
            add_theme_support('wc-product-gallery-slider');
        }

        // 3. Register navigation menus.
        register_nav_menus(array(
            'primary' => esc_html__('Primary Menu', 'blockbiva'),
            'footer' => esc_html__('Footer Menu', 'blockbiva'),
        ));
    }

    /**
     * Set the content width in pixels, based on the theme's design and stylesheet.
     *
     * Priority 0 to make it available to lower priority callbacks.
     *
     * @global int $content_width
     */
    public function content_width()
    {
        $GLOBALS['content_width'] = apply_filters('blockbiva_content_width', 1200);
    }
}

// Initialize the setup
Blockbiva_Setup::get_instance();
