@extends('frontend.layouts.template-1')
@push('title')
<title>{{$configKeyword->description}} {{$category->name}} {{config('app.name')}}</title>
    <meta name="description" content="{{$configKeyword->description}} , {{$configKeyword->genders}}">
    <meta name="keywords" content="{{$configKeyword->keywords}},{{$configKeyword->categories}},{{$configKeyword->genders}}">
@endpush
@push('body')
<body class="archive post-type-archive post-type-archive-product logged-in woocommerce woocommerce-page woocommerce-no-js wrapper-full-width global-cart-design-1 global-search-full-screen global-header-shop mobile-nav-from-left basel-light catalog-mode-off categories-accordion-on global-wishlist-enable basel-top-bar-on basel-ajax-shop-on basel-ajax-search-on enable-sticky-header header-full-width sticky-header-real offcanvas-sidebar-mobile offcanvas-sidebar-tablet wpb-js-composer js-comp-ver-5.6 vc_responsive">
@endpush
@section('content')

<div class="container">
    <div class="row">
        <div class="site-content shop-content-area col-sm-12 content-with-products description-area-before" role="main">

            @include('frontend.categories.include.breadcrumb-1')

            @include('frontend.categories.include.filters-1')

            <div class="basel-shop-loader"></div>

            <div class="products elements-grid basel-products-holder  basel-spacing- products-spacing- pagination-infinit row grid-columns-4" data-min_price="" data-max_price="" data-source="main_loop">

                @if($configSite->list == 1)
                    @include('frontend.categories.list-products-1')
                @endif

                @if($configSite->list == 2)
                    @include('frontend.categories.list-colors-1')
                @endif

            </div>

            <div class="products-footer">
                <!--
                <a href="{{url(setRoute('category').$slug.'/'.$page.'/'.$num)}}/?infinit_scrolling" rel="nofollow" class="btn basel-load-more basel-products-load-more load-on-scroll">Carregar mais produtos</a>
                -->
            </div>

        </div>
    </div> <!-- end row -->
</div><!-- end container -->
@endsection
@if (count($category->products) >= 1)
    @foreach($category->products as $product)
        @foreach($product->images()->where('active', constLang('active_true'))->limit(1)->get() as $color)
            @php
                $graph[] = array(
                    "@type" => "Product",
                    "@id" => url(setRoute('color').$color->slug),
                    "url" => url(setRoute('color').$color->slug),
                    "name" => $color->slug
                );
            @endphp
        @endforeach
    @endforeach
    @push('scripts')
    <script type="application/ld+json">
        {!! json_encode([
            "@context" => "https://schema.org/",
            "@graph" => $graph
        ]) !!}
    </script>
    @endpush
@endif <!-- count $category->products -->