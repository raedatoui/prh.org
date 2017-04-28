<section class="hero module">
	<div class="content">

		<h1 class="hero__header"><?php 
			// Strip auto-added paragraph tags since <h1><p> isn't valid, (but leave any other html intact)
		  echo str_replace(array('<p>', '</p>'), '', $module_title);
		?></h1>
		<p class="hero__subhead">
			<?php foreach ($module[PAGE_HERO_MODULE['jump_links']] as $item): ?>
			<a class="hero__link underline jump" href="#<?php echo $item[PAGE_HERO_MODULE['jump_link_ref']]; ?>"><?php echo  $item[PAGE_HERO_MODULE['jump_link_title']]; ?></a>
			<?php endforeach; ?>
		</p>
	</div>
</section>
