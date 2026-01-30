<?php
/**
 * Render template for Blockbiva Hero block.
 *
 * @var array $attributes Block attributes.
 * @var string $content Block inner content.
 */

if (!defined('ABSPATH')) {
    exit;
}

$wrapper_attributes = get_block_wrapper_attributes(array(
    'class' => 'blockbiva-hero-block',
));
?>
<div <?php echo $wrapper_attributes; ?>>
    <div class="blockbiva-hero-content">
        <?php echo $content; ?>
    </div>
</div>