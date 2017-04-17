<?php
get_header(); ?>

<?php $post_type = get_post_type();
			$pt_object = get_post_type_object($post_type);
			$pt_label = $pt_object->labels->singular_name;
?>
<!-- placeholder hero so the content doesn't hit the nav -->
<section class="hero module">
</section>

<main class="main-content post-content module">
	<div class="content">

	<header>
		<h1><?php the_title(); ?></h1>

		<footer class="post-meta eyebrow">
			<span class="post-type"><?php echo $pt_label; ?>s</span>
			<time class="post-date"><?php the_date('M j, Y \a\t g:i A'); ?></time>
		</footer>

		<?phps
			$intro = get_the_excerpt();
			if (!is_generated($intro)) {
				echo '<p class="post-intro">' . $intro . '</p>';
			} ?>
	</header>

		<hr>
		<article class="post-body">
			<?php the_content(); ?>
		</article>

		<hr>

		<footer class="post-byline">
			<?php the_field('post_byline'); ?>
		</footer>
	</div>
</main>



	<?php
		// $page = new PageModules( get_the_ID() );
		// $page->render();
	?>
<?php
get_footer();
