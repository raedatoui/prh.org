<?php
/**
 * Template Name: Homepage
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package prh-wp-theme
 */

get_header();?>


<?php
	while (have_posts()): the_post();
		$groups = acf_get_field_groups();
		$modules = array();
		foreach( $groups as $group_key => $group ) {
			$module = acf_get_fields($group);
			$key = $group['title'];
			$modules[$key] = array('module_name' => $group['title']);
			foreach($module as $field_name => $field ) {
			  $f = $field['name'];
			  $modules[$key][$f] = get_field($f);
			}
		}
		$page = new PageModules($modules);
//		echo "<pre><code>";
//		$posts = $query->posts;
//		foreach($posts as $post) {
//			echo $post->post_date . "<br>";
//		}
//		print_r($page->modules);
//		echo "</code></pre>";

		$page->render();
	endwhile; // End of the loop. ?>

	<section class="physician-perspectives module module__aggregate-card page-content">
		<div class="module__title">
			<h2>Our Expert Opinions</h2>
		</div>
		<div class="module__content">
			<div class="row">
				<a class="aggregate-tile col-xs-12 col-md-4" href="#">
					<div class="tile__container">
						<div class="tile__type--container">
							<span class="tile__type">Press Release</span>
							<div class="tile__source">
								<img src="<?php echo_theme_uri(); ?>/images/optimized/icon_source-huffpo.jpg" />
							</div>
						</div>
						<date class="tile__date">Mar 2, 2017</date>
						<h3 class="tile__title">Texas bill would allow OBs to withhold information from pregnant women</h3>
						<span class="tile__summary">The Texas Senate Committee and State Affairs voted this week to advance a controversial bill that would prevent parents from suing their care provider if their baby is born with disabilities, even if their doctor discovered the fetus’ condition and failed to disclose it.</span>
					</div>
				</a>

				<a class="aggregate-tile col-xs-12 col-md-4" href="#">
					<div class="tile__container">
						<div class="tile__type--container">
							<span class="tile__type">Press Release</span>
							<div class="tile__source"></div>
						</div>
						<date class="tile__date">Feb 24, 2017</date>
						<h3 class="tile__title">Purveyor of anti-choice misinformation working on Trump's abortion policy</h3>
						<span class="tile__summary">Katy Talentio, a member of Trump's Domestic Policy Council, revealed yesterday a background in </span>
					</div>
				</a>

				<a class="aggregate-tile col-xs-12 col-md-4" href="#">
					<div class="tile__container">
						<div class="tile__type--container">
							<span class="tile__type">Press Release</span>
							<div class="tile__source"></div>
						</div>
						<date class="tile__date">Feb 27, 2017</date>
						<h3 class="tile__title">The health effects of rescinding trans Title IX protection</h3>
						<span class="tile__summary">Last night, Donald Trump rescinded Obama's Title IX measures that increase protection for transgender youth.</span>
					</div>
				</a>

			</div>
			<div class="row">
				<a class="cta" href="#">See More</a>
			</div>
		</div>
	</section>
</div><!-- .page-container-->

<?php

get_footer();
