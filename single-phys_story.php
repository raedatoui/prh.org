<?php
get_header(); ?>

<?php $post_type = get_post_type();
$pt_object = get_post_type_object($post_type);
$pt_label = $pt_object->labels->singular_name;
$date_format = get_option( 'date_format' );
the_post();
?>

<section class="hero shiny-hero module voc-story" id="hero">
	<div class="content">
		<!-- <a class="anchor" id="<?php echo sanitize_module_title($module_title); ?>" aria-hidden="true"></a> -->
		<header class="module__title">
			<h2>&nbsp;</h2>
		</header>	
		<h1 class="hero__header">
			<?php
				$intro = get_the_excerpt();
				if ( !is_generated( $intro ) ) {
					echo sanitize_text_field($intro);
				} 
			?>
		</h1>
	</div>
</section>

<main class="module story-main-module voc" id="main">
	<div class="content">
	
		<h1 class=""><?php the_title(); ?></h1>
		<footer class="post-meta">
			<time class="post-date"><?php the_date( $date_format ); ?></time>
		</footer>


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

						<h2 class="sidebar-header">Share your story</h2>
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

				<!-- VOC Link -->
				<aside class="sidebar-block media-contact-block">
					<div class="sidebar-content">
						<h2 class="sidebar-header">Tell your story</h2>
						<a class="cta" href="https://prh.org/voicesofcourage">Start here</a>
					</div>
				</aside>

				<!-- Tags -->
				<?php $tags = get_the_tags( $post->ID ); if ( $tags ):  ?>
					<aside class="sidebar-block tags-block">
						<div class="sidebar-content">
							<h2 class="sidebar-header">Keep Reading</h2>
							<ul class="tags-list">
								<?php foreach( $tags as $tag ):  ?>
									<li>
										<a class="tag" href="<?php bloginfo('url' );?>/voicesofcourage?tag=<?php print_r( urlencode($tag->name) );?>">
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
						<a class="cta" href="<?php echo $widget_data->url;?>">Subscribe</a>
					</div>
				</aside>

			</div>

		</div>

	</div>
</main>

<section class="module voc voc-stories latest-articles-module">
	<div class="content">
		<header class="module__title">
			<h2>Latest Stories</h2>
			</header>
		<div class="row macy-grid" id="aggregate-macy-voc">
			<?php
				$args = array(
					'per_page' => 6
				);
				search_and_render_stories( $args ); 
			?>
		</div>
		<div class="row cta-row">
			<a class="cta" href="https://prh.org/voicesofcourage">
				View All Stories
			</a>
		</div>
	</div>
</section>

<?php
get_footer();
