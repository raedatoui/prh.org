<?php

function prh_remove_user_fields()
{
	$hide_css = "<style>";
	$hide_css .= "tr.user-url-wrap{ display: none; }";
	if ( current_user_can('subscriber') )  {
		$hide_css = $hide_css . "tr.user-admin-color-wrap, tr.user-nickname-wrap, tr.user-display-name-wrap { display: none; }";
	}
	$hide_css = $hide_css . "</style>";
	echo $hide_css;
}
add_action( 'admin_head-user-edit.php', 'prh_remove_user_fields' );
add_action( 'admin_head-profile.php',   'prh_remove_user_fields' );


// methods for adding fields to user profiles
function modify_contact_methods($profile_fields) {
	// Add new fields
	$profile_fields['occupation'] = 'Occupation';
	$profile_fields['medical-speciality'] = 'Medical Specialty';
	$profile_fields['address-1'] = 'Address 1';
	$profile_fields['address-2'] = 'Address 2';
	$profile_fields['city'] = 'City';
	$profile_fields['state'] = 'State';
	$profile_fields['zipcode'] = 'Zipcode';
	unset( $profile_fields['googleplus'] );
	unset( $profile_fields['twitter'] );
	unset( $profile_fields['facebook'] );

	return $profile_fields;
}
add_filter('user_contactmethods', 'modify_contact_methods');

// Send users to their designated landing page
function prh_redirect_first_login( $redirect_to, $requested_redirect_to, $user )
{
	// If they're on the login page, don't do anything
	if( !isset( $user->user_login ) ) {
		return $redirect_to;
	}

	$is_lta_member = false;
	$is_ps_member = false;
	require_once( ABSPATH . 'wp-includes/pluggable.php' );
	if ( $group = Groups_Group::read_by_name( 'LTA' ) ) {
		$is_lta_member = Groups_User_Group::read( $user->ID , $group->group_id );
	}
	if ( $group = Groups_Group::read_by_name( 'PS' ) ) {
		$is_ps_member = Groups_User_Group::read( $user->ID , $group->group_id );
	}

	if ( ! $is_lta_member && ! $is_ps_member) {
		return admin_url( 'index.php' );
	} else {
		if ( $is_lta_member ) {
			return '/leadership-training-academy-class-2018';
		}
		if ( $is_ps_member ) {
			return '/ps-welcome-page';
		}
	}
}
add_filter( 'login_redirect', 'prh_redirect_first_login', 10, 3 );



function prh_change_private_title_prefix() {
	return '%s';
}
add_filter('private_title_format', 'prh_change_private_title_prefix');

// utility to check if the current user belongs to a given group.
function is_member( $group ) {
	$is_a_member = false;
	require_once( ABSPATH . 'wp-includes/pluggable.php' );
	if ( $group = Groups_Group::read_by_name( $group ) ) {
		$is_a_member = Groups_User_Group::read( get_current_user_id() , $group->group_id );
	}
	return $is_a_member;
}
