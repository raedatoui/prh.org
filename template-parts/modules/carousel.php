<?php $carousel = $this->modules[CAROUSEL_MODULE['name']]; ?>
<section class="featured-carousel module page-content">
	<?php if ( $carousel['config'][MODULE_OPTIONS['title']] != '' ): ?>
		<div class="module__title">
			<h2><?php echo $carousel['config'][MODULE_OPTIONS['title']] ?></h2>
		</div>
	<?php endif; ?>
	<div class="module__content">
		<div class="row">
			<div class="carousel">
				<?php foreach ( $carousel[CAROUSEL_MODULE['images']] as $index => $image ): ?>
				<div class="slide slide-<?php echo $image ?>">
				  <a href="<?php echo $image[CAROUSEL_MODULE['link']] ?>"><img src="<?php echo $image[CAROUSEL_MODULE['image']]['url'] ?>" alt="" /></a>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>