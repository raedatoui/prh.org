<?php
/**
 * Template name: Article
 */

get_header(); ?>

<!-- placeholder hero so the content doesn't hit the nav -->
<section class="hero module">
</section>

<main class="main-content module">
  <div class="content">

  <header>
  <h1><?php the_title(); ?></h1>
  <time class="article-date"><?php the_date('M j, Y \a\t g:i A'); ?></time>
  </header>

  <?php the_content(); ?>
  </div>
</main>

  <?php
    $page = new PageModules( get_the_ID() );
    $page->render();
  ?>
<?php
get_footer();
