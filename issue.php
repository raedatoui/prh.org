<?php
/**
 * Template name: Issue Page
 */

get_header(); ?>

<!-- placeholder hero so the content doesn't hit the nav -->
<section class="hero module">
	<div class="content">
	</div>
</section>

<?php

	$page = new PageModules( get_the_ID() );
	$page->render(); ?>

<section class="module">
	<div class="content">


	<section class="accordion-group" id="accordion-group-0" aria-labelledby="accordion-group-0-header" role="group">

	<header class="row center-xs">
		<div class="module__title">
			<h2 id="accordion-group-0-header">Concertinas</h2>
		</div>
	</header>

		<h3 class="accordion-title">English</h3>
		<div class="accordion-content collapsible">
			<p>The English concertina is a member of the concertina family of free-reed musical instruments. Invented in England in 1829, it was the first instrument of what would become the concertina family.</p>

			<p>It is a fully chromatic instrument, having buttons in a rectangular arrangement of four staggered rows; its buttons are unisonoric, producing the same note on both the push and pull of the bellows. It differs from other concertinas in that the scale is divided evenly between the two hands, such that playing a scale involves both hands alternately playing each note in sequence.</p>
		</div>

		<h3 class="accordion-title">Duet</h3>
		<div class="accordion-content">
			<p>The Duet concertina is a family of concertinas, distinguished by being unisonoric (producing the same note on the push and pull of the bellows, unlike the Anglo concertina) and by having their lower notes on the left and higher on the right (unlike the English concertina).</p>

			<p>Instruments built according to various duet systems are the last development step in the history of the instrument and less common than other concertinas. Duet concertina systems aim to simplify playing a melody with an accompaniment. To this end the various duet systems feature single note button layouts that provide the lower (bass) notes in the left hand and the higher (treble) notes in the right, usually with some overlap (like a two-manual organ).</p>
		</div>

		<h3 class="accordion-title">German</h3>
		<div class="accordion-content">
			<p>The German concertinas, developed within Germany itself for its local market and diaspora, tend to be larger than the English or Anglo concertinas. They are generally bisonoric, use a different style of "long plate" reeds, and tend to be square rather than hexagonal. Unlike the English and Anglo, they sometimes have more than one reed per note, creating a vibrato effect.</p>
		</div>
	</section>

	<section class="accordion-group">

	<header class="row center-xs">
		<div class="module__title">
			<h2>Accordions</h2>
		</div>
	</header>


		<h3 class="accordion-title">History</h3>
		<div class="accordion-content">
			<p>The accordion is a free reed instrument and is in the same family as other instruments such as the sheng and khaen. The sheng and khaen are both much older than the accordion and this type of reed did inspire the kind of free reeds in use in the accordion as we know it today.</p>

			<p>The accordion's basic form is believed to have been invented in Berlin in 1822 by Christian Friedrich Ludwig Buschmann, although one instrument has been recently discovered that appears to have been built earlier.</p>
		</div>

		<h3 class="accordion-title">Use</h3>
		<div class="accordion-content">
			<p>The accordion has traditionally been used to perform folk or ethnic music, popular music, and transcriptions from the operatic and light-classical music repertoire. Today the instrument is sometimes heard in contemporary pop styles, such as rock, pop-rock, etc., and occasionally even in serious classical music concerts, as well as advertisements.</p>
		</div>

		<h3 class="accordion-title">Manufacturing</h3>
		<div class="accordion-content">
			<p>The best accordions are always fully hand-made, particularly the reeds; completely hand-made reeds have a far better tonal quality than even the best automatically-manufactured ones. Some accordions have been modified by individuals striving to bring a more pure sound out of low-end instruments, such as the ones improved by Yutaka Usui, a Japanese-born craftsman.</p>

			<p>The manufacture of an accordion is only a partly automated process. In a sense, all accordions are handmade, since there is always some hand assembly of the small parts required. The general process involves making the individual parts, assembling the subsections, assembling the entire instrument, and final decorating and packaging.</p>

			<p>Famous centres of production are the Italian cities of Stradella and Castelfidardo, with many small and medium size manufacturers especially at the latter. Castelfidardo honours the memory of Paolo Soprani who was one of the first large-scale producers. The French town of Tulle has hosted Maugein Freres since 1919, and the company is now the last complete-process manufacturer of accordions in France. German companies such as Hohner and Weltmeister made large numbers of accordions, but production had diminished by the end of the 20th century. Hohner still manufactures its top-end models in Germany, and Weltmeister instruments are still handmade by HARMONA Akkordeon GmbH in Klingenthal. Cheaper /student models are often made in China.</p>
		</div>
	</section>

	</div>
</section>

<?php	get_footer();
