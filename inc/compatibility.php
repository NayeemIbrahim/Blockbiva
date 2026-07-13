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
}

new Blockbiva_Compatibility();

