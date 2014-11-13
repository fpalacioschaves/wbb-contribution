<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * Dashboard. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://plugins.wbbdev.com
 * @since             1.0.0
 * @package           WBB_Contribution
 *
 * @wordpress-plugin
 * Plugin Name:       WBB_Contribution
 * Plugin URI:        http://plugins.webberty.com
 * Description:       Full control to User Contribution
 * Version:           1.0.0
 * Author:            Webberty
 * Author URI:        http://webberty.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wbb-contribution
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-wbb-contribution-activator.php';

/**
 * The code that runs during plugin deactivation.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-wbb-contribution-deactivator.php';

/** This action is documented in includes/class-wbb-contribution-activator.php */
register_activation_hook( __FILE__, array( 'WBB_Contribution_Activator', 'activate' ) );

/** This action is documented in includes/class-wbb-contribution-deactivator.php */
register_deactivation_hook( __FILE__, array( 'WBB_Contribution_Deactivator', 'deactivate' ) );

/**
 * The core plugin class that is used to define internationalization,
 * dashboard-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wbb-contribution.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_WBB_Contribution() {

	$plugin = new WBB_Contribution();
	$plugin->run();

}
run_WBB_Contribution();
