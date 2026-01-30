<?php
/**
 * Gutenberg block registration and patterns.
 *
 * @package Blockbiva
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Block Management Class
 */
class Blockbiva_Blocks
{

    /**
     * Constructor
     */
    public function __construct()
    {
        add_action('init', array($this, 'register_custom_blocks'));
        add_action('init', array($this, 'register_block_patterns'));
        add_action('init', array($this, 'register_pattern_categories'));
        add_action('init', array($this, 'register_block_styles'));
    }

    /**
     * Register Block Styles
     */
    public function register_block_styles()
    {
        // Group Block Styles
        register_block_style(
            'core/group',
            array(
                'name' => 'blockbiva-card-soft',
                'label' => esc_html__('Soft Card', 'blockbiva'),
            )
        );

        register_block_style(
            'core/group',
            array(
                'name' => 'blockbiva-glass',
                'label' => esc_html__('Glassmorphism', 'blockbiva'),
            )
        );

        // Button Block Styles
        register_block_style(
            'core/button',
            array(
                'name' => 'blockbiva-gradient',
                'label' => esc_html__('Gradient', 'blockbiva'),
            )
        );

        register_block_style(
            'core/button',
            array(
                'name' => 'blockbiva-outline-bold',
                'label' => esc_html__('Outline Bold', 'blockbiva'),
            )
        );

        register_block_style(
            'core/button',
            array(
                'name' => 'blockbiva-dark',
                'label' => esc_html__('Dark', 'blockbiva'),
            )
        );

        // Image Block Styles
        register_block_style(
            'core/image',
            array(
                'name' => 'blockbiva-rounded-lg',
                'label' => esc_html__('Rounded Large', 'blockbiva'),
            )
        );
    }

    /**
     * Register Custom Gutenberg Blocks
     */
    public function register_custom_blocks()
    {
        $blocks = array(
            'hero',
            'cta',
            'pricing',
            'features',
        );

        foreach ($blocks as $block) {
            register_block_type_from_metadata(BLOCKBIVA_DIR . '/blocks/' . $block);
        }
    }

    /**
     * Register pattern categories
     */
    public function register_pattern_categories()
    {
        register_block_pattern_category(
            'blockbiva-saas',
            array('label' => esc_html__('SaaS & Tech', 'blockbiva'))
        );
    }

    /**
     * Register block patterns
     */
    public function register_block_patterns()
    {
        // 1. SaaS Hero Pattern
        register_block_pattern(
            'blockbiva/saas-hero',
            array(
                'title' => esc_html__('SaaS Hero Split', 'blockbiva'),
                'categories' => array('blockbiva-saas'),
                'content' => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|4","bottom":"var:preset|spacing|4"}}},"backgroundColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-base-background-color has-background" style="padding-top:var(--wp--preset--spacing--4);padding-bottom:var(--wp--preset--spacing--4)">
    <!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|3"}}}} -->
    <div class="wp-block-columns alignwide">
        <!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
        <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%">
            <!-- wp:heading {"level":1,"fontSize":"jumbo","style":{"typography":{"lineHeight":"1.1"}}} -->
            <h1 class="wp-block-heading has-jumbo-font-size" style="line-height:1.1">Scale Your SaaS with <span class="has-primary-color">Antigravity</span> Speed.</h1>
            <!-- /wp:heading -->
            <!-- wp:paragraph {"fontSize":"large"} -->
            <p class="has-large-font-size">The ultimate premium theme designed for high-growth tech startups and software agencies.</p>
            <!-- /wp:paragraph -->
            <!-- wp:buttons -->
            <div class="wp-block-buttons">
                <!-- wp:button {"className":"is-style-fill"} -->
                <div class="wp-block-button is-style-fill"><a class="wp-block-button__link wp-element-button">Get Started Free</a></div>
                <!-- /wp:button -->
                <!-- wp:button {"className":"is-style-outline"} -->
                <div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button">Watch Demo</a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
        </div>
        <!-- /wp:column -->
        <!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
        <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%">
            <!-- wp:image {"sizeSlug":"large","className":"blockbiva-shadow-xl blockbiva-rounded-lg"} -->
            <figure class="wp-block-image size-large blockbiva-shadow-xl blockbiva-rounded-lg"><img src="' . BLOCKBIVA_URI . '/assets/images/saas-mockup.png" alt="SaaS Mockup"/></figure>
            <!-- /wp:image -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->',
            )
        );

        // 2. SaaS Pricing Pattern
        register_block_pattern(
            'blockbiva/saas-pricing',
            array(
                'title' => esc_html__('SaaS Pricing Grid', 'blockbiva'),
                'categories' => array('blockbiva-saas'),
                'content' => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|4","bottom":"var:preset|spacing|4"}}},"backgroundColor":"neutral-light","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-neutral-light-background-color has-background" style="padding-top:var(--wp--preset--spacing--4);padding-bottom:var(--wp--preset--spacing--4)">
    <!-- wp:heading {"textAlign":"center","fontSize":"x-large"} -->
    <h2 class="wp-block-heading has-text-align-center has-x-large-font-size">Simple, Transparent Pricing</h2>
    <!-- /wp:heading -->
    <!-- wp:spacer {"height":"var:preset|spacing|2"} -->
    <div style="height:var(--wp--preset--spacing--2)" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->
    <!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|2"}}}} -->
    <div class="wp-block-columns alignwide">
        <!-- wp:column {"className":"blockbiva-card-soft"} -->
        <div class="wp-block-column blockbiva-card-soft">
            <!-- wp:heading {"level":4} -->
            <h4 class="wp-block-heading">Starter</h4>
            <!-- /wp:heading -->
            <!-- wp:paragraph {"fontSize":"jumbo","style":{"typography":{"fontWeight":"800"}}} -->
            <p class="has-jumbo-font-size" style="font-weight:800">$0</p>
            <!-- /wp:paragraph -->
            <!-- wp:list {"style":{"typography":{"lineHeight":"2"}}} -->
            <ul style="line-height:2"><li>1 Project</li><li>Basic Analytics</li><li>Community Support</li></ul>
            <!-- /wp:list -->
            <!-- wp:buttons -->
            <div class="wp-block-buttons"><!-- wp:button {"width":100,"className":"is-style-outline"} --><div class="wp-block-button has-custom-width wp-block-button__width-100 is-style-outline"><a class="wp-block-button__link wp-element-button">Get Started</a></div><!-- /wp:button --></div>
            <!-- /wp:buttons -->
        </div>
        <!-- /wp:column -->
        <!-- wp:column {"className":"blockbiva-card-soft blockbiva-shadow-lg","style":{"border":{"width":"2px","color":"var:preset|color|primary"}}} -->
        <div class="wp-block-column blockbiva-card-soft blockbiva-shadow-lg" style="border-color:var(--wp--preset--color--primary);border-width:2px">
            <!-- wp:heading {"level":4} -->
            <h4 class="wp-block-heading">Pro <span class="has-small-font-size has-primary-color">(Popular)</span></h4>
            <!-- /wp:heading -->
            <!-- wp:paragraph {"fontSize":"jumbo","style":{"typography":{"fontWeight":"800"}}} -->
            <p class="has-jumbo-font-size" style="font-weight:800">$49</p>
            <!-- /wp:paragraph -->
            <!-- wp:list {"style":{"typography":{"lineHeight":"2"}}} -->
            <ul style="line-height:2"><li>Unlimited Projects</li><li>Advanced AI Insights</li><li>Priority Support</li></ul>
            <!-- /wp:list -->
            <!-- wp:buttons -->
            <div class="wp-block-buttons"><!-- wp:button {"width":100} --><div class="wp-block-button has-custom-width wp-block-button__width-100"><a class="wp-block-button__link wp-element-button">Go Pro Now</a></div><!-- /wp:button --></div>
            <!-- /wp:buttons -->
        </div>
        <!-- /wp:column -->
        <!-- wp:column {"className":"blockbiva-card-soft"} -->
        <div class="wp-block-column blockbiva-card-soft">
            <!-- wp:heading {"level":4} -->
            <h4 class="wp-block-heading">Enterprise</h4>
            <!-- /wp:heading -->
            <!-- wp:paragraph {"fontSize":"jumbo","style":{"typography":{"fontWeight":"800"}}} -->
            <p class="has-jumbo-font-size" style="font-weight:800">$99</p>
            <!-- /wp:paragraph -->
            <!-- wp:list {"style":{"typography":{"lineHeight":"2"}}} -->
            <ul style="line-height:2"><li>Dedicated Infrastructure</li><li>Full White-label</li><li>24/7 Account Manager</li></ul>
            <!-- /wp:list -->
            <!-- wp:buttons -->
            <div class="wp-block-buttons"><!-- wp:button {"width":100,"className":"is-style-outline"} --><div class="wp-block-button has-custom-width wp-block-button__width-100 is-style-outline"><a class="wp-block-button__link wp-element-button">Contact Sales</a></div><!-- /wp:button --></div>
            <!-- /wp:buttons -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->',
            )
        );
    }
}

new Blockbiva_Blocks();
