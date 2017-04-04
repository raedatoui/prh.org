<?php $hero = $this->modules[HERO_MODULE['name']]; ?>
<section class="hero module">
	<div class="page-content">
		<?php if ( $hero['config'][MODULE_OPTIONS['title']] != '' ): ?>
			<div class="module__title">
				<h2><?php echo $hero['config'][MODULE_OPTIONS['title']] ?></h2>
			</div>
		<?php endif; ?>
		<div class="module__content">
			<div class="row">
				<div class="col-xs-12">
					<h3 class="hero__header"><?php echo $hero[HERO_MODULE['header']] ?></h3>
				</div>
				<div class="col-xs-12 hero__subhead"><?php echo $hero[HERO_MODULE['text']] ?></div>
			</div>
		</div>
	</div>
</section>