<?php

/**
 * Wrapper for theme menus
 *
 * @package demo
 */

namespace Demo\Inc\Classes;

use Demo\Inc\Classes\Base\ResourceBase;
use Demo\Inc\Traits\Theme\Menu;

class ThemeMenus extends ResourceBase {
	use Menu;

	protected function setupHooks() {
		$this->addNavMenus( [
			'headerMenuLocation'              => 'Header Menu Location',
			'footerFirstSectionMenuLocation'  => 'Footer First Section Menu',
			'footerSecondSectionMenuLocation' => 'Footer Second Section Menu',
		] );

		$this->customizeNavCssClasses( [ $this, 'addCurrentMenuClassToSinglePages' ] );
	}

	/**
	 * Adds current-menu-item class to nav menu when single page is viewed for particular post type.
	 *
	 * @param string[] $classes
	 * @param object $item
	 *
	 * @return string[]
	 */
	public function addCurrentMenuClassToSinglePages( $classes, $item ) {
		if (
			is_single() &&
			get_post_type() == $item->object
		) {
			$classes[] = 'current-menu-item';

			return $classes;
		}

		if (
			is_single() &&
			get_post_type() == 'post' &&
			get_post_meta( $item->ID, '_menu_item_object_id', true ) == get_option( 'page_for_posts' )
		) {
			$classes[] = 'current-menu-item';

			return $classes;
		}

		return $classes;
	}
}