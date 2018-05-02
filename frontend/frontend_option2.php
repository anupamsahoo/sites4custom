<?php
//HOOK
add_action('wp_head','site4custom_head_option2');
if ( ! function_exists( 'site4custom_head_option2') ) {
    function site4custom_head_option2()
    {
        $data = site4_get_data();
        $css = "<style type='text/css'>";
        $css .= '.topBar{width:auto;font-size:'.$data['topBarData']['font_size'].';background:'.$data['topBarData']['background_color'].';padding:5px; color:'.$data['topBarData']['font_color'].';text-align:right;}';
        $css .= ".site4warper{width:100%; margin: 0; padding:0;min-height: 200px;background:" . $data['custom_header_data']['background_color'] . " url('" . $data['custom_header_data']['background_image'] . "');}";
        $css .= '.logoAreaOption2{width:100%;max-width:280px; margin: 0 auto;padding: 10px 0;text-align:center;}';
        $css .= ".site4BannerArea{width:100%;min-height:".$data['bannerData']['bannerHeight'].";overflow:hidden;background:".$data['bannerData']['bannerBackgroundColor']." url('".$data['bannerData']['bannerBackground']."') no-repeat;background-size:cover;}
        .site4BannerLeftC{width:90%; max-width:500px;padding-top:".$data['bannerData']['bannerTextTopMargin'].";float:left;}
        .site4BannerLeft{width:auto;padding:20px;font-weight:bold;background:".$data['bannerData']['bannerTextBackgroundColor'].";font-size:".$data['bannerData']['bannerTextSize'].";color:".$data['bannerData']['bannerTextFontColor'].";}
        .site4BannerRight{float:right;width:90%;max-width:400px;padding:15px;background:".$data['formData']['formBackgroundColor'].";min-height:".$data['bannerData']['bannerHeight'].";}
        @media only screen and (max-width: 1026px){
        .site4BannerLeftC{float:none; margin: 0 auto 20px auto;width:80%;max-width:80%;}
        .site4BannerRight{float:none; margin: 0 auto 20px auto;width:70%;max-width:70%;}
        }
        ";
        $css .= "</style>";
        echo $css;
    }
}
add_action( 'genesis_before_header', 'site4custom_frontend' );
if ( ! function_exists( 'site4custom_frontend') ) {
    function site4custom_frontend() {
        $data = site4_get_data();
        //print_r($data);
        echo '<div class="topBar"><div class="site4MainContainer">'.$data['topBarData']['text'].'</div></div>  
              <div class="site4warper"><div class="logoAreaOption2"><a href="' . get_home_url() . '"><img src="' . $data['custom_header_data']['logo'] . '"  alt=""/></div></div>';

    }
}
add_action( 'genesis_after_header', 'site4custom_after_header', 11 );
if ( ! function_exists( 'site4custom_after_header') ) {
    function site4custom_after_header()
    {
        $data = site4_get_data();
        $formID = $data['formData']['formShortcode'];
        $form = do_shortcode('[gravityform id="'.$formID.'"]');
        echo '<div class="site4BannerArea">
                <div class="site4MainContainer">
                <div class="site4BannerLeftC">
                    <div class="site4BannerLeft">'.$data['bannerData']['bannerText'].'</div>
                    </div>
                    <div class="site4BannerRight">'.$form.'</div>
                </div> 
             </div>';
    }
}