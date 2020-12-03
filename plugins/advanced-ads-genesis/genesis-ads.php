<?php
/**
 * Advanced Ads – Genesis
 *
 * Plugin Name:       Advanced Ads – Genesis
 * Plugin URI:        https://wpadvancedads.com/add-ons/genesis/
 * Description:       Place ads on various positions within Genesis themes
 * Version:           1.0.5
 * Author:            Thomas Maier
 * Author URI:        https://wpadvancedads.com
 * Text Domain:       advanced-ads-genesis
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Only load if not already existing (maybe within another plugin I created).
if ( ! class_exists( 'Advanced_Ads_Genesis_Plugin' ) ) {

	// Load basic path and url to the plugin.
	define( 'AAG_BASE_PATH', plugin_dir_path( __FILE__ ) );
	define( 'AAG_BASE_URL', plugin_dir_url( __FILE__ ) );
	define( 'AAG_BASE_DIR', dirname( plugin_basename( __FILE__ ) ) ); // Directory of the plugin without any paths.

	// Plugin slug and textdomain.
	define( 'AAG_SLUG', 'advanced-ads-genesis' );

	define( 'AAG_VERSION', '1.0.5' );
	define( 'AAG_PLUGIN_URL', 'https://wpadvancedads.com' );
	define( 'AAG_PLUGIN_NAME', 'Genesis Ads' );

	include_once plugin_dir_path( __FILE__ ) . 'classes/plugin.php';

	if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
		include_once plugin_dir_path( __FILE__ ) . 'admin/admin.php';
		new Advanced_Ads_Genesis_Admin();
	} else {
		include_once plugin_dir_path( __FILE__ ) . 'public/public.php';
		new Advanced_Ads_Genesis();
	}
}
