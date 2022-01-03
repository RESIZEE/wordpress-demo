<?php

namespace Demo\Inc\Classes\Core;

use Demo\Inc\Classes\Base\CustomTypeBase;
use Demo\Inc\Traits\Theme\Hooks;

class CustomTaxonomy extends CustomTypeBase {
	use Hooks;

	public $associateWith;

	public function __construct( $name, $associateWith, $options = [] ) {
		$this->name          = $name;
		$this->associateWith = $associateWith;
		$this->options       = $options;
	}

	/**
	 * Registers custom taxonomy.
	 *
	 * @return void
	 */
	public function register() {
		$this->initAction( function() {
			register_taxonomy( $this->name, $this->associateWith, $this->options );
		} );
	}

	/**
	 * Automatically generate all labels necessary based on values provided. Custom array
	 * with keys to be overwritten in final labels array can be provided as $custom variable.
	 *
	 * @param string|string[] $singular
	 * @param string $plural
	 * @param string[] $custom
	 *
	 * @return $this
	 */
	public function setLabels( $singular, $plural, $custom = [] ) {
		$this->generateLabelNames( $singular, $plural );

		$labels = [
			'name'                       => __( $this->pluralNameCapitalize, "demo" ),
			'singular_name'              => __( $this->singularNameCapitalize, "demo" ),
			'search_items'               => __( "Search $this->pluralNameCapitalize", "demo" ),
			'popular_items'              => __( "Popular $this->pluralNameCapitalize", "demo" ),
			'all_items'                  => __( "All $this->pluralNameCapitalize", "demo" ),
			'parent_item'                => __( "Parent $this->singularNameCapitalize", "demo" ),
			'parent_item_colon'          => __( "Parent $this->singularNameCapitalize:", "demo" ),
			'edit_item'                  => __( "Edit $this->singularNameCapitalize", "demo" ),
			'view_item'                  => __( "View $this->singularNameCapitalize", "demo" ),
			'update_item'                => __( "Update $this->singularNameCapitalize", "demo" ),
			'add_new_item'               => __( "Add New $this->singularNameCapitalize", "demo" ),
			'new_item_name'              => __( "New $this->singularNameCapitalize Name", "demo" ),
			'separate_items_with_commas' => __( "Separate $this->singularNameLowercase with commas", "demo" ),
			'add_or_remove_items'        => __( "Add or remove $this->pluralNameLowercase", "demo" ),
			'choose_from_most_used'      => __( "Choose from the most used $this->pluralNameLowercase", "demo" ),
			'not_found'                  => __( "No $this->pluralNameLowercase found.", "demo" ),
			'no_terms'                   => __( "No $this->pluralNameLowercase", "demo" ),
			'filter_by_item'             => __( "Filter by $this->singularNameLowercase", "demo" ),
			'items_list_navigation'      => __( "$this->pluralNameCapitalize list navigation", "demo" ),
			'items_list'                 => __( "$this->pluralNameCapitalize list", "demo" ),
			'most_used'                  => __( "Most used", "demo" ),
			'back_to_items'              => __( "Successfully updated $this->singularNameLowercase.", "demo" ),
			'item_link'                  => __( "$this->singularNameCapitalize link", "demo" ),
			'item_link_description'      => __( "A link to a $this->singularNameLowercase.", "demo" ),
		];

		$this->replaceDefaultLabelsWithCustom( $labels, $custom );

		return $this;
	}
}