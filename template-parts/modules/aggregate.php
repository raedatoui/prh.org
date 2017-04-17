<?php
	$query = $module['query'];
	$dateFormat =  get_option( 'date_format' );
?>
<section class="module module__aggregate-card">
	<div class="content">
	<?php include( locate_template( 'template-parts/components/module-title.php', false, false ) ); ?>
		<div class="row">
			<?php
				while ($query->have_posts()):
					$query->the_post();
					$link = get_permalink ( $post );
					$postImage = get_the_post_thumbnail_url($post); ?>

					<a class="aggregate-tile col-xs-12 col-md-4" href="<?php echo $link ?>" aria-label="<?php the_title(); ?>">
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
				wp_reset_postdata(); ?>
		</div>
		<?php include( locate_template( 'template-parts/components/cta.php', false, false ) ); ?>
	</div>
</section>
