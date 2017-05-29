<?php
// Creating the widget
class prh_media_contact_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'prh_media_contact_widget',

		// Widget name will appear in UI
		__('Global Media Contact', 'prh_media_contact_widget_domain'),

		// Widget description
		array( 'description' => __( 'This widget stores default media contact info for all content types', 'prh_media_contact_widget_domain' ) ) );
	}

	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) {
		$label = apply_filters( 'widget_name', $instance['label'] );
		$name = apply_filters( 'widget_name', $instance['name'] );
		$email = apply_filters( 'widget_email', $instance['email'] );
		$phone = apply_filters( 'widget_phone', $instance['phone'] );

		// before and after widget arguments are defined by themes
//		echo $args['before_widget'];

		if ( ! empty( $label ) )
			echo "<p>" . $label . "</p>";

		if ( ! empty( $name ) )
			echo "<p>" . $name . "</p>";

		if ( ! empty( $email ) )
			echo '<a class="contact-link" href="mailto:' . $email . '" rel="author">' . $email . '</a>';

		if ( ! empty( $phone ) )
			echo '<a class="contact-link" href="tel:'  . $phone . '" rel="author">' . $phone . '</a>';

		// This is where you run the code and display the output
		echo __( '', 'prh_media_contact_widget_domain' );
//		echo $args['after_widget'];
	}

	// Widget Backend
	public function form( $instance ) {
		if ( isset( $instance[ 'label' ] ) ) {
			$label = $instance[ 'label' ];
		}
		else {
			$label = __( '', 'prh_media_contact_widget_domain' );
		}


		if ( isset( $instance[ 'name' ] ) ) {
			$name = $instance[ 'name' ];
		}
		else {
			$name = __( '', 'prh_media_contact_widget_domain' );
		}

		if ( isset( $instance[ 'email' ] ) ) {
			$email = $instance[ 'email' ];
		}
		else {
			$email = __( '', 'prh_media_contact_widget_domain' );
		}

		if ( isset( $instance[ 'phone' ] ) ) {
			$phone = $instance[ 'phone' ];
		}
		else {
			$phone = __( '', 'prh_media_contact_widget_domain' );
		}

//			$email_url = '<a class="contact-link" href="mailto:' . $email_link . '" rel="author">';
//			$phone_url = '<a class="contact-link" href="tel:' . $phone_link . '" rel="author">';

		// Widget admin form
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'label' ); ?>"><?php _e( 'Contact Type:' ); ?></label>
			<input class="widefat"
				id="<?php echo $this->get_field_id( 'label' ); ?>"
				name="<?php echo $this->get_field_name( 'label' ); ?>"
				type="text" value="<?php echo esc_attr( $label ); ?>"
				placeholder="Media Contact" />


			<label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e( 'Contact Name:' ); ?></label>
			<input class="widefat"
				id="<?php echo $this->get_field_id( 'name' ); ?>"
				name="<?php echo $this->get_field_name( 'name' ); ?>"
				type="text" value="<?php echo esc_attr( $name ); ?>"
				placeholder="Jane Doe" />

			<label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e( 'Contact Email:' ); ?></label>
			<input class="widefat"
				id="<?php echo $this->get_field_id( 'email' ); ?>"
				name="<?php echo $this->get_field_name( 'email' ); ?>"
				type="text" value="<?php echo esc_attr( $email ); ?>"
				placeholder="jane.doe@prh.org" />

			<label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php _e( 'Contact Phone:' ); ?></label>
			<input class="widefat"
				id="<?php echo $this->get_field_id( 'phone' ); ?>"
				name="<?php echo $this->get_field_name( 'phone' ); ?>"
				type="text" value="<?php echo esc_attr( $phone ); ?>"
				placeholder="(555) 789-6507"/>
		</p>
		<?php
	}

	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['label'] = ( ! empty( $new_instance['label'] ) ) ? strip_tags( $new_instance['label'] ) : '';
		$instance['name'] = ( ! empty( $new_instance['name'] ) ) ? strip_tags( $new_instance['name'] ) : '';
		$instance['email'] = ( ! empty( $new_instance['email'] ) ) ? strip_tags( $new_instance['email'] ) : '';
		$instance['phone'] = ( ! empty( $new_instance['phone'] ) ) ? strip_tags( $new_instance['phone'] ) : '';
		return $instance;
	}
} // Class prh_media_contact_widget ends here


// Creating the widget
class prh_subscription_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'prh_subscription_widget',

		// Widget name will appear in UI
		__('Global Subscription Link', 'prh_subscription_widget_domain'),

		// Widget description
		array( 'description' => __( 'This widget stores default media contact info for all content types', 'prh_subscription_widget_domain' ) ) );
	}

	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$text = apply_filters( 'widget_text', $instance['text'] );
		$url = apply_filters( 'widget_url', $instance['url'] );

		// before and after widget arguments are defined by themes
//		echo $args['before_widget'];

		if ( ! empty( $title ) )
			echo $title;

		if ( ! empty( $text ) )
			echo $text;

		if ( ! empty( $url ) )
			echo $url;

		// This is where you run the code and display the output
		echo __( '', 'prh_subscription_widget_domain' );
//		echo $args['after_widget'];
	}

	// Widget Backend
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( '', 'prh_subscription_widget_domain' );
		}
		if ( isset( $instance[ 'text' ] ) ) {
			$text = $instance[ 'text' ];
		}
		else {
			$text = __( '', 'prh_subscription_widget_domain' );
		}
		if ( isset( $instance[ 'url' ] ) ) {
			$url = $instance[ 'url' ];
		}
		else {
			$url= __( '', 'prh_subscription_widget_domain' );
		}

		// Widget admin form
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat"
				id="<?php echo $this->get_field_id( 'title' ); ?>"
				name="<?php echo $this->get_field_name( 'title' ); ?>"
				type="text" value="<?php echo esc_attr( $title ); ?>"
				placeholder="Stay Informed" />

			<label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text:' ); ?></label>
			<input class="widefat"
				id="<?php echo $this->get_field_id( 'text' ); ?>"
				name="<?php echo $this->get_field_name( 'text' ); ?>"
				type="textarea" value="<?php echo esc_attr( $text ); ?>"
				placeholder="We deliver breaking news and reproductive justice opportunities straight to your inbox." />

			<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'Url:' ); ?></label>
			<input class="widefat"
				id="<?php echo $this->get_field_id( 'url' ); ?>"
				name="<?php echo $this->get_field_name( 'url' ); ?>"
				type="text" value="<?php echo esc_attr( $url); ?>"
				placeholder="http://support.prh.org"/>
		</p>
		<?php
	}

	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['text'] = ( ! empty( $new_instance['text'] ) ) ? strip_tags( $new_instance['text'] ) : '';
		$instance['url'] = ( ! empty( $new_instance['url'] ) ) ? strip_tags( $new_instance['url'] ) : '';
		return $instance;
	}
} // Class prh_media_contact_widget ends here


// Register and load the widget
function prh_load_widgets() {
	register_widget( 'prh_media_contact_widget' );
	register_widget( 'prh_subscription_widget' );
}
add_action( 'widgets_init', 'prh_load_widgets' );


function prh_get_widget_data_for( $index = 1 ) {
	global $wp_registered_sidebars, $wp_registered_widgets;

	// Holds the final data to return
	$output = array();

	if ( is_int( $index ) ) {
		$index = "sidebar-$index";
	} else {
		$index = sanitize_title( $index );
		foreach ( (array) $wp_registered_sidebars as $key => $value ) {
			if ( sanitize_title( $value['name'] ) == $index ) {
				$index = $key;
				break;
			}
		}
	}

	// A nested array in the format $sidebar_id => array( 'widget_id-1', 'widget_id-2' ... );
	$sidebars_widgets = wp_get_sidebars_widgets();

	if ( empty( $sidebars_widgets[ $index ] ) || empty( $sidebars_widgets[ $index ] ) || ! is_array( $sidebars_widgets[ $index ] ) ) {
		return array();
	} else {
		// Loop over each widget_id so we can fetch the data out of the wp_options table.
		foreach( $sidebars_widgets[ $index ] as $id ) {
			// The name of the option in the database is the name of the widget class.
			$option_name = $wp_registered_widgets[$id]['callback'][0]->option_name;

			// Widget data is stored as an associative array. To get the right data we need to get the right key which is stored in $wp_registered_widgets
			$key = $wp_registered_widgets[$id]['params'][0]['number'];

			$widget_data = get_option($option_name);

			// Add the widget data on to the end of the output array.
			$output[] = (object) $widget_data[$key];
		}
		return $output;
	}
}