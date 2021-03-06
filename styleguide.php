<?php
/**
 * Template name: Styleguide
 *
 * @package prh-wp-theme
 */

get_header(); ?>

<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/styleguide.css">


<!-- Hero -->
<section class="hero module" id="hero">
	<div class="content">
		<header class="module__title">
			<h2>Hero Module</h2>
		</header>
		<h1 class="hero__header">Style Guide</h1>
		<div class="col-xs-12 hero__subhead">An inventory of global patterns.</div>
	</div>
</section>


<!-- Colors -->
<section class="module">
	<div class="content">
		<header class="module__title">
			<h2>Colors</h2>
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


<!-- Links & buttons -->
<section class="module">
	<div class="content">
		<header class="module__title">
			<h2>Buttons & links</h2>
		</header>
		<div class="row">
			<div class="swatch-block col-xs-12 col-md-6 col-lg-3 button-swatch-block">
				<a href="#" style="margin: 40px auto 30px; display: inline-block;">More Resources</a>
				<span class="swatch-label"><code>default link styles</code></span>
			</div>
			
			<div class="swatch-block col-xs-12 col-md-6 col-lg-3 button-swatch-block">
				<a href="#" class="cta">Call To Action</a>
				<span class="swatch-label"><code>.cta</code></span>
			</div>

			<div class="swatch-block col-xs-12 col-md-6 col-lg-3 button-swatch-block">
				<a href="#" class="cta cta--red">Call To Action</a>
				<span class="swatch-label"><code>.cta.cta--red</code></span>
			</div>

			<div class="swatch-block col-xs-12 col-md-6 col-lg-3 button-swatch-block">
				<a href="#" class="cta--link" style="margin: 30px auto 15px; max-width: 15em;">Call To Action</a>
				<span class="swatch-label"><code>.cta--link</code></span>
			</div>

		</div>
	</div>
</section>


<!-- Typefaces -->
<?php $header_sizes = array(54, 44, 30, 28, 25, 22); 
			$copy_sizes = array(28, 24, 20, 18, 16);
			$eyebrow_sizes = array(18, 16, 14); ?>
<section class="module">
	<div class="content">
		<header class="module__title">
			<h2>Typefaces</h2>
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
							<?php foreach ($header_sizes as $index => $size): ?>
								<h1 style="font-size:<?php echo $size;?>px;">Lora Regular at <?php echo $size;?>px.</h1>
							<?php endforeach; ?>
						</div>

						<div class="col-md-6">
							<?php foreach ($header_sizes as $index => $size): ?>
								<h1 style="font-size:<?php echo $size;?>px; font-style: italic">Lora Italic at <?php echo $size;?>px.</h1>
							<?php endforeach; ?>
						</div>
 						
 						</div>
 						<!-- <hr> -->
 	<!-- 					<div class="row">

						<div class="col-md-6">
							<?php foreach ($header_sizes as $index => $size): ?>
								<h1 style="font-size:<?php echo $size;?>px; font-weight: bold;">Lora Bold at <?php echo $size;?>px.</h1>
							<?php endforeach; ?>
						</div>						

						<div class="col-md-6">
							<?php foreach ($header_sizes as $index => $size): ?>
								<h1 style="font-size:<?php echo $size;?>px; font-weight: bold; font-style: italic;">Lora Bold Italic at <?php echo $size;?>px.</h1>
							<?php endforeach; ?>
						</div>


					</div> -->
			
           <!-- 					<hr>
						<h1>This is a level-one heading (h1)</h1>
						<h3>This is a level-three heading (h3)</h3>
						<p class="lead-copy">This style can be used for the first paragraph of some text content. In CSS, the class to apply is "lead-copy".</p>
						<blockquote><p>The italic version is used for standalone quotes.</p></blockquote> -->


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
					<?php foreach ($copy_sizes as $index => $size): ?>
						<p style="font-size: <?php echo $size;?>px;">Roboto (regular | <b>bold</b> | <i>italic</i> | <b><i>both</i></b>) at <?php echo $size; ?>px.</p>
					<?php endforeach; ?>
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
					<?php foreach($eyebrow_sizes as $index => $size): ?>
						<p class="eyebrow" style="font-size: <?php echo $size; ?>px;">Roboto Condensed at <?php echo $size; ?>px.</p>
					<?php endforeach; ?>
   <!-- 					<p class="eyebrow">This is the default eyebrow styling</p>
					<time class="eyebrow" style="color: #999;">Same style for dates and utility text</time>
					<p class="utility-copy">Smaller when used with the 'utility-copy' class.</p>
					<div class="row center-xs"><div class="module__title"><h2>Also used in level-2 headings</h2></div></div>
					<a class="cta">And in CTAs</a>
					<a class="cta cta--red">Even red ones</a>
 -->
				</div>

			</div>
		</div>
	</div>
</section>


<!-- SVGs / icons -->
<?php $svgs = array('carat', 'close', 'search', 'person', 'squiggle'); ?>
<section class="module">
	<div class="content">
		<header class="module__title">
			<h2>SVG Assets</h2>
		</header>
		<p class="lead-copy">SVGs can scale to any size without getting pixelated, so they're a natural choice for icons and UI elements.</p>

		<p>For the full svg code for these icons, see the file <code>svg.php</code> in the root folder of the Wordpress theme.</p>
		<div class="row swatch-row">

			<?php foreach ( $svgs as $svg_name ): 
			$size_class = ($svg_name == 'squiggle') ? ' col-sm-5' : ' col-sm-2'; ?>
			<div class="swatch-block col-xs-12 <?php echo $size_class; ?>">
				<svg class="icon--<?php echo $svg_name; ?> swatch" role="presentation">
					<use xlink:href="#icon--<?php echo $svg_name; ?>" />
				</svg>
				<span class="swatch-label"><code>icon--<?php echo $svg_name; ?></code></span>
			</div>
		<?php endforeach; ?>

		</div>
  </div>
</section>


<!-- Text copy -->
<section class="module">
	<div class="content">
		<header class="module__title">
			<h2>Copy</h2>
		</header>
		<p class="lead-copy">This paragraph text is larger than normal. It’s generally used at the beginning of a page or section, to introduce the content. Blocks of text in this style shouldn’t be too long.</p>
		<p>This is normal paragraph text. These styles apply to most of the body copy throughout the site. They support styles like <strong>bold</strong> and <em>italic</em> and can contain <a href="#">links</a> to other pages.</p>
		<p>The level-one heading generally just happens once on a page, up in the hero or header area. It’s usually the page’s title. On this page, it's "Style Guide". And here's some filler copy from the PRH site, to show what a larger block of text looks like.</p>
		<p>Physicians for Reproductive Health believes that access to contraception is of vital importance to women’s health because it allows them to determine the timing and spacing of pregnancies. In the medical world, we have studied birth control methods and their effects for decades. We know, based on enormous amounts of scientific evidence, that contraception is crucial to women’s well-being, their children’s health, and their ability to educate themselves, achieve career goals, care for and support their families, and otherwise participate in society. As physicians, we see every day how it improves our patients’ lives.</p>
	</div>
</section>


<!-- Examples with context - not active till I can organize this better. -->
<!-- 
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
	</section> -->


	<!-- <section class="module">
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
-->

<!-- Render out the page content, if there is any. Normal modules first, then page entry, then donate module. -->
<?php 	
	$page = new PageModules( get_the_ID() );
	$_page = $page; // wordpress is altering the value of 'page' when we output the content, so this hacks around that
	$page->init();
	$page->render_hero();
	$page->render_modules();

	if ( have_posts() ): 
		while ( have_posts() ): 
			the_post(); ?>

			<section class="module">
				<div class="content">
				<header class="module__title">
						<h2><?php the_title(); ?></h2>
				</header>
					<?php the_content(); ?>
				</div>
			</section>

		<?php 
		endwhile; 
	endif;  

	$_page->render_donate_module();
	get_footer();
