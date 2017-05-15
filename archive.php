<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package prh-wp-theme
 */

get_header(); ?>

	<main id="main" class="site-main archive-main" role="main">
		<div class="module archive-content-module">
			<div class="content">

				<header class="page-header archive-header row">
					<h1 class="page-title archive-page-title col-xs">
						<?php if (is_tag()): ?>
							Tagged: <?php single_tag_title(); ?>
						<?php endif; ?>
					</h1>
				</header>

				<?php if ( have_posts() ) : ?>
					<!-- Left side (results area) -->
					<div class="row">
						<div class="col-xs-12 col-md-10 search-results archive-entries">
							<?php
							// the markup for an individual result is in template-parts/content-search.php
							while ( have_posts() ) : the_post();
								get_template_part( 'template-parts/content', 'search' );
							endwhile; ?>
						</div>
					</div>
					<div class="row">
						<nav class="pagination results-pagination">
					<?php 

					global $wp_query;

					$big = 999999999; // need an unlikely integer
					$translated = __( 'Page ', 'mytextdomain' ); // Supply translatable string

					echo paginate_links( array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format' => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total' => $wp_query->max_num_pages,
						'before_page_number' => '<span class="visually-hidden">'.$translated.' </span>',
						'prev_text' => '',
						'next_text' => ''
					) ); ?>
				</nav>
					</div>
				<?php endif; ?>

			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();
