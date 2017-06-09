<section class="featured-carousel module">
	<div class="content">
		<?php include( locate_template( 'template-parts/components/module-title.php', false, false ) ); ?>
		<div class="carousel">

			<?php foreach ( $module[CAROUSEL_MODULE['slides']] as $index => $slide ): ?>

				<div class="slide slide-<?php echo $index ?>">
					<?php
						$link_class = "slide-link";
						$url = "http://" . $slide[CAROUSEL_MODULE['link']];
						$link_target =  get_url_target( $url );
						if (  $slide[CAROUSEL_MODULE['link']] == "" ) {
							$link_class =  "slide-link inactive-slide";
							$url = "#";
							$link_target = "_self";
						}
					?>
					<a class="<?php echo $link_class; ?>" href="<?php echo $url ?>" target="<?php echo $link_target; ?>">
						<div class="slide-half">
							<img src="<?php echo $slide[CAROUSEL_MODULE['image']]['url'] ?>"
							alt=""/>
						</div>
						<div class="slide-half">
							<?php
							echo_wrapped($slide[CAROUSEL_MODULE['eyebrow']], '<span class="eyebrow slide-eyebrow">', '</span>');
							echo '<div class="slide-content">';
							echo_wrapped($slide[CAROUSEL_MODULE['title']], '<h2 class="slide-title">', '</h2>');
							echo_wrapped($slide[CAROUSEL_MODULE['text']], '<p class="slide-text">', '</p>');
							echo '</div>';
							echo_wrapped($slide[CAROUSEL_MODULE['details']], '<span class="slide-cta">', '</span>');
							?>
						</div>
					</a>

				</div>

			<?php endforeach; ?>

		</div>
		<?php include( locate_template( 'template-parts/components/cta.php', false, false ) ); ?>
	</div>
</section>
