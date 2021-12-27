<?php
/*
 * Functions for demo theme.
 *
 * @package demo
 */

/*
 * Definition of constants used in Demo Theme
 */
if ( ! defined( 'DEMO_DIR_PATH' ) ) {
	define( 'DEMO_DIR_PATH', untrailingslashit( get_template_directory() ) );
}
if ( ! defined( 'DEMO_INC_DIR_PATH' ) ) {
	define( 'DEMO_INC_DIR_PATH', untrailingslashit( get_template_directory() . '/inc' ) );
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
require_once DEMO_INC_DIR_PATH . '/helpers/Autoloader.php';
function register_autoloader() {
	$autoloadDirs = [
		'classes',
		'traits',
		'helpers',
	];

	$autoloader = new Demo\Inc\Helpers\Autoloader(
		DEMO_DIR_PATH,
		'Demo\\',
		'inc',
		$autoloadDirs
	);

	$autoloader->register();
}

/*
 * Instantiating Demo Theme class
 */
function demo_get_theme_instance() {
	return Demo\Inc\Classes\DemoTheme::getInstance();
}

register_autoloader();

$theme = demo_get_theme_instance();


// Sve ovo da se prosledi u posebne klase
require_once DEMO_INC_DIR_PATH . '/custom-post-types.php';
require_once DEMO_INC_DIR_PATH . '/templates.php';
require_once DEMO_INC_DIR_PATH . '/menus.php';
require_once DEMO_INC_DIR_PATH . '/theme-support.php';
require_once DEMO_INC_DIR_PATH . '/adjust-queries.php';
require_once DEMO_INC_DIR_PATH . '/helpers.php';
require_once DEMO_INC_DIR_PATH . '/rest-api.php';
require_once DEMO_INC_DIR_PATH . '/admin-rest-api.php';
require_once DEMO_INC_DIR_PATH . '/filters.php';
require_once DEMO_INC_DIR_PATH . '/custom-meta.php';
require_once DEMO_INC_DIR_PATH . '/shortcodes.php';
require_once DEMO_INC_DIR_PATH . '/admin.php';
require_once DEMO_INC_DIR_PATH . '/ajax.php';