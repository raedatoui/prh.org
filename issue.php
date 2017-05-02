<?php
/**
 * Template name: Issue Page
 */

get_header(); ?>

<?php
	$page = new PageModules( get_the_ID() );
	$page->render();
?>

<?php	get_footer(); ?>
