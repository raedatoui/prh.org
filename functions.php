<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package prh-wp-theme
 */




if ( ! function_exists( 'prh_wp_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function prh_wp_theme_setup() {
  /*
   * Make theme available for translation.
   * Translations can be filed in the /languages/ directory.
   * If you're building a theme based on prh-wp-theme, use a find and replace
   * to change 'prh-wp-theme' to the name of your theme in all the template files.
   */
  load_theme_textdomain( 'prh-wp-theme', get_template_directory() . '/languages' );

  // Add default posts and comments RSS feed links to head.
  add_theme_support( 'automatic-feed-links' );

  /*
   * Let WordPress manage the document title.
   * By adding theme support, we declare that this theme does not use a
   * hard-coded <title> tag in the document head, and expect WordPress to
   * provide it for us.
   */
  add_theme_support( 'title-tag' );

  /*
   * Enable support for Post Thumbnails on posts and pages.
   *
   * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
   */
  add_theme_support( 'post-thumbnails' );

  // This theme uses wp_nav_menu() in one location.
  register_nav_menus( array(
    'menu-1' => esc_html__( 'Primary', 'prh-wp-theme' ),
  ) );

  /*
   * Switch default core markup for search form, comment form, and comments
   * to output valid HTML5.
   */
  add_theme_support( 'html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
  ) );

  // Set up the WordPress core custom background feature.
  add_theme_support( 'custom-background', apply_filters( 'prh_wp_theme_custom_background_args', array(
    'default-color' => 'ffffff',
    'default-image' => '',
  ) ) );

  // Add theme support for selective refresh for widgets.
  add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'prh_wp_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function prh_wp_theme_content_width() {
  $GLOBALS['content_width'] = apply_filters( 'prh_wp_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'prh_wp_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function prh_wp_theme_widgets_init() {
  register_sidebar( array(
    'name'          => esc_html__( 'Sidebar', 'prh-wp-theme' ),
    'id'            => 'sidebar-1',
    'description'   => esc_html__( 'Add widgets here.', 'prh-wp-theme' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );
}
add_action( 'widgets_init', 'prh_wp_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function prh_wp_theme_scripts() {
  wp_enqueue_style( 'prh-wp-theme-style', get_stylesheet_uri() );

  wp_enqueue_script( 'prh-wp-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

  wp_enqueue_script( 'prh-wp-theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
add_action( 'wp_enqueue_scripts', 'prh_wp_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';





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
