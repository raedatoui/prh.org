<?php

add_filter('acf/settings/save_json', 'prh_acf_json_save_point');

function prh_acf_json_save_point( $path ) {
	// update path
	$path = get_stylesheet_directory() . '/acf-json';

	// return
	return $path;
}

add_filter('acf/settings/load_json', 'prh_acf_json_load_point');

function prh_acf_json_load_point( $paths ) {
	// remove original path (optional)
	unset($paths[0]);

	// append path
	$paths[] = get_stylesheet_directory() . '/acf-json/';

	// return
	return $paths;
}


/**
 * This function sync the media contact fields when the user changes the name.
*/
function prh_sync_media_contact_values()
{
	?>
	<script type="text/javascript">
	(function($){
		$('*[data-name="media_contact_name"] select').change(function(){
			var selectedIndex = $(this)[0].selectedIndex;
			$('*[data-name="media_contact_email"] select').prop('selectedIndex', selectedIndex);
			$('*[data-name="media_contact_phone"] select').prop('selectedIndex', selectedIndex);
		});
	})(jQuery);
	</script>
	<?php
}

add_action('acf/input/admin_footer', 'prh_sync_media_contact_values');

/**
 * This function disables the email and phone fields of the Media Contact
 * group allowing them to sync with the name changes.
 */
function prh_disable_media_contact_fields(){
	?>
	<script type="text/javascript">
	(function($) {
		$(document).ready(function(){
			$('*[data-name="media_contact_email"] select').css('pointer-events', 'none');
			$('*[data-name="media_contact_phone"] select').css('pointer-events', 'none');
  		});
	})(jQuery);
	</script>
	<?php
}
add_action('admin_print_footer_scripts', 'prh_disable_media_contact_fields');
