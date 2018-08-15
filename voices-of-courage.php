<?php
/**
 * Template name: Voice of Courage
 */

$created_story = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST' &&  
	isset( $_POST['cpt_nonce_field'] ) && 
	wp_verify_nonce( $_POST['cpt_nonce_field'], 'cpt_nonce_action' ) ) {

	// create post object with the form values
	$post_title = $_POST['storyName'];
	$my_cptpost_args = array(
		'post_title' => $post_title,
		'post_status' => 'pending',
		'post_type' => 'phys_story',
	);

	// insert the post into the database
	$cpt_id = wp_insert_post( $my_cptpost_args);
	wp_set_post_tags( $cpt_id, $_POST['storyState'], true );
	update_field('voc_story', $_POST['storyContent'], $cpt_id);
	update_field('voc_email', $_POST['storyEmail'], $cpt_id);
	update_field('voc_name', $_POST['storyName'], $cpt_id);

	// insert the photo is present
	$f = 'storyPhoto';
	if( !empty( $_FILES[$f]['name'] )) {
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		$upload_overrides = array( 'test_form' => false );
		$file = wp_handle_upload( $_FILES[$f], $upload_overrides);
	
		if ( isset( $file['error'] )) {
			return new WP_Error( 'upload_error', $file['error'] );
		}
		$file_type = wp_check_filetype($_FILES[$f]['name'], array(
			'jpg|jpeg' => 'image/jpeg',
			'gif' => 'image/gif',
			'png' => 'image/png',
		));
		if ($file_type['type']) {
			$name_parts = pathinfo( $file['file'] );
			$name = $_FILES[$f]['name'];
			$type = $file['type'];
			
			$attachment = array(
			'post_title' => ($post_title . "-photo"),
			'post_type' => 'attachment',
			'post_mime_type' => $type,
			'guid' => $file['url'],
			);
			
			$attach_id = wp_insert_attachment( $attachment, $file['file'], $cpt_id );
			update_field('voc_photo', $attach_id, $cpt_id);
		}
	}
	$created_story = true;
}


get_header();

$page = new PageModules( get_the_ID(), true );
// determines the header for an about us or issue page
$hero_banner_name = MODULES['Page Hero Banner']['name'];
$hero_banner = $page->modules[$hero_banner_name];
$banner = false;
if ($hero_banner) {
	$hero_banner_image_name = MODULES['Page Hero Banner']['image'];
	$banner = $hero_banner[$hero_banner_image_name]['url'];
}		
$page->init();
$page->hero = array(
	'module_name' => 'Page Hero',
	'config' => PAGE_HERO_MODULE,
	'hero_jump_links' => $page->jump_links(),
	'banner' => $banner,
	'class_name' => 'voc',
	'show_alert' => $created_story
);
$page->render();

get_footer();
