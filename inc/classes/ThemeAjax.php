<?php

/**
 * Wrapper for theme ajax calls
 *
 * @package demo
 */

namespace Demo\Inc\Classes;

use Demo\Inc\Helpers\ResourceBase;
use Demo\Inc\Traits\Theme\Ajax;

class ThemeAjax extends ResourceBase {
	use Ajax;

	protected function setupHooks() {
		$this->addAuthAjaxHandler( [ $this, 'create_or_update_review' ] );
		$this->addPublicAjaxHandler( [ $this, 'subscribe_to_newsletter' ] );
	}

	/**
	 * Creates new review score for currently logged-in user or
	 * updates review score they previously choose.
	 *
	 * @return void
	 */
	public function create_or_update_review() {
		$this->checkNonce( 'wp_ajax' );

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

	/**
	 * Adds e-mail to newsletter subscribers list.
	 *
	 * @return void
	 */
	function subscribe_to_newsletter() {
		$this->checkNonce( 'wp_ajax' );

		$subscriberEmail = $_POST['subscriber_email'];

		if ( ! filter_var( $subscriberEmail, FILTER_VALIDATE_EMAIL ) ) {
			wp_send_json_error( [
				'message' => get_option( 'newsletter_error_message', __( 'Invalid e-mail input.', 'demo' ) ),
			], 422 );
		}

		wp_insert_post( [
			'post_type'   => 'newsletter',
			'post_status' => 'publish',
			'meta_input'  => [
				'subscriber_email' => $subscriberEmail,
			],
		] );

		wp_send_json_success( [
			'message' => get_option( 'newsletter_success_message', __( 'Successfully subscribed to newsletter.', 'demo' ) ),
		], 200 );
	}
}