<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       tatvic.com
 * @since      1.0.0
 *
 * @package    Convsst_Ecommerce_Google_Analytics
 * @subpackage Convsst_Ecommerce_Google_Analytics/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Convsst_Ecommerce_Google_Analytics
 * @subpackage Convsst_Ecommerce_Google_Analytics/includes
 * @author     Tatvic
 */
class Convsst_Ecommerce_Google_Analytics_i18n {

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			"server-side-tagging-via-google-tag-manager-for-wordpress",
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);
	}
}
