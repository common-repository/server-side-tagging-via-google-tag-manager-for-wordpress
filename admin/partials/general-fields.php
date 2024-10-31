<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$TVC_Admin_Helper = new TVC_Admin_Helper();
$this->customApiObj = new ConvsstCustomApi();
$class = "";
$message_p = "";
$validate_pixels = array();
$google_detail = $TVC_Admin_Helper->get_ee_options_data();
$plan_id = 46;
$googleDetail = "";
if (isset($google_detail['setting'])) {
  $googleDetail = $google_detail['setting'];
  if (isset($googleDetail->plan_id) && !in_array($googleDetail->plan_id, array("46"))) {
    $plan_id = $googleDetail->plan_id;
  }
}

$data = unserialize(get_option('convsst_options'));
$convsst_selected_events = unserialize(get_option('convsst_selected_events'));
$this->current_customer_id = $TVC_Admin_Helper->get_currentCustomerId();
$subscription_id = $TVC_Admin_Helper->get_subscriptionId();

$TVC_Admin_Helper->add_spinner_html();
$is_show_tracking_method_options = true; //$TVC_Admin_Helper->is_show_tracking_method_options($subscription_id);
?>


<!-- Main container -->
<div class="container-old conv-container conv-setting-container pt-4">

  <!-- Main row -->
  <div class="row justify-content-center" style="--bs-gutter-x: 0rem;">
    <!-- Main col8 center -->
    <div class="convfixedcontainermid col-md-8 col-xs-12 m-0 p-0">

      <!-- GTM Card -->
      <?php
      $tracking_method = (isset($data['tracking_method']) && $data['tracking_method'] != "") ? $data['tracking_method'] : "";
      $want_to_use_your_gtm = (isset($data['want_to_use_your_gtm']) && $data['want_to_use_your_gtm'] != "") ? $data['want_to_use_your_gtm'] : "0";
      $use_your_gtm_id = "";
      $sst_web_container = (isset($data['sst_web_container']) && $data['sst_web_container'] != "") ? $data['sst_web_container'] : "Not Connected";
      $sst_server_container = (isset($data['sst_server_container']) && $data['sst_server_container'] != "") ? $data['sst_server_container'] : "Not Connected";
      $sst_transport_url = (isset($data['sst_transport_url']) && $data['sst_transport_url'] != "") ? $data['sst_transport_url'] : "";
      if (isset($tracking_method) && $tracking_method == "gtm") {
        $use_your_gtm_id = ($data['tracking_method'] == 'gtm' && $want_to_use_your_gtm == 1) ? "Your own GTM container - " . $data['use_your_gtm_id'] : (($data['tracking_method'] == 'gtm') ? "Conversios container - GTM-K7X94DG" : esc_attr("Your own GTM container - " . $data['use_your_gtm_id']));
      }
      $is_sst_gtm_connected = "";
      if ((isset($data['sst_web_container']) && $data['sst_web_container'] != "") && (isset($data['sst_transport_url']) && $data['sst_transport_url'] != "")) {
        $is_sst_gtm_connected = "yes";
      }
      // GTM is connected or not
      if (isset($data['sst_web_container']) && !empty($data['sst_web_container']) 
        && isset($data['sst_server_container']) && !empty($data['sst_server_container']) 
        && isset($data['sst_transport_url']) && !empty($data['sst_transport_url'])) {
        $gtmCls = "conv-badge-green";
        $gtmText = "Connected";
      } else {
        $gtmCls = "conv-badge-yellow";
        $gtmText = "Configuration Required";
      }
      ?>

      <?php if (isset($tracking_method) && $tracking_method == 'gtag') { ?>
        <div class="alert d-flex align-items-cente p-0" role="alert">
          <div class="text-light conv-error-bg rounded-start d-flex">
            <span class="p-2 material-symbols-outlined align-self-center">info</span>
          </div>

          <div class="p-2 w-100 rounded-end border border-start-0 shadow-sm conv-notification-alert lh-lg bg-white">
            <h6 class="fs-6 lh-1 text-dark fw-bold border-bottom w-100 py-2">
              <?php esc_html_e("Attention!", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
            </h6>

            <span class="fs-6 lh-1 text-dark">
              <?php esc_html_e("As you might be knowing, GA3 is seeing sunset from 1st July 2023, we are also removing gtag.js based implementation for the old app users soon. Hence, we recommend you to change your implementation method to Google Tag Manager from below to avoid data descrepancy in the future.", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
          </div>
        </div>

      <?php } ?>


      <!-- GTM Server Side Start -->
      <div class="convo_sst d-flex flex-row">
        <div class="convcard-left conv-pixel-logo mt-2">
          <div class="convcard-logo text-center">
            <img src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/convsst_sstgtm_logo.svg'); ?>" />
          </div>
        </div>
        <div class="convcard-center p-2 col-10 d-flex">
          <div class="convcard-title">
            <h3>
              <?php esc_html_e("Server Side Tagging via GTM", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
            </h3>
            <p class="mt-1">
              <?php
              //if (isset($tracking_method) && $tracking_method == "gtm" && $is_sst_gtm_connected == "yes") {
                esc_html_e("Web GTM Container - ", "server-side-tagging-via-google-tag-manager-for-wordpress");
                echo '<span>' . esc_html($sst_web_container) . '</span>';
                echo '</p><p class="mt-1">';
                //if ($sst_server_container != '') {
                  esc_html_e("Server GTM Container - ", "server-side-tagging-via-google-tag-manager-for-wordpress");
                  echo '<span>' . esc_html($sst_server_container) . '</span>';
                //}
              //}
              ?>
            </p>
          </div>
          <span class="badge rounded-pill conv-badge ms-auto align-self-center gtm_stauts <?php echo $gtmCls; ?>">
            <?php echo $gtmText; ?>
          </span>
        </div>

        <div class="convcard-right ms-auto">
          <a href="<?php echo esc_url('admin.php?page=convsst-conversios-google-analytics&subpage="gtmsstsettings"'); ?>"
            class="h-100 rounded d-flex justify-content-center convcard-right-arrow link-light">
            <span class="material-symbols-outlined align-self-center">chevron_right</span>
          </a>
        </div>
      </div>
      <!-- GTM Server Side End -->



      <!-- Blue upgrade to pro -->
      <div class="convcard conv-pro-placeholder rounded-3 d-flex flex-row justify-content-between p-4 mt-4 shadow-sm">
        <div class="convcard-blue-left align-self-center bd-highlight">
          <h3 class="mb-3">
            <?php esc_html_e("Improve Your Website Performance", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
          </h3>
          <span style="max-width: 361px; display: block;">
            <?php esc_html_e("Boost data accuracy, privacy, and control with server-side tagging using GTM.", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
            </span>
          <span class="d-flex">
            <a style="padding:8px 60px 8px 60px;" class="text-light btn mt-3 btn-sm"
              href="https://www.conversios.io/pricing/?utm_source=free_sstpluginadmin&utm_medium=image_upgradenow&utm_campaign=free_sstdashboardscree&plugin_name=sst"
              target="_blank">
              <?php esc_html_e("Upgrade Now", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
            </a>
          </span>
        </div>
        <div class="convcard-blue-right align-self-center p-2 bd-highlight">
          <img src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/bro.png'); ?>" />
        </div>
      </div>
      <!-- Blue upgrade to pro End -->


      <div class="pt-4 conv-heading-box">
        <h3>
          <?php esc_html_e("Integrations", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
        </h3>
        <span>
          <?php esc_html_e("Once you’ve finished setting up your GTM & Server URL, go ahead with pixels & other integrations.", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
        </span>
        <div>
          <b>Note: </b><?php esc_html_e("You can connect only 2 channels at a time for tracking.", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
        </div>
      </div>

      <!-- All pixel list -->
      <?php
      $convsst_gtm_not_connected = ($is_sst_gtm_connected != 'yes') ? "conv-gtm-not-connected" : "conv-gtm-connected";
      $pixel_not_connected = array(
        "ga_id" => (isset($data['ga_id']) && $data['ga_id'] != '') ? '' : 'conv-pixel-not-connected',
        "gm_id" => (isset($data['gm_id']) && $data['gm_id'] != '') ? '' : 'conv-pixel-not-connected',
        "google_ads_id" => (isset($data['google_ads_id']) && $data['google_ads_id'] != '') ? '' : 'conv-pixel-not-connected',
        "fb_pixel_id" => (isset($data['fb_pixel_id']) && $data['fb_pixel_id'] != '') ? '' : 'conv-pixel-not-connected',
        "microsoft_convsst_ads_pixel_id" => (isset($data['microsoft_convsst_ads_pixel_id']) && $data['microsoft_convsst_ads_pixel_id'] != '') ? '' : 'conv-pixel-not-connected',
        "twitter_convsst_ads_pixel_id" => (isset($data['twitter_convsst_ads_pixel_id']) && $data['twitter_convsst_ads_pixel_id'] != '') ? '' : 'conv-pixel-not-connected',
        "pinterest_convsst_ads_pixel_id" => (isset($data['pinterest_convsst_ads_pixel_id']) && $data['pinterest_convsst_ads_pixel_id'] != '') ? '' : 'conv-pixel-not-connected',
        "snapchat_convsst_ads_pixel_id" => (isset($data['snapchat_convsst_ads_pixel_id']) && $data['snapchat_convsst_ads_pixel_id'] != '') ? '' : 'conv-pixel-not-connected',
        "tiKtok_convsst_ads_pixel_id" => (isset($data['tiKtok_convsst_ads_pixel_id']) && $data['tiKtok_convsst_ads_pixel_id'] != '') ? '' : 'conv-pixel-not-connected',
      );


      $pixel_video_link = array(
        "ga_id" => "https://www.conversios.io/docs/ecommerce-events-that-will-be-automated-using-conversios/?utm_source=galisting_inapp&utm_medium=resource_center_list&utm_campaign=resource_center",
        "gm_id" => "https://www.conversios.io/docs/ecommerce-events-that-will-be-automated-using-conversios/?utm_source=galisting_inapp&utm_medium=resource_center_list&utm_campaign=resource_center",
        "google_ads_id" => "https://youtu.be/Vr7vEeMIf7c",
        "fb_pixel_id" => "https://youtu.be/8nIyvQjeEkY",
        "microsoft_convsst_ads_pixel_id" => "https://youtu.be/BeP1Tp0I92o",
        "twitter_convsst_ads_pixel_id" => "",
        "pinterest_convsst_ads_pixel_id" => "https://youtu.be/Z0rcP1ItJDk",
        "snapchat_convsst_ads_pixel_id" => "https://youtu.be/uLQqAMQhFUo",
        "tiKtok_convsst_ads_pixel_id" => "https://www.conversios.io/docs/how-to-set-up-tiktok-pixel-using-conversios-plugin/?utm_source=Tiktoklisting_inapp&utm_medium=resource_center_list&utm_campaign=resource_center",
      );
      ?>

      <div id="convsst_pixel_list_box" class="shadow-sm">

        <!-- Google analytics  -->
        <div
          class="convcard conv-pixel-list-item d-flex flex-row p-2 mt-2 rounded-top <?php echo esc_attr($convsst_gtm_not_connected); ?>">

          <div class="p-2 pe-3 conv-pixel-logo border-end d-flex">
            <img class="align-self-center"
              src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/convsst_ganalytics_logo.png'); ?>" />
          </div>

          <div class="p-1 ps-3 align-self-center">
            <span class="fw-bold m-0">
              <?php esc_html_e("Google Analytics 4", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
              <a target="_blank" class="conv-link-blue conv-watch-video ps-2 fw-normal invisible"
                href="<?php echo esc_url($pixel_video_link['gm_id']); ?>">
                <span class="material-symbols-outlined align-text-bottom">play_circle_outline</span>
                <?php esc_html_e("Watch here", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
              </a>
            </span>
            <?php if ((empty($pixel_not_connected['ga_id']) || empty($pixel_not_connected['gm_id'])) && $convsst_gtm_not_connected == "conv-gtm-connected") { ?>
              <div class="d-flex pt-2">

                <?php if (isset($data['gm_id']) && $data['gm_id'] != '') { ?>
                  <span class="">
                    <?php echo (isset($data['gm_id']) && $data['gm_id'] != '') ? esc_attr("GA4: " . $data['gm_id']) : ''; ?>
                  </span>
                <?php } ?>
              </div>
            <?php } ?>
          </div>

          <div class="ms-auto d-flex">
            <?php if ((empty($pixel_not_connected['ga_id']) || empty($pixel_not_connected['gm_id'])) && $convsst_gtm_not_connected == "conv-gtm-connected") { ?>
              <span class="badge rounded-pill conv-badge conv-badge-green m-0 me-3 align-self-center">Connected</span>
            <?php }else{ ?>
              <span class="badge rounded-pill conv-badge conv-badge-red m-0 me-3 align-self-center">Not Connected</span>
            <?php } ?>
            <a href="<?php echo esc_url('admin.php?page=convsst-conversios-google-analytics&subpage="gasettings"'); ?>"
              class="rounded-end convcard-right-arrow align-self-center link-dark">
              <span class="material-symbols-outlined p-2">chevron_right</span>
            </a>
          </div>

        </div>

        <!-- Google Ads -->
        <div
          class="convcard conv-pixel-list-item d-flex flex-row p-2 mt-0 border-top <?php echo esc_attr($convsst_gtm_not_connected); ?>">
          <div class="p-2 pe-3 conv-pixel-logo border-end d-flex">
            <img class="align-self-center"
              src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/convsst_gads_logo.png'); ?>" />
          </div>

          <div class="p-1 ps-3 align-self-center">
            <span class="fw-bold m-0">
              <?php esc_html_e("Google Ads Conversion Tracking", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
              <a target="_blank" class="conv-link-blue conv-watch-video ps-2 fw-normal invisible"
                href="<?php echo esc_url($pixel_video_link['google_ads_id']); ?>">
                <span class="material-symbols-outlined align-text-bottom">play_circle_outline</span>
                <?php esc_html_e("Watch here", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
              </a>
            </span>
            <?php if (empty($pixel_not_connected['google_ads_id']) && $convsst_gtm_not_connected == "conv-gtm-connected") { ?>
              <div class="d-flex pt-2">
                <span class="pe-2 m-0">
                  <?php echo (isset($data['google_ads_id']) && $data['google_ads_id'] != '') ? esc_attr($data['google_ads_id']) : ''; ?>
                </span>
              </div>
            <?php } ?>
          </div>

          <div class="ms-auto d-flex">
            <?php if (empty($pixel_not_connected['google_ads_id']) && $convsst_gtm_not_connected == "conv-gtm-connected") { ?>
              <span class="badge rounded-pill conv-badge conv-badge-green m-0 me-3 align-self-center">Connected</span>
            <?php }else{ ?>
              <span class="badge rounded-pill conv-badge conv-badge-red m-0 me-3 align-self-center">Not Connected</span>
            <?php } ?>
            <a href="<?php echo esc_url('admin.php?page=convsst-conversios-google-analytics&subpage="gadssettings"'); ?>"
              class="rounded-end convcard-right-arrow align-self-center link-dark">
              <span class="material-symbols-outlined p-2">chevron_right</span>
            </a>
          </div>
        </div>

        <!-- FB Pixel -->
        <div
          class="convcard conv-pixel-list-item d-flex flex-row p-2 mt-0 border-top <?php echo esc_attr($convsst_gtm_not_connected); ?>">
          <div class="p-2 pe-3 conv-pixel-logo border-end d-flex">
            <img class="align-self-center"
              src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/convsst_meta_logo.png'); ?>" />
          </div>

          <div class="p-1 ps-3 align-self-center">
            <span class="fw-bold m-0">
              <?php esc_html_e("Facebook Pixel & Facebook Conversions API (Meta)", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
              <a target="_blank" class="conv-link-blue conv-watch-video ps-2 fw-normal invisible"
                href="<?php echo esc_url($pixel_video_link['fb_pixel_id']); ?>">
                <span class="material-symbols-outlined align-text-bottom">play_circle_outline</span>
                <?php esc_html_e("Watch here", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
              </a>
            </span>
            <?php if (empty($pixel_not_connected['fb_pixel_id']) && $convsst_gtm_not_connected == "conv-gtm-connected") { ?>
              <div class="d-flex pt-2">
                <span class="pe-2 m-0">
                  <?php echo (isset($data['fb_pixel_id']) && $data['fb_pixel_id'] != '') ? esc_attr($data['fb_pixel_id']) : ''; ?>
                </span>
              </div>
            <?php } ?>
          </div>

          <div class="ms-auto d-flex">
            <?php if (empty($pixel_not_connected['fb_pixel_id']) && $convsst_gtm_not_connected == "conv-gtm-connected") { ?>
              <span class="badge rounded-pill conv-badge conv-badge-green m-0 me-3 align-self-center">Connected</span>
            <?php }else{ ?>
              <span class="badge rounded-pill conv-badge conv-badge-red m-0 me-3 align-self-center">Not Connected</span>
            <?php } ?>
            
            <a href="<?php echo esc_url('admin.php?page=convsst-conversios-google-analytics&subpage="fbsettings"'); ?>"
              class="rounded-end convcard-right-arrow align-self-center link-dark">
              <span class="material-symbols-outlined p-2">chevron_right</span>
            </a>
          </div>
        </div>



        <!-- Snapchat Pixel -->
        <div
          class="convcard conv-pixel-list-item d-flex flex-row p-2 mt-0 border-top <?php echo esc_attr($convsst_gtm_not_connected); ?>">
          <div class="p-2 pe-3 conv-pixel-logo border-end d-flex">
            <img class="align-self-center"
              src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/convsst_snap_logo.png'); ?>" />
          </div>

          <div class="p-1 ps-3 align-self-center">
            <span class="fw-bold m-0">
              <?php esc_html_e("Snapchat Pixel & Conversion API", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
              <a target="_blank" class="conv-link-blue conv-watch-video ps-2 fw-normal invisible"
                href="<?php echo esc_url($pixel_video_link['snapchat_convsst_ads_pixel_id']); ?>">
                <span class="material-symbols-outlined align-text-bottom">play_circle_outline</span>
                <?php esc_html_e("Watch here", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
              </a>
            </span>
            <?php if (empty($pixel_not_connected['snapchat_convsst_ads_pixel_id']) && $convsst_gtm_not_connected == "conv-gtm-connected") { ?>
              <div class="d-flex pt-2">
                <span class="pe-2 m-0">
                  <?php echo (isset($data['snapchat_convsst_ads_pixel_id']) && $data['snapchat_convsst_ads_pixel_id'] != '') ? esc_attr($data['snapchat_convsst_ads_pixel_id']) : ''; ?>
                </span>
              </div>
            <?php } ?>
          </div>

          <div class="ms-auto d-flex">
            <?php if (empty($pixel_not_connected['snapchat_convsst_ads_pixel_id']) && $convsst_gtm_not_connected == "conv-gtm-connected") { ?>
              <span class="badge rounded-pill conv-badge conv-badge-green m-0 me-3 align-self-center">Connected</span>
            <?php }else{ ?>
              <span class="badge rounded-pill conv-badge conv-badge-red m-0 me-3 align-self-center">Not Connected</span>
            <?php } ?>
            <a href="<?php echo esc_url('admin.php?page=convsst-conversios-google-analytics&subpage="snapchatsettings"'); ?>"
              class="rounded-end convcard-right-arrow align-self-center link-dark">
              <span class="material-symbols-outlined p-2">chevron_right</span>
            </a>
          </div>
        </div>

        <!-- Tiktok -->
        <div
          class="convcard conv-pixel-list-item d-flex flex-row p-2 mt-0 border-top <?php echo esc_attr($convsst_gtm_not_connected); ?>">
          <div class="p-2 pe-3 conv-pixel-logo border-end d-flex">
            <img class="align-self-center"
              src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/convsst_tiktok_logo.png'); ?>" />
          </div>

          <div class="p-1 ps-3 align-self-center">
            <span class="fw-bold m-0">
              <?php esc_html_e("TikTok Pixel & Events API", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
              <a target="_blank" class="conv-link-blue conv-watch-video ps-2 fw-normal invisible"
                href="<?php echo esc_url($pixel_video_link['tiKtok_convsst_ads_pixel_id']); ?>">
                <span class="material-symbols-outlined align-text-bottom">play_circle_outline</span>
                <?php esc_html_e("Watch here", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
              </a>
            </span>
            <?php if (empty($pixel_not_connected['tiKtok_convsst_ads_pixel_id']) && $convsst_gtm_not_connected == "conv-gtm-connected") { ?>
              <div class="d-flex pt-2">
                <span class="pe-2 m-0">
                  <?php echo (isset($data['tiKtok_convsst_ads_pixel_id']) && $data['tiKtok_convsst_ads_pixel_id'] != '') ? esc_attr($data['tiKtok_convsst_ads_pixel_id']) : ''; ?>
                </span>
              </div>
            <?php } ?>
          </div>

          <div class="ms-auto d-flex">
            <?php if (empty($pixel_not_connected['tiKtok_convsst_ads_pixel_id']) && $convsst_gtm_not_connected == "conv-gtm-connected") { ?>
              <span class="badge rounded-pill conv-badge conv-badge-green m-0 me-3 align-self-center">Connected</span>
            <?php }else{ ?>
              <span class="badge rounded-pill conv-badge conv-badge-red m-0 me-3 align-self-center">Not Connected</span>
            <?php } ?>
            <a href="<?php echo esc_url('admin.php?page=convsst-conversios-google-analytics&subpage="tiktoksettings"'); ?>"
              class="rounded-end convcard-right-arrow align-self-center link-dark">
              <span class="material-symbols-outlined p-2">chevron_right</span>
            </a>
          </div>
        </div>
      </div>
      <!-- All pixel list end -->

      <!-- SST Benifits Accordian -->
      <div class="accordion convcard rounded mt-4" id="sstbenifits">
        <div class="accordion-item convcard">
          <h2 class="accordion-header card-header p-0" id="headingOne">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
              Improve Your Server Side Tracking
              </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#sstbenifits">
              <div class="accordion-body card-body">
                  <div class="list-group">
                      <div class="list-group-item d-flex justify-content-between align-items-center">
                          Get SGTM Server URL
                      </div>
                      <div class="list-group-item d-flex justify-content-between align-items-center">
                          GTM Automation (Prebuild GTM Tags, Triggers, Var for all events)
                      </div>
                      <div class="list-group-item d-flex justify-content-between align-items-center">
                          Complete Server Side Tracking for Various Platforms
                      </div>
                      <div class="list-group-item pt-4 d-flex justify-content-end align-items-center">
                        <a href="https://www.conversios.io/pricing/?utm_source=free_sstpluginadmin&utm_medium=sstbenefits&utm_campaign=free_sstdashboardscree&plugin_name=sst" target="_blank" class="btn btn-primary">Upgrade Now</a>
                      </div>
                  </div>
              </div>
          </div>
        </div>
      </div>

      <!-- SST Learn more / Docs Accordian -->
      <div class="accordion convcard rounded mt-4" id="sstlearnmore">
        <div class="accordion-item convcard">
          <h2 class="accordion-header card-header p-0" id="headingTwo">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseOne">
              Learn More About Server Side Tagging
              </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#sstlearnmore">
              <div class="accordion-body card-body">
                  <div class="list-group">
                      <div class="list-group-item d-flex justify-content-between align-items-center">
                        How to create a Web Container in GTM?
                        <a href="https://www.conversios.io/docs/how-to-create-a-gtm-account-and-find-google-tag-manager-id/?utm_source=sstfreeinplugin&utm_medium=dashboard&utm_campaign=sstfreeplugin" target="_blank" class="btn btn-outline-primary">Learn More</a>
                      </div>
                      <div class="list-group-item d-flex justify-content-between align-items-center">
                        How to create a Server Container in GTM?
                        <a href="https://www.conversios.io/docs/how-to-create-server-side-container-google-tag-manager/?utm_source=sstfreeinplugin&utm_medium=dashboard&utm_campaign=sstfreeplugin" target="_blank" class="btn btn-outline-primary">Learn More</a>
                      </div>
                  </div>
              </div>
          </div>
        </div>
      </div>
            
      <!-- Advanced option -->
      <?php if (is_plugin_active_for_network('woocommerce/woocommerce.php') || in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) { ?>
        <div class="pt-4 conv-heading-box">
          <h3>
            <?php esc_html_e("Advance options", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
          </h3>
          <span>
            <?php esc_html_e("This feature is for the woocommerce store which has changed standard woocommerce hooks or implemented custom woocommerce hooks.", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
          </span>
        </div>
        <div class="convcard conv-pixel-list-item rounded d-flex flex-row p-2 mt-2 <?php echo esc_attr($convsst_gtm_not_connected); ?>">
          <div class="p-2 pe-3 conv-pixel-logo border-end d-flex">
            <img class="align-self-center"
              src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/convsst_event_track_custom.png'); ?>" />
          </div>

          <div class="p-1 ps-3 align-self-center">
            <span class="fw-bold">
              <?php esc_html_e("Event Tracking - Custom Integration", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
              <a target="_blank" class="conv-link-blue conv-watch-video ps-2 fw-normal invisible"
                href="<?php echo esc_url("https://" . CONVSST_AUTH_CONNECT_URL . "/docs/custom-google-analytics-event-tracking-in-woocommerce-with-conversios-plugin/"); ?>">
                <span class="material-symbols-outlined align-text-bottom">article</span>
                <?php esc_html_e("Read Here", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
              </a>
            </span>
          </div>

          <div class="ms-auto d-flex">
            <a href="<?php echo esc_url('admin.php?page=convsst-conversios-google-analytics&subpage="customintgrationssettings"'); ?>"
              class="rounded-end convcard-right-arrow align-self-center link-dark">
              <span class="material-symbols-outlined p-2">chevron_right</span>
            </a>
          </div>

        </div>
        <!-- Advance option End -->
      <?php } ?>


    </div>
    <!-- Main col8 center -->
  </div>
  <!-- Main row -->
</div>
<!-- Main container End -->




<!-- Modal -->
<div class="modal fade upgradetosstmodal" id="convSsttoProModal" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    <div class="modal-content">

      <h2>Unlock The benefits of <br> <span>Server Side Tagging Via GTM</span> </h2>
      <div class="row">
        <div class="col-lg-6 col-md-12 col-12">
          <ul class="listing">
            <span>Benefits</span>
            <li>Adopt To First Party Cookies</li>
            <li>Improve Data Accuracy & Reduced Ad Blocker Impact</li>
            <li>Faster Page Speed</li>
            <li>Enhanced Data Privacy & Security</li>
          </ul>
        </div>
        <div class="col-lg-6 col-md-12 col-12">
          <ul class="listing">
            <span>Features</span>
            <li>Server Side Tagging Via GTM</li>
            <li>Powerful Google Cloud Servers</li>
            <li>Custom Loader & Custom Domain Mapping</li>
            <li>Server Side Tagging For Google Analytics 4 (GA4), Google Ads & Facebook CAPI</li>
            <li>Free Setup & Audit By Dedicated Customer Success Manager</li>
          </ul>
        </div>
        <div class="col-12">
          <div class="discount-btn">
            <a target="_blank"
              href="<?php echo esc_url('https://www.conversios.io/server-side-tagging-for-woocommerce/?utm_source=pixelandanalytics&utm_medium=in_app&utm_campaign=sstpopup'); ?>"
              class="btn btn-dark common-btn">Get Early Bird Discount</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Upgrade to PRO modal End -->


<!-- Channel Limit Modal -->
<div class="modal fade upgradetosstmodal" id="convsst_limitchannelmodal" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    <div class="modal-content">

      <h2>Unlock The benefits of <br> <span>Server Side Tagging Via GTM</span> </h2>
      <div class="row">
        <div class="col-lg-6 col-md-12 col-12">
          <ul class="listing">
            <span>Benefits</span>
            <li>Adopt To First Party Cookies</li>
            <li>Improve Data Accuracy & Reduced Ad Blocker Impact</li>
            <li>Faster Page Speed</li>
            <li>Enhanced Data Privacy & Security</li>
          </ul>
        </div>
        <div class="col-lg-6 col-md-12 col-12">
          <ul class="listing">
            <span>Features</span>
            <li>Server Side Tagging Via GTM</li>
            <li>Powerful Google Cloud Servers</li>
            <li>Custom Loader & Custom Domain Mapping</li>
            <li>Server Side Tagging For Google Analytics 4 (GA4), Google Ads & Facebook CAPI</li>
            <li>Free Setup & Audit By Dedicated Customer Success Manager</li>
          </ul>
        </div>
        <div class="col-12">
          <div class="discount-btn">
            <a target="_blank"
              href="<?php echo esc_url('https://www.conversios.io/server-side-tagging-for-woocommerce/?utm_source=pixelandanalytics&utm_medium=in_app&utm_campaign=sstpopup'); ?>"
              class="btn btn-dark common-btn">Get Early Bird Discount</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Channel Limit Modal END -->
<?php
wp_add_inline_script( 'convsst-admin',"
jQuery(function () {
    var connectedcount = jQuery('#convsst_pixel_list_box .conv-gtm-connected.conv-pixel-list-item .conv-badge.conv-badge-green').length;
    if (connectedcount >= 2) {
      jQuery('#convsst_pixel_list_box .conv-gtm-connected.conv-pixel-list-item').each(function (e) {
        var innerbadge = jQuery(this).find('.conv-badge.conv-badge-green').length;
        if (innerbadge == 0) {
          jQuery(this).find('.convcard-right-arrow').removeAttr('href').addClass('convsst_limitchannelmodal_btn');
        }
      });
    }

    jQuery('.convsst_limitchannelmodal_btn').click(function () {
      jQuery('#convsst_limitchannelmodal').modal('show');
    });
  });
");
?>