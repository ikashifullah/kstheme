<?php

class kstheme_pre_approved_form extends WP_Widget {
	
	function __construct() {
		
		parent::__construct(
		
		'kstheme_pre_approved_form',  // Base ID

		__('KSTheme Pre Approved Form', 'mortgagehouse'), // Name

		array( 'description' => __( 'Type any text for Pre-Approved Form.', 'mortgagehouse' ), )  // Args
		
		);
	}
	
	// Creating widget front-end
	public function widget( $args, $instance ) {
	
		//$title = apply_filters( 'widget_title', $instance['title'] );
				
		echo $args['before_widget'];
		$instance['pre_app_title'] = strip_tags( $instance['pre_app_title'] );
		
		$url = isset( $instance['pre_app_url'] ) ? $instance['pre_app_url'] : '#';		
		
		// This is where you run the code and display the output
		//echo '<div class="pre-approved-cont"> <p>Fill out our short online application to get pre-approved in minutes </p>'; 
		echo '<div class="pre-approved-cont"> <p>'.$instance['pre_app_title'].'</p>'; 
		printf('<div style="text-align:center"><a href="%s" class="pre-approved-btn">%s</a></div>', $url, 'Get Pre-approved');
		echo '</div>';
			
		
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
		
		if ( isset( $instance[ 'pre_app_title' ] ) ) {
			$pre_app_title = $instance[ 'pre_app_title' ];
		}
		else {
			$pre_app_title = '';
		}
		if ( isset( $instance[ 'pre_app_url' ] ) ) {
			$pre_app_url = $instance[ 'pre_app_url' ];
		}
		else {
			$pre_app_url = '';
		}
		
		//$pre_app_title = isset($instance['pre_app_title']) ? $instance['pre_app_title'] : '';
		// Widget admin form
		?>
		<p>
			<?php /*
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			*/ ?>
			<label for="<?php echo $this->get_field_id('pre_app_title'); ?>">pre-approved Title: </label>
			<textarea class="widefat" id="<?php echo $this->get_field_id('pre_app_title'); ?>" name="<?php echo $this->get_field_name('pre_app_title'); ?>"><?php echo attribute_escape($pre_app_title); ?></textarea>
			<br>
			<label for="<?php echo $this->get_field_id('pre_app_title'); ?>">pre-approved Button Link: </label>
			<input class="widefat" type="url" id="<?php echo $this->get_field_id('pre_app_url'); ?>" name="<?php echo $this->get_field_name('pre_app_url'); ?>" value = "<?php echo attribute_escape($pre_app_url); ?>" />
			
		</p>
		
	<?php
			
	}
	
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		//$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['pre_app_title'] = ( ! empty( $new_instance['pre_app_title'] ) ) ? strip_tags( $new_instance['pre_app_title'] ) : '';
		$instance['pre_app_url'] = ( ! empty( $new_instance['pre_app_url'] ) ) ? strip_tags( $new_instance['pre_app_url'] ) : '';
		return $instance;
		}

} // Class kstheme_pre_approved_form ends here



function register_kstheme_pre_approved_form_fn() {
	
	register_widget( 'kstheme_pre_approved_form' );
}

//add_action('widgets_init', create_function('', 'return register_widget( "kstheme_pre_approved_form" );') ); // only PHP 5.2+
add_action( 'widgets_init', 'register_kstheme_pre_approved_form_fn' ); // only PHP 5.3+
?>