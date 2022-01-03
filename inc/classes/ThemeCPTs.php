<?php

/**
 * Wrapper for theme roles
 *
 * @package demo
 */

namespace Demo\Inc\Classes;

use Demo\Inc\Classes\Core\CPT;
use Demo\Inc\Classes\Base\ResourceBase;
use Demo\Inc\Classes\Core\Metabox;

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

		$this->customizeMovieColumns( $movie );
	}

	/**
	 * Movie CPT column customization.
	 */
	private function customizeMovieColumns( $movie ) {
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

		$this->customizeBookColumns( $book );
	}

	/**
	 * Book CPT column customization.
	 */
	private function customizeBookColumns( $book ) {
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

		$this->customizeGameColumns( $game );
	}

	/**
	 * Game CPT column customization.
	 */
	private function customizeGameColumns( $game ) {
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

		$this->customizeMessagesColumns( $messages );
		$this->addMessagesCustomMetaboxes();
	}

	/**
	 * Messages CPT column customization.
	 */
	private function customizeMessagesColumns( $messages ) {
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
	 * Messages CPT custom metaboxes.
	 */
	private function addMessagesCustomMetaboxes() {
		$metabox = new Metabox(
			[ 'demo-contact' ],
			'contact_email',
			'User Email',
			'side'
		);
		$metabox->addRenderCallback( [ $this, 'renderMessagesEmailMetabox' ] );
		$metabox->addSaveMetaboxDataCallback( [ $this, 'saveMessagesEmailData' ] );

		$metabox->register();
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
			$newsletter->public      = true;
			$newsletter->menu_icon   = 'dashicons-email-alt';
			$newsletter->supports    = [ 'title', ];
			$newsletter->register();
		}
	}

	/**
	 * Metabox specific methods
	 */
	public function renderMessagesEmailMetabox( $post ) {
		wp_nonce_field( 'demo_save_contact_email_data', 'demo_contact_metabox_nonce' );

		$emailValue = get_post_meta( $post->ID, '_contact_email_value_key', true );

		echo '<label for="demo_contact_email_field">User Email Address: </label>';
		echo '<input type="email" id="demo_contact_email_field" name="demo_contact_email_field" value="' . esc_attr( $emailValue ) . '"size="25" />';
	}

	public function saveMessagesEmailData( $postId, $post, $isUpdating ) {
		//Check if nonce is not set
		if ( ! isset( $_POST['demo_contact_metabox_nonce'] ) ) {
			return;
		}

		//Check if nonce is valid (generated by WordPress and not manually)
		if ( ! wp_verify_nonce( $_POST['demo_contact_metabox_nonce'], 'demo_save_contact_email_data' ) ) {
			return;
		}

		//Check if is auto-saved or not
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		//Check if user have permission
		if ( ! current_user_can( 'edit_post', $postId ) ) {
			return;
		}

		//Check if we pass something inside email input
		if ( ! isset( $_POST['demo_contact_email_field'] ) ) {
			return;
		}

		$dataToStore = sanitize_text_field( $_POST['demo_contact_email_field'] );

		update_post_meta( $postId, '_contact_email_value_key', $dataToStore );
	}
}