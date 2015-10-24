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
	'before_widget' => '<div class="row widgets-wraps">',
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
    'before_title' => '<div class="widgettitle_wrap col-md-12"><h2 class="widgettitle"><span>',
    'after_title'  => '</span></h2></div>',
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
    'name'         => __( 'Footer Sidebar4', 'mortgagehouse' ),
    'id'           => 'sidebar-foot4',
    'description'  => __( 'Widgets in this area will be shown on the footer side.', 'mortgagehouse' ),
    'before_widget' => '<div class="row widgets-wraps">',
	'after_widget' => '</div>',
    'before_title' => '<div class="widgettitle_wrap col-md-12"><h2 class="widgettitle"><span>',
    'after_title'  => '</span></h2></div>',
) );