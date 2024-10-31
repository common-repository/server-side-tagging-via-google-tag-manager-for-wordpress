<?php

/**
 * TVC Ajax File Class.
 *
 * @package TVC Product Feed Manager/Data/Classes
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if (class_exists('TVC_Ajax_File') === FALSE):
  /**
   * Ajax File Class
   */
  class TVC_Ajax_File extends CONVSST_Ajax_Calls {
    // Domain
    private $apiDomain;

    // Access Token
    protected $access_token;

    // Refresh Token
    protected $refresh_token;

    protected $customApiObj;

    /**Ajax Constructor ****/
    public function __construct()
    {
      parent::__construct();
      $this->apiDomain = CONVSST_API_CALL_URL;
      // Hooks
      add_action('wp_ajax_tvcajax-get-campaign-categories', [$this, 'tvcajax_get_campaign_categories']);
      add_action('wp_ajax_tvcajax-update-campaign-status', [$this, 'tvcajax_update_campaign_status']);
      add_action('wp_ajax_tvcajax-delete-campaign', [$this, 'tvcajax_delete_campaign']);
      add_action('wp_ajax_tvcajax-store-time-taken', [$this, 'tvcajax_store_time_taken']);
      add_action('wp_ajax_tvc_call_notice_dismiss', [$this, 'tvc_call_notice_dismiss']);
      add_action('wp_ajax_tvc_call_notice_dismiss_trigger', [$this, 'tvc_call_notice_dismiss_trigger']);
      add_action('wp_ajax_tvc_call_notification_dismiss', [$this, 'tvc_call_notification_dismiss']);
      add_action('wp_ajax_convsst_get_conversion_list', [$this, 'convsst_get_conversion_list']);
      add_action('wp_ajax_tvc_call_active_licence', [$this, 'tvc_call_active_licence']);
      add_action('wp_ajax_convsst_call_subscription_refresh', [$this, 'convsst_call_subscription_refresh']);
      add_action('wp_ajax_tvc_call_add_survey', [$this, 'tvc_call_add_survey']);
      add_action('wp_ajax_convsst_save_badge_settings', [$this, 'convsst_save_badge_settings']);
      add_action('wp_ajax_tvc_call_add_customer_feedback', [$this, 'tvc_call_add_customer_feedback']);
      add_action('wp_ajax_update_user_tracking_data', [$this, 'update_user_tracking_data']);
      // For new UIUX
      add_action('wp_ajax_convsst_save_pixel_data', [$this, 'convsst_save_pixel_data']);
      add_action('wp_ajax_convsst_save_googleads_data', [$this, 'convsst_save_googleads_data']);
      add_action('wp_ajax_convsst_get_conversion_list_gads', [$this, 'convsst_get_conversion_list_gads']);

      add_action('wp_ajax_conv_save_gads_conversion', [$this, 'conv_save_gads_conversion']);
      add_action('wp_ajax_conv_checkMcc', [$this, 'conv_checkMcc']);
      
    } //end __construct()

    // Save data in ee_options
    public function convsst_save_data_eeoption($data)
    {
      if (is_null($data) || empty($data) ) {
        return;
      }
      $ee_options = unserialize(get_option('convsst_options'));
      if (is_null($ee_options)) {
        $ee_options = array();
      }
      foreach ($data['convsst_options_data'] as $key => $convsst_options_data) {
        if ($key == "convsst_selected_events") {
          continue;
        }
        $key_name = $key;
        $key_name_arr = array();
        $key_name_arr["measurement_id"] = "gm_id";
        $key_name_arr["property_id"] = "ga_id";
        //$key_name_arr["google_merchant_center_id"] = "google_merchant_id";
        if (array_key_exists($key_name, $key_name_arr)) {
          $ee_options[$key_name_arr[$key_name]] = sanitize_text_field($convsst_options_data);
        } else {
          if (is_array($convsst_options_data)) {
            $posted_arr = $convsst_options_data;
            $posted_arr_temp = [];
            if (!empty($posted_arr)) {
              $arr = $posted_arr;
              array_walk($arr, function (&$value) {
                $value = sanitize_text_field($value);
              });
              $posted_arr_temp = $arr;
              $ee_options[$key_name] = $posted_arr_temp;
            }
          } else {
            $ee_options[$key_name] = sanitize_text_field($convsst_options_data);
          }
        }
      }
      update_option('convsst_options', serialize($ee_options));
    }
    // Save data in ee_options
    public function convsst_save_data_eeapidata($data)
    {
      $eeapidata = unserialize(get_option('convsst_api_data'));
      $eeapidata_settings = $eeapidata['setting'];
      if (empty($eeapidata_settings)) {
        $eeapidata_settings = new stdClass();
      }
      foreach ($data['convsst_options_data'] as $key => $convsst_options_data) {
        if ($key == "convsst_selected_events") {
          continue;
        }
        $key_name = $key;
        if (is_array($convsst_options_data)) {
          $posted_arr = $convsst_options_data;
          $posted_arr_temp = [];
          if (!empty($posted_arr)) {
            $arr = $posted_arr;
            array_walk($arr, function (&$value) {
              $value = sanitize_text_field($value);
            });
            $posted_arr_temp = $arr;
            $eeapidata_settings->$key_name = $posted_arr_temp;
          }
        } else {
          $eeapidata_settings->$key_name = sanitize_text_field($convsst_options_data);
          if ($key_name == "google_merchant_center_id") {
            $eeapidata_settings->google_merchant_id = sanitize_text_field($convsst_options_data);
          }
        }
      }
      $eeapidata['setting'] = $eeapidata_settings;
      update_option('convsst_api_data', serialize($eeapidata));
    }
    //Save data in middleware
    public function convsst_save_data_middleware($postDataFull = array())
    {
      $postData = $postDataFull['convsst_options_data'];
      try {
        $url = $this->apiDomain . '/customer-subscriptions/update-detail';
        $header = array("Authorization: Bearer MTIzNA==", "Content-Type" => "application/json");
        $data = array();
        foreach ($postData as $key => $value) {
          if (is_array($value)) {
            $data[$key] = $value;
          } else {
            $data[$key] = sanitize_text_field((isset($value)) ? $value : '');
          }
        }
        $args = array(
          'headers' => $header,
          'method' => 'POST',
          'body' => wp_json_encode($data)
        );
        $result = wp_remote_request(esc_url_raw($url), $args);
      } catch (Exception $e) {
        return $e->getMessage();
      }
    }
    // All new functions for new UIUX
    public function convsst_save_pixel_data()
    {
      if (isset($_POST['pix_sav_nonce']) && $this->safe_ajax_call(sanitize_text_field(wp_unslash($_POST['pix_sav_nonce'])), 'pix_sav_nonce_val')) {

        $post = array(
          "convsst_options_data" => "",
          "convsst_options_type" => "",
          "convsst_tvc_data" => "",
          "update_site_domain" => "",
          "customer_subscription_id" => "",
          "convsst_catalogData" => "",
        );
        // $post we are doing sanitize data under callback function.
        $post = array_intersect_key($_POST,$post); // Compare the keys of two arrays, and return the matches

        $TVC_Admin_Helper = new TVC_Admin_Helper();
        if (isset($_POST['convsst_options_type']) && in_array("eeoptions", $_POST['convsst_options_type'])) {
          $this->convsst_save_data_eeoption($post);
        }
        if (isset($_POST['convsst_options_type']) && in_array("middleware", $_POST['convsst_options_type'])) {
          $this->convsst_save_data_middleware($post);
        }
        if (isset($_POST['convsst_options_type']) && in_array("eeapidata", $_POST['convsst_options_type'])) {
          $this->convsst_save_data_eeapidata($post);
        }
        if (in_array("eeselectedevents", $_POST['convsst_options_type']) && isset($_POST["convsst_options_data"]["convsst_selected_events"]) && isset($_POST['convsst_options_type'])) {
          $selectedevents['ga'] = array_map('sanitize_text_field', $_POST["convsst_options_data"]["convsst_selected_events"]["ga"]);
          
          $convsst_posted_events = [];
          if (!empty($selectedevents)) {
            $arr = $selectedevents;
            array_walk($arr, function (&$value) {
              $temp_arr = [];
              for ($i = 0; $i < count($value); $i++) {
                $temp_arr[] = $value[$i];
              }
              $value = $temp_arr;
            });
            $convsst_posted_events = $arr;
          }
          update_option("convsst_selected_events", serialize($convsst_posted_events));
        }
        
        if (in_array("permituserrole", $_POST['convsst_options_type']) && isset($_POST["convsst_options_data"]["convsst_permitted_users"]) && isset($_POST['convsst_options_type'])) {
          global $wp_roles;
          foreach ($TVC_Admin_Helper->convsst_get_user_roles() as $slug => $name)
          {
            if(in_array($slug, $_POST["convsst_options_data"]["convsst_permitted_users"]))
            {
              $wp_roles->add_cap($slug, 'manage_aioconversios');
            }
            else{
              $wp_roles->remove_cap($slug, 'manage_aioconversios');
            }
          }
          $wp_roles->add_cap('administrator', 'manage_aioconversios');
        }

        $TVC_Admin_Helper->update_app_status();
        echo "1";
      } else {
        echo "0";
      }
      exit;
    }

    // All new functions for new UIUX End
    // Save google ads settings
    public function convsst_save_googleads_data()
    {
      if (isset($_POST['pix_sav_nonce']) && $this->safe_ajax_call(sanitize_text_field(wp_unslash($_POST['pix_sav_nonce'])), 'pix_sav_nonce_val')) {
        $convsst_options_data = isset($_POST['convsst_options_data']) ? array_map('sanitize_text_field', $_POST['convsst_options_data']) : [];
        $googleDetail_setting = array();
        if (isset($convsst_options_data['remarketing_tags'])) {
          update_option('convsst_ads_ert', sanitize_text_field($convsst_options_data['remarketing_tags']));
          $googleDetail_setting["remarketing_tags"] = sanitize_text_field($convsst_options_data['remarketing_tags']);
        }
        if (isset($convsst_options_data['dynamic_remarketing_tags'])) {
          update_option('convsst_ads_edrt', sanitize_text_field($convsst_options_data['dynamic_remarketing_tags']));
          $googleDetail_setting["dynamic_remarketing_tags"] = sanitize_text_field($convsst_options_data['dynamic_remarketing_tags']);
        }
        if (isset($convsst_options_data['convsst_google_ads_tracking'])) {
          update_option('convsst_google_ads_tracking', sanitize_text_field($convsst_options_data['convsst_google_ads_tracking']));
          $googleDetail_setting["convsst_google_ads_tracking"] = sanitize_text_field($convsst_options_data['convsst_google_ads_tracking']);
        }
        if (isset($convsst_options_data['convsst_ga_EC'])) {
          update_option('convsst_ga_EC', sanitize_text_field($convsst_options_data['convsst_ga_EC']));
        }
        if (isset($convsst_options_data['conversio_send_to'])) {
          update_option('conversio_send_to', sanitize_text_field($convsst_options_data['conversio_send_to']));
          $googleDetail_setting["conversio_send_to"] = sanitize_text_field($convsst_options_data['conversio_send_to']);
        }
        if (isset($convsst_options_data['convsst_conversio_send_to_static']) && !empty($convsst_options_data['convsst_conversio_send_to_static'])) {
          update_option('conversio_send_to', sanitize_text_field($convsst_options_data['convsst_conversio_send_to_static']));
          $googleDetail_setting["conversio_send_to"] = sanitize_text_field($convsst_options_data['convsst_conversio_send_to_static']);
        }
        if (isset($convsst_options_data['link_google_analytics_with_google_ads'])) {
          $googleDetail_setting["link_google_analytics_with_google_ads"] = sanitize_text_field($convsst_options_data['link_google_analytics_with_google_ads']);
        }
        $googleDetail_setting["subscription_id"] = sanitize_text_field($convsst_options_data['subscription_id']);
        $data_eeoptions = array();
        $data_eeapidata = array();
        $data_middleware = array();
        $data_eeoptions['convsst_options_data']['google_ads_id'] = $convsst_options_data['google_ads_id'];
        $this->convsst_save_data_eeoption($data_eeoptions);
        $data_eeapidata['convsst_options_data'] = $convsst_options_data;
        $this->convsst_save_data_eeapidata($data_eeapidata);
        $googleDetail_setting['google_ads_id'] = $convsst_options_data['google_ads_id'];
        $data_middleware['convsst_options_data'] = $googleDetail_setting;
        $this->convsst_save_data_middleware($data_middleware);
        $TVC_Admin_Helper = new TVC_Admin_Helper();
        $TVC_Admin_Helper->update_remarketing_snippets();
        $TVC_Admin_Helper->update_app_status();
        if (isset($convsst_options_data['ga_GMC']) && $convsst_options_data['ga_GMC'] == '1' && isset($_POST['convsst_options_data']['merchant_id'])) {
          $access_token = $this->get_tvc_access_token();
          $refresh_token = $this->get_tvc_refresh_token();
          $api_obj = new Convsst_Conversios_Onboarding_ApiCall(sanitize_text_field($access_token), sanitize_text_field($refresh_token));
          $postData = ['subscription_id' => sanitize_text_field($_POST['convsst_options_data']['subscription_id']), 'merchant_id' => sanitize_text_field($_POST['convsst_options_data']['merchant_id']), 'account_id' => sanitize_text_field($_POST['convsst_options_data']['google_merchant_id']), 'adwords_id' => sanitize_text_field($_POST['convsst_options_data']['google_ads_id'])];
          $api_obj->linkGoogleAdsToMerchantCenter($postData);
        }

        if (isset($convsst_options_data['link_google_analytics_with_google_ads'])) {
          $access_token = $this->get_tvc_access_token();
          $refresh_token = $this->get_tvc_refresh_token();
          $api_obj = new Convsst_Conversios_Onboarding_ApiCall(sanitize_text_field($access_token), sanitize_text_field($refresh_token));
          $postData = [
            'ads_customer_id' => sanitize_text_field($convsst_options_data['google_ads_id']),
            'web_property_id' => isset($convsst_options_data['web_property_id']) ? sanitize_text_field($convsst_options_data['web_property_id']) : "",
            'web_property' => isset($convsst_options_data['web_property_id']) ? sanitize_text_field($convsst_options_data['web_property_id']) : "",
            'subscription_id' => sanitize_text_field($convsst_options_data['subscription_id'])
          ];
          $api_obj->linkAnalyticToAdsAccount($postData);
        }
      }
      echo "1";
      exit;
    }


    public function convsst_save_badge_settings()
    {
      $val = isset($_POST['bagdeVal']) ? sanitize_text_field($_POST['bagdeVal']) : "no";
      $data = array();
      $data = unserialize(get_option('convsst_options'));
      $data['convsst_show_badge'] = sanitize_text_field($val);
      if ($val == "yes") {
        $data['convsst_badge_position'] = sanitize_text_field("center");
      } else {
        $data['convsst_badge_position'] = "";
      }
      update_option('convsst_options', serialize($data));
      exit;
    }

    public function update_user_tracking_data()
    {
      if ($this->safe_ajax_call(sanitize_text_field(wp_unslash($_POST['TVCNonce'])), 'update_user_tracking_data-nonce')) {
        $event_name = isset($_POST['event_name']) ? sanitize_text_field($_POST['event_name']) : "";
        $screen_name = isset($_POST['screen_name']) ? sanitize_text_field($_POST['screen_name']) : "";
        $error_msg = isset($_POST['error_msg']) ? sanitize_text_field($_POST['error_msg']) : "";
        $event_label = isset($_POST['event_label']) ? sanitize_text_field($_POST['event_label']) : "";
        // $timestamp = isset($_POST['timestamp'])?sanitize_text_field($_POST['timestamp']):"";
        $timestamp = gmdate("YmdHis");
        $t_data = array(
          'event_name' => esc_sql($event_name),
          'screen_name' => esc_sql($screen_name),
          'timestamp' => esc_sql($timestamp),
          'error_msg' => esc_sql($error_msg),
          'event_label' => esc_sql($event_label),
        );
        if (!empty($t_data)) {

          $options_val = get_option('convsst_ut');
          if (!empty($options_val)) {
            $odata = (array) maybe_unserialize($options_val);
            array_push($odata, $t_data);
            update_option("convsst_ut", serialize($odata));
          } else {
            $t_d[] = $t_data;
            update_option("convsst_ut", serialize($t_d));
          }
        }
        wp_die();
      } else {
        echo wp_json_encode(array("error" => true, "message" => esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress")));
      }
      // IMPORTANT: don't forget to exit
      exit;
    }

    public function tvc_call_add_customer_feedback()
    {
      if (isset($_POST['convsst_customer_feed_nonce_field']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['convsst_customer_feed_nonce_field'])), 'convsst_customer_feed_nonce_field_save')) {
        if (isset($_POST['que_one']) && isset($_POST['que_two']) && isset($_POST['que_three'])) {
          $formdata = array();
          $formdata['business_insights_index'] = sanitize_text_field($_POST['que_one']);
          $formdata['automate_integrations_index'] = sanitize_text_field($_POST['que_two']);
          $formdata['business_scalability_index'] = sanitize_text_field($_POST['que_three']);
          $formdata['subscription_id'] = isset($_POST['subscription_id']) ? sanitize_text_field($_POST['subscription_id']) : "";
          $formdata['customer_id'] = isset($_POST['customer_id']) ? sanitize_text_field($_POST['customer_id']) : "";
          $formdata['feedback'] = isset($_POST['feedback_description']) ? sanitize_text_field($_POST['feedback_description']) : "";
          $customObj = new ConvsstCustomApi();
          unset($_POST['action']);
          echo wp_json_encode($customObj->record_customer_feedback($formdata));
          exit;
        } else {
          echo wp_json_encode(array("error" => true, "message" => esc_html__("Please answer the required questions", "server-side-tagging-via-google-tag-manager-for-wordpress")));
        }
      } else {
        echo wp_json_encode(array("error" => true, "message" => esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress")));
      }
      // IMPORTANT: don't forget to exit
      exit;
    }
    public function tvc_call_add_survey()
    {
      if (is_admin() && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['tvc_call_add_survey'])), 'tvc_call_add_survey-nonce')) {
        if (!class_exists('ConvsstCustomApi')) {
          include(CONVSST_PLUGIN_DIR . 'includes/setup/ConvsstCustomApi.php');
        }
        $customObj = new ConvsstCustomApi();
        unset($_POST['action']);
        $subscription_id = isset($_POST['subscription_id']) ? sanitize_text_field($_POST['subscription_id']) : "";
        $customer_id = isset($_POST['customer_id']) ? sanitize_text_field($_POST['customer_id']) : "";
        $radio_option_val = isset($_POST['radio_option_val']) ? sanitize_text_field($_POST['radio_option_val']) : "";
        $other_reason = isset($_POST['other_reason']) ? sanitize_text_field($_POST['other_reason']) : "";
        $site_url = isset($_POST['site_url']) ? sanitize_text_field($_POST['site_url']) : "";
        $plugin_name = isset($_POST['plugin_name']) ? sanitize_text_field($_POST['plugin_name']) : "";

        $post = array(
          "customer_id" => $customer_id,
          "subscription_id" => $subscription_id,
          "radio_option_val" => $radio_option_val,
          "other_reason" => $other_reason,
          "site_url" => $site_url,
          "plugin_name" => $plugin_name
        );
        echo wp_json_encode($customObj->add_survey_of_deactivate_plugin($post));
      } else {
        echo wp_json_encode(array('error' => true, "is_connect" => false, 'message' => esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress")));
      }
      // IMPORTANT: don't forget to exit
      exit;
    }
    //active licence key
    public function tvc_call_active_licence()
    {
      if (is_admin() && isset($_POST['convsst_licence_nonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['convsst_licence_nonce'])), 'convsst_lic_nonce')) {
        $licence_key = isset($_POST['licence_key']) ? sanitize_text_field($_POST['licence_key']) : "";
        $TVC_Admin_Helper = new TVC_Admin_Helper();
        $subscription_id = $TVC_Admin_Helper->get_subscriptionId();
        if ($subscription_id != "" && $licence_key != "") {
          $response = $TVC_Admin_Helper->active_licence($licence_key, $subscription_id);

          if ($response->error == false) {
            //$key, $html, $title = null, $link = null, $link_title = null, $overwrite= false
            //$TVC_Admin_Helper->add_ee_msg_nofification("active_licence_key", esc_html__("Your plan is now successfully activated.","server-side-tagging-via-google-tag-manager-for-wordpress"), esc_html__("Congratulations!!","server-side-tagging-via-google-tag-manager-for-wordpress"), "", "", true);
            $TVC_Admin_Helper->update_subscription_details_api_to_db();
            echo wp_json_encode(array('error' => false, "is_connect" => true, 'message' => esc_html__("The licence key has been activated.", "server-side-tagging-via-google-tag-manager-for-wordpress")));
          } else {
            echo wp_json_encode(array('error' => true, "is_connect" => true, 'message' => $response->message));
          }
        } else if ($licence_key != "") {
          $ee_additional_data = $TVC_Admin_Helper->get_ee_additional_data();
          $ee_additional_data['temp_active_licence_key'] = $licence_key;
          $TVC_Admin_Helper->set_ee_additional_data($ee_additional_data);
          echo wp_json_encode(array('error' => true, "is_connect" => false, 'message' => ""));
        } else {
          echo wp_json_encode(array('error' => true, "is_connect" => false, 'message' => esc_html__("Licence key is required.", "server-side-tagging-via-google-tag-manager-for-wordpress")));
        }
      } else {
        echo wp_json_encode(array('error' => true, "is_connect" => false, 'message' => esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress")));
      }
      exit;
    }

    public function convsst_call_subscription_refresh()
    {
      if ( is_admin() && isset($_POST['convsst_licence_nonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['convsst_licence_nonce'])), 'convsst_lic_nonce')) {
        $TVC_Admin_Helper = new TVC_Admin_Helper();
        $TVC_Admin_Helper->update_subscription_details_api_to_db();
        echo wp_json_encode(array('error' => false, "is_connect" => true, 'message' => esc_html__("Subscription refresh", "server-side-tagging-via-google-tag-manager-for-wordpress")));
      } else {
        echo wp_json_encode(array('error' => true, "is_connect" => false, 'message' => esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress")));
      }
      wp_die();
    }

    public function convsst_get_conversion_list()
    {
      if ($this->safe_ajax_call(sanitize_text_field(wp_unslash($_POST['TVCNonce'])), 'convsst_get_conversion_list-nonce')) {
        $TVC_Admin_Helper = new TVC_Admin_Helper();
        $this->customApiObj = new ConvsstCustomApi();
        $this->current_customer_id = $TVC_Admin_Helper->get_currentCustomerId();
        if ($this->current_customer_id != "") {
          $response = $this->customApiObj->get_conversion_list($this->current_customer_id);
          if (property_exists($response, "error") && $response->error == false) {
            if (property_exists($response, "data") && $response->data != "" && !empty($response->data)) {
              $selected_conversio_send_to = get_option('conversio_send_to');
              $conversion_label = array();
              foreach ($response->data as $key => $value) {
                $convsst_string = wp_strip_all_tags($value->tagSnippets);
                $conversion_label_check = $TVC_Admin_Helper->get_conversion_label($convsst_string);
                if ($conversion_label_check != "" && $conversion_label_check != null) {
                  $conversion_label[] = $TVC_Admin_Helper->get_conversion_label($convsst_string);
                }
              }
              echo wp_json_encode($conversion_label);
              exit;
            }
          }
        }
      }
      // IMPORTANT: don't forget to exit
      wp_die(0);
    }
    public function convsst_get_conversion_list_gads()
    {
      if ($this->safe_ajax_call(sanitize_text_field(wp_unslash($_POST['TVCNonce'])), 'convsst_get_conversion_list-nonce')) {
        $TVC_Admin_Helper = new TVC_Admin_Helper();
        $this->customApiObj = new ConvsstCustomApi();
        $current_customer_id = isset($_POST['gads_id']) ? sanitize_text_field($_POST['gads_id']) : "";
        if ($current_customer_id != "") {
          $response = $this->customApiObj->get_conversion_list($current_customer_id);
          if (property_exists($response, "error") && $response->error == false) {
            if (property_exists($response, "data") && $response->data != "" && !empty($response->data)) {
              
              $selected_conversio_send_to = get_option('conversio_send_to');
              $conversion_label = array();
              foreach ($response->data as $key => $value) {
                $convsst_string = $value->tagSnippets;
                $conversion_label_check = $TVC_Admin_Helper->get_conversion_label($convsst_string);
                if ($conversion_label_check != "" && $conversion_label_check != null) {
                  $conversion_label[] = $TVC_Admin_Helper->get_conversion_label($convsst_string);
                }
              }
              
              echo wp_json_encode($conversion_label);
              exit;
            }
          }
        }
      }
      // IMPORTANT: don't forget to exit
      wp_die(0);
    }

    public function conv_save_gads_conversion()
    {
      if ($this->safe_ajax_call(filter_input(INPUT_POST, 'CONVNonce', FILTER_SANITIZE_FULL_SPECIAL_CHARS), 'conv_save_gads_conversion-nonce')) {
        if (isset($_POST['cleargadsconversions']) && sanitize_text_field($_POST['cleargadsconversions']) == "yes") {

          $conversio_send_to = "";
          //update_option('convsst_google_ads_tracking', sanitize_text_field($convsst_google_ads_tracking));
          //update_option('convsst_ga_EC', sanitize_text_field($ga_EC));
          update_option('conversio_send_to', sanitize_text_field($conversio_send_to));

          /*if ( isset($_POST['subscription_id']) ) {
            // reset options on change email for pixel page - for GAds and GA4
            $convsst_options = unserialize(get_option('convsst_options'));
            unset($convsst_options["gads_conversions"]);
            unset($convsst_options["ga4_analytic_account_id"]);
            unset($convsst_options["gm_id"]);
            unset($convsst_options["google_ads_id"]);
            update_option('convsst_options', serialize($convsst_options));

            // reset options on change email for channel inner settings - for GAds and GA4
            $convsst_options = unserialize(get_option('convsst_api_data'));
            $convsst_options["setting"]->google_ads_id = '';
            $convsst_options["setting"]->measurement_id = '';
            $convsst_options["setting"]->ga4_property_id = '';
            $convsst_options["setting"]->ga4_analytic_account_id = '';
            update_option('convsst_api_data', serialize($convsst_options));
          }*/
        } 
        $TVC_Admin_Helper = new TVC_Admin_Helper();
        $TVC_Admin_Helper->update_app_status();
        die('1');
      } else {
        die('Security nonce not matched');
      }
    }

    public function conv_checkMcc()
    {
      if ($this->safe_ajax_call(filter_input(INPUT_POST, 'CONVNonce', FILTER_SANITIZE_FULL_SPECIAL_CHARS), 'conv_checkMcc-nonce')) {
        $TVC_Admin_Helper = new TVC_Admin_Helper();
        $customApiObj = new ConvsstCustomApi();

        $subscription_id = sanitize_text_field($_POST['subscription_id']);
        $ads_accountId = sanitize_text_field($_POST['ads_accountId']);

        if ($subscription_id != "" && $ads_accountId != "") {
          $response = $customApiObj->ads_checkMcc($subscription_id, $ads_accountId);
          echo wp_json_encode($response);
        }
      }
      exit;
    }

    public function tvc_call_notification_dismiss()
    {
      if ($this->safe_ajax_call(sanitize_text_field(wp_unslash($_POST['TVCNonce'])), 'tvc_call_notification_dismiss-nonce')) {
        $ee_dismiss_id = isset($_POST['data']['ee_dismiss_id']) ? sanitize_text_field($_POST['data']['ee_dismiss_id']) : "";
        if ($ee_dismiss_id != "") {
          $TVC_Admin_Helper = new TVC_Admin_Helper();
          $ee_msg_list = $TVC_Admin_Helper->get_ee_msg_nofification_list();
          if (isset($ee_msg_list[$ee_dismiss_id])) {
            unset($ee_msg_list[$ee_dismiss_id]);
            $ee_msg_list[$ee_dismiss_id]["active"] = 0;
            $TVC_Admin_Helper->set_ee_msg_nofification_list($ee_msg_list);
            echo wp_json_encode(array('status' => 'success', 'message' => ""));
          }
        }
      } else {
        echo wp_json_encode(array('status' => 'error', "message" => esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress")));
      }
      // IMPORTANT: don't forget to exit
      exit;
    }
    public function tvc_call_notice_dismiss()
    {
      if ($this->safe_ajax_call(sanitize_text_field(wp_unslash($_POST['apiNoticDismissNonce'])), 'tvc_call_notice_dismiss-nonce')) {
        $ee_notice_dismiss_id = isset($_POST['data']['ee_notice_dismiss_id']) ? sanitize_text_field($_POST['data']['ee_notice_dismiss_id']) : "";
        $ee_notice_dismiss_id = sanitize_text_field($ee_notice_dismiss_id);
        if ($ee_notice_dismiss_id != "") {
          $TVC_Admin_Helper = new TVC_Admin_Helper();
          $ee_additional_data = $TVC_Admin_Helper->get_ee_additional_data();
          $ee_additional_data['dismissed_' . $ee_notice_dismiss_id] = 1;
          $TVC_Admin_Helper->set_ee_additional_data($ee_additional_data);
          echo wp_json_encode(array('status' => 'success', 'message' => $ee_additional_data));
        }
      } else {
        echo wp_json_encode(array('status' => 'error', "message" => esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress")));
      }
      // IMPORTANT: don't forget to exit
      exit;
    }

    public function tvc_call_notice_dismiss_trigger()
    {
      if ($this->safe_ajax_call(sanitize_text_field(wp_unslash($_POST['apiNoticDismissNonce'])), 'tvc_call_notice_dismiss-nonce')) {
        $ee_notice_dismiss_id_trigger = isset($_POST['data']['ee_notice_dismiss_id_trigger']) ? sanitize_text_field($_POST['data']['ee_notice_dismiss_id_trigger']) : "";
        $ee_notice_dismiss_id_trigger = sanitize_text_field($ee_notice_dismiss_id_trigger);
        if ($ee_notice_dismiss_id_trigger != "") {
          $TVC_Admin_Helper = new TVC_Admin_Helper();
          $ee_additional_data = $TVC_Admin_Helper->get_ee_additional_data();
          $slug = $ee_notice_dismiss_id_trigger;
          $title = "";
          $content = "";
          $status = "0";
          $TVC_Admin_Helper->tvc_dismiss_admin_notice($slug, $content, $status, $title);
        }
      } else {
        echo wp_json_encode(array('status' => 'error', "message" => esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress")));
      }
      // IMPORTANT: don't forget to exit
      exit;
    }
    public function get_tvc_access_token()
    {
      if (!empty($this->access_token)) {
        return $this->access_token;
      } else {
        $TVC_Admin_Helper = new TVC_Admin_Helper();
        $google_detail = $TVC_Admin_Helper->get_ee_options_data();
        $this->access_token = sanitize_text_field(base64_decode($google_detail['setting']->access_token));
        return $this->access_token;
      }
    }

    public function get_tvc_refresh_token()
    {
      if (!empty($this->refresh_token)) {
        return $this->refresh_token;
      } else {
        $TVC_Admin_Helper = new TVC_Admin_Helper();
        $google_detail = $TVC_Admin_Helper->get_ee_options_data();
        $this->refresh_token = sanitize_text_field(base64_decode($google_detail['setting']->refresh_token));
        return $this->refresh_token;
      }
    }
    /**
     * Delete the campaign
     */
    public function tvcajax_delete_campaign()
    {
      // make sure this call is legal
      if ($this->safe_ajax_call(sanitize_text_field(wp_unslash($_POST['campaignDeleteNonce'])), 'tvcajax_delete_campaign-nonce')) {

        $merchantId = filter_input(INPUT_POST, 'merchantId',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $customerId = filter_input(INPUT_POST, 'customerId',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $campaignId = filter_input(INPUT_POST, 'campaignId',FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $url = $this->apiDomain . '/campaigns/delete';
        $data = [
          'merchant_id' => sanitize_text_field($merchantId),
          'customer_id' => sanitize_text_field($customerId),
          'campaign_id' => sanitize_text_field($campaignId)
        ];
        $args = array(
          'headers' => array(
            'Authorization' => "Bearer MTIzNA==",
            'Content-Type' => 'application/json'
          ),
          'method' => 'DELETE',
          'body' => wp_json_encode($data)
        );
        // Send remote request
        $request = wp_remote_request(esc_url_raw($url), $args);

        // Retrieve information
        $response_code = wp_remote_retrieve_response_code($request);
        $response_message = wp_remote_retrieve_response_message($request);
        $response_body = json_decode(wp_remote_retrieve_body($request));

        if ((isset($response_body->error) && $response_body->error == '')) {
          $message = $response_body->message;
          echo wp_json_encode(['status' => 'success', 'message' => $message]);
        } else {
          $message = is_array($response_body->errors) ? $response_body->errors[0] : "Face some unprocessable entity";
          echo wp_json_encode(['status' => 'error', 'message' => $message]);
          // return new WP_Error($response_code, $response_message, $response_body);
        }
      } else {
        echo wp_json_encode(array('status' => 'error', "message" => esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress")));
      }
      // IMPORTANT: don't forget to exit
      exit;
    }

    /**
     * Update the campaign status pause/active
     */
    public function tvcajax_update_campaign_status()
    {
      // make sure this call is legal
      if ($this->safe_ajax_call(sanitize_text_field(wp_unslash($_POST['campaignStatusNonce'])), 'tvcajax-update-campaign-status-nonce')) {
        if (!class_exists('ConvsstShoppingApi')) {
          include(CONVSST_PLUGIN_DIR . 'includes/setup/ConvsstShoppingApi.php');
        }

        $header = array(
          "Authorization: Bearer MTIzNA==",
          "Content-Type" => "application/json"
        );

        $merchantId = filter_input(INPUT_POST, 'merchantId',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $customerId = filter_input(INPUT_POST, 'customerId',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $campaignId = filter_input(INPUT_POST, 'campaignId',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $budgetId = filter_input(INPUT_POST, 'budgetId',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $campaignName = filter_input(INPUT_POST, 'campaignName',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $budget = filter_input(INPUT_POST, 'budget',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $status = filter_input(INPUT_POST, 'status',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $curl_url = $this->apiDomain . '/campaigns/update';
        $shoppingObj = new ConvsstShoppingApi();
        $campaignData = $shoppingObj->getCampaignDetails($campaignId);

        $data = [
          'merchant_id' => sanitize_text_field($merchantId),
          'customer_id' => sanitize_text_field($customerId),
          'campaign_id' => sanitize_text_field($campaignId),
          'account_budget_id' => sanitize_text_field($budgetId),
          'campaign_name' => sanitize_text_field($campaignName),
          'budget' => sanitize_text_field($budget),
          'status' => sanitize_text_field($status),
          'target_country' => sanitize_text_field($campaignData->data['data']->targetCountry),
          'ad_group_id' => sanitize_text_field($campaignData->data['data']->adGroupId),
          'ad_group_resource_name' => sanitize_text_field($campaignData->data['data']->adGroupResourceName)
        ];

        $args = array(
          'headers' => $header,
          'method' => 'PATCH',
          'body' => wp_json_encode($data)
        );
        $request = wp_remote_request(esc_url_raw($curl_url), $args);
        // Retrieve information
        $response_code = wp_remote_retrieve_response_code($request);
        $response_message = wp_remote_retrieve_response_message($request);
        $response = json_decode(wp_remote_retrieve_body($request));
        if (isset($response->error) && $response->error == false) {
          $message = $response->message;
          echo wp_json_encode(['status' => 'success', 'message' => $message]);
        } else {
          $message = is_array($response->errors) ? $response->errors[0] : esc_html__("Face some unprocessable entity", "server-side-tagging-via-google-tag-manager-for-wordpress");
          echo wp_json_encode(['status' => 'error', 'message' => $message]);
        }
      } else {
        echo wp_json_encode(array('status' => 'error', "message" => esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress")));
      }
      // IMPORTANT: don't forget to exit
      exit;
    }

    /**
     * Returns the campaign categories from a selected country
     */
    public function tvcajax_get_campaign_categories()
    {
      // make sure this call is legal
      if ($this->safe_ajax_call(sanitize_text_field(wp_unslash($_POST['campaignCategoryListsNonce'])), 'tvcajax-campaign-category-lists-nonce')) {

        $country_code = filter_input(INPUT_POST, 'countryCode',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $customer_id = filter_input(INPUT_POST, 'customerId',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $url = $this->apiDomain . '/products/categories';

        $data = [
          'customer_id' => sanitize_text_field($customer_id),
          'country_code' => sanitize_text_field($country_code)
        ];

        $args = array(
          'headers' => array(
            'Authorization' => "Bearer MTIzNA==",
            'Content-Type' => 'application/json'
          ),
          'body' => wp_json_encode($data)
        );

        // Send remote request
        $request = wp_remote_post(esc_url_raw($url), $args);

        // Retrieve information
        $response_code = wp_remote_retrieve_response_code($request);
        $response_message = wp_remote_retrieve_response_message($request);
        $response_body = json_decode(wp_remote_retrieve_body($request));

        if ((isset($response_body->error) && $response_body->error == '')) {
          echo wp_json_encode($response_body->data);
          //                    return new WP_REST_Response(
          //                        array(
          //                            'status' => $response_code,
          //                            'message' => $response_message,
          //                            'data' => $response_body->data
          //                        )
          //                    );
        } else {
          echo wp_json_encode([]);
          // return new WP_Error($response_code, $response_message, $response_body);
        }

        //   echo wp_json_encode( $categories );
      }

      // IMPORTANT: don't forget to exit
      exit;
    }

  } // End of TVC_Ajax_File_Class
endif;
$tvcajax_file_class = new TVC_Ajax_File();