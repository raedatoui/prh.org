<?php
get_header(); ?>

<?php $post_type = get_post_type();
$pt_object = get_post_type_object($post_type);
$pt_label = $pt_object->labels->singular_name;
$date_format = get_option( 'date_format' );
?>

<section class="hero article-hero module">

	<div class="content">
		<div class="row">
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
	</div>

</section>

<main class="module" id="main">
	<div class="content">
		<div class="row row-top">
			<article class="main-content post-content col-xs-12 col-md-8">

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

			<div class="sidebar post-sidebar col-xs-12 col-md-3 col-md-offset-1">

				<!-- Social sharing -->
				<aside class="sidebar-block social-block">
					<div class="sidebar-content sidebar-social">

						<h2 class="sidebar-header">Share</h2>
						<ul class="social-icons">

							<li><a href="http://facebook.com" class="fb-link"><span class="visually-hidden">Share on Facebook</span></a></li>

							<li><a href="https://twitter.com/intent/tweet?url=<?php echo the_permalink(); ?>&text=<?php the_title(); ?>"><span class="visually-hidden">Share on Twitter</span></a></li>

							<li><a href="http://www.tumblr.com/share"><span class="visually-hidden">Share on Twitter</span></a></li>

							<?php 
							$encoded_subject = urlencode('Found this article from Physicians for Reproductive Health');
							$encoded_url = urlencode(get_the_title() . ' - ' . get_the_permalink()); ?>
							<li><a target="_blank" href="mailto:?subject=<?php echo $encoded_subject; ?>&body=<?php echo $encoded_url; ?>"><span class="visually-hidden">Email link</span></a></li>

							<li class="copy-link"><a class="permalink-icon" data-clipboard-text="<?php the_permalink(); ?>"><span class="visually-hidden">Copy link</span></a>
							<div class="copied-link-message" aria-hidden="true">Copied!</div>
							</li>
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
						$email_url = '<a class="contact-link contact-info" href="mailto:' . $email_link . '" rel="author">';
						$phone_url = '<a class="contact-link contact-info" href="tel:' . $phone_link . '" rel="author">';
						?>
						<p class="contact-info"><?php echo $name; ?></p>
						<?php echo_wrapped( $email_link, $email_url, '</a>' ); ?>
						<?php echo_wrapped( $phone_link, $phone_url, '</a>' ); ?>
					</div>
				</aside>

				<!-- Tags -->
				<?php $tags = get_the_tags( $post->ID ); if ( $tags ):  ?>
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

		</div>

		<div class="row">
			<div class="col-xs-12">
				<p class="focus-lead-copy">Latest Articles</p>
			</div>
		</div>

		<div class="row">
			<?php
				$query = get_latest_articles();
				while ($query->have_posts()):
					$query->the_post();
					$link = get_permalink ( $post );
					$postImage = get_the_post_thumbnail_url( $post );
					$post_type = get_post_type( $post ); ?>
					<a class="aggregate-tile col-xs-12 col-md-4" href="<?php echo $link ?>" aria-label="<?php the_title(); ?>">
						<div class="tile__container">
							<div class="tile__type--container">
								<span class="tile__type"><?php echo CONTENT_TYPES_LABELS[$post_type]; ?></span>
								<?php if ( $postImage != '' ) : ?>
									<div class="tile__source">
										<img src="<?php echo $postImage ?>" />
									</div>
								<?php endif; ?>
							</div>
							<date class="tile__date"><?php echo get_the_date($dateFormat, $post); ?></date>
							<h3 class="tile__title"><?php the_title(); ?></h3>
							<div class="tile__summary">
								<p><?php echo sanitize_text_field(get_the_excerpt()); ?></p>
							</div>
						</div>
					</a>
			<?php
				endwhile;
				wp_reset_postdata(); ?>
		</div>
	</div>
</main>

<?php
get_footer();
