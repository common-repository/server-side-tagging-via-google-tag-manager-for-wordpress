<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CONVSST_pricing
{
    protected $TVC_Admin_Helper = "";
    protected $url = "";
    protected $subscriptionId = "";
    protected $google_detail;
    protected $customApiObj;
    protected $pro_plan_site;
    protected $convositeurl;

    public function __construct()
    {
        $this->TVC_Admin_Helper = new TVC_Admin_Helper();
        $this->customApiObj = new ConvsstCustomApi();
        $this->subscriptionId = $this->TVC_Admin_Helper->get_subscriptionId();
        $this->google_detail = $this->TVC_Admin_Helper->get_ee_options_data();
        $this->TVC_Admin_Helper->add_spinner_html();
        $this->pro_plan_site = $this->TVC_Admin_Helper->get_pro_plan_site();
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
        <div class="convo-global">
            <div class="convo-pricingpage">
                <!-- pricing timer -->
                <div class="pricing-timer d-none">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="timer-box">
                                            <div id="time"> <span id="min">00</span>:<span id="sec">00</span></div>
                                        </div>
                                        <h5 class="card-title">Wait! Get 10% Off</h5>
                                        <p class="card-text">Purchase any yearly plan in next 10 minutes with coupon code
                                            <strong>FIRSTBUY10</strong> and get additional 10% off.
                                        </p>
                                        <a class="btn btn-secondary common-btn" href="<?php echo esc_url($conversios_site_url . "/checkout?pid=planD_1_y"); ?>">
                                            Get It Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Compare feature -->
                <div class="comparefeature-wholebox" id="seeallfeatures">
                    <div class="comparefeature-area space">
                        <div class="container-full">
                            <div class="row">
                                <div class="col-12">
                                    <div class="title-text">
                                        <h2> <strong>Comprehensive Feature</strong> Comparison</h2>
                                        <h3>Delve into the details of all our feature</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="comparetable-box">
                                <form action="">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive custom-scrollbar">
                                                <table id="sticky-header-tbody-id" class="feature-table table ">
                                                    <thead id="con_stick_this">
                                                        <tr>
                                                            <th scope="col" class="th-data">
                                                                <div class="feature-box">
                                                                    <div class="card" style="margin:0 auto">
                                                                        <div class="card-body">
                                                                            <div class="card-icon">
                                                                                <img style="max-width:48px" src="<?php echo esc_url(CONVSST_PLUGIN_URL . '/admin/images/pricing-privacy.png'); ?>" alt="" class="img-fluid">
                                                                            </div>
                                                                            <h5 class="card-title">100% No Risk <br>
                                                                                Moneyback Guarantee</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </th>
                                                            <th scope="col" class="thd-data">
                                                                <div class="feature-box">
                                                                    <div class="dynamicprice_box" plan_cat="enterprise01" boxperiod="yearly" boxdomain="1">
                                                                        <div class="title card-title">Server Side Tagging</div>
                                                                        <p class="sub-title card-text">1 Active Website</p>
                                                                        <div class="strike-price">Regular Price: <span>
                                                                                $998.00</span></div>
                                                                        <div class="price">$499.00/ <span>year</span></div>
                                                                        <div class="offer-price">Flat 50% Off Applied </div>
                                                                        <div class="getstarted-btn get-it-now">
                                                                            <a class="label btn btn-secondary common-btn" target="_blank" href="<?php echo esc_url($conversios_site_url . "/checkout/?pid=wpAIO_EY1"); ?>">
                                                                                Get It Now
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dynamicprice_box d-none" plan_cat="enterprise03" boxperiod="yearly" boxdomain="5">
                                                                        <div class="title card-title">Server Side Tagging</div>
                                                                        <p class="sub-title card-text">3 Active Websites</p>
                                                                        <div style="opacity:0.06">
                                                                            <div class="card-price">$XXX/ <span>year</span></div>
                                                                            <div class="slash-price">Regular Price: <span>$XXXX/year</span></div>
                                                                            <div class="offer-price">50% Off</div>
                                                                        </div>
                                                                        <div class="getstarted-btn get-it-now">
                                                                            <a class="label btn btn-secondary common-btn" target="_blank" href="https://calendly.com/conversios/conversios-demo-for-server-side-tagging/">
                                                                                CONTACT US
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dynamicprice_box d-none" plan_cat="enterprise05" boxperiod="yearly" boxdomain="10">
                                                                        <div class="title card-title">Server Side Tagging</div>
                                                                        <p class="sub-title card-text">5 Active Websites</p>
                                                                        <div style="opacity:0.06">
                                                                            <div class="card-price">$XXX/ <span>year</span></div>
                                                                            <div class="slash-price">Regular Price: <span>$XXXX/year</span></div>
                                                                            <div class="offer-price">50% Off</div>
                                                                        </div>
                                                                        <div class="getstarted-btn get-it-now">
                                                                            <a class="label btn btn-secondary common-btn" target="_blank" href="https://calendly.com/conversios/conversios-demo-for-server-side-tagging/">
                                                                                CONTACT US
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dynamicprice_box d-none" plan_cat="enterprise05+" boxperiod="yearly" boxdomain="10+">
                                                                        <div class="title card-title">Server Side Tagging</div>
                                                                        <p class="card-text contactus">
                                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                                                Contact Us
                                                                            </button>
                                                                        </p>

                                                                    </div>
                                                                </div>
                                                            </th>
                                                            <th scope="col" class="thd-data">
                                                                <div class="feature-box">
                                                                    <div class="dynamicprice_box" plan_cat="professional01" boxperiod="yearly" boxdomain="1">
                                                                        <div class="title card-title">Professional</div>
                                                                        <p class="sub-title card-text">1 Active Website</p>
                                                                        <div class="strike-price">Regular Price: <span>
                                                                                $398.00</span></div>
                                                                        <div class="price">$199.00/ <span>year</span></div>
                                                                        <div class="offer-price">Flat 50% Off Applied </div>
                                                                        <div class="getstarted-btn get-it-now">
                                                                            <a class="label btn btn-secondary common-btn" target="_blank" href="<?php echo esc_url($conversios_site_url . "/checkout/?pid=wpAIO_PY1"); ?>">
                                                                                Get It Now
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dynamicprice_box d-none" plan_cat="professional03" boxperiod="yearly" boxdomain="5">
                                                                        <div class="title card-title">Professional</div>
                                                                        <p class="sub-title card-text">3 Active Websites</p>
                                                                        <div class="strike-price">Regular Price: <span>
                                                                                $598.00</span></div>
                                                                        <div class="price">$299.00/ <span>year</span></div>
                                                                        <div class="offer-price">Flat 50% Off Applied </div>
                                                                        <div class="getstarted-btn get-it-now">
                                                                            <a class="label btn btn-secondary common-btn" target="_blank" href="<?php echo esc_url($conversios_site_url . "/checkout/?pid=wpAIO_PY3"); ?>">
                                                                                Get It Now
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dynamicprice_box d-none" plan_cat="professional05" boxperiod="yearly" boxdomain="10">
                                                                        <div class="title card-title">Professional</div>
                                                                        <p class="sub-title card-text">5 Active Websites</p>
                                                                        <div class="strike-price">Regular Price: <span>
                                                                                $798.00</span></div>
                                                                        <div class="price">$399.00/ <span>year</span></div>
                                                                        <div class="offer-price">Flat 50% Off Applied </div>
                                                                        <div class="getstarted-btn get-it-now">
                                                                            <a class="label btn btn-secondary common-btn" target="_blank" href="<?php echo esc_url($conversios_site_url . "/checkout/?pid=wpAIO_PY5"); ?>">
                                                                                Get It Now
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dynamicprice_box d-none" plan_cat="professional05+" boxperiod="yearly" boxdomain="10+">
                                                                        <div class="title card-title">Professional</div>
                                                                        <p class="card-text contactus">
                                                                            <!-- Button trigger modal -->
                                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                                                Contact Us
                                                                            </button>
                                                                        </p>

                                                                    </div>
                                                                </div>
                                                            </th>
                                                            <th scope="col" class="thd-data">
                                                                <div class="feature-box">
                                                                    <div class="dynamicprice_box" plan_cat="starter01" boxperiod="yearly" boxdomain="1">
                                                                        <div class="title card-title">Starter</div>
                                                                        <p class="sub-title card-text">1 Active Website</p>
                                                                        <div class="strike-price">Regular Price: <span>
                                                                                $198.00</span></div>
                                                                        <div class="price">$99.00/ <span>year</span></div>
                                                                        <div class="offer-price">Flat 50% Off Applied </div>
                                                                        <div class="getstarted-btn get-it-now">
                                                                            <a class="label btn btn-secondary common-btn" target="_blank" href="<?php echo esc_url($conversios_site_url . "/checkout/?pid=wpAIO_SY1"); ?>">
                                                                                Get It Now
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dynamicprice_box d-none" plan_cat="starter03" boxperiod="yearly" boxdomain="5">
                                                                        <div class="title card-title">Starter</div>
                                                                        <p class="sub-title card-text">3 Active Websites</p>
                                                                        <div class="strike-price">Regular Price: <span>
                                                                                $398.00</span></div>
                                                                        <div class="price">$199.00/ <span>year</span></div>
                                                                        <div class="offer-price">Flat 50% Off Applied </div>
                                                                        <div class="getstarted-btn get-it-now">
                                                                            <a class="label btn btn-secondary common-btn" target="_blank" href="<?php echo esc_url($conversios_site_url . "/checkout/?pid=wpAIO_SY3"); ?>">
                                                                                Get It Now
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dynamicprice_box d-none" plan_cat="starter05" boxperiod="yearly" boxdomain="10">
                                                                        <div class="title card-title">Starter</div>
                                                                        <p class="sub-title card-text">5 Active Websites</p>
                                                                        <div class="strike-price">Regular Price: <span>
                                                                                $598.00</span></div>
                                                                        <div class="price">$299.00/ <span>year</span></div>
                                                                        <div class="offer-price">Flat 50% Off Applied </div>
                                                                        <div class="getstarted-btn get-it-now">
                                                                            <a class="label btn btn-secondary common-btn" target="_blank" href="<?php echo esc_url($conversios_site_url . "/checkout/?pid=wpAIO_SY5"); ?>">
                                                                                Get It Now
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dynamicprice_box d-none" plan_cat="starter05+" boxperiod="yearly" boxdomain="10+">
                                                                        <div class="title card-title">Starter</div>
                                                                        <p class="card-text contactus">
                                                                            <!-- Button trigger modal -->
                                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                                                Contact Us
                                                                            </button>
                                                                        </p>

                                                                    </div>
                                                                </div>
                                            </div>
                                            </th>
                                            <th scope="col" class="thd-data">
                                                <div class="feature-box">
                                                    <div class="dynamicprice_box" boxperiod="yearly" boxdomain="1">
                                                        <div class="title card-title">Free</div>
                                                        <!-- <p class="sub-title card-text">1 Active Website</p> -->
                                                        <div class="strike-price">Regular Price: <span>
                                                                $00.00</span></div>
                                                        <div class="price">$00.00/ <span>year</span></div>
                                                        <div class="offer-price" style="opacity: 0; visibility: hidden;">Flat
                                                            50% Off Applied </div>
                                                        <!-- <div class="getstarted-btn get-it-now">
                                                            <a class="label btn btn-secondary common-btn" target="_blank" href="<?php echo esc_url("https://wordpress.org/plugins/server-side-tagging-via-google-tag-manager-for-wordpress/"); ?>">
                                                                Get It Now
                                                            </a>
                                                        </div> -->
                                                    </div>
                                                    <div class="dynamicprice_box d-none" boxperiod="yearly" boxdomain="5">
                                                        <div class="title card-title">Free</div>
                                                        <!-- <p class="sub-title card-text">3 Active Websites</p> -->
                                                        <div class="strike-price">Regular Price: <span>
                                                                $00.00</span></div>
                                                        <div class="price">$00.00/ <span>year</span></div>
                                                        <div class="offer-price" style="opacity: 0; visibility: hidden;">Flat
                                                            50% Off Applied </div>
                                                        <!-- <div class="getstarted-btn get-it-now">
                                                            <a class="label btn btn-secondary common-btn" target="_blank" href="<?php echo esc_url("https://wordpress.org/plugins/server-side-tagging-via-google-tag-manager-for-wordpress/"); ?>">
                                                                Get It Now
                                                            </a>
                                                        </div> -->
                                                    </div>
                                                    <div class="dynamicprice_box d-none" boxperiod="yearly" boxdomain="10">
                                                        <div class="title card-title">Free</div>
                                                        <!-- <p class="sub-title card-text">5 Active Websites</p> -->
                                                        <div class="strike-price">Regular Price: <span>
                                                                $00.00</span></div>
                                                        <div class="price">$00.00/ <span>year</span></div>
                                                        <div class="offer-price" style="opacity: 0; visibility: hidden;">Flat
                                                            50% Off Applied </div>
                                                        <!-- <div class="getstarted-btn get-it-now">
                                                            <a class="label btn btn-secondary common-btn" target="_blank" href="<?php echo esc_url("https://wordpress.org/plugins/server-side-tagging-via-google-tag-manager-for-wordpress/"); ?>">
                                                                Get It Now
                                                            </a>
                                                        </div> -->
                                                    </div>
                                                    <div class="dynamicprice_box d-none" boxperiod="yearly" boxdomain="10+">
                                                        <div class="title card-title">Free</div>
                                                        <p class="card-text contactus">
                                                            <!-- Button trigger modal -->
                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="opacity: 0; visibility: hidden;">
                                                                Contact Us
                                                            </button>
                                                        </p>

                                                    </div>
                                                </div>
                                            </th>




                                            </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Accessibility Features -->
                                                <!-- 0 -->
                                                <tr class="title-row" data-title="Accessibility Features">
                                                    <td colspan="5" class="data">
                                                        <div class="feature-title">
                                                            Accessibility Features
                                                        </div>
                                                    </td>
                                                </tr>
                                                <!-- 1 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="A dedicated customer success manager ensures that everything is set up accurately and helps you solve any issue that you may face.">
                                                                Dedicated Customer Success Manager
                                                            </button>
                                                        </div>

                                                    </th>

                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <!-- 2 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc remove" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip">
                                                                Priority Support
                                                            </button>
                                                        </div>
                                                    </th>

                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <!-- 3 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Analytics and Ads management becomes complicated some time. Our team of expert helps you in set up everything and performs audit so that you focus on the things that matter for your business.">
                                                                Free Setup and Audit
                                                            </button>
                                                        </div>
                                                    </th>

                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <!-- 4 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Free consultation for campaign management and conversion rate optimization tips.">
                                                                Free Consultation for Campaign Management & CRO
                                                            </button>
                                                        </div>
                                                    </th>

                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>


                                                <!-- GTM for Google Analytics and Pixels -->
                                                <!-- 0 -->
                                                <tr class="title-row">
                                                    <td colspan="5" class="data">
                                                        <div class="feature-title">
                                                            GTM & Datalayer Automation
                                                        </div>
                                                    </td>
                                                </tr>
                                                <!-- 1 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="By default your website will interact with Conversios GTM container.">
                                                                Conversios GTM container
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                            <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <!-- 2 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="One click automation of your own GTM container for faster page speed and flexibility. Create tags, triggers & variables based on your needs.">
                                                                Automate your GTM container
                                                            </button>
                                                        </div>
                                                    </th>

                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <!-- 3 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Automates complete e-commerce datalayer for your Wordpress or WooCommerce stores. Single unified datalayer automation that can be used with all the analytics and Ads tracking.">
                                                                E-Commerce Datalayer
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <!-- GA4, Ads Conversion Tracking & Audience Building -->
                                                <!-- 0 -->
                                                <tr class="title-row" data-title="Accessibility Features">
                                                    <td colspan="5" class="data">
                                                        <div class="feature-title">
                                                            GA4, Ads Conversion Tracking & Audience Building
                                                        </div>
                                                    </td>
                                                </tr>
                                                <!-- 1 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc remove" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip">
                                                                <b>GA4 E-commerce tracking</b>
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <!-- 2 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Tracking of all the web pages.">
                                                                page_view
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <!-- 3 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Tracking of all the web pages.">
                                                                purchase
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <!-- 4 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="GA4 tracking when user views products on any product listing page. ie. Home page, product listing page, category page, similar products block etc.">
                                                                view_item_list
                                                            </button>
                                                        </div>
                                                    </th>

                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <!-- 5 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="GA4 tracking when user views any specific product's details page">
                                                                view_item
                                                            </button>
                                                        </div>
                                                    </th>

                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <!-- 6 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="GA4 tracking when user selects/clicks on any specific product.">
                                                                select_item
                                                            </button>
                                                        </div>
                                                    </th>

                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <!-- 7 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="GA4 tracking when user add product in the cart.">
                                                                add_to_cart
                                                            </button>
                                                        </div>
                                                    </th>

                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <!-- 8 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="GA4 tracking when user removes product from the cart.">
                                                                remove_from_cart
                                                            </button>
                                                        </div>
                                                    </th>

                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <!-- 9 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="GA4 tracking when user views cart page.">
                                                                view_cart
                                                            </button>
                                                        </div>
                                                    </th>

                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <!-- 10 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="GA4 tracking when user initiated checkout.">
                                                                begin_checkout
                                                            </button>
                                                        </div>
                                                    </th>

                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <!-- 11 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="GA4 tracking when user selects payment method in checkout.">
                                                                add_payment_info
                                                            </button>
                                                        </div>
                                                    </th>

                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <!-- 12 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="GA4 tracking when user selects shipping method in checkout.">
                                                                add_shipping_info
                                                            </button>
                                                        </div>
                                                    </th>

                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <!-- 13 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Form submission tracking in GA4.">
                                                                form field tracking
                                                            </button>
                                                        </div>
                                                    </th>

                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 14 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc remove" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip">
                                                                <b>Google Ads Tracking</b>
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 15 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Google Ads conversion tracking for purchase event.">
                                                                Conversion Tracking for purchase
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 16 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Google Ads conversion tracking for add to cart event.">
                                                                Conversion Tracking for add to cart
                                                            </button>
                                                        </div>
                                                    </th>

                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 17 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Google Ads conversion tracking for begin checkout event.">
                                                                Conversion Tracking for begin checkout
                                                            </button>
                                                        </div>
                                                    </th>

                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 18 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Google Ads enhanced conversion tracking for accurate and efficient conversion recording.">
                                                                Enhanced Conversion tracking
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 18 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Google Ads dynamic remarketing audience building based on user browsing behavior. 5 audience lists creation in Google Ads.">
                                                                Dynamic Audience building
                                                            </button>
                                                        </div>
                                                    </th>

                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 19 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc remove" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip">
                                                                <b>Facebook Ads Tracking</b>
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 20 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Facebook Ads conversion tracking for purchase event.">
                                                                Conversion tracking (purchase)
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 21 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Facebook dynamic remarketing audience building based on user browsing behavior. ">
                                                                Audience building based on e-commerce events
                                                            </button>
                                                        </div>
                                                    </th>

                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 22 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Enable this feature to improve the event quality score in business management account. ">
                                                                Advanced Matching
                                                            </button>
                                                        </div>
                                                    </th>

                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 23 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Server-Side Tagging   for FB events in order to increase accurate and efficient events tracking.">
                                                                Facebook Conversions API
                                                            </button>
                                                        </div>
                                                    </th>

                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 24 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc remove" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip">
                                                                <b>TikTok Ads Tracking</b>
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 25 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="TikTok Ads conversion tracking for purchase event.">
                                                                Conversion tracking (purchase)
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 26 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="TikTok dynamic remarketing audience building based on user browsing behavior. ">
                                                                Audience building based on e-commerce events
                                                            </button>
                                                        </div>
                                                    </th>

                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 27 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Enable this feature to improve the event quality score in business management account.">
                                                                Advanced Matching
                                                            </button>
                                                        </div>
                                                    </th>

                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 28 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Server-Side Tagging of e-commerce events for accurate and efficient events tracking for TikTok Ads.">
                                                                TikTok Events API
                                                            </button>
                                                        </div>
                                                    </th>

                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>


                                                <!-- 29 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc remove" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip">
                                                                <b>Snapchat Ads Tracking</b>
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 30 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Snapchat Ads conversion tracking for purchase event.">
                                                                Conversion tracking (purchase)
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 31 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Snapchat dynamic remarketing audience building based on user browsing behavior. ">
                                                                Audience building based on e-commerce events
                                                            </button>
                                                        </div>
                                                    </th>

                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 32 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Server-Side Tagging of e-commerce events for accurate and efficient events tracking for Snapchat Ads.">
                                                                Snapchat Conversions API
                                                            </button>
                                                        </div>
                                                    </th>

                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 33 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc remove" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip">
                                                                <b>Pinterest Ads Tracking</b>
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 34 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Pinterest Ads conversion tracking for purchase event.">
                                                                Conversion tracking (purchase)
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 35 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Pinterest dynamic remarketing audience building based on user browsing behavior. ">
                                                                Audience building based on e-commerce events
                                                            </button>
                                                        </div>
                                                    </th>

                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 36 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc remove" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip">
                                                                <b>Microsoft Ads Tracking</b>
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 37 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Microsoft Ads conversion tracking for purchase event.">
                                                                Conversion tracking (purchase)
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 38 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Microsoft Ads dynamic remarketing audience building based on user browsing behavior.">
                                                                Audience building based on e-commerce events
                                                            </button>
                                                        </div>
                                                    </th>

                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 39 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc remove" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip">
                                                                <b>Microsoft Clarity Integration</b>
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 40 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc remove" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip">
                                                                <b>Hotjar Integration</b>
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 41 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc remove" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip">
                                                                <b>Crazy Egg Integration</b>
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 42 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc remove" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip">
                                                                <b>Twitter Ads Tracking</b>
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <!-- Server-Side Tagging  -->
                                                <!-- 0 -->
                                                <tr class="title-row" data-title="hello">
                                                    <td colspan="5" class="data">
                                                        <div class="feature-title">
                                                            Server-Side Tagging
                                                        </div>
                                                    </td>
                                                </tr>
                                                <!-- 1 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="One click automation of server GTM container for e-commerce events and ad channels.">
                                                                Automation of Server GTM
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>


                                                </tr>
                                                <!-- 2 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="One click automation of web GTM container for e-commerce events and ad channels.">
                                                                Automation of Web GTM
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>


                                                </tr>
                                                <!-- 3 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="One click provisioning of powerful google cloud server hosting for 100% uptime, scalability and security.">
                                                                Cloud hosting for sGTM
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>


                                                </tr>
                                                <!-- 4 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="No code automation for server e-commerce events datalayer.">
                                                                Server e-commerce datalayer automation
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>


                                                </tr>
                                                <!-- 5 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Add your own sub domain to make tagging first party compliant.">
                                                                Custom GTM Loader
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>


                                                </tr>
                                                <!-- 6 -->

                                                <!-- 7 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Complete e-commerce tracking.">
                                                                Server-Side Tagging for GA4(with prebuilt GTM containers)
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>


                                                </tr>
                                                <!-- 8 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Complete conversion tracking and audience building in Google Ads.">
                                                                Server-Side Tagging for Google Ads
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>


                                                </tr>
                                                <!-- 9 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Complete conversion tracking and audience building in Facebook.">
                                                                Server-Side Tagging for FB Ads and CAPI
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>


                                                </tr>
                                                <!-- 10 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Complete conversion tracking and audience building in Snapchat.">
                                                                Server-Side Tagging for Snapchat Ads and CAPI
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>


                                                </tr>

                                                <!-- 11 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Complete conversion tracking and audience building in TikTok.">
                                                                Server-Side Tagging for TikTok Events API
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>


                                                </tr>


                                                <!-- Product Feed Manager  -->
                                                <!-- 0 -->
                                                <tr class="title-row" data-title="hello">
                                                    <td colspan="5" class="data">
                                                        <div class="feature-title">
                                                            Product Feed Manager
                                                        </div>
                                                    </td>
                                                </tr>
                                                <!-- 1 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Total number of WooCommerce product sync limit.">
                                                                Number of products
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items"><b>Unlimited</b></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items"><b>Unlimited</b></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items"><b>Upto 500</b></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items"><b>Upto 100</b></div>
                                                        </div>
                                                    </td>




                                                </tr>

                                                <!-- 2 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc remove" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip">
                                                                Google Shopping Feed
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                            <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 3 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc remove" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip">
                                                                Facebook Catalog Feed
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 4 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc remove" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip">
                                                                TikTok Catalog Feed
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                            <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 5 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Auto schedule product updates in ad channels.">
                                                                Schedule auto product sync
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                            <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>



                                                <!-- 7 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Filter your WooCommerce product to create feed.">
                                                                Advanced filters
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                            <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 8-->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Sync handpicked products from the product grid.">
                                                                Select specific WooCommerce products
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                            <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!--9-->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Sync product attributes from 50+ product plugins.">
                                                                Compatibility with 50+ product plugins
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                            <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- Reporting & Campaign Management  -->
                                                <!-- 0 -->
                                                <tr class="title-row" data-title="hello">
                                                    <td colspan="5" class="data">
                                                        <div class="feature-title">
                                                            Reporting & Campaign Management
                                                        </div>
                                                    </td>
                                                </tr>
                                                <!-- 1 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Know about e-commerce funnel, product, source and order performance reports from wordpress admin. Enables data driven decision making to increase conversion %.">
                                                                E-Commerce reporting
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                            <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 2 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Enables you to measure the campaign performance in Google Ads.">
                                                                Ads reporting
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                            <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 3 -->
                                                <!-- <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="ChatGPT powered insights on your analytics and campaigns data.">
                                                                AI powered Insights
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                Unlimited
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                Unlimited
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                Upto 50
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                Upto 10
                                                            </div>
                                                        </div>
                                                    </td>




                                                </tr> -->

                                                <!-- 4 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Schedule daily, weekly or monthly reports straight into your inbox.">
                                                                Schedule smart email reports
                                                            </button>
                                                        </div>
                                                    </th>

                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 5 -->
                                                <tr>
                                                    <th class="th-data" scope="row">
                                                        <div class="tooltip-box">
                                                            <button type="button" class="btn btn-secondary tooltipc" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Create and manage Google Ads performance max campaigns and increase ROAS. Create and manage campaigns based on feeds.">
                                                                Product Ads Campaign Management
                                                            </button>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span>&#10003;</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="feature-data">
                                                            <div class="items">
                                                                <span class="cross">&#10539;</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- 18 buttons -->
                                                <tr style="height:100px">
                                                    <th class="th-data" scope="row" style="border: 0px;"></th>
                                                    <td style="border: 0px;">
                                                        <div class="feature-data">

                                                            <div class="dynamicprice_box" plan_cat="enterprise01" boxperiod="yearly" boxdomain="1">
                                                                <div class="getnow-btn">
                                                                    <a class="btn btn-secondary getnow" index='1' target="_blank" href="<?php echo esc_url($conversios_site_url . "/checkout/?pid=wpAIO_EY1"); ?>">Get It Now</a>
                                                                </div>
                                                            </div>
                                                            <div class="dynamicprice_box d-none" plan_cat="enterprise03" boxperiod="yearly" boxdomain="5">
                                                                <div class="getnow-btn">
                                                                    <a class="btn btn-secondary getnow" index='1' target="_blank" href="https://calendly.com/conversios/conversios-demo-for-server-side-tagging/">CONTACT US</a>
                                                                </div>
                                                            </div>
                                                            <div class="dynamicprice_box d-none" plan_cat="enterprise05" boxperiod="yearly" boxdomain="10">
                                                                <div class="getnow-btn">
                                                                    <a class="btn btn-secondary getnow" index='1' target="_blank" href="https://calendly.com/conversios/conversios-demo-for-server-side-tagging/">CONTACT US</a>
                                                                </div>
                                                            </div>
                                                            <div class="dynamicprice_box d-none" plan_cat="enterprise05+" boxperiod="yearly" boxdomain="10+">
                                                                <div class="getnow-btn">
                                                                    <button type="button" class="btn btn-primary getnow" data-bs-toggle="modal" data-bs-target="#staticBackdrop" index='1'>CONTACT US</button>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </td>
                                                    <td style="border: 0px;">
                                                        <div class="feature-data">
                                                            <div class="dynamicprice_box" boxperiod="yearly" boxdomain="1">
                                                                <div class="getnow-btn">
                                                                    <a class="btn btn-secondary getnow" index='2' target="_blank" href="<?php echo esc_url($conversios_site_url . "/checkout/?pid=wpAIO_PY1"); ?>">Get It Now</a>
                                                                </div>
                                                            </div>
                                                            <div class="dynamicprice_box d-none" boxperiod="yearly" boxdomain="5">
                                                                <div class="getnow-btn">
                                                                    <a class="btn btn-secondary getnow" index='2' target="_blank" href="<?php echo esc_url($conversios_site_url . "/checkout/?pid=wpAIO_PY3"); ?>">Get It Now</a>
                                                                </div>
                                                            </div>
                                                            <div class="dynamicprice_box d-none" boxperiod="yearly" boxdomain="10">
                                                                <div class="getnow-btn">
                                                                    <a class="btn btn-secondary getnow" index='2' target="_blank" href="<?php echo esc_url($conversios_site_url . "/checkout/?pid=wpAIO_PY5"); ?>">Get It Now</a>
                                                                </div>
                                                            </div>
                                                            <div class="dynamicprice_box d-none" boxperiod="yearly" boxdomain="10+">
                                                                <div class="getnow-btn">
                                                                    <button type="button" class="btn btn-primary getnow" data-bs-toggle="modal" data-bs-target="#staticBackdrop" index='1'>CONTACT US</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td style="border: 0px;">
                                                        <div class="feature-data">
                                                            <div class="dynamicprice_box" boxperiod="yearly" boxdomain="1">
                                                                <div class="getnow-btn">
                                                                    <a class="btn btn-secondary getnow" index='3' target="_blank" href="<?php echo esc_url($conversios_site_url . "/checkout/?pid=wpAIO_SY1"); ?>">Get It Now</a>
                                                                </div>
                                                            </div>
                                                            <div class="dynamicprice_box d-none" boxperiod="yearly" boxdomain="5">
                                                                <div class="getnow-btn">
                                                                    <a class="btn btn-secondary getnow" index='3' target="_blank" href="<?php echo esc_url($conversios_site_url . "/checkout/?pid=wpAIO_SY3"); ?>">Get It Now</a>
                                                                </div>
                                                            </div>
                                                            <div class="dynamicprice_box d-none" boxperiod="yearly" boxdomain="10">
                                                                <div class="getnow-btn">
                                                                    <a class="btn btn-secondary getnow" index='3' target="_blank" href="<?php echo esc_url($conversios_site_url . "/checkout/?pid=wpAIO_SY5"); ?>">Get It Now</a>
                                                                </div>
                                                            </div>
                                                            <div class="dynamicprice_box d-none" boxperiod="yearly" boxdomain="10+">
                                                                <div class="getnow-btn">
                                                                    <button type="button" class="btn btn-primary getnow" data-bs-toggle="modal" data-bs-target="#staticBackdrop" index='1'>CONTACT US</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td style="border: 0px;">
                                                        <div class="feature-data">
                                                            <!-- <div class="dynamicprice_box" boxperiod="yearly" boxdomain="1">
                                                                <div class="getnow-btn">
                                                                    <a class="btn btn-secondary getnow" index='4' target="_blank" href="<?php echo esc_url("https://wordpress.org/plugins/server-side-tagging-via-google-tag-manager-for-wordpress/"); ?>">Get It Now</a>
                                                                </div>
                                                            </div>
                                                            <div class="dynamicprice_box d-none" boxperiod="yearly" boxdomain="5">
                                                                <div class="getnow-btn">
                                                                    <a class="btn btn-secondary getnow" index='4' target="_blank" href="<?php echo esc_url("https://wordpress.org/plugins/server-side-tagging-via-google-tag-manager-for-wordpress/"); ?>">Get It Now</a>
                                                                </div>
                                                            </div>
                                                            <div class="dynamicprice_box d-none" boxperiod="yearly" boxdomain="10">
                                                                <div class="getnow-btn">
                                                                    <a class="btn btn-secondary getnow" index='4' target="_blank" href="<?php echo esc_url("https://wordpress.org/plugins/server-side-tagging-via-google-tag-manager-for-wordpress/"); ?>">Get It Now</a>
                                                                </div>
                                                            </div> -->
                                                            <div class="dynamicprice_box d-none" boxperiod="yearly" boxdomain="10+">
                                                                <div class="getnow-btn">
                                                                    <button type="button" class="btn btn-primary getnow" data-bs-toggle="modal" data-bs-target="#staticBackdrop" index='1' style="opacity: 0; visibility: hidden;">CONTACT
                                                                        US</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>


                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
wp_add_inline_script( 'convsst-admin',"
function checkperiod_domain() {
    jQuery('.dynamicprice_box').addClass('d-none');
    var yearmonth_checkbox = 'monthly';
    if (jQuery('#yearmonth_checkbox').is(':checked')) {
        yearmonth_checkbox = 'yearly'
    }
    var domain_num = jQuery('input[name=inlineRadioOptions]:checked').val()
    jQuery('.dynamicprice_box').each(function() {
        var boxperiod = jQuery(this).attr('boxperiod');
        var boxdomain = jQuery(this).attr('boxdomain');

        if (boxperiod == yearmonth_checkbox && boxdomain == domain_num) {
            jQuery(this).removeClass('d-none');
        }
    });
}
jQuery(function() {
    jQuery('#yearmonth_checkbox').click(function() {
        checkperiod_domain();
        console.log('clicked');
    });
    jQuery('input[name=inlineRadioOptions]').change(function() {
        checkperiod_domain();
        console.log('changed');
    });
    var distance = jQuery('#con_stick_this').offset().top;
    var convpwindow = jQuery(window);
    convpwindow.scroll(function() {
        if (convpwindow.scrollTop() >= 2040 && convpwindow.scrollTop() <= 3650) {

            jQuery('#con_stick_this').addClass('sticky-header');
            jQuery('#sticky-header-tbody-id').addClass('sticky-header-tbody');
        } else {
            jQuery('#con_stick_this').removeClass('sticky-header');
            jQuery('#sticky-header-tbody-id').removeClass('sticky-header-tbody');
        }
    });
});
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle=tooltip]');
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
function checkperiod_domain() {
    jQuery('.dynamicprice_box').addClass('d-none');
    var yearmonth_checkbox = 'yearly';
    if (jQuery('#yearmonth_checkbox').is(':checked')) {
        yearmonth_checkbox = 'yearly'
    }
    var domain_num = jQuery('input[name=inlineRadioOptions]:checked').val()
    jQuery('.dynamicprice_box').each(function() {
        var boxperiod = jQuery(this).attr('boxperiod');
        var boxdomain = jQuery(this).attr('boxdomain');
        var plan_cat = jQuery(this).attr('plan_cat');
        console.log('plan_cat='+plan_cat);
        console.log('boxperiod='+boxperiod);
        console.log('boxdomain='+boxdomain);
        console.log('domain_num='+domain_num);
        if (plan_cat == 'enterprise03' || plan_cat == 'enterprise05') {
            jQuery(this).addClass('conv_dim_box');
        } else {
            jQuery(this).removeClass('conv_dim_box');
        }
        if (boxperiod == yearmonth_checkbox && boxdomain == domain_num) {
            jQuery(this).removeClass('d-none');
        }
    });
}
");

    }
}
?>