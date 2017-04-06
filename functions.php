<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package prh-wp-theme
 */


/************* Modules & Components *****************/
const COMPONENTS_TO_UNSET = array(
	'CTA',
	'Module Options',
	'Statistic',

);

const MODULE_OPTIONS = array(
	'enabled' => 'module_enabled',
	'order' => 'module_order',
	'title' => 'module_title',
	'use_cta' => 'module_use_cta',
	'cta' => 'module_cta'
);

const CTA_COMPONENT = array (
	'label' => 'cta_label',
	'link'=> 'cta_link'
);

const CAROUSEL_MODULE = array(
	'name' => 'Carousel',
	'options' => 'carousel_options',
	'images' => 'carousel_images',
	'image' => 'carousel_image',
	'link' => 'carousel_link',
	'template' => 'template-parts/modules/carousel.php'
);

const HERO_MODULE = array(
	'name' => 'Hero',
	'options' => 'hero_options',
	'header' => 'hero_header',
	'text' => 'hero_text',
	'template' => 'template-parts/modules/hero.php'
);

const STATISTICS_MODULE = array(
	'name' => 'Statistics',
	'options' => 'statistics_options',
	'figures' => 'statistics_figures',
	'figure' => 'statistic_figure',
	'number' => 'stat_number',
	'text' => 'stat_text',
	'cta' => 'statistics_cta',
	'template' => 'template-parts/modules/statistics.php'
);

const AGGREGATE_BY_POST_TYPE = array(
	'name' => 'Aggregate by Post Type',
	'options' => 'aggregate_by_post_type_options',
	'post_type' => 'aggregate_by_post_type',
	'template' => 'template-parts/modules/aggregate.php'
);

const MODULES = array(
	'Carousel' => CAROUSEL_MODULE,
	'Hero' => HERO_MODULE,
	'Statistics' => STATISTICS_MODULE,
	'Aggregate by Post Type' => AGGREGATE_BY_POST_TYPE
);

const CUSTOM_POST_TYPES = array (
	'press_release' => 'Press Release'
);

/**
 * Class PageModules
 * This class consumes the Custom Fields data for a given page and renders
 * the respective templates
 */
class PageModules {
	public $modules;
	public $keys;

	function __construct( $modules ) {
		$this->modules = $modules;
		$this->prepare();
		$this->configure();
		$this->filter();
		$this->sort();
		$this->keys = array_keys($this->modules);
	}

	function prepare() {
		foreach( COMPONENTS_TO_UNSET as $c ) {
			unset( $this->modules[$c] );
		}
	}

	function filter() {
		$filter = function ( $module ) {
			return $module['config'][MODULE_OPTIONS['enabled']] == 1;
		};
		$this->modules = array_filter( $this->modules, $filter );
	}

	function configure() {
		$func = function ( $module ) {
			if ( ! in_array( $module['module_name'], array_keys( MODULES ) ) ) {
				throw new Exception('Module ' . $module['module_name'] . ' not found');
			}
			$config = MODULES[$module['module_name']];
			if (! in_array( 'options', array_keys( $config ) ) ) {
				throw new Exception('Module found but not properly configured');
			}
			// unroll module options into $config object
			$options = $module[$config['options']][0];
			$config = array_merge( $config, $options );
			// remove module_options field from module
			unset( $module[$config['options']] );
			unset( $module['module_name'] );
			// remove old options key from const
			unset( $config ['options'] );
			$module['config'] = $config;
			return $module;
		};
		$this->modules = array_map( $func, $this->modules );
	}

	function sort() {
		$cmp = function ($a, $b) {
			$x = $a['config'][MODULE_OPTIONS['order']];
			$y = $b['config'][MODULE_OPTIONS['order']];
			if ($x == $y) {
				return 0;
			}
			return ($x < $y) ? -1 : 1;
		};
		uasort( $this->modules, $cmp );
	}

	function render() {
		foreach ($this->modules as $module) {
			$mn = $module['config']['name'];
			$template = MODULES[$mn]['template'];
			include( locate_template( $template, false, false ) );
		}
	}
}


function echo_theme_uri() {
	echo esc_url( get_template_directory_uri() );
}
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

if ( !function_exists('prh_wp_theme_setup') ):
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
	load_theme_textdomain('prh-wp-theme', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	*/
	add_theme_support('title-tag');

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(array(
		'menu-1' => esc_html__('Primary', 'prh-wp-theme'),
	));

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	*/
	add_theme_support('html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	));

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	//http://cubiq.org/clean-up-and-optimize-wordpress-for-your-next-theme
	remove_action('wp_head', 'wlwmanifest_link');

	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wp_shortlink_wp_head');

	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);

	add_filter('the_generator', '__return_false');
	//add_filter('show_admin_bar','__return_false');

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
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function prh_wp_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters('prh_wp_theme_content_width', 640);
}
add_action('after_setup_theme', 'prh_wp_theme_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
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
	// TODO: replace get_stylesheet_uri with path to css/main.min.css
	wp_enqueue_style( 'prh-wp-theme-style', get_template_directory_uri() . '/css/main.css' );
	wp_enqueue_style( 'prh-wp-theme-fonts', 'https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i|Roboto+Condensed:300,300i,400,400i,700,700i|Roboto+Slab:100,300,400,700|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i');

	// TODO: check if this is needed
	wp_enqueue_script('prh-wp-theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);

	wp_deregister_script('jquery');
	wp_deregister_script('wp-embed');
}
add_action('wp_enqueue_scripts', 'prh_wp_theme_scripts');

/**
 * Custom functions & features from the theme.
 */
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/jetpack.php';
require get_template_directory() . '/inc/custom-types.php';
require get_template_directory() . '/inc/editor.php';


/**
 * Function that gets the excerpt from the excerpt field or
 * chops the content to 100
 * @param $post
 * @return string
 */
function get_post_excerpt( $post ) {
	if ( $post->post_excerpt != NULL && $post->post_excerpt != '' ) {
		return get_the_excerpt( $post );
	} else {
		return   substr ( wp_strip_all_tags( $post->post_content ), 0, 100 );
	}
}

function echo_theme_uri() {
	echo esc_url( get_template_directory_uri() );
}

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
