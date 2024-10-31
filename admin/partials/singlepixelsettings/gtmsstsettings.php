<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// $gcp_regions = array(
//   "asia-east1-a" => "asia-east1-a",
//   "asia-east1-b" => "asia-east1-b",
//   "asia-east1-c" => "asia-east1-c",
//   "asia-east2-a" => "asia-east2-a",
//   "asia-east2-b" => "asia-east2-b",
//   "asia-east2-c" => "asia-east2-c",
//   "asia-northeast1-a" => "asia-northeast1-a",
//   "asia-northeast1-b" => "asia-northeast1-b",
//   "asia-northeast1-c" => "asia-northeast1-c",
//   "asia-northeast2-a" => "asia-northeast2-a",
//   "asia-northeast2-b" => "asia-northeast2-b",
//   "asia-northeast2-c" => "asia-northeast2-c",
//   "asia-northeast3-a" => "asia-northeast3-a",
//   "asia-northeast3-b" => "asia-northeast3-b",
//   "asia-northeast3-c" => "asia-northeast3-c",
//   "asia-south1-a" => "asia-south1-a",
//   "asia-south1-b" => "asia-south1-b",
//   "asia-south1-c" => "asia-south1-c",
//   "asia-south2-a" => "asia-south2-a",
//   "asia-south2-b" => "asia-south2-b",
//   "asia-south2-c" => "asia-south2-c",
//   "asia-southeast1-a" => "asia-southeast1-a",
//   "asia-southeast1-b" => "asia-southeast1-b",
//   "asia-southeast1-c" => "asia-southeast1-c",
//   "asia-southeast2-a" => "asia-southeast2-a",
//   "asia-southeast2-b" => "asia-southeast2-b",
//   "asia-southeast2-c" => "asia-southeast2-c",
//   "australia-southeast1-a" => "australia-southeast1-a",
//   "australia-southeast1-b" => "australia-southeast1-b",
//   "australia-southeast1-c" => "australia-southeast1-c",
//   "australia-southeast2-a" => "australia-southeast2-a",
//   "australia-southeast2-b" => "australia-southeast2-b",
//   "australia-southeast2-c" => "australia-southeast2-c",
//   "europe-north1-a" => "europe-north1-a",
//   "europe-north1-b" => "europe-north1-b",
//   "europe-central2-a" => "europe-central2-a",
//   "europe-central2-b" => "europe-central2-b",
//   "europe-central2-c" => "europe-central2-c",
//   "europe-north1-c" => "europe-north1-c",
//   "europe-southwest1-a" => "europe-southwest1-a",
//   "europe-southwest1-b" => "europe-southwest1-b",
//   "europe-southwest1-c" => "europe-southwest1-c",
//   "europe-west1-b" => "europe-west1-b",
//   "europe-west1-c" => "europe-west1-c",
//   "europe-west1-d" => "europe-west1-d",
//   "europe-west12-a" => "europe-west12-a",
//   "europe-west12-b" => "europe-west12-b",
//   "europe-west12-c" => "europe-west12-c",
//   "europe-west2-a" => "europe-west2-a",
//   "europe-west2-b" => "europe-west2-b",
//   "europe-west2-c" => "europe-west2-c",
//   "europe-west3-a" => "europe-west3-a",
//   "europe-west3-b" => "europe-west3-b",
//   "europe-west3-c" => "europe-west3-c",
//   "europe-west4-a" => "europe-west4-a",
//   "europe-west4-b" => "europe-west4-b",
//   "europe-west4-c" => "europe-west4-c",
//   "europe-west6-a" => "europe-west6-a",
//   "europe-west6-b" => "europe-west6-b",
//   "europe-west6-c" => "europe-west6-c",
//   "europe-west8-a" => "europe-west8-a",
//   "europe-west8-b" => "europe-west8-b",
//   "europe-west8-c" => "europe-west8-c",
//   "europe-west9-a" => "europe-west9-a",
//   "europe-west9-b" => "europe-west9-b",
//   "europe-west9-c" => "europe-west9-c",
//   "me-central1-a" => "me-central1-a",
//   "me-central1-b" => "me-central1-b",
//   "me-central1-c" => "me-central1-c",
//   "me-west1-a" => "me-west1-a",
//   "me-west1-b" => "me-west1-b",
//   "me-west1-c" => "me-west1-c",
//   "northamerica-northeast1-a" => "northamerica-northeast1-a",
//   "northamerica-northeast1-b" => "northamerica-northeast1-b",
//   "northamerica-northeast1-c" => "northamerica-northeast1-c",
//   "northamerica-northeast2-a" => "northamerica-northeast2-a",
//   "northamerica-northeast2-b" => "northamerica-northeast2-b",
//   "northamerica-northeast2-c" => "northamerica-northeast2-c",
//   "southamerica-east1-a" => "southamerica-east1-a",
//   "southamerica-east1-b" => "southamerica-east1-b",
//   "southamerica-east1-c" => "southamerica-east1-c",
//   "southamerica-west1-a" => "southamerica-west1-a",
//   "southamerica-west1-b" => "southamerica-west1-b",
//   "southamerica-west1-c" => "southamerica-west1-c",
//   "us-central1-a" => "us-central1-a",
//   "us-central1-b" => "us-central1-b",
//   "us-central1-c" => "us-central1-c",
//   "us-central1-f" => "us-central1-f",
//   "us-east1-b" => "us-east1-b",
//   "us-east1-c" => "us-east1-c",
//   "us-east1-d" => "us-east1-d",
//   "us-east4-a" => "us-east4-a",
//   "us-east4-b" => "us-east4-b",
//   "us-east4-c" => "us-east4-c",
//   "us-east5-a" => "us-east5-a",
//   "us-east5-b" => "us-east5-b",
//   "us-east5-c" => "us-east5-c",
//   "us-south1-a" => "us-south1-a",
//   "us-south1-b" => "us-south1-b",
//   "us-south1-c" => "us-south1-c",
//   "us-west1-a" => "us-west1-a",
//   "us-west1-b" => "us-west1-b",
//   "us-west1-c" => "us-west1-c",
//   "us-west2-a" => "us-west2-a",
//   "us-west2-b" => "us-west2-b",
//   "us-west2-c" => "us-west2-c",
//   "us-west3-a" => "us-west3-a",
//   "us-west3-b" => "us-west3-b",
//   "us-west3-c" => "us-west3-c",
//   "us-west4-a" => "us-west4-a",
//   "us-west4-b" => "us-west4-b",
//   "us-west4-c" => "us-west4-c",
// );

// $gcp_regions = array(
//   "asia-east1" => "asia-east1 (Taiwan)",
//   "asia-northeast1" => "asia-northeast1 (Tokyo)",
//   "asia-northeast2" => "asia-northeast2 (Osaka)",
//   "europe-north1" => "europe-north1 (Finland) ",
//   "europe-southwest1" => "europe-southwest1 (Madrid)",
//   "europe-west1" => "europe-west1 (Belgium)",
//   "europe-west4" => "europe-west4 (Netherlands)",
//   "europe-west8" => "europe-west8 (Milan)",
//   "europe-west9" => "europe-west9 (Paris)",
//   "me-west1" => "me-west1 (Tel Aviv)",
//   "us-central1" => "us-central1 (Iowa)",
//   "us-east1" => "us-east1 (South Carolina)",
//   "us-east4" => "us-east4 (Northern Virginia)",
//   "us-east5" => "us-east5 (Columbus)",
//   "us-south1" => "us-south1 (Dallas)",
//   "us-west1" => "us-west1 (Oregon)",
// );
$gcp_regions = array(
  "asia-east1" => "asia-east1",
  "asia-northeast1" => "asia-northeast1",
  "asia-northeast2" => "asia-northeast2",
  "europe-north1" => "europe-north1",
  "europe-southwest1" => "europe-southwest1",
  "europe-west1" => "europe-west1",
  "europe-west4" => "europe-west4",
  "europe-west8" => "europe-west8",
  "europe-west9" => "europe-west9",
  "me-west1" => "me-west1",
  "us-central1" => "us-central1",
  "us-east1" => "us-east1",
  "us-east4" => "us-east4",
  "us-east5" => "us-east5",
  "us-south1" => "us-south1",
  "us-west1" => "us-west1",
);
$tvs_admin = new TVC_Admin_Helper();
$tvs_admin_data = $tvs_admin->get_ee_options_data();
$store_id = $tvs_admin_data['setting']->store_id;

// echo "<pre>";
// print_r($store_id);
// echo "</pre>";
// exit();

$sst_web_container = (isset($ee_options['sst_web_container']) && $ee_options['sst_web_container'] != "") ? $ee_options['sst_web_container'] : "";
$sst_server_container = (isset($ee_options['sst_server_container']) && $ee_options['sst_server_container'] != "") ? $ee_options['sst_server_container'] : "";
$sst_server_container_config = (isset($ee_options['sst_server_container_config']) && $ee_options['sst_server_container_config'] != "") ? $ee_options['sst_server_container_config'] : "";
$sst_transport_url = (isset($ee_options['sst_transport_url']) && $ee_options['sst_transport_url'] != "") ? $ee_options['sst_transport_url'] : "";
$sst_region = (isset($ee_options['sst_region']) && $ee_options['sst_region'] != "") ? $ee_options['sst_region'] : "";
$is_own_server = isset($ee_options['sst_server_details']['is_sst_own_server']) ? $ee_options['sst_server_details']['is_sst_own_server'] : '';

$sst_server_ip = (isset($ee_options['sst_server_ip']) && $ee_options['sst_server_ip'] != "") ? $ee_options['sst_server_ip'] : "";

$sst_cloud_run_name =  isset($ee_options['sst_server_details']['sst_cloud_run_name']) ? $ee_options['sst_server_details']['sst_cloud_run_name'] : '';

$doc_link_url = "https://www.conversios.io/docs/how-to-create-a-web-server-side-container-and-find-the-container-config-3/?utm_source=app&utm_medium=gtmsetup&utm_campaign=doc";




// check if user is authenticated or not
if ((isset($_GET['g_mail']) && sanitize_text_field($_GET['g_mail'])) && (isset($_GET['subscription_id']) && sanitize_text_field($_GET['subscription_id']))) {
  update_option('convsst_customer_gtm_gmail', sanitize_email($_GET['g_mail']));
}

$g_gtm_email = get_option('convsst_customer_gtm_gmail');

// perform validation on the user email
$g_gtm_email =  ($g_gtm_email != '') ? $g_gtm_email : "";
$stepCls = $g_gtm_email != "" ? "" : "stepper-conv-bg-grey";
$disableTextCls = $g_gtm_email != "" ? "" : "conv-link-disabled";
$select2Disabled = $g_gtm_email != "" ? "" : "disabled";
$saveBtnDisabled = $g_gtm_email != "" ? "" : "conv-btn-save-disabled";

$gtm_web_account_id = isset($ee_options['sst_gtm_web_settings']['gtm_account_id']) ? $ee_options['sst_gtm_web_settings']['gtm_account_id'] : "";
$gtm_web_container_id = isset($ee_options['sst_gtm_web_settings']['gtm_container_id']) ? $ee_options['sst_gtm_web_settings']['gtm_container_id'] : "";
$gtm_web_container_publicId = isset($ee_options['sst_gtm_web_settings']['gtm_public_id']) ? $ee_options['sst_gtm_web_settings']['gtm_public_id'] : "";
$gtm_web_account_container_name = isset($ee_options['sst_gtm_web_settings']['gtm_account_container_name']) ? $ee_options['sst_gtm_web_settings']['gtm_account_container_name'] : "";
$is_gtm_automatic_process = isset($ee_options['sst_gtm_web_settings']['is_gtm_automatic_process']) ? $ee_options['sst_gtm_web_settings']['is_gtm_automatic_process'] : false;


$gtm_server_account_id = isset($ee_options['sst_gtm_server_settings']['gtm_account_id']) ? $ee_options['sst_gtm_server_settings']['gtm_account_id'] : "";
$gtm_server_container_id = isset($ee_options['sst_gtm_server_settings']['gtm_container_id']) ? $ee_options['sst_gtm_server_settings']['gtm_container_id'] : "";
$gtm_server_container_publicId = isset($ee_options['sst_gtm_server_settings']['gtm_public_id']) ? $ee_options['sst_gtm_server_settings']['gtm_public_id'] : "";
$gtm_server_account_container_name = isset($ee_options['sst_gtm_server_settings']['gtm_account_container_name']) ? $ee_options['sst_gtm_server_settings']['gtm_account_container_name'] : "";
// $is_gtm_automatic_process = isset($ee_options['sst_gtm_server_settings']['is_gtm_automatic_process']) ? $ee_options['sst_gtm_server_settings']['is_gtm_automatic_process'] : false;

$tracking_method = (isset($ee_options['tracking_method']) && $ee_options['tracking_method'] != "") ? $ee_options['tracking_method'] : "";

$use_your_gtm_id = isset($ee_options['use_your_gtm_id']) ? $ee_options['use_your_gtm_id'] : "";


?>


<div class="convcard p-4 mt-0 rounded-3 shadow-sm">

  <?php if (isset($pixel_settings_arr[$subpage]['topnoti']) && $pixel_settings_arr[$subpage]['topnoti'] != "") { ?>
    <div class="alert d-flex align-items-cente p-0" role="alert">
      <span class="p-2 material-symbols-outlined text-light conv-success-bg rounded-start">info</span>
      <div class="p-2 w-100 rounded-end border border-start-0 shadow-sm conv-notification-alert lh-lg">
        <?php 
        /* translators: %s: Top Notice */
        printf(  esc_html__( '%s', "server-side-tagging-via-google-tag-manager-for-wordpress" ), esc_html($pixel_settings_arr[$subpage]['topnoti']) ); 
        ?>
      </div>
    </div>
  <?php } ?>

  <form id="gtmsstsettings_form">

    <div class="convpixsetting-inner-box mt-4">

      <div class="container-section pb-3">
        <div class="card border-0 p-0 shadow-none" style="max-width: 100% !important;">
          <div class="container-setting">
            <nav>
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active conv-nav-tab" id="nav-manual-tab" data-bs-toggle="tab" data-bs-target="#nav-manual" type="button" role="tab" aria-controls="nav-manual" aria-selected="false"><span>Manual</span></button>
                <button class="nav-link conv-nav-tab" id="nav-automatic-tab" data-bs-toggle="tab" data-bs-target="#nav-automatic" type="button" role="tab" aria-controls="nav-automatic" aria-selected="true"><span>GTM Automation<span class="tooltipsst">Available In Pro</span></span></button>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">

              <div class="tab-pane fade show active" id="nav-manual" role="tabpanel" aria-labelledby="nav-manual-tab">
                <!-- SST Web Container -->
                <div class="mt-4">
                  <h5 class="fw-normal mb-1">
                    <?php esc_html_e("Web Container ID", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                  </h5>
                  <input type="text" class="form-control-lg w-100" name="sst_web_container" id="sst_web_container" value="<?php echo esc_attr($sst_web_container); ?>" placeholder="Enter web container ID">
                  <p class="fw-bold">How to Find your Web Container ID?
                    <a class="conv-link-blue" href="https://www.conversios.io/docs/how-to-create-a-gtm-account-and-find-google-tag-manager-id/?utm_source=sstfreeinplugin&utm_medium=dashboard&utm_campaign=sstfreeplugin" target="_blank">
                      <?php esc_html_e('Click here', "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                    </a>, and <a target="_blank" href="https://www.conversios.io/pricing/?plugin_name=sst&utm_source=sstfree_plugin&utm_medium=innersetting_gtm&utm_campaign=gtmmanual_getjson">Upgrade to Pro</a> to get pre-built JSON of tags and triggers.
                  </p>
                </div>

                <!-- SST Server Container -->
                <div class="mt-4">
                  <h5 class="fw-normal mb-1">
                    <?php esc_html_e("Server Container ID", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                  </h5>
                  <input type="text" class="form-control-lg w-100" name="sst_server_container" id="sst_server_container" value="<?php echo esc_attr($sst_server_container); ?>" placeholder="Enter server container ID">
                  <p class="fw-bold">How to Find your Server Container ID?
                    <a class="conv-link-blue" href="https://www.conversios.io/docs/how-to-create-server-side-container-google-tag-manager/?utm_source=sstfreeinplugin&utm_medium=dashboard&utm_campaign=sstfreeplugin" target="_blank">
                      <?php esc_html_e('Click here', "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                    </a>, and <a target="_blank" href="https://www.conversios.io/pricing/?plugin_name=sst&utm_source=sstfree_plugin&utm_medium=innersetting_gtm&utm_campaign=gtmmanual_getjson">Upgrade to Pro</a> to get pre-built JSON of tags and triggers.
                  </p>
                </div>

                <!-- SST Server Transport URL -->
                <div class="mt-4">
                  <h5 class="fw-normal mb-1">
                    <?php esc_html_e("SGTM Server URL", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                  </h5>
                  <input type="text" class="form-control-lg w-100" name="sst_transport_url" id="manual_sst_transport_url" value="<?php echo esc_attr($sst_transport_url); ?>" placeholder="Enter SGTM server url">
                  <div class="convcard py-2 px-3 my-3 rounded-3 shadow-sm d-flex justify-content-between align-items-center server-placeholder">
                    <div class="col-8 pe-2">
                      <h4><?php esc_html_e("Need help setting up SGTM Server URL?", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?></h4>
                      <small><strong style="color:#0AB17B">We’re here to assist!</strong>&nbsp;&nbsp;<?php esc_html_e("Reach out to our team for personalized help in setting up your server and web container.", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?></small>
                    </div>
                    <div class="col-4">
                      <a href="https://calendly.com/conversios/conversios-demo-for-server-side-tagging" target="_blank" class="btn btn-outline-primary w-100">Contact Us</a>
                    </div>
                  </div>
                </div>

              </div>

              <div class="tab-pane fade nav-automatic" id="nav-automatic" role="tabpanel" aria-labelledby="nav-automatic-tab">
              <div class="pt-3" style="padding: 5%;margin-top: 20px;border: 1px solid #ebebeb;border-radius: 4px;">
                <strong style="color:#0AB17B">Recommended:</strong>&nbsp;The <b>Automation of GTM Web and Server Container</b> is available in the Pro version. With a <b>Single-click</b>, all GTM Tags for e-commerce events will be created in your GTM container. No manual creation required. 
                <span class="conv-link-blue ms-2 fw-bold-500 upgradetopro_badge" popupopener="gtmpro_inner">                
                <img src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/upgrade_badge.png'); ?>">&nbsp;Available In Pro</span>
              </div>
              <ul class="progress-steps pt-3" style="pointer-events:none;opacity:0.2">
                  <li>
                    <div class="step-box">
                      <?php
                      $connect_url = $TVC_Admin_Helper->get_custom_connect_url_subpage(admin_url() . 'admin.php?page=convsst-conversios-google-analytics', "gtmsstsettings");
                      require_once("googlesigninforsstgtm.php");
                      ?>
                    </div>
                  </li>
                  <li class="stepper-deactivate">
                    <div class="step-box">
                      <div class="row web-container-row" style="cursor: pointer">
                        <div class="col-md-12">
                          <div class="row pb-2" data-bs-toggle="collapse" data-bs-target="#collapseWebContainer" aria-expanded="false" aria-controls="collapseWebContainer">

                            <div class="col-md-8">
                              <h5 class="fw-normal mb-1 web-container-id">Web Container ID:</h5>
                            </div>
                            <div class="col-md-3 d-flex justify-content-end">
                              <span class="web-container-setup-status badge rounded-pill conv-badge conv-badge-green m-0 me-3 align-self-center" style="display: none;">Connected</span>
                            </div>

                            <div class="col-md-1">
                              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none" class="web-container-arrow">
                                <g clip-path="url(#clip0_280_276)">
                                  <path d="M15.2075 7.87418L11 12.0725L6.7925 7.87418L5.5 9.16668L11 14.6667L16.5 9.16668L15.2075 7.87418Z" fill="#5F6368" />
                                </g>
                                <defs>
                                  <clipPath id="clip0_280_276">
                                    <rect width="22" height="22" fill="white" />
                                  </clipPath>
                                </defs>
                              </svg>
                            </div>

                          </div>

                        </div>
                      </div>
                      <?php 
                      /*<div class="collapse" id="collapseWebContainer">
                      </div>*/
                      ?>
                    </div>
                  </li>
                  <li class="stepper-deactivate">
                    <div class="step-box">
                      <div class="row" style="cursor: pointer">
                        <div class="col-md-12">
                          <div class="row pb-2" data-bs-toggle="collapse" data-bs-target="#collapseServerContainer" aria-expanded="false" aria-controls="collapseServerContainer">
                            <div class="col-md-8">
                              <h5 class="fw-normal mb-1 server-container-id">
                                <?php esc_html_e('Server Container ID:', "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                              </h5>
                            </div>
                            <div class="col-md-3 d-flex justify-content-end">
                              <span class="server-container-setup-status badge rounded-pill conv-badge conv-badge-green m-0 me-3 align-self-center" style="display: none;">Connected</span>
                            </div>
                            <div class="col-md-1">
                              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none" class="server-container-arrow">
                                <g clip-path="url(#clip0_280_276)">
                                  <path d="M15.2075 7.87418L11 12.0725L6.7925 7.87418L5.5 9.16668L11 14.6667L16.5 9.16668L15.2075 7.87418Z" fill="#5F6368" />
                                </g>
                                <defs>
                                  <clipPath id="clip0_280_276">
                                    <rect width="22" height="22" fill="white" />
                                  </clipPath>
                                </defs>
                              </svg>
                            </div>
                          </div>

                        </div>
                      </div>
                      <?php
                      /*<div class="collapse" id="collapseServerContainer">
                      </div>*/
                      ?>
                    </div>
                  </li>
                  <li class="stepper-deactivate reduceHeight">
                    <div class="step-box">
                      <div class="row" style="cursor: pointer">
                        <div class="col-md-12">
                          <div class="row pb-2" data-bs-toggle="collapse" data-bs-target="#collapseServerSetup" aria-expanded="true" aria-controls="collapseServerSetup">
                            <div class="col-md-8">
                              <h5 class="fw-normal mb-1 server-cloud-run-url">Server Set-up</h5>
                            </div>
                            <div class="col-md-3 d-flex justify-content-end">
                              <span class="server-cloud-run-setup-status badge rounded-pill conv-badge conv-badge-green m-0 me-3 align-self-center" style="display: none;">Connected</span>
                            </div>
                            <div class="col-md-1">
                              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none" class="server-setup-arrow">
                                <g clip-path="url(#clip0_280_276)">
                                  <path d="M15.2075 7.87418L11 12.0725L6.7925 7.87418L5.5 9.16668L11 14.6667L16.5 9.16668L15.2075 7.87418Z" fill="#5F6368"></path>
                                </g>
                                <defs>
                                  <clipPath id="clip0_280_276">
                                    <rect width="22" height="22" fill="white"></rect>
                                  </clipPath>
                                </defs>
                              </svg>
                            </div>

                          </div>

                        </div>
                      </div>
  
                      <?php /*<div class="server-set-up-main-div collapse conv-pointer-none-opacity" id="collapseServerSetup">
                      </div> */ ?>

                    </div>



                  </li>


                </ul>

              </div>
              

            </div>
          </div>
        </div>
      </div>


      <div class="event-setting-div py-3 border-top">
        <div class="row">
          <div class="col-md-12">
            <a class="conv-link-blue shadow-none collapsed px-2 d-flex align-items-center" id="eventCollapseLink" data-bs-toggle="collapse" href=".collapseEventSetting" role="button" aria-expanded="false" aria-controls="collapseEventSetting">
              <?php esc_html_e("Tracking Events Settings", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
              <div class="conv-down-arrow conv-arrow m-1">
              </div>
            </a>

          </div>
        </div>

        <div class="row collapse collapseEventSetting">

          <div class="py-3 hidden" style="display:none">
            <h5 class="fw-normal mb-1">
              <?php esc_html_e("Select User Roles to Disable Tracking:", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
            </h5>
            <select class="form-select mb-3 selecttwo w-100" id="convsst_disabled_users" name="convsst_disabled_users[]" multiple="multiple" data-placeholder="Select role">
              <?php foreach ($TVC_Admin_Helper->convsst_get_user_roles() as $slug => $name) {
                $is_selected = "";
                if (!empty($ee_options['convsst_disabled_users'])) {
                  $is_selected = in_array($slug, $ee_options['convsst_disabled_users']) ? "selected" : "";
                }
              ?>
                <option value="<?php echo esc_attr($slug); ?>" <?php echo esc_attr($is_selected); ?>><?php echo esc_html($name); ?></option>
              <?php } ?>
            </select>
          </div>


          <div class="py-3">
            <h5 class="fw-normal mb-1">
              <?php esc_html_e("Select Events to Track:", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
            </h5>
            <select class="form-select mb-3 selecttwo w-100" id="ga_selected_events" name="convsst_selected_events[ga][]" multiple="multiple" required data-placeholder="Select event">
              <?php
              $convsst_selected_events = unserialize(get_option('convsst_selected_events'));
              $convsst_all_pixel_event = $TVC_Admin_Helper->convsst_all_pixel_event();
              foreach ($convsst_all_pixel_event as $slug => $name) {
                $is_selected = empty($convsst_selected_events) ? "selected" : "";
                if (!empty($convsst_selected_events['ga'])) {
                  $is_selected =  in_array($slug, $convsst_selected_events['ga']) ? "selected" : "";
                }
              ?>
                <option value="<?php echo esc_attr($slug); ?>" <?php echo esc_attr($is_selected); ?>><?php echo esc_html($name); ?></option>
              <?php } ?>
            </select>
          </div>

        </div>



      </div>

      <input type="hidden" name="tracking_method" id="tracking_method" value="gtm">
    </div>
  </form>
</div>
<!-- Success Save Modal -->
<div class="modal fade" id="convsst_container_success_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-0 pb-0">

      </div>
      <div class="modal-body text-center p-0">
        <img style="width:184px;" src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/update_success_logo.png'); ?>">
        <h3 class="fw-normal pt-3">Container Created Successfully</h3>
        <span id="convsst_container_success_txt" class="mb-1 lh-lg"></span>
      </div>
      <div class="modal-footer border-0 pb-4 mb-1">
        <button class="btn conv-blue-bg m-auto text-white" data-bs-dismiss="modal">Done</button>
      </div>
    </div>
  </div>
</div>
<!-- Success Save Modal End -->

<!-- create container modal -->
<div class="modal fade" id="createContainerModal" tabindex="-1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createContainerModalLabel">Create GTM Container</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="account-list-div">
              <h5 class="fw-normal mb-1">
                <?php esc_html_e("Select Account To Create Container :", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
              </h5>
              <select class="form-select mb-3 selecttwo w-100" id="gtm_account_list" name="gtm_account_list">
                <option value="">Select GTM Account</option>
              </select>
            </div>
          </div>

        </div>
        <div class="row pt-3">
          <div class="col-md-8">
            <h5 class="fw-normal mb-1">Container Name</h5>
            <input type="text" name="container_input_name" id="container_input_name" style="width: 100%;">
          </div>
        </div>

        <div class="row pt-1 d-none conv-error">
          <div class="col-md-12">
            <span>Conversios container already exist with above account.</span>
          </div>
        </div>
        <div class="row pt-2">
          <div class="col-md-12">
            <p>Create Conversios container in selected account with pre build tag, trigger, variable and template.</p>
          </div>
        </div>
        <div class="row hidden-container-link-div">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn conv-cancel-btn" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn conv-blue-btn conv-text-white" id="create_gtm_container_btn">Create</button>
      </div>
    </div>
  </div>
</div>
<!-- create container modal -->
<?php
require_once("sstWebContainerDetailsHtml.php");
require_once("sstServerContainerDetailsHtml.php");

$js_code_1 = $js_code_2 = "";
if (isset($_GET['subscription_id']) && sanitize_text_field($_GET['subscription_id']) || $is_gtm_automatic_process === false) {
  $js_code_1 = "jQuery('#nav-automatic-tab').click()";
} else {
  $js_code_1 = "jQuery('#nav-manual-tab').click()";
}

if (isset($_GET['subscription_id']) && sanitize_text_field($_GET['subscription_id'])) { 
  $js_code_1 = "getSstWebContainer(true, false);
  jQuery('ul li:nth-child(1)').removeClass('stepper-deactivate');";
} else {
  $js_code_1 = "
  if (gtm_gmail != '') { // check if user is authenticated
    if (gtm_account_id != '' && gtm_container_id != '' && gtm_container_public_id != '') {
      getGtmAccountWithContainerDB(selectedOption, gtm_account_container_name, 'web');
      if (gtm_server_account_id == '' && gtm_server_container_id == '' && gtm_server_container_public_id == '') {
        getSstWebContainer(false, true);
      }
    } else {
      disableNextStep('collapseServerContainer', 'conv-pointer-none-opacity');
      getSstWebContainer(true, false);
    }

    if (gtm_server_account_id != '' && gtm_server_container_id != '' && gtm_server_container_public_id != '') {
      getGtmAccountWithContainerDB(selectedGtmServerOption, gtm_server_account_container_name, 'server');
    }

    jQuery('ul li:nth-child(1)').removeClass('stepper-deactivate');
  } else {
    jQuery('ul li:nth-child(1)').addClass('stepper-deactivate');
  }
  ";
}

wp_add_inline_script('convsst-admin', "
jQuery(function() {
  jQuery('.selecttwosearch').select2({
    containerCssClass: 'w-100',
    width: 'resolve'
  });

  jQuery('#gtm_account_container_list').select2();

  let plan_id = '". esc_js($plan_id) ."';
  let gtm_account_id = '". esc_js($gtm_web_account_id) ."';
  let gtm_container_id = '". esc_js($gtm_web_container_id) ."';
  let gtm_container_public_id = '". esc_js($gtm_web_container_publicId) ."';
  let gtm_account_container_name = '". esc_js($gtm_web_account_container_name) ."';
  let subscription_id = '". esc_js($tvc_data['subscription_id']). "';
  let selectedOption = gtm_account_id + '_' + gtm_container_id + '_' + gtm_container_public_id;

  let gtm_server_account_id = '". esc_js($gtm_server_account_id). "';
  let gtm_server_container_id = '". esc_js($gtm_server_container_id). "';
  let gtm_server_container_public_id = '". esc_js($gtm_server_container_publicId). "';
  let gtm_server_account_container_name = '". esc_js($gtm_server_account_container_name). "';
  let selectedGtmServerOption = gtm_server_account_id + '_' + gtm_server_container_id + '_' + gtm_server_container_public_id;

  let is_gtm_automatic_process = '". esc_js($is_gtm_automatic_process) ."';
  let gtm_gmail = '". esc_js($g_gtm_email). "';

  let sst_server_ip = '". esc_js($sst_server_ip). "';
  let sst_region = '". esc_js($sst_region). "';
  let store_id = '". esc_js($store_id). "';

  if ((is_gtm_automatic_process === true || is_gtm_automatic_process === 'true')) {
    jQuery('#nav-automatic-tab').click()
  } else {
    ".$js_code_1."
  }

  jQuery(document).on('change', 'form#gtmsstsettings_form', function() {

    let isAutomatic = (jQuery('#nav-automatic-tab').hasClass('active')) ? true : false
    if (isAutomatic) {
      let gtmIds = jQuery('#gtm_account_container_list').val();
      if (gtmIds != null && gtmIds.length > 2) {
        enableSaveBtn()
      } else {
        disableSaveBtn()
      }
      jQuery('.event-setting-div').hide();
    }else{
      jQuery('.event-setting-div').show();
      jQuery('#use_your_gtm_id').removeClass('conv-border-danger');
      jQuery('.conv-btn-connect').removeClass('conv-btn-connect-disabled');
      jQuery('.conv-btn-connect').addClass('conv-btn-connect-enabled-google');
      jQuery('.conv-btn-connect').text('Save');
    }
    
  });

  // Disable Save Button
  function disableSaveBtn() {

    jQuery('.conv-btn-connect').addClass('conv-btn-connect-disabled');
    jQuery('.conv-btn-connect').removeClass('conv-btn-connect-enabled-google');
    jQuery('.conv-btn-connect').text('Save');
  }
  // Enable save button
  function enableSaveBtn() {

    jQuery('.conv-btn-connect').removeClass('conv-btn-connect-disabled');
    jQuery('.conv-btn-connect').addClass('conv-btn-connect-enabled-google');
    jQuery('.conv-btn-connect').text('Save');
  }

  jQuery(document).on('click', '.conv-btn-connect-enabled-google', function(e) {
    e.preventDefault();
    convsst_change_loadingbar('show');
    saveData()
  });

  function saveData(type = '') {
    jQuery(this).addClass('disabled');
    var convsst_disabled_users_arr = jQuery('#convsst_disabled_users').val();
    var convsst_disabled_users = convsst_disabled_users_arr.length ? convsst_disabled_users_arr : [''];
    var convsst_selected_events_arr = {
      ga: jQuery('#ga_selected_events').val()
    };

    var convsst_selected_events = convsst_selected_events_arr;

    var tracking_method = jQuery('#tracking_method').val();
    let web_gtm_ids
    let web_account_id
    let web_container_id
    let web_container_publicId
    let web_gtm_account_container_name

    let server_gtm_ids
    let server_account_id
    let server_container_id
    let server_container_publicId
    let server_gtm_account_container_name

    
    web_gtm_ids = jQuery('#gtm_account_container_list').val();
    web_gtm_account_container_name = jQuery('#gtm_account_container_list option:selected').text();

    if (web_gtm_ids) {
      web_gtm_ids = web_gtm_ids.split('_');
      if (web_gtm_ids.length > 2) {
        web_account_id = web_gtm_ids[0] // account id
        web_container_id = web_gtm_ids[1] // container id
        web_container_publicId = web_gtm_ids[2] // container public id

        jQuery('#hidden_gtm_account_id').val(web_account_id);
        jQuery('#hidden_gtm_container_id').val(web_container_id);
        jQuery('#hidden_gtm_container_publicId').val(web_container_publicId);
      }
    }

    server_gtm_ids = jQuery('#server_gtm_account_container_list').val();
    server_gtm_account_container_name = jQuery('#server_gtm_account_container_list option:selected').text();

    if (server_gtm_ids) {
      server_gtm_ids = jQuery('#server_gtm_account_container_list').val().split('_');
      if (server_gtm_ids.length > 2) {
        server_account_id = server_gtm_ids[0]; // account id
        server_container_id = server_gtm_ids[1]; // container id
        server_container_publicId = server_gtm_ids[2]; // container public id

        jQuery('#hidden_server_gtm_account_id').val(server_account_id);
        jQuery('#hidden_server_gtm_container_id').val(server_container_id);
        jQuery('#hidden_server_gtm_container_publicId').val(server_container_publicId);
      }
    }

    let isAutomatic = (jQuery('#nav-automatic-tab').hasClass('active')) ? true : false;

    // container data
    let sst_web_container = isAutomatic ? web_container_publicId : jQuery('#sst_web_container').val()
    let sst_server_container = isAutomatic ? server_container_publicId : jQuery('#sst_server_container').val()

    let sst_region = ''
    let sst_server_container_config = ''
    let sst_server_ip = '';

    let sst_transport_url = (isAutomatic === true || isAutomatic === 'true') ? jQuery('#sst_transport_url').val() : jQuery('#manual_sst_transport_url').val();

    let is_sst_own_server = isAutomatic ? jQuery('#own_server').is(':checked') : false;

    sst_region = jQuery('#sst_region').val()
    sst_server_container_config = jQuery('#sst_server_container_config').val()
    sst_server_ip = jQuery('#sst_server_ip').val();

    let sst_cloud_run_name = jQuery('#sst_cloud_run_name').val()

    jQuery.ajax({
      type: 'POST',
      dataType: 'json',
      url: tvc_ajax_url,
      data: {
        action: 'convsst_save_pixel_data',
        pix_sav_nonce: '". esc_js(wp_create_nonce('pix_sav_nonce_val')) ."',
        convsst_options_data: {
          convsst_disabled_users: convsst_disabled_users,
          convsst_selected_events: convsst_selected_events,
          tracking_method: tracking_method,
          subscription_id: '". esc_js($tvc_data['subscription_id']) ."',
          sst_gtm_web_settings: {
            gtm_account_id: web_account_id,
            gtm_container_id: web_container_id,
            gtm_public_id: web_container_publicId,
            is_gtm_automatic_process: isAutomatic,
            gtm_account_container_name: web_gtm_account_container_name
          },
          sst_gtm_server_settings: {
            gtm_account_id: server_account_id,
            gtm_container_id: server_container_id,
            gtm_public_id: server_container_publicId,
            is_gtm_automatic_process: isAutomatic,
            gtm_account_container_name: server_gtm_account_container_name
          },
          sst_web_container: sst_web_container,
          sst_server_container: sst_server_container,
          sst_server_container_config: sst_server_container_config,
          sst_transport_url: sst_transport_url,
          sst_region: sst_region,
          sst_cloud_run_name: sst_cloud_run_name,
          sst_server_details: {
            sst_transport_url: sst_transport_url,
            sst_region: sst_region,
            sst_server_container_config: sst_server_container_config,
            is_sst_own_server: is_sst_own_server,
            sst_cloud_run_name: sst_cloud_run_name
          }
        },
        convsst_options_type: ['eeoptions', 'eeapidata', 'middleware', 'eeselectedevents'],
      },
      beforeSend: function() {
        let textMsg = '<br><br> <h5 class=\"text-danger\"> Please do not press refresh, as it may stop the integration.</h5>';
        getAlertMessage('info', 'Processing', 'Almost there! Usually it will take 1 to 5 min time to get this integration completed ' + textMsg, icon = 'info', '', '', iconImageSrc = '<img width=\"300\" height=\"300\" src=\"" . esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/Loading_icon.gif') . "\"/>', false);
      },
      success: function(response) {

        if (type == 'web_container') {
          let gtmIds = jQuery('#gtm_account_container_list').val().split('_');

          if (gtmIds.length > 2) {
            let account_id = gtmIds[0];
            let container_id = gtmIds[1];
            let container_publicId = gtmIds[2];

            jQuery('#hidden_gtm_account_id').val(account_id);
            jQuery('#hidden_gtm_container_id').val(container_id);
            jQuery('#hidden_gtm_container_publicId').val(container_publicId);

            let gtm_run_gtm_automation_nonce = '". esc_js(wp_create_nonce('gtm_run_gtm_automation_nonce')). "';

            let subscription_id = '". esc_js($tvc_data['subscription_id']). "';
            let workspace_id = 2;
            let isServerContainer = false;
            let isSSTContainer = true;

            let gtm_data = {
              action: 'convsst_run_gtm_automation',
              post: {
                account_id: account_id,
                container_id: container_id,
                subscription_id: subscription_id,
                workspace_id: workspace_id,
                isSSTContainer: isSSTContainer,
                isServerContainer: isServerContainer,
                gtm_run_gtm_automation_nonce: gtm_run_gtm_automation_nonce
              }
            }
            jQuery('#gtm_account_container_list').attr('disabled', true);
            jQuery('#collapseWebContainer').collapse('toggle');
            jQuery('ul li:nth-child(2)').removeClass('stepper-deactivate');
            runGtmAutomation(gtm_data);
            disableNextStep('create_container_data', 'conv-btn-save-disabled')
            jQuery('#create_container_link').css({
              'pointer-events': 'none',
              'opacity': '0.5'
            })
            jQuery('.web-container-setup-status').show();

            jQuery('.web-container-id').html('Web Container ID: ' + container_publicId)

            // enable server container set up 
            jQuery('#server_gtm_account_container_list').attr('disabled', false);
            removeDisableNextStep('collapseServerContainer', 'conv-pointer-none-opacity')
            jQuery('#create_server_container_link').css({
              'pointer-events': 'auto',
              'opacity': '1'
            })

            if (!jQuery('#collapseServerContainer').hasClass('show')) {
              jQuery('#collapseServerContainer').collapse('toggle')
            }
          }
        } else if (type == 'server_container') {

          let gtmIds = jQuery('#server_gtm_account_container_list').val().split('_');

          if (gtmIds.length > 2) {
            let account_id = gtmIds[0];
            let container_id = gtmIds[1];
            let container_publicId = gtmIds[2];

            jQuery('#hidden_server_gtm_account_id').val(account_id);
            jQuery('#hidden_server_gtm_container_id').val(container_id);
            jQuery('#hidden_server_gtm_container_publicId').val(container_publicId);

            let gtm_run_gtm_automation_nonce = '". esc_js(wp_create_nonce('gtm_run_gtm_automation_nonce')). "';
            let subscription_id = '". esc_js($tvc_data['subscription_id']). "';
            let workspace_id = 2;
            let isServerContainer = true;
            let isSSTContainer = true;
            let webContainerPublicId = jQuery('#gtm_account_container_list').val().split('_')[2]
            let gtm_data = {
              action: 'convsst_run_gtm_automation',
              post: {
                account_id: account_id,
                container_id: container_id,
                subscription_id: subscription_id,
                workspace_id: workspace_id,
                isSSTContainer: isSSTContainer,
                isServerContainer: isServerContainer,
                webContainerPublicId: webContainerPublicId,
                gtm_run_gtm_automation_nonce: gtm_run_gtm_automation_nonce
              }
            }
            runGtmAutomation(gtm_data);
            jQuery('ul li:nth-child(3)').removeClass('stepper-deactivate');

            // disable current step
            disableNextStep('create_server_container_data', 'conv-btn-save-disabled')
            jQuery('#create_server_container_link').css({
              'pointer-events': 'none',
              'opacity': '0.5'
            })
            jQuery('#server_gtm_account_container_list').attr('disabled', true);
            jQuery('.server-container-setup-status').show();
            jQuery('.server-container-id').html('Server Container ID: ' + container_publicId)

            // enable next step
            if (jQuery('#collapseServerContainer').hasClass('show')) {
              jQuery('#collapseServerContainer').collapse('toggle')
              jQuery('#collapseServerSetup').collapse('toggle')
            }
            jQuery('.server-set-up-main-div').removeClass('conv-pointer-none-opacity')
            jQuery('#conversios_server').click()
          }
        } else if (type == 'cloud_run') {
          jQuery('ul li:nth-child(4)').removeClass('stepper-deactivate');
          jQuery('.server-set-up-main-div').addClass('conv-pointer-none-opacity')
          jQuery('.server-cloud-run-setup-status').show();
          jQuery('.server-cloud-run-url').html('Server Set-up: ' + jQuery('#sst_transport_url').val())
          swal.close()
          if (jQuery('#collapseServerSetup').hasClass('show')) {
            jQuery('#collapseServerSetup').collapse('toggle')
          }
          jQuery('.tvc_google_signinbtn').hide();
          jQuery('#convsst_save_success_modal').modal('show');
        } else {
          swal.close()
          jQuery('#convsst_save_success_modal').modal('show');
        }
        convsst_change_loadingbar('hide');

      }
    });
  }

  var is_own_server = '". esc_js($is_own_server). "';
  var sst_transport_url = '". esc_js($sst_transport_url). "';

  ".$js_code_2."

  function disableServerConfiguration() {
    if ((is_own_server === true || is_own_server === 'true') && sst_transport_url != '') {
      jQuery('.default-server-div').hide();
      jQuery('.own-server-div').show()
      jQuery('ul li:nth-child(4)').removeClass('stepper-deactivate');
      if (jQuery('#collapseServerSetup').hasClass('show')) {
        jQuery('#collapseServerSetup').collapse('toggle');
      }
      jQuery('.server-set-up-main-div').addClass('conv-pointer-none-opacity')
      jQuery('.tvc_google_signinbtn').hide();
      jQuery('.server-cloud-run-setup-status').show();
      jQuery('.server-cloud-run-url').html('Server Set-up:  ' + sst_transport_url)

    } else if ((is_own_server === false || is_own_server === 'false')) {

      if (sst_region != '' && sst_transport_url != '') {

        jQuery('.server-set-up-main-div').addClass('conv-pointer-none-opacity')
        jQuery('.server-detail-div').show()
        jQuery('#create_cloud_run').hide()
        jQuery('ul li:nth-child(4)').removeClass('stepper-deactivate');
        if (jQuery('#collapseServerSetup').hasClass('show')) {
          jQuery('#collapseServerSetup').collapse('toggle');
        }
        jQuery('.tvc_google_signinbtn').hide();
        jQuery('.server-cloud-run-setup-status').show();
        jQuery('.server-cloud-run-url').html('Server Set-up:  ' + sst_transport_url)
      } else if (sst_region == '' && sst_server_ip == '' && sst_transport_url != '' && (is_gtm_automatic_process === true || is_gtm_automatic_process === 'true')) {

        jQuery('.server-set-up-main-div').addClass('conv-pointer-none-opacity')
        jQuery('.default-server-div').hide();
        jQuery('.own-server-div').show();
        jQuery('ul li:nth-child(4)').removeClass('stepper-deactivate');
        jQuery('.server-cloud-run-url').html('Server Set-up:  ' + sst_transport_url)
        disableNextStep('save_cloud_run', 'conv-btn-save-disabled')
        jQuery('#own_server').click();
      } else {
        return;
      }
    }
  }

  function getGtmAccountWithContainerDB(selectedOption = '', selectedContainerName = '', usage_context = '') {
    if (usage_context == 'web') {
      let accountContainerEle = jQuery('#gtm_account_container_list');
      accountContainerEle.select2();
      accountContainerEle
        .find('option')
        .remove()
        .end()
        .append('<option value=\"\">Select Web Container</option>')
        .val('')

      let data = {
        id: selectedOption,
        text: selectedContainerName
      };
      let newOption = new Option(data.text, data.id, true, true);
      accountContainerEle.append(newOption).trigger('change');
      if (selectedOption.split('_')[0] != '') {
        jQuery('#create_container_data').addClass('conv-btn-save-disabled')
        jQuery('#create_container_link').css({
          'pointer-events': 'none',
          'opacity': '0.5'
        })
        jQuery('ul li:nth-child(2)').removeClass('stepper-deactivate');
        jQuery('.web-container-setup-status').show();
        jQuery('.web-container-id').html('Web Container ID:' + selectedOption.split('_')[2])
      }

    } else {
      if (jQuery('#gtm_account_container_list').val() != '') {
        let accountServerContainerEle = jQuery('#server_gtm_account_container_list');
        accountServerContainerEle.select2();
        accountServerContainerEle
          .find('option')
          .remove()
          .end()
          .append('<option value=\"\">Select Server Container</option>')
          .val('')

        let data = {
          id: selectedOption,
          text: selectedContainerName
        };
        let newOption = new Option(data.text, data.id, true, true);
        accountServerContainerEle.append(newOption).trigger('change');
        if (selectedOption.split('_')[0] != '') {
          jQuery('#create_server_container_data').addClass('conv-btn-save-disabled')

          jQuery('#create_server_container_link').css({
            'pointer-events': 'none',
            'opacity': '0.5'
          })

          jQuery('.progress-steps li:nth-child(3)').removeClass('stepper-deactivate');
          if (jQuery('#collapseServerSetup').hasClass('show')) {
            jQuery('#collapseServerSetup').collapse('toggle');
          }
          jQuery('.server-set-up-main-div').removeClass('conv-pointer-none-opacity')
          jQuery('.server-container-setup-status').show();
          jQuery('.server-container-id').html('Server Container ID: ' + selectedOption.split('_')[2])
        }
      } else {
        jQuery('#create_server_container_link').css({
          'pointer-events': 'none',
          'opacity': '0.5'
        })
      }
      disableServerConfiguration();
    }
    disableSaveBtn()
  }

  function getSstWebContainer(isDisabled = false, isServerContainer = false) {
    var get_gtm_account_with_container_nonce = '". esc_js(wp_create_nonce('get_gtm_account_with_container_nonce')) ."';
    let gtm_data = {
      subscription_id: subscription_id,
      action: 'convsst_get_gtm_account_with_container',
      get_gtm_account_with_container_nonce: get_gtm_account_with_container_nonce,
    }

    jQuery.ajax({
      type: 'POST',
      dataType: 'json',
      url: tvc_ajax_url,
      data: gtm_data,
      beforeSend: function() {
        convsst_change_loadingbar('show');
      },
      success: function(response) {

        convsst_change_loadingbar('hide');
        if (response.status == 200) {

          let data = response.data;

          if (jQuery('#nav-automatic-tab').hasClass('active')) {
            if (data.length == 0) {
              getAlertMessage(
                'info', 
                'Error', 
                message = 'There is no GTM account associated with the email address which you authenticated. Please create a GTM Account or sign in with a different account.', 
                icon = 'info', 
                buttonText = 'Try again', 
                buttonColor = '#FCCB1E', 
                iconImageSrc = '<img src=\"" . esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/convsst_error_logo.png') . "\"/>'
            );
            }
          }

          var accountContainerEle = jQuery('#gtm_account_container_list');
          accountContainerEle.select2();
          // remove previous options  from container dropdown
          accountContainerEle
            .find('option')
            .remove()
            .end()
            .append('<option value=\"\">Select Web Container</option>')
            .val('')

          jQuery.each(data, function(key, value) {
            jQuery.each(value, function(aKey, aValue) {
              jQuery.each(aValue['container'], function(cKey, cValue) {
                if (cValue['usageContext'][0] != 'server') {

                  let text = aValue['name'];
                  let accountId = aValue['accountId'];
                  let containerId = cValue['containerId'];
                  let containerPublicId = cValue['publicId'];
                  let id = accountId + '_' + containerId + '_' + containerPublicId
                  text += '-' + cValue['name']
                  text += '-' + containerPublicId
                  let option = jQuery('<option/>', {
                    value: id,
                    text: text
                  });
                  accountContainerEle.append(option);
                }
              })
            })
          })

          disableNextStep('create_server_container_data', 'conv-btn-save-disabled')
          disableNextStep('create_container_data', 'conv-btn-save-disabled')
          jQuery('#gtm_account_container_list').val('').trigger('change');
          jQuery('#create_server_container_link').css({
            'pointer-events': 'none',
            'opacity': '0.5'
          })
          // check if selected container exists in list of containers 
          let isWebContainerExists = false;
          jQuery('#gtm_account_container_list > option').each(function() {
            if (selectedOption == this.value) {
              if (selectedOption.split('_').length > 2 && selectedOption.split('_')[0] != '' && selectedOption.split('_')[1] != '' && selectedOption.split('_')[2] != '') {
                jQuery('#gtm_account_container_list').val(selectedOption).trigger('change');
                jQuery('#create_container_data').addClass('conv-btn-save-disabled')
                jQuery('#gtm_account_container_list').attr('disabled', true);
                jQuery('ul li:nth-child(2)').removeClass('stepper-deactivate');
                jQuery('#create_container_link').css({
                  'pointer-events': 'none',
                  'opacity': '0.5'
                })
                isWebContainerExists = true;
                jQuery('.web-container-setup-status').show();
                jQuery('.web-container-id').html('Web Container ID: ' + selectedOption.split('_')[2])
              }
            }

          });

          if (jQuery('#gtm_account_container_list').val() != '') {
            jQuery('#gtm_account_container_list').attr('disabled', isDisabled);
          } else {
            jQuery('#gtm_account_container_list').attr('disabled', false);
            jQuery('#collapseWebContainer').collapse('toggle');
          }

          if (isWebContainerExists) {
            getSstServerContainer(data, false, true, isWebContainerExists)
          } else {
            getSstServerContainer(data, true, true, isWebContainerExists)
          }

          if (!isDisabled) {
            jQuery('.create-container-link').addClass('col-md-12');
          }

        } else {
          var errors = JSON.parse(response.errors)

          if (errors['subscription_id'] != undefined && errors['subscription_id'].length > 0) {            
            getAlertMessage(
              'error', 
              'Error', 
              message = errors['subscription_id'][0], 
              icon = 'error', 
              buttonText = 'Try again', 
              buttonColor = '#FCCB1E', 
              iconImageSrc = '<img src=\"" . esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/convsst_error_logo.png') . "\"/>'
          );
          }
        }
      }
    });
  }

  function getSstServerContainer(data = [], isDisabled = false, isServerContainer = true, isWebContainerExists = false) {

    if (data.length == 0) {
      var get_gtm_account_with_container_nonce = '". esc_js(wp_create_nonce('get_gtm_account_with_container_nonce')). "';
      let gtm_data = {
        subscription_id: subscription_id,
        action: 'convsst_get_gtm_account_with_container',
        get_gtm_account_with_container_nonce: get_gtm_account_with_container_nonce,
      }

      jQuery.ajax({
        type: 'POST',
        dataType: 'json',
        url: tvc_ajax_url,
        data: gtm_data,
        beforeSend: function() {
          convsst_change_loadingbar('show');
        },
        success: function(response) {

          convsst_change_loadingbar('hide');

          if (response.status == 200) {

            let data = response.data;
            displayServerContainer(data, false, true);

          } else {
            var errors = JSON.parse(response.errors)
          }
        }
      });
    } else {
      displayServerContainer(data, isDisabled, isServerContainer, isWebContainerExists);
    }

  }

  function displayServerContainer(data = [], isDisabled = false, isServerContainer = true, isWebContainerExists = false) {

    var serverAccountContainerEle = jQuery('#server_gtm_account_container_list');
    serverAccountContainerEle.select2();
    serverAccountContainerEle
      .find('option')
      .remove()
      .end()
      .append('<option value=\"\">Select Server Container</option>')
      .val('')

    jQuery.each(data, function(key, value) {
      jQuery.each(value, function(aKey, aValue) {
        jQuery.each(aValue['container'], function(cKey, cValue) {
          if (cValue['usageContext'][0] == 'server') {
            let text = aValue['name'];
            let accountId = aValue['accountId'];
            let containerId = cValue['containerId'];
            let containerPublicId = cValue['publicId'];
            let id = accountId + '_' + containerId + '_' + containerPublicId
            text += '-' + cValue['name']
            text += '-' + containerPublicId
            let option = jQuery('<option/>', {
              value: id,
              text: text
            });
            serverAccountContainerEle.append(option);
          }
        })
      })
    })

    jQuery('#server_gtm_account_container_list').val('').trigger('change');


    // check if selected container exists in list of containers 
    jQuery('#server_gtm_account_container_list > option').each(function() {
      if (selectedGtmServerOption == this.value) {
        if (selectedGtmServerOption.split('_').length > 2 && selectedGtmServerOption.split('_')[0] != '' && selectedGtmServerOption.split('_')[1] != '' && selectedGtmServerOption.split('_')[2] != '') {
          jQuery('#server_gtm_account_container_list').val(selectedGtmServerOption).trigger('change');

          jQuery('#create_server_container_data').addClass('conv-btn-save-disabled')
          jQuery('#create_server_container_link').css({
            'pointer-events': 'none',
            'opacity': '0.5'
          })
          jQuery('ul li:nth-child(3)').removeClass('stepper-deactivate');
          if (sst_transport_url == '') {
            jQuery('#collapseServerSetup').collapse('toggle');
          }
          jQuery('.server-set-up-main-div').removeClass('conv-pointer-none-opacity')
          jQuery('.server-container-setup-status').show();
          jQuery('.server-container-id').html('Server Container ID: ' + selectedGtmServerOption.split('_')[2])
        }
      }
    });

    if (jQuery('#server_gtm_account_container_list').val() != '') {
      jQuery('#server_gtm_account_container_list').attr('disabled', true);
      jQuery('#gtm_account_container_list').attr('disabled', true);
    } else {
      jQuery('#server_gtm_account_container_list').attr('disabled', isDisabled);

      if (isWebContainerExists == true) {
        jQuery('#gtm_account_container_list').attr('disabled', true);
        jQuery('#collapseServerContainer').collapse('toggle');
      }
      jQuery('.server-set-up-main-div').addClass('conv-pointer-none-opacity');
    }
    disableServerConfiguration();
  }
  /*
    *create new container in selected gtm account 
    */
  jQuery(document).on('click', '#create_gtm_container_btn', function(e) {
    e.preventDefault();
    if (jQuery('#gtm_account_list').val() != '') {
      let gtm_create_container_nonce = '". esc_js(wp_create_nonce('gtm_create_container_nonce')). "';
      let account_id = parseInt(jQuery('#gtm_account_list').val());

      let usage_context = (jQuery('#container_link_click').val() == 'create_server_container_link') ? 'server' : 'web';
      let container_input_name = jQuery('#container_input_name').val();

      let gtm_data = {
        action: 'convsst_create_gtm_container',
        post: {
          subscription_id: subscription_id,
          gtm_create_container_nonce: gtm_create_container_nonce,
          account_id: account_id, 
          usage_context: usage_context,
          name: container_input_name
        }
      }
      jQuery('.conv-error').addClass('d-none');

      // create container with selected account
      jQuery.ajax({
        type: 'POST',
        dataType: 'json',
        url: tvc_ajax_url,
        data: gtm_data,
        beforeSend: function() {
          convsst_change_loadingbar('show');
        },
        success: function(response) {
          convsst_change_loadingbar('hide');
          jQuery('#createContainerModal').modal('hide');

          if (response.status == 200) {
            let accountName = jQuery('#gtm_account_list option:selected').text()
            let data = {
              id: account_id + '_' + response.data.containerId + '_' + response.data.publicId,
              text: accountName + '-' + response.data.name + '-' + response.data.publicId
            };
            let newOption = new Option(data.text, data.id, true, true);
            if (response.data.usageContext[0] == 'web') {
              jQuery('#gtm_account_container_list').append(newOption).trigger('change');
              selectedOption = data.id
              jQuery('#create_container_data').click()
            } else {
              jQuery('#server_gtm_account_container_list').append(newOption).trigger('change');
              selectedGtmServerOption = data.id
              jQuery('#create_server_container_data').click()
            }

          } else {
            getAlertMessage(
                'error', 
                'Error', 
                message = 'Conversios Container already exists in your account.', 
                icon = 'error', 
                buttonText = 'Try again', 
                buttonColor = '#FCCB1E', 
                iconImageSrc = '<img src=\"" . esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/convsst_error_logo.png') . "\"/>'
            );
          }
        }
      });
    }

  })

  // run gtm automatiuon api to import container data into gtm account/container
  function runGtmAutomation(gtm_data = []) {

    jQuery.ajax({
      type: 'POST',
      dataType: 'json',
      url: tvc_ajax_url,
      data: gtm_data,
      beforeSend: function() {

      },
      success: function(response) {
        swal.close()
        if (response.status == 200) {

        } else {

        }
      },
      error: function(error) {
        swal.close()
      }
    });
  }

  jQuery('#create_container_link,#create_server_container_link').on('click', function(e) {
    let container_link_click = jQuery(this).attr('id');
    jQuery('#gtm_account_list').select2({
      dropdownParent: jQuery('#createContainerModal')
    });
    jQuery('#createContainerModal').modal('show');
    jQuery('#container_input_name').val('')
    let container_link_click_html = '<input type=\"hidden\" name=\"container_link_click\" value=\"' + container_link_click + '\" id=\"container_link_click\"></input>';

    jQuery('.hidden-container-link-div').html(container_link_click_html);
    let gtm_account_nonce = '". esc_js(wp_create_nonce('gtm_account_nonce')) ."';
    let gtm_data = {
      subscription_id: subscription_id, //subscription_id  
      gtm_account_nonce: gtm_account_nonce,
      action: 'convsst_get_gtm_account_list',
    }

    jQuery.ajax({
      type: 'POST',
      dataType: 'json',
      url: tvc_ajax_url,
      data: gtm_data,
      beforeSend: function() {
        convsst_change_loadingbar('show');

      },
      success: function(response) {
        convsst_change_loadingbar('hide');
        if (response.status == 200) {
          let data = response.data;
          let accountEle = jQuery('#gtm_account_list');
          // remove previous options  from container dropdown
          accountEle
            .find('option')
            .remove()
            .end()
            .append('<option value=\"\">Select GTM Account</option>')
            .val('')

          jQuery.each(data, function(key, value) {
            jQuery.each(value, function(aKey, aValue) {
              let option = jQuery('<option/>', {
                value: aValue['accountId'],
                text: aValue['name']
              });
              accountEle.append(option);
            })
          })
        } else {
          // account might be already created
          getAlertMessage(
              'error', 
              'Error', 
              message = 'There is an issue in fetching GTM Account.', 
              icon = 'error', 
              buttonText = 'Try again', 
              buttonColor = '#FCCB1E', 
              iconImageSrc = '<img src=\"" . esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/convsst_error_logo.png') . "\"/>'
          );

        }
      }
    });

    jQuery('#gtm_account_list').siblings('.select2:first').attr('style', 'width: 260px');
    jQuery('.conv-error').addClass('d-none')
  })
  
  if (JSON.parse(localStorage.getItem('webContainerDetails'))) {
    createDetailViewPageData(JSON.parse(localStorage.getItem('webContainerDetails')).data.containerVersion, 'web')
  } else {
    getGlobalSSTContainerJson(false)
  }

  if (JSON.parse(localStorage.getItem('serverContainerDetails'))) {
    createDetailViewPageData(JSON.parse(localStorage.getItem('serverContainerDetails')).data.containerVersion, 'server')
  } else {
    getGlobalSSTContainerJson(true)
  }

  function getGlobalSSTContainerJson(isServerJson = false) {
    let gtm_global_container_json_nonce = '". esc_js(wp_create_nonce('gtm_global_container_json_nonce')) ."';
    var is_sst_server_json = (isServerJson != '') ? isServerJson : '';
    let gtm_data = {
      action: 'convsst_get_global_container_json',
      gtm_global_container_json_nonce: gtm_global_container_json_nonce,
      is_sst_server_json: isServerJson
    }

    jQuery.ajax({
      type: 'POST',
      dataType: 'json',
      url: tvc_ajax_url,
      data: gtm_data,
      beforeSend: function() {

      },
      success: function(response) {
        if (response.status == 200) {
          if (response.data.containerVersion['client'] == undefined) {
            localStorage.setItem('webContainerDetails', JSON.stringify(response));
            createDetailViewPageData(response.data.containerVersion, 'web')
          } else if (is_sst_server_json === true || is_sst_server_json === 'true') {
            localStorage.setItem('serverContainerDetails', JSON.stringify(response));
            createDetailViewPageData(response.data.containerVersion, 'server')
          }

        }
      }
    });
  }

  function createDetailViewPageData(containerData, jsonType = 'web') {
    let tagHtml = ''
    jQuery.each(containerData.tag, function(key, value) {
      tagHtml += '<div ng-repeat=\"entityName in ctrl.newEntities\">' + value.name + '</div>';
    });
    jQuery('.' + jsonType + '-tag-list').append(tagHtml);
    jQuery('.' + jsonType + '-tag-count').text(containerData.tag.length)
    let triggerHtml = ''
    jQuery.each(containerData.trigger, function(key, value) {
      triggerHtml += '<div ng-repeat=\"entityName in ctrl.newEntities\">' + value.name + '</div>';
    });
    jQuery('.' + jsonType + '-trigger-list').append(triggerHtml);
    jQuery('.' + jsonType + '-trigger-count').text(containerData.trigger.length)
    let variableHtml = ''
    jQuery.each(containerData.variable, function(key, value) {

      variableHtml += '<div ng-repeat=\"entityName in ctrl.newEntities\">' + value.name + '</div>';
    });
    jQuery('.' + jsonType + '-variable-list').append(variableHtml);
    jQuery('.' + jsonType + '-variable-count').text(containerData.variable.length)
    let customTemplateHtml = ''
    jQuery.each(containerData.customTemplate, function(key, value) {

      customTemplateHtml += '<div ng-repeat=\"entityName in ctrl.newEntities\">' + value.name + '</div>';
    });
    jQuery('.' + jsonType + '-customTemplate-list').append(customTemplateHtml);
    jQuery('.' + jsonType + '-template-count').text(containerData.customTemplate.length)

    let clientHtml = ''
    if (containerData['client'] != undefined) {
      jQuery.each(containerData.tag, function(key, value) {

        clientHtml += '<div ng-repeat=\"entityName in ctrl.newEntities\">' + value.name + '</div>';
      });
      jQuery('.' + jsonType + '-client-list').append(clientHtml);
      jQuery('.' + jsonType + '-client-count').text(containerData.client.length)
    }

  }

  // GTM Account change event handler
  jQuery('#gtm_account_container_list').on('change', function(e) {
    if (jQuery(this).val() != '') {
      jQuery('#import_container_btn').removeClass('conv-link-disabled');
      jQuery('.step-two').removeClass('stepper-conv-bg-grey')
    } else {
      jQuery('#import_container_btn').addClass('conv-link-disabled');
      jQuery('.step-two').addClass('stepper-conv-bg-grey')
    }
  })

  // change text of the container details modal collapse
  jQuery('.collapseExample').on('hide.bs.collapse', function() {
    jQuery('#details-collapse').text('View Details')
  })
  jQuery('.collapseExample').on('show.bs.collapse', function() {
    jQuery('#details-collapse').text('Close Details')
  })

  // Arrow up and down rotation
  jQuery('.collapseEventSetting').on('show.bs.collapse', function() {
    jQuery('.conv-arrow').removeClass('conv-down-arrow').addClass('conv-up-arrow')
  })
  jQuery('.collapseEventSetting').on('hide.bs.collapse', function() {
    jQuery('.conv-arrow').removeClass('conv-up-arrow').addClass('conv-down-arrow')
  })

  jQuery('.conv-nav-tab').on('click', function() {
    jQuery('form#gtmsstsettings_form').change();
  })

  jQuery('#gtm_account_list').on('change', function() {
    jQuery('.conv-error').addClass('d-none')
  })

  jQuery(document).on('click', '#create_server_container_data', function(e) {
    e.preventDefault();
    saveData('server_container');
  });
  jQuery(document).on('click', '#create_container_data', function(e) {
    e.preventDefault();
    saveData('web_container')
  });



  jQuery('#sst_web_container,#sst_server_container,#sst_server_container_config,input[name=sst_transport_url],#sst_region').on('change', function() {
    if (jQuery(this).val() != '') {
      enableSaveBtn();
      if (jQuery('#sst_server_container_config').val() != '' && jQuery('#sst_server_container_config').val() != '') {
        removeDisableNextStep('create_cloud_run', 'conv-btn-save-disabled')
      }
    } else {
      disableSaveBtn();
      disableNextStep('create_cloud_run', 'conv-btn-save-disabled');
    }
  })
  jQuery('#server_gtm_account_container_list').on('change', function() {
    if (jQuery(this).val() != '') {
      removeDisableNextStep('create_server_container_data', 'conv-btn-save-disabled');
    } else {
      disableNextStep('create_server_container_data', 'conv-btn-save-disabled')
    }
  });
  jQuery('#gtm_account_container_list').on('change', function() {

    if (jQuery(this).val() != '') {
      removeDisableNextStep('create_container_data', 'conv-btn-save-disabled');
    } else {
      disableNextStep('create_container_data', 'conv-btn-save-disabled')
    }
  });
  jQuery('.collapse').on('show.bs.collapse', function() {

    jQuery(this).prev().find('svg').css({
      'transform': 'rotate(180deg)'
    })
  });

  jQuery('.collapse').on('hide.bs.collapse', function() {

    jQuery(this).prev().find('svg').css({
      'transform': 'rotate(0deg)'
    })
  });
  jQuery('#conversios_server').on('click', function() {
    if (jQuery(this).is(':checked')) {
      jQuery('.default-server-div').show();
      jQuery('.own-server-div').hide()
      disableNextStep('save_cloud_run', 'conv-btn-save-disabled')
    }

  });
  jQuery('#own_server').on('click', function() {
    if (jQuery(this).is(':checked')) {
      jQuery('.default-server-div').hide();
      jQuery('.own-server-div').show();
      if (jQuery('#own_sst_transport_url').val() != '') {
        removeDisableNextStep('save_cloud_run', 'conv-btn-save-disabled')
      } else {
        disableNextStep('save_cloud_run', 'conv-btn-save-disabled')
      }
    }
  })
  jQuery('#own_sst_transport_url').on('change', function() {

    if (jQuery(this).val() != '' && jQuery('#own_server').is(':checked')) {
      removeDisableNextStep('save_cloud_run', 'conv-btn-save-disabled')
    } else {
      disableNextStep('save_cloud_run', 'conv-btn-save-disabled');
    }
  })

  function disableNextStep(el, cl) {
    jQuery('#' + el).addClass(cl);
  }

  function removeDisableNextStep(el, cl) {
    jQuery('#' + el).removeClass(cl);
  }

  jQuery('#create_cloud_run').on('click', function(e) {
    e.preventDefault();

    let create_cloud_nonce = '". esc_js(wp_create_nonce('create_cloud_nonce')) ."';
    let sst_region = jQuery('#sst_region').val()
    let sst_config = jQuery('#sst_server_container_config').val()
    let sstAccount = jQuery('#server_gtm_account_container_list').val().split('_');
    let sst_server_account_id = sstAccount[0];
    let sst_server_container_id = sstAccount[1];
    let sst_container_name = jQuery('#server_gtm_account_container_list option:selected').text().split('-')[1];
    let cloud_run_data = {
      action: 'convsst_create_cloud_run',
      post: {
        subscription_id: subscription_id,
        create_cloud_nonce: create_cloud_nonce,
        sst_region: sst_region,
        sst_config: sst_config,
        store_id: store_id,
        sst_server_account_id: sst_server_account_id,
        sst_server_container_id: sst_server_container_id,
        sst_server_container_name: sst_container_name
      }
    }

    jQuery.ajax({
      type: 'POST',
      dataType: 'json',
      url: tvc_ajax_url,
      data: cloud_run_data,
      beforeSend: function() {
        let textMsg = '<br><br> <h5 class=\"text-danger\"> Please do not press refresh, as it may stop the integration.</h5>';
        getAlertMessage(
            'info', 
            'Processing', 
            'Almost there! Usually it will take 1 to 5 min time to get this integration completed ' + textMsg, 
            icon = 'info', 
            '', 
            '', 
            iconImageSrc = '<img width=\"300\" height=\"300\" src=\"" . esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/Loading_icon.gif') . "\"/ >', 
            false
        );
      },
      success: function(response) {
        swal.close()
        jQuery('#sst_transport_url').val(response['tagging_server_url']);
        jQuery('.transport-url').text(response['tagging_server_url'])
        jQuery('#sst_cloud_run_name').val(response['cloud_run_name'])
        jQuery('.server-detail-div').show();
        jQuery('#create_cloud_run').hide()
        removeDisableNextStep('save_cloud_run', 'conv-btn-save-disabled')

      },
      error: function(error) {
        swal.close()
      }
    });

  });

  jQuery('#save_cloud_run').on('click', function(e) {
    e.preventDefault();
    disableNextStep('save_cloud_run', 'conv-btn-save-disabled')
    saveData('cloud_run');

  })

  function getAlertMessage(type = 'Success', title = 'Success', message = '', icon = 'success', buttonText = 'Done', buttonColor = '#1085F1', iconImageTag = '', showBtn = true) {
    Swal.fire({
      type: type,
      icon: icon,
      title: title,
      showCancelButton: showBtn,
      showConfirmButton: showBtn,
      confirmButtonText: buttonText,
      confirmButtonColor: buttonColor,
      html: message,
    })
    let swalContainer = Swal.getContainer();
    jQuery(swalContainer).find('.swal2-icon-show').removeClass('swal2-' + icon).removeClass('swal2-icon')
    jQuery('.swal2-icon-show').html(iconImageTag)

  }

  jQuery('#collapseServerSetup').on('show.bs.collapse hide.bs.collapse', function(e) {
    if (e.type == 'show') {
      jQuery('.server-set-up-main-div').closest('li').removeClass('reduceHeight')
    } else {
      jQuery('.server-set-up-main-div').closest('li').addClass('reduceHeight')
    }
  })

}); 

");
?>
