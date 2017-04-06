<?php $stats = $this->modules[STATISTICS_MODULE['name']]; ?>
<section class="stats module page-content">
	<?php if ( $stats['config'][MODULE_OPTIONS['title']] != '' ): ?>
		<div class="module__title">
			<h2><?php echo $stats['config'][MODULE_OPTIONS['title']] ?></h2>
		</div>
	<?php endif; ?>
	<div class="module__content">
		<div class="row">
			<?php foreach ( $stats[STATISTICS_MODULE['figures']] as $index => $figure ): ?>
				<? $figure = $figure[STATISTICS_MODULE['figure']][0]; ?>
				<div class="stat-title col-xs-12 col-md-4">
					<span class="stat-number"><?php echo $figure[STATISTICS_MODULE['number']] ?></span>
					<span class="stat-category"><?php echo $figure[STATISTICS_MODULE['text']] ?></span>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="row">
			<?php $cta = $stats['config'][MODULE_OPTIONS['cta']][0];  ?>
			<a class="cta" href="<? echo $cta[CTA_COMPONENT['link']];?>">
				<? echo $cta[CTA_COMPONENT['label']]; ?>
			</a>
		</div>
	</div>
</section>
