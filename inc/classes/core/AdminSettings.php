<?php
/**
 * Wrappers class for Wordpress admin settings.
 */

namespace Demo\Inc\Classes\Core;

use Demo\Inc\Traits\Theme\Hooks;

class AdminSettings {
	use Hooks;

	/**
	 * Array of admin settings.
	 *
	 * @var array
	 */
	private $settings = [];

	/**
	 * Array of admin sections for settings.
	 *
	 * @var array
	 */
	private $sections = [];

	/**
	 * Array of fields for settings.
	 *
	 * @var array
	 */
	private $fields = [];

	/**
	 * Registers all provided settings, sections and fields by calling them on 'admin_init' hook.
	 *
	 * @return void
	 */
	public function register() {
		if ( ! empty( $this->settings ) ) {
			$this->adminInitAction( [ $this, 'generateSettings' ] );
		}
	}

	/**
	 * Adds new setting into $settings array.
	 *
	 * @param array $setting
	 *
	 * @return $this
	 */
	public function addSetting( $setting ) {
		$this->settings[] = $setting;

		return $this;
	}

	/**
	 * Adds multiple settings into $settings array.
	 *
	 * @param array $settings
	 *
	 * @return $this
	 */
	public function addSettings( $settings ) {
		$this->settings = count( $this->settings ) > 0 ? array_merge( $this->settings, $settings ) : $settings;

		return $this;
	}

	/**
	 * Adds new section into $sections array.
	 *
	 * @param array $section
	 *
	 * @return $this
	 */
	public function addSection( $section ) {
		$this->sections[] = $section;

		return $this;
	}

	/**
	 * Adds multiple sections into $sections array.
	 *
	 * @param array $sections
	 *
	 * @return $this
	 */
	public function addSections( $sections ) {
		$this->sections = count( $this->sections ) > 0 ? array_merge( $this->sections, $sections ) : $sections;

		return $this;
	}

	/**
	 * Adds new field into $fields array.
	 *
	 * @param array $field
	 *
	 * @return $this
	 */
	public function addField( $field ) {
		$this->fields[] = $field;

		return $this;
	}

	/**
	 * Adds multiple fields into $fields array.
	 *
	 * @param array $fields
	 *
	 * @return $this
	 */
	public function addFields( $fields ) {
		$this->fields = count( $this->fields ) > 0 ? array_merge( $this->fields, $fields ) : $fields;

		return $this;
	}

	/**
	 * Adds settings, sections and fields into Wordpress.
	 *
	 * @return void
	 */
	public function generateSettings() {
		foreach ( $this->settings as $setting ) {
			$setting['args'] = array_key_exists( 'args', $setting ) ? $setting['args'] : [];

			register_setting(
				$setting['option_group'],
				$setting['option_name'],
				$setting['args'],
			);
		}

		foreach ( $this->sections as $section ) {
			add_settings_section(
				$section['id'],
				$section['title'],
				$section['callback'],
				$section['page'],
			);
		}

		foreach ( $this->fields as $field ) {
			$field['section'] = array_key_exists( 'section', $field ) ? $field['section'] : 'default';
			$field['args']    = array_key_exists( 'args', $field ) ? $field['args'] : [];

			add_settings_field(
				$field['id'],
				$field['title'],
				$field['callback'],
				$field['page'],
				$field['section'],
				$field['args'],
			);
		}
	}
}
