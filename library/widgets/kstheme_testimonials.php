<?php
class kstheme_testimonials extends WP_Widget
{
    function __construct() {

        parent::__construct(

            'kstheme_testimonials',  // Base ID

            __('KSTheme Testimonials', 'mortgagehouse'), // Name

            array( 'description' => __( 'Add your customer testimonials here.', 'mortgagehouse' ), )  // Args

        );
    }

    function form($instance)
    {
        //$instance = wp_parse_args( (array) $instance, array( 'title' => '','slide_title' => 'testimonial', 'speed' =>'500', 'direction' =>'horizontal', 'control' =>'true', 'delay'=>'3000','autohover'=>'true', 'showtext'=>'excerpt', 'title_link'=>'true', 'pager'=>'true', 'play'=>'true', 'limit'=>'5', 'show_image'=>'yes', 'image_width'=>'60' ) );
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'New title', 'mortgagehouse' );
        }
    ?>
    <p class="fp_label">
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
    </p>
    <?php
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }

    function widget($args, $instance)
    {
        echo $args['before_widget'];
        //$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function(){
               jQuery('#kstheme-testimonials').bxSlider({
                   adaptiveHeight: true,
                   auto: true,
                   mode: 'vertical',
                   pass: 10000,
                   pager: false
               });
            });
        </script>
        <?php
        // WIDGET CODE GOES HERE
        query_posts('post_type=testimonial&posts_per_page=4');
        if (have_posts()) :
            echo "<div class='kstheme-testimonials-widget'><div id='kstheme-testimonials'>";
            while (have_posts()) : the_post();
                echo "<div>";
                echo "<h3>".get_the_title()."</h3>";
                the_post_thumbnail('testimonial');
                //echo "<div style='clear:both;'></div>";
                echo the_content();
                echo "</div>";
            endwhile;
            echo "</div></div>";
        endif;
        wp_reset_query();

        echo $args['after_widget'];
    }
}

function register_kstheme_testimonials_fn() {
    kstheme_get_script('jquery.bxSlider.min.js', 'bxSlider', '3.0.0');
    register_widget( 'kstheme_testimonials' );
}

//add_action('widgets_init', create_function('', 'return register_widget( "kstheme_testimonials" );') ); // only PHP 5.2+
add_action( 'widgets_init', 'register_kstheme_testimonials_fn' ); // only PHP 5.3+