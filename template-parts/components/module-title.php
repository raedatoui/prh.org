<?php if ( $module_title != '' ): ?>
	<?php
		$class_name = "module__title";
		$class_name = $class_name . " " . $module_class_name; 
	?>
	<a class="anchor" id="<?php echo sanitize_module_title($module_title); ?>" aria-hidden="true"></a>
	<header class="<?php echo $class_name ?>">
		<?php if ( $show_numbered_titles == true): ?>
			<span><?php echo $module_order . '/' . count($this->keys) ?></span>
		<?php endif; ?>	
		<h2><?php echo $module_title ?></h2>
	</header>
<?php endif; ?>
