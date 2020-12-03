<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.sinelogix.com/
 * @since             1.0.0
 * @package           Sponsors
 *
 * @wordpress-plugin
 * Plugin Name:       Sponsors Module
 * Plugin URI:        https://www.sinelogix.com/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Rucha Parmar
 * Author URI:        https://www.sinelogix.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       sponsors
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
define( 'SPONSORS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-sponsors-activator.php
 */
function activate_sponsors() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sponsors-activator.php';
	Sponsors_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-sponsors-deactivator.php
 */
function deactivate_sponsors() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sponsors-deactivator.php';
	Sponsors_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_sponsors' );
register_deactivation_hook( __FILE__, 'deactivate_sponsors' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-sponsors.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_sponsors() {

	$plugin = new Sponsors();
	$plugin->run();

	$sponsor = new Custom_Post_Type( 'Sponsor' );
}
run_sponsors();

function assign_category(){
	register_taxonomy_for_object_type('category', 'sponsor');
}
add_action('init','assign_category');
