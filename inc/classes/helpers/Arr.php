<?php

namespace Demo\Inc\Classes\Helpers;

class Arr {
	/**
	 * Inserts provided value(s) at desired index. If associative array is proveded as $insertion
	 * its keys will be preserved into final array.
	 *
	 * @param mixed $original
	 * @param array $insertion
	 * @param int $index
	 *
	 * @return array
	 */
	public static function insertAt( $original, $insertion, $index ) {
		$beginningOriginal = array_slice( $original, 0, $index );
		$endOriginal       = array_slice( $original, $index );

		return array_merge( $beginningOriginal, $insertion, $endOriginal );
	}

	public static function getKeyFromIndex( $array, $index ) {
		$keys = array_keys( $array );

		return $keys[ $index ];
	}

	public static function getIndexFromKey( $array, $key ) {
		$keys = array_keys( $array );

		return array_search($key, $keys);
	}
}