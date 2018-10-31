<section class="module voc voc-stories module__aggregate-card" id="voc-stories-container">
	<div class="content">
		<?php  include( locate_template( 'template-parts/components/module-title.php', false, false ) ); ?>
		<h3 id="stories-search-label"></h3>
		<div class="row macy-grid" id="aggregate-macy-voc">
			<?php
				$args = array();
				search_and_render_stories( $args ); 
			?>
		</div>

		<!-- <div class="row pagination">
			<button class="voc-pagination previous" type="button" aria-label="Previous" id="prev-btn">
				<svg class="flickity-button-icon" viewBox="0 0 100 100">
					<path d="M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z" class="arrow"></path>
				</svg>
			</button>

			<button class="voc-pagination next" type="button" aria-label="Next" id="next-btn">
				<svg class="flickity-button-icon" viewBox="0 0 100 100">
					<path d="M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z" class="arrow" transform="translate(100, 100) rotate(180) "></path>
				</svg>
			</button>
		</div> -->
		<div class="row cta-row">
			<div class="cta no-arrow" id="stories-read-more">Read More</a>
		</div>
	</div>
</section>