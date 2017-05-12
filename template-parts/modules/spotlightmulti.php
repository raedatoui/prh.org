<section class="info-module module" id="<?php echo $module_title; ?>">
	<div class="content">
	<?php include( locate_template( 'template-parts/components/module-title.php', false, false ) ) ?>
	<div class="module__content columns-3">
		<div class="row">
			<div class="col-xs-12">
				<p class="focus-lead-copy"><?php echo $module[$module['config']['headline']]?></p>
			</div>
		</div>
		<div class="row">
				<?php foreach ( $module[$module['config']['repeater']] as $cardContainer ): ?>
					<?php $card = $cardContainer[$module['config']['card']][0] ?>
					<div class="info-module--component">
						<img class="info-module__img" alt="" src="<?php echo $card[SPOTLIGHT_CARD['image']]['url'] ?>" />
						<div class="info-module__info">
							<h3 class="info-module__title"><?php echo $card[SPOTLIGHT_CARD['headline']] ?></h3>
							<?php if ( $card[SPOTLIGHT_CARD['text']] != '' ) : ?>
								<span class="info-module__text"><?php echo $card[SPOTLIGHT_CARD['text']] ?></span>
							<?php endif; ?>
							<?php if ( $card[SPOTLIGHT_CARD['use_cta']] ):  ?>
								<?php $cta = $card[SPOTLIGHT_CARD['cta']][0];  ?>
								<a class="cta" href="<? echo $cta[CTA_COMPONENT['link']];?>">
									<? echo $cta[CTA_COMPONENT['label']]; ?>
								</a>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
		</div>
	</div>
	</div>
</section>
