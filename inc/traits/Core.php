<?php
/*
 * Core functionalities not dependant on Wordpress alone.
 */

namespace Demo\Inc\Traits;

trait Core {
	/*
	 * Defining single constant.
	 */
	public function defineConstant( $name, $value = false ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	/*
	 * Defining multiple constants.
	 */
	public function defineConstants( $constants = [] ) {
		foreach ( $constants as $name => $value ) {
			$this->defineConstant( $name, $value );
		}
	}
}
