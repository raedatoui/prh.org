<section class="module voc voc-categories">
	<div class="content">
		<?php include( locate_template( 'template-parts/components/module-title.php', false, false ) ); ?>

		<ul>
			<li class="story-category abortion" data-category="abortion">
				<div class="icon"></div>
				<span>Abortion</span>
			</li>
			<li class="story-category pregnancy" data-category="pregnancy">
				<div class="icon"></div>
				<span>Pregnancy</span>
			</li>

			<li class="story-category contraception" data-category="contraception">
				<div class="icon"></div>
				<span>Contraception</span>
			</li>
			<li class="story-category health" data-category="access-to-care">
				<div class="icon"></div>
				<span>Access to Care</span>
			</li>
			<li class="story-category faith" data-category="faith">
				<div class="icon"></div>
				<span>Faith</span>
			</li>
		</ul>

		<div class="voc-categories search">
			<div class="search-term">
				<svg class="icon--search" role="presentation">
					<use xlink:href="#icon--search" />
				</svg>
				<input class="search-field" placeholder="SEARCH" name="term" id="stories-search-term" required/>
			</div>
			<div class="search-state">
				<svg class="icon--state" role="presentation">
					<use xlink:href="#icon--state" />
				</svg>
				<input class="search-field" placeholder="BY STATE" id="stories-search-state"/>
			</div>
		</div>

		<div class="row cta-row">
			<div class="cta no-arrow" id="strories-search-btn">Search</a>
		</div>

	</div>
</section>