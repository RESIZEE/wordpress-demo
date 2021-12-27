<?php

namespace Demo\Inc\Classes;

use Demo\Inc\Traits\Singleton;

abstract class ThemeBase {
	use Singleton;

	protected function __construct() {
		$this->setupHooks();
	}

	abstract protected function setupHooks();
}