<?php

/************* Editor customization *****************/

/**
 * Hide the main editor on specific pages
 */
define('EDITOR_HIDE_PAGE_TITLES', json_encode(array()));
define('EDITOR_HIDE_PAGE_TEMPLATES', json_encode(array('homepage.php')));

/**
 * Hide the main editor on defined pages
 *
 * You can choose between page titles or page templates. Just set them
 * accordingly like this:
 *
 * define('EDITOR_HIDE_PAGE_TITLES', json_encode(array('Home', 'Some post archive', 'Some Listing')));
 * define('EDITOR_HIDE_PAGE_TEMPLATES', json_encode(array('template-of-something.php', 'archive-customposttype.php')));
 *
 *
 * @global string $pagenow
 * @return void
 */
function prh_hide_editor() {
	global $pagenow;
	if(!('post.php' == $pagenow)){
		return;
	}

	// Get the Post ID.
	$post_id = filter_input(INPUT_GET, 'post') ? filter_input(INPUT_GET, 'post') : filter_input(INPUT_POST, 'post_ID');
	if(!isset($post_id)) {
		return;
	}

	// Hide the editor on the page titled 'Homepage'
	if(in_array(get_the_title($post_id), json_decode(EDITOR_HIDE_PAGE_TITLES))) {
		remove_post_type_support('page', 'editor');
	}

	// Hide the editor on a page with a specific page template
	$template_filename = get_post_meta($post_id, '_wp_page_template', true);

	if(in_array($template_filename, json_decode(EDITOR_HIDE_PAGE_TEMPLATES))) {
		remove_post_type_support('page', 'editor');
	}
}
add_action('admin_init', 'prh_hide_editor');


/**
 * Callback function to insert 'styleselect' into the $buttons array
 */
function prh_mce_buttons( $buttons ) {
	array_unshift($buttons, 'styleselect');
	return $buttons;
}
add_filter('mce_buttons', 'prh_mce_buttons');

/**
 * Callback function to insert custom styles into the styleselect dropdown.
 */
function prh_mce_before_init_insert_formats( $init_array ) {
	// Define the style_formats array
	$style_formats = array(
		// Each array child is a format with it's own settings
		array(
			'title' => 'Hero link',
			'inline' => 'a',
			'classes' => 'hero__link underline',
			'wrapper' => false,
		),
		array(
			'title' => 'Lead copy',
			'classes' => 'lead-copy',
			'block' => 'p'
			)
	);
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode($style_formats);
	return $init_array;
}
add_filter('tiny_mce_before_init', 'prh_mce_before_init_insert_formats');

/**
 * Callback function for adding the main CSS to the editor allowing to preview
 * typography styles directly in the editor's visual mode.
 */
function prh_custom_editor_styles() {
	add_editor_style('css/main.css');
}
add_action('init', 'prh_custom_editor_styles');


function set_post_order_in_admin( $wp_query ) {
	global $pagenow;
	if ( is_admin() && 'edit.php' == $pagenow && !isset($_GET['orderby'])) {
			$wp_query->set( 'orderby', 'date' );
			$wp_query->set( 'order', 'DESC' );
	}
}

add_filter('pre_get_posts', 'set_post_order_in_admin', 5 );


/**
 * Add a quick link to the homepage in the admin menu, because convenience.
 **/
function prh_admin_menu() {
		$front_id = get_option(page_on_front);
		$front_slug = 'post.php?post=' . $front_id . '&action=edit';

		add_pages_page(
				'Home',
				'Home',
				'edit_pages',
				$front_slug);
}

add_action('admin_menu', 'prh_admin_menu');