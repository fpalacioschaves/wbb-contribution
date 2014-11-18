<?php
/*
| ----------------------------------------------------------------------------------------------------------------------
| Styles and Scripts
| ----------------------------------------------------------------------------------------------------------------------
| Add here all your functions that include styles / Scripts into your theme
|
*/


/**
 * Load Scripts for this theme in front end
 */
function themeScripts ()
{
	wp_enqueue_script ( 'jquery' , "//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" );
	wp_enqueue_script ( 'bootstrap-js' , '' . get_template_directory_uri () . '/assets/js/bootstrap.min.js' , array( 'jquery' ) , NULL , TRUE );
	wp_enqueue_script ( 'modernizr' , '' . get_template_directory_uri () . '/assets/js/modernizr.js' , array( 'jquery' ) , NULL , FALSE );
	wp_enqueue_script ( 'temp' , '' . get_template_directory_uri () . '/assets/js/temp.js' , array( 'jquery' ) , NULL , FALSE );
}

add_action ( 'wp_enqueue_scripts' , 'themeScripts' );


//----------------------------------------------------------------------------------------------------------------------

/**
 * Load Styles for this theme here
 */
function themeStyles ()
{

	wp_enqueue_style ( 'bootstrap-css' , '' . get_template_directory_uri () . '/assets/css/bootstrap.min.css' , array() , '3.1.1' , 'all' );
	wp_enqueue_style ( 'general-css' , '' . get_template_directory_uri () . '/assets/css/general.css' , array() , '1.0.0' , 'all' );


}

add_action ( 'wp_enqueue_scripts' , 'themeStyles' );
