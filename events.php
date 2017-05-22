<?php
/**
 * Template name: Events Page
 */

get_header(); ?>

<?php
	$page = new PageModules( get_the_ID() );
	$page->init();
	$page->hero = array(
		'module_name' => 'Page Hero',
		'config' => PAGE_HERO_MODULE,
		'hero_jump_links' => $page->jump_links()
	);
	$page->render();
?>

<?php	get_footer(); ?>
