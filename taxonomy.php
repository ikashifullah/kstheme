<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package mortgagehouse
 */

get_header(); ?>

<div class="container">

	<div id="primary" class="content-area row">
		<main id="main" class="site-main col-md-9" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'taxonomy' ); ?>

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
