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


/***
* Generate a thumbnail on the fly
*
* @return thumbnail url
***/
function get_thumb($src_url='', $width=null, $height=null, $crop = true, $cached = true){
	
	if ( empty( $src_url ) ) throw new Exception('Invalid source URL');
	if ( empty( $width ) ) $width = get_option( 'thumbnail_size_w' );
	if ( empty( $height ) ) $height = get_option( 'thumbnail_size_h' );

	$src_info = pathinfo($src_url);

	$upload_info = wp_upload_dir();


	$upload_dir = $upload_info['basedir'];
	$upload_url = $upload_info['baseurl'];
	$thumb_name = $src_info['filename']."_".$width."X".$height.".".$src_info['extension'];


	if ( FALSE === strpos( $src_url, home_url() ) ){
		$source_path = $upload_info['path'].'/'.$src_info['basename'];
		$thumb_path = $upload_info['path'].'/'.$thumb_name;
		$thumb_url = $upload_info['url'].'/'.$thumb_name;
		if (!file_exists($source_path) && !copy($src_url, $source_path)) {
			throw new Exception('No permission on upload directory: '.$upload_info['path']);
		}

	}else{
		// define path of image
		$rel_path = str_replace( $upload_url, '', $src_url );
		$source_path = $upload_dir . $rel_path;
		$source_path_info = pathinfo($source_path);
		$thumb_path = $source_path_info['dirname'].'/'.$thumb_name;

		$thumb_rel_path = str_replace( $upload_dir, '', $thumb_path);
		$thumb_url = $upload_url . $thumb_rel_path;
	}

	if($cached && file_exists($thumb_path)) return $thumb_url;

		$editor = wp_get_image_editor( $source_path );
		$editor->resize( $width, $height, $crop );
		$new_image_info = $editor->save( $thumb_path );

	if(empty($new_image_info)) throw new Exception('Failed to create thumb: '.$thumb_path);

		return $thumb_url;
}

function get_taxonomy_hierarchy( $taxonomy, $parent = 0 ) {
	// only 1 taxonomy
	$taxonomy = is_array( $taxonomy ) ? array_shift( $taxonomy ) : $taxonomy;

	// get all direct decendents of the $parent
	$terms = get_terms( $taxonomy, array( 'parent' => $parent ) );

	// prepare a new array.  these are the children of $parent
	// we'll ultimately copy all the $terms into this new array, but only after they
	// find their own children
	$children = array();

	// go through all the direct decendents of $parent, and gather their children
	foreach ( $terms as $term ){
		// recurse to get the direct decendents of "this" term
		$term->children = get_taxonomy_hierarchy( $taxonomy, $term->term_id );

		// add the term to our new array
		$children[ $term->term_id ] = $term;
	}

	// send the results back to the caller
	return $children;
}

?>