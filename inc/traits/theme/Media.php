<?php
/**
 * Wrappers for Wordpress media.
 */

namespace Demo\Inc\Traits\Theme;

trait Media {
	use Hooks;

	/**
	 * Adds image size.
	 *
	 * @param string $name
	 * @param int $width
	 * @param int $height
	 * @param bool|array $crop
	 *
	 * @return $this
	 */
	public function addImageSize( $name, $width = 0, $height = 0, $crop = false ) {
		$this->afterSetupAction( function() use ( $name, $width, $height, $crop ) {
			add_image_size( $name, $width, $height, $crop );
		} );

		return $this;
	}

	/**
	 * Removes image size.
	 *
	 * @param string $name
	 *
	 * @return $this
	 */
	public function removeImageSize( $name ) {
		$this->afterSetupAction( function() use ( $name ) {
			remove_image_size( $name );
		} );

		return $this;
	}
}
