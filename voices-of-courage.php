<?php
/**
 * Template name: Voice of Courage
 */


function akismet_comment_check( $key, $data ) {
	$request = 'blog='. urlencode($data['blog']) .
			'&user_ip='. urlencode($data['user_ip']) .
			'&user_agent='. urlencode($data['user_agent']) .
			'&referrer='. urlencode($data['referrer']) .
			'&permalink='. urlencode($data['permalink']) .
			'&comment_type='. urlencode($data['comment_type']) .
			'&comment_author='. urlencode($data['comment_author']) .
			'&comment_author_email='. urlencode($data['comment_author_email']) .
			// '&comment_author_url='. urlencode($data['comment_author_url']) .
			'&comment_content='. urlencode($data['comment_content']) .
			'&blog_lang=en';
			// '&is_test=true';

	$host = $http_host = $key.'.rest.akismet.com';
	$path = '/1.1/comment-check';
	$port = 443;
	$akismet_ua = "WordPress/4.9.8 | Akismet/4.0.8";
	$content_length = strlen( $request );
	$http_request  = "POST $path HTTP/1.0\r\n";
	$http_request .= "Host: $host\r\n";
	$http_request .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$http_request .= "Content-Length: {$content_length}\r\n";
	$http_request .= "User-Agent: {$akismet_ua}\r\n";
	$http_request .= "\r\n";
	$http_request .= $request;
	$response = '';

	if( false != ( $fs = @fsockopen( 'ssl://' . $http_host, $port, $errno, $errstr, 10 ) ) ) {
		
		fwrite( $fs, $http_request );
	
		while ( !feof( $fs ) )
			$response .= fgets( $fs, 1160 ); // One TCP-IP packet
		fclose( $fs );

		$response = explode( "\r\n\r\n", $response, 2 );
	}
	
	if ( 'true' == $response[1] )
		return true;
	else
		return false;
}


$created_story = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST' &&  
	isset( $_POST['cpt_nonce_field'] ) && 
	wp_verify_nonce( $_POST['cpt_nonce_field'], 'cpt_nonce_action' ) ) {
	
	// Call to verify key function
	$valid_key = akismet_verify_key('c0384275eb73', 'https://prh.org');
	
	if ($valid_key) {
		// story data to check
		$data = array('blog' => 'https://prh.org',
				'user_ip' => $_SERVER['REMOTE_ADDR'],
				'user_agent' => $_SERVER['HTTP_USER_AGENT'],
				'referrer' => $_SERVER['HTTP_REFERER'],
				'permalink' => 'https://prh.org/voicesofcourage',
				'comment_type' => 'blog-post',
				'comment_author' => $_POST['storyName'],
				'comment_author_email' => $_POST['storyEmail'],
				// 'comment_author_url' => 'http://www.CheckOutMyCoolSite.com',
				'comment_content' => $_POST['storyContent']);

		$spam = akismet_comment_check( 'c0384275eb73', $data );

		if (!$spam) {
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
		}

		$created_story = true;
	}
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
	'config' => VOC_HERO_MODULE,
	'hero_jump_links' => $page->jump_links(),
	'banner' => $banner,
	'class_name' => 'voc',
	'show_alert' => $created_story
);
$page->render();

get_footer();
