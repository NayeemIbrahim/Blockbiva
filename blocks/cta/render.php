<?php
/**
 * Render template for CTA block.
 */

if (!defined('ABSPATH')) {
    exit;
}

$wrapper_attributes = get_block_wrapper_attributes(array(
    'class' => 'blockbiva-cta-block',
));
?>
<section <?php echo $wrapper_attributes; ?>>
    <div class="blockbiva-cta-inner">
        <?php echo $content; ?>
    </div>
</section>