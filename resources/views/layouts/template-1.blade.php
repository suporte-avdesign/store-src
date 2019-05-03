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
    @stack('title')
    <style>.wishlist_table .add_to_cart, a.add_to_wishlist.button.alt { border-radius: 16px; -moz-border-radius: 16px; -webkit-border-radius: 16px; }</style>
    <link rel="dns-prefetch" href="//fonts.googleapis.com" />
    @include('scripts.analytics-1')
    <link rel="stylesheet" id="contact-form-7"  href="{{asset('includes/contact-form-7/css/styles.css')}}?ver=5.0.5" type="text/css" media="all" />
    <style id="woocommerce-inline-inline-css" type="text/css">.woocommerce form .form-row .required { visibility: visible; }</style>
    <link rel="stylesheet" id="prettyPhoto" href="{{asset('plugins/prettyPhoto/css/prettyPhoto.css')}}" type="text/css" media="all" />
    <link rel="stylesheet" id="jquery-selectBox" href="{{asset('plugins/yith-wishlist/css/jquery.selectBox.css')}}" type="text/css" media="all" />
    <link rel="stylesheet" id="yith-wcwl-main" href="{{asset('plugins/yith-wishlist/css/style.css')}}" type="text/css" media="all" />
    <link rel="stylesheet" id="js_composer_front" href="{{asset('plugins/js_composer/css/js_composer.min.css')}}?ver=5.6" type="text/css" media="all" />
    <link rel="stylesheet" id="mailchimp-form" href="{{asset('plugins/mailchimp/css/form-basic.min.css')}}?ver=3.1.11" type="text/css" media="all" />
    <link rel="stylesheet" id="redux-google-fonts-basel_options-css"  href="https://fonts.googleapis.com/css?family=Karla%3A400%2C700%2C400italic%2C700italic%7CLora%3A400%2C700%2C400italic%2C700italic%7CLato%3A100%2C300%2C400%2C700%2C900%2C100italic%2C300italic%2C400italic%2C700italic%2C900italic&#038;subset=latin&#038;ver=1546694001" type="text/css" media="all" />
    <link rel="stylesheet" id="bootstrap" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}?ver=3.3.1" type="text/css" media="all" />
    <link rel="stylesheet" id="style-css" href="{{asset('themes/css/style.css')}}?ver=4.4.2" type="text/css" media="all" />
    <link rel="stylesheet" id="font-awesome" href="{{asset('plugins/font-awesome/css/font-awesome.min.css')}}?ver=4.7.0" type="text/css" media="all" />
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
    @include('scripts.monsterinsights_frontend')
    <script type="text/javascript" src="{{asset('plugins/google/analytics-frontend.min.js')}}?ver=7.3.2"></script>
    <script type="text/javascript" src="{{asset('includes/js/jquery/jquery.min.js')}}?ver=1.12.4"></script>
    <script type="text/javascript" src="{{asset('includes/js/jquery/jquery-migrate.min.js')}}?ver=1.4.1"></script>
    <script type="text/javascript" src="{{asset('plugins/jquery-blockui/jquery.blockUI.min.js')}}?ver=2.70"></script>
    @include('scripts.add_to_cart_params')
    <script type="text/javascript" src="{{asset('plugins/cart/js/add-to-cart.min.js')}}?ver=4.5.4"></script>
    <script type="text/javascript" src="{{asset('plugins/cart/js/avd-add-to-cart.js')}}?ver=5.6"></script>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="{{asset('themes/js/html5.min.js')}}?ver=4.4.2"></script>
    <![endif]-->
    <script type="text/javascript" src="{{asset('themes/js/device.min.js')}}?ver=4.4.2"></script>
    <link rel="shortcut icon" href="{{asset('themes/images/icons/favicon.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{asset('themes/images/icons/apple-touch-icon-152x152-precomposed.png')}}">
    @include('scripts.scroll-menu')
    <noscript><style>.woocommerce-product-gallery{ opacity: 1 !important; }</style></noscript>
    <style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style>
    <!--[if lte IE 9]>
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/js_composer/css/vc_lte_ie9.min.css')}}" media="screen">
    <![endif]-->

    <link rel="stylesheet" id="styles-css" href="{{asset('themes/css/styles.min.css')}}?ver=1.0.0" type="text/css" media="all" />
    <link rel="stylesheet" id="theme-css" href="{{asset('themes/css/theme.css')}}?ver=1.0.0" type="text/css" media="all" />
    @stack('styles')
    @stack('head')
    <noscript><style type="text/css"> .wpb_animate_when_almost_visible { opacity: 1; }</style></noscript>
</head>
@stack('body')

@include('messages.message-1-body')

@include('auth.login-1-sidbar')

<div class="website-wrapper">

    @include('headers.header-1')

    <div class="clear"></div>

    <div class="main-page-wrapper">

        @yield('content')

        @include('footers.footer-1')
    </div><!-- .main-page-wrapper -->
</div><!-- end wrapper -->


<div class="basel-close-side"></div>
<a href="#" class="scrollToTop basel-tooltip">Role para cima</a>

@include('scripts.c-document-body')
@include('scripts.wpcf7')
<script type="text/javascript" src="{{asset('includes/contact-form-7/js/scripts.js')}}?ver=5.0.5"></script>
<script type="text/javascript" src="{{asset('plugins/js-cookie/js.cookie.min.js')}}?ver=2.1.4"></script>
@include('scripts.woocommerce_params')
<script type="text/javascript" src="{{asset('plugins/frontend/avdesign.min.js')}}?ver=3.5.2"></script>
@include('scripts.wc_cart_fragments_params')
@stack('scripts')
<script type="text/javascript" src="{{asset('plugins/cart/js/cart-fragments.min.js')}}?ver=3.5.2"></script>
<script type="text/javascript" src="{{asset('plugins/yith-wishlist/js/jquery.selectBox.min.js')}}?ver=1.2.0"></script>
@include('scripts.yith_wcwl_l10n')
<script type="text/javascript" src="{{asset('plugins/yith-wishlist/js/jquery.yith-wcwl.js')}}?ver=2.2.5"></script>
<script type="text/javascript" src="{{asset('plugins/isotope/isotope.pkgd.min.js')}}?ver=5.6"></script>
<script type="text/javascript" src="{{asset('plugins/waypoints/waypoints.min.js')}}?ver=5.6"></script>
<script type="text/javascript" src="{{asset('plugins/js_composer/js/js_composer_front.min.js')}}?ver=5.6"></script>
@include('scripts.basel_settings')
<script type="text/javascript" src="{{asset('themes/js/theme-org.js')}}?ver=4.5.5"></script>
<script type="text/javascript" src="{{asset('includes/underscore/js/underscore.min.js')}}?ver=1.8.3"></script>
@include('scripts._wpUtilSettings')
<script type="text/javascript" src="{{asset('includes/util/avd-util.min.js')}}?ver=4.9.8"></script>
@include('scripts.wc_add_to_cart_variation_params')
<script type="text/javascript" src="{{asset('plugins/cart/js/add-to-cart-variation.min.js')}}?ver=3.5.2"></script>
@include('extras.popup-newsletter-1')
@include('extras.cookies-popup-1')
@include('extras.btn-link-1')
@include('extras.container-photo-swipe-ui-1')
</body>
</html>

