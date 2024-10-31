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
if (!class_exists('Conversios_Reports_Helper')) {
	class Conversios_Reports_Helper
	{
		protected $ConvsstShoppingApi;
		protected $TVC_Admin_Helper;
		protected $TVC_Admin_DB_Helper;
		protected $ConvsstCustomApi;
		public function __construct()
		{
			$this->req_int();
			$this->TVC_Admin_Helper = new TVC_Admin_Helper();
			$this->TVC_Admin_DB_Helper = new TVC_Admin_DB_Helper();
			$this->ConvsstCustomApi = new ConvsstCustomApi();
			$this->ConvsstShoppingApi = new ConvsstShoppingApi();
			add_action('wp_ajax_get_google_analytics_reports', array($this, 'get_google_analytics_reports'));
			add_action('wp_ajax_get_google_ads_reports_chart', array($this, 'get_google_ads_reports_chart'));
			add_action('wp_ajax_get_google_ads_campaign_performance', array($this, 'get_google_ads_campaign_performance'));
			add_action('wp_ajax_get_ga_source_performance', array($this, 'get_ga_source_performance'));
			add_action('wp_ajax_get_ga_product_performance', array($this, 'get_ga_product_performance'));
			add_action('wp_ajax_set_email_configurationGA4', array($this, 'set_email_configurationGA4'));
			add_action('wp_ajax_get_ecomm_checkout_funnel', array($this, 'get_ecomm_checkout_funnel'));
			add_action('wp_ajax_get_google_analytics_order_performance', array($this, 'get_google_analytics_order_performance'));
			//add_action('wp_ajax_generate_ai_response', array($this, 'generate_ai_response'));
			add_action('wp_ajax_save_all_reports', array($this, 'save_all_reports'));
			add_action('wp_ajax_get_google_ads_product_performance', array($this, 'get_google_ads_product_performance'));
			add_action('wp_ajax_save_prompt_suggestions', array($this, 'save_prompt_suggestions'));
			add_action('wp_ajax_get_google_ads_grid_report', array($this, 'get_google_ads_grid_report'));
			add_action('wp_ajax_get_google_ads_search_term_report', array($this, 'get_google_ads_search_term_report'));
			add_action('wp_ajax_get_google_ads_keyword_performance_report', array($this, 'get_google_ads_keyword_performance_report'));
			//general ga4 reports
			add_action('wp_ajax_get_ga4_general_grid_reports', array($this, 'get_ga4_general_grid_reports'));
			add_action('wp_ajax_get_ga4_page_report', array($this, 'get_ga4_page_report'));
			add_action('wp_ajax_get_general_donut_reports', array($this, 'get_general_donut_reports'));
			add_action('wp_ajax_get_realtime_report', array($this, 'get_realtime_report'));	
			add_action('wp_ajax_get_general_audience_report', array($this, 'get_general_audience_report'));	
			add_action('wp_ajax_get_daily_visitors_report', array($this, 'get_daily_visitors_report'));
			add_action('wp_ajax_get_demographic_ga4_reports', array($this, 'get_demographic_ga4_reports'));
		}


		public function req_int()
		{
			if (!class_exists('ConvsstCustomApi')) {
				require_once(CONVSST_PLUGIN_DIR . 'includes/setup/ConvsstCustomApi.php');
			}
			if (!class_exists('ConvsstShoppingApi')) {
				require_once(CONVSST_PLUGIN_DIR . 'includes/setup/ConvsstShoppingApi.php');
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
		public function get_daily_visitors_report(){
			$nonce = (isset($_POST['conversios_nonce'])) ? sanitize_text_field($_POST['conversios_nonce']) : "";
			if ($this->admin_safe_ajax_call($nonce, 'conversios_nonce')) {
				$domain = isset($_POST['domain']) ? sanitize_text_field($_POST['domain']) : "";
				$start_date = str_replace(' ', '', (isset($_POST['start_date'])) ? sanitize_text_field($_POST['start_date']) : "");
				if ($start_date != "") {
					$date = DateTime::createFromFormat('d-m-Y', $start_date);
					$start_date = $date->format('Y-m-d');
				}
				$start_date == (false !== strtotime($start_date)) ? date('Y-m-d', strtotime($start_date)) : date('Y-m-d', strtotime('-1 month'));

				$end_date = str_replace(' ', '', (isset($_POST['end_date'])) ? sanitize_text_field($_POST['end_date']) : "");
				if ($end_date != "") {
					$date = DateTime::createFromFormat('d-m-Y', $end_date);
					$end_date = $date->format('Y-m-d');
				}
				$end_date == (false !== strtotime($end_date)) ? date('Y-m-d', strtotime($end_date)) : date('Y-m-d', strtotime('now'));
								
				$start_date = sanitize_text_field($start_date);
				$end_date = sanitize_text_field($end_date);
				$api_rs = $this->ConvsstShoppingApi->ga4_general_daily_visitors_report($start_date, $end_date, $domain);
				
				if (isset($api_rs->error) && $api_rs->error == '') {
					if (isset($api_rs->data) && $api_rs->data != "") {
						$return = array('error' => false, 'data' => $api_rs->data);
					}
				} else {
					$return = array('error' => true, 'errors' => isset($api_rs->message) ? $api_rs->message : '');
				}
			} else {
				$return = array('error' => true, 'errors' => esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress"));
			}
			echo json_encode($return);
			wp_die();
		}
		public function get_general_audience_report(){
			$nonce = (isset($_POST['conversios_nonce'])) ? sanitize_text_field($_POST['conversios_nonce']) : "";
			if ($this->admin_safe_ajax_call($nonce, 'conversios_nonce')) {
				$domain = isset($_POST['domain']) ? sanitize_text_field($_POST['domain']) : "";
				$start_date = str_replace(' ', '', (isset($_POST['start_date'])) ? sanitize_text_field($_POST['start_date']) : "");
				if ($start_date != "") {
					$date = DateTime::createFromFormat('d-m-Y', $start_date);
					$start_date = $date->format('Y-m-d');
				}
				$start_date == (false !== strtotime($start_date)) ? date('Y-m-d', strtotime($start_date)) : date('Y-m-d', strtotime('-1 month'));

				$end_date = str_replace(' ', '', (isset($_POST['end_date'])) ? sanitize_text_field($_POST['end_date']) : "");
				if ($end_date != "") {
					$date = DateTime::createFromFormat('d-m-Y', $end_date);
					$end_date = $date->format('Y-m-d');
				}
				$end_date == (false !== strtotime($end_date)) ? date('Y-m-d', strtotime($end_date)) : date('Y-m-d', strtotime('now'));
								
				$start_date = sanitize_text_field($start_date);
				$end_date = sanitize_text_field($end_date);
				$api_rs = $this->ConvsstShoppingApi->ga4_general_audience_report($start_date, $end_date, $domain);
				
				if (isset($api_rs->error) && $api_rs->error == '') {
					if (isset($api_rs->data) && $api_rs->data != "") {
						$return = array('error' => false, 'data' => $api_rs->data);
					}
				} else {
					$return = array('error' => true, 'errors' => isset($api_rs->message) ? $api_rs->message : '');
				}
			} else {
				$return = array('error' => true, 'errors' => esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress"));
			}
			echo json_encode($return);
			wp_die();
		}
		public function get_ga4_general_grid_reports(){
			$nonce = (isset($_POST['conversios_nonce'])) ? sanitize_text_field($_POST['conversios_nonce']) : "";
			if ($this->admin_safe_ajax_call($nonce, 'conversios_nonce')) {
				$domain = isset($_POST['domain']) ? sanitize_text_field($_POST['domain']) : "";
				$start_date = str_replace(' ', '', (isset($_POST['start_date'])) ? sanitize_text_field($_POST['start_date']) : "");
				if ($start_date != "") {
					$date = DateTime::createFromFormat('d-m-Y', $start_date);
					$start_date = $date->format('Y-m-d');
				}
				$start_date == (false !== strtotime($start_date)) ? date('Y-m-d', strtotime($start_date)) : date('Y-m-d', strtotime('-1 month'));

				$end_date = str_replace(' ', '', (isset($_POST['end_date'])) ? sanitize_text_field($_POST['end_date']) : "");
				if ($end_date != "") {
					$date = DateTime::createFromFormat('d-m-Y', $end_date);
					$end_date = $date->format('Y-m-d');
				}
				$end_date == (false !== strtotime($end_date)) ? date('Y-m-d', strtotime($end_date)) : date('Y-m-d', strtotime('now'));
								
				$start_date = sanitize_text_field($start_date);
				$end_date = sanitize_text_field($end_date);
				$datediff = isset($_POST['datediff'])?$_POST['datediff']:"44";
				$old_end_date = sanitize_text_field(date("Y-m-d", strtotime("-1 days", strtotime($start_date))));
				$old_start_date = sanitize_text_field(date("Y-m-d",strtotime("-".$datediff." days", strtotime($old_end_date))));
				
				$api_rs_present = $this->ConvsstShoppingApi->ga4_general_grid_report($start_date, $end_date, $domain);
				
				if (isset($api_rs_present->error) && $api_rs_present->error == '') {
					if (isset($api_rs_present->data) && $api_rs_present->data != "") {
						//call for past data
						$api_rs_past = $this->ConvsstShoppingApi->ga4_general_grid_report($old_start_date, $old_end_date, $domain);
						
						if (isset($api_rs_past->error) && $api_rs_past->error == '') {
							if (isset($api_rs_past->data) && $api_rs_past->data != "") {
								$return = array('error' => false, 'data_present' => $api_rs_present->data, 'data_past' => $api_rs_past->data, 'errors' => '');
							}
						}else{
							$return = array('error' => false, 'data_present' => $api_rs_present->data, 'errors' => '');
						}		
					}
				} else {
					$return = array('error' => true, 'errors' => isset($api_rs_present->message) ? $api_rs_present->message : '');
				}
			 
			} else {
				$return = array('error' => true, 'errors' => esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress"));
			}
			echo json_encode($return);
			wp_die();
	
		}
		public function get_realtime_report(){
			$nonce = (isset($_POST['conversios_nonce'])) ? sanitize_text_field($_POST['conversios_nonce']) : "";
			$domain = isset($_POST['domain']) ? sanitize_text_field($_POST['domain']) : "";
			if ($this->admin_safe_ajax_call($nonce, 'conversios_nonce') && $domain != "") {
				$api_rs = $this->ConvsstShoppingApi->ga4_realtime_report($domain);
				if (isset($api_rs->error) && $api_rs->error == '') {
					if (isset($api_rs->data)) {
						$return = array('error' => false, 'data' => $api_rs->data);
					}
				} else {
					$return = array('error' => true, 'errors' => isset($api_rs->message) ? $api_rs->message : '');
				}
			} else {
				$return = array('error' => true, 'errors' => esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress"));
			}
			echo json_encode($return);
			wp_die();
		}
		public function get_demographic_ga4_reports(){
			$nonce = (isset($_POST['conversios_nonce'])) ? sanitize_text_field($_POST['conversios_nonce']) : "";
			if ($this->admin_safe_ajax_call($nonce, 'conversios_nonce')) {
				$domain = isset($_POST['domain']) ? sanitize_text_field($_POST['domain']) : "";
				$start_date = str_replace(' ', '', (isset($_POST['start_date'])) ? sanitize_text_field($_POST['start_date']) : "");
				if ($start_date != "") {
					$date = DateTime::createFromFormat('d-m-Y', $start_date);
					$start_date = $date->format('Y-m-d');
				}
				$start_date == (false !== strtotime($start_date)) ? date('Y-m-d', strtotime($start_date)) : date('Y-m-d', strtotime('-1 month'));

				$end_date = str_replace(' ', '', (isset($_POST['end_date'])) ? sanitize_text_field($_POST['end_date']) : "");
				if ($end_date != "") {
					$date = DateTime::createFromFormat('d-m-Y', $end_date);
					$end_date = $date->format('Y-m-d');
				}
				$end_date == (false !== strtotime($end_date)) ? date('Y-m-d', strtotime($end_date)) : date('Y-m-d', strtotime('now'));
								
				$start_date = sanitize_text_field($start_date);
				$end_date = sanitize_text_field($end_date);
				$report_name = isset($_POST['report_name']) ? sanitize_text_field($_POST['report_name']) : "";
				$api_rs = $this->ConvsstShoppingApi->ga4_demographics_report($start_date, $end_date, $domain,$report_name);
				
				if (isset($api_rs->error) && $api_rs->error == '') {
					if (isset($api_rs->data) && $api_rs->data != "") {
						$return = array('error' => false, 'data' => $api_rs->data);
					}
				} else {
					$return = array('error' => true, 'errors' => isset($api_rs->message) ? $api_rs->message : '');
				}
			} else {
				$return = array('error' => true, 'errors' => esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress"));
			}
			echo json_encode($return);
			wp_die();
		}
		public function get_general_donut_reports(){
			$nonce = (isset($_POST['conversios_nonce'])) ? sanitize_text_field($_POST['conversios_nonce']) : "";
			if ($this->admin_safe_ajax_call($nonce, 'conversios_nonce')) {
				$domain = isset($_POST['domain']) ? sanitize_text_field($_POST['domain']) : "";
				$start_date = str_replace(' ', '', (isset($_POST['start_date'])) ? sanitize_text_field($_POST['start_date']) : "");
				if ($start_date != "") {
					$date = DateTime::createFromFormat('d-m-Y', $start_date);
					$start_date = $date->format('Y-m-d');
				}
				$start_date == (false !== strtotime($start_date)) ? date('Y-m-d', strtotime($start_date)) : date('Y-m-d', strtotime('-1 month'));

				$end_date = str_replace(' ', '', (isset($_POST['end_date'])) ? sanitize_text_field($_POST['end_date']) : "");
				if ($end_date != "") {
					$date = DateTime::createFromFormat('d-m-Y', $end_date);
					$end_date = $date->format('Y-m-d');
				}
				$end_date == (false !== strtotime($end_date)) ? date('Y-m-d', strtotime($end_date)) : date('Y-m-d', strtotime('now'));
								
				$start_date = sanitize_text_field($start_date);
				$end_date = sanitize_text_field($end_date);
				$report_name = isset($_POST['report_name']) ? sanitize_text_field($_POST['report_name']) : "";
				$api_rs = $this->ConvsstShoppingApi->ga4_general_donut_report($start_date, $end_date, $domain,$report_name);
				
				if (isset($api_rs->error) && $api_rs->error == '') {
					if (isset($api_rs->data) && $api_rs->data != "") {
						$return = array('error' => false, 'data' => $api_rs->data);
					}
				} else {
					$return = array('error' => true, 'errors' => isset($api_rs->message) ? $api_rs->message : '');
				}
			} else {
				$return = array('error' => true, 'errors' => esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress"));
			}
			echo json_encode($return);
			wp_die();
		}
		public function get_ga4_page_report(){
			$nonce = (isset($_POST['conversios_nonce'])) ? sanitize_text_field($_POST['conversios_nonce']) : "";
			if ($this->admin_safe_ajax_call($nonce, 'conversios_nonce')) {
				$domain = isset($_POST['domain']) ? sanitize_text_field($_POST['domain']) : "";
				$limit = isset($_POST['limit']) ? sanitize_text_field($_POST['limit']) : "10000";
				$start_date = str_replace(' ', '', (isset($_POST['start_date'])) ? sanitize_text_field($_POST['start_date']) : "");
				if ($start_date != "") {
					$date = DateTime::createFromFormat('d-m-Y', $start_date);
					$start_date = $date->format('Y-m-d');
				}
				$start_date == (false !== strtotime($start_date)) ? date('Y-m-d', strtotime($start_date)) : date('Y-m-d', strtotime('-1 month'));

				$end_date = str_replace(' ', '', (isset($_POST['end_date'])) ? sanitize_text_field($_POST['end_date']) : "");
				if ($end_date != "") {
					$date = DateTime::createFromFormat('d-m-Y', $end_date);
					$end_date = $date->format('Y-m-d');
				}
				$end_date == (false !== strtotime($end_date)) ? date('Y-m-d', strtotime($end_date)) : date('Y-m-d', strtotime('now'));
								
				$start_date = sanitize_text_field($start_date);
				$end_date = sanitize_text_field($end_date);
				
				$api_rs = $this->ConvsstShoppingApi->ga4_page_report($start_date, $end_date, $domain,$limit);
				
				if (isset($api_rs->error) && $api_rs->error == '') {
					if (isset($api_rs->data) && $api_rs->data != "") {
						$return = array('error' => false, 'data' => $api_rs->data);
					}
				} else {
					$return = array('error' => true, 'errors' => isset($api_rs->message) ? $api_rs->message : '');
				}
			 
			} else {
				$return = array('error' => true, 'errors' => esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress"));
			}
			echo json_encode($return);
			wp_die();
		}
		public function get_ecomm_checkout_funnel()
		{
			$nonce = isset($_POST['conversios_nonce']) ? sanitize_text_field($_POST['conversios_nonce']) : "";
			if ($this->admin_safe_ajax_call($nonce, 'conversios_nonce')) {
				$domain = isset($_POST['domain']) ? sanitize_text_field($_POST['domain']) : "";
				$start_date = str_replace(' ', '', (isset($_POST['start_date'])) ? sanitize_text_field($_POST['start_date']) : "");
				if ($start_date != "") {
					$date = DateTime::createFromFormat('d-m-Y', $start_date);
					$start_date = $date->format('Y-m-d');
				}
				$start_date == (false !== strtotime($start_date)) ? date('Y-m-d', strtotime($start_date)) : date('Y-m-d', strtotime('-1 month'));

				$end_date = str_replace(' ', '', (isset($_POST['end_date'])) ? sanitize_text_field($_POST['end_date']) : "");
				if ($end_date != "") {
					$date = DateTime::createFromFormat('d-m-Y', $end_date);
					$end_date = $date->format('Y-m-d');
				}
				$end_date == (false !== strtotime($end_date)) ? date('Y-m-d', strtotime($end_date)) : date('Y-m-d', strtotime('now'));

				$start_date = sanitize_text_field($start_date);
				$end_date = sanitize_text_field($end_date);
				$api_rs = $this->ConvsstShoppingApi->ecommerce_checkout_funnel($start_date, $end_date, $domain);

				if (isset($api_rs->error) && $api_rs->error == '') {
					if (isset($api_rs->data) && $api_rs->data != "") {
						echo json_encode(array('error' => false, 'data' => $api_rs->data));
					}
				} else {
					$errormsg = isset($api_rs->errors[0]) ? $api_rs->errors[0] : "";
					echo json_encode(array('error' => true, 'errors' => $errormsg,  'status' => $api_rs->status));
				}
			} else {
				echo json_encode(array('error' => true, 'errors' => esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress")));
			}
			wp_die();
		}
		public function save_all_reports()
		{
			$nonce = isset($_POST['conversios_nonce']) ? sanitize_text_field($_POST['conversios_nonce']) : "";
			if ($this->admin_safe_ajax_call($nonce, 'conversios_nonce')) {
				$subscription_id = isset($_POST['subscription_id']) ? sanitize_text_field($_POST['subscription_id']) : "";
				$ga4_analytic_account_id = isset($_POST['ga4_analytic_account_id']) ? sanitize_text_field($_POST['ga4_analytic_account_id']) : "";
				$ga4_property_id = isset($_POST['property_id']) ? sanitize_text_field($_POST['property_id']) : "";
				$measurement_id = isset($_POST['measurement_id']) ? sanitize_text_field($_POST['measurement_id']) : "";
				$start_date = date('Y-m-d', strtotime('-7 day'));
				$end_date =  date('Y-m-d');
				$domain = isset($_POST['domain']) ? sanitize_text_field($_POST['domain']) : "";
				$google_ads_id = isset($_POST['google_ads_id']) ? sanitize_text_field($_POST['google_ads_id']) : "";
				if ($subscription_id != "" && $domain != "") {
					$api_rs = $this->ConvsstShoppingApi->save_all_reports($subscription_id, $start_date, $end_date, $domain, $ga4_analytic_account_id, $ga4_property_id, $google_ads_id, $measurement_id);
					echo json_encode($api_rs);
				} else {
					echo json_encode(array('error' => true, 'errors' => esc_html__("Invalid Request.", "server-side-tagging-via-google-tag-manager-for-wordpress")));
				}
			} else {
				echo json_encode(array('error' => true, 'errors' => esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress")));
			}
			wp_die();
		}
		public function save_prompt_suggestions()
		{
			$nonce = isset($_POST['conversios_nonce']) ? sanitize_text_field($_POST['conversios_nonce']) : "";
			if ($this->admin_safe_ajax_call($nonce, 'conversios_nonce')) {
				$subscription_id = isset($_POST['subscription_id']) ? sanitize_text_field($_POST['subscription_id']) : "";			
				$suggestions = is_array($_POST['data']) ? array_map('sanitize_text_field', $_POST['data']) : sanitize_text_field($_POST['data']);
				$domain = isset($_POST['domain']) ? sanitize_text_field($_POST['domain']) : "";
				if ($subscription_id != "" && $domain != "") {
					if (!empty($suggestions)) {
						$suggestions['date'] = date('Y-m-d');
						$api_rs = $this->ConvsstShoppingApi->save_suggestions($subscription_id, $suggestions, $domain);
						echo json_encode($api_rs);
					} else {
						echo json_encode(array('error' => true, 'errors' => esc_html__("Please fill in any suggestions to be submitted.", "server-side-tagging-via-google-tag-manager-for-wordpress")));
					}
				} else {
					echo json_encode(array('error' => true, 'errors' => esc_html__("Invalid Request.", "server-side-tagging-via-google-tag-manager-for-wordpress")));
				}
			} else {
				echo json_encode(array('error' => true, 'errors' => esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress")));
			}
			wp_die();
		}
		/*public function generate_ai_response()
		{
			$nonce = isset($_POST['conversios_nonce']) ? sanitize_text_field($_POST['conversios_nonce']) : "";
			if ($this->admin_safe_ajax_call($nonce, 'conversios_nonce')) {
				$subscription_id = isset($_POST['subscription_id']) ? sanitize_text_field($_POST['subscription_id']) : "";
				$key = isset($_POST['key']) ? sanitize_text_field($_POST['key']) : "";
				$domain = isset($_POST['domain']) ? sanitize_text_field($_POST['domain']) : "";
				if ($key != "" && $domain != "" && $subscription_id != "") {
					$ai_flag = "1";
					$api_rs = $this->ConvsstShoppingApi->generate_ai_response($subscription_id, $key, $domain, $ai_flag);
					//print_r($api_rs->data); die;
					if (isset($api_rs->error) && $api_rs->error == false) {
						if (isset($api_rs->data) && !empty($api_rs->data)) {
							$allPrompts = array(
								"SourceSales25" => "source_performance_ga4",
								"SourceConv20" => "source_performance_ga4",
								"SourceProfit20" => "source_performance_ga4",
								"ProductConv15" => "product_performance_ga4",
								"Productlowperform" => "product_performance_ga4",
								"CampaignPerformImprove" => "campaign_performance",
								"OrderPerformanceAnalysis" => "OrderPerformanceAnalysis"
							);
							//save in wp database add/update query
							$InsertData = array(
								'prompt_key' => esc_sql($key),
								'ai_response' => esc_sql($api_rs->data),
								'subscription_id' => esc_sql($subscription_id),
								'report_cat' => esc_sql($allPrompts[$key]),
								'last_prompt_date' => date('Y-m-d H:i:s'),
								'updated_date' => date('Y-m-d H:i:s')
							);
							$where = "prompt_key = '" . esc_sql($key) . "'";
							$existing_record = $this->TVC_Admin_DB_Helper->tvc_check_row('ee_ai_reportdata', $where);
							if ($existing_record == "0") { //insert new
								$InsertData['created_date'] = date('Y-m-d H:i:s');
								$this->TVC_Admin_DB_Helper->tvc_add_row('ee_ai_reportdata', $InsertData);
							} else { //update existing
								$this->TVC_Admin_DB_Helper->tvc_update_row('ee_ai_reportdata', $InsertData, array('prompt_key' => $InsertData['prompt_key']));
							}
						}
					}
					//return response for display
					echo json_encode($api_rs);
				} else {
					echo json_encode(array('error' => true, 'errors' => esc_html__("Required fields missing.", "server-side-tagging-via-google-tag-manager-for-wordpress")));
				}
			} else {
				echo json_encode(array('error' => true, 'errors' => esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress")));
			}
			wp_die();
		}*/

		public function set_email_configurationGA4()
		{
			$nonce = isset($_POST['conversios_nonce']) ? sanitize_text_field($_POST['conversios_nonce']) : "";
			if ($this->admin_safe_ajax_call($nonce, 'conversios_nonce')) {
				$subscription_id = isset($_POST['subscription_id']) ? sanitize_text_field($_POST['subscription_id']) : "";
				$is_disabled = isset($_POST['is_disabled']) ? sanitize_text_field($_POST['is_disabled']) : "";
				$custom_email = isset($_POST['custom_email']) ? sanitize_text_field($_POST['custom_email']) : "";
				$email_frequency = isset($_POST['email_frequency']) ? sanitize_text_field($_POST['email_frequency']) : "";
				if (!$is_disabled) { //enabled
					if ($subscription_id != "" && $is_disabled != "" && $custom_email != "" && $email_frequency != "") {
						$api_rs = $this->ConvsstShoppingApi->set_email_configurationGA4($subscription_id, $is_disabled, $custom_email, $email_frequency);
						echo json_encode($api_rs);
					} else {
						echo json_encode(array('error' => true, 'errors' => esc_html__("Invalid required fields", "server-side-tagging-via-google-tag-manager-for-wordpress")));
					}
				} else { //disabled
					if ($subscription_id != "" && $is_disabled != "") {
						$api_rs = $this->ConvsstShoppingApi->set_email_configurationGA4($subscription_id, $is_disabled);
						echo json_encode($api_rs);
					} else {
						echo json_encode(array('error' => true, 'errors' => esc_html__("Invalid required fields", "server-side-tagging-via-google-tag-manager-for-wordpress")));
					}
				}
			} else {
				echo json_encode(array('error' => true, 'errors' => esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress")));
			}
			wp_die();
		}
		public function get_google_analytics_order_performance()
		{
			$nonce = (isset($_POST['conversios_nonce'])) ? sanitize_text_field($_POST['conversios_nonce']) : "";
      
			if ($this->admin_safe_ajax_call($nonce, 'conversios_nonce')) {
				$start_date = str_replace(' ', '', (isset($_POST['start_date'])) ? sanitize_text_field($_POST['start_date']) : "");
				if ($start_date != "") {
					$date = DateTime::createFromFormat('d-m-Y', $start_date);
					$start_date = $date->format('Y-m-d');
				}
				$start_date == (false !== strtotime($start_date)) ? date('Y-m-d', strtotime($start_date)) : date('Y-m-d', strtotime('-1 month'));

				$end_date = str_replace(' ', '', (isset($_POST['end_date'])) ? sanitize_text_field($_POST['end_date']) : "");
				if ($end_date != "") {
					$date = DateTime::createFromFormat('d-m-Y', $end_date);
					$end_date = $date->format('Y-m-d');
				}
				$end_date == (false !== strtotime($end_date)) ? date('Y-m-d', strtotime($end_date)) : date('Y-m-d', strtotime('now'));

				$start_date = sanitize_text_field($start_date);
				$end_date = sanitize_text_field($end_date);
				$domain = isset($_POST['domain'])?sanitize_text_field($_POST['domain']):"";
				$limit = isset($_POST['limit'])?sanitize_text_field($_POST['limit']):"10000000";
				$api_rs = $this->ConvsstShoppingApi->order_performance($start_date,$end_date,$limit,$domain);
				if (isset($api_rs->error) && $api_rs->error == '') {
					if (isset($api_rs->data) && $api_rs->data != "") {
						$recievedArr = array();
						$recievedArr = json_decode($api_rs->data);
						$currencyCode = isset($recievedArr->currencyCode) ? $recievedArr->currencyCode : '';
						unset($recievedArr->recordsTotal);
						unset($recievedArr->recordsFiltered);
						unset($recievedArr->currencyCode);

						$FinalArr = array('data' => (array)$recievedArr,'currencyCode' => $currencyCode, 'error' => false);
						$return = $FinalArr;
					}
				} else {
					$errormsg = isset($api_rs->errors[0]) ? $api_rs->errors[0] : "";
					echo json_encode(array('error' => true, 'errors' => $errormsg,  'status' => $api_rs->status));
				}
			} else {
				$return = array('error' => true, 'errors' => esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress"));
			}
			echo json_encode($return);
			wp_die();
		}

		public function get_ga_product_performance()
		{
			$nonce = (isset($_POST['conversios_nonce'])) ? sanitize_text_field($_POST['conversios_nonce']) : "";
			if ($this->admin_safe_ajax_call($nonce, 'conversios_nonce')) {
				$start_date = str_replace(' ', '', (isset($_POST['start_date'])) ? sanitize_text_field($_POST['start_date']) : "");
				if ($start_date != "") {
					$date = DateTime::createFromFormat('d-m-Y', $start_date);
					$start_date = $date->format('Y-m-d');
				}
				$start_date == (false !== strtotime($start_date)) ? date('Y-m-d', strtotime($start_date)) : date('Y-m-d', strtotime('-1 month'));

				$end_date = str_replace(' ', '', (isset($_POST['end_date'])) ? sanitize_text_field($_POST['end_date']) : "");
				if ($end_date != "") {
					$date = DateTime::createFromFormat('d-m-Y', $end_date);
					$end_date = $date->format('Y-m-d');
				}
				$end_date == (false !== strtotime($end_date)) ? date('Y-m-d', strtotime($end_date)) : date('Y-m-d', strtotime('now'));

				$start_date = sanitize_text_field($start_date);
				$end_date = sanitize_text_field($end_date);
				$api_rs = $this->ConvsstShoppingApi->product_performance($start_date,$end_date);
				if (isset($api_rs->error) && $api_rs->error == '') {
					if (isset($api_rs->data) && $api_rs->data != "") {
						$recievedArr = array();
						$recievedArr = json_decode($api_rs->data);
						$currencyCode = $recievedArr->currencyCode;
						unset($recievedArr->recordsTotal);
						unset($recievedArr->recordsFiltered);
						unset($recievedArr->currencyCode);

						$FinalArr = array('data' => (array)$recievedArr,'currencyCode' => $currencyCode, 'error' => false);
						$return = $FinalArr;
					}
				} else {
					$errormsg = isset($api_rs->errors[0]) ? $api_rs->errors[0] : "";
					echo json_encode(array('error' => true, 'errors' => $errormsg,  'status' => $api_rs->status));
				}
			} else {
				$return = array('error' => true, 'errors' => esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress"));
			}
			echo json_encode($return);
			wp_die();
		}
		public function get_ga_source_performance()
		{
			$nonce = (isset($_POST['conversios_nonce'])) ? sanitize_text_field($_POST['conversios_nonce']) : "";
			if ($this->admin_safe_ajax_call($nonce, 'conversios_nonce')) {
				$start_date = str_replace(' ', '', (isset($_POST['start_date'])) ? sanitize_text_field($_POST['start_date']) : "");
				if ($start_date != "") {
					$date = DateTime::createFromFormat('d-m-Y', $start_date);
					$start_date = $date->format('Y-m-d');
				}
				$start_date == (false !== strtotime($start_date)) ? date('Y-m-d', strtotime($start_date)) : date('Y-m-d', strtotime('-1 month'));

				$end_date = str_replace(' ', '', (isset($_POST['end_date'])) ? sanitize_text_field($_POST['end_date']) : "");
				if ($end_date != "") {
					$date = DateTime::createFromFormat('d-m-Y', $end_date);
					$end_date = $date->format('Y-m-d');
				}
				$end_date == (false !== strtotime($end_date)) ? date('Y-m-d', strtotime($end_date)) : date('Y-m-d', strtotime('now'));

				$start_date = sanitize_text_field($start_date);
				$end_date = sanitize_text_field($end_date);
				$api_rs = $this->ConvsstShoppingApi->source_performance(2, 7, $start_date, $end_date);
				if (isset($api_rs->error) && $api_rs->error == '') {
					if (isset($api_rs->data) && $api_rs->data != "") {
						$return = array('error' => false, 'data' => $api_rs->data);
					}
				} else {
					$errormsg = isset($api_rs->errors[0]) ? $api_rs->errors[0] : "";
					$return = array('error' => true, 'errors' => $errormsg,  'status' => $api_rs->status);
				}
			} else {
				$return = array('error' => true, 'errors' => esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress"));
			}
			echo json_encode($return);
			wp_die();
		}
		public function get_google_ads_campaign_performance()
		{
			$nonce = (isset($_POST['conversios_nonce'])) ? sanitize_text_field($_POST['conversios_nonce']) : "";
			if ($this->admin_safe_ajax_call($nonce, 'conversios_nonce')) {
				$start_date = str_replace(' ', '', (isset($_POST['start_date'])) ? sanitize_text_field($_POST['start_date']) : "");
				if ($start_date != "") {
					$date = DateTime::createFromFormat('d-m-Y', $start_date);
					$start_date = $date->format('Y-m-d');
				}
				$start_date == (false !== strtotime($start_date)) ? date('Y-m-d', strtotime($start_date)) : date('Y-m-d', strtotime('-1 month'));
				$end_date = str_replace(' ', '', (isset($_POST['end_date'])) ? sanitize_text_field($_POST['end_date']) : "");
				if ($end_date != "") {
					$date = DateTime::createFromFormat('d-m-Y', $end_date);
					$end_date = $date->format('Y-m-d');
				}
				$end_date == (false !== strtotime($end_date)) ? date('Y-m-d', strtotime($end_date)) : date('Y-m-d', strtotime('now'));

				$start_date = sanitize_text_field($start_date);
				$end_date = sanitize_text_field($end_date);
				$limit = (isset($_POST['limit'])) ? sanitize_text_field($_POST['limit']) : "";
				if ($limit != "") {
					$api_rs = $this->ConvsstShoppingApi->campaign_performance(2, 7, $start_date, $end_date, $limit);
				} else {
					$api_rs = $this->ConvsstShoppingApi->campaign_performance(2, 7, $start_date, $end_date);
				}
				if (isset($api_rs->error) && $api_rs->error == '') {
					if (isset($api_rs->data) && $api_rs->data != "") {
						$return = array('error' => false, 'data' => $api_rs->data);
					}
				} else {
					$errormsg = isset($api_rs->errors[0]) ? $api_rs->errors[0] : "";
					$return = array('error' => true, 'errors' => $errormsg,  'status' => $api_rs->status);
				}
			} else {
				$return = array('error' => true, 'errors' => esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress"));
			}
			echo json_encode($return);
			wp_die();
		}
		public function get_google_ads_search_term_report()
		{
			$nonce = (isset($_POST['conversios_nonce'])) ? sanitize_text_field($_POST['conversios_nonce']) : "";
			if ($this->admin_safe_ajax_call($nonce, 'conversios_nonce')) {
				$start_date = str_replace(' ', '', (isset($_POST['start_date'])) ? sanitize_text_field($_POST['start_date']) : "");
				if ($start_date != "") {
					$date = DateTime::createFromFormat('d-m-Y', $start_date);
					$start_date = $date->format('Y-m-d');
				}
				$start_date == (false !== strtotime($start_date)) ? date('Y-m-d', strtotime($start_date)) : date('Y-m-d', strtotime('-1 month'));
				$end_date = str_replace(' ', '', (isset($_POST['end_date'])) ? sanitize_text_field($_POST['end_date']) : "");
				if ($end_date != "") {
					$date = DateTime::createFromFormat('d-m-Y', $end_date);
					$end_date = $date->format('Y-m-d');
				}
				$end_date == (false !== strtotime($end_date)) ? date('Y-m-d', strtotime($end_date)) : date('Y-m-d', strtotime('now'));

				$start_date = sanitize_text_field($start_date);
				$end_date = sanitize_text_field($end_date);
				$limit = (isset($_POST['limit'])) ? sanitize_text_field($_POST['limit']) : "";
				if ($limit != "") {
					$api_rs = $this->ConvsstShoppingApi->search_term_report(2, 7, $start_date, $end_date, $limit);
				} else {
					$api_rs = $this->ConvsstShoppingApi->search_term_report(2, 7, $start_date, $end_date);
				}
				if (isset($api_rs->error) && $api_rs->error == '') {
					if (isset($api_rs->data) && $api_rs->data != "") {
						$return = array('error' => false, 'data' => $api_rs->data);
					}
				} else {
					$errormsg = isset($api_rs->errors[0]) ? $api_rs->errors[0] : "";
					$return = array('error' => true, 'errors' => $errormsg,  'status' => $api_rs->status);
				}
			} else {
				$return = array('error' => true, 'errors' => esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress"));
			}
			echo json_encode($return);
			wp_die();
		}
		public function get_google_ads_keyword_performance_report()
		{
			$nonce = (isset($_POST['conversios_nonce'])) ? sanitize_text_field($_POST['conversios_nonce']) : "";
			if ($this->admin_safe_ajax_call($nonce, 'conversios_nonce')) {
				$start_date = str_replace(' ', '', (isset($_POST['start_date'])) ? sanitize_text_field($_POST['start_date']) : "");
				if ($start_date != "") {
					$date = DateTime::createFromFormat('d-m-Y', $start_date);
					$start_date = $date->format('Y-m-d');
				}
				$start_date == (false !== strtotime($start_date)) ? date('Y-m-d', strtotime($start_date)) : date('Y-m-d', strtotime('-1 month'));
				$end_date = str_replace(' ', '', (isset($_POST['end_date'])) ? sanitize_text_field($_POST['end_date']) : "");
				if ($end_date != "") {
					$date = DateTime::createFromFormat('d-m-Y', $end_date);
					$end_date = $date->format('Y-m-d');
				}
				$end_date == (false !== strtotime($end_date)) ? date('Y-m-d', strtotime($end_date)) : date('Y-m-d', strtotime('now'));

				$start_date = sanitize_text_field($start_date);
				$end_date = sanitize_text_field($end_date);
				$limit = (isset($_POST['limit'])) ? sanitize_text_field($_POST['limit']) : "";
				if ($limit != "") {
					$api_rs = $this->ConvsstShoppingApi->keyword_performance(2, 7, $start_date, $end_date, $limit);
				} else {
					$api_rs = $this->ConvsstShoppingApi->keyword_performance(2, 7, $start_date, $end_date);
				}
				if (isset($api_rs->error) && $api_rs->error == '') {
					if (isset($api_rs->data) && $api_rs->data != "") {
						$return = array('error' => false, 'data' => $api_rs->data);
					}
				} else {
					$errormsg = isset($api_rs->errors[0]) ? $api_rs->errors[0] : "";
					$return = array('error' => true, 'errors' => $errormsg,  'status' => $api_rs->status);
				}
			} else {
				$return = array('error' => true, 'errors' => esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress"));
			}
			echo json_encode($return);
			wp_die();
		}
		public function get_google_ads_product_performance()
		{
			$nonce = (isset($_POST['conversios_nonce'])) ? sanitize_text_field($_POST['conversios_nonce']) : "";
			if ($this->admin_safe_ajax_call($nonce, 'conversios_nonce')) {
				$start_date = str_replace(' ', '', (isset($_POST['start_date'])) ? sanitize_text_field($_POST['start_date']) : "");
				if ($start_date != "") {
					$date = DateTime::createFromFormat('d-m-Y', $start_date);
					$start_date = $date->format('Y-m-d');
				}
				$start_date == (false !== strtotime($start_date)) ? date('Y-m-d', strtotime($start_date)) : date('Y-m-d', strtotime('-1 month'));
				$end_date = str_replace(' ', '', (isset($_POST['end_date'])) ? sanitize_text_field($_POST['end_date']) : "");
				if ($end_date != "") {
					$date = DateTime::createFromFormat('d-m-Y', $end_date);
					$end_date = $date->format('Y-m-d');
				}
				$end_date == (false !== strtotime($end_date)) ? date('Y-m-d', strtotime($end_date)) : date('Y-m-d', strtotime('now'));

				$start_date = sanitize_text_field($start_date);
				$end_date = sanitize_text_field($end_date);
				$limit = (isset($_POST['limit'])) ? sanitize_text_field($_POST['limit']) : "";
				$google_ads_id = (isset($_POST['google_ads_id'])) ? sanitize_text_field($_POST['google_ads_id']) : "";
				$campaign_id = (isset($_POST['campaign_id'])) ? sanitize_text_field($_POST['campaign_id']) : "";
				if ($start_date != "" && $end_date != "" && $google_ads_id != "" && $campaign_id != "") {
					$api_rs = $this->ConvsstShoppingApi->ads_product_performance($start_date, $end_date, $google_ads_id, $campaign_id, $limit);
					if (isset($api_rs->error) && $api_rs->error == '') {
						if (isset($api_rs->data) && $api_rs->data != "") {
							$return = array('error' => false, 'data' => $api_rs->data);
						}
					} else {
						$errormsg = isset($api_rs->errors[0]) ? $api_rs->errors[0] : "";
						$return = array('error' => true, 'errors' => $errormsg,  'status' => $api_rs->status);
					}
				} else {
					$return = array('error' => true, 'errors' => esc_html__("Required fields missing.", "server-side-tagging-via-google-tag-manager-for-wordpress"));
				}
			} else {
				$return = array('error' => true, 'errors' => esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress"));
			}
			echo json_encode($return);
			wp_die();
		}
		public function get_google_ads_reports_chart()
		{
			$nonce = (isset($_POST['conversios_nonce'])) ? sanitize_text_field($_POST['conversios_nonce']) : "";
			if ($this->admin_safe_ajax_call($nonce, 'conversios_nonce')) {
				$start_date = str_replace(' ', '', (isset($_POST['start_date'])) ? sanitize_text_field($_POST['start_date']) : "");
				if ($start_date != "") {
					$date = DateTime::createFromFormat('d-m-Y', $start_date);
					$start_date = $date->format('Y-m-d');
				}
				$start_date == (false !== strtotime($start_date)) ? date('Y-m-d', strtotime($start_date)) : date('Y-m-d', strtotime('-1 month'));

				$end_date = str_replace(' ', '', (isset($_POST['end_date'])) ? sanitize_text_field($_POST['end_date']) : "");
				if ($end_date != "") {
					$date = DateTime::createFromFormat('d-m-Y', $end_date);
					$end_date = $date->format('Y-m-d');
				}
				$end_date == (false !== strtotime($end_date)) ? date('Y-m-d', strtotime($end_date)) : date('Y-m-d', strtotime('now'));
				$start_date = sanitize_text_field($start_date);
				$end_date = sanitize_text_field($end_date);
				$api_rs = $this->ConvsstShoppingApi->accountPerformance_for_dashboard($start_date, $end_date);
				if (isset($api_rs->error) && $api_rs->error == '') {
					if (isset($api_rs->data) && $api_rs->data != "") {
						$return = array('error' => false, 'data' => $api_rs->data);
					}
				} else {
					$errormsg = isset($api_rs->errors->error) ? $api_rs->errors->message : "";
					$return = array('error' => true, 'errors' => $errormsg, 'status' => $api_rs->status);
				}
			} else {
				$return = array('error' => true, 'errors' => esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress"));
			}
			echo json_encode($return);
			wp_die();
		}
		public function get_google_analytics_reports()
		{
			$nonce = (isset($_POST['conversios_nonce'])) ? sanitize_text_field($_POST['conversios_nonce']) : "";
			if ($this->admin_safe_ajax_call($nonce, 'conversios_nonce')) {
				$post_data = (object)$_POST;
				$subscription_id = sanitize_text_field(isset($post_data->subscription_id) ? $post_data->subscription_id : "");
				$start_date = str_replace(' ', '', (isset($_POST['start_date'])) ? sanitize_text_field($_POST['start_date']) : "");
				if ($start_date != "") {
					$date = DateTime::createFromFormat('d-m-Y', $start_date);
					$start_date = $date->format('Y-m-d');
				}
				$start_date == (false !== strtotime($start_date)) ? date('Y-m-d', strtotime($start_date)) : date('Y-m-d', strtotime('-1 month'));

				$end_date = str_replace(' ', '', (isset($_POST['end_date'])) ? sanitize_text_field($_POST['end_date']) : "");
				if ($end_date != "") {
					$date = DateTime::createFromFormat('d-m-Y', $end_date);
					$end_date = $date->format('Y-m-d');
				}
				$end_date == (false !== strtotime($end_date)) ? date('Y-m-d', strtotime($end_date)) : date('Y-m-d', strtotime('now'));
				$start_date = sanitize_text_field($start_date);
				$end_date = sanitize_text_field($end_date);
				$return = array();
				if ($subscription_id != "") {
					$api_rs = "";
					$data = array(
						'subscription_id' => sanitize_text_field($subscription_id),
						'start_date' => $start_date,
						'end_date' => $end_date
					);

					$api_rs = $this->ConvsstCustomApi->get_google_analytics_reports_ga4($data);
					if (isset($api_rs->error) && $api_rs->error == '') {
						if (isset($api_rs->data) && $api_rs->data != "") {
							$return = array('error' => false, 'data' => $api_rs->data, 'errors' => '');
						}
					} else {
						$return = array('error' => true, 'errors' => isset($api_rs->message) ? $api_rs->message : '');
					}
				} else {
					$return = array('error' => true, 'errors' => esc_html__("Subscription id is null.", "server-side-tagging-via-google-tag-manager-for-wordpress"));
				}
			} else {
				$return = array('error' => true, 'errors' => esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress"));
			}
			echo json_encode($return);
			wp_die();
		}

		public function get_google_ads_grid_report(){
			$nonce = (isset($_POST['conversios_nonce'])) ? sanitize_text_field($_POST['conversios_nonce']) : "";
			if ($this->admin_safe_ajax_call($nonce, 'conversios_nonce')) {
				$subscription_id = isset($_POST['subscription_id']) ? sanitize_text_field($_POST['subscription_id']) : "";
				$google_ads_id = isset($_POST['google_ads_id']) ? sanitize_text_field($_POST['google_ads_id']) : "";
				if ($subscription_id != "" && $google_ads_id != "") {
				$start_date = str_replace(' ', '', (isset($_POST['start_date'])) ? sanitize_text_field($_POST['start_date']) : "");
				if ($start_date != "") {
					$date = DateTime::createFromFormat('d-m-Y', $start_date);
					$start_date = $date->format('Y-m-d');
				}
				$start_date == (false !== strtotime($start_date)) ? date('Y-m-d', strtotime($start_date)) : date('Y-m-d', strtotime('-1 month'));

				$end_date = str_replace(' ', '', (isset($_POST['end_date'])) ? sanitize_text_field($_POST['end_date']) : "");
				if ($end_date != "") {
					$date = DateTime::createFromFormat('d-m-Y', $end_date);
					$end_date = $date->format('Y-m-d');
				}
				$end_date == (false !== strtotime($end_date)) ? date('Y-m-d', strtotime($end_date)) : date('Y-m-d', strtotime('now'));
								
				$start_date = sanitize_text_field($start_date);
				$end_date = sanitize_text_field($end_date);
				$datediff = isset($_POST['datediff'])?$_POST['datediff']:"44";
				$old_end_date = sanitize_text_field(date("Y-m-d", strtotime("-1 days", strtotime($start_date))));
				$old_start_date = sanitize_text_field(date("Y-m-d",strtotime("-".$datediff." days", strtotime($old_end_date))));
				
				$data = array(
					'customer_id' => $google_ads_id,
					'from_date' => $start_date,
					'to_date' => $end_date,
					'subscription_id' => $subscription_id,
					'graph_type' => 'day',
    				'date_range_type' => '2'
				);
				$api_rs_present = $this->ConvsstShoppingApi->get_google_ads_grid_report($data);
				
				if (isset($api_rs_present->error) && $api_rs_present->error == '') {
					if (isset($api_rs_present->data) && $api_rs_present->data != "") {
						//call for past data
						$data['from_date']=$old_start_date;
						$data['to_date']=$old_end_date;
						$api_rs_past = $this->ConvsstShoppingApi->get_google_ads_grid_report($data);
						
						if (isset($api_rs_past->error) && $api_rs_past->error == '') {
							if (isset($api_rs_past->data) && $api_rs_past->data != "") {
								$return = array('error' => false, 'data_present' => $api_rs_present->data, 'data_past' => $api_rs_past->data, 'errors' => '');
							}
						}else{
							$return = array('error' => false, 'data_present' => $api_rs_present->data, 'errors' => '');
						}		
					}
				} else {
					$return = array('error' => true, 'errors' => isset($api_rs_present->message) ? $api_rs_present->message : '');
				}
			 }else{
				$return = array('error' => true, 'errors' => esc_html__("Subscription id or Google Ads id is null.", "server-side-tagging-via-google-tag-manager-for-wordpress"));
			 }
			} else {
				$return = array('error' => true, 'errors' => esc_html__("Admin security nonce is not verified.", "server-side-tagging-via-google-tag-manager-for-wordpress"));
			}
			echo json_encode($return);
			wp_die();
	
		}
	}
}
new Conversios_Reports_Helper();
