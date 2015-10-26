<?php

class KSTheme_Image_Upload extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'KSTheme-upload-widget',
            'KSTheme Upload Widget',
            array(
                'description' => 'With KSTheme upload any image to sidebars.'
            )
        );
    }
    public function widget( $args, $instance )
    {
		echo $args['before_widget'];
        $image_instance = $instance['suw_image_loca'];
        // basic output
        printf( __('<img src="%1$s" />'), $image_instance);
		echo $args['after_widget'];
    }
    public function form( $instance )
    {
		 $img = isset( $instance['suw_image_loca'] ) ? esc_attr( $instance['suw_image_loca'] ) : ''
      ?>
     <p>
       <label for="<?php echo $this->get_field_id('suw_image_loca'); ?>">Image</label><br />
       <input type="text" class="suw-input-field <?php echo $this->get_field_name('suw_image_loca'); ?>" name="<?php echo $this->get_field_name('suw_image_loca'); ?>" id="<?php echo $this->get_field_id('suw_image_loca'); ?>" value="<?php echo $img; ?>" />
       <input type="button" class="suw-button-select button button-primary <?php echo $this->get_field_name('suw_image_loca'); ?>" id="<?php echo $this->get_field_name('suw_image_loca'); ?>" value="Select Image" />
     </p>
     <?php
    }
}
// end class
// init the widget
add_action( 'widgets_init', create_function('', 'return register_widget("KSTheme_Image_Upload");') );
// queue up the necessary js
function suw_enqueue()
{
    wp_enqueue_media();
	kstheme_get_script('file_upload_widget_script.js', 'hrw', '3.5.0'); 
}
add_action('admin_enqueue_scripts', 'suw_enqueue');