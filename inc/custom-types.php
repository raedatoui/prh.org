<?php

/************* Custom Post Type - Press Release *****************/
function press_release_type() {
	// creating (registering) the custom type
	register_post_type('press_release', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array(
			'labels' => array(
				'name' => __('Press Releases', 'prh-wp-theme'), /* This is the Title of the Group */
				'singular_name' => __('Press Release', 'prh-wp-theme'), /* This is the individual type */
				'all_items' => __('All Press Releases', 'prh-wp-theme'), /* the all items menu item */
				'add_new' => __('Add New', 'prh-wp-theme'), /* The add new menu item */
				'add_new_item' => __('Add New Press Release', 'prh-wp-theme'), /* Add New Display Title */
				'edit' => __('Edit', 'prh-wp-theme'), /* Edit Dialog */
				'edit_item' => __('Edit Press Release', 'prh-wp-theme'), /* Edit Display Title */
				'new_item' => __('New Press Release', 'prh-wp-theme'), /* New Display Title */
				'view_item' => __('View Press Release', 'prh-wp-theme'), /* View Display Title */
				'search_items' => __('Search Press Release', 'prh-wp-theme'), /* Search Custom Type Title */
				'not_found' => __('Nothing found in the Database.', 'prh-wp-theme'), /* This displays if there are no entries yet */
				'not_found_in_trash' => __('Nothing found in Trash', 'prh-wp-theme'), /* This displays if there is nothing in the trash */
				'parent_item_colon' => '',
			), /* end of arrays */
			'description' => __('Press releases', 'prh-wp-theme'), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
			'menu_icon' => get_stylesheet_directory_uri() . '/images/admin/icons/custom-post-icon.png', /* the icon for the custom post type menu */
			'rewrite' => array('slug' => 'press-release', 'with_front' => false), /* you can specify its url slug */
			'has_archive' => 'press-release', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky'),
		) /* end of options */
	); /* end of register post type */

	/* this adds your post categories to your custom post type */
	register_taxonomy_for_object_type('category', 'press_release');
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type('post_tag', 'press_release');
}
add_action('init', 'press_release_type');

/************* Custom Post Type - phys_story *****************/
function phys_story_type() {
	// creating (registering) the custom type
	register_post_type('phys_story', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array(
			'labels' => array(
				'name' => __('Physician Stories', 'prh-wp-theme'), /* This is the Title of the Group */
				'singular_name' => __('Physician Story', 'prh-wp-theme'), /* This is the individual type */
				'all_items' => __('All Physician Stories', 'prh-wp-theme'), /* the all items menu item */
				'add_new' => __('Add New', 'prh-wp-theme'), /* The add new menu item */
				'add_new_item' => __('Add New Physician Stories', 'prh-wp-theme'), /* Add New Display Title */
				'edit' => __('Edit', 'prh-wp-theme'), /* Edit Dialog */
				'edit_item' => __('Edit Physician Stories', 'prh-wp-theme'), /* Edit Display Title */
				'new_item' => __('New Physician Story', 'prh-wp-theme'), /* New Display Title */
				'view_item' => __('View Physician Story', 'prh-wp-theme'), /* View Display Title */
				'search_items' => __('Search Physician Stories', 'prh-wp-theme'), /* Search Custom Type Title */
				'not_found' => __('Nothing found in the Database.', 'prh-wp-theme'), /* This displays if there are no entries yet */
				'not_found_in_trash' => __('Nothing found in Trash', 'prh-wp-theme'), /* This displays if there is nothing in the trash */
				'parent_item_colon' => '',
			), /* end of arrays */
			'description' => __('Physician Stories', 'prh-wp-theme'), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
			'menu_icon' => get_template_directory_uri() . '/images/admin/icons/phy_story_icon.png', /* the icon for the custom post type menu */
			'rewrite' => array('slug' => 'physicians-story', 'with_front' => false), /* you can specify its url slug */
			'has_archive' => 'physicians-story', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky'),
		) /* end of options */
	); /* end of register post type */
	/* this adds your post categories to your custom post type */
	register_taxonomy_for_object_type('category', 'phys_story');
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type('post_tag', 'phys_story');
}
add_action('init', 'phys_story_type');

/************* Custom Post Type - prh_ipaper *****************/
function prh_ipaper_type() {
	// creating (registering) the custom type
	register_post_type('prh_ipaper', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array(
			'labels' => array(
				'name' => __('iPaper', 'prh-wp-theme'), /* This is the Title of the Group */
				'singular_name' => __('iPaper', 'prh-wp-theme'), /* This is the individual type */
				'all_items' => __('All iPapers', 'prh-wp-theme'), /* the all items menu item */
				'add_new' => __('Add New', 'prh-wp-theme'), /* The add new menu item */
				'add_new_item' => __('Add New iPaper', 'prh-wp-theme'), /* Add New Display Title */
				'edit' => __('Edit', 'prh-wp-theme'), /* Edit Dialog */
				'edit_item' => __('Edit iPapers', 'prh-wp-theme'), /* Edit Display Title */
				'new_item' => __('New iPaper', 'prh-wp-theme'), /* New Display Title */
				'view_item' => __('View iPaper', 'prh-wp-theme'), /* View Display Title */
				'search_items' => __('Search iPapers', 'prh-wp-theme'), /* Search Custom Type Title */
				'not_found' => __('Nothing found in the Database.', 'prh-wp-theme'), /* This displays if there are no entries yet */
				'not_found_in_trash' => __('Nothing found in Trash', 'prh-wp-theme'), /* This displays if there is nothing in the trash */
				'parent_item_colon' => '',
			), /* end of arrays */
			'description' => __('iPaper', 'prh-wp-theme'), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
			'menu_icon' => get_template_directory_uri() . '/images/admin/icons/scribd_documents_icon.png', /* the icon for the custom post type menu */
			'rewrite' => array('slug' => 'iPaper', 'with_front' => false), /* you can specify its url slug */
			'has_archive' => 'iPaper', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array('title', 'editor', 'author', 'sticky'),
		) /* end of options */
	); /* end of register post type */
	/* this adds your post categories to your custom post type */
	register_taxonomy_for_object_type('category', 'prh_ipaper');
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type('post_tag', 'prh_ipaper');
}
add_action('init', 'prh_ipaper_type');


// Register the column for modified date
function prh_post_modified_column_register( $columns ) {
	$columns['post_modified'] = __( 'Modified Date', 'mytextdomain' );
	return $columns;
}
add_filter( 'manage_edit-post_columns', 'prh_post_modified_column_register' );
add_filter( 'manage_edit-page_columns', 'prh_post_modified_column_register' );
add_filter( 'manage_edit-press_release_columns', 'prh_post_modified_column_register' );
add_filter( 'manage_edit-phys_story_columns', 'prh_post_modified_column_register' );

// Display the modified date column content
function prh_post_modified_column_display( $column_name, $post_id ) {
	if ( 'post_modified' != $column_name ){
		return;
	}
	$post_modified = get_post_field('post_modified', $post_id);
	if ( !$post_modified ){
		$post_modified = '' . __( 'undefined', 'mytextdomain' ) . '';
	}
	echo $post_modified;
}
add_action( 'manage_posts_custom_column', 'prh_post_modified_column_display', 10, 2 );
add_action( 'manage_pages_custom_column', 'prh_post_modified_column_display', 10, 2 );
add_action( 'manage_press_releases_custom_column', 'prh_post_modified_column_display', 10, 2 );
add_action( 'manage_phys_stories_custom_column', 'prh_post_modified_column_display', 10, 2 );

// Register the modified date column as sortable
function prh_post_modified_column_register_sortable( $columns ) {
	$columns['post_modified'] = 'post_modified';
	return $columns;
}
add_filter( 'manage_edit-post_sortable_columns', 'prh_post_modified_column_register_sortable' );
add_filter( 'manage_edit-page_sortable_columns', 'prh_post_modified_column_register_sortable' );
add_filter( 'manage_edit-press_release_sortable_columns', 'prh_post_modified_column_register_sortable' );
add_filter( 'manage_edit-phys_story_sortable_columns', 'prh_post_modified_column_register_sortable' );