<?php
/**
 * Wrappers for Wordpress theme support.
 */

namespace Demo\Inc\Traits\Theme;

trait Support {
	use Hooks;

	/**
	 * Adds theme support.
	 *
	 * @param string $feature
	 * @param mixed $options
	 *
	 * @return $this
	 */
	public function addSupport( $feature, $options = null ) {
		$this->afterSetupAction( function() use ( $feature, $options ) {
			if ( $options ) {
				add_theme_support( $feature, $options );
			} else {
				add_theme_support( $feature );
			}
		} );

		return $this;
	}

	/**
	 * Removes theme support.
	 *
	 * @param string $feature
	 *
	 * @return $this
	 */
	public function removeSupport( $feature ) {
		$this->afterSetupAction( function() use ( $feature ) {
			remove_theme_support( $feature );
		} );

		return $this;
	}

	/**
	 * Configures PHP Mailer after it has been initialized.
	 * It accepts callable and user can have full control over how to initialize mailer through $phpmailer variable
	 * which is provided to callback.
	 *
	 * Another way is to pass associative array with keys being PHPMailer class properties
	 * and values their respective values.
	 *
	 * @param Callable|array $config
	 *
	 * @return $this
	 */
	public function configurePhpMailer( $config ) {
		$this->phpMailerInitFilter( function( $phpmailer ) use ( $config ) {
			if ( is_callable( $config ) ) {
				$config( $phpmailer );
			} else {
				foreach ( $config as $key => $value ) {
					$phpmailer->{$key} = $value;
				}
			}
		} );

		return $this;
	}

}
