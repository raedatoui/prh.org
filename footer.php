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
?>

    <footer id="colophon" class="site-footer footer-module module" role="contentinfo">

    <div class="content">
      <div class="row footer-row">

      <div class="col-xs-12 col-lg-4 footer-col">
        <h4 class="eyebrow footer-eyebrow">Sitemap</h4>
        <?php wp_nav_menu(array('theme_location' => 'footer-menu',
                                'container' => 'nav',
                                'container_class' => 'footer-menu-container', 
                                'menu_class' => 'footer-sitemap')); ?>
      </div>

      <div class="col-xs-12 col-lg-4 footer-col">
        <h4 class="footer-title">Stay Informed</h4>
        <p class="footer-copy">We deliver breaking news and reproductive justice opportunities straight to your inbox.</p>
        <p class="footer-copy"><a class="eyebrow subscribe-link" href="#">Subscribe</a>
      </div>

      <div class="col-xs-12 col-lg-4 footer-col">
        <h4 class="footer-title">Join the Conversation</h4>
        <ul class="footer-social social-icons">
          <?php wp_nav_menu(array('theme_location' => 'footer-social',
                                  'menu_class' => 'footer-social-menu',
                                  'link_before' => '<span class="visually-hidden">',
                                  'link_after' => '</span>')); ?>
        </ul>
      </div>

    </div>

    </footer><!-- #colophon -->

	</div><!-- .page-container-->

	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/bundle.js"></script>

	<?php wp_footer(); ?>

</body>
</html>
