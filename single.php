<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package mortgagehouse
 */

get_header();
?>

<div class="container">

	<div id="primary" class="content-area">
		<main id="main" class="site-main col-md-9" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php
			if ( 'services' == get_post_type() || 'loan_program' == get_post_type() ):
				get_template_part( 'template-parts/content', 'custom_post_type' );
			else:
				get_template_part( 'template-parts/content', 'single' );
			endif;
			?>
			<?php the_post_navigation(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
		<?php get_sidebar(); ?>
	</div><!-- #primary -->
</div>

<?php get_template_part( 'template-parts/content', 'footertop' ); ?>	
<?php get_footer(); ?>
