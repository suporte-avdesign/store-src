<script type="text/javascript">
    jQuery(document).ready(function($) {

        var owl = $("#carousel-985 .owl-carousel");

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

<div id="carousel-985" class="vc_carousel_container">
    <div class="owl-carousel product-items">

        <!-- produto 1 -->
        <div class="product-item owl-carousel-item">
            <div class="owl-carousel-item-inner">
                <div class="product-grid-item basel-hover-base product product-in-carousel post-25157 type-product status-publish has-post-thumbnail product_cat-marketplace first instock shipping-taxable purchasable product-type-simple" data-loop="1" data-id="25157">

                    <div class="product-element-top">
                        <a href="{{url('product')}}/categoria/secao/produto-25157">
                            <img width="273" height="273" src="{{asset('faker/product_photos/img12-f.jpg')}}"
                                 class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                 alt=""
                                 srcset="{{asset('faker/product_photos/img12-f.jpg')}} 870w,
                                         {{asset('faker/product_photos/img12-f.jpg')}} 235w,
                                         {{asset('faker/product_photos/img12-f.jpg')}} 768w,
                                         {{asset('faker/product_photos/img12-f.jpg')}} 803w,
                                         {{asset('faker/product_photos/img12-f.jpg')}} 266w,
                                         {{asset('faker/product_photos/img12-f.jpg')}} 219w,
                                         {{asset('faker/product_photos/img12-f.jpg')}} 263w,
                                         {{asset('faker/product_photos/img12-f.jpg')}} 526w"
                                 sizes="(max-width: 273px) 100vw, 273px"
                            />
                        </a>
                        <div class="hover-img">
                            <a href="{{url('product')}}/categoria/secao/produto-1002">
                                <img width="273" height="273" src="{{asset('faker/product_photos/img12-l.jpg')}}"
                                     class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                     alt=""
                                     srcset="{{asset('faker/product_photos/img12-l.jpg')}} 870w,
                                             {{asset('faker/product_photos/img12-l.jpg')}} 235w,
                                             {{asset('faker/product_photos/img12-l.jpg')}} 768w,
                                             {{asset('faker/product_photos/img12-l.jpg')}} 803w,
                                             {{asset('faker/product_photos/img12-l.jpg')}} 266w,
                                             {{asset('faker/product_photos/img12-l.jpg')}} 219w,
                                             {{asset('faker/product_photos/img12-l.jpg')}} 263w,
                                             {{asset('faker/product_photos/img12-l.jpg')}} 526w"
                                     sizes="(max-width: 273px) 100vw, 273px"
                                />
                            </a>
                        </div>
                        <div class="hover-mask">
                            <div class="basel-add-btn">
                                <a href="/basel/shop/?add-to-cart=25157"
                                   data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                   data-product_id="25157"
                                   data-product_sku=""
                                   aria-label="Adicione o produto 1 ao seu carrinho"
                                   rel="nofollow">Adicionar ao carrinho
                                </a>
                            </div>

                            <div class="quick-view">
                                <a href="{{url('product.show')}}" class="open-quick-view" data-id="25157">Vusualização Rapida</a>
                            </div>

                            <div class="yith-wcwl-add-to-wishlist add-to-wishlist-25157">
                                <div class="yith-wcwl-add-button show" style="display:block">
                                    <a href="{{route('wishlist.store')}}?add_to_wishlist=25157" rel="nofollow" data-product-id="25157" data-product-type="simple" class="add_to_wishlist">
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
                                <a class="button" href="{{route('compare')}}" data-added-text="Compare este produto" data-id="25157">Compare</a>
                            </div>
                        </div>
                    </div>
                    <h3 class="product-title">
                        <a href="{{url('product')}}/categoria/secao/produto-25157">Produto 1</a>
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
                <div class="product-grid-item basel-hover-base product product-in-carousel post-25170 type-product status-publish has-post-thumbnail product_cat-marketplace instock shipping-taxable purchasable product-type-simple" data-loop="2" data-id="25170">
                    <div class="product-element-top">
                        <a href="{{url('product')}}/categoria/secao/produto-25170">
                            <img width="273" height="273" src="{{asset('faker/product_photos/img2-f.jpg')}}"
                                 class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                 alt=""
                                 srcset="{{asset('faker/product_photos/img2-f.jpg')}} 870w,
                                         {{asset('faker/product_photos/img2-f.jpg')}} 235w,
                                         {{asset('faker/product_photos/img2-f.jpg')}} 768w,
                                         {{asset('faker/product_photos/img2-f.jpg')}} 803w,
                                         {{asset('faker/product_photos/img2-f.jpg')}} 266w,
                                         {{asset('faker/product_photos/img2-f.jpg')}} 219w,
                                         {{asset('faker/product_photos/img2-f.jpg')}} 263w,
                                         {{asset('faker/product_photos/img2-f.jpg')}} 526w"
                                 sizes="(max-width: 273px) 100vw, 273px"
                            />
                        </a>
                        <div class="hover-img">
                            <a href="{{url('product')}}/categoria/secao/produto-25170">
                                <img width="273" height="273" src="{{asset('faker/product_photos/img2-l.jpg')}}"
                                     class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                     alt=""
                                     srcset="{{asset('faker/product_photos/img2-l.jpg')}} 870w,
                                             {{asset('faker/product_photos/img2-l.jpg')}} 235w,
                                             {{asset('faker/product_photos/img2-l.jpg')}} 768w,
                                             {{asset('faker/product_photos/img2-l.jpg')}} 803w,
                                             {{asset('faker/product_photos/img2-l.jpg')}} 266w,
                                             {{asset('faker/product_photos/img2-l.jpg')}} 219w,
                                             {{asset('faker/product_photos/img2-l.jpg')}} 263w,
                                             {{asset('faker/product_photos/img2-l.jpg')}} 526w"
                                     sizes="(max-width: 273px) 100vw, 273px"
                                />
                            </a>
                        </div>
                        <div class="hover-mask">
                            <div class="basel-add-btn">
                                <a href="/basel/shop/?add-to-cart=25170"
                                   data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                   data-product_id="25170"
                                   data-product_sku=""
                                   aria-label="Adicione o produto 2 ao seu carrinho"
                                   rel="nofollow">Adicionar ao carrinho
                                </a>
                            </div>

                            <div class="quick-view">
                                <a href="{{url('product.show')}}" class="open-quick-view" data-id="25170">Vusualização Rapida</a>
                            </div>

                            <div class="yith-wcwl-add-to-wishlist add-to-wishlist-25170">
                                <div class="yith-wcwl-add-button show" style="display:block">
                                    <a href="{{route('wishlist.store')}}?add_to_wishlist=25170" rel="nofollow" data-product-id="25170" data-product-type="simple" class="add_to_wishlist">
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
                                <a class="button" href="{{route('compare')}}" data-added-text="Compare este produto" data-id="25170">Compare</a>
                            </div>
                        </div>
                    </div>
                    <h3 class="product-title">
                        <a href="{{url('product')}}/categoria/secao/produto-25170">Produto 2</a>
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
                <div class="product-grid-item basel-hover-base product product-in-carousel post-25171 type-product status-publish has-post-thumbnail product_cat-marketplace instock shipping-taxable purchasable product-type-simple" data-loop="3" data-id="25171">

                    <div class="product-element-top">
                        <a href="{{url('product')}}/categoria/secao/produto-25171">
                            <img width="273" height="273" src="{{asset('faker/product_photos/img4-f.jpg')}}"
                                 class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                 alt=""
                                 srcset="{{asset('faker/product_photos/img4-f.jpg')}} 870w,
                                         {{asset('faker/product_photos/img4-f.jpg')}} 235w,
                                         {{asset('faker/product_photos/img4-f.jpg')}} 768w,
                                         {{asset('faker/product_photos/img4-f.jpg')}} 803w,
                                         {{asset('faker/product_photos/img4-f.jpg')}} 266w,
                                         {{asset('faker/product_photos/img4-f.jpg')}} 219w,
                                         {{asset('faker/product_photos/img4-f.jpg')}} 263w,
                                         {{asset('faker/product_photos/img4-f.jpg')}} 526w"
                                 sizes="(max-width: 273px) 100vw, 273px"
                            />
                        </a>
                        <div class="hover-img">
                            <a href="{{url('product')}}/categoria/secao/produto-25171">
                                <img width="273" height="273" src="{{asset('faker/product_photos/img4-l.jpg')}}"
                                     class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                     alt=""
                                     srcset="{{asset('faker/product_photos/img4-l.jpg')}} 870w,
                                             {{asset('faker/product_photos/img4-l.jpg')}} 235w,
                                             {{asset('faker/product_photos/img4-l.jpg')}} 768w,
                                             {{asset('faker/product_photos/img4-l.jpg')}} 803w,
                                             {{asset('faker/product_photos/img4-l.jpg')}} 266w,
                                             {{asset('faker/product_photos/img4-l.jpg')}} 219w,
                                             {{asset('faker/product_photos/img4-l.jpg')}} 263w,
                                             {{asset('faker/product_photos/img4-l.jpg')}} 526w"
                                     sizes="(max-width: 273px) 100vw, 273px"
                                />
                            </a>
                        </div>
                        <div class="hover-mask">
                            <div class="basel-add-btn">
                                <a href="/basel/shop/?add-to-cart=25171"
                                   data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                   data-product_id="25171"
                                   data-product_sku=""
                                   aria-label="Adicione o produto 3 ao seu carrinho"
                                   rel="nofollow">Adicionar ao carrinho
                                </a>
                            </div>

                            <div class="quick-view">
                                <a href="{{url('product.show')}}" class="open-quick-view" data-id="25171">Vusualização Rapida</a>
                            </div>

                            <div class="yith-wcwl-add-to-wishlist add-to-wishlist-25171">
                                <div class="yith-wcwl-add-button show" style="display:block">
                                    <a href="{{route('wishlist.store')}}?add_to_wishlist=25171" rel="nofollow" data-product-id="25171" data-product-type="simple" class="add_to_wishlist">
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
                                <a class="button" href="{{route('compare')}}" data-added-text="Compare este produto" data-id="25171">Compare</a>
                            </div>
                        </div>
                    </div>
                    <h3 class="product-title">
                        <a href="{{url('product')}}/categoria/secao/produto-25171">Produto 3</a>
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
                <div class="product-grid-item basel-hover-base product product-in-carousel post-25173 type-product status-publish has-post-thumbnail product_cat-marketplace last instock shipping-taxable purchasable product-type-simple" data-loop="4" data-id="25173">

                    <div class="product-element-top">
                        <a href="{{url('product')}}/categoria/secao/produto-25173">
                            <img width="273" height="273" src="{{asset('faker/product_photos/img8-f.jpg')}}"
                                 class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                 alt=""
                                 srcset="{{asset('faker/product_photos/img8-f.jpg')}} 870w,
                                         {{asset('faker/product_photos/img8-f.jpg')}} 235w,
                                         {{asset('faker/product_photos/img8-f.jpg')}} 768w,
                                         {{asset('faker/product_photos/img8-f.jpg')}} 803w,
                                         {{asset('faker/product_photos/img8-f.jpg')}} 266w,
                                         {{asset('faker/product_photos/img8-f.jpg')}} 219w,
                                         {{asset('faker/product_photos/img8-f.jpg')}} 263w,
                                         {{asset('faker/product_photos/img8-f.jpg')}} 526w"
                                 sizes="(max-width: 273px) 100vw, 273px"
                            />
                        </a>
                        <div class="hover-img">
                            <a href="{{url('product')}}/categoria/secao/produto-25173">
                                <img width="273" height="273" src="{{asset('faker/product_photos/img8-l.jpg')}}"
                                     class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                     alt=""
                                     srcset="{{asset('faker/product_photos/img8-l.jpg')}} 870w,
                                             {{asset('faker/product_photos/img8-l.jpg')}} 235w,
                                             {{asset('faker/product_photos/img8-l.jpg')}} 768w,
                                             {{asset('faker/product_photos/img8-l.jpg')}} 803w,
                                             {{asset('faker/product_photos/img8-l.jpg')}} 266w,
                                             {{asset('faker/product_photos/img8-l.jpg')}} 219w,
                                             {{asset('faker/product_photos/img8-l.jpg')}} 263w,
                                             {{asset('faker/product_photos/img8-l.jpg')}} 526w"
                                     sizes="(max-width: 273px) 100vw, 273px"
                                />
                            </a>
                        </div>
                        <div class="hover-mask">
                            <div class="basel-add-btn">
                                <a href="/basel/shop/?add-to-cart=25173"
                                   data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                   data-product_id="25173"
                                   data-product_sku=""
                                   aria-label="Adicione o produto 4 ao seu carrinho"
                                   rel="nofollow">Adicionar ao carrinho
                                </a>
                            </div>

                            <div class="quick-view">
                                <a href="{{url('product.show')}}" class="open-quick-view" data-id="25173">Vusualização Rapida</a>
                            </div>

                            <div class="yith-wcwl-add-to-wishlist add-to-wishlist-25173">
                                <div class="yith-wcwl-add-button show" style="display:block">
                                    <a href="{{route('wishlist.store')}}?add_to_wishlist=25173" rel="nofollow" data-product-id="25173" data-product-type="simple" class="add_to_wishlist">
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
                                <a class="button" href="{{route('compare')}}" data-added-text="Compare este produto" data-id="25173">Compare</a>
                            </div>
                        </div>
                    </div>
                    <h3 class="product-title">
                        <a href="{{url('product')}}/categoria/secao/produto-25173">Produto 4</a>
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
                <div class="product-grid-item basel-hover-base product product-in-carousel post-25174 type-product status-publish has-post-thumbnail product_cat-marketplace first instock shipping-taxable purchasable product-type-simple" data-loop="5" data-id="25174">
                    <div class="product-element-top">
                        <a href="{{url('product')}}/categoria/secao/produto-25174">
                            <img width="273" height="273" src="{{asset('faker/product_photos/img11-f.jpg')}}"
                                 class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                 alt=""
                                 srcset="{{asset('faker/product_photos/img11-f.jpg')}} 870w,
                                         {{asset('faker/product_photos/img11-f.jpg')}} 235w,
                                         {{asset('faker/product_photos/img11-f.jpg')}} 768w,
                                         {{asset('faker/product_photos/img11-f.jpg')}} 803w,
                                         {{asset('faker/product_photos/img11-f.jpg')}} 266w,
                                         {{asset('faker/product_photos/img11-f.jpg')}} 219w,
                                         {{asset('faker/product_photos/img11-f.jpg')}} 263w,
                                         {{asset('faker/product_photos/img11-f.jpg')}} 526w"
                                 sizes="(max-width: 273px) 100vw, 273px"
                            />
                        </a>
                        <div class="hover-img">
                            <a href="{{url('product')}}/categoria/secao/produto-25174">
                                <img width="273" height="273" src="{{asset('faker/product_photos/img11-l.jpg')}}"
                                     class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                     alt=""
                                     srcset="{{asset('faker/product_photos/img11-l.jpg')}} 870w,
                                             {{asset('faker/product_photos/img11-l.jpg')}} 235w,
                                             {{asset('faker/product_photos/img11-l.jpg')}} 768w,
                                             {{asset('faker/product_photos/img11-l.jpg')}} 803w,
                                             {{asset('faker/product_photos/img11-l.jpg')}} 266w,
                                             {{asset('faker/product_photos/img11-l.jpg')}} 219w,
                                             {{asset('faker/product_photos/img11-l.jpg')}} 263w,
                                             {{asset('faker/product_photos/img11-l.jpg')}} 526w"
                                     sizes="(max-width: 273px) 100vw, 273px"
                                />
                            </a>
                        </div>
                        <div class="hover-mask">
                            <div class="basel-add-btn">
                                <a href="/basel/shop/?add-to-cart=25174"
                                   data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                   data-product_id="25174"
                                   data-product_sku=""
                                   aria-label="Adicione o produto 5 ao seu carrinho"
                                   rel="nofollow">Adicionar ao carrinho
                                </a>
                            </div>

                            <div class="quick-view">
                                <a href="{{url('product.show')}}" class="open-quick-view" data-id="25174">Vusualização Rapida</a>
                            </div>

                            <div class="yith-wcwl-add-to-wishlist add-to-wishlist-25174">
                                <div class="yith-wcwl-add-button show" style="display:block">
                                    <a href="{{route('wishlist.store')}}?add_to_wishlist=25174" rel="nofollow" data-product-id="25174" data-product-type="simple" class="add_to_wishlist">
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
                                <a class="button" href="{{route('compare')}}" data-added-text="Compare este produto" data-id="25174">Compare</a>
                            </div>
                        </div>
                    </div>
                    <h3 class="product-title">
                        <a href="{{url('product')}}/categoria/secao/produto-25174">Produto 5</a>
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
                <div class="product-grid-item basel-hover-base product product-in-carousel post-25175 type-product status-publish has-post-thumbnail product_cat-marketplace instock shipping-taxable purchasable product-type-simple" data-loop="6" data-id="25175">
                    <div class="product-element-top">
                        <a href="{{url('product')}}/categoria/secao/produto-25175">
                            <img width="273" height="273" src="{{asset('faker/product_photos/img6-f.jpg')}}"
                                 class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                 alt=""
                                 srcset="{{asset('faker/product_photos/img6-f.jpg')}} 870w,
                                         {{asset('faker/product_photos/img6-f.jpg')}} 235w,
                                         {{asset('faker/product_photos/img6-f.jpg')}} 768w,
                                         {{asset('faker/product_photos/img6-f.jpg')}} 803w,
                                         {{asset('faker/product_photos/img6-f.jpg')}} 266w,
                                         {{asset('faker/product_photos/img6-f.jpg')}} 219w,
                                         {{asset('faker/product_photos/img6-f.jpg')}} 263w,
                                         {{asset('faker/product_photos/img6-f.jpg')}} 526w"
                                 sizes="(max-width: 273px) 100vw, 273px"
                            />
                        </a>
                        <div class="hover-img">
                            <a href="{{url('product')}}/categoria/secao/produto-25175">
                                <img width="273" height="273" src="{{asset('faker/product_photos/img6-l.jpg')}}"
                                     class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                     alt=""
                                     srcset="{{asset('faker/product_photos/img6-l.jpg')}} 870w,
                                             {{asset('faker/product_photos/img6-l.jpg')}} 235w,
                                             {{asset('faker/product_photos/img6-l.jpg')}} 768w,
                                             {{asset('faker/product_photos/img6-l.jpg')}} 803w,
                                             {{asset('faker/product_photos/img6-l.jpg')}} 266w,
                                             {{asset('faker/product_photos/img6-l.jpg')}} 219w,
                                             {{asset('faker/product_photos/img6-l.jpg')}} 263w,
                                             {{asset('faker/product_photos/img6-l.jpg')}} 526w"
                                     sizes="(max-width: 273px) 100vw, 273px"
                                />
                            </a>
                        </div>
                        <div class="hover-mask">
                            <div class="basel-add-btn">
                                <a href="/basel/shop/?add-to-cart=25175"
                                   data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                   data-product_id="25175"
                                   data-product_sku=""
                                   aria-label="Adicione o produto 6 ao seu carrinho"
                                   rel="nofollow">Adicionar ao carrinho
                                </a>
                            </div>

                            <div class="quick-view">
                                <a href="{{url('product.show')}}" class="open-quick-view" data-id="25175">Vusualização Rapida</a>
                            </div>

                            <div class="yith-wcwl-add-to-wishlist add-to-wishlist-25175">
                                <div class="yith-wcwl-add-button show" style="display:block">
                                    <a href="{{route('wishlist.store')}}?add_to_wishlist=25175" rel="nofollow" data-product-id="25175" data-product-type="simple" class="add_to_wishlist">
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
                                <a class="button" href="{{route('compare')}}" data-added-text="Compare este produto" data-id="25175">Compare</a>
                            </div>
                        </div>
                    </div>
                    <h3 class="product-title">
                        <a href="{{url('product')}}/categoria/secao/produto-25175">Produto 6</a>
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