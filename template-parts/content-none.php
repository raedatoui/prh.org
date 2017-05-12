<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package prh-wp-theme
 */

?>

<section class="no-results not-found">

	<div class="page-content">
		<?php if ( is_search() ): ?>

		<div class="search-result">
			<article class="row result-row">
				<h3>Nothing matched your search.</h3>
				<p>If you've applied filters, try <a href="<?php echo '/?s=' . get_search_query(); ?>">removing them</a> to see more results.</p>
				<p>You can also try a different search term, or use the navigation at the top of the page.</p>
			</article>
		</div>
		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
