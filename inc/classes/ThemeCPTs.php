<?php

/**
 * Wrapper for theme roles
 *
 * @package demo
 */

namespace Demo\Inc\Classes;

use Demo\Inc\Classes\Core\CPT;
use Demo\Inc\Classes\Base\ResourceBase;

class ThemeCPTs extends ResourceBase {

	protected function setupHooks() {
		$this->registerMovieCPT();
		$this->registerBookCPT();
		$this->registerGameCPT();
		$this->registerMessagesCPT();
		$this->registerNewsletterCPT();

		CPT::rewriteFlush();
	}

	/**
	 * Registers movie custom post type.
	 *
	 * @return void
	 */
	private function registerMovieCPT() {
		$movie = new CPT( 'movie' );
		$movie->setLabels( 'Movie', 'Movies' );
		$movie->description  = 'Movies.';
		$movie->public       = true;
		$movie->show_in_rest = true;
		$movie->menu_icon    = 'dashicons-video-alt2';
		$movie->has_archive  = true;
		$movie->rewrite      = [ 'slug' => 'movies' ];
		$movie->supports     = [
			'title',
			'editor',
			'excerpt',
			'thumbnail',
			'comments',
		];
		$movie->register();

		/**
		 * Movie CPT column customization.
		 */
		$movie
			->removeColumn( 'comments' )
			->appendCustomColumns( [
				'description'  => 'Description',
				'review_score' => 'Review Score',
			], 'title' )
			->customizeCustomColumnAppearance( 'description', function() {
				echo get_the_excerpt();
			} )
			->customizeCustomColumnAppearance( 'review_score', function( $postId ) {
				echo review_score( $postId );
			} );
	}

	/**
	 * Registers book custom post type.
	 *
	 * @return void
	 */
	private function registerBookCPT() {
		$book = new CPT( 'book' );
		$book->setLabels( 'Book', 'Books' );
		$book->description  = 'Books.';
		$book->public       = true;
		$book->show_in_rest = true;
		$book->menu_icon    = 'dashicons-book-alt';
		$book->has_archive  = true;
		$book->rewrite      = [ 'slug' => 'books' ];
		$book->supports     = [
			'title',
			'editor',
			'excerpt',
			'thumbnail',
			'comments',
		];
		$book->register();

		/**
		 * Book CPT column customization.
		 */
		$book
			->removeColumn( 'comments' )
			->appendCustomColumns( [
				'description'  => 'Description',
				'review_score' => 'Review Score',
			], 'title' )
			->customizeCustomColumnAppearance( 'description', function() {
				echo get_the_excerpt();
			} )
			->customizeCustomColumnAppearance( 'review_score', function( $postId ) {
				echo review_score( $postId );
			} );
	}

	/**
	 * Registers game custom post type.
	 *
	 * @return void
	 */
	private function registerGameCPT() {
		$game = new CPT( 'game' );
		$game->setLabels( 'Game', 'Games' );
		$game->description  = 'Games.';
		$game->public       = true;
		$game->show_in_rest = true;
		$game->menu_icon    = 'dashicons-games';
		$game->has_archive  = true;
		$game->rewrite      = [ 'slug' => 'games' ];
		$game->supports     = [
			'title',
			'editor',
			'excerpt',
			'thumbnail',
			'comments',
		];
		$game->register();

		/**
		 * Game CPT column customization.
		 */
		$game
			->removeColumn( 'comments' )
			->appendCustomColumns( [
				'description'  => 'Description',
				'review_score' => 'Review Score',
			], 'title' )
			->customizeCustomColumnAppearance( 'description', function() {
				echo get_the_excerpt();
			} )
			->customizeCustomColumnAppearance( 'review_score', function( $postId ) {
				echo review_score( $postId );
			} );
	}

	/**
	 * Registers messages custom post type.
	 *
	 * @return void
	 */
	private function registerMessagesCPT() {
		$messages = new CPT( 'demo-contact' );
		$messages->setLabels( 'Message', 'Messages' );
		$messages->description = 'Contact messages from visitors.';
		$messages->public      = true;
		$messages->menu_icon   = 'dashicons-email-alt';
		$messages->supports    = [
			'title',
			'editor',
			'author',
		];
		$messages->register();

		/**
		 * Messages CPT column customization.
		 */
		$messages
			->removeColumn( 'author' )
			->changeColumnLabel( 'title', 'Full Name' )
			->appendCustomColumns( [
				'message' => 'Message',
				'email'   => 'E-mail',
			], 'title' )
			->customizeCustomColumnsAppearance( function( $column, $postId ) {
				switch ( $column ) {
					case 'message':
						echo get_the_excerpt();
						break;

					case 'email':
						$email = get_post_meta( $postId, '_contact_email_value_key', true );
						echo '<a href="mailto:' . $email . '">' . $email . '</a>';
						break;
				}
			} );
	}

	/**
	 * Registers newsletter custom post type.
	 *
	 * @return void
	 */
	private function registerNewsletterCPT() {
		if ( get_option( 'newsletter_active' ) ) {
			$newsletter = new CPT( 'newsletter' );
			$newsletter->setLabels( 'Newsletter', 'Newsletter' );
			$newsletter->description = 'Newsletter subscriptions.';
			$newsletter->public      = false;
			$newsletter->menu_icon   = 'dashicons-email-alt';
			$newsletter->supports    = [ 'title', ];
			$newsletter->register();
		}
	}

}