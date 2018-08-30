<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package prh-wp-theme
 */

$menu_ids = get_nav_menu_locations(); ?>

		<footer id="colophon" class="site-footer footer-module module" role="contentinfo">

			<div class="content">

				<div class="row footer-row">

					<div class="col-xs-12 col-sm-4 footer-col">
						<?php
							$sitemap = wp_get_nav_menu_object( $menu_ids['footer-menu'] );
						?>
						<h4 class="footer-title"><?php echo $sitemap->name; ?></h4>
						<?php wp_nav_menu(array('theme_location' => 'footer-menu',
							'container' => 'nav',
							'container_class' => 'footer-menu-container',
							'menu_class' => 'footer-sitemap')); ?>
					</div>

					<div class="col-xs-12 col-sm-4 footer-col">
						<?php
						$widget_data = prh_get_widget_data_for( 1 )[1];
						?>
						<h4 class="footer-title"><?php echo $widget_data->title; ?></h4>
						<p class="footer-copy"><?php echo $widget_data->text; ?></p>
						<p class="footer-copy"><a class="eyebrow subscribe-link capsule-link" href="<?php echo $widget_data->url; ?>">Subscribe</a>
					</div>

					<div class="col-xs-12 col-sm-4 footer-col">
						<?php
							$social = wp_get_nav_menu_object( $menu_ids['footer-social'] );
						?>
						<h4 class="footer-title"><?php echo $social->name; ?></h4>
						<div class="footer-social social-icons">
							<?php wp_nav_menu(array('theme_location' => 'footer-social',
								'menu_class' => 'footer-social-menu',
								'link_before' => '<span class="visually-hidden">',
								'link_after' => '</span>')); ?>
						</div>
					</div>

				</div>
			</div>
		</footer><!-- #colophon -->

	</div><!-- .page-container-->

	<?php include( locate_template( 'template-parts/components/back-to-top-button.php', false, false)); ?>
	
	<div id="fb-root"></div>
	<?php wp_footer(); ?>

</body>
</html>
