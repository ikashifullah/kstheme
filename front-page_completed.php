<?php
/*
* Template Name: Home (Front Page)
*/
get_header();?>
<!-- Font template -->
<div class="container">
	<?php if(have_posts()): the_post(); ?>
	<div class="row">
		<div class="col-md-9 col-xs-12 main-content-wrap">
		</div>
	</div>
	<?php endif; ?>
</div>
<?php get_footer();?>