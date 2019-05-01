@extends('layouts.template-1')
@push('title')
<title> Seu Carrinho - {{config('app.name')}}</title>
@endpush
@push('styles')
<link rel="stylesheet" id="select2-css"  href="{{asset('plugins/select2/css/select2.css')}}?ver=3.5.2" type="text/css" media="all" />
@endpush
@push('body')
<body class="page-template-default page page-id-9 logged-in woocommerce-account woocommerce-page woocommerce-no-js wrapper-full-width global-cart-design-1 global-search-full-screen global-header-shop mobile-nav-from-left basel-light catalog-mode-off categories-accordion-on global-wishlist-enable basel-top-bar-on basel-ajax-shop-on basel-ajax-search-on enable-sticky-header header-full-width sticky-header-real offcanvas-sidebar-mobile offcanvas-sidebar-tablet wpb-js-composer js-comp-ver-5.6 vc_responsive">
@endpush
@section('content')
    <div class="page-title page-title-default title-size-small title-design-centered color-scheme-light" style="">
        <div class="container">
            <header class="entry-header">
                <h1 class="entry-title">Minha Conta</h1>
                <div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
                    <a href="{{route('home')}}" rel="v:url" property="v:title">Home</a> &raquo;
                    <span class="current">Minha Conta</span>
                </div>
            </header>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="site-content col-sm-12" role="main">
                <article id="post-9" class="post-9 page type-page status-publish hentry">

                    <div class="entry-content">
                        <div class="woocommerce">
                            <div class="woocommerce-my-account-wrapper">

                                @include('accounts.sidebar.sidebar-1')

                                <div class="woocommerce-MyAccount-content">
                                    <table class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">
                                        <thead>
                                        <tr>
                                            <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-number">
                                                <span class="nobr">Pedido</span>
                                            </th>
                                            <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-date">
                                                <span class="nobr">Data</span>
                                            </th>
                                            <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-status">
                                                <span class="nobr">Status</span>
                                            </th>
                                            <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-total">
                                                <span class="nobr">Total</span>
                                            </th>
                                            <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-actions">.
                                                <span class="nobr">Ações</span>
                                            </th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <tr class="woocommerce-orders-table__row woocommerce-orders-table__row--status-on-hold order">
                                            <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-number" data-title="Pedido">
                                                <a href="https://demo.xtemos.com/basel/my-account/view-order/29697/"># 73773</a>
                                            </td>
                                            <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-date" data-title="Data">
                                                <time datetime="2019-05-01T01:02:41+00:00">01 de Maio 2019</time>
                                            </td>
                                            <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-status" data-title="Status">
                                                Aguardando
                                            </td>
                                            <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-total" data-title="Total">
                                                <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol">R$ </span>366,00
                                                </span> para 2 itens
                                            </td>
                                            <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-actions" data-title="Ações">
                                                <a href="{{route('order.view', [$id])}}" class="woocommerce-button button view">Ver Ordem</a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
@endsection