<?php $module = $this->modules[STATISTICS_MODULE['name']]; ?>
<section class="stats module">
	<div class="content">
	<?php include( locate_template( 'template-parts/components/module-title.php', false, false ) ); ?>
		<div class="row">
			<?php foreach ( $module[STATISTICS_MODULE['figures']] as $index => $figure ): ?>
				<? $figure = $figure[STATISTICS_MODULE['figure']][0]; ?>
				<div class="stat-title col-xs-12 col-md-4">
					<span class="stat-number"><?php echo $figure[STATISTICS_MODULE['number']] ?></span>
					<span class="stat-category"><?php echo $figure[STATISTICS_MODULE['text']] ?></span>
				</div>
			<?php endforeach; ?>
		</div>
		<?php include( locate_template( 'template-parts/components/cta.php', false, false ) ); ?>
	</div>
</section>
