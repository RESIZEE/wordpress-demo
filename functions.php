<?php
/*
 * Functions for demo theme.
 * @package demo
 */

/*
 * Definition of constants used in Demo Theme
 */
if ( ! defined( 'DEMO_DIR_PATH' ) ) {
	define( 'DEMO_DIR_PATH', untrailingslashit( get_template_directory() ) );
}

if ( ! defined( 'DEMO_DIR_URI' ) ) {
	define( 'DEMO_DIR_URI', untrailingslashit( get_template_directory_uri() ) );
}

if ( ! defined( 'DEMO_CSS_URI' ) ) {
	define( 'DEMO_CSS_URI', untrailingslashit( get_template_directory_uri() . '/css' ) );
}

if ( ! defined( 'DEMO_JS_URI' ) ) {
	define( 'DEMO_JS_URI', untrailingslashit( get_template_directory_uri() . '/js' ) );
}

/*
 * Autoloader configuration
 */
require_once DEMO_DIR_PATH . '/inc/helpers/Autoloader.php';
function register_autoloader() {
	$autoloader = new Demo\Inc\Helpers\Autoloader(
		'Demo\\',
		'inc',
		[
			'classes',
			'traits',
		]
	);

	$autoloader->register();
}

/*
 * Instantiating Demo Theme class
 */
function demo_get_theme_instance() {
	Demo\Inc\Classes\DemoTheme::getInstance();
}

register_autoloader();

demo_get_theme_instance();

// Sve ovo da se prosledi u posebne klase
require_once DEMO_DIR_PATH . '/inc/custom-post-types.php';
require_once DEMO_DIR_PATH . '/inc/enqueue.php';
require_once DEMO_DIR_PATH . '/inc/templates.php';
require_once DEMO_DIR_PATH . '/inc/menus.php';
require_once DEMO_DIR_PATH . '/inc/theme-support.php';
require_once DEMO_DIR_PATH . '/inc/adjust-queries.php';
require_once DEMO_DIR_PATH . '/inc/helpers.php';
require_once DEMO_DIR_PATH . '/inc/rest-api.php';
require_once DEMO_DIR_PATH . '/inc/admin-rest-api.php';
require_once DEMO_DIR_PATH . '/inc/filters.php';
require_once DEMO_DIR_PATH . '/inc/custom-meta.php';
require_once DEMO_DIR_PATH . '/inc/shortcodes.php';
require_once DEMO_DIR_PATH . '/inc/admin.php';
require_once DEMO_DIR_PATH . '/inc/ajax.php';