<?php

/**
 * Register the column for modified date
 * @param $columns Wordpress columns for the
 * @return mixed modified columns including the new field.
 */
function prh_post_modified_column_register( $columns ) {
	$columns['post_modified'] = __( 'Modified Date', 'mytextdomain' );
	return $columns;
}
foreach( CONTENT_TYPES as $content_type ) {

	$manage = 'manage_edit-' . $content_type[0] . '_columns';
	add_filter( $manage, 'prh_post_modified_column_register' );
}

/**
 * Display the modified date column content
 * @param $column_name
 * @param $post_id
 */
function prh_post_modified_column_display( $column_name, $post_id ) {
	if ( 'post_modified' != $column_name ){
		return;
	}
	$post_modified = get_post_field('post_modified', $post_id);
	if ( !$post_modified ){
		$post_modified = '' . __( 'undefined', 'mytextdomain' ) . '';
	}
	echo $post_modified;
}
foreach( CONTENT_TYPES as $content_type ) {
	$manage = 'manage_' . $content_type[1] . '_custom_column';
	add_action( $manage, 'prh_post_modified_column_display', 10, 2 );
}

/**
 * Register the modified date column as sortable
 * @param $columns
 * @return mixed
 */
function prh_post_modified_column_register_sortable( $columns ) {
	$columns['post_modified'] = 'post_modified';
	return $columns;
}
foreach( CONTENT_TYPES as $content_type) {
	$manage = 'manage_edit-' . $content_type[0] . '_sortable_columns';
	add_filter( $manage, 'prh_post_modified_column_register_sortable' );
}

/**
 * Action to modify the admin icons for Posts to the same icons for Pages.
 */
function prh_replace_admin_menu_icons_css() {
    ?>
    <style>
		#menu-posts .dashicons-admin-post:before {
			content: "\f105" !important;
		}
    </style>
    <?php
}
add_action( 'admin_head', 'prh_replace_admin_menu_icons_css' );

/**
 * Remove the Post from the sidebar. Post is a built-in type that
 * can't be removed. 
 */
function remove_default_post_type() {
	remove_menu_page('edit.php');
}
add_action('admin_menu','remove_default_post_type');

/**
 * Filter that allows reordering the admin sidebar.
 * @param $menu_ord
 * @return array|bool
 */
function prh_custom_menu_order( $menu_ord ) {
	if ( !$menu_ord ) return true;

	return array(
		'index.php',
		'edit.php?post_type=page', // Pages
		'edit.php?post_type=press_release', // Press Release
		'edit.php?post_type=phys_story', // Stories
		'edit.php?post_type=prh_ipaper', // Legal Publications
		'edit.php?post_type=prh_update', // Updates
		'edit.php?post_type=prh_report', // Reports
		'edit.php?post_type=prh_news', // News
		'edit.php?post_type=prh_events', // Events
		'edit.php?post_type=prh_staff', // Staff
		'separator1', // First separator

		'nav-menus.php',
		'edit.php?post_type=acf-field-group', // Custom Fields
		'upload.php', // Media
		'users.php', // Users
		'separator2', // Second separator

		'themes.php', // Appearance
		'plugins.php', // Plugins
		'options-general.php', // Settings
		'tools.php', // Tools
		'separator-last', // Last separator
	);
}
add_filter( 'custom_menu_order', 'prh_custom_menu_order' );
add_filter( 'menu_order', 'prh_custom_menu_order' );

/**
 * Remove the Menus submenu under Appearance
 */
function remove_submenus() {
	global $submenu;
	unset( $submenu['themes.php'][10] ); // Removes Menu
}
add_action( 'admin_menu', 'remove_submenus' );

/**
 * Add the Menus to the top level and rename it to "Navigation".
 */
function new_nav_menu () {
	global $menu;
	$menu[99] = array( '', 'read', 'separator', '', 'menu-top menu-nav' );
	add_menu_page(
			__( 'Navigation', 'nav-menus' ),
			__( 'Navigation', 'nav-menus' ),
			'edit_themes',
			'nav-menus.php',
			'',
			'dashicons-menu',
			15 );
}
add_action( 'admin_menu', 'new_nav_menu' );