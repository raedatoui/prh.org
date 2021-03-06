<?php
/**
 * Template name: About Us Page
 */

get_header();

$page = new PageModules( get_the_ID(), false );
// determines the header for an about us or issue page
$hero_banner_name = MODULES['Page Hero Banner']['name'];
$hero_banner = $page->modules[$hero_banner_name];
$banner = false;
if ($hero_banner) {
	$hero_banner_image_name = MODULES['Page Hero Banner']['image'];
	$banner = $hero_banner[$hero_banner_image_name]['url'];
}		
$page->init();
$page->hero = array(
	'module_name' => 'Page Hero',
	'config' => PAGE_HERO_MODULE,
	'hero_jump_links' => $page->jump_links(),
	'banner' => $banner
);
$page->render();

get_footer();
