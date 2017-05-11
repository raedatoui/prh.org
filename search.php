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

				<!-- Filter selection (if any are active) -->
				<div class="filter-row row">
					<div class="col-xs-12 col-md-9 col-lg-8">
					<div class="row">
						<div class="col-xs-2 filter-label">My Filters:</div>
						<div class="col-xs col-md-7">
							<ul class="active-filters filter-list">


								<?php
							// DUMMY LOGIC - remove this when the real code is hooked up
							// this is just to let us test some tag display.

								$filters = array( 1, 2, 3 );
								foreach ( $filters as $filter ):

									$tag->name = 'Sample tag';
								$tag->slug = 'abortion-access';
								$tag->count = '20';
								?>

								<li class="active-filter">
									<a class="tag" href="<?php bloginfo('url' );?>/tag/<?php print_r( $tag->slug );?>">
										<?php print_r( $tag->name . ' (' . $tag->count . ')' ); ?>
									</a>
								</li>
								<?php endforeach; ?>
							</ul>
						</div>
						<div class="col-xs-3 filter-cancel">
							<a href="#">Clear all selections</a>
						</div>
					</div>
				</div>
			</div>

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

						<aside class="sidebar-block types-filter-block">
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

						<aside class="sidebar-block categories-filter-block">
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



				<?php 
				// the_posts_navigation();
				// else :
				// 	get_template_part( 'template-parts/content', 'none' ); ?>
				<?php endif; ?>
			</div>
		</div>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
