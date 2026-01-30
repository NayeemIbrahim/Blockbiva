<?php
/**
 * Blockbiva functions and definitions
 *
 * @package Blockbiva
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Define Theme Constants
 */
define('BLOCKBIVA_VERSION', '1.0.0');
define('BLOCKBIVA_DIR', get_template_directory());
define('BLOCKBIVA_URI', get_template_directory_uri());

/**
 * Modern Theme Bootstrapper
 */
final class Blockbiva_Core
{
    /**
     * Single instance of the class
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
        $this->load_dependencies();

        // Initialize Admin Dashboard
        if (is_admin() && class_exists('Blockbiva_Admin')) {
            new Blockbiva_Admin();
        }

        // Initialize Customizer
        if (class_exists('Blockbiva_Customizer')) {
            new Blockbiva_Customizer();
        }
    }

    /**
     * Load all modular components
     */
    private function load_dependencies()
    {
        $files = array(
            'admin/class-blockbiva-admin.php',
            'helpers.php',
            'setup.php',
            'enqueue.php',
            'blocks.php',
            'performance.php',
            'demo-import.php',
            'customizer.php',
            'compatibility.php',
        );

        // Conditionally add WooCommerce file if plugin is active
        if (class_exists('WooCommerce')) {
            $files[] = 'woocommerce.php';
        }

        foreach ($files as $file) {
            $path = BLOCKBIVA_DIR . '/inc/' . $file;
            if (file_exists($path)) {
                require_once $path;
            }
        }
    }
}

// Start the engine
Blockbiva_Core::get_instance();
