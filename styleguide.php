<?php
/**
 * Template name: Styleguide
 *
 * @package prh-wp-theme
 */

get_header(); ?>


<section class="hero module">
	<div class="content">
		<h1 class="hero__header">Style Guide</h1>
		<div class="col-xs-12 hero__subhead">An inventory of global patterns.</div>
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
