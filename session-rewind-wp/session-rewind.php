<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://sessionrewind.com
 * @since             1.0.0
 * @package           Session_Rewind
 *
 * @wordpress-plugin
 * Plugin Name:       Session Rewind
 * Plugin URI:        https://sessionrewind.com
 * Description:       Accurately record every session and issue.
 * Version:           1.1.1
 * Author:            Session Rewind
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       session-rewind
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'SESSION_REWIND_VERSION', '1.1.1' );


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-session-rewind-activator.php
 */
function activate_session_rewind() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-session-rewind-activator.php';
	Session_Rewind_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-session-rewind-deactivator.php
 */
function deactivate_session_rewind() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-session-rewind-deactivator.php';
	Session_Rewind_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_session_rewind' );
register_deactivation_hook( __FILE__, 'deactivate_session_rewind' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-session-rewind.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_session_rewind() {

	$plugin = new Session_Rewind();
	$plugin->run();

}
run_session_rewind();
