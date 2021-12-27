<?php

/*
 * Bootstraps Demo Theme
 *
 * @package demo
 */

namespace Demo\Inc\Classes;

use Demo\Inc\Traits\Singleton;

class DemoTheme {
	use Singleton;

	protected function __construct() {
		$this->setupHooks();
	}

	private function setupHooks() {
	}
}