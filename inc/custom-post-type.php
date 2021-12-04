<?php

// Hook for adding custom post types
add_action('init', 'demo_post_types');
function demo_post_types() {
    register_post_type(
        'movie',
        [
            'labels' => [
                'name' => __('Movies', 'demo'),
                'singular_name' => __('Movie', 'demo'),
                'add_new_item' => __('Add New Movie', 'demo'),
                'edit_item' => __('Edit Movie', 'demo'),
                'all_items' => __('All Movies', 'demo'),
                'view_item' => __('View Movie', 'demo'),
                'menu_name' => __('Movies', 'demo'),
                'update_item' => __('Update Movie', 'demo'),
                'search_items' => __('Search Movie', 'demo'),
            ],
            'description' => 'Movies and reviews.',
            'public' => true,
            'menu_icon' => 'dashicons-video-alt2',
            'has_archive' => true,
            'rewrite' => ['slug' => 'movies'],
            'supports' => [
                'title',
                'editor',
                'excerpt',
                'comments',
            ],
            'taxonomies' => [
                'category',
            ],
        ]
    );
}