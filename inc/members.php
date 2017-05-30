<?php

function prh_remove_user_fields() {
	if ( current_user_can('subscriber') )  : ?>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$('form#your-profile tr.user-admin-color-wrap').remove(); // remove the "Admin Color Scheme" field
				$('form#your-profile tr.user-admin-bar-front-wrap').remove(); // remove the "Toolbar" field
				$('form#your-profile tr.user-nickname-wrap').hide(); // Hide the "nickname" field
				$('table.form-table tr.user-display-name-wrap').remove(); // remove the “Display name publicly as” field
				$('table.form-table tr.user-url-wrap').remove();// remove the "Website" field in the "Contact Info" section
		});</script>
	<?php endif;
}
add_action('admin_head','prh_remove_user_fields');

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

	return $profile_fields;
}
add_filter('user_contactmethods', 'modify_contact_methods');

// Send users to their designated landing page
function redirectOnFirstLogin( $redirect_to, $requested_redirect_to, $user )
{
	return admin_url( 'profile.php' );
    // URL to redirect to
    $redirect_url = 'http://154.0d0.mwp.accessdomain.com/privacy-policy/';
    // How many times to redirect the user
    $num_redirects = 1;
    // Cookie-based solution: captures users who registered within the last n hours
    // The reason to set it as "last n hours" is so that if a user clears their cookies or logs in with a different browser,
    // they don't get this same redirect treatment long after they're already a registered user
    // 172800 seconds = 48 hours
    $message_period = 172800;

    // If they're on the login page, don't do anything
    if( !isset( $user->user_login ) )
    {
        return $redirect_to;
    }

	$is_a_member = false;
	require_once( ABSPATH . 'wp-includes/pluggable.php' );
	if ( $group = Groups_Group::read_by_name( 'LTA' ) ) {
		$is_a_member = Groups_User_Group::read( get_current_user_id() , $group->group_id );
	}
	print_r( $is_a_member);
	if ( ! $is_a_member ) {
		return 'http://154.0d0.mwp.accessdomain.com/';
	} else {
		return 'http://154.0d0.mwp.accessdomain.com/lta-landing-page/';
	}
//    $key_name = 'redirect_on_first_login_' . $user->ID;
//
//    if( strtotime( $user->user_registered ) > ( time() - $message_period )
//        && ( !isset( $_COOKIE[$key_name] ) || intval( $_COOKIE[$key_name] ) < $num_redirects )
//      )
//    {
//        if( isset( $_COOKIE[$key_name] ) )
//        {
//            $num_redirects = intval( $_COOKIE[$key_name] ) + 1;
//        }
//        setcookie( $key_name, $num_redirects, time() + $message_period, COOKIEPATH, COOKIE_DOMAIN );
//        return $redirect_url;
//    }
//    else
//    {
//        return $redirect_to;
//    }
}
//add_filter( 'login_redirect', 'redirectOnFirstLogin', 10, 3 );

function login_action($login) {
	//	print_r(json_encode($user));
}
//add_action( 'wp_login', 'login_action' );

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