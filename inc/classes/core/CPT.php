<?php
/**
 * Wrapper class for Wordpress custom post type.
 */

namespace Demo\Inc\Classes\Core;

use Demo\Inc\Classes\Base\CustomTypeBase;
use Demo\Inc\Traits\Theme\Hooks;

class CPT extends CustomTypeBase {
	use Hooks;

	public function __construct( $name, $options = [] ) {
		$this->name    = $name;
		$this->options = $options;
	}

	/**
	 * Registers custom post type.
	 *
	 * @return void
	 */
	public function register() {
		$this->initAction( function() {
			register_post_type( $this->name, $this->options );
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
			'name'                     => __( $this->pluralNameCapitalize, "demo" ),
			'singular_name'            => __( $this->singularNameCapitalize, "demo" ),
			'add_new'                  => __( "Add New", "demo" ),
			'add_new_item'             => __( "Add New $this->singularNameCapitalize", "demo" ),
			'edit_item'                => __( "Edit $this->singularNameCapitalize", "demo" ),
			'new_item'                 => __( "New $this->singularNameCapitalize", "demo" ),
			'view_item'                => __( "View $this->singularNameCapitalize", "demo" ),
			'view_items '              => __( "View $this->pluralNameCapitalize", "demo" ),
			'search_items'             => __( "Search $this->pluralNameCapitalize", "demo" ),
			'not_found'                => __( "No $this->pluralNameLowercase found.", "demo" ),
			'not_found_in_trash'       => __( "No $this->pluralNameLowercase found in Trash.", "demo" ),
			'parent_item_colon'        => __( "Parent $this->singularNameCapitalize:", "demo" ),
			'all_items'                => __( "All $this->pluralNameCapitalize", "demo" ),
			'archives'                 => __( "$this->singularNameCapitalize archives", "demo" ),
			'attributes '              => __( "$this->singularNameCapitalize attributes ", "demo" ),
			'insert_into_item'         => __( "Insert into $this->singularNameLowercase", "demo" ),
			'uploaded_to_this_item'    => __( "Uploaded to this $this->singularNameLowercase", "demo" ),
			'featured_image'           => __( "Featured Image", "demo" ),
			'set_featured_image'       => __( "Set featured image", "demo" ),
			'remove_featured_image'    => __( "Remove featured image", "demo" ),
			'use_featured_image'       => __( "Use as featured image", "demo" ),
			'menu_name'                => __( "$this->pluralNameCapitalize", "demo" ),
			'filter_items_list'        => __( "Filter $this->pluralNameLowercase list", "demo" ),
			'filter_by_date'           => __( "Filter by date", "demo" ),
			'items_list_navigation'    => __( "$this->pluralNameCapitalize list navigation", "demo" ),
			'items_list'               => __( "$this->pluralNameCapitalize list", "demo" ),
			'item_published'           => __( "$this->singularNameCapitalize published", "demo" ),
			'item_published_privately' => __( "$this->singularNameCapitalize published privately", "demo" ),
			'item_reverted_to_draft'   => __( "$this->singularNameCapitalize reverted to draft", "demo" ),
			'item_scheduled'           => __( "$this->singularNameCapitalize scheduled", "demo" ),
			'item_updated'             => __( "$this->singularNameCapitalize updated", "demo" ),
			'item_link'                => __( "$this->singularNameCapitalize link", "demo" ),
			'item_link_description'    => __( "A link to a $this->singularNameLowercase.", "demo" ),
		];

		$this->replaceDefaultLabelsWithCustom( $labels, $custom );

		return $this;
	}

	/**
	 * Flush Rewrite when theme switches.
	 *
	 * @return void
	 */
	public static function rewriteFlush() {
		add_action( 'after_switch_theme', function() {
			flush_rewrite_rules();
		} );
	}
}