<section class="info-module module">
	<div class="content">
		<?php include( locate_template( 'template-parts/components/module-title.php', false, false ) ) ?>
		<div class="module__content columns-1">
			<div class="info-module--component slide-link">
			<?php foreach ( $module[SPOTLIGHT_1_MODULE['card']] as $card ): ?>
				<!-- <div class="info-module__img col-xs-12 col-sm-4"> -->
				<div class="slide-half">
					<img alt="" src="<?php echo $card[SPOTLIGHT_CARD['image']]['url'] ?>" />
				</div>
				<div class="slide-half">
				<!-- </div> -->
				<!-- <div class="info-module__info col-xs-12 col-sm-8"> -->
					<h3 class="info-module__title"><?php echo $card[SPOTLIGHT_CARD['headline']] ?></h3>
					<?php if ( $card[SPOTLIGHT_CARD['text']] != '' ) : ?>
						<span class="info-module__text"><?php echo $card[SPOTLIGHT_CARD['text']] ?></span>
					<?php endif; ?>
				</div>
				<?php endforeach; ?>
			</div>
			<div class="row cta-row">
					<?php if ( $card[SPOTLIGHT_CARD['use_cta']] ):  ?>
						<?php
							$cta = $card[SPOTLIGHT_CARD['cta']][0];
							$cta_label = trim($cta[CTA_COMPONENT['label']]);
							$cta_class = "cta";
							if ( $cta_label == "Donate" ) {
								$cta_class = "cta cta--red";
							}
							$url = $cta[CTA_COMPONENT['link']];
						?>
						<a class="<?php echo $cta_class; ?>" href="<? echo $url; ?>" target="<?php echo get_url_target( $url ); ?>">
							<? echo $cta_label; ?>
						</a>
					<?php endif; ?>
			</div>
		</div>
	</div>
</section>
