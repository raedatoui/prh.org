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
  ?>
    <section class="hero">
      <div class="page-content">
        <div class="section-title">
          <h3>OUR PURPOSE</h3>
        </div>
        <div class="hero-grid row">
          <div class="col-xs-12 hero-device-title">OUR PURPOSE</div>
          <?php the_content(); ?>
        </div>
      </div>
    </section>
  <?php
    endwhile; // End of the loop.
  ?>

  <section class="featured" class="page-content">
    <div class="section-title-dk">
      <h3 class="dk-blue">FEATURED</h3>
    </div>
    <div class="hero-grid row">
      <div class="col-xs-12 hero-item">a</div>
      <div class="col-xs-12 hero-item">b</div>
    </div>
  </section>

  <section class="our-focus" class="page-content">
    <div class="section-title-dk">
      <h3 class="dk-blue">OUR FOCUS</h3>
    </div>
    <div class="hero-grid row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 hero-item">a</div>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 hero-item">b</div>
    </div>
  </section>


</div><!-- .page-container-->

<?php

get_footer();
