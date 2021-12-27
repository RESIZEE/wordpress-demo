<?php
/**
 * Wrappers for Wordpress menus.
 */

namespace Demo\Inc\Traits\Theme;

trait Menu {
	use Hooks;

	/**
	 * Adds nav menu to the theme.
	 */
	public function addNavMenu( $location, $description ) {
		$this->afterSetupAction( function() use ( $location, $description ) {
			register_nav_menu( $location, $description );
		} );

		return $this;
	}

	/**
	 * Adds nav menus to the theme.
	 */
	public function addNavMenus( $locations ) {
		$this->afterSetupAction( function() use ( $locations ) {
			register_nav_menus( $locations );
		} );

		return $this;
	}
}
