<?php
/**
 * Performance optimizations for the theme.
 *
 * @package Blockbiva
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Performance Class
 */
class Blockbiva_Performance
{

    public function __construct()
    {
        // 1. Disable Emojis (removes JS/CSS bloat)
        add_action('init', array($this, 'disable_emojis'));

        // 2. Disable Embeds (removes wp-embed.min.js)
        add_action('init', array($this, 'disable_embeds'));

        // 3. Remove XML-RPC (security + perf)
        add_filter('xmlrpc_enabled', '__return_false');

        // 4. Clean up Head
        add_action('init', array($this, 'cleanup_head'));

        // 5. Smart Lazy Loading
        add_filter('wp_get_attachment_image_attributes', array($this, 'smart_lazy_loading'), 10, 3);
    }

    /**
     * Disable emojis
     */
    public function disable_emojis()
    {
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_styles', 'print_emoji_styles');
        remove_filter('the_content_feed', 'wp_staticize_emoji');
        remove_filter('comment_text_rss', 'wp_staticize_emoji');
        remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    }

    /**
     * Disable oEmbed
     */
    public function disable_embeds()
    {
        if (!is_admin()) {
            wp_deregister_script('wp-embed');
        }
    }

    /**
     * Clean up head tags
     */
    public function cleanup_head()
    {
        remove_action('wp_head', 'rsd_link'); // EditURI
        remove_action('wp_head', 'wlwmanifest_link'); // Windows Live Writer
        remove_action('wp_head', 'wp_generator'); // WP Version
        remove_action('wp_head', 'start_post_rel_link');
        remove_action('wp_head', 'index_rel_link');
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
    }

    /**
     * Smart Lazy Loading
     * Ensures the first image in the loop (LCP) is NOT lazy loaded.
     */
    public function smart_lazy_loading($attr, $attachment, $size)
    {
        // If it's a potential LCP candidate (e.g., Hero image or first post thumb), disable lazy load
        // This is a heuristic; in a real loop, we might count indexes, but this serves as a good default.
        if (is_singular() && has_post_thumbnail() && get_post_thumbnail_id() === $attachment->ID) {
            $attr['loading'] = 'eager'; // Force immediate load for main hero image
        } else {
            $attr['loading'] = 'lazy';
        }

        return $attr;
    }
}

new Blockbiva_Performance();
