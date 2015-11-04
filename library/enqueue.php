<?php 

add_action('wp_enqueue_scripts', 'kstheme_load_scripts');
function kstheme_load_scripts() {

	// load all scripts
	kstheme_get_script('bootstrap.min.js', 'bootstrap', '3.3.5'); 
	kstheme_get_script('jquery-1.11.3.min.js', 'jquery', '1.11.3'); 
	kstheme_get_script('owl.carousel.min.js', 'owl-jquery', '1.3.3'); 
	kstheme_get_script('typed.min.js', 'typed-jquery', '1.0.0');

	// Load all styles
	kstheme_get_style("bootstrap.min.css", "bootstrap", "3.3.5");
	wp_enqueue_style( 'font-awesome', KSTHEME_THEME_DIR.'/font-awesome/css/font-awesome.min.css', NULL, '4.4.0');
	kstheme_get_style("main.css", "main-styles");
	kstheme_get_style("owl.carousel.css", "owl-styles");
	kstheme_get_style("owl.theme.css", "owl-theme");
	
	if(is_page('pre-approval-application')) {
		kstheme_get_style("calender/datepicker3.css", "datepicker3", "2.0.0");
		kstheme_get_script('calender/modernizr.js', 'modernizr', '2.8.3');
		kstheme_get_script('calender/bootstrap-datepicker.js', 'bootstrap-datepicker', '2.0.0');
		kstheme_get_script('calender/moment.js', 'moment', '2.8.4');
		kstheme_get_script('calender/bootstrap-datepicker-mobile.js', 'bootstrap-datepicker-mobile', '2.0.0');	
		kstheme_get_script('jquery.validate.min.js', 'jquery-validate', '1.14.0');
		kstheme_get_script('jquery.maskedinput.min.js', 'jquery-mask', '1.4.1');
	}
}

?>