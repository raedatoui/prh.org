<section class="info-module module">
	<div class="content">
		<?php include( locate_template( 'template-parts/components/module-title.php', false, false ) ) ?>
		<div class="module__content columns-3">
			<?php if ( $module[$module['config']['headline']] ): ?>
				<div class="row">
					<div class="col-xs-12">
						<p class="focus-lead-copy"><?php echo $module[$module['config']['headline']]?></p>
					</div>
				</div>
			<?php endif; ?>

			<div class="row">
				<?php foreach ( $module[$module['config']['repeater']] as $cardContainer ): ?>
					<?php $card = $cardContainer[$module['config']['card']][0] ?>
					<div class="info-module--component col-xs-12 col-sm-6 col-md-4">
						<div class="info-module__img">
							<img alt="" src="<?php echo $card[SPOTLIGHT_CARD['image']]['url'] ?>" />
						</div>
						<div class="info-module__info">
							<h3 class="info-module__title"><?php echo $card[SPOTLIGHT_CARD['headline']] ?></h3>
							<?php if ( $card[SPOTLIGHT_CARD['text']] != '' ) : ?>
								<span class="info-module__text"><?php echo $card[SPOTLIGHT_CARD['text']] ?></span>
							<?php endif; ?>
							<?php if ( $card[SPOTLIGHT_CARD['use_cta']] ):  ?>
								<?php
									$cta = $card[SPOTLIGHT_CARD['cta']][0];
									$cta_label = trim($cta[CTA_COMPONENT['label']]);
									$url = $cta[CTA_COMPONENT['link']];
								?>
								<a class="cta--link spotlight-cta" href="<? echo $url; ?>" target="<?php echo get_url_target( $url ); ?>">
									<? echo $cta_label; ?>
								</a>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<?php include( locate_template( 'template-parts/components/cta.php', false, false ) ); ?>
		</div>
	</div>
</section>
