<?php
/**
 * Base class for custom types(posts, taxonomies...).
 */

namespace Demo\Inc\Classes\Base;


abstract class CustomTypeBase {

	/**
	 * Name of custom type which will be used to reference it anywhere.
	 *
	 * @var string
	 */
	protected $name;

	/**
	 * Array of options for custom type creation.
	 *
	 * Can be accessed directly to configure options all at once.
	 *
	 * @var array
	 */
	public $options;

	/**
	 * Singular name in lowercase.
	 *
	 * @var string
	 */
	protected $singularNameLowercase;

	/**
	 * Singular name capitalized.
	 *
	 * @var string
	 */
	protected $singularNameCapitalize;

	/**
	 * Plural name in lowercase.
	 *
	 * @var string
	 */
	protected $pluralNameLowercase;

	/**
	 * Plural name capitalized.
	 *
	 * @var string
	 */
	protected $pluralNameCapitalize;

	/**
	 * Registers custom type.
	 *
	 * @return void
	 */
	abstract public function register();

	/**
	 * Sets label property on options array.
	 *
	 * @param string|string[] $singular
	 * @param string $plural
	 * @param array|string[] $custom
	 *
	 * @return $this
	 */
	abstract public function setLabels( $singular, $plural, $custom = [] );

	/**
	 * Replaces values from default labels with custom ones provided.
	 *
	 * @param string[] $labels
	 * @param string [] $custom
	 *
	 * @return void
	 */
	protected function replaceDefaultLabelsWithCustom( $labels, $custom ) {
		$labels = array_replace( $labels, $custom );

		$this->labels = $labels;
	}

	/**
	 * Generates singular and plural lowercase and capitalize versions.
	 *
	 * @param string $singular
	 * @param string $plural
	 *
	 * @return void
	 */
	protected function generateLabelNames( $singular, $plural ) {
		$this->singularNameLowercase  = strtolower( $singular );
		$this->singularNameCapitalize = ucwords( $singular );

		$this->pluralNameLowercase  = strtolower( $plural );
		$this->pluralNameCapitalize = ucwords( $plural );
	}

	/**
	 * Magic method used to easily generate all necessary option values through properties.
	 *
	 * @param string $name
	 * @param mixed $value
	 *
	 * @return void
	 */
	public function __set( $name, $value ) {
		$this->options[ $name ] = $value;
	}
}