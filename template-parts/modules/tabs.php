<section class="module module__tabs">
	<div class="content">
	<?php include( locate_template( 'template-parts/components/module-title.php', false, false ) ); ?>
		<div class="row">
			<div class="col-xs-12">
				<p class="focus-lead-copy"><?php echo $module[TAB_PANEL['headline']]?></p>
			</div>
		</div>
	</div>
	<div class="js-tab-accordion">
		<div class="content">
			<nav role="tablist" class="tab-accordion__nav">
				<?php foreach ( $module[TAB_PANEL['repeater']] as $key => $tabContainer ): ?>
					<?php $card = $tabContainer[TAB_PANEL['card']][0] ?>
					<a class="js-tab-accordion-tab" href="#target-<?php echo $key + 1 ?>">
						<span class="tab-accordion__nav-ordinal"><?php echo $key + 1 ?></span>
						<span class="tab-accordion__nav-title"><?php echo $card[TAB_CARD['title']] ?></span>
					</a>
				<? endforeach; ?>
			</nav>
		</div>
		<?php foreach ( $module[TAB_PANEL['repeater']] as $key => $tabContainer ): ?>
			<?php $card = $tabContainer[TAB_PANEL['card']][0] ?>

			<section id="target-<?php echo $key + 1 ?>" class="tab-accordion__section">
				<div class="content">
					<h1 class="js-tab-accordion-title">
						<svg class="mobile-tab-accordion-icon" role="presentation">
							<use xlink:href="#carat-forward" />
						</svg>
						<?php echo $card[TAB_CARD['title']] ?>
					</h1>
					<div class="tab-accordion__inner row">
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
