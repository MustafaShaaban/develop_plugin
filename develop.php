<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/MustafaShaaban/develop_plugin
 * @since             1.0.0
 * @package           Develop
 *
 * @wordpress-plugin
 * Plugin Name:       Develop
 * Plugin URI:        https://github.com/MustafaShaaban/develop_plugin
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Mustafa Shaaban
 * Author URI:        https://github.com/MustafaShaaban/develop_plugin
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       develop
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'DEVELOP_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-develop-activator.php
 */
function activate_develop() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-develop-activator.php';
	Develop_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-develop-deactivator.php
 */
function deactivate_develop() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-develop-deactivator.php';
	Develop_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_develop' );
register_deactivation_hook( __FILE__, 'deactivate_develop' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-develop.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_develop() {

	$plugin = new Develop();
	$plugin->run();

}
run_develop();
