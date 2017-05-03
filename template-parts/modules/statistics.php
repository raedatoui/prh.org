<section class="stats module" id="<?php echo $module_title; ?>">
	<div class="content">
	<?php include( locate_template( 'template-parts/components/module-title.php', false, false ) ); ?>
		<div class="row">
			<?php foreach ( $module[STATISTICS_MODULE['repeater']] as $index => $card ): ?>
				<? $card = $card[STATISTICS_MODULE['card']][0]; ?>
				<div class="stat-title col-xs-12 col-md-4">
					<span class="stat-number"><?php echo $card[STATISTIC_CARD['number']] ?></span>
					<span class="stat-category"><?php echo $card[STATISTIC_CARD['text']] ?></span>
				</div>
			<?php endforeach; ?>
		</div>
		<?php include( locate_template( 'template-parts/components/cta.php', false, false ) ); ?>
	</div>
</section>
