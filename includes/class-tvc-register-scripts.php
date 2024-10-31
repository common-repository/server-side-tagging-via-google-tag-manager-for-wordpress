<?php
/**
 * TVC Register Scripts Class.
 *
 * @package TVC Product Feed Manager/Classes
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if ( ! class_exists( 'CONVSST_Register_Scripts' ) ) :
  /**
   * Register Scripts Class
   */
  class CONVSST_Register_Scripts {
    public function __construct() {    
        // only load the next hooks when on the Settings page
      if ( isset($_GET['page']) && strpos(sanitize_text_field($_GET['page']), 'conversios') !== false) {
        add_action( 'admin_enqueue_scripts', array( $this, 'tvc_register_required_options_page_scripts' ) );
      }
    } 
    
    /**
     * Registers all required java scripts for the feed manager Settings page.
     */
    public function tvc_register_required_options_page_scripts() {
      // enqueue notice handling script
      wp_add_inline_script('convsst-admin',"var tvc_ajax_url = '". esc_js(admin_url( 'admin-ajax.php' )) ."';");
    }
  }
// End of CONVSST_Register_Scripts class
endif;
$my_ajax_registration_class = new CONVSST_Register_Scripts();
?>