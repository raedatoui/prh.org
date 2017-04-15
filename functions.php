<?php
/**
 * Custom functions 
 * @package prh-wp-theme
 */

	/**
	* Sets up theme defaults and registers support for various WordPress features.
	*/

if ( !function_exists('prh_wp_theme_setup') ):
	function prh_wp_theme_setup() {
		/*
		 * Make theme available for translation.
		*/
		load_theme_textdomain('prh-wp-theme', get_template_directory() . '/languages');
		add_theme_support('automatic-feed-links');
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');

		register_nav_menus(array(
			'menu-1' => esc_html__('Primary', 'prh-wp-theme'),
		));

		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));

		add_theme_support('customize-selective-refresh-widgets');

		//http://cubiq.org/clean-up-and-optimize-wordpress-for-your-next-theme
		remove_action('wp_head', 'wlwmanifest_link');
		remove_action('wp_head', 'wp_generator');
		remove_action('wp_head', 'rsd_link');
		remove_action('wp_head', 'wp_shortlink_wp_head');
		remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
		add_filter('the_generator', '__return_false');
		remove_action('wp_head', 'print_emoji_detection_script', 7);
		remove_action('wp_print_styles', 'print_emoji_styles');
		add_filter('emoji_svg_url', '__return_false');
		remove_action('wp_head', 'rest_output_link_wp_head');
		remove_action('wp_head', 'wp_oembed_add_discovery_links');
		add_filter('user_can_richedit', '__return_true');
	}

endif;
add_action('after_setup_theme', 'prh_wp_theme_setup');

/**
 * Register widget area.
 */
function prh_wp_theme_widgets_init() {
	register_sidebar(array(
		'name' => esc_html__('Sidebar', 'prh-wp-theme'),
		'id' => 'sidebar-1',
		'description' => esc_html__('Add widgets here.', 'prh-wp-theme'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
}
add_action('widgets_init', 'prh_wp_theme_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function prh_wp_theme_scripts() {
	wp_enqueue_style( 'prh-wp-theme-style', get_template_directory_uri() . '/css/main.css' );
	wp_enqueue_style( 'prh-wp-theme-fonts', 'https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i|Roboto+Condensed:700|Roboto:300,400,400i,700,700i');

	// TODO: check if this is needed
	wp_enqueue_script('prh-wp-theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);

	wp_deregister_script('jquery');
	wp_deregister_script('wp-embed');
}
add_action('wp_enqueue_scripts', 'prh_wp_theme_scripts');

/**
 * Custom functions & features from the theme.
 */

require get_template_directory() . '/inc/constants.php';
require get_template_directory() . '/inc/page-modules.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/custom-types.php';
require get_template_directory() . '/inc/editor.php';
require get_template_directory() . '/inc/acf.php';
require get_template_directory() . '/inc/metaboxes.php';


/**
 * Misc settings, excerpt rules
 */
function custom_excerpt_length( $length ) {
	return 25; // how many words in the except?
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function echo_theme_uri() {
	echo esc_url( get_template_directory_uri() );
}

/**
 * Helper function to prevent outputting empty elements
 * for fields that haven't been filled in.
 * $before and $after = html to surround the var, if set
 */

function echo_wrapped( $var, $before='', $after='' ) {
	if ($var == null || $var == '') {
		return;
	}
	echo $before . $var . $after;
}
