<div class="event-card col-xs-12">
  <div class="row">

    <time class="col-xs-12 col-sm-1 event-date">
      <span><?php echo date('M', strtotime($event['date'])); ?></span>
      <?php echo date('j', strtotime($event['date'])); ?>
    </time>

    <?php if ( $event['image'] != '' ) : ?>
      <div class="col-xs col-sm-3 event-img md-up">
        <img src="<?php echo $event['image']; ?>" />
      </div>
    <?php endif; ?>

    <div class="col-xs col-sm-offset-1 col-sm">

      <a class="event-title" href="<?php echo $event['link'] ?>">
        <h3><?php echo $event['title']; ?></h3>
      </a>

      <p>
        <?php echo $event['excerpt']; ?>
      </p>

      <?php 
        // $show_time is set at the template level, based on whether this event is past or future
        if ($show_time): ?>

        <!-- Event meta area - location, time, action buttons -->
        <div class="event-card-details row bottom-xs between-xs">

          <div>
            <svg class="icon--map" role="presentation">
              <use xlink:href="#icon--map" />
            </svg>

            <time class="event-meta upcoming-event-time">
              <?php 
              echo $event['start_time'];
              if( $event['end_time'] ) { echo ' – ' . $event['end_time']; } 
              ?>
            </time>

            <?php 
            $loc_tag = '<span class="event-meta upcoming-event-location">';
            echo_wrapped($event['location'], $loc_tag, '</span>'); 
            ?>
            
            <svg class="icon--calendar" role="presentation">
              <use xlink:href="#icon--calendar" />
            </svg>

            <!-- Add to calendar link gets generated from metadata here. -->
            <span class="addtocalendar atc-style-menu-wb">
              <var class="atc_event">
                <var class="atc_date_start">
                  <?php echo date('Y-m-d H:i:s', strtotime($event['start_time'])); ?>
                </var>
                <var class="atc_date_end">
                <?php 
                  // addtocalendar requires an endtime, but our fields don't, so check first;
                  // if they didn't provide one, just use the start time again
                  if ($event['end_time']) { $endtime = $event['end_time']; }
                  else { $endtime = $event['start_time']; } 
                  echo date('Y-m-d H:i:s', strtotime($endtime)); 
                  ?>
                </var>
                <var class="atc_timezone">America/New_York</var>
                <var class="atc_title">
                  <?php echo $event['title']; ?>
                </var>
                <var class="atc_description">
                  <?php echo $event['excerpt']; ?>
                </var>
                <var class="atc_location">
                  <?php echo $event['location']; ?>
                </var>
              </var>
            </span>
          </div>

          <div class="event-rsvp-row col-xs-12 col-sm">
			<?php $url = $event['cta'][0]['cta_link']; ?>
            <a class="cta rsvp-cta" href="<?php echo $url; ?>" target="<?php echo get_url_target( $url ); ?>">
              <?php echo $event['cta'][0]['cta_label']; ?>
            </a>
          </div>
        </div>

      <?php endif; ?>
    </div>
  </div>
</div>




