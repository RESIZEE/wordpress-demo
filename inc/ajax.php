<?php

// AJAX functions

add_action('wp_ajax_nopriv_demo_save_user_contact_form', 'demo_save_contact');
add_action('wp_ajax_demo_save_user_contact_form', 'demo_save_contact');

function demo_save_contact()
{
    $name = wp_strip_all_tags($_POST["name"]);
    $email = wp_strip_all_tags($_POST["email"]);
    $message = wp_strip_all_tags($_POST["message"]);
    

    $args = [
        'post_title' => $name,
        'post_content' => $message,
        'post_author' => 1,
        'post_type' => 'demo-contact',
        'post_status' => 'publish',
        'meta_input' => [
            '_contact_email_value_key' => $email
        ]
    ];
    //WP Insert Post -  Insert fields (create/update) in wp database and returns ID of created post
    $postID = wp_insert_post($args);

    // this is always the post ID, meaning success  
    echo $postID;

    die();
}
