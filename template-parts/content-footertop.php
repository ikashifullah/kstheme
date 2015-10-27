<div class="footer-top">
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-4 footer-top-widgets">
					
				
					<?php if ( is_active_sidebar( 'sidebar-foot1' ) ) : ?>

						<div class="first front-widgets">

							<?php dynamic_sidebar( 'sidebar-foot1' ); ?>

						</div><!-- .first -->

					<?php endif; ?>
				</div>
				<div class="col-md-4 footer-top-widgets">
					<?php if ( is_active_sidebar( 'sidebar-foot2' ) ) : ?>

						<div class="first front-widgets">

							<?php dynamic_sidebar( 'sidebar-foot2' ); ?>

						</div><!-- .first -->

					<?php endif; ?>
				</div>
				<div class="col-md-4 footer-top-widgets">
				
					<?php if ( is_active_sidebar( 'sidebar-foot3' ) ) : ?>

						<div class="first front-widgets">

							<?php dynamic_sidebar( 'sidebar-foot3' ); ?>

						</div><!-- .first -->

					<?php endif; ?>
				</div>
				<?php /*
				<div class="col-md-3 footer-top-widgets">
					<?php if ( is_active_sidebar( 'sidebar-foot4' ) ) : ?>

						<div class="first front-widgets">

							<?php dynamic_sidebar( 'sidebar-foot4' ); ?>

						</div><!-- .first -->

					<?php endif; ?>
				</div> */ ?>
			</div>
		</div>	
	</footer>
</div>