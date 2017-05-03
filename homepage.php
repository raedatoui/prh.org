<?php
/**
 * Template Name: Homepage
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package prh-wp-theme
 */

get_header();?>

<?php
	while (have_posts()): the_post();
		$page = new PageModules( get_the_ID() );
		$page->init();
		$page->render();

	endwhile; // End of the loop. ?>

<?php
get_footer();
