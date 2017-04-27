<?php
/**
 * Template name: Issue Page
 */

get_header(); ?>

<!-- placeholder hero so the content doesn't hit the nav -->
<section class="hero module">
	<div class="content">
	</div>
</section>

<?php
	$page = new PageModules( get_the_ID() );
	$page->render();
?>


<section class="routing module">
  <div class="content">

  <div class="row">
    
    <?php $count = 0;
      while ($count < 3): ?>
    <div class="col-xs-12 col-md-4">
      <div class="routing-block">

        <h3 class="routing-title">Title</h3>

        <div class="routing-content">
          <p>Content content content. Blah blah blah.</p>
        </div>

        <div class="routing-ctas">
          <a href="#">Link to something</a>
          <a href="#">Another link to something</a>
        </div>

      </div>
    </div>
    <?php $count++; endwhile; ?>


  </div>

  </div>
</section>


<?php	get_footer(); ?>
