<?php
// Hook for adding custom contact form
add_action('init', 'demo_contact');

function demo_contact()
{
    register_post_type('demo-contact', [
        'labels' => [
            'name' => __('Messages', 'demo'),
            'singular_name' => __('Message', 'demo'),
            'add_new_item' => __('Add New Message', 'demo'),
            'edit_item' => __('Edit Message', 'demo'),
            'all_items' => __('All Messages', 'demo'),
            'view_item' => __('View Message', 'demo'),
            'name_admin_bar' => __('Message', 'demo')
        ],
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'supports' => [
            'title',
            'editor',
            'author'
        ],
        'menu_icon' => 'dashicons-email-alt'
    ]);
}

add_filter('manage_demo-contact_posts_columns', 'demo_contact_columns');

function demo_contact_columns()
{
    $newColumns = [];
    $newColumns['Title'] = 'Full Name';
    $newColumns['message'] = 'Message';
    $newColumns['email'] = 'E-mail';
    $newColumns['date'] = 'Date';
    return $newColumns;
}

add_action('manage_demo-contact_posts_custom_column', 'demo_contact_custom_columns', 10, 2 );

function demo_contact_custom_columns($column, $post_id)
{
    switch ($column) {
        case 'message':
            echo get_the_excerpt();
            break;

        case 'email':
            //Email column
            break;
    }
}
