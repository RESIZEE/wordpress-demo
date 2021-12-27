<?php
/**
 * WORDPRESS ADMIN REST API INIT
 *
 * @package demo
 */

// ---DEMO NEWSLETTER API--- //
add_action( 'rest_api_init', 'demo_admin_newsletter_routes' );
function demo_admin_newsletter_routes() {
	register_rest_route(
		'demo/v1/admin',
		'newsletter/email',
		[
			'methods'             => 'POST',
			'callback'            => 'output_newsletter_email',
			'permission_callback' => '__return_true',
		]
	);
}

function output_newsletter_email( $data ) {
	if ( ! is_user_logged_in() ) {
		return [
			'error' => __( 'You did something wrong.', 'demo' ),
		];
	}

	$emails       = [];
	$emailTitle   = $data['email_title'] ?: 'Newsletter ' . get_bloginfo( 'name' );
	$emailContent = $data['email_content'];

	if ( ! has_content( $emailContent ) ) {
		return [ 'error' => __( 'Newsletter content cannot be empty.', 'demo' ) ];
	}

	$newsletterQuery = new WP_Query( [
		'post_type' => 'newsletter',
	] );

	while( $newsletterQuery->have_posts() ){
		$newsletterQuery->the_post();

		$emails[] = $newsletterQuery->post->subscriber_email;
	}

	wp_reset_query();

	//Send Email all newsletter subscribers
	$to        = implode( ',', $emails );
	$headers[] = 'From: ' . get_bloginfo( 'name' ) . '<' . get_option( 'forms_from_email', get_bloginfo( 'admin_email' ) ) . '>';
	$headers[] = 'Content-Type: text/html; charset=UTF-8';

	$newsletterSendStatus = wp_mail( $to, $emailTitle, $emailContent, $headers );

	if ( ! $newsletterSendStatus ) {
		return [
			'error' => __( 'Newsletter failed to send. Please try again later.', 'demo' ),
		];
	}

	return [
		'success' => __( 'Successfully sent newsletter.', 'demo' ),
	];
}