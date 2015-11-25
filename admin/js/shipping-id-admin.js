jQuery(window).load(function(){
    jQuery('.shipping_id_services').sortable({
        connectWith: ".shipping_id_services",
        handle: '.service-sortable-header ',
        placeholder: 'service-sortable-placeholder',
        cursor:'move',
        axis:'y',
        scrollSensitivity:40,
        helper: 'clone',
        opacity: 0.65,
        stop:function(event,ui){
            shipping_services_row_indexes();
        }
    });

    function shipping_services_row_indexes() {
        jQuery('.shipping_id_services .service-sortable').each(function(index, el){
            jQuery('input.order', el).val( parseInt( jQuery(el).index('.shipping_id_services .service-sortable') ) );
        });
    };
    jQuery( '.service-sortable-header' ).on( 'click','.show', function() {
        $parent = jQuery(this).parents('.service-sortable');
        if($parent.is('.active')){
            jQuery(this).removeClass('active');
            $parent.removeClass('active');
        } else{
            jQuery('.service-sortable-header span').removeClass('active');
            jQuery('.service-sortable').removeClass('active');
            jQuery(this).addClass('active');
            $parent.addClass('active');
        }
    });
    jQuery( '.service-sortable-header' ).on( 'change','.courier_enabled', function() {
        $parent = jQuery(this).parents('.service-sortable');
        $services = $parent.find('.service_enabled');
        $show = $parent.find('.show');
        if(jQuery(this).is(':checked')){
            $show.addClass('active');
            $parent.addClass('active');
            $services.prop( "checked", true );
        } else{
            $services.prop( "checked", false );
            $show.removeClass('active');
            $parent.removeClass('active');

        }
    });
});
