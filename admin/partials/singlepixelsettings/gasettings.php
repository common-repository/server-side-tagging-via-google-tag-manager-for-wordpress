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
                <?php 
                /* translators: %s: Top Notice */
                printf(  esc_html__( '%s', "server-side-tagging-via-google-tag-manager-for-wordpress" ), esc_html($pixel_settings_arr[$subpage]['topnoti']) ); 
                ?>
            </div>
        </div>
    <?php } ?>


    <?php
    $connect_url = $TVC_Admin_Helper->get_custom_connect_url_subpage(admin_url() . 'admin.php?page=convsst-conversios-google-analytics', "gasettings");
    require_once("googlesignin.php");
    ?>

    <form id="gasettings_form" class="convpixsetting-inner-box mt-4">

        <?php
        $tracking_option = (isset($ee_options['tracking_option']) && $ee_options['tracking_option'] != "") ? $ee_options['tracking_option'] : "";
        ?>
        <div>
            <!-- Google Analytics 3 -->
            <?php
            $ua_analytic_account_id = (isset($googleDetail->ua_analytic_account_id) && $googleDetail->ua_analytic_account_id != "") ? $googleDetail->ua_analytic_account_id : "";
            $property_id = (isset($googleDetail->property_id) && $googleDetail->property_id != "") ? $googleDetail->property_id : "";
            ?>
            <!-- Google Analytics 3 End-->

            <!-- Google Analytics 4 -->
            <?php
            $convsst_api_data = unserialize(get_option("convsst_api_data"));
            $convsst_api_data = isset($convsst_api_data['setting']) ? $convsst_api_data['setting'] : null;
            $ga4_analytic_account_id = (isset($convsst_api_data->ga4_analytic_account_id) && $convsst_api_data->ga4_analytic_account_id != "") ? $convsst_api_data->ga4_analytic_account_id : "";
            $measurement_id = (isset($convsst_api_data->measurement_id) && $convsst_api_data->measurement_id != "") ? $convsst_api_data->measurement_id : "";
            ?>
            <div id="analytics_box_GA4" class="py-1">
                <h5 class="fw-normal mb-1">
                    <?php esc_html_e("Select Google Analytics 4 Id", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                </h5>
                <div class="row pt-1 conv-hideme-gasettings">
                    <div class="col-5">
                        <select id="ga4_analytic_account_id" name="ga4_analytic_account_id" acctype="GA4" class="form-select form-select-lg mb-3 ga_analytic_account_id ga_analytic_account_id_ga4 selecttwo_search" style="width: 100%" <?php echo esc_attr($is_sel_disable); ?>>
                            <?php if (!empty($ga4_analytic_account_id)) { ?>
                                <option selected><?php echo esc_html($ga4_analytic_account_id); ?></option>
                            <?php } ?>
                            <option value="">Select GA4 Account ID</option>
                        </select>
                    </div>
                    <div class="col-5">
                        <select id="ga4_property_id" name="measurement_id" class="form-select form-select-lg mb-3 selecttwo_search" style="width: 100%" <?php echo esc_attr($is_sel_disable); ?>>
                            <option value="">Select Measurement ID</option>
                            <?php if (!empty($measurement_id)) { ?>
                                <option selected><?php echo esc_html($measurement_id); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-2 d-flex align-items-end">
                        <button type="button" class="btn btn-sm d-flex conv-enable-selection conv-link-blue align-items-center">
                            <span class="material-symbols-outlined md-18">edit</span>
                            <span class="px-1">Edit</span>
                        </button>
                    </div>

                </div>
            </div>
            <!-- Google Analytics 4 End -->


            <!-- GA4 API Secret  -->
            <?php
            $ga4_api_secret = (isset($ee_options["ga4_api_secret"]) && $ee_options["ga4_api_secret"] != "") ? $ee_options["ga4_api_secret"] : "";
            ?>
            <div id="ga4apisecret_box" class="py-3 <?php echo $tracking_option === 'UA' ? 'd-none' : ''; ?>">
                <div class="row pt-2">
                    <div class="col-12">
                        <h5 class="d-flex fw-normal mb-1 text-dark">
                            <?php esc_html_e("GA4 API Secret (To track refund order)", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>

                            <span class="align-middle conv-link-blue fw-bold-500 upgradetopro_badge" popupopener="ga4apisecret_box_inner">&nbsp;<img
                                    src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/upgrade_badge.png'); ?>">&nbsp;Available
                                In Pro</span>
                        </h5>
                        <input type="text" disabled name="ga4_api_secret" id="ga4_api_secret" class="form-control" value="" placeholder="e.g. CnTrpcbsStWFU5-TmSuhuS">
                    </div>

                </div>
            </div>
            <!-- GA4 API Secret End-->
        </div>
    </form>

</div>

<?php
$js_code_1 = $js_code_2 = "";
if ( isset($_GET['subscription_id']) ||  ($cust_g_email != "" && empty($ga4_analytic_account_id)) ) { 
    $js_code_1 = "load_ga_accounts(tvc_data);";
}
if ($cust_g_email != '') {
    $js_code_2 = "jQuery('.conv-btn-connect').removeClass('conv-btn-connect-disabled');
    jQuery('.conv-btn-connect').addClass('conv-btn-connect-enabled-google');
    jQuery('.conv-btn-connect').text('Save');";
} else {
    $js_code_2 = "jQuery('.tvc_google_signinbtn').trigger('click');";
}

$GET_SUBSCRIPTION_ID = isset($_GET['subscription_id']) ? sanitize_text_field($_GET['subscription_id']) : "''";

wp_add_inline_script( 'convsst-admin',"

// get list of google analytics account
function list_analytics_account(tvc_data, selelement, currele, page = 1) {
    var convsst_onboarding_nonce = '". esc_js(wp_create_nonce('convsst_onboarding_nonce')) ."';
    jQuery.ajax({
        type: 'POST',
        dataType: 'json',
        url: tvc_ajax_url,
        data: { 
            action: 'get_analytics_account_list',
            tvc_data: tvc_data,
            page: page,
            subscription_id: ". $GET_SUBSCRIPTION_ID .",
            convsst_onboarding_nonce: convsst_onboarding_nonce
        },
        success: function(response) {
            jQuery('#ga4_analytic_account_id').html('<option>Select GA4 Account ID</option>');
            jQuery('#ga4_property_id').html('<option>Select Measurement ID</option>');
            if (response && response.error == false) {
                var error_msg = 'null';
                if (response?.data?.items.length > 0) {
                    var AccOptions = '';
                    var selected = '';
                    response?.data?.items.forEach(function(item) {
                        AccOptions = AccOptions + '<option value=\"' + item.id + '\"> ' + item.name + '-' + item.id + '</option>';
                    });

                    jQuery('#ga4_analytic_account_id').append(AccOptions); //GA4 
                    selelement.prop('disabled', false);
                    jQuery('.conv-enable-selection').addClass('d-none');

                } else {
                    console.log('error1', 'There are no Google Analytics accounts associated with this email.');
                    getAlertMessageAll(
                        'info',
                        'Error',
                        message = 'There are no Google Analytics accounts associated with this email.',
                        icon = 'info',
                        buttonText = 'Ok',
                        buttonColor = '#FCCB1E',
                        iconImageSrc = '<img src=\"". esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/convsst_error_logo.png'). "\"/ >'
                    );
                }
            } else if (response && response.error == true && response.error != undefined) {
                const errors = response.errors[0];
                getAlertMessageAll(
                    'info',
                    'Error',
                    message = errors,
                    icon = 'info',
                    buttonText = 'Ok',
                    buttonColor = '#FCCB1E',
                    iconImageSrc = '<img src=\"". esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/convsst_error_logo.png'). "\"/ >'
                );
                var error_msg = errors;
            } else {
                getAlertMessageAll(
                    'info',
                    'Error',
                    message = 'There are no Google Analytics accounts associated with this email.',
                    icon = 'info',
                    buttonText = 'Ok',
                    buttonColor = '#FCCB1E',
                    iconImageSrc = '<img src=\"". esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/convsst_error_logo.png') ."\"/ >'
                );
            }
            jQuery('#tvc-ga4-acc-edit-acc_box')?.removeClass('tvc-disable-edits');
            convsst_change_loadingbar('hide');
            jQuery('.conv-enable-selection').removeClass('disabled');
        }
    });
}

// get list properties dropdown options
function list_analytics_web_properties(type, tvc_data, account_id, thisselid) {
    jQuery('#ga4_property_id').prop('disabled', true);
    var convsst_onboarding_nonce = '". esc_js(wp_create_nonce('convsst_onboarding_nonce')) ."';
    jQuery.ajax({
        type: 'POST',
        dataType: 'json',
        url: tvc_ajax_url,
        data: {
            action: 'get_analytics_web_properties',
            account_id: account_id,
            type: type,
            tvc_data: tvc_data,
            convsst_onboarding_nonce: convsst_onboarding_nonce
        },
        success: function(response) {
            if (response && response.error == false) {
                var error_msg = 'null';


                if (type == 'GA4') {
                    jQuery('#ga4_property_id').empty().trigger('change');
                    jQuery('#both_ga4_property_id').empty().trigger('change');
                    if (response?.data?.wep_measurement.length > 0) {
                        var streamOptions = '<option value=\"\">Select Measurement Id</option>';
                        var selected = '';
                        response?.data?.wep_measurement.forEach(function(item) {
                            let dataName = item.name.split('/');
                            streamOptions = streamOptions + '<option value=\"' + item.measurementId + '\">' + item.measurementId + ' - ' + item.displayName + '</option>';
                        });
                        jQuery('#ga4_property_id').append(streamOptions);
                        jQuery('#both_ga4_property_id').append(streamOptions);
                    } else {
                        var streamOptions = '<option value=\"\">No GA4 Property Found</option>';
                        jQuery('#ga3_property_id').append(streamOptions);
                        jQuery('#both_ga3_property_id').append(streamOptions);
                        getAlertMessageAll(
                            'info',
                            'Error',
                            message = 'There are no Google Analytics 4 Properties associated with this analytics account.',
                            icon = 'info',
                            buttonText = 'Ok',
                            buttonColor = '#FCCB1E',
                            iconImageSrc = '<img src=\"". esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/convsst_error_logo.png') ."\"/ >'
                        );
                    }
                    jQuery('.ga_analytic_account_id_ga4:not(#' + thisselid + ')').val(account_id).trigger('change');
                }

            } else if (response && response.error == true && response.error != undefined) {
                const errors = response.error[0];
                getAlertMessageAll(
                    'info',
                    'Error',
                    message = errors,
                    icon = 'info',
                    buttonText = 'Ok',
                    buttonColor = '#FCCB1E',
                    iconImageSrc = '<img src=\"". esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/convsst_error_logo.png') ."\"/ >'
                );
                var error_msg = errors;
            } else {
                getAlertMessageAll(
                    'info',
                    'Error',
                    message = 'There are no Google Analytics Properties associated with this email.',
                    icon = 'info',
                    buttonText = 'Ok',
                    buttonColor = '#FCCB1E',
                    iconImageSrc = '<img src=\"". esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/convsst_error_logo.png') ."\"/ >'
                );
            }
            convsst_change_loadingbar('hide');
            jQuery('#ga4_property_id').prop('disabled', false);
        }
    });
}

function load_ga_accounts(tvc_data) {
    convsst_change_loadingbar('show');
    jQuery('.conv-enable-selection').addClass('disabled');
    var selele = jQuery('.conv-enable-selection').closest('.conv-hideme-gasettings').find('select.ga_analytic_account_id');
    var currele = jQuery(this).closest('.conv-hideme-gasettings').find('select.ga_analytic_account_id');
    list_analytics_account(tvc_data, selele, currele);
}

//Onload functions
jQuery(function() {
    var tvc_data = '". esc_js(wp_json_encode($tvc_data)) ."';
    var tvc_ajax_url = '". esc_url(admin_url('admin-ajax.php')) ."';
    let subscription_id = '". esc_attr($subscriptionId) ."';
    let plan_id = '". esc_attr($plan_id) ."';
    let app_id = '". esc_attr($app_id) ."';
    let bagdeVal = 'yes';
    let convBadgeVal = '". esc_attr($convBadgeVal) ."';

    jQuery('.selecttwo_search').select2({
        minimumResultsForSearch: 1,
        placeholder: function() {
            jQuery(this).data('placeholder');
        }
    });

    jQuery('input[type=radio][name=tracking_option]').change(function() {
        jQuery('.conv-hideme-gasettings').addClass('d-none');
        jQuery(this).parent().find('.conv-hideme-gasettings').removeClass('d-none');
        var tracking_option = jQuery(this).val();
        if (tracking_option == 'BOTH' || tracking_option == 'GA4') {
            jQuery('#ga4apisecret_box').removeClass('d-none');
        }
        if (tracking_option == 'UA') {
            jQuery('#ga4apisecret_box').addClass('d-none');
        }
    });
    ".$js_code_1."
    jQuery('.conv-enable-selection').click(function() {
        convsst_change_loadingbar('show');
        jQuery('.conv-enable-selection').addClass('disabled');
        var selele = jQuery('.conv-enable-selection').closest('.conv-hideme-gasettings').find('select.ga_analytic_account_id');
        var currele = jQuery(this).closest('.conv-hideme-gasettings').find('select.ga_analytic_account_id');
        list_analytics_account(tvc_data, selele, currele);
    });

    jQuery(document).on('select2:select', '.ga_analytic_account_id', function(e) {
        if (jQuery(this).val() != \"\" && jQuery(this).val() != undefined) {
            convsst_change_loadingbar('show');
            var account_id = jQuery(e.target).val();
            var acctype = jQuery(e.target).attr('acctype');
            var thisselid = e.target.getAttribute('id');
            list_analytics_web_properties(acctype, tvc_data, account_id, thisselid);
            jQuery('.ga_analytic_account_id').closest('.conv-hideme-gasettings').find('select').prop('disabled', false);
        } else {
            jQuery('.ga_analytic_account_id').closest('.conv-hideme-gasettings').find('select').prop('disabled', false);
        }

    });

    jQuery(document).on('change', 'form#gasettings_form', function() {
        ".$js_code_2."
    });

    // Save data
    jQuery(document).on('click', '.conv-btn-connect-enabled-google', function() {
        var tracking_option = 'GA4';
        var box_id = \"#analytics_box_\" + tracking_option;
        var has_error = 0;
        var selected_vals = {};
        selected_vals['ua_analytic_account_id'] = '". esc_attr($ua_analytic_account_id) ."';
        selected_vals['property_id'] = '". esc_attr($property_id) ."';
        selected_vals['ga4_analytic_account_id'] = '';
        selected_vals['measurement_id'] = '';
        selected_vals['subscription_id'] = '". esc_js($tvc_data['subscription_id']) ."';
        jQuery(box_id).find('select').each(function() {
            if (!jQuery(this).val() || jQuery(this).val() == \"\" || jQuery(this).val() == 'undefined') {
                has_error = 1;
                return;
            } else {
                selected_vals[jQuery(this).attr('name')] = jQuery(this).val();
            }
        });
        selected_vals['tracking_option'] = tracking_option;
        selected_vals['ga4_api_secret'] = jQuery('#ga4_api_secret').val();
        if (has_error == 1) {
            jQuery('.conv-btn-connect').addClass('conv-btn-connect-disabled');
            jQuery('.conv-btn-connect').removeClass('conv-btn-connect-enabled-google');
            jQuery('.conv-btn-connect').text('Save');
            alert('Please select required fields to continue.');
        } else {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: tvc_ajax_url,
                data: {
                    action: 'convsst_save_pixel_data',
                    pix_sav_nonce: '". esc_js(wp_create_nonce('pix_sav_nonce_val')) ."',
                    convsst_options_data: selected_vals,
                    convsst_options_type: ['eeoptions', 'eeapidata', 'middleware'],
                    convsst_tvc_data: tvc_data,
                },
                beforeSend: function() {
                    jQuery('.conv-btn-connect-enabled-google').text('Saving...');
                    convsst_change_loadingbar('show');
                    jQuery(this).addClass('disabled');
                },
                success: function(response) {
                    var user_modal_txt = 'Congratulations, you have successfully saved your';
                    var user_modal_txt2 = \"<br>GA3 Account ID: \" + selected_vals['property_id'];
                    var user_modal_txt3 = \"<br>GA4 account ID: \" + selected_vals['measurement_id'];

                    if (tracking_option == 'BOTH') {
                        user_modal_txt = user_modal_txt + \" \" + user_modal_txt2 + \" \" + user_modal_txt3;
                    }
                    if (tracking_option == 'UA') {
                        user_modal_txt = user_modal_txt + \" \" + user_modal_txt2;
                    }
                    if (tracking_option == 'GA4') {
                        user_modal_txt = user_modal_txt + \" \" + user_modal_txt3;
                    }

                    if (response == '0' || response == '1') {
                        jQuery('.conv-btn-connect-enabled-google').text('Connect');
                        jQuery('#convsst_save_success_txt').html(user_modal_txt);
                        jQuery('#convsst_save_success_modal').modal('show');
                    }

                }
            });
        }
    });
});

");
?>
