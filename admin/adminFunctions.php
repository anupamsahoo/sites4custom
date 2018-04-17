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
        wp_register_script('ColorPicker', esc_url( plugins_url( 'js/jscolor/jscolor.js', __FILE__ ) ), array('jquery'));
        wp_enqueue_script('ColorPicker');
        wp_register_script('upload-js', esc_url( plugins_url( 'js/custom.js', __FILE__ ) ), array('jquery'));
        wp_enqueue_script('upload-js');
        wp_register_style( 'custom_wp_admin_css', esc_url( plugins_url( 'css/admin.css', __FILE__ ) ), false, '1.0.0' );
        wp_enqueue_style( 'custom_wp_admin_css' );
    }
}

function sites4custom_admin()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'sites4custom';
    $myrows = $wpdb->get_row("SELECT * FROM " . $table_name . " WHERE id='1'");
    $tap_to_call = @unserialize(base64_decode($myrows->tap_to_call_data));
    $custom_header_data = @unserialize(base64_decode($myrows->custom_header_data));
    $header_r_data = @unserialize(base64_decode($myrows->header_right_data));
    $sliderData = @unserialize(base64_decode($myrows->slider_data));
    $html = '<h1>Sites4 Custom</h1><hr />';
    $html .= '<div class="sites4Container">';
    $html .= '<div class="alertContainer">';
    $html .= '<div class="success_site4"><strong>Well done!</strong> You successfully read this important alert message.</div>';
    $html .= '<div class="error_site4"><strong>Oh snap!</strong> Change a few things up and try submitting again.</div>';
    $html .= '</div>';
    $html .= '<form name="update_site4_genesis" id="update_site4_genesis" action="admin.php?page=sites4custom" method="POST" enctype="multipart/form-data">';
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
    $html .= '<div class="inputContainerL"><label for="backgroundColor">Background Color</label><input type="text" id="backgroundColor" name="backgroundColor" value="'.$custom_header_data['background_color'].'" class="inputClass color {hash:true}"> </div>';
    $html .= '<div class="inputContainerR"><label for="phoneNumber">Phone Number</label><input type="text" id="phoneNumber" name="phoneNumber" value="'.$custom_header_data['phone_number'].'" class="inputClass"> </div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="sites4Container">';
    $html .= '<h2>Tap to call Setting</h2>';
    $html .= '<div class="sites4SubContainer">';
    $html .= '<div class="inputContainerL"><label for="wtsttcm">Want to show Tap to Call on Mobile?</label><br>
                    <select name="wtsttcm" class="inputClass" id="wtsttcm">';
                    if ($myrows->tap_to_call == 1){
                    $html .= '<option value="1" selected>Yes</option>';
                    $html .= '<option value="0">No</option>';
                    }else{
                        $html .= '<option value="1">Yes</option>';
                        $html .= '<option value="0" selected>No</option>';
                    }
            $html .='</select>';
            $html .='</div>';
        $html .='</div>';
        $html .='<div class="sites4SubContainer">';
            $html .='<div class="inputContainerL"><label for="ttcBack">Background Color</label><input type="text" id="ttcBack" value="'.$tap_to_call['bgcolor_tap'].'" name="ttcBack" class="inputClass color {hash:true}"> </div>';
            $html .='<div class="inputContainerR"><label for="ttcFontcolor">Font Color</label><input type="text" id="ttcFontcolor" value="'.$tap_to_call['textcolor_tap'].'" name="ttcFontcolor" class="inputClass color {hash:true}"> </div>';
        $html .='</div>';
        $html .='<div class="sites4SubContainer">';
            $html .='<div class="inputContainerL"><label for="ttcFontSize">Font Size</label><input type="text" id="ttcFontSize" value="'.$tap_to_call['font_size'].'" name="ttcFontSize" class="inputClass"> </div>';
        $html .='</div>';
    $html .='</div>';
    $html .='<div class="sites4Container">';
    $html .='<h2>Header Right Setting</h2>';
    $html .='<div class="sites4SubContainer">';
    $html .='<div class="inputContainerL"><label for="color1">Background Color Top Left</label><input type="text" id="color1" name="color1" value="'.$header_r_data['color1'].'" class="inputClass color {hash:true}"> </div>';
    $html .='<div class="inputContainerR"><label for="fontColor1">Font Color Top Left</label><input type="text" id="fontColor1" name="fontColor1" value="'.$header_r_data['fontColor1'].'" class="inputClass color {hash:true}"> </div>';
    $html .='</div>';
    $html .='<div class="sites4SubContainer">';
    $html .='<div class="inputContainerL"><label for="color2">Background Color Top Right</label><input type="text" id="color2" name="color2" value="'.$header_r_data['color2'].'" class="inputClass color {hash:true}"> </div>';
    $html .='<div class="inputContainerR"><label for="fontColor2">Font Color Top Right</label><input type="text" id="fontColor2" name="fontColor2" value="'.$header_r_data['fontColor2'].'" class="inputClass color {hash:true}"> </div>';
    $html .='</div>';
    $html .='<div class="sites4SubContainer">';
    $html .='<div class="inputContainerL"><label for="color3">Background Color Bottom</label><input type="text" id="color3" name="color3" value="'.$header_r_data['color3'].'" class="inputClass color {hash:true}"> </div>';
    $html .='<div class="inputContainerR"><label for="fontColor3">Font Color Top Bottom</label><input type="text" id="fontColor3" name="fontColor3" value="'.$header_r_data['fontColor3'].'" class="inputClass color {hash:true}"> </div>';
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
    $html .='</div>';
    $html .='</div>';
    $html .='<input type="hidden" name="upd_site4" value="yes_upd"><input type="hidden" name="pUrl" id="pUrl" value="' . esc_url( plugins_url('inc/action.php' , __FILE__)) . '">
        <input name="updateCustomSetting" type="submit" class="button button-primary button-large" id="updateCustomSetting" value="Save my setting"></form>';
    echo $html;
}