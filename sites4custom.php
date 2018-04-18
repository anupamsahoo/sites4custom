<?php
/*
Plugin Name: Sites4Contractor Genesis Custom Function V3
Plugin URI: http://sites4contractors.com/
Description: Integrates Custom function to overwrite genesis function and user can update logo, slider, mobile number, phone tab for mobile etc.
Version: 3.0
Author: Anupam Sahoo
Author URI: http://sites4contractor.com/
*/
defined('ABSPATH') or die('Plugin file cannot be accessed directly.');
//Version Control
add_option("sites4custom_version", "3.0");
global $sites4custom_version;
$sites4custom_version = '3.0';

function sites4Custom_activation()
{
    global $wpdb;
    global $sites4custom_version;
    $table_name = $wpdb->prefix . 'sites4custom';
    $table_name2 = $wpdb->prefix . 'sites4custom_header_option';
    $table_name3 = $wpdb->prefix . 'sites4custom_option2_data';

    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
              id int(11) NOT NULL AUTO_INCREMENT,
              tap_to_call int(11) NOT NULL,
              tap_to_call_data text NOT NULL,
              custom_header int(11) NOT NULL,
              custom_header_data text NOT NULL,
              header_right int(11) NOT NULL,
              header_right_data text NOT NULL,
              slider int(11) NOT NULL,
              slider_data text NOT NULL,
              UNIQUE KEY id (id)
            ) $charset_collate;
            ALTER TABLE $table_name ADD PRIMARY KEY (id);";
    $sql2 = "CREATE TABLE $table_name2 (
              id int(11) NOT NULL AUTO_INCREMENT,
              header_option int(11) NOT NULL,
              UNIQUE KEY id (id)
            ) $charset_collate;
            ALTER TABLE $table_name2 ADD PRIMARY KEY (id);";
    $sql3 = "CREATE TABLE $table_name3 (
              id int(11) NOT NULL AUTO_INCREMENT,
              top_bar text NOT NULL,
              logo_area text NOT NULL,
              banner_area text NOT NULL,
              form_section text NOT NULL,
              UNIQUE KEY id (id)
            ) $charset_collate;
            ALTER TABLE $table_name3 ADD PRIMARY KEY (id);";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
    dbDelta($sql2);
    dbDelta($sql3);
    add_option('sites4custom_version', $sites4custom_version);
}

function sites4custom_install_data()
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'sites4custom';
    $table_name2 = $wpdb->prefix . 'sites4custom_header_option';
    $table_name3 = $wpdb->prefix . 'sites4custom_option2_data';

    $wpdb->insert(
        $table_name,
        array(
            'id' => '1',
            'tap_to_call' => '0',
            'tap_to_call_data' => '',
            'custom_header' => '0',
            'custom_header_data' => '',
            'header_right' => '0',
            'header_right_data' => '',
            'slider' => '0',
            'slider_data' => '',
        )
    );
    $wpdb->insert(
        $table_name2,
        array(
            'id' => '1',
            'header_option' => '1'
        )
    );
    $wpdb->insert(
        $table_name3,
        array(
            'id' => '1',
            'top_bar' => '',
            'logo_area' => '',
            'banner_area' => '',
            'form_section' => '',
        )
    );
}

register_activation_hook(__FILE__, 'sites4Custom_activation');
register_activation_hook(__FILE__, 'sites4custom_install_data');
//PLUGIN Deactivation Hook
/*function site4_genesis_deactivation()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'site4genesis';
    $sql = "DROP TABLE IF EXISTS $table_name;";
    $e = $wpdb->query($sql);
}

register_deactivation_hook(__FILE__, 'site4_genesis_deactivation');*/

function sites4_action($action,$table,$data=null,$id=null){
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

if ( ! function_exists( 'site4custom_head_global') ) {
    function site4custom_head_global(){
        $css = "<style type='text/css'>";
        $css .= ".site-inner {max-width: 1140px !important;}.fl-row-fixed-width{max-width:1115px !important;}.fl-row-content-wrap{padding:0 !important;}";
        $css .= ".site-inner{padding-top:70px !important;}@media only screen and (max-width: 800px){.site-inner{padding-top:0 !important;}}";
        $css .= ".site4MainContainer{width:100%;max-width: 1100px; margin: 0 auto;}
        header.site-header{display: none !important;}
        .site-inner{padding-top:70px !important;}
        @media only screen and (max-width: 1026px){
        .site-inner{padding-top:0px !important;}
        }
        ";
        if(is_user_logged_in()) {
            $css .= ".stickyNavBar {position: fixed;top: 32px;width:100%;z-index: 99999999999;}";
        }else {
            $css .= ".stickyNavBar {position: fixed;top: 0;width:100%;z-index: 99999999999;}";
        }
        $css .= '</style>';
        echo $css;
    }
}
add_action('wp_head', 'site4custom_head_global');
add_action('wp_footer','site4custom_footer');
if ( ! function_exists( 'site4custom_footer') ) {
    function site4custom_footer(){
        $js = "<script type='text/javascript'>";
        $js .= "jQuery(document).ready(function() {
            var stickyNavTop = jQuery('.nav-primary').offset().top;
            //var stickyNavTop = stickyNavTop1+30;
            console.log(stickyNavTop);
            var stickyNav = function(){
                var scrollTop = jQuery(window).scrollTop();
                if (scrollTop > stickyNavTop) {
                    jQuery('.nav-primary').addClass('stickyNavBar');
                } else {
                    jQuery('.nav-primary').removeClass('stickyNavBar');
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
//Remove Genesis header
add_action('get_header', 'site4_remove_page_titles');
if ( ! function_exists( 'site4_remove_page_titles') ) {
    function site4_remove_page_titles()
    {
        remove_action('genesis_header', 'genesis_do_header');
        remove_action('genesis_header', 'genesis_header_markup_open', 5);
        remove_action('genesis_header', 'genesis_header_markup_close', 15);
    }
}
$headerOptionF = sites4_action('select','sites4custom_header_option','',1);

if ( ! function_exists( 'site4_get_data') ) {
    function site4_get_data()
    {
        global $wpdb;
        $data = array();
        $table_name = $wpdb->prefix . 'sites4custom';
        $myrows = $wpdb->get_row( "SELECT * FROM " . $table_name . " WHERE id='1'");

        $table_name2 = $wpdb->prefix . 'sites4custom_option2_data';
        $headerOption2 = $wpdb->get_row( "SELECT * FROM " . $table_name2 . " WHERE id='1'");

        $data['tap_to_call'] = $myrows->tap_to_call;
        $data['tap_to_call_data'] = @unserialize(base64_decode($myrows->tap_to_call_data));
        $data['custom_header'] = $myrows->custom_header;
        $data['custom_header_data'] = @unserialize(base64_decode($myrows->custom_header_data));
        $data['header_r'] = $myrows->header_right;
        $data['header_r_data'] = @unserialize(base64_decode($myrows->header_right_data));
        $data['slider'] = $myrows->slider;
        $data['sliderData'] = @unserialize(base64_decode($myrows->slider_data));

        $data['topBarData'] = @unserialize(base64_decode($headerOption2->top_bar));
        $data['bannerData'] = @unserialize(base64_decode($headerOption2->banner_area));
        $data['formData'] = @unserialize(base64_decode($headerOption2->form_section));

        return $data;
    }
}

//admin hook
include('admin/adminFunctions.php');
//frontend hook
if($headerOptionF->header_option == 2){
    include('frontend/frontend_option2.php');
}else{
    include('frontend/frontend.php');
}