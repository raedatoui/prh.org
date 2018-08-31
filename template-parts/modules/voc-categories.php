<section class="module voc voc-categories">
	<div class="content">
		<?php include( locate_template( 'template-parts/components/module-title.php', false, false ) ); ?>

		<ul>
			<li class="voc-category abortion" data-category="abortion">
				<div class="icon"></div>
				<span>Abortion</span>
			</li>
			<li class="voc-category pregnancy" data-category="pregnancy">
				<div class="icon"></div>
				<span>Pregnancy</span>
			</li>

			<li class="voc-category contraception" data-category="contraception">
				<div class="icon"></div>
				<span>Contraception</span>
			</li>
			<li class="voc-category health" data-category="health">
				<div class="icon"></div>
				<span>Health</span>
			</li>
			<li class="voc-category politics" data-category="politics">
				<div class="icon"></div>
				<span>Politics</span>
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
			<div class="cta no-arrow" id="voc-search-btn">Search</a>
		</div>
	</div>
</section>