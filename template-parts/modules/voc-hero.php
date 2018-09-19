<?php
	$hero_bg = "";
	$hero_class_name = "hero module shiny-hero"; 
	if ($banner) {
		$hero_bg = "background-image: url(" . $banner . "),linear-gradient(to bottom, #2179bd 25%, #2a548c 100%)";
	}
	if ($class_name) {
		$hero_class_name = $hero_class_name . " " . $class_name;
	}
	
?>

<a id="hero" class="anchor"></a>
<section class="<?php echo $hero_class_name ?>" style="<?php echo $hero_bg ?>" id="hero">
	<?php if ($show_alert) : ?>
		<div class="action-alert voc" id="alert-banner">
			
			<div>Thank you for your submission</div>
			
			<button class="close-alert" id="close-alert" aria-label="Hide this message" title="Hide this message">
				<svg class="icon--close" role="presentation">
					<use xlink:href="#icon--close" />
				</svg>
			</button>
		</div>
	<?php endif; ?>

	<div class="content">
		<header class="module__title">
			<h2>&nbsp;</h2>
		</header>	
		<h1 class="hero__header">&nbsp;</h1>
		<p class="hero__subhead">
			<?php foreach ($module[VOC_HERO_MODULE['jump_links']] as $item): ?>
			<a class="hero__link jump-link" href="#<?php echo $item['slug']; ?>"><?php echo $item['pretty']; ?></a>
			<?php endforeach; ?>
		</p>
	</div>
</section>
