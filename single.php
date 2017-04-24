<?php
get_header(); ?>

<?php $post_type = get_post_type();
			$pt_object = get_post_type_object($post_type);
			$pt_label = $pt_object->labels->singular_name;
			$date_format = get_option( 'date_format' );
?>

<section class="hero article-hero module">

	<header class="col-xs-12 col-md-8">

		<footer class="post-meta">
			<span class="post-type eyebrow"><?php echo $pt_label; ?> | </span>
			<time class="post-date utility-copy"><?php the_date( $date_format ); ?></time>
		</footer>

		<h1><?php the_title(); ?></h1>

		<?php
			$intro = get_the_excerpt();
			if ( !is_generated( $intro ) ) {
				echo '<p>' . $intro . '</p>';
			} ?>
	</header>

</section>

<main class="content module row row-top">



	<article class="main-content post-content col-xs-12 col-md-9">

		<div class="post-body">
			<?php the_content(); ?>
		</div>

		<footer class="post-byline">
			<?php the_field( 'post_byline' ); ?>
		</footer>
	</article>

	<div class="sidebar post-sidebar col-xs-12 col-md-3">

	<!-- Media contact -->
	<?php
		$show_media_contact = get_field('media_contact_enabled');
		if ( $show_media_contact ):
			$email_link = get_field('media_contact_email');
			$phone_link = get_field('media_contact_phone');
			$email_url = '<a class="contact-link" href="mailto:' . $email_link . '" rel="author">';
			$phone_url = '<a class="contact-link" href="tel:' . $phone_link . '" rel="author">';
		?>

		<aside class="sidebar-block media-contact-block">
			<div class="sidebar-content">
				<h2 class="sidebar-header">Media contact</h2>
				<?php echo_wrapped( $email_link, $email_url, '</a>' ); ?>
				<?php echo_wrapped( $phone_link, $phone_url, '</a>' ); ?>
			</div>
		</aside>
	<?php endif; ?>


	<!-- Tags -->
	<?php 
		$tags = get_the_tags( $post->ID );
		if ( $tags ):  ?>
			<aside class="sidebar-block tags-block">
				<div class="sidebar-content">
					<h2 class="sidebar-header">Tagged under</h2>
					<ul class="tags-list">
						<?php foreach( $tags as $tag ):  ?>
							<li>
								<a class="tag" href="<?php bloginfo('url' );?>/tag/<?php print_r( $tag->slug );?>">
									<?php print_r( $tag->name . ' ' . $tag->count ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</aside>
		<?php endif; ?>

	</div>
</main>

<?php
get_footer();
