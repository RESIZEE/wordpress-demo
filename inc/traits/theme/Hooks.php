<?php
/*
 * Wrappers for Wordpress hooks.
 */

namespace Demo\Inc\Traits\Theme;

trait Hooks {

	public function afterSetupAction( $callback ) {
		add_action( 'after_setup_theme', function() use ( $callback ) {
			$callback();
		} );
	}

	public function enqueueScriptsAction( $callback ) {
		add_action( 'wp_enqueue_scripts', function() use ( $callback ) {
			$callback();
		} );
	}

	public function initAction( $callback ) {
		add_action( 'init', function() use ( $callback ) {
			$callback();
		} );
	}
}
