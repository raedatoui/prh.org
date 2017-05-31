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
	<div class="search-open hero search-hero" id="hero">
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
				global $wp_query;

				// var_dump($wp_query->query_vars);

				$type_queried = false;
				$cat_queried = false;

				$total_results = $wp_query->found_posts;
				$active_search_query = get_search_query();
				$active_type_query = $wp_query->query_vars['post_type'];
				$active_cat_query = $wp_query->query_vars['category_name'];

				if ($active_type_query && $active_type_query != 'any' && $active_type_query != '') {
					$type_queried = true;
				}

				if ($active_cat_query && $active_cat_query != 'any' && $active_cat_query != '') {
					$cat_queried = true;
					$active_cat_name = get_category($wp_query->query_vars['cat'])->name;
				}

				$base_query =  '/?s=' . $active_search_query;
				$type_query = $base_query. '&post_type=' . $active_type_query;
				$cat_query = $base_query . '&category_name=' . $active_cat_query;
				$full_query = $base_query . '&post_type=' . $active_type_query . '&category_name=' . $active_cat_query;

				?>

				<header class="page-header row">
					<h2 class="page-title search-page-title col-xs">
						<?php printf( '%s results <span class="search-query-term md-up"> for &ldquo;%s&rdquo;</span>', $total_results,  get_search_query() ); ?>
					</h2>

					<!-- This triggers a checkbox a bit further down in the html...no-JS menu toggling? Sure! -->
					<label for="show-filters" class="md-down cta filters-button">Filters</label>
				</header><!-- .page-header -->

				<?php if ($type_queried || $cat_queried): ?>
					<div class="filter-row row">
						<div class="col-xs-12 col-md-9 col-lg-8">
							<div class="row">
								<div class="col-xs-2 filter-label">My Filters:</div>
								<div class="col-xs col-md-7">
									<ul class="active-filters filter-list">

										<?php if ($type_queried):
										$filtered_type = get_post_type_object($active_type_query); ?>
										<li class="active-filter">
											<a class="tag" href="<?php echo $cat_query; ?>">
												<?php echo $filtered_type->labels->singular_name; ?> <span class="visually-hidden">(Click to remove filter)</span>
											</a>
										</li>
									<?php endif; ?>

									<?php if ($cat_queried): ?>
										<li class="active-filter">
											<a class="tag"  href="<?php echo $type_query; ?>">
												<?php echo $active_cat_name; ?> <span class="visually-hidden">(Click to remove filter)</span>
											</a>
										</li>
									<?php endif; ?>

									</ul>
								</div>
								<div class="col-xs-12 col-sm-3 filter-cancel">
									<a href="<?php echo $base_query; ?>">Clear all selections</a>
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>

				<div class="row">
					<!-- Left side (results area) -->
					<div class="col-xs-12 col-md-9 col-lg-8 search-results">
						<?php
							if ( have_posts() ) :
								// the markup for an individual result is in template-parts/content-search.php
								while ( have_posts() ) : the_post();
									get_template_part( 'template-parts/content', 'search' );
								endwhile;

							else : // if !have_posts
								get_template_part( 'template-parts/content', 'none' );
							endif;
						?>
					</div>

					<!-- Right side (filtering) -->
					<input id="show-filters" type="checkbox" class="show-filters">
					<div class="sidebar post-sidebar col-xs-12 col-md-3 col-lg-offset-1 search-filters">
						<aside class="sidebar-block types-filter-block">
							<div class="sidebar-content">
								<h2 class="sidebar-header">Content type</h2>

								<ul class="filter-list checkbox-list type-list">
								<?php

								foreach ( $content_types as $type ):

									$is_active = ( $type->name == $active_type_query );
									if ( $type->name == 'page' ) {
										$query_url = $base_query . '&post_type=' . $type->name;
									}
									else {
										$query_url = $cat_query . '&post_type=' . $type->name;
									}

									if ($is_active) {
										$query_url = $cat_query;
									}
									// $filtered_query = ( $type->name == 'page' ) ? $base_query : $cat_query;
									// $query_url = ( $is_active ) ? $filtered_query : $filtered_query . '&post_type=' . $type->name;

									?>


									<?php
									// this is HACKY, but for some reason the page type query doesn't work.
									if ( $type->name !== 'page' && $type->name !== 'post' && $type->name !== 'attachment' ) : ?>
										<li class="checkbox-item <?php echo ($is_active ? 'is-checked' : ''); ?>">
												<a href="<?php echo $query_url; ?>">
													<span class="item-label"><?php echo $type->labels->singular_name; ?></span>
													<span class="visually-hidden">
														<?php echo $is_active ? '(Active.)' : ''; ?>
													</span>
												</a>
										</li>
									<?php endif; ?>

								<?php endforeach; ?>
								</ul>

							</div>
						</aside>

						<aside class="sidebar-block categories-filter-block">
							<div class="sidebar-content">
								<h2 class="sidebar-header">Category</h2>

								<ul class="filter-list checkbox-list type-list">
								<?php foreach ( $cats as $cat ):
									$is_active = ( $cat->slug == $active_cat_query );
									$filtered_query =  ( $type->name == 'page' ) ? $base_query : $type_query;
									$query_url = ( $is_active ) ? $filtered_query : $filtered_query . '&category_name=' . $cat->slug;
								?>

									<li class="checkbox-item <?php echo $is_active ? 'is-checked' : ''; ?>">
											<a href="<?php echo $query_url; ?>">
												<span class="item-label"><?php echo $cat->name ?></span>
												<span class="visually-hidden">
													<?php echo $is_active ? '(Active.)' : ''; ?>
												</span>
											</a>
									</li>

								<?php endforeach; ?>
								</ul>
							</div>
						</aside>
					</div>

					<!-- Results Pagination -->
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

			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();
