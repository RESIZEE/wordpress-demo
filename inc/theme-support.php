<?php

add_action('after_setup_theme', 'demo_features');
function demo_features() {
    //Post-type features
    add_theme_support('post-thumbnails');

    //Image sizes
    add_image_size('card-image', 0, 500, true);
    add_image_size('single-image', 0, 450, true);

    //Custom Logo
    add_theme_support('custom-logo', [
        'height' => 100,
        'width' => 400,
        'flex-height' => true,
        'flex-width' => true,
        'unlink-homepage-logo' => true,
    ]);
}

// Advanced Custom Fields integration
define('ACF_PATH', get_stylesheet_directory() . '/inc/acf/');
define('ACF_URL', get_stylesheet_directory_uri() . '/inc/acf/');

// Include the ACF plugin.
include_once(ACF_PATH . 'acf.php');

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'demo_acf_settings_url');
function demo_acf_settings_url($url) {
    return ACF_URL;
}

// Hide/Show ACF in Admin Panel, HIDE FOR PRODUCTION
add_filter('acf/settings/show_admin', 'demo_acf_settings_show_admin');
function demo_acf_settings_show_admin($show_admin) {
    return true;
}

require_once 'custom-fields.php';