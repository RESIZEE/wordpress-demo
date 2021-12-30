<?php

/**
 * Wrapper for all your custom classes that are not enough to live on their own.
 *
 * @package demo
 */

namespace Demo\Inc\Classes;

use Demo\Inc\Classes\Base\ResourceBase;

class ThemeCustom extends ResourceBase {

	protected function setupHooks() {
		add_filter( 'query_vars', [ $this, 'customizeQueryVars' ] );
		add_filter( 'excerpt_more', [ $this, 'customizeExcerptReadMore' ] );
		add_filter( 'nav_menu_css_class', [ $this, 'customizeNavCssClasses' ], 10, 2 );
	}

	/**
	 * Adds custom query vars so Wordpress can know about them.
	 *
	 * @return array
	 */
	public function customizeQueryVars( $queryVars ) {
		$queryVars[] = 'genre';
		$queryVars[] = 'cpt';

		return $queryVars;
	}

	/**
	 * Customizes excerpts more button.
	 *
	 * @return string
	 */
	public function customizeExcerptReadMore() {
		return
			'</br><a style="color: #fac900" href="' . get_the_permalink() . '" rel="nofollow">' .
			__( 'Read More', 'demo' ) .
			'...</a>';
	}

	/**
	 * Adds current-menu-item class to nav menu when single page is viewed for particular post type.
	 *
	 * @param string[] $classes
	 * @param object $item
	 *
	 * @return string[]
	 */
	public function customizeNavCssClasses( $classes, $item ) {
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