<?php

if ( ! function_exists( 'mortgagehouse_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mortgagehouse_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on mortgagehouse, use a find and replace
	 * to change 'mortgagehouse' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'mortgagehouse', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'mortgagehouse' ),
		'secondary' => esc_html__( 'Footer Menu', 'mortgagehouse' ),
		'sidebar' => esc_html__( 'Sidebar Menu', 'mortgagehouse' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'mortgagehouse_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // mortgagehouse_setup
add_action( 'after_setup_theme', 'mortgagehouse_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mortgagehouse_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'mortgagehouse_content_width', 640 );
}
add_action( 'after_setup_theme', 'mortgagehouse_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
/* 
function mortgagehouse_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'mortgagehouse' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'mortgagehouse_widgets_init' );
*/
/**
 * Enqueue scripts and styles.
 */
function mortgagehouse_scripts() {
	wp_enqueue_style( 'mortgagehouse-style', get_stylesheet_uri() );

	wp_enqueue_script( 'mortgagehouse-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'mortgagehouse-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mortgagehouse_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


register_sidebar( array(
    'name'         => __( 'Sidebar Widgets', 'mortgagehouse' ),
    'id'           => 'sidebar-widgets',
    'description'  => __( 'Display Pre-Approved Form and other Widgets in this area', 'mortgagehouse' ),
	'before_widget' => '<div class="widgets-wraps col-md-12 col-sm-6">',
	'after_widget' => '</div>',
    'before_title' => '<div class="widgettitle_wrap col-md-12"><h2 class="widgettitle"><span>',
    'after_title'  => '</span></h2></div>',
) );

register_sidebar( array(
    'name'         => __( 'Footer Sidebar1', 'mortgagehouse' ),
    'id'           => 'sidebar-foot1',
    'description'  => __( 'Widgets in this area will be shown on the footer side.', 'mortgagehouse' ),
	'before_widget' => '<div class="row widgets-wraps">',
	'after_widget' => '</div>',
    'before_title' => '<div class="widgettitle_wrap col-md-12">',
    'after_title'  => '</div>',
) );

register_sidebar( array(
    'name'         => __( 'Footer Sidebar2', 'mortgagehouse' ),
    'id'           => 'sidebar-foot2',
    'description'  => __( 'Widgets in this area will be shown on the footer side.', 'mortgagehouse' ),
	'before_widget' => '<div class="row widgets-wraps">',
	'after_widget' => '</div>',
    'before_title' => '<div class="widgettitle_wrap col-md-12"><h2 class="widgettitle"><span>',
    'after_title'  => '</span></h2></div>',
) );

register_sidebar( array(
    'name'         => __( 'Footer Sidebar3', 'mortgagehouse' ),
    'id'           => 'sidebar-foot3',
    'description'  => __( 'Widgets in this area will be shown on the footer side.', 'mortgagehouse' ),
    'before_widget' => '<div class="row widgets-wraps">',
	'after_widget' => '</div>',
    'before_title' => '<div class="widgettitle_wrap col-md-12"><h2 class="widgettitle"><span>',
    'after_title'  => '</span></h2></div>',
) );

register_sidebar( array(
    'name'         => __( 'Contact Us Sidebar4', 'mortgagehouse' ),
    'id'           => 'contact-sidebar4',
    'description'  => __( 'Widgets in this area will be shown aside only on contact us page.', 'mortgagehouse' ),
    'before_widget' => '<div class="widgets-wraps col-md-12 col-sm-6">',
	'after_widget' => '</div>',
    'before_title' => '<div class="widgettitle_wrap col-md-12"><h2 class="widgettitle"><span>',
    'after_title'  => '</span></h2></div>',
) );


add_action("init", "setPostType");

function setPostType(){

	// Loan Programs Custom Post Type
	$labels = array( 
		'name' => _x( 'Loan Programs', 'loan_program' ),
		'singular_name' => _x( 'Loan Program', 'loan_program' ),
		'add_new' => _x( 'Add New', 'loan_program' ),
		'add_new_item' => _x( 'Add New Loan Program', 'loan_program' ),
		'edit_item' => _x( 'Edit Loan Program', 'loan_program' ),
		'new_item' => _x( 'New Loan Program', 'loan_program' ),
		'view_item' => _x( 'View Loan Program', 'loan_program' ),
		'search_items' => _x( 'Search Loan Programs', 'loan_program' ),
		'not_found' => _x( 'No loan programs found', 'loan_program' ),
		'not_found_in_trash' => _x( 'No loan programs found in Trash', 'loan_program' ),
		'parent_item_colon' => _x( 'Parent Loan Program:', 'loan_program' ),
		'menu_name' => _x( 'Loan Programs', 'loan_program' ),
	);

	register_post_type( 'loan_program', 
		array( 
			'labels' => $labels,
			'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
			'public' => true,
		//	'taxonomies' => array('category')
		)
	);
	
	// Loan Programs Custom Post Type
	$program_labels = array( 
		'name' => _x( 'Loan Programs', 'loan program', 'mortgagehouse' ),
		'singular_name' => _x( 'Loan Program', 'loan program', 'mortgagehouse' ),
		'add_new' => _x( 'Add New', 'loan program', 'mortgagehouse' ),
		'add_new_item' => _x( 'Add New Loan Program', 'loan program', 'mortgagehouse' ),
		'edit_item' => _x( 'Edit Loan Program', 'loan program', 'mortgagehouse' ),
		'new_item' => _x( 'New Loan Program', 'loan program', 'mortgagehouse' ),
		'view_item' => _x( 'View Loan Program', 'loan program', 'mortgagehouse' ),
		'search_items' => _x( 'Search Loan Programs', 'loan program', 'mortgagehouse' ),
		'not_found' => _x( 'No loan programs found', 'loan program', 'mortgagehouse' ),
		'not_found_in_trash' => _x( 'No loan programs found in Trash', 'loan program', 'mortgagehouse' ),
		'parent_item_colon' => _x( 'Parent Loan Program:', 'loan program', 'mortgagehouse' ),
		'menu_name' => _x( 'Loan Programs', 'loan program', 'mortgagehouse' ),
	);

	register_post_type( 'loan_program', 
		array( 
			'labels' => $program_labels,
			'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
			'public' => true,
			'menu_icon' => 'dashicons-megaphone'
			
		)
	);

	register_taxonomy('program_category', 'loan_program', Array(

		'label' => __( 'Program Category', "mortgagehouse" ),

		//'rewrite' => array( 'slug' => 'property_amenities' ),

		'hierarchical' => true,

	));


	$services_labels = array( 
        'name' => _x( 'Services', 'services', 'mortgagehouse' ),
        'singular_name' => _x( 'Service', 'services', 'mortgagehouse' ),
        'add_new' => _x( 'Add New', 'services', 'mortgagehouse' ),
        'add_new_item' => _x( 'Add New Service', 'services', 'mortgagehouse' ),
        'edit_item' => _x( 'Edit Service', 'services', 'mortgagehouse' ),
        'new_item' => _x( 'New Service', 'services', 'mortgagehouse' ),
        'view_item' => _x( 'View Service', 'services', 'mortgagehouse' ),
        'search_items' => _x( 'Search Services', 'services', 'mortgagehouse' ),
        'not_found' => _x( 'No services found', 'services', 'mortgagehouse' ),
        'not_found_in_trash' => _x( 'No services found in Trash', 'services', 'mortgagehouse' ),
        'parent_item_colon' => _x( 'Parent Service:', 'services', 'mortgagehouse' ),
        'menu_name' => _x( 'Services', 'services', 'mortgagehouse' ),
    );

	register_post_type( 'services', 
		array( 
			'labels' => $services_labels,
			'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
			'public' => true,
			'menu_icon'   => 'dashicons-forms'
		)
	);
	
	$labels = array(
		'name' => _x( 'Client Carousel Images', 'carousel_image', 'mortgagehouse' ),
		'singular_name' => _x( 'Carousel Image', 'carousel_image', 'mortgagehouse' ),
		'add_new' => _x( 'Add New', 'carousel_image', 'mortgagehouse' ),
		'add_new_item' => _x( 'Add New Carousel Image', 'carousel_image', 'mortgagehouse' ),
		'edit_item' => _x( 'Edit Carousel Image', 'carousel_image', 'mortgagehouse' ),
		'new_item' => _x( 'New Carousel Image', 'carousel_image', 'mortgagehouse' ),
		'view_item' => _x( 'View Carousel Image', 'carousel_image', 'mortgagehouse' ),
		'search_items' => _x( 'Search Carousel Images', 'carousel_image', 'mortgagehouse' ),
		'not_found' => _x( 'No carousel images found', 'carousel_image', 'mortgagehouse' ),
		'not_found_in_trash' => _x( 'No carousel images found in Trash', 'carousel_image', 'mortgagehouse' ),
		'parent_item_colon' => _x( 'Parent Carousel Image:', 'carousel_image', 'mortgagehouse' ),
		'menu_name' => _x( 'Client Carousel', 'carousel_image', 'mortgagehouse' ),
		
	);

	register_post_type( 'client-carousel', 
		array(
			'labels' => $labels,
			'supports' => array( 'title', 'thumbnail','excerpt' ),
			'taxonomies' => array( 'category' ),
			'public' => true,
			'menu_icon' => 'dashicons-id',
		)
	);

	$labels = array(
		'name' => _x('Testimonials', 'post type general name'),
		'singular_name' => _x('Testimonial', 'post type singular name'),
		'add_new' => _x('Add New', 'testimonial'),
		'add_new_item' => __('Add New Testimonial'),
		'edit_item' => __('Edit Testimonial'),
		'new_item' => __('New Testimonial'),
		'view_item' => __('View Testimonial'),
		'search_items' => __('Search Testimonials'),
		'not_found' => __('No Testimonials found yet.'),
		'not_found_in_trash' => __('No Testimonials found in Trash'),
		'parent_item_colon' => '',
		'menu_name' => 'Testimonials'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'menu_icon' => 'dashicons-testimonial',
		'supports' => array('thumbnail','title', 'editor')
	);
	register_post_type('testimonial', $args);
    
}

add_shortcode( 'services-shortcode', 'display_services_post_type' );

function display_services_post_type(){
	$args = array(
		'post_type' => 'services',
		'post_status' => 'publish',
		'posts_per_page' => 4
	);

	$service_result = '';
	$query = new WP_Query( $args );
	if( $query->have_posts() ){
		
		while( $query->have_posts() ){
		$service_result .= '<div class="footer-service-cont">';	
			$query->the_post();
			$service_result .= '<h4><a href="'.get_permalink().'">' . get_the_title() . '</a></h4>';
			$service_result .= '<p>' . get_the_content('',FALSE,'') . '</p>';
		$service_result .= '</div>';	
		}
		
	}
	wp_reset_query();
	return $service_result;
}

add_shortcode( 'loan-program-shortcode', 'display_loan_program_post_type' );

function display_loan_program_post_type(){
	$args = array(
		'post_type' => 'loan_program',
		'post_status' => 'publish',
		'posts_per_page' => 4
	);

	$loan_result = '';
	$query = new WP_Query( $args );
	if( $query->have_posts() ){
		
		while( $query->have_posts() ){
		$loan_result .= '<div class="footer-service-cont">';	
			$query->the_post();
			$loan_result .= '<h4><a href="'.get_permalink().'">' . get_the_title() . '</a></h4>';
			$loan_result .= '<p>' . get_the_content('',FALSE,'') . '</p>';
		$loan_result .= '</div>';	
		}
		
	}
	wp_reset_query();
	return $loan_result;
}

add_filter('widget_text', 'do_shortcode');
