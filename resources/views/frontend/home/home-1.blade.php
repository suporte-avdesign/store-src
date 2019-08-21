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
    <script type="text/javascript" src="{{asset('includes/js/jquery/jquery.min.js')}}"></script>
    @include('frontend.scripts.add_to_cart_params')

    <!--[if lt IE 9]>
    <script type="text/javascript" src="{{asset('themes/js/html5.min.js')}}"></script>
    <![endif]-->

    <link rel="shortcut icon" href="{{asset('themes/images/icons/favicon.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{asset('themes/images/icons/apple-touch-icon-152x152-precomposed.png')}}">
    @include('frontend.scripts.scroll-menu')
    <noscript><style>.woocommerce-product-gallery{ opacity: 1 !important; }</style></noscript>
    <style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style>
    <!--[if lte IE 9]>
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/js_composer/css/vc_lte_ie9.min.css')}}" media="screen">
    <![endif]-->
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
    if (setREVStartSize !== undefined) setREVStartSize({
        c: '#rev_slider_31_1',
        responsiveLevels: [1240, 1024, 778, 480],
        gridwidth: [555, 1024, 778, 480],
        gridheight: [539, 1000, 760, 600],
        sliderLayout: 'auto'
    });
    var revapi31, tpj;
</script>

@include('frontend.scripts.wpcf7')

<script type="text/javascript">
    var woocommerce_params  = {!! json_encode([
        "ajax_url" => "woocommerce_params",
        "wc_ajax_url" => "woocommerce_params_2"
    ]) !!};
</script>

@include('frontend.scripts.wc_cart_fragments_params')
@include('frontend.scripts.yith_wcwl_l10n')
@include('frontend.scripts.basel_settings')
@include('frontend.scripts._wpUtilSettings')
@include('frontend.scripts.wc_add_to_cart_variation_params')


@include('frontend.extras.popup-newsletter-1')
@include('frontend.extras.cookies-popup-1')
@include('frontend.extras.btn-link-1')
@include('frontend.extras.container-photo-swipe-ui-1')

<script type="text/javascript" src="{{asset('cache/js/home-1.min.js')}}"></script>
</body>
</html>