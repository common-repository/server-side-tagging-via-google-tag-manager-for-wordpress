<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       tatvic.com
 * @since      1.0.0
 *
 * @package    Convsst_Ecommerce_Google_Analytics
 * @subpackage Convsst_Ecommerce_Google_Analytics/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Convsst_Ecommerce_Google_Analytics
 * @subpackage Convsst_Ecommerce_Google_Analytics/admin
 * @author     Tatvic
 */

if (!defined('ABSPATH')) {
  exit;
}

if (!class_exists('Convsst_Conversios_Admin')) {
  class Convsst_Conversios_Admin extends TVC_Admin_Helper
  {
    protected $google_detail;
    protected $url;
    protected $version;
    protected $plan_id;
    protected $current_customer_id;
    protected $customApiObj;
    public function __construct()
    {
      $this->version = CONVSST_PLUGIN_VERSION;
      $this->includes();
      $this->url = $this->get_onboarding_page_url(); // use in setting page
      $this->google_detail = $this->get_ee_options_data();
      add_action('admin_menu', array($this, 'add_admin_pages'));
      add_action('admin_init', array($this, 'init'));
      add_action("admin_print_styles", [$this, 'dequeue_css']);
      $this->plan_id = $this->get_plan_id();
      if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))) && $this->plan_id != 1) {
        add_action('woocommerce_order_fully_refunded', array($this, 'action_woocommerce_order_refunded'), 10, 2);
        add_action('woocommerce_order_partially_refunded', array($this, 'woocommerce_partial_order_refunded'), 10, 2);
      }
    }
    public function includes()
    {
      if (!class_exists('Convsst_Conversios_Header')) {
        require_once(CONVSST_PLUGIN_DIR . 'admin/partials/class-conversios-header.php');
      }
      if (!class_exists('Convsst_Conversios_Footer')) {
        require_once(CONVSST_PLUGIN_DIR . 'admin/partials/class-conversios-footer.php');
      }
    }

    public function init()
    {
      add_action('admin_enqueue_scripts', array($this, 'enqueue_styles'));
      add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
    }

    public function dequeue_css()
    {
      $screen = get_current_screen();
      global $wp_scripts, $wp_styles;
      if (str_contains($screen->id, 'conversios-pro_page_') || $screen->id === 'toplevel_page_convsst_conversios') {
        $not_allowed_css = array('porto_admin', 'flashy');
        foreach ($wp_styles->queue as $key => $value) {
          if (in_array($value, $not_allowed_css)) {
            wp_deregister_style($value);
            wp_dequeue_style($value);
          }
        }
      }
    }

    /**
     * Woo Full order refund.
     *
     * @since    1.0.0
     */
    public function action_woocommerce_order_refunded($order_id, $refund_id)
    {
      $data = unserialize(get_option('convsst_options'));
      if (
        empty($data['ga_eeT']) ||
        get_post_meta($order_id, "tvc_tracked_refund", true) == 1
      ) {
        return;
      }
      $refund = wc_get_order($refund_id);
      $value = $refund->get_amount();
      $query = urlencode('/refundorders/');
      $currency = $this->get_woo_currency();
      $client_id = wp_rand(1000000000, 9999999999) . "." . time();
      $ga_id = $data['ga_id'];
      $total_refunds = 0;
      if ($ga_id) {
        $url = "https://www.google-analytics.com/collect?v=1&t=event&ni=1&cu=" . $currency . "&ec=Enhanced-Ecommerce&ea=click&el=full_refund&tid=" . $ga_id . "&cid=" . $client_id . "&ti=" . $order_id . "&pa=refund&tr=" . $value . "&dp=" . $query;
        $request = wp_remote_get(esc_url_raw($url), array('timeout' => CONVSST_TM));
      }
      $gm_id = sanitize_text_field($data['gm_id']);
      $api_secret = sanitize_text_field($data['ga4_api_secret']);
      if ($gm_id && $api_secret) {
        $postData = array(
          "client_id" => $client_id,
          "non_personalized_ads" => true,
          "events" => [
            array(
              "name" => "refund",
              "params" => array(
                "currency" => $currency,
                "transaction_id" => $order_id,
                "value" => $value
              )
            )
          ]
        );
        $args = array(
          'method' => 'POST',
          'body' => wp_json_encode($postData)
        );
        $url = "https://www.google-analytics.com/mp/collect?measurement_id=" . $gm_id . "&api_secret=" . $api_secret;
        $request = wp_remote_post(esc_url_raw($url), $args);
      }
      update_post_meta($order_id, "tvc_tracked_refund", 1);
    }

    /**
     * Woo Partial order refund.
     *
     * @since    1.0.0
     */
    public function woocommerce_partial_order_refunded($order_id, $refund_id)
    {
      $data = unserialize(get_option('convsst_options'));
      $refund = wc_get_order($refund_id);
      $value = $refund->get_amount();
      $refunded_items = array();
      $currency = $this->get_woo_currency();
      $client_id = wp_rand(1000000000, 9999999999) . "." . time();
      $query_params = array();
      $i = 1;
      //GA3
      $ga_id = $data['ga_id'];
      if ($ga_id) {
        foreach ($refund->get_items('line_item') as $item_id => $item) {
          $query_params["pr{$i}id"] = $item['product_id'];
          $query_params["pr{$i}qt"] = abs($item['qty']);
          $query_params["pr{$i}pr"] = abs($item['total']);
          $i++;
        }
        $param_url = http_build_query($query_params, '', '&');
        $url = "https://www.google-analytics.com/collect?v=1&t=event&ni=1&cu=" . $currency . "&ec=Enhanced-Ecommerce&ea=Refund&el=partial_refunded&tid=" . sanitize_text_field($ga_id) . "&cid=" . $client_id . "&tr=" . $value . "&ti=" . $order_id . "&pa=refund&" . $param_url;
        $request = wp_remote_get(esc_url_raw($url), array('timeout' => CONVSST_TM));
      }
      //GA4
      $gm_id = sanitize_text_field($data['gm_id']);
      $api_secret = sanitize_text_field($data['ga4_api_secret']);
      if ($gm_id && $api_secret) {
        $items = array();
        foreach ($refund->get_items('line_item') as $item_id => $item) {
          $items[] = array("item_id" => $item['product_id'], "item_name" => $item['name'], "quantity" => abs($item['qty']), "price" => abs($item['total']), "currency" => $currency);
        }
        $postData = array(
          "client_id" => $client_id,
          "non_personalized_ads" => true,
          "events" => [
            array(
              "name" => "refund",
              "params" => array(
                "items" => $items,
                "currency" => $currency,
                "transaction_id" => $order_id,
                "value" => $value
              )
            )
          ]
        );
        $args = array(
          'method' => 'POST',
          'body' => wp_json_encode($postData)
        );
        $url = "https://www.google-analytics.com/mp/collect?measurement_id=" . $gm_id . "&api_secret=" . $api_secret;
        $request = wp_remote_post(esc_url_raw($url), $args);
      }
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    4.1.4
     */
    public function enqueue_styles()
    {
      $screen = get_current_screen();
      if ($screen->id == 'toplevel_page_convsst_conversios' || 
         (isset($_GET['page']) && strpos(sanitize_text_field(filter_input(INPUT_GET, 'page')), 'conversios') !== false) ||
         (isset($_GET['page']) && strpos(sanitize_text_field(filter_input(INPUT_GET, 'page')), 'convsst') !== false)
      ) {
        //developres hook to custom css
        do_action('convsst_add_css_' . sanitize_text_field(wp_unslash(filter_input(INPUT_GET, 'page'))));

        //conversios page css
        wp_register_style('conversios-daterangepicker-css', esc_url(CONVSST_PLUGIN_URL . '/admin/css/daterangepicker.css'));
        wp_enqueue_style('conversios-daterangepicker-css');

        //all conversios page css 
        if ($screen->id != "conversios-pro_page_conversios-google-analytics" && $screen->id != "conversios-pro_page_conversios-google-shopping-feed") {
          wp_enqueue_style('convsst-style-css', CONVSST_PLUGIN_URL . '/admin/css/style.css', array(), esc_attr($this->version), 'all');
        }

        //pricingcss
        if ($screen->id == "conversios-sst_page_convsst-conversios-pricing") {
          wp_enqueue_style('convsst-pricing-css', esc_url(CONVSST_PLUGIN_URL . '/admin/css/pricing/pricing.css'), array(), esc_attr($this->version), 'all');
        }

        wp_enqueue_style('convsst-responsive-css', CONVSST_PLUGIN_URL . '/admin/css/responsive.css', array(), esc_attr($this->version), 'all');
      }
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    4.1.4
     */
    public function enqueue_scripts()
    {
      $screen = get_current_screen();
      if (sanitize_text_field(wp_unslash(filter_input(INPUT_GET, 'page'))) == "conversios-analytics-reports" || sanitize_text_field(wp_unslash(filter_input(INPUT_GET, 'page'))) == "conversios-analytics-reports-old") {
        wp_enqueue_script('convsst-chart-js', esc_url_raw(CONVSST_PLUGIN_URL . '/admin/js/chart.js'));
        wp_enqueue_script('convsst-chart-datalabels-js', esc_url_raw(CONVSST_PLUGIN_URL . '/admin/js/chartjs-plugin-datalabels.js'));
        wp_enqueue_script('convsst-basictable-js', esc_url_raw(CONVSST_PLUGIN_URL . '/admin/js/jquery.basictable.min.js'));
        if (!wp_script_is('moment', 'enqueued')) {
          // Enqueue Moment.js only if it's not already enqueued
          wp_enqueue_script('convsst-moment-js', CONVSST_PLUGIN_URL . '/admin/js/moment.min.js', array(), '2.22.1', false);
        }
        wp_enqueue_script('convsst-daterangepicker-js', esc_url_raw(CONVSST_PLUGIN_URL . '/admin/js/daterangepicker.js'));
        wp_enqueue_script('convsst-custom-js', esc_url_raw(CONVSST_PLUGIN_URL . '/admin/js/tvc-ee-custom.js'), array('jquery'), esc_attr($this->version), false);
      }
    }

    /**
     * Display Admin Page.
     *
     * @since    4.1.4
     */
    public function add_admin_pages()
    {

      $google_detail = $this->google_detail;
      $plan_id = 1;
      if (isset($google_detail['setting'])) {
        $googleDetail = $google_detail['setting'];
        if (isset($googleDetail->plan_id) && !in_array($googleDetail->plan_id, array("1"))) {
          $plan_id = $googleDetail->plan_id;
        }
      }
      $icon = CONVSST_PLUGIN_URL . "/admin/images/offer.png";
      $freevspro = CONVSST_PLUGIN_URL . "/admin/images/freevspro.png";
      add_menu_page(
        '',
        esc_html__('Conversios SST', "server-side-tagging-via-google-tag-manager-for-wordpress") . '',
        'manage_options',
        CONVSST_MENU_SLUG,
        array($this, 'showPage'),
        esc_url(plugin_dir_url(__FILE__) . 'images/tatvic_logo.png'),
        26
      );

      if (!function_exists('is_plugin_active_for_network')) {
        require_once(ABSPATH . '/wp-admin/includes/woocommerce.php');
      }

      add_submenu_page(
        CONVSST_MENU_SLUG,
        esc_html__('Pixels & Analytics', "server-side-tagging-via-google-tag-manager-for-wordpress"),
        esc_html__('Pixels & Analytics', "server-side-tagging-via-google-tag-manager-for-wordpress"),
        'manage_options',
        'convsst-conversios-google-analytics',
        array($this, 'showPage'),
        1
      );

      add_submenu_page(
        CONVSST_MENU_SLUG,
        esc_html__('Reports & Insights', "server-side-tagging-via-google-tag-manager-for-wordpress"),
        esc_html__('Reports & Insights', "server-side-tagging-via-google-tag-manager-for-wordpress") . '<img style="position: absolute; height: 30px;bottom: 5px; right: 10px;" src="' . esc_url($freevspro) . '">',
        'manage_options',
        'conversios-analytics-reports',
        array($this, 'showPage'),
        5
      );

      add_submenu_page(
        CONVSST_MENU_SLUG,
        esc_html__('Free Vs Pro', "server-side-tagging-via-google-tag-manager-for-wordpress"),
        esc_html__('Free Vs Pro', "server-side-tagging-via-google-tag-manager-for-wordpress") . '<img style="position: absolute; height: 30px;bottom: 5px; right: 10px;" src="' . esc_url($freevspro) . '">',
        'manage_options',
        'convsst-conversios-pricing',
        array($this, 'showPage'),
        5
      );

      add_submenu_page(
        CONVSST_MENU_SLUG,
        esc_html__('Extensions', "server-side-tagging-via-google-tag-manager-for-wordpress"),
        esc_html__('Extensions', "server-side-tagging-via-google-tag-manager-for-wordpress") . '<img style="position: absolute; height: 30px;bottom: 5px; right: 10px;" src="' . esc_url($freevspro) . '">',
        'manage_options',
        'convsst-conversios-extensions',
        array($this, 'showPage'),
        5
      );
    }

    /**
     * Display page.
     *
     * @since    4.1.4
     */
    public function showPage()
    {
      do_action('convsst_add_header');
      if (!empty(sanitize_text_field(wp_unslash(filter_input(INPUT_GET, 'page'))))) {
        $get_action = str_replace("-", "_", sanitize_text_field(wp_unslash(filter_input(INPUT_GET, 'page'))));
      } else {
        $get_action = "convsst_conversios_google_analytics";
      }

      if (method_exists($this, $get_action)) {
        $this->$get_action();
      }
      do_action('convsst_add_footer');
    }

    public function convsst_conversios()
    {
      $is_inner_page = isset($_GET['tab']) ? sanitize_text_field(wp_unslash(filter_input(INPUT_GET, 'tab'))) : "";
      $is_inner_page = str_replace("-", "_", sanitize_text_field($is_inner_page));
      if ($is_inner_page != "") {
        $this->$is_inner_page();
      } else {
        $this->convsst_conversios_google_analytics();
      }
    }

    public function convsst_conversios_pricing()
    {
      require_once(CONVSST_PLUGIN_DIR . 'admin/partials/pricing.php');
      new CONVSST_pricing();
    }

    public function convsst_conversios_extensions()
    {
      require_once(CONVSST_PLUGIN_DIR . 'admin/partials/extensions.php');
      new CONVSST_extensions();
    }

    public function convsst_conversios_google_analytics()
    {
      $sub_page = (isset($_GET['subpage'])) ? sanitize_text_field(wp_unslash(filter_input(INPUT_GET, 'subpage'))) : "";
      if (!empty($sub_page)) {
        require_once('partials/single-pixel-settings.php');
      } else {
        require_once('partials/general-fields.php');
      }
    }

    public function conversios_analytics_reports()
    {
      $is_inner_page = isset($_GET['tab']) ? sanitize_text_field(wp_unslash(filter_input(INPUT_GET, 'tab'))) : "";
      $is_inner_page = str_replace("-", "_", sanitize_text_field($is_inner_page));
      if ($is_inner_page != "") {
        $this->$is_inner_page();
      } else {
        require_once(CONVSST_PLUGIN_DIR . 'includes/setup/class-analytics-reports.php');
      }
    }

  }
}
if (is_admin()) {
  new Convsst_Conversios_Admin();
}
