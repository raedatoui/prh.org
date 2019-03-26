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
	<div class="content">
		<p class="hero__subhead"></p>
	</div>
</section>

<section class="loader">
    <div class="lds-ellipsis">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
</section>
<section class="loader"></section>