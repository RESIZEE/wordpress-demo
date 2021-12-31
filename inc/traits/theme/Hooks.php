<?php
/**
 * Wrappers for Wordpress hooks.
 */

namespace Demo\Inc\Traits\Theme;

trait Hooks {

	protected function afterThemeSwitchedAction( $callback ) {
		add_action( 'after_switch_theme', function() use ( $callback ) {
			$callback();
		} );
	}

	protected function afterSetupAction( $callback ) {
		add_action( 'after_setup_theme', function() use ( $callback ) {
			$callback();
		} );
	}

	protected function enqueueScriptsAction( $callback ) {
		add_action( 'wp_enqueue_scripts', function() use ( $callback ) {
			$callback();
		} );
	}

	protected function adminEnqueueScriptsAction( $callback ) {
		add_action( 'admin_enqueue_scripts', function( $hook ) use ( $callback ) {
			$callback( $hook );
		} );
	}

	protected function initAction( $callback ) {
		add_action( 'init', function() use ( $callback ) {
			$callback();
		} );
	}

	protected function managePostColumnsFilter( $postType, $callback ) {
		add_filter( "manage_{$postType}_posts_columns", function( $columns ) use ( $callback ) {
			return $callback( $columns );
		} );
	}

	protected function managePostCustomColumnsAction( $postType, $callback ) {
		add_action( "manage_{$postType}_posts_custom_column", function( $column, $postId ) use ( $callback ) {
			$callback( $column, $postId );
		}, 10, 2 );
	}

	protected function addMetaboxesAction( $callback ) {
		add_action( 'add_meta_boxes', function( $postType ) use ( $callback ) {
			$callback( $postType );
		} );
	}

	protected function savePostAction( $callback ) {
		add_action( 'save_post', function( $postId, $post, $isUpdating ) use ( $callback ) {
			$callback( $postId, $post, $isUpdating );
		}, 10, 3 );
	}

	protected function navCssClassesFilter( $callback ) {
		add_filter( 'nav_menu_css_class', function( $classes, $item ) use ( $callback ) {
			return $callback( $classes, $item );
		}, 10, 2 );
	}
}
