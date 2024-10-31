<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       
 * @since      1.0.0
 *
 * Woo Order Reports
 */

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}
if (!class_exists('Convsst_Conversios_Onboarding_Helper')) :
  class Convsst_Conversios_Onboarding_Helper
  {
    protected $apiDomain;
    protected $token;
    public function __construct()
    {
      $this->req_int();
      //analytics
      add_action('wp_ajax_get_analytics_account_list', array($this, 'get_analytics_account_list'));
      add_action('wp_ajax_get_analytics_web_properties', array($this, 'get_analytics_web_properties'));
      add_action('wp_ajax_save_analytics_data', array($this, 'save_analytics_data'));
      //googl_ads
      add_action('wp_ajax_list_googl_convsst_ads_account', array($this, 'list_googl_convsst_ads_account'));
      add_action('wp_ajax_create_google_convsst_ads_account', array($this, 'create_google_convsst_ads_account'));
      add_action('wp_ajax_link_analytic_to_convsst_ads_account', array($this, 'link_analytic_to_convsst_ads_account'));
      add_action('wp_ajax_get_conversion_list', array($this, 'get_conversion_list'));

      //google_merchant
      add_action('wp_ajax_list_google_merchant_account', array($this, 'list_google_merchant_account'));
      add_action('wp_ajax_save_merchant_data', array($this, 'save_merchant_data'));
      add_action('wp_ajax_link_google_convsst_ads_to_merchant_center', array($this, 'link_google_convsst_ads_to_merchant_center'));

      //get subscription details
      add_action('wp_ajax_get_subscription_details', array($this, 'get_subscription_details'));
      add_action('wp_ajax_update_setup_time_to_subscription', array($this, 'update_setup_time_to_subscription'));

      add_action('ee_ut_cron', array($this, 'ee_ut_crons'));

      // GTM Account Settings
      add_action('wp_ajax_convsst_get_gtm_account_list', [$this, 'convsst_get_gtm_account_list']);
      add_action('wp_ajax_convsst_get_gtm_container_list', [$this, 'convsst_get_gtm_container_list']);
      add_action('wp_ajax_convsst_create_gtm_container', [$this, 'convsst_create_gtm_container']);
      add_action('wp_ajax_convsst_run_gtm_automation', [$this, 'convsst_run_gtm_automation']);
      add_action('wp_ajax_convsst_get_gtm_account_with_container', [$this, 'convsst_get_gtm_account_with_container']);
      add_action('wp_ajax_convsst_get_global_container_json', [$this, 'convsst_get_global_container_json']);

      // SST Settings
      add_action('wp_ajax_convsst_create_cloud_run', [$this, 'convsst_create_cloud_run']);
    }

    public function ee_ut_crons()
    {
      $google_detail = unserialize(get_option('convsst_api_data'));
      if (isset($google_detail['setting']->refresh_token)) {
        $refresh_token = sanitize_text_field(base64_decode($google_detail['setting']->refresh_token));
      }
      if ((isset($google_detail['setting']->access_token))) {
        $access_token = sanitize_text_field(base64_decode($google_detail['setting']->access_token));
      }
      $api_obj = new Convsst_Conversios_Onboarding_ApiCall($access_token, $refresh_token);
      echo wp_json_encode($api_obj->createUserTracking());
    }


    public function req_int()
    {
      if (!class_exists('ConvsstCustomApi.php')) {
        require_once(CONVSST_PLUGIN_DIR . 'includes/setup/ConvsstCustomApi.php');
      }
    }
    protected function admin_safe_ajax_call($nonce, $registered_nonce_name)
    {
      // only return results when the user is an admin with manage options
      if (is_admin() && wp_verify_nonce($nonce, $registered_nonce_name)) {
        return true;
      } else {
        return false;
      }
    }

    /**
     * Ajax code for get analytics web properties.
     * @since    4.0.2
     */
    public function get_analytics_web_properties()
    {
      $nonce = (isset($_POST['convsst_onboarding_nonce'])) ? sanitize_text_field($_POST['convsst_onboarding_nonce']) : "";
      if ($this->admin_safe_ajax_call($nonce, 'convsst_onboarding_nonce')) {
        $data = isset($_POST['tvc_data']) ? sanitize_text_field($_POST['tvc_data']) : "";
        $tvc_data = json_decode(str_replace("&quot;", "\"", $data));
        $api_obj = new Convsst_Conversios_Onboarding_ApiCall(sanitize_text_field($tvc_data->access_token), sanitize_text_field($tvc_data->refresh_token));

        $form_data = array(
          "type" => isset($_POST['type']) ? sanitize_text_field($_POST['type']) : '',
          "account_id" => isset($_POST['account_id']) ? sanitize_text_field($_POST['account_id']) : ''
        );
        echo wp_json_encode($api_obj->getAnalyticsWebProperties($form_data));
        wp_die();
      } else {
        echo esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress");
      }
    }

    /**
     * Ajax code for get analytics account list.
     * @since    4.0.2
     */
    public function get_analytics_account_list()
    {
      $nonce = (isset($_POST['convsst_onboarding_nonce'])) ? sanitize_text_field($_POST['convsst_onboarding_nonce']) : "";
      if ($this->admin_safe_ajax_call($nonce, 'convsst_onboarding_nonce')) {
        $data = isset($_POST['tvc_data']) ? sanitize_text_field($_POST['tvc_data']) : "";
        $tvc_data = json_decode(str_replace("&quot;", "\"", $data));
        $api_obj = new Convsst_Conversios_Onboarding_ApiCall(sanitize_text_field($tvc_data->access_token), sanitize_text_field($tvc_data->refresh_token));
        $from_data = array("page" => isset($_POST['page']) ? sanitize_text_field($_POST['page']) : '', 'subscription_id' => isset($_POST['subscription_id']) ? sanitize_text_field($_POST['subscription_id']) : '');  
        echo wp_json_encode($api_obj->getAnalyticsAccountList($from_data));
        wp_die();
      } else {
        echo esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress");
      }
    }


    /**
     * Ajax code for save analytics data.
     * @since    4.0.2
     */
    public function save_analytics_data()
    {
      $nonce = (isset($_POST['post']['convsst_onboarding_nonce'])) ? sanitize_text_field($_POST['post']['convsst_onboarding_nonce']) : "";
      if ($this->admin_safe_ajax_call($nonce, 'convsst_onboarding_nonce')) {
        $data = isset($_POST['post']['tvc_data']) ? sanitize_text_field($_POST['post']['tvc_data']) : "";
        $tvc_data = json_decode(str_replace("&quot;", "\"", $data));
        $api_obj = new Convsst_Conversios_Onboarding_ApiCall(sanitize_text_field($tvc_data->access_token), sanitize_text_field($tvc_data->refresh_token));
        //echo wp_json_encode($api_obj->saveSubscriptionsData($_POST['post'])); // deprecated
        $data = array( 'message' => 'deprecated!' );
        wp_send_json_error( $data, 400 );
        wp_die();
      } else {
        echo esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress");
      }
    }

    /**
     * Ajax code for list googl ads account.
     * @since    4.0.2
     */
    public function list_googl_convsst_ads_account()
    {
      $nonce = (isset($_POST['convsst_onboarding_nonce'])) ? sanitize_text_field($_POST['convsst_onboarding_nonce']) : "";
      if ($this->admin_safe_ajax_call($nonce, 'convsst_onboarding_nonce')) {
        $data = isset($_POST['tvc_data']) ? sanitize_text_field($_POST['tvc_data']) : "";
        $tvc_data = json_decode(str_replace("&quot;", "\"", $data));
        $customApiObj = new ConvsstCustomApi();
        $google_detail = $customApiObj->getGoogleAnalyticDetail($tvc_data->subscription_id);
        $access_token = isset($google_detail->data->access_token) ? base64_encode($google_detail->data->access_token) : '';
        $refresh_token = isset($google_detail->data->refresh_token) ? base64_encode($google_detail->data->refresh_token) : '';
        $api_obj = new Convsst_Conversios_Onboarding_ApiCall(sanitize_text_field($access_token), sanitize_text_field($refresh_token));
        echo wp_json_encode($api_obj->getGoogleAdsAccountList());
        wp_die();
      } else {
        echo esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress");
      }
    }
    /**
     * Ajax code for create google ads account.
     * @since    4.0.2
     */
    public function create_google_convsst_ads_account()
    {
      $nonce = (isset($_POST['convsst_onboarding_nonce'])) ? sanitize_text_field($_POST['convsst_onboarding_nonce']) : "";
      if ($this->admin_safe_ajax_call($nonce, 'convsst_onboarding_nonce')) {
        $data = isset($_POST['tvc_data']) ? sanitize_text_field($_POST['tvc_data']) : "";
        $tvc_data = json_decode(str_replace("&quot;", "\"", $data));
        $api_obj = new Convsst_Conversios_Onboarding_ApiCall(sanitize_text_field($tvc_data->access_token), sanitize_text_field($tvc_data->refresh_token));
        echo wp_json_encode($api_obj->createGoogleAdsAccount($data));
        wp_die();
      } else {
        echo esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress");
      }
    }

    /**
     * Ajax code for link analytic to ads account.
     * @since    4.0.2
     */
    public function link_analytic_to_convsst_ads_account()
    {
      $nonce = (isset($_POST['post']['convsst_onboarding_nonce'])) ? sanitize_text_field($_POST['post']['convsst_onboarding_nonce']) : "";
      if ($this->admin_safe_ajax_call($nonce, 'convsst_onboarding_nonce')) {
        $data = isset($_POST['post']['tvc_data']) ? sanitize_text_field($_POST['post']['tvc_data']) : "";
        $tvc_data = json_decode(str_replace("&quot;", "\"", $data));
        $api_obj = new Convsst_Conversios_Onboarding_ApiCall(sanitize_text_field($tvc_data->access_token), sanitize_text_field($tvc_data->refresh_token));
        //echo wp_json_encode($api_obj->linkAnalyticToAdsAccount($_POST['post'])); // deprecated!
        $data = array( 'message' => 'deprecated!' );
        wp_send_json_error( $data, 400 );
        wp_die();
      } else {
        echo esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress");
      }
    }

    /**
     * Ajax code for list google merchant account.
     * @since    4.0.2
     */
    public function list_google_merchant_account()
    {
      $nonce = (isset($_POST['convsst_onboarding_nonce'])) ? sanitize_text_field($_POST['convsst_onboarding_nonce']) : "";
      if ($this->admin_safe_ajax_call($nonce, 'convsst_onboarding_nonce')) {
        $data = isset($_POST['tvc_data']) ? sanitize_text_field($_POST['tvc_data']) : "";
        $tvc_data = json_decode(str_replace("&quot;", "\"", $data));
        $api_obj = new Convsst_Conversios_Onboarding_ApiCall(sanitize_text_field($tvc_data->access_token), sanitize_text_field($tvc_data->refresh_token));
        echo wp_json_encode($api_obj->listMerchantCenterAccount());
        wp_die();
      } else {
        echo esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress");
      }
    }

    /**
     * Ajax code for save merchant data.
     * @since    4.0.2
     */
    public function save_merchant_data()
    {
      $nonce = (isset($_POST['post']['convsst_onboarding_nonce'])) ? sanitize_text_field($_POST['post']['convsst_onboarding_nonce']) : "";
      if ($this->admin_safe_ajax_call($nonce, 'convsst_onboarding_nonce')) {
        $data = isset($_POST['post']['tvc_data']) ? sanitize_text_field($_POST['post']['tvc_data']) : "";
        $tvc_data = json_decode(str_replace("&quot;", "\"", $data));
        $api_obj = new Convsst_Conversios_Onboarding_ApiCall(sanitize_text_field($tvc_data->access_token), sanitize_text_field($tvc_data->refresh_token));
        //echo wp_json_encode($api_obj->saveMechantData($_POST['post'])); // deprecated!
        $data = array( 'message' => 'deprecated!' );
        wp_send_json_error( $data, 400 );
        wp_die();
      } else {
        echo esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress");
      }
    }
    /**
     * Ajax code for link analytic to ads account.
     * @since    4.0.2
     */
    public function get_conversion_list()
    {
      $nonce = (isset($_POST['convsst_onboarding_nonce'])) ? sanitize_text_field($_POST['convsst_onboarding_nonce']) : "";
      if ($this->admin_safe_ajax_call($nonce, 'convsst_onboarding_nonce')) {
        $data = isset($_POST['tvc_data']) ? sanitize_text_field($_POST['tvc_data']) : "";
        $tvc_data = json_decode(str_replace("&quot;", "\"", $data));
        $api_obj = new Convsst_Conversios_Onboarding_ApiCall(sanitize_text_field($tvc_data->access_token), sanitize_text_field($tvc_data->refresh_token));
        unset($_POST['tvc_data']);
        unset($_POST['convsst_onboarding_nonce']);

        $form_data = [];
        $form_data["customer_id"] = sanitize_text_field($_POST["customer_id"]);
        echo wp_json_encode($api_obj->getConversionList($form_data));
        wp_die();
      } else {
        echo esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress");
      }
    }

    /**
     * Ajax code for link google ads to merchant center.
     * @since    4.0.2
     */
    public function link_google_convsst_ads_to_merchant_center()
    {
      $nonce = (isset($_POST['convsst_onboarding_nonce'])) ? sanitize_text_field($_POST['convsst_onboarding_nonce']) : "";
      if ($this->admin_safe_ajax_call($nonce, 'convsst_onboarding_nonce')) {
        $data = isset($_POST['tvc_data']) ? sanitize_text_field($_POST['tvc_data']) : "";
        $tvc_data = json_decode(str_replace("&quot;", "\"", $data));
        $api_obj = new Convsst_Conversios_Onboarding_ApiCall(sanitize_text_field($tvc_data->access_token), sanitize_text_field($tvc_data->refresh_token));

        $merchant_id = isset($_POST['merchant_id']) ?  sanitize_text_field($_POST['merchant_id']) : '';
        $account_id = isset($_POST['account_id']) ? sanitize_text_field($_POST['account_id']) : '';
        $adwords_id = isset($_POST['adwords_id']) ? sanitize_text_field($_POST['adwords_id']) : '';
        $subscription_id = isset($_POST['subscription_id']) ? sanitize_text_field($_POST['subscription_id']) : '';
        $from_data = array(
          "merchant_id" => $merchant_id,
          "account_id" => $account_id,
          "adwords_id" => $adwords_id,
          "subscription_id" => $subscription_id,
        );
        echo wp_json_encode($api_obj->linkGoogleAdsToMerchantCenter($from_data));
        wp_die();
      } else {
        echo esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress");
      }
    }
    /**
     * Ajax code for link google ads to merchant center.
     * @since    4.0.2
     */
    public function get_subscription_details()
    {
      $nonce = (isset($_POST['convsst_onboarding_nonce'])) ? sanitize_text_field($_POST['convsst_onboarding_nonce']) : "";
      if ($this->admin_safe_ajax_call($nonce, 'convsst_onboarding_nonce')) {
        $data = isset($_POST['tvc_data']) ? sanitize_text_field($_POST['tvc_data']) : "";
        $tvc_data = json_decode(str_replace("&quot;", "\"", $data));
        $api_obj = new Convsst_Conversios_Onboarding_ApiCall(sanitize_text_field($tvc_data->access_token), sanitize_text_field($tvc_data->refresh_token));
        $subscription_id = isset($_POST['subscription_id']) ? sanitize_text_field($_POST['subscription_id']) : '';
        echo wp_json_encode($api_obj->getSubscriptionDetails($tvc_data, $subscription_id));
        wp_die();
      } else {
        echo esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress");
      }
    }

    /**
     * Ajax code for update setup time to subscription.
     * @since    4.0.2
     */
    public function update_setup_time_to_subscription()
    {
      $nonce = (isset($_POST['convsst_onboarding_nonce'])) ? sanitize_text_field($_POST['convsst_onboarding_nonce']) : "";
      if ($this->admin_safe_ajax_call($nonce, 'convsst_onboarding_nonce')) {
        $data = isset($_POST['tvc_data']) ? sanitize_text_field($_POST['tvc_data']) : "";
        $tvc_data = wp_json_decode(str_replace("&quot;", "\"", $data));
        $api_obj = new Convsst_Conversios_Onboarding_ApiCall(sanitize_text_field($tvc_data->access_token), sanitize_text_field($tvc_data->refresh_token));

        $data_value = [];
        foreach ($_POST as $key => $value) {
          $data_value[$key] = sanitize_text_field($value);
        }

        $subscription_id = isset($_POST['subscription_id']) ? sanitize_text_field($_POST['subscription_id']) : '';
        $return_url = $this->save_wp_setting_from_subscription_api($api_obj, $tvc_data, $subscription_id, $data_value);
        $return_rs = $api_obj->updateSetupTimeToSubscription($subscription_id);
        $return_rs->return_url = $return_url;
        echo wp_json_encode($return_rs);
        wp_die();
      } else {
        echo esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress");
      }
    }

    /**
     * save wp setting from subscription api
     * @since    4.0.2
     */
    public function save_wp_setting_from_subscription_api($api_obj, $tvc_data, $subscription_id, $data)
    {
      $old_setting = unserialize(get_option('convsst_options'));
      $TVC_Admin_Helper = new TVC_Admin_Helper();
      $google_detail = $api_obj->getSubscriptionDetails($tvc_data, $subscription_id);
      /**
       * active licence key while come from server page
       */
      $ee_additional_data = $TVC_Admin_Helper->get_ee_additional_data();
      if (isset($ee_additional_data['temp_active_licence_key']) && $ee_additional_data['temp_active_licence_key'] != "") {
        $licence_key = $ee_additional_data['temp_active_licence_key'];
        $subscription_id = isset($_GET['subscription_id']) ? sanitize_text_field($_GET['subscription_id']) : '';
        $TVC_Admin_Helper->active_licence($licence_key, $subscription_id);
        unset($ee_additional_data['temp_active_licence_key']);
        $TVC_Admin_Helper->set_ee_additional_data($ee_additional_data);
      }
      if (property_exists($google_detail, "error") && $google_detail->error == false) {
        $googleDetail = $google_detail->data;
        /**
         * for site verifecation
         */
        /*if(isset($googleDetail->google_merchant_center_id) && sanitize_text_field($googleDetail->google_merchant_center_id)){
          $this->site_verification_and_domain_claim($googleDetail);
        }*/

        $settings['subscription_id'] = sanitize_text_field($googleDetail->id);
        $settings['ga_eeT'] = (isset($googleDetail->enhanced_e_commerce_tracking) && sanitize_text_field($googleDetail->enhanced_e_commerce_tracking) == "1") ? "on" : "";

        $settings['ga_ST'] = (isset($googleDetail->add_gtag_snippet) && sanitize_text_field($googleDetail->add_gtag_snippet) == "1") ? "on" : "";
        $settings['gm_id'] = sanitize_text_field($googleDetail->measurement_id);
        $settings['ga_id'] = sanitize_text_field($googleDetail->property_id);
        $settings['google_ads_id'] = sanitize_text_field($googleDetail->google_ads_id);
        $settings['google_merchant_id'] = sanitize_text_field($googleDetail->google_merchant_center_id);
        $settings['tracking_option'] = sanitize_text_field($googleDetail->tracking_option);
        $settings['ga_gUser'] = 'on';
        $settings['ga_Impr'] = 6;
        $settings['ga_IPA'] = 'on';
        //$settings['ga_OPTOUT'] = 'on';
        $settings['ga_PrivacyPolicy'] = 'on';
        $settings['google-analytic'] = '';
        $settings['ga4_api_secret'] = isset($old_setting['ga4_api_secret']) ? $old_setting['ga4_api_secret'] : "";
        $settings['ga_CG'] = isset($old_setting['ga_CG']) ? $old_setting['ga_CG'] : "";
        $settings['ga_optimize_id'] = isset($old_setting['ga_optimize_id']) ? $old_setting['ga_optimize_id'] : "";

        $tracking_integration = array("tracking_method", "tvc_product_list_data_collection_method", "tvc_product_detail_data_collection_method", "tvc_checkout_data_collection_method", "tvc_thankyou_data_collection_method", "tvc_product_detail_addtocart_selector", "tvc_product_detail_addtocart_selector_type", "tvc_product_detail_addtocart_selector_val", "tvc_checkout_step_2_selector", "tvc_checkout_step_2_selector_type", "tvc_checkout_step_2_selector_val", "tvc_checkout_step_3_selector", "tvc_checkout_step_3_selector_type", "tvc_checkout_step_3_selector_val");
        foreach ($tracking_integration as $val) {
          $settings[$val] = isset($old_setting[$val]) ? sanitize_text_field($old_setting[$val]) : "";
        }

        //remove old conversion label if google_ads_id changed
        if ($old_setting['google_ads_id'] != $settings['google_ads_id']) {
          update_option('conversio_send_to', null);
        }


        $ga_ec = (isset($data["ga_ec"]) && $data["ga_ec"] == "1") ? 1 : 0;
        update_option('convsst_ga_EC', sanitize_text_field($ga_ec));

        //onboarding settings
        $setting_integration = array("tracking_method", "want_to_use_your_gtm", "use_your_gtm_id", "fb_pixel_id", "microsoft_convsst_ads_pixel_id", "twitter_convsst_ads_pixel_id", "pinterest_convsst_ads_pixel_id", "snapchat_convsst_ads_pixel_id", "tiKtok_convsst_ads_pixel_id", "fb_conversion_api_token");
        foreach ($setting_integration as $val) {
          $settings[$val] = isset($data[$val]) ? sanitize_text_field($data[$val]) : "";
        }

        //update option in wordpress local database
        update_option('convsst_google_ads_tracking', $googleDetail->convsst_google_ads_tracking);
        update_option('convsst_ads_tracking_id', $googleDetail->google_ads_id);
        update_option('convsst_ads_ert', $googleDetail->remarketing_tags);
        update_option('convsst_ads_edrt', $googleDetail->dynamic_remarketing_tags);

        $TVC_Admin_Helper->save_ee_options_settings($settings);
        $TVC_Admin_Helper->update_app_status();
        /**
         * for save conversion send to in WP DB
         */
        /*
         * function call for save API data in WP DB
         */
        $TVC_Admin_Helper->set_update_api_to_db($googleDetail);

        /**
         * function call for save remarketing snippets in WP DB
         */
        $TVC_Admin_Helper->update_remarketing_snippets();

        /*if($googleDetail->plan_id != 1 && sanitize_text_field($googleDetail->convsst_google_ads_tracking) == 1){
          //$TVC_Admin_Helper->update_conversion_send_to();
        }*/
        /**
         * save gmail and view ID in WP DB
         */
        if (property_exists($tvc_data, "g_mail") && sanitize_email($tvc_data->g_mail)) {
          update_option('convsst_customer_gmail', $tvc_data->g_mail);
        }
        //is not work for existing user && $ee_additional_data['convsst_created_at'] != "" 
        if (isset($ee_additional_data['convsst_created_at'])) {
          $ee_additional_data = $TVC_Admin_Helper->get_ee_additional_data();
          $ee_additional_data['convsst_updated_at'] = gmdate('Y-m-d');
          $TVC_Admin_Helper->set_ee_additional_data($ee_additional_data);
        } else {
          $ee_additional_data = $TVC_Admin_Helper->get_ee_additional_data();
          $ee_additional_data['convsst_created_at'] = gmdate('Y-m-d');
          $ee_additional_data['convsst_updated_at'] = gmdate('Y-m-d');
          $TVC_Admin_Helper->set_ee_additional_data($ee_additional_data);
        }

        $return_url = "admin.php?page=conversios-google-shopping-feed&tab=gaa_config_page";
        if (isset($googleDetail->google_merchant_center_id) || isset($googleDetail->google_ads_id)) {
          if (sanitize_text_field($googleDetail->google_merchant_center_id) != "" && sanitize_text_field($googleDetail->google_ads_id) != "") {
            $return_url = esc_url("admin.php?page=conversios-google-shopping-feed&tab=sync_product_page&welcome_msg=true");
          } else {
            $return_url = esc_url("admin.php?page=conversios-google-shopping-feed&tab=gaa_config_page&welcome_msg=true");
          }
        }
        return $return_url;
      }
    }
    

    public function convsst_get_gtm_account_list()
    {

      $nonce = (isset($_POST['gtm_account_nonce'])) ? sanitize_text_field($_POST['gtm_account_nonce']) : "";
      if ($this->admin_safe_ajax_call($nonce, 'gtm_account_nonce')) {
        $customApiObj = new ConvsstCustomApi();

        $post = array("subscription_id"=> sanitize_text_field($_POST["subscription_id"]), "gtm_account_nonce"=> sanitize_text_field($_POST["gtm_account_nonce"]));
        $data = $customApiObj->convsst_get_gtm_account_list($post);

        unset($_POST['subscription_id']);
        unset($_POST['gtm_account_nonce']);
        echo wp_json_encode($data);
        wp_die();
      } else {
        echo esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress");
      }
    }

    public function convsst_create_gtm_container()
    {

      $nonce = (isset($_POST['post']['gtm_create_container_nonce'])) ? sanitize_text_field($_POST['post']['gtm_create_container_nonce']) : "";
      if ($this->admin_safe_ajax_call($nonce, 'gtm_create_container_nonce')) {
        $customApiObj = new ConvsstCustomApi();
        $data = $customApiObj->convsst_create_gtm_container(array_map('sanitize_text_field', $_POST['post']));

        unset($_POST['subscription_id']);
        unset($_POST['gtm_create_container_nonce']);
        echo wp_json_encode($data);
        wp_die();
      } else {
        echo esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress");
      }
    }

    public function convsst_run_gtm_automation()
    {

      $nonce = (isset($_POST['post']['gtm_run_gtm_automation_nonce'])) ? sanitize_text_field($_POST['post']['gtm_run_gtm_automation_nonce']) : "";
      if ($this->admin_safe_ajax_call($nonce, 'gtm_run_gtm_automation_nonce')) {
        $customApiObj = new ConvsstCustomApi();
        $data = $customApiObj->convsst_run_gtm_automation( array_map('sanitize_text_field', $_POST['post']) );

        unset($_POST['subscription_id']);
        unset($_POST['gtm_run_gtm_automation_nonce']);
        echo wp_json_encode($data);
        wp_die();
      } else {
        echo esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress");
      }
    }

    public function convsst_get_gtm_account_with_container()
    {

      $nonce = (isset($_POST['get_gtm_account_with_container_nonce'])) ? sanitize_text_field($_POST['get_gtm_account_with_container_nonce']) : "";
      if ($this->admin_safe_ajax_call($nonce, 'get_gtm_account_with_container_nonce')) {
        $customApiObj = new ConvsstCustomApi();

        $post = array("subscription_id"=>sanitize_text_field($_POST["subscription_id"]), "get_gtm_account_with_container_nonce"=>sanitize_text_field($_POST["get_gtm_account_with_container_nonce"]));
        $data = $customApiObj->convsst_get_gtm_account_with_container($post);

        unset($_POST['subscription_id']);
        unset($_POST['get_gtm_account_with_container_nonce']);
        echo wp_json_encode($data);
        wp_die();
      } else {
        echo esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress");
      }
    }


    public function convsst_get_global_container_json()
    {

      $nonce = (isset($_POST['gtm_global_container_json_nonce'])) ? sanitize_text_field($_POST['gtm_global_container_json_nonce']) : "";
      if ($this->admin_safe_ajax_call($nonce, 'gtm_global_container_json_nonce')) {
        $customApiObj = new ConvsstCustomApi();

        $post = array("gtm_global_container_json_nonce"=> sanitize_text_field($_POST["gtm_global_container_json_nonce"]), "is_sst_server_json"=> sanitize_text_field($_POST["is_sst_server_json"]));
        $data = $customApiObj->convsst_get_global_container_json($post);

        unset($_POST['gtm_global_container_json_nonce']);
        echo wp_json_encode($data);
        wp_die();
      } else {
        echo esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress");
      }
    }

    public function convsst_create_cloud_run()
    {

      $nonce = (isset($_POST['post']['create_cloud_nonce'])) ? sanitize_text_field($_POST['post']['create_cloud_nonce']) : "";
      if ($this->admin_safe_ajax_call($nonce, 'create_cloud_nonce')) {
        $customApiObj = new ConvsstCustomApi();
        $data = $customApiObj->convsst_create_cloud_run( array_map('sanitize_text_field', $_POST['post']) );
        
        unset($_POST['subscription_id']);
        unset($_POST['create_cloud_nonce']);
        
        echo wp_json_encode($data);
        wp_die();
      } else {
        echo esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress");
      }
      
    }

  }


endif; // class_exists
new Convsst_Conversios_Onboarding_Helper();

if (!class_exists('Convsst_Conversios_Onboarding_ApiCall')) {
  class Convsst_Conversios_Onboarding_ApiCall
  {
    protected $apiDomain;
    protected $token;
    protected $merchantId;
    protected $access_token;
    protected $refresh_token;
    public function __construct($access_token, $refresh_token)
    {
      $filesystem = new WP_Filesystem_Direct( true );
      $merchantInfo = json_decode($filesystem->get_contents(CONVSST_PLUGIN_DIR . "includes/setup/json/merchant-info.json"),true);
      $this->refresh_token = $refresh_token;
      $this->access_token = base64_encode($this->generateAccessToken(base64_decode($access_token), base64_decode($this->refresh_token)));
      $this->apiDomain = CONVSST_API_CALL_URL;
      $this->token = 'MTIzNA==';
      $this->merchantId = sanitize_text_field($merchantInfo['merchantId']);
    }
    protected function admin_safe_ajax_call($nonce, $registered_nonce_name)
    {
      // only return results when the user is an admin with manage options
      if (is_admin() && wp_verify_nonce($nonce, $registered_nonce_name)) {
        return true;
      } else {
        return false;
      }
    }
    public function tc_wp_remot_call_post($url, $args)
    {
      try {
        if (!empty($args)) {
          // Send remote request
          $args['timeout'] = "1000";
          $request = wp_remote_post($url, $args);

          // Retrieve information
          $response_code = wp_remote_retrieve_response_code($request);

          $response_message = wp_remote_retrieve_response_message($request);
          $response_body = json_decode(wp_remote_retrieve_body($request));

          if ((isset($response_body->error) && $response_body->error == '')) {
            return new WP_REST_Response($response_body->data);
          } else {
            return new WP_Error($response_code, $response_message, $response_body);
          }
        }
      } catch (Exception $e) {
        return $e->getMessage();
      }
    }

    public function getSubscriptionDetails($tvc_data, $subscription_id)
    {
      try {
        $tvc_data = (object)$tvc_data;
        $access_token = sanitize_text_field(base64_decode($this->access_token));
        $url = $this->apiDomain . '/customer-subscriptions/subscription-detail';
        $header = array("Authorization: Bearer MTIzNA==", "Content-Type" => "application/json", "AccessToken: $access_token");
        $data = [
          'subscription_id' => sanitize_text_field($subscription_id), //$this->subscription_id,
          'domain' => sanitize_text_field($tvc_data->user_domain)
        ];
        $args = array(
          'headers' => $header,
          'method' => 'POST',
          'body' => wp_json_encode($data)
        );
        $result = $this->tc_wp_remot_call_post(esc_url_raw($url), $args);

        $return = new \stdClass();
        if ($result->status == 200) {
          $return->status = $result->status;
          $return->data = $result->data;
          $return->error = false;
          return $return;
        } else {
          $return->error = true;
          $return->data = $result->data;
          $return->status = $result->status;
          return $return;
        }
      } catch (Exception $e) {
        return $e->getMessage();
      }
    }

    public function getAnalyticsWebProperties($postData)
    {
      try {
        $url = $this->apiDomain . '/google-analytics/wep-details/account-id';
        $access_token = sanitize_text_field(base64_decode($this->access_token));
        $data = [
          'type' => sanitize_text_field($postData['type']),
          'account_id' => sanitize_text_field($postData['account_id'])
        ];
        $args = array(
          'timeout' => CONVSST_TM,
          'headers' => array(
            'Authorization' => "Bearer MTIzNA==",
            'Content-Type' => 'application/json',
            'AccessToken' => $access_token
          ),
          'body' => wp_json_encode($data)
        );
        $request = wp_remote_post(esc_url_raw($url), $args);

        // Retrieve information
        $response_code = wp_remote_retrieve_response_code($request);
        $response_message = wp_remote_retrieve_response_message($request);
        $response = json_decode(wp_remote_retrieve_body($request));
        $return = new \stdClass();
        if (isset($response->error) && $response->error == '') {
          $return->status = $response_code;
          $return->data = $response->data;
          $return->error = false;
          return $return;
        } else {
          $return->error = true;
          $return->data = ($response->data) ? $response->data : "";
          $return->status = $response_code;
          $return->errors = wp_json_encode($response->errors);
          return $return;
        }
      } catch (Exception $e) {
        return $e->getMessage();
      }
    }
    public function getAnalyticsAccountList($postData)
    {
      try {
        $url = $this->apiDomain . '/google-analytics/ga-account-list';

        $access_token = sanitize_text_field(base64_decode($this->access_token));
        $max_results = 100;
        $page = (isset($postData['page']) && sanitize_text_field($postData['page']) > 1) ? sanitize_text_field($postData['page']) : "1";
        if ($page > 1) {
          //set index
          $page = (($page - 1) * $max_results) + 1;
        }
        $data = [
          'page' => sanitize_text_field($page),
          'max_results' => sanitize_text_field($max_results)
        ];
        $args = array(
          'timeout' => CONVSST_TM,
          'headers' => array(
            'Authorization' => "Bearer MTIzNA==",
            'Content-Type' => 'application/json',
            'AccessToken' => $access_token
          ),
          'body' => wp_json_encode($data)
        );
        $request = wp_remote_post(esc_url_raw($url), $args);

        // Retrieve information
        $response_code = wp_remote_retrieve_response_code($request);
        $response_message = wp_remote_retrieve_response_message($request);
        $response = json_decode(wp_remote_retrieve_body($request));

        /*if ( isset($postData['subscription_id']) && !empty($postData['subscription_id']) ) {
          // reset options on change email for pixel page - for GAds and GA4
          $convsst_options = unserialize(get_option('convsst_options'));
          unset($convsst_options["gads_conversions"]);
          unset($convsst_options["ga4_analytic_account_id"]);
          unset($convsst_options["gm_id"]);
          unset($convsst_options["google_ads_id"]);
          update_option('convsst_options', serialize($convsst_options));

          // reset options on change email for channel inner settings - for GAds and GA4
          $conversio_send_to = "";
          //update_option('convsst_google_ads_tracking', sanitize_text_field($convsst_google_ads_tracking));
          //update_option('convsst_ga_EC', sanitize_text_field($ga_EC));
          update_option('conversio_send_to', sanitize_text_field($conversio_send_to));

          $convsst_options = unserialize(get_option('convsst_api_data'));
          $convsst_options["setting"]->google_ads_id = '';
          $convsst_options["setting"]->measurement_id = '';
          $convsst_options["setting"]->ga4_property_id = '';
          $convsst_options["setting"]->ga4_analytic_account_id = '';
          update_option('convsst_api_data', serialize($convsst_options));

          // will update all options in middleware by below code
          $TVC_Admin_Helper = new TVC_Admin_Helper();
          $TVC_Admin_Helper->update_app_status();
        }*/

        $return = new \stdClass();
        if (isset($response->error) && $response->error == '') {
          $return->status = $response_code;
          $return->data = $response->data;
          $return->error = false;
          return $return;
        } else {
          $return->error = true;
          if (isset($return->data)) {
            $return->data = ($response->data) ? $response->data : "";
            $return->status = $response_code;
            $return->errors = wp_json_encode($response->errors);
            return $return;
          } else {
            $return->data = ($response->errors) ? $response->errors : "";
            $return->status = "";
            $return->errors = $response->errors;
            return $return;
          }
        }
      } catch (Exception $e) {
        return $e->getMessage();
      }
    }
    public function getGoogleAdsAccountList()
    {
      try {
        if ($this->refresh_token != "") {
          $url = $this->apiDomain . '/adwords/list';
          $refresh_token = sanitize_text_field(base64_decode($this->refresh_token));
          $args = array(
            'timeout' => CONVSST_TM,
            'headers' => array(
              'Authorization' => "Bearer MTIzNA==",
              'Content-Type' => 'application/json',
              'RefreshToken' => $refresh_token
            ),
            'body' => ""
          );
          $request = wp_remote_post(esc_url_raw($url), $args);

          // Retrieve information
          $response_code = wp_remote_retrieve_response_code($request);
          $response_message = wp_remote_retrieve_response_message($request);
          $response = json_decode(wp_remote_retrieve_body($request));
          $return = new \stdClass();
          if (isset($response->error) && $response->error !== null && $response->error === false) {
            $return->status = $response_code;
            $return->data = $response->data;
            $return->error = false;
            return $return;
          } else {
            $return->error = true;
            if (isset($response->data)) {
              $return->data = $response->data;
            } else {
              $return->data = "";
            }
            $return->status = $response_code;
            if (isset($response->errors)) {
              $return->errors = wp_json_encode($response->errors);
            } else {
              $return->errors = "";
            }
            return $return;
          }
        } else {
          return array("error" => true);
        }
      } catch (Exception $e) {
        return $e->getMessage();
      }
    }

    public function listMerchantCenterAccount()
    {
      try {
        $url = $this->apiDomain . '/gmc/user-merchant-center/list';
        $header = array("Authorization: Bearer MTIzNA==", "Content-Type" => "application/json");
        $data = [
          'access_token' => sanitize_text_field(base64_decode($this->access_token)),
        ];
        $args = array(
          'timeout' => CONVSST_TM,
          'headers' => $header,
          'method' => 'POST',
          'body' => wp_json_encode($data)
        );
        $result = $this->tc_wp_remot_call_post(esc_url_raw($url), $args);
        $return = new \stdClass();
        if ($result->status == 200) {
          $return->status = $result->status;
          $return->data = $result->data;
          $return->error = false;
          return $return;
        } else {
          $return->error = true;
          $return->data = $result->data;
          $return->status = $result->status;
          $return->errors = wp_json_encode($result->errors);
          return $return;
        }
      } catch (Exception $e) {
        return $e->getMessage();
      }
    }

    public function createGoogleAdsAccount($postData)
    {
      $nonce = (isset($_POST['convsst_onboarding_nonce'])) ? sanitize_text_field($_POST['convsst_onboarding_nonce']) : "";
      if ($this->admin_safe_ajax_call($nonce, 'convsst_onboarding_nonce')) {
        try {
          $data = isset($_POST['tvc_data']) ? sanitize_text_field($_POST['tvc_data']) : "";
          $tvc_data = json_decode(str_replace("&quot;", "\"", $data));
          $url = $this->apiDomain . '/adwords/create-ads-account';
          $header = array("Authorization: Bearer MTIzNA==", "Content-Type" => "application/json");
          $data = [
            'subscription_id' => sanitize_text_field($tvc_data->subscription_id),
            'email' => sanitize_email($tvc_data->g_mail),
            'currency' => sanitize_text_field($tvc_data->currency_code),
            'time_zone' => sanitize_text_field($tvc_data->timezone_string), //'Asia/Kolkata',
            'domain' => sanitize_text_field($tvc_data->user_domain)
          ];
          $args = array(
            'headers' => $header,
            'method' => 'POST',
            'body' => wp_json_encode($data)
          );
          $result = $this->tc_wp_remot_call_post(esc_url_raw($url), $args);
          $return = new \stdClass();
          if ($result->status == 200) {
            $return->status = $result->status;
            $return->data = $result->data;
            $return->error = false;
            //admin notice when user created new google ads account.
            /*$TVC_Admin_Helper = new TVC_Admin_Helper();
            $link_title = "Create Performance max campaign now.";
            $content = "Create your first Google Ads performance max campaign using the plugin and get $500 as free credits.";
            $status = "1";
            $link = "admin.php?page=conversios-pmax";
            $created_google_convsst_ads_id = $result->data->adwords_id;
            $TVC_Admin_Helper->tvc_add_admin_notice("created_googleads_account", $content, $status, $link_title, $link, $created_google_convsst_ads_id, "", "6", "created_googleads_account");*/
            return $return;
          } else {
            $return->error = true;
            $return->error = $result->errors;
            $return->errors = wp_json_encode($result->errors);
            //$return->data = $result->data;
            $return->status = $result->status;
            return $return;
          }
        } catch (Exception $e) {
          return $e->getMessage();
        }
      }
    }

    public function saveSubscriptionsData($postData = array())
    {
      try {
        $url = $this->apiDomain . '/customer-subscriptions/update-detail';
        $header = array("Authorization: Bearer MTIzNA==", "Content-Type" => "application/json");
        $data = array(
          'subscription_id' => sanitize_text_field((isset($postData['subscription_id'])) ? $postData['subscription_id'] : ''),
          'tracking_option' => sanitize_text_field((isset($postData['tracking_option'])) ? $postData['tracking_option'] : ''),
          'measurement_id' => sanitize_text_field((isset($postData['web_measurement_id'])) ? $postData['web_measurement_id'] : ''),
          'ga4_analytic_account_id' => sanitize_text_field((isset($postData['ga4_account_id'])) ? $postData['ga4_account_id'] : ''),
          'property_id' => sanitize_text_field((isset($postData['web_property_id'])) ? $postData['web_property_id'] : ''),
          'ua_analytic_account_id' => sanitize_text_field((isset($postData['ua_account_id'])) ? $postData['ua_account_id'] : ''),
          'enhanced_e_commerce_tracking' => sanitize_text_field((isset($postData['enhanced_e_commerce_tracking']) && $postData['enhanced_e_commerce_tracking'] == 'true') ? 1 : 0),
          'user_time_tracking' => sanitize_text_field((isset($postData['user_time_tracking']) && $postData['user_time_tracking'] == 'true') ? 1 : 0),
          'add_gtag_snippet' => sanitize_text_field((isset($postData['add_gtag_snippet']) && $postData['add_gtag_snippet'] == 'true') ? 1 : 0),
          'client_id_tracking' => sanitize_text_field((isset($postData['client_id_tracking']) && $postData['client_id_tracking'] == 'true') ? 1 : 0),
          'exception_tracking' => sanitize_text_field((isset($postData['exception_tracking']) && $postData['exception_tracking'] == 'true') ? 1 : 0),
          'enhanced_link_attribution_tracking' => sanitize_text_field((isset($postData['enhanced_link_attribution_tracking']) && $postData['enhanced_link_attribution_tracking'] == 'true') ? 1 : 0),
          'google_ads_id' => sanitize_text_field((isset($postData['google_ads_id'])) ? $postData['google_ads_id'] : ''),
          'remarketing_tags' => sanitize_text_field((isset($postData['remarketing_tags']) && $postData['remarketing_tags'] == 'true') ? 1 : 0),
          'dynamic_remarketing_tags' => sanitize_text_field((isset($postData['dynamic_remarketing_tags']) && $postData['dynamic_remarketing_tags'] == 'true') ? 1 : 0),
          'google_ads_tracking' => sanitize_text_field((isset($postData['convsst_google_ads_tracking']) && $postData['convsst_google_ads_tracking'] == 'true') ? 1 : 0),
          'link_google_analytics_with_google_ads' => sanitize_text_field((isset($postData['link_google_analytics_with_google_ads']) && $postData['link_google_analytics_with_google_ads'] == 'true') ? 1 : 0)
        );
        $args = array(
          'headers' => $header,
          'method' => 'POST',
          'body' => wp_json_encode($data)
        );
        $result = $this->tc_wp_remot_call_post(esc_url_raw($url), $args);
        $return = new \stdClass();
        if ($result->status == 200) {
          $return->status = $result->status;
          $return->data = $result->data;
          $return->error = false;
          return $return;
        } else {
          $return->error = true;
          $return->data = $result->data;
          $return->status = $result->status;
          $return->errors = wp_json_encode($result->errors);
          return $return;
        }
      } catch (Exception $e) {
        return $e->getMessage();
      }
    }

    public function saveMechantData($postData = array())
    {
      try {
        $url = $this->apiDomain . '/customer-subscriptions/update-detail';
        $header = array("Authorization: Bearer MTIzNA==", "Content-Type" => "application/json");
        $data = [
          'merchant_id' => sanitize_text_field(($postData['merchant_id'] == 'NewMerchant') ? $this->merchantId : $postData['merchant_id']),
          'subscription_id' => sanitize_text_field((isset($postData['subscription_id'])) ? $postData['subscription_id'] : ''),
          'google_merchant_center_id' => sanitize_text_field((isset($postData['google_merchant_center'])) ? $postData['google_merchant_center'] : ''),
          'website_url' => sanitize_text_field($postData['website_url']),
          'customer_id' => sanitize_text_field($postData['customer_id'])
        ];
        $args = array(
          'headers' => $header,
          'method' => 'POST',
          'body' => wp_json_encode($data)
        );
        $result = $this->tc_wp_remot_call_post(esc_url_raw($url), $args);
        $return = new \stdClass();
        if ($result->status == 200) {
          $return->status = $result->status;
          $return->data = $result->data;
          $return->error = false;
          return $return;
        } else {
          $return->error = true;
          $return->data = $result->data;
          $return->status = $result->status;
          $return->errors = wp_json_encode($result->errors);
          return $return;
        }
      } catch (Exception $e) {
        return $e->getMessage();
      }
    }

    public function linkAnalyticToAdsAccount($postData)
    {
      try {
        $url = $this->apiDomain . '/google-analytics/link-ads-to-analytics';
        $access_token = sanitize_text_field(base64_decode($this->access_token));
        $refresh_token = sanitize_text_field(base64_decode($this->refresh_token));
        $data = [
          'type' => "GA4",
          'ads_customer_id' => sanitize_text_field($postData['ads_customer_id']),
          'subscription_id' => sanitize_text_field($postData['subscription_id']),
        ];

        $args = array(
          'timeout' => CONVSST_TM,
          'headers' => array(
            'Authorization' => "Bearer $this->token",
            'Content-Type' => 'application/json',
            'AccessToken' => $access_token,
            'RefreshToken' => $refresh_token
          ),
          'method' => 'POST',
          'body' => wp_json_encode($data)
        );
        $request = wp_remote_post(esc_url_raw($url), $args);

        // Retrieve information
        $response_code = wp_remote_retrieve_response_code($request);
        $response_message = wp_remote_retrieve_response_message($request);
        $result = json_decode(wp_remote_retrieve_body($request));
        $return = new \stdClass();
        if ($response_code == 200 && isset($result->error) && $result->error == '') {
          $return->status = $response_code;
          $return->data = $result->data;
          $return->error = false;
          return $return;
        } else {
          $return->error = true;
          $return->errors = $result->errors;
          $return->status = $response_code;
          return $return;
        }
      } catch (Exception $e) {
        return $e->getMessage();
      }
    }
    public function linkGoogleAdsToMerchantCenter($postData)
    {
      try {
        $url = $this->apiDomain . '/adwords/link-ads-to-merchant-center';
        $access_token = sanitize_text_field(base64_decode($this->access_token));
        $data = [
          'merchant_id' => sanitize_text_field(($postData['merchant_id']) == 'NewMerchant' ?  $this->merchantId : $postData['merchant_id']),
          'account_id' => sanitize_text_field($postData['account_id']),
          'adwords_id' => sanitize_text_field($postData['adwords_id'])
        ];
        $args = array(
          'timeout' => CONVSST_TM,
          'headers' => array(
            'Authorization' => "Bearer $this->token",
            'Content-Type' => 'application/json',
            'AccessToken' => $access_token
          ),
          'method' => 'POST',
          'body' => wp_json_encode($data)
        );

        // Send remote request
        $request = wp_remote_post(esc_url_raw($url), $args);

        // Retrieve information
        $response_code = wp_remote_retrieve_response_code($request);
        $response_message = wp_remote_retrieve_response_message($request);
        $result = json_decode(wp_remote_retrieve_body($request));
        $return = new \stdClass();
        if ($response_code == 200) {
          $return->status = $response_code;
          $return->data = $result->data;
          $return->error = false;
          return $return;
        } else {
          $return->error = true;
          $return->errors = $result->errors;
          $return->status = $response_code;
          return $return;
        }
      } catch (Exception $e) {
        return $e->getMessage();
      }
    }
    public function updateSetupTimeToSubscription($postData)
    {
      try {
        $url = $this->apiDomain . '/customer-subscriptions/update-setup-time';
        $data = [
          'subscription_id' => sanitize_text_field((isset($postData['subscription_id'])) ? $postData['subscription_id'] : ''),
          'setup_end_time' => gmdate('Y-m-d H:i:s')
        ];
        $args = array(
          'timeout' => CONVSST_TM,
          'headers' => array(
            'Authorization' => "Bearer $this->token",
            'Content-Type' => 'application/json'
          ),
          'method' => 'POST',
          'body' => wp_json_encode($data)
        );

        // Send remote request
        $request = wp_remote_post(esc_url_raw($url), $args);

        // Retrieve information
        $response_code = wp_remote_retrieve_response_code($request);
        $response_message = wp_remote_retrieve_response_message($request);
        $result = json_decode(wp_remote_retrieve_body($request));
        $return = new \stdClass();
        if ($response_code == 200) {
          $return->status = $response_code;
          $return->data = $result->data;
          $return->error = false;
          return $return;
        } else {
          $return->error = true;
          // $return->errors = $result->errors;
          $return->status = $response_code;
          $return->errors = json_decode($result->errors[0]);
          $return->errors = json_decode($response->errors[0]);
          return $return;
        }
      } catch (Exception $e) {
        return $e->getMessage();
      }
    }

    public function getConversionList($postData)
    {
      try {
        if (!empty($postData)) {
          foreach ($postData as $key => $value) {
            $postData[$key] = sanitize_text_field($value);
          }
        }
        $url = $this->apiDomain . '/google-ads/conversion-list';
        $header = array(
          "Authorization: Bearer MTIzNA==",
          "Content-Type" => "application/json"
        );
        $args = array(
          'timeout' => CONVSST_TM,
          'headers' => $header,
          'method' => 'POST',
          'body' => wp_json_encode($postData)
        );
        $request = wp_remote_post(esc_url_raw($url), $args);
        $response_code = wp_remote_retrieve_response_code($request);
        $response_message = wp_remote_retrieve_response_message($request);
        $response = json_decode(wp_remote_retrieve_body($request));

        $return = new \stdClass();
        if ((isset($response->error) && $response->error == '')) {
          $return->status = $response_code;
          $return->data = $response->data;
          $return->error = false;
          if (isset($response->data) && count($response->data) > 0) {
            $return->message = esc_html__("Google Ads conversion tracking setting success.", "server-side-tagging-via-google-tag-manager-for-wordpress");
          } else {
            $response = $this->createConversion($postData);
            if (isset($response->error) && $response->error == false) {
              $return->error = false;
              $return->message = esc_html__("Google Ads conversion tracking setting success.", "server-side-tagging-via-google-tag-manager-for-wordpress");
            } else {
              $return->error = true;
              $errors = json_decode($response->errors[0]);
              $return->errors = $errors->message;
            }
          }
          return $return;
        } else {
          $return->error = true;
          $return->errors = $response->errors[0];
          //$return->data = $result->data;
          $return->status = $response_code;
          return $return;
        }
      } catch (Exception $e) {
        return $e->getMessage();
      }
    }

    public function createConversion($postData)
    {
      try {
        $url = $this->apiDomain . '/google-ads/create-conversion';
        $header = array("Authorization: Bearer MTIzNA==", "Content-Type" => "application/json");
        $data = [
          'customer_id' => sanitize_text_field((isset($postData['customer_id'])) ? $postData['customer_id'] : ''),
          'name' => "Order Conversion"
        ];
        $args = array(
          'headers' => $header,
          'method' => 'POST',
          'body' => wp_json_encode($data)
        );
        $result = $this->tc_wp_remot_call_post(esc_url_raw($url), $args);
        $return = new \stdClass();
        if ($result->status == 200) {
          $return->status = $result->status;
          $return->data = $result->data;
          $return->error = false;
          return $return;
        } else {
          $return->error = true;
          $return->data = $result->data;
          $return->status = $result->status;
          return $return;
        }
      } catch (Exception $e) {
        return $e->getMessage();
      }
    }
    public function generateAccessToken($access_token, $refresh_token)
    {
      $url = "https://www.googleapis.com/oauth2/v1/tokeninfo?access_token=" . $access_token;
      $request =  wp_remote_get(esc_url_raw($url), array('timeout' => CONVSST_TM));
      $response_code = wp_remote_retrieve_response_code($request);

      $response_message = wp_remote_retrieve_response_message($request);
      $result = json_decode(wp_remote_retrieve_body($request));

      if (isset($result->error) && $result->error) {
        $filesystem = new WP_Filesystem_Direct( true );
        $credentials = json_decode($filesystem->get_contents(CONVSST_PLUGIN_DIR . "includes/setup/json/client-secrets.json"),true);
        $url = 'https://www.googleapis.com/oauth2/v4/token';
        $header = array("Content-Type" => "application/json");
        $clientId = $credentials['web']['client_id'];
        $clientSecret = $credentials['web']['client_secret'];

        $data = [
          "grant_type" => 'refresh_token',
          "client_id" => sanitize_text_field($clientId),
          'client_secret' => sanitize_text_field($clientSecret),
          'refresh_token' => sanitize_text_field($refresh_token),
        ];
        $args = array(
          'timeout' => CONVSST_TM,
          'headers' => $header,
          'method' => 'POST',
          'body' => wp_json_encode($data)
        );
        $request = wp_remote_post(esc_url_raw($url), $args);
        // Retrieve information
        $response_code = wp_remote_retrieve_response_code($request);
        $response_message = wp_remote_retrieve_response_message($request);
        $response = json_decode(wp_remote_retrieve_body($request));
        if (isset($response->access_token)) {
          $TVC_Admin_Helper = new TVC_Admin_Helper();
          $google_detail = $TVC_Admin_Helper->get_ee_options_data();
          $google_detail["setting"]->access_token = base64_encode(sanitize_text_field($response->access_token));
          $TVC_Admin_Helper->set_ee_options_data($google_detail);
          return $response->access_token;
        } else {
          //return $access_token;
        }
      } else {
        return $access_token;
      }
    } //generateAccessToken

    public function createUserTracking()
    {
      try {
        $url = $this->apiDomain . '/usertracking';
        $TVC_Admin_Helper = new TVC_Admin_Helper();
        $subscriptionId =  $TVC_Admin_Helper->get_subscriptionId();
        $options_val = get_option('convsst_ut');
        $header = array("Authorization: Bearer MTIzNA==", "Content-Type" => "application/json");
        $data = [
          'subscription_id' => sanitize_text_field((isset($subscriptionId)) ? $subscriptionId : ''),
          'site_url' => esc_url(get_site_url()),
          'ee_ut' => $options_val
        ];
        $args = array(
          'headers' => $header,
          'method' => 'POST',
          'body' => wp_json_encode($data)
        );
        $result = $this->tc_wp_remot_call_post(esc_url_raw($url), $args);
        $return = new \stdClass();
        if ($result->status == 200) {
          update_option("convsst_ut", '');
          $return->status = $result->status;
          $return->data = $result->data;
          $return->error = false;
          return $return;
        } else {
          $return->error = true;
          $return->data = $result->data;
          $return->status = $result->status;
          return $return;
        }
      } catch (Exception $e) {
        return $e->getMessage();
      }
    }
  }
}
