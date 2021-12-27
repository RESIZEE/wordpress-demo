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


add_action( 'phpmailer_init', 'mailtrap' );
function mailtrap( $phpmailer ) {
	$phpmailer->isSMTP();
	$phpmailer->Host     = 'smtp.mailtrap.io';
	$phpmailer->SMTPAuth = true;
	$phpmailer->Port     = 2525;
	$phpmailer->Username = '0120359271df8c';
	$phpmailer->Password = 'e729e71e2057be';
}

add_action( 'wp_mail_failed', 'log_mailer_errors', 10, 1 );
function log_mailer_errors( $wp_error ) {
	$fn = ABSPATH . '/mail.log'; // say you've got a mail.log file in your server root
	$fp = fopen( $fn, 'a' );
	fputs( $fp, "Mailer Error: " . $wp_error->get_error_message() . "\n" );
	fclose( $fp );
}