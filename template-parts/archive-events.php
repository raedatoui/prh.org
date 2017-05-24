<?php
//	wp_reset_postdata();
//
//	$upcoming_events = new WP_Query( array (
//		'numberposts'	=> -1,
//		'post_type'		=> 'prh_events',
//		'orderby'		=> 'meta_value',
//		'order'			=> 'DESC',
//		'meta_query' => array(
//			array(
//				'key'		=> 'event_date',
//				'compare'	=> '>=',
//				'value'		=> $today
//			)
//		)
//	) );
//
//	$past_events = new WP_Query( array (
//		'numberposts'	=> 5,
//		'post_type'		=> 'prh_events',
//		'orderby'		=> 'meta_value',
//		'order'			=> 'DESC',
//		'meta_query' => array(
//			array(
//				'key'		=> 'event_date',
//				'compare'	=> '<',
//				'value'		=> $today
//			)
//		)
//	) );

$today = strtotime(date('Ymd'));
$upcoming_events = [];
$past_events = [];

if ( have_posts() ) {
	while (have_posts()) {
		the_post();
		$date =  strtotime(get_field('event_date'));
		$event =  array(
			'title' => get_the_title(),
			'link' => get_permalink(),
			'date' => get_field('event_date'),
			'start_time' => get_field('event_start_time'),
			'end_time' => get_field('event_end_time'),
			'location' => get_field('event_location'),
			'excerpt'=> sanitize_text_field(get_the_excerpt()),
			'image' => get_the_post_thumbnail_url(),
			'cta' => get_field('event_rsvp')
		);
		if ( $date >= $today ) {
			$upcoming_events[] = $event;
		} else {
			$past_events[] = $event;
		}
	}
	$upcoming_events = array_reverse($upcoming_events);
}
?>

<section class="hero module shiny-hero">
	<div class="content">
		<h1 class="hero__header">Attend an Event</h1>
	</div>
</section>

<?php if ( count( $upcoming_events ) > 0 ): ?>
	<section class="module">
	<div class="content">
		<div class="row">
			<div class="col-xs-12">
				<p class="focus-lead-copy">Upcoming Events</p>
			</div>
		</div>
		<div class="row">
			<?php foreach($upcoming_events as $index => $event ): ?>
				<a class="event col-xs-12" href="<?php echo $event['link'] ?>" aria-label="<?php echo $event['title']; ?>">
					<h3 class="tile__title"><?php echo $event['title']; ?></h3>
					<div><?php echo $event['date']; ?></div>
					<?php if ( $event['image'] != '' ) : ?>
						<div>
							<img src="<?php echo $event['image']; ?>" />
						</div>
					<?php endif; ?>
				</a>
			<?php endforeach; ?>
		</div>
		<?php  if ( count( $past_events ) == 0 ) {
			get_template_part( 'template-parts/pagination');
		} ?>
	</div>
</section>
<?php endif; ?>

<?php if ( count( $past_events ) > 0 ): ?>
	<section class="module past-events">
		<div class="content">
			<div class="row">
				<div class="col-xs-12">
					<p class="focus-lead-copy">Past Events</p>
				</div>
			</div>
			<div class="row">
				<?php foreach($past_events as $index => $event ): ?>
					<a class="event col-xs-12" href="<?php echo $event['link'] ?>" aria-label="<?php echo $event['title']; ?>">
						<h3 class="tile__title"><?php echo $event['title']; ?></h3>
						<div><?php echo $event['date']; ?></div>
						<?php if ( $event['image'] != '' ) : ?>
							<div>
								<img src="<?php echo $event['image']; ?>" />
							</div>
						<?php endif; ?>
					</a>
				<?php endforeach; ?>
			</div>
			<?php get_template_part( 'template-parts/pagination'); ?>
		</div>
	</section>
<?php endif; ?>

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
