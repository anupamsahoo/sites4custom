<?php
//HOOK
if ( ! function_exists( 'site4_get_data') ) {
    function site4_get_data()
    {
        global $wpdb;
        $data = array();
        $table_name = $wpdb->prefix . 'sites4custom';
        $myrows = $wpdb->get_row( "SELECT * FROM " . $table_name . " WHERE id='1'");
        $data['tap_to_call'] = $myrows->tap_to_call;
        $data['tap_to_call_data'] = @unserialize(base64_decode($myrows->tap_to_call_data));
        $data['custom_header'] = $myrows->custom_header;
        $data['custom_header_data'] = @unserialize(base64_decode($myrows->custom_header_data));
        $data['header_r'] = $myrows->header_right;
        $data['header_r_data'] = @unserialize(base64_decode($myrows->header_right_data));
        $data['slider'] = $myrows->slider;
        $data['sliderData'] = @unserialize(base64_decode($myrows->slider_data));
        return $data;
    }
}
add_action('get_header', 'site4_remove_page_titles');
if ( ! function_exists( 'site4_remove_page_titles') ) {
    function site4_remove_page_titles()
    {
        $slider = site4_get_data();
        if($slider['slider'] == '1'){
            if (is_front_page()) {
                remove_action('genesis_header', 'genesis_do_header');
                remove_action('genesis_header', 'genesis_header_markup_open', 5);
                remove_action('genesis_header', 'genesis_header_markup_close', 15);
                add_action('genesis_header', 'site4_custom_slider');
            }
        }
    }
}
if ( ! function_exists( 'site4_custom_slider') ) {
    function site4_custom_slider() {
        $data = site4_get_data();
        if ( function_exists( 'soliloquy' ) ) { soliloquy( $data['sliderData']['slidercode'] ); }
        echo "<style type='text/css'>
                .soliloquy-viewport img{height:" . $data['sliderData']['sliderHeight'] . "px !important;}
                .soliloquy-outer-container{height:" . $data['sliderData']['sliderHeight'] . "px !important;}
                @media only screen and (max-width: 970px){.soliloquy-outer-container{height:auto !important;}.soliloquy-viewport img{height:auto !important;}}
                </style>";
    }
}
add_action('wp_head','site4custom_head');
if ( ! function_exists( 'site4custom_head') ) {
    function site4custom_head(){
        $data = site4_get_data();
        $css = "<style type='text/css'>";
        $css .= ".site-inner {max-width: 1140px !important;}.fl-row-fixed-width{max-width:1115px !important;}.fl-row-content-wrap{padding:0 !important;}";
        $css .= ".site-inner{padding-top:70px !important;}@media only screen and (max-width: 800px){.site-inner{padding-top:0 !important;}}";
        $css .= ".site4warper{width:100%; margin: 0; padding:0;min-height: 200px;background:" . $data['custom_header_data']['background_color'] . " url('" . $data['custom_header_data']['background_image'] . "');}
        .site4MainContainer{width:100%;max-width: 1100px; margin: 0 auto;}
        .site4logoArea{width:280px; float: left; margin: 10px 0 0 0;padding: 0;text-align: left;}
        .site4HeaderRight{width:".$data['header_r_data']['container_width']."; float: right; margin: 40px 0 0 0; padding: 0;}
        .site4HeaderRightTop{width:100%;margin: 0 0 0 0;background:" . $data['header_r_data']['color2'] . ";float: left;}
        .site4HeaderRightTop a{color:" . $data['header_r_data']['fontColor1'] . "; text-decoration: none;}
        .site4HeaderRightTop a.phobenum{color:" . $data['header_r_data']['fontColor2'] . "; text-decoration: none;}
        .site4HeaderRightTopLeft{width:" . $data['header_r_data']['widthOne'] . "; float: left;background:" . $data['header_r_data']['color1'] . ";padding:10px 0;text-align: center;color:" . $data['header_r_data']['fontColor1'] . ";font-weight: 700;font-size: " . $data['header_r_data']['text1FontSize'] . ";}
        .site4HeaderRightTopRight{width:" . $data['header_r_data']['widthTwo'] . ";float: left;background:" . $data['header_r_data']['color2'] . " url('" . WP_PLUGIN_URL . "/sites4custom/images/pIcon.png') no-repeat left top;padding:15px 0 5px 46px;text-align: center;color:#404040;font-weight: 700;font-size: " . $data['header_r_data']['text2FontSize'] . ";}
        .site4HeaderRightTopBottom{width:100%;font-size: " . $data['header_r_data']['text3FontSize'] . "; background: " . $data['header_r_data']['color3'] . ";float: left;color:" . $data['header_r_data']['fontColor3'] . ";text-align: center;padding: 5px 0;}
        .site_4_phoneBar{display: none;}
        header.site-header{display: none !important;}
        .site-inner{padding-top:70px !important;}
        @media only screen and (max-width: 1026px){
            .site4HeaderRight{display: none;}
            .site4logoArea{float: none;width:100%;margin: 0 auto; text-align: center;}
            .site_4_phoneBar{display:block;width:100%;padding:5px 0;background:" . $data['tap_to_call_data']['bgcolor_tap'] . ";font-size:" . $data['tap_to_call_data']['font_size'] . ";text-align:center;color:" . $data['tap_to_call_data']['textcolor_tap'] . ";}
            .site_4_phoneBar a{text-decoration: none;color:" . $data['tap_to_call_data']['textcolor_tap'] . ";}
        }";
        $css .= '</style>';
        echo $css;
    }
}
add_action('wp_footer','site4custom_footer');
if ( ! function_exists( 'site4custom_footer') ) {
    function site4custom_footer(){
        $js = "<script type='text/javascript'>";
        $js .= "jQuery(document).ready(function() {
            var stickyNavTop = jQuery('.nav-primary'').offset().top;
            var stickyNav = function(){
                var scrollTop = jQuery(window).scrollTop();
                if (scrollTop > stickyNavTop) {
                    jQuery('.nav-primary'').addClass('stickyNavBar');
                } else {
                    jQuery('.nav-primary'').removeClass('stickyNavBar');
                }
            };

            stickyNav();
            jQuery(window).scroll(function() {
                stickyNav();
            });
        });";
        $js .= '</script>';
        echo $js;
    }
}
add_action( 'genesis_before_header', 'site4custom_frontend' );
if ( ! function_exists( 'site4custom_frontend') ) {
    function site4custom_frontend() {
        $data = site4_get_data();
        //print_r($data);
        echo '        
        <div class="site4warper">
        <div class="site_4_phoneBar"><a href="tel:1-' . $data['custom_header_data']['phone_number'] . '" style="color:#FFFFFF;">' . $data['custom_header_data']['phone_number'] . '</a></div>
        <div class="site4MainContainer">
            <div class="site4logoArea"><a href="' . get_home_url() . '"><img src="' . $data['custom_header_data']['logo'] . '"  alt=""/></div>
            <div class="site4HeaderRight">
                <div class="site4HeaderRightTop">
                    <div class="site4HeaderRightTopLeft"><a href="'.$data['header_r_data']['linkPage'].'">' . $data['header_r_data']['text1'] . '</a></div>
                    <div class="site4HeaderRightTopRight"><a href="tel:1-' . $data['custom_header_data']['phone_number'] . '" class="phobenum">' . $data['custom_header_data']['phone_number'] . '</a></div>
                </div>
                <div class="site4HeaderRightTopBottom">'.$data['header_r_data']['text2'].'</div>
            </div>
        </div>
</div>';

    }
}