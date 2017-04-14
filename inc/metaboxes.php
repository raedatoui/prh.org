<?php

// disable default dashboard widgets
function prh_custom_dashboard_widgets() {
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core'); // Comments Widget
	remove_meta_box('dashboard_quick_press','dashboard','side'); //Quick Press widget
}

add_action('wp_dashboard_setup', 'prh_custom_dashboard_widgets');


define( 'DESIGNED_PAGE_TEMPLATES', json_encode( array( 'homepage.php', 'issue.php' ) ) );

function customize_admin( $post_type ) {
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
		remove_meta_box( 'slugdiv','page','normal' ); // Slug Metabox
		remove_meta_box( 'authordiv','page','normal' ); // Author Metabox
		remove_meta_box( 'postcustom','page','normal' ); // Custom Fields Metabox
	}
	$template_filename = get_post_meta( $post_id, '_wp_page_template', true );

	if( in_array( $template_filename, json_decode( DESIGNED_PAGE_TEMPLATES ) ) ) {
		remove_post_type_support( 'page', 'editor' ); // Remove Text Editor
		remove_meta_box( 'postexcerpt','page','normal' ); // Excerpt Metabox
		remove_meta_box( 'edit-box-ppr','page','normal' ); // Quick Redirect Metabox
	}
}
add_action( 'do_meta_boxes', 'customize_admin' );