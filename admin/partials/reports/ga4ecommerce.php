<?php
$plan_id = !empty($this->plan_id) ? $this->plan_id : 1;

?>
<?php if ($plan_id == 11) { ?>
    <div style="position:relative;">
        <div class="modal fade" id="upgradetopromodalotherReports" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="position:relative;border-radius:16px;">
                    <div class="modal-body p-4 pb-0">
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <img width="200" height="200" src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/upgrade-pro-reporting.png'); ?>" />
                            <h2 class="text-fw-bold">Upgrade to Pro Now</h2>
                            <span class="text-secondary text-center">Unlock this premium report with our <span class="fw-bold">Pro version!</span> Upgrade now for comprehensive insights and advanced analytics.</span>
                        </div>
                    </div>
                    <div class="border-0 pb-4 mb-1 pt-4 d-flex flex-row justify-content-center align-items-center p-2">
                        <a id="upgradetopro_modal_link" class="btn bg-white text-black m-auto w-100 mx-2 ms-4 p-2" href="admin.php?page=conversios-analytics-reports" style="border: 1px solid black;">
                            <?php esc_html_e("Back", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                        </a>
                        <a id="upgradetopro_modal_link" class="btn conv-yellow-bg m-auto w-100 mx-2 me-4 p-2" href="https://www.conversios.io/wordpress/all-in-one-google-analytics-pixels-and-product-feed-manager-for-woocommerce-pricing/?utm_source=in_app&utm_medium=modal_popup&utm_campaign=upgrade" target="_blank">
                            <?php esc_html_e("Upgrade Now", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="imgcontainerconv">
            <img src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/web-reports-gecom.png'); ?>" class="w-100" />
        </div>
    </div>
<?php } else { ?>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-3 col-xl-3 col-xxl conv_rep_gridbox my-4 conv_rgrid_prodviews">
            <div class="bg-white conv_rgrid_in conv_bordershadow rounded py-2 px-3 placeholder-glow">
                <h5 class="conv-text-blue mb-0 text-truncate d-flex">
                    <?php esc_html_e("Product Views", "server-side-tagging-via-google-tag-manager-for-wordpress") ?>
                    <span class="material-symbols-outlined text-secondary md-18 ps-1 align-self-center" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="<?php esc_html_e("The number of times the item details were viewed. The metric counts the occurrence of the view_item event.", "server-side-tagging-via-google-tag-manager-for-wordpress") ?>">
                        info
                    </span>
                </h5>
                <div class="conv_rgrid_dydata">
                    <div class="conv_rgrid_data d-flex align-items-center py-2">
                        <div class="conv_rgrid_data_num">N/A</div>
                        <div class="conv_rgrid_data_icon">|</div>
                        <div class="conv_rgrid_data_per">N/A</div>
                    </div>
                    <div class="conv_rgrid_data_compari"></div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3 col-xl-3 col-xxl conv_rep_gridbox my-4 conv_rgrid_adc">
            <div class="bg-white conv_rgrid_in conv_bordershadow rounded py-2 px-3 placeholder-glow">
                <h5 class="conv-text-blue mb-0  text-truncate d-flex">
                    <?php esc_html_e("Add To Cart", "server-side-tagging-via-google-tag-manager-for-wordpress") ?>
                    <span class="material-symbols-outlined text-secondary md-18 ps-1 align-self-center" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="<?php esc_html_e("The number of times users added items to their shopping carts.", "server-side-tagging-via-google-tag-manager-for-wordpress") ?>">
                        info
                    </span>
                </h5>
                <div class="conv_rgrid_dydata">
                    <div class="conv_rgrid_data d-flex align-items-center py-2">
                        <div class="conv_rgrid_data_num">N/A</div>
                        <div class="conv_rgrid_data_icon">|</div>
                        <div class="conv_rgrid_data_per">N/A</div>
                    </div>
                    <div class="conv_rgrid_data_compari"></div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3 col-xl-3 col-xxl conv_rep_gridbox my-4 conv_rgrid_transaction">
            <div class="bg-white conv_rgrid_in conv_bordershadow rounded py-2 px-3 placeholder-glow">
                <h5 class="conv-text-blue mb-0 text-truncate d-flex">
                    <?php esc_html_e("Total Transactions", "server-side-tagging-via-google-tag-manager-for-wordpress") ?>
                    <span class="material-symbols-outlined text-secondary md-18 ps-1 align-self-center" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="<?php esc_html_e("The count of transaction events with purchase revenue. Transaction events are in_app_purchase, ecommerce_purchase, purchase, app_store_subscription_renew, app_store_subscription_convert, and refund.", "server-side-tagging-via-google-tag-manager-for-wordpress") ?>">
                        info
                    </span>
                </h5>
                <div class="conv_rgrid_dydata">
                    <div class="conv_rgrid_data d-flex align-items-center py-2">
                        <div class="conv_rgrid_data_num">N/A</div>
                        <div class="conv_rgrid_data_icon">|</div>
                        <div class="conv_rgrid_data_per">N/A</div>
                    </div>
                    <div class="conv_rgrid_data_compari"></div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3 col-xl-3 col-xxl conv_rep_gridbox my-4 conv_rgrid_avgorderval">
            <div class="bg-white conv_rgrid_in conv_bordershadow rounded py-2 px-3 placeholder-glow">
                <h5 class="conv-text-blue mb-0 text-truncate d-flex">
                    <?php esc_html_e("Avg. Order Value", "server-side-tagging-via-google-tag-manager-for-wordpress") ?>
                    <span class="material-symbols-outlined text-secondary md-18 ps-1 align-self-center" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="<?php esc_html_e("The average purchase revenue in the transaction group of events.", "server-side-tagging-via-google-tag-manager-for-wordpress") ?>">
                        info
                    </span>
                </h5>
                <div class="conv_rgrid_dydata">
                    <div class="conv_rgrid_data d-flex align-items-center py-2">
                        <div class="conv_rgrid_data_num">N/A</div>
                        <div class="conv_rgrid_data_icon">|</div>
                        <div class="conv_rgrid_data_per">N/A</div>
                    </div>
                    <div class="conv_rgrid_data_compari"></div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3 col-xl-3 col-xxl conv_rep_gridbox my-4 conv_rgrid_revenue">
            <div class="bg-white conv_rgrid_in conv_bordershadow rounded py-2 px-3 placeholder-glow">
                <h5 class="conv-text-blue mb-0 text-truncate d-flex">
                    <?php esc_html_e("Revenue", "server-side-tagging-via-google-tag-manager-for-wordpress") ?>
                    <span class="material-symbols-outlined text-secondary md-18 ps-1 align-self-center" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="<?php esc_html_e("The sum of revenue from purchases, subscriptions, and advertising (Purchase revenue plus Subscription revenue plus Ad revenue) minus refunded transaction revenue.", "server-side-tagging-via-google-tag-manager-for-wordpress") ?>">
                        info
                    </span>
                </h5>
                <div class="conv_rgrid_dydata">
                    <div class="conv_rgrid_data d-flex align-items-center py-2">
                        <div class="conv_rgrid_data_num">N/A</div>
                        <div class="conv_rgrid_data_icon">|</div>
                        <div class="conv_rgrid_data_per">N/A</div>
                    </div>
                    <div class="conv_rgrid_data_compari"></div>
                </div>
            </div>
        </div>
    </div>


    <!-- Table reports and AI -->
    <div class="row px-0">
        <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 conv_report_tabs">
            <h4 class="pt-3"><?php esc_html_e("All GA4 Performance Metrics", "server-side-tagging-via-google-tag-manager-for-wordpress") ?></h4>
            <div class="bg-white conv_bordershadow rounded">
                <ul class="nav nav-pills p-3 pb-0" id="conv_reporttab_pill" role="tablist">

                    <li class="nav-item pe-2" role="presentation">
                        <button class="nav-link conv_tabbut active rounded-pill px-2 py-1 lh-base d-flex justify-content-center" id="pills-convsomedr-tab" data-bs-toggle="pill" data-bs-target="#pills-convsomedr" type="button" role="tab" aria-controls="pills-convsomedr" aria-selected="false">
                            <?php esc_html_e("Source & Medium Performance", "server-side-tagging-via-google-tag-manager-for-wordpress") ?>
                            <span class="material-symbols-outlined md-18 ps-1 align-self-center" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="<?php esc_html_e("Google Analytics 4 provides a report tracking traffic source's performance metrics, enabling businesses to identify the most effective channels for directing users to their websites or apps, thereby optimizing marketing strategies.", "server-side-tagging-via-google-tag-manager-for-wordpress") ?>">
                                info
                            </span>
                        </button>
                    </li>

                    <li class="nav-item pe-2" role="presentation">
                        <button class="nav-link conv_tabbut rounded-pill px-2 py-1 lh-base d-flex justify-content-center" id="pills-convopr-tab" data-bs-toggle="pill" data-bs-target="#pills-convopr" type="button" role="tab" aria-controls="pills-convopr" aria-selected="true">
                            <?php esc_html_e("Order Performance", "server-side-tagging-via-google-tag-manager-for-wordpress") ?>
                            <span class="material-symbols-outlined md-18 ps-1 align-self-center" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="<?php esc_html_e("This report analyzes order and transaction performance on your website or app, providing data on order source, revenue, tax amount, and other key indicators. It helps identify trends and optimize sales funnels.", "server-side-tagging-via-google-tag-manager-for-wordpress") ?>">
                                info
                            </span>
                        </button>
                    </li>

                    <li class="nav-item pe-2" role="presentation">
                        <button class="nav-link conv_tabbut rounded-pill px-2 py-1 lh-base d-flex justify-content-center" id="pills-convprodperr-tab" data-bs-toggle="pill" data-bs-target="#pills-convprodperr" type="button" role="tab" aria-controls="pills-convprodperr" aria-selected="false">
                            <?php esc_html_e("Product Performance", "server-side-tagging-via-google-tag-manager-for-wordpress") ?>
                            <span class="material-symbols-outlined md-18 ps-1 align-self-center" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="<?php esc_html_e("The Product Performance Report in Google Analytics 4 offers valuable insights into product performance, including views, cart adds, revenue generated, and other metrics, enabling optimization for improved sales and user satisfaction.", "server-side-tagging-via-google-tag-manager-for-wordpress") ?>">
                                info
                            </span>
                        </button>
                    </li>

                </ul>
                <div class="tab-content" id="conv_reporttab_pillContent">

                    <!-- Source/Medium report table -->
                    <div class="tab-pane fade show active" id="pills-convsomedr" role="tabpanel" aria-labelledby="pills-convsomedr-tab">
                        <div class="table-responsive-fixed">
                            <table id="conv_sourcemedium_tbl" class="table-borderless w-100">
                                <thead class="border-bottom">
                                    <tr>
                                        <th class="text-start pt-1 text-truncate">Source/Medium</th>
                                        <th class="text-end p-1 text-truncate">Users</th>
                                        <th class="text-end p-1 text-truncate">Sessions</th>
                                        <th class="text-end p-1 text-truncate">Product views</th>
                                        <th class="text-end p-1 text-truncate">Added to carts</th>
                                        <th class="text-end p-1 text-truncate">Total transactions</th>
                                        <th class="text-end p-1 text-truncate">Avg Order value (<div class="conv_repo_curr d-inline"></div>)</th>
                                        <th class="text-end p-1 text-truncate d-flex justify-content-end">
                                            Revenue
                                            (<div class="conv_repo_curr d-inline"></div>)
                                            <div class="conv_rgrid_data_icon conv_rgrid_data_icon_black"><img src="<?php echo esc_url_raw(CONVSST_PLUGIN_URL . '/admin/images/green-up.png'); ?>" alt="" /></div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="placeholder-glow fixedh_tbody">
                                    <tr class="placeholder d-table-row border-bottom">
                                        <td colspan="8" class="p-3">1</td>
                                    </tr>
                                    <tr class="placeholder d-table-row border-bottom">
                                        <td colspan="8" class="p-3">1</td>
                                    </tr>
                                    <tr class="placeholder d-table-row border-bottom">
                                        <td colspan="8" class="p-3">1</td>
                                    </tr>
                                    <tr class="placeholder d-table-row border-bottom">
                                        <td colspan="8" class="p-3">1</td>
                                    </tr>
                                    <tr class="placeholder d-table-row border-bottom">
                                        <td colspan="8" class="p-3">1</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="p-3 fw-bold text-end">
                                <span>View Full Report (</span>
                                <a target="_blank" class="conv-link-blue" href="https://www.conversios.io/checkout/?pid=wpAIO_EY1&utm_source=sstfree_plugin&utm_medium=ereports&utm_campaign=viewfullreport">
                                    <img style="width:14px; max-width:100%; height:auto"
                                    src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/upgrade_badge.png'); ?>" />
                                    <span class="text"><?php esc_html_e("Available In Pro", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?></span>
                                </a>
                                <span>)</span>
                            </div>
                            
                        </div> 
                    </div>

                    <!-- Order Performance Order -->
                    <div class="tab-pane fade" id="pills-convopr" role="tabpanel" aria-labelledby="pills-convopr-tab">
                        <div class="table-responsive-fixed">

                            <table id="conv_orderperformance_tbl" class="table-borderless w-100">
                                <thead class="border-bottom">
                                    <tr>
                                        <th class="text-start p-3 pt-2 text-truncate d-flex justify-content-start">
                                            Transaction Id
                                            <div class="conv_rgrid_data_icon conv_rgrid_data_icon_black"><img src="<?php echo esc_url_raw(CONVSST_PLUGIN_URL . '/admin/images/green-up.png'); ?>" alt="" /></div>
                                        </th>
                                        <th class="text-end p-1 text-truncate">Source/Medium</th>
                                        <th class="text-end p-1 text-truncate">Tax Amount (<div class="conv_repo_curr d-inline"></div>)</th>
                                        <th class="text-end p-1 text-truncate">Refund Amount (<div class="conv_repo_curr d-inline"></div>)</th>
                                        <th class="text-end p-1 text-truncate">Shipping Amount (<div class="conv_repo_curr d-inline"></div>)</th>
                                        <th class="text-end p-1 text-truncate">Purchase Revenue(<div class="conv_repo_curr d-inline"></div>)</th>
                                    </tr>
                                </thead>
                                <tbody class="placeholder-glow fixedh_tbody">
                                    <tr class="placeholder d-table-row border-bottom">
                                        <td colspan="6" class="p-3">1</td>
                                    </tr>
                                    <tr class="placeholder d-table-row border-bottom">
                                        <td colspan="6" class="p-3">1</td>
                                    </tr>
                                    <tr class="placeholder d-table-row border-bottom">
                                        <td colspan="6" class="p-3">1</td>
                                    </tr>
                                    <tr class="placeholder d-table-row border-bottom">
                                        <td colspan="6" class="p-3">1</td>
                                    </tr>
                                    <tr class="placeholder d-table-row border-bottom">
                                        <td colspan="6" class="p-3">1</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="p-3 fw-bold text-end">
                                <span>View Full Report (</span>
                                <a target="_blank" class="conv-link-blue" href="https://www.conversios.io/checkout/?pid=wpAIO_EY1&utm_source=sstfree_plugin&utm_medium=ereports&utm_campaign=viewfullreport">
                                    <img style="width:14px; max-width:100%; height:auto"
                                    src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/upgrade_badge.png'); ?>" />
                                    <span class="text"><?php esc_html_e("Available In Pro", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?></span>
                                </a>
                                <span>)</span>
                            </div>
                        </div>
                    </div>


                    <!-- Product Performace Report -->
                    <div class="tab-pane fade" id="pills-convprodperr" role="tabpanel" aria-labelledby="pills-convprodperr-tab">
                        <div class="table-responsive-fixed">
                            <table id="conv_productper_tbl" class="table-borderless w-100">
                                <thead class="border-bottom">
                                    <tr>
                                        <th class="text-start pt-1 text-truncate">Product Name</th>
                                        <th class="text-end p-1 text-truncate">Views</th>
                                        <th class="text-end p-1 text-truncate">Added to Cart</th>
                                        <th class="text-end p-1 text-truncate">Qty</th>
                                        <th class="text-end p-1 text-truncate">Checkouts</th>
                                        <th class="text-end p-1 text-truncate">Cart to details (%) </th>
                                        <th class="text-end p-1 text-truncate">Buy to details (%)</th>
                                        <th class="text-end p-1 text-truncate d-flex justify-content-end">
                                            Revenue
                                            (<div class="conv_repo_curr d-inline"></div>)
                                            <div class="conv_rgrid_data_icon conv_rgrid_data_icon_black"><img src="<?php echo esc_url_raw(CONVSST_PLUGIN_URL . '/admin/images/green-up.png'); ?>" alt="" /></div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="placeholder-glow fixedh_tbody">
                                    <tr class="placeholder d-table-row border-bottom">
                                        <td colspan="8" class="p-3">1</td>
                                    </tr>
                                    <tr class="placeholder d-table-row border-bottom">
                                        <td colspan="8" class="p-3">1</td>
                                    </tr>
                                    <tr class="placeholder d-table-row border-bottom">
                                        <td colspan="8" class="p-3">1</td>
                                    </tr>
                                    <tr class="placeholder d-table-row border-bottom">
                                        <td colspan="8" class="p-3">1</td>
                                    </tr>
                                    <tr class="placeholder d-table-row border-bottom">
                                        <td colspan="8" class="p-3">1</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="p-3 fw-bold text-end">
                                <span>View Full Report (</span>
                                <a target="_blank" class="conv-link-blue" href="https://www.conversios.io/checkout/?pid=wpAIO_EY1&utm_source=sstfree_plugin&utm_medium=ereports&utm_campaign=viewfullreport">
                                    <img style="width:14px; max-width:100%; height:auto"
                                    src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/logos/upgrade_badge.png'); ?>" />
                                    <span class="text"><?php esc_html_e("Available In Pro", "server-side-tagging-via-google-tag-manager-for-wordpress"); ?></span>
                                </a>
                                <span>)</span>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- End Table reports and AI -->

    <!-- Funnel reports -->
    <div class="row pt-3 px-0">

        <!-- Conversion Funnel -->
        <div class="col-xs-6 col-sm-6 col-md-6 col-xl-6 col-xxl-6 conv_report_tabs">
            <h4 class="pt-3 d-flex">
                <?php esc_html_e("Conversion Funnel (# Of Events)", "server-side-tagging-via-google-tag-manager-for-wordpress") ?>
                <span class="material-symbols-outlined text-secondary md-18 ps-1 align-self-center" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="<?php esc_html_e(" A conversion funnel, also known as a sales or marketing funnel, is a visual representation of the steps that users take to complete a purchase on your website or app. It consists of multiple stages, starting from sessions, product views, add to carts , checkouts and ending with the desired order confirmation / purchase action. By analyzing the conversion funnel in Google Analytics 4, you can identify potential bottlenecks or drop-off points in the user journey and implement strategies to optimize each stage for improved conversion rates. Also, the numbers at various stages in this funnel are in terms of Number of Events triggered at various stages.", "server-side-tagging-via-google-tag-manager-for-wordpress") ?>">
                    info
                </span>
            </h4>
            <div class="bg-white conv_bordershadow rounded p-4">
                <canvas id="conv_conversionfunnel_chart" class="p-4" height="300"></canvas>
            </div>
        </div>
        <!-- End Conversion Funnel -->

        <!-- Checkout Funnel -->
        <div class="col-xs-6 col-sm-6 col-md-6 col-xl-6 col-xxl-6 conv_report_tabs">
            <h4 class="pt-3 d-flex">
                <?php esc_html_e("Checkout Funnel (#Active Users)", "server-side-tagging-via-google-tag-manager-for-wordpress") ?>
                <span class="material-symbols-outlined text-secondary md-18 ps-1 align-self-center" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="<?php esc_html_e("The checkout funnel is a specific type of conversion funnel that focuses on the steps involved in the checkout process for e-commerce websites or apps. It tracks the progression of users from viewing the cart to completing the purchase, including steps such as initiating checkout, entering shipping and billing information, selecting payment method, and confirming the order. By analyzing the checkout funnel in Google Analytics 4, you can identify any obstacles or friction points that may be causing users to abandon their carts and take steps to streamline the checkout process for a smoother user experience and higher conversion rates. Also, the numbers at various stages in this funnel are in terms of Number of Users that performed the events at various stages.", "server-side-tagging-via-google-tag-manager-for-wordpress") ?>">
                    info
                </span>
            </h4>
            <div class="bg-white conv_bordershadow rounded p-4">
                <canvas id="conv_checkoutfunnel_chart" class="p-4" height="300"></canvas>
            </div>
        </div>
        <!-- End Checkout Funnel -->

    </div>
    <!-- End Funnel reports -->
<?php } ?>



<?php if (!$ga4_measurement_id == "" && $plan_id != 11 && $plan_id != 1) { ?>

    <script src="https://cdn.jsdelivr.net/npm/chartjs-chart-funnel"></script>


    <script>
        var start = moment().subtract(7, 'days');
        var end = moment().subtract(1, 'days');

        jQuery('#conv_reporttab_pill').on('show.bs.tab', function() {
            let tabid = event.target.id;

            jQuery("#conv_reporttab_pillContent .conv_ai_tab").addClass('d-none');

            if (tabid == "pills-convprodperr-tab") {
                jQuery("#pills-convprodperr-ai").removeClass("d-none");
                jQuery("#conv_aibox_subheading").html("Product Performance");

                if (jQuery("#pills-convprodperr-ai-check").val() == "0") {
                    //conv_generate_ai_insight("ProductConv15");
                    jQuery("#pills-convprodperr-ai-check").val("1");
                }
            }

            if (tabid == "pills-convopr-tab") {
                jQuery("#pills-convopr-ai").removeClass("d-none");
                jQuery("#conv_aibox_subheading").html("Order Performance");

                if (jQuery("#pills-convopr-ai-check").val() == 0) {
                    //conv_generate_ai_insight("OrderPerformanceAnalysis");
                    jQuery("#pills-convopr-ai-check").val("1");
                }
            }

            if (tabid == "pills-convsomedr-tab") {
                jQuery("#pills-convsomedr-ai").removeClass("d-none");
                jQuery("#conv_aibox_subheading").html("Source & Medium Performance");
            }
        });

        function conv_GetCurrencySymbol(locale, currency) {
            return (0).toLocaleString(
                locale, {
                    style: 'currency',
                    currency: currency,
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }
            ).replace(/\d/g, '').trim()
        }

        function conv_changeplaceholder(status = "hide") {
            if (status == "hide") {
                jQuery(".conv_rgrid_dydata").removeClass("placeholder bg-light");
            }
            if (status == "show") {
                jQuery(".conv_rgrid_dydata").addClass("placeholder bg-light");
            }
        }

        function conv_format_revenue(conv_val) {
            return parseFloat(conv_val).toFixed(2);
        }

        function conv_format_revenue_percent(conv_val) {
            return parseFloat(conv_val * 100).toFixed(2);
        }

        function conv_report_percentage(partialValue, totalValue) {
            if (partialValue != 0 && totalValue != 0) {
                var reportperc = (100 * parseInt(partialValue)) / parseInt(totalValue);
                reportperc = "(" + reportperc.toFixed(2) + "%" + ")";
                return reportperc;
            } else {
                return "(0%)";
            }
        }


        // Funnel Chart function
        function conv_create_funnel_chart(canvasname, funneldata) {
            var data = funneldata;
            var options = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        onClick: function(e) {
                            return false;
                        },
                        display: true,
                        position: 'right',
                        align: 'end',
                        fullSize: false,
                        labels: {
                            usePointStyle: true, // Use point style for legend icons
                            generateLabels: function(chart) {
                                var data = chart.data;
                                if (data.labels.length && data.datasets.length) {
                                    return data.labels.map(function(label, i) {
                                        var backgroundColor = data.datasets[0].backgroundColor[i];
                                        var comparedpercent = data.datasets[0].comparedpercent[i];
                                        var value = data.datasets[0].data[i];
                                        // Build legend item
                                        return {
                                            text: label + ' - ' + data.datasets[0].data[i] + " " + comparedpercent, // Label with dataset value
                                            fillStyle: backgroundColor,
                                            hidden: isNaN(data.datasets[0].data[i]), // Hide if value is NaN
                                            index: i,
                                            datasetIndex: i,
                                            value: value,
                                        }
                                    });
                                }
                                return [];
                            },
                            font: {
                                size: 14
                            },
                            padding: 20,
                            color: "#000",
                        }
                    },
                    funnel: {
                        aspectRatio: 1,
                        minHeight: 300
                    }
                },
                indexAxis: 'y'
            };

            var ctx = document.getElementById(canvasname).getContext('2d');
            let chartStatus = Chart.getChart(canvasname); // <canvas> id
            if (chartStatus != undefined) {
                chartStatus.destroy();
            }
            var verticalFunnelChart = new Chart(ctx, {
                type: 'funnel',
                data: data,
                options: options,
            });
        }
        // End Funnel Chart function

        function conv_setupdownarrow(gvalue, classname) {
            gvalue = String(gvalue);
            if (gvalue !== 0 && gvalue !== undefined && gvalue !== null && gvalue !== "0") {
                if (gvalue.startsWith("-")) {
                    jQuery("." + classname + " .conv_rgrid_data_icon").html('<img src="<?php echo esc_url_raw(CONVSST_PLUGIN_URL . '/admin/images/red-down.png'); ?>" alt="" />');
                } else {
                    jQuery("." + classname + " .conv_rgrid_data_icon").html('<img src="<?php echo esc_url_raw(CONVSST_PLUGIN_URL . '/admin/images/green-up.png'); ?>" alt="" />');
                }
            } else {
                jQuery("." + classname + " .conv_rgrid_data_icon").html('|');
            }

        }

        function save_currency_local(ga_currency) {
            var selected_vals = {};
            selected_vals['ecom_reports_ga_currency'] = ga_currency;
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
                    console.log('currency saved', response);
                }
            });
        }

        function get_google_analytics_reports(post_data) {
            conv_changeplaceholder("show");
            jQuery.ajax({
                type: "POST",
                dataType: "json",
                url: tvc_ajax_url,
                data: post_data,
                success: function(response) {
                    if (response?.error == false) {
                        data = JSON.parse(response.data);
                        //console.log("data---", data);
                        griddata = data.dashboard_data_point;
                        jQuery(".conv_rgrid_newuser .conv_rgrid_data_num").html(griddata.newUsers);
                        jQuery(".conv_rgrid_newuser .conv_rgrid_data_per").html(griddata.compare_newUsers + "%");
                        conv_setupdownarrow(griddata.compare_newUsers, 'conv_rgrid_newuser');

                        jQuery(".conv_rgrid_transaction .conv_rgrid_data_num").html(griddata.transactions);
                        jQuery(".conv_rgrid_transaction .conv_rgrid_data_per").html(griddata.compare_transactions + "%");
                        conv_setupdownarrow(griddata.compare_transactions, 'conv_rgrid_transaction');


                        let convcurrenycodesy = conv_GetCurrencySymbol("en-US", data.currencyCode);
                        jQuery("#ecom_reports_ga_currency").val(data.currencyCode);

                        var ga_currency_db = "<?php echo esc_attr($ecom_reports_ga_currency); ?>";
                        if (data.currencyCode != ga_currency_db) {
                            save_currency_local(data.currencyCode);
                        }

                        jQuery(".conv_repo_curr").html(convcurrenycodesy);
                        jQuery(".conv_rgrid_revenue .conv_rgrid_data_num").html(convcurrenycodesy + conv_format_revenue(griddata.totalRevenue));
                        jQuery(".conv_rgrid_revenue .conv_rgrid_data_per").html(griddata.compare_totalRevenue + "%");
                        conv_setupdownarrow(griddata.compare_totalRevenue, 'conv_rgrid_revenue');


                        jQuery(".conv_rgrid_avgorderval .conv_rgrid_data_num").html(convcurrenycodesy + conv_format_revenue(griddata.averagePurchaseRevenue));
                        jQuery(".conv_rgrid_avgorderval .conv_rgrid_data_per").html(griddata.compare_averagePurchaseRevenue + "%");
                        conv_setupdownarrow(griddata.compare_averagePurchaseRevenue, 'conv_rgrid_avgorderval');

                        jQuery(".conv_rgrid_prodviews .conv_rgrid_data_num").html(griddata.itemViews);
                        jQuery(".conv_rgrid_prodviews .conv_rgrid_data_per").html(griddata.compare_itemViews + "%");
                        conv_setupdownarrow(griddata.compare_itemViews, 'conv_rgrid_prodviews');


                        jQuery(".conv_rgrid_adc .conv_rgrid_data_num").html(griddata.addToCarts);
                        jQuery(".conv_rgrid_adc .conv_rgrid_data_per").html(griddata.compare_addToCarts + "%");
                        conv_setupdownarrow(griddata.compare_addToCarts, 'conv_rgrid_adc');


                        jQuery(".conv_rgrid_sessions .conv_rgrid_data_num").html(griddata.sessions);
                        jQuery(".conv_rgrid_sessions .conv_rgrid_data_per").html(griddata.compare_sessions + "%");
                        conv_setupdownarrow(griddata.compare_sessions, 'conv_rgrid_sessions');

                        jQuery(".conv_rgrid_ttlusers .conv_rgrid_data_num").html(griddata.totalUsers);
                        jQuery(".conv_rgrid_ttlusers .conv_rgrid_data_per").html(griddata.compare_totalUsers + "%");
                        conv_setupdownarrow(griddata.compare_totalUsers, 'conv_rgrid_ttlusers');

                        conv_set_gridboxwidth();

                        conv_changeplaceholder("hide");

                        // For Source/Medium Report Table
                        let tableBody = jQuery('#conv_sourcemedium_tbl tbody');
                        tableBody.empty();
                        if (data.medium_performance_report != null && data.medium_performance_report != undefined) {
                            let smr_data = data.medium_performance_report.mediums;
                            jQuery.each(smr_data, function(index, transaction) {
                                if (index <= 4) {
                                    let row = "<tr class='border-bottom text-secondary'><td class='p-1' title='" + transaction.medium + "'>" + transaction.medium + "</td><td class='text-end p-1'>" + transaction.totalUsers + "</td><td class='text-end p-1'>" + transaction.sessions + "</td><td class='text-end p-1'>" + transaction.itemViewEvents + "</td><td class='text-end p-1'>" + transaction.addToCarts + "</td><td class='text-end p-1'>" + transaction.transactions + "</td><td class='text-end p-1'>" + conv_format_revenue(transaction.averagePurchaseRevenue) + "</td><td class='text-end p-1'>" + conv_format_revenue(transaction.totalRevenue) + "</td></tr>";
                                    tableBody.append(row);
                                }
                            });
                        } else {
                            //console.log("Data not found for Source/Medium report");
                            let noimgsrc = "<?php echo esc_url_raw(CONVSST_PLUGIN_URL . '/admin/images/no-results.png'); ?>";
                            let row = "<div class='noresultimg'><img src='" + noimgsrc + "' /></div>";
                            jQuery("#conv_sourcemedium_tbl").after(row);
                        }


                        // For Product Performance Report Table
                        let tableBodyProdPer = jQuery('#conv_productper_tbl tbody');
                        tableBodyProdPer.empty();
                        if (data.product_performance_report != null && data.product_performance_report != undefined) {
                            let prodper_data = data.product_performance_report.products;
                            jQuery.each(prodper_data, function(index, transaction) {
                                if (index <= 4) {
                                    let row = "<tr class='border-bottom text-secondary'><td class='p-1' title='" + transaction.itemName + "'>" + transaction.itemName + "</td><td class='text-end p-1'>" + transaction.itemsViewed + "</td><td class='text-end p-1'>" + transaction.itemsAddedToCart + "</td><td class='text-end p-1'>" + transaction.itemsPurchased + "</td><td class='text-end p-1'>" + transaction.itemsAddedToCart + "</td><td class='text-end p-1'>" + conv_format_revenue_percent(transaction.cartToViewRate) + "</td><td class='text-end p-1'>" + conv_format_revenue_percent(transaction.purchaseToViewRate) + "</td><td class='text-end p-1'>" + conv_format_revenue(transaction.itemRevenue) + "</td></tr>";
                                    tableBodyProdPer.append(row);
                                }
                            });
                        } else {
                            //console.log("Data not found for Product Performance report");
                            let noimgsrc = "<?php echo esc_url_raw(CONVSST_PLUGIN_URL . '/admin/images/no-results.png'); ?>";
                            let row = "<div class='noresultimg'><img src='" + noimgsrc + "' /></div>";
                            jQuery('#conv_productper_tbl').after(row);
                        }


                        // Create funnal chart
                        var total_users_data = griddata?.totalUsers;
                        var item_views_data = griddata?.itemViews;
                        var add_cart_data = griddata?.addToCarts;
                        var checkout_data = griddata?.checkouts;
                        var transactions_data = griddata?.transactions;

                        if (total_users_data == undefined) {
                            total_users_data = 0;
                        }
                        if (item_views_data == undefined) {
                            item_views_data = 0;
                        }
                        if (add_cart_data == undefined) {
                            add_cart_data = 0;
                        }
                        if (checkout_data == undefined) {
                            checkout_data = 0;
                        }
                        if (transactions_data == undefined) {
                            transactions_data = 0;
                        }

                        //if (griddata.totalUsers != "0" && griddata.itemViews != "0" && griddata.addToCarts != "0" && griddata.checkouts != "0" && griddata.transactions != "0") {
                        var conversion_funnel_data = {
                            labels: ["Total Sessions", "Product Views", "Add To Cart", "Checkouts", "Order Conf"],
                            datasets: [{
                                data: [
                                    total_users_data,
                                    item_views_data,
                                    add_cart_data,
                                    checkout_data,
                                    transactions_data
                                ],
                                backgroundColor: ["#0E42D2", "#165DFF", "#4080FF", "#6AA1FF", "#94BFFF"],
                                comparedpercent: [
                                    conv_report_percentage(total_users_data, total_users_data),
                                    conv_report_percentage(item_views_data, total_users_data),
                                    conv_report_percentage(add_cart_data, total_users_data),
                                    conv_report_percentage(checkout_data, total_users_data),
                                    conv_report_percentage(transactions_data, total_users_data),
                                ],
                                shrinkAnchor: 'bottom',
                            }]
                        };
                        conv_create_funnel_chart('conv_conversionfunnel_chart', conversion_funnel_data);
                        // } else {
                        //     let noimgsrc = " echo esc_url_raw(CONVSST_PLUGIN_URL . '/admin/images/no-results.png'); ";
                        //     let row = "<div class='noresultimg'><img src='" + noimgsrc + "' /></div>";
                        //     jQuery("#conv_conversionfunnel_chart").addClass("d-none");
                        //     jQuery("#conv_conversionfunnel_chart").after(row);
                        // }

                    } else {
                        console.log("Error in data fetching");
                    }
                },
            });
        }

        // Checkout Funnel
        function conv_checkout_funnel_report(post_data) {
            jQuery.ajax({
                type: "POST",
                dataType: "json",
                url: tvc_ajax_url,
                data: post_data,
                success: function(response) {
                    if (response.error == false && Object.keys(response.data).length > 0) {
                        var data = response.data;
                        var view_cart_users = data?.view_cart?.activeUsers;
                        var begin_checkout_users = data?.begin_checkout?.activeUsers;
                        var shipping_users = data?.add_shipping_info?.activeUsers;
                        var payment_users = data?.add_payment_info?.activeUsers;
                        var purchase_users = data?.purchase?.activeUsers;

                        if (view_cart_users == undefined) {
                            view_cart_users = 0;
                        }
                        if (begin_checkout_users == undefined) {
                            begin_checkout_users = 0;
                        }
                        if (shipping_users == undefined) {
                            shipping_users = 0;
                        }
                        if (payment_users == undefined) {
                            payment_users = 0;
                        }
                        if (purchase_users == undefined) {
                            purchase_users = 0;
                        }

                        // if (view_cart_users != "0" && data.begin_checkout.activeUsers != "0" && data.add_shipping_info.activeUsers != "0" && data.add_payment_info.activeUsers != "0" && data.purchase.activeUsers != "0") {
                        var checkout_funnel_data = {
                            labels: ["View Cart", "Begin Checkout", "Add Shipping Info", "Add payment Info", "Purchases"],
                            datasets: [{
                                data: [
                                    view_cart_users,
                                    begin_checkout_users,
                                    shipping_users,
                                    payment_users,
                                    purchase_users
                                ],
                                backgroundColor: ["#0E42D2", "#165DFF", "#4080FF", "#6AA1FF", "#94BFFF"],
                                comparedpercent: [
                                    conv_report_percentage(view_cart_users, view_cart_users),
                                    conv_report_percentage(begin_checkout_users, view_cart_users),
                                    conv_report_percentage(shipping_users, view_cart_users),
                                    conv_report_percentage(payment_users, view_cart_users),
                                    conv_report_percentage(purchase_users, view_cart_users),
                                ],
                                shrinkAnchor: 'bottom',
                            }]
                        };
                        conv_create_funnel_chart('conv_checkoutfunnel_chart', checkout_funnel_data);
                        // } else {
                        //     let noimgsrc = " echo esc_url_raw(CONVSST_PLUGIN_URL . '/admin/images/no-results.png'); ";
                        //     let row = "<div class='noresultimg'><img src='" + noimgsrc + "' /></div>";
                        //     jQuery("#conv_checkoutfunnel_chart").addClass("d-none");
                        //     jQuery("#conv_checkoutfunnel_chart").after(row);
                        // }

                    } else {
                        let noimgsrc = "<?php echo esc_url_raw(CONVSST_PLUGIN_URL . '/admin/images/no-results.png'); ?>";
                        let row = "<div class='noresultimg'><img src='" + noimgsrc + "' /></div>";
                        jQuery("#conv_checkoutfunnel_chart").addClass("d-none");
                        jQuery("#conv_checkoutfunnel_chart").after(row);
                    }
                }
            });

        }
        // End Checkout Funnel

        // Get Order Performace Report
        function conv_get_order_performance_report(post_data) {
            post_data['domain'] = '<?php echo get_site_url(); ?>';
            jQuery.ajax({
                type: "POST",
                dataType: "json",
                url: tvc_ajax_url,
                data: post_data,
                success: function(response) {
                    let opr_data = response.data;
                    var tableBody = jQuery('#conv_orderperformance_tbl tbody');
                    tableBody.empty();
                    if (opr_data.length != 0) {
                        jQuery.each(opr_data, function(index, transaction) {
                            if (index <= 4) {
                                var row = "<tr class='border-bottom text-secondary'><td class='text-start p-1'>" + transaction.transactionId + "</td><td class='text-end p-1' title='" + transaction.sessionSourceMedium + "'>" + transaction.sessionSourceMedium + "</td><td class='text-end p-1'>" + transaction.taxAmount + "</td><td class='text-end p-1'>" + transaction.refundAmount + "</td><td class='text-end p-1'>" + transaction.shippingAmount + "</td><td class='text-end p-1'>" + transaction.purchaseRevenue + "</td></tr>";
                                tableBody.append(row);
                            }
                        });
                    } else {
                        let noimgsrc = "<?php echo esc_url_raw(CONVSST_PLUGIN_URL . '/admin/images/no-results.png'); ?>";
                        let row = "<div class='noresultimg'><img src='" + noimgsrc + "' /></div>";
                        jQuery('#conv_orderperformance_tbl').after(row);
                    }

                }
            });
        }
        // End Order Performance Report

        // Compare Dates
        function conv_compareDates(date1, date2) {
            const jsDate1 = new Date(
                date1.split("-")[2],
                date1.split("-")[1] - 1,
                date1.split("-")[0]
            );
            const jsDate2 = new Date(
                date2.split("-")[2],
                date2.split("-")[1] - 1,
                date2.split("-")[0]
            );
            if (jsDate1 > jsDate2) {
                return 1;
            } else if (jsDate1 < jsDate2) {
                return -1;
            } else {
                return 0;
            }
        }
        // End Compare Dates

        // Save all AI report
        function conv_save_all_ai_report(post_data) {
            post_data["action"] = "save_all_reports";
            post_data["domain"] = "<?php echo get_site_url(); ?>";
            jQuery.ajax({
                type: "POST",
                dataType: "json",
                url: tvc_ajax_url,
                data: post_data,
                success: function(response) {
                    if (response.error == false) {
                        var selected_vals = {};
                        selected_vals['last_fetched_prompt_date'] = moment().format("DD-MM-YYYY");
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
                            success: function(response) {}
                        });
                    } else {
                        //console.log("report saveing unsuccessfull.");
                    }
                },
            });
        }
        // End Save all AI Report

        // Generate AI Report
        /*function conv_generate_ai_insight(conv_prompt_key) {
            var data = {
                "action": "generate_ai_response",
                "subscription_id": '<?php echo esc_attr($ee_options['subscription_id']); ?>',
                "key": conv_prompt_key,
                "domain": '<?php echo esc_attr(get_site_url()); ?>',
                "conversios_nonce": '<?php echo wp_create_nonce('conversios_nonce'); ?>'
            };
            //ai_flag is setv
            jQuery.ajax({
                type: "POST",
                dataType: "json",
                url: tvc_ajax_url,
                data: data,
                success: function(response) {
                    if (response?.error == false && response?.data != "") {
                        let newData = response?.data;
                        if (conv_prompt_key == "SourceSales25") {
                            jQuery("#pills-convsomedr-ai ul").html("<li>" + newData);
                        }

                        if (conv_prompt_key == "ProductConv15") {
                            jQuery("#pills-convprodperr-ai ul").html("<li>" + newData);
                        }

                        if (conv_prompt_key == "OrderPerformanceAnalysis") {
                            jQuery("#pills-convopr-ai ul").html("<li>" + newData);
                        }
                    }
                }
            });
        }*/
        // End Generate AI Report

        function conv_set_gridboxwidth() {
            var gridboxwidth = jQuery("#conv_gridrepbox_row").outerWidth();
            if (gridboxwidth <= 1500) {
                jQuery('.conv_rep_gridbox').each(function() {
                    var colWidth = jQuery(this).outerWidth();
                    if (colWidth > 175) {
                        jQuery(".conv_rep_gridbox").addClass("col-xxl-3");
                    }
                });
            } else {
                jQuery(".conv_rep_gridbox").removeClass("col-xxl-3");
            }

        }

        function cb(start, end) {
            var start_date = start.format('DD/MM/YYYY') || 0,
                end_date = end.format('DD/MM/YYYY') || 0;
            var datdiff = end.diff(start, 'days') + 1;
            jQuery(".conv_rgrid_data_compari").html("From last " + datdiff + " days");
            jQuery('span.daterangearea').html(start_date + ' - ' + end_date);
            var data = {
                action: 'get_google_analytics_reports',
                subscription_id: '<?php echo esc_attr($ee_options["subscription_id"]); ?>',
                start_date: jQuery.trim(start_date.replace(/\//g, "-")),
                end_date: jQuery.trim(end_date.replace(/\//g, "-")),
                conversios_nonce: '<?php echo wp_create_nonce('conversios_nonce'); ?>',
            };
            jQuery(".noresultimg").remove();
            jQuery("#conv_checkoutfunnel_chart").removeClass("d-none");
            jQuery("#conv_conversionfunnel_chart").removeClass("d-none");

            get_google_analytics_reports(data);

            data["action"] = "get_google_analytics_order_performance";
            conv_get_order_performance_report(data);

            //Check AI report last sync
            var last_report_date = '<?php echo $last_fetched_prompt_date; ?>';
            let currDate = moment().format("DD-MM-YYYY");
            if (last_report_date == "") {
                conv_save_all_ai_report(data);
            } else {
                const dateRes = conv_compareDates(currDate, last_report_date);
                if (dateRes === 1) {
                    conv_save_all_ai_report(data);
                }
            }
            data["action"] = "get_ecomm_checkout_funnel";
            conv_checkout_funnel_report(data);
        }

        /*jQuery('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            maxDate: end,
            ranges: {
                'Last 7 Days': [moment().subtract(7, 'days'), moment().subtract(1, 'days')],
                'Last 30 Days': [moment().subtract(30, 'days'), moment().subtract(1, 'days')],
                'Last 90 Days': [moment().subtract(90, 'days'), moment().subtract(1, 'days')],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month')
                    .endOf('month')
                ],
                'Last Year': [moment().subtract(365, 'days'), moment().subtract(1, 'days')]
            }
        }, cb);*/
        cb(start, end);



        // Generate AI report for Source Medium on page load
        //conv_generate_ai_insight("SourceSales25");

        jQuery(function() {
            jQuery(window).resize(function() {
                conv_set_gridboxwidth();
            });

            //For tooltip
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });

        });
    </script>
<?php
} else {
?>
    <script>
        jQuery(function() {
            jQuery("#reportrange").addClass('d-none');
            jQuery(".conv_reportsec_box").addClass("opacity-50");

            jQuery("#upgradetopromodalotherReports").modal('show');
            jQuery("body.modal-open").css("overflow", "auto !important");
        });

        jQuery(document).on('show.bs.modal', '#upgradetopromodalotherReports', function() {
            setTimeout(function() {
                jQuery("body.modal-open").addClass("overflow-auto");
            }, 1000);
        });
    </script>

<?php
}
?>