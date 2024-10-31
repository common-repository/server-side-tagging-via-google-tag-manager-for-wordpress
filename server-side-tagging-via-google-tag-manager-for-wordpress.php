<?php
/**
 *
 * @link              conversios.io
 * @since             1.0.0
 * @package           Server Side Tagging
 *
 * @wordpress-plugin
 * Plugin Name:       Conversios.io - Server Side Tagging
 * Plugin URI:        https://www.conversios.io/
 * Description:       With Conversios, Server-side Tagging you can track user interactions and conversions on various platforms, including Google Analytics 4, Facebook, Google Ads, Snapchat Conversions API, and TikTok Events API.
 * Version:           1.0.9
 * Author:            Conversios
 * Author URI:        conversios.io
 * License:           GPLv3
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       server-side-tagging-via-google-tag-manager-for-wordpress
 * Domain Path:       /languages
 */

/**
 * If this file is called directly, abort.
 */
if (!defined('WPINC')) {
    die;
}
/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('CONVSST_PLUGIN_VERSION', '1.0.9');

//Timeout 
if (!defined('CONVSST_TM')) {
    define('CONVSST_TM', 300);
}
//APP ID
if (!defined('CONVSST_APP_ID')) {
    define('CONVSST_APP_ID', 13);
}
//Screen ID
if (!defined('CONVSST_SCREEN_ID')) {
    define('CONVSST_SCREEN_ID', 'conversios_page_');
}
//Top Menu
if (!defined('CONVSST_TOP_MENU')) {
    define('CONVSST_TOP_MENU', 'Conversios');
}
//Menu Slug
if (!defined('CONVSST_MENU_SLUG')) {
    define('CONVSST_MENU_SLUG', 'convsst-conversios-google-analytics');
}

function convsst_is_EeAioFreePro_active($plugin_name = 'server-side-tagging-via-google-tag-manager-for-wordpress/enhanced-ecommerce-google-analytics.php')
{
    if (!function_exists('is_plugin_active')) {
        include_once(ABSPATH . 'wp-admin/includes/plugin.php');
    }
    return is_plugin_active($plugin_name);
}

register_activation_hook(__FILE__, 'convsst_activate_ecommerce_google_analytics_pro');
function convsst_activate_ecommerce_google_analytics_pro()
{

    if (is_plugin_active('enhanced-e-commerce-for-woocommerce-store/enhanced-ecommerce-google-analytics.php')) {
        wp_die('Please deactivate "Conversios.io - All-in-one Google Analytics, Pixels and Product Feed Manager for WooCommerce" plugin before activating Server Side Tagging via Google Tag Manager for WordPress plugin.');
    }
    if (is_plugin_active('enhanced-e-commerce-pro-for-woocommerce-store/enhanced-ecommerce-pro-google-analytics.php')) {
        wp_die('Please deactivate "Conversios.io - All-in-one Pro" plugin before activating Server Side Tagging via Google Tag Manager for WordPress plugin.');
    }
    
    if (convsst_is_EeAioFreePro_active('enhanced-e-commerce-for-woocommerce-store/enhanced-ecommerce-google-analytics.php')) {
        //deactivate_plugins('server-side-tagging-via-google-tag-manager-for-wordpress/enhanced-ecommerce-google-analytics.php', true, false);
        deactivate_plugins( plugin_basename( __FILE__ ) ); // Deactivate our plugin
        $error_message = 'Plugin activation failed. This plugin cannot be activated while "Conversios.io - All-in-one Google Analytics, Pixels and Product Feed Manager for WooCommerce" is active.';
        add_action( 'admin_notices', function() use ( $error_message ) {
            convsst_plugin_activation_warning( $error_message );
        } ); // Pass error message to the notice function
        wp_redirect( admin_url( 'plugins.php' ) );
        die(esc_html($error_message));
    }

    if (convsst_is_EeAioFreePro_active('enhanced-e-commerce-pro-for-woocommerce-store/enhanced-ecommerce-pro-google-analytics.php')) {
        //deactivate_plugins('enhanced-e-commerce-pro-for-woocommerce-store/enhanced-ecommerce-pro-google-analytics.php', true, false);
        deactivate_plugins( plugin_basename( __FILE__ ) ); // Deactivate our plugin
        $error_message = 'Plugin activation failed. This plugin cannot be activated while "Conversios.io - All-in-one Pro" is active.';
        add_action( 'admin_notices', function() use ( $error_message ) {
            convsst_plugin_activation_warning( $error_message );
        } ); // Pass error message to the notice function
        //die(esc_html($error_message));
        return;
    }

    $ee_options_settings = unserialize(get_option('convsst_options'));

    $subscriptionId = (isset($ee_options_settings['subscription_id'])) ? $ee_options_settings['subscription_id'] : "";
    $apiDomain = "https://connect.tatvic.com/laravelapi/public/api";
    
    $header = array(
        "Authorization: Bearer 'MTIzNA=='",
        "Content-Type" => "application/json"
    );

    $current_user = wp_get_current_user();

    if (empty($subscriptionId)) {
        $current_user = wp_get_current_user();

        // Do customer login
        $url = $apiDomain . '/customers/login';
        $header = array("Authorization: Bearer MTIzNA==", "content-type: application/json");
        $postData = [
            'first_name' => "",
            'last_name' => "",
            'access_token' => "",
            'refresh_token' => "",
            'email' => $current_user->user_email,
            'sign_in_type' => 1,
            'app_id' => CONVSST_APP_ID,
            'platform_id' => 1
        ];
        $args = array(
            'headers' => $header,
            'method' => 'POST',
            "timeout" => CONVSST_TM,
            'body' => $postData
        );
        $dologin_response = wp_remote_post(esc_url_raw($url), $args);

        // Update token to subs
        $url = $apiDomain . '/customer-subscriptions/update-token';
        $header = array("Authorization: Bearer MTIzNA==", "content-type: application/json");
        $postData = [
            'subscription_id' => "",
            'gmail' => $current_user->user_email,
            'access_token' => "",
            'refresh_token' => "",
            'domain' => get_site_url(),
            'app_id' =>  CONVSST_APP_ID,
            'platform_id' => 1
        ];
        $args = array(
            'headers' => $header,
            'method' => 'POST',
            "timeout" => CONVSST_TM,
            'body' => $postData
        );
        $request = wp_remote_post(esc_url_raw($url), $args);
        $updatetoken_response = json_decode(wp_remote_retrieve_body($request));

        //Get subscription details
        $url = $apiDomain . '/customer-subscriptions/subscription-detail';
        $header = array("Authorization: Bearer MTIzNA==", "content-type: application/json");
        $postData = [
            'subscription_id' => $updatetoken_response->data->customer_subscription_id,
            'domain' => get_site_url(),
            'app_id' => CONVSST_APP_ID,
            'platform_id' => 1
        ];
        $args = array(
            'headers' => $header,
            'method' => 'POST',
            "timeout" => CONVSST_TM,
            'body' => $postData
        );
        $request = wp_remote_post(esc_url_raw($url), $args);
        $subsdetails_response = json_decode(wp_remote_retrieve_body($request));

        $eeapidata = array("setting" => $subsdetails_response->data);
        update_option("convsst_api_data", serialize($eeapidata));

        $subscriptiondata = $subsdetails_response->data;

        $eeoptions = array();
        $eeoptions["subscription_id"] = (isset($subscriptiondata->id) && $subscriptiondata->id != "") ? sanitize_text_field($subscriptiondata->id) : "";
        $eeoptions["ga_eeT"] = "on";
        $eeoptions["ga_ST"] = "on";
        $eeoptions["gm_id"] = (isset($subscriptiondata->measurement_id) && $subscriptiondata->measurement_id != "") ? sanitize_text_field($subscriptiondata->measurement_id) : "";
        $eeoptions["ga_id"] = (isset($subscriptiondata->property_id) && $subscriptiondata->property_id != "") ? sanitize_text_field($subscriptiondata->property_id) : "";
        $eeoptions["google_ads_id"] = (isset($subscriptiondata->google_ads_id) && $subscriptiondata->google_ads_id != "") ? sanitize_text_field($subscriptiondata->google_ads_id) : "";
        $eeoptions["google_merchant_id"] = (isset($subscriptiondata->google_merchant_center_id) && $subscriptiondata->google_merchant_center_id != "") ? sanitize_text_field($subscriptiondata->google_merchant_center_id) : "";
        $eeoptions["tracking_option"] = (isset($subscriptiondata->tracking_option) && $subscriptiondata->tracking_option != "") ? sanitize_text_field($subscriptiondata->tracking_option) : "";
        $eeoptions["ga_gUser"] = "on";
        $eeoptions["ga_Impr"] = "6";
        $eeoptions["ga_IPA"] = "on";
        $eeoptions["ga_PrivacyPolicy"] = "on";
        $eeoptions["google-analytic"] = "";
        $eeoptions["ga4_api_secret"] = "";
        $eeoptions["ga_CG"] = "";
        $eeoptions["ga_optimize_id"] = "";
        $eeoptions["tracking_method"] = (isset($subscriptiondata->tracking_method) && $subscriptiondata->tracking_method != "") ? sanitize_text_field($subscriptiondata->tracking_method) : "";
        $eeoptions["tvc_product_list_data_collection_method"] = (isset($subscriptiondata->tvc_product_list_data_collection_method) && $subscriptiondata->tvc_product_list_data_collection_method != "") ? sanitize_text_field($subscriptiondata->tvc_product_list_data_collection_method) : "";
        $eeoptions["tvc_product_detail_data_collection_method"] = (isset($subscriptiondata->tvc_product_detail_data_collection_method) && $subscriptiondata->tvc_product_detail_data_collection_method != "") ? sanitize_text_field($subscriptiondata->tvc_product_detail_data_collection_method) : "";
        $eeoptions["tvc_checkout_data_collection_method"] = (isset($subscriptiondata->tvc_checkout_data_collection_method) && $subscriptiondata->tvc_checkout_data_collection_method != "") ? sanitize_text_field($subscriptiondata->tvc_checkout_data_collection_method) : "";
        $eeoptions["tvc_thankyou_data_collection_method"] = (isset($subscriptiondata->tvc_thankyou_data_collection_method) && $subscriptiondata->tvc_thankyou_data_collection_method != "") ? sanitize_text_field($subscriptiondata->tvc_thankyou_data_collection_method) : "";
        $eeoptions["tvc_product_detail_addtocart_selector"] = (isset($subscriptiondata->tvc_product_detail_addtocart_selector) && $subscriptiondata->tvc_product_detail_addtocart_selector != "") ? sanitize_text_field($subscriptiondata->tvc_product_detail_addtocart_selector) : "";
        $eeoptions["tvc_product_detail_addtocart_selector_type"] = (isset($subscriptiondata->tvc_product_detail_addtocart_selector_type) && $subscriptiondata->tvc_product_detail_addtocart_selector_type != "") ? sanitize_text_field($subscriptiondata->tvc_product_detail_addtocart_selector_type) : "";
        $eeoptions["tvc_product_detail_addtocart_selector_val"] = (isset($subscriptiondata->tvc_product_detail_addtocart_selector_val) && $subscriptiondata->tvc_product_detail_addtocart_selector_val != "") ? sanitize_text_field($subscriptiondata->tvc_product_detail_addtocart_selector_val) : "";
        $eeoptions["tvc_checkout_step_2_selector"] = (isset($subscriptiondata->tvc_checkout_step_2_selector) && $subscriptiondata->tvc_checkout_step_2_selector != "") ? sanitize_text_field($subscriptiondata->tvc_checkout_step_2_selector) : "";
        $eeoptions["tvc_checkout_step_2_selector_type"] = (isset($subscriptiondata->tvc_checkout_step_2_selector_type) && $subscriptiondata->tvc_checkout_step_2_selector_type != "") ? sanitize_text_field($subscriptiondata->tvc_checkout_step_2_selector_type) : "";
        $eeoptions["tvc_checkout_step_2_selector_val"] = (isset($subscriptiondata->tvc_checkout_step_2_selector_val) && $subscriptiondata->tvc_checkout_step_2_selector_val != "") ? sanitize_text_field($subscriptiondata->tvc_checkout_step_2_selector_val) : "";
        $eeoptions["tvc_checkout_step_3_selector"] = (isset($subscriptiondata->tvc_checkout_step_3_selector) && $subscriptiondata->tvc_checkout_step_3_selector != "") ? sanitize_text_field($subscriptiondata->tvc_checkout_step_3_selector) : "";
        $eeoptions["tvc_checkout_step_3_selector_type"] = (isset($subscriptiondata->tvc_checkout_step_3_selector_type) && $subscriptiondata->tvc_checkout_step_3_selector_type != "") ? sanitize_text_field($subscriptiondata->tvc_checkout_step_3_selector_type) : "";
        $eeoptions["tvc_checkout_step_3_selector_val"] = (isset($subscriptiondata->tvc_checkout_step_3_selector_val) && $subscriptiondata->tvc_checkout_step_3_selector_val != "") ? sanitize_text_field($subscriptiondata->tvc_checkout_step_3_selector_val) : "";
        $eeoptions["want_to_use_your_gtm"] = (isset($subscriptiondata->want_to_use_your_gtm) && $subscriptiondata->want_to_use_your_gtm != "") ? sanitize_text_field($subscriptiondata->want_to_use_your_gtm) : "";
        $eeoptions["use_your_gtm_id"] = (isset($subscriptiondata->use_your_gtm_id) && $subscriptiondata->use_your_gtm_id != "") ? sanitize_text_field($subscriptiondata->use_your_gtm_id) : "";
        $eeoptions["fb_pixel_id"] = (isset($subscriptiondata->fb_pixel_id) && $subscriptiondata->fb_pixel_id != "") ? sanitize_text_field($subscriptiondata->fb_pixel_id) : "";
        $eeoptions["microsoft_convsst_ads_pixel_id"] = (isset($subscriptiondata->microsoft_convsst_ads_pixel_id) && $subscriptiondata->microsoft_convsst_ads_pixel_id != "") ? sanitize_text_field($subscriptiondata->microsoft_convsst_ads_pixel_id) : "";
        $eeoptions["twitter_convsst_ads_pixel_id"] = (isset($subscriptiondata->twitter_convsst_ads_pixel_id) && $subscriptiondata->twitter_convsst_ads_pixel_id != "") ? sanitize_text_field($subscriptiondata->twitter_convsst_ads_pixel_id) : "";
        $eeoptions["pinterest_convsst_ads_pixel_id"] = (isset($subscriptiondata->pinterest_convsst_ads_pixel_id) && $subscriptiondata->pinterest_convsst_ads_pixel_id != "") ? sanitize_text_field($subscriptiondata->pinterest_convsst_ads_pixel_id) : "";
        $eeoptions["snapchat_convsst_ads_pixel_id"] = (isset($subscriptiondata->snapchat_convsst_ads_pixel_id) && $subscriptiondata->snapchat_convsst_ads_pixel_id != "") ? sanitize_text_field($subscriptiondata->snapchat_convsst_ads_pixel_id) : "";
        $eeoptions["tiKtok_convsst_ads_pixel_id"] = (isset($subscriptiondata->tiKtok_convsst_ads_pixel_id) && $subscriptiondata->tiKtok_convsst_ads_pixel_id != "") ? sanitize_text_field($subscriptiondata->tiKtok_convsst_ads_pixel_id) : "";
        $eeoptions["fb_conversion_api_token"] = (isset($subscriptiondata->fb_conversion_api_token) && $subscriptiondata->fb_conversion_api_token != "") ? sanitize_text_field($subscriptiondata->fb_conversion_api_token) : "";
        $eeoptions["tiKtok_business_id"] = (isset($subscriptiondata->tiKtok_business_id) && $subscriptiondata->tiKtok_business_id != "") ? sanitize_text_field($subscriptiondata->tiKtok_business_id) : "";
        $eeoptions["tiKtok_mail_id"] = (isset($subscriptiondata->tiKtok_mail_id) && $subscriptiondata->tiKtok_mail_id != "") ? sanitize_text_field($subscriptiondata->tiKtok_mail_id) : "";

        update_option("convsst_options", serialize($eeoptions));
    } else {
        $url = $apiDomain . "/customer-subscriptions/app_activity_detail";

        $postData = array(
            "subscription_id" => $subscriptionId,
            "domain" => esc_url(get_site_url()),
            "app_status" => sanitize_text_field('active'),
            "app_data" => array(
                "app_version" => "1.0.9",
                "app_id" => CONVSST_APP_ID,
                "is_pro" => 1
            )
        );
        $args = array(
            'headers' => $header,
            'method' => 'POST',
            "timeout" => CONVSST_TM,
            'body' => $postData
        );
        $request = wp_remote_post(esc_url_raw($url), $args);
    }
}

/**
 * Display an admin notice explaining the deactivation.
 */
function convsst_plugin_activation_warning($error_message='') {
    ?>
    <div class="notice error">
      <p>
      <?php 
      /* translators: %s: Error message */
      printf( esc_html__( 'Plugin activation failed. %s:', 'server-side-tagging-via-google-tag-manager-for-wordpress' ), esc_html( $error_message ) ); 
      ?>
      </p>
    </div>
    <?php
}

register_deactivation_hook(__FILE__, 'convsst_deactivate_ecommerce_google_analytics_pro');
function convsst_deactivate_ecommerce_google_analytics_pro()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-enhanced-ecommerce-google-analytics-deactivator.php';
    Convsst_Ecommerce_Google_Analytics_Deactivator::deactivate();
    wp_clear_scheduled_hook('tvc_add_cron_interval_for_product_sync');
}


if (convsst_is_EeAioFreePro_active()) {
    return;
}


$fullName = plugin_basename(__FILE__);
$dir = str_replace('/server-side-tagging-via-google-tag-manager-for-wordpress.php', '', $fullName);
if (!defined('CONVSST_PLUGIN_NAME')) {
    define('CONVSST_PLUGIN_NAME', $dir);
}
// Store the directory of the plugin
if (!defined('CONVSST_PLUGIN_DIR')) {
    define('CONVSST_PLUGIN_DIR', plugin_dir_path(__FILE__));
}
// Store the url of the plugin
if (!defined('CONVSST_PLUGIN_URL')) {
    define('CONVSST_PLUGIN_URL', plugins_url() . '/' . CONVSST_PLUGIN_NAME);
}

if (!defined('CONVSST_API_CALL_URL')) {
    define('CONVSST_API_CALL_URL', 'https://connect.tatvic.com/laravelapi/public/api');   
}

if (!defined('CONVSST_AUTH_CONNECT_URL')) {
    define('CONVSST_AUTH_CONNECT_URL', 'conversios.io');
}

if (!defined('TVC_Admin_Helper')) {
    include_once(CONVSST_PLUGIN_DIR . '/admin/class-tvc-admin-helper.php');
}

if (!defined('CONVSST_LOG')) {
    define('CONVSST_LOG', CONVSST_PLUGIN_DIR . 'logs/');
}

add_action('upgrader_process_complete', 'convsst_upgrade_function_pro', 10, 2);
function convsst_upgrade_function_pro($upgrader_object, $options)
{
    $fullName = plugin_basename(__FILE__);
    if ($options['action'] == 'update' && $options['type'] == 'plugin' && is_array($options['plugins'])) {
        foreach ($options['plugins'] as $each_plugin) {
            if ($each_plugin == $fullName) {
                $TVC_Admin_Helper = new TVC_Admin_Helper();
                $TVC_Admin_Helper->update_app_status();
            }
        }
    }
}

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-enhanced-ecommerce-google-analytics.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */

function convsst_run_ecommerce_google_analytics_pro()
{
    $plugin = new Convsst_Ecommerce_Google_Analytics_Pro();
    $plugin->run();
}
convsst_run_ecommerce_google_analytics_pro();
