<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mortgagehouse
 */

?>

<div class="row site-footer">
		<div class="container">
		<footer role="contentinfo">
			<div class="site-info">
				<?php
				wp_nav_menu( array(
					'menu'              => 'secondary',
					'container_class'   => 'footer-menu-cont',
					'theme_location'    => 'secondary',
					'depth'             => 1,
					'container'         => 'div',
				) );
				?>
				<p class="pull-right">&copy; Mortgage House LLC. All Rights Reserved.</p>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->		
	</div>
</div>

<?php wp_footer(); ?>
<script>
	jQuery('.navbar-lower').affix({
	  offset: {top: 50}
	});
	jQuery(document).ready(function() {
 
		jQuery("#owl-example").owlCarousel({
			autoPlay: true,
			pagination: false
		});
 
	});
</script>
</body>
</html>
