<?php
/*
 * Wrappers for Wordpress menus.
 */

namespace Demo\Inc\Traits\Theme;

trait Menus {
	use Hooks;

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
