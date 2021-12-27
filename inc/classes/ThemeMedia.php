<?php

/**
 * Wrapper for theme media
 *
 * @package demo
 */

namespace Demo\Inc\Classes;

use Demo\Inc\Helpers\ResourceBase;
use Demo\Inc\Traits\Theme\Media;

class ThemeMedia extends ResourceBase {
	use Media;

	protected function setupHooks() {
		$this
			->addImageSize( 'card-image', 0, 500, true )
			->addImageSize( 'single-image', 0, 450, true );
	}
}