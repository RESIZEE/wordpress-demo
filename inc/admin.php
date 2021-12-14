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

function demo_custom_settings() {
	/* General settings */
	register_setting(
		'demo-settings-group',
		'acf_active',
		[
			'default' => false,
		]
	);
	register_setting(
		'demo-settings-group',
		'newsletter_active',
		[
			'default' => true,
		]
	);
	add_settings_section(
		'demo-general-settings',
		'General Settings',
		'demo_general_settings',
		'resize_demo',
	);
	add_settings_field(
		'general-acf-active',
		'Activate ACF Plugin',
		'demo_general_settings_acf_active',
		'resize_demo',
		'demo-general-settings',
	);
	add_settings_field(
		'general-newsletter-active',
		'Activate Newsletter',
		'demo_general_settings_newsletter_active',
		'resize_demo',
		'demo-general-settings',
	);

	/* Forms settings */
	if ( get_option( 'newsletter_active' ) ) {
		register_setting(
			'demo-newsletter-form-group',
			'newsletter_display',
			[
				'default' => false,
			]
		);
		register_setting(
			'demo-newsletter-form-group',
			'newsletter_placeholder',
			[
				'default' => 'Email',
			],
		);
		add_settings_section(
			'demo-newsletter-form',
			'Newsletter Form Settings',
			'demo_newsletter_form',
			'resize_demo_forms',
		);
		add_settings_field(
			'newsletter-form-active',
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
}

/* END MENU SECTION */


/* SETTINGS SECTION */
// Main page
function demo_general_settings() {
	echo 'Customize general settings.';
}

function demo_general_settings_acf_active() {
	$checked = esc_attr( get_option( 'acf_active' ) ) ? 'checked' : '';
	echo '<input type="checkbox" name="acf_active" ' . $checked . '>';
}

function demo_general_settings_newsletter_active() {
	$checked = esc_attr( get_option( 'newsletter_active' ) ) ? 'checked' : '';
	echo '<input type="checkbox" name="newsletter_active" ' . $checked . '>';
}

//Forms - Newsletter
function demo_newsletter_form() {
	echo 'Customize newsletter form settings.';
}

function demo_newsletter_form_display() {
	$checked = esc_attr( get_option( 'newsletter_display' ) ) ? 'checked' : '';
	echo '<input type="checkbox" name="newsletter_display" ' . $checked . '>';
}

function demo_newsletter_form_placeholder() {
	$placeholder = esc_attr( get_option( 'newsletter_placeholder' ) );
	$description = __( 'This value will be shown inside input field of default newsletter form in footer.', 'demo' );
	echo
		'<input type="text" name="newsletter_placeholder" placeholder="Placeholder..." value="' . $placeholder . '">' .
		field_description( $description );
}
/* END SETTINGS SECTION */

// Validation and sanitization of field with appropriate error
//function demo_sanitize_validate_newsletter_placeholder( $input ) {
//	if ( empty( $input ) ) {
//		$message = __( 'Newsletter placeholder must not be empty.', 'demo' );
//		add_settings_error(
//			'newsletter_form_placeholder',
//			'newsletter-form-placeholder-error',
//			$message,
//		);
//	}
//
//	return $input;
//}