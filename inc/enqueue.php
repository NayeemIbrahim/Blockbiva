<?php
/**
 * Enqueue scripts and styles.
 *
 * @package Blockbiva
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue Class
 */
class Blockbiva_Enqueue
{

    /**
     * Constructor
     */
    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_frontend'));
        add_action('enqueue_block_editor_assets', array($this, 'enqueue_editor'));
    }

    /**
     * Enqueue frontend scripts and styles.
     */
    public function enqueue_frontend()
    {
        $version = $this->get_asset_version('/assets/css/main.css');

        // 0. Preconnect to fonts
        add_action('wp_head', function () {
            echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
            echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
        }, 1);

        // 1. Remove jQuery on frontend to improve performance (load only if absolutely needed)
        if (!is_admin()) {
            wp_deregister_script('jquery');
        }

        // 2. Enqueue CSS
        $font_pairing = get_theme_mod('font_pairing', 'geometric');
        $fonts_url = 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Montserrat:wght@700;800&display=swap'; // Default Geometric for SaaS

        if ($font_pairing === 'classic') {
            $fonts_url = 'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Lora:ital,wght@0,400;0,500;1,400&display=swap';
        } elseif ($font_pairing === 'minimal') {
            $fonts_url = 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap';
        } elseif ($font_pairing === 'modern') {
            $fonts_url = 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@700;800&display=swap';
        }

        wp_enqueue_style('blockbiva-fonts', $fonts_url, array(), null);
        wp_enqueue_style('blockbiva-main', BLOCKBIVA_URI . '/assets/css/main.css', array(), $version);
        wp_enqueue_style('blockbiva-blocks', BLOCKBIVA_URI . '/assets/css/blocks.css', array(), $version);
        wp_enqueue_style('blockbiva-style', get_stylesheet_uri(), array(), BLOCKBIVA_VERSION);

        // 3. Enqueue Vanilla JS
        wp_enqueue_script('blockbiva-scripts', BLOCKBIVA_URI . '/assets/js/main.js', array(), $this->get_asset_version('/assets/js/main.js'), true);
        wp_enqueue_script('blockbiva-utils', BLOCKBIVA_URI . '/assets/js/theme-utils.js', array(), $this->get_asset_version('/assets/js/theme-utils.js'), true);

        // 4. Localize Settings
        wp_localize_script('blockbiva-scripts', 'blockbivaSettings', array(
            'darkModeDefault' => get_theme_mod('dark_mode_default', false),
            'scrollThreshold' => get_theme_mod('scroll_to_top_threshold', 300),
        ));

        // 5. Conditional scripts
        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
    }

    /**
     * Enqueue editor-only assets.
     */
    public function enqueue_editor()
    {
        wp_enqueue_style('blockbiva-editor-styles', BLOCKBIVA_URI . '/assets/css/editor-style.css', array(), $this->get_asset_version('/assets/css/editor-style.css'));
    }

    /**
     * Get file modification time as version for cache busting.
     *
     * @param string $path Relative path to file.
     * @return string Version string.
     */
    private function get_asset_version($path)
    {
        $file_path = BLOCKBIVA_DIR . $path;
        return file_exists($file_path) ? filemtime($file_path) : BLOCKBIVA_VERSION;
    }
}

new Blockbiva_Enqueue();
