<?php if ( $module_title != '' ): ?>
  <a class="anchor" id="<?php echo sanitize_module_title($module_title); ?>" aria-hidden="true"></a>
  <header class="module__title">
  	<h2><?php echo $module_title ?></h2>
  </header>
<?php endif; ?>
