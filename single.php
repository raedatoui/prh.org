<?php
get_header(); ?>

<?php $post_type = get_post_type();
			$pt_object = get_post_type_object($post_type);
			$pt_label = $pt_object->labels->singular_name;
?>

<section class="hero article-hero module">

	<header class="col-xs-12 col-md-8">

		<footer class="post-meta">
			<span class="post-type eyebrow"><?php echo $pt_label; ?> | </span>
			<time class="post-date utility-copy"><?php the_date('M j, Y'); ?></time>
		</footer>

		<h1><?php the_title(); ?></h1>

		<?php
			$intro = get_the_excerpt();
			if (!is_generated($intro)) {
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
			<?php the_field('post_byline'); ?>
		</footer>
	</article>

	<div class="sidebar post-sidebar col-xs-12 col-md-3">

		<?php 
		$tags = get_the_tags($post->ID);
		if ($tags):  ?>
			<aside class="sidebar-block tags-block">
				<div class="sidebar-content">
					<h2 class="sidebar-header">Tagged under</h2>
					<ul class="tags-list">
						<?php foreach($tags as $tag):  ?>
							<li>
								<a class="tag" href="<?php bloginfo('url');?>/tag/<?php print_r($tag->slug);?>">
									<?php print_r($tag->name); ?>
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
