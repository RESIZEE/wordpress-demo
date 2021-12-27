<?php
/**
 * Core functionalities not dependant on Wordpress alone.
 */

namespace Demo\Inc\Traits\Theme;

trait Core {
	/**
	 * Defining single constant.
	 *
	 * @param string $name
	 * @param mixed $value
	 *
	 * @return void
	 */
	public function defineConstant( $name, $value = false ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	/**
	 * Defining multiple constants.
	 *
	 * @param array $constants
	 *
	 * @return void
	 */
	public function defineConstants( $constants = [] ) {
		foreach ( $constants as $name => $value ) {
			$this->defineConstant( $name, $value );
		}
	}
}
