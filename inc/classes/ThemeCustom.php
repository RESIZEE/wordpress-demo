<?php

/**
 * Wrapper for all your custom classes that are not enough to live on their own.
 *
 * @package demo
 */

namespace Demo\Inc\Classes;

use Demo\Inc\Classes\Base\ResourceBase;
use WP_Query;

class ThemeCustom extends ResourceBase {

	protected function setupHooks() {
		add_filter( 'query_vars', [ $this, 'customizeQueryVars' ] );
		add_filter( 'excerpt_more', [ $this, 'customizeExcerptReadMore' ] );
		add_filter( 'nav_menu_css_class', [ $this, 'customizeNavCssClasses' ], 10, 2 );

		add_action( 'pre_get_posts', [ $this, 'customizeQueries' ] );
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

	/**
	 * Customizing queries.
	 *
	 * @param WP_Query $query
	 *
	 * @return WP_Query
	 */
	public function customizeQueries( WP_Query $query ) {
		if (
			! is_admin() &&
			! $query->is_main_query() &&
			is_front_page()
		) {
			$postNumber = wp_is_mobile() ? 2 : 4;
			$query->set( 'posts_per_page', $postNumber );

			return $query;
		}

		/**
		 * Modifying main query to display certain number of posts per page
		 * on archive for custom post types.
		 */
		if (
			! is_admin() &&
			$query->is_main_query() &&
			is_post_type_archive( get_query_var( 'post_type' ) )
		) {

			$postNumber = wp_is_mobile() ? 3 : 9;
			$query->set( 'posts_per_page', $postNumber );

			if ( get_query_var( 'genre' ) ) {
				/**
				 * Modifying main query to display only custom post type posts from genre they clicked on.
				 * Results are shown on same page(archive) user was.
				 */
				$taxonomyQuery = [
					[
						'taxonomy' => 'genre',
						'field'    => 'slug',
						'terms'    => get_query_var( 'genre' ),
					],
				];
				$query->set( 'tax_query', $taxonomyQuery );
			}

			return $query;
		}

		/**
		 * Modifying main query to display certain number of posts per page
		 * and also filter only posts from certain post_type on taxonomy archive pages.
		 */
		if (
			! is_admin() &&
			$query->is_main_query() &&
			is_tax( 'genre' ) &&
			get_query_var( 'cpt' )
		) {
			$postNumber = wp_is_mobile() ? 3 : 9;

			$query->set( 'posts_per_page', $postNumber );
			$query->set( 'post_type', get_query_var( 'cpt' ) );

			return $query;
		}

		return $query;
	}

}