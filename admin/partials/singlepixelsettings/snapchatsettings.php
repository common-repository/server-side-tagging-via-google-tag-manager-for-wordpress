<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$is_sel_disable = 'disabled';
?>
<div class="convcard p-4 mt-0 rounded-3 shadow-sm">
    <form id="pixelsetings_form" class="convpixsetting-inner-box">
        <div>
            <!-- Snapchat Pixel -->
            <?php $snapchat_convsst_ads_pixel_id = isset($ee_options['snapchat_convsst_ads_pixel_id']) ? $ee_options['snapchat_convsst_ads_pixel_id'] : ""; ?>
            <div id="snapchat_box" class="py-1">
                <div class="row pt-2">
                    <div class="col-7">
                        <label class="d-flex fw-normal mb-1 text-dark">
                            <?php esc_html_e("Snapchat Pixel ID", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                            <span class="material-symbols-outlined text-secondary md-18 ps-2" data-bs-toggle="tooltip" data-bs-placement="top" title="The Snapchat Ads pixel ID looks like. 12e1ec0a-90aa-4267-b1a0-182c455711e9">
                                info
                            </span>
                        </label>
                        <input type="text" name="snapchat_convsst_ads_pixel_id" id="snapchat_convsst_ads_pixel_id" class="form-control valtoshow_inpopup_this" value="<?php echo esc_attr($snapchat_convsst_ads_pixel_id); ?>" placeholder="e.g. 12e1ec0a-90aa-4267-b1a0-182c455711e9">
                    </div>
                </div>
            </div>
            <!-- Snapchat Pixel End-->


            <!-- Snapchat CAPI Pixel -->
            <?php
            $isbox_disabled = ""; //($plan_id == 42 || $plan_id == 41 || $plan_id == 1) ? "" : "boxdisabled disabled";
            $snapchat_access_token = (isset($ee_options["snapchat_access_token"]) && $ee_options["snapchat_access_token"] != "") ? $ee_options["snapchat_access_token"] : "";
            ?>
            <div id="tiktok_capi_box" class="py-1">
                <div class="row pt-2">
                    <div class="col-12">
                        <label class="d-flex fw-normal mb-1 text-dark">
                            <?php esc_html_e("SnapChat Conversion API Token", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                            <span class="conv-link-blue ms-2 fw-bold-500 upgradetopro_badge" popupopener="snapcapi_inner">
                                <img src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/upgrade_badge.png'); ?>" />
                                <?php esc_html_e("Available In Pro", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                            </span>
                        </label>
                        <div class="mt-0 mb-2">
                            <input type="text" placeholder="eg. CnTrpcbsSTWFU%-TmSuhuSCnTrpcbsSTWFU%-TmSuhuS" class="form-control disabled disabledsection">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Snapchat CAPI Pixel End-->
        </div>
    </form>
    <input type="hidden" id="valtoshow_inpopup" value="Snapchat Pixel ID:" />

</div>