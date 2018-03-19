<?php
	$hero_bg = "";
	if ($banner) {
		$hero_bg = "background-image: url(" . $banner . "),linear-gradient(to bottom, #2179bd 25%, #2a548c 100%)";
	}
?>

<a id="hero" class="anchor"></a>
<section class="hero module shiny-hero" style="<?php echo $hero_bg ?>">
	<div class="content">
		<h1 class="hero__header"><?php
			// Strip auto-added paragraph tags since <h1><p> isn't valid, (but leave any other html intact)
		  echo str_replace(array('<p>', '</p>'), '', $module_title);
		?></h1>
		<p class="hero__subhead">
			<?php foreach ($module[PAGE_HERO_MODULE['jump_links']] as $item): ?>
			<a class="hero__link jump-link" href="#<?php echo $item['slug']; ?>"><?php echo $item['pretty']; ?></a>
			<?php endforeach; ?>
		</p>
	</div>
</section>
