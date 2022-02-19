<?php
/**
* Plugin Name: Simple Post Slider 
* Plugin URI: 
* Author: donstudio.com
* Version: 1.0
* Text Domain: wpsps
* Domain Path: /languages
* Author URI: https://donstudio.com
* Description: Simple Post Slider, will create a beautiful slideshow automatically populated with the posts you add on your Wordpress Website.
**/

//Exit if accessed directly
if(!defined('ABSPATH')){
	return; 	
}

$WPSPS_cp_version = 1.1;

define("WPSPS_PATH", plugin_dir_path(__FILE__));
define("WPSPS_URL", plugins_url('',__FILE__));
define("WPSPS_VERSION",1.1);


//Admin Settings
include_once WPSPS_PATH.'/admin/wpsps-admin.php';

function wpsps_cp_rock_the_world(){
	global $wpsps_cp_gl_atcem_value;
	
	require_once WPSPS_PATH.'/includes/class-wpsps-public.php';
	//Start the plugin
	WPSPS_CP::get_instance();
}
add_action('plugins_loaded','wpsps_cp_rock_the_world');
