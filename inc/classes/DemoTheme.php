<?php

/**
 * Bootstraps Demo Theme
 *
 * @package demo
 */

namespace Demo\Inc\Classes;

use Demo\Inc\Classes\Base\ResourceBase;
use Demo\Inc\Traits\Theme\Support;

class DemoTheme extends ResourceBase {
	use Support;

	protected function __construct() {
		ThemeRoles::getInstance();
		ThemeAssets::getInstance();
		ThemeMenus::getInstance();
		ThemeMedia::getInstance();
		ThemeCPTs::getInstance();
		ThemeCustomTaxonomies::getInstance();
		ThemeAjax::getInstance();
		ThemeAdmin::getInstance();
		ThemeCustom::getInstance();

		// Calls setupHooks
		parent::__construct();
	}

	protected function setupHooks() {
		$this
			/**
			 * Enable support for post thumbnails. This will allow usage of Featured Image on post types pages.
			 */
			->addSupport( 'post-thumbnails' )
			->addSupport( 'custom-logo', [
				'height'               => 100,
				'width'                => 400,
				'flex-height'          => true,
				'flex-width'           => true,
				'unlink-homepage-logo' => true,
			] )
			/**
			 * Enables wordpress to automatically generate <title> tag content for us dynamically
			 * depending on page we are on.
			 */
			->addSupport( 'title-tag' )
			/**
			 * Add support for html5 elements.
			 */
			->addSupport( 'html5' )
			/**
			 * Some blocks in Gutenberg like tables, quotes, separator benefit from structural styles (margin, padding, border etc…)
			 * They are applied visually only in the editor (back-end) but not on the front-end to avoid the risk of conflicts with the styles wanted in the theme.
			 * If you want to display them on front to have a base to work with, in this case, you can add support for wp-block-styles, as done below.
			 */
			->addSupport( 'wp-block-styles' )
			->configurePhpMailer( [
				'Mailer'   => 'smtp',
				'Host'     => 'smtp.mailtrap.io',
				'SMTPAuth' => true,
				'Port'     => 2525,
				'Username' => '0120359271df8c',
				'Password' => 'e729e71e2057be',
			] );
	}


}