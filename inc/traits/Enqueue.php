<?php
/*
 * Wrappers for Wordpress enqueue.
 */

namespace Demo\Inc\Traits;

trait Enqueue {
	/*
	 * Enqueues stylesheet.
	 */
	public function addStyle( $handle, $src, $deps = [], $ver = false, $media = 'all' ) {
		$this->enqueueScriptsAction( function() use ( $handle, $src, $deps, $ver, $media ) {
			wp_enqueue_style( $handle, $src, $deps, $ver, $media );
		} );

		return $this;
	}

	/*
	 * Enqueues script.
	 */
	public function addScript( $handle, $src = '', $deps = [], $ver = false, $inFooter = false, $localization = [] ) {
		$this->enqueueScriptsAction( function() use ( $handle, $src, $deps, $ver, $inFooter, $localization ) {
			wp_enqueue_script( $handle, $src, $deps, $ver, $inFooter, );
		} );

		if ( ! empty( $localization ) ) {
			$localization['handle'] = $handle;

			$this->localizeScript( $localization );
		}

		return $this;
	}

	/*
	 * Localizes script.
	 */
	public function localizeScript( $localization = [] ) {
		$this->enqueueScriptsAction( function() use ( $localization ) {
			wp_localize_script( $localization['handle'], $localization['objectName'], $localization['data'] );
		} );

		return $this;
	}
}
