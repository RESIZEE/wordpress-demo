<?php

/*
 * Bootstraps Demo Theme
 *
 * @package demo
 */

namespace Demo\Inc\Classes;

use Demo\Inc\Helpers\ResourceBase;

class DemoTheme extends ResourceBase {
	protected function __construct() {
		Assets::getInstance();
		Menus::getInstance();

		// Calls setupHooks
		parent::__construct();
	}

	protected function setupHooks() {
	}
}