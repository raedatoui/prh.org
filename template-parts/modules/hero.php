<section class="hero module">
	<div class="content">
		<?php include( locate_template( 'template-parts/components/module-title.php', false, false ) ); ?>

		<h1 class="hero__header"><?php 
			// Strip auto-added paragraph tags since <h1><p> isn't valid, (but leave any other html intact)
		  echo str_replace(array('<p>', '</p>'), '', $module[HERO_MODULE['header']]);
		?></h1>
		<div class="col-xs-12 hero__subhead"><?php echo $module[HERO_MODULE['text']] ?></div>
		<?php include( locate_template( 'template-parts/components/cta.php', false, false ) ); ?>
	</div>
</section>
