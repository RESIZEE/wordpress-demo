<?php
/**
 * Wrappers for Wordpress menus.
 */

namespace Demo\Inc\Traits\Theme;

trait Menu {
	use Hooks;

	/**
	 * Adds nav menu to the theme.
	 *
	 * @param string $location
	 * @param string $description
	 *
	 * @return $this
	 */
	public function addNavMenu( $location, $description ) {
		$this->afterSetupAction( function() use ( $location, $description ) {
			register_nav_menu( $location, $description );
		} );

		return $this;
	}

	/**
	 * Adds nav menus to the theme.
	 *
	 * @param string[] $locations
	 *
	 * @return $this
	 */
	public function addNavMenus( $locations ) {
		$this->afterSetupAction( function() use ( $locations ) {
			register_nav_menus( $locations );
		} );

		return $this;
	}

	/**
	 * Hooking onto Wordpress hook to alter css classes for nav menu.
	 * Callback provided will be executed inside 'nav_menu_css_class' action.
	 *
	 * @param Callable $callback
	 *
	 * @return void
	 */
	public function customizeNavCssClasses( $callback ) {
		$this->navCssClassesFilter( function( $classes, $item ) use ( $callback ) {
			return $callback( $classes, $item );
		} );
	}
}
