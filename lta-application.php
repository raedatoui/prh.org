<?php
/**
 * Template name: LTA Application
 */

get_header();

$page = new PageModules( get_the_ID(), false, true );
// determines the header for an about us or issue page
$hero_banner_name = MODULES['Page Hero Banner']['name'];
$hero_banner = $page->modules[$hero_banner_name];
$banner = false;
if ($hero_banner) {
    $hero_banner_image_name = MODULES['Page Hero Banner']['image'];
    $banner = $hero_banner[$hero_banner_image_name]['url'];
}
$page->init();
$page->hero = array(
    'module_name' => 'Page Hero',
    'config' => LTA_HERO_MODULE,
    'hero_jump_links' => $page->jump_links(),
    'banner' => $banner,
    'class_name' => 'lta'
);
$page->render();

get_footer();