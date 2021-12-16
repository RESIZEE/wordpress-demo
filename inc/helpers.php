<?php

// Checks wheter content of post has content or not and returns boolean
function has_content( $content ) {
	if ( ! $content ) {
		$content = get_the_content();
	}

	return strlen( $content ) > 0;
}

// Calculates avarage review score for current or provided post
function review_score( $postId = null ) {
	$id                = $postId ?: get_the_ID();
	$sum               = 0;
	$totalReviewsCount = 0;

	// Getting all reviews for cerain post(movie, game, book)
	$reviewQuery = new WP_Query( [
		'post_type'  => 'review',
		'meta_query' => [
			[
				'key'     => 'reviewed_post_id',
				'compare' => '=',
				'value'   => $id,
			],
		],
	] );

	$totalReviewsCount = $reviewQuery->found_posts;

	// If there are no reviews for post return 0
	if ( $totalReviewsCount <= 0 ) {
		return 0;
	}

	while( $reviewQuery->have_posts() ) {
		$reviewQuery->the_post();

		$sum += (int) $reviewQuery->post->review_score;
	}

	wp_reset_query();

	return round( $sum / $totalReviewsCount, 1 );
}

// Retrieve review score for current or provided post
function current_user_review_score( $postId = null ) {
	if ( ! is_user_logged_in() ) {
		return 0;
	}

	$id = $postId ?: get_the_ID();

	// Getting review score for cerain post(movie, game, book)
	$reviewQuery = new WP_Query( [
		'author'     => get_current_user_id(),
		'post_type'  => 'review',
		'meta_query' => [
			[
				'key'     => 'reviewed_post_id',
				'compare' => '=',
				'value'   => $id,
			],
		],
	] );

	// If there is review with current users ID on current/provided post
	// return review score otherwise return false
	$reviewScore = $reviewQuery->found_posts ?
		$reviewQuery->post->review_score : 0;

	wp_reset_query();

	return $reviewScore;
}

// Calculates avarage review score for current or provided post
function current_user_has_reviewed( $postId = null ) {
	if ( ! is_user_logged_in() ) {
		return 0;
	}

	$id = $postId ?: get_the_ID();

	// Getting review for current user on current/provided post
	$reviewQuery = new WP_Query( [
		'author'     => get_current_user_id(),
		'post_type'  => 'review',
		'meta_query' => [
			[
				'key'     => 'reviewed_post_id',
				'compare' => '=',
				'value'   => $id,
			],
		],
	] );

	// If there is review with current users ID on current/provided post
	// return review ID otherwise return false
	$hasReviewed = $reviewQuery->found_posts ?
		$reviewQuery->post->ID : 0;

	wp_reset_query();

	return $hasReviewed;
}

// Returns description tag for admin menu field
function admin_description_field( $content ) {
	return '<p class="description">' . $content . '</p>';
}