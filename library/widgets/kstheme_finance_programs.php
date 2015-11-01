<?php

class kstheme_finance_programs extends WP_Widget {
	
	function __construct() {
		
		parent::__construct(

		'kstheme_finance_programs',  // Base ID

		__('KSTheme Finance Programs', 'mortgagehouse'), // Name

		array( 'description' => __( 'Display all Finance Programs in sidebar.', 'mortgagehouse' ), )  // Args
		
		);
	}
	
	// Creating widget front-end
	public function widget( $args, $instance ) {
	
		//$title = apply_filters( 'widget_title', $instance['title'] );
				
		echo $args['before_widget'];


		$programs = get_taxonomy_hierarchy('program_category');
		$programs_html = '<div class="kst-finance-cont">';
		foreach($programs as $program) {
			$programs_html .= '<ul class="kst-finance-programs">';
				$programs_html .='<li><a href="' . get_term_link( $program ) . '" title="' . sprintf( __( 'View all post filed under %s', 'mortgagehouse' ), $program->name ) . '">' . $program->name . '</a></li>';
					$programs_html .='<ul>';
			foreach($program->children as $child) {
				$programs_html .='<li><a href="' . get_term_link( $child ) . '" title="' . sprintf( __( 'View all post filed under %s', 'mortgagehouse' ), $child->name ) . '">' . $child->name . '</a></li>';
			}
					$programs_html .='</ul>';
			$programs_html .='</ul>';
		}
		echo $programs_html.'</div>';
		
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

} // Class kstheme_finance_programs ends here



function register_kstheme_finance_programs_fn() {
	
	register_widget( 'kstheme_finance_programs' );
}

//add_action('widgets_init', create_function('', 'return register_widget( "kstheme_pre_approved_form" );') ); // only PHP 5.2+
add_action( 'widgets_init', 'register_kstheme_finance_programs_fn' ); // only PHP 5.3+
?>