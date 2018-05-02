<?php
//Admin Function
if (is_admin()) {
    add_action('admin_menu', 'sites4custom_menu');
    function sites4custom_menu()
    {
        $dir = plugin_dir_path( __DIR__ );
        add_menu_page( 'Site4 Custom', 'Sites4 Custom', 'manage_options', 'sites4custom', 'sites4custom_admin', esc_url( plugins_url( 'images/icon.jpg', __FILE__ ) ), '59' );

    }

}

add_action('admin_enqueue_scripts', 'site4genesis_scripts');
function site4genesis_scripts()
{
    if (isset($_GET['page']) && $_GET['page'] == 'sites4custom') {
        wp_enqueue_media();
        wp_register_script('ColorPicker', esc_url( plugins_url( 'js/colorPicker/jquery.minicolors.js', __FILE__ ) ), array('jquery'));
        wp_enqueue_script('ColorPicker');
        wp_register_style('color-css', esc_url( plugins_url( 'js/colorPicker/jquery.minicolors.css', __FILE__ ) ), false, '1.0.0');
        wp_enqueue_style('color-css');
        wp_register_script('upload-js', esc_url( plugins_url( 'js/custom.js', __FILE__ ) ), array('jquery'),'1.0.0' );
        wp_enqueue_script('upload-js');
        wp_register_style( 'custom_wp_admin_css', esc_url( plugins_url( 'css/admin.css', __FILE__ ) ), false, '1.3.0' );
        wp_enqueue_style( 'custom_wp_admin_css' );
    }
}

function sites4custom_admin()
{
    global $wpdb;
    $headerOption = sites4_action('select','sites4custom_header_option','',1);
    $table_name = $wpdb->prefix . 'sites4custom';
    $myrows = $wpdb->get_row("SELECT * FROM " . $table_name . " WHERE id='1'");
    $tap_to_call = @unserialize(base64_decode($myrows->tap_to_call_data));
    $custom_header_data = @unserialize(base64_decode($myrows->custom_header_data));
    $header_r_data = @unserialize(base64_decode($myrows->header_right_data));
    $headerOption2 = sites4_action('select','sites4custom_option2_data','',1);
    $topBarData = @unserialize(base64_decode($headerOption2->top_bar));
    $bannerData = @unserialize(base64_decode($headerOption2->banner_area));
    $formData = @unserialize(base64_decode($headerOption2->form_section));
    //print_r($custom_header_data);
    $html = '<h1>Sites4 Custom</h1><hr />';
    $html .= '<form name="update_site4_genesis" id="update_site4_genesis" action="admin.php?page=sites4custom" method="POST" enctype="multipart/form-data">';
    $html .= '<div class="sites4Container">';
    $html .= '<div class="alertContainer">';
    $html .= '<div class="success_site4"><strong>Well done!</strong> You successfully read this important alert message.</div>';
    $html .= '<div class="error_site4"><strong>Oh snap!</strong> Change a few things up and try submitting again.</div>';
    $html .= '</div>';
    if ($headerOption->header_option == 1){
        $html .= '<input type="hidden" name="header_option" id="header_option" value="1">';
    }else{
        $html .= '<input type="hidden" name="header_option" id="header_option" value="2">';
    }
    $html .= '<h2>Global Setting</h2>';
    $html .= '<div class="sites4SubContainer">';
    $html .= '<div class="inputContainerF"><label for="upload_image">Select or upload logo</label><br>
                <input id="upload_image" type="text" size="36" class="inputClass" name="ad_image" placeholder="http://" value="'.$custom_header_data['logo'].'"/>
                    <input id="upload_image_button" class="button" type="button" value="Upload Image"/></div>';
    $html .= '</div>';
    $html .= '<div class="sites4SubContainer">';
    $html .= '<div class="inputContainerF"><label for="upload_back_image">Select or upload Background Image</label><br>
                    <input id="upload_back_image" type="text" size="36"  class="inputClass" name="upload_back_image" placeholder="http://"
                           value="'.$custom_header_data['background_image'].'"/>
                    <input id="upload_bimage_button" class="button" type="button" value="Upload Background Image"/></div>';
    $html .= '</div>';
    $html .= '<div class="sites4SubContainer">';
    $html .= '<div class="inputContainerL"><label for="backgroundColor">Background Color</label><input type="text" id="backgroundColor" name="backgroundColor" value="'.$custom_header_data['background_color'].'" data-format="rgb" data-opacity="1" data-swatches="#fff|#000|#f00|#0f0|#00f|#ff0|rgba(0,0,255,0.5)|rgba(255,255,255,0)" class="color inputClass"> </div>';
    $html .= '<div class="inputContainerR"><label for="phoneNumber">Phone Number</label><input type="text" id="phoneNumber" name="phoneNumber" value="'.$custom_header_data['phone_number'].'" class="inputClass"> </div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="sites4Container"><h2>Mobile Header Right Setting</h2>';
    $html .= '<div class="sites4SubContainer">';
    $html .='<div class="inputContainerL"><label for="mobButton1">Button1 Color</label><input type="text" id="mobButton1" name="mobButton1" value="'.$custom_header_data['button1_color'].'" data-format="rgb" data-opacity="1" data-swatches="#fff|#000|#f00|#0f0|#00f|#ff0|rgba(0,0,255,0.5)|rgba(255,255,255,0)" class="color inputClass"> </div>';
    $html .='<div class="inputContainerR"><label for="mobButtonTxt1">Button1 Text</label><input type="text" id="mobButtonTxt1" name="mobButtonTxt1" value="'.$custom_header_data['button1_txt'].'" class="inputClass"> </div>';
    $html .='<div class="inputContainerL" style="margin-top: 15px;"><label for="mobButton1txtC">Button1 Text Color</label><input type="text" id="mobButton1txtC" name="mobButton1txtC" value="'.$custom_header_data['button1_txt_color'].'" data-format="rgb" data-opacity="1" data-swatches="#fff|#000|#f00|#0f0|#00f|#ff0|rgba(0,0,255,0.5)|rgba(255,255,255,0)" class="color inputClass"> </div>';
    $html .= '</div>';
    $html .= '<div class="sites4SubContainer">';
    $html .='<div class="inputContainerL"><label for="mobButton2">Button2 Color</label><input type="text" id="mobButton2" name="mobButton2" value="'.$custom_header_data['button2_color'].'" data-format="rgb" data-opacity="1" data-swatches="#fff|#000|#f00|#0f0|#00f|#ff0|rgba(0,0,255,0.5)|rgba(255,255,255,0)" class="color inputClass"> </div>';
    $html .='<div class="inputContainerR"><label for="mobButtonTxt2">Button2 Text</label><input type="text" id="mobButtonTxt2" name="mobButtonTxt2" value="'.$custom_header_data['button2_txt'].'" class="inputClass"> </div>';
    $html .='<div class="inputContainerL" style="margin-top: 15px;"><label for="mobButton2txtC">Button2 Text Color</label><input type="text" id="mobButton2txtC" name="mobButton2txtC" value="'.$custom_header_data['button2_txt_color'].'" data-format="rgb" data-opacity="1" data-swatches="#fff|#000|#f00|#0f0|#00f|#ff0|rgba(0,0,255,0.5)|rgba(255,255,255,0)" class="color inputClass"> </div>';
    $html .= '</div>';
    $html .= '<div class="sites4SubContainer">';
    $html .='<div class="inputContainerL"><label for="pageMeta">Page Meta for Mobile</label><input type="text" id="pageMeta" name="pageMeta" value="'.$custom_header_data['page_meta'].'" class="inputClass"> </div>';
    $html .='<div class="inputContainerR"><label for="pageMetaTxtC">Page Meta Text Color</label><input type="text" id="pageMetaTxtC" name="pageMetaTxtC" value="'.$custom_header_data['page_meta_color'].'" data-format="rgb" data-opacity="1" data-swatches="#fff|#000|#f00|#0f0|#00f|#ff0|rgba(0,0,255,0.5)|rgba(255,255,255,0)" class="color inputClass"> </div>';
    $html .= '</div>';
    $html .= '<div class="sites4SubContainer">';
    $html .='<div class="inputContainerL"><label for="popFormID">Popup Form ID</label><input type="text" id="popFormID" name="popFormID" value="'.$custom_header_data['pop_form_id'].'" class="inputClass"> </div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="sites4Container">';
    $html .= '<h2>Tap to call Setting</h2><div class="switch-field">
      <div class="switch-title">Want to show Tap to Call on Mobile?</div>
      <input type="radio" id="switch_left_ttc" class="switchRadio" data-getid="tapToCall" name="switch_ttc" value="1" '. ($myrows->tap_to_call == 1 ? "checked" : "") .'/>
      <label for="switch_left_ttc">Yes</label>
      <input type="radio" id="switch_right_ttc" class="switchRadio" data-getid="tapToCall" name="switch_ttc" value="2"'. ($myrows->tap_to_call == 2 ? "checked" : "") .' />
      <label for="switch_right_ttc">No</label>
    </div>';
    $html .='<div id="tapToCall" style="display:'. ($myrows->tap_to_call == 1 ? "block" : "none") .';"><div class="sites4SubContainer">';
    $html .='<div class="inputContainerL"><label for="ttcBack">Background Color</label><input type="text" id="ttcBack" name="ttcBack" value="'.$tap_to_call['bgcolor_tap'].'" data-format="rgb" data-opacity="1" data-swatches="#fff|#000|#f00|#0f0|#00f|#ff0|rgba(0,0,255,0.5)|rgba(255,255,255,0)" class="color inputClass"> </div>';
    $html .='<div class="inputContainerR"><label for="ttcFontcolor">Font Color</label><input type="text" id="ttcFontcolor" name="ttcFontcolor" value="'.$tap_to_call['textcolor_tap'].'" data-format="rgb" data-opacity="1" data-swatches="#fff|#000|#f00|#0f0|#00f|#ff0|rgba(0,0,255,0.5)|rgba(255,255,255,0)" class="color inputClass"> </div>';
    $html .='</div>';
    $html .='<div class="sites4SubContainer">';
    $html .='<div class="inputContainerL"><label for="ttcFontSize">Font Size</label><input type="text" id="ttcFontSize" value="'.$tap_to_call['font_size'].'" name="ttcFontSize" class="inputClass"> </div>';
    $html .='</div>';
    $html .='</div></div>';
    $html .='<div class="sites4Container">';
    $html .='<h2>Header Right Setting</h2><div class="switch-field">
      <div class="switch-title">Want to Show Right Header?</div>
      <input type="radio" id="switch_left_right_header" class="switchRadio" data-getid="headerRight" name="switch_right_header" value="1" '. ($myrows->header_right == 1 ? "checked" : "") .'/>
      <label for="switch_left_right_header">Yes</label>
      <input type="radio" id="switch_right_right_header" class="switchRadio" data-getid="headerRight" name="switch_right_header" value="2" '. ($myrows->header_right == 2 ? "checked" : "") .'/>
      <label for="switch_right_right_header">No</label>
    </div>';
    $html .='<div class="sites4SubContainer">';
    $html .= '<div class="inputContainerF"><label for="form_image_phone">Select or upload logo</label><br>
                <input id="form_image_phone" type="text" size="36" class="inputClass" name="phone_icon" placeholder="http://" value="'.$header_r_data['phone_icon'].'"/>
                    <input id="upload_form_image_phone" class="button" type="button" value="Upload Phone Icon"/></div>';
    $html .= '</div>';
    $html .='<div id="headerRight" style="display:'. ($myrows->header_right == 1 ? "block" : "none") .';"><div class="sites4SubContainer">';
    $html .='<div class="inputContainerL"><label for="color1">Background Color Top Left</label><input type="text" id="color1" name="color1" value="'.$header_r_data['color1'].'" class="inputClass color" data-format="rgb" data-opacity="1" data-swatches="#fff|#000|#f00|#0f0|#00f|#ff0|rgba(0,0,255,0.5)|rgba(255,255,255,0)"> </div>';
    $html .='<div class="inputContainerR"><label for="fontColor1">Font Color Top Left</label><input type="text" id="fontColor1" name="fontColor1" value="'.$header_r_data['fontColor1'].'" class="inputClass color" data-format="rgb" data-opacity="1" data-swatches="#fff|#000|#f00|#0f0|#00f|#ff0|rgba(0,0,255,0.5)|rgba(255,255,255,0)"> </div>';
    $html .='</div>';
    $html .='<div class="sites4SubContainer">';
    $html .='<div class="inputContainerL"><label for="color2">Background Color Top Right</label><input type="text" id="color2" name="color2" value="'.$header_r_data['color2'].'" class="inputClass color" data-format="rgb" data-opacity="1" data-swatches="#fff|#000|#f00|#0f0|#00f|#ff0|rgba(0,0,255,0.5)|rgba(255,255,255,0)"> </div>';
    $html .='<div class="inputContainerR"><label for="fontColor2">Font Color Top Right</label><input type="text" id="fontColor2" name="fontColor2" value="'.$header_r_data['fontColor2'].'" class="inputClass color" data-format="rgb" data-opacity="1" data-swatches="#fff|#000|#f00|#0f0|#00f|#ff0|rgba(0,0,255,0.5)|rgba(255,255,255,0)"> </div>';
    $html .='</div>';
    $html .='<div class="sites4SubContainer">';
    $html .='<div class="inputContainerL"><label for="color3">Background Color Bottom</label><input type="text" id="color3" name="color3" value="'.$header_r_data['color3'].'" class="inputClass color" data-format="rgb" data-opacity="1" data-swatches="#fff|#000|#f00|#0f0|#00f|#ff0|rgba(0,0,255,0.5)|rgba(255,255,255,0)"> </div>';
    $html .='<div class="inputContainerR"><label for="fontColor3">Font Color Top Bottom</label><input type="text" id="fontColor3" name="fontColor3" value="'.$header_r_data['fontColor3'].'" class="inputClass color" data-format="rgb" data-opacity="1" data-swatches="#fff|#000|#f00|#0f0|#00f|#ff0|rgba(0,0,255,0.5)|rgba(255,255,255,0)"> </div>';
    $html .='</div>';
    $html .='<div class="sites4SubContainer">';
    $html .='<div class="inputContainerL"><label for="linkPage">Link to page</label><input type="text" id="linkPage" name="linkPage" value="'.$header_r_data['linkPage'].'" class="inputClass"> </div>';
    if($header_r_data['container_width']){$conRwidth = $header_r_data['container_width'];}else{$conRwidth = '820px';}
    $html .='<div class="inputContainerR"><label for="widthRightContainer">Container Width</label><input type="text" value="'.$conRwidth.'" id="widthRightContainer" name="widthRightContainer" class="inputClass"> </div>';
    $html .='</div>';
    if($header_r_data['widthOne']){$Leftwidth = $header_r_data['widthOne'];}else{$Leftwidth = '475px';}
    if($header_r_data['widthTwo']){$Rightwidth = $header_r_data['widthTwo'];}else{$Rightwidth = '280px';}
    $html .='<div class="sites4SubContainer">';
    $html .='<div class="inputContainerL"><label for="widthOne">Width Top Left</label><input type="text" id="widthOne" name="widthOne" value="'.$Leftwidth.'" class="inputClass"> </div>';
    $html .='<div class="inputContainerR"><label for="widthTwo">Width Top Right</label><input type="text" id="widthTwo" name="widthTwo" value="'.$Rightwidth.'" class="inputClass"> </div>';
    $html .='</div>';
    $html .='<div class="sites4SubContainer">';
    $html .='<div class="inputContainerL"><label for="text1">Text Top Left</label><input type="text" id="text1" name="text1" value="'.$header_r_data['text1'].'" class="inputClass"> </div>';
    $html .='<div class="inputContainerR"><label for="text2">Text Bottom</label><input type="text" id="text2" name="text2"  value="'.$header_r_data['text2'].'" class="inputClass"> </div>';
    $html .='</div>';
    if($header_r_data['text1FontSize']){$text1FontSize = $header_r_data['text1FontSize'];}else{$text1FontSize = '40px';}
    if($header_r_data['text2FontSize']){$text2FontSize = $header_r_data['text2FontSize'];}else{$text2FontSize = '40px';}
    if($header_r_data['text3FontSize']){$text3FontSize = $header_r_data['text3FontSize'];}else{$text3FontSize = '18px';}
    $html .='<div class="sites4SubContainer">';
    $html .='<div class="inputContainerL"><label for="text1FontSize">Font Size Top Left</label><input type="text" id="text1FontSize" name="text1FontSize" value="'.$text1FontSize.'" class="inputClass"> </div>';
    $html .='<div class="inputContainerR"><label for="text2FontSize">Font Size Top Right</label><input type="text" id="text2FontSize" name="text2FontSize"  value="'.$text2FontSize.'" class="inputClass"> </div>';
    $html .='</div>';
    $html .='<div class="sites4SubContainer">';
    $html .='<div class="inputContainerL"><label for="text3FontSize">Font Size Bottom</label><input type="text" id="text3FontSize" name="text3FontSize" value="'.$text3FontSize.'" class="inputClass"> </div>';
    $html .='</div></div>';
    $html .='</div>';
    $html .= '
             <div class="sites4Container"><h2>Top Bar</h2><div class="switch-field">
      <div class="switch-title">Want to Show Top Bar?</div>
      <input type="radio" id="switch_left_top_bar" class="switchRadio" data-getid="topBarS" name="switch_top_bar" value="1" '. ($topBarData['top_bar_show'] == 1 ? "checked" : "") .'/>
      <label for="switch_left_top_bar">Yes</label>
      <input type="radio" id="switch_right_top_bar" class="switchRadio" data-getid="topBarS" name="switch_top_bar" value="2" '. ($topBarData['top_bar_show'] == 2 ? "checked" : "") .' />
      <label for="switch_right_top_bar">No</label>
    </div>';
    $html .='<div id="topBarS" style="display:'. ($topBarData['top_bar_show'] == 1 ? "block" : "none") .';"><div class="sites4SubContainer">';
    $html .='<div class="inputContainerL"><label for="topBarText">Text</label><input type="text" id="topBarText" name="topBarText"  value="'.$topBarData['text'].'" class="inputClass"> </div>';
    $html .='<div class="inputContainerR"><label for="topBarBackgroundColor">Background Color</label><input type="text" id="topBarBackgroundColor" name="topBarBackgroundColor"  value="'.$topBarData['background_color'].'" class="inputClass color" data-format="rgb" data-opacity="1" data-swatches="#fff|#000|#f00|#0f0|#00f|#ff0|rgba(0,0,255,0.5)|rgba(255,255,255,0)"></div>';
    $html .='</div>';
    $html .='<div class="sites4SubContainer">';
    $html .='<div class="inputContainerL"><label for="topBarFontSize">Font Size</label><input type="text" id="topBarFontSize" name="topBarFontSize"  value="'.$topBarData['font_size'].'" class="inputClass"> </div>';
    $html .='<div class="inputContainerR"><label for="topBarFontColor">Font Color</label><input type="text" id="topBarFontColor" name="topBarFontColor"  value="'.$topBarData['font_color'].'" class="inputClass color" data-format="rgb" data-opacity="1" data-swatches="#fff|#000|#f00|#0f0|#00f|#ff0|rgba(0,0,255,0.5)|rgba(255,255,255,0)"></div>';
    $html .='</div>';
    $html .= '</div></div>';

    $html .= '<div class="sites4Container"><h2>Banner Area</h2><div class="switch-field">
      <div class="switch-title">Want to Show Banner Section?</div>
      <input type="radio" id="switch_l_banner" name="switch_banner" class="switchRadio1" data-getid="bannerAreaSetting" value="1" '. ($bannerData['banner_show'] == 1 ? "checked" : "") .'/>
      <label for="switch_l_banner">Yes</label>
      <input type="radio" id="switch_r_banner" name="switch_banner" class="switchRadio1" data-getid="bannerAreaSetting" value="2" '. ($bannerData['banner_show'] == 2 ? "checked" : "") .' />
      <label for="switch_r_banner">No</label>
    </div>';
    $html .='<div class="bannerAreaSetting" style="display:'. ($bannerData['banner_show'] == 1 ? "block" : "none") .';">

    <div class="sites4SubContainer">';
    $html .='<div class="inputContainerF"><label for="credit_card_image">Background Image</label>
     <input id="credit_card_image" type="text" size="36" name="bannerBackground" class="inputClass" placeholder="http://"
                           value="'.$bannerData['bannerBackground'].'"/>
                    <input id="upload_image_button_card" class="button" type="button" value="Upload BG Image"/></div>';
    $html .='</div>';

    $html .='<div class="sites4SubContainer">';
    $html .='<div class="inputContainerL"><label for="bannerHeight">Banner Minimum Height</label><input type="text" id="bannerHeight" name="bannerHeight"  value="'.$bannerData['bannerHeight'].'" class="inputClass"> </div>';
    $html .='<div class="inputContainerR"><label for="bannerBackgroundColor">Banner Background Color</label><input type="text" id="bannerBackgroundColor" name="bannerBackgroundColor"  value="'.$bannerData['bannerBackgroundColor'].'" class="inputClass color" data-format="rgb" data-opacity="1" data-swatches="#fff|#000|#f00|#0f0|#00f|#ff0|rgba(0,0,255,0.5)|rgba(255,255,255,0)"> </div>';
    $html .='</div>';

    $html .='<div class="sites4SubContainer">';
    $html .='<div class="inputContainerL"><label for="bannerTextFontColor">Banner Font Color</label><input type="text" id="bannerTextFontColor" name="bannerTextFontColor"  value="'.$bannerData['bannerTextFontColor'].'" class="inputClass color" data-format="rgb" data-opacity="1" data-swatches="#fff|#000|#f00|#0f0|#00f|#ff0|rgba(0,0,255,0.5)|rgba(255,255,255,0)"></div>';
    $html .='<div class="inputContainerR"><label for="bannerTextBackgroundColor">Text Background Color</label><input type="text" id="bannerTextBackgroundColor" name="bannerTextBackgroundColor"  value="'.$bannerData['bannerTextBackgroundColor'].'" class="inputClass color" data-format="rgb" data-opacity="1" data-swatches="#fff|#000|#f00|#0f0|#00f|#ff0|rgba(0,0,255,0.5)|rgba(255,255,255,0)"> </div>';
    $html .='</div>';

    $html .='<div class="sites4SubContainer">';
    $html .='<div class="inputContainerL"><label for="bannerTextTopMargin">Text Top Margin</label><input type="text" id="bannerTextTopMargin" name="bannerTextTopMargin"  value="'.$bannerData['bannerTextTopMargin'].'" class="inputClass"> </div>';
    $html .='<div class="inputContainerR"><label for="bannerText">Banner Text</label><input type="text" id="bannerText" name="bannerText"  value="'.$bannerData['bannerText'].'" class="inputClass"></div>';
    $html .='</div>';

    $html .='<div class="sites4SubContainer">';
    $html .='<div class="inputContainerL"><label for="bannerTextSize">Text Size</label><input type="text" id="bannerTextSize" name="bannerTextSize"  value="'.$bannerData['bannerTextSize'].'" class="inputClass"> </div>';
    $html .='<div class="inputContainerR"><label for="bannerBorder">Border Bottom Color</label><input type="text" id="bannerBorder" name="border_bottom_color"  value="'.$bannerData['border_bottom_color'].'" class="inputClass color" data-format="rgb" data-opacity="1" data-swatches="#fff|#000|#f00|#0f0|#00f|#ff0|rgba(0,0,255,0.5)|rgba(255,255,255,0)"></div>';
    $html .='</div>';

    $html .='</div>';

    $html .= '</div>';

    $html .= '<div class="bannerAreaSetting" style="display:'. ($bannerData['banner_show'] == 1 ? "block" : "none") .';"><div class="sites4Container"><h2>Form Area</h2>';
    $html .='<div class="sites4SubContainer">';
    $html .='<div class="inputContainerL"><label for="formBackgroundColor">Form Background Color</label><input type="text" id="formBackgroundColor" name="formBackgroundColor"  value="'.$formData['formBackgroundColor'].'" class="inputClass color" data-format="rgb" data-opacity="1" data-swatches="#fff|#000|#f00|#0f0|#00f|#ff0|rgba(0,0,255,0.5)|rgba(255,255,255,0)"> </div>';
    $html .='<div class="inputContainerR"><label for="formShortcode">Form ID</label><input type="text" id="formShortcode" name="formShortcode"  value="'.$formData['formShortcode'].'" class="inputClass"></div>';
    $html .='</div>';
    $html .='<div class="sites4SubContainer">';
    $html .='<div class="inputContainerF">
            <div class="inputContainerF"><label for="form_image">Image</label>
                 <input id="form_image" type="text" size="36" name="form_image" class="inputClass" placeholder="http://"
                                       value="'.$formData['form_image'].'"/>
                                <input id="upload_form_image" class="button" type="button" value="Upload Image"/></div>
            </div>';
    $html .='</div>';
    $html .= '</div></div>';
    $html .='<br><input type="hidden" name="upd_site4" value="yes_upd"><input type="hidden" name="pUrl" id="pUrl" value="' . esc_url( plugins_url('inc/action.php' , __FILE__)) . '">
        <input name="updateCustomSetting" type="submit" class="button button-primary button-large" id="updateCustomSetting" value="Save my setting"></form>';
    echo $html;
}