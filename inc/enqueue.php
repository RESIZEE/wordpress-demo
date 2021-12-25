<?php

/* FRONTEND SCRIPTS AND STYLES */
add_action( 'wp_enqueue_scripts', 'demo_resources' );
function demo_resources() {
	/* Styles */
	wp_enqueue_style(
		'font-awesome',
		'//use.fontawesome.com/releases/v5.15.4/css/all.css'
	);
	wp_enqueue_style(
		'bootstrap',
		DEMO_CSS_URI . '/bootstrap.min.css',
	);
	wp_enqueue_style(
		'demo-main',
		get_stylesheet_uri(),
		null,
		microtime()
	);

	/* Scripts */
	wp_enqueue_script(
		'bootstrap-bundled',
		DEMO_JS_URI . '/bootstrap.bundle.min.js',
		[ 'jquery' ],
		null,
		true,
	);
	wp_enqueue_script(
		'demo-main-bundled',
		DEMO_JS_URI . '/scripts-bundled.js',
		null,
		microtime(),
		true,
	);
	wp_localize_script(
		'demo-main-bundled',
		'demoData',
		[
			'rootUrl' => get_site_url(),
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'wp_ajax' ),
		]
	);
}

/* ADMIN SCRIPTS AND STYLES */
add_action( 'admin_enqueue_scripts', 'demo_admin_resources' );
function demo_admin_resources( $hook ) {
	// strpos returns 0 if needle is at the beginning  of the haystack
	// therefore check needs to explicitly look for false value since 0 is false too
	if ( strpos( $hook, 'resize_demo' ) === false ) {
		return;
	}
	/* Styles */
	wp_enqueue_style(
		'demo-admin-main',
		DEMO_CSS_URI . '/admin/admin.css',
		null,
		microtime(),
	);

	/* Scripts */
	wp_enqueue_script(
		'demo-admin-main-bundled',
		DEMO_JS_URI . '/admin/scripts-bundled.js',
		null,
		microtime(),
		true,
	);
	wp_localize_script(
		'demo-admin-main-bundled',
		'demoData',
		[
			'rootUrl' => get_site_url(),
			'nonce'   => wp_create_nonce( 'wp_rest' ),
		]
	);
}