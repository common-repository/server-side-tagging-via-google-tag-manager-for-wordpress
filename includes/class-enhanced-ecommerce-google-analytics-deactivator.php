<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Fired during plugin deactivation
 *
 * @link       test.com
 * @since      1.0.0
 *
 * @package    Convsst_Ecommerce_Google_Analytics
 * @subpackage Convsst_Ecommerce_Google_Analytics/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Convsst_Ecommerce_Google_Analytics
 * @subpackage Convsst_Ecommerce_Google_Analytics/includes
 * @author     Tatvic
 */
class Convsst_Ecommerce_Google_Analytics_Deactivator extends TVC_Admin_Helper {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		if (!current_user_can('activate_plugins')){
			return;    
    	}
		$TVC_Admin_Helper = new TVC_Admin_Helper();
		$TVC_Admin_Helper->update_app_status("0");
		$TVC_Admin_Helper->app_activity_detail("deactivate");
	}
}
