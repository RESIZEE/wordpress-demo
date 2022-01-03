<?php
/**
 * Wrapper class for Wordpress custom post type.
 */

namespace Demo\Inc\Classes\Core;

use Demo\Inc\Classes\Base\CustomTypeBase;
use Demo\Inc\Classes\Helpers\Arr;
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

	/**
	 * Prepends single column provided to the beginning of existing ones if beforeColumn is not provided.
	 * If beforeColumn is provided prepends column before column provided.
	 * **NOTE**: beforeColumn is human like, 1 is the start.It is not 0 based like array indexes. Also, it is
	 * important to note that counting starts from 1st column that is not checkbox(for bulk action) that is why index is beforeColumn.
	 * It can also be name of the column(name used to create it)
	 *
	 * @param string $name
	 * @param string $label
	 * @param null|int|string $beforeColumn
	 *
	 * @return $this
	 */
	public function prependCustomColumn( $name, $label, $beforeColumn = null ) {
		$this->managePostColumnsFilter( $this->name, function( $columns ) use ( $name, $label, $beforeColumn ) {
			return $this->insertValueBefore( $columns, [ $name => $label ], $beforeColumn );
		} );

		return $this;
	}

	/**
	 * Prepends multiple columns provided to the beginning of existing ones if beforeColumn is not provided.
	 * If beforeColumn is provided prepends columns before column at beforeColumn provided.
	 * **NOTE**: beforeColumn is human like, 1 is the start.It is not 0 based like array indexes. Also, it is
	 * important to note that counting starts from 1st column that is not checkbox(for bulk action) that is why index is beforeColumn.
	 * It can also be name of the column(name used to create it)
	 *
	 * @param string[] $customColumns
	 * @param null|int|string $beforeColumn
	 *
	 * @return $this
	 */
	public function prependCustomColumns( $customColumns, $beforeColumn = null ) {
		$this->managePostColumnsFilter( $this->name, function( $columns ) use ( $customColumns, $beforeColumn ) {
			return $this->insertValueBefore( $columns, $customColumns, $beforeColumn );
		} );

		return $this;
	}

	/**
	 * Inserts values at the beginning of the array or before specific identified.
	 * Identified can be key or index.
	 *
	 * @param string[] $array
	 * @param string[] $values
	 * @param null|int|string $beforeColumn
	 *
	 * @return array
	 */
	protected function insertValueBefore( $array, $values, $beforeColumn ) {
		if ( $beforeColumn ) {
			$beforeColumn = is_int( $beforeColumn ) ? $beforeColumn : Arr::getIndexFromKey( $array, $beforeColumn );

			return Arr::insertAt( $array, $values, $beforeColumn );
		} else {
			return array_merge( $values, $array );
		}
	}

	/**
	 * Appends single column provided to the end of existing ones if afterColumn is not provided.
	 * If afterColumn is provided appends column after column at afterColumn provided.
	 * **NOTE**: afterColumn is human like, 1 is the start.It is not 0 based like array indexes. Also, it is
	 * important to note that counting starts from 1st column that is not checkbox(for bulk action) that is why index is afterColumn + 1.
	 * It can also be name of the column(name used to create it)
	 *
	 * @param string $name
	 * @param string $label
	 * @param null|int|string $afterColumn
	 *
	 * @return $this
	 */
	public function appendCustomColumn( $name, $label, $afterColumn = null ) {
		$this->managePostColumnsFilter( $this->name, function( $columns ) use ( $name, $label, $afterColumn ) {
			return $this->insertValueAfter( $columns, [ $name => $label ], $afterColumn );
		} );

		return $this;
	}

	/**
	 * Appends multiple columns provided to the end of existing ones if afterColumn is not provided.
	 * If afterColumn is provided appends columns after column at afterColumn provided.
	 * **NOTE**: afterColumn is human like, 1 is the start. It is not 0 based like array indexes. Also, it is
	 * important to note that counting starts from 1st column that is not checkbox(for bulk action) that is why index is afterColumn + 1.
	 * It can also be name of the column(name used to create it)
	 *
	 * @param string[] $customColumns
	 * @param null|int|string $afterColumn
	 *
	 * @return $this
	 */
	public function appendCustomColumns( $customColumns, $afterColumn = null ) {
		$this->managePostColumnsFilter( $this->name, function( $columns ) use ( $customColumns, $afterColumn ) {
			return $this->insertValueAfter( $columns, $customColumns, $afterColumn );
		} );

		return $this;
	}

	/**
	 * Inserts values at the end of the array or after specific identified.
	 * Identified can be key or index.
	 *
	 * @param string[] $array
	 * @param string[] $values
	 * @param null|int|string $afterColumn
	 *
	 * @return array
	 */
	protected function insertValueAfter( $array, $values, $afterColumn ) {
		if ( $afterColumn ) {
			$afterColumn = is_int( $afterColumn ) ? $afterColumn : Arr::getIndexFromKey( $array, $afterColumn );

			return Arr::insertAt( $array, $values, $afterColumn + 1 );
		} else {
			return array_merge( $array, $values );
		}
	}

	/**
	 * Overrides all columns for post type and sets new ones provided.
	 *
	 * @param string[] $customColumns
	 *
	 * @return $this
	 */
	public function setCustomColumns( $customColumns ) {
		$this->managePostColumnsFilter( $this->name, function() use ( $customColumns ) {
			return $customColumns;
		} );

		return $this;
	}

	/**
	 * Removes column at specific position or which specific name(name which was used to create it, not label).
	 * **NOTE**: Position is human like where 1 is the start and not 0 based like array indexes. Also,
	 * position starts with 1st column that is not checkbox(for bulk action).
	 *
	 * @param string|int $column
	 *
	 * @return $this
	 */
	public function removeColumn( $column ) {
		$this->managePostColumnsFilter( $this->name, function( $columns ) use ( $column ) {
			if ( is_string( $column ) ) {
				unset( $columns[ $column ] );
			}
			if ( is_int( $column ) ) {
				unset( $columns[ Arr::getKeyFromIndex( $columns, $column ) ] );
			}

			return $columns;
		} );

		return $this;
	}

	/**
	 * Changes displayed label in table header for column specified. Position number or name for column are both
	 * acceptable vales.
	 * **NOTE**: Position is human like where 1 is the start and not 0 based like array indexes. Also,
	 * position starts with 1st column that is not checkbox(for bulk action).
	 *
	 * @param string|int $column
	 * @param string $label
	 *
	 * @return $this
	 */
	public function changeColumnLabel( $column, $label ) {
		$this->managePostColumnsFilter( $this->name, function( $columns ) use ( $column, $label ) {
			if ( is_string( $column ) ) {
				$columns[ $column ] = $label;
			}
			if ( is_int( $column ) ) {
				$columns[ Arr::getKeyFromIndex( $columns, $column ) ] = $label;
			}

			return $columns;
		} );

		return $this;
	}

	/**
	 * Changes appearance only for column provided.
	 * In callback post id is passed as parameter which can be used to dynamically apply changes to column appearance.
	 *
	 * @param string $name
	 * @param Callable $callback
	 *
	 * @return $this
	 */
	public function customizeCustomColumnAppearance( $name, $callback ) {
		$this->managePostCustomColumnsAction( $this->name, function( $column, $postId ) use ( $name, $callback ) {
			if ( $column === $name ) {
				$callback( $postId );
			}
		} );

		return $this;
	}

	/**
	 * Changes frontend appearance of custom columns set for specific post type.
	 * All columns are passed to callback in which you can change appearance of each of them.
	 * Also post id is passed to callback.
	 *
	 * @param Callable $callback
	 *
	 * @return $this
	 */
	public function customizeCustomColumnsAppearance( $callback ) {
		$this->managePostCustomColumnsAction( $this->name, function( $column, $postId ) use ( $callback ) {
			$callback( $column, $postId );
		} );

		return $this;
	}
}