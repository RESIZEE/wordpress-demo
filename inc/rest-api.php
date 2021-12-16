<?php
/* 
*
*   WORDPRESS REST API INIT
*
*/

// ---DEMO REVIEW API--- //
add_action( 'rest_api_init', 'demo_review_routes' );
function demo_review_routes() {
	register_rest_route(
		'demo/v1',
		'review',
		[
			'methods'  => 'POST',
			'callback' => 'create_or_update_review',
		]
	);
}

function create_or_update_review( $data ) {
	$allowedReviewPostTypes = [ 'movie', 'book', 'game', ];

	$postId      = sanitize_text_field( $data['reviewed_post_id'] );
	$reviewScore = (int) sanitize_text_field( $data['review_score'] );

	if (
		! is_user_logged_in() ||
		! in_array( get_post_type( $postId ), $allowedReviewPostTypes ) ||
		! in_array( $reviewScore, range( 1, 5 ) )
	) {
		return [ 'error' => __( 'You did something wrong.', 'demo' ) ];
	}

	wp_insert_post( [
		'ID'          => current_user_has_reviewed( $postId ),
		'post_type'   => 'review',
		'post_status' => 'publish',
		'meta_input'  => [
			'reviewed_post_id' => $postId,
			'review_score'     => $reviewScore,
		],
	] );

	return [
		'review_score' => review_score( $postId ),
		'success'      => __( 'Your review was saved successfully.', 'demo' ),
	];
}


add_action( 'rest_api_init', 'demo_custom_rest' );
function demo_custom_rest() {
	register_rest_field( 'post', 'authorName', [
		'get_callback' => function() {
			return get_the_author();
		},
	] );
}

/* Custom route for custom_post_type */
add_action( 'rest_api_init', 'demoRegisterSearch' );
function demoRegisterSearch() {
	register_rest_route(
		'demo/v1',
		'search',
		[
			'methods'  => WP_REST_SERVER::READABLE,
			'callback' => 'demoSearchResults',
		]
	);
}


//---DEMO SEARCH API---//
function demoSearchResults( $data ) {
	$allowedReviewPostTypes = [ 'movie', 'book', 'game', ];
	$post_type_query        = new WP_Query( [
		'post_type' => $allowedReviewPostTypes,
		's'         => sanitize_text_field( $data['term'] ),
	] );

	$results = [
		'generalInfo' => [],
		'movies'      => [],
		'books'       => [],
		'games'       => [],
	];

	while( $post_type_query->have_posts() ) {
		$post_type_query->the_post();

		if ( get_post_type() == 'post' || get_post_type() == 'page' ) {
			array_push( $results['generalInfo'], [
				'postType'   => get_post_type(),
				'title'      => get_the_title(),
				'permalink'  => get_the_permalink(),
				'authorName' => get_the_author(),
			] );
		}

		if ( get_post_type() == 'movie' ) {
			array_push( $results['movies'], [
				'postType'   => get_post_type(),
				'title'      => get_the_title(),
				'permalink'  => get_the_permalink(),
				'authorName' => get_the_author(),
				'image'      => get_the_post_thumbnail_url( 0, 'card-image-container' ),
			] );
		}

		if ( get_post_type() == 'book' ) {
			array_push( $results['books'], [
				'postType'   => get_post_type(),
				'title'      => get_the_title(),
				'permalink'  => get_the_permalink(),
				'authorName' => get_the_author(),
				'image'      => get_the_post_thumbnail_url( 0, 'card-image-container' ),
			] );
		}

		if ( get_post_type() == 'game' ) {
			array_push( $results['games'], [
				'postType'   => get_post_type(),
				'title'      => get_the_title(),
				'permalink'  => get_the_permalink(),
				'authorName' => get_the_author(),
			] );
		}
	}

	return $results;
}


//---DEMO CONTACT API---//
add_action( 'rest_api_init', 'demo_contact_routes' );
function demo_contact_routes() {
	register_rest_route(
		'demo/v1',
		'contact',
		[
			'methods'  => 'POST',
			'callback' => 'demo_save_contact',
		]
	);
}

function demo_save_contact( $data ) {
	$name    = sanitize_text_field( $data["name"] );
	$email   = sanitize_text_field( $data["email"] );
	$message = sanitize_text_field( $data["message"] );


	$args = [
		'post_title'   => $name,
		'post_content' => $message,
		'post_author'  => 1,
		'post_type'    => 'demo-contact',
		'post_status'  => 'publish',
		'meta_input'   => [
			'_contact_email_value_key' => $email,
		],
	];
	//WP Insert Post -  Insert fields (create/update) in wp database and returns ID of created post or 0 if fail
	$postID = wp_insert_post( $args );

	//Check if message is saved
	if ( $postID !== 0 ) {

		//Send Email to administrator
		$to      = get_bloginfo( 'admin_email' );
		$subject = 'Demo Contact Form - ' . $name;


        $headers[] = 'From: ' . get_bloginfo('name') . '<' . $to . '>';
        $headers[] = 'Replay-To' . $name . '<' . $email . '>';
        $headers[] = 'Content-Type: text/html; charset=UTF-8';


		wp_mail( $to, $subject, $message, $headers );

		echo $postID;
	} else {
		echo 0;
	}


	die();
}

// ---DEMO NEWSLETTER API--- //
add_action( 'rest_api_init', 'demo_newsletter_routes' );
function demo_newsletter_routes() {
	register_rest_route(
		'demo/v1',
		'newsletter/subscribe',
		[
			'methods'  => 'POST',
			'callback' => 'subscribe_to_newsletter',
		]
	);
}

function subscribe_to_newsletter( $data ) {
	$subscriberEmail = $data['subscriber_email'];

	if ( ! filter_var( $subscriberEmail, FILTER_VALIDATE_EMAIL ) ) {
		return [
			'error' => get_option( 'newsletter_error_message', __( 'Invalid e-mail input.' ) ),
		];
	}

	wp_insert_post( [
		'post_type'   => 'newsletter',
		'post_status' => 'publish',
		'meta_input'  => [
			'subscriber_email' => $subscriberEmail,
		],
	] );

	return [
		'success' => get_option( 'newsletter_success_message', __( 'Successfully subscribed to newsletter.' ) ),
	];
}