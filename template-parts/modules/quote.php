<?php
	$module = $this->modules[QUOTE_MODULE['name']];
	$quoteText = $module[QUOTE_MODULE['text']];
	$quoteClass = 'col-md-8';
	if ( $quoteText == '') {
		$quoteClass = 'col-md-12';
	}
?>
<section class="module module__quote page-content">
	<?php include( locate_template( 'template-parts/components/module-title.php', false, false ) ); ?>
	<div class="module__content">
		<div class="row">
			<?php if ( $quoteText != '') : ?>
				<div class="text-component col-xs-12 col-md-4">
					<p><?php echo  $quoteText; ?></p>
				</div>
			<?php endif; ?>
			<div class="quote-component col-xs-12 <?php echo $quoteClass ?>">
				<blockquote>
					<p><?php echo $module[QUOTE_MODULE['quote']]; ?></p>
					<footer>
						<cite>&mdash;<?php echo $module[QUOTE_MODULE['attribution_name']]; ?>, <span class="cite-origin"><?php echo $module[QUOTE_MODULE['attribution_location']]; ?></span></cite>
					</footer>
				</blockquote>
			</div>
		</div>
		<?php include( locate_template( 'template-parts/components/cta.php', false, false ) ); ?>
	</div>
</section>