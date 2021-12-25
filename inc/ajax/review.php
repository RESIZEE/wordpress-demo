<?php

/*
* DEMO AJAX
*
*   Ajax actions which are handling post type review feature
*
* @package demo
*/

/*
 * Handles ajax request for creating new review with user selected score
 * or updates already existing user review score.
 */
add_action( 'wp_ajax_create_or_update_review', 'create_or_update_review' );
function create_or_update_review() {
	// Checking if the nonce is correct or dies.
	check_ajax_referer( 'wp_ajax' );

	$data = [
		'reviewed_post_id' => $_POST['reviewed_post_id'],
		'review_score'     => $_POST['review_score'],
	];

	$allowedReviewPostTypes = [ 'movie', 'book', 'game', ];

	$postId      = sanitize_text_field( $data['reviewed_post_id'] );
	$reviewScore = (int) sanitize_text_field( $data['review_score'] );

	if (
		! is_user_logged_in() ||
		! in_array( get_post_type( $postId ), $allowedReviewPostTypes ) ||
		! in_array( $reviewScore, range( 1, 5 ) )
	) {
		wp_send_json_error( [
			'message' => __( 'You did something wrong.', 'demo' ),
		], 422 );
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

	wp_send_json_success( [
		'review_score' => review_score( $postId ),
		'message'      => __( 'Your review was saved successfully.', 'demo' ),
	], 200 );
}