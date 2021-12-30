<?php
/**
 * Wrappers class for Wordpress metaboxes.
 */

namespace Demo\Inc\Classes\Core;

use Demo\Inc\Traits\Theme\Hooks;

class Metabox {
	use Hooks;

	/**
	 * Supported post types by metabox.
	 * @var string[]
	 */
	public $supportedPostTypes;

	/**
	 * ID of metabox.
	 *
	 * @var string
	 */
	public $id;

	/**
	 * Title of the metabox.
	 *
	 * @var string
	 */
	public $title;

	/**
	 * Optional. Context within which metabox will be visible.
	 *
	 * @var string
	 */
	public $context;

	/**
	 * Optional. Priority within the context in which metabox will be visible.
	 *
	 * @var string
	 */
	public $priority;

	/**
	 * Callback that visualizes metabox and its content.
	 * @var Callable
	 */
	private $renderCallback;

	/**
	 * Optional. Callback used when data is saved from metabox to Wordpress database.
	 *
	 * @var Callable
	 */
	private $saveMetaboxDataCallback;

	/**
	 * Initialize properties that are used for add_metabox function.
	 *
	 * @param string[] $supportedPostTypes
	 * @param string $id
	 * @param string $title
	 * @param string $context
	 * @param string $priority
	 */
	public function __construct( $supportedPostTypes, $id, $title, $context = 'advanced', $priority = 'default' ) {
		$this->supportedPostTypes = $supportedPostTypes;
		$this->id                 = $id;
		$this->title              = $title;
		$this->context            = $context;
		$this->priority           = $priority;
	}

	/**
	 * Sets render callback property to desired value.
	 *
	 * @param Callable $callback
	 *
	 * @return void
	 */
	public function addRenderCallback( $callback ) {
		$this->renderCallback = $callback;
	}

	/**
	 * Sets callable in charge of saving data from metabox to database to desired value.
	 *
	 * @param Callable $callback
	 *
	 * @return void
	 */
	public function addSaveMetaboxDataCallback( $callback ) {
		$this->saveMetaboxDataCallback = $callback;
	}

	/**
	 * Composes all pieces and creates callable and all required data.
	 *
	 * @return void
	 */
	public function register() {
		$this->addMetaboxesAction( function( $postType ) {
			if ( in_array( $postType, $this->supportedPostTypes ) ) {
				add_meta_box( $this->id, $this->title, $this->renderCallback, $postType, $this->context, $this->priority );
			}
		} );
		if ( isset( $this->saveMetaboxDataCallback ) ) {
			$this->savePostAction( $this->saveMetaboxDataCallback );
		}
	}
}
