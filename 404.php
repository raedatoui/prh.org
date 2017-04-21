<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package prh-wp-theme
 */

get_header(); ?>

<!-- placeholder hero so the content doesn't hit the nav -->
<section class="hero module">
</section>

<main class="content module row row-top">
	<header class="col-xs-12">
		<h1><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'prh-wp-theme' ); ?></h1>
	</header>

	<article class="main-content post-content col-xs-12 col-md-9">
		<div class="post-body">
			<p>
				<?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'prh-wp-theme' ); ?>
			</p>
		</div>
	</article>

	<div class="sidebar post-sidebar col-xs-12 col-md-3">

		<?php
		$tags = false;
		// temporarily removed to avoid any QA confusion; uncomment to re-enable.
		// $tags = get_the_tags($post->ID);
		if ($tags):  ?>
			<aside class="sidebar-block tags-block">
				<div class="sidebar-content">
					<h2 class="sidebar-header">Tagged</h2>
					<ul class="tags-list">
						<?php foreach($tags as $tag):  ?>
							<li>
								<a class="tag" href="<?php bloginfo('url');?>/tag/<?php print_r($tag->slug);?>">
									<?php print_r($tag->name); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</aside>
		<?php endif; ?>

		<aside class="sidebar-block categories-block">
			<div class="sidebar-content">
				<h2 class="sidebar-header">
					<?php esc_html_e( 'Most Used Categories', 'prh-wp-theme' ); ?>
				</h2>
				<ul class="tags-list">
					<?php
					wp_list_categories( array(
						'orderby'    => 'count',
						'order'      => 'DESC',
						'show_count' => 1,
						'title_li'   => '',
						'number'     => 10,
						)
					);
					?>
				</ul>
			</div>
		</aside>

	</div>
</main>


<?php
get_footer();
