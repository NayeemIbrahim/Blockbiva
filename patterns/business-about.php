<?php
/**
 * Title: Business About Blockbiva
 * Slug: blockbiva/business-about
 * Categories: text, image
 * Description: A premium split layout with stats, image, and professional about section.
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}},"color":{"background":"var:preset|color|surface-variation"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-background" style="background-color:var(--wp--preset--color--surface-variation);padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">

    <!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|80"}}}} -->
    <div class="wp-block-columns alignwide are-vertically-aligned-center">

        <!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
        <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%">
            <!-- wp:group {"style":{"spacing":{"padding":{"top":"8px","bottom":"8px","left":"8px","right":"8px"}},"border":{"radius":"24px"}},"className":"is-style-blockbiva-card-soft"} -->
            <div class="wp-block-group is-style-blockbiva-card-soft" style="border-radius:24px;padding-top:8px;padding-right:8px;padding-bottom:8px;padding-left:8px">
                <!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"16px"}}} -->
                <figure class="wp-block-image size-large"><img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Team working together on digital products" style="border-radius:16px"/></figure>
                <!-- /wp:image -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
        <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%">
            <!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.15em","fontWeight":"700","fontSize":"0.8rem"},"color":{"text":"var:preset|color|primary"}}} -->
            <p style="color:var(--wp--preset--color--primary);font-size:0.8rem;font-weight:700;letter-spacing:0.15em;text-transform:uppercase">About Blockbiva</p>
            <!-- /wp:paragraph -->

            <!-- wp:heading {"level":2,"style":{"typography":{"fontWeight":"900","fontSize":"var:preset|font-size|2xl"},"spacing":{"margin":{"top":"var:preset|spacing|10"}}}} -->
            <h2 class="wp-block-heading" style="font-size:var(--wp--preset--font-size--2xl);font-weight:900;margin-top:var(--wp--preset--spacing--10)">We Don't Just Build Sites. We Engineer <span style="color:var(--wp--preset--color--primary)">Growth Machines.</span></h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"style":{"typography":{"lineHeight":"1.8","fontSize":"1.05rem"},"color":{"text":"var:preset|color|neutral-dark"}}} -->
            <p style="color:var(--wp--preset--color--neutral-dark);font-size:1.05rem;line-height:1.8">Born from the belief that every website should be a competitive advantage. We merged industrial-grade performance with award-winning design sensibilities.</p>
            <!-- /wp:paragraph -->

            <!-- wp:spacer {"height":"var:preset|spacing|20"} -->
            <div style="height:var(--wp--preset--spacing--20)" aria-hidden="true" class="wp-block-spacer"></div>
            <!-- /wp:spacer -->

            <!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"var:preset|spacing|30"}}}} -->
            <div class="wp-block-columns">
                <!-- wp:column -->
                <div class="wp-block-column">
                    <!-- wp:paragraph {"style":{"typography":{"fontSize":"2.5rem","fontWeight":"900","lineHeight":"1"},"color":{"text":"var:preset|color|primary"},"spacing":{"margin":{"bottom":"4px"}}}} -->
                    <p style="color:var(--wp--preset--color--primary);font-size:2.5rem;font-weight:900;line-height:1;margin-bottom:4px">99</p>
                    <!-- /wp:paragraph -->
                    <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.85rem","fontWeight":"600"},"color":{"text":"var:preset|color|neutral-dark"}}} -->
                    <p style="color:var(--wp--preset--color--neutral-dark);font-size:0.85rem;font-weight:600">PageSpeed Score</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:column -->
                <!-- wp:column -->
                <div class="wp-block-column">
                    <!-- wp:paragraph {"style":{"typography":{"fontSize":"2.5rem","fontWeight":"900","lineHeight":"1"},"color":{"text":"var:preset|color|primary"},"spacing":{"margin":{"bottom":"4px"}}}} -->
                    <p style="color:var(--wp--preset--color--primary);font-size:2.5rem;font-weight:900;line-height:1;margin-bottom:4px">5K+</p>
                    <!-- /wp:paragraph -->
                    <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.85rem","fontWeight":"600"},"color":{"text":"var:preset|color|neutral-dark"}}} -->
                    <p style="color:var(--wp--preset--color--neutral-dark);font-size:0.85rem;font-weight:600">Active Users</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:column -->
                <!-- wp:column -->
                <div class="wp-block-column">
                    <!-- wp:paragraph {"style":{"typography":{"fontSize":"2.5rem","fontWeight":"900","lineHeight":"1"},"color":{"text":"var:preset|color|primary"},"spacing":{"margin":{"bottom":"4px"}}}} -->
                    <p style="color:var(--wp--preset--color--primary);font-size:2.5rem;font-weight:900;line-height:1;margin-bottom:4px">0.4s</p>
                    <!-- /wp:paragraph -->
                    <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.85rem","fontWeight":"600"},"color":{"text":"var:preset|color|neutral-dark"}}} -->
                    <p style="color:var(--wp--preset--color--neutral-dark);font-size:0.85rem;font-weight:600">Avg Load Time</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:column -->
            </div>
            <!-- /wp:columns -->

            <!-- wp:spacer {"height":"var:preset|spacing|20"} -->
            <div style="height:var(--wp--preset--spacing--20)" aria-hidden="true" class="wp-block-spacer"></div>
            <!-- /wp:spacer -->

            <!-- wp:buttons -->
            <div class="wp-block-buttons">
                <!-- wp:button {"className":"is-style-fill","style":{"border":{"radius":"999px"},"spacing":{"padding":{"top":"0.875rem","bottom":"0.875rem","left":"2rem","right":"2rem"}}}} -->
                <div class="wp-block-button is-style-fill"><a class="wp-block-button__link wp-element-button" style="border-radius:999px;padding-top:0.875rem;padding-right:2rem;padding-bottom:0.875rem;padding-left:2rem">Learn Our Story →</a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
        </div>
        <!-- /wp:column -->

    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->