<?php
$ee_options = unserialize(get_option('convsst_options'));
$sch_email_toggle_check = isset($ee_options['sch_email_toggle_check']) ? sanitize_text_field($ee_options['sch_email_toggle_check']) : '1';
$sch_custom_email = isset($ee_options['sch_custom_email']) ? sanitize_text_field($ee_options['sch_custom_email']) : '';
$sch_email_frequency = isset($ee_options['sch_email_frequency']) ? sanitize_text_field($ee_options['sch_email_frequency']) : '';
$g_mail = get_option('ee_customer_gmail');
$ga4_measurement_id = isset($ee_options['gm_id']) && $ee_options['gm_id'] != "" ? $ee_options['gm_id'] : "";
$google_ads_id = isset($ee_options['google_ads_id']) && $ee_options['google_ads_id'] != "" ? $ee_options['google_ads_id'] : "";
$last_fetched_prompt_date = isset($ee_options['last_fetched_prompt_date']) && $ee_options['last_fetched_prompt_date'] != "" ? $ee_options['last_fetched_prompt_date'] : "";
$ecom_reports_ga_currency = isset($ee_options['ecom_reports_ga_currency']) ? sanitize_text_field($ee_options['ecom_reports_ga_currency']) : '';
$ecom_reports_gads_currency = isset($ee_options['ecom_reports_gads_currency']) ? sanitize_text_field($ee_options['ecom_reports_gads_currency']) : '';

$subpage = (isset($_GET["subpage"]) && $_GET["subpage"] != "") ? sanitize_text_field($_GET["subpage"]) : "ga4ecommerce";


$report_settings_arr = array("ga4ecommerce", "gads", "ga4general");
if ($subpage == "ga4ecommerce") {
    $ga4page_cls = "btn-outline-primary";
    $gadspage_cls = "btn-outline-secondary alt-btn-reports";
    $ga4general_cls = "btn-outline-secondary alt-btn-reports";
} else if ($subpage == "gads") {
    $ga4page_cls = "btn-outline-secondary alt-btn-reports";
    $gadspage_cls = "btn-outline-primary";
    $ga4general_cls = "btn-outline-secondary alt-btn-reports";
} else if ($subpage == "ga4general") {
    $ga4page_cls = "btn-outline-secondary alt-btn-reports";
    $gadspage_cls = "btn-outline-secondary alt-btn-reports";
    $ga4general_cls = "btn-outline-primary";
}
$plan_id = !empty($this->plan_id) ? $this->plan_id : 1;

?>

<div class="conv_report_mainbox pt-4 mx-4">
    <div class="row">
        <div class="d-flex">
            <div class="conv_pageheading">
                <h2><?php esc_html_e("Reports & Insights", "server-side-tagging-via-google-tag-manager-for-wordpress") ?></h2>
            </div>
            <div class="ms-auto p-2 bd-highlight">
            <div id="reportrange" class="dshtpdaterange upgradetopro_badge" popupopener="ereports">
                    <div class="dateclndicn">
                        <img src="<?php echo esc_url_raw(CONVSST_PLUGIN_URL . '/admin/images/claendar-icon.png'); ?>" alt="" />
                    </div>
                    <span class="daterangearea report_range_val"></span>
                    <div class="careticn">
                        <img src="<?php echo esc_url_raw(CONVSST_PLUGIN_URL . '/admin/images/caret-down.png'); ?>" alt="" />
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex">

            <div class="conv_pageheading">
                <a href="admin.php?page=conversios-analytics-reports&subpage=ga4general" class="btn <?php echo $ga4general_cls; ?> me-3">
                    <?php esc_html_e("General Reports", "server-side-tagging-via-google-tag-manager-for-wordpress") ?>
                </a>
                <a href="admin.php?page=conversios-analytics-reports&subpage=ga4ecommerce" class="btn <?php echo $ga4page_cls; ?> me-3">
                    <?php esc_html_e("Ecommerce Reports", "server-side-tagging-via-google-tag-manager-for-wordpress") ?>
                </a>
                <a href="admin.php?page=conversios-analytics-reports&subpage=gads" class="btn <?php echo $gadspage_cls; ?> me-3">
                    <?php esc_html_e("Google Ads Reports", "server-side-tagging-via-google-tag-manager-for-wordpress") ?>
                </a>
            </div>
            <div class="ms-auto p-2 bd-highlight">
                <?php if($plan_id != 11 && $plan_id != 1){ ?>
                    <h4 class="conv-text-blue d-flex schedule_email" data-bs-toggle="modal" data-bs-target="#schedule_email_modal">
                    <span class="material-symbols-outlined conv-text-blue pe-1">check_circle</span>
                    <?php esc_html_e("Schedule Email", "server-side-tagging-via-google-tag-manager-for-wordpress") ?>
                </h4>
                <?php } else {?>
                    <h4 class="conv-text-blue d-flex schedule_email" data-bs-toggle="modal" data-bs-target="#upgradetopromodal">
                    <span class="material-symbols-outlined conv-text-blue pe-1">check_circle</span>
                    <?php esc_html_e("Schedule Email", "server-side-tagging-via-google-tag-manager-for-wordpress") ?>
                </h4>
                <?php } ?>
                
            </div>
        </div>

        <?php if ($subpage == "ga4ecommerce" && $ga4_measurement_id == "") { ?>
            <div class="d-flex">
                <div class="col-12 alert alert-danger alert alert-danger h5 py-4 my-4 d-flex justify-content-center" role="alert">
                    <span class="material-symbols-outlined">
                        error
                    </span>
                    <?php esc_html_e("Please connect Google Analytics account to view the reports.", "server-side-tagging-via-google-tag-manager-for-wordpress") ?>
                    <a class="conv-link-blue d-flex ps-3" href="<?php echo esc_url_raw('admin.php?page=convsst-conversios-google-analytics"'); ?>">
                        <?php esc_html_e("Click here to connect", "server-side-tagging-via-google-tag-manager-for-wordpress") ?>
                        <span class="material-symbols-outlined">
                            arrow_forward
                        </span>
                    </a>
                </div>
            </div>
        <?php } ?>


    </div>
    
        <?php
        if (in_array($subpage, $report_settings_arr)) {
            require_once(CONVSST_PLUGIN_DIR . "admin/partials/reports/" . $subpage . '.php');
        }
        ?>
        <!-- All report section -->
</div>


<!-- Schedule Email Modal box -->
<div class="modal email-modal fade" id="schedule_email_modal" tabindex="-1" aria-labelledby="schedule_email_modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div id="loadingbar_blue" class="progress-materializecss" style="display: none;">
            <div class="indeterminate"></div>
        </div>
        <div class="modal-content">
            <div class="modal-body">
                <div class="scheduleemail-box">
                    <h2><?php esc_html_e("Schedule Email", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?></h2>
                    <p>
                        <?php esc_html_e("Schedule your Google Analytics 4 Insight Report email for", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                        <br>
                        <?php esc_html_e("data-driven insights", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                    </p>
                    <?php
                    if ($sch_email_toggle_check == '0') { //enabled
                        $switch_cls = 'convEmail_default_cls_enabled';
                        $switch_checked = 'checked';
                        $save_btn_text = 'Save';
                        $arrow_class_drop = 'down-arrow';
                        if ($sch_custom_email != '') {
                            $sch_custom_email_final = $sch_custom_email;
                        } else {
                            $sch_custom_email_final = $g_mail;
                        }
                        $email_frequency_disabled = '';
                    } else { //disabled
                        $switch_cls = 'convEmail_default_cls_disabled';
                        $switch_checked = '';
                        $arrow_class_drop = '';
                        $save_btn_text = 'Save';
                        $email_frequency_disabled = 'disabled';
                        $sch_custom_email_final = $g_mail;
                    } ?>
                    <div class="schedule-formbox">
                        <div class="toggle-switch">
                            <div class="form-check form-switch">
                                <div class="form-check form-switch">
                                    <label id="email_toggle_btnLabel" for="email_toggle_btn" class="form-check-input switch <?php echo $switch_cls; ?>" role="switch">
                                        <input id="email_toggle_btn" type="checkbox" class="<?php echo $switch_cls; ?>" <?php echo $switch_checked; ?>>
                                        <div></div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-wholebox">
                            <div class="form-box">
                                <label for="custom_email" class="form-label llabel"><?php esc_html_e("Email address", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?></label>
                                <input type="email" class="form-control icontrol" id="custom_email" aria-describedby="emailHelp" placeholder="user@gmail.com" value="<?php echo $sch_custom_email_final; ?>" <?php echo $email_frequency_disabled; ?>>
                            </div>
                            <div class="form-box">
                                <label for="email_frequency" class="form-label llabel">
                                    <?php esc_html_e("Email Frequency", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                                </label>
                                <input type="text" class="form-control icontrol" id="email_frequency" value="<?php echo $sch_email_frequency; ?>" <?php echo $email_frequency_disabled; ?> readonly>
                                <div id="email_frequency_arrow" class="<?php echo $arrow_class_drop; ?>"></div>
                                <ul class="dropdown" id="emailFrequency_holder" style="display:none;">
                                    <li id="Daily" class="email-items">
                                        <?php esc_html_e("Daily", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?></li>
                                    <li id="Weekly" class="email-items">
                                        <?php esc_html_e("Weekly", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?></li>
                                    <li id="Monthly" class="email-items">
                                        <?php esc_html_e("Monthly", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                                    </li>
                                </ul>
                            </div>
                            <?php
                            if ($sch_email_frequency == "Daily") {
                                $sch_duration = "day";
                                $sch_duration_days = "7";
                            } else if ($sch_email_frequency == "Weekly") {
                                $sch_duration = "week";
                                $sch_duration_days = "7";
                            } else if ($sch_email_frequency == "Monthly") {
                                $sch_duration = "month";
                                $sch_duration_days = "30";
                            } else {
                                $sch_duration = "week";
                                $sch_duration_days = "7";
                            }
                            ?>
                            <div class="form-box">
                                <h5><span id="sch_frequency_msg">
                                        <?php esc_html_e("You will receive a report in your email inbox every " . $sch_duration . ", providing you with
                                            updated
                                            insights from the past " . $sch_duration_days . " Days.", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                                    </span></h5>
                            </div>
                            <div class="form-box">
                                <div class="save">
                                    <button id="schedule_email_save_config" class="btn disabled save-btn"><?php esc_html_e("Available in pro","server-side-tagging-via-google-tag-manager-for-wordpress") //echo $save_btn_text; ?></button>
                                </div>
                            </div>
                            <div class="form-box">
                                <div class="save">
                                    <span id="err_sch_msg" style="display: none;color: red;position: absolute;top: -9px;"><?php esc_html_e("Something went wrong, please try again later.", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?></span>
                                </div>
                            </div>

                            <div id="schedule_email_alert" class="d-none">
                                <div class="alert alert-info" role="alert">
                                    <div id="schedule_email_alert_msg"></div>
                                    <div role="button" class="fw-bold pt-3" data-bs-dismiss="modal">Click here to close the popup</div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!--modal end-->
<!-- Upgrade to PRO modal -->
<!-- <div class="modal fade" id="upgradetopromodal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body p-4 pb-0">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="fw-bold text-uppercase pt-0 d-flex"><img style="height:29px;max-width:100%;margin-right: 10px;" src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/upgrade_badge_big.png'); ?>" />
                                <?php esc_html_e("Upgrade to Pro now and enjoy exclusive benefits:", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                            </h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <ul class="conv-upgrade-banner-list ps-4 pt-4">
                                <li>Take advantage of <span>Google Consent Mode V2</span> for enhanced tracking across all platforms.</li>
                                <li>Use your <span>own GTM container</span> with automated tag triggers.</li>
                                <li>Optimize <span>Google Ads conversion tracking</span> for Add To Cart and Begin Checkout.</li>
                                <li>Enable <span>Dynamic Remarketing</span> Tags for View_item, Add_to_cart, Begin_checkout, Purchase.</li>
                                <li>Integrate seamlessly with <span>FBCAPI, Snapchat CAPI, and TikTok Events API</span>.</li>
                                <li>Access detailed <span>GA4 e-commerce reporting</span>.</li>
                                <li>Maximize results with <span>Google Ads conversion reporting</span>.</li>
                                <li>Expand your reach with <span>unlimited product feed</span> for Google Merchant Center, FB Catalogue, and TikTok.</li>
                                <li>Experience dedicated <span>customer support</span>.</li>
                                <li>Implement <span>server-side tagging</span> for enhanced performance.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 pb-4 mb-1 pt-4">
                <a id="upgradetopro_modal_link" class="btn conv-yellow-bg m-auto w-100 mx-4 p-2" href="https://www.conversios.io/wordpress/all-in-one-google-analytics-pixels-and-product-feed-manager-for-woocommerce-pricing/?utm_source=in_app&utm_medium=modal_popup&utm_campaign=upgrade" target="_blank">
                    <?php esc_html_e("Upgrade Now", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                </a>
            </div>
        </div>
    </div>
</div> -->
<!-- Upgrade to PRO modal End -->
<script>
    var plan_id = "<?php echo $plan_id ?>";
    // Schedule email
    function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!regex.test(email)) {
            return false;
        } else {
            return true;
        }
    }

    function save_local_data(email_toggle_check, custom_email, email_frequency) {
        var selected_vals = {};
        selected_vals['sch_email_toggle_check'] = email_toggle_check;
        selected_vals['sch_custom_email'] = custom_email;
        selected_vals['sch_email_frequency'] = email_frequency;
        jQuery.ajax({
            type: "POST",
            dataType: "json",
            url: tvc_ajax_url,
            data: {
                action: "convsst_save_pixel_data",
                pix_sav_nonce: "<?php echo wp_create_nonce('pix_sav_nonce_val'); ?>",
                convsst_options_data: selected_vals,
                convsst_options_type: ["eeoptions"]
            },
            beforeSend: function() {},
            success: function(response) {
                console.log('Email setting saved in db');
            }
        });
    }
    /*schedule email form submit event listner*/
    jQuery("#schedule_email_save_config").on("click", function() {
        let email_toggle_check = '1'; //default
        if (jQuery("#email_toggle_btn").prop("checked")) {
            email_toggle_check = '0'; //enabled
        } else {
            email_toggle_check = '1'; //disabled
        }
        let custom_email = jQuery("#custom_email").val();
        let email_frequency = jQuery("#email_frequency").val();
        if (email_toggle_check == '0') {
            //validations
            if (custom_email != "") {
                if (IsEmail(custom_email)) {
                    jQuery("#custom_email").attr("style", "border: 1px solid #E4E4E4 !important");
                } else {
                    jQuery("#custom_email").attr("style", "border: 1px solid red !important");
                    jQuery("#custom_email").focus();
                    return false;
                }
            } else {
                jQuery("#custom_email").attr("style", "border: 1px solid red !important");
                jQuery("#custom_email").focus();
                return false;
            }
            if (email_frequency != "") {
                if (email_frequency == "Daily") {
                    email_frequency_final = "1_day";
                } else if (email_frequency == "Weekly") {
                    email_frequency_final = "7_day";
                } else if (email_frequency == "Monthly") {
                    email_frequency_final = "30_day";
                } else {
                    email_frequency_final = "7_day";
                }
                jQuery("#email_frequency").attr("style", "border: 1px solid #E4E4E4 !important");
            } else {
                jQuery("#email_frequency").attr("style", "border: 1px solid red !important");
                jQuery("#email_frequency").focus();
                return false;
            }
            var data = {
                "action": "set_email_configurationGA4",
                "subscription_id": '<?php echo isset($ee_options['subscription_id']) ? esc_attr($ee_options['subscription_id']) : ''; ?>',
                "is_disabled": email_toggle_check,
                "custom_email": custom_email,
                "email_frequency": email_frequency_final,
                "convsst_nonce": '<?php echo wp_create_nonce('convsst_nonce'); ?>'
            };
        } else {
            //validations 
            var data = {
                "action": "set_email_configurationGA4",
                "subscription_id": '<?php echo isset($ee_options['subscription_id']) ? esc_attr($ee_options['subscription_id']) : ''; ?>',
                "is_disabled": email_toggle_check,
                "convsst_nonce": '<?php echo wp_create_nonce('convsst_nonce'); ?>'
            };
        }
        jQuery.ajax({
            type: "POST",
            dataType: "json",
            url: tvc_ajax_url,
            data: data,
            beforeSend: function() {
                jQuery("#loadingbar_blue").show();
            },
            success: function(response) {
                if (response.error == false) {
                    jQuery("#err_sch_msg").hide();
                    jQuery("#loadingbar_blue").hide();
                    if (email_toggle_check == "0") {
                        jQuery("#schedule_email_alert_msg").html("Successfully subscribed to receive analytics reports in your email");
                    } else {
                        jQuery("#schedule_email_alert_msg").html("Successfully Unsubscribed");
                    }

                    jQuery("#schedule_email_alert").removeClass("d-none");

                    jQuery('#sch_ack_msg').show();
                    //local storage
                    save_local_data(email_toggle_check, custom_email, email_frequency);
                    if (email_toggle_check == '0') {
                        jQuery('#schedule_form_btn_set').show();
                        jQuery('#schedule_form_btn_raw').hide();
                    } else {
                        jQuery('#schedule_form_btn_set').hide();
                        jQuery('#schedule_form_btn_raw').show();
                    }
                } else {
                    jQuery("#err_sch_msg").show();
                    jQuery("#loadingbar_blue").hide();
                }
                setTimeout(
                    function() {
                        jQuery("#sch_ack_msg").hide();
                    }, 8000);
            }
        });
    });
    jQuery("#sch_ack_msg_close").on("click", function() {
        jQuery("#sch_ack_msg").hide();
    });
    jQuery('#email_toggle_btn').change(function() {
        if (jQuery(this).prop("checked")) {
            jQuery("#email_toggle_btnLabel").addClass("convEmail_default_cls_enabled");
            jQuery("#email_toggle_btnLabel").removeClass("convEmail_default_cls_disabled");
            jQuery("#custom_email").prop("disabled", false);
            jQuery("#custom_email").css("background-color", "#F5F6F7");
            jQuery("#email_frequency").prop("disabled", false);
            jQuery("#email_frequency_arrow").addClass("down-arrow");
            jQuery("#email_frequency").css("background-color", "#F5F6F7");
            //jQuery("#schedule_email_save_config").text("Save");
            //jQuery("#email_frequency").val('Weekly');
            jQuery("#custom_email").val('<?php echo $g_mail; ?>');
            /*jQuery("#schedule_email_save_config").prop( "disabled", false );
            jQuery("#schedule_email_save_config").css("background-color","#1085F1");*/

        } else {
            jQuery("#email_toggle_btnLabel").addClass("convEmail_default_cls_disabled");
            jQuery("#email_toggle_btnLabel").removeClass("convEmail_default_cls_enabled");
            jQuery("#custom_email").prop("disabled", true);
            jQuery("#email_frequency").css("background-color", "#E9ECEF");
            jQuery("#email_frequency").val('');
            jQuery("#custom_email").val('');
            jQuery("#custom_email").css("background-color", "#E9ECEF");
            jQuery("#email_frequency").prop("disabled", true);
            jQuery("#email_frequency_arrow").removeClass("down-arrow");
            //jQuery("#schedule_email_save_config").text("Save");
            /*jQuery("#schedule_email_save_config").prop( "disabled", true );
            jQuery("#schedule_email_save_config").css("border","1px solid");
            jQuery("#schedule_email_save_config").css("background-color","#E9ECEF");*/
        }
    });
    jQuery("#email_frequency,#email_frequency_arrow").on("click", function() {
        if (jQuery("#emailFrequency_holder").is(":visible")) {
            jQuery("#emailFrequency_holder").hide();
        } else {
            jQuery("#emailFrequency_holder").show();
        }
    });
    jQuery(".email-items").on("click", function() {
        jQuery("#email_frequency").val(this.id);
        jQuery("#emailFrequency_holder").hide();
        let sch_frequency_msg = "";
        if (this.id == "Daily") {
            sch_frequency_msg =
                "You will receive a report in your inbox every day, providing you with updated insights from the past 7 Days.";
        } else if (this.id == "Weekly") {
            sch_frequency_msg =
                "You will receive a report in your inbox every week, providing you with updated insights from the past 7 Days.";
        } else if (this.id == "Monthly") {
            sch_frequency_msg =
                "You will receive a report in your inbox every month, providing you with updated insights from the past 30 Days.";
        } else {
            sch_frequency_msg =
                "You will receive a report in your inbox every week, providing you with updated insights from the past 7 Days.";
        }
        jQuery("#sch_frequency_msg").text(sch_frequency_msg);
    });
    // End Schedule email
    jQuery('#schedule_email_modal').on('hidden.bs.modal', function(e) {
        jQuery("#schedule_email_alert_msg").html("");
        jQuery("#schedule_email_alert").addClass("d-none");
    });
    if (plan_id == 11) {
        jQuery('#reportrange, .conv_page_path').click(function() {
            jQuery("#upgradetopromodal").modal('show');
        });
    }
</script>