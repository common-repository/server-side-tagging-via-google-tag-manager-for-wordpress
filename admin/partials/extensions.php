<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CONVSST_extensions
{
    protected $convositeurl;

    public function __construct()
    {
        $this->convositeurl = "http://conversios.io";
        $this->create_form();
    }

    public function create_form()
    {
        $close_icon = esc_url(CONVSST_PLUGIN_URL . '/admin/images/close.png');
        $check_icon = esc_url(CONVSST_PLUGIN_URL . '/admin/images/check.png');
        $conversios_site_url = "https://www.conversios.io";
        ?>
        <!-- Pricing page WP AIO-->
        <div class="container mt-5 convo-global">
            <h3>Plugin You Should Try</h3>
            <p class="fs-16 mb-0">Check out other plugin from Conversios for audience building, campaign creation, tracking key conversion events, product feed management, and more. Try these plugins today!</p>
            <div class="row">
                <!-- AIO Card -->
                <div class="col-md-6 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <a class="navbar-brand link-dark fs-16 fw-400">
                                    <img style="width: 114px;" src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/logo.png'); ?>" />
                                </a>
                                <div>
                                    <span class="card-rating">&#9733;</span>
                                    <span class="card-rating">&#9733;</span>
                                    <span class="card-rating">&#9733;</span>
                                    <span class="card-rating">&#9733;</span>
                                    <span class="card-rating">☆</span>
                                </div>
                            </div>
                            <h4 class="card-title conv-blue mb-3 fs-16">Google Analytics 4 (GA4), Google Ads, Meta Pixel, GTM & Multiple Pixels for Woocommerce & WordPress</h4>
                            <div class="ext-wpinfo d-flex justify-content-between mb-3">
                                <span class="d-flex align-items-end active-installs"><svg class="me-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" focusable="false"><path fill-rule="evenodd" d="M11.25 5h1.5v15h-1.5V5zM6 10h1.5v10H6V10zm12 4h-1.5v6H18v-6z" clip-rule="evenodd"></path></svg>
                                 20,000+ active Installations</span>
                                <span class="d-flex align-items-end tested-version"><svg class="me-1" xmlns="http://www.w3.org/2000/svg" viewBox="-2 -2 24 24" width="24" height="24" aria-hidden="true" focusable="false"><path d="M20 10c0-5.51-4.49-10-10-10C4.48 0 0 4.49 0 10c0 5.52 4.48 10 10 10 5.51 0 10-4.48 10-10zM7.78 15.37L4.37 6.22c.55-.02 1.17-.08 1.17-.08.5-.06.44-1.13-.06-1.11 0 0-1.45.11-2.37.11-.18 0-.37 0-.58-.01C4.12 2.69 6.87 1.11 10 1.11c2.33 0 4.45.87 6.05 2.34-.68-.11-1.65.39-1.65 1.58 0 .74.45 1.36.9 2.1.35.61.55 1.36.55 2.46 0 1.49-1.4 5-1.4 5l-3.03-8.37c.54-.02.82-.17.82-.17.5-.05.44-1.25-.06-1.22 0 0-1.44.12-2.38.12-.87 0-2.33-.12-2.33-.12-.5-.03-.56 1.2-.06 1.22l.92.08 1.26 3.41zM17.41 10c.24-.64.74-1.87.43-4.25.7 1.29 1.05 2.71 1.05 4.25 0 3.29-1.73 6.24-4.4 7.78.97-2.59 1.94-5.2 2.92-7.78zM6.1 18.09C3.12 16.65 1.11 13.53 1.11 10c0-1.3.23-2.48.72-3.59C3.25 10.3 4.67 14.2 6.1 18.09zm4.03-6.63l2.58 6.98c-.86.29-1.76.45-2.71.45-.79 0-1.57-.11-2.29-.33.81-2.38 1.62-4.74 2.42-7.1z"></path></svg>
                                 Tested with <?php echo get_bloginfo('version'); ?></span>
                            </div>
                            <div class="d-flex justify-content-between">
                            <a target="_blank" style="width:200px" class="btn btn-custom btn-outline-primary btn-custom-primary me-1" href="https://www.conversios.io/pricing/?utm_source=free_sstpluginadmin&utm_medium=sst_extension&utm_campaign=free_sst_button&plugin_name=aio">Buy Now</a>
                            <a target="_blank" style="width:200px" class="btn btn-primary me-1" href="https://www.conversios.io/all-in-one-google-analytics-pixels-product-feed-manager-for-woocommerce/?utm_source=free_sstpluginadmin&utm_medium=sst_extension&utm_campaign=free_sst_button">Explore Product</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- PFM Card -->
                <div class="col-md-6 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <a class="navbar-brand link-dark fs-16 fw-400">
                                    <img style="width: 114px;" src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/logo.png'); ?>" />
                                </a>
                                <div>
                                    <span class="card-rating">&#9733;</span>
                                    <span class="card-rating">&#9733;</span>
                                    <span class="card-rating">&#9733;</span>
                                    <span class="card-rating">&#9733;</span>
                                    <span class="card-rating">&#9733;</span>
                                </div>
                            </div>
                            <h4 class="card-title conv-blue mb-3 fs-16">Automate & Optimize WooCommerce Product Feeds: Master Google, TikTok, & Facebook Advertising</h4>
                            <div class="ext-wpinfo d-flex justify-content-between mb-3">
                                <span class="d-flex align-items-end active-installs"><svg class="me-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" focusable="false"><path fill-rule="evenodd" d="M11.25 5h1.5v15h-1.5V5zM6 10h1.5v10H6V10zm12 4h-1.5v6H18v-6z" clip-rule="evenodd"></path></svg>
                                 100+ active Installations</span>
                                <span class="d-flex align-items-end tested-version"><svg class="me-1" xmlns="http://www.w3.org/2000/svg" viewBox="-2 -2 24 24" width="24" height="24" aria-hidden="true" focusable="false"><path d="M20 10c0-5.51-4.49-10-10-10C4.48 0 0 4.49 0 10c0 5.52 4.48 10 10 10 5.51 0 10-4.48 10-10zM7.78 15.37L4.37 6.22c.55-.02 1.17-.08 1.17-.08.5-.06.44-1.13-.06-1.11 0 0-1.45.11-2.37.11-.18 0-.37 0-.58-.01C4.12 2.69 6.87 1.11 10 1.11c2.33 0 4.45.87 6.05 2.34-.68-.11-1.65.39-1.65 1.58 0 .74.45 1.36.9 2.1.35.61.55 1.36.55 2.46 0 1.49-1.4 5-1.4 5l-3.03-8.37c.54-.02.82-.17.82-.17.5-.05.44-1.25-.06-1.22 0 0-1.44.12-2.38.12-.87 0-2.33-.12-2.33-.12-.5-.03-.56 1.2-.06 1.22l.92.08 1.26 3.41zM17.41 10c.24-.64.74-1.87.43-4.25.7 1.29 1.05 2.71 1.05 4.25 0 3.29-1.73 6.24-4.4 7.78.97-2.59 1.94-5.2 2.92-7.78zM6.1 18.09C3.12 16.65 1.11 13.53 1.11 10c0-1.3.23-2.48.72-3.59C3.25 10.3 4.67 14.2 6.1 18.09zm4.03-6.63l2.58 6.98c-.86.29-1.76.45-2.71.45-.79 0-1.57-.11-2.29-.33.81-2.38 1.62-4.74 2.42-7.1z"></path></svg>
                                 Tested with <?php echo get_bloginfo('version'); ?></span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a target="_blank" style="width:200px" class="btn btn-custom btn-outline-primary btn-custom-primary me-1" href="https://www.conversios.io/pricing/?utm_source=free_sstpluginadmin&utm_medium=sst_extension&utm_campaign=free_sst_button&plugin_name=pfm">Buy Now</a>
                                <a target="_blank" style="width:200px" class="btn btn-primary me-1" href="https://www.conversios.io/product-feed-manager-for-woocommerce/?utm_source=free_sstpluginadmin&utm_medium=sst_extension&utm_campaign=free_sst_button&plugin_name=pfm">Explore Product</a>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <?php
    }
}