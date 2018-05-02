jQuery(document).ready(function($){
    var custom_uploader;
    $('#upload_image_button').click(function(e) {
        e.preventDefault();
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }

        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });

        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#upload_image').val(attachment.url);
        });

        //Open the uploader dialog
        custom_uploader.open();
    });
    var custom_b_uploader;
    $('#upload_bimage_button').click(function(e) {
        e.preventDefault();
        //If the uploader object has already been created, reopen the dialog
        if (custom_b_uploader) {
            custom_b_uploader.open();
            return;
        }

        //Extend the wp.media object
        custom_b_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Background Image',
            button: {
                text: 'Choose Background Image'
            },
            multiple: false
        });

        //When a file is selected, grab the URL and set it as the text field's value
        custom_b_uploader.on('select', function() {
            attachment = custom_b_uploader.state().get('selection').first().toJSON();
            $('#upload_back_image').val(attachment.url);
        });

        //Open the uploader dialog
        custom_b_uploader.open();
    });
    var custom_bc_uploader;
    $('#upload_image_button_card').click(function(e) {
        e.preventDefault();
        //If the uploader object has already been created, reopen the dialog
        if (custom_bc_uploader) {
            custom_bc_uploader.open();
            return;
        }

        //Extend the wp.media object
        custom_bc_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });

        //When a file is selected, grab the URL and set it as the text field's value
        custom_bc_uploader.on('select', function() {
            attachment = custom_bc_uploader.state().get('selection').first().toJSON();
            $('#credit_card_image').val(attachment.url);
        });

        //Open the uploader dialog
        custom_bc_uploader.open();
    });
    var custom_formI_uploader;
    $('#upload_form_image').click(function(e) {
        e.preventDefault();
        //If the uploader object has already been created, reopen the dialog
        if (custom_formI_uploader) {
            custom_formI_uploader.open();
            return;
        }

        //Extend the wp.media object
        custom_formI_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });

        //When a file is selected, grab the URL and set it as the text field's value
        custom_formI_uploader.on('select', function() {
            attachment = custom_formI_uploader.state().get('selection').first().toJSON();
            $('#form_image').val(attachment.url);
        });

        //Open the uploader dialog
        custom_formI_uploader.open();
    });
    var custom_phone_uploader;
    $('#upload_form_image_phone').click(function(e) {
        e.preventDefault();
        //If the uploader object has already been created, reopen the dialog
        if (custom_phone_uploader) {
            custom_phone_uploader.open();
            return;
        }

        //Extend the wp.media object
        custom_phone_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Phone Icon',
            button: {
                text: 'Choose Phone Icon'
            },
            multiple: false
        });

        //When a file is selected, grab the URL and set it as the text field's value
        custom_phone_uploader.on('select', function() {
            attachment = custom_phone_uploader.state().get('selection').first().toJSON();
            $('#form_image_phone').val(attachment.url);
        });

        //Open the uploader dialog
        custom_phone_uploader.open();
    });
    $("form#update_site4_genesis").submit(function( event ) {
        event.preventDefault();
        $('.alertContainer').css({'display':'block'});
        $(".loading_site4").css({  'display': 'block' });
        $(".error_site4").css({'display': 'none'});
        $(".success_site4").css({'display': 'none'});
        var pUrl = $('#pUrl').val();
        console.log(jQuery('#ttcBack').val());
        var dataPost = $(this).serialize();
        //console.log(dataPost);
        $.ajax({
            type: "POST",
            url: pUrl,
            data:dataPost,
            dataType: 'json',
            success: function(msg){
                $(".loading_site4").css({  'display': 'none' });
                if (msg.d)
                {
                    $(".success_site4").css({'display': 'block'});
                    $(".success_site4").html(msg.d);
                }
                else{
                    $(".error_site4").css({'display': 'block'});
                }
                $('html, body').animate({scrollTop:0}, 'slow');
            }
        });

    });
    jQuery('#headerOption').on('change', function(){
        var opVal = jQuery(this).val();
        if(opVal == 1){
            jQuery('#headerOption2').fadeOut();
            jQuery('#headerOption1').fadeIn();
            jQuery('#header_option').val('1');
        }
        if(opVal == 2){
            jQuery('#headerOption1').fadeOut();
            jQuery('#headerOption2').fadeIn();
            jQuery('#header_option').val('2');
        }
    })
    /*$(function() {
        $(".set-1").mtabs();
    });*/
    $('.color').each( function() {
        //
        // Dear reader, it's actually very easy to initialize MiniColors. For example:
        //
        //  $(selector).minicolors();
        //
        // The way I've done it below is just for the demo, so don't get confused
        // by it. Also, data- attributes aren't supported at this time...they're
        // only used for this demo.
        //
        $(this).minicolors({
            control: $(this).attr('data-control') || 'hue',
            defaultValue: $(this).attr('data-defaultValue') || '',
            format: $(this).attr('data-format') || 'hex',
            keywords: $(this).attr('data-keywords') || '',
            inline: $(this).attr('data-inline') === 'true',
            letterCase: $(this).attr('data-letterCase') || 'lowercase',
            opacity: $(this).attr('data-opacity'),
            position: $(this).attr('data-position') || 'bottom left',
            swatches: $(this).attr('data-swatches') ? $(this).attr('data-swatches').split('|') : [],
            change: function(value, opacity) {
                if( !value ) return;
                if( opacity ) value += ', ' + opacity;
                if( typeof console === 'object' ) {
                    console.log(value);
                }
            },
            theme: 'bootstrap'
        });

    });

    jQuery('.switchRadio').on('change',function(){
        var ttc = jQuery(this).val();
        var idGet = jQuery(this).attr('data-getid');
        //alert(idGet);
        if(ttc == 1){
            jQuery('#' +idGet).css('display','block');
        }else{
            jQuery('#' +idGet).css('display','none');
        }
    })
    jQuery('.switchRadio1').on('change',function(){
        var ttc = jQuery(this).val();
        //alert(ttc);
        var idGet = jQuery(this).attr('data-getid');
        if(ttc == 1){
            jQuery('.' +idGet).css('display','block');
        }else{
            jQuery('.' +idGet).css('display','none');
        }
    })

});