<?php
/**
 * One Click Demo Import Integration
 *
 * @package Blockbiva
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Demo Data
 */
function blockbiva_import_files()
{
    return array(
        array(
            'import_file_name' => esc_html__('Business Demo', 'blockbiva'),
            'categories' => array('Business', 'Corporate'),
            'import_file_url' => get_template_directory_uri() . '/demo/content.xml',
            // 'import_widget_file_url'    => get_template_directory_uri() . '/demo/widgets.wie',
            // 'import_customizer_file_url' => get_template_directory_uri() . '/demo/customizer.dat',
            // 'import_preview_image_url'   => get_template_directory_uri() . '/assets/images/demo-preview.jpg',
            'import_notice' => esc_html__('Importing the business demo will set up your homepage and menus.', 'blockbiva'),
            'preview_url' => 'http://localhost/wordpress/',
        ),
    );
}
add_filter('ocdi/import_files', 'blockbiva_import_files');

/**
 * Actions after import
 */
function blockbiva_after_import_setup()
{
    // Assign menus to their locations.
    $main_menu = get_term_by('name', 'Main Menu', 'nav_menu');

    set_theme_mod('nav_menu_locations', array(
        'primary' => $main_menu ? $main_menu->term_id : null,
    ));

    // Assign front page and posts page (blog).
    $front_page_id = get_page_by_title('Home');
    $blog_page_id = get_page_by_title('Blog');

    if ($front_page_id && $blog_page_id) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $front_page_id->ID);
        update_option('page_for_posts', $blog_page_id->ID);
    }
}
add_action('ocdi/after_import', 'blockbiva_after_import_setup');
