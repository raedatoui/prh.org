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
		<p class="hero__subhead"></p>
		<p class="hero__subhead"></p>
		<h1 class="hero__header">
			<div>Real <span>stories.</span> Real <span>life.</span></div>
			<div class="header__subhead">Voices of courage</div>
		</h1>
	</div>
</section>
