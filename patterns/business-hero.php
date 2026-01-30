<?php
/**
 * Title: Business Hero Blockbiva
 * Slug: blockbiva/business-hero
 * Categories: banner, featured
 * Description: A high-end business hero with glassmorphism and modern typography.
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}},"color":{"gradient":"linear-gradient(135deg,#0f172a 0%,#1e293b 100%)","text":"#ffffff"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-text-color has-background"
    style="background:linear-gradient(135deg,#0f172a 0%,#1e293b 100%);color:#ffffff;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">

    <!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|50"}}}} -->
    <div class="wp-block-columns alignwide are-vertically-aligned-center">

        <!-- wp:column {"verticalAlignment":"center","width":"55%"} -->
        <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:55%">

            <!-- wp:heading {"level":1,"style":{"typography":{"fontWeight":"900","lineHeight":"1","fontSize":"clamp(3rem, 6vw, 4.5rem)","letterSpacing":"-0.04em"}}} -->
            <h1 class="wp-block-heading"
                style="font-size:clamp(3rem, 6vw, 4.5rem);font-weight:900;letter-spacing:-0.04em;line-height:1">
                Future-Proof Your Business Identity.</h1>
            <!-- /wp:heading -->

            <!-- wp:spacer {"height":"var:preset|spacing|30"} -->
            <div style="height:var(--wp--preset--spacing--30)" aria-hidden="true" class="wp-block-spacer"></div>
            <!-- /wp:spacer -->

            <!-- wp:paragraph {"style":{"typography":{"fontSize":"1.25rem","lineHeight":"1.6"},"color":{"text":"#cbd5e1"}}} -->
            <p style="color:#cbd5e1;font-size:1.25rem;line-height:1.6">Blockbiva themes aren't just about looks—they're
                about performance, conversion, and surgical precision in user experience. Build your legacy today.</p>
            <!-- /wp:paragraph -->

            <!-- wp:spacer {"height":"var:preset|spacing|40"} -->
            <div style="height:var(--wp--preset--spacing--40)" aria-hidden="true" class="wp-block-spacer"></div>
            <!-- /wp:spacer -->

            <!-- wp:buttons -->
            <div class="wp-block-buttons">
                <!-- wp:button {"className":"is-style-fill","style":{"spacing":{"padding":{"top":"1rem","bottom":"1rem","left":"2.5rem","right":"2.5rem"}}}} -->
                <div class="wp-block-button is-style-fill"><a class="wp-block-button__link wp-element-button"
                        style="padding-top:1rem;padding-right:2.5rem;padding-bottom:1rem;padding-left:2.5rem">Launch
                        Project</a></div>
                <!-- /wp:button -->

                <!-- wp:button {"className":"is-style-outline","style":{"spacing":{"padding":{"top":"1rem","bottom":"1rem","left":"2.5rem","right":"2.5rem"}}}} -->
                <div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button"
                        style="padding-top:1rem;padding-right:2.5rem;padding-bottom:1rem;padding-left:2.5rem">Explore
                        Features</a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->

        </div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"center","width":"45%"} -->
        <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:45%">
            <!-- wp:group {"className":"is-style-blockbiva-glass","style":{"spacing":{"padding":{"top":"10px","bottom":"10px","left":"10px","right":"10px"}}}} -->
            <div class="wp-block-group is-style-blockbiva-glass"
                style="padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">
                <!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"12px"}}} -->
                <figure class="wp-block-image size-large"><img
                        src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                        alt="Data Analytics" style="border-radius:12px" /></figure>
                <!-- /wp:image -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->