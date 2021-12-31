<?php

// Advanced Custom Fields integration
define( 'ACF_PATH', get_stylesheet_directory() . '/inc/acf/' );
define( 'ACF_URL', get_stylesheet_directory_uri() . '/inc/acf/' );

// Include the ACF plugin.
include_once( ACF_PATH . 'acf.php' );

// Customize the url setting to fix incorrect asset URLs.
add_filter( 'acf/settings/url', 'demo_acf_settings_url' );
function demo_acf_settings_url( $url ) {
	return ACF_URL;
}

// Hide/Show ACF in Admin Panel, HIDE FOR PRODUCTION
add_filter( 'acf/settings/show_admin', 'demo_acf_settings_show_admin' );
function demo_acf_settings_show_admin( $show_admin ) {
	return get_option( 'acf_active' );
}

require_once 'custom-fields.php';
