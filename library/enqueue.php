<?php 

add_action('wp_enqueue_scripts', 'kstheme_load_scripts');
function kstheme_load_scripts() {

	// load all scripts
	kstheme_get_script('bootstrap.min.js', 'bootstrap', '3.3.5'); 
	kstheme_get_script('jquery-1.11.3.min.js', 'jquery', '1.11.3'); 
	kstheme_get_script('owl.carousel.min.js', 'owl-jquery', '1.3.3'); 
	
	// Load all styles
	kstheme_get_style("bootstrap.min.css", "bootstrap", "3.3.5");
	wp_enqueue_style( 'font-awesome', KSTHEME_THEME_DIR.'/font-awesome/css/font-awesome.min.css', NULL, '4.4.0');
	kstheme_get_style("main.css", "main-styles");
	kstheme_get_style("owl.carousel.css", "owl-styles");
	kstheme_get_style("owl.theme.css", "owl-theme");
}

?>