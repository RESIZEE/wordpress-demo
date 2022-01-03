<?php

/**
 * Class that holds callbacks for admin panel functionalities.
 *
 * @package demo
 */

namespace Demo\Inc\Classes\Callbacks;

use Demo\Inc\Traits\Singleton;

class AdminCallbacks {
	use Singleton;

	/**
	 * =======================================
	 *           ADMIN PAGES
	 * =======================================
	 */
	public static function mainPage() {
		require_once DEMO_INC_DIR_PATH . '/admin-pages/demo-main-page.php';
	}

	public static function formsSubpage() {
		require_once DEMO_INC_DIR_PATH . '/admin-pages/demo-forms-page.php';
	}
	/**
	 * =======================================
	 *           END ADMIN PAGES
	 * =======================================
	 */

	/**
	 * =======================================
	 *           ADMIN SECTIONS
	 * =======================================
	 */
	public static function generalSettingsSection() {
		echo __( 'Customize general settings.', 'demo' );
	}

	public static function formGeneralSettingSection() {
		echo __( 'Customize general form settings.', 'demo' );
	}

	public static function newsletterGeneralSettingSection() {
		echo __( 'Customize newsletter form settings.', 'demo' );
	}

	public static function newsletterOutputSection() {
		echo __( 'Output newsletter e-mail to subscribers.', 'demo' );
	}
	/**
	 * =======================================
	 *           END ADMIN SECTIONS
	 * =======================================
	 */

	/**
	 * =======================================
	 *           END ADMIN FIELDS
	 * =======================================
	 */
	public static function newsletterActiveField() {
		$checked = esc_attr( get_option( 'newsletter_active' ) ) ? 'checked' : '';
		echo '<input type="checkbox" name="newsletter_active" ' . $checked . '>';
	}

	public static function fromMailField() {
		$fromEmail   = esc_attr( get_option( 'forms_from_email' ) );
		$description = __( 'This value will be as from e-mail in e-mails sent from forms.', 'demo' );
		echo
			'<input type="text" name="forms_from_email" placeholder="From e-mail..." value="' . $fromEmail . '">' .
			admin_description_field( $description );
	}

	public static function newsletterDisplayField() {
		$checked = esc_attr( get_option( 'newsletter_display' ) ) ? 'checked' : '';
		echo '<input type="checkbox" name="newsletter_display" ' . $checked . '>';
	}

	public static function newsletterPlaceholderField() {
		$placeholder = esc_attr( get_option( 'newsletter_placeholder' ) );
		$description = __( 'This value will be shown inside input field of default newsletter form in footer.', 'demo' );
		echo
			'<input type="text" name="newsletter_placeholder" placeholder="Placeholder..." value="' . $placeholder . '">' .
			admin_description_field( $description );
	}

	public static function newsletterSuccessMessageField() {
		$successMessage = esc_attr( get_option( 'newsletter_success_message' ) );
		$description    = __( 'This value will be shown as an alert on sucessfull newsletter subscription.', 'demo' );

		echo
			'<input type="text" name="newsletter_success_message" placeholder="Success message..." value="' . $successMessage . '">' .
			admin_description_field( $description );
	}

	public static function newsletterErrorMessageField() {
		$errorMessage = esc_attr( get_option( 'newsletter_error_message' ) );
		$description  = __( 'This value will be shown as an alert on wrong e-mail input.', 'demo' );

		echo
			'<input type="text" name="newsletter_error_message" placeholder="Error message..." value="' . $errorMessage . '">' .
			admin_description_field( $description );
	}

	public static function newsletterOutputTitleField() {
		echo
			get_template_part(
				'template-parts/alerts/error',
				null,
				[ 'class' => 'admin-newsletter-alert w-50 d-none', ]
			) .
			get_template_part(
				'template-parts/alerts/success',
				null,
				[ 'class' => 'admin-newsletter-alert w-50 d-none', ]
			) .
			'<input id="newsletter-email-title" type="text" name="demo_newsletter_email_title" placeholder="Newsletter title...">';
	}

	public static function newsletterOutputContentField() {
		echo
			'<textarea id="newsletter-email-content" name="newsletter_email_content" placeholder="Newsletter content..." rows="10"></textarea>' .
			'<br>' .
			'<div class="d-flex">
			<button id="newsletter-email-output-button" type="button" class="button button-primary">' . __( 'Send' ) . '</button>
			<div class="d-none loading-spinner ml-8"></div>
		</div>';
	}
	/**
	 * =======================================
	 *           END ADMIN FIELDS
	 * =======================================
	 */

}