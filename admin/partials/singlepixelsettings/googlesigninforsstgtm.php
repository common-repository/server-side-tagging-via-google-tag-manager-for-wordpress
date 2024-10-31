<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<div class="row">
    <div class="col-md-11">
        <div class="convpixsetting-inner-box ">
            <?php if ($g_gtm_email != "") { ?>
                <h5 class="fw-normal mb-1">
                    <?php esc_html_e("Successfully signed in with account:", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                </h5>
                <span>
                    <?php echo esc_html($g_gtm_email); ?>
                    <span class="conv-link-blue ps-2 tvc_google_signinbtn">
                        <?php esc_html_e("Change", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                    </span>
                </span>
            <?php } else { ?>
                <div class="google_signing_image tvc_google_signinbtn">
                    <img src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/btn_google_signin_dark_normal_web.png'); ?>">
                </div>
            <?php } ?>
        </div>
    </div>
</div>


<!-- Google signin -->
<div class="pp-modal onbrd-popupwrp" id="tvc_google_signin" tabindex="-1" role="dialog">
    <div class="onbrdppmain" role="document">
        <div class="onbrdnpp-cntner acccretppcntnr">
            <div class="onbrdnpp-hdr">
                <div class="ppclsbtn clsbtntrgr"><img src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/close-icon.png'); ?>" alt="" /></div>
            </div>
            <div class="onbrdpp-body">
                <p>-- We recommend to use Chrome browser to configure the plugin if you face any issues during setup. --</p>
                <div class="google_signin_sec_left pt-0">
                    <?php if (!isset($tvc_data['g_mail']) || $tvc_data['g_mail'] == "" || $subscriptionId == "") { ?>
                        <div class="google_signing_image google_connect_url">
                            <img src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/btn_google_signin_dark_normal_web.png'); ?>">
                        </div>
                    <?php } else { ?>
                        <?php if ($is_refresh_token_expire == true) { ?>
                            <p class="alert alert-primary"><?php esc_html_e("It seems the token to access your Google accounts is expired. Sign in again to continue.", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?></p>
                            <div class="google_signing_image google_connect_url">
                                <img src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/btn_google_signin_dark_normal_web.png'); ?>">
                            </div>
                        <?php } else { ?>
                            <div class="google_signing_image google_connect_url">
                                <img src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/btn_google_signin_dark_normal_web.png'); ?>">
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <p><?php esc_html_e("Make sure you sign in with the google email account that has all privileges to access google analytics, google ads and google merchant center account that you want to configure for your store.", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?></p>
                </div>
                <div class="google_signin_sec_right">
                    <h5><?php esc_html_e("Why do I need to sign in with google?", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?></h5>
                    <p><?php esc_html_e("When you sign in with Google, we ask for limited programmatic access for your accounts in order to automate below features for you: ", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?><a href="https://www.conversios.io/privacy-policy/" target="_blank" class=""> See Details in Our Privacy Policy.</a></p>
                    <p><strong><?php esc_html_e("Google Tag Manager: ", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?></strong><?php esc_html_e("To automate google tag manager using google api and to set up your GTM account.", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?></p>
                    <!-- <label class="conv-gtm-guide"><a href="https://www.conversios.io/privacy-policy/" target="_blank" class="">Conversios privacy policy</a>
                    </label> -->
                </div>
                <!--badge consent & toggle -->
                <div style="margin-top: 10px; display:none" class="d-none">
                    <label id="badge_label_check" for="convsst_show_badge_onboardingCheck" class="switch <?php echo empty($ee_options['convsst_show_badge']) || esc_attr($ee_options['convsst_show_badge']) == "no" ? "convsst_default_cls_disabled" : "convsst_default_cls_enabled"; ?>">
                        <input id="convsst_show_badge_onboardingCheck" type="checkbox" <?php echo empty($ee_options['convsst_show_badge']) || esc_attr($ee_options['convsst_show_badge']) == "no" ? "class ='convsst_default_cls_disabled'" : "class ='convsst_default_cls_enabled' checked"; ?> />
                        <div></div>
                    </label>
                    <span style="font-weight: 600; padding: 10px;">Influence visitor's perceptions and actions on your website via trusted partner Badge</span>
                </div>
                <p class="pt-2" style="font-size: 11px !important;"><?php esc_html_e("We comply with the Google API Services User Data Policy, including the Limited Use requirements. This means that we only collect and use user data for the purposes that are described in this policy and in the app's privacy policy. We do not sell or share user data with third parties, except as required by law or to provide the app's services.For more information about our data collection and use practices, please see our privacy policy,", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?><a href="https://developers.google.com/terms/api-services-user-data-policy" target="_blank"> Google API Services User Data Policy </a>and<a href="https://developers.google.com/terms/api-services-user-data-policy#additional_requirements_for_specific_api_scopes" target="_blank"> Limited Use Policy.</a></p>
            </div>
        </div>
    </div>
</div>

<?php
wp_add_inline_script( 'convsst-admin',"
function convsst_save_badge_settings(bagdeVal) {
    var data = {
        action: 'convsst_save_badge_settings',
        bagdeVal: bagdeVal
    };
    jQuery.ajax({
        type: 'POST',
        dataType: 'json',
        url: tvc_ajax_url,
        data: data,
        success: function(response) {
            console.log(response);
            //do nothing
        }
    });
}
jQuery(function() {
    var tvc_data = '". esc_js(wp_json_encode($tvc_data)) ."';
    var tvc_ajax_url = '". esc_url(admin_url('admin-ajax.php')) ."';
    let subscription_id = '". esc_attr($subscriptionId) ."';
    let plan_id = '". esc_attr($plan_id) ."';
    let app_id = '". esc_attr($app_id) ."';
    let bagdeVal = 'yes';
    let convBadgeVal = '". esc_attr($convBadgeVal) ."';

    let ua_acc_val = jQuery('#ua_acc_val').val();
    let ga4_acc_val = jQuery('#ga4_acc_val').val();
    let googleAds = jQuery('#googleAds').val();
    let gmc_field = jQuery('#gmc_field').val();

    //open google signin popup
    jQuery('.tvc_google_signinbtn').on('click', function() {
        jQuery('#tvc_google_signin').addClass('showpopup');
        jQuery('body').addClass('scrlnone');
        if (convBadgeVal == '') {
            convsst_save_badge_settings('no');
        }
    });

    jQuery(document).on('click', '.google_connect_url', function() {
        const w = 600;
        const h = 650;
        const dualScreenLeft = window.screenLeft !== undefined ? window.screenLeft : window.screenX;
        const dualScreenTop = window.screenTop !== undefined ? window.screenTop : window.screenY;

        const width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
        const height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

        const systemZoom = width / window.screen.availWidth;
        const left = (width - w) / 2 / systemZoom + dualScreenLeft;
        const top = (height - h) / 2 / systemZoom + dualScreenTop;
        var url = '". esc_url($connect_url) ."';
        url = url.replace(/&amp;/g, '&');
        url = url.replaceAll('&#038;', '&');
        const newWindow = window.open(url, 'newwindow', config = `scrollbars=yes,
                width=' + w / systemZoom +', 
                height=' + h / systemZoom +', 
                top=' + top + ', 
                left=' + left +'},toolbar=no,menubar=no,scrollbars=no,resizable=no,location=no,directories=no,status=no
                `);
        if (window.focus) newWindow.focus();
    });

    jQuery('.clsbtntrgr, .ppblubtn').on('click', function() {
        jQuery(this).closest('.onbrd-popupwrp').removeClass('showpopup');
        jQuery('body').removeClass('scrlnone');
    });

    jQuery('#convsst_show_badge_onboardingCheck').change(function() {
        if (jQuery(this).prop('checked')) {
            jQuery('#badge_label_check').addClass('convsst_default_cls_enabled');
            jQuery('#badge_label_check').removeClass('convsst_default_cls_disabled');
            bagdeVal = 'yes';
        } else {
            jQuery('#badge_label_check').addClass('convsst_default_cls_disabled');
            jQuery('#badge_label_check').removeClass('convsst_default_cls_enabled');
            bagdeVal = 'no';
        }
        convsst_save_badge_settings(bagdeVal); //saving badge settings
    });

});
");
?>
