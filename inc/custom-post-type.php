<?php

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