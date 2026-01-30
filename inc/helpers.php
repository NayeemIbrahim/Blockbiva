<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Helper functions and utility methods.
 *
 * @package Blockbiva
 */

/**
 * Utility Helper Class
 */
class Blockbiva_Helpers
{

    /**
     * Securely escape HTML output
     *
     * @param string $data Content to escape.
     * @return string Escaped content.
     */
    public static function safe_html($data)
    {
        return wp_kses_post($data);
    }

    /**
     * Securely escape attributes
     *
     * @param string $data Attribute content to escape.
     * @return string Escaped attribute content.
     */
    public static function safe_attr($data)
    {
        return esc_attr($data);
    }

    /**
     * Render Schema.org JSON-LD
     */
    public static function render_schema()
    {
        if (!is_singular()) {
            return;
        }

        global $post;
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => is_single() ? 'BlogPosting' : 'WebPage',
            'mainEntityOfPage' => array(
                '@type' => 'WebPage',
                '@id' => get_permalink(),
            ),
            'headline' => get_the_title(),
            'datePublished' => get_the_date('c'),
            'dateModified' => get_the_modified_date('c'),
            'author' => array(
                '@type' => 'Person',
                'name' => get_the_author(),
            ),
        );

        echo "\n" . '<script type="application/ld+json">' . wp_json_encode($schema) . '</script>' . "\n";
    }

    /**
     * Hook Schema to wp_head
     */
    public static function init()
    {
        add_action('wp_head', array(__CLASS__, 'render_schema'));
    }


    /**
     * Language Switcher for WPML/Polylang
     */
    public static function language_switcher()
    {
        if (function_exists('icl_get_languages')) {
            $languages = icl_get_languages('skip_missing=0');
            if (!empty($languages)) {
                echo '<ul class="blockbiva-language-switcher">';
                foreach ($languages as $l) {
                    echo '<li><a href="' . esc_url($l['url']) . '"><img src="' . esc_url($l['country_flag_url']) . '" alt="' . esc_attr($l['native_name']) . '" width="18" height="12"></a></li>';
                }
                echo '</ul>';
            }
        } elseif (function_exists('pll_the_languages')) {
            echo '<ul class="blockbiva-language-switcher">';
            pll_the_languages(array('show_flags' => 1, 'show_names' => 0));
            echo '</ul>';
        }
    }
}

/**
 * Shortcode for Dynamic Copyright
 */
add_action('init', function () {
    add_shortcode('blockbiva_copyright', function () {
        $text = get_theme_mod('copyright_text', sprintf(esc_html__('© %s Blockbiva Pro. All rights reserved.', 'blockbiva'), date('Y')));
        return '<span class="blockbiva-copyright">' . wp_kses_post($text) . '</span>';
    });
});

/**
 * Shortcode for Language Switcher
 */
add_shortcode('blockbiva_language_switcher', array('Blockbiva_Helpers', 'language_switcher'));

/**
 * Shortcode for Breadcrumbs
 */
add_shortcode('blockbiva_breadcrumbs', function () {
    ob_start();
    do_action('blockbiva_theme_breadcrumb');
    return ob_get_clean();
});

/**
 * Enable shortcodes in block templates
 */
add_filter('render_block', function ($block_content, $block) {
    if (strpos($block_content, '[blockbiva_copyright]') !== false || strpos($block_content, '[blockbiva_breadcrumbs]') !== false) {
        return do_shortcode($block_content);
    }
    return $block_content;
}, 99, 2);

// Initialize Helpers
Blockbiva_Helpers::init();
