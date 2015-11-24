<?php
/**
 * WC_ID_Shipping
 *
 * @extends WC_Shipping_Method
 */
function wc_id_shipping() {
    if ( ! class_exists( 'WC_ID_Shipping' ) ) {
        class WC_ID_Shipping extends WC_Shipping_Method {
            /**
             * Constructor for your shipping class
             *
             * @access public
             * @return void
             */

            public function __construct() {
                $this->id                 = 'wc_id_shipping';
                $this->method_title       = __( 'Indonesia Shipping Basic', 'wc-id-shipping' );
                $this->method_description = __( 'The <strong>Indonesia Shipping Basic Version</strong> extension obtains rates dynamically from the Rajaongkir.com API during cart/checkout.', 'wc-id-shipping' );
                $this->province           = get_transient( $this->id . '_province' );
                $this->city               = get_transient( $this->id . '_city' );
                $this->services           = include( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/includes/data-services.php' );

                $this->init();
            }
        /**
         * Init your settings
         *
         * @access public
         * @return void
         */
            public function init() {
                // Load the settings API
                $this->init_form_fields(); // This is part of the settings API. Override the method to add your own settings
                $this->init_settings(); // This is part of the settings API. Loads settings you previously init.

                $this->enabled          = isset( $this->settings['enabled'] ) ? $this->settings['enabled'] : $this->enabled;
                $this->title            = isset( $this->settings['title'] ) ? $this->settings['title'] : $this->method_title;
                $this->api_key          = isset( $this->settings['api_key'] ) ? $this->settings['api_key'] : '';
                $this->origin_province  = isset( $this->settings['origin_province'] ) ? $this->settings['origin_province'] : '';
                $this->origin_city      = isset( $this->settings['origin_city'] ) ? $this->settings['origin_city'] : '';
                $this->origin_city      = isset( $this->settings['min_weight'] ) ? $this->settings['min_weight'] : 1;
                $this->custom_services   = isset( $this->settings['services'] ) ? $this->settings['services'] : array();
                if ( false === $this->province ) {
                    $this->get_province();
                }
                if ( false === $this->city ) {
                    $this->get_city();
                }

                // Save settings in admin if you have any defined
                add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
            }

            /**
             * Initialise Settings Form Fields
             */
            public function init_form_fields() {
                $this->form_fields  = array(
                    'enabled'          => array(
                        'title'           => __( 'Enable Indinonesia Shipping', 'wc_id_shipping' ),
                        'type'            => 'checkbox',
                        'label'           => __( 'Enable this shipping method', 'wc_id_shipping' ),
                        'default'         => 'no'
                    ),
                    'title'            => array(
                        'title'           => __( 'Method Title', 'wc_id_shipping' ),
                        'type'            => 'text',
                        'description'     => __( 'This controls the title which the user sees during checkout.', 'wc_id_shipping' ),
                        'default'         => __( 'Indonesia Shipping', 'wc_id_shipping' ),
                        'desc_tip'        => true
                    ),

                    'api_key'           => array(
                        'title'           => __( 'Raja Ongkir API Key', 'wc_id_shipping' ),
                        'type'            => 'text',
                        'default'         => '',
                    ),
                    'origin_city'   => array(
                        'title'           => __( 'Store Base Location', 'wc_id_shipping' ),
                        'type'     => 'select',
                        'class'    => 'wc-enhanced-select',
                        'options'  => array( '' => __( 'Select a store base location&hellip;', 'wc_id_shipping' ) ) + $this->options_city()
                    ),
                    'min_weight'   => array(
                        'title'           => __( 'Min Weight', 'wc_id_shipping' ),
                        'type'     => 'number',
                        'label'           => __( 'In kilogram', 'wc_id_shipping' ),
                        'default'         => 1
                    ),
                    'services' => array(
                        'title'             => __( 'Select Services', 'wc_id_shipping' ),
                        'type'              => 'services',
                    )

                );
            }

            /**
             * generate_services_html function.
             */
            public function generate_services_html() {
                ob_start();
                include( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/woocommerce-indonesia-shipping-method-display.php' );
                return ob_get_clean();
            }

            /**
             * validate_services_field function.
             *
             * @access public
             * @param mixed $key
             * @return void
             */
            public function validate_services_field( $key ) {
                $services         = array();
                $posted_services  = $_POST['wc_id_shipping_service'];
                foreach ( $posted_services as $code => $settings ) {

                    $services[ $code ] = array(
                        'order'              => wc_clean( $settings['order'] )
                    );

                    foreach ( $this->services[$code]['services'] as $key => $name ) {
                        $services[ $code ][ $key ]['enabled'] = isset( $settings[ $key ]['enabled'] ) ? true : false;
                        $services[ $code ][ $key ]['adjustment'] = wc_clean( $settings[ $key ]['adjustment'] );
                        $services[ $code ][ $key ]['adjustment_percent'] = wc_clean( $settings[ $key ]['adjustment_percent'] );
                    }

                }

                return $services;
            }


            private function get_province(){
                $args = array(
                    'timeout'     => 30,
                    'headers'     => array(
                        'key'           => $this->api_key,
                        'content-type'  => 'application/x-www-form-urlencoded'
                    )
                );
                $response = wp_remote_get( 'http://api.rajaongkir.com/starter/province', $args);
                if ( is_wp_error( $response ) ) {
                    return;
                }
                $data = json_decode(wp_remote_retrieve_body( $response ));
                $province = array();
                foreach($data->rajaongkir->results as $key => $value){
                    $province[$value->province_id] = $value->province;
                }
                set_transient( $this->id . '_province', $province, 3153600000 );
            }

            private function options_city(){
                $options = array();

                foreach ($this->city as $key => $value) {
                    $options[$key] = $value['name'];
                }
                return $options;
            }

            private function get_city(){
                $args = array(
                    'timeout'     => 30,
                    'headers'     => array(
                        'key'           => $this->api_key,
                        'content-type'  => 'application/x-www-form-urlencoded'
                    )
                );
                $response = wp_remote_get( 'http://api.rajaongkir.com/starter/city', $args);
                if ( is_wp_error( $response ) ) {
                    return;
                }
                $data = json_decode(wp_remote_retrieve_body( $response ));

                $city = array();
                foreach($data->rajaongkir->results as $key => $value){
                    $city[$value->city_id]['province_id'] = $value->province_id;
                    $city[$value->city_id]['name'] = $value->city_name;
                }
                set_transient( $this->id . '_city', $city, 3153600000 );
            }
        }
    }
}
add_action( 'woocommerce_shipping_init', 'wc_id_shipping' );



function add_wc_id_shipping_method( $methods ) {
        $methods[] = 'WC_ID_Shipping';
        return $methods;
}

add_filter( 'woocommerce_shipping_methods', 'add_wc_id_shipping_method' );
