<?php


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
