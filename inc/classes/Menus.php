<?php

/*
 * Wrapper for theme assets
 *
 * @package demo
 */

namespace Demo\Inc\Classes;

use Demo\Inc\Helpers\ResourceBase;
use Demo\Inc\Traits\Theme\Menu;

class Menus extends ResourceBase {
	use Menu;

	protected function setupHooks() {
		$this->addNavMenus( [
			'headerMenuLocation'              => 'Header Menu Location',
			'footerFirstSectionMenuLocation'  => 'Footer First Section Menu',
			'footerSecondSectionMenuLocation' => 'Footer Second Section Menu',
		] );
	}
}