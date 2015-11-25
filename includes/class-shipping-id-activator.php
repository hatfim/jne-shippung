<?php

/**
 * Fired during plugin activation
 *
 * @link       hatfim.ydniw.com
 * @since      1.0.0
 *
 * @package    Shipping_Id
 * @subpackage Shipping_Id/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Shipping_Id
 * @subpackage Shipping_Id/includes
 * @author     Hatfim Ydniw <hatfim@ydniw.com>
 */
class Shipping_Id_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
        /**
         * Setup data transiet from raja ongkir
         *
         * Long Description.
         *
         * @since    1.0.0
         */
        $province = include( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/includes/data-province.php' );
        set_transient( 'shipping_id_province', $province, 3153600000 );
        $city = include( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/includes/data-city.php' );
        set_transient( 'shipping_id_city', $city, 3153600000 );

	}

}
