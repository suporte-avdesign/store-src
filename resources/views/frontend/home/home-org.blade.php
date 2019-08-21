<!DOCTYPE html>
<!--[if IE 8]>
<html class="ie ie8" lang="{{ app()->getLocale() }}">
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html lang="{{ app()->getLocale() }}">
<!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <script>document.documentElement.className = document.documentElement.className + ' yes-js js_active js'</script>
    <title> {{$content->title}}</title>
    <meta name="description" content="{{$configKeyword->description}} , {{$configKeyword->genders}}">
    <meta name="keywords" content="{{$configKeyword->keywords}},{{$configKeyword->categories}},{{$configKeyword->genders}}">

    <style>.wishlist_table .add_to_cart, a.add_to_wishlist.button.alt { border-radius: 16px; -moz-border-radius: 16px; -webkit-border-radius: 16px; }</style>
    <link rel="dns-prefetch" href="//fonts.googleapis.com" />
    @include('frontend.scripts.analytics-1')
    <link rel="stylesheet" id="contact-form-7"  href="{{mix('includes/contact-form-7/css/styles.css')}}" type="text/css" media="all" />
    <style id="woocommerce-inline-inline-css" type="text/css">.woocommerce form .form-row .required { visibility: visible; }</style>

    <!-- MOME -->
    <link rel="stylesheet" id="rs-plugin-settings-css" href="{{asset('plugins/revslider/css/settings.min.css')}}" type="text/css" media="all" />

    <style id="rs-plugin-settings-inline-css" type="text/css">.tp-caption a{color:#ff7302;text-shadow:none;-webkit-transition:all 0.2s ease-out;-moz-transition:all 0.2s ease-out;-o-transition:all 0.2s ease-out;-ms-transition:all 0.2s ease-out}.tp-caption a:hover{color:#ffa902}</style>
    <style id='woocommerce-inline-inline-css' type='text/css'>.woocommerce form .form-row .required {visibility: visible;}</style>
    <link rel="stylesheet" id="prettyPhoto" href="{{asset('plugins/prettyPhoto/css/prettyPhoto.css')}}" type="text/css" media="all" />
    <link rel="stylesheet" id="jquery-selectBox" href="{{asset('plugins/yith-wishlist/css/jquery.selectBox.css')}}" type="text/css" media="all" />
    <link rel="stylesheet" id="yith-wcwl-main" href="{{asset('plugins/yith-wishlist/css/style.css')}}" type="text/css" media="all" />
    <link rel="stylesheet" id="js_composer_front" href="{{asset('plugins/js_composer/css/js_composer.min.css')}}" type="text/css" media="all" />
    <link rel="stylesheet" id="mailchimp-form" href="{{asset('plugins/mailchimp/css/form-basic.min.css')}}" type="text/css" media="all" />
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

    <link rel="stylesheet" id="bootstrap" href="{{asset('bootstrap/css/bootstrap.min.css')}}" type="text/css" media="all" />
    <link rel="stylesheet" id="style-css" href="{{asset('css/main.css')}}" type="text/css" media="all" />
    <link rel="stylesheet" id="font-awesome" href="{{asset('font-awesome/css/font-awesome.min.css')}}" type="text/css" media="all" />
    <style id="font-awesome-inline-css" type="text/css">
        [data-font="FontAwesome"]:before {font-family: 'FontAwesome' !important;content: attr(data-icon) !important;speak: none !important;font-weight: normal !important;font-variant: normal !important;text-transform: none !important;line-height: 1 !important;font-style: normal !important;-webkit-font-smoothing: antialiased !important;-moz-osx-font-smoothing: grayscale !important;}
    </style>
    <script type="text/template" id="tmpl-variation-template">
        <div class="woocommerce-variation-description">@{{{ data.variation.variation_description }}}</div>
        <div class="woocommerce-variation-price">@{{{ data.variation.price_html }}}</div>
        <div class="woocommerce-variation-availability">@{{{ data.variation.availability_html }}}</div>
    </script>
    <script type="text/template" id="tmpl-unavailable-variation-template">
        <p>Desculpe, este produto não está disponível. Por favor, escolha uma combinação diferente.</p>
    </script>
    @include('frontend.scripts.monsterinsights_frontend')
    <script type="text/javascript" src="{{asset('plugins/google/analytics-frontend.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('includes/js/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('includes/js/jquery/jquery-migrate.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/jquery-blockui/jquery.blockUI.min.js')}}"></script>
    @include('frontend.scripts.add_to_cart_params')
    <script type="text/javascript" src="{{asset('plugins/cart/js/add-to-cart.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/cart/js/avd-add-to-cart.js')}}"></script>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="{{asset('themes/js/html5.min.js')}}"></script>
    <![endif]-->
    <script type="text/javascript" src="{{asset('themes/js/device.min.js')}}"></script>
    <link rel="shortcut icon" href="{{asset('themes/images/icons/favicon.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{asset('themes/images/icons/apple-touch-icon-152x152-precomposed.png')}}">
    @include('frontend.scripts.scroll-menu')
    <noscript><style>.woocommerce-product-gallery{ opacity: 1 !important; }</style></noscript>
    <style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style>
    <!--[if lte IE 9]>
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/js_composer/css/vc_lte_ie9.min.css')}}" media="screen">
    <![endif]-->
    @include('frontend.scripts.home.setREVStartSize')

    <link rel="stylesheet" id="theme-css" href="{{asset('themes/css/home-1-min.css')}}" type="text/css" media="all" />

    <style type="text/css" data-type="vc_shortcodes-custom-css">.vc_custom_1477403044270{margin-top: -40px !important;margin-bottom: 10vh !important;}.vc_custom_1477929174010{margin-bottom: 5vh !important;}.vc_custom_1477937331390{margin-bottom: 5vh !important;padding-top: 50px !important;padding-bottom: 50px !important;background-color: #f9f9f9 !important;}.vc_custom_1477552018282{margin-bottom: 0px !important;padding-top: 20px !important;}.vc_custom_1477943846123{margin-top: 0px !important;margin-bottom: 10px !important;}.vc_custom_1477937509795{margin-bottom: 8vh !important;padding-top: 50px !important;padding-bottom: 50px !important;background-color: #f9f9f9 !important;}.vc_custom_1477937519143{margin-bottom: 8vh !important;}.vc_custom_1477735778599{margin-bottom: -40px !important;padding-top: 0px !important;padding-bottom: 0px !important;background-color: #f9f9f9 !important;}.vc_custom_1488187477623{margin-bottom: 60px !important;padding-left: 120px !important;background-image: url(https://demo.xtemos.com/basel/wp-content/uploads/2015/08/market-category-1.png?id=25263) !important;background-position: 0 0 !important;background-repeat: no-repeat !important;}.vc_custom_1488187533752{margin-bottom: 60px !important;padding-left: 120px !important;background-image: url(https://demo.xtemos.com/basel/wp-content/uploads/2015/08/market-category-4.png?id=25266) !important;background-position: 0 0 !important;background-repeat: no-repeat !important;}.vc_custom_1488187489197{margin-bottom: 60px !important;padding-left: 120px !important;background-image: url(https://demo.xtemos.com/basel/wp-content/uploads/2015/08/market-category-2.png?id=25264) !important;background-position: 0 0 !important;background-repeat: no-repeat !important;}.vc_custom_1488187522669{margin-bottom: 60px !important;padding-left: 120px !important;background-image: url(https://demo.xtemos.com/basel/wp-content/uploads/2015/08/market-category-5.png?id=25267) !important;background-position: 0 0 !important;background-repeat: no-repeat !important;}.vc_custom_1488187501809{margin-bottom: 60px !important;padding-left: 120px !important;background-image: url(https://demo.xtemos.com/basel/wp-content/uploads/2015/08/market-category-3.png?id=25265) !important;background-position: 0 0 !important;background-repeat: no-repeat !important;}.vc_custom_1488187511503{margin-bottom: 60px !important;padding-left: 120px !important;background-image: url(https://demo.xtemos.com/basel/wp-content/uploads/2015/08/market-category-6.png?id=25268) !important;background-position: 0 0 !important;background-repeat: no-repeat !important;}.vc_custom_1477735786181{border-right-width: 1px !important;padding-top: 40px !important;padding-bottom: 40px !important;border-right-color: #e0e0e0 !important;border-right-style: solid !important;}.vc_custom_1477735838426{border-right-width: 1px !important;padding-top: 40px !important;padding-bottom: 40px !important;border-right-color: #e0e0e0 !important;border-right-style: solid !important;}.vc_custom_1477735857513{border-right-width: 1px !important;padding-top: 40px !important;padding-bottom: 40px !important;border-right-color: #e0e0e0 !important;border-right-style: solid !important;}.vc_custom_1477735910971{padding-top: 40px !important;padding-bottom: 40px !important;}</style>

    <link rel="stylesheet" id="theme-css" href="{{asset('themes/css/theme.css')}}" type="text/css" media="all" />

    <noscript><style type="text/css"> .wpb_animate_when_almost_visible { opacity: 1; }</style></noscript>
</head>
<body class="page-template-default page page-id-25099 logged-in woocommerce-no-js wrapper-full-width global-cart-design-1 global-search-full-screen global-header-simple mobile-nav-from-left basel-light catalog-mode-off categories-accordion-on global-wishlist-enable basel-top-bar-on basel-ajax-shop-on basel-ajax-search-on enable-sticky-header sticky-header-clone offcanvas-sidebar-mobile offcanvas-sidebar-tablet wpb-js-composer js-comp-ver-5.6 vc_responsive">
@include('frontend.messages.body-1')
@include('frontend.auth.login-1-sidbar')
@include('frontend.headers.tops.top-1')
@include('frontend.headers.navs.mobile-nav-1')
@include('frontend.headers.columns.cart-right-1')
<div class="website-wrapper">

    @include('frontend.headers.header-2')

    <div class="clear"></div>

    <div class="main-page-wrapper">
        <!-- MAIN CONTENT AREA -->
        <div class="container">
            <div class="row">
                <div class="site-content col-sm-12" role="main">
                    <article id="post-25099" class="post-25099 page type-page status-publish hentry">
                        <div class="entry-content">

                            <div class="vc_row wpb_row vc_row-fluid vc_custom_1477403044270">

                                @include('frontend.home.banners.banner-1')

                                @include('frontend.home.sliders.rev-slider-1')

                                @include('frontend.home.banners.banner-2')

                            </div>

                            @include('frontend.home.carousel.offers-1')

                            @include('frontend.home.carousel.featured-1')

                            <div class="vc_row-full-width vc_clearfix"></div>

                        </div>

                    </article>
                </div>
            </div>
        </div>

    </div>


    <!-- FOOTER -->
    @include('frontend.footers.footer-1')



</div> <!-- end wrapper -->

<div class="basel-close-side "></div>
<a href="#" class="scrollToTop basel-tooltip">Role para cima</a>

<script type="text/javascript">
    var c=document.body.className;
    c=c.replace(/woocommerce-no-js/, 'woocommerce-js');
    document.body.className=c;
</script>
<script type="text/javascript">
    function revslider_showDoubleJqueryError(sliderID) {
        var errorMessage = "Revolution Slider Error: You have some jquery.js library include that comes after the revolution files js include.";
        errorMessage += "<br> This includes make eliminates the revolution slider libraries, and make it not work.";
        errorMessage += "<br><br> To fix it you can:<br>&nbsp;&nbsp;&nbsp; 1. In the Slider Settings -> Troubleshooting set option:  <strong><b>Put JS Includes To Body</b></strong> option to true.";
        errorMessage += "<br>&nbsp;&nbsp;&nbsp; 2. Find the double jquery.js include and remove it.";
        errorMessage = "<span style='font-size:16px;color:#BC0C06;'>" + errorMessage + "</span>";
        jQuery(sliderID).show().html(errorMessage);
    }
</script>

@include('frontend.scripts.wpcf7')
<script type="text/javascript" src="{{asset('includes/contact-form-7/js/scripts.js')}}"></script>

<script type="text/javascript" src="{{asset('plugins/revslider/js/jquery.themepunch.tools.min.js')}}" defer="defer"></script>
<script type="text/javascript" src="{{asset('plugins/revslider/js/jquery.themepunch.revolution.min.js')}}" defer="defer"></script>
<script type="text/javascript" src="{{asset('plugins/revslider/js/extensions/revolution.extension.actions.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/revslider/js/extensions/revolution.extension.carousel.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/revslider/js/extensions/revolution.extension.kenburn.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/revslider/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/revslider/js/extensions/revolution.extension.migration.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/revslider/js/extensions/revolution.extension.navigation.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/revslider/js/extensions/revolution.extension.parallax.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/revslider/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/revslider/js/extensions/revolution.extension.video.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/js-cookie/js.cookie.min.js')}}"></script>
<script type="text/javascript">
    var woocommerce_params  = {!! json_encode([
        "ajax_url" => "woocommerce_params",
        "wc_ajax_url" => "woocommerce_params_2"
    ]) !!};
</script>
<script type="text/javascript" src="{{asset('plugins/frontend/avdesign.min.js')}}"></script>
@include('frontend.scripts.wc_cart_fragments_params')
<script type="text/javascript" src="{{asset('plugins/cart/js/cart-fragments.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/yith-wishlist/js/jquery.selectBox.min.js')}}"></script>
@include('frontend.scripts.yith_wcwl_l10n')
<script type="text/javascript" src="{{asset('plugins/yith-wishlist/js/jquery.yith-wcwl.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/isotope/isotope.pkgd.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/waypoints/waypoints.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/js_composer/js/js_composer_front.min.js')}}"></script>
@include('frontend.scripts.basel_settings')
<script type="text/javascript" src="{{asset('themes/js/theme.min.js')}}"></script>
<script type="text/javascript" src="{{asset('includes/underscore/js/underscore.js')}}"></script>



@include('frontend.scripts._wpUtilSettings')
<script type="text/javascript" src="{{asset('includes/util/avd-util.js')}}"></script>
@include('frontend.scripts.wc_add_to_cart_variation_params')
<script type="text/javascript" src="{{asset('plugins/cart/js/add-to-cart-variation.min.js')}}"></script>

<script>
    var htmlDiv = document.getElementById("rs-plugin-settings-inline-css");
    var htmlDivCss = "";
    if (htmlDiv) {
        htmlDiv.innerHTML = htmlDiv.innerHTML + htmlDivCss;
    } else {
        var htmlDiv = document.createElement("div");
        htmlDiv.innerHTML = "<style>" + htmlDivCss + "</style>";
        document.getElementsByTagName("head")[0].appendChild(htmlDiv.childNodes[0]);
    }
</script>


<script type="text/javascript">
    if (setREVStartSize !== undefined) setREVStartSize({
        c: '#rev_slider_31_1',
        responsiveLevels: [1240, 1024, 778, 480],
        gridwidth: [555, 1024, 778, 480],
        gridheight: [539, 1000, 760, 600],
        sliderLayout: 'auto'
    });

    var revapi31,
        tpj;
    (function() {
        if (!/loaded|interactive|complete/.test(document.readyState)) document.addEventListener("DOMContentLoaded", onLoad);
        else onLoad();

        function onLoad() {
            if (tpj === undefined) {
                tpj = jQuery;
                if ("off" == "on") tpj.noConflict();
            }
            if (tpj("#rev_slider_31_1").revolution == undefined) {
                revslider_showDoubleJqueryError("#rev_slider_31_1");
            } else {
                revapi31 = tpj("#rev_slider_31_1").show().revolution({
                    sliderType: "standard",
                    jsFileLocation: "{{asset('plugins/revslider/js/')}}",
                    sliderLayout: "auto",
                    dottedOverlay: "none",
                    delay: 10000,
                    navigation: {
                        keyboardNavigation: "off",
                        keyboard_direction: "horizontal",
                        mouseScrollNavigation: "off",
                        mouseScrollReverse: "default",
                        onHoverStop: "off",
                        touch: {
                            touchenabled: "on",
                            touchOnDesktop: "on",
                            swipe_threshold: 75,
                            swipe_min_touches: 1,
                            swipe_direction: "horizontal",
                            drag_block_vertical: false
                        },
                        arrows: {
                            style: "gyges",
                            enable: true,
                            hide_onmobile: false,
                            hide_onleave: true,
                            hide_delay: 200,
                            hide_delay_mobile: 1200,
                            tmp: '',
                            left: {
                                h_align: "left",
                                v_align: "center",
                                h_offset: 20,
                                v_offset: 0
                            },
                            right: {
                                h_align: "right",
                                v_align: "center",
                                h_offset: 20,
                                v_offset: 0
                            }
                        }
                    },
                    responsiveLevels: [1240, 1024, 778, 480],
                    visibilityLevels: [1240, 1024, 778, 480],
                    gridwidth: [555, 1024, 778, 480],
                    gridheight: [539, 1000, 760, 600],
                    lazyType: "none",
                    parallax: {
                        type: "mouse",
                        origo: "enterpoint",
                        speed: 400,
                        speedbg: 0,
                        speedls: 0,
                        levels: [1, 2, 3, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 51, 55],
                    },
                    shadow: 0,
                    spinner: "spinner0",
                    stopLoop: "off",
                    stopAfterLoops: -1,
                    stopAtSlide: -1,
                    shuffle: "off",
                    autoHeight: "off",
                    disableProgressBar: "on",
                    hideThumbsOnMobile: "off",
                    hideSliderAtLimit: 0,
                    hideCaptionAtLimit: 0,
                    hideAllCaptionAtLilmit: 0,
                    debugMode: false,
                    fallbacks: {
                        simplifyAll: "off",
                        nextSlideOnWindowFocus: "off",
                        disableFocusListener: false
                    }
                });
            }; /* END OF revapi call */

        }; /* END OF ON LOAD FUNCTION */
    }()); /* END OF WRAPPING FUNCTION */
</script>

@include('frontend.extras.popup-newsletter-1')
@include('frontend.extras.cookies-popup-1')
@include('frontend.extras.btn-link-1')
@include('frontend.extras.container-photo-swipe-ui-1')
</html>