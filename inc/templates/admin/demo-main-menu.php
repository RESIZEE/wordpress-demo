<h1>Demo Theme Options</h1>

<?php settings_errors(); ?>
<form action="options.php" method="POST">
    <?php
    settings_fields( 'demo-settings-group' );
    do_settings_sections( 'resize_demo' );
    submit_button();
    ?>

</form>

