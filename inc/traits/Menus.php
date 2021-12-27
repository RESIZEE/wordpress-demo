<?php
/*
 * Wrappers for Wordpress menus.
 */

namespace Demo\Inc\Traits;

trait Menus {
	/*
 * Adds nav menu to the theme.
 */
	public function addNavMenus( $locations ) {
		$this->afterSetupAction( function() use ( $locations ) {
			register_nav_menus( $locations );
		} );

		return $this;
	}
}
