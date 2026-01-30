<?php
/**
 * Render template for Features block.
 */

if (!defined('ABSPATH')) {
    exit;
}

$wrapper_attributes = get_block_wrapper_attributes(array(
    'class' => 'blockbiva-features-block',
));
?>
<div <?php echo $wrapper_attributes; ?>>
    <?php echo $content; ?>
</div>