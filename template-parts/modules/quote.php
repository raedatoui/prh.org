<?php $quote = $this->modules[QUOTE_MODULE['name']]; ?>
<section class="module module__quote page-content">
	<?php if ( $quote['config'][MODULE_OPTIONS['title']] != '' ): ?>
		<div class="module__title">
			<h2><?php echo $quote['config'][MODULE_OPTIONS['title']] ?></h2>
		</div>
	<?php endif; ?>
	<div class="module__content">
		<div class="row">
			<div class="text-component col-xs-12 col-md-4">
				<p><?php echo $quote[QUOTE_MODULE['text']]; ?></p>
			</div>
			<div class="quote-component col-xs-12 col-md-8">
				<blockquote>
					<p><?php echo $quote[QUOTE_MODULE['quote']]; ?></p>
					<footer>
						<cite>&mdash;<?php echo $quote[QUOTE_MODULE['attribution_name']]; ?>, <span class="cite-origin"><?php echo $quote[QUOTE_MODULE['attribution_location']]; ?></span></cite>
					</footer>
				</blockquote>
			</div>
		</div>

		<div class="row">
			<?php $cta = $quote['config'][MODULE_OPTIONS['cta']][0];  ?>
			<a class="cta" href="<? echo $cta[CTA_COMPONENT['link']];?>">
				<? echo $cta[CTA_COMPONENT['label']]; ?>
			</a>
		</div>
	</div>
</section>