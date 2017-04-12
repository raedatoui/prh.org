<?php
/**
 * Template name: Styleguide
 *
 * @package prh-wp-theme
 */

get_header(); ?>


    <?php
   /* while ( have_posts() ) : the_post();
      $groups = acf_get_field_groups();
      $modules = array();
      foreach( $groups as $group_key => $group ) {
        $module = acf_get_fields($group);
        $key = $group['title'];
        $modules[$key] = array('module_name' => $group['title']);
        foreach($module as $field_name => $field ) {
          $f = $field['name'];
          $modules[$key][$f] = get_field($f);
        }
      }
      $page = new PageModules($modules);
      $page->render(); */
      ?>

  <section class="hero module">
    <div class="content">
      <h1 class="hero__header">Style Guide
      </h1>
      <div class="col-xs-12 hero__subhead">An inventory of global patterns.</div>
    </div>
  </section>

  <section class="module">
    <div class="content">
      <div class="module-title">
        <h2>Headers and copy</h2>
      </div>
      <h1>Heading level one (h1)</h1>
      <p class="lead-copy">This paragraph text is larger than normal. It’s generally used at the beginning of a page or section, to introduce the content. Blocks of text in this style shouldn’t be too long.</p>
      <p>This is normal paragraph text. These styles apply to most of the body copy throughout the site. They support styles like <strong>bold</strong> and <em>italic</em> and can contain <a href="#">links</a> to other pages. By the way, the level-one heading generally just happens once on a page, up in the hero or header area. It’s usually the page’s title.</p>
      <div class="module-title">
        <h2>Heading level two (h2)</h2>
      </div>
      <p>The second-level heading, or module title, is used for naming the big subsections within a page.</p>
      <h3>Heading level three (h3)</h3>
      <p>Following the page’s information hierarchy, third level headings should be used within the subsections. Avoid skipping levels – if your last header was an h2 and you want to label a block within that subsection, use an h3. If you need one within <em>that</em>, go ahead to h4. Here are a few more paragraphs of text from the PRH site, to show what a larger block of text looks like.</p>
      <p>Physicians for Reproductive Health believes that access to contraception is of vital importance to women’s health because it allows them to determine the timing and spacing of pregnancies. In the medical world, we have studied birth control methods and their effects for decades. We know, based on enormous amounts of scientific evidence, that contraception is crucial to women’s well-being, their children’s health, and their ability to educate themselves, achieve career goals, care for and support their families, and otherwise participate in society. As physicians, we see every day how it improves our patients’ lives.</p>
      <p>The contraceptives that are most reliable, however, can be too expensive for many women to afford out of pocket. Because we believe every woman should be able to choose from a broad array FDA-approved contraceptives to find the one that meets her health needs, we advocated in support of the Affordable Care Act. We were thrilled when the Supreme Court upheld health care reform in June 2012.</p>
      <h4>Heading level four</h4>
      <p>Some pages probably won’t ever get to this level of hierarchy, but it’s probably a good idea to provide a style just in case. More filler text:</p>
      <p>Physicians for Reproductive Health believes that access to contraception is of vital importance to women’s health because it allows them to determine the timing and spacing of pregnancies. In the medical world, we have studied birth control methods and their effects for decades. We know, based on enormous amounts of scientific evidence, that contraception is crucial to women’s well-being, their children’s health, and their ability to educate themselves, achieve career goals, care for and support their families, and otherwise participate in society. As physicians, we see every day how it improves our patients’ lives.</p>

      <div class="module-title">
        <h2>Other elements</h2>
      </div>
      <p><span class="eyebrow">Eyebrow text | Also used for dates</span></p>
      <div class="cta-row"><a href="#" class="cta">Call To Action</a>
      <a href="#" class="cta cta--red">Call to Action</a></div>
      <blockquote>
        <p>This is what the default styling for a blockquote looks like, including a citation with a secondary detail.</p>
        <footer><cite>—Joel Hodgson, <span class="cite-origin">Minnesota</span></cite></footer>
      </blockquote>


      <?php //the_content(); ?>
    </div>
  </section>

<?php //endwhile; ?>
</div> <!-- /page-container -->

<?php
get_footer();
