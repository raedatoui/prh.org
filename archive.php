<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package prh-wp-theme
 */

get_header();

$post_type = get_post_type();
if ( $post_type === 'prh_events') {
	get_template_part( 'template-parts/archive', 'events' );
} else {
	get_template_part( 'template-parts/archive', 'main' );
}
get_footer();
