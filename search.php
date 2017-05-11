<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package prh-wp-theme
 */

get_header(); 

// Set up the query of all our content types (to make the list of filters)
$ct_args = array('public' => true);
$ct_output = 'objects';
$ct_operator = 'and';
$content_types = get_post_types($ct_args, $ct_output, $ct_operator);

// Same, but for categories
$cats = get_categories();
?>

	<!-- Persistent search bar above the results -->
	<div class="search-open hero search-hero">
		<div id="search-bar" class="search-bar">
			<div class="content search-bar-content">
			<?php get_search_form(); ?>
			</div>
		</div>
	</div>

	<main id="main" class="site-main search-main" role="main">
		<div class="module search-results-module">
			<div class="content">

				<?php
				if ( have_posts() ) : 
				global $wp_query;
				$total_results = $wp_query->found_posts;
				?>

				<header class="page-header row">
					<h2 class="page-title search-page-title col-xs">
						<?php printf( esc_html__( '%s results for &ldquo;%s&rdquo;', 'prh-wp-theme' ), $total_results, '<span class="search-query-term">' . get_search_query() . '</span>' ); ?>
					</h2>
				</header><!-- .page-header -->

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

						<aside class="sidebar-block media-contact-block">
							<div class="sidebar-content">
								<h2 class="sidebar-header">Content type</h2>

								<ul class="filter-list checkbox-list type-list">
								<?php
								foreach ( $content_types as $type ): ?>

									<li class="checkbox-item">
										<label>
											<input type="checkbox" class="filter filter-type" id="filter-type-<?php echo $type->slug; ?>">
											<?php echo $type->labels->singular_name; ?>
										</label>
									</li>
								<?php endforeach; ?>
								</ul>

							</div>
						</aside>

						<aside class="sidebar-block media-contact-block">
							<div class="sidebar-content">
								<h2 class="sidebar-header">Category</h2>

								<ul class="filter-list checkbox-list type-list">
								<?php foreach ( $cats as $cat ): ?>

									<li class="checkbox-item">
										<label>
											<input type="checkbox" class="filter filter-cat" id="filter-cat-<?php echo $cat->slug; ?>">
											<?php echo $cat->name ?>
										</label>
									</li>

								<?php endforeach; ?>
								</ul>
							</div>
						</aside>
					</div>

				<?php 

				the_posts_navigation();

				// else :

				// 	get_template_part( 'template-parts/content', 'none' );

				endif; ?>
			</div>
		</div>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
