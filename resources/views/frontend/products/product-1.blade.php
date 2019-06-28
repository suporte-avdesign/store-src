@extends('layouts.template-1')
@push('title')
<title>{{$configKeyword->description}} {{$data->product->name}} {{config('app.name')}}</title>
    <meta name="description" content="{{$configKeyword->description}} , {{$configKeyword->genders}}">
    <meta name="keywords" content="{{$configKeyword->keywords}},{{$configKeyword->categories}},{{$configKeyword->genders}}">
@endpush
@push('body')
<body class="product-template-default single single-product postid-19656 logged-in woocommerce woocommerce-page woocommerce-no-js wrapper-full-width global-cart-design-1 global-search-full-screen global-header-shop mobile-nav-from-left basel-product-design-default basel-light catalog-mode-off categories-accordion-on global-wishlist-enable basel-top-bar-on basel-ajax-shop-on basel-ajax-search-on enable-sticky-header header-full-width sticky-header-real offcanvas-sidebar-mobile offcanvas-sidebar-tablet wpb-js-composer js-comp-ver-5.6 vc_responsive">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="site-content shop-content-area col-sm-12 content-with-products description-area-before" role="main">
                <div class="single-breadcrumbs-wrapper">
                    <div class="container">
                        <!-- breadcrumbs -->
                        @include('frontend.products.includes.breadcrumb-1')
                        <!-- Next Previous -->
                        @include('frontend.products.includes.next-previous-1')

                    </div>
                </div>

                <div class="container">
                    <div class="woocommerce-notices-wrapper"></div>
                </div>
                <!-- produto -->
                <div id="product-{{$product->id}}" class="single-product-page single-product-content product-design-default product-with-attachments post-{{$product->id}} product type-product status-publish has-post-thumbnail product_cat-woman first instock featured shipping-taxable purchasable product-type-variable has-default-attributes">
                    <div class="container">
                        <div class="row">
                            <!-- com sidbar col-sm-9 -->
                            <div class="product-image-summary col-sm-12">
                                <div class="row">
                                    <!-- images gallery colorr/positions-->
                                    @if(!empty($data->positions) && $configProduct->positions == 1)
                                        @include('frontend.products.includes.gallery-positions-1')
                                    @else
                                        @include('frontend.products.includes.gallery-colors-1')
                                    @endif
                                    <!-- Descrição do produto -->
                                    <div class="col-sm-6 summary entry-summary">
                                        <button type="button" id="btn-attacked" class="submit">Atacado</button>
                                        <button type="button" id="btn-retail" class="submit">Varejo</button>

                                        <div class="summary-inner ">
                                            <div class="basel-scroll-content">
                                                <h1 itemprop="name" class="product_title entry-title">{{$product->name}}</h1>

                                                <div id="attacked" style="display: @if($product->kit == 1) block @else none @endif">
                                                    <div id="attacked" style="display: block">
                                                        <div id="basel-woocommerce-layered-nav-17" class="filter-widget widget-count-4  basel-woocommerce-layered-nav">

                                                            <div class="basel-scroll">
                                                                <ul class="show-labels-on swatches-normal swatches-display-inline basel-scroll-content">
                                                                    <li class="wc-layered-nav-term  with-swatch-text">
                                                                        <a href="javascript:void(0)">33</a>
                                                                        <span class="count">(1)</span>
                                                                    </li>
                                                                    <li class="wc-layered-nav-term  with-swatch-text">
                                                                        <a href="javascript:void(0)">34</a>
                                                                        <span class="count">(1)</span>
                                                                    </li>
                                                                    <li class="wc-layered-nav-term  with-swatch-text">
                                                                        <a href="javascript:void(0)">35</a>
                                                                        <span class="count">(2)</span>
                                                                    </li>
                                                                    <li class="wc-layered-nav-term  with-swatch-text">
                                                                        <a href="javascript:void(0)">36</a>
                                                                        <span class="count">(2)</span>
                                                                    </li>
                                                                    <li class="wc-layered-nav-term  with-swatch-text">
                                                                        <a href="javascript:void(0)">37</a>
                                                                        <span class="count">(1)</span>
                                                                    </li>
                                                                    <li class="wc-layered-nav-term  with-swatch-text">
                                                                        <a href="javascript:void(0)">38</a>
                                                                        <span class="count">(2)</span>
                                                                    </li>
                                                                    <li class="wc-layered-nav-term  with-swatch-text">
                                                                        <a href="javascript:void(0)">39</a>
                                                                        <span class="count">(2)</span>
                                                                    </li>
                                                                    <li class="wc-layered-nav-term  with-swatch-text">
                                                                        <a href="javascript:void(0)">40</a>
                                                                        <span class="count">(1)</span>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <form class="cart grouped_form">
                                                            <table cellspacing="0" class="woocommerce-grouped-product-list group_table">
                                                                <tbody>
                                                                <tr id="product-{{$data->id}}" class="woocommerce-grouped-product-list-item post-{{$data->id}} product type-product status-publish has-post-thumbnail product_cat-lingerie instock shipping-taxable purchasable product-type-simple">
                                                                    <td class="woocommerce-grouped-product-list-item__quantity">
                                                                        <div class="quantity">
                                                                            <input type="button" value="-" class="minus">
                                                                            <label class="screen-reader-text" for="quantity_5cbf0639a0370">Quantidade</label>
                                                                            <input type="number" id="quantity_5cbf0639a0370" class="input-text qty text" step="1" min="0" max="12" name="quantity[{{$data->id}}]" value="0" title="Qtd" size="4" pattern="[0-9]*" inputmode="numeric" aria-labelledby="Amarelo">
                                                                            <input type="button" value="+" class="plus">
                                                                        </div>
                                                                    </td>
                                                                    <td class="woocommerce-grouped-product-list-item__label">
                                                                        <label for="product-{{$data->id}}"><a href="#">Amarelo</a></label>
                                                                    </td>
                                                                    <td class="woocommerce-grouped-product-list-item__price">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">R$ </span>160,00
                                                                    </span>
                                                                    </td>
                                                                </tr>
                                                                <tr id="product-23298" class="woocommerce-grouped-product-list-item post-23298 product type-product status-publish has-post-thumbnail product_cat-lingerie instock shipping-taxable purchasable product-type-simple">
                                                                    <td class="woocommerce-grouped-product-list-item__quantity">
                                                                        <div class="quantity">
                                                                            <input type="button" value="-" class="minus">
                                                                            <label class="screen-reader-text" for="quantity_5cbf0639a0370">Quantidade</label>
                                                                            <input type="number" id="quantity_5cbf0639a0370" class="input-text qty text" step="1" min="0" max="12" name="quantity[23298]" value="0" title="Qtd" size="4" pattern="[0-9]*" inputmode="numeric" aria-labelledby="Branco">
                                                                            <input type="button" value="+" class="plus">
                                                                        </div>
                                                                    </td>
                                                                    <td class="woocommerce-grouped-product-list-item__label">
                                                                        <label for="product-23298"><a href="#">Branco</a></label>
                                                                    </td>
                                                                    <td class="woocommerce-grouped-product-list-item__price">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">R$ </span>160,00
                                                                    </span>
                                                                    </td>
                                                                </tr>
                                                                <tr id="product-23299" class="woocommerce-grouped-product-list-item post-23299 product type-product status-publish has-post-thumbnail product_cat-lingerie instock shipping-taxable purchasable product-type-simple">
                                                                    <td class="woocommerce-grouped-product-list-item__quantity">
                                                                        <div class="quantity">
                                                                            <input type="button" value="-" class="minus">
                                                                            <label class="screen-reader-text" for="quantity_5cbf0639a0370">Quantidade</label>
                                                                            <input type="number" id="quantity_5cbf0639a0370" class="input-text qty text" step="1" min="0" max="12" name="quantity[23299]" value="0" title="Qtd" size="4" pattern="[0-9]*" inputmode="numeric" aria-labelledby="Azul">
                                                                            <input type="button" value="+" class="plus">
                                                                        </div>
                                                                    </td>
                                                                    <td class="woocommerce-grouped-product-list-item__label">
                                                                        <label for="product-23299"><a href="#">Azul</a></label>
                                                                    </td>
                                                                    <td class="woocommerce-grouped-product-list-item__price">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">R$ </span>160,00
                                                                    </span>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </form>
                                                    </div>

                                                    <div id="basel-woocommerce-layered-nav-17" class="filter-widget widget-count-4  basel-woocommerce-layered-nav">
                                                        <h5 class="widget-title">Exemplo Venda Caixa</h5>
                                                        <div class="basel-scroll">
                                                            <ul class="show-labels-on swatches-normal swatches-display-inline basel-scroll-content">
                                                                <li class="wc-layered-nav-term  with-swatch-text">
                                                                    <a href="javascript:void(0)">33</a>
                                                                    <span class="count">(1)</span>
                                                                </li>
                                                                <li class="wc-layered-nav-term  with-swatch-text">
                                                                    <a href="javascript:void(0)">34</a>
                                                                    <span class="count">(1)</span>
                                                                </li>
                                                                <li class="wc-layered-nav-term  with-swatch-text">
                                                                    <a href="javascript:void(0)">35</a>
                                                                    <span class="count">(2)</span>
                                                                </li>
                                                                <li class="wc-layered-nav-term  with-swatch-text">
                                                                    <a href="javascript:void(0)">36</a>
                                                                    <span class="count">(2)</span>
                                                                </li>
                                                                <li class="wc-layered-nav-term  with-swatch-text">
                                                                    <a href="javascript:void(0)">37</a>
                                                                    <span class="count">(1)</span>
                                                                </li>
                                                                <li class="wc-layered-nav-term  with-swatch-text">
                                                                    <a href="javascript:void(0)">38</a>
                                                                    <span class="count">(2)</span>
                                                                </li>
                                                                <li class="wc-layered-nav-term  with-swatch-text">
                                                                    <a href="javascript:void(0)">39</a>
                                                                    <span class="count">(2)</span>
                                                                </li>
                                                                <li class="wc-layered-nav-term  with-swatch-text">
                                                                    <a href="javascript:void(0)">40</a>
                                                                    <span class="count">(1)</span>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <form class="cart grouped_form">
                                                        <table cellspacing="0" class="woocommerce-grouped-product-list group_table">
                                                            <tbody>
                                                            <tr id="product-{{$data->id}}" class="woocommerce-grouped-product-list-item post-{{$data->id}} product type-product status-publish has-post-thumbnail product_cat-lingerie instock shipping-taxable purchasable product-type-simple">
                                                                <td class="woocommerce-grouped-product-list-item__quantity">
                                                                    <div class="quantity">
                                                                        <input type="button" value="-" class="minus">
                                                                        <label class="screen-reader-text" for="quantity_5cbf0639a0370">Quantidade</label>
                                                                        <input type="number" id="quantity_5cbf0639a0370" class="input-text qty text" step="1" min="0" max="12" name="quantity[{{$data->id}}]" value="0" title="Qtd" size="4" pattern="[0-9]*" inputmode="numeric" aria-labelledby="Amarelo">
                                                                        <input type="button" value="+" class="plus">
                                                                    </div>
                                                                </td>
                                                                <td class="woocommerce-grouped-product-list-item__label">
                                                                    <label for="product-{{$data->id}}"><a href="#">Amarelo</a></label>
                                                                </td>
                                                                <td class="woocommerce-grouped-product-list-item__price">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">R$ </span>160,00
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            <tr id="product-23298" class="woocommerce-grouped-product-list-item post-23298 product type-product status-publish has-post-thumbnail product_cat-lingerie instock shipping-taxable purchasable product-type-simple">
                                                                <td class="woocommerce-grouped-product-list-item__quantity">
                                                                    <div class="quantity">
                                                                        <input type="button" value="-" class="minus">
                                                                        <label class="screen-reader-text" for="quantity_5cbf0639a0370">Quantidade</label>
                                                                        <input type="number" id="quantity_5cbf0639a0370" class="input-text qty text" step="1" min="0" max="12" name="quantity[23298]" value="0" title="Qtd" size="4" pattern="[0-9]*" inputmode="numeric" aria-labelledby="Branco">
                                                                        <input type="button" value="+" class="plus">
                                                                    </div>
                                                                </td>
                                                                <td class="woocommerce-grouped-product-list-item__label">
                                                                    <label for="product-23298"><a href="#">Branco</a></label>
                                                                </td>
                                                                <td class="woocommerce-grouped-product-list-item__price">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">R$ </span>160,00
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            <tr id="product-23299" class="woocommerce-grouped-product-list-item post-23299 product type-product status-publish has-post-thumbnail product_cat-lingerie instock shipping-taxable purchasable product-type-simple">
                                                                <td class="woocommerce-grouped-product-list-item__quantity">
                                                                    <div class="quantity">
                                                                        <input type="button" value="-" class="minus">
                                                                        <label class="screen-reader-text" for="quantity_5cbf0639a0370">Quantidade</label>
                                                                        <input type="number" id="quantity_5cbf0639a0370" class="input-text qty text" step="1" min="0" max="12" name="quantity[23299]" value="0" title="Qtd" size="4" pattern="[0-9]*" inputmode="numeric" aria-labelledby="Azul">
                                                                        <input type="button" value="+" class="plus">
                                                                    </div>
                                                                </td>
                                                                <td class="woocommerce-grouped-product-list-item__label">
                                                                    <label for="product-23299"><a href="#">Azul</a></label>
                                                                </td>
                                                                <td class="woocommerce-grouped-product-list-item__price">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">R$ </span>160,00
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </form>
                                                </div>

                                                <div id="retail" style="display: @if($product->kit != 1) block @else none @endif">
                                                    <h5 class="widget-title">{{constLang('messages.qty_min')}}</h5>
                                                    <p class="price">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <span class="woocommerce-Price-currencySymbol">R$ </span>59,00
                                                        </span>
                                                    </p>
                                                    @if($data->description != "")
                                                        <div class="woocommerce-product-details__short-description">
                                                            <p>{{$data->description}}</p>
                                                        </div>
                                                    @endif

                                                    <form class="variations_form cart" method="post" enctype="multipart/form-data" data-product_id="{{$product->id}}" data-product_variations='{{$product_variations}}'>

                                                        <table class="variations" cellspacing="0">
                                                            <tbody>
                                                            <tr>
                                                                <td class="label"><label for="pa_color">{{constLang('colors')}}</label></td>
                                                                <td class="value with-swatches">
                                                                    <div class="swatches-select" data-id="pa_color">
                                                                        @foreach($colors as $color)
                                                                            @if($color->html == '#ffffff' || $color->html == '#FFFFFF')
                                                                                <div class="basel-swatch basel-tooltip  colored-swatch swatch-size-" data-value="{{\Illuminate\Support\Str::slug($color->color, '-')}}"  style="background-color:{{$color->html}};border: 2px solid #2a2a2a;">{{$color->color}}</div>
                                                                            @else
                                                                                <div class="basel-swatch basel-tooltip  colored-swatch swatch-size-" data-value="{{\Illuminate\Support\Str::slug($color->color, '-')}}"  style="background-color:{{$color->html}}">{{$color->color}}</div>
                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                    <select id="pa_color" class="" name="attribute_pa_color" data-attribute_name="attribute_pa_color" data-show_option_none="yes">
                                                                        <option value="">Selecione a Opção</option>
                                                                        @foreach($colors as $color)
                                                                            <option value="{{\Illuminate\Support\Str::slug($color->color, '-')}}">{{$color->color}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="label"><label for="pa_size">{{constLang('sizes')}}</label></td>
                                                                <td class="value with-swatches">
                                                                    <div class="swatches-select" data-id="pa_size">
                                                                        @foreach($colors as $color)
                                                                            @foreach($color->grids as $size)
                                                                                <div class="basel-swatch basel-tooltip  text-only swatch-size-" data-value="{{$size->grid}}"  style="">{{$size->grid}}</div>
                                                                            @endforeach
                                                                        @endforeach
                                                                    </div>
                                                                    <select id="pa_size" class="" name="attribute_pa_size" data-attribute_name="attribute_pa_size" data-show_option_none="yes">
                                                                        <option value="">{{constLang('select_options')}}</option>
                                                                        @foreach($colors as $color)
                                                                            @foreach($color->grids as $size)
                                                                                <option value="{{$size->grid}}" >{{$size->grid}}</option>
                                                                            @endforeach
                                                                        @endforeach
                                                                    </select>
                                                                    <a class="reset_variations" href="#">{{constLang('reset')}}</a>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>


                                                        <div class="single_variation_wrap">
                                                            <div class="woocommerce-variation single_variation"></div>
                                                            <div class="woocommerce-variation-add-to-cart variations_button">
                                                                <div class="quantity">
                                                                    <input type="button" value="-" class="minus" />
                                                                    <label class="screen-reader-text" for="quantity_5cba02707fe6e">{{constLang('quantity')}}</label>
                                                                    <input
                                                                        type="number"
                                                                        id="quantity_5cba02707fe6e"
                                                                        class="input-text qty text"
                                                                        step="1"
                                                                        min="1"
                                                                        max=""
                                                                        name="quantity"
                                                                        value="1"
                                                                        title="{{constLang('qty')}}"
                                                                        size="4"
                                                                        pattern="[0-9]*"
                                                                        inputmode="numeric"
                                                                        aria-labelledby="{{$product->name}} {{constLang('quantity')}}" />
                                                                    <input type="button" value="+" class="plus" />
                                                                </div>

                                                                <button type="submit" class="single_add_to_cart_button button alt">{{constLang('add')}}</button>
                                                                <input type="hidden" name="add-to-cart" value="{{$product->id}}" />
                                                                <input type="hidden" name="product_id" value="{{$product->id}}" />
                                                                <input type="hidden" name="variation_id" class="variation_id" value="0" />
                                                                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                                                            </div>
                                                        </div>


                                                    </form>
                                                </div>


                                                @if($configProduct->wishlist == 1)
                                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-{{$product->id}}">
                                                        <div class="yith-wcwl-add-button show" style="display:block">
                                                            <a href="{{route('wishlist.store')}}" rel="nofollow" data-product-id="{{$product->id}}" data-product-type="variable" class="add_to_wishlist" >
                                                                Adicionar a lista de desejo
                                                            </a>
                                                            <img src="{{asset('themes/images/loader/wpspin_light.gif')}}" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" />
                                                        </div>

                                                        <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;">
                                                            <span class="feedback">Produto adicionado!</span>
                                                            <a href="https://demo.xtemos.com/basel/wishlist/" rel="nofollow">
                                                                Ver lista de desejo
                                                            </a>
                                                        </div>

                                                        <div class="yith-wcwl-wishlistexistsbrowse hide" style="display:none">
                                                            <span class="feedback">O produto já está na lista de desejos!</span>
                                                            <a href="https://demo.xtemos.com/basel/wishlist/" rel="nofollow">
                                                                Ver lista de desejo
                                                            </a>
                                                        </div>

                                                        <div style="clear:both"></div>
                                                        <div class="yith-wcwl-wishlistaddresponse"></div>
                                                    </div>
                                                @endif
                                                <div class="clear"></div>

                                                @if($configProduct->compare == 1)
                                                    <div class="compare-btn-wrapper">
                                                        <a class="basel-compare-btn button" href="{{route('compare')}}" data-added-text="Ver Produtos" data-id="{{$product->id}}">Compare</a>
                                                    </div>
                                                @endif
                                                <!-- Outros-->
                                                <div class="product_meta">
                                                    <span class="sku_wrapper">SKU: <span class="sku">N/F</span></span>
                                                    <span class="posted_in">Categoria: <a href="#" rel="tag">Feminino</a></span>
                                                </div>
                                                @if($configSite->social_share == 1)
                                                    @include('frontend.products.includes.social-share-1')
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- .summary -->
                            </div>

                            <!-- include('products.includes.sidber-1') -->

                        </div>
                    </div>
                    <div class="container"></div>
                    <!-- include('products.includes.tabs-1') -->
                </div><!-- #produto -->
            </div>
            <div class="clearfix"></div>
            <!-- include('products.includes.related-1') -->
        </div> <!-- fim row -->
    </div> <!-- fim container -->
@endsection

@push('scripts')
<script type="application/ld+json">{!! json_encode($schema_org) !!}</script>
<script type="text/javascript" src="{{asset('plugins/zoom/js/jquery.zoom.min.js')}}"></script>
<script type="text/javascript">
    var wc_single_product_params = {!! json_encode([
        "i18n_required_rating_text" => "Por favor, selecione uma classificação",
        "review_rating_required" => "yes",
        "flexslider" => array(
            "rtl" => false,
            "animation" => "slide",
            "smoothHeight" => true,
            "directionNav" => false,
            "controlNav" => "thumbnails",
            "slideshow" => false,
            "animationSpeed" => 500,
            "animationLoop" => false,
            "allowOneSlide" => false
        ),
        "zoom_enabled" => "1",
        "zoom_options" => [],
        "photoswipe_enabled" => "",
        "photoswipe_options" => array(
            "shareEl" => false,
            "closeOnScroll" => false,
            "history" => false,
            "hideAnimationDuration" => 0,
            "showAnimationDuration" => 0
        ),
        "flexslider_enabled" => ""
    ]) !!}}
</script>
<script type="text/javascript" src="{{asset('plugins/product/js/single-product.min.js')}}"></script>
@endpush
