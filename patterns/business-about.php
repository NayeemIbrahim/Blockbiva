<?php
/**
 * Title: Business About Blockbiva
 * Slug: blockbiva/business-about
 * Categories: text, image
 * Description: A split layout with professional about section and image on left.
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}},"color":{"background":"var:preset|color|surface-variation"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-background"
    style="background-color:var(--wp--preset--color--surface-variation);padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">

    <!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|80"}}}} -->
    <div class="wp-block-columns alignwide are-vertically-aligned-center">

        <!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
        <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%">
            <!-- wp:group {"className":"is-style-blockbiva-card-soft","style":{"spacing":{"padding":{"top":"5px","bottom":"5px","left":"5px","right":"5px"}}}} -->
            <div class="wp-block-group is-style-blockbiva-card-soft"
                style="padding-top:5px;padding-right:5px;padding-bottom:5px;padding-left:5px">
                <!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"12px"}}} -->
                <figure class="wp-block-image size-large"><img
                        src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                        alt="Professional Team Collaboration" style="border-radius:12px" /></figure>
                <!-- /wp:image -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
        <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%">
            <!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.1em","fontWeight":"700","fontSize":"0.875rem"},"color":{"text":"var:preset|color|primary"}}} -->
            <p class="has-primary-color has-text-color"
                style="font-size:0.875rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">Our Legacy</p>
            <!-- /wp:paragraph -->

            <!-- wp:heading {"level":2,"style":{"typography":{"fontWeight":"900","fontSize":"var:preset|font-size|2xl"}}} -->
            <h2 class="wp-block-heading" style="font-size:var(--wp--preset--font-size--2xl);font-weight:900">Crafting
                Digital Excellence Since 2024.</h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"style":{"typography":{"lineHeight":"1.8"},"fontSize":"medium"}} -->
            <p class="has-medium-font-size" style="line-height:1.8">Blockbiva Pro was born from a simple
                observation: most websites are built to exist, not to excel. We changed that by merging industrial-grade
                performance with boutique design sensibilities.</p>
            <!-- /wp:paragraph -->

            <!-- wp:paragraph {"style":{"typography":{"lineHeight":"1.8"},"fontSize":"medium"}} -->
            <p class="has-medium-font-size" style="line-height:1.8">Our approach is surgical. We analyze, we strategist,
                and then we execute with a level of precision that turns visitors into brand advocates.</p>
            <!-- /wp:paragraph -->

            <!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
            <div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40)">
                <!-- wp:button {"className":"is-style-fill"} -->
                <div class="wp-block-button is-style-fill"><a class="wp-block-button__link wp-element-button">Discover
                        Our Mission</a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
        </div>
        <!-- /wp:column -->

    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->