<?php
get_header(); ?>

<?php $post_type = get_post_type();
			$pt_object = get_post_type_object($post_type);
			$pt_label = $pt_object->labels->singular_name;
?>

<section class="hero article-hero module">

	<div class="content row hero-content">
		<header class="col-xs-12 col-md-8">

			<h1><?php the_title(); ?></h1>

		</header>
	</div>

</section>


<main class="content module row row-top" id="main">

	<article class="main-content post-content col-xs-12 col-md-9">

		<div class="post-body">
			<?php the_content(); ?>
		</div>


	</article>

	<div class="sidebar post-sidebar col-xs-12 col-md-3">

		<!-- Media contact -->
		<?php
		$show_media_contact = get_field( 'media_contact_enabled' );
		if ( $show_media_contact ) : ?>
			<?php
				$email_link = get_field( 'media_contact_email' );
				$phone_link = get_field( 'media_contact_phone' );
				$label = get_field('media_contact_label');
				$name = get_field('media_contact_name');
				$email_url = '<a class="contact-link" href="mailto:' . $email_link . '" rel="author">';
				$phone_url = '<a class="contact-link" href="tel:' . $phone_link . '" rel="author">'; ?>
			<aside class="sidebar-block media-contact-block">
				<div class="sidebar-content">
					<h2 class="sidebar-header"><?php echo $label; ?></h2>
					<p><?php echo $name; ?></p>
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

