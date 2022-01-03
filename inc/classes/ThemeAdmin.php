<?php

/**
 * Wrapper for theme admin panel
 *
 * @package demo
 */

namespace Demo\Inc\Classes;


use Demo\Inc\Classes\Base\ResourceBase;
use Demo\Inc\Classes\Callbacks\AdminCallbacks;
use Demo\Inc\Classes\Core\AdminPages;
use Demo\Inc\Classes\Core\AdminSettings;

class ThemeAdmin extends ResourceBase {

	private $adminPages;
	private $adminSettings;

	protected function __construct() {
		$this->adminPages    = new AdminPages();
		$this->adminSettings = new AdminSettings();

		// Calls setupHooks
		parent::__construct();
	}

	protected function setupHooks() {
		$this->pages()->settings();
	}

	/**
	 * =======================================
	 *              ADMIN PAGES
	 * =======================================
	 */
	/**
	 * Composes all pages calls into single method for readability purposes only.
	 *
	 * @return $this
	 */
	private function pages() {
		$this->mainPage();

		// Only if newsletter features are enabled from general setting we want to add this subpage.
		if ( get_option( 'newsletter_active' ) ) {
			$this->formsSubpage();
		}

		$this->adminPages->register();

		return $this;
	}

	/**
	 * Adds main page to admin pages.
	 *
	 * @return $this
	 */
	private function mainPage() {
		$mainPage = [
			'page_title' => 'Demo Theme Options',
			'menu_title' => 'Demo',
			'capability' => 'manage_options',
			'menu_slug'  => 'resize_demo',
			'callback'   => [ AdminCallbacks::class, 'mainPage' ],
			'icon_url'   => 'dashicons-admin-site',
			'position'   => 58,
		];

		$this->adminPages
			->addPage( $mainPage )
			->withMainSubpage( 'General' );

		return $this;
	}

	/**
	 * Adds forms subpage to admin pages.
	 *
	 * @return $this
	 */
	private function formsSubpage() {
		$formsSubpage = [
			'parent_slug' => 'resize_demo',
			'page_title'  => 'Demo Forms',
			'menu_title'  => 'Forms',
			'capability'  => 'manage_options',
			'menu_slug'   => 'resize_demo_forms',
			'callback'    => [ AdminCallbacks::class, 'formsSubpage' ],
			'position'    => 2,
		];

		$this->adminPages
			->addSubpage( $formsSubpage );

		return $this;
	}
	/**
	 * =======================================
	 *           END ADMIN PAGES
	 * =======================================
	 */

	/**
	 * =======================================
	 *           ADMIN SETTINGS
	 * =======================================
	 */
	/**
	 * Composes all settings calls into single method for readability purposes only.
	 *
	 * @return $this
	 */
	private function settings() {
		$this
			->generalSettings()
			->generalSettingSections()
			->generalSettingFields();

		// Only if newsletter features are enabled from general setting we want to add these settings.
		if ( get_option( 'newsletter_active' ) ) {
			$this
				->formSettings()
				->formSettingSections()
				->formSettingFields();
		}

		$this->adminSettings->register();

		return $this;
	}

	/**
	 * Adds general settings for general(main page).
	 *
	 * @return $this
	 */
	private function generalSettings() {
		$newsletterActiveSetting = [
			'option_group' => 'demo-settings-group',
			'option_name'  => 'newsletter_active',
			'args'         => [
				'default' => true,
			],
		];

		$this->adminSettings->addSetting( $newsletterActiveSetting );

		return $this;
	}

	/**
	 * Adds general sections for general(main page).
	 *
	 * @return $this
	 */
	private function generalSettingSections() {
		$generalSettingsSection = [
			'id'       => 'demo-general-settings',
			'title'    => 'General Settings',
			'callback' => [ AdminCallbacks::class, 'generalSettingsSection' ],
			'page'     => 'resize_demo',
		];

		$this->adminSettings->addSection( $generalSettingsSection );

		return $this;
	}

	/**
	 * Adds general fields for general(main page).
	 *
	 * @return $this
	 */
	private function generalSettingFields() {
		$newsletterActiveField = [
			'id'       => 'general-newsletter-active',
			'title'    => 'Activate Newsletter',
			'callback' => [ AdminCallbacks::class, 'newsletterActiveField' ],
			'page'     => 'resize_demo',
			'section'  => 'demo-general-settings',
		];

		$this->adminSettings->addField( $newsletterActiveField );

		return $this;
	}

	/**
	 * Adds form settings for forms subpage.
	 *
	 * @return $this
	 */
	private function formSettings() {
		// General form settings
		$fromEmailSetting = [
			'option_group' => 'demo-form-group',
			'option_name'  => 'forms_from_email',
			'args'         => [
				'default' => get_bloginfo( 'admin_email' ),
			],
		];

		// Newsletter settings
		$displayNewsletterSetting        = [
			'option_group' => 'demo-form-group',
			'option_name'  => 'newsletter_display',
			'args'         => [
				'default' => false,
			],
		];
		$newsletterPlaceholderSetting    = [
			'option_group' => 'demo-form-group',
			'option_name'  => 'newsletter_placeholder',
			'args'         => [
				'default' => 'Email',
			],
		];
		$newsletterSuccessMessageSetting = [
			'option_group' => 'demo-form-group',
			'option_name'  => 'newsletter_success_message',
			'args'         => [
				'default' => __( 'Successfully subscribed to newsletter.' ),
			],
		];
		$newsletterErrorMessageSetting   = [
			'option_group' => 'demo-form-group',
			'option_name'  => 'newsletter_error_message',
			'args'         => [
				'default' => __( 'Invalid e-mail input.' ),
			],
		];

		// Output newsletter settings
		$newsletterOutputTitleSetting   = [
			'option_group' => 'demo-newsletter-email-output-group',
			'option_name'  => 'newsletter_email_title',
		];
		$newsletterOutputContentSetting = [
			'option_group' => 'demo-newsletter-email-output-group',
			'option_name'  => 'newsletter_email_content',
		];

		$this->adminSettings->addSettings( [
			$fromEmailSetting,
			$displayNewsletterSetting,
			$newsletterPlaceholderSetting,
			$newsletterSuccessMessageSetting,
			$newsletterErrorMessageSetting,
			$newsletterOutputTitleSetting,
			$newsletterOutputContentSetting,
		] );

		return $this;
	}

	/**
	 * Adds form sections for forms subpage.
	 *
	 * @return $this
	 */
	private function formSettingSections() {
		// General form section
		$formSettingsSection = [
			'id'       => 'demo-forms-general-settings',
			'title'    => 'Forms General Settings',
			'callback' => [ AdminCallbacks::class, 'formGeneralSettingSection' ],
			'page'     => 'resize_demo_forms',
		];

		// Newsletter section
		$newsletterSettingsSection = [
			'id'       => 'demo-newsletter-form',
			'title'    => 'Newsletter Form Settings',
			'callback' => [ AdminCallbacks::class, 'newsletterGeneralSettingSection' ],
			'page'     => 'resize_demo_forms',
		];

		// Newsletter output section
		$newsletterOutputSettingsSection = [
			'id'       => 'demo-newsletter-email',
			'title'    => 'Newsletter E-mail Output',
			'callback' => [ AdminCallbacks::class, 'newsletterOutputSection' ],
			'page'     => 'resize_demo_forms',
		];

		$this->adminSettings->addSections( [
			$formSettingsSection,
			$newsletterSettingsSection,
			$newsletterOutputSettingsSection,
		] );

		return $this;
	}

	/**
	 * Adds form fields for forms subpage.
	 *
	 * @return $this
	 */
	private function formSettingFields() {
		// General newsletter fields
		$fromEmailField = [
			'id'       => 'forms-to-email',
			'title'    => 'E-mail From Value',
			'callback' => [ AdminCallbacks::class, 'fromMailField' ],
			'page'     => 'resize_demo_forms',
			'section'  => 'demo-forms-general-settings',
		];

		// Newsletter fields
		$displayNewsletterField        = [
			'id'       => 'newsletter-form-active',
			'title'    => 'Display Default Newsletter Form',
			'callback' => [ AdminCallbacks::class, 'newsletterDisplayField' ],
			'page'     => 'resize_demo_forms',
			'section'  => 'demo-newsletter-form',
		];
		$newsletterPlaceholderField    = [
			'id'       => 'newsletter-form-placeholder',
			'title'    => 'Input Placeholder',
			'callback' => [ AdminCallbacks::class, 'newsletterPlaceholderField' ],
			'page'     => 'resize_demo_forms',
			'section'  => 'demo-newsletter-form',
		];
		$newsletterSuccessMessageField = [
			'id'       => 'newsletter-form-success-message',
			'title'    => 'Success Alert Message',
			'callback' => [ AdminCallbacks::class, 'newsletterSuccessMessageField' ],
			'page'     => 'resize_demo_forms',
			'section'  => 'demo-newsletter-form',
		];
		$newsletterErrorMessageField   = [
			'id'       => 'newsletter-form-error-message',
			'title'    => 'Error Alert Message',
			'callback' => [ AdminCallbacks::class, 'newsletterErrorMessageField' ],
			'page'     => 'resize_demo_forms',
			'section'  => 'demo-newsletter-form',
		];

		// Newsletter output fields
		$newsletterOutputTitleField   = [
			'id'       => 'newsletter-email-title',
			'title'    => 'Newsletter E-mail Title',
			'callback' => [ AdminCallbacks::class, 'newsletterOutputTitleField' ],
			'page'     => 'resize_demo_forms',
			'section'  => 'demo-newsletter-email',
		];
		$newsletterOutputContentField = [
			'id'       => 'newsletter-email-content',
			'title'    => 'Newsletter E-mail Content',
			'callback' => [ AdminCallbacks::class, 'newsletterOutputContentField' ],
			'page'     => 'resize_demo_forms',
			'section'  => 'demo-newsletter-email',
		];

		$this->adminSettings->addFields( [
			$fromEmailField,
			$displayNewsletterField,
			$newsletterPlaceholderField,
			$newsletterSuccessMessageField,
			$newsletterErrorMessageField,
			$newsletterOutputTitleField,
			$newsletterOutputContentField,
		] );

		return $this;
	}
	/**
	 * =======================================
	 *           END ADMIN SETTINGS
	 * =======================================
	 */
}