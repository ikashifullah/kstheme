<?php

/*

* Template Name: Home (Front Page)

*/

get_header (); ?>

    <!-- Font template -->

    <div class="container">

        <?php if ( have_posts () ): the_post (); ?>

            <div class="row">

                <div class="col-md-9 col-xs-12 main-content-wrap">

                    <h1 class="main-intro-heading"><?php the_title (); ?></h1>

                    <?php the_content (); ?>

                    <h2 class="programs-heading">Mortgage Finance Products</h2>
                    <?php

                    $args = array ( 'post_type' => 'loan_program', 'posts_per_page' => 4 );

                    $the_query = new WP_Query( $args );

                    if ( $the_query->have_posts () ) { ?>

                        <?php while ( $the_query->have_posts () ) {
                            $the_query->the_post (); ?>

                            <article class="programs-cont col-md-6 col-xs-12">

                                <div class="row">

                                    <div class="program-icon col-md-1 col-xs-1">

                                        <i class="fa <?php echo get_post_meta ( $the_query->post->ID, 'loan_program_icon_font_awesome_tag', true ) ?>"></i>

                                    </div>

                                    <div class="program-content col-md-11 col-xs-11">

                                        <h4 class="program-title">

                                            <a href="<?php the_permalink (); ?>"><?php echo get_the_title (); ?></a>

                                        </h4>

                                        <div class="program-text">

                                            <?php the_content ( '<p>Read More <i class="fa fa-chevron-circle-right"></i></p>' ); ?>


                                        </div>

                                    </div>

                                </div>

                            </article>

                        <?php }

                    } else {

                        echo 'Please add a few Loan Programs';

                    }

                    wp_reset_postdata ();

                    ?>
                    <div class="clear"></div>
                    <h2 class="services-heading">Our Services</h2>
                    <?php
                    $args = array ( 'post_type' => 'services', 'posts_per_page' => 6 );

                    $the_query = new WP_Query( $args );

                    if ( $the_query->have_posts () ) { ?>

                        <?php while ( $the_query->have_posts () ) {
                            $the_query->the_post (); ?>

                            <article class="programs-cont col-md-6 col-xs-12">

                                <div class="row">


								
                                    <!--<div class="program-icon col-md-1 col-xs-1">

                                        <i class="fa <?php //echo get_post_meta ( $the_query->post->ID, 'loan_program_icon_font_awesome_tag', true ) ?>"></i>

                                    </div>-->

                                    <div class="program-content col-md-12 col-xs-12">

										<h4 class="service-program-title">

                                            <a href="<?php the_permalink (); ?>"><?php echo get_the_title (); ?></a>

                                        </h4>

									
										 <?php echo get_the_post_thumbnail(); ?>
                                        

                                        <div class="program-text">

                                            <?php the_content ( '<p>Read More <i class="fa fa-chevron-circle-right"></i></p>' ); ?>

                                        </div>

                                    </div>

                                </div>

                            </article>

                        <?php }

                    } else {

                        echo 'Please add a few services';

                    }

                    wp_reset_postdata ();

                    ?>

                </div>

                <?php get_sidebar (); ?>


            </div>

        <?php endif; ?>

    </div>

<?php
$args = array ( 'post_type' => 'client-carousel' );

$the_query = new WP_Query( $args );

if ( $the_query->have_posts () ) { ?>
    <div class="carouse-bg">
        <div class="container">
            <div class="row col-md-12">
                <!-- Carousel -->
                <div id="owl-example" class="owl-carousel">


                    <?php while ( $the_query->have_posts () ) {
                        $the_query->the_post (); ?>

                        <div><?php echo get_the_post_thumbnail (); ?></div> <?php //remove one of the line; ?>
                        <div><?php echo get_the_post_thumbnail (); ?></div>

                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
<?php } else {

    //echo 'Please add a few clients logos!';

}

wp_reset_postdata ();

?>

    <div class="clear"></div>

<?php get_template_part ( 'template-parts/content', 'footertop' ); ?>

<?php get_footer (); ?>