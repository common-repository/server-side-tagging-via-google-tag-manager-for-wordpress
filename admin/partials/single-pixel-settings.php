<?php
if (!defined('ABSPATH')) {
	exit;
}
$pixel_settings_arr = array(
    "gtmsettings" => array(
        "logo" => "/admin/images/logos/convsst_gtm_logo.png",
        "title" => "Google Tag Manager",
        "topnoti" => "Use your own Google Tag Manager account to increase the page speed and customize events as per your requirements."
    ),
    "gtmsstsettings" => array(
        "logo" => "/admin/images/logos/convsst_sstgtm_logo.svg",
        "title" => "Google Tag Manager - Server Side ",
    ),
    "gasettings" => array(
        "logo" => "/admin/images/logos/convsst_ganalytics_logo.png",
        "title" => "Google Analytics 4",
        "topnoti" => "GA4 takes upto 48 hours to reflect data in your Google Analytics account. Monitor it from Conversios GA4 reporting dashboard."
    ),
    "gadssettings" => array(
        "logo" => "/admin/images/logos/convsst_gads_logo.png",
        "title" => "Google Ads Conversion Tracking",
        "topnoti" => "Enabling Google Ads enhanced conversion along with Google Ads conversion tracking helps in campaign performance."
    ),
    "fbsettings" => array(
        "logo" => "/admin/images/logos/convsst_meta_logo.png",
        "title" => "Facebook Pixel & Facebook Conversions API (Meta)",
        "topnoti" => "Enable FBCAPI along with FB pixel for higher accuracy and better campaign performance."
    ),
    "bingsettings" => array(
        "logo" => "/admin/images/logos/convsst_bing_logo.png",
        "title" => "Microsoft Ads Pixel (Bing)",
    ),
    "twittersettings" => array(
        "logo" => "/admin/images/logos/convsst_twitter_logo.png",
        "title" => "Twitter Pixel",
    ),
    "pintrestsettings" => array(
        "logo" => "/admin/images/logos/convsst_pint_logo.png",
        "title" => "Pinterest Pixel",
    ),
    "snapchatsettings" => array(
        "logo" => "/admin/images/logos/convsst_snap_logo.png",
        "title" => "Snapchat Pixel & Conversion API",
    ),
    "tiktoksettings" => array(
        "logo" => "/admin/images/logos/convsst_tiktok_logo.png",
        "title" => "TikTok Pixel & Events API",
    ),
    "customintgrationssettings" => array(
        "logo" => "/admin/images/logos/convsst_event_track_custom.png",
        "title" => "Event Tracking - Custom Integration",
    ),
    "gmcsettings" => array(
        "logo" => "/admin/images/logos/convsst_gmc_logo.png",
        "title" => "Google Merchant Center Account",
        "topnoti" => "Product feed to Google Merchant Center helps you improve your product's visibility in Google search results and helps to optimize your Google Campaigns resulting in high ROAS."
    ),
    "tiktokBusinessSettings" => array(
        "logo" => "/admin/images/logos/convsst_tiktok_logo.png",
        "title" => "TikTok Business Account",
        "topnoti" => "Product feed to TikTok catalog help you to run ads on tiktok for your product and reach out to more than 900 Million people."
    ),
    "metasettings" => array(
        "logo" => "/admin/images/logos/convsst_fb_catalog_logo.png",
        "title" => "Facebook Catalog",
    ),
);

$subpage = (isset($_GET["subpage"]) && $_GET["subpage"] != "") ? sanitize_text_field($_GET["subpage"]) : "";
$version = CONVSST_PLUGIN_VERSION;

$googleDetail = "";
$tracking_option = "UA";
$login_customer_id = "";

$TVC_Admin_Helper = new TVC_Admin_Helper();
$customApiObj = new ConvsstCustomApi();
$app_id = CONVSST_APP_ID;
//get user data
$ee_options = $TVC_Admin_Helper->get_ee_options_settings();
$ee_additional_data = $TVC_Admin_Helper->get_ee_additional_data();
$get_ee_options_data = $TVC_Admin_Helper->get_ee_options_data();
$tvc_data = $TVC_Admin_Helper->get_store_data();

$subscriptionId =  $ee_options['subscription_id'];

$url = $TVC_Admin_Helper->get_onboarding_page_url();
$is_refresh_token_expire = false; //$TVC_Admin_Helper->is_refresh_token_expire();

//get badge settings
$convBadgeVal = isset($ee_options['convsst_show_badge']) ? $ee_options['convsst_show_badge'] : "";
$convBadgePositionVal = isset($ee_options['convsst_badge_position']) ? $ee_options['convsst_badge_position'] : "";

//check last login for check RefreshToken
$g_mail = get_option('convsst_customer_gmail');
$tvc_data['g_mail'] = "";
if ($g_mail) {
    $tvc_data['g_mail'] = sanitize_email($g_mail);
}


//check if redirected from the authorization
if (isset($_GET['subscription_id']) && sanitize_text_field($_GET['subscription_id'])) {
    $subscriptionId = sanitize_text_field($_GET['subscription_id']);
    if (isset($_GET['g_mail']) && sanitize_email($_GET['g_mail'])) {
        $tvc_data['g_mail'] = sanitize_email($_GET['g_mail']);
        $ee_additional_data = $TVC_Admin_Helper->get_ee_additional_data();
        $ee_additional_data['ee_last_login'] = sanitize_text_field(current_time('timestamp'));
        $TVC_Admin_Helper->set_ee_additional_data($ee_additional_data);
        $is_refresh_token_expire = false;
    }
}

$resource_center_data = array();
//get account settings from the api
if ($subscriptionId != "") {
    $google_detail = $customApiObj->getGoogleAnalyticDetail($subscriptionId);

    if (property_exists($google_detail, "error") && $google_detail->error == false) {
        if (property_exists($google_detail, "data") && $google_detail->data != "") {
            $googleDetail = $google_detail->data;
            $tvc_data['subscription_id'] = $googleDetail->id;
            $tvc_data['access_token'] = base64_encode(sanitize_text_field($googleDetail->access_token));
            $tvc_data['refresh_token'] = base64_encode(sanitize_text_field($googleDetail->refresh_token));
            $plan_id = $googleDetail->plan_id;
            $login_customer_id = $googleDetail->customer_id;
            $tracking_option = $googleDetail->tracking_option;
            if ($googleDetail->tracking_option != '') {
                $defaulSelection = 0;
            }
            $rcd_postdata = array("app_id" => CONVSST_APP_ID, "platform_id" => 46, "plan_id" => $plan_id, "screen_name" => $subpage);
            $resource_center_res = $customApiObj->get_resource_center_data($rcd_postdata);
            if (!empty($resource_center_res->data)) {
                $resource_center_data = $resource_center_res->data;
            }
        }
    }
}
?>

<!-- Main container -->
<div class="container-old conv-container conv-setting-container pt-4">
    <!-- Main row -->
    <div class="row justify-content-center" style="--bs-gutter-x: 0rem;">
        <!-- Main col8 center -->
        <div class="col-xs-12 row convfixedcontainerfull m-0 p-0">

            <div class="col-md-8 g-0">
                <!-- Pixel setting header -->
                <div class="convsst_pixel_settings_head d-flex flex-row mt-0 align-items-center mb-3">
                    <a href="<?php echo esc_url('admin.php?page=convsst-conversios-google-analytics'); ?>" class="link-dark rounded-3 border border-2 hreflink">
                        <span class="material-symbols-outlined p-1">arrow_back</span>
                    </a>
                    <div class="ms-4 ps-1">
                        <img src="<?php echo esc_url(CONVSST_PLUGIN_URL . $pixel_settings_arr[$subpage]['logo']); ?>" />
                    </div>
                    <h4 class="m-0 fw-normal ms-2 fw-bold-500">
                        <?php echo esc_html(sanitize_text_field($pixel_settings_arr[$subpage]['title'])); ?>
                    </h4>
                    <button class="btn text-white ms-auto d-flex justify-content-center conv-btn-connect conv-btn-connect-disabled" style="width:110px">Save</button>
                </div>
                <!-- Pixel setting header end-->

                <!-- Pixel setting body -->

                <div id="loadingbar_blue" class="progress-materializecss d-none">
                    <div class="indeterminate"></div>
                </div>
                <?php
                if (array_key_exists($subpage, $pixel_settings_arr)) {
                    require_once("singlepixelsettings/" . $subpage . '.php');
                }
                ?>
                <!-- Pixel setting body end -->

                <!-- Hero block -->
                <?php if ($subpage == "gtmsettings") { ?>
                    <div class="convcard p-4 mt-0 rounded-3 shadow-sm mt-3">
                        <h4>Some tips for using your own GTM:</h4>
                        <p>In order to speed up tracking on your website, we recommend to use your own GTM. Below are the things you should consider when you are using your own GTM:</p>
                        <ol>
                            <li>Make sure you have downloaded the latest container JSON <a href="https://conversios.io/help-center/GTM-WJQKHML_workspace12.zip" target="_blank" class="conv-link-blue">from here</a> and imported it in your GTM account as <a target="_blank" class="conv-link-blue" href="https://conversios.io/help-center/configure_our_plugin_with_your_gtm.pdf">shown in the guide</a>.</li>
                            <li>Once you have completed step 1, configure all the tracking of accounts from Pixels and Analytics screen as per your requirements.</li>
                            <li>Next, open you GTM account from this URL and select the container and hit preview to validate if all the tags are firing correctly. <a href="https://www.youtube.com/watch?v=AukTIy5TO9A" target="_blank" class="conv-link-blue">Follow this video for detailed information</a>.</li>
                            <li>If the desired events or tags are not firing reach out to your dedicated customer success manager or reach out directly at <a href="mailto:info@conversios.io">info@conversios.io</a>.</li>
                        </ol>
                    </div>
                <?php } ?>

                <?php if ($subpage == "gasettings") { ?>
                    <div class="convcard p-4 mt-0 rounded-3 shadow-sm mt-3">
                        <h4>Tips to validate Google Analytics 4 tracking:</h4>
                        <ol>
                            <li>Validate from GTM preview if the events are being tracked as expected. Complete an entire user journey to validate every event and data is being tracked. <a href="https://youtu.be/KGGI8m_oiaU" class="conv-link-blue" target="_blank">Refer this video to validate</a>.</li>
                            <li>GA4 takes up to 48 hours to reflect data in your GA4 account. Hence, if you are able to validate tracking in step 1, do not worry your data will be populated in GA4 in upto 48 hours.</li>
                            <li>Monitor the tracking on Conversios - GA4 reporting dashboard for up 5-7 days and compare it with your woocommerce data.</li>
                            <li>If you still find data discrepency, reach out to your dedicated customer success manager or reach out directly at <a href="mailto:info@conversios.io">info@conversios.io</a>.</li>
                        </ol>
                    </div>
                <?php } ?>



                <?php if ($subpage == "gadssettings") { ?>
                    <div class="convcard p-4 mt-0 rounded-3 shadow-sm mt-3">
                        <h4>Tips to validate Google Ads conversion tracking and leveraging it to optimize your Google Ads compaigns:</h4>
                        <ol>
                            <li>Make sure you select right conversion id and label in the settings above and validate the conversion tracking <a href="https://youtu.be/iBOayyJijnU" class="conv-link-blue" target="__blank">by following this steps</a>.</li>
                            <li>Enable enhanced conversion tracking from the settings above this helps Google understand your traffic better and it in turn optimize your campaigns.</li>
                            <li>You can see the conversion tracking data for your campaigns only if the campaigns are live and it takes upto 24 hours to reflect the data in Google Ads.</li>
                            <li>Connect your Google Analytics 4 account with Google Ads account for better attribution and detail analysis.</li>
                        </ol>
                    </div>
                <?php } ?>

                <?php if ($subpage == "fbsettings") { ?>
                    <div class="convcard p-4 mt-0 rounded-3 shadow-sm mt-3">
                        <h4>Tips to validate and leverage FB pixel and FBCAPI:</h4>
                        <ol>
                            <li>It is advised to use FB pixel and FBCAPI together for better accuracy and efficiency. Hence, make sure you have configured both in above settings.</li>
                            <li>Once you have set up FB pixel and/or FBCAPI, validate if the tracking is accurate on your store <a href="https://youtu.be/yRf83wuxU4E" target="_blank" class="conv-link-blue"> by visiting this guide </a>.</li>
                            <li>Open your FB business manager and go to Assets > Pixels to check if the data is being populated.</li>
                            <li>Connect with your dedicated customer success manager if you are facing any issue or reach out to <a class="conv-link-blue" href="mailto:info@conversios.io">info@conversios.io</a> with your query.</li>
                        </ol>
                    </div>
                <?php } ?>


                <!-- Hero block end -->

            </div>

            <!-- Resource center sidebar -->
            <div class="col-md-4 pe-0 ps-4">
                <div class="convcard p-4 mt-0 rounded-3 shadow-sm">
                    <div class="knowledge-center">
                        <div class="d-flex align-items-center knowledge-center-title">
                           <h5 class="d-flex mb-3"><span class="material-symbols-outlined me-2">info</span>Knowledge Center</h5>
                        </div>
                        <?php if( isset($_GET['subpage']) && $_GET['subpage'] == 'gtmsstsettings' ) : ?>
                            <div class="knowledge-center-item d-flex">
                                <span class="material-symbols-outlined fs-5">description</span>
                                <small class="m-0 ms-1"><a href="https://www.conversios.io/docs/how-to-create-a-gtm-account-and-find-google-tag-manager-id/?utm_source=sstfreeinplugin&utm_medium=dashboard&utm_campaign=sstfreeplugin" 
                                class="text-dark" target="_blank">How To Create A GTM Account And Find Google Tag Manager ID?</a></small>
                            </div>
                            <div class="knowledge-center-item d-flex">
                                <span class="material-symbols-outlined fs-5">description</span>
                                <small class="m-0 ms-1"><a href="https://www.conversios.io/docs/what-is-google-tag-manager-and-how-does-it-work/" 
                                class="text-dark" target="_blank">What Is Google Tag Manager And How Does It Work?</a></small>
                            </div>
                            <div class="knowledge-center-item d-flex">
                                <span class="material-symbols-outlined fs-5">description</span>
                                <small class="m-0 ms-1"><a href="https://www.conversios.io/docs/how-to-create-server-side-container-google-tag-manager/?utm_source=sstfreeinplugin&utm_medium=dashboard&utm_campaign=sstfreeplugin" 
                                class="text-dark" target="_blank">How To Create A Server Side Container In Google Tag Manager?</a></small>
                            </div>
                            <div class="knowledge-center-item d-flex">
                                <span class="material-symbols-outlined fs-5">description</span>
                                <small class="m-0 ms-1"><a href="https://www.conversios.io/docs/what-are-the-advantages-of-gtm-based-implementation-vs-on-page-implementation/" 
                                class="text-dark" target="_blank">Why Google Tag Manager Is Better Than On-Page Implementation For Event Tracking?</a></small>
                            </div>
                        <?php endif; ?>
                        <?php if( isset($_GET['subpage']) && $_GET['subpage'] == 'gasettings' ) : ?>
                            <div class="knowledge-center-item d-flex">
                                <span class="material-symbols-outlined fs-5">description</span>
                                <small class="m-0 ms-1"><a href="https://www.conversios.io/docs/how-to-enable-refund-order-tracking/?utm_source=sstfreeinplugin&utm_medium=GA4_Inner_dashboard&utm_campaign=sstfreeplugin" 
                                class="text-dark" target="_blank">How To Enable GA4 Event Tracking For Refund Orders?</a></small>
                            </div>
                            <div class="knowledge-center-item d-flex">
                                <span class="material-symbols-outlined fs-5">description</span>
                                <small class="m-0 ms-1"><a href="https://www.conversios.io/docs/how-to-find-your-ga4-measurement-id/?utm_source=sstfreeinplugin&utm_medium=GA4_Inner_dashboard&utm_campaign=sstfreeplugin" 
                                class="text-dark" target="_blank">How To Find Your GA4 Measurement ID?</a></small>
                            </div>
                        <?php endif; ?>
                        <?php if( isset($_GET['subpage']) && $_GET['subpage'] == 'gadssettings' ) : ?>
                            <div class="knowledge-center-item d-flex">
                                <span class="material-symbols-outlined fs-5">description</span>
                                <small class="m-0 ms-1"><a href="https://www.conversios.io/docs/how-to-create-and-setup-new-google-ads-conversion/?utm_source=sstfreeinplugin&utm_medium=GAds_Inner_dashboard&utm_campaign=sstfreeplugin" 
                                class="text-dark" target="_blank">How To Create A New Google Ads Conversion?</a></small>
                            </div>
                            <div class="knowledge-center-item d-flex">
                                <span class="material-symbols-outlined fs-5">description</span>
                                <small class="m-0 ms-1"><a href="https://www.conversios.io/docs/how-to-find-your-google-ads-conversion-id-and-label-in-google-ads/?utm_source=sstfreeinplugin&utm_medium=GAds_Inner_dashboard&utm_campaign=sstfreeplugin" 
                                class="text-dark" target="_blank">How To Find Your Google Ads Conversion Id And Label In Google Ads?</a></small>
                            </div>
                            <div class="knowledge-center-item d-flex">
                                <span class="material-symbols-outlined fs-5">description</span>
                                <small class="m-0 ms-1"><a href="https://www.conversios.io/docs/how-to-leverage-dynamic-remarketing-tags-to-increase-sales/?utm_source=sstfreeinplugin&utm_medium=GAds_Inner_dashboard&utm_campaign=sstfreeplugin" 
                                class="text-dark" target="_blank">How To Leverage Dynamic Remarketing Tags To Increase Sales?</a></small>
                            </div>
                            <div class="knowledge-center-item d-flex">
                                <span class="material-symbols-outlined fs-5">description</span>
                                <small class="m-0 ms-1"><a href="https://www.conversios.io/docs/how-to-enable-enhanced-conversion-tracking-in-google-ads/?utm_source=sstfreeinplugin&utm_medium=GAds_Inner_dashboard&utm_campaign=sstfreeplugin" 
                                class="text-dark" target="_blank">How To Enable Google Ads Enhanced Conversion Tracking?</a></small>
                            </div>
                            <div class="knowledge-center-item d-flex">
                                <span class="material-symbols-outlined fs-5">description</span>
                                <small class="m-0 ms-1"><a href="https://www.conversios.io/docs/why-google-ads-conversion-and-enhanced-conversion-tracking-are-important-for-campaign-performance-optimization/?utm_source=sstfreeinplugin&utm_medium=GAds_Inner_dashboard&utm_campaign=sstfreeplugin" 
                                class="text-dark" target="_blank">How Google Ads Conversion And Enhanced Conversion Tracking Improve Campaign Performance?</a></small>
                            </div>
                        <?php endif; ?>
                        <?php if( isset($_GET['subpage']) && $_GET['subpage'] == 'fbsettings' ) : ?>
                            <div class="knowledge-center-item d-flex">
                                <span class="material-symbols-outlined fs-5">description</span>
                                <small class="m-0 ms-1"><a href="https://www.conversios.io/docs/how-to-find-my-facebook-pixel-id/?utm_source=sstfreeinplugin&utm_medium=FB_Inner_dashboard&utm_campaign=sstfreeplugin" 
                                class="text-dark" target="_blank">How Do I Find My Facebook Pixel ID?</a></small>
                            </div>
                            <div class="knowledge-center-item d-flex">
                                <span class="material-symbols-outlined fs-5">description</span>
                                <small class="m-0 ms-1"><a href="https://www.conversios.io/docs/how-to-set-up-my-facebook-pixel-id/?utm_source=sstfreeinplugin&utm_medium=FB_Inner_dashboard&utm_campaign=sstfreeplugin" 
                                class="text-dark" target="_blank">How To Set Up My Facebook Pixel ID?</a></small>
                            </div>
                            <div class="knowledge-center-item d-flex">
                                <span class="material-symbols-outlined fs-5">description</span>
                                <small class="m-0 ms-1"><a href="https://www.conversios.io/docs/how-to-generate-facebook-conversion-api-token/?utm_source=sstfreeinplugin&utm_medium=FB_Inner_dashboard&utm_campaign=sstfreeplugin" 
                                class="text-dark" target="_blank">How To Generate Facebook Conversion API Token?</a></small>
                            </div>
                            <div class="knowledge-center-item d-flex">
                                <span class="material-symbols-outlined fs-5">description</span>
                                <small class="m-0 ms-1"><a href="https://www.conversios.io/docs/what-are-the-benefits-of-integrating-fbcapi-into-the-website/?utm_source=sstfreeinplugin&utm_medium=FB_Inner_dashboard&utm_campaign=sstfreeplugin" 
                                class="text-dark" target="_blank">What Are The Benefits Of Integrating FBCAPI Into The Website?</a></small>
                            </div>
                            <div class="knowledge-center-item d-flex">
                                <span class="material-symbols-outlined fs-5">description</span>
                                <small class="m-0 ms-1"><a href="https://www.conversios.io/docs/why-should-you-integrate-fb-pixel-and-fbcapi/?utm_source=sstfreeinplugin&utm_medium=FB_Inner_dashboard&utm_campaign=sstfreeplugin" 
                                class="text-dark" target="_blank">Why Should You Integrate FB Pixel And FBCAPI?</a></small>
                            </div>
                            <div class="knowledge-center-item d-flex">
                                <span class="material-symbols-outlined fs-5">description</span>
                                <small class="m-0 ms-1"><a href="https://www.conversios.io/blog/facebook-conversions-api-vs-facebook-pixel/?utm_source=sstfreeinplugin&utm_medium=FB_Inner_dashboard&utm_campaign=sstfreeplugin" 
                                class="text-dark" target="_blank">Facebook Conversions API Vs. Pixel: Which Is Best For Your Marketing?</a></small>
                            </div>
                            <div class="knowledge-center-item d-flex">
                                <span class="material-symbols-outlined fs-5">description</span>
                                <small class="m-0 ms-1"><a href="https://www.conversios.io/blog/mastering-facebook-pixel-for-ecommerce-conversion-tracking-guide/?utm_source=sstfreeinplugin&utm_medium=FB_Inner_dashboard&utm_campaign=sstfreeplugin" 
                                class="text-dark" target="_blank">Mastering Facebook Pixel For E-Commerce: Conversion Tracking Guide</a></small>
                            </div>
                        <?php endif; ?>
                        <?php if( isset($_GET['subpage']) && $_GET['subpage'] == 'snapchatsettings' ) : ?>
                            <div class="knowledge-center-item d-flex">
                                <span class="material-symbols-outlined fs-5">description</span>
                                <small class="m-0 ms-1"><a href="https://www.conversios.io/docs/how-to-find-the-snapchat-pixel-id-from-the-business-manager-account/?utm_source=sstfreeinplugin&utm_medium=Snap_Inner_dashboard&utm_campaign=sstfreeplugin" 
                                class="text-dark" target="_blank">How To Find The Snapchat Pixel Id From The Business Manager Account?</a></small>
                            </div>
                            <div class="knowledge-center-item d-flex">
                                <span class="material-symbols-outlined fs-5">description</span>
                                <small class="m-0 ms-1"><a href="https://www.conversios.io/docs/what-are-the-benefits-of-integrating-snapchat-pixels-into-the-website/?utm_source=sstfreeinplugin&utm_medium=Snap_Inner_dashboard&utm_campaign=sstfreeplugin" 
                                class="text-dark" target="_blank">What Are The Benefits Of Integrating Snapchat Pixels Into The Website?</a></small>
                            </div>
                            <div class="knowledge-center-item d-flex">
                                <span class="material-symbols-outlined fs-5">description</span>
                                <small class="m-0 ms-1"><a href="https://www.conversios.io/docs/why-should-you-integrate-snapchat-pixel/?utm_source=sstfreeinplugin&utm_medium=Snap_Inner_dashboard&utm_campaign=sstfreeplugin" 
                                class="text-dark" target="_blank">Importance Of Integrating Snapchat Pixels</a></small>
                            </div>
                        <?php endif; ?>
                        <?php if( isset($_GET['subpage']) && $_GET['subpage'] == 'tiktoksettings' ) : ?>
                            <div class="knowledge-center-item d-flex">
                                <span class="material-symbols-outlined fs-5">description</span>
                                <small class="m-0 ms-1"><a href="https://www.conversios.io/docs/how-to-find-tiktok-pixel-id-from-business-manager-account/?utm_source=sstfreeinplugin&utm_medium=Tiktok_Inner_dashboard&utm_campaign=sstfreeplugin" 
                                class="text-dark" target="_blank">How To Find TikTok Pixel Id From Business Manager Account?</a></small>
                            </div>
                            <div class="knowledge-center-item d-flex">
                                <span class="material-symbols-outlined fs-5">description</span>
                                <small class="m-0 ms-1"><a href="https://www.conversios.io/docs/how-to-find-your-tiktok-pixel-id-and-conversion-api-token/?utm_source=sstfreeinplugin&utm_medium=Tiktok_Inner_dashboard&utm_campaign=sstfreeplugin" 
                                class="text-dark" target="_blank">How To Find Your TikTok Pixel ID And Conversion API Token?</a></small>
                            </div>
                            <div class="knowledge-center-item d-flex">
                                <span class="material-symbols-outlined fs-5">description</span>
                                <small class="m-0 ms-1"><a href="https://www.conversios.io/docs/why-should-you-integrate-tik-tok-pixels-2/?utm_source=sstfreeinplugin&utm_medium=Tiktok_Inner_dashboard&utm_campaign=sstfreeplugin" 
                                class="text-dark" target="_blank">Why Should You Integrate Tik Tok Pixels?</a></small>
                            </div>
                            <div class="knowledge-center-item d-flex">
                                <span class="material-symbols-outlined fs-5">description</span>
                                <small class="m-0 ms-1"><a href="https://www.conversios.io/docs/what-are-the-benefits-of-integrating-tiktok-pixels-into-the-website-2/?utm_source=sstfreeinplugin&utm_medium=Tiktok_Inner_dashboard&utm_campaign=sstfreeplugin" 
                                class="text-dark" target="_blank">What Are The Benefits Of Integrating TikTok Pixels Into The Website?</a></small>
                            </div>
                        <?php endif; ?>
                        <?php if( isset($_GET['subpage']) && $_GET['subpage'] == 'customintgrationssettings' ) : ?>
                            <div class="knowledge-center-item d-flex">
                                <span class="material-symbols-outlined fs-5">description</span>
                                <small class="m-0 ms-1"><a href="https://www.conversios.io/docs/custom-google-analytics-event-tracking-in-woocommerce-with-conversios-plugin/?utm_source=sstfreeinplugin&utm_medium=Advanced_Inner_dashboard&utm_campaign=sstfreeplugin" 
                                class="text-dark" target="_blank">Custom Google Analytics Event Tracking In WooCommerce With Conversios Plugin</a></small>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="convcard p-4 mt-3 rounded-3 shadow-sm">
                    <div class="knowledge-center">
                        <div class="d-flex align-items-center knowledge-center-title">
                           <h5 class="d-flex mb-3"><span class="material-symbols-outlined me-2">help</span>Need Help.</h5>
                        </div>
                        <div class="knowledge-center-item d-flex border-0">
                            <small class="m-0 ms-1 text-dark">Reach out to our experts if you are facing any challenges or need any solution.</small>
                        </div>
                        <div class="knowledge-center-item d-flex border-0">
                            <a href="https://calendly.com/conversios/conversios-demo-for-server-side-tagging/?utm_source=free_sstpluginadmin&utm_medium=sstconnectwithexpert&utm_campaign=free_sst_sidebar_needhelp" target="_blank" class="btn btn-outline-primary w-100">Connect with our expert</a>   
                        </div>
                    </div>
                </div>
                <div class="convcard mt-0 rounded-3 shadow-sm">
                    <div class="conv-rc-side-body">
                        <?php
                        foreach ($resource_center_data as $resource) {
                            if ($resource->screen_name != $subpage) {
                                continue;
                            }
                        ?>
                            <a target="_blank" href="<?php echo esc_url($resource->link); ?>">
                                <div class="card m-0 border-0" style="max-width: 540px;">

                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img src="<?php echo esc_url($resource->thumbnail_url); ?>" class="img-fluid border rounded">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body p-0 ps-2">
                                                <h6 class="fw-normal mb-1">
                                                    <?php echo esc_attr($resource->title); ?>
                                                </h6>
                                            </div>
                                            <div class="ps-2">
                                                <span class="text-secondary">
                                                    <?php echo esc_attr($resource->type); ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </a>
                        <?php } ?>
                    </div>

                </div>
            </div>
        </div>
        <!-- Main col8 center End-->
    </div>
    <!-- Main row End -->

</div>
<!-- Main container End -->


<!-- Success Save Modal -->
<div class="modal fade" id="convsst_save_success_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">

            </div>
            <div class="modal-body text-center p-0">
                <img style="width:184px;" src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/convsst_modal_img_highfive.png'); ?>">
                <h3 class="fw-normal pt-3">Successfully Saved</h3>
                <span id="convsst_save_success_txt" class="mb-1 lh-lg"></span>
            </div>
            <div class="modal-footer border-0 pb-4 mb-1">
                <button id="conv-modal-redirect-btn" class="btn conv-blue-bg m-auto text-white">Done</button>
            </div>
        </div>
    </div>
</div>
<!-- Success Save Modal End -->


<!-- disconnect Save Modal -->
<div class="modal fade" id="convsst_save_disconnect_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">

            </div>
            <div class="modal-body text-center p-0">
                <img style="width:184px;" src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/convsst_modal_img_success.png'); ?>">
                <h3 id="convsst_save_disconnect_txt" class="fw-normal pt-3"></h3>
                <span class="mb-1 lh-lg"></span>
            </div>
            <div class="modal-footer border-0 pb-4 mb-1">
                <button id="conv-modal-redirect-btn" class="btn conv-blue-bg m-auto text-white">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Disconnect Save Modal End -->

<!-- Modal SST Pro-->
<div class="modal fade upgradetosstmodal" id="convSsttoProModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
            <a target="_blank" href="<?php echo esc_url('https://www.conversios.io/server-side-tagging-for-woocommerce/?utm_source=pixelandanalytics&utm_medium=in_app&utm_campaign=sstpopup'); ?>" class="btn btn-dark common-btn">Get Early Bird Discount</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal SST Pro End -->

<?php
$redirectscreen = (isset($_GET['redirectscreen']) && $_GET['redirectscreen'] == 'productfeed') ? '1' : '0';
$subpage = (isset($_GET['subpage']) && ($_GET['subpage'] == 'gmcsettings') || $_GET['subpage'] == 'tiktokBusinessSettings') ? '1' : '0';
wp_add_inline_script( 'convsst-admin',"
//Other then GTM,GA,GAds
function change_top_button_state(state = 'enable') {
    if (state == 'enable' && !jQuery('form#pixelsetings_form input').hasClass('conv-border-danger')) {
        jQuery('.conv-btn-connect').removeClass('conv-btn-connect-disabled');
        jQuery('.conv-btn-connect').addClass('conv-btn-connect-enabled');
        jQuery('.conv-btn-connect').text('Save');
    }
    if (state == 'disable') {
        jQuery('.conv-btn-connect').addClass('conv-btn-connect-disabled');
        jQuery('.conv-btn-connect').removeClass('conv-btn-connect-enabled');
        jQuery('.conv-btn-connect').text('Save');
    }
}
function convsst_change_loadingbar(state = 'show') {
    if (state == 'show') {
        jQuery('#loadingbar_blue').removeClass('d-none');
        jQuery('#wpbody').css('pointer-events', 'none');
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    } else {
        jQuery('#loadingbar_blue').addClass('d-none');
        jQuery('#wpbody').css('pointer-events', 'auto');
    }
}
function getAlertMessageAll(type = 'Success', title = 'Success', message = '', icon = 'success', buttonText = 'Done', buttonColor = '#1085F1', iconImageTag = '') {
    Swal.fire({
        type: type,
        icon: icon,
        title: title,
        confirmButtonText: buttonText,
        confirmButtonColor: buttonColor,
        text: message,
    })
    let swalContainer = Swal.getContainer();
    jQuery(swalContainer).find('.swal2-icon-show').removeClass('swal2-' + icon).removeClass('swal2-icon')
    jQuery('.swal2-icon-show').html(iconImageTag)
}
//On page load logics
jQuery(function() {
    // prevent enter key press
    jQuery(window).keydown(function(event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });
    jQuery('#showpopup').toast('show');
    var tvc_ajax_url = '". esc_url(admin_url('admin-ajax.php')) ."';
    let subscription_id = '". esc_attr($subscriptionId) ."';
    //For tooltip
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle=tooltip]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
    //initilize select2 for the inner screens
    jQuery('.selecttwo').select2({
        width: '100%',
        minimumResultsForSearch: -1,
        placeholder: function() {
            jQuery(this).data('placeholder');
        }
    });
    // Show tootltip on click
    jQuery('a[data-bs-toggle=tooltip]').tooltip({
        trigger: 'click'
    });
    // Enable save button on form change
    jQuery(document).on('change', 'form#pixelsetings_form', function() {
        change_top_button_state('enable');
    });
    // Client side pixel id validations
    jQuery(document).on('input', '#fb_pixel_id, #microsoft_convsst_ads_pixel_id, #twitter_convsst_ads_pixel_id, #pinterest_convsst_ads_pixel_id, #snapchat_convsst_ads_pixel_id, #tiKtok_convsst_ads_pixel_id', function() {
        var ele_id = this.id;
        var ele_val = jQuery(this).val();
        var regex_arr = {
            fb_pixel_id: new RegExp(/^\d{14,16}$/m),
            microsoft_convsst_ads_pixel_id: new RegExp(/^\d{7,9}$/m),
            twitter_convsst_ads_pixel_id: new RegExp(/^[a-z0-9]{5,7}$/m),
            pinterest_convsst_ads_pixel_id: new RegExp(/^\d{13}$/m),
            snapchat_convsst_ads_pixel_id: new RegExp(/^[a-z0-9\-]*$/m),
            tiKtok_convsst_ads_pixel_id: new RegExp(/^[A-Z0-9]{20,20}$/m)
        };
        if (ele_val.match(regex_arr[ele_id]) || ele_val === '') {
            jQuery(this).removeClass('conv-border-danger');
            change_top_button_state('enable');
        } else {
            jQuery(this).addClass('conv-border-danger');
            change_top_button_state('disable');
        }

    });
    //Save data other then GTM,GA,GAds
    jQuery(document).on('click', '.conv-btn-connect-enabled', function() {
        convsst_change_loadingbar('show');
        jQuery(this).addClass('disabled');
        var valtoshow_inpopup = jQuery('#valtoshow_inpopup').val() + ' ' + jQuery('.valtoshow_inpopup_this').val();
        var selected_vals = {};
        selected_vals['subscription_id'] = '". esc_js($tvc_data['subscription_id']) ."';

        jQuery('form#pixelsetings_form input, textarea').each(function() {
            selected_vals[jQuery(this).attr('name')] = jQuery(this).val();
        });

        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: tvc_ajax_url,
            data: {
                action: 'convsst_save_pixel_data',
                pix_sav_nonce: '". esc_js(wp_create_nonce('pix_sav_nonce_val')) ."',
                convsst_options_data: selected_vals,
                convsst_options_type: ['eeoptions'],
            },
            beforeSend: function() {
                jQuery('.conv-btn-connect-enabled').text('Saving...');
            },
            success: function(response) {
                var user_modal_txt = 'Congratulations, you have successfully saved your <br> ' + valtoshow_inpopup;

                if (response == '0' || response == '1') {
                    jQuery('.conv-btn-connect-enabled').text('Save');
                    jQuery('#convsst_save_success_txt').html(user_modal_txt);
                    jQuery('#convsst_save_success_modal').modal('show');
                }
                convsst_change_loadingbar('hide');
            }

        });
    });
    jQuery('#conv-modal-redirect-btn').click(function() {
        var redirectscreen = '". $redirectscreen ."';
        var subPage = '". $subpage ."';
        if (subPage == '1') {
            redirectscreen = '1';
        }
        if (redirectscreen == '1') {
            location.href = 'admin.php?page=conversios-google-shopping-feed';
        } else {
            location.href = 'admin.php?page=convsst-conversios-google-analytics';
        }
    });
});
");

// echo '<pre>--ee_options--';
// print_r($ee_options);
// echo '</pre>';


// echo '<pre>--tvc_data---';
// print_r($tvc_data);
// echo '</pre>';


// echo '<pre>--ee_additional_data--';
// print_r($ee_additional_data);
// echo '</pre>';

// echo '<pre>--ee_api_data--';
// print_r($get_ee_options_data);
// echo '</pre>';

// echo '<pre>--Google Details--';
// print_r($googleDetail);
// echo '</pre>';
?>