<?php

/**
 * Press Release
 */
function press_release_type() {
	// creating (registering) the custom type
	register_post_type( 'press_release', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array(
			'labels' => array(
				'name' => __( 'Press Releases', 'prh-wp-theme' ), /* This is the Title of the Group */
				'singular_name' => __( 'Press Release', 'prh-wp-theme' ), /* This is the individual type */
				'all_items' => __( 'All Press Releases', 'prh-wp-theme' ), /* the all items menu item */
				'add_new' => __( 'Add New', 'prh-wp-theme' ), /* The add new menu item */
				'add_new_item' => __( 'Add New Press Release', 'prh-wp-theme' ), /* Add New Display Title */
				'edit' => __( 'Edit', 'prh-wp-theme' ), /* Edit Dialog */
				'edit_item' => __( 'Edit Press Release', 'prh-wp-theme' ), /* Edit Display Title */
				'new_item' => __( 'New Press Release', 'prh-wp-theme' ), /* New Display Title */
				'view_item' => __( 'View Press Release', 'prh-wp-theme' ), /* View Display Title */
				'search_items' => __( 'Search Press Release', 'prh-wp-theme' ), /* Search Custom Type Title */
				'not_found' => __( 'Nothing found in the Database.', 'prh-wp-theme' ), /* This displays if there are no entries yet */
				'not_found_in_trash' => __( 'Nothing found in Trash', 'prh-wp-theme' ), /* This displays if there is nothing in the trash */
				'parent_item_colon' => '',
			), /* end of arrays */
			'description' => __( 'Press releases', 'prh-wp-theme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_icon'   => 'dashicons-admin-page', /* the icon for the custom post type menu */
			'rewrite' => array( 'slug' => 'press-release', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'press-release', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'revisions', 'sticky' ),
		) /* end of options */
	); /* end of register post type */
	/* this adds your post categories to your custom post type */
	register_taxonomy_for_object_type( 'category', 'press_release' );
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type( 'post_tag', 'press_release' );
}
add_action( 'init', 'press_release_type' );

/**
 * Story
 */
function story_type() {
	// creating (registering) the custom type
	register_post_type( 'phys_story', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array(
			'labels' => array(
				'name' => __( 'Stories', 'prh-wp-theme' ), /* This is the Title of the Group */
				'singular_name' => __( 'Story', 'prh-wp-theme' ), /* This is the individual type */
				'all_items' => __( 'All Stories', 'prh-wp-theme' ), /* the all items menu item */
				'add_new' => __( 'Add New', 'prh-wp-theme' ), /* The add new menu item */
				'add_new_item' => __( 'Add New Story', 'prh-wp-theme' ), /* Add New Display Title */
				'edit' => __( 'Edit', 'prh-wp-theme' ), /* Edit Dialog */
				'edit_item' => __( 'Edit Story', 'prh-wp-theme' ), /* Edit Display Title */
				'new_item' => __( 'New Story', 'prh-wp-theme' ), /* New Display Title */
				'view_item' => __( 'View Story', 'prh-wp-theme' ), /* View Display Title */
				'search_items' => __( 'Search Stories', 'prh-wp-theme' ), /* Search Custom Type Title */
				'not_found' => __( 'Nothing found in the Database.', 'prh-wp-theme' ), /* This displays if there are no entries yet */
				'not_found_in_trash' => __( 'Nothing found in Trash', 'prh-wp-theme' ), /* This displays if there is nothing in the trash */
				'parent_item_colon' => '',
			), /* end of arrays */
			'description' => __( 'Stories', 'prh-wp-theme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_icon'   => 'dashicons-admin-page', /* the icon for the custom post type menu */
			'rewrite' => array( 'slug' => 'stories', 'with_front' => false), /* you can specify its url slug */
			'has_archive' => 'story', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'revisions', 'sticky' ),
		) /* end of options */
	); /* end of register post type */
	/* this adds your post categories to your custom post type */
	register_taxonomy_for_object_type( 'category', 'phys_story' );
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type( 'post_tag', 'phys_story' );
}
add_action( 'init', 'story_type' );

/**
 * Legal publication
 */
function publication_type() {
	// creating (registering) the custom type
	register_post_type( 'prh_ipaper', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array(
			'labels' => array(
				'name' => __( 'Legal Publications', 'prh-wp-theme' ), /* This is the Title of the Group */
				'singular_name' => __( 'Legal Publication', 'prh-wp-theme' ), /* This is the individual type */
				'all_items' => __( 'All Legal Publications', 'prh-wp-theme' ), /* the all items menu item */
				'add_new' => __( 'Add New', 'prh-wp-theme' ), /* The add new menu item */
				'add_new_item' => __( 'Add New Legal Publication', 'prh-wp-theme' ), /* Add New Display Title */
				'edit' => __( 'Edit', 'prh-wp-theme' ), /* Edit Dialog */
				'edit_item' => __( 'Edit Legal Publication', 'prh-wp-theme' ), /* Edit Display Title */
				'new_item' => __( 'New Legal Publication', 'prh-wp-theme' ), /* New Display Title */
				'view_item' => __( 'View Legal Publication', 'prh-wp-theme' ), /* View Display Title */
				'search_items' => __( 'Search Legal Publications', 'prh-wp-theme' ), /* Search Custom Type Title */
				'not_found' => __( 'Nothing found in the Database.', 'prh-wp-theme' ), /* This displays if there are no entries yet */
				'not_found_in_trash' => __( 'Nothing found in Trash', 'prh-wp-theme' ), /* This displays if there is nothing in the trash */
				'parent_item_colon' => '',
			), /* end of arrays */
			'description' => __( 'Legal Publications', 'prh-wp-theme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_icon'   => 'dashicons-admin-page', /* the icon for the custom post type menu */
			'rewrite' => array( 'slug' => 'legal-publications', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'legal-publication', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'sticky', 'thumbnail', 'excerpt', 'revisions' ),
		) /* end of options */
	); /* end of register post type */
	/* this adds your post categories to your custom post type */
	register_taxonomy_for_object_type( 'category', 'prh_ipaper' );
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type( 'post_tag', 'prh_ipaper' );
}
add_action( 'init', 'publication_type' );

/**
 * Update
 */
function update_type() {
	// creating (registering) the custom type
	register_post_type( 'prh_update', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array(
			'labels' => array(
				'name' => __( 'Updates', 'prh-wp-theme' ), /* This is the Title of the Group */
				'singular_name' => __( 'Update', 'prh-wp-theme' ), /* This is the individual type */
				'all_items' => __( 'All Updates', 'prh-wp-theme' ), /* the all items menu item */
				'add_new' => __( 'Add New', 'prh-wp-theme' ), /* The add new menu item */
				'add_new_item' => __( 'Add New Update', 'prh-wp-theme' ), /* Add New Display Title */
				'edit' => __( 'Edit', 'prh-wp-theme' ), /* Edit Dialog */
				'edit_item' => __( 'Edit Update', 'prh-wp-theme' ), /* Edit Display Title */
				'new_item' => __( 'New Update', 'prh-wp-theme' ), /* New Display Title */
				'view_item' => __( 'View Update', 'prh-wp-theme' ), /* View Display Title */
				'search_items' => __( 'Search Updates', 'prh-wp-theme' ), /* Search Custom Type Title */
				'not_found' => __( 'Nothing found in the Database.', 'prh-wp-theme' ), /* This displays if there are no entries yet */
				'not_found_in_trash' => __( 'Nothing found in Trash', 'prh-wp-theme' ), /* This displays if there is nothing in the trash */
				'parent_item_colon' => '',
			), /* end of arrays */
			'description' => __( 'Updates', 'prh-wp-theme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_icon'   => 'dashicons-admin-page', /* the icon for the custom post type menu */
			'rewrite' => array( 'slug' => 'updates', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'update', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'sticky', 'thumbnail', 'excerpt', 'revisions' ),
		) /* end of options */
	); /* end of register post type */
	/* this adds your post categories to your custom post type */
	register_taxonomy_for_object_type( 'category', 'prh_update' );
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type( 'post_tag', 'prh_update' );
}
add_action( 'init', 'update_type' );

/**
 * Report
 */
function report_type() {
	// creating (registering) the custom type
	register_post_type( 'prh_report', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array(
			'labels' => array(
				'name' => __( 'Reports', 'prh-wp-theme' ), /* This is the Title of the Group */
				'singular_name' => __( 'Report', 'prh-wp-theme' ), /* This is the individual type */
				'all_items' => __( 'All Reports', 'prh-wp-theme' ), /* the all items menu item */
				'add_new' => __( 'Add New', 'prh-wp-theme' ), /* The add new menu item */
				'add_new_item' => __( 'Add New Report', 'prh-wp-theme' ), /* Add New Display Title */
				'edit' => __( 'Edit', 'prh-wp-theme' ), /* Edit Dialog */
				'edit_item' => __( 'Edit Report', 'prh-wp-theme' ), /* Edit Display Title */
				'new_item' => __( 'New Report', 'prh-wp-theme' ), /* New Display Title */
				'view_item' => __( 'View Report', 'prh-wp-theme' ), /* View Display Title */
				'search_items' => __( 'Search Reports', 'prh-wp-theme' ), /* Search Custom Type Title */
				'not_found' => __( 'Nothing found in the Database.', 'prh-wp-theme' ), /* This displays if there are no entries yet */
				'not_found_in_trash' => __( 'Nothing found in Trash', 'prh-wp-theme' ), /* This displays if there is nothing in the trash */
				'parent_item_colon' => '',
			), /* end of arrays */
			'description' => __( 'Reports', 'prh-wp-theme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_icon'   => 'dashicons-admin-page', /* the icon for the custom post type menu */
			'rewrite' => array( 'slug' => 'reports', 'with_front' => false), /* you can specify its url slug */
			'has_archive' => 'report', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'sticky', 'thumbnail', 'excerpt', 'revisions' ),
		) /* end of options */
	); /* end of register post type */
	/* this adds your post categories to your custom post type */
	register_taxonomy_for_object_type( 'category', 'prh_report' );
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type( 'post_tag', 'prh_report' );
}
add_action( 'init', 'report_type' );

/**
 * PRH in The News
 */
function news_type() {
	// creating (registering) the custom type
	register_post_type( 'prh_news', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array(
			'labels' => array(
				'name' => __( 'PRH In the News', 'prh-wp-theme' ), /* This is the Title of the Group */
				'singular_name' => __( 'PRH In the News', 'prh-wp-theme' ), /* This is the individual type */
				'all_items' => __( 'All News', 'prh-wp-theme' ), /* the all items menu item */
				'add_new' => __( 'Add New', 'prh-wp-theme' ), /* The add new menu item */
				'add_new_item' => __( 'Add New News Item', 'prh-wp-theme' ), /* Add New Display Title */
				'edit' => __( 'Edit', 'prh-wp-theme' ), /* Edit Dialog */
				'edit_item' => __( 'Edit News Item', 'prh-wp-theme' ), /* Edit Display Title */
				'new_item' => __( 'New News Item', 'prh-wp-theme' ), /* New Display Title */
				'view_item' => __( 'View News Item', 'prh-wp-theme' ), /* View Display Title */
				'search_items' => __( 'Search New Items', 'prh-wp-theme' ), /* Search Custom Type Title */
				'not_found' => __( 'Nothing found in the Database.', 'prh-wp-theme' ), /* This displays if there are no entries yet */
				'not_found_in_trash' => __( 'Nothing found in Trash', 'prh-wp-theme' ), /* This displays if there is nothing in the trash */
				'parent_item_colon' => '',
			), /* end of arrays */
			'description' => __( 'PRH In the News', 'prh-wp-theme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_icon'   => 'dashicons-admin-page', /* the icon for the custom post type menu */
			'rewrite' => array( 'slug' => 'news', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'news', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'sticky', 'thumbnail', 'excerpt', 'revisions' ),
		) /* end of options */
	); /* end of register post type */
	/* this adds your post categories to your custom post type */
	register_taxonomy_for_object_type( 'category', 'prh_news' );
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type( 'post_tag', 'prh_news' );
}
add_action( 'init', 'news_type' );

/**
 * Events
 */
function event_type() {
	// creating (registering) the custom type
	register_post_type( 'prh_events', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array(
			'labels' => array(
				'name' => __( 'Events', 'prh-wp-theme' ), /* This is the Title of the Group */
				'singular_name' => __( 'Event', 'prh-wp-theme' ), /* This is the individual type */
				'all_items' => __( 'All Events', 'prh-wp-theme' ), /* the all items menu item */
				'add_new' => __( 'Add New', 'prh-wp-theme' ), /* The add new menu item */
				'add_new_item' => __( 'Add New Event', 'prh-wp-theme' ), /* Add New Display Title */
				'edit' => __( 'Edit', 'prh-wp-theme' ), /* Edit Dialog */
				'edit_item' => __( 'Edit Event', 'prh-wp-theme' ), /* Edit Display Title */
				'new_item' => __( 'New Event', 'prh-wp-theme' ), /* New Display Title */
				'view_item' => __( 'View Event', 'prh-wp-theme' ), /* View Display Title */
				'search_items' => __( 'Search Events', 'prh-wp-theme' ), /* Search Custom Type Title */
				'not_found' => __( 'Nothing found in the Database.', 'prh-wp-theme' ), /* This displays if there are no entries yet */
				'not_found_in_trash' => __( 'Nothing found in Trash', 'prh-wp-theme' ), /* This displays if there is nothing in the trash */
				'parent_item_colon' => '',
			), /* end of arrays */
			'description' => __( 'Events', 'prh-wp-theme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_icon'   => 'dashicons-admin-page', /* the icon for the custom post type menu */
			'rewrite' => array( 'slug' => 'events', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'events', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'sticky', 'thumbnail', 'excerpt', 'revisions' ),
		) /* end of options */
	); /* end of register post type */
	/* this adds your post categories to your custom post type */
	register_taxonomy_for_object_type( 'category', 'prh_events' );
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type( 'post_tag', 'prh_events' );
}
add_action( 'init', 'event_type' );


/**
 * Saff
 */
function staff_type() {
	// creating (registering) the custom type
	register_post_type( 'prh_staff', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array(
			'labels' => array(
				'name' => __( 'Staff', 'prh-wp-theme' ), /* This is the Title of the Group */
				'singular_name' => __( 'Staff', 'prh-wp-theme' ), /* This is the individual type */
				'all_items' => __( 'All Staff', 'prh-wp-theme' ), /* the all items menu item */
				'add_new' => __( 'Add New', 'prh-wp-theme' ), /* The add new menu item */
				'add_new_item' => __( 'Add New Staff', 'prh-wp-theme' ), /* Add New Display Title */
				'edit' => __( 'Edit', 'prh-wp-theme' ), /* Edit Dialog */
				'edit_item' => __( 'Edit Staff', 'prh-wp-theme' ), /* Edit Display Title */
				'new_item' => __( 'New Staff', 'prh-wp-theme' ), /* New Display Title */
				'view_item' => __( 'View Staff', 'prh-wp-theme' ), /* View Display Title */
				'search_items' => __( 'Search Staff', 'prh-wp-theme' ), /* Search Custom Type Title */
				'not_found' => __( 'Nothing found in the Database.', 'prh-wp-theme' ), /* This displays if there are no entries yet */
				'not_found_in_trash' => __( 'Nothing found in Trash', 'prh-wp-theme' ), /* This displays if there is nothing in the trash */
				'parent_item_colon' => '',
			), /* end of arrays */
			'description' => __( 'Staff', 'prh-wp-theme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_icon'   => 'dashicons-admin-page', /* the icon for the custom post type menu */
			'rewrite' => array( 'slug' => 'staff', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'staff', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'sticky', 'thumbnail', 'excerpt', 'revisions' ),
		) /* end of options */
	); /* end of register post type */
	/* this adds your post categories to your custom post type */
	register_taxonomy_for_object_type( 'category', 'prh_staff' );
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type( 'post_tag', 'prh_staff' );
}
add_action( 'init', 'staff_type' );

add_action('pre_get_posts', 'query_post_type');
function query_post_type($query) {
	if( $query->is_main_query() && is_tag() ) {
		$query->set( 'post_type', array(
			'post',
			'page',
			'press_release',
			'phys_story',
			'prh_ipaper',
			'prh_update',
			'prh_report',
			'prh_news',
			'prh_events',
			'prh_staff'
		) );
  }
}

function get_latest_articles( $count = 3) {

	$args = array(
		'post_status' => array( 'publish' ),
		'orderby' => 'date',
		'order'   => 'DESC',
		'posts_per_page' => $count,
		'post_type' => CONTENT_TYPES_FOR_AGGREGATION
	);
	return new WP_Query( $args );
}