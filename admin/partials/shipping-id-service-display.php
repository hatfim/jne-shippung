<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       hatfim.ydniw.com
 * @since      1.0.0
 *
 * @package    Shipping_Id
 * @subpackage Shipping_Id/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->


<tr valign="top" id="service_options">
    <th scope="row" class="titledesc"><?php _e( 'Services', 'wc_id_shipping' ); ?></th>
    <td class="forminp">


        <div class="shipping_id_services stuffbox">
            <?php
                $sort = 0;
                $this->ordered_services = array();

                foreach ( $this->services as $code => $values ) {

                    if ( isset( $this->custom_services[ $code ]['order'] ) ) {
                        $sort = $this->custom_services[ $code ]['order'];
                    }

                    while ( isset( $this->ordered_services[ $sort ] ) )
                        $sort++;

                    $this->ordered_services[ $sort ] = array( $code, $values );

                    $sort++;
                }

                ksort( $this->ordered_services );


                foreach ( $this->ordered_services as $value ) {
                    $code   = $value[0];
                    $values = $value[1];
                    if ( ! isset( $this->custom_services[ $code ] ) )
                        $this->custom_services[ $code ] = array();
                    ?>
                    <div class="service-sortable">
                        <input type="hidden" class="order" name="shipping_id_service[<?php echo $code; ?>][order]" value="<?php echo isset( $this->custom_services[ $code ]['order'] ) ? $this->custom_services[ $code ]['order'] : ''; ?>" />
                        <div class="service-sortable-header">
                            <h3><?php echo $values['name']; ?></h3>
                            <p><span class="show">SHOW</span></p>
                            <p class="enabled">
                                <input type="checkbox" id="<?php echo $code ; ?>" class="courier_enabled" name="shipping_id_service[<?php echo $code; ?>][enabled]" <?php checked( ( ! isset( $this->custom_services[ $code ]['enabled'] ) || ! empty( $this->custom_services[ $code ]['enabled'] ) ), true ); ?> />
                                  <label for="shipping_id_service[<?php echo $code; ?>][enabled]"><span></span></label>
                            </p>
                        </div>
                        <div class="service-sortable-content ">

                            <table class="widefat">
                                <thead>
                                    <th><?php _e( 'Couries(s)', 'wc_id_shipping' ); ?></th>
                                    <th><?php echo sprintf( __( 'Price Adjustment (%s)', 'wc_id_shipping' ), get_woocommerce_currency_symbol() ); ?></th>
                                    <th><?php _e( 'Price Adjustment (%)', 'wc_id_shipping' ); ?></th>
                                </thead>
                                <tbody>
                                    <?php foreach ( $values['services'] as $key => $name ) : ?>
                                        <tr>
                                            <td>
                                                <label>
                                                    <input class="service_enabled" type="checkbox" name="shipping_id_service[<?php echo $code; ?>][<?php echo $key; ?>][enabled]" <?php checked( ( ! isset( $this->custom_services[ $code ][ $key ]['enabled'] ) || ! empty( $this->custom_services[ $code ][ $key ]['enabled'] ) ), true ); ?> />
                                                    <?php echo $name; ?>
                                                </label>
                                            </td>
                                            <td>
                                                <?php echo get_woocommerce_currency_symbol(); ?><input type="text" name="shipping_id_service[<?php echo $code; ?>][<?php echo $key; ?>][adjustment]" placeholder="N/A" value="<?php echo isset( $this->custom_services[ $code ][ $key ]['adjustment'] ) ? $this->custom_services[ $code ][ $key ]['adjustment'] : ''; ?>" size="4" />

                                            </td>
                                            <td>
                                                <input type="text" name="shipping_id_service[<?php echo $code; ?>][<?php echo $key; ?>][adjustment_percent]" placeholder="N/A" value="<?php echo isset( $this->custom_services[ $code ][ $key ]['adjustment_percent'] ) ? $this->custom_services[ $code ][ $key ]['adjustment_percent'] : ''; ?>" size="4" />%

                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php
                }
            ?>
        </div>
    </td>
</tr>
