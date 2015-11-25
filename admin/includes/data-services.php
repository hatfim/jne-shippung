<?php
/**
 * Rajaongkir Courier and Services
 */

return array(
    // Domestic
    'pos' => array(
        // Name of the service shown to the user
        'name'  => __( 'POS Indonesia (POS)', 'shipping-id' ),

        // Services which costs are merged if returned (cheapest is used). This gives us the best possible rate.
        'services' => array(
            'Surat Kilat Khusus'    => __( 'Surat Kilat Khusus', 'shipping-id' ),
            'Express Next Day'      => __( 'Express Next Day', 'shipping-id' ),
        )
    ),
    'jne' => array(
        // Name of the service shown to the user
        'name'  => __( 'Jalur Nugraha Ekakurir (JNE)', 'shipping-id' ),

        // Services which costs are merged if returned (cheapest is used). This gives us the best possible rate.
        'services' => array(
            'OKE'               => __( 'Ongkos Kirim Ekonomis', 'shipping-id' ),
            'REG'               => __( 'Layanan Reguler', 'shipping-id' ),
            'YES'               => __( 'Yakin Esok Sampai', 'shipping-id' ),
            'SPS'               => __( 'Super Speed', 'shipping-id' ),
        )
    ),
    'tiki' => array(
        // Name of the service shown to the user
        'name'  => __( 'Citra Van Titipan Kilat (TIKI)', 'shipping-id' ),

        // Services which costs are merged if returned (cheapest is used). This gives us the best possible rate.
        'services' => array(
            'HDS'               => __( 'Holiday Delivery Service', 'shipping-id' ),
            'ONS'               => __( 'Over Night Service', 'shipping-id' ),
            'REG'               => __( 'Regular Service', 'shipping-id' ),
            'ECO'               => __( 'Economi Service', 'shipping-id' ),
        )
    ),
);
