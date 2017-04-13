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
	$page->render();
	endwhile; // End of the loop. ?>

	<section class="support-us module info-module">
		<div class="content">
		<div class="module__title">
			<h2>One-Up Us</h2>
		</div>
		<div class="module__content columns-1">
			<div class="info-module--component row">
				<img class="info-module__img" alt="" src="<?php echo_theme_uri() ;?>/images/optimized/img_02.png" />
				<div class="info-module__info">
					<h3 class="info-module__title">90 cents of every dollar you donate goes directly to our programs.</h3>
					<span class="info-module__text">Advance the need for reproductive health rights today with a tax-free donation.</span>
						<a class="cta cta--red" href="#">Donate</a>
				</div>
			</div>
		</div>
		</div>
	</section>

	<section class="take-action module info-module">
		<div class="content">
		<div class="module__title">
			<h2>Support Us</h2>
		</div>
		<div class="module__content columns-3">
			<div class="row">
				<div class="info-module--component">
					<img class="info-module__img" alt="" src="<?php echo_theme_uri() ;?>/images/optimized/img_spotlight_01.png" />
					<div class="info-module__info">
						<h3 class="info-module__title">Make Your Voice Heard</h3>
						<span class="info-module__text">Speak out against attacks on reproductive healthcare rights.</span>
							<a class="cta cta--red" href="#">Speak Out</a>
					</div>
				</div>
				<div class="info-module--component">
					<img class="info-module__img" alt="" src="<?php echo_theme_uri() ;?>/images/optimized/img_spotlight_02.png" />
					<div class="info-module__info">
						<h3 class="info-module__title">Educate Others</h3>
						<span class="info-module__text">Pay your reproductive healthcare knowledge forward.</span>
							<a class="cta cta--red" href="#">Pay it Forward</a>
					</div>
				</div>
				<div class="info-module--component">
					<img class="info-module__img" alt="" src="<?php echo_theme_uri() ;?>/images/optimized/img_spotlight_03.png" />
					<div class="info-module__info">
						<h3 class="info-module__title">Attend an Event</h3>
						<span class="info-module__text">Lorem ipsum dolor sit amet consectetuer adipiscing elit</span>
							<a class="cta cta--red" href="#">See Events</a>
					</div>
				</div>
			</div>
		</div>
		</div>
	</section>
</div><!-- .page-container-->

<?php

get_footer();
