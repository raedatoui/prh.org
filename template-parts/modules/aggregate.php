<?php
	$query = $module['query'];

?>
<section class="module module__aggregate-card">
	<div class="content">
		<?php include( locate_template( 'template-parts/components/module-title.php', false, false ) ); ?>
		<div class="row macy-grid" id="aggregate-macy-<?php echo $module['config']['module_order']; ?>">
			<?php include( locate_template( 'template-parts/components/content-cards.php', false, false ) ); ?>
		</div>
		<?php include( locate_template( 'template-parts/components/cta.php', false, false ) ); ?>
	</div>
</section>
