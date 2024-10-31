<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class TVC_Admin_Helper
{
  protected $customApiObj;
  protected $ee_options_data = "";
  protected $e_options_settings = "";
  protected $merchantId = "";
  protected $main_merchantId = "";
  protected $subscriptionId = "";
  protected $time_zone = "";
  protected $connect_actual_link = "";
  protected $connect_url = "";
  protected $woo_country = "";
  protected $woo_currency = "";
  protected $currentCustomerId = "";
  protected $user_currency_symbol = "";
  protected $setting_status = "";
  protected $ee_additional_data = "";
  protected $store_data;
  protected $api_subscription_data;
  protected $onboarding_page_url;
  protected $tiktok_business_id;
  protected $plan_id;
  public function __construct()
  {
    $this->includes();
    $this->customApiObj = new ConvsstCustomApi();
    add_action('init', array($this, 'init'));
    add_action('init', array($this, 'tvc_upgrade_function'), 9999);
  }

  public function includes()
  {
    if (!class_exists('ConvsstCustomApi.php')) {
      require_once(CONVSST_PLUGIN_DIR . 'includes/setup/ConvsstCustomApi.php');
    }
    if (!class_exists('ConvsstShoppingApi')) {
      require_once(CONVSST_PLUGIN_DIR . 'includes/setup/ConvsstShoppingApi.php');
    }
  }

  public function init()
  {
    add_filter('sanitize_option_ee_auto_update_id', array($this, 'sanitize_option_ee_general'), 10, 2);
    add_filter('sanitize_option_ee_remarketing_snippets', array($this, 'sanitize_option_ee_general'), 10, 2);
    add_filter('sanitize_option_ee_convsst_send_to', array($this, 'sanitize_option_ee_general'), 10, 2);
    add_filter('sanitize_option_ee_api_data', array($this, 'sanitize_option_ee_general'), 10, 2);
    add_filter('sanitize_option_ee_additional_data', array($this, 'sanitize_option_ee_general'), 10, 2);
    add_filter('sanitize_option_ee_options', array($this, 'sanitize_option_ee_general'), 10, 2);
    add_filter('sanitize_option_ee_msg_nofifications', array($this, 'sanitize_option_ee_general'), 10, 2);
    add_filter('sanitize_option_convsst_google_ads_tracking', array($this, 'sanitize_option_ee_general'), 10, 2);
    add_filter('sanitize_option_convsst_ads_tracking_id', array($this, 'sanitize_option_ee_general'), 10, 2);
    add_filter('sanitize_option_convsst_ads_ert', array($this, 'sanitize_option_ee_general'), 10, 2);
    add_filter('sanitize_option_convsst_ads_edrt', array($this, 'sanitize_option_ee_general'), 10, 2);
    add_filter('sanitize_option_ee_customer_gmail', array($this, 'sanitize_option_ee_email'), 10, 2);
    add_filter('sanitize_option_ee_prod_mapped_cats', array($this, 'sanitize_option_ee_general'), 10, 2);
    add_filter('sanitize_option_ee_prod_mapped_attrs', array($this, 'sanitize_option_ee_general'), 10, 2);

    add_filter('sanitize_post_meta__tracked', array($this, 'sanitize_meta_ee_number'));
    add_filter('sanitize_option_tvc_tracked_refund', array($this, 'sanitize_option_ee_general'), 10, 2);
  }

  public function sanitize_meta_ee_number($value)
  {
    $value = (int) $value;
    if ($value < -1) {
      $value = abs($value);
    }
    return $value;
  }

  public function sanitize_option_ee_email($value, $option)
  {
    global $wpdb;
    $value = $wpdb->strip_invalid_text_for_column($wpdb->options, 'option_value', $value);
    if (is_wp_error($value)) {
      $error = $value->get_error_message();
    } else {
      $value = sanitize_email($value);
      if (!is_email($value)) {
        $error = esc_html__('The email address entered did not appear to be a valid email address. Please enter a valid email address.',"server-side-tagging-via-google-tag-manager-for-wordpress");
      }
    }
    if (!empty($error)) {
      $value = get_option($option);
      if (function_exists('add_settings_error')) {
        add_settings_error($option, "invalid_{$option}", $error);
      }
    }
    return $value;
  }

  public function sanitize_option_ee_general($value, $option)
  {
    global $wpdb;
    $value = $wpdb->strip_invalid_text_for_column($wpdb->options, 'option_value', $value);
    if (is_wp_error($value)) {
      $error = $value->get_error_message();
    }
    if (!empty($error)) {
      $value = get_option($option);
      if (function_exists('add_settings_error')) {
        add_settings_error($option, "invalid_{$option}", $error);
      }
    }
    return $value;
  }
  public function tvc_upgrade_function()
  {
    $ee_additional_data = $this->get_ee_additional_data();
    $ee_p_version = isset($ee_additional_data['ee_p_version']) ? $ee_additional_data['ee_p_version'] : "";
    if ($ee_p_version == "") {
      $ee_p_version = "1.0.0";
    }
    if (version_compare($ee_p_version, CONVSST_PLUGIN_VERSION, ">=")) {
      return;
    } else {
      $this->update_app_status();
    }
    if (!isset($ee_additional_data['ee_p_version']) || empty($ee_additional_data)) {
      $ee_additional_data = array();
    }

    $ee_additional_data['ee_p_version'] = CONVSST_PLUGIN_VERSION;
    $this->set_ee_additional_data($ee_additional_data);
  }
  /*
   * Check auto update time
   */
  public function is_need_to_update_api_to_db()
  {
    if ($this->get_subscriptionId() != "") {
      $google_detail = $this->get_ee_options_data();
      if (isset($google_detail['sync_time']) && $google_detail['sync_time']) {
        $current = sanitize_text_field(current_time('timestamp'));
        //echo gmdate( 'M-d-Y H:i', current_time( 'timestamp' ))."==>".date( 'M-d-Y H:i', $google_detail['sync_time']);
        $diffrent_hours = floor(($current - $google_detail['sync_time']) / (60 * 60));
        if ($diffrent_hours > 11) {
          return true;
        }
      } else if (empty($google_detail)) {
        return true;
      }
    }
    return false;
  }
  /*
   * if user has subscription id  and if DB data is empty then call update data
   */
  public function is_ee_options_data_empty()
  {
    if ($this->get_subscriptionId() != "") {
      if (empty($this->get_ee_options_data())) {
        $this->set_update_api_to_db();
      }
    }
  }

  /*
   * Update user only subscription details in DB
   */
  public function update_subscription_details_api_to_db($googleDetail = null)
  {
    //if(empty($googleDetail)){			
    $google_detail = $this->customApiObj->getGoogleAnalyticDetail();
    if (property_exists($google_detail, "error") && $google_detail->error == false) {
      if (property_exists($google_detail, "data") && $google_detail->data != "") {
        $google_detail->data->access_token = base64_encode(sanitize_text_field($google_detail->data->access_token));
        $google_detail->data->refresh_token = base64_encode(sanitize_text_field($google_detail->data->refresh_token));
        $googleDetail = $google_detail->data;
      }
    }
    //}
    if (!empty($googleDetail)) {
      $get_ee_options_data = $this->get_ee_options_data();
      $get_ee_options_data["setting"] = $googleDetail;
      $this->set_ee_options_data($get_ee_options_data);
    }
  }
 
  /*
   * Update user subscription and shopping details in DB
   */
  public function set_update_api_to_db($googleDetail = null)
  {
    //if(empty($googleDetail)){			
    $google_detail = $this->customApiObj->getGoogleAnalyticDetail();
    if (property_exists($google_detail, "error") && $google_detail->error == false) {
      if (property_exists($google_detail, "data") && $google_detail->data != "") {
        $google_detail->data->access_token = base64_encode(sanitize_text_field($google_detail->data->access_token));
        $google_detail->data->refresh_token = base64_encode(sanitize_text_field($google_detail->data->refresh_token));
        $googleDetail = $google_detail->data;
      }
    } else {
      return array("error" => true, "message" => esc_html__("Please try after some time.", "server-side-tagging-via-google-tag-manager-for-wordpress"));
    }
    //}

    $campaigns_list = "";
    if (isset($googleDetail->google_ads_id) && $googleDetail->google_ads_id != "") {
      //$this->update_remarketing_snippets();
      $shopping_api = new ConvsstShoppingApi();
      $campaigns_list_res = $shopping_api->getCampaigns();
      if (isset($campaigns_list_res->data) && isset($campaigns_list_res->status) && $campaigns_list_res->status == 200) {
        if (isset($campaigns_list_res->data['data'])) {
          $campaigns_list = $campaigns_list_res->data['data'];
        }
      }
    }
    $syncProductStat = array("total" => 0, "approved" => 0, "disapproved" => 0, "pending" => 0);
    $google_detail_t = $this->get_ee_options_data();
    $prod_sync_status = isset($google_detail_t["prod_sync_status"]) ? $google_detail_t["prod_sync_status"] : $syncProductStat;
    $this->set_ee_options_data(array("setting" => $googleDetail, "prod_sync_status" => (object) $prod_sync_status, "campaigns_list" => $campaigns_list, "sync_time" => current_time('timestamp')));
    return array("error" => false, "message" => esc_html__("Details updated successfully.", "server-side-tagging-via-google-tag-manager-for-wordpress"));
  }
  /*
   * update remarketing snippets
   */
  public function update_remarketing_snippets()
  {
    $customer_id = $this->get_currentCustomerId();
    if ($customer_id != "") {
      $rs = $this->customApiObj->get_remarketing_snippets($customer_id);
      $remarketing_snippets = array();
      if (property_exists($rs, "error") && $rs->error == false) {
        if (property_exists($rs, "data") && $rs->data != "" && property_exists($rs->data, "snippets")) {
          $remarketing_snippets["snippets"] = base64_encode($rs->data->snippets);
          $remarketing_snippets["id"] = $rs->data->id;
        }
      }
      update_option("convsst_remarketing_snippets", serialize($remarketing_snippets));
    }
  }
  public function get_conversion_label($convsst_string)
  {
    $convsst_string = trim(preg_replace('/\s\s+/', '', $convsst_string));
    $convsst_string = str_replace(" ", "", $convsst_string);
    $convsst_string = str_replace("'", "", $convsst_string);
    $convsst_string = str_replace("return false;", "", $convsst_string);
    $convsst_string = str_replace("event,conversion,{", ",event:conversion,", $convsst_string);
    $convsst_array = explode(",", $convsst_string);
    $convsst_val_array = array();
    if (!empty($convsst_array) && in_array("event:conversion", $convsst_array)) {
      foreach ($convsst_array as $key => $convsst_value) {
        $convsst_val_array = explode(":", $convsst_value);
        if (in_array("send_to", $convsst_val_array)) {
          return $convsst_val_array[1];
        }
      }
    }
  }
  
  /*
   * get API data from DB
   */
  public function get_ee_options_data()
  {
    if (!empty($this->ee_options_data)) {
      return $this->ee_options_data;
    } else {
      $this->ee_options_data = unserialize(get_option('convsst_api_data'));
      return $this->ee_options_data;
    }
  }


  /*
   * set API data in DB
   */
  public function set_ee_options_data($ee_options_data)
  {
    update_option("convsst_api_data", serialize($ee_options_data));
  }
  /*
   * set additional data in DB
   */
  public function set_ee_additional_data($ee_additional_data)
  {
    update_option("convsst_additional_data", serialize($ee_additional_data));
  }
  /*
   * get additional data from DB
   */
  public function get_ee_additional_data()
  {
    $this->ee_additional_data = unserialize(get_option('convsst_additional_data'));
    return $this->ee_additional_data;
  }

  public function save_ee_options_settings($settings)
  {
    update_option("convsst_options", serialize($settings));
  }
  /*
   * get plugin setting data from DB
   */
  public function get_ee_options_settings()
  {
    if (!empty($this->e_options_settings)) {
      return $this->e_options_settings;
    } else {
      $this->e_options_settings = unserialize(get_option('convsst_options'));
      return $this->e_options_settings;
    }
  }

  /*
   * set selected pixel events
   */
  public function set_convsst_selected_events($selected_events)
  {
    update_option("convsst_selected_events", serialize($selected_events));
  }

  /*
   * get subscriptionId
   */
  public function get_subscriptionId()
  {
    if (!empty($this->subscriptionId)) {
      return $this->subscriptionId;
    } else {
      $ee_options_settings = $this->get_ee_options_settings();
      return $this->subscriptionId = (isset($ee_options_settings['subscription_id'])) ? $ee_options_settings['subscription_id'] : "";
    }
  }
  /*
   * get merchantId
   */
  public function get_merchantId()
  {
    if (!empty($this->merchantId)) {
      return $this->merchantId;
    } else {
      $tvc_merchant = "";
      $google_detail = $this->get_ee_options_data();
      return $this->merchantId = (isset($google_detail['setting']->google_merchant_center_id)) ? $google_detail['setting']->google_merchant_center_id : "";
    }
  }
  /*
   * get main_merchantId
   */
  public function get_main_merchantId()
  {
    if (!empty($this->main_merchantId)) {
      return $this->main_merchantId;
    } else {
      $main_merchantId = "";
      $google_detail = $this->get_ee_options_data();
      return $this->main_merchantId = (isset($google_detail['setting']->merchant_id)) ? $google_detail['setting']->merchant_id : "";
    }
  }
  /*
   * get admin time zone
   */
  public function get_time_zone()
  {
    if (!empty($this->time_zone)) {
      return $this->time_zone;
    } else {
      $timezone = get_option('timezone_string');
      if ($timezone == "") {
        $timezone = "America/New_York";
      }
      $this->time_zone = $timezone;
      return $this->time_zone;
    }
  }

  public function get_connect_actual_link()
  {
    if (!empty($this->connect_actual_link)) {
      return $this->connect_actual_link;
    } else {
      $this->connect_actual_link = get_site_url();
      return $this->connect_actual_link;
    }
  }

  /**
   * Wordpress store information
   */
  public function get_store_data()
  {
    if (!empty($this->store_data)) {
      return $this->store_data;
    } else {
      return $this->store_data = array(
        "subscription_id" => $this->get_subscriptionId(),
        "user_domain" => $this->get_connect_actual_link(),
        "currency_code" => $this->get_woo_currency(),
        "timezone_string" => $this->get_time_zone(),
        "user_country" => $this->get_woo_country(),
        "app_id" => CONVSST_APP_ID,
        "time" => gmdate("d-M-Y h:i:s A")
      );
    }
  }
  public function get_connect_url()
  {
    if (!empty($this->connect_url)) {
      return $this->connect_url;
    } else {
      $this->connect_url = "https://" . CONVSST_AUTH_CONNECT_URL . "/config3/ga_rdr_gmc.php?return_url=" . CONVSST_AUTH_CONNECT_URL . "/config3/ads-analytics-form.php?domain=" . $this->get_connect_actual_link() . "&amp;country=" . $this->get_woo_country() . "&amp;user_currency=" . $this->get_woo_currency() . "&amp;subscription_id=" . $this->get_subscriptionId() . "&amp;confirm_url=" . admin_url() . "&amp;timezone=" . $this->get_time_zone();
      return $this->connect_url;
    }
  }
  public function get_custom_connect_url($confirm_url = "")
  {
    if (!empty($this->connect_url)) {
      return $this->connect_url;
    } else {
      if ($confirm_url == "") {
        $confirm_url = admin_url();
      }
      $this->connect_url = "https://" . CONVSST_AUTH_CONNECT_URL . "/config3/ga_rdr_gmc.php?return_url=" . CONVSST_AUTH_CONNECT_URL . "/config3/ads-analytics-form.php?domain=" . $this->get_connect_actual_link() . "&amp;country=" . $this->get_woo_country() . "&amp;user_currency=" . $this->get_woo_currency() . "&amp;subscription_id=" . $this->get_subscriptionId() . "&amp;confirm_url=" . $confirm_url . "&amp;timezone=" . $this->get_time_zone();
      return $this->connect_url;
    }
  }

  public function get_custom_connect_url_subpage($confirm_url = "", $subpage = "")
  {
    if (!empty($this->connect_url)) {
      return $this->connect_url;
    } else {
      if ($confirm_url == "") {
        $confirm_url = admin_url();
      }
      $this->connect_url = "http://" . CONVSST_AUTH_CONNECT_URL . "/config3/ga_rdr_gmc.php?return_url=" . CONVSST_AUTH_CONNECT_URL . "/config3/ads-analytics-form.php?domain=" . $this->get_connect_actual_link() . "&amp;country=" . $this->get_woo_country() . "&amp;user_currency=" . $this->get_woo_currency() . "&amp;subscription_id=" . $this->get_subscriptionId() . "&amp;confirm_url=" . $confirm_url . "&amp;subpage=" . $subpage . "&amp;timezone=" . $this->get_time_zone();
      return $this->connect_url;
    }
  }

  public function get_onboarding_page_url()
  {
    if (!empty($this->onboarding_page_url)) {
      return $this->onboarding_page_url;
    } else {
      $this->onboarding_page_url = admin_url() . "admin.php?page=convsst-conversios-google-analytics";
      return $this->onboarding_page_url;
    }
  }

  public function get_woo_currency()
  {
    if (!empty($this->woo_currency)) {
      return $this->woo_currency;
    } else {
      $this->woo_currency = get_option('woocommerce_currency');
      return $this->woo_currency;
    }
  }

  public function get_woo_country()
  {
    if (!empty($this->woo_country)) {
      return $this->woo_country;
    } else {
      $store_raw_country = get_option('woocommerce_default_country');
      $country = explode(":", $store_raw_country);
      $this->woo_country = (isset($country[0])) ? $country[0] : "";
      return $this->woo_country;
    }
  }

  public function get_api_customer_id()
  {
    $google_detail = $this->get_ee_options_data();
    if (isset($google_detail['setting'])) {
      $googleDetail = (array) $google_detail['setting'];
      return ((isset($googleDetail['customer_id'])) ? $googleDetail['customer_id'] : "");
    }
  }
  //tvc_customer = >google_ads_id
  public function get_currentCustomerId()
  {
    if (!empty($this->currentCustomerId)) {
      return $this->currentCustomerId;
    } else {
      $ee_options_settings = $this->get_ee_options_settings();
      return $this->currentCustomerId = (isset($ee_options_settings['google_ads_id'])) ? $ee_options_settings['google_ads_id'] : "";
    }
  }
  public function get_user_currency_symbol()
  {
    if (!empty($this->user_currency_symbol)) {
      return $this->user_currency_symbol;
    } else {
      $currency_symbol = "";
      $currency_symbol_rs = $this->customApiObj->getCampaignCurrencySymbol(['customer_id' => $this->get_currentCustomerId()]);
      if (isset($currency_symbol_rs->data) && isset($currency_symbol_rs->data['status']) && $currency_symbol_rs->data['status'] == 200) {
        $currency_symbol = get_woocommerce_currency_symbol($currency_symbol_rs->data['data']->currency);
      } else {
        $currency_symbol = get_woocommerce_currency_symbol("USD");
      }
      $this->user_currency_symbol = $currency_symbol;
      return $this->user_currency_symbol;
    }
  }

  public function add_spinner_html()
  {
    $spinner_gif = CONVSST_PLUGIN_URL . '/admin/images/ajax-loader.gif';
    echo '<div class="feed-spinner" id="feed-spinner" style="display:none;">
				<img id="img-spinner" src="' . esc_url($spinner_gif) . '" alt="Loading" />
			</div>';
  }

  public function get_gmcAttributes()
  {
    $filesystem = new WP_Filesystem_Direct( true );
   	$str = $filesystem->get_contents(CONVSST_PLUGIN_DIR . "includes/setup/json/gmc_attrbutes.json");
    $attributes = $str ? json_decode($str, true) : [];
    return $attributes;
  }
  public function get_gmc_countries_list()
  {
    $filesystem = new WP_Filesystem_Direct( true );
   	$str = $filesystem->get_contents(CONVSST_PLUGIN_DIR . "includes/setup/json/countries.json");
    $attributes = $str ? json_decode($str, true) : [];
    return $attributes;
  }
  public function get_gmc_language_list()
  {
    $filesystem = new WP_Filesystem_Direct( true );
   	$str = $filesystem->get_contents(CONVSST_PLUGIN_DIR . "includes/setup/json/iso_lang.json");
    $attributes = $str ? json_decode($str, true) : [];
    return $attributes;
  }
  /* start display form input*/
  public function tvc_language_select($name, $class_id = "", string $label = "Please Select", string $sel_val = "en", bool $require = false)
  {
    if ($sel_val == "en") {
      $sel_val = get_locale();
      if (strlen($sel_val) > 0) {
        $sel_val = explode('_', $sel_val)[0];
      }
    }
    if ($name) {
      $countries_list = $this->get_gmc_language_list();
?>
      <select style="width: 100%" class="fw-light text-secondary fs-6 form-control form-select-sm select2 <?php echo esc_attr($class_id); ?> <?php echo ($require == true) ? "field-required" : ""; ?>" name="<?php echo esc_attr($name); ?>" id="<?php echo esc_attr($class_id); ?>">
        <option value=""><?php echo esc_html($label); ?></option>
        <?php foreach ($countries_list as $Key => $val) { ?>
          <option value="<?php echo esc_attr($val["code"]); ?>" <?php echo ($val["code"] == $sel_val) ? "selected" : ""; ?>><?php echo esc_html($val["name"]) . " (" . esc_html($val["native_name"]) . ")"; ?></option>
        <?php
        } ?>
      </select>
    <?php
    }
  }
  public function tvc_countries_select($name, $class_id = "", string $label = "Please Select", bool $require = false)
  {
    if ($name) {
      $countries_list = $this->get_gmc_countries_list();
      $sel_val = $this->get_woo_country();
    ?>
      <select style="width: 100%" class="fw-light text-secondary fs-6 form-control form-select-sm select2 <?php echo esc_attr($class_id); ?> <?php echo ($require == true) ? "field-required" : ""; ?>" name="<?php echo esc_attr($name); ?>" id="<?php echo esc_attr($class_id); ?>">
        <option value=""><?php echo esc_html($label); ?></option>
        <?php foreach ($countries_list as $Key => $val) { ?>
          <option value="<?php echo esc_attr($val["code"]); ?>" <?php echo ($val["code"] == $sel_val) ? "selected" : ""; ?>><?php echo esc_html($val["name"]); ?></option>
        <?php
        } ?>
      </select>
    <?php
    }
  }
  public function tvc_select($name, $class_id = "", string $label = "Please Select", string $sel_val = null, bool $require = false, $option_list = array())
  {
    if (!empty($option_list) && $name) {
    ?>
      <select style="width: 100%" class="fw-light text-secondary fs-6 form-control form-select-sm select2 <?php echo esc_attr($class_id); ?> <?php echo ($require == true) ? "field-required" : ""; ?>" name="<?php echo esc_attr($name); ?>" id="<?php echo esc_attr($class_id); ?>">
        <option value=""><?php echo esc_html($label); ?></option>
        <?php foreach ($option_list as $Key => $val) { ?>
          <option value="<?php echo esc_attr($val["field"]); ?>" <?php echo ($val["field"] == $sel_val) ? "selected" : ""; ?>><?php echo esc_html($val["field"]); ?></option>
        <?php
        }
        if ($name == 'brand') { ?>
          <option value="product_cat" <?php echo ("product_cat" == $sel_val) ? "selected" : ""; ?>><?php echo esc_html("product_cat"); ?></option>
        <?php }
        ?>
      </select>
    <?php
    }
  }

  public function add_additional_option_in_tvc_select($tvc_select_option, $field)
  {
    $plan_id = $this->get_plan_id();
    if ($field == "brand") {
      $is_plugin = 'yith-woocommerce-brands-add-on/init.php';
      $is_plugin_premium = 'yith-woocommerce-brands-add-on-premium/init.php';
      $woocommerce_brand_is_active = 'woocommerce-brands/woocommerce-brands.php';
      $perfect_woocommerce_brand_is_active = 'perfect-woocommerce-brands/perfect-woocommerce-brands.php';
      $wpc_brands = 'wpc-brands/wpc-brands.php';
      if (is_plugin_active($is_plugin) || is_plugin_active($is_plugin_premium)) {
        $tvc_select_option[]["field"] = "yith_product_brand";
      } else if (in_array($woocommerce_brand_is_active, apply_filters('active_plugins', get_option('active_plugins')))) {
        $tvc_select_option[]["field"] = "woocommerce_product_brand";
      } else if (in_array($perfect_woocommerce_brand_is_active, apply_filters('active_plugins', get_option('active_plugins')))) {
        $tvc_select_option[]["field"] = "perfect_woocommerce_product_brand";
      } else if (in_array($wpc_brands, apply_filters('active_plugins', get_option('active_plugins')))) {
        $tvc_select_option[]["field"] = "wpc-brand";
      }
    }
    return $tvc_select_option;
  }

  public function add_additional_option_val_in_map_product_attribute($key, $product_id)
  {
    if ($key != "" && $product_id != "") {
      if ($key == "brand") {
        $is_plugin = 'yith-woocommerce-brands-add-on/init.php';
        $is_plugin_premium = 'yith-woocommerce-brands-add-on-premium/init.php';
        $woocommerce_brand_is_active = 'woocommerce-brands/woocommerce-brands.php';
        $perfect_woocommerce_brand_is_active = 'perfect-woocommerce-brands/perfect-woocommerce-brands.php';
        $wpc_brands = 'wpc-brands/wpc-brands.php';
        if (is_plugin_active($is_plugin) || is_plugin_active($is_plugin_premium)) {
          return $yith_product_brand = $this->get_custom_taxonomy_name($product_id, "yith_product_brand");
        } else if (in_array($woocommerce_brand_is_active, apply_filters('active_plugins', get_option('active_plugins')))) {
          return $product_brand = $this->get_custom_taxonomy_name($product_id, "product_brand");
        } else if (in_array($perfect_woocommerce_brand_is_active, apply_filters('active_plugins', get_option('active_plugins')))) {
          return $product_brand = $this->get_custom_taxonomy_name($product_id, "pwb-brand");
        } else if (in_array($wpc_brands, apply_filters('active_plugins', get_option('active_plugins')))) {
          return $product_brand = $this->get_custom_taxonomy_name($product_id, "wpc-brand");
        }
      }
    }
  }

  public function get_custom_taxonomy_name($product_id, $taxonomy = "product_cat", $separator = ", ")
  {
    $terms_ids = wp_get_post_terms($product_id, $taxonomy, array('fields' => 'ids'));
    // Loop though terms ids (product categories)    
    foreach ($terms_ids as $term_id) {
      // Loop through product category ancestors
      foreach (get_ancestors($term_id, $taxonomy) as $ancestor_id) {
        return get_term($ancestor_id, $taxonomy)->name;
        exit;
      }
      return get_term($term_id, $taxonomy)->name;
      exit;
      break;
    }
  }

  public function tvc_text($name, string $type = "text", string $class_id = "", string $label = null, $sel_val = null, bool $require = false)
  {
    ?>
    <input style="width:100%;" type="<?php echo esc_attr($type); ?>" <?php echo esc_attr($type) == 'number' ? 'min="0"' : '' ?> name="<?php echo esc_attr($name); ?>" class="form-control from-control-overload fw-light text-secondary fs-6 tvc-text <?php echo esc_attr($class_id); ?>" id="<?php echo esc_attr($class_id); ?>" placeholder="<?php echo esc_attr($label); ?>" value="<?php echo esc_attr($sel_val); ?>">
    <?php
  }

  /* end from input*/

  public function is_current_tab_in($tabs)
  {
    if (isset($_GET['tab']) && is_array($tabs) && in_array(sanitize_text_field($_GET['tab']), $tabs)) {
      return true;
    } else if (isset($_GET['tab']) && sanitize_text_field($_GET['tab']) == $tabs) {
      return true;
    }
    return false;
  }

  public function get_tvc_product_cat_list()
  {
    $args = array(
      'hide_empty'   => 1,
      'taxonomy' => 'product_cat',
      'orderby'  => 'term_id'
    );
    $shop_categories_list = get_categories($args);
    $tvc_cat_id_list = [];
    foreach ($shop_categories_list as $key => $value) {
      $tvc_cat_id_list[] = $value->term_id;
    }
    return wp_json_encode($tvc_cat_id_list);
  }
  public function get_tvc_product_cat_list_with_name()
  {
    $args = array(
      'hide_empty' => 1,
      'taxonomy' => 'product_cat',
      'orderby'  => 'term_id'
    );
    $shop_categories_list = get_categories($args);
    $tvc_cat_id_list = [];
    foreach ($shop_categories_list as $key => $value) {
      $tvc_cat_id_list[$value->term_id] = $value->name;
    }
    return $tvc_cat_id_list;
  }

  public function call_tvc_site_verified_and_domain_claim()
  {
    $google_detail = $this->get_ee_options_data();
    if (!isset($_GET['welcome_msg']) && isset($google_detail['setting']) && $google_detail['setting']) {
      $googleDetail = $google_detail['setting'];
      $message = "";
      $title = "";
      if (isset($googleDetail->google_merchant_center_id) && $googleDetail->google_merchant_center_id) {
        $title = "";
        $notice_text = "";
        $call_js_function_args = "";
        if (isset($googleDetail->is_site_verified) && isset($googleDetail->is_domain_claim) && $googleDetail->is_site_verified == '0' && $googleDetail->is_domain_claim == '0') {
          /*$title = esc_html__("Site verification and Domain claim for merchant center account failed.","server-side-tagging-via-google-tag-manager-for-wordpress");
	        $message = esc_html__("Without a verified and claimed website, your product will get disapproved.","server-side-tagging-via-google-tag-manager-for-wordpress");
	        $call_js_function_args = "both";*/
        } else if (isset($googleDetail->is_site_verified) && $googleDetail->is_site_verified == '0') {
          /*$title = esc_html__("Site verification for merchant center account failed.","server-side-tagging-via-google-tag-manager-for-wordpress");
	        $message = esc_html__("Without a verified website, your product will get disapproved.","server-side-tagging-via-google-tag-manager-for-wordpress");
	        $call_js_function_args = "site_verified";*/
        } else if (isset($googleDetail->is_domain_claim) && $googleDetail->is_domain_claim == '0') {
          /*$title = esc_html__("Site claimed website for merchant center account failed.","server-side-tagging-via-google-tag-manager-for-wordpress");
	        $message = esc_html__("Without a claimed website, your product will get disapproved.","server-side-tagging-via-google-tag-manager-for-wordpress");
	        $call_js_function_args = "domain_claim";*/
        }
        if ($message != "" && $title != "") {
    ?>
          <div class="errormsgtopbx claimalert">
            <div class="errmscntbx">
              <div class="errmsglft">
                <span class="errmsgicon"><img src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/error-white-icon.png'); ?>" alt="error" /></span>
              </div>
              <div class="erralertrigt">
                <h6><?php echo esc_html($title); ?></h6>
              </div>
            </div>
          </div>
          <?php
        }
      }
    }
  }
  public function call_domain_claim()
  {
    $googleDetail = [];
    $google_detail = $this->get_ee_options_data();
    if (isset($google_detail['setting']) && $google_detail['setting']) {
      $googleDetail = $google_detail['setting'];
      if ($googleDetail->is_site_verified == '0') {
        return array('error' => true, 'msg' => esc_html__("First need to verified your site. Click on site verification refresh icon to verified your site.", "server-side-tagging-via-google-tag-manager-for-wordpress"));
      } else if (property_exists($googleDetail, "is_domain_claim") && $googleDetail->is_domain_claim == '0') {
        //'website_url' => $googleDetail->site_url,
        $postData = [
          'merchant_id' => sanitize_text_field($googleDetail->merchant_id),
          'website_url' => get_site_url(),
          'subscription_id' => sanitize_text_field($googleDetail->id),
          'account_id' => sanitize_text_field($googleDetail->google_merchant_center_id)
        ];
        $claimWebsite = $this->customApiObj->claimWebsite($postData);
        if (isset($claimWebsite->error) && !empty($claimWebsite->errors)) {
          return array('error' => true, 'msg' => $claimWebsite->errors);
        } else {
          $this->update_subscription_details_api_to_db();
          return array('error' => false, 'msg' => esc_html__("Domain claimed successfully.", "server-side-tagging-via-google-tag-manager-for-wordpress"));
        }
      } else {
        return array('error' => false, 'msg' => esc_html__("Already domain claimed successfully.", "server-side-tagging-via-google-tag-manager-for-wordpress"));
      }
    }
  }

  public function update_app_status($status = "1")
  {
    $this->customApiObj->update_app_status($status);
  }

  public function app_activity_detail($status = "")
  {
    $this->customApiObj->app_activity_detail($status);
  }
 

  /* message notification */
  public function set_ee_msg_nofification_list($ee_msg_list)
  {
    update_option("convsst_msg_nofifications", serialize($ee_msg_list));
  }
  public function get_ee_msg_nofification_list()
  {
    return unserialize(get_option('convsst_msg_nofifications'));
  }

  public function active_licence($licence_key, $subscription_id)
  {
    if ($licence_key != "") {
      $customObj = new ConvsstCustomApi();
      return $customObj->active_licence_Key($licence_key, $subscription_id);
    }
  }

  public function get_pro_plan_site()
  {
    return "https://conversios.io/pricing/";
  }

  public function get_conversios_site_url()
  {
    return "https://conversios.io/";
  }

  public function is_show_tracking_method_options($subscription_id = 0)
  {
    if ($subscription_id > 0 && $subscription_id <= 31200) {
      return true;
    } else {
      return false;
    }
  }

  public function is_ga_property()
  {
    $data = $this->get_ee_options_settings();
    $is_connected = false;
    if ((isset($data['ga_id']) && $data['ga_id'] != '') || (isset($data['ga_id']) && $data['ga_id'] != '')) {
      return true;
    } else {
      return false;
    }
  }
  /*
   * get user plan id
   */
  public function get_plan_id()
  {
    if (!empty($this->plan_id)) {
      return $this->plan_id;
    } else {
      $plan_id = 1;
      $google_detail = $this->get_ee_options_data();
      if (isset($google_detail['setting'])) {
        $googleDetail = $google_detail['setting'];
        if (isset($googleDetail->plan_id) && !in_array($googleDetail->plan_id, array("1"))) {
          $plan_id = $googleDetail->plan_id;
        }
      }
      return $this->plan_id = $plan_id;
    }
  }

  /*
   * get user plan id
   */
  public function get_user_subscription_data()
  {
    $google_detail = $this->get_ee_options_data();
    if (isset($google_detail['setting'])) {
      return $google_detail['setting'];
    }
  }
  /*
   * Check refresh tocken status
   */
  public function is_refresh_token_expire()
  {
    $access_token = $this->customApiObj->get_tvc_access_token();
    $refresh_token = $this->customApiObj->get_tvc_refresh_token();
    if ($access_token != "" && $refresh_token != "") {
      $access_token = $this->customApiObj->generateAccessToken($access_token, $refresh_token);
    }
    if ($access_token != "") {
      return false;
    } else {
      return true;
    }
  }

  public function convsst_display_admin_notice() {
    
    $current_screen = get_current_screen();
    if ((strpos($current_screen->id, 'convsst') !== false || strpos($current_screen->id, 'conversios') !== false) && !is_plugin_active('woocommerce/woocommerce.php')) {
      
      ?>
      <div class="notice notice-error is-dismissible-not my-2">
        <p><?php esc_html_e('Server-side tagging via Google Tag Manager requires WooCommerce to be installed and activated.', 'server-side-tagging-via-google-tag-manager-for-wordpress'); ?></p>
        <?php if (!file_exists(WP_PLUGIN_DIR . '/woocommerce/woocommerce.php')) : ?>
          <p><a href="<?php echo esc_url(wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=woocommerce'), 'install-plugin_woocommerce')); ?>" class="button button-primary"><?php esc_html_e('Install WooCommerce', 'convsst'); ?></a></p>
        <?php else : ?>
          <p><a href="<?php echo esc_url(wp_nonce_url(self_admin_url('plugins.php?action=activate&plugin=woocommerce/woocommerce.php'), 'activate-plugin_woocommerce/woocommerce.php')); ?>" class="button button-primary"><?php esc_html_e('Activate WooCommerce', 'convsst'); ?></a></p>
        <?php endif; ?>
        <!-- <button type="button" class="notice-dismiss">
          <span class="screen-reader-text">Dismiss this notice.</span>
        </button> -->
      </div>
      <?php
    }
  }

  public function tvc_display_admin_notices()
  {
    $ee_additional_data = $this->get_ee_additional_data();
    if (isset($ee_additional_data['admin_notices']) && !empty($ee_additional_data['admin_notices'])) {
      $static_notice_priority = array("no_google_signin" => "1", "no_ga_account" => "2", "no_google_convsst_ads_account" => "3", "review_for_days" => "4");
      $display_arr = array();
      foreach ($ee_additional_data['admin_notices'] as $key => $admin_notice) {
        if (!isset($admin_notice["key"])) {
          $admin_notice["key"] = $key;
        }
        if (!empty($admin_notice['link_title']) && !empty($admin_notice['status']) && $admin_notice['status'] = "1") {
          if ((!isset($admin_notice['priority']) || $admin_notice['priority'] == "")) {
            if (isset($static_notice_priority[$key])) {
              $admin_notice["priority"] = $static_notice_priority[$key];
              $display_arr[$admin_notice["priority"]] = $admin_notice;
            }
          } else {
            //after priority setting
            $display_arr[$admin_notice["priority"]] = $admin_notice;
          }
        }
      }
      //display - sorting ascending - slice 2 
      usort($display_arr, function ($a, $b) {
        return $a['priority'] - $b['priority'];
      });
      //setting the limit 2 admin notices at a time.
      $admin_notice_display_arr_limit = array_slice($display_arr, 0, 2);
      if (isset($admin_notice_display_arr_limit) && !empty($admin_notice_display_arr_limit)) {
        foreach ($admin_notice_display_arr_limit  as $convsst_display_admin_notice) {
          if (!empty($convsst_display_admin_notice['link_title']) && !empty($convsst_display_admin_notice['status']) && $convsst_display_admin_notice['status'] = "1") {
          ?>
            <div class="notice notice-info notice-dismiss_trigger is-dismissible" data-id='<?php echo esc_attr($convsst_display_admin_notice['key']); ?>'>
      <?php echo '<p>' . esc_html($convsst_display_admin_notice['content']) . ' <a href="' . esc_url($convsst_display_admin_notice["link"]) . '" target="_blank" ><b><u>' . esc_html($convsst_display_admin_notice['link_title']) . '</u></b></a></p>
            </div>';
          }
        }
      }
    
      
    }
    wp_add_inline_script( 'convsst-admin',"
var tvc_ajax_url = '". esc_url(admin_url('admin-ajax.php')) ."';
(function($) {
  jQuery(function() {
    jQuery('.notice-dismiss_trigger').on('click', '.notice-dismiss', function(event, el) {
      var ee_notice_dismiss_id_trigger = jQuery(this).parent('.is-dismissible').attr('data-id');
      jQuery.post(tvc_ajax_url, {
        action: 'tvc_call_notice_dismiss_trigger',
        data: {
          ee_notice_dismiss_id_trigger: ee_notice_dismiss_id_trigger
        },
        apiNoticDismissNonce: '". esc_js(wp_create_nonce('tvc_call_notice_dismiss-nonce')) ."',
        dataType: 'json'
      }, function(response) {});
    });
  });
})(jQuery);
      ");
  }

  /*
   * conver curency code to currency symbols
   */
  public function get_currency_symbols($code)
  {
    $currency_symbols = array(
      'USD' => '$', // US Dollar
      'EUR' => '€', // Euro
      'CRC' => '₡', // Costa Rican Colón
      'GBP' => '£', // British Pound Sterling
      'ILS' => '₪', // Israeli New Sheqel
      'INR' => '₹', // Indian Rupee
      'JPY' => '¥', // Japanese Yen
      'KRW' => '₩', // South Korean Won
      'NGN' => '₦', // Nigerian Naira
      'PHP' => '₱', // Philippine Peso
      'PLN' => 'zł', // Polish Zloty
      'PYG' => '₲', // Paraguayan Guarani
      'THB' => '฿', // Thai Baht
      'UAH' => '₴', // Ukrainian Hryvnia
      'VND' => '₫' // Vietnamese Dong
    );
    if (isset($currency_symbols[$code]) && $currency_symbols[$code] != "") {
      return $currency_symbols[$code];
    } else {
      return $code;
    }
  }
  /*pixel validation */
  public function is_facebook_pixel_id($string)
  {
    if (empty($string)) {
      return true;
    }
    $re = '/^\d{14,16}$/m';
    return $this->convsst_validate_with_regex($re, $string);
  }
  public function is_bing_uet_tag_id($string)
  {
    if (empty($string)) {
      return true;
    }
    $re = '/^\d{7,9}$/m';
    return $this->convsst_validate_with_regex($re, $string);
  }
  public function is_twitter_pixel_id($string)
  {
    if (empty($string)) {
      return true;
    }
    $re = '/^[a-z0-9]{5,7}$/m';
    return $this->convsst_validate_with_regex($re, $string);
  }
  public function is_pinterest_pixel_id($string)
  {
    if (empty($string)) {
      return true;
    }
    $re = '/^\d{13}$/m';
    return $this->convsst_validate_with_regex($re, $string);
  }
  public function is_snapchat_pixel_id($string)
  {
    if (empty($string)) {
      return true;
    }
    $re = '/^[a-z0-9\-]*$/m';
    return $this->convsst_validate_with_regex($re, $string);
  }
  public function is_tiktok_pixel_id($string)
  {
    if (empty($string)) {
      return true;
    }
    $re = '/^[A-Z0-9]{20,20}$/m';
    return $this->convsst_validate_with_regex($re, $string);
  }
  public function convsst_validate_with_regex($re, $string)
  {
    // validate if string matches the regex $re
    if (preg_match($re, $string)) {
      return true;
    } else {
      return false;
    }
  }

  /*
  * Add Plugin logs
  */
  public function plugin_log($message, $file = 'plugin')
  {
    // Get WordPress uploads directory.
    if (is_array($message)) {
      $message = wp_json_encode($message);
    }
    $log = new WC_Logger();
    $log->add('Conversios Product Sync Log ', $message);
    //error_log($message);
    return true;
  }

  /*
   * get user roles from wp
   */
  function convsst_get_user_roles()
  {
    $wp_usr_roles   = new WP_Roles();
    $user_roles_arr = array();
    foreach ($wp_usr_roles->get_names() as $slug => $name) {
      $user_roles_arr[$slug] = $name;
    }
    return $user_roles_arr;
  }

  /*
   * get user roles from wp
   */
  function convsst_all_pixel_event()
  {
    $convsst_pixel_events = array(
      "view_item_list" => "View item list",
      "select_item" => "Select item",
      "add_to_cart_list" => "Add to cart on item list",
      "view_item" => "View Item",
      "add_to_cart_single" => "Add to cart on single item",
      "view_cart" => "View cart",
      "remove_from_cart" => "Remove from cart",
      "begin_checkout" => "Begin checkout",
      "add_shipping_info" => "Add shipping info",
      "add_payment_info" => "Add payment info",
      "purchase" => "Purchase"
    );
    ksort($convsst_pixel_events);
    return $convsst_pixel_events;
  }
  function get_convsst_pro_link_adv($advance_utm_medium = "popup", $advance_utm_campaign = "pixel_setting", $advance_linkclass = "tvc-pro", $advance_linktype = "anchor", $upgradetopro_text_param = "Upgrade to Pro")
  {
    $convsst_advance_plugin_link = esc_url($this->get_pro_plan_site() . "?utm_source=in_app&utm_medium=" . $advance_utm_medium . "&utm_campaign=" . $advance_utm_campaign);
    $convsst_advance_plugin_link_return = "";
    $upgradetopro_text = esc_html($upgradetopro_text_param);
    if ($advance_linktype == "anchor") {
      $convsst_advance_plugin_link_return = "<a href='" . $convsst_advance_plugin_link . "' target='_blank' class='" . $advance_linkclass . "'> " . $upgradetopro_text . "</a>";
    }
    if ($advance_linktype == "linkonly") {
      $convsst_advance_plugin_link_return = $convsst_advance_plugin_link;
    }
    return $convsst_advance_plugin_link_return;
  }

  public function ee_get_result_limit($table, $limit)
  {

    global $wpdb;
    if ($table == "") {
      return;
    } else {
      $tablename = esc_sql($wpdb->prefix . $table);
      return $wpdb->get_results( $wpdb->prepare("select * from {$tablename}  ORDER BY id DESC LIMIT %d", $limit) );
    }
  }
  

  /*
   * get tiktok_business_id
   */
  public function get_tiktok_business_id()
  {
    $tiktok_detail = $this->get_ee_options_settings();
    return $this->tiktok_business_id = (isset($tiktok_detail['tiktok_setting']['tiktok_business_id'])) ? $tiktok_detail['tiktok_setting']['tiktok_business_id'] : "";
  }

  public function get_ee_sst_pcount_limit($type = 'limitnumber')
  {
    $plan_id = $this->get_plan_id();
    $allow_sst_js = 0;
    $ee_sst_pcount = get_option('convsst_sst_pcount', 0);

    if ($type == 'limitnumber') {
      $limitnumber = 0;
      if ($plan_id == 46) {
        $limitnumber = 100;
      }

      return $limitnumber;
    }

    if ($type == 'isallowed') {
      if ($plan_id == 46 && $ee_sst_pcount < 100) {
        $allow_sst_js = 1;
      }
      return $allow_sst_js;
    }
  } 
  
  public function get_ee_sst_pcount_quota()
  {
    $get_ee_sst_pcount_limit = $this->get_ee_sst_pcount_limit();
    $percentage_arr = array(
      "60" => round((60 / 100) * $get_ee_sst_pcount_limit),
      "70" => round((70 / 100) * $get_ee_sst_pcount_limit),
      "80" => round((80 / 100) * $get_ee_sst_pcount_limit),
      "90" => round((90 / 100) * $get_ee_sst_pcount_limit),
      "100" => round((100 / 100) * $get_ee_sst_pcount_limit)
    );
    return $percentage_arr;
  }

  public function update_ee_sst_pcount_quota($data)
  {
    $this->customApiObj->updateEeSstPcountQuota($data);
  }

  //tvc_add_data_admin_notice function for adding the admin notices
  public function tvc_add_admin_notice($slug, $content, $status, $link_title = null, $link = null, $value = null, $title = null, $priority = "", $key = "")
  {
    $ee_additional_data = $this->get_ee_additional_data();
    if (!isset($ee_additional_data['admin_notices'][$slug])) {
      $ee_additional_data['admin_notices'][$slug] = array("link_title" => $link_title, "content" => $content, "status" => $status, "title" => $title, "value" => $value, "link" => $link, "priority" => $priority, "key" => $key);
      $this->set_ee_additional_data($ee_additional_data);
    }
  }

}
