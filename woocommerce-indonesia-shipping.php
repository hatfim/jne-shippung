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
 * @package           Woocommerce_Indonesia_Shipping
 *
 * @wordpress-plugin
 * Plugin Name:       Woocommerce Indonesia Shipping
 * Plugin URI:        https://github.com/hatfim/woocommerce-indonesia-shipping
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Hatfim Ydniw
 * Author URI:        hatfim.ydniw.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woocommerce-indonesia-shipping
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woocommerce-indonesia-shipping-activator.php
 */
function activate_woocommerce_indonesia_shipping() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-indonesia-shipping-activator.php';
	Woocommerce_Indonesia_Shipping_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woocommerce-indonesia-shipping-deactivator.php
 */
function deactivate_woocommerce_indonesia_shipping() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-indonesia-shipping-deactivator.php';
	Woocommerce_Indonesia_Shipping_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_woocommerce_indonesia_shipping' );
register_deactivation_hook( __FILE__, 'deactivate_woocommerce_indonesia_shipping' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-indonesia-shipping.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woocommerce_indonesia_shipping() {

	$plugin = new Woocommerce_Indonesia_Shipping();
	$plugin->run();

}
if (in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )) {
    run_woocommerce_indonesia_shipping();
}
