<?php
/**
 * Wrappers for Wordpress theme support.
 */

namespace Demo\Inc\Traits\Theme;

trait Support {
	use Hooks;

	/**
	 * Adds theme support.
	 */
	public function addSupport( $feature, $options = null ) {
		$this->afterSetupAction( function() use ( $feature, $options ) {
			if ( $options ) {
				add_theme_support( $feature, $options );
			} else {
				add_theme_support( $feature );
			}
		} );

		return $this;
	}

	/**
	 * Removes theme support.
	 */
	public function removeSupport( $feature ) {
		$this->afterSetupAction( function() use ( $feature ) {
			remove_theme_support( $feature );
		} );

		return $this;
	}
}
