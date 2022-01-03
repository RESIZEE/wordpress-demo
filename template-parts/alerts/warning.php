<?php
/**
 * Template part which displays warning alert with dynamic classes, styles and text message.
 *
 * @package demo
 */

$class   = array_key_exists( 'class', $args ) ? $args['class'] : '';
$style   = array_key_exists( 'style', $args ) ? 'style="' . $args['style'] . '"' : '';
$message = array_key_exists( 'message', $args ) ? $args['message'] : __( 'Success', 'demo' );
?>
<div
        class="alert alert-warning <?php echo $class ?>"
        <?php echo $style ?>
        role="alert"
>
    <?php echo $message ?>
</div>
