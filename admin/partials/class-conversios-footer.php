<?php

/**
 * @since      4.0.2
 * Description: Conversios Onboarding page, It's call while active the plugin
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if (!class_exists('Convsst_Conversios_Footer')) {
	class Convsst_Conversios_Footer
	{
		protected $TVC_Admin_Helper;
		protected $customApiObj;
		protected $ee_options;
		public function __construct()
		{
			add_action('convsst_add_footer', array($this, 'before_end_footer'));
			add_action('convsst_add_footer', array($this, 'before_end_footer_add_script'));
			$this->TVC_Admin_Helper = new TVC_Admin_Helper();
			$this->customApiObj = new ConvsstCustomApi();
			$this->ee_options = unserialize(get_option("convsst_options"));
		}
		public function before_end_footer()
		{
			$googledetails_arr = $this->customApiObj->getGoogleAnalyticDetail($this->ee_options['subscription_id']);
			$googledetails = (array)$googledetails_arr->data;

			/*if ($googledetails['plan_id'] != 46) {
				$licenceInfoArr = array(
					"Plan Type:" => isset($googledetails['plan_name']) && $googledetails['plan_name'] != "" ? $googledetails['plan_name'] : "Not Available",
					"Plan Price:" => isset($googledetails['price']) && $googledetails['price'] != "" ? "$" . $googledetails['price'] : "Not Available",
					"Active License Key:" => isset($googledetails['licence_key']) && $googledetails['licence_key'] != "" ? $googledetails['licence_key'] : "Not Available",
					"Subscription ID:" => isset($googledetails['id']) && $googledetails['id'] != "" ? $googledetails['id'] : "Not Available",
					"Last Bill Date:" => isset($googledetails['subscription_update_date']) && $googledetails['subscription_update_date'] != "" ? $googledetails['subscription_update_date'] : "Not Available",
					"Next Bill Date:" => isset($googledetails['subscription_expiry_date']) && $googledetails['subscription_expiry_date'] != "" ? $googledetails['subscription_expiry_date'] : "Not Available",
				);
			} else {
				$licenceInfoArr = array(
					"Plan Type:" => "Not Available",
					"Plan Price:" => "Not Available",
					"Active License Key:" => "Not Available",
					"Subscription ID:" => "Not Available",
					"Last Bill Date:" => "Not Available",
					"Next Bill Date:" => "Not Available",
				);
			}*/
?>
			<div class="tvc_footer_links">
				<input type="hidden" id="getPlanId" value="<?php echo esc_attr($googledetails['plan_id']) ?>">
				<input type="hidden" id="getPlanName" value="<?php echo esc_attr($googledetails['plan_name']) ?>">
			</div>
			<div class="modal fade" id="convLicenceInfoMod" tabindex="-1" aria-labelledby="convLicenceInfoModLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg modal-dialog-centered" style="width: 700px;">
					<div class="modal-content">
						<div class="modal-header badge-dark-blue-bg text-white">
							<h5 class="modal-title text-white" id="convLicenceInfoModLabel">
								<?php esc_html_e("My Subscription", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
							</h5>
							<button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="container-fluid">
								<div class="row">
									<?php
									$licenceInfoArr = array(
										"Plan Type:" => "Free",
									);
									?>
									<?php foreach ($licenceInfoArr as $key => $value) { ?>
										<div class="<?php echo $key == "Connected with:" ? "col-md-12" : "col-md-6"; ?> py-2 px-0">
										<span class="fw-bold">
                                                <?php
                                                printf(
                                                    esc_html__('%s', 'server-side-tagging-via-google-tag-manager-for-wordpress'),
                                                    esc_html($key)
                                                );
                                                ?>
                                            </span>
                                            <span class="ps-2">
                                                <?php
                                                printf(
                                                    esc_html__('%s', 'server-side-tagging-via-google-tag-manager-for-wordpress'),
                                                    esc_html($value)
                                                );
                                                ?>
                                            </span>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>

						<div class="modal-footer justify-content-center">
							<div class="fs-6">
								<span><?php esc_html_e("You are currently using our free plugin, no license needed! Happy Analyzing.", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?></span>
								<span><?php esc_html_e("To unlock more features of Google Products ", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?></span>
								<?php echo wp_kses_post($this->TVC_Admin_Helper->get_convsst_pro_link_adv("planpopup", "globalheader", "conv-link-blue", "anchor", "Upgrade to Pro Version")); ?>
							</div>
						</div>

					</div>
				</div>
			</div>

			<!-- Upgrade to PRO modal -->
            <div class="modal fade" id="upgradetopromodal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-dialog">
                        <div class="modal-content p-4">
                            <div class="modal-header border-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img class="m-auto d-block" src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/uptopro_2024.png'); ?>">
                                <h4 id="conuptppro_text" class="pt-4"></h4>
                            </div>
                            <div class="modal-footer border-0 justify-content-center pt-0">
                                <div class="col-6 m-0 p-2">
                                    <a target="_blank" id="conuptppro_elink" href="<?php echo esc_url_raw('https://www.conversios.io/pricing/?plugin_name=sst'); ?>" class="btn btn-outline-dark w-100">
                                        <?php esc_html_e("Explore More Features", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                                    </a>
                                </div>
                                <div class="col-6 m-0 p-2">
                                    <a target="_blank" id="conuptppro_ulink" href="<?php echo esc_url_raw('https://www.conversios.io/pricing/?plugin_name=sst'); ?>" class="btn btn-success w-100">
                                        <?php esc_html_e("Upgrade Now & Get 50% Off", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Upgrade to PRO modal End -->
		<?php
		}

		public function before_end_footer_add_script()
		{
			$TVC_Admin_Helper = new TVC_Admin_Helper();
			$subscriptionId =  sanitize_text_field($TVC_Admin_Helper->get_subscriptionId());

			$_page = isset($_GET['page']) ? esc_js( sanitize_text_field($_GET['page']) ) : '';
			wp_add_inline_script( 'convsst-admin',"
jQuery(document).ready(function() {
	var type = 'warning';
	var plan_name = 'Free Plan';
	var plan_id = jQuery('#getPlanId').val();
	jQuery('#pluginPlanName').html(plan_name).addClass('btn-' + type);

	var screen_name = '". esc_js($_page) . "';
	var error_msg = 'null';
	jQuery('.navinfotopnav ul li a').click(function() {
		var slug = jQuery(this).find('span').text();
		var menu = jQuery(this).attr('href');
		str_menu = slug.replace(/\s+/g, '_').toLowerCase();
		user_tracking_data('click', error_msg, screen_name, 'topmenu_' + str_menu);
	});
	// Open UpgradetoPro Popup
	jQuery('.upgradetopro_badge').click(function() {
		var popupopener = jQuery(this).attr('popupopener');
		var propopup_text_arr = {
			ga4apisecret_box: 'Automatically track refund orders and gain insights into frequently returned products and total refund value.',
			ga4apisecret_box_inner: 'Automatically track refund orders and gain insights into frequently returned products and total refund value.',
			fbcapi: 'You can boost event matching, data accuracy, privacy compliance, and ad performance with Facebook Conversion API.',
			fbcapi_inner: 'You can boost event matching, data accuracy, privacy compliance, and ad performance with Facebook Conversion API.',
			snapcapi: 'You can boost event matching, data accuracy, privacy compliance, and ad performance with Snapchat Conversion API.',
			snapcapi_inner: 'You can boost event matching, data accuracy, privacy compliance, and ad performance with Snapchat Conversion API.',
			tiktokcapi: 'You can boost event matching, data accuracy, privacy compliance, and ad performance with Tiktok Events API.',
			tiktokcapi_inner: 'You can boost event matching, data accuracy, privacy compliance, and ad performance with Tiktok Events API.',
			gtmpro: 'Create all GTM tags and triggers for e-commerce events in your GTM container with just a single click. No manual setup needed.',
			gtmpro_inner: 'Create all GTM tags and triggers for e-commerce events in your GTM container with just a single click. No manual setup needed.',
			gadseec: 'Build Audience & improve the accuracy of your conversion with Google Ads Conversion & Enhance Conversion Tracking',
			gadseec_inner: 'Build Audience & improve the accuracy of your conversion with Google Ads Conversion & Enhance Conversion Tracking',
			ereports: 'Access enhanced ecommerce reports from Google Analytics and Google Ads, including historical data.'
		};

		var propopup_elink_arr = {
			ga4apisecret_box: 'https://www.conversios.io/pricing/?utm_source=sstfree_plugin&utm_medium=onboarding&utm_campaign=ga4apikey&plugin_name=sst',
			fbcapi: 'https://www.conversios.io/pricing/?utm_source=sstfree_plugin&utm_medium=onboarding&utm_campaign=capi&plugin_name=sst',
			snapcapi: 'https://www.conversios.io/pricing/?utm_source=sstfree_plugin&utm_medium=onboarding&utm_campaign=snapcapi&plugin_name=sst',
			tiktokcapi: 'https://www.conversios.io/pricing/?utm_source=sstfree_plugin&utm_medium=onboarding&utm_campaign=tiktokcapi&plugin_name=sst',
			gtmpro: 'https://www.conversios.io/pricing/?utm_source=sstfree_plugin&utm_medium=onboarding&utm_campaign=gtmautomation&plugin_name=sst',
			gadseec: 'https://www.conversios.io/pricing/?utm_source=sstfree_plugin&utm_medium=onboarding&utm_campaign=gadseec&plugin_name=sst',
			ga4apisecret_box_inner: 'https://www.conversios.io/pricing/?utm_source=sstfree_plugin&utm_medium=innersetting_ga4&utm_campaign=ga4apikey&plugin_name=sst',
			gadseec_inner: 'https://www.conversios.io/pricing/?utm_source=sstfree_plugin&utm_medium=innersetting_gads&utm_campaign=gadseec&plugin_name=sst',
			fbcapi_inner: 'https://www.conversios.io/pricing/?utm_source=sstfree_plugin&utm_medium=innersetting_fb&utm_campaign=capi&plugin_name=sst',
			snapcapi_inner: 'https://www.conversios.io/pricing/?utm_source=sstfree_plugin&utm_medium=innersetting_snap&utm_campaign=capi&plugin_name=sst',
			tiktokcapi_inner: 'https://www.conversios.io/pricing/?utm_source=sstfree_plugin&utm_medium=innersetting_tiktok&utm_campaign=capi&plugin_name=sst',
			gtmpro_inner: 'https://www.conversios.io/pricing/?utm_source=sstfree_plugin&utm_medium=innersetting_gtm&utm_campaign=gtmautomation&plugin_name=sst',
			ereports: 'https://www.conversios.io/pricing/?utm_source=sstfree_plugin&utm_medium=ereports&utm_campaign=daterange&plugin_name=sst'
		};

		var propopup_ulink_arr = {
			ga4apisecret_box: 'https://www.conversios.io/checkout?pid=wpAIO_EY1&?utm_source=sstfree_plugin&utm_medium=onboarding&utm_campaign=ga4apikey',
			fbcapi: 'https://www.conversios.io/checkout/?pid=wpAIO_EY1&utm_source=sstfree_plugin&utm_medium=onboarding&utm_campaign=capi',
			snapcapi: 'https://www.conversios.io/checkout/?pid=wpAIO_EY1&utm_source=sstfree_plugin&utm_medium=onboarding&utm_campaign=snapcapi',
			tiktokcapi: 'https://www.conversios.io/checkout/?pid=wpAIO_EY1&utm_source=sstfree_plugin&utm_medium=onboarding&utm_campaign=tiktokcapi',
			gtmpro: 'https://www.conversios.io/checkout/?pid=wpAIO_EY1&utm_source=sstfree_plugin&utm_medium=onboarding&utm_campaign=gtmautomation',
			gadseec: 'https://www.conversios.io/checkout/?pid=wpAIO_EY1&utm_source=sstfree_plugin&utm_medium=onboarding&utm_campaign=gadseec',
			ga4apisecret_box_inner: 'https://www.conversios.io/checkout?pid=wpAIO_EY1&?utm_source=sstfree_plugin&utm_medium=innersetting_ga4&utm_campaign=ga4apikey',
			fbcapi_inner: 'https://www.conversios.io/checkout/?pid=wpAIO_EY1&utm_source=sstfree_plugin&utm_medium=innersetting_fb&utm_campaign=capi',
			snapcapi_inner: 'https://www.conversios.io/checkout/?pid=wpAIO_EY1&utm_source=sstfree_plugin&utm_medium=innersetting_snap&utm_campaign=capi',
			tiktokcapi_inner: 'https://www.conversios.io/checkout/?pid=wpAIO_EY1&utm_source=sstfree_plugin&utm_medium=innersetting_tiktok&utm_campaign=capi',
			gtmpro_inner: 'https://www.conversios.io/checkout/?pid=wpAIO_EY1&utm_source=sstfree_plugin&utm_medium=innersetting_gtm&utm_campaign=gtmautomation',
			gadseec_inner: 'https://www.conversios.io/checkout/?pid=wpAIO_EY1&utm_source=sstfree_plugin&utm_medium=innersetting_gads&utm_campaign=gadseec',
			ereports: 'https://www.conversios.io/checkout/?pid=wpAIO_EY1&utm_source=sstfree_plugin&utm_medium=ereports&utm_campaign=daterange'
		};

		jQuery('#conuptppro_text').html(propopup_text_arr[popupopener]);
		jQuery('#conuptppro_elink').attr('href', propopup_elink_arr[popupopener]);
		jQuery('#conuptppro_ulink').attr('href', propopup_ulink_arr[popupopener]);
		jQuery('#upgradetopromodal').modal('show');
	});

});
function user_tracking_data(event_name, error_msg, screen_name, event_label) {
	// alert();
	jQuery.ajax({
		type: 'POST',
		dataType: 'json',
		url: tvc_ajax_url,
		data: {
			action: 'update_user_tracking_data',
			event_name: event_name,
			error_msg: error_msg,
			screen_name: screen_name,
			event_label: event_label,
			TVCNonce: '". esc_js(wp_create_nonce('update_user_tracking_data-nonce')) ."'
		},
		success: function(response) {
			console.log('user tracking');
		}
	});
}
			");
			
		}
	}
}
new Convsst_Conversios_Footer();
