<tr valign="top" id="service_options">
    <th scope="row" class="titledesc"><?php _e( 'Services', 'wc_id_shipping' ); ?></th>
    <td class="forminp">
            <style type="text/css">
                .wc_id_shipping_services td {
                    vertical-align: middle;
                    padding: 4px 7px;
                }
                .wc_id_shipping_services th {
                    padding: 9px 7px;
                }
                .wc_id_shipping_services td input {
                    margin-right: 4px;
                }
                .wc_id_shipping_services .check-column {
                    vertical-align: middle;
                    text-align: left;
                    padding: 0 7px;
                }
                .wc_id_shipping_services th.sort {
                    width: 16px;
                }
                .wc_id_shipping_services td.sort {
                    cursor: move;
                    width: 16px;
                    padding: 0 16px;
                    cursor: move;
                    background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAYAAADED76LAAAAHUlEQVQYV2O8f//+fwY8gJGgAny6QXKETRgEVgAAXxAVsa5Xr3QAAAAASUVORK5CYII=) no-repeat center;
                }
            </style>

        <table class="wc_id_shipping_services widefat">
            <thead>
                <th class="sort">&nbsp;</th>
                <th><?php _e( 'Couries(s)', 'wc_id_shipping' ); ?></th>
            </thead>
            <tbody>
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
                        <tr class="sortable">
                            <td class="sort">
                                <input type="hidden" class="order" name="wc_id_shipping_service[<?php echo $code; ?>][order]" value="<?php echo isset( $this->custom_services[ $code ]['order'] ) ? $this->custom_services[ $code ]['order'] : ''; ?>" />
                            </td>
                            <td>
                                <h3><?php echo $values['name']; ?></h3>
                                <table class="wc_id_shipping_services widefat">
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
                                                        <input type="checkbox" name="wc_id_shipping_service[<?php echo $code; ?>][<?php echo $key; ?>][enabled]" <?php checked( ( ! isset( $this->custom_services[ $code ][ $key ]['enabled'] ) || ! empty( $this->custom_services[ $code ][ $key ]['enabled'] ) ), true ); ?> />
                                                        <?php echo $name; ?>
                                                    </label>
                                                </td>
                                                <td>
                                                    <?php echo get_woocommerce_currency_symbol(); ?><input type="text" name="wc_id_shipping_service[<?php echo $code; ?>][<?php echo $key; ?>][adjustment]" placeholder="N/A" value="<?php echo isset( $this->custom_services[ $code ][ $key ]['adjustment'] ) ? $this->custom_services[ $code ][ $key ]['adjustment'] : ''; ?>" size="4" />

                                                </td>
                                                <td>
                                                    <input type="text" name="wc_id_shipping_service[<?php echo $code; ?>][<?php echo $key; ?>][adjustment_percent]" placeholder="N/A" value="<?php echo isset( $this->custom_services[ $code ][ $key ]['adjustment_percent'] ) ? $this->custom_services[ $code ][ $key ]['adjustment_percent'] : ''; ?>" size="4" />%

                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                            </td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
        <script type="text/javascript">
            jQuery(window).load(function(){
                jQuery('.wc_id_shipping_services tbody').sortable({
                    items:'tr.sortable',
                    cursor:'move',
                    axis:'y',
                    handle: '.sort',
                    scrollSensitivity:40,
                    forcePlaceholderSize: true,
                    helper: 'clone',
                    opacity: 0.65,
                    placeholder: 'wc-metabox-sortable-placeholder',
                    start:function(event,ui){
                        ui.item.css('background-color','#f6f6f6');
                    },
                    stop:function(event,ui){
                        ui.item.removeAttr('style');
                        royal_mail_services_row_indexes();
                    }
                });

                function royal_mail_services_row_indexes() {
                    jQuery('.wc_id_shipping_services tbody tr.sortable').each(function(index, el){
                        jQuery('input.order', el).val( parseInt( jQuery(el).index('.wc_id_shipping_services tr.sortable') ) );
                    });
                };

            });
        </script>
    </td>
</tr>
