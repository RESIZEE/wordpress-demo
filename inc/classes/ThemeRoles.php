<?php

/**
 * Wrapper for theme roles
 *
 * @package demo
 */

namespace Demo\Inc\Classes;

use Demo\Inc\Classes\Base\ResourceBase;
use Demo\Inc\Classes\Core\Role;

class ThemeRoles extends ResourceBase {

	protected function setupHooks() {
		( new Role( [ 'editor', 'administrator' ] ) )->attachCap( 'output_newsletter' );
	}
}