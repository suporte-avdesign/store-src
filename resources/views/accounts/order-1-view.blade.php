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
                                    <p>
                                        Pedido #
                                        <mark class="order-number">123456</mark> foi feita em
                                        <mark class="order-date">1º de maio de 2019</mark> e o status é
                                        <mark class="order-status">Aguardando</mark>.
                                    </p>

                                    <section class="woocommerce-order-details">
                                        <h2 class="woocommerce-order-details__title">Detalhes do Pedido</h2>
                                        <table class="woocommerce-table woocommerce-table--order-details shop_table order_details">
                                            <thead>
                                                <tr>
                                                    <th class="woocommerce-table__product-name product-name">Produto</th>
                                                    <th class="woocommerce-table__product-table product-total">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="woocommerce-table__line-item order_item">
                                                    <td class="woocommerce-table__product-name product-name">
                                                        <a href="#">Produto 1</a>
                                                        <strong class="product-quantity">&times; 1</strong>
                                                    </td>
                                                    <td class="woocommerce-table__product-total product-total">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <span class="woocommerce-Price-currencySymbol">R$ </span>275,00
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr class="woocommerce-table__line-item order_item">
                                                    <td class="woocommerce-table__product-name product-name">
                                                        <a href="#">Produto 2</a>
                                                        <strong class="product-quantity">&times; 1</strong>
                                                    </td>

                                                    <td class="woocommerce-table__product-total product-total">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <span class="woocommerce-Price-currencySymbol">R$ </span>79,00
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>

                                            <tfoot>
                                            <tr>
                                                <th scope="row">Subtotal:</th>
                                                <td>
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span class="woocommerce-Price-currencySymbol">R$ </span>354,00
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Frete:</th>
                                                <td>
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span class="woocommerce-Price-currencySymbol">R$ </span>12,00
                                                    </span>&nbsp;
                                                    <small class="shipped_via">Correio (PAC)</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Méodo e Pagamento:</th>
                                                <td>Depósito em conta</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Total:</th>
                                                <td>
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span class="woocommerce-Price-currencySymbol">R$ </span>366,00
                                                    </span>
                                                </td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </section>

                                    <section class="woocommerce-customer-details">
                                        <section class="woocommerce-columns woocommerce-columns--2 woocommerce-columns--addresses col2-set addresses">
                                            <div class="woocommerce-column woocommerce-column--1 woocommerce-column--billing-address col-1">
                                                <h2 class="woocommerce-column__title">Endereço de Cobrança</h2>
                                                <address>
                                                    São Roque Calçacod<br>
                                                    Rua Cavalheiro, 243<br>
                                                    Brás - São Paulo<br>
                                                    CEP: 03010-000
                                                    <p class="woocommerce-customer-details--phone">Telefone: (11)969384849</p>
                                                    <p class="woocommerce-customer-details--email">Email: maniadepizza@gmail.com</p>
                                                </address>
                                            </div>
                                            <!-- /.col-1 -->
                                            <div class="woocommerce-column woocommerce-column--2 woocommerce-column--shipping-address col-2">
                                                <h2 class="woocommerce-column__title">Endereço de Entrega</h2>
                                                <address>
                                                    São Roque Calçacod<br>
                                                    Rua Cavalheiro, 243<br>
                                                    Brás - São Paulo<br>
                                                    CEP: 03010-000
                                                    <p class="woocommerce-customer-details--phone">Telefone: (11)969384849</p>
                                                </address>
                                            </div>
                                        </section>

                                    </section>

                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
@endsection