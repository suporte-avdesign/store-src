@extends('frontend.layouts.template-1')
@push('title')
<title> Seu Carrinho - {{config('app.name')}}</title>
@endpush
@push('styles')
<link rel="stylesheet" id="select2-css"  href="{{asset('plugins/select2/css/select2.css')}}?ver=3.5.2" type="text/css" media="all" />
@endpush
@push('head')
<script type='text/javascript'>
    var _zxcvbnSettings = {!! json_encode(["src" => asset('includes/zxcvbn/js/zxcvbn-async.min.js')]) !!}
</script>
<script type="text/javascript" src="{{asset('includes/zxcvbn/js/zxcvbn-async.min.js')}}"></script>
@endpush
@push('body')
<body class="page-template-default page page-id-8 woocommerce-checkout woocommerce-page woocommerce-order-received woocommerce-no-js wrapper-full-width global-cart-design-1 global-search-full-screen global-header-shop mobile-nav-from-left basel-light catalog-mode-off categories-accordion-on global-wishlist-enable basel-top-bar-on basel-ajax-shop-on basel-ajax-search-on enable-sticky-header header-full-width sticky-header-real offcanvas-sidebar-mobile offcanvas-sidebar-tablet wpb-js-composer js-comp-ver-5.6 vc_responsive">
@endpush
@section('content')
    <div class="page-title page-title-default title-size-small title-design-centered color-scheme-light" style="">
        <div class="container">
            <header class="entry-header">
                <h1 class="entry-title">Pagamento</h1>
                <div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
                    <a href="{{route('home')}}" rel="v:url" property="v:title">Home</a> &raquo;
                    <span class="current">pagamento</span>
                </div>
            </header>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="site-content col-sm-12" role="main">
                <article id="post-29276" class="post-29276 page type-page status-publish hentry">
                    <div class="entry-content">
                        <div class="vc_row wpb_row vc_row-fluid vc_custom_1517232325769">
                            <div class="wpb_column vc_column_container vc_col-sm-6">
                                <div class="vc_column-inner">
                                    <div class="wpb_wrapper">
                                        <div class="title-wrapper  basel-title-color-primary basel-title-style-bordered basel-title-size-default text-center vc_custom_1534844170235"><span class="title-subtitle font-default">XTEMOS ELEMENT</span>
                                            <div class="liner-continer"> <span class="left-line"></span>
                                                <h4 class="title">POPUP SUBSCRIBE FORM<span class="title-separator"><span></span></span></h4> <span class="right-line"></span></div>
                                        </div>
                                        <div class="basel-button-wrapper text-center"><a href="#newsletter-popup" title="" class="btn btn-color-primary btn-style-default btn-size-default basel-popup-with-content ">SUBSCRIBE TO OUR NEWSLETTER</a></div>
                                        <div id="newsletter-popup" class="mfp-with-anim basel-content-popup mfp-hide" style="max-width:800px;">
                                            <div class="basel-popup-inner">
                                                <div class="vc_row wpb_row vc_inner vc_row-fluid vc_custom_1534239552700 vc_row-has-fill">
                                                    <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-has-fill">
                                                        <div class="vc_column-inner vc_custom_1492152486025">
                                                            <div class="wpb_wrapper">
                                                                <div class="title-wrapper  basel-title-color-white basel-title-style-default basel-title-size-large text-center ">
                                                                    <div class="liner-continer"> <span class="left-line"></span>
                                                                        <h4 class="title">HEY YOU, SIGN UP AND CONNECT TO BASEL!<span class="title-separator"><span></span></span></h4> <span class="right-line"></span></div><span class="title-after_title">Be the first to learn about our latest trends and get exclusive offers</span></div>
                                                                <div class="wpb_text_column wpb_content_element vc_custom_1534239628934 color-scheme-light">
                                                                    <div class="wpb_wrapper">
                                                                        <form id="mc4wp-form-1" class="mc4wp-form mc4wp-form-21436 mc4wp-form-basic" method="post" data-id="21436" data-name="Default sign-up form">
                                                                            <div class="mc4wp-form-fields">
                                                                                <p class="mailchimp-input-icon">
                                                                                    <label>Email address: </label>
                                                                                    <input type="email" name="EMAIL" placeholder="Your email address" required />
                                                                                </p>
                                                                                <p>
                                                                                    <input type="submit" value="Sign up" />
                                                                                </p>
                                                                                <div style="display: none;">
                                                                                    <input type="text" name="_mc4wp_honeypot" value="" tabindex="-1" autocomplete="off" />
                                                                                </div>
                                                                                <input type="hidden" name="_mc4wp_timestamp" value="1560185807" />
                                                                                <input type="hidden" name="_mc4wp_form_id" value="21436" />
                                                                                <input type="hidden" name="_mc4wp_form_element_id" value="mc4wp-form-1" />
                                                                            </div>
                                                                            <div class="mc4wp-response"></div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                <div class="wpb_text_column wpb_content_element vc_custom_1489065277732 color-scheme-light">
                                                                    <div class="wpb_wrapper">
                                                                        <p style="text-align: center;">Will be used in accordance with our <strong><a href="#">Privacy Policy</a></strong></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="vc_row wpb_row vc_row-fluid vc_custom_1492007733059 vc_row-o-content-top vc_row-flex">
                            <div class="wpb_column vc_column_container vc_col-sm-6">
                                <div class="vc_column-inner vc_custom_1489065426716">
                                    <div class="wpb_wrapper">
                                        <div class="title-wrapper  basel-title-color-primary basel-title-style-bordered basel-title-size-default text-center vc_custom_1489065524846"><span class="title-subtitle font-default">XTEMOS ELEMENT</span>
                                            <div class="liner-continer"> <span class="left-line"></span>
                                                <h4 class="title">POPUP WITH PRODUCTS<span class="title-separator"><span></span></span></h4> <span class="right-line"></span></div>
                                        </div>
                                        <div class="basel-button-wrapper text-center"><a href="#popup-products" title="" class="btn btn-color-primary btn-style-default btn-size-default basel-popup-with-content ">SHOW BEST PRODUCTS</a></div>
                                        <div id="popup-products" class="mfp-with-anim basel-content-popup mfp-hide" style="max-width:950px;">
                                            <div class="basel-popup-inner">
                                                <div class="vc_row wpb_row vc_inner vc_row-fluid vc_row-o-equal-height vc_row-flex">
                                                    <div class="wpb_column vc_column_container vc_col-sm-12">
                                                        <div class="vc_column-inner vc_custom_1534239083773">
                                                            <div class="wpb_wrapper">
                                                                <div class="title-wrapper  basel-title-color-default basel-title-style-default basel-title-size-default text-center ">
                                                                    <div class="liner-continer"> <span class="left-line"></span>
                                                                        <h4 class="title">BEST PRODUCTS<span class="title-separator"><span></span></span></h4> <span class="right-line"></span></div>
                                                                </div>
                                                                <div class="basel-products-element">
                                                                    <div class="products elements-grid row basel-products-holder  pagination- grid-columns-4" data-paged="1" data-source="shortcode" data-atts="{&quot;post_type&quot;:&quot;product&quot;,&quot;layout&quot;:&quot;grid&quot;,&quot;include&quot;:&quot;&quot;,&quot;custom_query&quot;:&quot;&quot;,&quot;taxonomies&quot;:&quot;58&quot;,&quot;pagination&quot;:&quot;&quot;,&quot;items_per_page&quot;:&quot;4&quot;,&quot;product_hover&quot;:&quot;quick&quot;,&quot;columns&quot;:&quot;4&quot;,&quot;sale_countdown&quot;:0,&quot;offset&quot;:&quot;&quot;,&quot;orderby&quot;:&quot;date&quot;,&quot;query_type&quot;:&quot;OR&quot;,&quot;order&quot;:&quot;ASC&quot;,&quot;meta_key&quot;:&quot;&quot;,&quot;exclude&quot;:&quot;&quot;,&quot;class&quot;:&quot;&quot;,&quot;ajax_page&quot;:&quot;&quot;,&quot;speed&quot;:&quot;5000&quot;,&quot;slides_per_view&quot;:&quot;1&quot;,&quot;wrap&quot;:&quot;&quot;,&quot;autoplay&quot;:&quot;no&quot;,&quot;hide_pagination_control&quot;:&quot;&quot;,&quot;hide_prev_next_buttons&quot;:&quot;&quot;,&quot;scroll_per_page&quot;:&quot;yes&quot;,&quot;carousel_js_inline&quot;:&quot;no&quot;,&quot;img_size&quot;:&quot;woocommerce_thumbnail&quot;,&quot;force_not_ajax&quot;:&quot;no&quot;,&quot;center_mode&quot;:&quot;no&quot;,&quot;products_masonry&quot;:&quot;0&quot;,&quot;products_different_sizes&quot;:&quot;0&quot;}">
                                                                        <div class="product-grid-item basel-hover-quick product  col-xs-6 col-sm-4 col-md-3 first  type-product post-19603 status-publish first instock product_cat-bags product_tag-bag product_tag-new has-post-thumbnail shipping-taxable purchasable product-type-variable" data-loop="1" data-id="19603">
                                                                            <div class="product-element-top">
                                                                                <a href="https://demo.xtemos.com/basel/shop/bags/backpack-double-strap/"> <img width="273" height="348" src="https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-1.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-1.jpg 870w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-1-235x300.jpg 235w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-1-768x980.jpg 768w, https://xtemos1.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-1-803x1024.jpg 803w, https://xtemos1.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-1-266x340.jpg 266w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-1-219x280.jpg 219w, https://xtemos1.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-1-263x336.jpg 263w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-1-526x671.jpg 526w" sizes="(max-width: 273px) 100vw, 273px" /> </a>
                                                                                <div class="hover-img">
                                                                                    <a href="https://demo.xtemos.com/basel/shop/bags/backpack-double-strap/"> <img width="273" height="348" src="https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-17.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-17.jpg 870w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-17-235x300.jpg 235w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-17-768x980.jpg 768w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-17-803x1024.jpg 803w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-17-266x340.jpg 266w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-17-219x280.jpg 219w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-17-263x336.jpg 263w, https://xtemos1.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-17-526x671.jpg 526w" sizes="(max-width: 273px) 100vw, 273px" /> </a>
                                                                                </div>
                                                                                <div class="basel-buttons">
                                                                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-19603">
                                                                                        <div class="yith-wcwl-add-button show" style="display:block"> <a href="/basel/button-with-popup/?add_to_wishlist=19603" rel="nofollow" data-product-id="19603" data-product-type="variable" class="add_to_wishlist"> Add to Wishlist</a> <img src="https://xtemos2.r.worldssl.net/basel/wp-content/plugins/yith-woocommerce-wishlist/assets/images/wpspin_light.gif" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" /></div>
                                                                                        <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"> <span class="feedback">Product added!</span> <a href="https://demo.xtemos.com/basel/wishlist/" rel="nofollow"> Browse Wishlist </a></div>
                                                                                        <div class="yith-wcwl-wishlistexistsbrowse hide" style="display:none"> <span class="feedback">The product is already in the wishlist!</span> <a href="https://demo.xtemos.com/basel/wishlist/" rel="nofollow"> Browse Wishlist </a></div>
                                                                                        <div style="clear:both"></div>
                                                                                        <div class="yith-wcwl-wishlistaddresponse"></div>
                                                                                    </div>
                                                                                    <div class="clear"></div>
                                                                                    <div class="basel-compare-btn product-compare-button"><a class="button" href="https://demo.xtemos.com/basel/compare/" data-added-text="Compare products" data-id="19603">Compare</a></div>
                                                                                    <div class="quick-view"> <a href="https://demo.xtemos.com/basel/shop/bags/backpack-double-strap/" class="open-quick-view" data-id="19603">Quick View</a></div>
                                                                                </div>
                                                                                <div class="quick-shop-wrapper">
                                                                                    <div class="quick-shop-close"><span>Close</span></div>
                                                                                    <div class="quick-shop-btn"> <a href="#" class="btn-quick-shop" data-id="19603"><span>Quick shop</span></a></div>
                                                                                    <div class="quick-shop-form"></div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="swatches-wrapper">
                                                                                <div class="swatches-on-grid">
                                                                                    <div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-" style="background-color:#0c0c0c;" data-image-src="https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-3.jpg" data-image-srcset="https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-3.jpg 870w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-3-235x300.jpg 235w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-3-768x980.jpg 768w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-3-803x1024.jpg 803w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-3-266x340.jpg 266w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-3-219x280.jpg 219w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-3-263x336.jpg 263w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-3-526x671.jpg 526w" data-image-sizes="(max-width: 870px) 100vw, 870px">Black</div>
                                                                                    <div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-" style="background-color:#aa6927;" data-image-src="https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-2.jpg" data-image-srcset="https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-2.jpg 870w, https://xtemos1.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-2-235x300.jpg 235w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-2-768x980.jpg 768w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-2-803x1024.jpg 803w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-2-266x340.jpg 266w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-2-219x280.jpg 219w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-2-263x336.jpg 263w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-2-526x671.jpg 526w" data-image-sizes="(max-width: 870px) 100vw, 870px">Brown</div>
                                                                                    <div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-" style="background-color:#539b2d;" data-image-src="https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-17.jpg" data-image-srcset="https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-17.jpg 870w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-17-235x300.jpg 235w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-17-768x980.jpg 768w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-17-803x1024.jpg 803w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-17-266x340.jpg 266w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-17-219x280.jpg 219w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-17-263x336.jpg 263w, https://xtemos1.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-17-526x671.jpg 526w" data-image-sizes="(max-width: 870px) 100vw, 870px">Green</div>
                                                                                </div>
                                                                            </div>
                                                                            <h3 class="product-title"><a href="https://demo.xtemos.com/basel/shop/bags/backpack-double-strap/">Nombined strapped backpack</a></h3><span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&pound;</span>54.00</span>
                                                                        </span>
                                                                        </div>
                                                                        <div class="product-grid-item basel-hover-quick product  col-xs-6 col-sm-4 col-md-3 type-product post-19614 status-publish instock product_cat-bags product_tag-bag product_tag-basic has-post-thumbnail shipping-taxable purchasable product-type-variable" data-loop="2" data-id="19614">
                                                                            <div class="product-element-top">
                                                                                <a href="https://demo.xtemos.com/basel/shop/bags/clutch-printed-bag/"> <img width="273" height="348" src="https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-3.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-3.jpg 870w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-3-235x300.jpg 235w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-3-768x980.jpg 768w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-3-803x1024.jpg 803w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-3-266x340.jpg 266w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-3-219x280.jpg 219w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-3-263x336.jpg 263w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-3-526x671.jpg 526w" sizes="(max-width: 273px) 100vw, 273px" /> </a>
                                                                                <div class="hover-img">
                                                                                    <a href="https://demo.xtemos.com/basel/shop/bags/clutch-printed-bag/"> <img width="273" height="348" src="https://xtemos1.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-12.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="https://xtemos1.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-12.jpg 870w, https://xtemos1.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-12-235x300.jpg 235w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-12-768x980.jpg 768w, https://xtemos1.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-12-803x1024.jpg 803w, https://xtemos1.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-12-266x340.jpg 266w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-12-219x280.jpg 219w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-12-263x336.jpg 263w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-12-526x671.jpg 526w" sizes="(max-width: 273px) 100vw, 273px" /> </a>
                                                                                </div>
                                                                                <div class="basel-buttons">
                                                                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-19614">
                                                                                        <div class="yith-wcwl-add-button show" style="display:block"> <a href="/basel/button-with-popup/?add_to_wishlist=19614" rel="nofollow" data-product-id="19614" data-product-type="variable" class="add_to_wishlist"> Add to Wishlist</a> <img src="https://xtemos2.r.worldssl.net/basel/wp-content/plugins/yith-woocommerce-wishlist/assets/images/wpspin_light.gif" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" /></div>
                                                                                        <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"> <span class="feedback">Product added!</span> <a href="https://demo.xtemos.com/basel/wishlist/" rel="nofollow"> Browse Wishlist </a></div>
                                                                                        <div class="yith-wcwl-wishlistexistsbrowse hide" style="display:none"> <span class="feedback">The product is already in the wishlist!</span> <a href="https://demo.xtemos.com/basel/wishlist/" rel="nofollow"> Browse Wishlist </a></div>
                                                                                        <div style="clear:both"></div>
                                                                                        <div class="yith-wcwl-wishlistaddresponse"></div>
                                                                                    </div>
                                                                                    <div class="clear"></div>
                                                                                    <div class="basel-compare-btn product-compare-button"><a class="button" href="https://demo.xtemos.com/basel/compare/" data-added-text="Compare products" data-id="19614">Compare</a></div>
                                                                                    <div class="quick-view"> <a href="https://demo.xtemos.com/basel/shop/bags/clutch-printed-bag/" class="open-quick-view" data-id="19614">Quick View</a></div>
                                                                                </div>
                                                                                <div class="quick-shop-wrapper">
                                                                                    <div class="quick-shop-close"><span>Close</span></div>
                                                                                    <div class="quick-shop-btn"> <a href="#" class="btn-quick-shop" data-id="19614"><span>Quick shop</span></a></div>
                                                                                    <div class="quick-shop-form"></div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="swatches-wrapper">
                                                                                <div class="swatches-on-grid">
                                                                                    <div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-" style="background-color:#0c0c0c;" data-image-src="https://xtemos1.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-12.jpg" data-image-srcset="https://xtemos1.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-12.jpg 870w, https://xtemos1.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-12-235x300.jpg 235w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-12-768x980.jpg 768w, https://xtemos1.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-12-803x1024.jpg 803w, https://xtemos1.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-12-266x340.jpg 266w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-12-219x280.jpg 219w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-12-263x336.jpg 263w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-12-526x671.jpg 526w" data-image-sizes="(max-width: 870px) 100vw, 870px">Black</div>
                                                                                    <div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-" style="background-color:#aa6927;" data-image-src="https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-11.jpg" data-image-srcset="https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-11.jpg 870w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-11-235x300.jpg 235w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-11-768x980.jpg 768w, https://xtemos1.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-11-803x1024.jpg 803w, https://xtemos1.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-11-266x340.jpg 266w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-11-219x280.jpg 219w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-11-263x336.jpg 263w, https://xtemos1.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-11-526x671.jpg 526w" data-image-sizes="(max-width: 870px) 100vw, 870px">Brown</div>
                                                                                    <div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-" style="background-color:#539b2d;" data-image-src="https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-1.jpg" data-image-srcset="https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-1.jpg 870w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-1-235x300.jpg 235w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-1-768x980.jpg 768w, https://xtemos1.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-1-803x1024.jpg 803w, https://xtemos1.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-1-266x340.jpg 266w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-1-219x280.jpg 219w, https://xtemos1.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-1-263x336.jpg 263w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-1-526x671.jpg 526w" data-image-sizes="(max-width: 870px) 100vw, 870px">Green</div>
                                                                                </div>
                                                                            </div>
                                                                            <h3 class="product-title"><a href="https://demo.xtemos.com/basel/shop/bags/clutch-printed-bag/">Clutch printed bag</a></h3><span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&pound;</span>67.00</span>
                                                                        </span>
                                                                        </div>
                                                                        <div class="clearfix visible-xs-block"></div>
                                                                        <div class="product-grid-item basel-hover-quick product  col-xs-6 col-sm-4 col-md-3 type-product post-19615 status-publish instock product_cat-bags product_tag-bag product_tag-basic has-post-thumbnail shipping-taxable purchasable product-type-variable" data-loop="3" data-id="19615">
                                                                            <div class="product-element-top">
                                                                                <a href="https://demo.xtemos.com/basel/shop/bags/ethnic-jacquard-backpack/"> <img width="273" height="348" src="https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-2.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-2.jpg 870w, https://xtemos1.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-2-235x300.jpg 235w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-2-768x980.jpg 768w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-2-803x1024.jpg 803w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-2-266x340.jpg 266w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-2-219x280.jpg 219w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-2-263x336.jpg 263w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-2-526x671.jpg 526w" sizes="(max-width: 273px) 100vw, 273px" /> </a>
                                                                                <div class="hover-img">
                                                                                    <a href="https://demo.xtemos.com/basel/shop/bags/ethnic-jacquard-backpack/"> <img width="273" height="348" src="https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-11.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-11.jpg 870w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-11-235x300.jpg 235w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-11-768x980.jpg 768w, https://xtemos1.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-11-803x1024.jpg 803w, https://xtemos1.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-11-266x340.jpg 266w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-11-219x280.jpg 219w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-11-263x336.jpg 263w, https://xtemos1.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-11-526x671.jpg 526w" sizes="(max-width: 273px) 100vw, 273px" /> </a>
                                                                                </div>
                                                                                <div class="basel-buttons">
                                                                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-19615">
                                                                                        <div class="yith-wcwl-add-button show" style="display:block"> <a href="/basel/button-with-popup/?add_to_wishlist=19615" rel="nofollow" data-product-id="19615" data-product-type="variable" class="add_to_wishlist"> Add to Wishlist</a> <img src="https://xtemos2.r.worldssl.net/basel/wp-content/plugins/yith-woocommerce-wishlist/assets/images/wpspin_light.gif" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" /></div>
                                                                                        <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"> <span class="feedback">Product added!</span> <a href="https://demo.xtemos.com/basel/wishlist/" rel="nofollow"> Browse Wishlist </a></div>
                                                                                        <div class="yith-wcwl-wishlistexistsbrowse hide" style="display:none"> <span class="feedback">The product is already in the wishlist!</span> <a href="https://demo.xtemos.com/basel/wishlist/" rel="nofollow"> Browse Wishlist </a></div>
                                                                                        <div style="clear:both"></div>
                                                                                        <div class="yith-wcwl-wishlistaddresponse"></div>
                                                                                    </div>
                                                                                    <div class="clear"></div>
                                                                                    <div class="basel-compare-btn product-compare-button"><a class="button" href="https://demo.xtemos.com/basel/compare/" data-added-text="Compare products" data-id="19615">Compare</a></div>
                                                                                    <div class="quick-view"> <a href="https://demo.xtemos.com/basel/shop/bags/ethnic-jacquard-backpack/" class="open-quick-view" data-id="19615">Quick View</a></div>
                                                                                </div>
                                                                                <div class="quick-shop-wrapper">
                                                                                    <div class="quick-shop-close"><span>Close</span></div>
                                                                                    <div class="quick-shop-btn"> <a href="#" class="btn-quick-shop" data-id="19615"><span>Quick shop</span></a></div>
                                                                                    <div class="quick-shop-form"></div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="swatches-wrapper">
                                                                                <div class="swatches-on-grid">
                                                                                    <div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-" style="background-color:#0c0c0c;" data-image-src="https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-3.jpg" data-image-srcset="https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-3.jpg 870w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-3-235x300.jpg 235w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-3-768x980.jpg 768w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-3-803x1024.jpg 803w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-3-266x340.jpg 266w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-3-219x280.jpg 219w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-3-263x336.jpg 263w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-3-526x671.jpg 526w" data-image-sizes="(max-width: 870px) 100vw, 870px">Black</div>
                                                                                    <div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-" style="background-color:#aa6927;" data-image-src="https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-2.jpg" data-image-srcset="https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-2.jpg 870w, https://xtemos1.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-2-235x300.jpg 235w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-2-768x980.jpg 768w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-2-803x1024.jpg 803w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-2-266x340.jpg 266w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-2-219x280.jpg 219w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-2-263x336.jpg 263w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-2-526x671.jpg 526w" data-image-sizes="(max-width: 870px) 100vw, 870px">Brown</div>
                                                                                    <div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-" style="background-color:#539b2d;" data-image-src="https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-17.jpg" data-image-srcset="https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-17.jpg 870w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-17-235x300.jpg 235w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-17-768x980.jpg 768w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-17-803x1024.jpg 803w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-17-266x340.jpg 266w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-17-219x280.jpg 219w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-17-263x336.jpg 263w, https://xtemos1.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-17-526x671.jpg 526w" data-image-sizes="(max-width: 870px) 100vw, 870px">Green</div>
                                                                                </div>
                                                                            </div>
                                                                            <h3 class="product-title"><a href="https://demo.xtemos.com/basel/shop/bags/ethnic-jacquard-backpack/">Hylon technical backpack</a></h3><span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&pound;</span>222.00</span>
                                                                        </span>
                                                                        </div>
                                                                        <div class="clearfix visible-sm-block"></div>
                                                                        <div class="product-grid-item basel-hover-quick product  col-xs-6 col-sm-4 col-md-3 last  type-product post-19617 status-publish last instock product_cat-bags product_tag-bag product_tag-basic has-post-thumbnail shipping-taxable purchasable product-type-variable" data-loop="4" data-id="19617">
                                                                            <div class="product-element-top">
                                                                                <a href="https://demo.xtemos.com/basel/shop/bags/gamouflage-print-backpack/"> <img width="273" height="348" src="https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-4.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-4.jpg 870w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-4-235x300.jpg 235w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-4-768x980.jpg 768w, https://xtemos1.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-4-803x1024.jpg 803w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-4-266x340.jpg 266w, https://xtemos1.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-4-219x280.jpg 219w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-4-263x336.jpg 263w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-4-526x671.jpg 526w" sizes="(max-width: 273px) 100vw, 273px" /> </a>
                                                                                <div class="hover-img">
                                                                                    <a href="https://demo.xtemos.com/basel/shop/bags/gamouflage-print-backpack/"> <img width="273" height="348" src="https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-13.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-13.jpg 870w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-13-235x300.jpg 235w, https://xtemos1.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-13-768x980.jpg 768w, https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-13-803x1024.jpg 803w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-13-266x340.jpg 266w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-13-219x280.jpg 219w, https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-13-263x336.jpg 263w, https://xtemos1.r.worldssl.net/basel/wp-content/uploads/2015/10/bag-13-526x671.jpg 526w" sizes="(max-width: 273px) 100vw, 273px" /> </a>
                                                                                </div>
                                                                                <div class="basel-buttons">
                                                                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-19617">
                                                                                        <div class="yith-wcwl-add-button show" style="display:block"> <a href="/basel/button-with-popup/?add_to_wishlist=19617" rel="nofollow" data-product-id="19617" data-product-type="variable" class="add_to_wishlist"> Add to Wishlist</a> <img src="https://xtemos2.r.worldssl.net/basel/wp-content/plugins/yith-woocommerce-wishlist/assets/images/wpspin_light.gif" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" /></div>
                                                                                        <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"> <span class="feedback">Product added!</span> <a href="https://demo.xtemos.com/basel/wishlist/" rel="nofollow"> Browse Wishlist </a></div>
                                                                                        <div class="yith-wcwl-wishlistexistsbrowse hide" style="display:none"> <span class="feedback">The product is already in the wishlist!</span> <a href="https://demo.xtemos.com/basel/wishlist/" rel="nofollow"> Browse Wishlist </a></div>
                                                                                        <div style="clear:both"></div>
                                                                                        <div class="yith-wcwl-wishlistaddresponse"></div>
                                                                                    </div>
                                                                                    <div class="clear"></div>
                                                                                    <div class="basel-compare-btn product-compare-button"><a class="button" href="https://demo.xtemos.com/basel/compare/" data-added-text="Compare products" data-id="19617">Compare</a></div>
                                                                                    <div class="quick-view"> <a href="https://demo.xtemos.com/basel/shop/bags/gamouflage-print-backpack/" class="open-quick-view" data-id="19617">Quick View</a></div>
                                                                                </div>
                                                                                <div class="quick-shop-wrapper">
                                                                                    <div class="quick-shop-close"><span>Close</span></div>
                                                                                    <div class="quick-shop-btn"> <a href="#" class="btn-quick-shop" data-id="19617"><span>Quick shop</span></a></div>
                                                                                    <div class="quick-shop-form"></div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="swatches-wrapper">
                                                                                <div class="swatches-on-grid">
                                                                                    <div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-" style="background-color:#0c0c0c;" data-image-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-3.jpg" data-image-srcset="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-3.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-3-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-3-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-3-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-3-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-3-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-3-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-3-526x671.jpg 526w" data-image-sizes="(max-width: 870px) 100vw, 870px">Black</div>
                                                                                    <div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-" style="background-color:#aa6927;" data-image-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-2.jpg" data-image-srcset="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-2.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-2-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-2-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-2-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-2-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-2-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-2-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-2-526x671.jpg 526w" data-image-sizes="(max-width: 870px) 100vw, 870px">Brown</div>
                                                                                </div>
                                                                            </div>
                                                                            <h3 class="product-title"><a href="https://demo.xtemos.com/basel/shop/bags/gamouflage-print-backpack/">Jacquard ethnic backpack</a></h3><span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&pound;</span>260.00</span>
                                                                        </span>
                                                                        </div>
                                                                        <div class="clearfix visible-xs-block"></div>
                                                                        <div class="clearfix visible-md-block visible-lg-block"></div>
                                                                    </div>
                                                                    <div class="products-footer"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wpb_column vc_column_container vc_col-sm-6">
                                <div class="vc_column-inner">
                                    <div class="wpb_wrapper">
                                        <div class="title-wrapper  basel-title-color-primary basel-title-style-bordered basel-title-size-default text-center vc_custom_1489065813001"><span class="title-subtitle font-default">XTEMOS ELEMENT</span>
                                            <div class="liner-continer"> <span class="left-line"></span>
                                                <h4 class="title">VIDEO POPUP<span class="title-separator"><span></span></span></h4> <span class="right-line"></span></div>
                                        </div>
                                        <div class="basel-button-wrapper text-center"><a href="#video-example" title="" class="btn btn-color-primary btn-style-default btn-size-default basel-popup-with-content ">WATCH VIDEO</a></div>
                                        <div id="video-example" class="mfp-with-anim basel-content-popup mfp-hide" style="max-width:800px;">
                                            <div class="basel-popup-inner">
                                                <div class="wpb_video_widget wpb_content_element vc_clearfix vc_custom_1534238829363 vc_video-aspect-ratio-169 vc_video-el-width-100 vc_video-align-left">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_video_wrapper">
                                                            <div class="basel-video-poster-wrapper">
                                                                <div class="basel-video-poster" style="background-image:url(https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2016/11/basel-gallery-10.jpg)" ;></div>
                                                                <div class="button-play"></div>
                                                            </div>
                                                            <iframe src="https://player.vimeo.com/video/51589652?app_id=122963" width="500" height="281" frameborder="0" title="Timelapse - Lighthouse (Oct 2012)" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="vc_row wpb_row vc_row-fluid vc_custom_1534239777924 vc_row-o-content-top vc_row-flex">
                            <div class="wpb_column vc_column_container vc_col-sm-6">
                                <div class="vc_column-inner vc_custom_1489065426716">
                                    <div class="wpb_wrapper">
                                        <div class="title-wrapper  basel-title-color-primary basel-title-style-bordered basel-title-size-default text-center vc_custom_1489065780917"><span class="title-subtitle font-default">XTEMOS ELEMENT</span>
                                            <div class="liner-continer"> <span class="left-line"></span>
                                                <h4 class="title">POPUP WITH TEXT<span class="title-separator"><span></span></span></h4> <span class="right-line"></span></div>
                                        </div>
                                        <div class="basel-button-wrapper text-center"><a href="#text-popup" title="" class="btn btn-color-primary btn-style-default btn-size-default basel-popup-with-content ">SIMPLE TEXT</a></div>
                                        <div id="text-popup" class="mfp-with-anim basel-content-popup mfp-hide" style="max-width:900px;">
                                            <div class="basel-popup-inner">
                                                <div class="vc_row wpb_row vc_inner vc_row-fluid vc_row-o-equal-height vc_row-flex">
                                                    <div class="wpb_column vc_column_container vc_col-sm-6">
                                                        <div class="vc_column-inner">
                                                            <div class="wpb_wrapper">
                                                                <div class="title-wrapper  basel-title-color-default basel-title-style-default basel-title-size-small text-left vc_custom_1489066164915">
                                                                    <div class="liner-continer"> <span class="left-line"></span>
                                                                        <h4 class="title">Scelerisque a per non a condimentum<span class="title-separator"><span></span></span></h4> <span class="right-line"></span></div>
                                                                </div>
                                                                <div class="wpb_text_column wpb_content_element">
                                                                    <div class="wpb_wrapper">
                                                                        <p>Dis adipiscing a laoreet inceptos adipiscing est per ullamcorper malesuada mi vestibulum elementum tempus leo parturient habitant ut a.Consectetur gravida et ultricies eu parturient convallis aliquam id nam hendrerit vestibulum nec.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="title-wrapper  basel-title-color-default basel-title-style-default basel-title-size-small text-left vc_custom_1489066437801">
                                                                    <div class="liner-continer"> <span class="left-line"></span>
                                                                        <h4 class="title">Parturient a odio vestibulum adipiscing<span class="title-separator"><span></span></span></h4> <span class="right-line"></span></div>
                                                                </div>
                                                                <div class="wpb_text_column wpb_content_element vc_custom_1489066365035">
                                                                    <div class="wpb_wrapper">
                                                                        <p>Dis adipiscing a laoreet inceptos adipiscing est per ullamcorper malesuada mi vestibulum elementum tempus leo parturient habitant ut a.Consectetur gravida et ultricies eu parturient convallis aliquam id nam hendrerit vestibulum nec.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="basel-button-wrapper text-left"><a href="#" title="" class="btn btn-color-primary btn-style-default btn-size-small">READ MORE</a></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="wpb_column vc_column_container vc_col-sm-6">
                                                        <div class="vc_column-inner">
                                                            <div class="wpb_wrapper">
                                                                <div class="title-wrapper  basel-title-color-default basel-title-style-default basel-title-size-small text-left vc_custom_1489066418105">
                                                                    <div class="liner-continer"> <span class="left-line"></span>
                                                                        <h4 class="title">Parturient penatibus amet a parturient<span class="title-separator"><span></span></span></h4> <span class="right-line"></span></div>
                                                                </div>
                                                                <div class="wpb_text_column wpb_content_element">
                                                                    <div class="wpb_wrapper">
                                                                        <p>Dis adipiscing a laoreet inceptos adipiscing est per ullamcorper malesuada mi vestibulum elementum tempus leo parturient habitant ut a.Consectetur gravida et ultricies eu parturient convallis aliquam id nam hendrerit vestibulum nec.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="title-wrapper  basel-title-color-default basel-title-style-default basel-title-size-small text-left vc_custom_1489066427143">
                                                                    <div class="liner-continer"> <span class="left-line"></span>
                                                                        <h4 class="title">Mollis adipiscing at quam parturient<span class="title-separator"><span></span></span></h4> <span class="right-line"></span></div>
                                                                </div>
                                                                <div class="wpb_text_column wpb_content_element vc_custom_1489066369467">
                                                                    <div class="wpb_wrapper">
                                                                        <p>Dis adipiscing a laoreet inceptos adipiscing est per ullamcorper malesuada mi vestibulum elementum tempus leo parturient habitant ut a.Consectetur gravida et ultricies eu parturient convallis aliquam id nam hendrerit vestibulum nec.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="basel-button-wrapper text-left"><a href="#" title="" class="btn btn-color-primary btn-style-default btn-size-small">READ MORE</a></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wpb_column vc_column_container vc_col-sm-6">
                                <div class="vc_column-inner">
                                    <div class="wpb_wrapper">
                                        <div class="title-wrapper  basel-title-color-primary basel-title-style-bordered basel-title-size-default text-center vc_custom_1489066450648"><span class="title-subtitle font-default">XTEMOS ELEMENT</span>
                                            <div class="liner-continer"> <span class="left-line"></span>
                                                <h4 class="title">IMAGES GALLERY IN POPUP<span class="title-separator"><span></span></span></h4> <span class="right-line"></span></div>
                                        </div>
                                        <div class="basel-button-wrapper text-center"><a href="#gallery-example" title="" class="btn btn-color-primary btn-style-default btn-size-default basel-popup-with-content ">SHOW GALLERY</a></div>
                                        <div id="gallery-example" class="mfp-with-anim basel-content-popup mfp-hide" style="max-width:800px;">
                                            <div class="basel-popup-inner">
                                                <div class="vc_row wpb_row vc_inner vc_row-fluid">
                                                    <div class="wpb_column vc_column_container vc_col-sm-12">
                                                        <div class="vc_column-inner vc_custom_1534238812931">
                                                            <div class="wpb_wrapper">
                                                                <div id="gallery_959" class="basel-images-gallery  spacing-10 columns-2 view-grid photoswipe-images">
                                                                    <div class="gallery-images ">
                                                                        <div class="basel-gallery-item">
                                                                            <a href="https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2016/11/basel-gallery-8.jpg" data-index="1" data-width="1900" data-height="1188"> <img class="basel-gallery-image image-1 " src="https://xtemos2.r.worldssl.net/basel/wp-content/uploads/2016/11/basel-gallery-8-900x600.jpg" width="900" height="600" alt="basel-gallery-8" title="basel-gallery-8" /> </a>
                                                                        </div>
                                                                        <div class="basel-gallery-item">
                                                                            <a href="https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2016/11/basel-gallery-10.jpg" data-index="2" data-width="1900" data-height="1188"> <img class="basel-gallery-image image-2 " src="https://xtemos3.r.worldssl.net/basel/wp-content/uploads/2016/11/basel-gallery-10-900x600.jpg" width="900" height="600" alt="basel-gallery-10" title="basel-gallery-10" /> </a>
                                                                        </div>
                                                                        <div class="basel-gallery-item">
                                                                            <a href="https://xtemos1.r.worldssl.net/basel/wp-content/uploads/2016/11/basel-gallery-7.jpg" data-index="3" data-width="1900" data-height="1188"> <img class="basel-gallery-image image-3 " src="https://xtemos1.r.worldssl.net/basel/wp-content/uploads/2016/11/basel-gallery-7-900x600.jpg" width="900" height="600" alt="basel-gallery-7" title="basel-gallery-7" /> </a>
                                                                        </div>
                                                                        <div class="basel-gallery-item">
                                                                            <a href="https://xtemos1.r.worldssl.net/basel/wp-content/uploads/2016/11/basel-gallery-6.jpg" data-index="4" data-width="1900" data-height="1188"> <img class="basel-gallery-image image-4 " src="https://xtemos1.r.worldssl.net/basel/wp-content/uploads/2016/11/basel-gallery-6-900x600.jpg" width="900" height="600" alt="basel-gallery-6" title="basel-gallery-6" /> </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>


@endsection
@push('scripts')
<script type="text/javascript" src="{{asset('plugins/select2/js/select2.full.min.js')}}?ver=1.0.4"></script>


@endpush