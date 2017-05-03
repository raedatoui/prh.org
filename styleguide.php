<?php
/**
 * Template name: Styleguide
 *
 * @package prh-wp-theme
 */

get_header(); ?>


<style>

.style-details {
	margin-bottom: 2em;
}

.style-details:after {
	content:"";
	display: block;
	clear: both;
}

.style-details dt,
.style-details dd {
	float: left;
}

.style-details dt { 
	clear: both;
	font-weight: bold; 
	margin-right: 2ch;
	width: 10em;
}

.swatch-block {
	background: #fff;
	background: #fff7f1;
	border: 10px solid #fff1e6;
	text-align: center;
}

.swatch-label {
	display: block;
	margin: 0 auto 40px;
}

.swatch {
	height: 40px;
	width: 100%;
	margin: 20px auto;
}

.swatch-paper,
.swatch-cream {
	outline: 2px solid #f3ebde;
}

.type-samples {
	padding: 40px 0;
}

.type-samples h1,
.type-samples h2,
.type-samples h3,
.type-samples p,
.type-samples > * {
	margin-bottom: 30px;
}

.type-block {
	margin-bottom: 100px;
}

</style>

<section class="hero module">
	<div class="content">
		<h1 class="hero__header">Style Guide</h1>
		<div class="col-xs-12 hero__subhead">An inventory of global patterns.</div>
	</div>
</section>

<!-- Colors -->
<section class="module">
	<div class="content">
		<header class="row center-xs">
			<div class="module__title">
				<h2>Colors</h2>
			</div>
		</header>

		<div class="row swatch-row">
			<?php foreach (PRH_COLORS as $key => $color): ?>
				<div class="col-xs-3 col-md-2 col-lg-1 swatch-block">
					<div class="swatch swatch-<?php echo $key; ?>" style="background-color: <?php echo $color; ?>;"></div>
					<span class="swatch-label eyebrow"><?php echo $key; ?></span>
					<span class="swatch-label swatch-hex"><?php echo $color; ?></span>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>		


<!-- Typefaces -->
<section class="module">
	<div class="content">
		<header class="row center-xs">
			<div class="module__title"><h2>Typefaces</h2></div>
		</header>

		<div class="row">
			<div class="col-xs-12 type-block">
				<h3>Lora</h3>
					<p>Accent/emphasis typeface. Mostly used for headers and lead-in copy, and some quotes.</p>

					<dl class="style-details">
						<dt>Letter-spacing</dt> <dd>-25</dd>
						<dt>Default line-height</dt> <dd>1.25</dd>
						<dt>Weights</dt> <dd>400, 700</dd>
						<dt>Styles</dt> <dd>Normal, italic</dd>
					</dl>

					<hr>
					<div class="type-samples">
					<div class="row">

						<div class="col-md-6">
							<h1 style="font-size: 54px;">Lora Regular at 54px.</h1>
							<h1 style="font-size: 44px;">Lora Regular at 44px.</h1>
							<h1 style="font-size: 30px;">Lora Regular at 30px.</h1>
							<h1 style="font-size: 28px;">Lora Regular at 28px.</h1>
							<h1 style="font-size: 25px;">Lora Regular at 25px.</h1>
							<h1 style="font-size: 22px;">Lora Regular at 22px.</h1>
						</div>

						<div class="col-md-6">
							<h1 style="font-size: 54px; font-style: italic;">Lora Italic at 54px.</h1>
							<h1 style="font-size: 44px; font-style: italic;">Lora Italic at 44px.</h1>
							<h1 style="font-size: 30px; font-style: italic;">Lora Italic at 30px.</h1>
							<h1 style="font-size: 28px; font-style: italic;">Lora Italic at 28px.</h1>
							<h1 style="font-size: 25px; font-style: italic;">Lora Italic at 25px.</h1>
							<h1 style="font-size: 22px; font-style: italic;">Lora Italic at 22px.</h1>
						</div>
 						
 						</div><hr><div class="row">

						<div class="col-md-6">
							<h1 style="font-size: 54px; font-weight: 700;">Lora Bold at 54px.</h1>
							<h1 style="font-size: 44px; font-weight: 700;">Lora Bold at 44px.</h1>
							<h1 style="font-size: 30px; font-weight: 700;">Lora Bold at 30px.</h1>
							<h1 style="font-size: 28px; font-weight: 700;">Lora Bold at 28px.</h1>
							<h1 style="font-size: 25px; font-weight: 700;">Lora Bold at 25px.</h1>
							<h1 style="font-size: 22px; font-weight: 700;">Lora Bold at 22px.</h1>
						</div>						

						<div class="col-md-6">
							<h1 style="font-size: 54px; font-weight: 700; font-style: italic;">Lora Bold Italic at 54px.</h1>
							<h1 style="font-size: 44px; font-weight: 700; font-style: italic;">Lora Bold Italic at 44px.</h1>
							<h1 style="font-size: 30px; font-weight: 700; font-style: italic;">Lora Bold Italic at 30px.</h1>
							<h1 style="font-size: 28px; font-weight: 700; font-style: italic;">Lora Bold Italic at 28px.</h1>
							<h1 style="font-size: 25px; font-weight: 700; font-style: italic;">Lora Bold Italic at 25px.</h1>
							<h1 style="font-size: 22px; font-weight: 700; font-style: italic;">Lora Bold Italic at 22px.</h1>
						</div>


					</div>
			
					<hr>
						<h1>This is a level-one heading (h1)</h1>
						<h3>This is a level-three heading (h3)</h3>
						<p class="lead-copy">This style can be used for the first paragraph of some text content. In CSS, the class to apply is "lead-copy".</p>
						<blockquote><p>The italic version is used for standalone quotes.</p></blockquote>
					</div>


			</div>

			<div class="col-xs-12 col-md-6 type-block">
				<h3>Roboto</h3>
				<p>Primary typeface. Used for body copy, typically at 18px.</p>

				<dl class="style-details">
					<dt>Letter-spacing</dt> <dd>25</dd>
					<dt>Default line-height</dt> <dd>1.67</dd>
					<dt>Weights</dt> <dd>400, 700</dd>
					<dt>Styles</dt> <dd>Normal, italic</dd>
				</dl>

				<hr>
				<div class="type-samples">
					<p style="font-size: 28px;">This is Roboto at 28px.</p>
					<p style="font-size: 24px;">This is Roboto at 24px.</p>
					<p style="font-size: 20px;">This is Roboto at 20px.</p>
					<p style="font-size: 18px;">This is Roboto at 18px.</p>
					<p style="font-size: 16px;">This is Roboto at 16px.</p>
				</div>
			</div>

			<div class="col-xs-12 col-md-6 type-block">
				<h3>Roboto Condensed</h3>
				<p>Used for the level 2 heading, eyebrows, CTA buttons, and some utility copy.</p>
				<dl class="style-details">
					<dt>Letter-spacing</dt> <dd>.3em</dd>
					<dt>Default line-height</dt> <dd>1.67</dd>
					<dt>Weights</dt> <dd>700</dd>
					<dt>Styles</dt> <dd>Normal</dd>
				</dl>
				<hr>
				<div class="type-samples">
					<p class="eyebrow">This is the default eyebrow styling</p>
					<time class="eyebrow" style="color: #999;">Same style for dates and utility text</time>
					<p class="utility-copy">Smaller when used with the 'utility-copy' class.</p>
					<div class="row center-xs"><div class="module__title"><h2>Also used in level-2 headings</h2></div></div>
					<a class="cta">And in CTAs</a>
					<a class="cta cta--red">Even red ones</a>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="module">
	<div class="content">
		<header class="row center-xs">
			<div class="module__title">
				<h2>Copy</h2>
			</div>
		</header>
		<p class="lead-copy">This paragraph text is larger than normal. It’s generally used at the beginning of a page or section, to introduce the content. Blocks of text in this style shouldn’t be too long.</p>
		<p>This is normal paragraph text. These styles apply to most of the body copy throughout the site. They support styles like <strong>bold</strong> and <em>italic</em> and can contain <a href="#">links</a> to other pages.</p>
		<p>The level-one heading generally just happens once on a page, up in the hero or header area. It’s usually the page’s title. On this page, it's "Style Guide". And here's some filler copy from the PRH site, to show what a larger block of text looks like.</p>
		<p>Physicians for Reproductive Health believes that access to contraception is of vital importance to women’s health because it allows them to determine the timing and spacing of pregnancies. In the medical world, we have studied birth control methods and their effects for decades. We know, based on enormous amounts of scientific evidence, that contraception is crucial to women’s well-being, their children’s health, and their ability to educate themselves, achieve career goals, care for and support their families, and otherwise participate in society. As physicians, we see every day how it improves our patients’ lives.</p>
	</div>
</section>

<section class="module">
	<div class="content">
	<header class="row center-xs">
		<div class="module__title">
			<h2>Headers</h2>
		</div>
		</header>
		<p class="lead-copy">Headers show content hierarchy.</p>
		<p>The second-level heading, or module title, is used for naming the big subsections within a page. The word 'Headers' above this block of text is an example.</p>
		<h3>Heading level three (h3)</h3>
		<p>Following the page’s information hierarchy, third level headings should be used within the subsections. Avoid skipping levels – if your last header was an h2 and you want to label a block within that subsection, use an h3. If you need one within <em>that</em>, continue on with h4. HTML supports 6 levels of headers, but most content won't go deeper than 3 or 4.</p>
		<h4>Heading level four</h4>
		<p>Some pages won’t get to this level of hierarchy, but others might, especially in areas like sidebars. Here's some more filler text. Physicians for Reproductive Health believes that access to contraception is of vital importance to women’s health because it allows them to determine the timing and spacing of pregnancies. In the medical world, we have studied birth control methods and their effects for decades.</p>
		<h5>Heading level five</h5>
		<p>Most pages won’t get to this level of hierarchy, but others might, especially in areas like sidebars. Here's some more filler text. Physicians for Reproductive Health believes that access to contraception is of vital importance to women’s health because it allows them to determine the timing and spacing of pregnancies. In the medical world, we have studied birth control methods and their effects for decades.</p>
		<h6>Heading level six</h6>
		<p>Most pages won’t get to this level of hierarchy, but others might, especially in areas like sidebars. Here's some more filler text. Physicians for Reproductive Health believes that access to contraception is of vital importance to women’s health because it allows them to determine the timing and spacing of pregnancies. In the medical world, we have studied birth control methods and their effects for decades.</p>
	</div>
</section>

<section class="module">
	<div class="content">
	<header class="row center-xs">
		<div class="module__title">
			<h2>Buttons & links</h2>
		</div>
		</header>
		<div class="cta-row">
			<a href="#" class="cta">Call To Action</a>
			<a href="#" class="cta cta--red">Call to Action</a>
		</div>
		<p><a href="#">A normal inline link looks like this.</a></p>
  </div>
</section>

<section class="module">
	<div class="content">
	<header class="row center-xs">
		<div class="module__title">
			<h2>Blockquotes</h2>
		</div>
		</header>
		<blockquote>
			<p>This is what the default styling for a blockquote looks like, including a citation with a secondary detail.</p>
			<footer><cite>—Joel Hodgson, <span class="cite-origin">Minnesota</span></cite></footer>
		</blockquote>
	</div>
</section>

<section class="module">
	<div class="content">
	<header class="row center-xs">
		<div class="module__title">
			<h2>Misc text elements</h2>
		</div>
		</header>
		<p><span class="eyebrow">Eyebrow text | Also used for dates</span></p>
	</div>
</section>

<section class="module">
	<div class="content">
	<header class="row center-xs">
		<div class="module__title">
			<h2>Test your markup</h2>
		</div>
		</header>
		<p class="lead-copy">Below this, the page pulls from the wordpress admin area.</p>
		<p>You can edit the page called 'Styleguide' and the contents will show up here. Any modules added that way will show below that.</p>
  </div>
</section>

<section class="module">
	<div class="content">
	<header class="row center-xs">
		<div class="module__title">
			<h2>SVG Assets</h2>
		</div>
		</header>
		<p class="lead-copy">Our SVG assets, as defined in svg.php.</p>
		<div>
			<svg class="icon--carat" role="presentation">
				<use xlink:href="#icon--carat" />
			</svg>

			<svg class="icon--close" role="presentation">
				<use xlink:href="#icon--close" />
			</svg>

			<svg class="icon--search" role="presentation">
				<use xlink:href="#icon--search" />
			</svg>

			<svg class="icon--person" role="presentation">
				<use xlink:href="#icon--person" />
			</svg>

			<svg class="icon--squiggle" role="presentation">
				<use xlink:href="#icon--squiggle" />
			</svg>
		</div>
  </div>
</section>

<?php
while ( have_posts() ) : the_post(); ?>
<section class="module">
	<div class="content">
	<header class="row center-xs">
		<div class="module__title">
			<h2><?php the_title(); ?></h2>
		</div>
		</header>
		<?php the_content(); ?>
	</div>
</section>

<?php
	$page = new PageModules( get_the_ID() );
	$page->render();
endwhile; ?>

</div> <!-- /page-container -->

<?php
get_footer();
