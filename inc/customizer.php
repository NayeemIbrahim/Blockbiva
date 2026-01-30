<?php
/**
 * Theme Customizer functionality.
 *
 * @package Blockbiva
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Custom Range & Responsive Control
 */
if (class_exists('WP_Customize_Control')) {
    class Blockbiva_Range_Control extends WP_Customize_Control
    {
        public $type = 'blockbiva_range';
        public $devices = array(); // If empty, it's a single range. If array('desktop','tablet','mobile'), it's responsive.

        public function __construct($manager, $id, $args = array())
        {
            parent::__construct($manager, $id, $args);
            if (isset($args['devices'])) {
                $this->devices = $args['devices'];
            }
        }

        public function render_content()
        {
            $is_responsive = !empty($this->devices);
            $input_args = $this->input_attrs;
            $min = isset($input_args['min']) ? $input_args['min'] : 0;
            $max = isset($input_args['max']) ? $input_args['max'] : 2000;
            $step = isset($input_args['step']) ? $input_args['step'] : 1;

            ?>
            <div class="blockbiva-range-control <?php echo $is_responsive ? 'is-responsive' : ''; ?>">
                <div class="blockbiva-range-header">
                    <span class="blockbiva-range-title"><?php echo esc_html($this->label); ?></span>
                    <?php if ($is_responsive): ?>
                        <div class="blockbiva-responsive-toggle">
                            <button type="button" class="active" data-device="desktop"><span
                                    class="dashicons dashicons-desktop"></span></button>
                            <button type="button" data-device="tablet"><span class="dashicons dashicons-tablet"></span></button>
                            <button type="button" data-device="mobile"><span class="dashicons dashicons-smartphone"></span></button>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="blockbiva-range-inputs">
                    <?php if ($is_responsive): ?>
                        <?php foreach ($this->devices as $device):
                            $val = get_theme_mod($this->settings[$device]->id, $this->settings[$device]->default);
                            $unit = ($device === 'desktop' && strpos($this->id, 'edge') !== false) ? '%' : 'PX';
                            ?>
                            <div
                                class="blockbiva-range-field blockbiva-range-field-<?php echo esc_attr($device); ?> <?php echo $device === 'desktop' ? 'active' : ''; ?>">
                                <div class="blockbiva-range-input-wrapper">
                                    <input type="range" class="range-slider" min="<?php echo esc_attr($min); ?>"
                                        max="<?php echo esc_attr($max); ?>" step="<?php echo esc_attr($step); ?>"
                                        value="<?php echo esc_attr($val); ?>" />
                                    <div class="blockbiva-range-number-unit">
                                        <input type="number" value="<?php echo esc_attr($val); ?>"
                                            data-customize-setting-link="<?php echo esc_attr($this->settings[$device]->id); ?>" />
                                        <span class="unit"><?php echo esc_html($unit); ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else:
                        $val = get_theme_mod($this->setting->id, $this->setting->default);
                        $unit = strpos($this->id, 'spacing') !== false && strpos($this->id, 'rem') === false ? 'PX' :
                            (strpos($this->id, 'rem') !== false ? 'REM' : 'PX');
                        ?>
                        <div class="blockbiva-range-field active">
                            <div class="blockbiva-range-input-wrapper">
                                <input type="range" class="range-slider" min="<?php echo esc_attr($min); ?>"
                                    max="<?php echo esc_attr($max); ?>" step="<?php echo esc_attr($step); ?>"
                                    value="<?php echo esc_attr($val); ?>" />
                                <div class="blockbiva-range-number-unit">
                                    <input type="number" value="<?php echo esc_attr($val); ?>"
                                        data-customize-setting-link="<?php echo esc_attr($this->setting->id); ?>" />
                                    <span class="unit"><?php echo esc_html($unit); ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if ($this->description): ?>
                    <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
                <?php endif; ?>
            </div>
            <?php
        }
    }
}

/**
 * Customizer Class
 */
class Blockbiva_Customizer
{

    /**
     * Constructor
     */
    public function __construct()
    {
        add_action('customize_register', array($this, 'register_settings'));
        add_action('wp_head', array($this, 'render_dynamic_css'), 100);
        add_action('wp_footer', array($this, 'render_scroll_to_top'));
        add_action('customize_controls_enqueue_scripts', array($this, 'enqueue_customizer_assets'));
    }

    /**
     * Enqueue Customizer Assets
     */
    public function enqueue_customizer_assets()
    {
        wp_enqueue_style('blockbiva-customizer-css', get_template_directory_uri() . '/assets/css/customizer-controls.css', array(), '1.0');
        wp_enqueue_script('blockbiva-customizer-js', get_template_directory_uri() . '/assets/js/customizer-controls.js', array('jquery', 'customize-controls'), '1.0', true);
    }

    /**
     * Register Customizer Settings
     *
     * @param WP_Customize_Manager $wp_customize Customizer manager.
     */
    public function register_settings($wp_customize)
    {
        // 1. Panel: Theme Options
        $wp_customize->add_panel('blockbiva_theme_options', array(
            'title' => esc_html__('Theme Options', 'blockbiva'),
            'description' => esc_html__('Global theme settings and toggles.', 'blockbiva'),
            'priority' => 30,
        ));

        // 2. Section: Header Settings
        $wp_customize->add_section('blockbiva_header_settings', array(
            'title' => esc_html__('Header & Navigation', 'blockbiva'),
            'panel' => 'blockbiva_theme_options',
        ));

        // Setting: Sticky Header
        $wp_customize->add_setting('sticky_header', array(
            'default' => true,
            'sanitize_callback' => 'rest_sanitize_boolean',
            'transport' => 'refresh',
        ));

        $wp_customize->add_control('sticky_header_control', array(
            'label' => esc_html__('Enable Sticky Header', 'blockbiva'),
            'section' => 'blockbiva_header_settings',
            'settings' => 'sticky_header',
            'type' => 'checkbox',
        ));

        // Setting: Navigation Alignment
        $wp_customize->add_setting('nav_alignment', array(
            'default' => 'right',
            'sanitize_callback' => 'blockbiva_sanitize_select',
            'transport' => 'refresh',
        ));

        $wp_customize->add_control('nav_alignment_control', array(
            'label' => esc_html__('Navigation Alignment', 'blockbiva'),
            'section' => 'blockbiva_header_settings',
            'settings' => 'nav_alignment',
            'type' => 'select',
            'choices' => array(
                'left' => esc_html__('Left', 'blockbiva'),
                'center' => esc_html__('Center', 'blockbiva'),
                'right' => esc_html__('Right', 'blockbiva'),
            ),
        ));

        // Setting: Header Transparency
        $wp_customize->add_setting('header_transparency', array(
            'default' => 82,
            'sanitize_callback' => 'absint',
            'transport' => 'refresh',
        ));

        $wp_customize->add_control(new Blockbiva_Range_Control($wp_customize, 'header_transparency_control', array(
            'label' => esc_html__('Header Opacity', 'blockbiva'),
            'section' => 'blockbiva_header_settings',
            'settings' => 'header_transparency',
            'input_attrs' => array('min' => 0, 'max' => 100, 'step' => 1),
        )));

        // Setting: Menu Font Size
        $wp_customize->add_setting('menu_font_size', array(
            'default' => 16,
            'sanitize_callback' => 'absint',
            'transport' => 'refresh',
        ));

        $wp_customize->add_control('menu_font_size_control', array(
            'label' => esc_html__('Menu Font Size (px)', 'blockbiva'),
            'section' => 'blockbiva_header_settings',
            'settings' => 'menu_font_size',
            'type' => 'number',
        ));

        // Setting: Menu Font Weight
        $wp_customize->add_setting('menu_font_weight', array(
            'default' => '600',
            'sanitize_callback' => 'blockbiva_sanitize_select',
            'transport' => 'refresh',
        ));

        $wp_customize->add_control('menu_font_weight_control', array(
            'label' => esc_html__('Menu Font Weight', 'blockbiva'),
            'section' => 'blockbiva_header_settings',
            'settings' => 'menu_font_weight',
            'type' => 'select',
            'choices' => array(
                '400' => esc_html__('Regular', 'blockbiva'),
                '500' => esc_html__('Medium', 'blockbiva'),
                '600' => esc_html__('Semi-Bold', 'blockbiva'),
                '700' => esc_html__('Bold', 'blockbiva'),
            ),
        ));

        // Setting: Logo Width (Responsive) - Moved to Site Identity
        $wp_customize->add_setting('logo_width_desktop', array('default' => 120, 'sanitize_callback' => 'absint', 'transport' => 'refresh'));
        $wp_customize->add_setting('logo_width_tablet', array('default' => 100, 'sanitize_callback' => 'absint', 'transport' => 'refresh'));
        $wp_customize->add_setting('logo_width_mobile', array('default' => 80, 'sanitize_callback' => 'absint', 'transport' => 'refresh'));

        $wp_customize->add_control(new Blockbiva_Range_Control($wp_customize, 'logo_width_responsive', array(
            'label' => esc_html__('Logo Width', 'blockbiva'),
            'section' => 'title_tagline',
            'devices' => array('desktop', 'tablet', 'mobile'),
            'settings' => array(
                'desktop' => 'logo_width_desktop',
                'tablet' => 'logo_width_tablet',
                'mobile' => 'logo_width_mobile',
            ),
            'input_attrs' => array('min' => 20, 'max' => 500, 'step' => 1),
            'priority' => 9, // Place after Logo upload
        )));

        // Setting: Menu Item Gap (Desktop/Tablet)
        $wp_customize->add_setting('menu_gap_desktop', array('default' => 2, 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh'));
        $wp_customize->add_setting('menu_gap_tablet', array('default' => 1, 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh'));

        $wp_customize->add_control(new Blockbiva_Range_Control($wp_customize, 'menu_gap_responsive', array(
            'label' => esc_html__('Menu Item Spacing (rem)', 'blockbiva'),
            'section' => 'blockbiva_header_settings',
            'devices' => array('desktop', 'tablet'),
            'settings' => array(
                'desktop' => 'menu_gap_desktop',
                'tablet' => 'menu_gap_tablet',
            ),
            'input_attrs' => array('min' => 0, 'max' => 5, 'step' => 0.1),
        )));

        // Setting: Menu Text Spacing
        $wp_customize->add_setting('menu_letter_spacing', array(
            'default' => 0.5,
            'sanitize_callback' => 'sanitize_text_field', // Changed from absint to allow floats
            'transport' => 'refresh',
        ));

        $wp_customize->add_control(new Blockbiva_Range_Control($wp_customize, 'menu_letter_spacing_control', array(
            'label' => esc_html__('Menu Text Spacing (px)', 'blockbiva'),
            'section' => 'blockbiva_header_settings',
            'settings' => 'menu_letter_spacing',
            'input_attrs' => array('min' => 0, 'max' => 10, 'step' => 0.5),
        )));

        // Setting: Menu Link Color
        $wp_customize->add_setting('menu_link_color', array(
            'default' => '#1e293b',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'refresh',
        ));

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'menu_link_color_control', array(
            'label' => esc_html__('Menu Link Color', 'blockbiva'),
            'section' => 'blockbiva_header_settings',
            'settings' => 'menu_link_color',
        )));

        // Setting: Menu Link Hover Color
        $wp_customize->add_setting('menu_link_hover_color', array(
            'default' => '#6366f1',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'refresh',
        ));

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'menu_link_hover_color_control', array(
            'label' => esc_html__('Menu Link Hover Color', 'blockbiva'),
            'section' => 'blockbiva_header_settings',
            'settings' => 'menu_link_hover_color',
        )));

        // Setting: Header Vertical Padding (Responsive)
        $wp_customize->add_setting('header_padding_desktop', array('default' => 20, 'sanitize_callback' => 'absint', 'transport' => 'refresh'));
        $wp_customize->add_setting('header_padding_tablet', array('default' => 15, 'sanitize_callback' => 'absint', 'transport' => 'refresh'));
        $wp_customize->add_setting('header_padding_mobile', array('default' => 10, 'sanitize_callback' => 'absint', 'transport' => 'refresh'));

        // Setting: Header padding
        $wp_customize->add_control(new Blockbiva_Range_Control($wp_customize, 'header_padding_responsive', array(
            'label' => esc_html__('Header Vertical Padding', 'blockbiva'),
            'section' => 'blockbiva_header_settings',
            'devices' => array('desktop', 'tablet', 'mobile'),
            'settings' => array(
                'desktop' => 'header_padding_desktop',
                'tablet' => 'header_padding_tablet',
                'mobile' => 'header_padding_mobile',
            ),
            'input_attrs' => array('min' => 0, 'max' => 100, 'step' => 1),
        )));

        // Setting: Auto-hide Header on Scroll
        $wp_customize->add_setting('header_auto_hide', array(
            'default' => false,
            'sanitize_callback' => 'rest_sanitize_boolean',
            'transport' => 'refresh',
        ));

        $wp_customize->add_control('header_auto_hide_control', array(
            'label' => esc_html__('Auto-hide Header on Scroll', 'blockbiva'),
            'section' => 'blockbiva_header_settings',
            'settings' => 'header_auto_hide',
            'type' => 'checkbox',
        ));

        // 3. Section: Layout & Performance
        $wp_customize->add_section('blockbiva_layout_settings', array(
            'title' => esc_html__('Layout & Performance', 'blockbiva'),
            'panel' => 'blockbiva_theme_options',
        ));

        // Setting: Dark Mode Default
        $wp_customize->add_setting('dark_mode_default', array(
            'default' => false,
            'sanitize_callback' => 'rest_sanitize_boolean',
            'transport' => 'refresh',
        ));

        $wp_customize->add_control('dark_mode_default_control', array(
            'label' => esc_html__('Dark Mode by Default', 'blockbiva'),
            'description' => esc_html__('Automatically enable dark mode on first visit.', 'blockbiva'),
            'section' => 'blockbiva_layout_settings',
            'settings' => 'dark_mode_default',
            'type' => 'checkbox',
        ));

        // Setting: Content Width
        $wp_customize->add_setting('layout_content_width', array(
            'default' => 1200,
            'sanitize_callback' => 'absint',
            'transport' => 'refresh',
        ));

        $wp_customize->add_control(new Blockbiva_Range_Control($wp_customize, 'layout_content_width_control', array(
            'label' => esc_html__('Maximum Site Width', 'blockbiva'),
            'section' => 'blockbiva_layout_settings',
            'settings' => 'layout_content_width',
            'input_attrs' => array('min' => 800, 'max' => 1920, 'step' => 10),
        )));

        // Content Spacing Group
        $wp_customize->add_setting('spacing_vertical_title', array('sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control('spacing_vertical_title_control', array(
            'label' => esc_html__('--- CONTENT SPACING ---', 'blockbiva'),
            'section' => 'blockbiva_layout_settings',
            'settings' => 'spacing_vertical_title',
            'type' => 'hidden',
        ));

        // Responsive Top Spacing
        $wp_customize->add_setting('content_top_spacing_desktop', array('default' => 60, 'sanitize_callback' => 'absint', 'transport' => 'refresh'));
        $wp_customize->add_setting('content_top_spacing_tablet', array('default' => 40, 'sanitize_callback' => 'absint', 'transport' => 'refresh'));
        $wp_customize->add_setting('content_top_spacing_mobile', array('default' => 30, 'sanitize_callback' => 'absint', 'transport' => 'refresh'));

        $wp_customize->add_control(new Blockbiva_Range_Control($wp_customize, 'content_top_spacing_responsive', array(
            'label' => esc_html__('Content Top Spacing', 'blockbiva'),
            'section' => 'blockbiva_layout_settings',
            'devices' => array('desktop', 'tablet', 'mobile'),
            'settings' => array(
                'desktop' => 'content_top_spacing_desktop',
                'tablet' => 'content_top_spacing_tablet',
                'mobile' => 'content_top_spacing_mobile',
            ),
            'input_attrs' => array('min' => 0, 'max' => 200, 'step' => 1),
        )));

        // Responsive Bottom Spacing
        $wp_customize->add_setting('content_bottom_spacing_desktop', array('default' => 60, 'sanitize_callback' => 'absint', 'transport' => 'refresh'));
        $wp_customize->add_setting('content_bottom_spacing_tablet', array('default' => 40, 'sanitize_callback' => 'absint', 'transport' => 'refresh'));
        $wp_customize->add_setting('content_bottom_spacing_mobile', array('default' => 30, 'sanitize_callback' => 'absint', 'transport' => 'refresh'));

        $wp_customize->add_control(new Blockbiva_Range_Control($wp_customize, 'content_bottom_spacing_responsive', array(
            'label' => esc_html__('Content Bottom Spacing', 'blockbiva'),
            'section' => 'blockbiva_layout_settings',
            'devices' => array('desktop', 'tablet', 'mobile'),
            'settings' => array(
                'desktop' => 'content_bottom_spacing_desktop',
                'tablet' => 'content_bottom_spacing_tablet',
                'mobile' => 'content_bottom_spacing_mobile',
            ),
            'input_attrs' => array('min' => 0, 'max' => 200, 'step' => 1),
        )));

        // Responsive Edge Spacing
        $wp_customize->add_setting('content_edge_spacing_desktop', array('default' => 5, 'sanitize_callback' => 'absint', 'transport' => 'refresh'));
        $wp_customize->add_setting('content_edge_spacing_tablet', array('default' => 24, 'sanitize_callback' => 'absint', 'transport' => 'refresh'));
        $wp_customize->add_setting('content_edge_spacing_mobile', array('default' => 16, 'sanitize_callback' => 'absint', 'transport' => 'refresh'));

        $wp_customize->add_control(new Blockbiva_Range_Control($wp_customize, 'content_edge_spacing_responsive', array(
            'label' => esc_html__('Horizontal Edge Spacing', 'blockbiva'),
            'description' => esc_html__('Adjusts horizontal spacing between main content area and edges of the screen.', 'blockbiva'),
            'section' => 'blockbiva_layout_settings',
            'devices' => array('desktop', 'tablet', 'mobile'),
            'settings' => array(
                'desktop' => 'content_edge_spacing_desktop',
                'tablet' => 'content_edge_spacing_tablet',
                'mobile' => 'content_edge_spacing_mobile',
            ),
            'input_attrs' => array('min' => 0, 'max' => 100, 'step' => 1),
        )));

        // Setting: Narrow Container Max Width
        $wp_customize->add_setting('narrow_container_width', array(
            'default' => 750,
            'sanitize_callback' => 'absint',
            'transport' => 'refresh',
        ));

        $wp_customize->add_control(new Blockbiva_Range_Control($wp_customize, 'narrow_container_width_control', array(
            'label' => esc_html__('Narrow Container Max Width', 'blockbiva'),
            'description' => esc_html__('This option applies only if the posts or pages are set to Narrow Width structure.', 'blockbiva'),
            'section' => 'blockbiva_layout_settings',
            'settings' => 'narrow_container_width',
            'input_attrs' => array('min' => 400, 'max' => 1000, 'step' => 10),
        )));

        // Setting: Wide Alignment Offset
        $wp_customize->add_setting('wide_alignment_offset', array(
            'default' => 130,
            'sanitize_callback' => 'absint',
            'transport' => 'refresh',
        ));

        $wp_customize->add_control(new Blockbiva_Range_Control($wp_customize, 'wide_alignment_offset_control', array(
            'label' => esc_html__('Wide Alignment Offset', 'blockbiva'),
            'description' => esc_html__('This option will apply only to those elements that have a wide alignment option.', 'blockbiva'),
            'section' => 'blockbiva_layout_settings',
            'settings' => 'wide_alignment_offset',
            'input_attrs' => array('min' => 0, 'max' => 400, 'step' => 10),
        )));

        // 4. Section: Design & Colors
        $wp_customize->add_section('blockbiva_design_settings', array(
            'title' => esc_html__('Design & Colors', 'blockbiva'),
            'panel' => 'blockbiva_theme_options',
        ));

        // Global Primary Color
        $wp_customize->add_setting('primary_color', array(
            'default' => '#6366f1',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'refresh',
        ));

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color_control', array(
            'label' => esc_html__('Global Primary Color', 'blockbiva'),
            'section' => 'blockbiva_design_settings',
            'settings' => 'primary_color',
        )));

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_color_control', array(
            'label' => esc_html__('Secondary Color', 'blockbiva'),
            'section' => 'blockbiva_design_settings',
            'settings' => 'secondary_color',
        )));

        // Setting: Accent Color 3
        $wp_customize->add_setting('accent_color_3', array(
            'default' => '#f43f5e',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'refresh',
        ));

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'accent_color_3_control', array(
            'label' => esc_html__('Accent Color 3 (Rose)', 'blockbiva'),
            'section' => 'blockbiva_design_settings',
            'settings' => 'accent_color_3',
        )));

        // Setting: Surface/Base Variation
        $wp_customize->add_setting('surface_variation_color', array(
            'default' => '#f8fafc',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'refresh',
        ));

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'surface_variation_color_control', array(
            'label' => esc_html__('Surface Variation (Light Backgrounds)', 'blockbiva'),
            'section' => 'blockbiva_design_settings',
            'settings' => 'surface_variation_color',
        )));

        // 5. Section: Typography
        $wp_customize->add_section('blockbiva_typography_settings', array(
            'title' => esc_html__('Typography', 'blockbiva'),
            'panel' => 'blockbiva_theme_options',
        ));

        // Font Pairing
        $wp_customize->add_setting('font_pairing', array(
            'default' => 'geometric',
            'sanitize_callback' => 'blockbiva_sanitize_select',
            'transport' => 'refresh',
        ));

        $wp_customize->add_control('font_pairing_control', array(
            'label' => esc_html__('Font Pairing', 'blockbiva'),
            'section' => 'blockbiva_typography_settings',
            'settings' => 'font_pairing',
            'type' => 'select',
            'choices' => array(
                'modern' => esc_html__('Modern (Outfit / Inter)', 'blockbiva'),
                'classic' => esc_html__('Classic (Playfair Display / Lora)', 'blockbiva'),
                'minimal' => esc_html__('Minimal (Inter / Inter)', 'blockbiva'),
                'geometric' => esc_html__('Geometric (Montserrat / Inter)', 'blockbiva'),
            ),
        ));

        // Advanced Typography: Heading Line Height
        $wp_customize->add_setting('heading_line_height', array(
            'default' => 1.2,
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'refresh',
        ));

        $wp_customize->add_control(new Blockbiva_Range_Control($wp_customize, 'heading_line_height_control', array(
            'label' => esc_html__('Heading Line Height', 'blockbiva'),
            'section' => 'blockbiva_typography_settings',
            'settings' => 'heading_line_height',
            'input_attrs' => array('min' => 0.8, 'max' => 2.0, 'step' => 0.1),
        )));

        // Advanced Typography: Body Line Height
        $wp_customize->add_setting('body_line_height', array(
            'default' => 1.7,
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'refresh',
        ));

        $wp_customize->add_control(new Blockbiva_Range_Control($wp_customize, 'body_line_height_control', array(
            'label' => esc_html__('Body Line Height', 'blockbiva'),
            'section' => 'blockbiva_typography_settings',
            'settings' => 'body_line_height',
            'input_attrs' => array('min' => 1.0, 'max' => 2.5, 'step' => 0.1),
        )));

        // 6. Section: Footer Settings
        $wp_customize->add_section('blockbiva_footer_settings', array(
            'title' => esc_html__('Footer Settings', 'blockbiva'),
            'panel' => 'blockbiva_theme_options',
        ));

        // Copyright Text
        $wp_customize->add_setting('copyright_text', array(
            'default' => sprintf(esc_html__('© %s Blockbiva Pro. All rights reserved.', 'blockbiva'), date('Y')),
            'sanitize_callback' => 'wp_kses_post',
            'transport' => 'refresh',
        ));

        $wp_customize->add_control('copyright_text_control', array(
            'label' => esc_html__('Copyright Text', 'blockbiva'),
            'section' => 'blockbiva_footer_settings',
            'settings' => 'copyright_text',
            'type' => 'textarea',
        ));

        // Show Footer Widgets
        $wp_customize->add_setting('show_footer_widgets', array(
            'default' => true,
            'sanitize_callback' => 'rest_sanitize_boolean',
            'transport' => 'refresh',
        ));

        $wp_customize->add_control('show_footer_widgets_control', array(
            'label' => esc_html__('Show Footer Widgets', 'blockbiva'),
            'section' => 'blockbiva_footer_settings',
            'settings' => 'show_footer_widgets',
            'type' => 'checkbox',
        ));

        // 7. Section: Design Tokens & Spacing
        $wp_customize->add_section('blockbiva_tokens_settings', array(
            'title' => esc_html__('Design Tokens & Spacing', 'blockbiva'),
            'panel' => 'blockbiva_theme_options',
        ));

        // Global Border Radius
        $wp_customize->add_setting('global_border_radius', array(
            'default' => 16,
            'sanitize_callback' => 'absint',
            'transport' => 'refresh',
        ));

        $wp_customize->add_control(new Blockbiva_Range_Control($wp_customize, 'global_border_radius_control', array(
            'label' => esc_html__('Global Border Radius', 'blockbiva'),
            'section' => 'blockbiva_tokens_settings',
            'settings' => 'global_border_radius',
            'input_attrs' => array('min' => 0, 'max' => 40, 'step' => 1),
        )));

        // Section Spacing
        $wp_customize->add_setting('section_spacing_desktop', array('default' => 4, 'sanitize_callback' => 'absint', 'transport' => 'refresh'));
        $wp_customize->add_setting('section_spacing_tablet', array('default' => 3, 'sanitize_callback' => 'absint', 'transport' => 'refresh'));
        $wp_customize->add_setting('section_spacing_mobile', array('default' => 2, 'sanitize_callback' => 'absint', 'transport' => 'refresh'));

        $wp_customize->add_control(new Blockbiva_Range_Control($wp_customize, 'section_spacing_responsive', array(
            'label' => esc_html__('Section Vertical Spacing', 'blockbiva'),
            'section' => 'blockbiva_tokens_settings',
            'devices' => array('desktop', 'tablet', 'mobile'),
            'settings' => array(
                'desktop' => 'section_spacing_desktop',
                'tablet' => 'section_spacing_tablet',
                'mobile' => 'section_spacing_mobile',
            ),
            'input_attrs' => array('min' => 1, 'max' => 12, 'step' => 1),
        )));

        // Blog Grid Columns
        $wp_customize->add_setting('blog_grid_columns', array(
            'default' => '3',
            'sanitize_callback' => 'blockbiva_sanitize_select',
            'transport' => 'refresh',
        ));

        $wp_customize->add_control('blog_grid_columns_control', array(
            'label' => esc_html__('Blog Post Columns', 'blockbiva'),
            'section' => 'blockbiva_tokens_settings',
            'settings' => 'blog_grid_columns',
            'type' => 'select',
            'choices' => array(
                '1' => esc_html__('1 Column', 'blockbiva'),
                '2' => esc_html__('2 Columns', 'blockbiva'),
                '3' => esc_html__('3 Columns', 'blockbiva'),
                '4' => esc_html__('4 Columns', 'blockbiva'),
            ),
        ));

        // 8. Section: Smooth Scroll & Back to Top
        $wp_customize->add_section('blockbiva_scroll_settings', array(
            'title' => esc_html__('Smooth Scroll & Back to Top', 'blockbiva'),
            'panel' => 'blockbiva_theme_options',
        ));

        // Setting: Enable Back to Top
        $wp_customize->add_setting('scroll_to_top_enable', array(
            'default' => true,
            'sanitize_callback' => 'rest_sanitize_boolean',
            'transport' => 'refresh',
        ));

        $wp_customize->add_control('scroll_to_top_enable_control', array(
            'label' => esc_html__('Enable Back to Top Button', 'blockbiva'),
            'section' => 'blockbiva_scroll_settings',
            'settings' => 'scroll_to_top_enable',
            'type' => 'checkbox',
        ));

        // Setting: Back to Top Icon
        $wp_customize->add_setting('scroll_to_top_icon', array(
            'default' => 'arrow',
            'sanitize_callback' => 'blockbiva_sanitize_select',
            'transport' => 'refresh',
        ));

        $wp_customize->add_control('scroll_to_top_icon_control', array(
            'label' => esc_html__('Button Icon', 'blockbiva'),
            'section' => 'blockbiva_scroll_settings',
            'settings' => 'scroll_to_top_icon',
            'type' => 'select',
            'choices' => array(
                'arrow' => esc_html__('Arrow Up', 'blockbiva'),
                'chevron' => esc_html__('Chevron Up', 'blockbiva'),
                'caret' => esc_html__('Caret Up', 'blockbiva'),
                'plus' => esc_html__('Plus Icon', 'blockbiva'),
            ),
        ));

        // Setting: Position
        $wp_customize->add_setting('scroll_to_top_position', array(
            'default' => 'right',
            'sanitize_callback' => 'blockbiva_sanitize_select',
            'transport' => 'refresh',
        ));

        $wp_customize->add_control('scroll_to_top_position_control', array(
            'label' => esc_html__('Button Position', 'blockbiva'),
            'section' => 'blockbiva_scroll_settings',
            'settings' => 'scroll_to_top_position',
            'type' => 'radio',
            'choices' => array(
                'left' => esc_html__('Left Side', 'blockbiva'),
                'right' => esc_html__('Right Side', 'blockbiva'),
            ),
        ));

        // Setting: Button Color
        $wp_customize->add_setting('scroll_to_top_color', array(
            'default' => '#6366f1',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'refresh',
        ));

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'scroll_to_top_color_control', array(
            'label' => esc_html__('Button Background Color', 'blockbiva'),
            'section' => 'blockbiva_scroll_settings',
            'settings' => 'scroll_to_top_color',
        )));
    }

    /**
     * Render Dynamic CSS based on Customizer settings
     */
    public function render_dynamic_css()
    {
        $primary_color = get_theme_mod('primary_color', '#6366f1');
        $secondary_color = get_theme_mod('secondary_color', '#0ea5e9');
        $sticky_header = get_theme_mod('sticky_header', true);
        $font_pairing = get_theme_mod('font_pairing', 'geometric');
        $show_footer_widgets = get_theme_mod('show_footer_widgets', true);
        $content_width = get_theme_mod('layout_content_width', 1200);
        $nav_alignment = get_theme_mod('nav_alignment', 'right');
        $header_opacity = get_theme_mod('header_transparency', 82) / 100;
        $menu_size = get_theme_mod('menu_font_size', 16);
        $menu_weight = get_theme_mod('menu_font_weight', '600');

        // New Header Vars
        $logo_desktop = get_theme_mod('logo_width_desktop', 120);
        $logo_tablet = get_theme_mod('logo_width_tablet', 100);
        $logo_mobile = get_theme_mod('logo_width_mobile', 80);

        $menu_gap_desktop = get_theme_mod('menu_gap_desktop', 2);
        $menu_gap_tablet = get_theme_mod('menu_gap_tablet', 1);

        $menu_letter_spacing = get_theme_mod('menu_letter_spacing', 0.5);

        $menu_color = get_theme_mod('menu_link_color', '#1e293b');
        $menu_hover = get_theme_mod('menu_link_hover_color', '#6366f1');

        $header_padding_desktop = get_theme_mod('header_padding_desktop', 20);
        $header_padding_tablet = get_theme_mod('header_padding_tablet', 15);
        $header_padding_mobile = get_theme_mod('header_padding_mobile', 10);

        $border_radius = get_theme_mod('global_border_radius', 16);
        $border_radius = get_theme_mod('global_border_radius', 16);
        $section_spacing_desktop = get_theme_mod('section_spacing_desktop', 4);
        $section_spacing_tablet = get_theme_mod('section_spacing_tablet', 3);
        $section_spacing_mobile = get_theme_mod('section_spacing_mobile', 2);

        // Responsive Spacing Values
        $top_desktop = get_theme_mod('content_top_spacing_desktop', 60);
        $top_tablet = get_theme_mod('content_top_spacing_tablet', 40);
        $top_mobile = get_theme_mod('content_top_spacing_mobile', 30);

        $bottom_desktop = get_theme_mod('content_bottom_spacing_desktop', 60);
        $bottom_tablet = get_theme_mod('content_bottom_spacing_tablet', 40);
        $bottom_mobile = get_theme_mod('content_bottom_spacing_mobile', 30);

        $edge_desktop = get_theme_mod('content_edge_spacing_desktop', 5);
        $edge_tablet = get_theme_mod('content_edge_spacing_tablet', 24);
        $edge_mobile = get_theme_mod('content_edge_spacing_mobile', 16);

        $narrow_width = get_theme_mod('narrow_container_width', 750);
        $wide_offset = get_theme_mod('wide_alignment_offset', 130);

        // Advanced Options
        $accent_3 = get_theme_mod('accent_color_3', '#f43f5e');
        $surface_variation = get_theme_mod('surface_variation_color', '#f8fafc');
        $heading_lh = get_theme_mod('heading_line_height', 1.2);
        $body_lh = get_theme_mod('body_line_height', 1.7);
        $stt_enable = get_theme_mod('scroll_to_top_enable', true);
        $stt_color = get_theme_mod('scroll_to_top_color', '#6366f1');
        $stt_pos = get_theme_mod('scroll_to_top_position', 'right');
        $header_auto_hide = get_theme_mod('header_auto_hide', false);

        $dynamic_css = "";

        // Design Tokens & Global Styles (Desktop Defaults)
        $dynamic_css .= "
            :root {
                --radius-global: {$border_radius}px !important;
                --radius-sm: " . ($border_radius * 0.5) . "px !important;
                --radius-md: {$border_radius}px !important;
                --radius-lg: " . ($border_radius * 1.5) . "px !important;
                --radius-xl: " . ($border_radius * 2) . "px !important;
                --section-spacing: {$section_spacing_desktop}rem !important;
                --wp--style--global--content-size: {$content_width}px !important;
                --wp--style--global--wide-size: " . ($content_width + ($wide_offset * 1.5)) . "px !important;
                --narrow-content-size: {$narrow_width}px !important;
                
                /* Advanced presets */
                --wp--preset--color--accent-3: {$accent_3} !important;
                --wp--preset--color--surface-variation: {$surface_variation} !important;
                --heading-line-height: {$heading_lh} !important;
                --body-line-height: {$body_lh} !important;
                
                /* Responsive Content Spacing */
                --content-top-spacing: {$top_desktop}px !important;
                --content-bottom-spacing: {$bottom_desktop}px !important;
                --wp--style--root--padding-right: {$edge_desktop}% !important;
                --wp--style--root--padding-left: {$edge_desktop}% !important;
                
                /* Header & Nav */
                --logo-width: {$logo_desktop}px !important;
                --menu-gap: {$menu_gap_desktop}rem !important;
                --menu-letter-spacing: {$menu_letter_spacing}px !important;
                --menu-color: {$menu_color} !important;
                --menu-hover: {$menu_hover} !important;
                --header-padding: {$header_padding_desktop}px !important;
                
                /* Smooth Scroll Button */
                --stt-color: {$stt_color} !important;
                --stt-color-hover: " . $this->hex2rgba($stt_color, 0.8) . " !important;
            }

            body {
                line-height: var(--body-line-height) !important;
            }

            h1, h2, h3, h4, h5, h6 {
                line-height: var(--heading-line-height) !important;
            }

            @media (max-width: 1024px) {
                :root {
                    --content-top-spacing: {$top_tablet}px !important;
                    --content-bottom-spacing: {$bottom_tablet}px !important;
                    --wp--style--root--padding-right: {$edge_tablet}px !important;
                    --wp--style--root--padding-left: {$edge_tablet}px !important;
                    --section-spacing: {$section_spacing_tablet}rem !important;
                    
                    --logo-width: {$logo_tablet}px !important;
                    --menu-gap: {$menu_gap_tablet}rem !important;
                    --header-padding: {$header_padding_tablet}px !important;
                }
            }

            @media (max-width: 768px) {
                :root {
                    --content-top-spacing: {$top_mobile}px !important;
                    --content-bottom-spacing: {$bottom_mobile}px !important;
                    --wp--style--root--padding-right: {$edge_mobile}px !important;
                    --wp--style--root--padding-left: {$edge_mobile}px !important;
                    --section-spacing: {$section_spacing_mobile}rem !important;
                    
                    --logo-width: {$logo_mobile}px !important;
                    --header-padding: {$header_padding_mobile}px !important;
                }
            }
        ";

        // Header Transparency & Menu Styling
        $dynamic_css .= "
            header, .site-header, .wp-block-template-part-header {
                background-color: rgba(255, 255, 255, {$header_opacity}) !important;
                transition: transform 0.3s ease-in-out, background-color 0.3s ease-in-out !important;
            }
            body.is-dark-theme header, body.is-dark-theme .site-header, body.is-dark-theme .wp-block-template-part-header {
                background-color: rgba(15, 23, 42, {$header_opacity}) !important;
            }
            " . ($header_auto_hide ? "
            .header-hidden {
                transform: translateY(-100%);
            }" : "") . "

            .wp-block-navigation .wp-block-navigation-item__content {
                font-size: {$menu_size}px !important;
                font-weight: {$menu_weight} !important;
                color: var(--menu-color) !important;
                letter-spacing: var(--menu-letter-spacing) !important;
            }
            .wp-block-navigation .wp-block-navigation-item__content:hover,
            .wp-block-navigation .wp-block-navigation-item__content:focus {
                color: var(--menu-hover) !important;
                text-decoration: none !important;
            }
            /* Enhanced Logo Selector */
            .wp-block-site-logo, 
            .wp-block-site-logo img,
            .custom-logo-link img {
                width: var(--logo-width) !important;
                max-width: 100% !important;
                height: auto !important;
            }
            /* Header Padding - Super Specific to override block styles */
            header.wp-block-group,
            .wp-block-template-part-header,
            .site-header,
            header {
                padding-top: var(--header-padding) !important;
                padding-bottom: var(--header-padding) !important;
                min-height: auto !important;
            }
            .wp-block-navigation .wp-block-navigation-item {
                margin-left: 0 !important;
                margin-right: 0 !important;
            }
            .wp-block-navigation,
            .wp-block-navigation .wp-block-page-list {
                gap: var(--menu-gap) !important;
                flex-wrap: wrap !important;
            }
        ";

        // Navigation Alignment
        $nav_justify = 'flex-end';
        if ($nav_alignment === 'center')
            $nav_justify = 'center';
        if ($nav_alignment === 'left')
            $nav_justify = 'flex-start';

        $dynamic_css .= "
            .wp-block-navigation {
                justify-content: {$nav_justify} !important;
            }
        ";

        // Scroll to Top Styles
        if ($stt_enable) {
            $dynamic_css .= "
                .blockbiva-scroll-to-top {
                    position: fixed;
                    bottom: 30px;
                    {$stt_pos}: 30px;
                    width: 50px;
                    height: 50px;
                    background: var(--stt-color) !important;
                    color: #fff !important;
                    border-radius: var(--radius-global) !important;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    cursor: pointer;
                    z-index: 9999;
                    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    opacity: 0;
                    visibility: hidden;
                    transform: translateY(20px);
                    border: none;
                }
                .blockbiva-scroll-to-top.is-visible {
                    opacity: 1;
                    visibility: visible;
                    transform: translateY(0);
                }
                .blockbiva-scroll-to-top:hover {
                    background: var(--stt-color-hover) !important;
                    transform: translateY(-5px);
                }
                .blockbiva-scroll-to-top svg {
                    width: 24px;
                    height: 24px;
                    fill: currentColor;
                }
            ";
        }

        // Font Pairings
        if ($font_pairing !== 'geometric') {
            switch ($font_pairing) {
                case 'classic':
                    $dynamic_css .= "
                        :root {
                            --wp--preset--font-family--heading: 'Playfair Display', serif !important;
                            --wp--preset--font-family--body: 'Lora', serif !important;
                        }
                    ";
                    break;
                case 'minimal':
                    $dynamic_css .= "
                        :root {
                            --wp--preset--font-family--heading: 'Inter', sans-serif !important;
                            --wp--preset--font-family--body: 'Inter', sans-serif !important;
                        }
                    ";
                    break;
                case 'modern':
                    $dynamic_css .= "
                        :root {
                            --wp--preset--font-family--heading: 'Outfit', sans-serif !important;
                            --wp--preset--font-family--body: 'Inter', sans-serif !important;
                        }
                    ";
                    break;
            }
        }


        // Blog Grid Columns
        $blog_columns = get_theme_mod('blog_grid_columns', '3');
        $dynamic_css .= "
            .wp-block-post-template.is-flex-container {
                display: grid !important;
                grid-template-columns: repeat({$blog_columns}, 1fr) !important;
                gap: 2rem !important;
            }
            @media (max-width: 1024px) {
                .wp-block-post-template.is-flex-container {
                    grid-template-columns: repeat(2, 1fr) !important;
                }
            }
            @media (max-width: 600px) {
                .wp-block-post-template.is-flex-container {
                    grid-template-columns: 1fr !important;
                }
            }
        ";

        if (!empty($dynamic_css)) {
            // Enqueue the dynamic CSS properly
            wp_add_inline_style('blockbiva-style', $dynamic_css);
        }

    }

    /**
     * Helper: Hex to RGBA
     */
    private function hex2rgba($color, $opacity = false)
    {
        $default = 'rgb(0,0,0)';
        if (empty($color))
            return $default;
        if ($color[0] == '#') {
            $color = substr($color, 1);
        }
        if (strlen($color) == 6) {
            $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
        } elseif (strlen($color) == 3) {
            $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
        } else {
            return $default;
        }
        $rgb = array_map('hexdec', $hex);
        if ($opacity) {
            if (abs($opacity) > 1)
                $opacity = 1.0;
            $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
        } else {
            $output = 'rgb(' . implode(",", $rgb) . ')';
        }
        return $output;
    }

    /**
     * Render Scroll to Top Button
     */
    public function render_scroll_to_top()
    {
        if (!get_theme_mod('scroll_to_top_enable', true)) {
            return;
        }

        $icon_type = get_theme_mod('scroll_to_top_icon', 'arrow');
        $svg = '';

        switch ($icon_type) {
            case 'chevron':
                $svg = '<svg viewBox="0 0 24 24"><path d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z"/></svg>';
                break;
            case 'caret':
                $svg = '<svg viewBox="0 0 24 24"><path d="M7 14l5-5 5 5z"/></svg>';
                break;
            case 'plus':
                $svg = '<svg viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>';
                break;
            case 'arrow':
            default:
                $svg = '<svg viewBox="0 0 24 24"><path d="M4 12l1.41 1.41L11 7.83V20h2V7.83l5.58 5.59L20 12l-8-8-8 8z"/></svg>';
                break;
        }

        printf(
            '<button class="blockbiva-scroll-to-top" aria-label="%s">%s</button>',
            esc_attr__('Scroll to top', 'blockbiva'),
            $svg
        );
    }
}

/**
 * Sanitize select options safely
 */
function blockbiva_sanitize_select($input, $setting)
{
    if (!is_object($setting) || !isset($setting->manager)) {
        return $input;
    }
    $control = $setting->manager->get_control($setting->id);
    if (!$control || !isset($control->choices)) {
        return $input;
    }
    return (array_key_exists($input, $control->choices) ? $input : $setting->default);
}

new Blockbiva_Customizer();
