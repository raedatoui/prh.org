<?php
get_header(); ?>

<?php $post_type = get_post_type();
			$pt_object = get_post_type_object($post_type);
			$pt_label = $pt_object->labels->singular_name;
			$date_format = get_option( 'date_format' );
?>

<section class="hero article-hero module">

	<div class="content row hero-content">
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
	</div>

</section>

<main class="content module row row-top" id="main">

	<article class="main-content post-content col-xs-12 col-md-9">

		<div class="post-body">
			<?php the_content(); ?>
		</div>

		<?php
			$byline_enabled = get_field( 'article_details_enabled');
			if ( $byline_enabled ) : ?>
				<footer class="post-byline">
					<?php the_field( 'post_byline' ); ?>
				</footer>
			<?php endif; ?>
	</article>

	<div class="sidebar post-sidebar col-xs-12 col-md-3">

		<!-- Social sharing -->
		<aside class="sidebar-block social-block">
			<div class="sidebar-content sidebar-social">

				<h2 class="sidebar-header">Share</h2>
				<ul class="social-icons">
					<li><a href="https://twitter.com/intent/tweet?url=<?php echo the_permalink(); ?>&text=<?php the_title(); ?>"><span class="visually-hidden">Share on Twitter</span></a></li>
					<li><a href="http://facebook.com" class="fb-link"><span class="visually-hidden">Share on Facebook</span></a></li>
					<li><a href="mailto:"><span class="visually-hidden">Email link</span></a></li>
				</ul>
			</div>
		</aside>

		<!-- Media contact -->
		<aside class="sidebar-block media-contact-block">
		<div class="sidebar-content">
			<h2 class="sidebar-header">Media contact</h2>
			<?php
				$show_media_contact = get_field( 'media_contact_enabled' );
				if ( $show_media_contact ) {
					$email_link = get_field( 'media_contact_email' );
					$phone_link = get_field( 'media_contact_phone' );
					$name = get_field('media_contact_name');
				} else {
					$widget_data = prh_get_widget_data_for( 1 )[0];
					$name = $widget_data->name;
					$email_link = $widget_data->email;
					$phone_link = $widget_data->phone;
				}
				$email_url = '<a class="contact-link" href="mailto:' . $email_link . '" rel="author">';
				$phone_url = '<a class="contact-link" href="tel:' . $phone_link . '" rel="author">';
			?>
			<p><?php echo $name; ?></p>
			<?php echo_wrapped( $email_link, $email_url, '</a>' ); ?>
			<?php echo_wrapped( $phone_link, $phone_url, '</a>' ); ?>
		</div>
	</aside>

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
										<?php print_r( $tag->name . ' (' . $tag->count . ')' ); ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</aside>
			<?php endif; ?>

		<!-- Subscribe -->
		<aside class="sidebar-block subscribe-block">
			<?php $widget_data = prh_get_widget_data_for( 1 )[1]; ?>
			<div class="sidebar-content">
				<h2 class="sidebar-header"><?php echo $widget_data->title; ?></h2>
				<a class="cta" href="<? echo $widget_data->url;?>">Subscribe</a>
			</div>
		</aside>

	</div>

</main>

<?php
get_footer();
