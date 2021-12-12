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

// Edit default columns in post type
add_filter('manage_demo-contact_posts_columns', 'demo_contact_columns');

function demo_contact_columns($columns)
{
    $newColumns = [];
    $newColumns['title'] = 'Full Name';
    $newColumns['message'] = 'Message';
    $newColumns['email'] = 'E-mail';
    $newColumns['date'] = 'Date';
    return $newColumns;
}


//Create new custom columns in post type 
add_action('manage_demo-contact_posts_custom_column', 'demo_contact_custom_columns', 10, 2);

function demo_contact_custom_columns($column, $post_id)
{
    switch ($column) {
        case 'message':
            echo get_the_excerpt();
            break;

        case 'email':
            $email = get_post_meta($post_id, '_contact_email_value_key', true);
            echo '<a href="mailto:' . $email . '">' . $email . '</a>';
            break;
    }
}


//Custom meta boxes for contact
add_action('add_meta_boxes', 'demo_contact_add_meta_box');
function demo_contact_add_meta_box()
{
    //Email metabox
    add_meta_box('contact_email', 'User Email', 'demo_contact_email', 'demo-contact', 'side');
}

function demo_contact_email($post)
{
    wp_nonce_field('demo_save_contact_email_data', 'demo_contact_metabox_nonce');

    $emailValue = get_post_meta($post->ID, '_contact_email_value_key', true);

    echo '<label for="demo_contact_email_field">User Email Address: </label>';
    echo '<input type="email" id="demo_contact_email_field" name="demo_contact_email_field" value="' . esc_attr($emailValue) . '"size="25" />';
}


//Save custom meta boxes for contact
add_action('save_post', 'demo_save_contact_email_data');
function demo_save_contact_email_data($post_id)
{
    //Check if nonce is not setted
    if (!isset($_POST['demo_contact_metabox_nonce'])) {
        return;
    }

    //Check if nonce is valid (genereted by WordPress and not manually)
    if (!wp_verify_nonce($_POST['demo_contact_metabox_nonce'], 'demo_save_contact_email_data')) {
        return;
    }

    //Check if is auto-saved or not
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    //Check if user have permission
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    //Check if we pass something inside email input
    if (!isset($_POST['demo_contact_email_field'])) {
        return;
    }

    $dataToStore = sanitize_text_field($_POST['demo_contact_email_field']);

    update_post_meta($post_id, '_contact_email_value_key', $dataToStore);
}
