<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       conversios.io
 * @since      1.0.0
 *
 * @package    Convsst_Ecommerce_Google_Analytics
 * @subpackage Convsst_Ecommerce_Google_Analytics/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * @package    Convsst_Ecommerce_Google_Analytics
 * @subpackage Convsst_Ecommerce_Google_Analytics/public
 * @author     Conversios
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

require_once(CONVSST_PLUGIN_DIR . 'public/class-con-settings.php');

class Convsst_Ecommerce_Google_Analytics_Wordpress extends Convsst_Settings
{
  /**
   * Init and hook in the integration.
   *
   * @access public
   * @return void
   */
  //set plugin version
  protected $gtm;
  protected $TVC_Admin_Helper;
  protected $plugin_name;
  protected $version;
  protected $fb_page_view_event_id;
  protected $tvc_options;
  protected $tracking_method;

  /**
   * Convsst_Ecommerce_Google_Analytics_Public constructor.
   * @param $plugin_name
   * @param $version
   */

  public function __construct($plugin_name, $version)
  {
    parent::__construct();
    $this->gtm = new Convsst_GTM_Tracking($plugin_name, $version);
    $this->TVC_Admin_Helper = new TVC_Admin_Helper();
    $this->plugin_name = sanitize_text_field($plugin_name);
    $this->version  = sanitize_text_field($version);
    $this->tvc_call_hooks();
    $this->fb_page_view_event_id = $this->get_fb_event_id();

    /*
     * start tvc_options
     */
    $current_user = wp_get_current_user();
    //$current_user ="";
    $user_id = "";
    $user_type = "guest_user";
    if (isset($current_user->ID) && $current_user->ID != 0) {
      $user_id = $current_user->ID;
      $current_user_type = 'register_user';
    }
    $this->tvc_options = array(
      "local_time" => esc_js(time()),
      "is_admin" => esc_attr(is_admin()),
      "tracking_option" => esc_js($this->tracking_option),
      "property_id" => esc_js($this->ga_id),
      "measurement_id" => esc_js($this->gm_id),
      "google_ads_id" => esc_js($this->google_ads_id),
      "google_merchant_center_id" => esc_js($this->google_merchant_id),
      "o_enhanced_e_commerce_tracking" => esc_js($this->ga_eeT),
      "o_log_step_gest_user" => esc_js($this->ga_gUser),
      "o_impression_thresold" => esc_js($this->ga_imTh),
      "o_ip_anonymization" => esc_js($this->ga_IPA),
      "ads_tracking_id" => esc_js($this->ads_tracking_id),
      "remarketing_tags" => esc_js($this->ads_ert),
      "dynamic_remarketing_tags" => esc_js($this->ads_edrt),
      "convsst_google_ads_tracking" => esc_js($this->convsst_google_ads_tracking),
      "conversio_send_to" => esc_js($this->conversio_send_to),
      "convsst_ga_EC" => esc_js($this->convsst_ga_EC),
      "user_id" => esc_js($user_id),
      "user_type" => esc_js($user_type),
      "day_type" => esc_js($this->add_day_type()),
      "remarketing_snippet_id" => esc_js($this->remarketing_snippet_id),
      "fb_pixel_id" => esc_js($this->fb_pixel_id),
      "fb_conversion_api_token" => esc_js($this->fb_conversion_api_token),
      "fb_event_id" => $this->get_fb_event_id(),
      "tvc_ajax_url" => esc_url(admin_url('admin-ajax.php')),
      "nonce" => wp_create_nonce("tvc-ajax-nonce"),
    );
    /*
     * end tvc_options
     */
  }

  public function tvc_call_hooks()
  {
    /**
     * add global site tag js or settings
     **/
    add_action("wp_head", array($this->gtm, "begin_datalayer"));
    add_action("wp_enqueue_scripts", array($this->gtm, "enqueue_scripts"));
    add_action("wp_head", array($this, "add_google_site_verification_tag"), 1);
    //add_action("wp_footer", array($this->gtm, "add_gtm_data_layer"));

    if ($this->tracking_method == "gtm") {
      add_action("woocommerce_after_cart", array($this->gtm, "product_cart_view"));
    } else {
      add_action("woocommerce_after_cart", array($this, "remove_cart_tracking"));
    }


    //Add Dev ID
    add_action("wp_enqueue_scripts", array($this, "add_dev_id"));
    add_action("wp_enqueue_scripts", array($this, "tvc_store_meta_data"));
    add_filter('script_loader_tag', array($this,'add_async_attribute_to_frontend_script'), 10, 3);
  }

  /**
   * Google Analytics Day type
   *
   * @access public
   * @return void
   */
  public function add_day_type()
  {
    $date = gmdate("Y-m-d");
    $day = strtolower(gmdate('l', strtotime($date)));
    if (($day == "saturday") || ($day == "sunday")) {
      $day_type = esc_html__("weekend", "server-side-tagging-via-google-tag-manager-for-wordpress");
    } else {
      $day_type = esc_html__("weekday", "server-side-tagging-via-google-tag-manager-for-wordpress");
    }
    return $day_type;
  }
  /*
   * Site verification using tag method
   */
  public function add_google_site_verification_tag()
  {
    $TVC_Admin_Helper = new TVC_Admin_Helper();
    $ee_additional_data = $TVC_Admin_Helper->get_ee_additional_data();
    if (isset($ee_additional_data['add_site_varification_tag']) && isset($ee_additional_data['site_varification_tag_val']) && $ee_additional_data['add_site_varification_tag'] == 1 && $ee_additional_data['site_varification_tag_val'] != "") {
      echo esc_html(html_entity_decode(esc_html(base64_decode($ee_additional_data['site_varification_tag_val']))));
    }
  }
  /**
   * Get store meta data for trouble shoot
   * @access public
   * @return void
   */
  public function tvc_store_meta_data()
  {
    //only on home page
    global $woocommerce;
    $google_detail = $this->TVC_Admin_Helper->get_ee_options_data();
    $googleDetail = array();
    if (isset($google_detail['setting'])) {
      $googleDetail = $google_detail['setting'];
    }
    $tvc_sMetaData = array(
      'tvc_wpv' => esc_js(get_bloginfo('version')),
      'tvc_eev' => esc_js($this->tvc_eeVer),
      'tvc_cnf' => array(
        't_cg' => esc_js($this->ga_CG),
        't_ec' => esc_js($this->convsst_ga_EC),
        't_ee' => esc_js($this->ga_eeT),
        't_df' => esc_js($this->ga_DF),
        't_gUser' => esc_js($this->ga_gUser),
        't_UAen' => esc_js($this->ga_ST),
        't_thr' => esc_js($this->ga_imTh),
        't_IPA' => esc_js($this->ga_IPA),
        //'t_OptOut' => esc_js($this->ga_OPTOUT),
        't_PrivacyPolicy' => esc_js($this->ga_PrivacyPolicy)
      ),
      'tvc_sub_data' => array(
        'sub_id' => esc_js(isset($googleDetail->id) ? sanitize_text_field($googleDetail->id) : ""),
        'cu_id' => esc_js(isset($googleDetail->customer_id) ? sanitize_text_field($googleDetail->customer_id) : ""),
        'pl_id' => esc_js(isset($googleDetail->plan_id) ? sanitize_text_field($googleDetail->plan_id) : ""),
        'ga_tra_option' => esc_js(isset($googleDetail->tracking_option) ? sanitize_text_field($googleDetail->tracking_option) : ""),
        'ga_property_id' => esc_js(isset($googleDetail->property_id) ? sanitize_text_field($googleDetail->property_id) : ""),
        'ga_measurement_id' => esc_js(isset($googleDetail->measurement_id) ? sanitize_text_field($googleDetail->measurement_id) : ""),
        'ga_convsst_ads_id' => esc_js(isset($googleDetail->google_ads_id) ? sanitize_text_field($googleDetail->google_ads_id) : ""),
        'ga_gmc_id' => esc_js(isset($googleDetail->google_merchant_center_id) ? sanitize_text_field($googleDetail->google_merchant_center_id) : ""),
        'ga_gmc_id_p' => esc_js(isset($googleDetail->merchant_id) ? sanitize_text_field($googleDetail->merchant_id) : ""),
        'op_gtag_js' => esc_js(isset($googleDetail->add_gtag_snippet) ? sanitize_text_field($googleDetail->add_gtag_snippet) : ""),
        'op_en_e_t' => esc_js(isset($googleDetail->enhanced_e_commerce_tracking) ? sanitize_text_field($googleDetail->enhanced_e_commerce_tracking) : ""),
        'op_rm_t_t' => esc_js(isset($googleDetail->remarketing_tags) ? sanitize_text_field($googleDetail->remarketing_tags) : ""),
        'op_dy_rm_t_t' => esc_js(isset($googleDetail->dynamic_remarketing_tags) ? esc_attr($googleDetail->dynamic_remarketing_tags) : ""),
        'op_li_ga_wi_ads' => esc_js(isset($googleDetail->link_google_analytics_with_google_ads) ? sanitize_text_field($googleDetail->link_google_analytics_with_google_ads) : ""),
        'gmc_is_product_sync' => esc_js(isset($googleDetail->is_product_sync) ? sanitize_text_field($googleDetail->is_product_sync) : ""),
        'gmc_is_site_verified' => esc_js(isset($googleDetail->is_site_verified) ? sanitize_text_field($googleDetail->is_site_verified) : ""),
        'gmc_is_domain_claim' => esc_js(isset($googleDetail->is_domain_claim) ? sanitize_text_field($googleDetail->is_domain_claim) : ""),
        'gmc_product_count' => esc_js(isset($googleDetail->product_count) ? sanitize_text_field($googleDetail->product_count) : ""),
        'fb_pixel_id' => esc_js($this->fb_pixel_id),
        'tracking_method' => esc_js($this->tracking_method),
        'user_gtm_id' => ($this->tracking_method == 'gtm' && $this->want_to_use_your_gtm == 1) ? esc_js($this->use_your_gtm_id) : (($this->tracking_method == 'gtm') ? "conversios-gtm" : "")
      )
    );
    $this->wp_version_compare("tvc_smd=" . wp_json_encode($tvc_sMetaData) . ";");
  }

  /**
   * add dev id
   *
   * @access public
   * @return void
   */
  public function add_dev_id()
  {
    wp_add_inline_script('enhanced-ecommerce-google-analytics','(window.gaDevIds = window.gaDevIds || []).push("5CDcaG");','before');
  }
  /**
   * Add attribute in script tag like defere, ansyc etc.
   *
   * @access public
   * @return void
   */
  public function add_async_attribute_to_frontend_script($tag, $handle, $src) {
    $has_html5_support    = current_theme_supports('html5');
    if ('enhanced-ecommerce-google-analytics' === $handle) {
      // Add async and nonce attributes 
      $str = 'id="enhanced-ecommerce-google-analytics-js-before" data-cfasync="false" data-pagespeed-no-defer ' . ($has_html5_support ? ' type="text/javascript"' : '');
      $tag = str_replace( 'id="enhanced-ecommerce-google-analytics-js-before"', $str, $tag );
    }
    return $tag;
  }
}

/**
 * GTM Tracking Data Layer Push
 **/
class Convsst_GTM_Tracking extends Convsst_Settings
{
  protected $plugin_name;
  protected $version;
  protected $user_data;
  public function __construct($plugin_name, $version)
  {
    parent::__construct();
    $this->plugin_name = $plugin_name;
    $this->version = $version;
    $this->TVC_Admin_Helper = new TVC_Admin_Helper();
    $this->tvc_options = array(
      "affiliation" => esc_js(get_bloginfo('name')),
      "is_admin" => esc_attr(is_admin()),
      "tracking_option" => esc_js($this->tracking_option),
      "property_id" => esc_js($this->ga_id),
      "measurement_id" => esc_js($this->gm_id),
      "google_ads_id" => esc_js($this->google_ads_id),
      "fb_pixel_id" => esc_js($this->fb_pixel_id),
      "fb_conversion_api_token" => esc_js($this->fb_conversion_api_token),
      "fb_event_id" => $this->get_fb_event_id(),
      "tvc_ajax_url" => esc_url(admin_url('admin-ajax.php'))
    );
  }
  public function get_user_data()
  {
    if (empty($this->user_data)) {
      $this->set_user_data();
    }
    return $this->user_data;
  }


  /**
   * begin datalayer like settings
   **/
  public function begin_datalayer()
  {
    if ($this->disable_tracking($this->ga_eeT)) {
      return;
    }
    /*start uset tracking*/
    $enhanced_conversion = array();

    /*end user tracking*/
    $conversio_send_to = array();
    if ($this->conversio_send_to != "") {
      $conversio_send_to = explode("/", $this->conversio_send_to);
    }
    $dataLayer = array("event" => "begin_datalayer");
    if ($this->ga_id != "") {
      $dataLayer["cov_ga3_propety_id"] = esc_js($this->ga_id);
    }
    if ($this->gm_id != "") {
      $dataLayer["cov_ga4_measurment_id"] = esc_js($this->gm_id);
    }
    if ($this->remarketing_snippet_id != "") {
      $dataLayer["cov_remarketing_conversion_id"] = esc_js($this->remarketing_snippet_id);
    }
    $dataLayer["cov_remarketing"] = $this->ads_ert;
    $dataLayer["cov_dynamic_remarketing"] = $this->ads_edrt;
    if ($this->fb_pixel_id != "") {
      $dataLayer["cov_fb_pixel_id"] = esc_js($this->fb_pixel_id);
    }
    if ($this->microsoft_convsst_ads_pixel_id != "") {
      $dataLayer["cov_microsoft_uetq_id"] = esc_js($this->microsoft_convsst_ads_pixel_id);
    }
    if ($this->twitter_convsst_ads_pixel_id != "") {
      $dataLayer["cov_twitter_pixel_id"] = esc_js($this->twitter_convsst_ads_pixel_id);
    }
    if ($this->pinterest_convsst_ads_pixel_id != "") {
      $dataLayer["cov_pintrest_pixel_id"] = esc_js($this->pinterest_convsst_ads_pixel_id);
    }
    if ($this->snapchat_convsst_ads_pixel_id != "") {
      $dataLayer["cov_snapchat_pixel_id"] = esc_js($this->snapchat_convsst_ads_pixel_id);
    }
    if ($this->tiKtok_convsst_ads_pixel_id != "") {
      $dataLayer["cov_tiktok_sdkid"] = esc_js($this->tiKtok_convsst_ads_pixel_id);
    }
    if (!empty($enhanced_conversion) &&  $this->convsst_ga_EC == 1) {
      $dataLayer =  array_merge($dataLayer, $enhanced_conversion);
    }
    if (!empty($conversio_send_to) && $this->conversio_send_to && $this->convsst_google_ads_tracking == 1) {
      if (isset($conversio_send_to[0]) && isset($conversio_send_to[1])) {
        $dataLayer["cov_gads_conversion_id"] = esc_js($conversio_send_to[0]);
        $dataLayer["cov_gads_conversion_label"] = esc_js($conversio_send_to[1]);
      }
    }
    if ($this->fb_conversion_api_token != "") {
      $dataLayer["fb_event_id"] = $this->get_fb_event_id();
    }
    $this->add_gtm_begin_datalayer_js($dataLayer);
  }

  /** 
   * dataLayer for setting and GTM global tag
   **/
  public function add_gtm_begin_datalayer_js($data_layer)
  {
    $gtm_id = ($this->want_to_use_your_gtm && $this->use_your_gtm_id != "") ? $this->use_your_gtm_id : "GTM-K7X94DG";
    $has_html5_support    = current_theme_supports('html5');
    $gtm_url = "https://www.googletagmanager.com";

    wp_add_inline_script('enhanced-ecommerce-google-analytics','
      window.dataLayer = window.dataLayer || [];
      dataLayer.push(' . wp_json_encode($data_layer) . ');
    ', true);

    wp_add_inline_script('enhanced-ecommerce-google-analytics',"
    <!-- Google Tag Manager by Conversios-->
  
      (function(w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
          'gtm.start': new Date().getTime(),
          event: 'gtm.js'
        });
        var f = d.getElementsByTagName(s)[0],
          j = d.createElement(s),
          dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src =
          '". esc_js($gtm_url) ."/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
      })(window, document, 'script', 'dataLayer', '". esc_js($gtm_id) ."');
    
    <!-- End Google Tag Manager by Conversios-->
    ",true);

    add_action('wp_body_open', array($this,'add_gtm_noscript'));
  }
  /** 
   * Google Tag Manager Noscript
   **/
  public function add_gtm_noscript()
  {
    $gtm_id = ($this->want_to_use_your_gtm && $this->use_your_gtm_id != "") ? $this->use_your_gtm_id : "GTM-K7X94DG";
    $gtm_url = "https://www.googletagmanager.com";
    if ($this->sst_transport_url != "" && $this->sst_web_container != "") {
      $gtm_id = trim($this->sst_web_container);
      $gtm_url = trim($this->sst_transport_url, '/');
    }
    ?>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="<?php echo esc_js($gtm_url); ?>?id=<?php echo esc_js($gtm_id); ?>" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
     <?php
  }
  /** 
   * DataLayer to JS
   **/
  public function add_gtm_data_layer_js($data_layer)
  {
    $has_html5_support    = current_theme_supports('html5');
    echo '<script data-cfasync="false" data-pagespeed-no-defer' . ($has_html5_support ? ' type="text/javascript"' : '') . '>
      window.dataLayer = window.dataLayer || [];
      dataLayer.push(' . wp_json_encode($data_layer) . ');
    </script>
    ';
  }

  public function enqueue_scripts()
  {
    wp_enqueue_script(esc_js($this->plugin_name), esc_url(CONVSST_PLUGIN_URL . '/public/js/con-gtm-google-analytics.js'), array('jquery'), esc_js($this->version), false);
  }
}
