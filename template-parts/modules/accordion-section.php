<section class="module">
	<div class="content">

	<?php foreach ( $module[ACCORDION_SECTION['repeater']] as $group ): ?>
		<?php $module_title = $group[ACCORDION_GROUP['title']]; ?>
		<section class="accordion-group" id="<?php echo sanitize_title($module_title); ?>">

			<?php include( locate_template( 'template-parts/components/module-title.php', false, false ) ); ?>

			<?php foreach ( $group[ACCORDION_GROUP['items']] as $item ): ?>
				<h3 class="accordion-title">
					<svg class="icon--minus" role="presentation">
						<use xlink:href="#icon--minus" />
					</svg>

					<svg class="icon--plus" role="presentation">
						<use xlink:href="#icon--plus" />
					</svg>
					<?php echo $item[ACCORDION_ITEM['title']]; ?></h3>
				<div class="accordion-content main-content">
					<?php echo $item[ACCORDION_ITEM['content']]; ?>
				</div>
			<?php endforeach; ?>

		</section>
	<?php endforeach; ?>

	</div>
</section>
