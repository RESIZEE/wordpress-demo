<?php

/* MENU SECTION */
add_action( 'admin_menu', 'demo_add_menu_page' );
function demo_add_menu_page() {
	// Main demo menu
	add_menu_page(
		'Demo Theme Options',
		'Demo',
		'manage_options',
		'resize_demo',
		'demo_main_menu_page',
		'dashicons-admin-site',
		58
	);

	// Demo submenus
	add_submenu_page(
		'resize_demo',
		'Demo Theme Options',
		'General',
		'manage_options',
		'resize_demo',
		'demo_main_menu_page',
		1
	);
	add_submenu_page(
		'resize_demo',
		'Demo Forms',
		'Forms',
		'manage_options',
		'resize_demo_forms',
		'demo_forms_page',
		2
	);

	add_action( 'admin_init', 'demo_custom_settings' );
}

function demo_main_menu_page() {
	require_once 'templates/admin/demo-main-menu.php';
}


function demo_forms_page() {
	echo '<h1>' . 'Demo Forms' . '</h1>';
}
/* END MENU SECTION */


/* SETTINGS SECTION */
function demo_custom_settings() {
	register_setting(
		'demo-settings-group',
		'name',
	);
	add_settings_section(
		'demo-general-settings',
		'General Settings',
		'demo_general_settings',
		'resize_demo',
	);
	add_settings_field(
		'name',
		'Name',
		'demo_general_settings_name',
		'resize_demo',
		'demo-general-settings',
	);
}

function demo_general_settings() {
	echo 'Customize general settings.';
}

function demo_general_settings_name() {
	$name = esc_attr( get_option( 'name' ) );
	echo '<input type="text" name="name" placeholder="Name..." value="' . $name . '">';
}
/* END SETTINGS SECTION */