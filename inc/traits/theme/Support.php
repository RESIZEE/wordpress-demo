<?php
/*
 * Wrappers for Wordpress theme support.
 */

namespace Demo\Inc\Traits\Theme;

trait Support {
	/*
	 * Adds theme support.
	 */
	public function addSupport( $feature, $options = [] ) {
		$this->afterSetupAction( function() use ( $feature, $options ) {
			add_theme_support( $feature, $options );
		} );

		return $this;
	}

	/*
	 * Removes theme support.
	 */
	public function removeSupport( $feature ) {
		$this->afterSetupAction( function() use ( $feature ) {
			remove_theme_support( $feature );
		} );

		return $this;
	}
}
