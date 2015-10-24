<?php
/*
* Template Name: Home (Front Page)
*/
get_header();?>
<!-- Font template -->
<div class="container">
	<?php if(have_posts()): the_post(); ?>
	<div class="row">
		<div class="col-md-9 main-content-wrap">
			<?php the_content();?>
		</div>				<div class="col-md-3 right-sidebar">						<?php if ( is_active_sidebar( 'sidebar-widgets' ) ) : ?>				<div class="first front-widgets">					<?php dynamic_sidebar( 'sidebar-widgets' ); ?>				</div><!-- .first -->			<?php endif; ?>		  		</div>
	</div>
	<?php endif; ?>
</div><div class="footer-top">	<footer>		<div class="container">			<div class="row">				<div class="col-md-3 footer-top-widgets">					<?php if ( is_active_sidebar( 'sidebar-foot1' ) ) : ?>						<div class="first front-widgets">							<?php dynamic_sidebar( 'sidebar-foot1' ); ?>						</div><!-- .first -->					<?php endif; ?>				</div>				<div class="col-md-3 footer-top-widgets">					<?php if ( is_active_sidebar( 'sidebar-foot2' ) ) : ?>						<div class="first front-widgets">							<?php dynamic_sidebar( 'sidebar-foot2' ); ?>						</div><!-- .first -->					<?php endif; ?>				</div>				<div class="col-md-3 footer-top-widgets">					<?php if ( is_active_sidebar( 'sidebar-foot3' ) ) : ?>						<div class="first front-widgets">							<?php dynamic_sidebar( 'sidebar-foot3' ); ?>						</div><!-- .first -->					<?php endif; ?>				</div>				<div class="col-md-3 footer-top-widgets">					<?php if ( is_active_sidebar( 'sidebar-foot4' ) ) : ?>						<div class="first front-widgets">							<?php dynamic_sidebar( 'sidebar-foot4' ); ?>						</div><!-- .first -->					<?php endif; ?>				</div>			</div>		</div>		</footer></div>	
<?php get_footer();?>