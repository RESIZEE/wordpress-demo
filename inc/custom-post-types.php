<?php

// Hook for adding custom post types
add_action('init', 'demo_post_types');
function demo_post_types()
{
    register_post_type(
        'movie',
        [
            'show_in_rest' => true,
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
                'thumbnail',
                'comments',
            ],
        ]
    );
    register_post_type(
        'book',
        [
            'show_in_rest' => true,
            'labels' => [
                'name' => __('Books', 'demo'),
                'singular_name' => __('Book', 'demo'),
                'add_new_item' => __('Add New Book', 'demo'),
                'edit_item' => __('Edit Book', 'demo'),
                'all_items' => __('All Books', 'demo'),
                'view_item' => __('View Book', 'demo'),
                'menu_name' => __('Books', 'demo'),
                'update_item' => __('Update Book', 'demo'),
                'search_item' => __('Search Book', 'demo'),
            ],
            'description' => 'Books and reviews.',
            'public' => true,
            'menu_icon' => 'dashicons-book-alt',
            'has_archive' => true,
            'rewrite' => ['slug' => 'books'],
            'supports' => [
                'title',
                'editor',
                'excerpt',
                'thumbnail',
                'comments',
            ],
        ]
    );
    register_post_type(
        'game',
        [
            'public' => true,
            'show_in_rest' => true,
            'labels' => [
                'name' => __('Games', 'demo'),
                'add_new_item' => __('Add New Game', 'demo'),
                'edit_item' => __('Edit Game', 'demo'),
                'all_items' => __('All Games', 'demo'),
                'singular_name' => __('Game'),
            ],
            'description' => 'Games and reviews.',
            'menu_icon' => 'dashicons-games',
            'has_archive' => true,
            'rewrite' => ['slug' => 'games'],
            'supports' => [
                'title',
                'editor',
                'excerpt',
                'thumbnail',
                'comments',
            ],
        ]
    );
    register_post_type(
        'review',
        [
            'labels' => [
                'name' => __('Reviews', 'demo'),
                'singular_name' => __('Review', 'demo'),
                'add_new_item' => __('Add New Review', 'demo'),
                'edit_item' => __('Edit Review', 'demo'),
                'all_items' => __('All Reviews', 'demo'),
                'view_item' => __('View Review', 'demo'),
                'menu_name' => __('Reviews', 'demo'),
                'update_item' => __('Update Review', 'demo'),
                'search_items' => __('Search Review', 'demo'),
            ],
            'description' => 'Reviews.',
            'public' => false,
            'show_ui' => true,
            'menu_icon' => 'dashicons-star-filled',
            'supports' => ['title'],
        ]
    );

    register_taxonomy(
        'genre',
        [
            'movie',
            'book',
            'game',
        ],
        [
            'show_in_rest' => true,
            'labels' => [
                'name' => __('Genres', 'demo'),
                'singular_name' => __('Genre', 'demo'),
                'add_new_item' => __('Add New Genre', 'demo'),
                'new_item_name' => __('New Genre Name', 'demo'),
                'edit_item' => __('Edit Genre', 'demo'),
                'all_items' => __('All Genres', 'demo'),
                'view_item' => __('View Genre', 'demo'),
                'menu_name' => __('Genres', 'demo'),
                'update_item' => __('Update Genre', 'demo'),
                'search_items' => __('Search Genres', 'demo'),
                'no_terms' => __('No genres', 'demo'),
                'not_found' => __('No genres found', 'demo'),
            ],
            'hierarchical' => true,
            'description' => 'Genres.',
            'public' => true,
            'query_var' => false,
        ]
    );
}
