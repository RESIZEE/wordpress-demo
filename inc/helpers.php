<?php

/**
 * Demo helper functions used in the theme.
 *
 * @package demo
 */

/**
 * Checks whether content of post or passed content actually has content or not and returns true/false
 *
 * @param string $content
 *
 * @return bool
 */
function has_content( $content ) {
	$content = $content ?: get_the_content();

	return strlen( $content ) > 0;
}

/**
 * Calculates average review score for current or provided post or returns 0
 * if there are no reviews.
 *
 * Returns formatted string.
 *
 * @param null|int $postId
 *
 * @return string
 */
function review_score( $postId = null ) {
	$id  = $postId ?: get_the_ID();
	$sum = 0;

	// Getting all reviews for certain post(movie, game, book)
	$reviewQuery = new WP_Comment_Query( [
		'post_id' => $id,
		'type'    => 'review',
	] );

	$reviews = $reviewQuery->comments;

	$totalReviewsCount = count( $reviews );

	// If there are no reviews for post return 0
	if ( $totalReviewsCount <= 0 ) {
		return '0';
	}

	foreach ( $reviews as $review ) {
		$reviewScore = (int) get_comment_meta( $review->comment_ID, 'review_score', true );

		$sum += $reviewScore;
	}

	wp_reset_query();

	return number_format( $sum / $totalReviewsCount, 1 );
}

/**
 * Retrieve review score for current or provided post for currently logged-in user
 * or return 0 if user did not review post.
 *
 * @param null|int $postId
 *
 * @return int
 */
function current_user_review_score( $postId = null ) {
	if ( ! is_user_logged_in() ) {
		return 0;
	}

	$id = $postId ?: get_the_ID();

	// Getting review score for certain post(movie, game, book)
	$reviewQuery = new WP_Comment_Query( [
		'post_id' => $id,
		'type'    => 'review',
		'user_id' => get_current_user_id(),
	] );

	$reviews = $reviewQuery->comments;

	// If there is review with current users ID on current/provided post
	// return review score otherwise return false
	$reviewScore = count( $reviews ) ?
		get_comment_meta( $reviews[0]->comment_ID, 'review_score', true ) : 0;

	wp_reset_query();

	return (int) $reviewScore;
}

/**
 * Checks if user has already reviewed post, if so returns comment ID under which review is stored
 * otherwise returns false to indicate that user has not reviewed post.
 *
 * @param null|int $postId
 *
 * @return false|int
 */
function current_user_has_reviewed( $postId = null ) {
	if ( ! is_user_logged_in() ) {
		return 0;
	}

	$id = $postId ?: get_the_ID();

	// Getting review for current user on current/provided post
	$reviewQuery = new WP_Comment_Query( [
		'post_id' => $id,
		'type'    => 'review',
		'user_id' => get_current_user_id(),
	] );

	$reviews = $reviewQuery->comments;

	// If there is review with current users ID on current/provided post
	// return review ID otherwise return false
	$hasReviewed = count( $reviews ) ?
		$reviews[0]->comment_ID : false;

	wp_reset_query();

	return $hasReviewed;
}

// Returns description tag for admin menu field
function admin_description_field( $content ) {
	return '<p class="description">' . $content . '</p>';
}