<?php
/**
 * Template name: Article
 */

get_header(); ?>

<!-- placeholder hero so the content doesn't hit the nav -->
<section class="hero module">
  <div class="content">
  <h1><?php the_title(); ?></h1>
  </div>
</section>

<main class="main-content module">
  <div class="content">
  <?php the_content(); ?>
  </div>
</main>

  <?php
    $page = new PageModules( get_the_ID() );
    $page->render();
  ?>
<?php
get_footer();
