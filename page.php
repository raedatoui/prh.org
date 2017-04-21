<?php
get_header(); ?>

<?php $post_type = get_post_type();
			$pt_object = get_post_type_object($post_type);
			$pt_label = $pt_object->labels->singular_name;
?>
<!-- placeholder hero so the content doesn't hit the nav -->
<section class="hero module">
</section>

<main class="content module row row-top">

	<header class="col-md-12">
		<h1><?php the_title(); ?></h1>

		<footer class="post-meta">
			<span class="post-type eyebrow"><?php echo $pt_label; ?> | </span>
			<time class="post-date eyebrow"><?php the_date('M j, Y \a\t g:i A'); ?></time>
		</footer>

		<?php
			$intro = get_the_excerpt();
			if (!is_generated($intro)) {
				echo '<p class="post-intro lead-copy">' . $intro . '</p>';
			} ?>
	</header>

	<article class="main-content post-content col-md-9">
			
			<div class="post-body">
				<?php the_content(); ?>
			</div>

			<hr>

			<footer class="post-byline">
				<?php the_field('post_byline'); ?>
			</footer>
	</article>

	<div class="sidebar post-sidebar col-md-3"></div>

</main>


<?php
get_footer();
