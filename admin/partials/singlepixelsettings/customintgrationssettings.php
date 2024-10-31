<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$is_sel_disable = 'disabled';
?>
<div class="convcard p-4 mt-0 rounded-3 shadow-sm">
    <form id="advset_customintegration_form" class="convpixsetting-inner-box">
        <h5 class="fw-bold-500 mb-1">
            <?php esc_html_e("Product Data Collection Method", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
        </h5>
        <div>
            <?php esc_html_e("When you have custom woocommerce implementation and you have modified standard woocommerce hooks, you can select your custom hooks from below to enable google analytics tracking for specific events.", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
        </div>

        <a target="_blank" class="conv-link-blue fw-normal" href="<?php echo esc_url("https://" . CONVSST_AUTH_CONNECT_URL . "/docs/custom-google-analytics-event-tracking-in-woocommerce-with-conversios-plugin/"); ?>">
            <b><?php esc_html_e("Detailed Document", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?></b>
        </a>

        <!-- Product list page  -->
        <div class="mt-4 d-flex align-items-center">
            <label for="tvc_product_list_data_collection_method" class="col-sm-3 col-form-label text-dark">
                <small class="fw-bold-500"><?php esc_html_e("Product List", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?></small>
            </label>
            <div class="col-sm-9">
                <?php $tvc_product_list_data_collection_method = isset($ee_options['tvc_product_list_data_collection_method']) ? $ee_options['tvc_product_list_data_collection_method'] : "woocommerce_after_shop_loop_item";
                $list = array(
                    "woocommerce_before_shop_loop_item" => "woocommerce_before_shop_loop_item (default hook)",
                    "woocommerce_after_shop_loop_item" => "woocommerce_after_shop_loop_item (default hook)",
                    "woocommerce_before_shop_loop_item_title" => "woocommerce_before_shop_loop_item_title (default hook)",
                    "woocommerce_shop_loop_item_title" => "woocommerce_shop_loop_item_title (default hook)",
                    "woocommerce_after_shop_loop_item_title" => "woocommerce_after_shop_loop_item_title (default hook)",
                    "conversios_shop_loop_item" => "conversios_shop_loop_item (conversios hook)"
                ); ?>
                <select name="tvc_product_list_data_collection_method" id="tvc_product_list_data_collection_method" class="data_collection_method form-select selecttwo" style="width: 100%">
                    <?php if (!empty($list)) {
                        foreach ($list as $key => $val) {
                            $selected = ($tvc_product_list_data_collection_method == $key) ? "selected" : "";
                    ?>
                            <option value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_html($val); ?></option>
                    <?php
                        }
                    } ?>
                </select>
            </div>
        </div>
        <!-- Product list page  End-->

        <!-- Product details page  -->
        <div class="mt-2 d-flex align-items-center">
            <label for="inputPassword" class="col-sm-3 col-form-label text-dark">
                <small class="fw-bold-500"><?php esc_html_e("Product Detail Page", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?></small>
            </label>
            <div class="col-sm-9">
                <?php $tvc_product_detail_data_collection_method = isset($ee_options['tvc_product_detail_data_collection_method']) ? $ee_options['tvc_product_detail_data_collection_method'] : "woocommerce_after_single_product";
                $list = array(
                    "woocommerce_before_single_product" => "woocommerce_before_single_product (default hook)",
                    "woocommerce_after_single_product" => "woocommerce_after_single_product (default hook)",
                    "woocommerce_single_product_summary" => "woocommerce_single_product_summary (default hook)",
                    "conversios_single_product" => "conversios_single_product (conversios hook)",
                    "on_page" => "On page load"
                ); ?>
                <select name="tvc_product_detail_data_collection_method" id="tvc_product_detail_data_collection_method" class="data_collection_method selecttwo" style="width: 100%">
                    <?php if (!empty($list)) {
                        foreach ($list as $key => $val) {
                            $selected = ($tvc_product_detail_data_collection_method == $key) ? "selected" : "";
                    ?>
                            <option value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_html($val); ?></option>
                    <?php
                        }
                    } ?>
                </select>
            </div>
        </div>
        <!-- Product details page End-->


        <!-- Checkout Page  -->
        <div class="mt-2 d-flex align-items-center">
            <label for="inputPassword" class="col-sm-3 col-form-label text-dark">
                <small class="fw-bold-500"><?php esc_html_e("Checkout Page", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?></small>
            </label>
            <div class="col-sm-9">
                <?php
                $tvc_checkout_data_collection_method = isset($ee_options['tvc_checkout_data_collection_method']) ? $ee_options['tvc_checkout_data_collection_method'] : "woocommerce_before_checkout_form";
                $list = array(
                    "woocommerce_before_checkout_form" => "woocommerce_before_checkout_form (default hook)",
                    "woocommerce_after_checkout_form" => "woocommerce_after_checkout_form (default hook)",
                    "woocommerce_checkout_billing" => "woocommerce_checkout_billing (default hook)",
                    "woocommerce_checkout_shipping" => "woocommerce_checkout_shipping (default hook)",
                    "woocommerce_checkout_order_review" => "woocommerce_checkout_order_review (default hook)",
                    "conversios_checkout_form" => "conversios_checkout_form (conversios hook)",
                    "on_page" => "On page load"
                ); ?>
                <select name="tvc_checkout_data_collection_method" id="tvc_checkout_data_collection_method" class="data_collection_method selecttwo" style="width: 100%">
                    <?php if (!empty($list)) {
                        foreach ($list as $key => $val) {
                            $selected = ($tvc_checkout_data_collection_method == $key) ? "selected" : "";
                    ?>
                            <option value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_html($val); ?></option>
                    <?php
                        }
                    } ?>
                </select>
            </div>
        </div>
        <!-- Checkout Page End-->

        <!-- Order Confirmation Page  -->
        <div class="mt-2 d-flex align-items-center pb-4">
            <label for="inputPassword" class="col-sm-3 col-form-label text-dark">
                <small class="fw-bold-500"><?php esc_html_e("Order Confirmation page", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?></small>
            </label>
            <div class="col-sm-9">
                <?php
                $tvc_thankyou_data_collection_method = isset($ee_options['tvc_thankyou_data_collection_method']) ? $ee_options['tvc_thankyou_data_collection_method'] : "woocommerce_thankyou";
                $list = array(
                    "woocommerce_thankyou" => "woocommerce_thankyou (default hook)",
                    "woocommerce_before_thankyou" => "woocommerce_before_thankyou (default hook)",
                    "conversios_thankyou" => "conversios_thankyou (conversios hook)",
                    "on_page" => "On page load"
                ); ?>
                <select name="tvc_thankyou_data_collection_method" id="tvc_thankyou_data_collection_method" class="data_collection_method selecttwo" style="width: 100%">
                    <?php if (!empty($list)) {
                        foreach ($list as $key => $val) {
                            $selected = ($tvc_thankyou_data_collection_method == $key) ? "selected" : "";
                    ?>
                            <option value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_html($val); ?></option>
                    <?php
                        }
                    } ?>
                </select>
            </div>
        </div>
        <!-- Order Confirmation Page End-->


        <h5 class="fw-bold-500 mb-1 pt-4 border-top">
            <?php esc_html_e("Event Selector", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
        </h5>
        <span>
            <?php esc_html_e("If you change your front end class or id for below events, select/input the changed class or id.", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
        </span>

        <!-- Product page add to cart  -->
        <div class="mt-2 d-flex align-items-center">
            <label for="inputPassword" class="col-3 col-form-label text-dark">
                <small class="fw-bold-500"><?php esc_html_e("Product Page Add to Cart button", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?></small>
            </label>

            <div class="col-9 d-flex convsst_dynamic_box">
                <div class="col-3">
                    <?php
                    $tvc_product_detail_addtocart_selector = (isset($ee_options['tvc_product_detail_addtocart_selector']) && $ee_options['tvc_product_detail_addtocart_selector']) ? $ee_options['tvc_product_detail_addtocart_selector'] : "default";
                    $list = array(
                        "default" => "default",
                        "custom" => "custom"
                    );
                    ?>
                    <select name="tvc_product_detail_addtocart_selector" id="tvc_product_detail_addtocart_selector" class="selecttwo convsst_enable_inputs" style="width: 100%">
                        <?php if (!empty($list)) {
                            foreach ($list as $key => $val) {
                                $selected = ($tvc_product_detail_addtocart_selector == $key) ? "selected" : "";
                        ?>
                                <option value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_html($val); ?></option>
                        <?php
                            }
                        } ?>
                    </select>
                </div>

                <div class="col-3 px-2">
                    <?php $tvc_product_detail_addtocart_selector_type = (isset($ee_options['tvc_product_detail_addtocart_selector_type']) && $ee_options['tvc_product_detail_addtocart_selector_type']) ? $ee_options['tvc_product_detail_addtocart_selector_type'] : "";
                    $list = array(
                        "id" => "id",
                        "class" => "class"
                    ); ?>
                    <select name="tvc_product_detail_addtocart_selector_type" id="tvc_product_detail_addtocart_selector_type" class="selecttwo convsst_enable_inputs_item" style="width: 100%" <?php echo ($tvc_product_detail_addtocart_selector == "default") ? esc_attr($is_sel_disable) : ""; ?>>
                        <?php if (!empty($list)) {
                            foreach ($list as $key => $val) {
                                $selected = ($tvc_product_detail_addtocart_selector_type == $key) ? "selected" : "";
                                //$selected = ($tvc_product_detail_addtocart_selector == 'default' && $key == "class") ? "selected" : "";
                        ?>
                                <option value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_html($val); ?></option>
                        <?php
                            }
                        } ?>
                    </select>
                </div>

                <div class="col-6">
                    <?php
                    $tvc_product_detail_addtocart_selector_val = isset($ee_options['tvc_product_detail_addtocart_selector_val']) ? $ee_options['tvc_product_detail_addtocart_selector_val'] : "";
                    $tvc_product_detail_addtocart_selector_val = ($tvc_product_detail_addtocart_selector == 'default') ? "single_add_to_cart_button" : $tvc_product_detail_addtocart_selector_val;
                    ?>
                    <input type="text" class="form-control conv-text-grey convsst_enable_inputs_item" name="tvc_product_detail_addtocart_selector_val" id="tvc_product_detail_addtocart_selector_val" value="<?php echo esc_attr($tvc_product_detail_addtocart_selector_val); ?>" <?php echo ($tvc_product_detail_addtocart_selector == "default") ? esc_attr($is_sel_disable) : ""; ?>>
                </div>
            </div>
        </div>
        <!-- {Product Page Add to Cart End-->


        <!-- Checkout Page Step 2  -->
        <div class="mt-1 d-flex align-items-center">
            <label class="col-3 col-form-label text-dark">
                <small class="fw-bold-500"><?php esc_html_e("Checkout Step 2", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?></small>
            </label>

            <div class="col-9 d-flex convsst_dynamic_box">
                <div class="col-3">
                    <?php
                    $tvc_checkout_step_2_selector = (isset($ee_options['tvc_checkout_step_2_selector']) && $ee_options['tvc_checkout_step_2_selector']) ? $ee_options['tvc_checkout_step_2_selector'] : "default";
                    $list = array(
                        "default" => "default",
                        "custom" => "custom"
                    );
                    ?>
                    <select name="tvc_checkout_step_2_selector" id="tvc_checkout_step_2_selector" class="selecttwo convsst_enable_inputs" style="width: 100%">
                        <?php if (!empty($list)) {
                            foreach ($list as $key => $val) {
                                $selected = ($tvc_checkout_step_2_selector == $key) ? "selected" : "";
                        ?>
                                <option value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_html($val); ?></option>
                        <?php
                            }
                        } ?>
                    </select>
                </div>

                <div class="col-3 px-2">
                    <?php $tvc_checkout_step_2_selector_type = (isset($ee_options['tvc_checkout_step_2_selector_type']) && $ee_options['tvc_checkout_step_2_selector_type']) ? $ee_options['tvc_checkout_step_2_selector_type'] : "";
                    $list = array(
                        "id" => "id",
                        "class" => "class"
                    ); ?>
                    <div id="convsst_disable_text" class="<?php echo $tvc_checkout_step_2_selector == "default" ? "convsst_disable_text" : ""; ?>">
                        <select name="tvc_checkout_step_2_selector_type" id="tvc_checkout_step_2_selector_type" class="selecttwo convsst_enable_inputs_item" style="width: 100%" <?php echo ($tvc_checkout_step_2_selector == "default") ? esc_attr($is_sel_disable) : ""; ?>>
                            <?php if (!empty($list)) {
                                foreach ($list as $key => $val) {
                                    $selected = ($tvc_checkout_step_2_selector_type == $key) ? "selected" : "";
                                    //$selected = ($tvc_checkout_step_2_selector_type == 'default') ? "" : "";
                            ?>
                                    <option value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_html($val); ?></option>
                            <?php
                                }
                            } ?>
                        </select>
                    </div>
                </div>

                <div class="col-6">
                    <?php
                    $tvc_checkout_step_2_selector_val = isset($ee_options['tvc_checkout_step_2_selector_val']) ? $ee_options['tvc_checkout_step_2_selector_val'] : "";
                    $tvc_checkout_step_2_selector_val = ($tvc_checkout_step_2_selector == 'default') ? "input[name=billing_first_name]" : $tvc_checkout_step_2_selector_val;
                    ?>
                    <input type="text" class="form-control conv-text-grey convsst_enable_inputs_item" name="tvc_checkout_step_2_selector_val" id="tvc_checkout_step_2_selector_val" value="<?php echo esc_attr($tvc_checkout_step_2_selector_val); ?>" <?php echo ($tvc_checkout_step_2_selector == "default") ? esc_attr($is_sel_disable) : ""; ?>>
                </div>
            </div>
        </div>
        <!-- Checkout Page Step 2  End -->


        <!-- Checkout Page Step 3  -->
        <div class="mt-2 d-flex align-items-center">
            <label class="col-3 col-form-label text-dark">
                <small class="fw-bold-500"><?php esc_html_e("Checkout Step 3", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?></small>
            </label>

            <div class="col-9 d-flex convsst_dynamic_box">
                <div class="col-3">
                    <?php
                    $tvc_checkout_step_3_selector = (isset($ee_options['tvc_checkout_step_3_selector']) && $ee_options['tvc_checkout_step_3_selector']) ? $ee_options['tvc_checkout_step_3_selector'] : "default";
                    $list = array(
                        "default" => "default",
                        "custom" => "custom"
                    );
                    ?>
                    <select name="tvc_checkout_step_3_selector" id="tvc_checkout_step_3_selector" class="selecttwo convsst_enable_inputs" style="width: 100%">
                        <?php if (!empty($list)) {
                            foreach ($list as $key => $val) {
                                $selected = ($tvc_checkout_step_3_selector == $key) ? "selected" : "";
                        ?>
                                <option value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_html($val); ?></option>
                        <?php
                            }
                        } ?>
                    </select>
                </div>

                <div class="col-3 px-2">
                    <?php $tvc_checkout_step_3_selector_type = (isset($ee_options['tvc_checkout_step_3_selector_type']) && $ee_options['tvc_checkout_step_3_selector_type']) ? $ee_options['tvc_checkout_step_3_selector_type'] : "";
                    $list = array(
                        "id" => "id",
                        "class" => "class"
                    ); ?>

                    <select name="tvc_checkout_step_3_selector_type" id="tvc_checkout_step_3_selector_type" class="selecttwo convsst_enable_inputs_item" style="width: 100%" <?php echo ($tvc_checkout_step_3_selector == "default") ? esc_attr($is_sel_disable) : ""; ?>>
                        <?php if (!empty($list)) {
                            foreach ($list as $key => $val) {
                                $selected = ($tvc_checkout_step_3_selector_type == $key) ? "selected" : "";
                                //$selected = ($tvc_checkout_step_3_selector_type == 'default' && $key=="id") ? "selected" : "";
                        ?>
                                <option value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_html($val); ?></option>
                        <?php
                            }
                        } ?>
                    </select>

                </div>

                <div class="col-6">
                    <?php
                    $tvc_checkout_step_3_selector_val = isset($ee_options['tvc_checkout_step_3_selector_val']) ? $ee_options['tvc_checkout_step_3_selector_val'] : "";
                    $tvc_checkout_step_3_selector_val = ($tvc_checkout_step_3_selector == 'default') ? "place_order" : $tvc_checkout_step_3_selector_val;
                    ?>
                    <input type="text" class="form-control conv-text-grey convsst_enable_inputs_item" name="tvc_checkout_step_3_selector_val" id="tvc_checkout_step_3_selector_val" value="<?php echo esc_attr($tvc_checkout_step_3_selector_val); ?>" <?php echo ($tvc_checkout_step_3_selector == "default") ? esc_attr($is_sel_disable) : ""; ?>>
                </div>
            </div>
        </div>
        <!-- Checkout Page Step 3  End -->

    </form>
</div>

<!-- Success Save Modal -->
<div class="modal fade" id="convsst_savecustint_success_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">

            </div>
            <div class="modal-body text-center p-0">
                <img style="width:184px;" src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/convsst_modal_img_success.png'); ?>">
                <h3 class="fw-normal pt-3"><?php esc_html_e("Updated Successfully", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?></h3>
                <span id="convsst_save_success_txt" class="mb-1 lh-lg">
                    All changes you have made, have been saved <br> successfully.
                </span>
            </div>
            <div class="modal-footer border-0 pb-4 mb-1">
                <a href="<?php echo esc_url('admin.php?page=convsst-conversios-google-analytics'); ?>" class="btn conv-blue-bg m-auto text-white">Done</a>
            </div>
        </div>
    </div>
</div>
<!-- Success Save Modal End -->

<?php
wp_add_inline_script( 'convsst-admin',"
jQuery(function() {
    jQuery(document).on('change', '.convsst_enable_inputs', function(event) {
        if (jQuery(this).val() == 'custom') {
            jQuery(this).closest('.convsst_dynamic_box').find('.convsst_enable_inputs_item').prop('disabled', false);
        } else {
            jQuery(this).closest('.convsst_dynamic_box').find('.convsst_enable_inputs_item').prop('disabled', true);
        }
    });
    jQuery(document).on('change', 'form#advset_customintegration_form', function() {
        jQuery('.conv-btn-connect').removeClass('conv-btn-connect-disabled');
        jQuery('.conv-btn-connect').addClass('conv-btn-connect-enabled-custint');
        jQuery('.conv-btn-connect').text('Save');
    });
    jQuery(document).on('change', '#tvc_product_detail_addtocart_selector', function(event) {
        if (jQuery(this).val() == 'default') {
            jQuery('#tvc_product_detail_addtocart_selector_val').val('single_add_to_cart_button');
            jQuery('#tvc_product_detail_addtocart_selector_type').val('class').change();
        }
    });
    jQuery(document).on('change', '#tvc_checkout_step_2_selector', function(event) {
        if (jQuery(this).val() == 'default') {
            jQuery('#tvc_checkout_step_2_selector_val').val('input[name=billing_first_name]');
            jQuery('#tvc_checkout_step_2_selector_type').val('').change();
        } else {
            jQuery('#tvc_checkout_step_2_selector_val').val('');
            jQuery('#tvc_checkout_step_2_selector_type').val('class').change();
            jQuery('#convsst_disable_text').removeClass('convsst_disable_text');
        }
    });
    jQuery(document).on('change', '#tvc_checkout_step_3_selector', function(event) {
        if (jQuery(this).val() == 'default') {
            jQuery('#tvc_checkout_step_3_selector_val').val('place_order');
            jQuery('#tvc_checkout_step_3_selector_type').val('id').change();
        } else {
            jQuery('#tvc_checkout_step_3_selector_val').val('');
            jQuery('#convsst_disable_text').removeClass('convsst_disable_text');
        }
    });

    //Save data
    jQuery(document).on('click', '.conv-btn-connect-enabled-custint', function() {
        var valtoshow_inpopup = jQuery('#valtoshow_inpopup').val() + ' ' + jQuery('.valtoshow_inpopup_this').val();
        var selected_vals = {};
        jQuery('form#advset_customintegration_form select, input').each(function() {
            selected_vals[jQuery(this).attr('name')] = jQuery(this).val();
        });
        selected_vals['subscription_id'] = '". esc_js($tvc_data['subscription_id']) ."';
        selected_vals['convsst_show_badge'] = jQuery('input[name=convsst_show_badge]:checked').val();
        selected_vals['convsst_badge_position'] = jQuery('input[name=convsst_badge_position]:checked').val();

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
                jQuery('.conv-btn-connect-enabled-custint').text('Saving...');
                convsst_change_loadingbar('show');
                jQuery('.conv-btn-connect-enabled-custint').addClass('disabled');
            },
            success: function(response) {
                if (response == '0' || response == '1') {
                    jQuery('#convsst_savecustint_success_modal').modal('show');
                }

            }

        });

    });
});
");
?>