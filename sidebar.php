<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mortgagehouse
 */

if ( ! is_active_sidebar( 'sidebar-widgets' ) ) {
	return;
}  
 
if( is_page(144)) { ?>
	
	<div  id="secondary" role="complementary" class="col-md-3 right-sidebar contact-sidebar">
			
	<?php if ( is_active_sidebar( 'contact-sidebar4' ) ) : ?>

		<div class="first front-widgets">

			<?php dynamic_sidebar( 'contact-sidebar4' ); ?>

		</div><!-- .first -->

	<?php endif; ?>
		  
</div>

	
<?php } else { ?>

<div  id="secondary" role="complementary" class="col-md-3 right-sidebar">
			
	<?php if ( is_active_sidebar( 'sidebar-widgets' ) ) : ?>

		<div class="first front-widgets">

			<?php dynamic_sidebar( 'sidebar-widgets' ); ?>

		</div><!-- .first -->

	<?php endif; ?>
		  
</div>
<?php } ?>