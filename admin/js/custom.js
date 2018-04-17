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
            title: 'Choose Credit Card Image',
            button: {
                text: 'Choose Credit Card Image'
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
    $("form#update_site4_genesis").submit(function( event ) {
        event.preventDefault();
        $('.alertContainer').css({'display':'block'});
        $(".loading_site4").css({  'display': 'block' });
        $(".error_site4").css({'display': 'none'});
        $(".success_site4").css({'display': 'none'});
        var pUrl = $('#pUrl').val();
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
    /*$(function() {
        $(".set-1").mtabs();
    });*/

});