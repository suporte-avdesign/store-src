<div data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row wpb_row vc_row-fluid vc_custom_1477937331390 vc_row-has-fill">
    <!-- banner -->
    <div class="wpb_column vc_column_container vc_col-sm-3 vc_col-lg-3 vc_col-md-3 vc_hidden-md vc_hidden-sm vc_hidden-xs">
        <div class="vc_column-inner">
            <div class="wpb_wrapper">
                <div class="promo-banner cursor-pointer text-center vertical-alignment-top banner- hover-1 color-scheme-light" onclick="window.location.href='#'">
                    <div class="main-wrapp-img">
                        <div class="banner-image">
                            <img class="promo-banner-image image-1" src="{{asset('faker/banners/home/featured-1.jpg')}}" width="292" height="420" alt="Produtos em Destaque" title="Produtos em Destaque" />
                        </div>
                    </div>
                    <!--
                    <div class="wrapper-content-baner">
                        <div class="banner-inner">
                            <p><strong style="background: white; color: #0967d0; padding: 2px 15px 0; line-height: 1.2;">EXTREMO</strong></p>
                            <h2 style="margin: -5px 0 10px; font-weight: bold;">Titulo 1</h2>
                            <p style="margin-bottom: 10px; padding: 0 10px;">Descrição 1</p>
                            <p><a class="btn btn-color-primary btn-size-small" href="#">Link 1</a></p>
                        </div>
                    </div>
                    -->
                </div>

            </div>
        </div>
    </div>

    <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-9 vc_col-md-12 vc_col-xs-12">
        <div class="vc_column-inner">
            <div class="wpb_wrapper">
                <div class="basel-products-tabs tabs-6313">
                    <div class="basel-products-loader"></div>
                    <div class="basel-tabs-header">
                        <div class="tabs-name">
                            <img width="32" height="32" src="{{asset('themes/images/icons/computer.png')}}" class="tabs-icon attachment-full" alt=" " />
                            <span>Feminino</span>
                        </div>
                        <div class="tabs-navigation-wrapper">
                            <span class="open-title-menu ">Novos</span>
                            <ul class="products-tabs-title">
                                <li data-atts="{&quot;title&quot;:&quot;Novos&quot;,&quot;layout&quot;:&quot;carousel&quot;,&quot;post_type&quot;:&quot;ids&quot;,&quot;items_per_page&quot;:&quot;6&quot;,&quot;product_hover&quot;:&quot;base&quot;,&quot;slides_per_view&quot;:&quot;4&quot;,&quot;hide_pagination_control&quot;:&quot;yes&quot;,&quot;include&quot;:&quot;25156, 25155, 25154, 25153, 25152, 25139&quot;,&quot;carousel_js_inline&quot;:&quot;yes&quot;}" class="active-tab-title">
                                    <span class="tab-label">Novos</span>
                                </li>
                                <li data-atts="{&quot;title&quot;:&quot;Ofertas&quot;,&quot;layout&quot;:&quot;carousel&quot;,&quot;post_type&quot;:&quot;ids&quot;,&quot;items_per_page&quot;:&quot;6&quot;,&quot;product_hover&quot;:&quot;base&quot;,&quot;slides_per_view&quot;:&quot;4&quot;,&quot;hide_pagination_control&quot;:&quot;yes&quot;,&quot;include&quot;:&quot;25157, 25170, 25171, 25173, 25174, 25175&quot;,&quot;carousel_js_inline&quot;:&quot;yes&quot;}" class="" ">
                                    <span class="tab-label ">Ofertas</span>
                                </li>
                                <li data-atts="{&quot;title&quot;:&quot;Destaque&quot;,&quot;layout&quot;:&quot;carousel&quot;,&quot;post_type&quot;:&quot;ids&quot;,&quot;items_per_page&quot;:&quot;12&quot;,&quot;product_hover&quot;:&quot;base&quot;,&quot;slides_per_view&quot;:&quot;4&quot;,&quot;hide_pagination_control&quot;:&quot;yes&quot;,&quot;orderby&quot;:&quot;rand&quot;,&quot;include&quot;:&quot;25157, 25170, 25171, 25173, 25174, 25175, 25156, 25155, 25154, 25153, 25152, 25139&quot;,&quot;carousel_js_inline&quot;:&quot;yes&quot;} " class=" "">
                                    <span class="tab-label">Destaque</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="basel-tab-content">

                        <script type="text/javascript">
                            jQuery(document).ready(function($) {

                                var owl = $("#carousel-302 .owl-carousel");

                                $(window).bind("vc_js", function() {
                                    owl.trigger('refresh.owl.carousel');
                                });

                                var options = {
                                    rtl: $('body').hasClass('rtl'),
                                    items: 4,
                                    responsive: {
                                        979: {
                                            items: 4
                                        },
                                        768: {
                                            items: 3
                                        },
                                        479: {
                                            items: 3
                                        },
                                        0: {
                                            items: 2
                                        }
                                    },
                                    autoplay: false,
                                    autoplayTimeout: 5000,
                                    dots: false,
                                    nav: true,
                                    autoheight: true,
                                    slideBy: 'page',
                                    center: false,
                                    navText: false,
                                    loop: false,
                                    onRefreshed: function() {
                                        $(window).resize();
                                    }
                                };

                                owl.owlCarousel(options);

                            });
                        </script>

                        <div id="carousel-302" class="vc_carousel_container">
                            <div class="owl-carousel product-items">

                                <!-- produto 1 -->
                                <div class="product-item owl-carousel-item">
                                    <div class="owl-carousel-item-inner">
                                        <div class="product-grid-item basel-hover-base product product-in-carousel post-25156 type-product status-publish has-post-thumbnail product_cat-marketplace first instock shipping-taxable purchasable product-type-simple" data-loop="1" data-id="25156">

                                            <div class="product-element-top">
                                                <a href="{{url('product')}}/categoria/secao/produto-25156">
                                                    <img width="273" height="273" src="{{asset('faker/product_photos/img3-f.jpg')}}"
                                                         class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                         alt=""
                                                         srcset="{{asset('faker/product_photos/img3-f.jpg')}} 870w,
                                                         {{asset('faker/product_photos/img3-f.jpg')}} 235w,
                                                         {{asset('faker/product_photos/img3-f.jpg')}} 768w,
                                                         {{asset('faker/product_photos/img3-f.jpg')}} 803w,
                                                         {{asset('faker/product_photos/img3-f.jpg')}} 266w,
                                                         {{asset('faker/product_photos/img3-f.jpg')}} 219w,
                                                         {{asset('faker/product_photos/img3-f.jpg')}} 263w,
                                                         {{asset('faker/product_photos/img3-f.jpg')}} 526w"
                                                         sizes="(max-width: 273px) 100vw, 273px"
                                                    />
                                                </a>
                                                <div class="hover-img">
                                                    <a href="{{url('product')}}/categoria/secao/produto-1002">
                                                        <img width="273" height="273" src="{{asset('faker/product_photos/img3-l.jpg')}}"
                                                             class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                             alt=""
                                                             srcset="{{asset('faker/product_photos/img3-l.jpg')}} 870w,
                                                             {{asset('faker/product_photos/img3-l.jpg')}} 235w,
                                                             {{asset('faker/product_photos/img3-l.jpg')}} 768w,
                                                             {{asset('faker/product_photos/img3-l.jpg')}} 803w,
                                                             {{asset('faker/product_photos/img3-l.jpg')}} 266w,
                                                             {{asset('faker/product_photos/img3-l.jpg')}} 219w,
                                                             {{asset('faker/product_photos/img3-l.jpg')}} 263w,
                                                             {{asset('faker/product_photos/img3-l.jpg')}} 526w"
                                                             sizes="(max-width: 273px) 100vw, 273px"
                                                        />
                                                    </a>
                                                </div>
                                                <div class="hover-mask">
                                                    <div class="basel-add-btn">
                                                        <a href="/basel/shop/?add-to-cart=25156"
                                                           data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                                           data-product_id="25156"
                                                           data-product_sku=""
                                                           aria-label="Adicione o produto 1 ao seu carrinho"
                                                           rel="nofollow">Adicionar ao carrinho
                                                        </a>
                                                    </div>

                                                    <div class="quick-view">
                                                        <a href="{{url('product.show')}}" class="open-quick-view" data-id="25156">Vusualização Rapida</a>
                                                    </div>

                                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-25156">
                                                        <div class="yith-wcwl-add-button show" style="display:block">
                                                            <a href="{{route('wishlist.store')}}?add_to_wishlist=25156" rel="nofollow" data-product-id="25156" data-product-type="simple" class="add_to_wishlist">
                                                                Adicionar a lista de desejos
                                                            </a>
                                                            <img src="{{asset('themes/images/loader/wpspin_light.gif')}}" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" />
                                                        </div>

                                                        <div class="yith-wcwl-wishlistaddedbrowse hide">
                                                            <span class="feedback">Produto Adicionado!</span>
                                                            <a href="{{route('wishlist')}}" rel="nofollow">Ver lista de desejos</a>
                                                        </div>

                                                        <div class="yith-wcwl-wishlistexistsbrowse hide">
                                                            <span class="feedback">O produto já está na lista de desejos!</span>
                                                            <a href="{{route('wishlist')}}" rel="nofollow">Ver lista de desejos</a>
                                                        </div>

                                                        <div style="clear:both"></div>
                                                        <div class="yith-wcwl-wishlistaddresponse"></div>
                                                    </div>

                                                    <div class="clear"></div>
                                                    <div class="basel-compare-btn product-compare-button">
                                                        <a class="button" href="{{route('compare')}}" data-added-text="Compare este produto" data-id="25156">Compare</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="{{url('product')}}/categoria/secao/produto-25156">Produto 1</a>
                                            </h3>

                                            <span class="price">
                                                <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol">R$ </span>70,00
                                                </span>
                                            </span>

                                        </div>
                                    </div>
                                </div>

                                <!-- produto 2 -->
                                <div class="product-item owl-carousel-item">
                                    <div class="owl-carousel-item-inner">
                                        <div class="product-grid-item basel-hover-base product product-in-carousel post-25155 type-product status-publish has-post-thumbnail product_cat-marketplace instock shipping-taxable purchasable product-type-simple" data-loop="2" data-id="25155">
                                            <div class="product-element-top">
                                                <a href="{{url('product')}}/categoria/secao/produto-25155">
                                                    <img width="273" height="273" src="{{asset('faker/product_photos/img1-f.jpg')}}"
                                                         class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                         alt=""
                                                         srcset="{{asset('faker/product_photos/img1-f.jpg')}} 870w,
                                                         {{asset('faker/product_photos/img1-f.jpg')}} 235w,
                                                         {{asset('faker/product_photos/img1-f.jpg')}} 768w,
                                                         {{asset('faker/product_photos/img1-f.jpg')}} 803w,
                                                         {{asset('faker/product_photos/img1-f.jpg')}} 266w,
                                                         {{asset('faker/product_photos/img1-f.jpg')}} 219w,
                                                         {{asset('faker/product_photos/img1-f.jpg')}} 263w,
                                                         {{asset('faker/product_photos/img1-f.jpg')}} 526w"
                                                         sizes="(max-width: 273px) 100vw, 273px"
                                                    />
                                                </a>
                                                <div class="hover-img">
                                                    <a href="{{url('product')}}/categoria/secao/produto-25155">
                                                        <img width="273" height="273" src="{{asset('faker/product_photos/img1-l.jpg')}}"
                                                             class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                             alt=""
                                                             srcset="{{asset('faker/product_photos/img1-l.jpg')}} 870w,
                                                             {{asset('faker/product_photos/img1-l.jpg')}} 235w,
                                                             {{asset('faker/product_photos/img1-l.jpg')}} 768w,
                                                             {{asset('faker/product_photos/img1-l.jpg')}} 803w,
                                                             {{asset('faker/product_photos/img1-l.jpg')}} 266w,
                                                             {{asset('faker/product_photos/img1-l.jpg')}} 219w,
                                                             {{asset('faker/product_photos/img1-l.jpg')}} 263w,
                                                             {{asset('faker/product_photos/img1-l.jpg')}} 526w"
                                                             sizes="(max-width: 273px) 100vw, 273px"
                                                        />
                                                    </a>
                                                </div>
                                                <div class="hover-mask">
                                                    <div class="basel-add-btn">
                                                        <a href="/basel/shop/?add-to-cart=25155"
                                                           data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                                           data-product_id="25155"
                                                           data-product_sku=""
                                                           aria-label="Adicione o produto 2 ao seu carrinho"
                                                           rel="nofollow">Adicionar ao carrinho
                                                        </a>
                                                    </div>

                                                    <div class="quick-view">
                                                        <a href="{{url('product.show')}}" class="open-quick-view" data-id="25155">Vusualização Rapida</a>
                                                    </div>

                                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-25155">
                                                        <div class="yith-wcwl-add-button show" style="display:block">
                                                            <a href="{{route('wishlist.store')}}?add_to_wishlist=25155" rel="nofollow" data-product-id="25155" data-product-type="simple" class="add_to_wishlist">
                                                                Adicionar a lista de desejos
                                                            </a>
                                                            <img src="{{asset('themes/images/loader/wpspin_light.gif')}}" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" />
                                                        </div>

                                                        <div class="yith-wcwl-wishlistaddedbrowse hide">
                                                            <span class="feedback">Produto Adicionado!</span>
                                                            <a href="{{route('wishlist')}}" rel="nofollow">Ver lista de desejos</a>
                                                        </div>

                                                        <div class="yith-wcwl-wishlistexistsbrowse hide">
                                                            <span class="feedback">O produto já está na lista de desejos!</span>
                                                            <a href="{{route('wishlist')}}" rel="nofollow">Ver lista de desejos</a>
                                                        </div>

                                                        <div style="clear:both"></div>
                                                        <div class="yith-wcwl-wishlistaddresponse"></div>
                                                    </div>

                                                    <div class="clear"></div>
                                                    <div class="basel-compare-btn product-compare-button">
                                                        <a class="button" href="{{route('compare')}}" data-added-text="Compare este produto" data-id="25155">Compare</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="{{url('product')}}/categoria/secao/produto-25155">Produto 2</a>
                                            </h3>

                                            <span class="price">
                                                <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol">R$ </span>70,00
                                                </span>
                                            </span>

                                        </div>
                                    </div>
                                </div>

                                <!-- produto 3 -->
                                <div class="product-item owl-carousel-item">
                                    <div class="owl-carousel-item-inner">
                                        <div class="product-grid-item basel-hover-base product product-in-carousel post-25154 type-product status-publish has-post-thumbnail product_cat-marketplace instock shipping-taxable purchasable product-type-simple" data-loop="3" data-id="25154">

                                            <div class="product-element-top">
                                                <a href="{{url('product')}}/categoria/secao/produto-25154">
                                                    <img width="273" height="273" src="{{asset('faker/product_photos/img5-f.jpg')}}"
                                                         class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                         alt=""
                                                         srcset="{{asset('faker/product_photos/img5-f.jpg')}} 870w,
                                                         {{asset('faker/product_photos/img5-f.jpg')}} 235w,
                                                         {{asset('faker/product_photos/img5-f.jpg')}} 768w,
                                                         {{asset('faker/product_photos/img5-f.jpg')}} 803w,
                                                         {{asset('faker/product_photos/img5-f.jpg')}} 266w,
                                                         {{asset('faker/product_photos/img5-f.jpg')}} 219w,
                                                         {{asset('faker/product_photos/img5-f.jpg')}} 263w,
                                                         {{asset('faker/product_photos/img5-f.jpg')}} 526w"
                                                         sizes="(max-width: 273px) 100vw, 273px"
                                                    />
                                                </a>
                                                <div class="hover-img">
                                                    <a href="{{url('product')}}/categoria/secao/produto-25154">
                                                        <img width="273" height="273" src="{{asset('faker/product_photos/img5-l.jpg')}}"
                                                             class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                             alt=""
                                                             srcset="{{asset('faker/product_photos/img5-l.jpg')}} 870w,
                                                             {{asset('faker/product_photos/img5-l.jpg')}} 235w,
                                                             {{asset('faker/product_photos/img5-l.jpg')}} 768w,
                                                             {{asset('faker/product_photos/img5-l.jpg')}} 803w,
                                                             {{asset('faker/product_photos/img5-l.jpg')}} 266w,
                                                             {{asset('faker/product_photos/img5-l.jpg')}} 219w,
                                                             {{asset('faker/product_photos/img5-l.jpg')}} 263w,
                                                             {{asset('faker/product_photos/img5-l.jpg')}} 526w"
                                                             sizes="(max-width: 273px) 100vw, 273px"
                                                        />
                                                    </a>
                                                </div>
                                                <div class="hover-mask">
                                                    <div class="basel-add-btn">
                                                        <a href="/basel/shop/?add-to-cart=25154"
                                                           data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                                           data-product_id="25154"
                                                           data-product_sku=""
                                                           aria-label="Adicione o produto 3 ao seu carrinho"
                                                           rel="nofollow">Adicionar ao carrinho
                                                        </a>
                                                    </div>

                                                    <div class="quick-view">
                                                        <a href="{{url('product.show')}}" class="open-quick-view" data-id="25154">Vusualização Rapida</a>
                                                    </div>

                                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-25154">
                                                        <div class="yith-wcwl-add-button show" style="display:block">
                                                            <a href="{{route('wishlist.store')}}?add_to_wishlist=25154" rel="nofollow" data-product-id="25154" data-product-type="simple" class="add_to_wishlist">
                                                                Adicionar a lista de desejos
                                                            </a>
                                                            <img src="{{asset('themes/images/loader/wpspin_light.gif')}}" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" />
                                                        </div>

                                                        <div class="yith-wcwl-wishlistaddedbrowse hide">
                                                            <span class="feedback">Produto Adicionado!</span>
                                                            <a href="{{route('wishlist')}}" rel="nofollow">Ver lista de desejos</a>
                                                        </div>

                                                        <div class="yith-wcwl-wishlistexistsbrowse hide">
                                                            <span class="feedback">O produto já está na lista de desejos!</span>
                                                            <a href="{{route('wishlist')}}" rel="nofollow">Ver lista de desejos</a>
                                                        </div>

                                                        <div style="clear:both"></div>
                                                        <div class="yith-wcwl-wishlistaddresponse"></div>
                                                    </div>

                                                    <div class="clear"></div>
                                                    <div class="basel-compare-btn product-compare-button">
                                                        <a class="button" href="{{route('compare')}}" data-added-text="Compare este produto" data-id="25154">Compare</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="{{url('product')}}/categoria/secao/produto-25154">Produto 3</a>
                                            </h3>

                                            <span class="price">
                                                <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol">R$ </span>70,00
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- produto 4 -->
                                <div class="product-item owl-carousel-item">
                                    <div class="owl-carousel-item-inner">
                                        <div class="product-grid-item basel-hover-base product product-in-carousel post-25153 type-product status-publish has-post-thumbnail product_cat-marketplace last instock shipping-taxable purchasable product-type-simple" data-loop="4" data-id="25153">

                                            <div class="product-element-top">
                                                <a href="{{url('product')}}/categoria/secao/produto-25153">
                                                    <img width="273" height="273" src="{{asset('faker/product_photos/img7-f.jpg')}}"
                                                         class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                         alt=""
                                                         srcset="{{asset('faker/product_photos/img7-f.jpg')}} 870w,
                                                         {{asset('faker/product_photos/img7-f.jpg')}} 235w,
                                                         {{asset('faker/product_photos/img7-f.jpg')}} 768w,
                                                         {{asset('faker/product_photos/img7-f.jpg')}} 803w,
                                                         {{asset('faker/product_photos/img7-f.jpg')}} 266w,
                                                         {{asset('faker/product_photos/img7-f.jpg')}} 219w,
                                                         {{asset('faker/product_photos/img7-f.jpg')}} 263w,
                                                         {{asset('faker/product_photos/img7-f.jpg')}} 526w"
                                                         sizes="(max-width: 273px) 100vw, 273px"
                                                    />
                                                </a>
                                                <div class="hover-img">
                                                    <a href="{{url('product')}}/categoria/secao/produto-25153">
                                                        <img width="273" height="273" src="{{asset('faker/product_photos/img7-l.jpg')}}"
                                                             class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                             alt=""
                                                             srcset="{{asset('faker/product_photos/img7-l.jpg')}} 870w,
                                                             {{asset('faker/product_photos/img7-l.jpg')}} 235w,
                                                             {{asset('faker/product_photos/img7-l.jpg')}} 768w,
                                                             {{asset('faker/product_photos/img7-l.jpg')}} 803w,
                                                             {{asset('faker/product_photos/img7-l.jpg')}} 266w,
                                                             {{asset('faker/product_photos/img7-l.jpg')}} 219w,
                                                             {{asset('faker/product_photos/img7-l.jpg')}} 263w,
                                                             {{asset('faker/product_photos/img7-l.jpg')}} 526w"
                                                             sizes="(max-width: 273px) 100vw, 273px"
                                                        />
                                                    </a>
                                                </div>
                                                <div class="hover-mask">
                                                    <div class="basel-add-btn">
                                                        <a href="/basel/shop/?add-to-cart=25153"
                                                           data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                                           data-product_id="25153"
                                                           data-product_sku=""
                                                           aria-label="Adicione o produto 4 ao seu carrinho"
                                                           rel="nofollow">Adicionar ao carrinho
                                                        </a>
                                                    </div>

                                                    <div class="quick-view">
                                                        <a href="{{url('product.show')}}" class="open-quick-view" data-id="25153">Vusualização Rapida</a>
                                                    </div>

                                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-25153">
                                                        <div class="yith-wcwl-add-button show" style="display:block">
                                                            <a href="{{route('wishlist.store')}}?add_to_wishlist=25153" rel="nofollow" data-product-id="25153" data-product-type="simple" class="add_to_wishlist">
                                                                Adicionar a lista de desejos
                                                            </a>
                                                            <img src="{{asset('themes/images/loader/wpspin_light.gif')}}" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" />
                                                        </div>

                                                        <div class="yith-wcwl-wishlistaddedbrowse hide">
                                                            <span class="feedback">Produto Adicionado!</span>
                                                            <a href="{{route('wishlist')}}" rel="nofollow">Ver lista de desejos</a>
                                                        </div>

                                                        <div class="yith-wcwl-wishlistexistsbrowse hide">
                                                            <span class="feedback">O produto já está na lista de desejos!</span>
                                                            <a href="{{route('wishlist')}}" rel="nofollow">Ver lista de desejos</a>
                                                        </div>

                                                        <div style="clear:both"></div>
                                                        <div class="yith-wcwl-wishlistaddresponse"></div>
                                                    </div>

                                                    <div class="clear"></div>
                                                    <div class="basel-compare-btn product-compare-button">
                                                        <a class="button" href="{{route('compare')}}" data-added-text="Compare este produto" data-id="25153">Compare</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="{{url('product')}}/categoria/secao/produto-25153">Produto 4</a>
                                            </h3>

                                            <span class="price">
                                                <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol">R$ </span>70,00
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- produto 5 -->
                                <div class="product-item owl-carousel-item">
                                    <div class="owl-carousel-item-inner">
                                        <div class="product-grid-item basel-hover-base product product-in-carousel post-25152 type-product status-publish has-post-thumbnail product_cat-marketplace first instock shipping-taxable purchasable product-type-simple" data-loop="5" data-id="25152">
                                            <div class="product-element-top">
                                                <a href="{{url('product')}}/categoria/secao/produto-25152">
                                                    <img width="273" height="273" src="{{asset('faker/product_photos/img9-f.jpg')}}"
                                                         class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                         alt=""
                                                         srcset="{{asset('faker/product_photos/img9-f.jpg')}} 870w,
                                                         {{asset('faker/product_photos/img9-f.jpg')}} 235w,
                                                         {{asset('faker/product_photos/img9-f.jpg')}} 768w,
                                                         {{asset('faker/product_photos/img9-f.jpg')}} 803w,
                                                         {{asset('faker/product_photos/img9-f.jpg')}} 266w,
                                                         {{asset('faker/product_photos/img9-f.jpg')}} 219w,
                                                         {{asset('faker/product_photos/img9-f.jpg')}} 263w,
                                                         {{asset('faker/product_photos/img9-f.jpg')}} 526w"
                                                         sizes="(max-width: 273px) 100vw, 273px"
                                                    />
                                                </a>
                                                <div class="hover-img">
                                                    <a href="{{url('product')}}/categoria/secao/produto-25152">
                                                        <img width="273" height="273" src="{{asset('faker/product_photos/img9-l.jpg')}}"
                                                             class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                             alt=""
                                                             srcset="{{asset('faker/product_photos/img9-l.jpg')}} 870w,
                                                             {{asset('faker/product_photos/img9-l.jpg')}} 235w,
                                                             {{asset('faker/product_photos/img9-l.jpg')}} 768w,
                                                             {{asset('faker/product_photos/img9-l.jpg')}} 803w,
                                                             {{asset('faker/product_photos/img9-l.jpg')}} 266w,
                                                             {{asset('faker/product_photos/img9-l.jpg')}} 219w,
                                                             {{asset('faker/product_photos/img9-l.jpg')}} 263w,
                                                             {{asset('faker/product_photos/img9-l.jpg')}} 526w"
                                                             sizes="(max-width: 273px) 100vw, 273px"
                                                        />
                                                    </a>
                                                </div>
                                                <div class="hover-mask">
                                                    <div class="basel-add-btn">
                                                        <a href="/basel/shop/?add-to-cart=25152"
                                                           data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                                           data-product_id="25152"
                                                           data-product_sku=""
                                                           aria-label="Adicione o produto 5 ao seu carrinho"
                                                           rel="nofollow">Adicionar ao carrinho
                                                        </a>
                                                    </div>

                                                    <div class="quick-view">
                                                        <a href="{{url('product.show')}}" class="open-quick-view" data-id="25152">Vusualização Rapida</a>
                                                    </div>

                                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-25152">
                                                        <div class="yith-wcwl-add-button show" style="display:block">
                                                            <a href="{{route('wishlist.store')}}?add_to_wishlist=25152" rel="nofollow" data-product-id="25152" data-product-type="simple" class="add_to_wishlist">
                                                                Adicionar a lista de desejos
                                                            </a>
                                                            <img src="{{asset('themes/images/loader/wpspin_light.gif')}}" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" />
                                                        </div>

                                                        <div class="yith-wcwl-wishlistaddedbrowse hide">
                                                            <span class="feedback">Produto Adicionado!</span>
                                                            <a href="{{route('wishlist')}}" rel="nofollow">Ver lista de desejos</a>
                                                        </div>

                                                        <div class="yith-wcwl-wishlistexistsbrowse hide">
                                                            <span class="feedback">O produto já está na lista de desejos!</span>
                                                            <a href="{{route('wishlist')}}" rel="nofollow">Ver lista de desejos</a>
                                                        </div>

                                                        <div style="clear:both"></div>
                                                        <div class="yith-wcwl-wishlistaddresponse"></div>
                                                    </div>

                                                    <div class="clear"></div>
                                                    <div class="basel-compare-btn product-compare-button">
                                                        <a class="button" href="{{route('compare')}}" data-added-text="Compare este produto" data-id="25152">Compare</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="{{url('product')}}/categoria/secao/produto-25152">Produto 5</a>
                                            </h3>

                                            <span class="price">
                                                <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol">R$ </span>70,00
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- produto 6 -->
                                <div class="product-item owl-carousel-item">
                                    <div class="owl-carousel-item-inner">
                                        <div class="product-grid-item basel-hover-base product product-in-carousel post-25139 type-product status-publish has-post-thumbnail product_cat-marketplace instock shipping-taxable purchasable product-type-simple" data-loop="6" data-id="25139">
                                            <div class="product-element-top">
                                                <a href="{{url('product')}}/categoria/secao/produto-25139">
                                                    <img width="273" height="273" src="{{asset('faker/product_photos/img10-f.jpg')}}"
                                                         class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                         alt=""
                                                         srcset="{{asset('faker/product_photos/img10-f.jpg')}} 870w,
                                                         {{asset('faker/product_photos/img10-f.jpg')}} 235w,
                                                         {{asset('faker/product_photos/img10-f.jpg')}} 768w,
                                                         {{asset('faker/product_photos/img10-f.jpg')}} 803w,
                                                         {{asset('faker/product_photos/img10-f.jpg')}} 266w,
                                                         {{asset('faker/product_photos/img10-f.jpg')}} 219w,
                                                         {{asset('faker/product_photos/img10-f.jpg')}} 263w,
                                                         {{asset('faker/product_photos/img10-f.jpg')}} 526w"
                                                         sizes="(max-width: 273px) 100vw, 273px"
                                                    />
                                                </a>
                                                <div class="hover-img">
                                                    <a href="{{url('product')}}/categoria/secao/produto-25139">
                                                        <img width="273" height="273" src="{{asset('faker/product_photos/img10-l.jpg')}}"
                                                             class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                             alt=""
                                                             srcset="{{asset('faker/product_photos/img10-l.jpg')}} 870w,
                                                             {{asset('faker/product_photos/img10-l.jpg')}} 235w,
                                                             {{asset('faker/product_photos/img10-l.jpg')}} 768w,
                                                             {{asset('faker/product_photos/img10-l.jpg')}} 803w,
                                                             {{asset('faker/product_photos/img10-l.jpg')}} 266w,
                                                             {{asset('faker/product_photos/img10-l.jpg')}} 219w,
                                                             {{asset('faker/product_photos/img10-l.jpg')}} 263w,
                                                             {{asset('faker/product_photos/img10-l.jpg')}} 526w"
                                                             sizes="(max-width: 273px) 100vw, 273px"
                                                        />
                                                    </a>
                                                </div>
                                                <div class="hover-mask">
                                                    <div class="basel-add-btn">
                                                        <a href="/basel/shop/?add-to-cart=25139"
                                                           data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                                           data-product_id="25139"
                                                           data-product_sku=""
                                                           aria-label="Adicione o produto 6 ao seu carrinho"
                                                           rel="nofollow">Adicionar ao carrinho
                                                        </a>
                                                    </div>

                                                    <div class="quick-view">
                                                        <a href="{{url('product.show')}}" class="open-quick-view" data-id="25139">Vusualização Rapida</a>
                                                    </div>

                                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-25139">
                                                        <div class="yith-wcwl-add-button show" style="display:block">
                                                            <a href="{{route('wishlist.store')}}?add_to_wishlist=25139" rel="nofollow" data-product-id="25139" data-product-type="simple" class="add_to_wishlist">
                                                                Adicionar a lista de desejos
                                                            </a>
                                                            <img src="{{asset('themes/images/loader/wpspin_light.gif')}}" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" />
                                                        </div>

                                                        <div class="yith-wcwl-wishlistaddedbrowse hide">
                                                            <span class="feedback">Produto Adicionado!</span>
                                                            <a href="{{route('wishlist')}}" rel="nofollow">Ver lista de desejos</a>
                                                        </div>

                                                        <div class="yith-wcwl-wishlistexistsbrowse hide">
                                                            <span class="feedback">O produto já está na lista de desejos!</span>
                                                            <a href="{{route('wishlist')}}" rel="nofollow">Ver lista de desejos</a>
                                                        </div>

                                                        <div style="clear:both"></div>
                                                        <div class="yith-wcwl-wishlistaddresponse"></div>
                                                    </div>

                                                    <div class="clear"></div>
                                                    <div class="basel-compare-btn product-compare-button">
                                                        <a class="button" href="{{route('compare')}}" data-added-text="Compare este produto" data-id="25139">Compare</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <h3 class="product-title">
                                                <a href="{{url('product')}}/categoria/secao/produto-25139">Produto 6</a>
                                            </h3>

                                            <span class="price">
                                                <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol">R$ </span>70,00
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- end product-items -->
                        </div>
                        <!-- end #carousel-302 -->

                    </div>
                    <style type="text/css">
                        .tabs-6313 .tabs-name {
                            background: #b4c51b
                        }

                        .basel-products-tabs.tabs-6313 .products-tabs-title .active-tab-title {
                            color: #b4c51b
                        }

                        .tabs-6313 .basel-tabs-header {
                            border-color: #b4c51b
                        }
                    </style>
                </div>
            </div>
        </div>
    </div>
</div>