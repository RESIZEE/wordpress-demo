<?php

/**
 * Wrapper for theme plugin support
 *
 * @package demo
 */

namespace Demo\Inc\Classes;

use Demo\Inc\Classes\Base\ResourceBase;

class ThemePlugins extends ResourceBase {

	protected function setupHooks() {
		$this
			->acf();
	}

	private function acf() {
		add_filter( 'acf/settings/save_json', array( $this, 'acfJsonSavePoint' ) );
		add_filter( 'acf/settings/load_json', array( $this, 'acfJsonLoadPoint' ) );

		return $this;
	}

	public function acfJsonSavePoint() {
		return get_stylesheet_directory() . '/acf-json';
	}

	public function acfJsonLoadPoint( $paths ) {
		unset( $paths[0] );

		$paths[] = get_stylesheet_directory() . '/acf-json';

		return $paths;
	}
}