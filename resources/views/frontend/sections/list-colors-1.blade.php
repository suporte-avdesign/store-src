<!--
-1 x 2 = <div class="clearfix visible-xs-block"></div>
-! x 3 = <div class="clearfix visible-sm-block"></div>
-1 x 4 = <div class="clearfix visible-md-block visible-lg-block"></div>
-->
<!-- PRODUTO 1 first select options -->
@forelse($categories as $category)
    @forelse($category->products as $product)
        @foreach($product->images as $color)
            <div class="product-grid-item basel-hover-alt product  col-xs-6 col-sm-4 col-md-3 @if($loop->first) first @endif post-1001 type-product status-publish has-post-thumbnail product_cat-bags product_tag-new product_tag-whte instock featured shipping-taxable purchasable product-type-variable has-default-attributes" data-loop="13" data-id="1001">
                <div class="product-element-top">
                    <a href="#">

                        <img width="273" height="273" src="{{asset('storage/faker/product_photos/img1-f.jpg')}}"
                             class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                             alt=""
                             srcset="{{asset('storage/faker/product_photos/img5-f.jpg')}} 870w,
                                     {{asset('storage/faker/product_photos/img1-f.jpg')}} 235w,
                                     {{asset('storage/faker/product_photos/img1-f.jpg')}} 768w,
                                     {{asset('storage/faker/product_photos/img1-f.jpg')}} 803w,
                                     {{asset('storage/faker/product_photos/img1-f.jpg')}} 266w,
                                     {{asset('storage/faker/product_photos/img5-f.jpg')}} 219w,
                                     {{asset('storage/faker/product_photos/img5-f.jpg')}} 263w,
                                     {{asset('storage/faker/product_photos/img5-f.jpg')}} 526w"
                             sizes="(max-width: 273px) 100vw, 273px" />
                    </a>
                    <div class="hover-img">
                        <a href="{{url('product')}}/categoria/secao/produto-1001">
                            <img width="273" height="273" src="{{asset('storage/faker/product_photos/img1-l.jpg')}}"
                                 class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                 alt=""
                                 srcset="{{asset('storage/faker/product_photos/img1-l.jpg')}} 870w,
                                         {{asset('storage/faker/product_photos/img1-l.jpg')}} 235w,
                                         {{asset('storage/faker/product_photos/img1-l.jpg')}} 768w,
                                         {{asset('storage/faker/product_photos/img1-l.jpg')}} 803w,
                                         {{asset('storage/faker/product_photos/img1-l.jpg')}} 266w,
                                         {{asset('storage/faker/product_photos/img1-l.jpg')}} 219w,
                                         {{asset('storage/faker/product_photos/img1-l.jpg')}} 263w,
                                         {{asset('storage/faker/product_photos/img1-l.jpg')}} 526w"
                                 sizes="(max-width: 273px) 100vw, 273px" />
                        </a>
                    </div>
                    <div class="basel-buttons">

                        <div class="yith-wcwl-add-to-wishlist add-to-wishlist-1001">
                            <div class="yith-wcwl-add-button show">
                                <a href="{{route('wishlist.store')}}?infinit_scrolling&add_to_wishlist=1001" rel="nofollow" data-product-id="1001" data-product-type="variable" class="add_to_wishlist">
                                    Adicionar a lista de desejos
                                </a>
                                <img src="{{asset('themes/images/loader/wpspin_light.gif')}}" class="ajax-loading" alt="carregando" width="16" height="16" style="visibility:hidden"/>
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
                            <a class="button" href="{{route('compare')}}" data-added-text="Compare Produtos" data-id="1001">Compare</a></div>
                        <div class="quick-view">
                            <a href="{{url('product.show')}}" class="open-quick-view" data-id="1001">Vusualização Rapida</a>
                        </div>
                    </div>
                </div>
                <h3 class="product-title">
                    <a href="{{url('product')}}/categoria/secao/produto-1001">Produto 1 </a>
                </h3>
                <div class="wrap-price">
                    <div class="wrapp-swap">
                        <div class="swap-elements">
                            <!-- Avaliação -->
                            <div class="star-rating">
                                <span style="width:80%">Avaliado <strong class="rating">4</strong> fora de 5</span>
                            </div>

                            <span class="price">
                                <span class="woocommerce-Price-amount amount">
                                    <span class="woocommerce-Price-currencySymbol">R$ </span>12,00
                                </span> &ndash;
                                <span class="woocommerce-Price-amount amount">
                                    <span class="woocommerce-Price-currencySymbol">R$ </span>15,00
                                </span>
                            </span>
                            <!-- redireciona para selecionar as opções -->
                            <div class="btn-add">
                                <a href="{{url('product')}}/categoria/secao/produto-1001"
                                   data-quantity="1" class="button product_type_variable add_to_cart_button"
                                   data-product_id="1001"
                                   data-product_sku=""
                                   aria-label="Selecione as opções do produto 1" rel="nofollow">Selecione as opções
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- OPÇÃO DE CORES -->
                    <div class="swatches-on-grid">
                        <div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-"
                             style="background-color:#eded55;"
                             data-image-src="{{asset('storage/faker/product_photos/img2-l.jpg')}}"
                             data-image-srcset="{{asset('storage/faker/product_photos/img2-f.jpg')}} 870w,
                                                {{asset('storage/faker/product_photos/img2-f.jpg')}} 235w,
                                                {{asset('storage/faker/product_photos/img2-f.jpg')}} 768w,
                                                {{asset('storage/faker/product_photos/img2-f.jpg')}} 803w,
                                                {{asset('storage/faker/product_photos/img2-f.jpg')}} 266w,
                                                {{asset('storage/faker/product_photos/img2-f.jpg')}} 219w,
                                                {{asset('storage/faker/product_photos/img2-f.jpg')}} 263w,
                                                {{asset('storage/faker/product_photos/img2-f.jpg')}} 526w"
                             data-image-sizes="(max-width: 870px) 100vw, 870px">Azul
                        </div>
                        <div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-"
                             style="background-color:#769ec1;"
                             data-image-src="{{asset('storage/faker/product_photos/img1-f.jpg')}}"
                             data-image-srcset="{{asset('storage/faker/product_photos/img1-f.jpg')}} 870w,
                                                {{asset('storage/faker/product_photos/img1-f.jpg')}} 235w,
                                                {{asset('storage/faker/product_photos/img1-f.jpg')}} 768w,
                                                {{asset('storage/faker/product_photos/img1-f.jpg')}} 803w,
                                                {{asset('storage/faker/product_photos/img1-f.jpg')}} 266w,
                                                {{asset('storage/faker/product_photos/img1-f.jpg')}} 219w,
                                                {{asset('storage/faker/product_photos/img1-f.jpg')}} 263w,
                                                {{asset('storage/faker/product_photos/img1-f.jpg')}} 526w"
                             data-image-sizes="(max-width: 870px) 100vw, 870px">Azul
                        </div>
                    </div>
                </div>

            </div>
            @if(($loop->iteration % 2) == 0)
                <div class="clearfix visible-xs-block"></div>
            @endif
            @if(($loop->iteration % 3) == 0)
                <div class="clearfix visible-sm-block"></div>
            @endif
            @if(($loop->iteration % 4) == 0)
                <div class="clearfix visible-md-block visible-lg-block"></div>
            @endif
        @endforeach

     @empty <!-- /product -->

     @endforelse <!-- /products -->
@empty <!-- category -->

@endforelse <!-- /category -->
<div class="clearfix visible-xs-block"></div>
<div class="clearfix visible-sm-block"></div>
<div class="clearfix visible-md-block visible-lg-block"></div>