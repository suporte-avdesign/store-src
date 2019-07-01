@extends('frontend.layouts.template-1')
@push('title')
<title>{{$configKeyword->description}} {{$product->name}} {{config('app.name')}}</title>
    <meta name="description" content="{{$configKeyword->description}} , {{$configKeyword->genders}}">
    <meta name="keywords" content="{{$configKeyword->keywords}},{{$configKeyword->categories}},{{$configKeyword->genders}}">
@endpush
@push('body')
<body class="product-template-default single single-product postid-{{$product->id}} logged-in woocommerce woocommerce-page woocommerce-no-js wrapper-full-width global-cart-design-1 global-search-full-screen global-header-shop mobile-nav-from-left basel-product-design-default basel-light catalog-mode-off categories-accordion-on global-wishlist-enable basel-top-bar-on basel-ajax-shop-on basel-ajax-search-on enable-sticky-header header-full-width sticky-header-real offcanvas-sidebar-mobile offcanvas-sidebar-tablet wpb-js-composer js-comp-ver-5.6 vc_responsive">
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
                                        @include('frontend.products.gallery-positions-1')
                                    @else
                                        @include('frontend.products.gallery-colors-1')
                                    @endif
                                    <!-- Descrição do produto -->
                                    <div class="col-sm-6 summary entry-summary">
                                        <div class="summary-inner ">
                                            <div class="basel-scroll-content">
                                                <p itemprop="name" class="product_title entry-title">{{$product->name}}</p>

                                                @include('frontend.products.includes.prices-1')

                                                @if($data->description != "")
                                                    <div class="woocommerce-product-details__short-description">
                                                        <p>{{$data->description}}</p>
                                                    </div>
                                                @endif

                                                @if($product->kit == 1)
                                                    @include('frontend.products.includes.product-kit')
                                                @else
                                                    @include('frontend.products.includes.product-unit')
                                                @endif

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
                                                    <span class="posted_in">Categoria: <a href="#" rel="tag">{{$category->name}}</a></span>
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
    ]) !!}
</script>
<script type="text/javascript" src="{{asset('plugins/product/js/single-product.min.js')}}"></script>
@endpush
