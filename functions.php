<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package prh-wp-theme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function prh_wp_theme_body_classes( $classes ) {
  // Adds a class of group-blog to blogs with more than 1 published author.
  if ( is_multi_author() ) {
    $classes[] = 'group-blog';
  }

  // Adds a class of hfeed to non-singular pages.
  if ( ! is_singular() ) {
    $classes[] = 'hfeed';
  }

  return $classes;
}
add_filter( 'body_class', 'prh_wp_theme_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function prh_wp_theme_pingback_header() {
  if ( is_singular() && pings_open() ) {
    echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
  }
}
add_action( 'wp_head', 'prh_wp_theme_pingback_header' );


add_action('init', 'home_page_features');
function home_page_features()
{
  $labels = array(
    'name' => _x('Home Features', 'post type general name', 'prh-wp-theme', 'prh-wp-theme'),
    'singular_name' => _x('Feature', 'post type singular name', 'prh-wp-theme'),
    'add_new' => _x('Add New', 'Feature', 'prh-wp-theme'),
    'add_new_item' => __('Add New Feature', 'prh-wp-theme'),
    'edit_item' => __('Edit Feature', 'prh-wp-theme'),
    'new_item' => __('New Feature', 'prh-wp-theme'),
    'view_item' => __('View Feature', 'prh-wp-theme'),
    'search_items' => __('Search Features', 'prh-wp-theme'),
    'not_found' =>  __('No slides found', 'woothemes'),
    'not_found_in_trash' => __('No features found in Trash', 'prh-wp-theme'),
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_icon' => get_template_directory_uri() .'/ico/feature.png',
    'menu_position' => null,
    'supports' => array('title')
  );
  register_post_type('hp_features',$args);
}

/************* Custom Post Type - Press Release *****************/

function press_release_type() {
  // creating (registering) the custom type
  register_post_type( 'press_release', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
    // let's now add all the options for this post type
    array(
    'labels' => array(
      'name' => __('Press Releases', 'prh-wp-theme'), /* This is the Title of the Group */
      'singular_name' => __('Press Release', 'prh-wp-theme'), /* This is the individual type */
      'all_items' => __('All Press Releases', 'prh-wp-theme'), /* the all items menu item */
      'add_new' => __('Add New', 'prh-wp-theme'), /* The add new menu item */
      'add_new_item' => __('Add New Press Release', 'prh-wp-theme'), /* Add New Display Title */
      'edit' => __( 'Edit', 'prh-wp-theme' ), /* Edit Dialog */
      'edit_item' => __('Edit Press Releases', 'prh-wp-theme'), /* Edit Display Title */
      'new_item' => __('New Press Release', 'prh-wp-theme'), /* New Display Title */
      'view_item' => __('View Press Release', 'prh-wp-theme'), /* View Display Title */
      'search_items' => __('Search Press Release', 'prh-wp-theme'), /* Search Custom Type Title */
      'not_found' =>  __('Nothing found in the Database.', 'prh-wp-theme'), /* This displays if there are no entries yet */
      'not_found_in_trash' => __('Nothing found in Trash', 'prh-wp-theme'), /* This displays if there is nothing in the trash */
      'parent_item_colon' => ''
      ), /* end of arrays */
      'description' => __( 'Press releases', 'prh-wp-theme' ), /* Custom Type Description */
      'public' => true,
      'publicly_queryable' => true,
      'exclude_from_search' => false,
      'show_ui' => true,
      'query_var' => true,
      'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
      'menu_icon' => get_stylesheet_directory_uri() . '/ico/custom-post-icon.png', /* the icon for the custom post type menu */
      'rewrite' => array( 'slug' => 'press-release', 'with_front' => false ), /* you can specify its url slug */
      'has_archive' => 'press-release', /* you can rename the slug here */
      'capability_type' => 'post',
      'hierarchical' => false,
      /* the next one is important, it tells what's enabled in the post editor */
      'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
    ) /* end of options */
  ); /* end of register post type */

  /* this adds your post categories to your custom post type */
  register_taxonomy_for_object_type('category', 'press_release');
  /* this adds your post tags to your custom post type */
  register_taxonomy_for_object_type('post_tag', 'press_release');


}

// adding the function to the Wordpress init
add_action( 'init', 'press_release_type');

/************* Custom Post Type - phys_story *****************/

function phys_story_type() {
  // creating (registering) the custom type
  register_post_type( 'phys_story', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
    // let's now add all the options for this post type
    array(
    'labels' => array(
      'name' => __('Physician Stories', 'prh-wp-theme'), /* This is the Title of the Group */
      'singular_name' => __('Physician Story', 'prh-wp-theme'), /* This is the individual type */
      'all_items' => __('All Physician Stories', 'prh-wp-theme'), /* the all items menu item */
      'add_new' => __('Add New', 'prh-wp-theme'), /* The add new menu item */
      'add_new_item' => __('Add New Physician Stories', 'prh-wp-theme'), /* Add New Display Title */
      'edit' => __( 'Edit', 'prh-wp-theme' ), /* Edit Dialog */
      'edit_item' => __('Edit Physician Stories', 'prh-wp-theme'), /* Edit Display Title */
      'new_item' => __('New Physician Story', 'prh-wp-theme'), /* New Display Title */
      'view_item' => __('View Physician Story', 'prh-wp-theme'), /* View Display Title */
      'search_items' => __('Search Physician Stories', 'prh-wp-theme'), /* Search Custom Type Title */
      'not_found' =>  __('Nothing found in the Database.', 'prh-wp-theme'), /* This displays if there are no entries yet */
      'not_found_in_trash' => __('Nothing found in Trash', 'prh-wp-theme'), /* This displays if there is nothing in the trash */
      'parent_item_colon' => ''
      ), /* end of arrays */
      'description' => __( 'Physician Stories', 'prh-wp-theme' ), /* Custom Type Description */
      'public' => true,
      'publicly_queryable' => true,
      'exclude_from_search' => false,
      'show_ui' => true,
      'query_var' => true,
      'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
      'menu_icon' => get_template_directory_uri() .'/ico/phy_story_icon.png', /* the icon for the custom post type menu */
      'rewrite' => array( 'slug' => 'physicians-story', 'with_front' => false ), /* you can specify its url slug */
      'has_archive' => 'physicians-story', /* you can rename the slug here */
      'capability_type' => 'post',
      'hierarchical' => false,
      /* the next one is important, it tells what's enabled in the post editor */
      'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
    ) /* end of options */
  ); /* end of register post type */
    /* this adds your post categories to your custom post type */
  register_taxonomy_for_object_type('category', 'phys_story');
  /* this adds your post tags to your custom post type */
  register_taxonomy_for_object_type('post_tag', 'phys_story');

}

// adding the function to the Wordpress init
add_action( 'init', 'phys_story_type');

/************* Custom Post Type - prh_ipaper *****************/

function prh_ipaper_type() {
  // creating (registering) the custom type
  register_post_type( 'prh_ipaper', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
    // let's now add all the options for this post type
    array(
    'labels' => array(
      'name' => __('iPaper', 'prh-wp-theme'), /* This is the Title of the Group */
      'singular_name' => __('iPaper', 'prh-wp-theme'), /* This is the individual type */
      'all_items' => __('All iPapers', 'prh-wp-theme'), /* the all items menu item */
      'add_new' => __('Add New', 'prh-wp-theme'), /* The add new menu item */
      'add_new_item' => __('Add New iPaper', 'prh-wp-theme'), /* Add New Display Title */
      'edit' => __( 'Edit', 'prh-wp-theme' ), /* Edit Dialog */
      'edit_item' => __('Edit iPapers', 'prh-wp-theme'), /* Edit Display Title */
      'new_item' => __('New iPaper', 'prh-wp-theme'), /* New Display Title */
      'view_item' => __('View iPaper', 'prh-wp-theme'), /* View Display Title */
      'search_items' => __('Search iPapers', 'prh-wp-theme'), /* Search Custom Type Title */
      'not_found' =>  __('Nothing found in the Database.', 'prh-wp-theme'), /* This displays if there are no entries yet */
      'not_found_in_trash' => __('Nothing found in Trash', 'prh-wp-theme'), /* This displays if there is nothing in the trash */
      'parent_item_colon' => ''
      ), /* end of arrays */
      'description' => __( 'iPaper', 'prh-wp-theme' ), /* Custom Type Description */
      'public' => true,
      'publicly_queryable' => true,
      'exclude_from_search' => false,
      'show_ui' => true,
      'query_var' => true,
      'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
      'menu_icon' => get_template_directory_uri() .'/ico/scribd_documents_icon.png', /* the icon for the custom post type menu */
      'rewrite' => array( 'slug' => 'iPaper', 'with_front' => false ), /* you can specify its url slug */
      'has_archive' => 'iPaper', /* you can rename the slug here */
      'capability_type' => 'post',
      'hierarchical' => false,
      /* the next one is important, it tells what's enabled in the post editor */
      'supports' => array( 'title', 'editor', 'author', 'sticky')
    ) /* end of options */
  ); /* end of register post type */
    /* this adds your post categories to your custom post type */
  register_taxonomy_for_object_type('category', 'prh_ipaper');
  /* this adds your post tags to your custom post type */
  register_taxonomy_for_object_type('post_tag', 'prh_ipaper');

}

// adding the function to the Wordpress init
add_action( 'init', 'prh_ipaper_type');

/************* Custom Post Type - timeline *****************/

function timeline_type() {

  register_post_type( 'timeline',

    array(
    'labels' => array(
      'name' => __('Timeline Items', 'prh-wp-theme'), /* This is the Title of the Group */
      'singular_name' => __('Timeline Item', 'prh-wp-theme'), /* This is the individual type */
      'all_items' => __('All Timeline Items', 'prh-wp-theme'), /* the all items menu item */
      'add_new' => __('Add New', 'prh-wp-theme'), /* The add new menu item */
      'add_new_item' => __('Add New Timeline Item', 'prh-wp-theme'), /* Add New Display Title */
      'edit' => __( 'Edit', 'prh-wp-theme' ), /* Edit Dialog */
      'edit_item' => __('Edit Timeline Items', 'prh-wp-theme'), /* Edit Display Title */
      'new_item' => __('New Timeline Item', 'prh-wp-theme'), /* New Display Title */
      'view_item' => __('View Timeline Item', 'prh-wp-theme'), /* View Display Title */
      'search_items' => __('Search Timeline Item', 'prh-wp-theme'), /* Search Custom Type Title */
      'not_found' =>  __('Nothing found in the Database.', 'prh-wp-theme'), /* This displays if there are no entries yet */
      'not_found_in_trash' => __('Nothing found in Trash', 'prh-wp-theme'), /* This displays if there is nothing in the trash */
      'parent_item_colon' => ''
      ), /* end of arrays */
      'description' => __( 'Timeline Items', 'prh-wp-theme' ), /* Custom Type Description */
      'public' => true,
      'publicly_queryable' => true,
      'exclude_from_search' => false,
      'show_ui' => true,
      'query_var' => true,
      'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
      'menu_icon' => get_template_directory_uri() .'/ico/timeline.png', /* the icon for the custom post type menu */
      'rewrite' => array( 'slug' => 'timeline-items', 'with_front' => false ), /* you can specify its url slug */
      'has_archive' => 'timeline-items', /* you can rename the slug here */
      'capability_type' => 'post',
      'hierarchical' => false,
      /* the next one is important, it tells what's enabled in the post editor */
      'supports' => array( 'title', 'editor', 'revisions', 'sticky')
    ) /* end of options */
  ); /* end of register post type */
    /* this adds your post categories to your custom post type */
  register_taxonomy_for_object_type('category', 'timeline');
  /* this adds your post tags to your custom post type */
  register_taxonomy_for_object_type('post_tag', 'timeline');

}

// adding the function to the Wordpress init
add_action( 'init', 'timeline_type');