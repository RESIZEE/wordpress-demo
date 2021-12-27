<?php
$class   = array_key_exists( 'class', $args ) ? $args['class'] : '';
$style   = array_key_exists( 'style', $args ) ? $args['style'] : '';
$message = array_key_exists( 'message', $args ) ? $args['message'] : __( 'Error', 'demo' );
?>

<div
        class="error-alert alert alert-danger <?php echo $class ?>"
        style="<?php echo $style ?>"
        role="alert"
>
    <?php echo $message ?>
</div>
