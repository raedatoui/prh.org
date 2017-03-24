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

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'prh-wp-theme' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'prh-wp-theme' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'prh-wp-theme' ), 'prh-wp-theme', '<a href="https://hugeinc.com/" rel="designer">hugeinc.com</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/bundle.js"></script>

<?php wp_footer(); ?>


</body>
</html>
