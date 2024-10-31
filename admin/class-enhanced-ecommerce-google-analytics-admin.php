<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       tatvic.com
 * @since      1.0.0
 *
 * @package    Convsst_Ecommerce_Google_Analytics
 * @subpackage Convsst_Ecommerce_Google_Analytics/admin
 * @author     Tatvic
 */

if (!defined('ABSPATH')) {
  exit;
}
require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-base.php';
require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-direct.php';

class Convsst_Ecommerce_Google_Analytics_Admin extends TVC_Admin_Helper
{

  /**
   * The ID of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $plugin_name    The ID of this plugin.
   */
  private $plugin_name;

  /**
   * The version of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $version    The current version of this plugin.
   */
  private $version;

  /**
   * Initialize the class and set its properties.
   *
   * @since      1.0.0
   * @param      string    $plugin_name       The name of this plugin.
   * @param      string    $version    The version of this plugin.
   */
  protected $ga_id;
  protected $ga_LC;
  protected $ga_eeT;
  protected $site_url;
  protected $pro_plan_site;
  protected $google_detail;
  public function __construct($plugin_name, $version)
  {
    $this->plugin_name = $plugin_name;
    $this->version = $version;
    $this->google_detail = $this->get_ee_options_data();
  }

  /**
   * Register the stylesheets for the admin area.
   *
   * @since    1.0.0
   */
  public function enqueue_styles()
  {
    $screen = get_current_screen();
    if ($screen->id == 'toplevel_page_convsst_conversios' || 
    (isset($_GET['page']) && strpos(sanitize_text_field($_GET['page']), 'conversios') !== false) ||
    (isset($_GET['page']) && strpos(sanitize_text_field($_GET['page']), 'convsst') !== false)
    ) {
      if (sanitize_text_field($_GET['page']) == "conversios_onboarding") {
        return;
      }
      if (is_rtl()) {
        wp_register_style('convsst-bootstrap', CONVSST_PLUGIN_URL . '/includes/setup/plugins/bootstrap/css/bootstrap.rtl.min.css');
      } else {
        wp_register_style('convsst-bootstrap', CONVSST_PLUGIN_URL . '/includes/setup/plugins/bootstrap/css/bootstrap.min.css');
      }
      wp_enqueue_style('convsst-bootstrap');
      wp_register_style('convsst-header', CONVSST_PLUGIN_URL . '/admin/css/header.css', array(), esc_attr($this->version), 'all');
      wp_enqueue_style('convsst-header');
      
      wp_enqueue_style('convsst-uiuxcss', CONVSST_PLUGIN_URL . '/admin/css/uiux.css', array(), esc_attr($this->version), 'all');
      wp_register_style('convsst-select2', CONVSST_PLUGIN_URL . '/admin/css/select2.css');
      wp_enqueue_style('convsst-select2');
      wp_register_style('convsst-sweetalert2', CONVSST_PLUGIN_URL . '/admin/css/sweetalert2.min.css');
      wp_enqueue_style('convsst-sweetalert2');
    }
  }

  /**
   * Register the JavaScript for the admin area.
   *
   * @since    1.0.0
   */
  public function enqueue_scripts()
  {
    $screen = get_current_screen();
    if ($screen->id == 'toplevel_page_convsst_conversios'  || 
       (isset($_GET['page']) && strpos(sanitize_text_field($_GET['page']), 'conversios') !== false) ||
       (isset($_GET['page']) && strpos(sanitize_text_field($_GET['page']), 'convsst') !== false)
    ) {
      if (sanitize_text_field($_GET['page']) == "conversios_onboarding") {
        return;
      }
      wp_register_script('convsst-popper-bootstrap', CONVSST_PLUGIN_URL . '/includes/setup/plugins/bootstrap/js/popper.min.js');
      wp_enqueue_script('convsst-popper-bootstrap');
      wp_register_script('convsst-atvc-bootstrap', CONVSST_PLUGIN_URL . '/includes/setup/plugins/bootstrap/js/bootstrap.min.js');
      wp_enqueue_script('convsst-atvc-bootstrap');
      wp_register_script('convsst-select2', CONVSST_PLUGIN_URL . '/admin/js/select2.min.js', array(), '4.0.13', false);
      wp_enqueue_script('convsst-select2');
      wp_enqueue_script('convsst-sweetalert', CONVSST_PLUGIN_URL . '/admin/js/sweetalert2.11.js');

      wp_register_script('convsst-admin', CONVSST_PLUGIN_URL . '/admin/js/sst-admin.js', array(), NULL, true);
      wp_enqueue_script('convsst-admin');
    }
  }

  public function add_custom_js_to_admin_header() {
    ?>
    <script type="text/javascript">
        var tvc_ajax_url = '<?php echo esc_url_raw(admin_url('admin-ajax.php')); ?>';
    </script>
    <?php
  }
}
