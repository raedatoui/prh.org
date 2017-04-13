<?php if ( $module['config'][MODULE_OPTIONS['use_cta']] ): ?>
	<div class="row cta-row">
		<?php $cta = $module['config'][MODULE_OPTIONS['cta']][0];  ?>
		<a class="cta" href="<? echo $cta[CTA_COMPONENT['link']];?>">
			<? echo $cta[CTA_COMPONENT['label']]; ?>
		</a>
	</div>
<?php endif; ?>