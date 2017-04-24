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
		$title = apply_filters( 'widget_title', $instance['title'] );
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];

		// This is where you run the code and display the output
		echo __( 'Hello, World!', 'prh_media_contact_widget_domain' );
		echo $args['after_widget'];
	}

	// Widget Backend
	public function form( $instance ) {
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
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
} // Class prh_media_contact_widget ends here

// Register and load the widget
function prh_load_widgets() {
	register_widget( 'prh_media_contact_widget' );
}
add_action( 'widgets_init', 'prh_load_widgets' );