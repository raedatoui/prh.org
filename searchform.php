<form role="search" method="get" class="search-form row middle-xs" action="<?php echo esc_url( home_url( '/' )); ?>">
  <label for="s" class="col-xs search-label">Search:</label>
  <input type="search" 
         class="search-field col-xs" 
         placeholder="What are you looking for?" 
         value="<?php echo get_search_query(); ?>" 
         name="s" id="s" />
  <input type="submit" class="search-submit visually-hidden" value="<?php echo esc_attr_x( 'Search', 'submit button' ); ?>" />
</form>
