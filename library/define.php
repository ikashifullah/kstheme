<?php

function kstheme_get_script( $fn = NULL, $name = 'kstheme', $ver = '0.0.1', $bottom = true ) {
	if( $fn != NULL ) {
			wp_register_script( $name, get_template_directory_uri().'/js/'.$fn, NULL, $ver, $bottom );
			wp_enqueue_script( $name );
	}	
}

function kstheme_get_style( $fn = NULL, $name = 'kstheme', $ver = '0.0.1', $media = 'all' ) {
	if( $fn != NULL ) {
		wp_register_style( $name, get_template_directory_uri().'/css/'.$fn, NULL, $ver, $media );
		wp_enqueue_style( $name );
	}
}

?>