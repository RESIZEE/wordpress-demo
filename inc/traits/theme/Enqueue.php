<?php
/**
 * Wrappers for Wordpress enqueue.
 */

namespace Demo\Inc\Traits\Theme;

trait Enqueue {
	use Hooks;

	/**
	 * Enqueues frontend stylesheet.
	 */
	public function addStyle( $handle, $src, $deps = [], $ver = false, $media = 'all' ) {
		$this->enqueueScriptsAction( function() use ( $handle, $src, $deps, $ver, $media ) {
			wp_enqueue_style( $handle, $src, $deps, $ver, $media );
		} );

		return $this;
	}

	/**
	 * Enqueues frontend script.
	 */
	public function addScript( $handle, $src = '', $deps = [], $ver = false, $inFooter = false, $localization = [] ) {
		$this->enqueueScriptsAction( function() use ( $handle, $src, $deps, $ver, $inFooter, $localization ) {
			wp_enqueue_script( $handle, $src, $deps, $ver, $inFooter );

			if ( ! empty( $localization ) ) {
				wp_localize_script( $handle, $localization['objectName'], $localization['data'] );
			}
		} );

		return $this;
	}

	/**
	 * Enqueues stylesheet for admin page.
	 */
	public function addAdminStyle( $handle, $src, $deps = [], $ver = false, $media = 'all', $hookCheckCallback = null ) {
		$this->adminEnqueueScriptsAction( function( $hook ) use ( $handle, $src, $deps, $ver, $media, $hookCheckCallback ) {
			if ( is_callable( $hookCheckCallback ) && $hookCheckCallback( $hook ) ) {
				wp_enqueue_style( $handle, $src, $deps, $ver, $media );
			}
		} );

		return $this;
	}

	/**
	 * Enqueues script for admin page.
	 */
	public function addAdminScript( $handle, $src = '', $deps = [], $ver = false, $inFooter = false, $localization = [], $hookCheckCallback = null ) {
		$this->adminEnqueueScriptsAction( function( $hook ) use ( $handle, $src, $deps, $ver, $inFooter, $localization, $hookCheckCallback ) {
			if ( is_callable( $hookCheckCallback ) && $hookCheckCallback( $hook ) ) {
				wp_enqueue_script( $handle, $src, $deps, $ver, $inFooter );

				if ( ! empty( $localization ) ) {
					wp_localize_script( $handle, $localization['objectName'], $localization['data'] );
				}
			}
		} );

		return $this;
	}

	/**
	 * Localizes script.
	 */
	public function localizeScript( $handle, $objectName, $data ) {
		$this->enqueueScriptsAction( function() use ( $handle, $objectName, $data ) {
			wp_localize_script( $handle, $objectName, $data );
		} );

		return $this;
	}
}
