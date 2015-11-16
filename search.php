<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package mortgagehouse
 */

get_header(); ?>

<div class="container">

	<div id="primary" class="content-area">

		<?php if ( have_posts () ): ?>

			<h1 class="main-intro-heading"><?php printf( esc_html__( 'Search Results for: %s', 'mortgagehouse' ), '<span>' . get_search_query() . '</span>' ); ?></h1>

			<main id="main" class="site-main col-md-9" role="main">


			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'search' ); ?>

			<?php endwhile; // End of the loop. ?>

			<?php the_post_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>
			</main><!-- #main -->

		<?php get_sidebar(); ?>
	</div><!-- #primary -->
</div>

<?php get_template_part( 'template-parts/content', 'footertop' ); ?>
<?php get_footer(); ?>