<div style="position:relative;">
    <div class="modal fade" id="upgradetopromodalotherReports" data-bs-keyboard="false" data-bs-backdrop="static"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="position:relative;border-radius:16px;">
                <div class="modal-body p-4 pb-0">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <img width="200" height="200"
                            src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/upgrade-pro-reporting.png'); ?>" />
                        <h2 class="text-fw-bold">Upgrade to Pro Now</h2>
                        <span class="text-secondary text-center">Unlock this premium report with our <span
                                class="fw-bold">Pro version!</span> Upgrade now for comprehensive insights and advanced
                            analytics.</span>
                    </div>
                </div>
                <div class="border-0 pb-4 mb-1 pt-4 d-flex flex-row justify-content-center align-items-center p-2">
                    <a id="upgradetopro_modal_link" class="btn bg-white text-black m-auto w-100 mx-2 ms-4 p-2"
                        href="admin.php?page=conversios-analytics-reports" style="border: 1px solid black;">
                        <?php esc_html_e("Back", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                    </a>
                    <a id="upgradetopro_modal_link" class="btn conv-yellow-bg m-auto w-100 mx-2 me-4 p-2"
                        href="https://www.conversios.io/pricing/?utm_source=free_sstpluginadmin&utm_medium=reports_gadsw&utm_campaign=free_sst_reports_gads&plugin_name=sst"
                        target="_blank">
                        <?php esc_html_e("Upgrade Now", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div id="imgcontainerconv" style=" margin-left: -1.5rem; margin-right: -1.5rem; ">
        <img src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/web-reports-gads.png'); ?>" class="w-100" />
    </div>
</div>
<script>
jQuery('.dshtpdaterange, .schedule_email').attr('style', 'display: none !important');
jQuery(function() {
    jQuery("#upgradetopromodalotherReports").modal('show');
    jQuery("body.modal-open").css("overflow", "auto !important");

});
jQuery(document).on('show.bs.modal', '#upgradetopromodalotherReports', function() {
    setTimeout(function() {
        jQuery("body.modal-open").addClass("overflow-auto");
    }, 1000);
});
</script>