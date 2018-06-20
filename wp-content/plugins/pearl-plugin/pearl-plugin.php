<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.pearlthemes.com
 * @since             1.0.0
 * @package           Pearl_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Pearl Plugin
 * Plugin URI:        https://themeforest.net/user/pearlthemes/portfolio
 * Description:       Pearl Plugin provides Portfolio, Testimonial, Services and Team post types, contact form and related functionality.
 * Version:           1.5.0
 * Author:            PearlThemes
 * Author URI:        https://www.pearlthemes.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       pearl-plugin
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-pearl-plugin-activator.php
 */
function activate_pearl_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pearl-plugin-activator.php';
	Pearl_Plugin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-pearl-plugin-deactivator.php
 */
function deactivate_pearl_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pearl-plugin-deactivator.php';
	Pearl_Plugin_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_pearl_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_pearl_plugin' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-pearl-plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_pearl_plugin() {

	$plugin = new Pearl_Plugin();
	$plugin->run();

}
run_pearl_plugin();
