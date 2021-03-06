<?php
	$overview_text_class = 'col-md-12';
	$overview_class = 'overview module';
	$resources_enabled = $module[$module['config']['resources_enabled']];
	if ( $resources_enabled ) {
		$overview_text_class = 'col-md-8';
	}
	if ($module_class_name) {
		$overview_text_class = $overview_text_class . " " . $module_class_name;
		$overview_class = $overview_class . ' ' . $module_class_name;
	}
?>
<section class="<?php echo $overview_class ?>">
	<div class="content">
		<?php include( locate_template( 'template-parts/components/module-title.php', false, false ) ); ?>

		<div class="row top-xs">

			<!-- Text component -->
			<section class="overview-text main-content <?php echo $overview_text_class ?>">
				<?php
				$full_content = $module[$module['config']['content']];
				$contents = get_extended($full_content);
				$moretext = (strlen($contents['more_text']) > 1) ? $contents['more_text'] : 'Read more'; 
				?>

				<?php echo $contents['main']; ?>

				<?php if (strlen($contents['extended']) > 0):	?>
					<p>
						<a id="collapse-link-1" href="#collapsible-1" class="collapse-link">
							<?php echo $moretext; ?>
						</a>
					</p>

					<div id="collapsible-1" class="collapsible overview-collapsible is-collapsed">
						<div class="collapsible-content">
							<?php echo $contents['extended']; ?>
						</div>
					</div> 
				<?php endif; ?>
			</section>

			<?php if ( $resources_enabled ) : ?>
				<!-- Resource links component -->
				<aside class="sidebar resources-sidebar col-xs-12 col-md-3 col-md-offset-1">
					<div class="sidebar-content resources-content">

						<h2 class="sidebar-header resources-header">
							<?php echo $module[$module['config']['resources_title']]; ?>
						</h2>

						<ul class="sidebar-links resources-links">
							<?php foreach ( $module[$module['config']['resources_links']] as $index => $link ):
								$url = $link[$module['config']['resources_link_url']];
								?>

								<li>
									<a href="<?php echo $url; ?>" class="resource-link" target="<?php echo get_url_target( $url ); ?>">
										<?php echo $link[$module['config']['resources_link_text']]; ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</aside>
			<?php endif; ?>

		</div>
		
		<?php include( locate_template( 'template-parts/components/cta.php', false, false ) ); ?>

	</div>
</section>
