<?php
/**
 * Wrappers for Wordpress ajax calls.
 */

namespace Demo\Inc\Traits\Theme;

trait Ajax {
	/**
	 * Creates new ajax action for passed function only for users that are guests(not logged-in).
	 *
	 * @param Callable $callback
	 *
	 * @return void
	 */
	public function addNotAuthAjaxHandler( $callback ) {
		add_action( 'wp_ajax_nopriv_' . $callback[1], $callback );
	}

	/**
	 * Creates new ajax action for passed function only for users who are logged-in.
	 *
	 * @param Callable $callback
	 *
	 * @return void
	 */
	public function addAuthAjaxHandler( $callback ) {
		add_action( 'wp_ajax_' . $callback[1], $callback );
	}

	/**
	 * Creates new ajax action for passed function for both logged-in and logged-out users.
	 *
	 * @param Callable $callback
	 *
	 * @return void
	 */
	public function addPublicAjaxHandler( $callback ) {
		add_action( 'wp_ajax_nopriv_' . $callback[1], $callback );
		add_action( 'wp_ajax_' . $callback[1], $callback );
	}

	/**
	 * Checks if nonce is valid or returns error message.
	 *
	 * @return void
	 */
	public function checkNonce( $nonceAction, $queryArg = false, $errorMessage = null ) {
		if ( ! check_ajax_referer( $nonceAction, $queryArg, false ) ) {
			wp_send_json_error( [
				'message' => $errorMessage ?: __( 'Invalid security token provided.', 'demo' ),
			], 400 );
		}
	}
}
