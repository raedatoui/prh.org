<?php
$options = get_option( 'prh_settings' );
if ( isset($options['action_alert_enabled'] ) ) {
	$enabled = $options['action_alert_enabled'];
} else {
	$enabled = false;
}

$text = $options['action_alert_text'];
$url = $options['action_alert_url'];
$expires = strtotime($options['action_alert_expires']);
$cookie = $_COOKIE;

if ( isset($cookie['alertClosed']) && $cookie['alertID'] == $options['action_alert_timestamp'] 
	|| !$enabled 
	|| is_alert_expired() ) {
	return;
}
?>

<div class="action-alert" id="alert-banner" data-timestamp="<?php echo $options['action_alert_timestamp']; ?>">
	<a href="<?php echo $url; ?>">
		<span class="eyebrow alert-title">Urgent Action</span>
		<?php echo $text; ?>
	</a>
	<button class="close-alert" id="close-alert" aria-label="Hide this message" title="Hide this message">
		<svg class="icon--close" role="presentation">
			<use xlink:href="#icon--close" />
		</svg>
	</button>
</div>

