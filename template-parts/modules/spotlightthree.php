<section class="info-module module" id="<?php echo $module_title; ?>">
	<div class="content">
	<?php include( locate_template( 'template-parts/components/module-title.php', false, false ) ) ?>
	<div class="module__content columns-3">
		<div class="row">

				<?php foreach ( $module[SPOTLIGHT_3_MODULE['repeater']] as $cardContainer ): ?>
					<?php $card = $cardContainer[SPOTLIGHT_3_MODULE['card']][0] ?>
					<div class="info-module--component">
						<img class="info-module__img" alt="" src="<?php echo $card[SPOTLIGHT_CARD['image']]['url'] ?>" />
						<div class="info-module__info">
							<h3 class="info-module__title"><?php echo $card[SPOTLIGHT_CARD['headline']] ?></h3>
							<?php if ( $card[SPOTLIGHT_CARD['text']] != '' ) : ?>
								<span class="info-module__text"><?php echo $card[SPOTLIGHT_CARD['text']] ?></span>
							<?php endif; ?>
							<?php if ( $card[SPOTLIGHT_CARD['use_cta']] ):  ?>
								<?php $cta = $card[SPOTLIGHT_CARD['cta']][0];  ?>
								<a class="cta" href="<?php echo $cta[CTA_COMPONENT['link']];?>">
									<?php echo $cta[CTA_COMPONENT['label']]; ?>
								</a>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
		</div>
	</div>
	</div>
</section>
