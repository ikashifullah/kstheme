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
function getEmailTemplate($values) {
	extract ( $values );
	$fullname = $first_name . ' ' . $middle_name . ' ' . $last_name;
	if ( $employment == 'Employed' ) {
		$company = $employed_company;
		$description = $employed_description;
	} else {
		$company = $self_company;
		$description = $self_description;
	}
	$tr = '';
	if( isset($email_work) && !empty($email_work) ) {
		$email_work = $email_work;
	} else {
		$email_work = 'Work email is not applicable';
	}
	if( isset($contact_home) && !empty($contact_home) ) {
		$contact_home = $contact_home;
	} else {
		$contact_home = 'Landline contact is not applicable';
	}
	if ( $property_info_provided == 'yes' ) {
		$tr = <<<TR
		<tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
			<td style="margin: 0;padding: 5px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;border: 1px solid #ccc;font-size: 14px;">Property Info: </td>
			<td style="margin: 0;padding: 5px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;border: 1px solid #ccc;font-size: 14px;">{$property_info}</td>
		</tr>
TR;
	}
$tr_ci = '';
	if ( isset($contact_international) && !empty($contact_international) ) {
		$tr_ci = <<<CITR
		<tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
			<td style="margin: 0;padding: 5px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;border: 1px solid #ccc;font-size: 14px;">Contact (International): </td>
			<td style="margin: 0;padding: 5px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;border: 1px solid #ccc;font-size: 14px;">{$contact_international}</td>
		</tr>
CITR;
	}
	//$LogoSrc = KSTHEME_IMG_DIR .'/mortgage_house_logo.jpg';
	$LogoSrc ='http://mortgagehouseuae.com/wp-content/themes/kstheme/images/Mortgagehouse_logo.png';
	$template =<<<FILE
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- If you delete this meta tag, Half Life 3 will never be released. -->
<meta name="viewport" content="width=device-width" />

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>	Pre-Approval Form: Mortgagehouse </title>
</head>
<body bgcolor="#FFFFFF" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;-webkit-font-smoothing: antialiased;-webkit-text-size-adjust: none;height: 100%;width: 100%!important;">

<!-- HEADER -->
<table class="head-wrap" bgcolor="#29333D" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%;">
	<tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
		<td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"></td>
		<td class="header container" style="margin: 0 auto!important;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;display: block!important;max-width: 600px!important;clear: both!important;">

				<div class="content" style="margin: 0 auto;padding: 15px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;max-width: 600px;display: block;">
				<table style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%;">
					<tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
						<td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"><img src="{$LogoSrc}" width="150" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;max-width: 100%;"></td>
						<td align="right" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"><h6 class="collapse" style="margin: 0!important;padding: 0;font-family: &quot;HelveticaNeue-Light&quot;, &quot;Helvetica Neue Light&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif;line-height: 1.1;margin-bottom: 15px;color: #FFFFFF;font-weight: 900;font-size: 14px;text-transform: uppercase;">Pre Approval Form</h6></td>
					</tr>
				</table>
				</div>

		</td>
		<td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"></td>
	</tr>
</table><!-- /HEADER -->


<!-- BODY -->
<table class="body-wrap" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%;">
	<tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
		<td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"></td>
		<td class="container" bgcolor="#FFFFFF" style="margin: 0 auto!important;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;display: block!important;max-width: 600px!important;clear: both!important;">

			<div class="content" style="margin: 0 auto;padding: 15px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;max-width: 600px;display: block;">
			<table style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%;">
				<tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
					<td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
						<h3 style="margin: 0;padding: 0;font-family: &quot;HelveticaNeue-Light&quot;, &quot;Helvetica Neue Light&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif;line-height: 1.1;margin-bottom: 15px;color: #000;font-weight: 500;font-size: 27px;">Hi, {$fullname}</h3>
						<p class="lead" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;margin-bottom: 10px;font-weight: normal;font-size: 17px;line-height: 1.6;">Below is the information you provided us through Pre-Approval Form on Mortgagehouse Website</p>
						<table class="form-table" width="100%" cellpadding="5" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%;">
							<tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
								<td style="margin: 0;padding: 5px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;border: 1px solid #ccc;font-size: 14px;">Full Name:</td>
								<td style="margin: 0;padding: 5px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;border: 1px solid #ccc;font-size: 14px;">{$fullname}</td>
							</tr>
							<tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
								<td style="margin: 0;padding: 5px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;border: 1px solid #ccc;font-size: 14px;">Date of Birth:</td>
								<td style="margin: 0;padding: 5px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;border: 1px solid #ccc;font-size: 14px;">{$dob}</td>
							</tr>
							<tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
								<td rowspan="2" style="margin: 0;padding: 5px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;border: 1px solid #ccc;font-size: 14px;">Contact Nos:</td>
								<td style="margin: 0;padding: 5px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;border: 1px solid #ccc;font-size: 14px;">{$contact_work}</td>
							</tr>
							<tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
								<td style="margin: 0;padding: 5px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;border: 1px solid #ccc;font-size: 14px;">{$contact_home}</td>
							</tr>
							{$tr_ci}
							<tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
								<td rowspan="2" style="margin: 0;padding: 5px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;border: 1px solid #ccc;font-size: 14px;">Emails:</td>
								<td style="margin: 0;padding: 5px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;border: 1px solid #ccc;font-size: 14px;">{$email_work}</td>
							</tr>
							<tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
								<td style="margin: 0;padding: 5px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;border: 1px solid #ccc;font-size: 14px;">{$email_home}</td>
							</tr>
							<tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
								<td style="margin: 0;padding: 5px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;border: 1px solid #ccc;font-size: 14px;">Nationality:</td>
								<td style="margin: 0;padding: 5px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;border: 1px solid #ccc;font-size: 14px;">{$nationality_country}</td>
							</tr>
							<tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
								<td rowspan="2" style="margin: 0;padding: 5px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;border: 1px solid #ccc;font-size: 14px;">Employment: Employed</td>
								<td style="margin: 0;padding: 5px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;border: 1px solid #ccc;font-size: 14px;">{$company}</td>
							</tr>
							<tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
								<td style="margin: 0;padding: 5px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;border: 1px solid #ccc;font-size: 14px;">{$description}</td>
							</tr>
							<tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
								<td style="margin: 0;padding: 5px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;border: 1px solid #ccc;font-size: 14px;">I want to:</td>
								<td style="margin: 0;padding: 5px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;border: 1px solid #ccc;font-size: 14px;">{$want}</td>
							</tr>
							<tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
								<td style="margin: 0;padding: 5px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;border: 1px solid #ccc;font-size: 14px;">What amount of finance you are looking for (estimated): </td>
								<td style="margin: 0;padding: 5px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;border: 1px solid #ccc;font-size: 14px;">{$finance_amount}</td>
							</tr>
							{$tr}
						</table>
						<!-- Callout Panel -->
						<p class="callout" style="margin: 0;padding: 15px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;margin-bottom: 15px;font-weight: normal;font-size: 14px;line-height: 1.6;background-color: #ECF8FF;">
							Feel free to contact us any time, visit our website. <a href="http://mortgagehouseuae.com/" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #2BA6CB;font-weight: bold;">Click it! &raquo;</a>
						</p><!-- /Callout Panel -->

						<!-- social & contact -->
						<table class="social" width="100%" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;background-color: #ebebeb;width: 100%;">
							<tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
								<td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">

									<!-- column 1 -->
									<table align="left" class="column" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 280px;float: left;min-width: 279px;">
										<tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
											<td style="margin: 0;padding: 15px 10px 15px 3px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
												<h5 class="" style="margin: 0;padding: 0;font-family: &quot;HelveticaNeue-Light&quot;, &quot;Helvetica Neue Light&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif;line-height: 1.1;margin-bottom: 15px;color: #000;font-weight: 900;font-size: 17px;">Connect with Us:</h5>
												<p class="" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;margin-bottom: 10px;font-weight: normal;font-size: 14px;line-height: 1.6;">
													<a href="https://www.facebook.com/mortgagehouseuae" class="soc-btn" style="background-color: #3B5998;margin: 0;padding: 3px 7px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #FFF;font-size: 12px;margin-bottom: 10px;text-decoration: none;font-weight: bold;display: block;text-align: center;">Facebook</a>
													<a href="https://twitter.com/mortgagehouseae" class="soc-btn" style="background-color: #1daced;margin: 0;padding: 3px 7px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #FFF;font-size: 12px;margin-bottom: 10px;text-decoration: none;font-weight: bold;display: block;text-align: center;">Twitter</a>
													<a href="https://plus.google.com/116169091233838009595" class="soc-btn" style="background-color: #DB4A39;margin: 0;padding: 3px 7px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #FFF;font-size: 12px;margin-bottom: 10px;text-decoration: none;font-weight: bold;display: block;text-align: center;">Google+</a>
													<a href="https://ae.linkedin.com/in/mortgagehouseuae" class="soc-btn" style="background-color: #007bb5;margin: 0;padding: 3px 7px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #FFF;font-size: 12px;margin-bottom: 10px;text-decoration: none;font-weight: bold;display: block;text-align: center;">LinkedIn</a>
													<a href="https://www.youtube.com/channel/UCPIghRvSZc2b0-jIJfOqLfA" class="soc-btn" style="background-color: #c4302b;margin: 0;padding: 3px 7px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #FFF;font-size: 12px;margin-bottom: 10px;text-decoration: none;font-weight: bold;display: block;text-align: center;">Youtube</a>
												</p>
											</td>
										</tr>
									</table><!-- /column 1 -->

									<!-- column 2 -->
									<table align="left" class="column" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 280px;float: left;min-width: 279px;">
										<tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
											<td style="margin: 0;padding: 15px 10px 15px 3px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">

												<h5 class="" style="margin: 0;padding: 0;font-family: &quot;HelveticaNeue-Light&quot;, &quot;Helvetica Neue Light&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif;line-height: 1.1;margin-bottom: 15px;color: #000;font-weight: 900;font-size: 17px;">Contact Info:</h5>
												<p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;margin-bottom: 10px;font-weight: normal;font-size: 14px;line-height: 1.6;">Phone: <strong style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">+971 4 355 0666</strong><br style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
												</p><p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;margin-bottom: 10px;font-weight: normal;font-size: 14px;line-height: 1.6;">Fax: <strong style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">+971 4 355 0669</strong><br style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
                Email: <strong style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"><a href="emailto:info@mortgagehouseuae.com" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #2BA6CB;">info@mortgagehouseuae.com</a></strong><br style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
                Website: <strong style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"><a href="http://www.mortgagehouseuae.com" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #2BA6CB;">www.mortgagehouseuae.com</a></strong></p>

											</td>
										</tr>
									</table><!-- /column 2 -->

									<span class="clear" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;display: block;clear: both;"></span>

								</td>
							</tr>
						</table><!-- /social & contact -->

					</td>
				</tr>
			</table>
			</div><!-- /content -->

		</td>
		<td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"></td>
	</tr>
</table><!-- /BODY -->

<!-- FOOTER -->
<table class="footer-wrap" bgcolor="#29333D" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%;clear: both!important;">
	<tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
		<td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"></td>
		<td class="container" style="margin: 0 auto!important;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;display: block!important;max-width: 600px!important;clear: both!important;">

				<!-- content -->
				<div class="content" style="margin: 0 auto;padding: 15px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;max-width: 600px;display: block;">
				<table style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%;">
				<tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
					<td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
						<p style="color: #cccccc;margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;margin-bottom: 10px;font-weight: normal;font-size: 14px;line-height: 1.6;">
							&copy; 2015 Mortgagehouse. All Rights Reserved.
						</p>
					</td>
				</tr>
			</table>
				</div><!-- /content -->

		</td>
		<td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"></td>
	</tr>
</table><!-- /FOOTER -->

</body>
</html>
FILE;

return $template;
}

?>