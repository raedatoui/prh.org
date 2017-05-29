<?php
/**
 * Custom functions 
 * @package prh-wp-theme
 */

if ( !function_exists('prh_wp_theme_setup') ):
	/**
	* Sets up theme defaults and registers support for various WordPress features.
	*/
	function prh_wp_theme_setup() {
		/*
		 * Make theme available for translation.
		*/
		load_theme_textdomain('prh-wp-theme', get_template_directory() . '/languages' );
		add_theme_support('automatic-feed-links' );
		add_theme_support('title-tag' );
		add_theme_support('post-thumbnails' );

		register_nav_menus(array(
			'menu-1' => esc_html__('Header', 'prh-wp-theme' ),
			'footer-menu' => esc_html__('Footer: Sitemap', 'prh-wp-theme'),
			'footer-social' => esc_html__('Footer: Social', 'prh-wp-theme')
		));

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));

		add_theme_support( 'customize-selective-refresh-widgets' );

		//http://cubiq.org/clean-up-and-optimize-wordpress-for-your-next-theme
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'wp_generator' );
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wp_shortlink_wp_head' );
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10);
		add_filter('the_generator', '__return_false' );
		remove_action('wp_head', 'print_emoji_detection_script', 7);
		remove_action('wp_print_styles', 'print_emoji_styles' );
		add_filter('emoji_svg_url', '__return_false' );
		remove_action('wp_head', 'rest_output_link_wp_head' );
		remove_action('wp_head', 'wp_oembed_add_discovery_links' );
		add_filter( 'user_can_richedit', '__return_true' );
	}

endif;
add_action( 'after_setup_theme', 'prh_wp_theme_setup' );

/**
 * Register widget area.
 */
function prh_wp_theme_widgets_init() {
	register_sidebar(array(
		'name' => esc_html__( 'Sidebar', 'prh-wp-theme' ),
		'id' => 'sidebar-1',
		'description' => esc_html__('Add widgets here.', 'prh-wp-theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
}
add_action( 'widgets_init', 'prh_wp_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function prh_wp_theme_scripts() {
	wp_enqueue_style( 'prh-wp-theme-style', get_template_directory_uri() . '/css/main.css' );
	wp_enqueue_style( 'prh-wp-theme-fonts', 'https://fonts.googleapis.com/css?family=Lora:400,400i|Roboto+Condensed:700|Roboto:400,400i,700,700i' );

	// TODO: check if this is needed
	wp_enqueue_script('prh-wp-theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);

	wp_deregister_script( 'jquery' );
	wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_enqueue_scripts', 'prh_wp_theme_scripts' );

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
require get_template_directory() . '/inc/admin-menu.php';
require get_template_directory() . '/inc/widgets.php';

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
 * Helper for checking whether an excerpt is a "real" one
 * or an auto-generated one. For things using the article template - 
 * they're supposed to fill out the excerpt field,
 * but if they don't, we shouldn't output the automatic one. 
 * If we change the [...] used in auto-excerpts, this needs to be updated.
 */
function is_generated( $excerpt ) {
	return( substr( $excerpt, -1 ) == ']' );
}

/**
 * Helper function to prevent outputting empty elements
 * for fields that haven't been filled in.
 * $before and $after = html to surround the var, if set
 */
function echo_wrapped( $var, $before='', $after='' ) {
	if ( $var == null || $var == '' ) {
		return;
	}
	echo $before . $var . $after;
}


/**
 * Returning an authentication error if a user who is not logged in tries to query the REST API
 * @param $access
 * @return WP_Error
 */
function prh_only_allow_logged_in_rest_access( $access ) {

	if( !current_user_can('administrator') ) {
		return new WP_Error( 'rest_cannot_access', __( 'No access.', 'disable-json-api' ), array( 'status' => rest_authorization_required_code() ) );
	}
	return $access;
}
add_filter( 'rest_authentication_errors', 'prh_only_allow_logged_in_rest_access' );

// Add specific CSS class by filter
function prh_extra_body_class( $classes ) {
	if ( is_archive() && get_post_type() == 'prh_events') {
		$classes[] = 'page page-template';
	}
	return $classes;
}
add_filter( 'body_class', 'prh_extra_body_class' );

// Send new users to a special page
function redirectOnFirstLogin( $redirect_to, $requested_redirect_to, $user )
{
    // URL to redirect to
    $redirect_url = 'http://154.0d0.mwp.accessdomain.com/privacy-policy/';
    // How many times to redirect the user
    $num_redirects = 1;
    // Cookie-based solution: captures users who registered within the last n hours
    // The reason to set it as "last n hours" is so that if a user clears their cookies or logs in with a different browser,
    // they don't get this same redirect treatment long after they're already a registered user
    // 172800 seconds = 48 hours
    $message_period = 172800;

    // If they're on the login page, don't do anything
    if( !isset( $user->user_login ) )
    {
        return $redirect_to;
    }

	$is_a_member = false;
	require_once( ABSPATH . 'wp-includes/pluggable.php' );
	if ( $group = Groups_Group::read_by_name( 'LTA' ) ) {
		$is_a_member = Groups_User_Group::read( get_current_user_id() , $group->group_id );
	}
	print_r( $is_a_member);
	if ( ! $is_a_member ) {
		return 'http://154.0d0.mwp.accessdomain.com/';
	} else {
		return 'http://154.0d0.mwp.accessdomain.com/lta-landing-page/';
	}
//    $key_name = 'redirect_on_first_login_' . $user->ID;
//
//    if( strtotime( $user->user_registered ) > ( time() - $message_period )
//        && ( !isset( $_COOKIE[$key_name] ) || intval( $_COOKIE[$key_name] ) < $num_redirects )
//      )
//    {
//        if( isset( $_COOKIE[$key_name] ) )
//        {
//            $num_redirects = intval( $_COOKIE[$key_name] ) + 1;
//        }
//        setcookie( $key_name, $num_redirects, time() + $message_period, COOKIEPATH, COOKIE_DOMAIN );
//        return $redirect_url;
//    }
//    else
//    {
//        return $redirect_to;
//    }
}

add_filter( 'login_redirect', 'redirectOnFirstLogin', 10, 3 );

function login_action($login) {

//	print_r(json_encode($user));
}
add_action( 'wp_login', 'login_action' );
