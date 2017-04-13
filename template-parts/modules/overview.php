<?php $module = $this->modules[OVERVIEW_MODULE['name']]; ?>
<section class="overview module">
  <div class="content">
    <?php include( locate_template( 'template-parts/components/module-title.php', false, false ) ); ?>

    <div class="overview-text">
    <?php
      $full_content = $module[OVERVIEW_MODULE['content']]; 
      $split_content = explode('<p><!--more--></p>', $full_content);
      ?>

      <?php echo $split_content[0]; ?>
      
      <?php if (count($split_content) >= 1): ?>
<!--         <a href="#collapsible-1" class="collapse-link">Read more</a>

        <div id="collapsible-1" class="collapsible overview-collapsible is-collapsed">
          <div class="collapsible-content">
            <?php //echo $split_content[1]; ?>
          </div>
        </div> -->
      <?php endif; ?>


    </div>
  </div>
</section>
