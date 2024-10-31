<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$is_sel_disable = 'disabled';
?>
<div class="convcard p-4 mt-0 rounded-3 shadow-sm">
    <form id="pixelsetings_form" class="convpixsetting-inner-box">
        <div>
            <!-- Tiktok Pixel -->
            <?php $tiKtok_convsst_ads_pixel_id = isset($ee_options['tiKtok_convsst_ads_pixel_id']) ? $ee_options['tiKtok_convsst_ads_pixel_id'] : ""; ?>
            <div id="tiktok_box" class="py-1">
                <div class="row pt-2">
                    <div class="col-7">
                        <label class="d-flex fw-normal mb-1 text-dark">
                            <?php esc_html_e("TikTok Pixel ID", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                            <span class="material-symbols-outlined text-secondary md-18 ps-2" data-bs-toggle="tooltip" data-bs-placement="top" title="The TiKTok Ads pixel ID looks like. CBET743C77U5BM7P178N">
                                info
                            </span>
                        </label>
                        <input type="text" name="tiKtok_convsst_ads_pixel_id" id="tiKtok_convsst_ads_pixel_id" class="form-control valtoshow_inpopup_this" value="<?php echo esc_attr($tiKtok_convsst_ads_pixel_id); ?>" placeholder="eg.CBET743C77U5BM7P178N">
                    </div>
                </div>
            </div>
            <!-- Tiktok Pixel End-->

            <!-- Tiktok Pixel -->
            <?php
            $isbox_disabled = ""; //($plan_id == 42 ||  $plan_id == 41 || $plan_id == 1) ? "" : "boxdisabled disabled";
            $tiktok_access_token = (isset($ee_options["tiktok_access_token"]) && $ee_options["tiktok_access_token"] != "") ? $ee_options["tiktok_access_token"] : "";
            ?>
            <div id="tiktok_capi_box" class="py-1">
                <div class="row pt-2">
                    <div class="col-12">
                        <label class="d-flex fw-normal mb-1 text-dark">
                            <?php esc_html_e("Tiktok Events API Token", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                            <span class="conv-link-blue ms-2 fw-bold-500 upgradetopro_badge" popupopener="tiktokcapi_inner">
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
            <!-- Tiktok Pixel End-->

        </div>
    </form>
    <input type="hidden" id="valtoshow_inpopup" value="TikTok Pixel ID:" />

</div>