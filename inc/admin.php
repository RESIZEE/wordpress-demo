<?php

add_action( 'admin_menu', 'demo_add_menu_page' );
function demo_add_menu_page() {
	// Main demo menu
	add_menu_page(
		'Demo Theme Options',
		'Demo',
		'manage_options',
		'resize_demo',
		'demo_create_menu_page',
		'dashicons-admin-site',
		58
	);
}

function demo_create_menu_page() {
	echo '<h1>' . 'Demo Options' . '</h1>';
}