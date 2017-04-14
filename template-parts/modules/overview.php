<?php $module = $this->modules[OVERVIEW_MODULE['name']]; ?>
<section class="overview module">
	<div class="content">
		<?php include( locate_template( 'template-parts/components/module-title.php', false, false ) ); ?>

		<div class="row top-xs">
			<!-- Text component -->
			<section class="overview-text col-md-8">
				<?php
				$full_content = $module[OVERVIEW_MODULE['content']]; 
				$split_content = explode('<p><!--more--></p>', $full_content);
				?>

				<?php echo $split_content[0]; ?>
				
				<?php if (count($split_content) >= 1): ?>

					<p><a id="collapse-link-1" href="#collapsible-1" class="collapse-link">Read more</a></p>

					<div id="collapsible-1" class="collapsible overview-collapsible is-collapsed">
						<div class="collapsible-content">
							<?php echo $split_content[1]; ?>
						</div>
					</div> 
				<?php endif; ?>
			</section>


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
