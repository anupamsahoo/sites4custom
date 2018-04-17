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

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
    add_option('sites4custom_version', $sites4custom_version);
}

function sites4custom_install_data()
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'sites4custom';

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
}

register_activation_hook(__FILE__, 'sites4Custom_activation');
register_activation_hook(__FILE__, 'sites4custom_install_data');
//PLUGIN Deactivation Hook
function site4_genesis_deactivation()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'site4genesis';
    $sql = "DROP TABLE IF EXISTS $table_name;";
    $e = $wpdb->query($sql);
}

register_deactivation_hook(__FILE__, 'site4_genesis_deactivation');

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

//admin hook
include('admin/adminFunctions.php');
//frontend hook
include('frontend/frontend.php');