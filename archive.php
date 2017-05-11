<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package prh-wp-theme
 */

get_header(); ?>


	<main id="main" class="site-main search-main" role="main">
		<div class="module search-results-module">
			<div class="content">

				<?php
				if ( have_posts() ) : 
				?>

					<!-- Left side (results area) -->
				<div class="row">
					<div class="col-xs-12 col-md-9 col-lg-8 search-results">
						<?php
						// the markup for an individual result is in template-parts/content-search.php
						while ( have_posts() ) : the_post();
							get_template_part( 'template-parts/content', 'search' );
						endwhile; ?>
					</div>

					<!-- Right side (filtering) -->
					<div class="sidebar post-sidebar col-xs-12 col-md-3 col-lg-offset-1 search-filters">

					</div>

				<?php 

				the_posts_navigation();

				// else :

				// 	get_template_part( 'template-parts/content', 'none' );

				endif; ?>
			</div>
		</div>
		</div>

	</main><!-- #main -->

	
<?php
get_sidebar();
get_footer();
