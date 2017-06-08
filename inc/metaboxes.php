<?php
define( 'DESIGNED_PAGE_TEMPLATES', json_encode( array( 'homepage.php', 'issue.php'. 'about.php' ) ) );

function prh_customize_meta_boxes( $post_type ) {
	global $pagenow;

	if( 'post.php' != $pagenow ) {
		return;
	}
	// Get the Post ID.
	$post_id = filter_input(INPUT_GET, 'post') ? filter_input(INPUT_GET, 'post' ) : filter_input(INPUT_POST, 'post_ID' );
	if( !isset( $post_id ) ) {
		return;
	}

	if ( $post_type == 'page' ) {
		remove_meta_box( 'postimagediv','page','side' ); // Featured Image Metabox
		remove_meta_box( 'postcustom','page','normal' ); // Custom Fields Metabox
	}
	$template_filename = get_post_meta( $post_id, '_wp_page_template', true );

	if( in_array( $template_filename, json_decode( DESIGNED_PAGE_TEMPLATES ) ) ) {
		remove_post_type_support( 'page', 'editor' ); // Remove Text Editor
		remove_meta_box( 'edit-box-ppr','page','normal' ); // Quick Redirect Metabox
	}
}
add_action( 'do_meta_boxes', 'prh_customize_meta_boxes' );

