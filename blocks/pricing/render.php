<?php
/**
 * Render template for Pricing block.
 */

if (!defined('ABSPATH')) {
    exit;
}

$wrapper_attributes = get_block_wrapper_attributes(array(
    'class' => 'blockbiva-pricing-block',
));
?>
<div <?php echo $wrapper_attributes; ?>>
    <?php echo $content; ?>
</div>