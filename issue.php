<?php
/**
 * Template name: Issue Page
 */

get_header(); ?>

<!-- placeholder hero so the content doesn't hit the nav -->
<section class="hero module">
	<div class="content">
	</div>
</section>

<?php
	$page = new PageModules( get_the_ID() );
	$page->render();
?>

<?php	get_footer(); ?>
