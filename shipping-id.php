<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              hatfim.ydniw.com
 * @since             1.0.0
 * @package           Shipping_Id
 *
 * @wordpress-plugin
 * Plugin Name:       Shipping ID
 * Plugin URI:        https://github.com/hatfim/shipping-id
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Hatfim Ydniw
 * Author URI:        hatfim.ydniw.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       shipping-id
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-shipping-id-activator.php
 */
function activate_shipping_id() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-shipping-id-activator.php';
	Shipping_Id_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-shipping-id-deactivator.php
 */
function deactivate_shipping_id() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-shipping-id-deactivator.php';
	Shipping_Id_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_shipping_id' );
register_deactivation_hook( __FILE__, 'deactivate_shipping_id' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-shipping-id.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_shipping_id() {

	$plugin = new Shipping_Id();
	$plugin->run();

}
if (in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )) {
    run_shipping_id();
}

