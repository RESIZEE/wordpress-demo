<?php

namespace Demo\Inc\Helpers;

use Demo\Inc\Traits\Singleton;

abstract class ResourceBase {
	use Singleton;

	protected function __construct() {
		$this->setupHooks();
	}

	abstract protected function setupHooks();
}