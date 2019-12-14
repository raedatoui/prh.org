<?php if ( $module['config'][MODULE_OPTIONS['use_cta']] ): ?>
	<?php
		$cta = $module['config'][MODULE_OPTIONS['cta']][0];
		$cta_label = trim($cta[CTA_COMPONENT['label']]);
		$cta_class = "cta";
		if ( $cta_label == "Donate" ) {
			$cta_class = "cta cta--red";
		}
		$url = $cta[CTA_COMPONENT['link']];
	?>
	<div class="row cta-row">
		<a class="<?php echo $cta_class; ?>" href="<?php echo $url; ?>" target="<?php echo get_url_target( $url ); ?>">
			<?php echo $cta_label; ?>
		</a>
	</div>
<?php endif; ?>