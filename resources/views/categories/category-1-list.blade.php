@extends('layouts.template-1')
@push('title')
<title> São Roque calçados categoria/seção</title>
@endpush
@push('body')
<body class="archive post-type-archive post-type-archive-product logged-in woocommerce woocommerce-page woocommerce-no-js wrapper-full-width global-cart-design-1 global-search-full-screen global-header-shop mobile-nav-from-left basel-light catalog-mode-off categories-accordion-on global-wishlist-enable basel-top-bar-on basel-ajax-shop-on basel-ajax-search-on enable-sticky-header header-full-width sticky-header-real offcanvas-sidebar-mobile offcanvas-sidebar-tablet wpb-js-composer js-comp-ver-5.6 vc_responsive">
@endpush
@section('content')
<div class="page-title page-title-default title-size-small title-design-centered color-scheme-light without-title title-shop" style="">
    <div class="container">
        <div class="nav-shop">

            <a href="#" class="basel-show-categories">Categorias</a>
            <ul class="basel-product-categories">
                <li class="cat-link shop-all-link">
                    <a href="#">Todos</a>
                </li>
                <li class="cat-item cat-item-163 wc-default-cat">
                    <a class="pf-value" href="#" data-val="categoria-1" data-title="Categoria 1">Categoria 1</a>
                </li>
                <li class="cat-item cat-item-58">
                    <a class="pf-value" href="#" data-val="bags" data-title="Categoria 2">Categoria 2</a>
                </li>
                <li class="cat-item cat-item-63 ">
                    <a class="pf-value" href="#" data-val="accessories" data-title="Categoria 3">Categoria 3</a>
                </li>
                <li class="cat-item cat-item-64 ">
                    <a class="pf-value" href="#" data-val="other" data-title="Outras">Outras</a>
                    <ul class='children'>
                        <li class="cat-item cat-item-160 ">
                            <a class="pf-value" href="#" data-val="bakery" data-title="Categoria 1">Categotia 1</a>
                        </li>
                        <li class="cat-item cat-item-158 ">
                            <a class="pf-value" href="#" data-val="beer" data-title="Categoria 2">Categoria 2</a>
                        </li>
                        <li class="cat-item cat-item-99 ">
                            <a class="pf-value" href="#" data-val="flowers" data-title="Categoria">Categoria 3</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="site-content shop-content-area col-sm-12 content-with-products description-area-before" role="main">

            @include('categories.category-1-breadcrumb')

            @include('categories.category-1-filters')

            <div class="basel-shop-loader"></div>

            <div class="products elements-grid basel-products-holder  basel-spacing- products-spacing- pagination-infinit row grid-columns-4" data-min_price="" data-max_price="" data-source="main_loop">

                @include('categories.category-1-products')

            </div>

            <div class="products-footer">
                <a href="{{route('category.infinit', [$section, $page, $num])}}/?infinit_scrolling" rel="nofollow" class="btn basel-load-more basel-products-load-more load-on-scroll">Carregar mais produtos</a>
            </div>

        </div>
    </div> <!-- end row -->
</div><!-- end container -->
@endsection
@push('scripts')
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

@endpush