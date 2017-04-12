<?php $module = $this->modules[SPOTLIGHT_1_MODULE['name']]; ?>
<section class="info-module module">
  <div class="content">
  <?php include( locate_template( 'template-parts/components/module-title.php', false, false ) ) ?>
  <div class="module__content columns-1">
    <div class="info-module--component row">
    <?php foreach ( $module[SPOTLIGHT_1_MODULE['card']] as $card ): ?>

      <img class="info-module__img" alt="" src="<?php echo $card[SPOTLIGHT_CARD['image']]['url'] ?>" />
      <div class="info-module__info">
        <h3 class="info-module__title"><?php echo $card[SPOTLIGHT_CARD['headline']] ?></h3>
        <?php if ( $card[SPOTLIGHT_CARD['text']] != '' ) : ?>
          <span class="info-module__text"><?php echo $card[SPOTLIGHT_CARD['text']] ?></span>
        <?php endif; ?>
        <?php if ( $module['config'][MODULE_OPTIONS['use_cta']] ):  ?>
          <?php $cta = $module['config'][MODULE_OPTIONS['cta']][0];  ?>
          <a class="cta" href="<? echo $cta[CTA_COMPONENT['link']];?>">
            <? echo $cta[CTA_COMPONENT['label']]; ?>
          </a>
        <?php endif; ?>
      </div>
      <?php endforeach; ?>

    </div>
  </div>
  </div>
</section>
