<?php
/**
 * Template Name: Homepage
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package prh-wp-theme
 */

get_header();


while (have_posts()): the_post();
	$page = new PageModules( get_the_ID(), false );
	$page->init();
	$page->render();

endwhile; // End of the loop. 


get_footer();
