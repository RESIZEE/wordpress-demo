<?php

/**
 * Wrapper for theme assets
 *
 * @package demo
 */

namespace Demo\Inc\Classes;

use Demo\Inc\Helpers\ResourceBase;
use Demo\Inc\Traits\Theme\Enqueue;

class ThemeAssets extends ResourceBase {
	use Enqueue;

	/**
	 * Scripts and styles version number.
	 */
	//const VERSION = '1.0.0';

	protected function setupHooks() {
		$this->enqueueStyles();
		$this->enqueueScripts();
		$this->enqueueAdminStyles();
		$this->enqueueAdminScripts();
	}

	/**
	 * Enqueue frontend styles.
	 */
	private function enqueueStyles() {
		$this
			->addStyle(
				'font-awesome',
				'//use.fontawesome.com/releases/v5.15.4/css/all.css'
			)
			->addStyle(
				'bootstrap',
				DEMO_CSS_URI . '/bootstrap.min.css',
			)
			->addStyle(
				'demo-main',
				get_stylesheet_uri(),
				null,
				microtime()
			);
	}

	/**
	 * Enqueue frontend scripts.
	 */
	private function enqueueScripts() {
		$mainScriptLocalization = [
			'objectName' => 'demoData',
			'data'       => [
				'rootUrl' => get_site_url(),
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => wp_create_nonce( 'wp_ajax' ),
			],
		];

		$this
			->addScript(
				'bootstrap-bundled',
				DEMO_JS_URI . '/bootstrap.bundle.min.js',
				[ 'jquery' ],
				null,
				true,
			)
			->addScript(
				'demo-main-bundled',
				DEMO_JS_URI . '/scripts-bundled.js',
				null,
				microtime(),
				true,
				$mainScriptLocalization
			);
	}

	/**
	 * Enqueue admin styles.
	 */
	private function enqueueAdminStyles() {
		$this
			->addAdminStyle(
				'demo-admin-main',
				DEMO_CSS_URI . '/admin/admin.css',
				null,
				microtime(),
				null,
				function( $hook ) {
					return $this->isOnHookSuffix( $hook, 'resize_demo' );
				}
			);
	}

	/**
	 * Enqueue admin scripts.
	 */
	private function enqueueAdminScripts() {
		$localization = [
			'objectName' => 'demoData',
			'data'       => [
				'rootUrl' => get_site_url(),
				'nonce'   => wp_create_nonce( 'wp_rest' ),
			],
		];

		$this
			->addAdminScript(
				'demo-admin-main-bundled',
				DEMO_JS_URI . '/admin/scripts-bundled.js',
				null,
				microtime(),
				true,
				$localization,
				function( $hook ) {
					return $this->isOnHookSuffix( $hook, 'resize_demo' );
				}
			);
	}

	/**
	 * Checks if we are on desired page.
	 *
	 * Used to enqueue styles conditionally on admin pages.
	 */
	private function isOnHookSuffix( $hook, $hookSuffix ) {
		/**
		 * strpos returns 0 if needle is at the beginning  of the haystack
		 * therefore check needs to explicitly look for false value since 0 is false too
		 */
		if ( strpos( $hook, $hookSuffix ) === false ) {
			return false;
		} else {
			return true;
		}

	}
}