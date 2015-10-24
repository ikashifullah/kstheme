<?php

class kstheme_company_profile extends WP_Widget {
	
	function __construct() {
		
		parent::__construct(
		
		'kstheme_company_profile',  // Base ID

		__('KSTheme Company Profile', 'mortgagehouse'), // Name

		array( 'description' => __( 'Add your company info, and contact details.', 'mortgagehouse' ), )  // Args
		
		);
	}
	
	// Creating widget front-end
	public function widget( $args, $instance ) {
	
		//$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo $args['before_widget'];
		/*if ( ! empty( $title ) )
			echo '';//$args['before_title'] . $title . $args['after_title'];
		*/
		printf('<p class="contact_us_detail"><a href="%s" title="Mortgagehouse"><img src="%s" alt="Add image alt tag"></a></p>', get_site_url(), KSTHEME_IMG_DIR."/mortgage_house_logo.jpg");	
		
		// This is where you run the code and display the output
		echo '<p class="company-intro">Mel iusto referrentur et. Te paulo possim repudiandae mea, id vim modus labores. Illud oratio phaedrum at sed, eam ut bonorum evertitur. Eos at erant sanctus, nam molestie inimicus expetendis ut. Ius justo veniam homero et, verterem gloriatur interesset et mel. Mei eius<p>';
		
		echo '<ul>';

			printf('<li><i class="fa fa-home"></i> %s</li>', 'Opposite Emirates Towers, Dubai');

			printf('<li><i class="fa fa-phone-square"></i> %s</li>', '+971 43 550 666');

			printf('<li><i class="fa fa-envelope"></i> %s</li>', 'info@mortgagehouseuae.com');

			printf('<li><i class="fa fa-clock-o"></i> %s</li>', '9:00 am - 6:00 pm');

			printf('<li><i class="fa fa-exclamation-circle"></i> <a href="%s">%s</a></li>', 'http://www.propertyhouseuae.com', 'www.propertyhouseuae.com');

		echo '</ul>';
		
		echo $args['after_widget'];
	}
	
	
	// Widget Backend 
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'mortgagehouse' );
		}
		// Widget admin form
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
	<?php 
	}
	
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
		}

} // Class kstheme_company_profile ends here



function register_kstheme_company_profile_fn() {
	
	register_widget( 'kstheme_company_profile' );
}

//add_action('widgets_init', create_function('', 'return register_widget( "kstheme_company_profile" );') ); // only PHP 5.2+
add_action( 'widgets_init', 'register_kstheme_company_profile_fn' ); // only PHP 5.3+
?>