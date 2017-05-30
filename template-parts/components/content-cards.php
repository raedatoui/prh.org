<?php
	$date_format =  get_option( 'date_format' );

	while ($query->have_posts()):
		$query->the_post();
		$link = get_permalink();
		$target = '_self';
		if (  get_post_type() == 'prh_news' ) {
			$link = get_field( 'article_external_url');
			$target = '_blank';
		}
		$post_image = get_the_post_thumbnail_url();
		$post_type = get_post_type(); ?>
		<a class="aggregate-tile col-xs-12 col-md-4" href="<?php echo $link ?>" aria-label="<?php the_title(); ?>" target="<?php echo $target; ?>">
			<div class="tile__container">
				<div class="tile__type--container">
					<span class="tile__type"><?php echo CONTENT_TYPES_LABELS[$post_type][0]; ?></span>
					<?php if ( $post_image != '' ) : ?>
						<div class="tile__source">
							<img src="<?php echo $post_image ?>" />
						</div>
					<?php endif; ?>
				</div>
				<date class="tile__date"><?php echo get_the_date($date_format); ?></date>
				<h3 class="tile__title"><?php the_title(); ?></h3>
				<div class="tile__summary">
					<p><?php echo sanitize_text_field(get_the_excerpt()); ?></p>
				</div>
			</div>
		</a>
<?php
	endwhile;
	wp_reset_postdata(); ?>