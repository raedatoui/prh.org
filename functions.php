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
	'Spotlight card'
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
	'slides' => 'carousel_slides',
	'image' => 'slide_image',
	'eyebrow' => 'slide_eyebrow',
	'title' => 'slide_title',
	'text' => 'slide_text',
	'cta' => 'slide_cta',
	'link' => 'slide_link',
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
	'template' => 'template-parts/modules/statistics.php'
);

const QUOTE_MODULE = array(
	'name' => 'Quote',
	'options' => 'quote_options',
	'quote' => 'quote',
	'attribution_name' => 'quote_attribution_name',
	'attribution_location' => 'quote_attribution_location',
	'text' => 'quote_text',
	'template' => 'template-parts/modules/quote.php'
);

const AGGREGATE_BY_POST_TYPE = array(
	'name' => 'Aggregate by Post Type',
	'options' => 'aggregate_by_post_type_options',
	'post_type' => 'aggregate_by_post_type',
	'template' => 'template-parts/modules/aggregate.php'
);

const SPOTLIGHT_1_MODULE = array(
	'name' => 'Spotlight 1 Module',
	'options' => 'spotlight_1_options',
	'card' => 'spotlight_1_card',
	'template' => 'template-parts/modules/spotlightone.php'
);

const SPOTLIGHT_3_MODULE = array(
	'name' => 'Spotlight 3 Module',
	'options' => 'spotlight_3_options',
	'repeater' => 'spotlight_3_repeater',
	'card' => 'spotlight_3_card',
	'template' => 'template-parts/modules/spotlightthree.php'
);

const SPOTLIGHT_CARD = array(
	'name' => 'Spotlight card',
	'image' => 'spotlight_image',
	'headline' => 'spotlight_headline',
	'text' => 'spotlight_text',
	'cta' => 'spotlight_cta'
);

const MODULES = array(
	'Carousel' => CAROUSEL_MODULE,
	'Hero' => HERO_MODULE,
	'Statistics' => STATISTICS_MODULE,
	'Aggregate by Post Type' => AGGREGATE_BY_POST_TYPE,
	'Quote' => QUOTE_MODULE,
	'Spotlight 1 Module' => SPOTLIGHT_1_MODULE,
	'Spotlight 3 Module' => SPOTLIGHT_3_MODULE
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
		*/
		load_theme_textdomain('prh-wp-theme', get_template_directory() . '/languages');
		add_theme_support('automatic-feed-links');
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
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
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 * @global int $content_width
 */
function prh_wp_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters('prh_wp_theme_content_width', 640);
}
add_action('after_setup_theme', 'prh_wp_theme_content_width', 0);

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
