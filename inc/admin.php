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
		// General Form Settings section
		register_setting(
			'demo-form-group',
			'forms_from_email',
			[
				'default' => get_bloginfo( 'admin_email' ),
			]
		);
		add_settings_section(
			'demo-forms-general-settings',
			'Forms General Settings',
			'demo_forms_general_settings',
			'resize_demo_forms',
		);
		add_settings_field(
			'forms-to-email',
			'E-mail From Value',
			'demo_forms_general_settings_from_mail',
			'resize_demo_forms',
			'demo-forms-general-settings',
		);

		// General newsletter settings section
		register_setting(
			'demo-form-group',
			'newsletter_display',
			[
				'default' => false,
			]
		);
		register_setting(
			'demo-form-group',
			'newsletter_placeholder',
			[
				'default' => 'Email',
			],
		);
		register_setting(
			'demo-form-group',
			'newsletter_success_message',
			[
				'default' => __( 'Successfully subscribed to newsletter.' ),
			],
		);
		register_setting(
			'demo-form-group',
			'newsletter_error_message',
			[
				'default' => __( 'Invalid e-mail input.' ),
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
			'Input Placeholder',
			'demo_newsletter_form_placeholder',
			'resize_demo_forms',
			'demo-newsletter-form',
		);
		add_settings_field(
			'newsletter-form-success-message',
			'Success Alert Message',
			'demo_newsletter_form_success_message',
			'resize_demo_forms',
			'demo-newsletter-form',
		);
		add_settings_field(
			'newsletter-form-error-message',
			'Error Alert Message',
			'demo_newsletter_form_error_message',
			'resize_demo_forms',
			'demo-newsletter-form',
		);

		// Output newsletter to subscribers section
		register_setting(
			'demo-newsletter-email-output-group',
			'newsletter_email_title',
		);
		register_setting(
			'demo-newsletter-email-output-group',
			'newsletter_email_content',
		);
		add_settings_section(
			'demo-newsletter-email',
			'Newsletter E-mail Output',
			'demo_newsletter_email_output',
			'resize_demo_forms',
		);
		add_settings_field(
			'newsletter-email-title',
			'Newsletter E-mail Title',
			'demo_newsletter_email_title',
			'resize_demo_forms',
			'demo-newsletter-email',
		);
		add_settings_field(
			'newsletter-email-content',
			'Newsletter E-mail Content',
			'demo_newsletter_email_content',
			'resize_demo_forms',
			'demo-newsletter-email',
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

//Forms - General
function demo_forms_general_settings() {
	echo 'Customize general form settings.';
}

function demo_forms_general_settings_from_mail() {
	$fromEmail   = esc_attr( get_option( 'forms_from_email' ) );
	$description = __( 'This value will be as from e-mail in e-mails sent from forms.', 'demo' );
	echo
		'<input type="text" name="forms_from_email" placeholder="From e-mail..." value="' . $fromEmail . '">' .
		admin_description_field( $description );
}

//Forms - Newsletter
// General Newsletter settings section
function demo_newsletter_form() {
	echo 'Customize newsletter form settings.';
}

function demo_newsletter_form_placeholder() {
	$placeholder = esc_attr( get_option( 'newsletter_placeholder' ) );
	$description = __( 'This value will be shown inside input field of default newsletter form in footer.', 'demo' );
	echo
		'<input type="text" name="newsletter_placeholder" placeholder="Placeholder..." value="' . $placeholder . '">' .
		admin_description_field( $description );
}

function demo_newsletter_form_display() {
	$checked = esc_attr( get_option( 'newsletter_display' ) ) ? 'checked' : '';
	echo '<input type="checkbox" name="newsletter_display" ' . $checked . '>';
}

function demo_newsletter_form_success_message() {
	$successMessage = esc_attr( get_option( 'newsletter_success_message' ) );
	$description    = __( 'This value will be shown as an alert on sucessfull newsletter subscription.', 'demo' );

	echo
		'<input type="text" name="newsletter_success_message" placeholder="Success message..." value="' . $successMessage . '">' .
		admin_description_field( $description );
}

function demo_newsletter_form_error_message() {
	$errorMessage = esc_attr( get_option( 'newsletter_error_message' ) );
	$description  = __( 'This value will be shown as an alert on wrong e-mail input.', 'demo' );

	echo
		'<input type="text" name="newsletter_error_message" placeholder="Error message..." value="' . $errorMessage . '">' .
		admin_description_field( $description );
}

// Newsletter output email section
function demo_newsletter_email_output() {
	echo 'Output newsletter e-mail to subscribers.';
}

function demo_newsletter_email_title() {
	echo
		get_template_part(
			'template-parts/alerts/error',
			null,
			[ 'class' => 'w-50 d-none', ]
		) .
		get_template_part(
			'template-parts/alerts/success',
			null,
			[ 'class' => 'w-50 d-none', ]
		) .
		'<input id="newsletter-email-title" type="text" name="demo_newsletter_email_title" placeholder="Newsletter title...">';
}

function demo_newsletter_email_content() {
	echo
		'<textarea id="newsletter-email-content" name="newsletter_email_content" placeholder="Newsletter content..." rows="10"></textarea>' .
		'<br>' .
		'<div class="d-flex">
			<button id="newsletter-email-output-button" type="button" class="button button-primary">' . __( 'Send' ) . '</button>
			<div class="d-none loading-spinner ml-8"></div>
		</div>';
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