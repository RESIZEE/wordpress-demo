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
	require_once 'templates/admin/demo-main-page.php';
}


function demo_forms_page() {
	require_once 'templates/admin/demo-forms-page.php';
}

/* END MENU SECTION */


/* SETTINGS SECTION */
function demo_custom_settings() {
	/* General settings */
	register_setting(
		'demo-settings-group',
		'name',
		[
			'default' => 'RESIZE',
		]
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

	/* Forms settings */
	register_setting(
		'demo-newsletter-form-group',
		'newsletter_form_display',
		[
			'default' => true,
		]
	);
	register_setting(
		'demo-newsletter-form-group',
		'newsletter_form_placeholder',
		[
			'default' => 'Email',
		]
	);
	add_settings_section(
		'demo-newsletter-form',
		'Newsletter Form Settings',
		'demo_newsletter_form',
		'resize_demo_forms',
	);
	add_settings_field(
		'newsletter-form-display',
		'Display Default Newsletter Form',
		'demo_newsletter_form_display',
		'resize_demo_forms',
		'demo-newsletter-form',
	);
	add_settings_field(
		'newsletter-form-placeholder',
		'Newsletter Input Placeholder',
		'demo_newsletter_form_placeholder',
		'resize_demo_forms',
		'demo-newsletter-form',
	);
}

function demo_general_settings() {
	echo 'Customize general settings.';
}

function demo_general_settings_name() {
	$name = esc_attr( get_option( 'name', 'RESIZE' ) );
	echo '<input type="text" name="name" placeholder="Name..." value="' . $name . '">';
}

function demo_newsletter_form() {
	echo 'Customize newsletter form settings.';
}

function demo_newsletter_form_display() {
	$checked = esc_attr( get_option( 'newsletter_form_display' ) ) ? 'checked' : '';
	echo '<input type="checkbox" name="newsletter_form_display" ' . $checked . '>';
}

function demo_newsletter_form_placeholder() {
	$placeholder = esc_attr( get_option( 'newsletter_form_placeholder' ) );
	echo '<input type="text" name="newsletter_form_placeholder" placeholder="Placeholder..." value="' . $placeholder . '">';
}
/* END SETTINGS SECTION */