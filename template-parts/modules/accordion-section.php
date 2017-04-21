<section class="module">
	<div class="content">

	<?php foreach ( $module[ACCORDION_SECTION['repeater']] as $group ): ?>
		<section class="accordion-group">
			<header class="row row-center-xs">
				<div class="module__title">
					<h2><?php echo $group[ACCORDION_GROUP['title']]; ?></h2>
				</div>
			</header>

			<?php foreach ( $group[ACCORDION_GROUP['items']] as $item ): ?>
				<h3 class="accordion-title">
					<svg class="icon--minus" role="presentation">
						<use xlink:href="#icon--minus" />
					</svg>

					<svg class="icon--plus" role="presentation">
						<use xlink:href="#icon--plus" />
					</svg>
					<?php echo $item[ACCORDION_ITEM['title']]; ?></h3>
				<div class="accordion-content">
					<?php echo $item[ACCORDION_ITEM['content']]; ?>
				</div>
			<?php endforeach; ?>

		</section>
	<?php endforeach; ?>

	</div>
</section>
