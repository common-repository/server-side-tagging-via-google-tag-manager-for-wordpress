<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * @since      4.0.2
 * Description: Conversios Onboarding page, It's call while active the plugin
 */
if (class_exists('Convsst_Conversios_Header') === FALSE) {
	class Convsst_Conversios_Header extends TVC_Admin_Helper
	{
		// Site Url.
		protected $site_url;
		// Conversios site Url.
		protected $conversios_site_url;
		// Subcription Data.
		protected $subscription_data;
		// Plan id.
		protected $plan_id = 46;
		protected $plan_name = 46;
		protected $TVC_Admin_Helper;
		protected $ee_options;

		/** Contruct for Hook */
		public function __construct()
		{
			$this->site_url = "admin.php?page=";
			$this->conversios_site_url = $this->get_conversios_site_url();
			$this->subscription_data = $this->get_user_subscription_data();
			$this->ee_options = unserialize(get_option("convsst_options"));

			add_action('convsst_add_header', [$this, 'before_start_header']);
			add_action('convsst_add_header', [$this, 'header_menu']);
		} //end __construct()


		/**
		 * before start header section
		 *
		 * @since    4.1.4
		 * @return void
		 */
		public function before_start_header()
		{
?>
			<div>
			<?php
		}

		/**
		 * header section
		 *
		 * @since    4.1.4
		 */
		public function Convsst_Conversios_Header()
		{
			$plan_name = esc_html__("Free Plan SST", "server-side-tagging-via-google-tag-manager-for-wordpress");
			?>
				<!-- header start -->
				<header class="header">
					<div class="hedertop">
						<div class="row align-items-center">
							<div class="hdrtpleft">
								<div class="brandlogo">
									<a target="_blank" href="<?php echo esc_url($this->conversios_site_url); ?>"><img src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/logo.png'); ?>" alt="" /></a>
								</div>
								<div class="hdrcntcbx">
									<?php printf("%s <span><a href=\"mailto:info@conversios.io\">info@conversios.io</a></span>", esc_html_e("For any query, contact us on", "server-side-tagging-via-google-tag-manager-for-wordpress")); ?>
								</div>
							</div>
							<div class="hdrtpright">
								<div class="hustleplanbtn">
									<a href="<?php echo esc_url($this->site_url . 'conversios-account'); ?>"><button class="cvrs-btn greenbtn">
											<?php echo esc_attr($plan_name); ?>
										</button></a>
								</div>
							</div>
							<div class="hdrcntcbx mblhdrcntcbx">
								<?php printf("%s <span><a href=\"tel:+1 (415) 968-6313\">+1 (415) 968-6313</a></span>", esc_html_e("For any query, contact us at", "server-side-tagging-via-google-tag-manager-for-wordpress")); ?>
							</div>
						</div>
					</div>
				</header>
				<!-- header end -->
				<?php
			}

			/* add active tab class */
			protected function is_active_menu($page = "")
			{
				if ($page != "" && isset($_GET['page']) && sanitize_text_field($_GET['page']) == $page) {
					return "dark";
				}
				return "secondary";
			}
			public function conversios_menu_list()
			{
				$conversios_menu_arr  = array();
				$conversios_menu_arr  = array(
					"convsst-conversios-google-analytics" => array(
						"page" => "convsst-conversios-google-analytics",
						"title" => "Pixels & Analytics"
					),
					"conversios-analytics-reports" => array(
						"page" => "conversios-analytics-reports&subpage=ga4ecommerce",
						"title" => "Reports & Insights"
					),
					"convsst-conversios-pricing" => array(
						"page" => "convsst-conversios-pricing",
						"title" => "Free vs Pro"
					),
					"convsst-conversios-extensions" => array(
						"page" => "convsst-conversios-extensions",
						"title" => "Extensions"
					),
				);
				return apply_filters('convsst_menu_list', $conversios_menu_arr, $conversios_menu_arr);
			}
			/**
			 * header menu section
			 *
			 * @since    4.1.4
			 */
			public function header_menu()
			{
				$menu_list = $this->conversios_menu_list();
				if (!empty($menu_list)) {
				?>	
					<div class="notification-bar" style="display:none">
						<img class="align-self-center me-2" src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/icon/discount.png'); ?>" />
						<span class="fs-16">
						15-Day Money-Back Guarantee. <a href="https://www.conversios.io/pricing/?utm_source=free_sstpluginadmin&utm_medium=sstnewbar&utm_campaign=free_sstdashboardscree&plugin_name=sst" target="_blank" class="text-white font-weight-bold"><b>Upgrade now</b></a> to access all Premium Features. 
						<span class="material-symbols-outlined close">close</span>
					</div>
					<header class="conv-header border-bottom bg-white mt-4">
						<div class="container-fluid col-12">
							<nav class="navbar navbar-expand-lg navbar-light ps-4" style="height:40px;">
								<div class="container-fluid">
									<a class="navbar-brand link-dark fs-16 fw-400">
										<img style="width: 150px;" src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/logo.png'); ?>" />
									</a>
									<div class="collapse navbar-collapse" id="navbarSupportedContent">
										<ul class="navbar-nav me-auto mb-lg-0">
											<?php
											foreach ($menu_list as $key => $value) {
												if (isset($value['title']) && $value['title']) {
													$is_active = $this->is_active_menu($key);
													$active = $is_active != 'secondary' ? 'rich-blue' : '';
													if( $_GET['page'] == 'convsst-conversios-google-analytics' && $key == 'convsst_conversios' ) { 
														$active = 'rich-blue';
													}
													$menu_url = "#";
													if (isset($value['page']) && $value['page'] != "#") {
														$menu_url = $this->site_url . $value['page'];
													}
													$is_parent_menu = "";
													$is_parent_menu_link = "";
													if (isset($value['sub_menus']) && !empty($value['sub_menus'])) {
														$is_parent_menu = "dropdown";
													}
											?>
													<li class="nav-item me-4 fs-14 fw-400 <?php echo esc_attr($active); ?> <?php echo esc_attr($is_parent_menu); ?>">
														<a class="px-0 nav-link text-<?php esc_attr($is_active); ?> " aria-current="page" href="<?php echo esc_url($menu_url); ?>">
															<?php echo esc_attr($value['title']); ?>
														</a>
													</li>
											<?php
												}
											} ?>
										</ul>
										<div class="d-flex">
											<?php
											$plan_name = esc_html__("Free Plan", "server-side-tagging-via-google-tag-manager-for-wordpress");
											$type = 'warning';
											if (isset($this->subscription_data->plan_name) && !in_array($this->subscription_data->plan_id, array("46"))) {
												$plan_name = $this->subscription_data->plan_name;
												$type = 'success';
											} ?>
											<button id="pluginPlanName" type="button" class="btn btn-<?php echo esc_attr($type) ?> rounded-pill fs-12 fw-400 me-4 px-2 py-0" data-bs-toggle="modal" data-bs-target="#convLicenceInfoMod"></button>
											<a href="https://wordpress.org/support/plugin/server-side-tagging-via-google-tag-manager-for-wordpress/reviews/?rate=5#rate-response" target="_blank"><span class="rate-us me-2 fs-12">Rate Us!</span>
												<img style="max-width:153px; height:20px" src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/rate-us.png'); ?>" />
											</a>
										</div>
									</div>
								</div>
							</nav>
						</div>
					</header>
				<?php
				}
			}
		}
	}
	new Convsst_Conversios_Header();
