<?php
/**
 * prh-wp-theme Theme Customizer
 *
 * @package prh-wp-theme
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function prh_wp_theme_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
}
add_action( 'customize_register', 'prh_wp_theme_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function prh_wp_theme_customize_preview_js() {
	wp_enqueue_script( 'prh_wp_theme_customizer', get_template_directory_uri() . '/js/admin/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'prh_wp_theme_customize_preview_js' );
