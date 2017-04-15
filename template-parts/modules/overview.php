<?php 
$module = $this->modules[OVERVIEW_MODULE['name']]; ?>
<section class="overview module">
	<div class="content">
		<?php include( locate_template( 'template-parts/components/module-title.php', false, false ) ); ?>

		<div class="row top-xs">

			<!-- Text component -->
			<section class="overview-text col-md-8">
				<?php
				$full_content = $module[OVERVIEW_MODULE['content']]; 
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

			<!-- Resource links component -->
			<aside class="sidebar resources-sidebar col-xs-12 col-md-3 col-md-offset-1">
				<div class="sidebar-content resources-content">

					<h2 class="sidebar-header resources-header">
						<?php echo $module[OVERVIEW_MODULE['resources_title']]; ?>
					</h2>

					<ul class="sidebar-links resources-links">
						<?php foreach ( $module[OVERVIEW_MODULE['resources_links']] as $index => $link ): ?>
							<li>
								<a href="<?php echo $link[OVERVIEW_MODULE['resources_link_url']]; ?>" class="resource-link">
									<?php echo $link[OVERVIEW_MODULE['resources_link_text']]; ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</aside>

		</div>
	</div>
</section>
