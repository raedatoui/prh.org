<div class="row">
	<nav class="pagination results-pagination">
		<?php
		global $wp_query;

		$big = 999999999; // need an unlikely integer
		$translated = __( 'Page ', 'mytextdomain' ); // Supply translatable string

		echo paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages,
			'before_page_number' => '<span class="visually-hidden">'.$translated.' </span>',
			'prev_text' => '<span class="visually-hidden">Previous results page</span>',
			'next_text' => '<span class="visually-hidden">Next results page</span>'
		) ); ?>
	</nav>
</div>
