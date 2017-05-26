<?php

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
	<section class="module future-events">
	<div class="content events-content">
		<header class="module__title"><h2>Upcoming Events</h2></header>
		<div class="row">
			<?php 
			$show_time = true;
			foreach($upcoming_events as $index => $event ): 
				include( locate_template( 'template-parts/content-event.php', false, false ) );
			endforeach; 
			?>
		</div>
		<?php  if ( count( $past_events ) == 0 ) {
			get_template_part( 'template-parts/pagination');
		} ?>
	</div>
</section>
<?php endif; ?>

<?php if ( count( $past_events ) > 0 ): ?>
	<section class="module past-events">
		<div class="content events-content">
			<header class="module__title"><h2>Past Events</h2></header>
			<div class="row">
				<?php 
				$show_time = false;
				foreach($past_events as $index => $event ):
					include( locate_template( 'template-parts/content-event.php', false, false ) );
				endforeach; ?>
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
