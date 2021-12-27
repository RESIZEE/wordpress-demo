<?php

/*
 * Base class for main theme class which is wrapper for WP functionalities.
 */

namespace Demo\Inc\Helpers;

use Demo\Inc\Traits\Hooks;
use Demo\Inc\Traits\Singleton;

abstract class ThemeBase {
	use Singleton, Hooks;

	protected function __construct() {
		$this->setupHooks();
	}

	/*
	 * Load basic actions which are added on class instantiation.
	 */
	abstract protected function setupHooks();

	/*
	 * Defining single constant.
	 */
	public function defineConstant( $name, $value = false ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	/*
	 * Defining multiple constants.
	 */
	public function defineConstants( $constants = [] ) {
		foreach ( $constants as $name => $value ) {
			$this->defineConstant( $name, $value );
		}
	}

	/*
	 * Adds nav menu to the theme.
	 */
	public function addNavMenus( $locations ) {
		$this->afterSetupAction( function() use ( $locations ) {
			register_nav_menus( $locations );
		} );

		return $this;
	}

	/*
	 * Enqueues stylesheet.
	 */
	public function addStyle( $handle, $src, $deps = [], $ver = false, $media = 'all' ) {
		$this->enqueueScriptsAction( function() use ( $handle, $src, $deps, $ver, $media ) {
			wp_enqueue_style( $handle, $src, $deps, $ver, $media );
		} );

		return $this;
	}

	/*
	 * Enqueues script.
	 */
	public function addScript( $handle, $src = '', $deps = [], $ver = false, $inFooter = false, $localization = [] ) {
		$this->enqueueScriptsAction( function() use ( $handle, $src, $deps, $ver, $inFooter, $localization ) {
			wp_enqueue_script( $handle, $src, $deps, $ver, $inFooter, );
		} );

		if ( ! empty( $localization ) ) {
			$localization['handle'] = $handle;

			$this->localizeScript( $localization );
		}

		return $this;
	}

	/*
	 * Localizes script.
	 */
	public function localizeScript( $localization = [] ) {
		$this->enqueueScriptsAction( function() use ( $localization ) {
			wp_localize_script( $localization['handle'], $localization['objectName'], $localization['data'] );
		} );

		return $this;
	}

	/*
	 * Adds theme support.
	 */
	public function addSupport( $feature, $options = [] ) {
		$this->afterSetupAction( function() use ( $feature, $options ) {
			add_theme_support( $feature, $options );
		} );

		return $this;
	}

	/*
	 * Removes theme support.
	 */
	public function removeSupport( $feature ) {
		$this->afterSetupAction( function() use ( $feature ) {
			remove_theme_support( $feature );
		} );

		return $this;
	}

	/*
	 * Adds image size.
	 */
	public function addImageSize( $name, $width = 0, $height = 0, $crop = false ) {
		$this->afterSetupAction( function() use ( $name, $width, $height, $crop ) {
			add_image_size( $name, $width, $height, $crop );
		} );

		return $this;
	}

	/*
	 * Removes image size.
	 */
	public function removeImageSize( $name ) {
		$this->afterSetupAction( function() use ( $name ) {
			remove_image_size( $name );
		} );

		return $this;
	}
}