<?php
  $options = get_option( 'prh_settings' );
  $enabled = $options['action_alert_enabled'];
  $text = $options['action_alert_text'];
  $url = $options['action_alert_url'];
  $expires = strtotime($options['action_alert_expires']);

  if ($enabled):
    if ( !is_alert_expired() ):
  ?>

<div class="action-alert">
  <a href="<?php echo $url; ?>">
    <span class="eyebrow alert-title">Urgent Action</span>
    <?php echo $text; ?>
  </a>
</div>

<?php endif; endif; ?>
