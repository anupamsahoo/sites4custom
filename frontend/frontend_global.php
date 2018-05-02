<?php
//HOOK
add_action('wp_head','site4custom_head_option2');
if ( ! function_exists( 'site4custom_head_option2') ) {
    function site4custom_head_option2()
    {
        $data = site4_get_data();
        if($data['header_r_data']['phone_icon']) {
            $phoneIcon = $data['header_r_data']['phone_icon'];
         }else{
            $phoneIcon = WP_PLUGIN_URL . "/sites4custom/images/pIcon.png";
        }
        $css = "<style type='text/css'>";
        $css .= ".site4BannerRight .gform_heading{display:none !important;}.site4warper{width:100%; margin: 0; padding:0;min-height: 200px;background:" . $data['custom_header_data']['background_color'] . " url('" . $data['custom_header_data']['background_image'] . "');}
        .site4logoArea{width:280px; float: left; margin: 10px 0 0 0;padding: 0;text-align: left;}
        .site4HeaderRight{width:".$data['header_r_data']['container_width']."; float: right; margin: 40px 0 0 0; padding: 0;}
        .site4HeaderRightTop{width:100%;margin: 0 0 0 0;background:" . $data['header_r_data']['color2'] . ";float: left;}
        .site4HeaderRightTop a{color:" . $data['header_r_data']['fontColor1'] . "; text-decoration: none;}
        .site4HeaderRightTop a.phobenum{color:" . $data['header_r_data']['fontColor2'] . "; text-decoration: none;}
        .site4HeaderRightTopLeft{width:" . $data['header_r_data']['widthOne'] . "; float: left;background:" . $data['header_r_data']['color1'] . ";padding:10px 0;text-align: center;color:" . $data['header_r_data']['fontColor1'] . ";font-weight: 700;font-size: " . $data['header_r_data']['text1FontSize'] . ";}
        .site4HeaderRightTopRight{width:" . $data['header_r_data']['widthTwo'] . ";float: left;background:" . $data['header_r_data']['color2'] . " url('" . $phoneIcon ."') no-repeat left top;padding:15px 0 5px 46px;text-align: center;color:#404040;font-weight: 700;font-size: " . $data['header_r_data']['text2FontSize'] . ";}
        .site4HeaderRightTopBottom{width:100%;font-size: " . $data['header_r_data']['text3FontSize'] . "; background: " . $data['header_r_data']['color3'] . ";float: left;color:" . $data['header_r_data']['fontColor3'] . ";text-align: center;padding: 5px 0;}
        .site_4_phoneBar{display: none;}
        .deskHideN{display:none;}        
        @media only screen and (max-width: 1026px){
        .mobHide{display:none;}
        .deskHideN{display:block;}
            .site4HeaderRight{display: none;}
            .site4logoArea{float: none;width:100%;margin: 0 auto; text-align: center;}
            .site_4_phoneBar{display:block;width:100%;padding:5px 0;background:" . $data['tap_to_call_data']['bgcolor_tap'] . ";font-size:" . $data['tap_to_call_data']['font_size'] . ";text-align:center;color:" . $data['tap_to_call_data']['textcolor_tap'] . ";}
            .site_4_phoneBar a{text-decoration: none;color:" . $data['tap_to_call_data']['textcolor_tap'] . ";}
        }";
        $css .= '.topBar{width:auto;font-size:'.$data['topBarData']['font_size'].';background:'.$data['topBarData']['background_color'].';padding:5px; color:'.$data['topBarData']['font_color'].';text-align:right;}';
        $css .= '.logoAreaOption2{width:100%;max-width:280px; margin: 0 auto;padding: 10px 0;text-align:center;}';
        $css .= ".site4BannerArea{width:100%;min-height:".$data['bannerData']['bannerHeight'].";overflow:hidden;background:".$data['bannerData']['bannerBackgroundColor']." url('".$data['bannerData']['bannerBackground']."') no-repeat;background-size:cover;border-bottom:4px solid ".$data['bannerData']['border_bottom_color'].";}
        .site4BannerLeftC{width:90%; max-width:500px;padding-top:".$data['bannerData']['bannerTextTopMargin'].";float:left;}
        .site4BannerLeft{width:auto;padding:20px;font-weight:bold;background:".$data['bannerData']['bannerTextBackgroundColor'].";font-size:".$data['bannerData']['bannerTextSize'].";color:".$data['bannerData']['bannerTextFontColor'].";}
        .site4BannerRight{float:right;width:90%;max-width:400px;padding:15px;background:".$data['formData']['formBackgroundColor'].";min-height:".$data['bannerData']['bannerHeight'].";}
        .formImage{display:none;}
        @media only screen and (max-width: 1026px){
        .formImage{width:100%;margin: 0;display: block;text-align: center;}
        .formImage img{width:100%; max-width:300px;}
        .site4BannerLeftC{float:none; margin: 0 auto 20px auto;width:80%;max-width:80%;}
        .site4BannerRight{float:none; margin: 0 auto 20px auto;width:70%;max-width:70%;}
        }";
        if(is_front_page() || is_home()){
            $css .= '.site4BannerArea{display: block !important;}';
        }else{
            $css .= '.site4BannerArea{display: none !important;}';
        }
        $css .= "</style>";
        echo $css;
    }
}
add_action('genesis_before_header', 'site4custom_frontend');
if ( ! function_exists( 'site4custom_frontend') ) {
    function site4custom_frontend()
    {
        $data = site4_get_data();
        //print_r($data);
        if ($data['topBarData']['top_bar_show'] == 1) {
            echo '<div class="topBar"><div class="site4MainContainer">' . $data['topBarData']['text'] . '</div></div>';
        }
        echo '<div class="site4warper">';
        if($data['tap_to_call'] == 1) {
            echo '<div class="site_4_phoneBar"><a href="tel:1-' . $data['custom_header_data']['phone_number'] . '" style="color:#FFFFFF;">' . $data['custom_header_data']['phone_number'] . '</a></div>';
        }
        if($data['header_r'] == 1){
            if($data['custom_header_data']['page_meta']){
                $metaD = $data['custom_header_data']['page_meta'];
            }else{
                $metaD = get_bloginfo('description');
            }
            echo '<div class="site4MainContainer">
            <div class="site4logoArea mobHide"><a href="' . get_home_url() . '"><img src="' . $data['custom_header_data']['logo'] . '"  alt=""/></div>
            <div class="site_4_logoMobCon">
            <div class="row deskHideN" style="padding: 20px 20px;">
                <div class="col-xs-6"><a href="' . get_home_url() . '"><img src="' . $data['custom_header_data']['logo'] . '"  alt=""/></a></div>
                <div class="col-xs-6">
                    <div class="row">
                        <div class="col-xs-12">
                            <a href="#estimateSite4" data-toggle="modal" data-target="#estimateSite4" class="btn btn-primary btn-block search_ez" style="background: ' . $data['custom_header_data']['button1_color'] . ';color: ' . $data['custom_header_data']['button1_txt_color'] . ';border:1px solid ' . $data['custom_header_data']['button1_color'] . ';margin-top:14px;">' . $data['custom_header_data']['button1_txt'] . '</a>
                            <a href="tel:' . $data['custom_header_data']['phone_number'] . '" class="btn btn-primary btn-block search_ez" style="background: ' . $data['custom_header_data']['button2_color'] . ';color:' . $data['custom_header_data']['button2_txt_color'] . ';border:1px solid ' . $data['custom_header_data']['button2_color'] . ';">' . $data['custom_header_data']['button2_txt'] . '</a>
                        </div>
                        <div class="col-xs-12">
                            <p style="color:' . $data['custom_header_data']['page_meta_color'] . ';margin-top:20px;text-align:center;font-size:16px;">' . $metaD . '</p>
                        </div>
                    </div>                
                </div>
            </div>
            </div>

            <div class="site4HeaderRight">
                <div class="site4HeaderRightTop">
                    <div class="site4HeaderRightTopLeft"><a href="'.$data['header_r_data']['linkPage'].'">' . $data['header_r_data']['text1'] . '</a></div>
                    <div class="site4HeaderRightTopRight"><a href="tel:1-' . $data['custom_header_data']['phone_number'] . '" class="phobenum">' . $data['custom_header_data']['phone_number'] . '</a></div>
                </div>
                <div class="site4HeaderRightTopBottom">'.$data['header_r_data']['text2'].'</div>
            </div>
        </div>';
        }else {
            echo '<div class="logoAreaOption2"><a href="' . get_home_url() . '"><img src="' . $data['custom_header_data']['logo'] . '"  alt=""/></div>';
        }
        echo '</div>';
    }
}
add_action( 'genesis_after_header', 'site4custom_after_header', 11 );
if ( ! function_exists( 'site4custom_after_header') ) {
    function site4custom_after_header()
    {
        $data = site4_get_data();
        if($data['bannerData']['banner_show'] == 1) {
            $formID = $data['formData']['formShortcode'];
            $form = do_shortcode('[gravityform id="' . $formID . '"]');
            echo '<div class="site4BannerArea">
                <div class="site4MainContainer">
                <div class="site4BannerLeftC mobHide">
                    <div class="site4BannerLeft">' . $data['bannerData']['bannerText'] . '</div>
                    </div>
                     <div class="site4BannerRight">';
            if($data['formData']['form_image']) {
                echo '<div class="formImage"><img src="' . $data['formData']['form_image'] . '" alt=""></div>';
            }
            echo $form . '
                    </div>
                </div> 
             </div>';
        }
    }
}
add_action('wp_footer','site4custom_footer_form');
if ( ! function_exists( 'site4custom_footer_form') ) {
    function site4custom_footer_form(){
        $data = site4_get_data();
        $formID = $data['custom_header_data']['pop_form_id'];
        $formPop = do_shortcode('[gravityform id="' . $formID . '"]');
        echo '
        <div class="modal fade" id="estimateSite4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">' . $data['custom_header_data']['button1_txt'] . '</h4>
              </div>
              <div class="modal-body">
                 ' . $formPop . '
              </div>
            </div>
          </div>
        </div>
        ';
    }
}