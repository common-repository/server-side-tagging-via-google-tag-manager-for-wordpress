<?php
class Convsst_Settings
{
  protected $convsst_ga_EC;
  //content grouping start
  protected $ga_optimize_id;
  protected $ga_CG;
  //content grouping end
  public $tvc_eeVer = CONVSST_PLUGIN_VERSION;
  protected $ga_LC;
  protected $ga_Dname;

  protected $ga_id;
  protected $gm_id;
  protected $google_ads_id;
  protected $google_merchant_id;

  protected $tracking_option;

  protected $ga_ST;
  protected $ga_eeT;
  protected $ga_gUser;

  protected $ga_imTh;

  protected $ga_IPA;
  //protected $ga_OPTOUT; 

  protected $ads_ert;
  protected $ads_edrt;
  protected $ads_tracking_id;

  protected $ga_PrivacyPolicy;

  protected $ga_gCkout;
  protected $ga_DF;
  protected $tvc_options;
  protected $TVC_Admin_Helper;
  protected $remarketing_snippet_id;
  protected $remarketing_snippets;
  protected $conversio_send_to;
  protected $ee_options;
  protected $fb_pixel_id;
  protected $c_t_o; //custom_tracking_options
  protected $tracking_method;

  protected $microsoft_convsst_ads_pixel_id;
  protected $twitter_convsst_ads_pixel_id;
  protected $pinterest_convsst_ads_pixel_id;
  protected $snapchat_convsst_ads_pixel_id;
  protected $snapchat_access_token;
  protected $tiKtok_convsst_ads_pixel_id;

  protected $want_to_use_your_gtm;
  protected $use_your_gtm_id;
  protected $tiktok_business_id;
  protected $tiktok_access_token;
  protected $fb_api_version;
  protected $fb_conversion_api_token;
  protected $plan_id;
  protected $sst_transport_url;
  protected $sst_web_container;

  protected $ga_excT;
  protected $exception_tracking;
  protected $ga_elaT;
  protected $net_revenue_setting;

  protected $convsst_google_ads_tracking;
  protected $convsst_disabled_users;

  public function __construct()
  {
    $this->fb_api_version = "v15.0";
    $this->TVC_Admin_Helper = new TVC_Admin_Helper();
    $this->plan_id = $this->TVC_Admin_Helper->get_plan_id();
    $this->fb_conversion_api_token = sanitize_text_field($this->get_option("fb_conversion_api_token"));
    

    add_action('wp_head', array($this, 'convsst_set_yith_current_currency'));
    $this->ga_CG = $this->get_option('ga_CG') == "on" ? true : false; // Content Grouping
    $this->ga_optimize_id = sanitize_text_field($this->get_option("ga_optimize_id"));
    $this->ee_options = $this->TVC_Admin_Helper->get_ee_options_settings();

    $this->tracking_method = sanitize_text_field($this->get_option("tracking_method"));

    $this->ga_Dname = "auto";
    $this->ga_id = sanitize_text_field($this->get_option("ga_id"));
    $this->ga_eeT = sanitize_text_field($this->get_option("ga_eeT"));
    $this->ga_ST = sanitize_text_field($this->get_option("ga_ST")); //add_gtag_snippet
    $this->gm_id = sanitize_text_field($this->get_option("gm_id")); //measurement_id
    $this->google_ads_id = sanitize_text_field($this->get_option("google_ads_id"));
    $this->ga_excT = sanitize_text_field($this->get_option("ga_excT")); //exception_tracking
    $this->exception_tracking = sanitize_text_field($this->get_option("exception_tracking")); //exception_tracking
    $this->ga_elaT = sanitize_text_field($this->get_option("ga_elaT")); //enhanced_link_attribution_tracking
    $this->google_merchant_id = sanitize_text_field($this->get_option("google_merchant_id"));
    $this->tracking_option = sanitize_text_field($this->get_option("tracking_option"));
    $this->ga_gCkout = sanitize_text_field($this->get_option("ga_gCkout") == "on" ? true : false); //guest checkout
    $this->ga_gUser = sanitize_text_field($this->get_option("ga_gUser") == "on" ? true : false); //guest checkout
    $this->ga_DF = sanitize_text_field($this->get_option("ga_DF") == "on" ? true : false);
    $this->ga_imTh = sanitize_text_field($this->get_option("ga_Impr") == "" ? 6 : $this->get_option("ga_Impr"));
    //$this->ga_OPTOUT = sanitize_text_field($this->get_option("ga_OPTOUT") == "on" ? true : false); //Google Analytics Opt Out
    $this->ga_PrivacyPolicy = sanitize_text_field($this->get_option("ga_PrivacyPolicy") == "on" ? true : false);
    $this->ga_IPA = sanitize_text_field($this->get_option("ga_IPA") == "on" ? true : false); //IP Anony.
    $this->ads_ert = get_option('convsst_ads_ert'); //Enable remarketing tags
    $this->ads_edrt = get_option('convsst_ads_edrt'); //Enable dynamic remarketing tags
    $this->ads_tracking_id = sanitize_text_field(get_option('convsst_ads_tracking_id'));
    $this->convsst_google_ads_tracking = get_option('convsst_google_ads_tracking');
    $this->convsst_ga_EC = get_option("convsst_ga_EC");
    $this->conversio_send_to = get_option('conversio_send_to');
    $this->tiktok_business_id = sanitize_text_field($this->get_option("tiktok_business_id"));
    $this->tiktok_access_token = sanitize_text_field($this->get_option("tiktok_access_token"));
    $this->snapchat_access_token = sanitize_text_field($this->get_option("snapchat_access_token"));
    
    $remarketing = unserialize(get_option('convsst_remarketing_snippets'));
    if (!empty($remarketing) && isset($remarketing['snippets']) && esc_attr($remarketing['snippets'])) {
      $this->remarketing_snippets = base64_decode($remarketing['snippets']);
      $this->remarketing_snippet_id = sanitize_text_field(isset($remarketing['id']) ? esc_attr($remarketing['id']) : "");
    }

    /*pixels*/
    $this->fb_pixel_id = sanitize_text_field($this->get_option('fb_pixel_id'));
    $this->microsoft_convsst_ads_pixel_id = sanitize_text_field($this->get_option('microsoft_convsst_ads_pixel_id'));
    $this->twitter_convsst_ads_pixel_id = sanitize_text_field($this->get_option('twitter_convsst_ads_pixel_id'));
    $this->pinterest_convsst_ads_pixel_id = sanitize_text_field($this->get_option('pinterest_convsst_ads_pixel_id'));
    $this->snapchat_convsst_ads_pixel_id = sanitize_text_field($this->get_option('snapchat_convsst_ads_pixel_id'));
    $this->tiKtok_convsst_ads_pixel_id = sanitize_text_field($this->get_option('tiKtok_convsst_ads_pixel_id'));
    /* GTM*/
    $this->want_to_use_your_gtm = sanitize_text_field($this->get_option('want_to_use_your_gtm'));
    $this->use_your_gtm_id = sanitize_text_field($this->get_option('use_your_gtm_id'));
    $this->sst_transport_url = sanitize_text_field($this->get_option('sst_transport_url'));
    $this->sst_web_container = sanitize_text_field($this->get_option('sst_web_container'));
    if (is_plugin_active_for_network('woocommerce/woocommerce.php') || in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
      $this->ga_LC = get_woocommerce_currency(); //Local Currency from Back end
    }

    //Disabled user roles
    $this->convsst_disabled_users = $this->get_option('convsst_disabled_users');
    $this->c_t_o = $this->TVC_Admin_Helper->get_ee_options_settings();
    
    //net_revenue_setting
    $this->net_revenue_setting = $this->get_option('net_revenue_setting');
  }

  public function convsst_set_yith_current_currency()
  {
    if (in_array("yith-multi-currency-switcher-for-woocommerce/init.php", apply_filters('active_plugins', get_option('active_plugins')))) {
      $this->ga_LC = yith_wcmcs_get_current_currency_id(); 
    }
  }

  public function get_option($key)
  {
    if (empty($this->ee_options)) {
      $this->ee_options = $this->TVC_Admin_Helper->get_ee_options_settings();
    }
    if (isset($this->ee_options[$key])) {
      return $this->ee_options[$key];
    }
  }

  public function wc_version_compare($codeSnippet)
  {
    global $woocommerce;
    if (version_compare($woocommerce->version, "2.1", ">=")) {
      wc_enqueue_js($codeSnippet);
    } else {
      $woocommerce->add_inline_js($codeSnippet);
    }
  }
  public function wp_version_compare($codeSnippet)
  {

      ////////// DEPRECATED after 7.0.12+ ///////////////
      /*
      global $woocommerce;
      if (version_compare($woocommerce->version, "2.1", ">=")) {
      wc_enqueue_js($codeSnippet);
      } else {
      $woocommerce->add_inline_js($codeSnippet);
      }*/
      
      wp_add_inline_script('enhanced-ecommerce-google-analytics', $codeSnippet);
  }
  public function get_selector_val_fron_array($obj, $key)
  {
    if (isset($obj[$key . '_val']) && $obj[$key . '_val'] && isset($obj[$key . '_type']) && $obj[$key . '_type'] == "id") {
      return ",#" . $obj[$key . '_val'];
    } else if (isset($obj[$key . '_val']) && $obj[$key . '_val'] && isset($obj[$key . '_type']) && $obj[$key . '_type'] == "class") {
      $class_list = explode(",", $obj[$key . '_val']);
      if (!empty($class_list)) {
        $class_selector = "";
        foreach ($class_list as $class) {
          $class_selector .= ",." . trim($class);
        }
        return $class_selector;
      }
    }
  }

  public function get_selector_val_from_array_for_gmt($obj, $key)
  {
    if (isset($obj[$key . '_val']) && $obj[$key . '_val'] && isset($obj[$key . '_type']) && $obj[$key . '_type'] == "id") {
      return "#" . $obj[$key . '_val'];
    } else if (isset($obj[$key . '_val']) && $obj[$key . '_val'] && isset($obj[$key . '_type']) && $obj[$key . '_type'] == "class") {
      $class_list = explode(",", $obj[$key . '_val']);
      if (!empty($class_list)) {
        $class_selector = "";
        foreach ($class_list as $class) {
          $class_selector .= ($class_selector) ? ",." . trim($class) : "." . trim($class);
        }
        return $class_selector;
      }
    }
  }

  public function convsst_check_user_role_disabled()
  {
    $current_user_roles = array();
    if (is_user_logged_in()) {
      $user = wp_get_current_user();
      $current_user_roles = (array) $user->roles;
    }
    if (!empty($this->convsst_disabled_users)) {
      $matched_user_roles = array_intersect($current_user_roles, $this->convsst_disabled_users);
      if (is_array($matched_user_roles) && count($matched_user_roles) > 0) {
        return true;
      }
    }
  }

  public function convsst_check_pixel_event_disabled($pixel_event)
  {
    $convsst_selected_events = unserialize(get_option('convsst_selected_events'));
    if (!empty($convsst_selected_events) && ($pixel_event != "" && !in_array($pixel_event, $convsst_selected_events["ga"]))) {
      return true;
    }
  }

  public function disable_tracking($type, $pixel_event = "")
  {
    $is_user_role_disabled = $this->convsst_check_user_role_disabled();
    $is_pixel_event_disabled = $this->convsst_check_pixel_event_disabled($pixel_event);
    if ($type == "" || $is_user_role_disabled || $is_pixel_event_disabled) {
      return true;
    }
  }
  public function tvc_get_order_with_url_order_key()
  {
    $_get['key'] = filter_input(INPUT_GET, 'key', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (isset($_get['key'])) {
      $order_key = $_get['key'];
      return wc_get_order(wc_get_order_id_by_order_key($order_key));
    }
  }
  public function tvc_get_order_from_query_vars()
  {
    global  $wp;
    $order_id = absint($wp->query_vars['order-received']);
    if ($order_id && 0 != $order_id && wc_get_order($order_id)) {
      return wc_get_order($order_id);
    }
  }
  public function tvc_get_order_from_order_received_page()
  {
    if ($this->tvc_get_order_from_query_vars()) {
      return $this->tvc_get_order_from_query_vars();
    } else {
      if ($this->tvc_get_order_with_url_order_key()) {
        return $this->tvc_get_order_with_url_order_key();
      } else {
        return false;
      }
    }
  }
  public function get_client_ip()
  {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
      $ipaddress = sanitize_text_field($_SERVER['HTTP_CLIENT_IP']);
    else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
      $ipaddress = sanitize_text_field($_SERVER['HTTP_X_FORWARDED_FOR']);
    else if (isset($_SERVER['HTTP_X_FORWARDED']))
      $ipaddress = sanitize_text_field($_SERVER['HTTP_X_FORWARDED']);
    else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
      $ipaddress = sanitize_text_field($_SERVER['HTTP_FORWARDED_FOR']);
    else if (isset($_SERVER['HTTP_FORWARDED']))
      $ipaddress = sanitize_text_field($_SERVER['HTTP_FORWARDED']);
    else if (isset($_SERVER['REMOTE_ADDR']))
      $ipaddress = sanitize_text_field($_SERVER['REMOTE_ADDR']);
    else
      $ipaddress = 'UNKNOWN';
    return $ipaddress;
  }
  public function get_fb_event_id()
  {
    $data = openssl_random_pseudo_bytes(16);

    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

    return vsprintf('%s%s%s%s%s%s%s%s', str_split(bin2hex($data), 4));
  }

}
?>