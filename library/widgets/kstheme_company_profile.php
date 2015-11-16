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
		printf('<p class="contact_us_detail"><a href="%s" title="Mortgagehouse"><img src="%s" alt="Add image alt tag"></a></p>', get_site_url(), KSTHEME_IMG_DIR."/Mortgagehouse_logo.png");	
		
		// This is where you run the code and display the output
		echo '<p class="company-intro">With over 15 years’ experience in banking and finances, our management team has a complete understanding of the best bank products and processes available on the market; therefore we are able to provide a bespoke package which is tailored on a case by case basis.
			Serving both private and business communities within the UAE with a dynamic approach, Mortgage House has a wealth of resourceful advice plans that guarantees peace of mind for first time buyers and investors alike.<p>';
		
		echo '<ul class="contact-info-details">';

			printf('<li><i class="fa fa-home fa-lg"></i> %s</li>', 'Opposite Emirates Towers, Dubai');

			printf('<li><i class="fa fa-phone-square fa-lg"></i> %s</li>', '+971 43 550 666');

			printf('<li><i class="fa fa-envelope fa-lg"></i> <a href="%s">%s</a></li>', 'mailto:info@mortgagehouseuae.com', 'info@mortgagehouseuae.com');

			printf('<li><i class="fa fa-clock-o fa-lg"></i> %s</li>', '9:00 am - 6:00 pm');

			printf('<li><i class="fa fa-globe fa-lg"></i> <a href="%s">%s</a></li>', 'http://www.mortgagehouseuae.com', 'www.mortgagehouseuae.com');

		echo '</ul>';
		
		$socials = array (
			'facebook' => 'Facebook',
			'twitter' => 'Twitter',
			'google-plus' => 'Google+',
			'linkedin' => 'LinkedIn',
			'youtube' => 'YouTube',
		);
		
		$social_output = '<ul class="contact-info-social">';
		foreach ( $socials as $social_key => $social ) {
			if ( empty( $instance[ $social_key ] ) ) {
				continue;
			}
			$social_url = $instance[ $social_key ];
			$social_url = esc_url( $social_url );
			
			$social_output .='<li class="'.$social_key.'-bg"><a href="'.$social_url.'" target="_blank"><i class="fa fa-'.$social_key.' fa-lg"></i></a></li>';
			
		}
		$social_output .= '</ul>';
		echo $social_output;
		
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
		// 1. Create array for social media
		$socials = array (
			'facebook' => 'Facebook',
			'twitter' => 'Twitter',
			'google-plus' => 'Google+',
			'linkedin' => 'LinkedIn',
			'youtube' => 'YouTube',
		);
		foreach($socials as $social_key => $social) {
		if ( isset( $instance[ $social_key ] ) ) {
			$social_url = $instance[ $social_key ];
		}
		else {
			$social_url = '';
		}	
			
		?>
		<p>
			<label for="<?php echo $this->get_field_id( $social_key ); ?>"><?php echo $social; ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( $social_key ); ?>" name="<?php echo $this->get_field_name( $social_key ); ?>" type="text" value="<?php echo esc_attr( $social_url ); ?>" />
		</p>
		<?php 
		}
		?>
		
	<?php 
	}
	
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		
		$socials = array (
			'facebook' => 'Facebook',
			'twitter' => 'Twitter',
			'google-plus' => 'Google+',
			'linkedin' => 'LinkedIn',
			'youtube' => 'YouTube',
		);
		foreach($socials as $social_key => $social) {
			$instance[$social_key] = ( ! empty( $new_instance[$social_key] ) ) ?  $new_instance[$social_key]  : '';
		}
		
		return $instance;
	}

} // Class kstheme_company_profile ends here



function register_kstheme_company_profile_fn() {
	
	register_widget( 'kstheme_company_profile' );
}

//add_action('widgets_init', create_function('', 'return register_widget( "kstheme_company_profile" );') ); // only PHP 5.2+
add_action( 'widgets_init', 'register_kstheme_company_profile_fn' ); // only PHP 5.3+
?>