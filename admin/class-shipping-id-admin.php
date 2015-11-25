<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       hatfim.ydniw.com
 * @since      1.0.0
 *
 * @package    Shipping_Id
 * @subpackage Shipping_Id/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Shipping_Id
 * @subpackage Shipping_Id/admin
 * @author     Hatfim Ydniw <hatfim@ydniw.com>
 */
class Shipping_Id_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Shipping_Id_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Shipping_Id_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/shipping-id-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Shipping_Id_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Shipping_Id_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/shipping-id-admin.js', array( 'jquery' ), $this->version, false );

	}
    /**
     * An instance of this class should be passed to the run() function
     * defined in Woocommerce_Indonesia_Shipping_Loader as all of the hooks are defined
     * in that particular class.
     *
     * The Woocommerce_Indonesia_Shipping_Loader will then create the relationship
     * between the defined hooks and the functions defined in this
     * class.
     */

    public function init_class_shipping_id(){
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-shipping-id-method.php';

    }

    /**
     * Add method to WC
     */
    public function add_method( $methods ) {
        $methods[] = 'WC_Shipping_ID';
        return $methods;
    }

}
