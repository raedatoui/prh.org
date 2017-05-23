<?php
	wp_reset_postdata();
	$today = date('Ymd');
	$upcoming_events = new WP_Query( array (
		'numberposts'	=> -1,
		'post_type'		=> 'prh_events',
		'orderby'		=> 'meta_value',
		'order'			=> 'DESC',
		'meta_query' => array(
			array(
				'key'		=> 'event_date',
				'compare'	=> '>=',
				'value'		=> $today
			)
		)
	) );

	$past_events = new WP_Query( array (
		'numberposts'	=> 5,
		'post_type'		=> 'prh_events',
		'orderby'		=> 'meta_value',
		'order'			=> 'DESC',
		'meta_query' => array(
			array(
				'key'		=> 'event_date',
				'compare'	=> '<',
				'value'		=> $today
			)
		)
	) );


?>

<section class="hero module shiny-hero">
	<div class="content">
		<h1 class="hero__header">Attend an Event</h1>
	</div>
</section>

<section class="module">
	<div class="content">
		<?php if ( $upcoming_events->have_posts() ) : ?>
			<div class="row">
				<div class="col-xs-12">
					<p class="focus-lead-copy">Upcoming Events</p>
				</div>
			</div>
			<div class="row">
				<?php while ( $upcoming_events->have_posts() ) : $upcoming_events->the_post(); ?>
					<p><?php the_title(); ?></p>
				<?php endwhile; ?>
			</div>
		<?php else: ?>
		<div class="row">
			<div class="col-xs-12">
				<p class="focus-lead-copy">No Upcoming Events</p>
			</div>
		</div>
		<?php endif; ?>
  </div>
</section>

<section class="module">
	<div class="content">
		<?php if ( $past_events->have_posts() ) : ?>
			<div class="row">
				<div class="col-xs-12">
					<p class="focus-lead-copy">Upcoming Events</p>
				</div>
			</div>
			<div class="row">
				<?php while ( $past_events->have_posts() ) : $past_events->the_post(); ?>
					<p><?php the_title(); ?></p>
				<?php endwhile; ?>
			</div>
		<?php else: ?>
		<div class="row">
			<div class="col-xs-12">
				<p class="focus-lead-copy">No Past Events</p>
			</div>
		</div>
		<?php endif; ?>
  </div>
</section>

<?php
	$donate_bg = get_template_directory_uri() . '/images/optimized/donate-module.jpg';
	$front_id = get_option(page_on_front);
	$headline = get_field(DONATE_MODULE['headline'], $front_id);
	$text = get_field(DONATE_MODULE['text'], $front_id);
	$cta_url = get_field(DONATE_MODULE['cta_url'], $front_id);
	$cta_text = get_field(DONATE_MODULE['cta_text'], $front_id);
?>

<section class="module donate-module" style="background-image: url(<?php echo $donate_bg; ?>);">
	<div class="center-xs donate-content">
		<h2 class="donate-header"><?php echo $headline; ?></h2>
		<p class="donate-copy"><?php echo $text; ?></p>
		<div class="cta-row center-xs donate-cta">
		   <a class="cta cta--red" href="<?php echo $cta_url; ?>"><?php echo $cta_text; ?></a>
		</div>
	</div>
</section>