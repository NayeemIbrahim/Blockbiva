<?php
/**
 * Main Admin Class
 *
 * @package Blockbiva
 */

if (!defined('ABSPATH')) {
    exit;
}

class Blockbiva_Admin
{
    /**
     * Constructor
     */
    public function __construct()
    {
        add_action('admin_menu', array($this, 'add_dashboard_page'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_styles'));
        add_action('admin_notices', array($this, 'check_demo_import_plugin'));
        add_action('admin_init', array($this, 'hide_unnecessary_options'));
    }

    /**
     * Add Dashboard Page
     */
    public function add_dashboard_page()
    {
        add_theme_page(
            esc_html__('Blockbiva Dashboard', 'blockbiva'),
            esc_html__('Blockbiva Dashboard', 'blockbiva'),
            'manage_options',
            'blockbiva-dashboard',
            array($this, 'render_dashboard')
        );
    }

    /**
     * Render Dashboard
     */
    public function render_dashboard()
    {
        include_once get_template_directory() . '/inc/admin/views/dashboard.php';
    }

    /**
     * Enqueue Styles
     */
    public function enqueue_styles($hook)
    {
        if ('appearance_page_blockbiva-dashboard' !== $hook) {
            return;
        }

        wp_enqueue_style(
            'blockbiva-admin-css',
            get_template_directory_uri() . '/assets/css/admin.css',
            array(),
            '1.0.0'
        );
    }

    /**
     * Check for Demo Import Plugin
     */
    public function check_demo_import_plugin()
    {
        if (!class_exists('OCDI_Plugin')) {
            ?>
            <div class="notice notice-info is-dismissible">
                <p>
                    <?php
                    printf(
                        esc_html__('Install the %1$sOne Click Demo Import%2$s plugin to import the demo patterns easily.', 'blockbiva'),
                        '<strong>',
                        '</strong>'
                    );
                    ?>
                </p>
            </div>
            <?php
        }
    }

    /**
     * Hide Unnecessary Options
     */
    public function hide_unnecessary_options()
    {
        // Hide Theme File Editor if needed (usually handled by DISALLOW_FILE_EDIT but good to have)
        // remove_submenu_page('themes.php', 'theme-editor.php');

        // Remove confusing dashboard widgets
        remove_meta_box('dashboard_primary', 'dashboard', 'side'); // WP News
    }
}
