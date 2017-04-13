<?php
/**
 * Template name: Issue Page
 */

get_header(); ?>
  <?php
  while (have_posts()): the_post();
    $groups = acf_get_field_groups();
    $modules = array();
    foreach( $groups as $group_key => $group ) {
      $module = acf_get_fields($group);
      $key = $group['title'];
      $modules[$key] = array('module_name' => $group['title']);
      foreach($module as $field_name => $field ) {
        $f = $field['name'];
        $modules[$key][$f] = get_field($f);
      }
    }
    $page = new PageModules($modules);
    $page->render();
  endwhile; // End of the loop. ?>
<?php
get_footer();
