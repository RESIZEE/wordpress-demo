<?php

/**
 * Wrapper for theme ajax calls
 *
 * @package demo
 */

namespace Demo\Inc\Classes;

use Demo\Inc\Classes\Base\ResourceBase;
use Demo\Inc\Traits\Theme\Ajax;
use WP_Query;

class ThemeAjax extends ResourceBase {
	use Ajax;

	protected function setupHooks() {
		$this->addAuthAjaxHandler( [ $this, 'create_or_update_review' ] );
		$this->addPublicAjaxHandler( [ $this, 'subscribe_to_newsletter' ] );
		$this->addAuthAjaxHandler( [ $this, 'output_newsletter_email' ] );
	}

	/**
	 * Creates new review score for currently logged-in user or
	 * updates review score they previously choose.
	 *
	 * @return void
	 */
	public function create_or_update_review() {
		$this->checkNonce( 'wp_ajax' );

		$postId      = sanitize_text_field( $_POST['reviewed_post_id'] );
		$reviewScore = (int) sanitize_text_field( $_POST['review_score'] );

		$allowedReviewPostTypes = [ 'movie', 'book', 'game', ];

		if (
			! is_user_logged_in() ||
			! in_array( get_post_type( $postId ), $allowedReviewPostTypes ) ||
			! in_array( $reviewScore, range( 1, 5 ) )
		) {
			wp_send_json_error( [
				'message' => __( 'You did something wrong.', 'demo' ),
			], 422 );
		}

		// If user has already reviewed post, update comment meta which stores review score
		// instead of creating completely new comment, otherwise just create new comment of type 'review'
		if ( $reviewId = current_user_has_reviewed( $postId ) ) {
			update_comment_meta( $reviewId, 'review_score', $reviewScore );
		} else {
			wp_insert_comment( [
				'comment_post_ID' => $postId,
				'comment_type'    => 'review',
				'user_id'         => get_current_user_id(),
				'comment_meta'    => [
					'review_score' => $reviewScore,
				],
			] );
		}

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

	/**
	 * Sends newsletter e-mail to all subscribers.
	 *
	 * @return void
	 */
	function output_newsletter_email() {
		$this->checkNonce( 'wp_ajax' );

		if ( ! is_admin() || ! current_user_can( 'output_newsletter' ) ) {
			wp_send_json_error( [
				'message' => __( 'Sorry, you are not allowed to do this action.', 'demo' ),
			], 401 );
		}

		$emails       = [];
		$emailTitle   = $_POST['email_title'] ?: __( 'Newsletter', 'demo' ) . ' ' . get_bloginfo( 'name' );
		$emailContent = $_POST['email_content'];

		if ( ! has_content( $emailContent ) ) {
			wp_send_json_error( [
				'message' => __( 'Newsletter content cannot be empty.', 'demo' ),
			], 422 );
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
			wp_send_json_error( [
				'message' => __( 'Newsletter failed to send. Please try again later.', 'demo' ),
			], 500 );
		}

		wp_send_json_success( [
			'message' => __( 'Successfully sent newsletter.', 'demo' ),
		], 200 );
	}
}