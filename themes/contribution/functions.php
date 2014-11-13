<?php if ( ! defined ( 'WPINC' ) )
{
	die;
}

/*
| ----------------------------------------------------------------------------------------------------------------------
| Required by WordPress.
| ----------------------------------------------------------------------------------------------------------------------
| Keep this file clean and only use it for requires.
|
*/

if ( ! defined ( '__DIR__' ) )
{
	define( '__DIR__' , dirname ( __FILE__ ) );
}


/**
 * Load Defined Constants
 */
require_once locate_template ( 'config/constants.php' );


/**
 * Load Theme Configuration
 */
require_once locate_template ( 'config/theme-config.php' );

/**
 * Load Theme Core Functions
 */
require_once locate_template ( 'system/WBB-Core/WBB-Core.php' );

/**
 * Load Theme Scripts and Styles
 */
require_once locate_template ( 'config/scripts.php' );

/**
 * Load extra included functions / Files
 */
require_once locate_template ( 'config/includes.php' );




