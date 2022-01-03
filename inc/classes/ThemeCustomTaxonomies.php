<?php

/**
 * Wrapper for theme roles
 *
 * @package demo
 */

namespace Demo\Inc\Classes;

use Demo\Inc\Classes\Core\CustomTaxonomy;
use Demo\Inc\Classes\Base\ResourceBase;

class ThemeCustomTaxonomies extends ResourceBase {

	protected function setupHooks() {
		$this->registerGenreTaxonomy();
	}

	/**
	 * Registers genre custom taxonomy.
	 *
	 * @return void
	 */
	private function registerGenreTaxonomy() {
		$genre = new CustomTaxonomy( 'genre', [ 'movie', 'book', 'game', ] );
		$genre->setLabels( 'Genre', 'Genres' );
		$genre->description  = 'Genres.';
		$genre->public       = true;
		$genre->hierarchical = true;
		$genre->query_var    = false;
		$genre->register();
	}
}