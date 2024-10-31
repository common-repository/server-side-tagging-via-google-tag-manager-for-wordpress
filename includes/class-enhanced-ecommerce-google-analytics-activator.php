<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Fired during plugin activation
 *
 * @link       test.com
 * @since      1.0.0
 *
 * @package    Convsst_Ecommerce_Google_Analytics_Activator
 * @subpackage Convsst_Ecommerce_Google_Analytics_Activator/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Convsst_Ecommerce_Google_Analytics_Activator
 * @subpackage Convsst_Ecommerce_Google_Analytics_Activator/includes
 * @author     Tatvic
 */

class Convsst_Ecommerce_Google_Analytics_Activator {

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function activate() {  	
    	/*if (!is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
           wp_die(wp_sprintf("%s <br><a href='" . esc_url(admin_url( 'plugins.php' )) . "'>&laquo; %s</a>", esc_html__("Hey, It seems WooCommerce plugin is not active on your wp-admin. Conversios.io - Google Analytics and Google Shopping plugin can only be activated if you have active WooCommerce plugin in your wp-admin.","server-side-tagging-via-google-tag-manager-for-wordpress"), esc_html__("Return to Plugins","server-side-tagging-via-google-tag-manager-for-wordpress")));
        }*/
        $TVC_Admin_Helper = new TVC_Admin_Helper();
        $TVC_Admin_Helper->update_app_status();
        $TVC_Admin_Helper->app_activity_detail("activate");         
    }
}
