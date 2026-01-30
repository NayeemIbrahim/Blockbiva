<?php
/**
 * WooCommerce Compatibility File
 *
 * @package Blockbiva
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * WooCommerce Setup Class
 */
class Blockbiva_WooCommerce
{

    public function __construct()
    {
        add_filter('woocommerce_enqueue_styles', '__return_empty_array'); // Use our own styles

        // Layout wrappers
        add_action('woocommerce_before_main_content', array($this, 'before_main_content'));
        add_action('woocommerce_after_main_content', array($this, 'after_main_content'));

        // Adjust product columns
        add_filter('loop_shop_columns', array($this, 'loop_columns'), 999);

        // Breadcrumb customization
        add_filter('woocommerce_breadcrumb_defaults', array($this, 'change_breadcrumb_delimiter'));
    }

    /**
     * Wrapper before content
     */
    public function before_main_content()
    {
        echo wp_kses_post('<main id="primary" class="site-main woocommerce-main-wrapper"><div class="wp-block-group alignwide">');
    }

    /**
     * Wrapper after content
     */
    public function after_main_content()
    {
        echo wp_kses_post('</div></main>');
    }

    /**
     * Loop columns
     */
    public function loop_columns()
    {
        return 3;
    }

    /**
     * Change breadcrumb delimiter
     */
    public function change_breadcrumb_delimiter($defaults)
    {
        $defaults['delimiter'] = ' <span class="breadcrumb-separator">/</span> ';
        return $defaults;
    }
}

new Blockbiva_WooCommerce();
