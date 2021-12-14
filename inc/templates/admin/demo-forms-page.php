<h1>Demo Forms Options</h1>

<?php settings_errors(); ?>
<form action="options.php" method="POST" id="newsletter-form">
    <?php
    settings_fields( 'demo-newsletter-form-group' );
    do_settings_sections( 'resize_demo_forms' );
    submit_button();
    ?>
</form>

