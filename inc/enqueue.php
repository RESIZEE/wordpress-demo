<?php

add_action('wp_enqueue_scripts', 'demo_resources');
function demo_resources() {
    /* Styles */
    wp_enqueue_style(
        'font-awesome',
        '//use.fontawesome.com/releases/v5.15.4/css/all.css'
    );
    wp_enqueue_style(
        'bootstrap',
        get_theme_file_uri('/css/bootstrap.min.css'),
    );
    wp_enqueue_style(
        'demo-main',
        get_stylesheet_uri(),
        null,
        microtime()
    );

    /* Scripts */
    wp_enqueue_script(
        'demo-main-bundled',
        get_theme_file_uri('/js/scripts-bundled.js'),
        null,
        microtime(),
        true,
    );
    wp_enqueue_script(
        'bootstrap-bundled',
        get_theme_file_uri('/js/bootstrap.bundle.min.js'),
        null,
        microtime(),
        true,
    );
}