<?php if ( $module['config'][MODULE_OPTIONS['use_cta']] ): ?>
	<?php
		$cta = $module['config'][MODULE_OPTIONS['cta']][0];
		$cta_label = trim($cta[CTA_COMPONENT['label']]);
		$cta_class = "cta";
		if ( $cta_label == "Donate" ) {
			$cta_class = "cta cta--red";
		}
	?>
	<div class="row cta-row">
		<a class="<?php echo $cta_class; ?>" href="<? echo $cta[CTA_COMPONENT['link']];?>">
			<?php echo $cta_label; ?>
		</a>
	</div>
<?php endif; ?>