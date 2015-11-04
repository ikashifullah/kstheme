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
	if ( $property_info_provided == 'yes' ) {
		$tr = "<tr>
			<td> Property Info </td>
			<td> {$property_info} </td>
		</tr>";
	}
	//$LogoSrc = KSTHEME_IMG_DIR .'/mortgage_house_logo.jpg';
	$LogoSrc ='http://mortgagehouseuae.com/images/log.jpg';
	$template =<<<FILE
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- If you delete this meta tag, Half Life 3 will never be released. -->
<meta name="viewport" content="width=device-width" />

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>	Pre-Approval Form: Mortgagehouse </title>
<style>
/* -------------------------------------
		GLOBAL
------------------------------------- */
* {
	margin:0;
	padding:0;
}
* { font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; }

img {
	max-width: 100%;
}
.collapse {
	margin:0;
	padding:0;
}
body {
	-webkit-font-smoothing:antialiased;
	-webkit-text-size-adjust:none;
	width: 100%!important;
	height: 100%;
}


/* -------------------------------------
		ELEMENTS
------------------------------------- */
a { color: #2BA6CB;}

.btn {
	text-decoration:none;
	color: #FFF;
	background-color: #666666;
	padding:10px 16px;
	font-weight:bold;
	margin-right:10px;
	text-align:center;
	cursor:pointer;
	display: inline-block;
}

p.callout {
	padding:15px;
	background-color:#ECF8FF;
	margin-bottom: 15px;
}
.callout a {
	font-weight:bold;
	color: #2BA6CB;
}

table.social {
/* 	padding:15px; */
	background-color: #ebebeb;

}
.social .soc-btn {
	padding: 3px 7px;
	font-size:12px;
	margin-bottom:10px;
	text-decoration:none;
	color: #FFF;font-weight:bold;
	display:block;
	text-align:center;
}
a.fb { background-color: #3B5998 !important; }
a.tw { background-color: #1daced !important; }
a.gp { background-color: #DB4A39 !important; }
a.yt { background-color: #c4302b !important; }
a.li { background-color: #007bb5 !important; }

.sidebar .soc-btn {
	display:block;
	width:100%;
}

/* -------------------------------------
		HEADER
------------------------------------- */
table.head-wrap { width: 100%;}

.header.container table td.logo { padding: 15px; }
.header.container table td.label { padding: 15px; padding-left:0px;}


/* -------------------------------------
		BODY
------------------------------------- */
table.body-wrap { width: 100%;}


/* -------------------------------------
		FOOTER
------------------------------------- */
table.footer-wrap { width: 100%;	clear:both!important;
}
.footer-wrap .container td.content  p { border-top: 1px solid rgb(215,215,215); padding-top:15px;}
.footer-wrap .container td.content p {
	font-size:10px;
	font-weight: bold;

}


/* -------------------------------------
		TYPOGRAPHY
------------------------------------- */
h1,h2,h3,h4,h5,h6 {
font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; line-height: 1.1; margin-bottom:15px; color:#000;
}
h1 small, h2 small, h3 small, h4 small, h5 small, h6 small { font-size: 60%; color: #6f6f6f; line-height: 0; text-transform: none; }

h1 { font-weight:200; font-size: 44px;}
h2 { font-weight:200; font-size: 37px;}
h3 { font-weight:500; font-size: 27px;}
h4 { font-weight:500; font-size: 23px;}
h5 { font-weight:900; font-size: 17px;}
h6 { font-weight:900; font-size: 14px; text-transform: uppercase; color:#FFFFFF;}

.collapse { margin:0!important;}

p, ul {
	margin-bottom: 10px;
	font-weight: normal;
	font-size:14px;
	line-height:1.6;
}
p.lead { font-size:17px; }
p.last { margin-bottom:0px;}

ul li {
	margin-left:5px;
	list-style-position: inside;
}

/* -------------------------------------
		SIDEBAR
------------------------------------- */
ul.sidebar {
	background:#ebebeb;
	display:block;
	list-style-type: none;
}
ul.sidebar li { display: block; margin:0;}
ul.sidebar li a {
	text-decoration:none;
	color: #666;
	padding:10px 16px;
/* 	font-weight:bold; */
	margin-right:10px;
/* 	text-align:center; */
	cursor:pointer;
	border-bottom: 1px solid #777777;
	border-top: 1px solid #FFFFFF;
	display:block;
	margin:0;
}
ul.sidebar li a.last { border-bottom-width:0px;}
ul.sidebar li a h1,ul.sidebar li a h2,ul.sidebar li a h3,ul.sidebar li a h4,ul.sidebar li a h5,ul.sidebar li a h6,ul.sidebar li a p { margin-bottom:0!important;}



/* ---------------------------------------------------
		RESPONSIVENESS
		Nuke it from orbit. It's the only way to be sure.
------------------------------------------------------ */

/* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
.container {
	display:block!important;
	max-width:600px!important;
	margin:0 auto!important; /* makes it centered */
	clear:both!important;
}

/* This should also be a block element, so that it will fill 100% of the .container */
.content {
	padding:15px;
	max-width:600px;
	margin:0 auto;
	display:block;
}

/* Let's make sure tables in the content area are 100% wide */
.content table { width: 100%; }


/* Odds and ends */
.column {
	width: 300px;
	float:left;
}
.column tr td { padding: 15px 10px 15px 3px; }
.column-wrap {
	padding:0!important;
	margin:0 auto;
	max-width:600px!important;
}
.column table { width:100%;}
.social .column {
	width: 280px;
	min-width: 279px;
	float:left;
}
table.form-table  {
}
table.form-table td {
	padding: 5px;
	border: 1px solid #ccc;
	font-size: 14px;
}
/* Be sure to place a .clear element after each set of columns, just to be safe */
.clear { display: block; clear: both; }


/* -------------------------------------------
		PHONE
		For clients that support media queries.
		Nothing fancy.
-------------------------------------------- */
@media only screen and (max-width: 600px) {

	a[class="btn"] { display:block!important; margin-bottom:10px!important; background-image:none!important; margin-right:0!important;}

	div[class="column"] { width: auto!important; float:none!important;}

	table.social div[class="column"] {
		width:auto!important;
	}
	table.form-table div[class="column"] {
		width:auto!important;
	}

}

</style>

</head>

<body bgcolor="#FFFFFF">

<!-- HEADER -->
<table class="head-wrap" bgcolor="#29333D">
	<tr>
		<td></td>
		<td class="header container" >

				<div class="content">
				<table>
					<tr>
						<td><img src="{$LogoSrc}" width="300" /></td>
						<td align="right"><h6 class="collapse">Pre Approval Form</h6></td>
					</tr>
				</table>
				</div>

		</td>
		<td></td>
	</tr>
</table><!-- /HEADER -->


<!-- BODY -->
<table class="body-wrap">
	<tr>
		<td></td>
		<td class="container" bgcolor="#FFFFFF">

			<div class="content">
			<table>
				<tr>
					<td>
						<h3>Hi, {$fullname}</h3>
						<p class="lead">Below is the information you provided us through Pre-Approval Form on Mortgagehouse Website</p>
						<table class="form-table" width="100%" cellpadding="5">
							<tr>
								<td>Full Name:</td>
								<td>{$fullname}</td>
							</tr>
							<tr>
								<td>Date of Birth:</td>
								<td>{$dob}</td>
							</tr>
							<tr>
								<td rowspan="2">Contact Nos:</td>
								<td>{$contact_work}</td>
							</tr>
							<tr>
								<td>{$contact_home}</td>
							</tr>
							<tr>
								<td rowspan="2">Emails:</td>
								<td>{$email_work}</td>
							</tr>
							<tr>
								<td>{$email_home}</td>
							</tr>
							<tr>
								<td>Nationality:</td>
								<td>{$nationality_country}</td>
							</tr>
							<tr>
								<td rowspan="2">Employment: Employed</td>
								<td>{$company}</td>
							</tr>
							<tr>
								<td>{$description}</td>
							</tr>
							<tr>
								<td>I want to:</td>
								<td>{$want}</td>
							</tr>
							<tr>
								<td>What amount of finance you are looking for (estimated): </td>
								<td>{$finance_amount}</td>
							</tr>
							{$tr}
						</table>
						<!-- Callout Panel -->
						<p class="callout">
							Feel free to contact us any time, visit our website. <a href="#">Click it! &raquo;</a>
						</p><!-- /Callout Panel -->

						<!-- social & contact -->
						<table class="social" width="100%">
							<tr>
								<td>

									<!-- column 1 -->
									<table align="left" class="column">
										<tr>
											<td>
												<h5 class="">Connect with Us:</h5>
												<p class="">
													<a href="#" class="soc-btn" style="background-color: #3B5998;">Facebook</a>
													<a href="#" class="soc-btn" style="background-color: #1daced;">Twitter</a>
													<a href="#" class="soc-btn" style="background-color: #DB4A39;">Google+</a>
													<a href="#" class="soc-btn" style="background-color: #007bb5;">LinkedIn</a>
													<a href="#" class="soc-btn" style="background-color: #c4302b;">Youtube</a>
												</p>
											</td>
										</tr>
									</table><!-- /column 1 -->

									<!-- column 2 -->
									<table align="left" class="column">
										<tr>
											<td>

												<h5 class="">Contact Info:</h5>
												<p>Phone: <strong>+971 4 355 0666</strong><br/>
												<p>Fax: <strong>+971 4 355 0669</strong><br/>
                Email: <strong><a href="emailto:info@mortgagehouseuae.com">info@mortgagehouseuae.com</a></strong><br/>
                Website: <strong><a href="http://www.mortgagehouseuse.com">www.mortgagehouseuse.com</a></strong></p>

											</td>
										</tr>
									</table><!-- /column 2 -->

									<span class="clear"></span>

								</td>
							</tr>
						</table><!-- /social & contact -->

					</td>
				</tr>
			</table>
			</div><!-- /content -->

		</td>
		<td></td>
	</tr>
</table><!-- /BODY -->

<!-- FOOTER -->
<table class="footer-wrap" bgcolor="#29333D">
	<tr>
		<td></td>
		<td class="container">

				<!-- content -->
				<div class="content">
				<table>
				<tr>
					<td>
						<p style="color: #cccccc;">
							&copy; 2015 Mortgagehouse. All Rights Reserved.
						</p>
					</td>
				</tr>
			</table>
				</div><!-- /content -->

		</td>
		<td></td>
	</tr>
</table><!-- /FOOTER -->

</body>
</html>
FILE;

return $template;
}

?>