<h1><?php echo __( 'Demo Form Options', 'demo' ) ?></h1>

<?php settings_errors(); ?>
<form action="options.php" method="POST" id="newsletter-form">
    <?php
    settings_fields( 'demo-newsletter-form-group' );
    settings_fields( 'demo-forms-general-settings-group' );
    do_settings_sections( 'resize_demo_forms' );
    submit_button();
    ?>
</form>

