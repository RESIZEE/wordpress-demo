<?php
/**
 * Wrappers for Wordpress hooks.
 */

namespace Demo\Inc\Traits\Theme;

trait Hooks {

	public function afterThemeSwitchedAction( $callback ) {
		add_action( 'after_switch_theme', function() use ( $callback ) {
			$callback();
		} );
	}

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

	public function adminEnqueueScriptsAction( $callback ) {
		add_action( 'admin_enqueue_scripts', function( $hook ) use ( $callback ) {
			$callback( $hook );
		} );
	}

	public function initAction( $callback ) {
		add_action( 'init', function() use ( $callback ) {
			$callback();
		} );
	}

	public function managePostColumnsFilter( $postType, $callback ) {
		add_filter( "manage_{$postType}_posts_columns", function( $columns ) use ( $callback ) {
			return $callback( $columns );
		} );
	}

	public function managePostCustomColumnsAction( $postType, $callback ) {
		add_action( "manage_{$postType}_posts_custom_column", function( $column, $postId ) use ( $callback ) {
			$callback( $column, $postId );
		}, 10, 2 );
	}
}
