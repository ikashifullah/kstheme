<?php
/**
 * mortgagehouse functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package mortgagehouse
 */

 
@error_reporting(E_ALL);
@ini_set("log_errors", 1);



$kstheme_appPath = pathinfo( __FILE__ ); // App Path
$kstheme_site_url = get_site_url(); // Site URL
@ini_set("error_log", $kstheme_appPath['dirname']."/error.log");

define( 'KSTHEME_APP_PATH', $kstheme_appPath['dirname'] );
define( 'KSTHEME_SITE_URL', $kstheme_site_url );
define( 'KSTHEME_THEME_DIR', get_template_directory_uri() );
define( 'KSTHEME_SYS_DIR', KSTHEME_APP_PATH. '/library' );
define( 'KSTHEME_IMG_DIR', KSTHEME_THEME_DIR."/images");   // Images folder
define("KSTHEME_CLS_DIR", KSTHEME_SYS_DIR."/classes");	// Classes
define("KSTHEME_WG_DIR", KSTHEME_SYS_DIR."/widgets");	// Widgets Folder
define("KSTHEME_ADM_DIR", KSTHEME_SYS_DIR."/admin");	// Widgets Folder

// Includes : Basic or default functions and included files
require_once KSTHEME_SYS_DIR.'/define.php';
require_once KSTHEME_SYS_DIR."/load.php";      // loading functions, classes, shotcode, widgets
require_once KSTHEME_SYS_DIR.'/enqueue.php';
require_once KSTHEME_SYS_DIR.'/wp_init.php';




