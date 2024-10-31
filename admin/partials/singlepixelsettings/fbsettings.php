<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$is_sel_disable = 'disabled';
?>
<div class="convcard p-4 mt-0 rounded-3 shadow-sm">
    <form id="pixelsetings_form" class="convpixsetting-inner-box">
        <div>
            <!-- Facebook ID  -->
            <?php
            $fb_pixel_id = (isset($ee_options["fb_pixel_id"]) && $ee_options["fb_pixel_id"] != "") ? $ee_options["fb_pixel_id"] : "";
            ?>
            <div id="fbpixel_box" class="py-1">
                <div class="row pt-2">
                    <div class="col-7">
                        <label class="d-flex fw-normal mb-1 text-dark">
                            <?php esc_html_e("Meta (Facebook) Pixel ID", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                            <span class="material-symbols-outlined text-secondary md-18 ps-2" data-bs-toggle="tooltip" data-bs-placement="top" title="The Facebook pixel ID looks like. 518896233175751">
                                info
                            </span>
                        </label>
                        <input type="text" name="fb_pixel_id" id="fb_pixel_id" class="form-control valtoshow_inpopup_this" value="<?php echo esc_attr($fb_pixel_id); ?>" placeholder="e.g. 518896233175751">
                    </div>

                </div>
            </div>
            <!-- Facebook ID End-->


            <!-- Facebook ID  -->
            <?php
            $fb_conversion_api_token = (isset($ee_options["fb_conversion_api_token"]) && $ee_options["fb_conversion_api_token"] != "") ? $ee_options["fb_conversion_api_token"] : "";
            ?>
            <div id="fbapi_box" class="pt-4">
                <div class="row pt-2">
                    <div class="col-12">
                        <h5 class="d-flex fw-normal mb-1 text-dark">
                            <label class="d-flex fw-normal mb-1 text-dark">
                                <?php esc_html_e("Meta (Facebook)Conversion API Token", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                            </label>
                            <span class="align-middle conv-link-blue fw-bold-500 upgradetopro_badge" popupopener="fbcapi_inner">&nbsp;<img
                                    src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/upgrade_badge.png'); ?>">&nbsp;Available
                                In Pro</span>
                        </h5>
                        <input type="text" disabled class="form-control" placeholder="e.g. CnTrpcbsSTWFU%-TmSuhuSCnTrpcbsSTWFU%-TmSuhuS">
                    </div>

                </div>
            </div>
            <!-- Facebook ID End-->

        </div>
    </form>
    <input type="hidden" id="valtoshow_inpopup" value="Meta (Facebook) Pixel ID:" />

</div>
