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

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'mortgagehouse' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'mortgagehouse' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'mortgagehouse' ), 'mortgagehouse', '<a href="https://kashifullahwebdeveloper.wordpress.com/" rel="designer">Kashif Ullah</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<script>
	jQuery('.navbar-lower').affix({
	  offset: {top: 50}
	});
</script>
</body>
</html>
