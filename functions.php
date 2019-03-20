<?php
/**
 * Custom functions 
 * @package prh-wp-theme
 */
add_filter('use_block_editor_for_post', '__return_false');

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

function prh_styles() {
	wp_enqueue_style( 'prh-wp-theme-style', get_template_directory_uri() . '/css/main.css' );
	wp_enqueue_style( 'prh-wp-theme-fonts', 'https://fonts.googleapis.com/css?family=Lora:400,400i|Roboto+Condensed:700|Roboto:400,400i,700|Roboto+Slab:400,700' );
}

function prh_scripts() {
//	wp_deregister_script( 'jquery' );
	wp_deregister_script( 'wp-embed' );

	wp_enqueue_script('mainjs', get_template_directory_uri() . '/js/bundle.js', array(), null, true );
	wp_enqueue_script('vendor', get_template_directory_uri() . '/js/vendor.js', array(), null, true );
}


add_action( 'wp_enqueue_scripts', 'prh_styles' );
add_action( 'wp_enqueue_scripts', 'prh_scripts' );

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
require get_template_directory() . '/inc/dashboard.php';
require get_template_directory() . '/inc/members.php';

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

/**
 * Helper function that determines the target attribute of an anchor tag based
 * on the href.
 * @param $url
 * @return string
 */
function get_url_target( $url ) {
	if ( substr( $url , 0, 7 ) === "mailto:" ) {
		return '_self';
	}
	// Parse home URL and parameter URL
	$link_url = parse_url( $url );
	$home_url = parse_url( "http://" . $_SERVER['HTTP_HOST'] );

	// Decide on target
	if( $link_url['host'] == $home_url['host'] ) {
		// Is an internal link
		$target = '_self';
	} else {
		// Is an external link
		$target = '_blank';
	}
	return $target;
}

function prh_login_form() {
	echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/css/login.css" />';
}
add_action( 'login_head', 'prh_login_form' );

function prh_custom_loginlogo_url( $url ) {
	return esc_url( home_url( '/' ) );
}
add_filter( 'login_headerurl', 'prh_custom_loginlogo_url' );

function sanitize_module_title( $module_title) {
	if ( preg_match('/^\d/', $module_title) === 1 ) {
		$module_title = 'prh-' . $module_title;
	}
	return sanitize_title($module_title);
}

add_action( 'before_delete_post', 'delete_story_attachments' );
function delete_story_attachments( $post_id ){

    // We check if the global post type isn't ours and just return
    global $post_type;   
    if ( $post_type != 'phys_story' ) return;

	global $wpdb;

    $args = array(
        'post_type'         => 'attachment',
        'post_status'       => 'any',
        'posts_per_page'    => -1,
        'post_parent'       => $post_id
    );
    $attachments = new WP_Query($args);
    $attachment_ids = array();
    if($attachments->have_posts()) : while($attachments->have_posts()) : $attachments->the_post();
            $attachment_ids[] = get_the_id();
        endwhile;
    endif;
    wp_reset_postdata();

    if(!empty($attachment_ids)) :
		$delete_attachments_query = $wpdb->prepare('DELETE FROM %1$s WHERE %1$s.ID IN (%2$s)', array($wpdb->posts, join(',', $attachment_ids)));
        $wpdb->query($delete_attachments_query);
    endif;

}

/********************************************************** 
 * the ajax functions for searching stories on the VOC page.
***********************************************************/
function slugify($text) {
	// replace non letter or digits by -
	$text = preg_replace('~[^\pL\d]+~u', '-', $text);
	// transliterate
	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
	// remove unwanted characters
	$text = preg_replace('~[^-\w]+~', '', $text);
	// trim
	$text = trim($text, '-');
	// remove duplicate -
	$text = preg_replace('~-+~', '-', $text);
	// lowercase
	$text = strtolower($text);
	if (empty($text)) {
		return 'n-a';
	}
	return $text;
}

function search_and_render_stories($args) {
	$per_page = 9;
	if ( isset( $_POST['per_page']) ) {
		$per_page = intval( $_POST['per_page'] );
	}

	if ( isset( $args['per_page']) ) {
		$per_page = intval( $args['per_page'] );
	}

	$query_args = array_merge($args, array (
		'post_status'    => array( 'publish' ),
		'orderby'        => 'date',
		'order'          => 'DESC',
		'post_type'      => 'phys_story',
		'posts_per_page' => $per_page,
	) );
	
	$paged = 1;
	if ( isset( $_POST['paged']) ) {
		$paged = intval( $_POST['paged'] );
		$query_args['paged'] = $paged;
	}

	$the_query = new WP_Query( $query_args );
	$counter = 0;
	if( $the_query->have_posts() ) :
		while( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<?php 
			$voc_img = get_the_post_thumbnail_url();
			if ($voc_img == '' ) {
				$voc_img = 'https://prh.org/wp-content/uploads/2017/03/Story-Fist-Avatar-e1497389449725.png';
			}
			$data_paged = $paged + floor($counter / 3);
		?>
		<a class="aggregate-tile col-xs-12 col-md-4 voc"
			href="<?php echo get_permalink(); ?>"
			aria-label="<?php the_title(); ?>"
			data-paged="<?php echo $data_paged ?>"> 
			<div class="tile__container voc">
				<div class="tile__image-container"><img alt="" src="<?php echo $voc_img ?>"/></div>
				<div class="tile__voc-hover">
					<h4 class="tile__title voc">
					<?php
						$title = get_the_title();
						$parts = explode( ':', $title);
						if (count($parts) == 2 ) : ?>
							<span class="tile__story-num"><? echo $parts[0] ?>:</span><br>
							<span class="tile__story-title"><? echo $parts[1] ?></span>
						<? endif; ?>
					</h4>
				</div>
			</div>
		</a>
		<?php $counter = $counter + 1; endwhile;
		wp_reset_postdata();
	endif;
}

// search stories by term.
add_action('wp_ajax_search_stories_by_term' , 'search_stories_by_term');
add_action('wp_ajax_nopriv_search_stories_by_term','search_stories_by_term');
function search_stories_by_term() {
	$args = array(
		's' => esc_attr( $_POST['keyword'] )
	);
	search_and_render_stories( $args );
	die();
}

// search stories by category.
add_action('wp_ajax_search_stories_by_category' , 'search_stories_by_category');
add_action('wp_ajax_nopriv_search_stories_by_category','search_stories_by_category');
function search_stories_by_category() {
	$args = array(
		'category_name' => $_POST['category']
	);
	search_and_render_stories( $args );
	die();
}

// search stories by tag.
add_action('wp_ajax_search_stories_by_tag' , 'search_stories_by_tag');
add_action('wp_ajax_nopriv_search_stories_by_tag','search_stories_by_tag');
function search_stories_by_tag() {
	$args = array(
		'tag' => slugify($_POST['tag'])
	);
	search_and_render_stories( $args );
	die();
}

// search stories by tag and term
add_action('wp_ajax_search_stories_by_tag_and_term' , 'search_stories_by_tag_and_term');
add_action('wp_ajax_nopriv_search_stories_by_tag_and_term','search_stories_by_tag_and_term');
function search_stories_by_tag_and_term() {
	$args = array(
		'tag' => $_POST['tag'],
		's' => esc_attr( $_POST['keyword'] )
	);
	search_and_render_stories( $args );
	die();
}
