<section class="module module__tabs">
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

			<section id="tab-target-<?php echo $key + 1 ?>" class="tab-section">
				<div class="content">
					<h3 class="tab-section-title">
						<svg class="icon--carat" role="presentation">
							<use xlink:href="#icon--carat" />
						</svg>
						<?php echo $card[TAB_CARD['title']] ?>
					</h3>
					<div class="tab-inner row">
						<div class="col-xs-12 col-md-4">
							<p><?php echo $card[TAB_CARD['text']] ?></p>
							<?php $cta = $card[TAB_CARD['cta']][0];  ?>
							<a class="cta" href="<? echo $cta[CTA_COMPONENT['link']];?>">
								<? echo $cta[CTA_COMPONENT['label']]; ?>
							</a>
						</div>
						<div class="col-xs-12 col-md-8">
							<img src="<?php echo $card[TAB_CARD['image']]['url'] ?>" />
						</div>
					</div>
				</div>
			</section>
		<?php endforeach; ?>
	</div>
</section>
