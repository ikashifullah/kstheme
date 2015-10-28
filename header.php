<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mortgagehouse
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<title><?php bloginfo('name'); ?> <?php wp_title( '|', true, 'right' ); ?></title>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header id="masthead" class="site-header" role="banner">
		<nav class="navbar navbar-inverse navbar-static-top">
		  <div class="container social-bar">
			<div class="navbar-header">
			  <span class="navbar-brand"><i class="fa fa-mobile fa-lg"></i> Call us today 12354-123</span>
			</div>
			<div id="social-bar-links">
				<ul class="nav navbar-nav navbar-right">
					<li class="twitter-bg"><a href="#"><i class="fa fa-twitter fa-lg"></i></a></li>
					<li class="facebook-bg"><a href="#">&nbsp;<i class="fa fa-facebook fa-lg"></i></a></li>
					<li class="googleplus-bg"><a href="#"><i class="fa fa-google-plus fa-lg"></i></a></li>
					<li class="linkedin-bg"><a href="#"><i class="fa fa-linkedin fa-lg"></i></a></li>
					<li class="youtube-bg"><a href="#"><i class="fa fa-youtube fa-lg"></i></a></li>
				</ul>
			</div>	
		  </div>
		</nav>
		<nav class="navbar navbar-inverse navbar-lower affix-top">
		  <div class="container mh-menu-bar">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand mh-logo" href="<?php echo home_url(); ?>">
			  <?php 
			  $options = get_option('KSTheme_options');
				if(isset($options['logo'])) :
			  ?>
			  <img src="<?php echo $options['logo']; ?>" width="300" height="50" />
			  <?php else : ?>
				<img src="<?php echo KSTHEME_IMG_DIR.'/mortgage_house_logo.jpg'; ?>" width="300" height="50" />
			  <?php endif; ?>	
				<?php /*<img src="<?php echo $javo_tso->get('logo_url', JAVO_IMG_DIR.'/javo-house-logo-v01.png');?>">*/ ?>
			  </a>
			</div>
			<?php
				wp_nav_menu( array(
					'menu'              => 'primary',
					'theme_location'    => 'primary',
					'depth'             => 2,
					'container'         => 'div',
					'container_class'   => 'collapse navbar-collapse',
					'container_id'      => 'navbar',
					'menu_class'        => 'nav navbar-nav navbar-right',
					'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
					'walker'            => new wp_bootstrap_navwalker())
				);
			?>
		  </div>
		</nav>
</header>
<?php
if(function_exists('putRevSlider'))
	putRevSlider("rev-text");
?>