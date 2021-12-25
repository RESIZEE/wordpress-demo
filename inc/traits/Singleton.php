<?php
/**
 * Singleton trait which implements Singleton pattern in any class in which this trait is used.
 *
 * @package demo
 */

namespace Demo\Inc\Traits;

trait Singleton {
	/*
	 * Protected constructor to prevent direct object creation.
	 *
	 * Class implementing this trait will be able to override constructor.
	 */
	protected function __construct() {
	}

	/*
	 * Preventing object cloning
	 */
	final protected function __clone() {
	}

	/*
	 * This method is source of singleton implementation.
	 *
	 * If class which is being called has already been instantiated
	 * it's instance is being returned if not new instance will be created.
	 */
	final public static function getInstance() {
		static $instances = [];

		$called_class = get_called_class();

		if ( ! isset( $instances[ $called_class ] ) ) {
			$instances[ $called_class ] = new $called_class();

			/*
			 * Custom action in case there is need to hook action at this point of lifecycle.
             * demo_singleton_init_{class_name}
			 */
			do_action( sprintf( 'demo_singleton_init_%s', $called_class ) );
		}

		return $instances[ $called_class ];
	}
}
