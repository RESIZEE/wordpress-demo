<?php
$class   = array_key_exists( 'class', $args ) ? $args['class'] : '';
$style   = array_key_exists( 'style', $args ) ? $args['style'] : '';
$message = array_key_exists( 'message', $args ) ? $args['message'] : __( 'Success', 'demo' );
?>

<div
        class="success-alert alert alert-success <?php echo $class ?>"
        style="<?php echo $style ?>"
        role="alert"
>
    <?php echo $message ?>
</div>
