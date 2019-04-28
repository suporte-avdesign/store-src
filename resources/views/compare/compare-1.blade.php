@extends('layouts.template-1')
@push('title')
<title>Compare produtos {{config('app.name')}}</title>
@endpush
@push('body')
<body class="page-template-default page page-id-29472 logged-in woocommerce-no-js wrapper-full-width global-cart-design-1 global-search-full-screen global-header-shop mobile-nav-from-left basel-light catalog-mode-off categories-accordion-on global-wishlist-enable basel-top-bar-on basel-ajax-shop-on basel-ajax-search-on enable-sticky-header header-full-width sticky-header-real offcanvas-sidebar-mobile offcanvas-sidebar-tablet wpb-js-composer js-comp-ver-5.6 vc_responsive">
@endpush
@section('content')
    <div class="page-title page-title-default title-size-small title-design-centered color-scheme-light" style="">
        <div class="container">
            <header class="entry-header">
                <h1 class="entry-title">Compare</h1>
                <div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
                    <a href="{{route('home')}}" rel="v:url" property="v:title">Home</a> &raquo;
                    <span class="current">Compare</span>
                </div>
            </header>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="site-content col-sm-12" role="main">
                <article id="post-29472" class="post-29472 page type-page status-publish hentry">
                    <div class="entry-content">
                        <div class="basel-compare-table">
                            <div class="basel-compare-row compare-basic">

                                <div class="basel-compare-col compare-field"></div>

                                <div class="basel-compare-col compare-value" data-title="">
                                    <div class="compare-basic-content">
                                        <a href="{{route('compare.remove', [$page, $id])}}" class="basel-compare-remove" data-id="19655">
                                            <span class="remove-loader"></span>Remover
                                        </a>
                                        <a class="product-image" href="{{route('product', [$product['category'], $product['section'], $product['slug']])}}" target="_blank">
                                            <img width="273" height="273"
                                                 src="{{asset('faker/product_photos/img2-f.jpg')}}"
                                                 class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                 alt=""
                                                 srcset="{{asset('faker/product_photos/img2-f.jpg')}} 273w,
                                                    {{asset('faker/product_photos/img2-f.jpg')}} 546w,
                                                    {{asset('faker/product_photos/img2-f.jpg')}} 235w,
                                                    {{asset('faker/product_photos/img2-f.jpg')}} 768w,
                                                    {{asset('faker/product_photos/img2-f.jpg')}} 803w,
                                                    {{asset('faker/product_photos/img2-f.jpg')}} 266w,
                                                    {{asset('faker/product_photos/img2-f.jpg')}} 219w,
                                                    {{asset('faker/product_photos/img2-f.jpg')}} 263w,
                                                    {{asset('faker/product_photos/img2-f.jpg')}} 526w,
                                                    {{asset('faker/product_photos/img2-f.jpg')}} 870w"
                                                 sizes="(max-width: 273px) 100vw, 273px"
                                            />
                                        </a>
                                        <h4 class="product-title">
                                            <a href="{{route('product', [$product['category'], $product['section'], $product['slug']])}}" target="_blank">Produto 3</a>
                                        </h4>

                                        @include('ratings.rating-1')

                                        <div class="price">
                                            <span class="woocommerce-Price-amount amount">
                                                <span class="woocommerce-Price-currencySymbol">R$ </span>12,00
                                            </span> &ndash;
                                            <span class="woocommerce-Price-amount amount">
                                                <span class="woocommerce-Price-currencySymbol">R$ </span>15,00
                                            </span>
                                        </div>
                                        <a href="{{route('product', [$product['category'], $product['section'], $product['slug']])}}" data-quantity="1" class="button product_type_variable add_to_cart_button add-to-cart-loop" data-product_id="19655" data-product_sku="" aria-label="Selecione as opções para o produto 3" rel="nofollow">
                                            <span>Selecione as opções</span>
                                        </a>
                                    </div>
                                </div>

                                <div class="basel-compare-col compare-value" data-title="">
                                    <div class="compare-basic-content">
                                        <a href="{{route('compare.remove', [$page, $id])}}" class="basel-compare-remove" data-id="19515">
                                            <span class="remove-loader"></span>Remover
                                        </a>
                                        <a class="product-image" href="{{route('product', [$product['category'], $product['section'], $product['slug']])}}" target="_blank">
                                            <img width="273" height="273"
                                                 src="{{asset('faker/product_photos/img4-f.jpg')}}"
                                                 class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                 alt=""
                                                 srcset="{{asset('faker/product_photos/img4-f.jpg')}} 273w,
                                                    {{asset('faker/product_photos/img4-f.jpg')}} 546w,
                                                    {{asset('faker/product_photos/img4-f.jpg')}} 235w,
                                                    {{asset('faker/product_photos/img4-f.jpg')}} 768w,
                                                    {{asset('faker/product_photos/img4-f.jpg')}} 803w,
                                                    {{asset('faker/product_photos/img4-f.jpg')}} 266w,
                                                    {{asset('faker/product_photos/img4-f.jpg')}} 219w,
                                                    {{asset('faker/product_photos/img4-f.jpg')}} 263w,
                                                    {{asset('faker/product_photos/img4-f.jpg')}} 526w,
                                                    {{asset('faker/product_photos/img4-f.jpg')}} 870w"
                                                 sizes="(max-width: 273px) 100vw, 273px"
                                            />
                                        </a>
                                        <h4 class="product-title">
                                            <a href="{{route('product', [$product['category'], $product['section'], $product['slug']])}}" target="_blank">Produto 2</a>
                                        </h4>

                                        @include('ratings.rating-1')

                                        <div class="price">
                                            <span class="woocommerce-Price-amount amount">
                                                <span class="woocommerce-Price-currencySymbol">R$ </span>10,00
                                            </span>
                                        </div>
                                        <a href="{{route('product', [$product['category'], $product['section'], $product['slug']])}}" data-quantity="1" class="button product_type_variable add_to_cart_button add-to-cart-loop" data-product_id="19515" data-product_sku="" aria-label="Selecione as opções para o produto 3" rel="nofollow">
                                            <span>Selecione as opções</span>
                                        </a>
                                    </div>
                                </div>

                            </div>

                            <div class="basel-compare-row compare-description">
                                <div class="basel-compare-col compare-field">Descrição</div>

                                <div class="basel-compare-col compare-value" data-title="Descrição">
                                    Descrição do  produto 3
                                </div>

                                <div class="basel-compare-col compare-value" data-title="Descrição">
                                    Descrição do  produto 2
                                </div>
                            </div>
                            <div class="basel-compare-row compare-sku">
                                <div class="basel-compare-col compare-field">Sku</div>

                                <div class="basel-compare-col compare-value" data-title="Sku"></div>

                                <div class="basel-compare-col compare-value" data-title="Sku"></div>
                            </div>
                            <div class="basel-compare-row compare-availability">
                                <div class="basel-compare-col compare-field">Disponibilidade</div>

                                <div class="basel-compare-col compare-value" data-title="Disponibilidade">
                                    <p class="stock in-stock">Em Estoque</p>
                                </div>

                                <div class="basel-compare-col compare-value" data-title="Disponibilidade">
                                    <p class="stock in-stock">Em Estoque</p>
                                </div>

                            </div>
                            <div class="compare-loader"></div>

                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
@endsection