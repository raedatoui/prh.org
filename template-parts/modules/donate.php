<?php
// We can't set a default for an image field, but we'll provide a fallback in case they don't fill it out.
// Better experience than making it mandatory, since the image is 
// probably not going to change much page-to-page (or over time).

$donate_bg = $module[DONATE_MODULE['image']] ? 
                     $module[DONATE_MODULE['image']] : 
                     get_template_directory_uri() . '/images/optimized/donate-module.jpg';?>

<section class="module donate-module" style="background-image: url(<?php echo $donate_bg; ?>);" id="donate-module">

  <div class="center-xs donate-content">

    <h2 class="donate-header">
      <?php echo $module[DONATE_MODULE['headline']]; ?>
    </h2>

    <p class="donate-copy">
      <?php echo $module[DONATE_MODULE['text']]; ?>
    </p>

    <div class="cta-row center-xs donate-cta">
		<?php $url = $module[DONATE_MODULE['cta_url']]; ?>
      <a class="cta cta--red" href="<?php echo $url; ?>" target="<?php get_url_target( $url ); ?>"><?php echo $module[DONATE_MODULE['cta_text']]; ?></a>
    </div>

  </div>

</section>
