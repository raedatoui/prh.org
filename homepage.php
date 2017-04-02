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
      $groups = acf_get_field_groups();
      $modules = array();
      foreach( $groups as $group_key => $group ) {
        $module = acf_get_fields($group);
        $key = $group['title'];
        $modules[$key] = array();
        foreach($module as $field_name => $field ) {
          $f = $field['name'];
          $modules[$key][$f] = get_field($f);
        }
      }
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

    <section class="featured-carousel module">
      <div class="page-content">
        <div class="section-title-dk">
          <h3 class="dk-blue"><?php echo $modules[CAROUSEL_MODULE['name']][CAROUSEL_MODULE['header']] ?></h3>
        </div>
        <div class="hero-grid row">
          <div class="carousel">
            <?php
            $images =  $modules[CAROUSEL_MODULE['name']][CAROUSEL_MODULE['images']];
            foreach($images as $index => $image ): ?>
            <div class="slide slide-<?php echo ($index+1) ?>">
              <a href="<?php echo $image['link']?>"><img src="<?php echo $image['image']['url'] ?>" alt="" /></a>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
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

  <?php
    endwhile; // End of the loop.
  ?>
</div><!-- .page-container-->

<?php

get_footer();
