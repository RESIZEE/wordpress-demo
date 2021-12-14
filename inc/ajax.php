<?php

add_action('rest_api_init', 'demo_contact_routes');
function demo_contact_routes() {
    register_rest_route(
        'demo/v1',
        'contact',
        [
            'methods' => 'POST',
            'callback' => 'demo_save_contact',
        ]
    );
}

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
    //WP Insert Post -  Insert fields (create/update) in wp database and returns ID of created post or 0 if fail
    $postID = wp_insert_post($args);

    //Check if message is saved
    if($postID !== 0){

        //Send Email to administrator
        $to = get_bloginfo('admin_email');  
        $subject = 'Demo Contact Form - '. $name;

        $headers[] = 'From: '.get_bloginfo('name').'<'.$to.'>';
        $headers[] = 'Replay-To'.$name.'<'.$email.'>';
        $headers[] = 'Content-Type: text/html: charset=UTF-8';


        wp_mail($to,$subject,$message,$headers);
        
        echo $postID;
    } else{
        echo 0;
    }

    

    die();
}
