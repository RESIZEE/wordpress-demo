<?php
/**
 * Base class future classes that implement Singleton pattern.
 */

namespace Demo\Inc\Classes\Base;

use Demo\Inc\Traits\Singleton;

abstract class ResourceBase {
	use Singleton;

	protected function __construct() {
		$this->setupHooks();
	}

	/**
	 * Load all class dependencies
	 *
	 * @return void
	 */
	abstract protected function setupHooks();
}