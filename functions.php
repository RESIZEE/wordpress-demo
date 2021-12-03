<?php

add_action('wp_enqueue_scripts', 'demo_resources');
function demo_resources() {
    /* Styles */
    wp_enqueue_style(
        'demo-main',
        get_stylesheet_uri(),
        null,
        microtime()
    );
    wp_enqueue_style(
        'font-awesome',
        '//use.fontawesome.com/releases/v5.15.4/css/all.css'
    );
    wp_enqueue_style(
        'bootstrap',
        get_theme_file_uri('/css/bootstrap.min.css'),
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

// Hook for adding custom post types
add_action('init', 'demo_post_types');
function demo_post_types() {
    register_post_type(
        'movie',
        [
            'labels' => [
                'name' => 'Movies',
                'singular_name' => 'Movie',
                'add_new_item' => 'Add New Movie',
                'edit_item' => 'Edit Movie',
                'all_items' => 'All Movies',
            ],
            'description' => 'Post type representing movies.',
            'public' => true,
            'menu_icon' => 'dashicons-video-alt2',
            'has_archive' => true,
        ]
    );
}