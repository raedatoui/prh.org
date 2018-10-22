<section class="routing module">
	<div class="content">

		<?php include( locate_template( 'template-parts/components/module-title.php', false, false ) ); ?>

		<?php if ( $module[$module['config']['headline']] ): ?>
			<div class="row">
				<div class="col-xs-12">
					<p class="focus-lead-copy"><?php echo $module[$module['config']['headline']]?></p>
				</div>
			</div>
		<?php endif; ?>

		<div class="row routing-row macy-grid" id="routing-macy-<?php echo $module['config']['module_order']; ?>">
			<?php foreach ( $module[$module['config']['repeater']] as $index => $block ): ?>
			<div class="col-xs-12 col-sm-6 col-lg-4">
				<div class="routing-block">
					<div class="routing-content">
						<h3 class="routing-title">
							<?php echo $block[ROUTING_BLOCK['title']]; ?>
						</h3>
						<?php echo_wrapped($block[ROUTING_BLOCK['text']], '<p>', '</p>'); ?>
					</div>

					<div class="routing-ctas">
						<?php foreach ( $block[ROUTING_BLOCK['links']] as $link_index => $link):
							$url = $link[ROUTING_BLOCK['link_url']]; ?>
							<a class="cta--link" href="<?php echo $url; ?>" target="<?php echo get_url_target( $url); ?>">
								<span class="visually-hidden"><?php echo $block[ROUTING_BLOCK['title']]; ?>: </span>
								<?php echo $link[ROUTING_BLOCK['link_text']]; ?>
							</a>
						<?php endforeach; ?>
					</div>

				</div>
			</div>
		<?php endforeach; ?>
		</div>

		<?php include( locate_template( 'template-parts/components/cta.php', false, false ) ); ?>

	</div>
</section>
