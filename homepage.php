<?php
/**
 * Template Name: Homepage
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package prh-wp-theme
 */

get_header();?>

<?php
	while (have_posts()): the_post();
		$page = new PageModules( get_the_ID() );
		$page->render();
	endwhile; // End of the loop. ?>

  <section class="routing module">
  <div class="content">

  <header class="row center-xs">
    <div class="module__title">
      <h2>Our Focus</h2>
    </div>
  </header>

  <div class="row routing-row">
    
    <?php $count = 0;
      while ($count < 3): ?>
    <div class="col-xs-12 col-md-4">
      <div class="routing-block">

        <div class="routing-content">
        <h3 class="routing-title">Title</h3>
          <p>Content content content. Blah blah blah.</p>
        </div>

        <div class="routing-ctas">
          <a class="cta--link" href="#">Link to something</a>
          <a class="cta--link" href="#">Another link to something</a>
        </div>

      </div>
    </div>
    <?php $count++; endwhile; ?>


  </div>

  </div>
</section>


<?php
get_footer();
