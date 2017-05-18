<?php
	$quote_text = $module[QUOTE_MODULE['text']];
	$quote_class = 'col-md-8';
	if ( $quote_text == '') {
		$quote_class = 'col-md-12';
	}
?>
<section class="module module__quote" id="<?php echo sanitize_title($module_title); ?>">
	<div class="content">
	<?php include( locate_template( 'template-parts/components/module-title.php', false, false ) ); ?>
		<div class="row">
			<?php if ( $quote_text != '') : ?>
				<div class="text-component col-xs-12 col-md-4">
					<p><?php echo  $quote_text; ?></p>
				</div>
			<?php endif; ?>
			<div class="quote-component col-xs-12 <?php echo $quote_class ?>">
				<blockquote>

				<p>
					<svg class="quote-icon quote-start module-overlay" role="presentation">
						<use xlink:href="#quote-start" />
					</svg>

					<?php echo $module[QUOTE_MODULE['quote']]; ?>

					<svg class="quote-icon quote-end module-overlay" role="presentation">
						<use xlink:href="#quote-end" />
					</svg>

					</p>

					<footer>
						<cite>&mdash;<?php echo $module[QUOTE_MODULE['attribution_name']]; ?><?php
							$attr_loc = $module[QUOTE_MODULE['attribution_location']];
							if ( $attr_loc !== '') {
								echo_wrapped($attr_loc, ', <span class="cite-origin">', '</span>');
							} ?></cite>
					</footer>
				</blockquote>
			</div>
		</div>
		<?php include( locate_template( 'template-parts/components/cta.php', false, false ) ); ?>
	</div>
</section>
