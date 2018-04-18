<?php
define('WP_USE_THEMES', false);
require_once('../../../../../wp-load.php');
if($_POST['upd_site4'] == 'yes_upd')
{
    $headerOptionPost = $_POST['header_option'];
    $upHoption = sites4_action_acpage('update','sites4custom_header_option',array('header_option' => $headerOptionPost),1);
    //Option 1 Settings
    $tapCallyes = $_POST['wtsttcm'];
    $tapCallArray = array(
        'phonenumber'   => $_POST['phonenumber'],
        'bgcolor_tap'   => $_POST['ttcBack'],
        'textcolor_tap' => $_POST['ttcFontcolor'],
        'font_size'    => $_POST['ttcFontSize']
    );
    $tapCall = serialize($tapCallArray);
    $tap_to_call = base64_encode($tapCall);

    $custom_header = '1';
    $cusHarray = array(
        'logo' => $_POST['ad_image'],
        'background_image' => $_POST['upload_back_image'],
        'background_color' => $_POST['backgroundColor'],
        'phone_number' => $_POST['phoneNumber']
    );
    $cusH = serialize($cusHarray);
    $custom_header_data = base64_encode($cusH);

    $header_right = '0';
    $hRightArray = array(
        'color1' => $_POST['color1'],
        'color2' => $_POST['color2'],
        'color3' => $_POST['color3'],
        'container_width' => $_POST['widthRightContainer'],
        'widthOne' => $_POST['widthOne'],
        'widthTwo' => $_POST['widthTwo'],
        'text1' => $_POST['text1'],
        'text2' => $_POST['text2'],
        'fontColor1' => $_POST['fontColor1'],
        'fontColor2' => $_POST['fontColor2'],
        'fontColor3' => $_POST['fontColor3'],
        'linkPage' => $_POST['linkPage'],
        'text1FontSize' => $_POST['text1FontSize'],
        'text2FontSize' => $_POST['text2FontSize'],
        'text3FontSize' => $_POST['text3FontSize']
    );
    $hRight = serialize($hRightArray);
    $header_right_data = base64_encode($hRight);
    $sld = '0';
    $sArray = array(
        'sliderHeight' => $_POST['sliderHeight'],
        'slidercode' => $_POST['slidercode']
    );
    $sliD = serialize($sArray);
    $slider = 'none';
    $u = update_site4_data($tapCallyes,$tap_to_call,$custom_header,$custom_header_data,$header_right,$header_right_data,$sld,$slider);

    //Option 2
    $topBarData = array(
        'text' => $_POST['topBarText'],
        'background_color' => $_POST['topBarBackgroundColor'],
        'font_size' => $_POST['topBarFontSize'],
        'font_color' => $_POST['topBarFontColor'],
    );
    $topBarDataS = serialize($topBarData);
    $top_bar_data = base64_encode($topBarDataS);

    $bannerAreaData = array(
        'bannerBackground' => $_POST['bannerBackground'],
        'bannerBackgroundColor' => $_POST['bannerBackgroundColor'],
        'bannerTextFontColor' => $_POST['bannerTextFontColor'],
        'bannerTextBackgroundColor' => $_POST['bannerTextBackgroundColor'],
        'bannerText' => $_POST['bannerText'],
        'bannerHeight' => $_POST['bannerHeight'],
        'bannerTextTopMargin' => $_POST['bannerTextTopMargin'],
        'bannerTextSize' => $_POST['bannerTextSize']
    );
    $bannerAreaDataS = serialize($bannerAreaData);
    $bannerAreaDataEn = base64_encode($bannerAreaDataS);

    $formData = array(
        'formBackgroundColor' => $_POST['formBackgroundColor'],
        'formShortcode' => $_POST['formShortcode']
    );

    $formDataS = serialize($formData);
    $formDataEn = base64_encode($formDataS);

    $updateop2Data = array(
        'top_bar' => $top_bar_data,
        'banner_area' => $bannerAreaDataEn,
        'form_section' => $formDataEn
    );
    $updateOption2 = sites4_action_acpage('update','sites4custom_option2_data',$updateop2Data,1);

    if($updateOption2 || $u || $upHoption) {
        $responseData['d'] = "<strong>Update Done</strong>";
    }
    else{
        $responseData['err'] =  "Error";
    }
}
else
{
    $responseData['err'] = "Error";
}
function update_site4_data($tapCallyes,$tap_to_call,$custom_header,$custom_header_data,$header_right,$header_right_data,$sld,$slider){
    global $wpdb;
    $table_name = $wpdb->prefix . 'sites4custom';
    //$update =
    //$wpdb->update( $table, $data, $where, $format = null, $where_format = null );
    $update = $wpdb->update(
        $table_name,
        array(
            'tap_to_call' => $tapCallyes,
            'tap_to_call_data' => $tap_to_call,
            'custom_header' => $custom_header,
            'custom_header_data' => $custom_header_data,
            'header_right' => $header_right,
            'header_right_data' => $header_right_data,
            'slider' => $sld,
            'slider_data' => $slider
        ),
        array( 'id' => 1 )
    );
    if($update){return true;}else{return false;}
}
function sites4_action_acpage($action,$table,$data=null,$id=null){
    global $wpdb;
    $table_name = $wpdb->prefix . $table;
    if($action == 'add'){
        $result = $wpdb->insert($table_name, $data);
    }
    elseif($action == 'update'){
        $result = $wpdb->update($table_name,$data, array( 'id' => $id ));
    }
    elseif($action == 'delete'){
        $result = $wpdb->delete( $table_name, array( 'id' => $id ) );
    }elseif($action == 'select'){
        $result = $wpdb->get_row( "SELECT * FROM $table_name WHERE id = $id" );
    }
    else{
        $result = false;
    }
    if($result){return $result;}else{return false;}
}
header("Content-Type: application/json; charset=utf8");
$return = json_encode($responseData);
echo $return;