
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

    <style>
        .wishlist_table .add_to_cart, a.add_to_wishlist.button.alt { border-radius: 16px; -moz-border-radius: 16px; -webkit-border-radius: 16px; }
    </style>

    <link rel="dns-prefetch" href="//fonts.googleapis.com" />
    @include('google.analytics-1')
    <!-- / Google Analytics by MonsterInsights -->
    <link rel="stylesheet" id="contact-form-7"  href="{{asset('plugins/contact-form-7/css/styles.css')}}?ver=5.0.5" type="text/css" media="all" />
    <style id="woocommerce-inline-inline-css" type="text/css">
        .woocommerce form .form-row .required { visibility: visible; }
    </style>
    <link rel="stylesheet" id="prettyPhoto" href="{{asset('plugins/prettyPhoto/css/prettyPhoto.css')}}" type="text/css" media="all" />
    <link rel="stylesheet" id="jquery-selectBox" href="{{asset('plugins/yith-wishlist/css/jquery.selectBox.css')}}" type="text/css" media="all" />
    <link rel="stylesheet" id="yith-wcwl-main" href="{{asset('plugins/yith-wishlist/css/style.css')}}" type="text/css" media="all" />
    <link rel="stylesheet" id="js_composer_front" href="{{asset('plugins/js_composer/css/js_composer.min.css')}}?ver=5.6" type="text/css" media="all" />
    <link rel="stylesheet" id="mc4wp-form-basic" href="{{asset('plugins/mailchimp/css/form-basic.min.css')}}?ver=3.1.11" type="text/css" media="all" />
    <link rel="stylesheet" id="redux-google-fonts-basel_options-css"  href="https://fonts.googleapis.com/css?family=Karla%3A400%2C700%2C400italic%2C700italic%7CLora%3A400%2C700%2C400italic%2C700italic%7CLato%3A100%2C300%2C400%2C700%2C900%2C100italic%2C300italic%2C400italic%2C700italic%2C900italic&#038;subset=latin&#038;ver=1546694001" type="text/css" media="all" />
    <link rel="stylesheet" id="bootstrap" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}?ver=3.3.1" type="text/css" media="all" />
    <link rel="stylesheet" id="style-css" href="{{asset('themes/css/style.min.css')}}?ver=4.4.2" type="text/css" media="all" />
    <link rel="stylesheet" id="font-awesome" href="{{asset('plugins/font-awesome/css/font-awesome.min.css')}}?ver=4.7.0" type="text/css" media="all" />

    <style id="font-awesome-inline-css" type="text/css">
        [data-font="FontAwesome"]:before {font-family: 'FontAwesome' !important;content: attr(data-icon) !important;speak: none !important;font-weight: normal !important;font-variant: normal !important;text-transform: none !important;line-height: 1 !important;font-style: normal !important;-webkit-font-smoothing: antialiased !important;-moz-osx-font-smoothing: grayscale !important;}
    </style>
    <script type="text/template" id="tmpl-variation-template">
        <div class="woocommerce-variation-description">
            @{{{ data.variation.variation_description }}}
        </div>
        <div class="woocommerce-variation-price">
            @{{{ data.variation.price_html }}}
        </div>
        <div class="woocommerce-variation-availability">
            @{{{ data.variation.availability_html }}}
        </div>
    </script>
    <script type="text/template" id="tmpl-unavailable-variation-template">
        <p>Desculpe, este produto não está disponível. Por favor, escolha uma combinação diferente.</p>
    </script>
    <script type="text/javascript">
        /* <![CDATA[ */
        var monsterinsights_frontend = {"js_events_tracking":"true","is_debug_mode":"false","download_extensions":"doc,exe,js,pdf,ppt,tgz,zip,xls","inbound_paths":"","home_url":"https:\/\/demo.xtemos.com\/basel","track_download_as":"event","internal_label":"int","hash_tracking":"false"};
        /* ]]> */
    </script>
    <script type="text/javascript" src="{{asset('plugins/google/analytics-frontend.min.js')}}?ver=7.3.2"></script>
    <script type="text/javascript" src="{{asset('includes/js/jquery/jquery.min.js')}}?ver=1.12.4"></script>
    <script type="text/javascript" src="{{asset('includes/js/jquery/jquery-migrate.min.js')}}?ver=1.4.1"></script>
    <script type="text/javascript" src="{{asset('plugins/jquery-blockui/jquery.blockUI.min.js')}}?ver=2.70"></script>


    <script type="text/javascript">
        var wc_add_to_cart_params = {!! json_encode([
            "ajax_url" => route('cart.add'),
            "wc_ajax_url" => route('cart.add')."/?wc-ajax=%%endpoint%%",
            "i18n_view_cart" => "Ver Carrrinho",
            "cart_url" => route('cart'),
            "is_cart" => "",
            "cart_redirect_after_add" => "no"
        ]) !!};
    </script>
    <script type="text/javascript" src="{{asset('plugins/cart/js/add-to-cart.min.js')}}?ver=3.5.2"></script>
    <script type="text/javascript" src="{{asset('plugins/cart/js/avd-add-to-cart.js')}}?ver=5.6"></script>
    <!--[if lt IE 9]>
        <script type="text/javascript" src="{{asset('themes/js/html5.min.js')}}?ver=4.4.2"></script>
    <![endif]-->
    <script type="text/javascript" src="{{asset('themes/js/device.min.js')}}?ver=4.4.2"></script>


    <link rel="shortcut icon" href="{{asset('themes/images/icons/favicon.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{asset('themes/images/icons/apple-touch-icon-152x152-precomposed.png')}}">

    <link rel="stylesheet" id="categories" href="{{asset('themes/css/categories.css')}}?ver=1.0.0" type="text/css" media="all" />
    <link rel="stylesheet" id="theme" href="{{asset('themes/css/theme.min.css')}}?ver=1.0.0" type="text/css" media="all" />

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
    <meta name="generator" content="Powered by WPBakery Page Builder - drag and drop page builder for WordPress."/>
    <!--[if lte IE 9]>
     <link rel="stylesheet" type="text/css" href="{{asset('plugins/js_composer/css/vc_lte_ie9.min.css')}}" media="screen">
    <![endif]-->

    <noscript><style type="text/css"> .wpb_animate_when_almost_visible { opacity: 1; }</style></noscript>
</head>
@stack('body')

<div class="website-wrapper">

    @include('headers.header-1')

    @yield('content')

    @include('footers.footer-1')

</div>
<!-- end wrapper -->
<div class="basel-close-side"></div>
<a href="#" class="scrollToTop basel-tooltip">Role para cima</a>
<script type="application/ld+json"> {
    "@context":"https:\/\/schema.org\/",
    "@graph":[ {
        "@type": "Product", "@id": "https:\/\/demo.xtemos.com\/basel\/shop\/bags\/nombined-strapped-backpack\/", "name": "Backpack double strap", "url": "https:\/\/demo.xtemos.com\/basel\/shop\/bags\/nombined-strapped-backpack\/"
    }
    ,
    {
        "@type": "Product", "@id": "https:\/\/demo.xtemos.com\/basel\/shop\/shoes\/basic-contrast-sneakers\/", "name": "Basic contrast sneakers", "url": "https:\/\/demo.xtemos.com\/basel\/shop\/shoes\/basic-contrast-sneakers\/"
    }
    ,
    {
        "@type": "Product", "@id": "https:\/\/demo.xtemos.com\/basel\/shop\/woman\/basic-knit-dress-chest\/", "name": "Basic knit dress chest", "url": "https:\/\/demo.xtemos.com\/basel\/shop\/woman\/basic-knit-dress-chest\/"
    }
    ,
    {
        "@type": "Product", "@id": "https:\/\/demo.xtemos.com\/basel\/shop\/man\/hooded-jacquard-jumper\/", "name": "Basic Korean-style coat", "url": "https:\/\/demo.xtemos.com\/basel\/shop\/man\/hooded-jacquard-jumper\/"
    }
    ,
    {
        "@type": "Product", "@id": "https:\/\/demo.xtemos.com\/basel\/shop\/accessories\/before-decaf-phone-case\/", "name": "Before decaf phone case", "url": "https:\/\/demo.xtemos.com\/basel\/shop\/accessories\/before-decaf-phone-case\/"
    }
    ,
    {
        "@type": "Product", "@id": "https:\/\/demo.xtemos.com\/basel\/shop\/jewellery\/black-sphere-and-beads\/", "name": "Black sphere and beads", "url": "https:\/\/demo.xtemos.com\/basel\/shop\/jewellery\/black-sphere-and-beads\/"
    }
    ,
    {
        "@type": "Product", "@id": "https:\/\/demo.xtemos.com\/basel\/shop\/accessories\/black-umbrella-in-handle\/", "name": "Black umbrella in handle", "url": "https:\/\/demo.xtemos.com\/basel\/shop\/accessories\/black-umbrella-in-handle\/"
    }
    ,
    {
        "@type": "Product", "@id": "https:\/\/demo.xtemos.com\/basel\/shop\/watches\/19564\/", "name": "Bold metallic watch", "url": "https:\/\/demo.xtemos.com\/basel\/shop\/watches\/19564\/"
    }
    ,
    {
        "@type": "Product", "@id": "https:\/\/demo.xtemos.com\/basel\/shop\/woman\/jur-detail-jacket\/", "name": "Cem and cutwork jacket", "url": "https:\/\/demo.xtemos.com\/basel\/shop\/woman\/jur-detail-jacket\/"
    }
    ,
    {
        "@type": "Product", "@id": "https:\/\/demo.xtemos.com\/basel\/shop\/shoes\/hrim-sports-shoes\/", "name": "Cen\u2019s dress shoes", "url": "https:\/\/demo.xtemos.com\/basel\/shop\/shoes\/hrim-sports-shoes\/"
    }
    ,
    {
        "@type": "Product", "@id": "https:\/\/demo.xtemos.com\/basel\/shop\/accessories\/classic-square-buckle-belt\/", "name": "Classic Square Buckle Belt", "url": "https:\/\/demo.xtemos.com\/basel\/shop\/accessories\/classic-square-buckle-belt\/"
    }
    ,
    {
        "@type": "Product", "@id": "https:\/\/demo.xtemos.com\/basel\/shop\/bags\/clutch-printed-bag\/", "name": "Clutch printed bag", "url": "https:\/\/demo.xtemos.com\/basel\/shop\/bags\/clutch-printed-bag\/"
    }
    ]
}
</script>

<script type="text/javascript">
    var c=document.body.className;
    c=c.replace(/woocommerce-no-js/, 'woocommerce-js');
    document.body.className=c;
</script>

<script type="text/javascript">
    var wpcf7  = {!! json_encode([
        "apiSettings" => array(
            "root" => url("contact-form-7/v1"),
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
<script type="text/javascript" src="{{asset('plugins/contact-form-7/js/scripts.js')}}?ver=5.0.5"></script>
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
        "fragment_name" => "wc_fragments_648848747847",
        "csrf_token" => csrf_token()
    ]) !!};
</script>

<script type="text/javascript" src="{{asset('plugins/cart/js/cart-fragments.min.js')}}?ver=3.5.2"></script>
<script type="text/javascript" src="{{asset('plugins/yith-wishlist/js/jquery.selectBox.min.js')}}?ver=1.2.0"></script>
<script type="text/javascript">
    var yith_wcwl_l10n = {!! json_encode([
        "ajax_url" => route('wishlist.store'),
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
        "cart_url" => "https:\/\/demo.xtemos.com\/basel\/cart\/",
        "ajaxurl" => route('product.search'),
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
        )
        ,
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
        "shop_filters_close" => "no",
        "sticky_desc_scroll" => "1",
        "quickview_in_popup_fix" => "",
        "one_page_menu_offset" => "150"
    ]) !!};
    var basel_variation_gallery_data=null;
</script>

<script type="text/javascript" src="{{asset('themes/js/theme.min.js')}}?ver=4.4.2">
</script>

<script type="text/javascript" src="{{asset('includes/underscore/js/underscore.min.js')}}?ver=1.8.3"></script>
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

@include('extras.popup-newsletter-1')

@include('extras.cookies-popup-1')

@include('extras.btn-link-1')

@include('extras.container-photo-swipe-ui-1')

</body>
</html>

