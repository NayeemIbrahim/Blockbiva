<?php
/**
 * Title: Business Testimonials Blockbiva
 * Slug: blockbiva/business-testimonials
 * Categories: testimonials, social
 * Description: A premium testimonial grid with client avatars and elegant quote styling.
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}},"color":{"background":"var:preset|color|base"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-background"
    style="background-color:var(--wp--preset--color--base);padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">

    <!-- wp:group {"layout":{"type":"constrained","contentSize":"800px"},"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|60"}}}} -->
    <div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--60)">
        <!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontWeight":"900","fontSize":"var:preset|font-size|2xl"}}} -->
        <h2 class="wp-block-heading has-text-align-center"
            style="font-size:var(--wp--preset--font-size--2xl);font-weight:900">Trusted by Global Visionaries.</h2>
        <!-- /wp:heading -->
    </div>
    <!-- /wp:group -->

    <!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|40"}}}} -->
    <div class="wp-block-columns alignwide">

        <!-- wp:column {"className":"is-style-blockbiva-card-soft"} -->
        <div class="wp-block-column is-style-blockbiva-card-soft">
            <!-- wp:paragraph {"style":{"typography":{"fontSize":"1.125rem","lineHeight":"1.7","fontStyle":"italic"}},"color":{"text":"var:preset|color|contrast"}} -->
            <p class="has-contrast-color has-text-color" style="font-size:1.125rem;font-style:italic;line-height:1.7">
                "The transition to Blockbiva Pro was the single best technical decision we made this year. The
                performance gains are measurable, and the aesthetic is world-class."</p>
            <!-- /wp:paragraph -->

            <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|30"}}}} -->
            <div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--30)">
                <!-- wp:image {"width":48, "height":48, "sizeSlug":"full","style":{"border":{"radius":"999px"}}} -->
                <figure class="wp-block-image size-full is-resized"><img
                        src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80"
                        alt="John Doe" style="border-radius:999px" width="48" height="48" /></figure>
                <!-- /wp:image -->
                <!-- wp:group {"layout":{"type":"constrained"}} -->
                <div class="wp-block-group">
                    <!-- wp:paragraph {"style":{"typography":{"fontWeight":"700","fontSize":"1rem"}},"className":"has-no-margin-bottom"} -->
                    <p class="has-no-margin-bottom" style="font-size:1rem;font-weight:700">Marcus Thorne</p>
                    <!-- /wp:paragraph -->
                    <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.875rem"}},"color":{"text":"var:preset|color|neutral-medium"}} -->
                    <p class="has-neutral-medium-color has-text-color" style="font-size:0.875rem">CTO, Nexus Paradigm
                    </p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"className":"is-style-premium-card-soft"} -->
        <div class="wp-block-column is-style-premium-card-soft">
            <!-- wp:paragraph {"style":{"typography":{"fontSize":"1.125rem","lineHeight":"1.7","fontStyle":"italic"}},"color":{"text":"var:preset|color|contrast"}} -->
            <p class="has-contrast-color has-text-color" style="font-size:1.125rem;font-style:italic;line-height:1.7">
                "Finally, a theme that understands the balance between developer freedom and designer precision. Our
                agency has reduced delivery times by 40%."</p>
            <!-- /wp:paragraph -->

            <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|30"}}}} -->
            <div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--30)">
                <!-- wp:image {"width":48, "height":48, "sizeSlug":"full","style":{"border":{"radius":"999px"}}} -->
                <figure class="wp-block-image size-full is-resized"><img
                        src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80"
                        alt="Jane Smith" style="border-radius:999px" width="48" height="48" /></figure>
                <!-- /wp:image -->
                <!-- wp:group {"layout":{"type":"constrained"}} -->
                <div class="wp-block-group">
                    <!-- wp:paragraph {"style":{"typography":{"fontWeight":"700","fontSize":"1rem"}},"className":"has-no-margin-bottom"} -->
                    <p class="has-no-margin-bottom" style="font-size:1rem;font-weight:700">Elena Rostova</p>
                    <!-- /wp:paragraph -->
                    <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.875rem"}},"color":{"text":"var:preset|color|neutral-medium"}} -->
                    <p class="has-neutral-medium-color has-text-color" style="font-size:0.875rem">Creative Director,
                        Aura Studio</p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->