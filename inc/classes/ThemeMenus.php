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
	}
}