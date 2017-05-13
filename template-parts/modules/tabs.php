<section class="module module__tabs" id="<?php echo $module_title; ?>">
	<div class="content">
	<?php include( locate_template( 'template-parts/components/module-title.php', false, false ) ); ?>
		<div class="row">
			<div class="col-xs-12">
				<p class="focus-lead-copy"><?php echo $module[TAB_PANEL['headline']]?></p>
			</div>
		</div>
	</div>
	<div class="tab-accordion">
		<div class="content">
			<nav role="tablist" class="tab-nav">
				<?php foreach ( $module[TAB_PANEL['repeater']] as $key => $tabContainer ): ?>
					<?php $card = $tabContainer[TAB_PANEL['card']][0] ?>
					<a class="tab-nav-title" href="#tab-target-<?php echo $key + 1 ?>">
						<span class="tab-nav-ordinal"><?php echo $key + 1 ?></span>
						<span class="tab-nav-copy"><?php echo $card[TAB_CARD['title']] ?></span>
					</a>
				<? endforeach; ?>
			</nav>
		</div>
		<?php foreach ( $module[TAB_PANEL['repeater']] as $key => $tabContainer ): ?>
			<?php $card = $tabContainer[TAB_PANEL['card']][0] ?>

			<section class="tab-section" id="tab-target-<?php echo $key + 1 ?>" >
				<div class="content">
					<h3 class="tab-section-title">
						<button class="">
							<svg class="icon--minus" role="presentation">
								<use xlink:href="#icon--minus" />
							</svg>

							<svg class="icon--plus" role="presentation">
								<use xlink:href="#icon--plus" />
							</svg>
							<?php echo $card[TAB_CARD['title']] ?>
						</button>
					</h3>
					<div class="tab-inner row">
						<?php
							$copy_class = '4';
							$has_image = !empty( $card[TAB_CARD['image']] );
							if ( !$has_image ) {
								$copy_class = '12';
							}
						?>
						<div class="col-xs-12 col-md-<?php echo $copy_class; ?>">
							<p><?php echo $card[TAB_CARD['text']] ?></p>
							<?php if ( $card[TAB_CARD['use_cta']] ): ?>
								<?php
									$cta = $card[TAB_CARD['cta']][0];
									$cta_label = trim($cta[CTA_COMPONENT['label']]);
									$cta_class = "cta";
									if ( $cta_label == "Donate" ) {
										$cta_class = "cta cta--red";
									}
								?>
								<a class="<?php echo $cta_class; ?>" href="<? echo $cta[CTA_COMPONENT['link']];?>">
									<? echo $cta_label; ?>
								</a>
							<?php endif; ?>
						</div>
						<?php  if( $has_image ):  ?>
							<div class="col-xs-12 col-md-8">
								<img src="<?php echo $card[TAB_CARD['image']]['url'] ?>" />
							</div>
						<?php endif; ?>
					</div>
				</div>
			</section>
		<?php endforeach; ?>
	</div>
</section>
