<?php 
$module_slug = 'accordion-section';
if ($module['config']['module_title'] !== null):
	$module_slug = sanitize_module_title($module['config']['module_title']);
endif;
?>
<section class="module">
	<div class="content">
	<a class="anchor" id="<?php echo $module_slug; ?>" aria-hidden="true"></a>

	<?php foreach ( $module[ACCORDION_SECTION['repeater']] as $group ): ?>
		<?php $module_title = $group[ACCORDION_GROUP['title']]; ?>
		<section class="accordion-group">

			<?php include( locate_template( 'template-parts/components/module-title.php', false, false ) ); ?>

			<?php foreach ( $group[ACCORDION_GROUP['items']] as $item ): ?>
				<h3 class="accordion-title">
					<svg class="icon--minus" role="presentation">
						<use xlink:href="#icon--minus" />
					</svg>

					<svg class="icon--plus" role="presentation">
						<use xlink:href="#icon--plus" />
					</svg>
					<?php echo $item[ACCORDION_ITEM['title']]; ?>
				</h3>
				<div class="accordion-content main-content">
					<?php echo $item[ACCORDION_ITEM['content']]; ?>
				</div>
			<?php endforeach; ?>

		</section>
	<?php endforeach; ?>

     <?php include( locate_template( 'template-parts/components/cta.php', false, false ) ); ?>

	</div>
</section>
