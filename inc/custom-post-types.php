<?php

//---CUSTOM COLUMNS FOR POST TYPES---//
add_action( 'manage_demo-contact_posts_custom_column', 'demo_contact_custom_columns', 10, 2 );

function demo_contact_custom_columns( $column, $post_id ) {
	switch ( $column ) {
		case 'message':
			echo get_the_excerpt();
			break;

		case 'email':
			$email = get_post_meta( $post_id, '_contact_email_value_key', true );
			echo '<a href="mailto:' . $email . '">' . $email . '</a>';
			break;
	}
}
