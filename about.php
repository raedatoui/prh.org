<?php
/**
 * Template name: About Us Page
 */

get_header(); ?>

<?php

	$page = new PageModules( get_the_ID() );
	$page->render();

	get_footer();
