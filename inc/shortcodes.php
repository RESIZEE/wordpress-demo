<?php


//Contact form shortcode [contact_form]
add_shortcode('contact_form', 'demo_contact_form');
function demo_contact_form($atts, $content = null)
{
    //Get the attributes
    $atts = shortcode_atts(
        [],
        $atts,
        'contact_form'
    );

    //Return HTML
    return 'This is contact form';
}
