<?php
/**
 * Plugin Compatibility Logic
 *
 * @package Blockbiva
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Compatibility Class
 */
class Blockbiva_Compatibility
{

    public function __construct()
    {
        // Breadcrumbs for SEO Plugins
        add_action('blockbiva_theme_breadcrumb', array($this, 'render_breadcrumbs'));

        // Remove Emoji script (performance)
        add_action('init', array($this, 'clean_up_wp'));
    }

    /**
     * Render Breadcrumbs via standard SEO plugin hooks
     */
    public function render_breadcrumbs()
    {
        if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<div class="blockbiva-breadcrumbs">', '</div>');
        } elseif (function_exists('rank_math_the_breadcrumbs')) {
            rank_math_the_breadcrumbs();
        }
    }

    /**
     * Clean up unnecessary WP core assets if not needed
     */
    public function clean_up_wp()
    {
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('admin_print_styles', 'print_emoji_styles');
    }
}

new Blockbiva_Compatibility();
