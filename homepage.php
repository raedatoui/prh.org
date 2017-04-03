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
		$groups = acf_get_field_groups();
		$modules = array();
		foreach( $groups as $group_key => $group ) {
			$module = acf_get_fields($group);
			$key = $group['title'];
			$modules[$key] = array('module_name' => $group['title']);
			foreach($module as $field_name => $field ) {
			  $f = $field['name'];
			  $modules[$key][$f] = get_field($f);
			}
		}
		$page = new PageModules($modules);
		
		if ( in_array( HERO_MODULE['name'], $page->keys ) ):
			$hero = $page->modules[HERO_MODULE['name']]; ?>
			<section class="hero module">
				<div class="page-content">
					<?php if ( $hero['config'][MODULE_OPTIONS['title']] != '' ): ?>
						<div class="module__title">
							<h2><?php echo $hero['config'][MODULE_OPTIONS['title']] ?></h2>
						</div>
					<?php endif; ?>
					<div class="module__content">
						<div class="row">
							<div class="col-xs-12">
								<h3 class="hero__header"><?php echo $hero[HERO_MODULE['header']] ?></h3>
							</div>
							<div class="col-xs-12 hero__subhead"><?php echo $hero[HERO_MODULE['text']] ?></div>
						</div>
					</div>
				</div>
			</section>
		<?php endif; ?>

		<?php if ( in_array( CAROUSEL_MODULE['name'], $page->keys ) ):
			$carousel = $page->modules[CAROUSEL_MODULE['name']]; ?>
			<section class="featured-carousel module page-content">
				<?php if ( $carousel['config'][MODULE_OPTIONS['title']] != '' ): ?>
					<div class="module__title">
						<h2><?php echo $carousel['config'][MODULE_OPTIONS['title']] ?></h2>
					</div>
				<?php endif; ?>
				<div class="module__content">
					<div class="row">
						<div class="carousel">
							<?php foreach ( $carousel[CAROUSEL_MODULE['images']] as $index => $image ): ?>
							<div class="slide slide-<?php echo $index ?>">
							  <a href="<?php echo $image[CAROUSEL_MODULE['link']] ?>"><img src="<?php echo $image[CAROUSEL_MODULE['image']]['url'] ?>" alt="" /></a>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</section>
		<?php endif; ?>

	<?php endwhile; // End of the loop. ?>

</div><!-- .page-container-->

<?php

get_footer();
