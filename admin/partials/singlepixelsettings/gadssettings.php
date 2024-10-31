<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$is_sel_disable = 'disabled';
$cust_g_email =  (isset($tvc_data['g_mail']) && esc_attr($subscriptionId)) ? esc_attr($tvc_data['g_mail']) : "";
?>
<div class="convcard p-4 mt-0 rounded-3 shadow-sm">

    <?php if (isset($pixel_settings_arr[$subpage]['topnoti']) && $pixel_settings_arr[$subpage]['topnoti'] != "") { ?>
        <div class="alert d-flex align-items-cente p-0" role="alert">
            <span class="p-2 material-symbols-outlined text-light conv-success-bg rounded-start">info</span>
            <div class="p-2 w-100 rounded-end border border-start-0 shadow-sm conv-notification-alert lh-lg">
                <?php echo esc_html($pixel_settings_arr[$subpage]['topnoti']); ?>
            </div>
        </div>
    <?php } ?>

    <?php
    $connect_url = $TVC_Admin_Helper->get_custom_connect_url_subpage(admin_url() . 'admin.php?page=convsst-conversios-google-analytics', "gadssettings");    
    require_once("googlesignin.php");
    ?>

    <form id="gadssetings_form" class="convpixsetting-inner-box mt-4">
        <div>
            <!-- Google Ads  -->
            <?php
            $convsst_api_data = unserialize(get_option("convsst_api_data"));
            $convsst_api_data = isset($convsst_api_data['setting']) ? $convsst_api_data['setting'] : null;
            $google_ads_id = (isset($convsst_api_data->google_ads_id) && $convsst_api_data->google_ads_id != "") ? $convsst_api_data->google_ads_id : "";
            ?>
            <div id="analytics_box_ads" class="py-1">
                <div class="row pt-2">
                    <div class="col-7">
                        <h5 class="fw-normal mb-1">
                            <?php esc_html_e("Select Google Ads Account:", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                        </h5>
                        <select id="google_ads_id" name="google_ads_id" class="form-select form-select-lg mb-3 selecttwo google_ads_id" style="width: 100%" <?php echo esc_attr($is_sel_disable); ?>>
                            <?php if (!empty($google_ads_id)) { ?>
                                <option value="<?php echo esc_attr($google_ads_id); ?>" selected><?php echo esc_html($google_ads_id); ?></option>
                            <?php } ?>
                            <option value="">Select Account</option>
                        </select>
                    </div>

                    <div class="col-2 d-flex align-items-end">
                        <button type="button" class="btn btn-sm d-flex conv-enable-selection conv-link-blue align-items-center">
                            <span class="material-symbols-outlined md-18">edit</span>
                            <span class="px-1">Edit</span>
                        </button>
                    </div>
                    <div id="conv_mcc_alert" class="my-3 mx-2 alert alert-danger d-none" role="alert">
                        <?php esc_html_e("You have selected a MCC account. Please select other google ads account to proceed further.", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                    </div>
                    <div class="col-12 flex-row pt-3">
                        <h5 class="fw-normal mb-1">
                            <?php esc_html_e("OR", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                        </h5>
                        <div class="col-12 py-2">
                            <button id="convsst_create_gads_new_btn" type="button" class="btn conv-blue-bg text-white" data-bs-toggle="modal" data-bs-target="#convsst_create_gads_new">
                                <?php esc_html_e("Create New", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Google Ads End-->

            <!-- Checkboxes -->
            <div id="checkboxes_box" class="pt-4">

                <div class="d-flex pt-2 align-items-center d-none">
                    <input class="form-check-input" type="checkbox" value="1" id="remarketing_tags" name="remarketing_tags" <?php echo isset($googleDetail->remarketing_tags) && $googleDetail->remarketing_tags == 1 ? 'checked="checked"' : ''; ?>>
                    <label class="form-check-label ps-2" for="remarketing_tags">
                        <?php esc_html_e("Enable remarketing tags", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                    </label>
                </div>
                <div class="d-flex pt-2 align-items-center d-none">
                    <input class="form-check-input" type="checkbox" value="1" id="dynamic_remarketing_tags" name="dynamic_remarketing_tags" <?php echo isset($googleDetail->dynamic_remarketing_tags) && $googleDetail->dynamic_remarketing_tags == 1 ? 'checked="checked"' : ''; ?>>
                    <label class="form-check-label ps-2" for="dynamic_remarketing_tags">
                        <?php esc_html_e("Enable dynamic remarketing tags", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                    </label>
                </div>

                <div class="d-flex pt-2 align-items-center">
                    <?php
                    $convsst_api_data = unserialize(get_option("convsst_api_data"));
                    $convsst_api_data = isset($convsst_api_data['setting']) ? $convsst_api_data['setting'] : null;
                    $is_diabled = (isset($convsst_api_data->measurement_id) && $convsst_api_data->measurement_id != "") ? "" : "disabled";
                    ?>
                    <input class="form-check-input <?php echo esc_attr($is_diabled) ?>" type="checkbox" value="1" id="link_google_analytics_with_google_ads" name="link_google_analytics_with_google_ads" <?php echo isset($googleDetail->link_google_analytics_with_google_ads) && $googleDetail->link_google_analytics_with_google_ads == 1 ? 'checked="checked"' : ''; ?> <?php echo esc_attr($is_diabled) ?>>
                    <label class="form-check-label ps-2" for="link_google_analytics_with_google_ads">
                        <?php esc_html_e("Link Google analytics with Google ads", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                    </label>
                </div>

                <div class="d-flex pt-2 align-items-center">
                    <?php $convsst_google_ads_tracking = get_option("convsst_google_ads_tracking"); ?>
                    <input class="form-check-input" type="checkbox" value="1" id="convsst_google_ads_tracking" name="convsst_google_ads_tracking" <?php echo isset($convsst_google_ads_tracking) && $convsst_google_ads_tracking == 1 ? 'checked="checked"' : ''; ?>>
                    <label class="form-check-label ps-2" for="convsst_google_ads_tracking">
                        <?php esc_html_e("Enable Google ads conversion tracking", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                    </label>
                </div>

                <div class="d-flex pt-2 align-items-center">
                    <?php $convsst_ga_EC = get_option("convsst_ga_EC"); ?>
                    <input class="form-check-input" type="checkbox" value="1" id="convsst_ga_EC" name="convsst_ga_EC" <?php echo $convsst_ga_EC == 1 && isset($convsst_google_ads_tracking) && $convsst_google_ads_tracking == 1 ? 'checked' : ''; ?> <?php echo !isset($convsst_google_ads_tracking) || (isset($convsst_google_ads_tracking) && $convsst_google_ads_tracking) != "1" ? "disabled" : "" ?>>
                    <label class="form-check-label ps-2" for="convsst_ga_EC">
                        <?php esc_html_e("Enable Google ads enhanced conversion tracking", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                    </label>
                </div>

            </div>
            <!-- Checkboxes end -->

            <div class="mt-4">

                <?php $conversio_send_to = get_option('conversio_send_to'); ?>
                <?php $convsst_google_ads_tracking = get_option("convsst_google_ads_tracking"); ?>
                <div id="analytics_box_adstwo" class="py-1 <?php echo isset($convsst_google_ads_tracking) && $convsst_google_ads_tracking == 0 ? 'd-none' : ''; ?>">
                    <div class="row pt-2">
                        <div class="col-10">
                            <h5 class="fw-normal mb-1">
                                <?php esc_html_e("Conversion label and ID for purchase", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                            </h5>
                            <select id="conversio_send_to" name="conversio_send_to" class="form-select form-select-lg mb-3 selecttwo google_ads_id" style="width: 100%" <?php echo esc_attr($is_sel_disable); ?>>
                                <?php if (!empty($conversio_send_to)) { ?>
                                    <option value="<?php echo esc_attr($conversio_send_to); ?>" selected><?php echo esc_html($conversio_send_to); ?></option>
                                <?php } ?>
                                <option value="">
                                    <?php esc_html_e("Conversion label", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                                </option>
                            </select>
                        </div>

                        <div class="col-2 d-flex align-items-end">
                            <button type="button" class="btn btn-sm d-flex conv-enable-selection_cli conv-link-blue align-items-center">
                                <span class="material-symbols-outlined md-18">edit</span>
                                <span class="px-1">Edit</span>
                            </button>
                        </div>
                        <div id="conversion_idlabel_box" class="col-12 mt-3 d-none">
                            <div class="alert alert-danger" role="alert">
                                No conversion labels are retrived, kindly refresh once else check if conversion label is available in your google ads account.
                                <br>Or<br>
                                Enter it manually in below input box.
                                <small>
                                    <?php esc_html_e("How to find Google Ads Conversion Id and Label?", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                                    <a target="_blank" href="https://www.conversios.io/docs/how-to-find-your-google-ads-conversion-id-and-label-in-google-ads/">
                                        <?php esc_html_e("click here", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                                    </a>
                                </small>
                            </div>
                            <h5 class="fw-normal mb-1">
                                <?php esc_html_e("Enter Google Ads Conversion Id and Label:", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                            </h5>
                            <input type="text" id="convsst_conversio_send_to_static" class="form-control" name="convsst_conversio_send_to_static" value="<?php echo esc_attr($conversio_send_to); ?>">

                        </div>


                    </div>
                </div>

            </div>

        </div>
    </form>

</div>


<!-- Create New Ads Account Modal -->
<div class="modal fade" id="convsst_create_gads_new" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    <span id="before_gadsacccreated_title" class="before-ads-acc-creation"><?php esc_html_e("Enable Google Ads Account", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?></span>
                    <span id="after_gadsacccreated_title" class="d-none after-ads-acc-creation"><?php esc_html_e("Account Created", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?></span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
                <span id="before_gadsacccreated_text" class="mb-1 lh-lg fs-6 before-ads-acc-creation">
                    <?php esc_html_e("You’ll receive an invite from Google on your email. Accept the invitation to enable your Google Ads Account.", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                </span>

                <div class="onbrdpp-body alert alert-primary text-start d-none after-ads-acc-creation" id="new_google_convsst_ads_section">
                    <p>
                        <?php esc_html_e("Your Google Ads Account has been created", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                        <strong>
                            (<b><span id="new_google_convsst_ads_id"></span></b>).
                        </strong>
                    </p>
                    <h6>
                        <?php esc_html_e("Steps to claim your Google Ads Account:", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                    </h6>
                    <ol>
                        <li>
                            <?php esc_html_e("Accept invitation mail from Google Ads sent to your email address", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                            <em><?php echo (isset($tvc_data['g_mail'])) ? esc_attr($tvc_data['g_mail']) : ""; ?></em>
                            <span id="invitationLink">
                                <br>
                                <em>OR</em>
                                Open
                                <a href="" target="_blank" id="ads_invitationLink">Invitation Link</a>
                            </span>
                        </li>
                        <li><?php esc_html_e("Log into your Google Ads account and set up your billing preferences", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?></li>
                    </ol>
                </div>

            </div>
            <div class="modal-footer">
                <button id="ads-continue" class="btn conv-blue-bg m-auto text-white before-ads-acc-creation">
                    <span id="gadsinviteloader" class="spinner-grow spinner-grow-sm d-none" role="status" aria-hidden="true"></span>
                    <?php esc_html_e("Send Invite", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                </button>

                <button id="ads-continue-close" class="btn btn-secondary m-auto text-white d-none after-ads-acc-creation" data-bs-dismiss="modal">
                    <?php esc_html_e("Ok, close", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="convgadseditconfirm" tabindex="-1" aria-labelledby="convgadseditconfirmLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="convgadseditconfirmLabel">Change Google Ads Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Changing Google Ads Account will remove selected conversions ID and Labels
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="conv_changegadsacc_but" type="button" class="btn btn-primary">
                    Change Now
                    <div class="spinner-border spinner-border-sm d-none" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>

<?php

$js_code = $js_code_2 = $js_code_3 = '';
if ($cust_g_email != '') {   
    $js_code = "
    var convsst_conversio_send_to_static = jQuery('#convsst_conversio_send_to_static').val();
    if (!jQuery('#conversion_idlabel_box').hasClass('d-none') && convsst_conversio_send_to_static == '') {
        jQuery('#convsst_conversio_send_to_static').addClass('conv-border-danger');
        jQuery('.conv-btn-connect').addClass('conv-btn-connect-disabled');
        jQuery('.conv-btn-connect').removeClass('conv-btn-connect-enabled-google');
        jQuery('.conv-btn-connect').text('Save');
    } else {
        jQuery('#convsst_conversio_send_to_static').removeClass('conv-border-danger');
        jQuery('.conv-btn-connect').removeClass('conv-btn-connect-disabled');
        jQuery('.conv-btn-connect').addClass('conv-btn-connect-enabled-google');
        jQuery('.conv-btn-connect').text('Save');
    }
    ";
} else {
    $js_code = "jQuery('.tvc_google_signinbtn').trigger('click');";
}

if ($cust_g_email == '') {
    $js_code_2 = "
    jQuery('#convsst_create_gads_new_btn').addClass('disabled');
    jQuery('.conv-enable-selection, .conv-enable-selection_cli').addClass('d-none');
    ";
}

if (isset($_GET['subscription_id']) && sanitize_text_field($_GET['subscription_id'])) {
    $js_code_3 = "
    list_google_convsst_ads_account(tvc_data);
    jQuery('.conv-enable-selection').addClass('d-none');
    jQuery('.form-check-input').attr('disabled',true);
    jQuery('.form-check-input').prop('checked', false);
    ";
}

$js_code_3 .= "if( jQuery('#google_ads_id').val() == '' ) {
    jQuery('.form-check-input').attr('disabled',true);
    jQuery('.form-check-input').prop('checked', false);
}
";

$GET_SUBSCRIPTION_ID = isset($_GET['subscription_id']) ? sanitize_text_field($_GET['subscription_id']) : "''";

wp_add_inline_script( 'convsst-admin',"
// get list google ads dropdown options
function list_google_convsst_ads_account(tvc_data, new_convsst_ads_id) {

    var selectedValue = jQuery('#google_ads_id').val();
    var convsst_onboarding_nonce = '". esc_js(wp_create_nonce('convsst_onboarding_nonce')) ."';
    jQuery.ajax({
        type: 'POST',
        dataType: 'json',
        url: tvc_ajax_url,
        data: {
            action: 'list_googl_convsst_ads_account',
            tvc_data: tvc_data,
            convsst_onboarding_nonce: convsst_onboarding_nonce
        },
        success: function(response) {

            jQuery('#google_ads_id').val('').trigger('change');
            jQuery('#google_ads_id').html('<option value=\"\">Select Account</option>');

            var btn_cam = 'convsst_ads_list';
            if (response.error === false) {
                var error_msg = 'null';
                if (response.data.length == 0) {
                    getAlertMessageAll(
                        'info',
                        'Error',
                        message = 'No Google Ads Account Found please create a new account by clicking on Create Now.',
                        icon = 'info',
                        buttonText = 'Ok',
                        buttonColor = '#FCCB1E',
                        iconImageSrc = '<img src=\"". esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/convsst_error_logo.png') ."\" />'
                    );
                } else {
                    if (response.data.length > 0) {
                        jQuery('#google_ads_id').html('');
                        // validation
                        jQuery('.form-check-input:not(\"#convsst_ga_EC, .disabled\")').removeAttr('disabled');
                        var AccOptions = '';
                        var selected = '';
                        if (new_convsst_ads_id != '' && new_convsst_ads_id != undefined) {
                            AccOptions = AccOptions + '<option value=\"' + new_convsst_ads_id + '\" selected>' + new_convsst_ads_id + '</option>';
                        }
                        response?.data.forEach(function(item) {
                            AccOptions = AccOptions + '<option value=\"' + item + '\">' + item + '</option>';
                        });
                        jQuery('#google_ads_id').append(AccOptions);
                        jQuery('#google_ads_id').prop('disabled', false);
                        jQuery('.conv-enable-selection').addClass('d-none');
                    }
                }
            } else {
                var error_msg = response.errors;
                // auth token will not get if customer dont gave GA account also.
                getAlertMessageAll(
                    'info',
                    'Error',
                    message = 'No Google Ads Account Found please create a new account by clicking on Create Now.',
                    icon = 'info',
                    buttonText = 'Ok',
                    buttonColor = '#FCCB1E',
                    iconImageSrc = '<img src=\"". esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/convsst_error_logo.png') ."\" />'
                );
            }
            jQuery('#ads-account').prop('disabled', false);
            convsst_change_loadingbar('hide');
        }
    });
    cleargadsconversions();
}

//Get conversion list
function get_conversion_list() {
    convsst_change_loadingbar('show');
    jQuery('#conversion_idlabel_box').addClass('d-none');
    var data = {
        action: 'convsst_get_conversion_list_gads',
        gads_id: jQuery('#google_ads_id').val(),
        TVCNonce: '". esc_js(wp_create_nonce('convsst_get_conversion_list-nonce')) ."'
    };
    jQuery.ajax({
        type: 'POST',
        dataType: 'json',
        url: tvc_ajax_url,
        data: data,
        success: function(response) {
            if (response == 0) {
                jQuery('#conversio_send_to').html('<option value=\"\">No Conversation Label and ID Found</option>');
                jQuery('#conversio_send_to').trigger('change');
                jQuery('#conversion_idlabel_box').removeClass('d-none');
                convsst_change_loadingbar('hide');
            } else {
                var AccOptions = '';
                var selected = '';
                response?.forEach(function(item) {
                    AccOptions = AccOptions + '<option value=\"' + item + '\">' + item + '</option>';
                });
                jQuery('#conversio_send_to').html(AccOptions);
                jQuery('#conversio_send_to').prop('disabled', false);
                jQuery('.conv-enable-selection_cli').addClass('d-none');
                convsst_change_loadingbar('hide');
            }

        }

    });
}

// Create new gads acc function
function create_google_convsst_ads_account(tvc_data) {
    var convsst_onboarding_nonce = '". esc_js(wp_create_nonce('convsst_onboarding_nonce')) ."';
    var error_msg = 'null';
    var btn_cam = 'create_new';
    var ename = 'conversios_onboarding';
    var event_label = 'ads';
    //user_tracking_data(btn_cam, error_msg,ename,event_label);   
    jQuery.ajax({
        type: 'POST',
        dataType: 'json',
        url: tvc_ajax_url,
        data: {
            action: 'create_google_convsst_ads_account',
            tvc_data: tvc_data,
            convsst_onboarding_nonce: convsst_onboarding_nonce
        },
        beforeSend: function() {
            jQuery('#gadsinviteloader').removeClass('d-none');
            jQuery('#ads-continue').addClass('disabled');
        },
        success: function(response) {
            if (response) {
                error_msg = 'null';
                var btn_cam = 'complate_new';
                var ename = 'conversios_onboarding';
                var event_label = 'ads';

                //add_message('success', response.data.message);
                jQuery('#new_google_convsst_ads_id').text(response.data.adwords_id);
                if (response.data.invitationLink != '') {
                    jQuery('#ads_invitationLink').attr('href', response.data.invitationLink);
                } else {
                    jQuery('#invitationLink').html('');
                }
                jQuery('.before-ads-acc-creation').addClass('d-none');
                jQuery('.after-ads-acc-creation').removeClass('d-none');
                //localStorage.setItem('new_google_convsst_ads_id', response.data.adwords_id);
                var tvc_data = '". esc_js(wp_json_encode($tvc_data)) ."';
                list_google_convsst_ads_account(tvc_data, response.data.adwords_id);
            } else {
                var error_msg = response.errors;
                add_message('error', response.data.message);
            }
            //user_tracking_data(btn_cam, error_msg,ename,event_label);   
        }
    });
}

function cleargadsconversions() {
    var data = {
        action: 'conv_save_gads_conversion',
        cleargadsconversions: 'yes',
        subscription_id: ". $GET_SUBSCRIPTION_ID .",
        CONVNonce: '". esc_js(wp_create_nonce('conv_save_gads_conversion-nonce')) ."',
    };
    jQuery.ajax({
        type: 'POST',
        url: tvc_ajax_url,
        data: data,
        success: function(response) {
            jQuery('#convgadseditconfirm').modal('hide');
            jQuery('#conversio_send_to').val(null).trigger('change');
        }
    });
}

//Onload functions
jQuery(function() {
    var tvc_data = '". esc_js(wp_json_encode($tvc_data)) ."';
    var tvc_ajax_url = '". esc_url(admin_url('admin-ajax.php')) ."';
    let subscription_id = '". esc_attr($subscriptionId) ."';
    let plan_id = '". esc_attr($plan_id) ."';
    let app_id = '". esc_attr(CONVSST_APP_ID) ."';
    let bagdeVal = 'yes';
    let convBadgeVal = '". esc_attr($convBadgeVal) ."';
    jQuery('.selecttwo').select2({
        minimumResultsForSearch: -1,
        placeholder: function() {
            jQuery(this).data('placeholder');
        }
    });
    jQuery('.conv-enable-selection').click(function() {
        if( jQuery('#conversio_send_to').val() != '' ) {
            jQuery('#convgadseditconfirm').modal('show');
        }else {
            jQuery('#conv_changegadsacc_but').trigger('click');
            convsst_change_loadingbar('show');
        }
    });
    jQuery('#conv_changegadsacc_but').click(function() {
        jQuery('#conv_changegadsacc_but').addClass('disabled');
        jQuery('#conv_changegadsacc_but').find('.spinner-border').removeClass('d-none');

        convsst_change_loadingbar('show');
        jQuery('.conv-enable-selection').addClass('disabled');
        list_google_convsst_ads_account(tvc_data);
        convsst_change_loadingbar('hide');
    });
    jQuery('.conv-enable-selection_cli').click(function() {
        jQuery('.conv-enable-selection_cli').addClass('disabled');
        get_conversion_list(tvc_data);
    });
    jQuery(document).on('change', 'form#gadssetings_form', function() {
        ". $js_code ."
    });

    ". $js_code_2 ."
    ". $js_code_3 ."

    jQuery('#convsst_google_ads_tracking').click(function() {
        if (jQuery('#convsst_google_ads_tracking').is(':checked')) {
            jQuery('#convsst_ga_EC').removeAttr('disabled');
            jQuery('#convsst_ga_EC').prop('checked', true);
            jQuery('#convsst_ga_EC').attr('checked', true);
            jQuery('#analytics_box_adstwo').removeClass('d-none');
        } else {
            jQuery('#convsst_ga_EC').attr('disabled', true);
            jQuery('#convsst_ga_EC').prop('checked', false);
            jQuery('#convsst_ga_EC').attr('checked', false);
            jQuery('#analytics_box_adstwo').addClass('d-none');
        }
    });

    //Set gads label id in static box on dropdown change
    jQuery(document).on('change', '#conversio_send_to', function() {
        jQuery('#convsst_conversio_send_to_static').val(jQuery('#conversio_send_to').val());
    });

    jQuery(document).on('input', '#convsst_conversio_send_to_static', function() {
        if (jQuery('#convsst_conversio_send_to_static').val() != '') {
            var inpval = jQuery('#convsst_conversio_send_to_static').val();
            var regex = /^AW-+[0-9{5,}]+[\/]+[a-zA-Z0-9{5,}]/;
            console.log(regex.test(inpval));
            if (regex.test(inpval) === false) {
                jQuery('#convsst_conversio_send_to_static').addClass('conv-border-danger');
            }
        } else {
            jQuery('#convsst_conversio_send_to_static').removeClass('conv-border-danger');
        }
    });

    jQuery(document).on('change', '#google_ads_id', function() {
        if(jQuery('#convsst_google_ads_tracking').is(':checked'))
        {
            get_conversion_list();
        }
        var selectedAcc = jQuery('#google_ads_id').val();
        if (selectedAcc != '') {

            // validation
            jQuery('.form-check-input:not(\"#convsst_ga_EC, .disabled\")').removeAttr('disabled');

            jQuery('#spinner_mcc_check').removeClass('d-none');
            jQuery('#conv_mcc_alert').addClass('d-none');
            //console.log('selected ads acc is '+selectedAcc);
            var data = {
                action: 'conv_checkMcc',
                ads_accountId: selectedAcc,
                subscription_id: '". esc_attr($subscriptionId) ."',
                CONVNonce: '". esc_html(wp_create_nonce('conv_checkMcc-nonce')) ."'
            };
            jQuery.ajax({
                type: 'POST',
                url: tvc_ajax_url,
                data: data,
                success: function(response) {
                    var newResponse = JSON.parse(response);
                    if (newResponse.status == 200 && newResponse?.data[0] != '') {
                        var managerStatus = newResponse.data[0]?.managerStatus;
                        if (managerStatus) { //mcc true
                            //console.log('mcc is there');
                            jQuery('#conv_mcc_alert').removeClass('d-none');
                            jQuery('#google_ads_id').val('').trigger('change');
                        }
                    }
                    jQuery('#spinner_mcc_check').addClass('d-none');
                    jQuery('#accordionFlushExample .accordion-body').removeClass('disabledsection');
                }
            });
        }
    })

    jQuery(document).on('click', '.conv-btn-connect-enabled-google', function() {
        convsst_change_loadingbar('show');
        var google_ads_id = jQuery('#google_ads_id').val();
        var remarketing_tags = jQuery('#remarketing_tags').val();
        var dynamic_remarketing_tags = jQuery('#dynamic_remarketing_tags').val();
        var link_google_analytics_with_google_ads = jQuery('#link_google_analytics_with_google_ads').val();
        var convsst_google_ads_tracking = jQuery('#convsst_google_ads_tracking').val();
        var convsst_ga_EC = jQuery('#convsst_ga_EC').val();
        var conversio_send_to = jQuery('#conversio_send_to').val();

        var selectedoptions = {};

        selectedoptions['google_ads_id'] = jQuery('#google_ads_id').val();
        selectedoptions['conversio_send_to'] = jQuery('#conversio_send_to').val();
        selectedoptions['convsst_conversio_send_to_static'] = jQuery('#convsst_conversio_send_to_static').val();
        selectedoptions['subscription_id'] = '". esc_js($tvc_data['subscription_id']) ."';

        jQuery('#checkboxes_box input[type=checkbox]').each(function() {
            if (jQuery(this).is(':checked')) {
                selectedoptions[jQuery(this).attr('name')] = jQuery(this).val();
            } else {
                selectedoptions[jQuery(this).attr('name')] = '0';
            }
        });

        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: tvc_ajax_url,
            data: {
                action: 'convsst_save_googleads_data',
                pix_sav_nonce: '". esc_js(wp_create_nonce('pix_sav_nonce_val')) ."',
                convsst_options_data: selectedoptions,
                convsst_tvc_data: tvc_data,
            },
            beforeSend: function() {
                jQuery('.conv-btn-connect-enabled-google').text('Saving...');
                jQuery('.conv-btn-connect-enabled-google').addClass('disabled');
            },
            success: function(response) {
                var user_modal_txt = 'Congratulations, you have successfully saved your <br> Google Ads Account ID: ' + google_ads_id + '.';

                if (response == '0' || response == '1') {
                    jQuery('.conv-btn-connect-enabled-google').text('Connect');
                    jQuery('#convsst_save_success_txt').html(user_modal_txt);
                    jQuery('#convsst_save_success_modal').modal('show');
                }
                convsst_change_loadingbar('hide');
            }
        });

    });

    // Create new gads acc
    jQuery('#ads-continue').on('click', function(e) {
        e.preventDefault();
        create_google_convsst_ads_account(tvc_data);
        jQuery('.ggladspp').removeClass('showpopup');
    });

});
");
?>



