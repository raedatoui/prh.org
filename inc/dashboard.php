<?php

// disable default dashboard widgets
function prh_custom_dashboard_widgets() {
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core'); // Comments Widget
	remove_meta_box('dashboard_quick_press','dashboard','side'); //Quick Press widget
}

add_action('wp_dashboard_setup', 'prh_custom_dashboard_widgets');
