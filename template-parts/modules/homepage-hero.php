<section class="hero module shiny-hero" id="hero">
<?php include( locate_template( 'template-parts/modules/action-alert.php', false, false ) ); ?>
  <div class="content">
    <?php include( locate_template( 'template-parts/components/module-title.php', false, false ) ); ?>
		<h1 class="hero__header"><?php 
			// Strip auto-added paragraph tags since <h1><p> isn't valid, (but leave any other html intact)
		  echo str_replace(array('<p>', '</p>'), '', $module[HOMEPAGE_HERO_MODULE['header']]);
		?></h1>
		<p class="hero__subhead"><?php echo $module[HOMEPAGE_HERO_MODULE['text']] ?></p>
	</div>
</section>
