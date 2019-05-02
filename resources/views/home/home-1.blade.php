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
    <title> {{config('app.name')}}</title>
    <style>
        .wishlist_table .add_to_cart, a.add_to_wishlist.button.alt { border-radius: 16px; -moz-border-radius: 16px; -webkit-border-radius: 16px; }
    </style>
    <link rel="dns-prefetch" href="//fonts.googleapis.com" />
@include('google.analytics-1')
<!-- / Google Analytics by MonsterInsights -->
    <link rel="stylesheet" id="contact-form-7"  href="{{asset('includes/contact-form-7/css/styles.css')}}?ver=5.0.5" type="text/css" media="all" />
    <style id="woocommerce-inline-inline-css" type="text/css">.woocommerce form .form-row .required { visibility: visible; }</style>
    <link rel="stylesheet" id="rs-plugin-settings-css" href="{{asset('plugins/revslider/css/settings.css')}}?ver=5.4.8.1" type="text/css" media="all" />
    <style id="rs-plugin-settings-inline-css" type="text/css">
        .tp-caption a{color:#ff7302;text-shadow:none;-webkit-transition:all 0.2s ease-out;-moz-transition:all 0.2s ease-out;-o-transition:all 0.2s ease-out;-ms-transition:all 0.2s ease-out}.tp-caption a:hover{color:#ffa902}
    </style>
    <style id='woocommerce-inline-inline-css' type='text/css'>
        .woocommerce form .form-row .required {
            visibility: visible;
        }
    </style>


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
    <script type="text/javascript">
        var monsterinsights_frontend = {"js_events_tracking":"true","is_debug_mode":"false","download_extensions":"doc,exe,js,pdf,ppt,tgz,zip,xls","inbound_paths":"","home_url":"{{route('home')}}","track_download_as":"event","internal_label":"int","hash_tracking":"false"};
    </script>
    <script type="text/javascript" src="{{asset('plugins/google/analytics-frontend.min.js')}}?ver=7.3.2"></script>
    <script type="text/javascript" src="{{asset('includes/js/jquery/jquery.min.js')}}?ver=1.12.4"></script>
    <script type="text/javascript" src="{{asset('includes/js/jquery/jquery-migrate.min.js')}}?ver=1.4.1"></script>
    <script type="text/javascript" src="{{asset('plugins/jquery-blockui/jquery.blockUI.min.js')}}?ver=2.70"></script>
    <script type="text/javascript">
        var wc_add_to_cart_params = {!! json_encode([
            "ajax_url" => route('cart.add'),
            "wc_ajax_url" => route('cart.remove')."/?wc-ajax=%%endpoint%%",
            "i18n_view_cart" => "Ver Carrrinho",
            "cart_url" => route('cart'),
            "is_cart" => "",
            "cart_redirect_after_add" => "no",
            "csrf_token" => csrf_token()
        ]) !!};
    </script>
    <script type="text/javascript" src="{{asset('plugins/cart/js/add-to-cart.min.js')}}?ver=4.5.4"></script>
    <script type="text/javascript" src="{{asset('plugins/cart/js/avd-add-to-cart.js')}}?ver=5.6"></script>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="{{asset('themes/js/html5.min.js')}}?ver=4.4.2"></script>
    <![endif]-->
    <script type="text/javascript" src="{{asset('themes/js/device.min.js')}}?ver=4.4.2"></script>
    <link rel="shortcut icon" href="{{asset('themes/images/icons/favicon.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{asset('themes/images/icons/apple-touch-icon-152x152-precomposed.png')}}">
    <link rel="stylesheet" id="theme-css" href="{{asset('themes/css/home-1.css')}}?ver=1.0.0" type="text/css" media="all" />
    <script type="text/javascript">
        jQuery(document).ready(function() {
            var scrollMenu = function() {
                var scrollMenu = jQuery('.dropdown-scroll > .sub-menu-dropdown');

                scrollMenu.each(function() {
                    var $this = jQuery(this);
                    var innerContent = $this.find('> .container');

                    $this.on('mousemove', function(e) {
                        var parentOffset = $this.offset();
                        //or $(this).offset(); if you really just want the current element's offset
                        var relY = e.pageY - parentOffset.top;

                        var deltaHeight = innerContent.outerHeight() - $this.height();

                        if( deltaHeight < 0 ) return;

                        var percentY = relY / $this.height();

                        var margin = 0;

                        if( percentY <= 0 ) {
                            margin = 0;
                        } else if( percentY >= 1 ) {
                            margin = - deltaHeight;
                        } else {
                            margin = - percentY * deltaHeight;
                        }

                        margin = parseInt(margin);

                        innerContent.css({
                            'position': 'relative',
                            'top': margin
                        });
                    });
                });

            }

            setTimeout(function() {
                scrollMenu();
            }, 1000);

            scrollMenu();

            function lazyload(){
                var lazy = jQuery( '.basel-lasy-image' );

                lazy.each( function() {
                    var _this = jQuery( this ),
                        ImageSrc = _this.data( 'blazy-src' );

                    if ( !_this.parent().hasClass( 'blazy-image-loaded' ) ) {
                        _this.attr( 'src', ImageSrc );
                        _this.parent().addClass('blazy-image-loading');
                        _this.on('load', function() {
                            _this.parent().removeClass('blazy-image-loading');
                            _this.parent().addClass( 'blazy-image-loaded' );
                        })
                    }
                })

            }
            jQuery( document ).on( 'mouseenter mouseleave mousemove','.dropdown-scroll', function( e ) {
                lazyload();
            });

            var onePageMenuFix = function() {

                var scrollToRow = function(hash) {
                    var row = jQuery('#' + hash);

                    if( row.length < 1 ) return;

                    var position = row.offset().top;

                    jQuery('html, body').stop().animate({
                        scrollTop: position - basel_settings.one_page_menu_offset
                    }, 800, function() {
                        activeMenuItem(hash);
                    });
                };

                var activeMenuItem = function(hash) {
                    var itemHash;
                    jQuery('.onepage-link').each(function() {
                        itemHash = jQuery(this).find('> a').attr('href').split('#')[1];

                        if( itemHash == hash ) {
                            jQuery('.onepage-link').removeClass('current-menu-item');
                            jQuery(this).addClass('current-menu-item');
                        }

                    });
                };

                jQuery('body').on('click', '.onepage-link > a', function(e) {
                    var jQuerythis = jQuery(this),
                        hash = jQuerythis.attr('href').split('#')[1];

                    if( jQuery('#' + hash).length < 1 ) return;

                    e.preventDefault();

                    scrollToRow(hash);

                    // close mobile menu
                    jQuery('.basel-close-side').trigger('click');
                });

                if( jQuery('.onepage-link').length > 0 ) {
                    jQuery('.entry-content > .vc_section, .entry-content > .vc_row').waypoint(function () {
                        var hash = jQuery(this).attr('id');
                        activeMenuItem(hash);
                    }, { offset: 0 });

                    // jQuery('.onepage-link').removeClass('current-menu-item');


                    // URL contains hash
                    var locationHash = window.location.hash.split('#')[1];

                    if(window.location.hash.length > 1) {
                        setTimeout(function(){
                            scrollToRow(locationHash);
                        }, 500);
                    }

                }
            };
            onePageMenuFix();
        });
    </script>
    <noscript><style>.woocommerce-product-gallery{ opacity: 1 !important; }</style></noscript>
    <style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style>
    <!--[if lte IE 9]>
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/js_composer/css/vc_lte_ie9.min.css')}}" media="screen">
    <![endif]-->

    <script type="text/javascript">
        function setREVStartSize(e) {
            try {
                e.c = jQuery(e.c);
                var i = jQuery(window).width(),
                    t = 9999,
                    r = 0,
                    n = 0,
                    l = 0,
                    f = 0,
                    s = 0,
                    h = 0;
                if (e.responsiveLevels && (jQuery.each(e.responsiveLevels, function(e, f) {
                        f > i && (t = r = f, l = e), i > f && f > r && (r = f, n = e)
                    }), t > r && (l = n)), f = e.gridheight[l] || e.gridheight[0] || e.gridheight, s = e.gridwidth[l] || e.gridwidth[0] || e.gridwidth, h = i / s, h = h > 1 ? 1 : h, f = Math.round(h * f), "fullscreen" == e.sliderLayout) {
                    var u = (e.c.width(), jQuery(window).height());
                    if (void 0 != e.fullScreenOffsetContainer) {
                        var c = e.fullScreenOffsetContainer.split(",");
                        if (c) jQuery.each(c, function(e, i) {
                            u = jQuery(i).length > 0 ? u - jQuery(i).outerHeight(!0) : u
                        }), e.fullScreenOffset.split("%").length > 1 && void 0 != e.fullScreenOffset && e.fullScreenOffset.length > 0 ? u -= jQuery(window).height() * parseInt(e.fullScreenOffset, 0) / 100 : void 0 != e.fullScreenOffset && e.fullScreenOffset.length > 0 && (u -= parseInt(e.fullScreenOffset, 0))
                    }
                    f = u
                } else void 0 != e.minHeight && f < e.minHeight && (f = e.minHeight);
                e.c.closest(".rev_slider_wrapper").css({
                    height: f
                })
            } catch (d) {
                console.log("Failure at Presize of Slider:" + d)
            }
        };
    </script>

    <link rel="stylesheet" id="theme-css" href="{{asset('themes/css/theme-home-1.css')}}?ver=1.0.0" type="text/css" media="all" />
    <link rel="stylesheet" id="theme-css" href="{{asset('themes/css/theme.css')}}?ver=1.0.0" type="text/css" media="all" />
    <style type="text/css" data-type="vc_shortcodes-custom-css">.vc_custom_1477403044270{margin-top: -40px !important;margin-bottom: 10vh !important;}.vc_custom_1477929174010{margin-bottom: 5vh !important;}.vc_custom_1477937331390{margin-bottom: 5vh !important;padding-top: 50px !important;padding-bottom: 50px !important;background-color: #f9f9f9 !important;}.vc_custom_1477552018282{margin-bottom: 0px !important;padding-top: 20px !important;}.vc_custom_1477943846123{margin-top: 0px !important;margin-bottom: 10px !important;}.vc_custom_1477937509795{margin-bottom: 8vh !important;padding-top: 50px !important;padding-bottom: 50px !important;background-color: #f9f9f9 !important;}.vc_custom_1477937519143{margin-bottom: 8vh !important;}.vc_custom_1477735778599{margin-bottom: -40px !important;padding-top: 0px !important;padding-bottom: 0px !important;background-color: #f9f9f9 !important;}.vc_custom_1488187477623{margin-bottom: 60px !important;padding-left: 120px !important;background-image: url(https://demo.xtemos.com/basel/wp-content/uploads/2015/08/market-category-1.png?id=25263) !important;background-position: 0 0 !important;background-repeat: no-repeat !important;}.vc_custom_1488187533752{margin-bottom: 60px !important;padding-left: 120px !important;background-image: url(https://demo.xtemos.com/basel/wp-content/uploads/2015/08/market-category-4.png?id=25266) !important;background-position: 0 0 !important;background-repeat: no-repeat !important;}.vc_custom_1488187489197{margin-bottom: 60px !important;padding-left: 120px !important;background-image: url(https://demo.xtemos.com/basel/wp-content/uploads/2015/08/market-category-2.png?id=25264) !important;background-position: 0 0 !important;background-repeat: no-repeat !important;}.vc_custom_1488187522669{margin-bottom: 60px !important;padding-left: 120px !important;background-image: url(https://demo.xtemos.com/basel/wp-content/uploads/2015/08/market-category-5.png?id=25267) !important;background-position: 0 0 !important;background-repeat: no-repeat !important;}.vc_custom_1488187501809{margin-bottom: 60px !important;padding-left: 120px !important;background-image: url(https://demo.xtemos.com/basel/wp-content/uploads/2015/08/market-category-3.png?id=25265) !important;background-position: 0 0 !important;background-repeat: no-repeat !important;}.vc_custom_1488187511503{margin-bottom: 60px !important;padding-left: 120px !important;background-image: url(https://demo.xtemos.com/basel/wp-content/uploads/2015/08/market-category-6.png?id=25268) !important;background-position: 0 0 !important;background-repeat: no-repeat !important;}.vc_custom_1477735786181{border-right-width: 1px !important;padding-top: 40px !important;padding-bottom: 40px !important;border-right-color: #e0e0e0 !important;border-right-style: solid !important;}.vc_custom_1477735838426{border-right-width: 1px !important;padding-top: 40px !important;padding-bottom: 40px !important;border-right-color: #e0e0e0 !important;border-right-style: solid !important;}.vc_custom_1477735857513{border-right-width: 1px !important;padding-top: 40px !important;padding-bottom: 40px !important;border-right-color: #e0e0e0 !important;border-right-style: solid !important;}.vc_custom_1477735910971{padding-top: 40px !important;padding-bottom: 40px !important;}</style>
    <noscript><style type="text/css"> .wpb_animate_when_almost_visible { opacity: 1; }</style></noscript>
</head>

<body class="page-template-default page page-id-25099 logged-in woocommerce-no-js wrapper-full-width global-cart-design-1 global-search-full-screen global-header-simple mobile-nav-from-left basel-light catalog-mode-off categories-accordion-on global-wishlist-enable basel-top-bar-on basel-ajax-shop-on basel-ajax-search-on enable-sticky-header sticky-header-clone offcanvas-sidebar-mobile offcanvas-sidebar-tablet wpb-js-composer js-comp-ver-5.6 vc_responsive">

@include('headers.navs.mobile-nav-1')


@include('headers.columns.cart-right-1')

<div class="website-wrapper">


    @include('headers.tops.top-1')

<!--END TOP HEADER-->

    <!-- HEADER -->
    <header class="main-header header-has-no-bg header-simple icons-design-line color-scheme-dark">

        <div class="container">
            <div class="wrapp-header">
                <div class="site-logo">
                    <div class="basel-logo-wrap">
                        <a href="https://demo.xtemos.com/basel/" class="basel-logo basel-main-logo" rel="home">
                            <img src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/logo-basel.svg" alt="Basel" /> </a>
                    </div>
                </div>
                <div class="main-nav site-navigation basel-navigation menu-center" role="navigation">
                    <div class="menu-main-navigation-container">
                        <ul id="menu-main-navigation" class="menu">
                            <li id="menu-item-19422" class="dropdown-scroll menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-19422 menu-item-design-sized item-event-hover menu-item-has-children"><a href="https://demo.xtemos.com/basel/">Home</a>
                                <div class="sub-menu-dropdown color-scheme-dark">

                                    <div class="container">
                                        <div class="vc_row wpb_row vc_row-fluid col-five vc_custom_1475533876817">
                                            <div class="wpb_column vc_column_container vc_col-sm-2 color-scheme-dark">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1487879314225">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/"><strong><span style="color: #1aada3;">1.</span> HOME DEFAULT</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1511344750662">
                                                            <a href="https://demo.xtemos.com/basel/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/prev-main.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1487879330860">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/furniture/"><strong><span style="color: #1aada3;">2.</span> Furniture store</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1487879340170">
                                                            <a href="https://demo.xtemos.com/basel/furniture/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/prev-furniture.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1521125735460">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-fashion-new/"><strong><span style="color: #1aada3;">3.</span> Fashion 4.0</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1521125450949">
                                                            <a href="https://demo.xtemos.com/basel/home-fashion-new/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2017/11/basel-fashion-new-preview.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1497366060747">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-beer"><strong><span style="color: #1aada3;">4.</span> Beer</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1497366048454">
                                                            <a href="https://demo.xtemos.com/basel/home-beer" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/beer-preview.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1505233042256">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-fashion-flat/"><strong><span style="color: #1aada3;">5.</span> Fashion Flat</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1484179872282">
                                                            <a href="https://demo.xtemos.com/basel/home-fashion-flat/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/fashion-flat.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="vc_row wpb_row vc_row-fluid col-five vc_custom_1476734232282">
                                            <div class="wpb_column vc_column_container vc_col-sm-2 color-scheme-dark">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1505233031603">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-sushi/"><strong><span style="color: #1aada3;">6. </span>Sushi</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1494340426796">
                                                            <a href="https://demo.xtemos.com/basel/home-sushi/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/prev-sushi.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1505232776768">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-medical"><strong><span style="color: #1aada3;">7.</span> Medical</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1502548857766">
                                                            <a href="https://demo.xtemos.com/basel/home-medical" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/prev-medical.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1505232782803">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-lingerie/"><strong><span style="color: #1aada3;">8.</span> Lingerie store</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1484179846825">
                                                            <a href="https://demo.xtemos.com/basel/home-lingerie/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/menu-lingerie.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1505232788620">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-electronics/"><strong><span style="color: #1aada3;">9.</span> Electronics</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1484179850350">
                                                            <a href="https://demo.xtemos.com/basel/home-electronics/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/menu-electronics.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1507713220973">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-bakery"><strong><span style="color: #1aada3;">10.</span> Bakery</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1505227180245">
                                                            <a href="https://demo.xtemos.com/basel/home-bakery" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/bakery-preview.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-2 vc_hidden-lg vc_hidden-md vc_hidden-sm vc_hidden-xs">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="vc_row wpb_row vc_row-fluid col-five vc_custom_1476734429377">
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1505232761917">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-organic/"><strong><span style="color: #1aada3;">11.</span> Organic shop</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1484179875277">
                                                            <a href="https://demo.xtemos.com/basel/home-organic/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/menu-organic.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-2 color-scheme-dark">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1489510829487">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-cosmetics/"><strong><span style="color: #1aada3;">12.</span> Cosmetics</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1484179853637">
                                                            <a href="https://demo.xtemos.com/basel/home-cosmetics/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/menu-cosmetics.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1489510835078">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-wine/"><strong><span style="color: #1aada3;">13.</span> Wine store</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1484179833512">
                                                            <a href="https://demo.xtemos.com/basel/home-wine/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/menu-wine.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1489510842527">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-food/"><strong><span style="color: #1aada3;">14.</span> Food</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1484179856919">
                                                            <a href="https://demo.xtemos.com/basel/home-food/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/food-menu.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1507713414438">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-hookahs"><strong><span style="color: #1aada3;">15.</span> Hookahs</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1491314522805">
                                                            <a href="https://demo.xtemos.com/basel/home-hookahs" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/hookahs-posters.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="vc_row wpb_row vc_row-fluid col-five vc_custom_1480368580966">
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1489510853614">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-sport/"><strong><span style="color: #1aada3;">16.</span> SPORT SHOP</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1484179839315">
                                                            <a href="https://demo.xtemos.com/basel/home-sport/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/Home-sport-–-Xtemos-New.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-2 color-scheme-dark">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1489510858878">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-shoes"><strong><span style="color: #1aada3;">17.</span> Shoes store</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1484179842827">
                                                            <a href="https://demo.xtemos.com/basel/home-shoes" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/menu-shoes.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1489510865027">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-flat-full-width/"><strong><span style="color: #1aada3;">18.</span> Flat full-width</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1484179836454">
                                                            <a href="https://demo.xtemos.com/basel/home-flat-full-width/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/menu-1.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1507713407333">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-dark"><strong><span style="color: #1aada3;">19.</span> Dark version</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1487879356791">
                                                            <a href="https://demo.xtemos.com/basel/home-dark" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/menu-dark.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1505227232397">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-cars/"><strong><span style="color: #1aada3;">20.</span> Cars</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1484596614922">
                                                            <a href="https://demo.xtemos.com/basel/home-cars/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/menu-cars.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="vc_row wpb_row vc_row-fluid col-five vc_custom_1481570312586">
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1489511338136">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-coffee/"><strong><span style="color: #1aada3;">21.</span> Coffee</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1484179820702">
                                                            <a href="https://demo.xtemos.com/basel/home-coffee/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/menu-3.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1489511350239">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-parallax/"><strong><span style="color: #1aada3;">22.</span> Parallax</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1487879596250">
                                                            <a href="https://demo.xtemos.com/basel/home-parallax/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/menu-parallax.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1507713397750">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-posters/"><strong><span style="color: #1aada3;">23.</span> Posters</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1489510676714">
                                                            <a href="https://demo.xtemos.com/basel/home-posters/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/prev-posters.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1489511361162">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-minimalist/"><strong><span style="color: #1aada3;">24.</span> Minimalist</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1484179804439">
                                                            <a href="https://demo.xtemos.com/basel/home-minimalist/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/menu-minimalist.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1505227238339">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-fashion/"><strong><span style="color: #1aada3;">25.</span> Fashion store</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1484179860005">
                                                            <a href="https://demo.xtemos.com/basel/home-fashion/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/prev-fashion.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="vc_row wpb_row vc_row-fluid col-five vc_custom_1480368595821">
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1489511373113">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-jewellery/"><strong><span style="color: #1aada3;">26.</span> Jewellery</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1484179827037">
                                                            <a href="https://demo.xtemos.com/basel/home-jewellery/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/jewellery-menu.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1489511379278">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-landing/"><strong><span style="color: #1aada3;">27.</span> LANDING</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1484179794109">
                                                            <a href="https://demo.xtemos.com/basel/home-landing/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/landing-menu.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1497366106021">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-games/"><strong><span style="color: #1aada3;">28.</span> Games</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1489510728211">
                                                            <a href="https://demo.xtemos.com/basel/home-games/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/prev-games.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1507713389638">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/hero-slider/"><strong><span style="color: #1aada3;">29.</span> HERO SLIDER</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1484179807695">
                                                            <a href="https://demo.xtemos.com/basel/hero-slider/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/prev-slider.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1505227244721">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-portfolio/"><strong><span style="color: #1aada3;">30.</span> Portfolio</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1484179817344">
                                                            <a href="https://demo.xtemos.com/basel/home-portfolio/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/menu-portfolio.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="vc_row wpb_row vc_row-fluid col-five vc_custom_1480368595821">
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1489511413562">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-flowers/"><strong><span style="color: #1aada3;">31.</span> Flowers</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1484179801241">
                                                            <a href="https://demo.xtemos.com/basel/home-flowers/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/prev-flovers.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1489511419135">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-corporate/"><strong><span style="color: #1aada3;">32.</span> CORPORATE</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1484179725983">
                                                            <a href="https://demo.xtemos.com/basel/home-corporate/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/corpo-menu.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1489511425520">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-agency/"><strong><span style="color: #1aada3;">33.</span> AGENCY</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1484179713487">
                                                            <a href="https://demo.xtemos.com/basel/home-agency/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/agency-menu.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1491314546352">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-construction/"><strong><span style="color: #1aada3;">34.</span> CONSTRUCTION</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1491314537651">
                                                            <a href="https://demo.xtemos.com/basel/home-construction/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/menu-construction.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1505227251234">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-marketplace/"><strong><span style="color: #1aada3;">35.</span> marketplace</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1484179810834">
                                                            <a href="https://demo.xtemos.com/basel/home-marketplace/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/market-menu.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="vc_row wpb_row vc_row-fluid col-five vc_custom_1480368595821">
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1497366123243">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-pets/"><strong><span style="color: #1aada3;">36.</span> Pets</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1489510578999">
                                                            <a href="https://demo.xtemos.com/basel/home-pets/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/prev-pets.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1505227279919">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-bicycle/"><strong><span style="color: #1aada3;">37.</span> Bicycle store</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1484179797854">
                                                            <a href="https://demo.xtemos.com/basel/home-bicycle/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/prev-bicicle.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1505227272499">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/?rtl"><strong><span style="color: #1aada3;">38.</span> RTL Ready</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1484179814135">
                                                            <a href="https://demo.xtemos.com/basel/?rtl" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/prev-main-rtl.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1507713381542">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/watch-demo/"><strong><span style="color: #1aada3;">39.</span> Watches</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1484179768332">
                                                            <a href="https://demo.xtemos.com/basel/watch-demo/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/prev-watch.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-2">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1521125357348">
                                                            <div class="wpb_wrapper">
                                                                <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-lighting/"><strong><span style="color: #1aada3;">40.</span> Lighting</strong></a></h5>

                                                            </div>
                                                        </div>
                                                        <div class="vc_custom_1507713512513">
                                                            <a href="https://demo.xtemos.com/basel/home-lighting/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/preview-lighting.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <style type="text/css" data-type="vc_shortcodes-custom-css">
                                            .vc_custom_1475533876817 {
                                                margin-bottom: 0px !important;
                                            }

                                            .vc_custom_1476734232282 {
                                                margin-bottom: 0px !important;
                                            }

                                            .vc_custom_1476734429377 {
                                                margin-bottom: 0px !important;
                                            }

                                            .vc_custom_1480368580966 {
                                                margin-bottom: 0px !important;
                                            }

                                            .vc_custom_1481570312586 {
                                                margin-bottom: 0px !important;
                                            }

                                            .vc_custom_1480368595821 {
                                                margin-bottom: 0px !important;
                                            }

                                            .vc_custom_1480368595821 {
                                                margin-bottom: 0px !important;
                                            }

                                            .vc_custom_1480368595821 {
                                                margin-bottom: 0px !important;
                                            }

                                            .vc_custom_1487879314225 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1511344750662 {
                                                margin-bottom: 35px !important;
                                            }

                                            .vc_custom_1487879330860 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1487879340170 {
                                                margin-bottom: 35px !important;
                                            }

                                            .vc_custom_1521125735460 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1521125450949 {
                                                margin-bottom: 35px !important;
                                            }

                                            .vc_custom_1497366060747 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1497366048454 {
                                                margin-bottom: 35px !important;
                                            }

                                            .vc_custom_1505233042256 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1484179872282 {
                                                margin-bottom: 35px !important;
                                            }

                                            .vc_custom_1505233031603 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1494340426796 {
                                                margin-bottom: 0px !important;
                                            }

                                            .vc_custom_1505232776768 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1502548857766 {
                                                margin-bottom: 35px !important;
                                            }

                                            .vc_custom_1505232782803 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1484179846825 {
                                                margin-bottom: 35px !important;
                                            }

                                            .vc_custom_1505232788620 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1484179850350 {
                                                margin-bottom: 35px !important;
                                                background-color: rgba(255, 255, 255, 0.1) !important;
                                                *background-color: rgb(255, 255, 255) !important;
                                            }

                                            .vc_custom_1507713220973 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1505227180245 {
                                                margin-bottom: 35px !important;
                                            }

                                            .vc_custom_1505232761917 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1484179875277 {
                                                margin-bottom: 35px !important;
                                            }

                                            .vc_custom_1489510829487 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1484179853637 {
                                                margin-bottom: 35px !important;
                                            }

                                            .vc_custom_1489510835078 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1484179833512 {
                                                margin-bottom: 35px !important;
                                            }

                                            .vc_custom_1489510842527 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1484179856919 {
                                                margin-bottom: 35px !important;
                                            }

                                            .vc_custom_1507713414438 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1491314522805 {
                                                margin-bottom: 35px !important;
                                            }

                                            .vc_custom_1489510853614 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1484179839315 {
                                                margin-bottom: 35px !important;
                                            }

                                            .vc_custom_1489510858878 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1484179842827 {
                                                margin-bottom: 35px !important;
                                            }

                                            .vc_custom_1489510865027 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1484179836454 {
                                                margin-bottom: 35px !important;
                                            }

                                            .vc_custom_1507713407333 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1487879356791 {
                                                margin-bottom: 35px !important;
                                            }

                                            .vc_custom_1505227232397 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1484596614922 {
                                                margin-bottom: 35px !important;
                                            }

                                            .vc_custom_1489511338136 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1484179820702 {
                                                margin-bottom: 35px !important;
                                            }

                                            .vc_custom_1489511350239 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1487879596250 {
                                                margin-bottom: 35px !important;
                                            }

                                            .vc_custom_1507713397750 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1489510676714 {
                                                margin-bottom: 35px !important;
                                            }

                                            .vc_custom_1489511361162 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1484179804439 {
                                                margin-bottom: 35px !important;
                                            }

                                            .vc_custom_1505227238339 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1484179860005 {
                                                margin-bottom: 35px !important;
                                            }

                                            .vc_custom_1489511373113 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1484179827037 {
                                                margin-bottom: 35px !important;
                                            }

                                            .vc_custom_1489511379278 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1484179794109 {
                                                margin-bottom: 35px !important;
                                            }

                                            .vc_custom_1497366106021 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1489510728211 {
                                                margin-bottom: 35px !important;
                                            }

                                            .vc_custom_1507713389638 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1484179807695 {
                                                margin-bottom: 35px !important;
                                            }

                                            .vc_custom_1505227244721 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1484179817344 {
                                                margin-bottom: 35px !important;
                                            }

                                            .vc_custom_1489511413562 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1484179801241 {
                                                margin-bottom: 35px !important;
                                            }

                                            .vc_custom_1489511419135 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1484179725983 {
                                                margin-bottom: 35px !important;
                                            }

                                            .vc_custom_1489511425520 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1484179713487 {
                                                margin-bottom: 35px !important;
                                            }

                                            .vc_custom_1491314546352 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1491314537651 {
                                                margin-bottom: 35px !important;
                                            }

                                            .vc_custom_1505227251234 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1484179810834 {
                                                margin-bottom: 35px !important;
                                            }

                                            .vc_custom_1497366123243 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1489510578999 {
                                                margin-bottom: 35px !important;
                                            }

                                            .vc_custom_1505227279919 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1484179797854 {
                                                margin-bottom: 35px !important;
                                            }

                                            .vc_custom_1505227272499 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1484179814135 {
                                                margin-bottom: 35px !important;
                                            }

                                            .vc_custom_1507713381542 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1484179768332 {
                                                margin-bottom: 0px !important;
                                            }

                                            .vc_custom_1521125357348 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1507713512513 {
                                                margin-bottom: 35px !important;
                                            }
                                        </style>
                                    </div>

                                </div>
                                <style type="text/css">
                                    .menu-item-19422 > .sub-menu-dropdown {
                                        min-height: 10px;
                                        width: 1125px;
                                    }
                                </style>
                            </li>
                            <li id="menu-item-19427" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-19427 menu-item-design-full-width item-event-hover item-with-label item-label-sale menu-item-has-children"><a href="https://demo.xtemos.com/basel/shop/">Shop<span class="menu-label menu-label-sale">Sale</span></a>
                                <div class="sub-menu-dropdown color-scheme-dark">

                                    <div class="container">
                                        <div class="vc_row wpb_row vc_row-fluid menu-shop-full-width vc_custom_1479204564519 vc_row-o-equal-height vc_row-o-content-top vc_row-flex">
                                            <div class="wpb_column has-border vc_column_container vc_col-sm-9 vc_col-has-fill">
                                                <div class="vc_column-inner vc_custom_1480366259560">
                                                    <div class="wpb_wrapper">
                                                        <div class="vc_row wpb_row vc_inner vc_row-fluid vc_custom_1474656058991">
                                                            <div class="wpb_column vc_column_container vc_col-sm-3">
                                                                <div class="vc_column-inner vc_custom_1446742142663">
                                                                    <div class="wpb_wrapper">
                                                                        <div class="wpb_text_column wpb_content_element vc_custom_1502700496580">
                                                                            <div class="wpb_wrapper">
                                                                                <ul class="sub-menu">
                                                                                    <li><a href="https://demo.xtemos.com/basel/product-category/woman/">Shop Styles</a>
                                                                                        <ul class="sub-sub-menu">
                                                                                            <li><a href="https://demo.xtemos.com/basel/shop/?shopmasonryalt">Masonry grid</a></li>
                                                                                            <li class="item-with-label item-label-new"><a href="https://demo.xtemos.com/basel/shop/?shop_alt">Alternative shop</a></li>
                                                                                            <li><a href="https://demo.xtemos.com/basel/shop/?shophover1">Default style</a></li>
                                                                                            <li><a href="https://demo.xtemos.com/basel/shop/?shophover2">Button on hover</a></li>
                                                                                            <li><a href="https://demo.xtemos.com/basel/shop/?shophover3">Button hover alt</a></li>
                                                                                            <li><a href="https://demo.xtemos.com/basel/shop/?shophover4">Hover info</a></li>
                                                                                            <li><a href="https://demo.xtemos.com/basel/shop/?shophover6">Standard button</a></li>
                                                                                            <li class="item-with-label item-label-new"><a href="https://demo.xtemos.com/basel/shop/?shophover8">Quick shop products <span class="menu-label menu-label-new">NEW</span></a></li>
                                                                                            <li class="item-with-label item-label-hot"><a href="https://demo.xtemos.com/basel/shop/?list_view">Grid/List switcher <span class="menu-label menu-label-hot">HOT</span></a></li>
                                                                                        </ul>
                                                                                    </li>
                                                                                </ul>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="wpb_column vc_column_container vc_col-sm-3">
                                                                <div class="vc_column-inner vc_custom_1446742137800">
                                                                    <div class="wpb_wrapper">
                                                                        <div class="wpb_text_column wpb_content_element vc_custom_1475612615663">
                                                                            <div class="wpb_wrapper">
                                                                                <ul class="sub-menu">
                                                                                    <li><a href="https://demo.xtemos.com/basel/shop/woman/jur-detail-jacket/">Product Pages</a>
                                                                                        <ul class="sub-sub-menu">
                                                                                            <li class="item-with-label"><a href="https://demo.xtemos.com/basel/shop/man/coloured-jacket-basic/">Default style</a></li>
                                                                                            <li class="item-with-label"><a href="https://demo.xtemos.com/basel/shop/man/coloured-jacket-basic/?productalt">Alternative style</a></li>
                                                                                            <li class="item-with-label item-label-new"><a href="https://demo.xtemos.com/basel/shop/other/new-brands/yomber-jacket-trim/">Compact <span class="menu-label menu-label-new">NEW</span></a></li>
                                                                                            <li class="item-with-label"><a href="https://demo.xtemos.com/basel/shop/woman/virror-detail-cape/?productsticky">Sticky details</a></li>
                                                                                            <li class="item-with-label item-label-hot"><a href="https://demo.xtemos.com/basel/shop/accessories/before-decaf-phone-case/">Extra content <span class="menu-label menu-label-hot">HOT</span></a></li>
                                                                                            <li class="item-with-label"><a href="https://demo.xtemos.com/basel/shop/accessories/bags/ethnic-jacquard-backpack/">Variations images</a></li>
                                                                                            <li class="item-with-label item-label-sale"><a href="https://demo.xtemos.com/basel/shop/accessories/bags/ethnic-jacquard-backpack/">Thumbnails left</a></li>
                                                                                            <li><a href="https://demo.xtemos.com/basel/shop/woman/jur-detail-jacket/?thumbsbottom">Thumbnails bottom</a></li>
                                                                                            <li><a href="https://demo.xtemos.com/basel/shop/woman/virror-detail-cape/?productbg">Product with background</a></li>
                                                                                        </ul>
                                                                                    </li>
                                                                                </ul>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="wpb_column vc_column_container vc_col-sm-3">
                                                                <div class="vc_column-inner vc_custom_1446742132151">
                                                                    <div class="wpb_wrapper">
                                                                        <div class="wpb_text_column wpb_content_element vc_custom_1502699626543">
                                                                            <div class="wpb_wrapper">
                                                                                <ul class="sub-menu">
                                                                                    <li><a href="https://demo.xtemos.com/basel/product-category/man/">Product Features</a>
                                                                                        <ul class="sub-sub-menu">
                                                                                            <li><a href="https://demo.xtemos.com/basel/shop/other/sport/y-adidas-ultra-boost/">360° product viewer</a></li>
                                                                                            <li><a href="http://demo.xtemos.com/basel/shop/woman/basic-knit-dress-chest/">Zoom image</a></li>
                                                                                            <li class="item-with-label item-label-new"><a href="https://demo.xtemos.com/basel/shop/accessories/before-decaf-phone-case/">With video</a></li>
                                                                                            <li><a href="https://demo.xtemos.com/basel/shop/woman/gthnic-detail-open-jacket/?imagelarge">Large Image</a></li>
                                                                                            <li class="item-with-label item-label-new"><a href="https://demo.xtemos.com/basel/shop/?infinit_scrolling">Infinit scrolling <span class="menu-label menu-label-new">NEW</span></a></li>
                                                                                            <li><a href="https://demo.xtemos.com/basel/shop/woman/basic-knit-dress-chest/">Variable Product</a></li>
                                                                                            <li><a href="https://demo.xtemos.com/basel/shop/jewellery/yeptum-ring-earrings/">Grouped Product</a></li>
                                                                                            <li><a href="https://demo.xtemos.com/basel/shop/other/flat-brands/yrum-parturt-egestas/">External Product</a></li>
                                                                                            <li><a href="https://demo.xtemos.com/basel/shop/bags/vintage-cinch-backpack/?prodright">Sidebar right</a></li>
                                                                                        </ul>
                                                                                    </li>
                                                                                </ul>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="wpb_column vc_column_container vc_col-sm-3">
                                                                <div class="vc_column-inner">
                                                                    <div class="wpb_wrapper">
                                                                        <div class="wpb_text_column wpb_content_element vc_custom_1502699113582">
                                                                            <div class="wpb_wrapper">
                                                                                <ul class="sub-menu">
                                                                                    <li><a href="https://demo.xtemos.com/basel/product-category/man/">Shop Pages</a>
                                                                                        <ul class="sub-sub-menu">
                                                                                            <li><a href="https://demo.xtemos.com/basel/shop/?shop2">2 Columns</a></li>
                                                                                            <li><a href="https://demo.xtemos.com/basel/shop/?shop3">3 Columns</a></li>
                                                                                            <li><a href="https://demo.xtemos.com/basel/shop/?shop4">4 Columns</a></li>
                                                                                            <li><a href="https://demo.xtemos.com/basel/shop/?shop6">6 Columns</a></li>
                                                                                            <li><a href="https://demo.xtemos.com/basel/shop/?shopleft">Sidebar Left</a></li>
                                                                                            <li><a href="https://demo.xtemos.com/basel/shop/?shopright">Sidebar Right</a></li>
                                                                                            <li><a href="https://demo.xtemos.com/basel/shop/?shopfullwidth">Full width</a></li>
                                                                                            <li><a href="https://demo.xtemos.com/basel/product-category/shoes/">Category banner</a></li>
                                                                                            <li class="item-with-label item-label-new"><a href="https://demo.xtemos.com/basel/shop/?rtl">RTL Shop page <span class="menu-label menu-label-new">NEW</span></a></li>
                                                                                        </ul>
                                                                                    </li>
                                                                                </ul>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="vc_row wpb_row vc_inner vc_row-fluid vc_custom_1474894251362">
                                                            <div class="wpb_column vc_column_container vc_col-sm-3">
                                                                <div class="vc_column-inner vc_custom_1474656302067">
                                                                    <div class="wpb_wrapper">
                                                                        <div class="wpb_text_column wpb_content_element vc_custom_1479204795229 has-border">
                                                                            <div class="wpb_wrapper">
                                                                                <h5 style="text-transform: uppercase; font-weight: bold; margin-bottom: 5px;"><i class="fa fa-truck" style="margin-right: 7px; font-size: 14px;"></i>Free Shipping</h5>
                                                                                <p>Free for $50+ orders</p>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="wpb_column vc_column_container vc_col-sm-3">
                                                                <div class="vc_column-inner vc_custom_1474656297012">
                                                                    <div class="wpb_wrapper">
                                                                        <div class="wpb_text_column wpb_content_element vc_custom_1479204799674 has-border">
                                                                            <div class="wpb_wrapper">
                                                                                <h5 style="text-transform: uppercase; font-weight: bold; margin-bottom: 5px;"><i class="fa fa-phone" style="margin-right: 7px; font-size: 14px;"></i>Buyer Support</h5>
                                                                                <p>Get in touch 24/7</p>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="wpb_column vc_column_container vc_col-sm-3">
                                                                <div class="vc_column-inner vc_custom_1474656291867">
                                                                    <div class="wpb_wrapper">
                                                                        <div class="wpb_text_column wpb_content_element vc_custom_1479204804099 has-border">
                                                                            <div class="wpb_wrapper">
                                                                                <h5 style="text-transform: uppercase; font-weight: bold; margin-bottom: 5px;"><i class="fa fa-support" style="margin-right: 7px; font-size: 14px;"></i>Total Security</h5>
                                                                                <p>Secure checkout</p>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="wpb_column vc_column_container vc_col-sm-3">
                                                                <div class="vc_column-inner vc_custom_1474656282948">
                                                                    <div class="wpb_wrapper">
                                                                        <div class="wpb_text_column wpb_content_element vc_custom_1479204808986 has-border">
                                                                            <div class="wpb_wrapper">
                                                                                <h5 style="text-transform: uppercase; font-weight: bold; margin-bottom: 5px;"><i class="fa fa-reply" style="margin-right: 7px; font-size: 14px;"></i>RETURN POLICY</h5>
                                                                                <p>14 days ago</p>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column hide-pag vc_column_container vc_col-sm-3 color-scheme-dark">
                                                <div class="vc_column-inner vc_custom_1475581999943">
                                                    <div class="wpb_wrapper">
                                                        <div id="carousel-790" class="vc_carousel_container " data-owl-carousel data-hide_pagination_control="yes" data-hide_prev_next_buttons="yes" data-desktop="1" data-desktop_small="1" data-tablet="1" data-mobile="2">
                                                            <div class="owl-carousel product-items ">

                                                                <div class="product-item owl-carousel-item">
                                                                    <div class="owl-carousel-item-inner">

                                                                        <div class="product-grid-item basel-hover-quick product product-in-carousel post-24254 type-product status-publish has-post-thumbnail product_cat-flat-brands first instock shipping-taxable purchasable product-type-variable has-default-attributes" data-loop="1" data-id="24254">

                                                                            <div class="product-element-top">
                                                                                <a href="https://demo.xtemos.com/basel/shop/other/flat-brands/ybuum-natoq-partnt/">
                                                                                    <img width="273" height="348" src="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-526x671.jpg 526w" sizes="(max-width: 273px) 100vw, 273px" /> </a>
                                                                                <div class="hover-img">
                                                                                    <a href="https://demo.xtemos.com/basel/shop/other/flat-brands/ybuum-natoq-partnt/">
                                                                                        <img width="273" height="348" src="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-2.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-2.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-2-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-2-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-2-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-2-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-2-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-2-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-2-526x671.jpg 526w" sizes="(max-width: 273px) 100vw, 273px" /> </a>
                                                                                </div>
                                                                                <div class="basel-buttons">

                                                                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-24254">
                                                                                        <div class="yith-wcwl-add-button show" style="display:block">

                                                                                            <a href="/basel/home-marketplace/?add_to_wishlist=24254" rel="nofollow" data-product-id="24254" data-product-type="variable" class="add_to_wishlist">
                                                                                                Add to Wishlist</a>
                                                                                            <img src="https://demo.xtemos.com/basel/wp-content/plugins/yith-woocommerce-wishlist/assets/images/wpspin_light.gif" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" />
                                                                                        </div>

                                                                                        <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;">
                                                                                            <span class="feedback">Product added!</span>
                                                                                            <a href="https://demo.xtemos.com/basel/wishlist/" rel="nofollow">
                                                                                                Browse Wishlist	        </a>
                                                                                        </div>

                                                                                        <div class="yith-wcwl-wishlistexistsbrowse hide" style="display:none">
                                                                                            <span class="feedback">The product is already in the wishlist!</span>
                                                                                            <a href="https://demo.xtemos.com/basel/wishlist/" rel="nofollow">
                                                                                                Browse Wishlist	        </a>
                                                                                        </div>

                                                                                        <div style="clear:both"></div>
                                                                                        <div class="yith-wcwl-wishlistaddresponse"></div>

                                                                                    </div>

                                                                                    <div class="clear"></div>
                                                                                    <div class="basel-compare-btn product-compare-button"><a class="button" href="https://demo.xtemos.com/basel/compare/" data-added-text="Compare products" data-id="24254">Compare</a></div>
                                                                                    <div class="quick-view">
                                                                                        <a href="https://demo.xtemos.com/basel/shop/other/flat-brands/ybuum-natoq-partnt/" class="open-quick-view" data-id="24254">Quick View</a>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="quick-shop-wrapper">
                                                                                    <div class="quick-shop-close"><span>Close</span></div>
                                                                                    <div class="quick-shop-btn">
                                                                                        <a href="#" class="btn-quick-shop" data-id="24254"><span>Quick shop</span></a>
                                                                                    </div>
                                                                                    <div class="quick-shop-form">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="swatches-wrapper">
                                                                                <div class="swatches-on-grid">
                                                                                    <div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-" style="background-color:#eded55;" data-image-src="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7.jpg" data-image-srcset="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-526x671.jpg 526w" data-image-sizes="(max-width: 870px) 100vw, 870px">Yellow</div>
                                                                                    <div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-" style="background-color:#61a058;" data-image-src="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7.jpg" data-image-srcset="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-526x671.jpg 526w" data-image-sizes="(max-width: 870px) 100vw, 870px">Green</div>
                                                                                    <div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-" style="background-color:#769ec1;" data-image-src="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7.jpg" data-image-srcset="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-526x671.jpg 526w" data-image-sizes="(max-width: 870px) 100vw, 870px">Blue</div>
                                                                                </div>
                                                                            </div>
                                                                            <h3 class="product-title"><a href="https://demo.xtemos.com/basel/shop/other/flat-brands/ybuum-natoq-partnt/">Ybuum natoq partnt</a></h3>

                                                                            <span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&pound;</span>572.00</span>
                                                                                </span>

                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="product-item owl-carousel-item">
                                                                    <div class="owl-carousel-item-inner">

                                                                        <div class="product-grid-item basel-hover-quick product product-in-carousel post-24253 type-product status-publish has-post-thumbnail product_cat-flat-brands instock sale shipping-taxable purchasable product-type-variable has-default-attributes" data-loop="2" data-id="24253">

                                                                            <div class="product-element-top">
                                                                                <a href="https://demo.xtemos.com/basel/shop/other/flat-brands/yam-orci-lacinia/">
                                                                                    <div class="product-labels labels-rounded"><span class="onsale product-label">-28%</span></div><img width="273" height="348" src="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-526x671.jpg 526w" sizes="(max-width: 273px) 100vw, 273px" /> </a>
                                                                                <div class="hover-img">
                                                                                    <a href="https://demo.xtemos.com/basel/shop/other/flat-brands/yam-orci-lacinia/">
                                                                                        <img width="273" height="348" src="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-2.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-2.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-2-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-2-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-2-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-2-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-2-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-2-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-2-526x671.jpg 526w" sizes="(max-width: 273px) 100vw, 273px" /> </a>
                                                                                </div>
                                                                                <div class="basel-buttons">

                                                                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-24253">
                                                                                        <div class="yith-wcwl-add-button show" style="display:block">

                                                                                            <a href="/basel/home-marketplace/?add_to_wishlist=24253" rel="nofollow" data-product-id="24253" data-product-type="variable" class="add_to_wishlist">
                                                                                                Add to Wishlist</a>
                                                                                            <img src="https://demo.xtemos.com/basel/wp-content/plugins/yith-woocommerce-wishlist/assets/images/wpspin_light.gif" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" />
                                                                                        </div>

                                                                                        <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;">
                                                                                            <span class="feedback">Product added!</span>
                                                                                            <a href="https://demo.xtemos.com/basel/wishlist/" rel="nofollow">
                                                                                                Browse Wishlist	        </a>
                                                                                        </div>

                                                                                        <div class="yith-wcwl-wishlistexistsbrowse hide" style="display:none">
                                                                                            <span class="feedback">The product is already in the wishlist!</span>
                                                                                            <a href="https://demo.xtemos.com/basel/wishlist/" rel="nofollow">
                                                                                                Browse Wishlist	        </a>
                                                                                        </div>

                                                                                        <div style="clear:both"></div>
                                                                                        <div class="yith-wcwl-wishlistaddresponse"></div>

                                                                                    </div>

                                                                                    <div class="clear"></div>
                                                                                    <div class="basel-compare-btn product-compare-button"><a class="button" href="https://demo.xtemos.com/basel/compare/" data-added-text="Compare products" data-id="24253">Compare</a></div>
                                                                                    <div class="quick-view">
                                                                                        <a href="https://demo.xtemos.com/basel/shop/other/flat-brands/yam-orci-lacinia/" class="open-quick-view" data-id="24253">Quick View</a>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="quick-shop-wrapper">
                                                                                    <div class="quick-shop-close"><span>Close</span></div>
                                                                                    <div class="quick-shop-btn">
                                                                                        <a href="#" class="btn-quick-shop" data-id="24253"><span>Quick shop</span></a>
                                                                                    </div>
                                                                                    <div class="quick-shop-form">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="swatches-wrapper">
                                                                                <div class="swatches-on-grid">
                                                                                    <div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-" style="background-color:#eded55;" data-image-src="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2.jpg" data-image-srcset="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-526x671.jpg 526w" data-image-sizes="(max-width: 870px) 100vw, 870px">Yellow</div>
                                                                                    <div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-" style="background-color:#dd3333;" data-image-src="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2.jpg" data-image-srcset="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-526x671.jpg 526w" data-image-sizes="(max-width: 870px) 100vw, 870px">Red</div>
                                                                                    <div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-" style="background-color:#769ec1;" data-image-src="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2.jpg" data-image-srcset="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-526x671.jpg 526w" data-image-sizes="(max-width: 870px) 100vw, 870px">Blue</div>
                                                                                </div>
                                                                            </div>
                                                                            <h3 class="product-title"><a href="https://demo.xtemos.com/basel/shop/other/flat-brands/yam-orci-lacinia/">Yom orci lacinia</a></h3>

                                                                            <span class="price"><del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&pound;</span>799.00</span>
                                                                                </del> <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&pound;</span>572.00</span></ins></span>

                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="product-item owl-carousel-item">
                                                                    <div class="owl-carousel-item-inner">

                                                                        <div class="product-grid-item basel-hover-quick product product-in-carousel post-24246 type-product status-publish has-post-thumbnail product_cat-flat-brands instock shipping-taxable purchasable product-type-variable has-default-attributes" data-loop="3" data-id="24246">

                                                                            <div class="product-element-top">
                                                                                <a href="https://demo.xtemos.com/basel/shop/other/flat-brands/yus-condntum-sapien/">
                                                                                    <img width="273" height="348" src="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-526x671.jpg 526w" sizes="(max-width: 273px) 100vw, 273px" /> </a>
                                                                                <div class="hover-img">
                                                                                    <a href="https://demo.xtemos.com/basel/shop/other/flat-brands/yus-condntum-sapien/">
                                                                                        <img width="273" height="348" src="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-2.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-2.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-2-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-2-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-2-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-2-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-2-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-2-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-2-526x671.jpg 526w" sizes="(max-width: 273px) 100vw, 273px" /> </a>
                                                                                </div>
                                                                                <div class="basel-buttons">

                                                                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-24246">
                                                                                        <div class="yith-wcwl-add-button show" style="display:block">

                                                                                            <a href="/basel/home-marketplace/?add_to_wishlist=24246" rel="nofollow" data-product-id="24246" data-product-type="variable" class="add_to_wishlist">
                                                                                                Add to Wishlist</a>
                                                                                            <img src="https://demo.xtemos.com/basel/wp-content/plugins/yith-woocommerce-wishlist/assets/images/wpspin_light.gif" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" />
                                                                                        </div>

                                                                                        <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;">
                                                                                            <span class="feedback">Product added!</span>
                                                                                            <a href="https://demo.xtemos.com/basel/wishlist/" rel="nofollow">
                                                                                                Browse Wishlist	        </a>
                                                                                        </div>

                                                                                        <div class="yith-wcwl-wishlistexistsbrowse hide" style="display:none">
                                                                                            <span class="feedback">The product is already in the wishlist!</span>
                                                                                            <a href="https://demo.xtemos.com/basel/wishlist/" rel="nofollow">
                                                                                                Browse Wishlist	        </a>
                                                                                        </div>

                                                                                        <div style="clear:both"></div>
                                                                                        <div class="yith-wcwl-wishlistaddresponse"></div>

                                                                                    </div>

                                                                                    <div class="clear"></div>
                                                                                    <div class="basel-compare-btn product-compare-button"><a class="button" href="https://demo.xtemos.com/basel/compare/" data-added-text="Compare products" data-id="24246">Compare</a></div>
                                                                                    <div class="quick-view">
                                                                                        <a href="https://demo.xtemos.com/basel/shop/other/flat-brands/yus-condntum-sapien/" class="open-quick-view" data-id="24246">Quick View</a>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="quick-shop-wrapper">
                                                                                    <div class="quick-shop-close"><span>Close</span></div>
                                                                                    <div class="quick-shop-btn">
                                                                                        <a href="#" class="btn-quick-shop" data-id="24246"><span>Quick shop</span></a>
                                                                                    </div>
                                                                                    <div class="quick-shop-form">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="swatches-wrapper">
                                                                                <div class="swatches-on-grid">
                                                                                    <div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-" style="background-color:#eded55;" data-image-src="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6.jpg" data-image-srcset="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-526x671.jpg 526w" data-image-sizes="(max-width: 870px) 100vw, 870px">Yellow</div>
                                                                                    <div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-" style="background-color:#dd3333;" data-image-src="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6.jpg" data-image-srcset="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-526x671.jpg 526w" data-image-sizes="(max-width: 870px) 100vw, 870px">Red</div>
                                                                                    <div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-" style="background-color:#769ec1;" data-image-src="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6.jpg" data-image-srcset="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-526x671.jpg 526w" data-image-sizes="(max-width: 870px) 100vw, 870px">Blue</div>
                                                                                </div>
                                                                            </div>
                                                                            <h3 class="product-title"><a href="https://demo.xtemos.com/basel/shop/other/flat-brands/yus-condntum-sapien/">Yus condntum sapien</a></h3>

                                                                            <span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&pound;</span>572.00</span>
                                                                                </span>

                                                                        </div>

                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <!-- end product-items -->
                                                        </div>
                                                        <!-- end #carousel-790 -->

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <style type="text/css" data-type="vc_shortcodes-custom-css">
                                            .vc_custom_1479204564519 {
                                                margin-bottom: 30px !important;
                                                padding-top: 0px !important;
                                                padding-bottom: 0px !important;
                                            }

                                            .vc_custom_1480366259560 {
                                                border-right-width: 1px !important;
                                                padding-top: 0px !important;
                                                padding-right: 0px !important;
                                                padding-bottom: 0px !important;
                                                border-right-color: #eaeaea !important;
                                                border-right-style: solid !important;
                                            }

                                            .vc_custom_1475581999943 {
                                                margin-bottom: 0px !important;
                                                padding-right: 20px !important;
                                                padding-left: 20px !important;
                                            }

                                            .vc_custom_1474656058991 {
                                                margin-top: 0px !important;
                                                margin-bottom: 0px !important;
                                                padding-top: 0px !important;
                                            }

                                            .vc_custom_1474894251362 {
                                                margin-bottom: 0px !important;
                                            }

                                            .vc_custom_1446742142663 {
                                                margin-bottom: 0px !important;
                                            }

                                            .vc_custom_1446742137800 {
                                                margin-bottom: 0px !important;
                                            }

                                            .vc_custom_1446742132151 {
                                                margin-bottom: 0px !important;
                                            }

                                            .vc_custom_1502700496580 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1475612615663 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1502699626543 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1502699113582 {
                                                margin-bottom: 10px !important;
                                            }

                                            .vc_custom_1474656302067 {
                                                margin-bottom: 0px !important;
                                            }

                                            .vc_custom_1474656297012 {
                                                margin-bottom: 0px !important;
                                            }

                                            .vc_custom_1474656291867 {
                                                margin-bottom: 0px !important;
                                            }

                                            .vc_custom_1474656282948 {
                                                margin-bottom: 0px !important;
                                            }

                                            .vc_custom_1479204795229 {
                                                margin-bottom: 0px !important;
                                                border-right-width: 1px !important;
                                                border-right-color: #e0e0e0 !important;
                                                border-right-style: solid !important;
                                            }

                                            .vc_custom_1479204799674 {
                                                margin-bottom: 0px !important;
                                                border-right-width: 1px !important;
                                                border-right-color: #e0e0e0 !important;
                                                border-right-style: solid !important;
                                            }

                                            .vc_custom_1479204804099 {
                                                margin-bottom: 0px !important;
                                                border-right-width: 1px !important;
                                                border-right-color: #e0e0e0 !important;
                                                border-right-style: solid !important;
                                            }

                                            .vc_custom_1479204808986 {
                                                margin-bottom: 0px !important;
                                            }
                                        </style>
                                    </div>

                                </div>
                            </li>
                            <li id="menu-item-22135" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-22135 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/category/lifestyle/">Blog</a>
                                <div class="sub-menu-dropdown color-scheme-dark">

                                    <div class="container">

                                        <ul class="sub-menu color-scheme-dark">
                                            <li id="menu-item-19908" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-19908 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/category/lifestyle/?blog1">Blog Default</a></li>
                                            <li id="menu-item-20121" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-20121 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/category/lifestyle/?blog2">Alternative Style</a></li>
                                            <li id="menu-item-20122" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-20122 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/category/lifestyle/?blogfullwidth">Blog Full Width</a></li>
                                            <li id="menu-item-20123" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-20123 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/category/hobbies/?blog3">Small images</a></li>
                                            <li id="menu-item-20124" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-20124 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/category/hobbies/?blog4">Masonry Grid</a></li>
                                            <li id="menu-item-23824" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-23824 menu-item-design-default item-event-hover item-with-label item-label-hot"><a href="https://demo.xtemos.com/basel/category/hobbies/?blogmask">Blog mask<span class="menu-label menu-label-hot">Hot</span></a></li>
                                            <li id="menu-item-20125" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-20125 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/category/hobbies/?blogcol4">4 Columns</a></li>
                                            <li id="menu-item-20127" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-20127 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/posuere-at-mi-a-sem/">Blog Single Post</a></li>
                                            <li id="menu-item-25562" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-25562 menu-item-design-default item-event-hover item-with-label item-label-new"><a href="https://demo.xtemos.com/basel/category/lifestyle/?rtl">Blog RTL<span class="menu-label menu-label-new">New</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li id="menu-item-19904" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-19904 menu-item-design-sized item-event-hover menu-item-has-children"><a href="https://demo.xtemos.com/basel/contact-us-2/">Pages</a>
                                <div class="sub-menu-dropdown color-scheme-dark">

                                    <div class="container">
                                        <div class="vc_row wpb_row vc_row-fluid vc_custom_1447326536772">
                                            <div class="wpb_column vc_column_container vc_col-sm-3">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1457906267198">
                                                            <div class="wpb_wrapper">
                                                                <ul class="sub-menu">
                                                                    <li><a href="https://demo.xtemos.com/basel/faqs/">Pages</a>
                                                                        <ul class="sub-sub-menu">
                                                                            <li><a href="https://demo.xtemos.com/basel/faqs/">FaQs</a></li>
                                                                            <li><a href="https://demo.xtemos.com/basel/about-me/">About Me</a></li>
                                                                            <li><a href="https://demo.xtemos.com/basel/our-shop/">Our Shop</a></li>
                                                                            <li><a href="https://demo.xtemos.com/basel/our-service/">Our Service</a></li>
                                                                            <li><a href="https://demo.xtemos.com/basel/our-company/">Our Company</a></li>
                                                                            <li><a href="https://demo.xtemos.com/basel/contact-us-3/">Contact Us</a></li>
                                                                            <li><a href="https://demo.xtemos.com/basel/contact-us-2/">Contact Us 2</a></li>
                                                                            <li><a href="https://demo.xtemos.com/basel/our-gallery/">Our Gallery</a></li>
                                                                        </ul>
                                                                    </li>
                                                                </ul>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-3">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1483621673237">
                                                            <div class="wpb_wrapper">
                                                                <ul class="sub-menu">
                                                                    <li><a href="https://demo.xtemos.com/basel/?head1">Headers</a>
                                                                        <ul class="sub-sub-menu">
                                                                            <li><a href="https://demo.xtemos.com/basel/?head1">Header base</a></li>
                                                                            <li><a href="https://demo.xtemos.com/basel/?head2">Simplified</a></li>
                                                                            <li><a href="https://demo.xtemos.com/basel/?head3">With logo center</a></li>
                                                                            <li class="item-with-label item-label-hot"><a href="https://demo.xtemos.com/basel/furniture/">Categories menu <span class="menu-label menu-label-hot">HOT</span></a></li>
                                                                            <li><a href="https://demo.xtemos.com/basel/?head5">Top bar menu</a></li>
                                                                            <li><a href="https://demo.xtemos.com/basel/?head9">Split menu</a></li>
                                                                            <li><a href="https://demo.xtemos.com/basel/watch-demo/?head7">Dark header</a></li>
                                                                            <li class="item-with-label item-label-hot"><a href="https://demo.xtemos.com/basel/home-flowers/?head8">Colored header <span class="menu-label menu-label-hot">HOT</span></a></li>
                                                                        </ul>
                                                                    </li>
                                                                </ul>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-3">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1450200825017">
                                                            <div class="wpb_wrapper">
                                                                <ul class="sub-menu">
                                                                    <li><a href="https://demo.xtemos.com/basel/portfolio/">Portfolio</a>
                                                                        <ul class="sub-sub-menu">
                                                                            <li><a href="https://demo.xtemos.com/basel/portfolio/?projects4">Grid 4 Columns</a></li>
                                                                            <li><a href="https://demo.xtemos.com/basel/portfolio/?gridnospace">Grid No Space</a></li>
                                                                            <li><a href="https://demo.xtemos.com/basel/portfolio/?portfoliofullwidth">Grid full width</a></li>
                                                                            <li><a href="https://demo.xtemos.com/basel/portfolio/?portfolio4">Alternative style</a></li>
                                                                            <li><a href="https://demo.xtemos.com/basel/portfolio/?portfolio5">Grid with text</a></li>
                                                                            <li><a href="https://demo.xtemos.com/basel/portfolio/a-fusce-fringilla-scelerisque/">Single Project</a></li>
                                                                            <li><a href="https://demo.xtemos.com/basel/portfolio/mus-enim-ac-mus-mus/">Project Full Width</a></li>
                                                                            <li><a href="https://demo.xtemos.com/basel/portfolio/varius-tempor-arcu-sociosqu/">Project with video</a></li>
                                                                        </ul>
                                                                    </li>
                                                                </ul>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-3">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element vc_custom_1494340633560">
                                                            <div class="wpb_wrapper">
                                                                <ul class="sub-menu">
                                                                    <li><a href="https://demo.xtemos.com/basel/shop/">Shop</a>
                                                                        <ul class="sub-sub-menu">
                                                                            <li><a href="https://demo.xtemos.com/basel/cart/"><i class="fa fa-shopping-cart"></i>Shopping Cart</a></li>
                                                                            <li><a href="https://demo.xtemos.com/basel/checkout/"><i class="fa fa-credit-card"></i>Checkout</a></li>
                                                                            <li><a href="https://demo.xtemos.com/basel/my-account/"><i class="fa fa-user"></i>My Account</a></li>
                                                                            <li><a href="https://demo.xtemos.com/basel/wishlist/view/"><i class="fa fa-heart"></i>Wishlist</a></li>
                                                                            <li><a href="https://demo.xtemos.com/basel/track-order/">Track order</a></li>
                                                                            <li><a href="https://demo.xtemos.com/basel/404404">404 Not Found</a></li>
                                                                            <li><a href="https://demo.xtemos.com/basel/maintenance-page/">Maintenance mode</a></li>
                                                                            <li><a href="https://demo.xtemos.com/basel/maintenance-page-2-2/">Maintenance 2</a></li>
                                                                        </ul>
                                                                    </li>
                                                                </ul>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <style type="text/css" data-type="vc_shortcodes-custom-css">
                                            .vc_custom_1447326536772 {
                                                margin-bottom: -35px !important;
                                            }

                                            .vc_custom_1457906267198 {
                                                margin-bottom: 0px !important;
                                            }

                                            .vc_custom_1483621673237 {
                                                margin-bottom: 0px !important;
                                            }

                                            .vc_custom_1450200825017 {
                                                margin-bottom: 0px !important;
                                            }

                                            .vc_custom_1494340633560 {
                                                margin-bottom: 1px !important;
                                            }
                                        </style>
                                    </div>

                                </div>
                                <style type="text/css">
                                    .menu-item-19904 > .sub-menu-dropdown {
                                        min-height: 199px;
                                        width: 750px;
                                    }
                                </style>
                            </li>
                            <li id="menu-item-26107" class="hidden-nav-button menu-item menu-item-type-custom menu-item-object-custom menu-item-26107 menu-item-design-default item-event-hover callto-btn"><a href="https://themeforest.net/item/basel-responsive-ecommerce-theme/14906749?ref=xtemos">purchase</a></li>
                            <li id="menu-item-19907" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-19907 menu-item-design-sized item-event-hover"><a href="https://demo.xtemos.com/basel/features/">Features</a>
                                <style type="text/css">
                                    .menu-item-19907 > .sub-menu-dropdown {
                                        background-image: url(https://demo.xtemos.com/basel/wp-content/uploads/2015/11/menu-baner-1.jpg);
                                    }

                                    .menu-item-19907 > .sub-menu-dropdown {
                                        min-height: 100px;
                                        width: 1000px;
                                    }
                                </style>
                                <div class="sub-menu-dropdown color-scheme-dark">

                                    <div class="container">

                                        <ul class="sub-menu color-scheme-dark">
                                            <li id="menu-item-19913" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-19913 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/recent-products/">WooCommerce</a>
                                                <ul class="sub-sub-menu color-scheme-dark">
                                                    <li id="menu-item-19914" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-19914 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/recent-products/">Recent Products</a></li>
                                                    <li id="menu-item-19921" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-19921 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/featured-products/">Featured Products</a></li>
                                                    <li id="menu-item-22808" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22808 menu-item-design-default item-event-hover item-with-label item-label-hot"><a href="https://demo.xtemos.com/basel/element-products/">Element Products<span class="menu-label menu-label-hot">Hot</span></a></li>
                                                    <li id="menu-item-19924" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-19924 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/single-product/">Single Product</a></li>
                                                    <li id="menu-item-19929" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-19929 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/products-by-id/">Products by ID</a></li>
                                                    <li id="menu-item-19939" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-19939 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/products-category/">Products Category</a></li>
                                                    <li id="menu-item-19942" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-19942 menu-item-design-default item-event-hover item-with-label item-label-new"><a href="https://demo.xtemos.com/basel/products-categories/">Products Categories<span class="menu-label menu-label-new">New</span></a></li>
                                                    <li id="menu-item-19948" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-19948 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/sale-products/">Sale Products</a></li>
                                                    <li id="menu-item-19951" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-19951 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/top-rated/">Top Rated Products</a></li>
                                                    <li id="menu-item-26594" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-26594 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/products-widgets/">Products widgets</a></li>
                                                </ul>
                                            </li>
                                            <li id="menu-item-19956" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-19956 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/blog-element/">Xtemos Elements</a>
                                                <ul class="sub-sub-menu color-scheme-dark">
                                                    <li id="menu-item-19961" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-19961 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/google-maps/">Google Maps</a></li>
                                                    <li id="menu-item-20013" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-20013 menu-item-design-default item-event-hover item-with-label item-label-hot"><a href="https://demo.xtemos.com/basel/banners/">Banners<span class="menu-label menu-label-hot">Hot</span></a></li>
                                                    <li id="menu-item-20039" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-20039 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/titles/">Titles</a></li>
                                                    <li id="menu-item-20006" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-20006 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/instagram/">Instagram</a></li>
                                                    <li id="menu-item-19974" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-19974 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/social-buttons/">Social Buttons</a></li>
                                                    <li id="menu-item-19985" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-19985 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/team-member/">Team Member</a></li>
                                                    <li id="menu-item-27669" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-27669 menu-item-design-default item-event-hover item-with-label item-label-new"><a href="https://demo.xtemos.com/basel/section-dividers/">Section Dividers<span class="menu-label menu-label-new">New</span></a></li>
                                                    <li id="menu-item-19998" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-19998 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/testimonials/">Testimonials</a></li>
                                                    <li id="menu-item-19957" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-19957 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/blog-element/">Blog Element</a></li>
                                                    <li id="menu-item-27670" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-27670 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/gradients/">Gradients</a></li>
                                                </ul>
                                            </li>
                                            <li id="menu-item-24494" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-24494 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/infobox/">Xtemos Elements</a>
                                                <ul class="sub-sub-menu color-scheme-dark">
                                                    <li id="menu-item-24493" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-24493 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/24388-2/">Countdown timer</a></li>
                                                    <li id="menu-item-24495" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-24495 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/24324-2/">360 degree view</a></li>
                                                    <li id="menu-item-24496" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-24496 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/menu-price/">Menu price</a></li>
                                                    <li id="menu-item-24498" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-24498 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/infobox/">Infobox</a></li>
                                                    <li id="menu-item-24497" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-24497 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/24297-2/">Pricing tables</a></li>
                                                    <li id="menu-item-24514" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-24514 menu-item-design-default item-event-hover item-with-label item-label-hot"><a href="https://demo.xtemos.com/basel/product-ajax-arrows/">Product AJAX arrows<span class="menu-label menu-label-hot">Hot</span></a></li>
                                                    <li id="menu-item-24515" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-24515 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/product-load-more/">Product load more</a></li>
                                                    <li id="menu-item-24513" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-24513 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/portfolio-element/">Portfolio element</a></li>
                                                    <li id="menu-item-25660" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-25660 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/galleries/">Images gallery</a></li>
                                                    <li id="menu-item-29035" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-29035 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/list-element/">List element</a></li>
                                                </ul>
                                            </li>
                                            <li id="menu-item-29292" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-29292 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/basel-slider/">Features</a>
                                                <ul class="sub-sub-menu color-scheme-dark">
                                                    <li id="menu-item-29293" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-29293 menu-item-design-default item-event-hover item-with-label item-label-new"><a href="https://demo.xtemos.com/basel/basel-slider/">Basel Slider<span class="menu-label menu-label-new">New</span></a></li>
                                                    <li id="menu-item-29294" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-29294 menu-item-design-default item-event-hover item-with-label item-label-hot"><a href="https://demo.xtemos.com/basel/product-filters/">Product filters<span class="menu-label menu-label-hot">Hot</span></a></li>
                                                    <li id="menu-item-29036" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-29036 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/extra-menu-list/">Extra menu list</a></li>
                                                    <li id="menu-item-25711" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-25711 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/ajax-products-tabs/">AJAX products tabs</a></li>
                                                    <li id="menu-item-26204" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-26204 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/animated-counter/">Animated counter</a></li>
                                                    <li id="menu-item-28561" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-28561 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/timeline/">Timeline</a></li>
                                                    <li id="menu-item-29037" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-29037 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/brands-element/">Brands Element</a></li>
                                                    <li id="menu-item-20034" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-20034 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/products-slider/">Products Slider</a></li>
                                                    <li id="menu-item-29295" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-29295 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/button-with-popup/">Button with popup</a></li>
                                                    <li id="menu-item-29297" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-29297 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/shop/accessories/london-ampersand-cushion/?stickyaddtocart">Sticky add to cart</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--END MAIN-NAV-->
                <div class="right-column">
                    <div class="search-button basel-search-full-screen">
                        <a href="#">
                            <i class="fa fa-search"></i>
                        </a>
                        <div class="basel-search-wrapper">
                            <div class="basel-search-inner">
                                <span class="basel-close-search">close</span>
                                <form role="search" method="get" id="searchform" class="searchform  basel-ajax-search" action="https://demo.xtemos.com/basel/" data-thumbnail="1" data-price="1" data-count="5" data-post_type="product">
                                    <div>
                                        <label class="screen-reader-text">Search for:</label>
                                        <input type="text" class="search-field" placeholder="Search for products" value="" name="s" id="s" />
                                        <input type="hidden" name="post_type" id="post_type" value="product">
                                        <button type="submit" id="searchsubmit" value="Search">Search</button>

                                    </div>
                                </form>
                                <div class="search-results-wrapper">
                                    <div class="basel-scroll">
                                        <div class="basel-search-results basel-scroll-content"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wishlist-info-widget">
                        <a href="https://demo.xtemos.com/basel/wishlist/">
                            Wishlist
                            <span class="wishlist-count">0</span>
                        </a>
                    </div>
                    <div class="shopping-cart basel-cart-design-1 basel-cart-icon cart-widget-opener">
                        <a href="https://demo.xtemos.com/basel/cart/">
                            <span>Cart (<span>o</span>)</span>
                            <span class="basel-cart-totals">
								<span class="basel-cart-number">0</span>
                                <span class="subtotal-divider">/</span>
                                <span class="basel-cart-subtotal"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&pound;</span>0.00</span>
                                </span>
                                </span>
                        </a>
                    </div>
                    <div class="mobile-nav-icon">
                        <span class="basel-burger"></span>
                    </div>
                    <!--END MOBILE-NAV-ICON-->
                </div>
            </div>
        </div>

    </header>
    <!--END MAIN HEADER-->

    <div class="clear"></div>

    <div class="main-page-wrapper">
        <!-- MAIN CONTENT AREA -->
        <div class="container">
            <div class="row">
                <div class="site-content col-sm-12" role="main">
                    <article id="post-25099" class="post-25099 page type-page status-publish hentry">
                        <div class="entry-content">

                            <div class="vc_row wpb_row vc_row-fluid vc_custom_1477403044270">

                                @include('home.banners.banner-1')

                                @include('home.sliders.rev-slider-1')

                                @include('home.banners.banner-2')

                            </div>

                            @include('home.carousel.offers-1')

                            @include('home.carousel.featured-1')

                            <div class="vc_row-full-width vc_clearfix"></div>

                        </div>

                    </article>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    @include('footers.footer-1')


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
<script type="text/javascript">
    var wpcf7  = {!! json_encode([
        "apiSettings" => array(
            "root" => route('contact.store'),
            "namespace" => "form/contact-form-7/v1"
        ),
        "recaptcha" => array(
            "messages" => array(
                "empty" => "Verifique se você não é um robô."
            ),
            "namespace" => "contact-form-7/v1"
        ),
        "cached" => "1"
    ]) !!};
</script>
<script type="text/javascript" src="{{asset('includes/contact-form-7/js/scripts.js')}}?ver=5.0.5"></script>
<script type="text/javascript" src="{{asset('plugins/revslider/js/jquery.themepunch.tools.min.js')}}?ver=5.4.8.1" defer="defer"></script>
<script type="text/javascript" src="{{asset('plugins/revslider/js/jquery.themepunch.revolution.min.js')}}?ver=5.4.8.1" defer="defer"></script>
<script type="text/javascript" src="{{asset('plugins/revslider/js/extensions/revolution.extension.actions.min.js')}}?ver=5.4.8.1"></script>
<script type="text/javascript" src="{{asset('plugins/revslider/js/extensions/revolution.extension.carousel.min.js')}}?ver=5.4.8.1"></script>
<script type="text/javascript" src="{{asset('plugins/revslider/js/extensions/revolution.extension.kenburn.min.js')}}?ver=5.4.8.1"></script>
<script type="text/javascript" src="{{asset('plugins/revslider/js/extensions/revolution.extension.layeranimation.min.js')}}?ver=5.4.8.1"></script>
<script type="text/javascript" src="{{asset('plugins/revslider/js/extensions/revolution.extension.migration.min.js')}}?ver=5.4.8.1"></script>
<script type="text/javascript" src="{{asset('plugins/revslider/js/extensions/revolution.extension.navigation.min.js')}}?ver=5.4.8.1"></script>
<script type="text/javascript" src="{{asset('plugins/revslider/js/extensions/revolution.extension.parallax.min.js')}}?ver=5.4.8.1"></script>
<script type="text/javascript" src="{{asset('plugins/revslider/js/extensions/revolution.extension.slideanims.min.js')}}?ver=5.4.8.1"></script>
<script type="text/javascript" src="{{asset('plugins/revslider/js/extensions/revolution.extension.video.min.js')}}?ver=5.4.8.1"></script>
<script type="text/javascript" src="{{asset('plugins/js-cookie/js.cookie.min.js')}}?ver=2.1.4"></script>
<script type="text/javascript">
    var woocommerce_params  = {!! json_encode([
        "ajax_url" => "woocommerce_params",
        "wc_ajax_url" => "woocommerce_params_2"
    ]) !!};
</script>
<script type="text/javascript" src="{{asset('plugins/frontend/avdesign.min.js')}}?ver=3.5.2"></script>
<script type='text/javascript'>
    var wc_cart_fragments_params = {!! json_encode([
        "ajax_url" => route('cart'),
        "wc_ajax_url" => route('cart.fragments'),
        "fragment_name" => "wc_fragments_anselmo_velame",
        "csrf_token" => csrf_token()
    ]) !!};
</script>
<script type="text/javascript" src="{{asset('plugins/cart/js/cart-fragments.min.js')}}?ver=3.5.2"></script>
<script type="text/javascript" src="{{asset('plugins/yith-wishlist/js/jquery.selectBox.min.js')}}?ver=1.2.0"></script>
<script type="text/javascript">
    var yith_wcwl_l10n = {!! json_encode([
        "ajax_url" => route('wishlist.store'),
        "remove_url" => route('wishlist.remove'),
        "redirect_to_cart" => "no",
        "multi_wishlist" => "",
        "hide_add_button" => "1",
        "is_user_logged_in" => "",
        "ajax_loader_url" => asset('plugins/yith-wishlist/images/ajax-loader.gif'),
        "remove_from_wishlist_after_add_to_cart" => "yes",
        "csrf_token" => csrf_token(),
        "labels" => array(
            "cookie_disabled" => "Lamentamos, mas esse recurso está disponível somente se os cookies estiverem ativados no seu navegador.",
            "added_to_cart_message" => '<div class="woocommerce-message">Produto adicionado ao carrinho</div>'
        ),
        "actions" => array(
            "add_to_wishlist_action" => "add_to_wishlist",
            "remove_from_wishlist_action" => "remove_from_wishlist",
            "move_to_another_wishlist_action" => "move_to_another_wishlsit",
            "reload_wishlist_and_adding_elem_action" => "reload_wishlist_and_adding_elem"
        )
    ]) !!};
</script>

<script type="text/javascript" src="{{asset('plugins/yith-wishlist/js/jquery.yith-wcwl.js')}}?ver=2.2.5"></script>
<script type="text/javascript" src="{{asset('plugins/isotope/isotope.pkgd.min.js')}}?ver=5.6"></script>
<script type="text/javascript" src="{{asset('plugins/waypoints/waypoints.min.js')}}?ver=5.6"></script>
<script type="text/javascript" src="{{asset('plugins/js_composer/js/js_composer_front.min.js')}}?ver=5.6"></script>
<script type="text/javascript">
    var basel_settings = {!! json_encode([
        "adding_to_cart" => "Carregando",
        "added_to_cart" => "O produto foi adicionado com sucesso ao seu carrinho.",
        "continue_shopping" => "Continue comprando",
        "view_cart" => "Ver Carrinho",
        "go_to_checkout" => "Finalizar",
        "countdown_days" => "dias",
        "countdown_hours" => "h",
        "countdown_mins" => "m",
        "countdown_sec" => "s",
        "loading" => "Carregando...",
        "close" => "Fechar (Esc)",
        "share_fb" => "Compartilhe no Facebook",
        "pin_it" => "Pin it",
        "tweet" => "Tweet",
        "download_image" => "Download da Imagem",
        "wishlist" => "yes",
        "cart_url" => route('cart'),
        "ajaxurl" => route('cart.product'),
        "search_url" => route('product.search'),
        "quickview_url" => route('product.show'),
        "compare_url" => route('compare.store'),
        "sections_tabs" => route('section.tabs'),
        "add_to_cart_action" => "widget",
        "categories_toggle" => "yes",
        "enable_popup" => "yes",
        "popup_delay" => "2000",
        "popup_event" => "scroll",
        "popup_scroll" => "800",
        "popup_pages" => "0",
        "promo_popup_hide_mobile" => "yes",
        "product_images_captions" => "no",
        "all_results" => "Ver todos os resultados",
        "product_gallery" => array(
            "images_slider" => true,
            "thumbs_slider" => array(
                "enabled" =>  true,
                "position" => "left",
                "items" => array(
                    "desktop" => 4,
                    "desktop_small" => 3,
                    "tablet" => 4,
                    "mobile" => 3,
                    "vertical_items" => 3
                )
            )
        ),
        "zoom_enable" => "yes",
        "ajax_scroll" => "yes",
        "ajax_scroll_class" => ".main-page-wrapper",
        "ajax_scroll_offset" => "100",
        "product_slider_auto_height" => "no",
        "product_slider_autoplay" => "",
        "ajax_add_to_cart" => "1",
        "cookies_version" => "1",
        "header_banner_version" => "1",
        "header_banner_close_btn" => "1",
        "header_banner_enabled" => "",
        "promo_version" => "1",
        "pjax_timeout" => "5000",
        "split_nav_fix" => "",
        "shop_filters_close" => "yes",
        "sticky_desc_scroll" => "1",
        "quickview_in_popup_fix" => "",
        "one_page_menu_offset" => "150",
        "csrf_token" => csrf_token(),9
    ]) !!};
    var basel_variation_gallery_data=null;
</script>
<script type="text/javascript" src="{{asset('themes/js/theme-org.js')}}?ver=4.5.5"></script>
<script type="text/javascript" src="{{asset('banners')}}?ver=1.8.3"></script>
<script type='text/javascript'>
    var _wpUtilSettings = {!! json_encode([
        "ajax" => array(
            "url" => "/underscore"
        )
    ]) !!};
</script>
<script type="text/javascript" src="{{asset('includes/util/avd-util.min.js')}}?ver=4.9.8"></script>
<script type='text/javascript'>
    var wc_add_to_cart_variation_params = {!! json_encode([
        "wc_ajax_url" => "remover/item/?removed_item=1&wc-ajax=%%endpoint%%",
        "i18n_no_matching_variations_text" => "Desculpe, nenhum produto corresponde à sua seleção. Escolha uma combinação diferente.",
        "i18n_make_a_selection_text" => "Selecione a cor, o tamanho e a quantidade antes de prosseguir.",
        "i18n_unavailable_text" => "Desculpe, este produto não está disponível. Escolha uma combinação diferente."
    ]) !!};
</script>
<script type="text/javascript" src="{{asset('plugins/cart/js/add-to-cart-variation.min.js')}}?ver=3.5.2"></script>
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
                    jsFileLocation: "//demo.xtemos.com/basel/wp-content/plugins/revslider/public/assets/js/",
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
                        disableFocusListener: false,
                    }
                });
            }; /* END OF revapi call */

        }; /* END OF ON LOAD FUNCTION */
    }()); /* END OF WRAPPING FUNCTION */
</script>

@include('extras.popup-newsletter-1')

@include('extras.cookies-popup-1')

@include('extras.btn-link-1')

@include('extras.container-photo-swipe-ui-1')
</body>
</html>