<main id="main" class="site-main archive-main" role="main">
	<div class="module archive-content-module">
		<div class="content">

			<header class="page-header archive-header row">
				<h1 class="page-title archive-page-title col-xs">
					<?php if ( is_tag() ): ?>
						Tagged: <?php single_tag_title(); ?>
					<?php elseif ( is_archive() ): ?>
						Archive: <?php echo CONTENT_TYPES_LABELS[get_post_type()][1]; ?>
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
						<?php get_template_part( 'template-parts/pagination'); ?>
					</nav>
				</div>
			<?php endif; ?>

		</div>
	</div>
</main><!-- #main -->
