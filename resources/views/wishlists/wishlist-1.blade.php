@extends('layouts.template-1')
@push('title')
<title> Lista de Desejo - {{config('app.name')}}</title>
@endpush
@push('body')
<body class="page-template-default page page-id-5 woocommerce-no-js woocommerce-wishlist woocommerce woocommerce-page wrapper-full-width global-cart-design-1 global-search-full-screen global-header-shop mobile-nav-from-left basel-light catalog-mode-off categories-accordion-on global-wishlist-enable basel-top-bar-on basel-ajax-shop-on basel-ajax-search-on enable-sticky-header header-full-width sticky-header-real offcanvas-sidebar-mobile offcanvas-sidebar-tablet wpb-js-composer js-comp-ver-5.6 vc_responsive">
@endpush
@section('content')
<div class="page-title page-title-default title-size-small title-design-centered color-scheme-light" style="">
    <div class="container">
        <header class="entry-header">
            <h1 class="entry-title">Lista de Desejo</h1>
            <div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
                <a href="{{route('home')}}" rel="v:url" property="v:title">Home</a> &raquo;
                <span class="current">Mina Lista</span>
            </div>
        </header>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="site-content col-sm-12" role="main">
            <article id="post-5" class="post-5 page type-page status-publish hentry">
                <div class="entry-content">
                    <div id="yith-wcwl-messages"></div>
                    <div class="wishlist-wrapper">
                        <form id="yith-wcwl-form" action="{{route('wishlist')}}/" method="post" class="woocommerce">

                            <input type="hidden" id="yith_wcwl_form_nonce" name="yith_wcwl_form_nonce" alue="78590294cc" />
                            <input type="hidden" name="_wp_http_referer" value="/basel/wishlist/" />
                            <table class="shop_table_responsive shop_table cart wishlist_table" data-pagination="no" data-per-page="5" data-page="1" data-id="" data-token="">
                                <thead>
                                <tr>
                                    <th class="product-remove"></th>
                                    <th class="product-thumbnail"></th>
                                    <th class="product-name">
                                        <span class="nobr">Produto</span>
                                    </th>
                                    <th class="product-price">
                                        <span class="nobr">Preço Unitário</span>
                                    </th>
                                    <th class="product-stock-status">
                                        <span class="nobr">Estoque</span>
                                    </th>
                                    <th class="product-add-to-cart"></th>
                                </tr>
                                </thead>

                                <tbody>

                                <!-- select options -->
                                <tr id="yith-wcwl-row-19515" data-row-id="19515">
                                    <td class="product-remove">
                                        <div>
                                            <a href="{{route('product', [$product['category'], $product['section'], $product['slug']])}}?remove_from_wishlist=19515&wishlist_token={{csrf_token()}}" class="remove remove_from_wishlist" title="Remove this product">&times;</a>
                                        </div>
                                    </td>
                                    <td class="product-thumbnail">
                                        <a href="{{route('product', [$product['category'], $product['section'], $product['slug']])}}/?cor=preto-amarelo">
                                            <img width="273" height="273"
                                                 src="{{asset('faker/product_photos/img4-f.jpg')}}"
                                                 class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                 alt="" srcset="{{asset('faker/product_photos/img4-f.jpg')}} 273w,
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
                                    </td>
                                    <td class="product-name" data-title="Product Name">
                                        <a href="{{route('product', [$product['category'], $product['section'], $product['slug']])}}/?cor=preto-amarelo">Produto 2 - Preto/Amarelo</a>
                                    </td>

                                    <td class="product-price" data-title="Unit Price">
                                        <span class="woocommerce-Price-amount amount">
                                            <span class="woocommerce-Price-currencySymbol">R$ </span>47,00
                                        </span>
                                    </td>

                                    <td class="product-stock-status" data-title="Stock Status">
                                        <span class="wishlist-in-stock">Em Estoque</span>
                                    </td>

                                    <td class="product-add-to-cart">
                                        <a href="{{route('wishlist.cart')}}?remove_from_wishlist_after_add_to_cart=19515"
                                           data-quantity="1"
                                           class="button product_type_variable add_to_cart_button add_to_cart button alt"
                                           data-product_id="19515"
                                           data-product_sku=""
                                           aria-label="Selecione as Opções" rel="nofollow">Selecione as Opções</a>
                                    </td>
                                </tr>

                                <!-- add cart -->
                                <tr id="yith-wcwl-row-19515" data-row-id="19515">
                                    <td class="product-remove">
                                        <div>
                                            <a href="{{route('wishlist.remove')}}?remove_from_wishlist=19515&wishlist_token={{csrf_token()}}" class="remove remove_from_wishlist" title="Remove this product">&times;</a>
                                        </div>
                                    </td>
                                    <td class="product-thumbnail">
                                        <a href="{{route('product', [$product['category'], $product['section'], $product['slug']])}}/?cor=preto-amarelo">
                                            <img width="273" height="273"
                                                 src="{{asset('faker/product_photos/img4-f.jpg')}}"
                                                 class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                 alt="" srcset="{{asset('faker/product_photos/img4-f.jpg')}} 273w,
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
                                    </td>
                                    <td class="product-name" data-title="Product Name">
                                        <a href="{{route('product', [$product['category'], $product['section'], $product['slug']])}}/?cor=preto-amarelo">Produto 2 - Preto/Amarelo</a>
                                    </td>

                                    <td class="product-price" data-title="Unit Price">
                                        <span class="woocommerce-Price-amount amount">
                                            <span class="woocommerce-Price-currencySymbol">R$ </span>47,00
                                        </span>
                                    </td>

                                    <td class="product-stock-status" data-title="Stock Status">
                                        <span class="wishlist-in-stock">Em Estoque</span>
                                    </td>

                                    <td class="product-add-to-cart">
                                        <a href="{{route('wishlist.cart')}}?add-to-cart=19659&remove_from_wishlist_after_add_to_cart=19659"
                                           data-quantity="1"
                                           class="button product_type_simple add_to_cart_button ajax_add_to_cart add_to_cart button alt"
                                           data-product_id="19659"
                                           data-product_sku=""
                                           aria-label="Adicionar “Produto 2” ao carrinho"
                                           rel="nofollow"> Adicionar ao carrinho</a>
                                    </td>
                                </tr>

                                </tbody>


                                <tfoot>
                                <tr>
                                    <td colspan="6"></td>
                                </tr>
                                </tfoot>

                            </table>

                            <input type="hidden" id="yith_wcwl_edit_wishlist" name="yith_wcwl_edit_wishlist" value="782757cc30" /><input type="hidden" name="_wp_http_referer" value="/basel/wishlist/" />
                            <input type="hidden" value="" name="wishlist_id" id="wishlist_id">


                        </form>

                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
@endsection