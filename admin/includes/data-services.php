<?php

/**
 * Rajaongkir Courier and Services
 */
return array(
    // Domestic
    'pos' => array(
        // Name of the service shown to the user
        'name'  => __( 'POS Indonesia (POS)', 'wc_id_shipping' ),

        // Services which costs are merged if returned (cheapest is used). This gives us the best possible rate.
        'services' => array(
            'Surat Kilat Khusus'    => __( 'Surat Kilat Khusus', 'wc_id_shipping' ),
            'Express Next Day'      => __( 'Express Next Day', 'wc_id_shipping' ),
        )
    ),
    'jne' => array(
        // Name of the service shown to the user
        'name'  => __( 'Jalur Nugraha Ekakurir (JNE)', 'wc_id_shipping' ),

        // Services which costs are merged if returned (cheapest is used). This gives us the best possible rate.
        'services' => array(
            'OKE'               => __( 'Ongkos Kirim Ekonomis', 'wc_id_shipping' ),
            'REG'               => __( 'Layanan Reguler', 'wc_id_shipping' ),
            'YES'               => __( 'Yakin Esok Sampai', 'wc_id_shipping' ),
            'SPS'               => __( 'Super Speed', 'wc_id_shipping' ),
        )
    ),
    'tiki' => array(
        // Name of the service shown to the user
        'name'  => __( 'Citra Van Titipan Kilat (TIKI)', 'wc_id_shipping' ),

        // Services which costs are merged if returned (cheapest is used). This gives us the best possible rate.
        'services' => array(
            'HDS'               => __( 'Holiday Delivery Service', 'wc_id_shipping' ),
            'ONS'               => __( 'Over Night Service', 'wc_id_shipping' ),
            'REG'               => __( 'Regular Service', 'wc_id_shipping' ),
            'ECO'               => __( 'Economi Service', 'wc_id_shipping' ),
        )
    ),
);
