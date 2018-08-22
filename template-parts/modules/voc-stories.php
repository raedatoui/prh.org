<section class="module voc voc-stories module__aggregate-card">
	<div class="content">
		<?php  include( locate_template( 'template-parts/components/module-title.php', false, false ) ); ?>
		<h3 id="stories-search-label"></h3>
		<div class="row macy-grid" id="aggregate-macy-voc">
			<?php
				$args = array();
				search_and_render_stories( $args ); 
			?>
		</div>

		<!-- <div class="row cta-row voc">
			<a class="cta" href="#" id='stories-prev-page'>
				Prev Page
			</a>
			<a class="cta" href="#" id='stories-next-page'>
				Next Page
			</a>
		</div> -->

	</div>
</section>