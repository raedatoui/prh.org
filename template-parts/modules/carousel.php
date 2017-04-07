<?php $module = $this->modules[CAROUSEL_MODULE['name']]; ?>
<section class="featured-carousel module page-content">
	<?php include( locate_template( 'template-parts/components/module-title.php', false, false ) ); ?>
	<div class="module__content">
		<div class="row">
			<div class="carousel">
				<?php foreach ( $module[CAROUSEL_MODULE['images']] as $index => $image ): ?>
				<div class="slide slide-<?php echo $image ?>">
				  <a href="<?php echo $image[CAROUSEL_MODULE['link']] ?>"><img src="<?php echo $image[CAROUSEL_MODULE['image']]['url'] ?>" alt="" /></a>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php include( locate_template( 'template-parts/components/cta.php', false, false ) ); ?>
	</div>
</section>