<?php
	$aggregate = $this->modules[AGGREGATE_BY_POST_TYPE['name']];
	$args = array(
		'post_status' => array( 'publish' ),
		'post_type' => $aggregate[AGGREGATE_BY_POST_TYPE['post_type']],
		'posts_per_page' => 3,
		'orderby' => 'date',
		'order'   => 'DESC',
	);
	$aggregate_query = new WP_Query( $args );
	$posts = $aggregate_query->posts;
	$dateFormat =  get_option('date_format');
?>
<section class="module module__aggregate-card page-content">
		<?php if ( $aggregate['config'][MODULE_OPTIONS['title']] != '' ): ?>
		<div class="module__title">
			<h2><?php echo $aggregate['config'][MODULE_OPTIONS['title']] ?></h2>
		</div>
	<?php endif; ?>
	<div class="module__content">
		<div class="row">
			<?php 
			if ($aggregate_query->have_posts()):
				while ($aggregate_query->have_posts()): 
					$aggregate_query->the_post(); 
					$link = get_permalink ( $post );
					$postImage = get_the_post_thumbnail_url($post); ?>
			<a class="aggregate-tile col-xs-12 col-md-4" href="<?php echo $link ?>">
				<div class="tile__container">
					<div class="tile__type--container">
						<span class="tile__type"><?php echo CUSTOM_POST_TYPES[$post->post_type]; ?>	</span>
						<?php if ( $postImage != '' ) : ?>
							<div class="tile__source">
								<img src="<?php echo $postImage ?>" />
							</div>
						<?php endif; ?>
					</div>
					<date class="tile__date"><?php echo get_the_date($dateFormat, $post); ?></date>
					<h3 class="tile__title"><?php the_title(); ?></h3>
					<div class="tile__summary"><?php the_excerpt(); ?></div>
				</div>
			</a>
		<?php 
				endwhile; 
			endif; 
			wp_reset_postdata(); ?>
		</div>
		<div class="row">
			<?php $cta = $aggregate['config'][MODULE_OPTIONS['cta']][0];  ?>
			<a class="cta" href="<? echo $cta[CTA_COMPONENT['link']];?>">
				<? echo $cta[CTA_COMPONENT['label']]; ?>
			</a>
		</div>
	</div>
</section>
