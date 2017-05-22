<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package prh-wp-theme
 */

?>
<div class="search-result">
	<article class="row result-row" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="result-meta col-xs-12 col-md-2">
			<div class="eyebrow result-type"><?php echo get_post_type_object(get_post_type())->labels->singular_name; ?></div>
			<div class="result-date"><?php prh_wp_theme_posted_on(); ?></div>
		</header>
		<div class="result-content col-xs">
			<?php the_title( sprintf( '<h3 class="result-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
			<p><?php echo sanitize_text_field(get_the_excerpt()); ?></p>

			<?php 
		$tags = get_the_tags( $post->ID );
		if ( $tags ):  ?>
			<aside class="tags-block result-tags">
					<ul class="tags-list">
						<?php foreach( $tags as $tag ):  ?>
							<li>
								<a class="tag" href="<?php bloginfo('url' );?>/tag/<?php print_r( $tag->slug );?>">
									<?php print_r( $tag->name . ' (' . $tag->count . ')' ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
			</aside>
		<?php endif; ?>


		</div>
	</article>
</div>
