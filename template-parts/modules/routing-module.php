 <section class="routing module">
  <div class="content">

    <?php include( locate_template( 'template-parts/components/module-title.php', false, false ) ); ?>

    <div class="row routing-row">
      
      <?php foreach ( $module[ROUTING_MODULE['repeater']] as $index => $block ): ?>
      <div class="col-xs-12 col-md-4">
        <div class="routing-block">

          <div class="routing-content">
            <h3 class="routing-title">
              <?php echo $block[ROUTING_BLOCK['title']]; ?>
            </h3>
            <?php echo_wrapped($block[ROUTING_BLOCK['text']], '<p>', '</p>'); ?>
          </div>

          <div class="routing-ctas">

            <?php foreach ( $block[ROUTING_BLOCK['links']] as $link_index => $link): ?>
              <a class="cta--link" href="<?php echo $link[ROUTING_BLOCK['link_url']]; ?>">
                <span class="visually-hidden"><?php echo $block[ROUTING_BLOCK['title']]; ?>: </span>
                <?php echo $link[ROUTING_BLOCK['link_text']]; ?>
              </a>
            <?php endforeach; ?>

          </div>
        </div>
      </div>
    <?php endforeach; ?>


    </div>

    <?php include( locate_template( 'template-parts/components/cta.php', false, false ) ); ?>

  </div>
</section>
