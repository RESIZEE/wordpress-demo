<?php
/*
 * Wrappers for Wordpress media.
 */

namespace Demo\Inc\Traits\Theme;

trait Media {
	use Hooks;

	/*
	* Adds image size.
	*/
	public function addImageSize( $name, $width = 0, $height = 0, $crop = false ) {
		$this->afterSetupAction( function() use ( $name, $width, $height, $crop ) {
			add_image_size( $name, $width, $height, $crop );
		} );

		return $this;
	}

	/*
	 * Removes image size.
	 */
	public function removeImageSize( $name ) {
		$this->afterSetupAction( function() use ( $name ) {
			remove_image_size( $name );
		} );

		return $this;
	}
}
