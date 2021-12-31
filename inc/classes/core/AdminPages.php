<?php
/**
 * Wrappers class for Wordpress admin pages and subpages.
 */

namespace Demo\Inc\Classes\Core;

use Demo\Inc\Traits\Theme\Hooks;

class AdminPages {
	use Hooks;

	/**
	 * Menu pages displayed in admin panel.
	 * @var array
	 */
	private $pages = [];

	/**
	 * Menu subpages displayed in admin panel.
	 *
	 * @var array
	 */
	private $subpages = [];

	/**
	 * Registers all provided menu pages and subpages by calling them on 'admin_menu' hook
	 *
	 * @return void
	 */
	public function register() {
		if ( ! empty( $this->pages ) || ! empty( $this->subpages ) ) {
			$this->adminMenuAction( [ $this, 'generateMenu' ] );
		}
	}

	/**
	 * Adds new page into $pages array.
	 *
	 * @param array $page
	 *
	 * @return $this
	 */
	public function addPage( $page ) {
		$this->pages[] = $page;

		return $this;
	}

	/**
	 * Adds multiple pages into $pages array.
	 *
	 * @param array $pages
	 *
	 * @return $this
	 */
	public function addPages( $pages ) {
		$this->pages = count( $this->pages ) > 0 ? array_merge( $this->pages, $pages ) : $pages;

		return $this;
	}

	/**
	 * Adds subpage for main page(1st one provided into $pages array).
	 * Optional $title can be provided if not title of page will be used.
	 *
	 * @param string $title
	 *
	 * @return $this
	 */
	public function withMainSubpage( $title = null ) {
		if ( empty( $this->pages ) ) {
			return $this;
		}

		/**
		 * We take data from 1st admin page added to also be our 1st subpage.
		 */
		$mainPage = $this->pages[0];

		$mainSubpage = [
			'parent_slug' => $mainPage['menu_slug'],
			'page_title'  => $mainPage['page_title'],
			'menu_title'  => $title ?: $mainPage['menu_slug'],
			'capability'  => $mainPage['capability'],
			'menu_slug'   => $mainPage['menu_slug'],
			'callback'    => $mainPage['callback'],
			'position'    => 1,
		];

		$this->addSubpage( $mainSubpage );

		return $this;
	}

	/**
	 * Adds subpage to $subpages array.
	 *
	 * @param array $subpage
	 *
	 * @return $this
	 */
	public function addSubpage( $subpage ) {
		$this->subpages[] = $subpage;

		return $this;
	}

	/**
	 * Adds multiple subpages into $subpages array.
	 *
	 * @param array $subpages
	 *
	 * @return $this
	 */
	public function addSubpages( $subpages ) {
		$this->subpages = count( $this->subpages ) > 0 ? array_merge( $this->subpages, $subpages ) : $subpages;

		return $this;
	}

	/**
	 * Adds pages and subpages into Wordpress.
	 *
	 * @return void
	 */
	public function generateMenu() {
		foreach ( $this->pages as $page ) {
			$page['callback'] = array_key_exists( 'callback', $page ) ? $page['callback'] : [];
			$page['icon_url'] = array_key_exists( 'icon_url', $page ) ? $page['icon_url'] : [];
			$page['position'] = array_key_exists( 'position', $page ) ? $page['position'] : [];

			add_menu_page(
				$page['page_title'],
				$page['menu_title'],
				$page['capability'],
				$page['menu_slug'],
				$page['callback'],
				$page['icon_url'],
				$page['position'],
			);
		}

		foreach ( $this->subpages as $subpage ) {
			$subpage['callback'] = array_key_exists( 'callback', $subpage ) ? $subpage['callback'] : [];
			$subpage['position'] = array_key_exists( 'position', $subpage ) ? $subpage['position'] : [];

			add_submenu_page(
				$subpage['parent_slug'],
				$subpage['page_title'],
				$subpage['menu_title'],
				$subpage['capability'],
				$subpage['menu_slug'],
				$subpage['callback'],
				$subpage['position'],
			);
		}
	}
}
