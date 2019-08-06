@extends('frontend.layouts.template-1')
@push('title')
<title> Seu Carrinho - {{config('app.name')}}</title>
@endpush
@push('styles')
<link rel="stylesheet" id="select2-css"  href="{{asset('plugins/select2/css/select2.css')}}?ver=3.5.2" type="text/css" media="all" />
@endpush
@push('head')
<script type='text/javascript'>
    var _zxcvbnSettings = {!! json_encode(["src" => asset('includes/zxcvbn/js/zxcvbn-async.min.js')]) !!}
</script>
<script type="text/javascript" src="{{asset('includes/zxcvbn/js/zxcvbn-async.min.js')}}"></script>
@endpush
@push('body')
<body class="page-template-default page page-id-8 woocommerce-checkout woocommerce-page woocommerce-order-received woocommerce-no-js wrapper-full-width global-cart-design-1 global-search-full-screen global-header-shop mobile-nav-from-left basel-light catalog-mode-off categories-accordion-on global-wishlist-enable basel-top-bar-on basel-ajax-shop-on basel-ajax-search-on enable-sticky-header header-full-width sticky-header-real offcanvas-sidebar-mobile offcanvas-sidebar-tablet wpb-js-composer js-comp-ver-5.6 vc_responsive">
@endpush
@section('content')
    <div class="page-title page-title-default title-size-small title-design-centered color-scheme-light" style="">
        <div class="container">
            <header class="entry-header">
                <h1 class="entry-title">Seu Pedido</h1>
                <div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
                    <a href="{{route('home')}}" rel="v:url" property="v:title">Home</a> &raquo;
                    <span class="current">Seu pedido</span>
                </div>
            </header>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="site-content col-sm-12" role="main">
                <article id="post-8" class="post-8 page type-page status-publish hentry">
                    <div class="entry-content">
                        <div class="woocommerce">
                            <div class="woocommerce-order">
                                <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">
                                    Obrigado. Seu pedido foi recebido.
                                </p>

                                <ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">
                                    <li class="woocommerce-order-overview__order order">Pedido número:
                                        <strong>12345</strong>
                                    </li>
                                    <li class="woocommerce-order-overview__date date">Data:
                                        <strong>27 de abril 2019</strong>
                                    </li>
                                    <li class="woocommerce-order-overview__total total">Total:
                                        <strong>
                                            <span class="woocommerce-Price-amount amount">
                                                <span class="woocommerce-Price-currencySymbol">R$ </span>208,00
                                            </span>
                                        </strong>
                                    </li>

                                    <li class="woocommerce-order-overview__payment-method method">Pagamento:
                                        <strong>Depósito em conta</strong>
                                    </li>
                                </ul>
                                <p>Faça seu pagamento diretamente em nossa conta bancária. Por favor, use o número do pedido como referência de pagamento. Seu pedido não será enviado até que os fundos sejam liberados em nossa conta.</p>

                                <section class="woocommerce-bacs-bank-details">
                                    <h2 class="wc-bacs-bank-details-heading">Nossos dados bancários</h2>
                                    <h3 class="wc-bacs-bank-details-account-name">Favorecido: {{$account_name}}</h3>
                                    <ul class="wc-bacs-bank-details order_details bacs_details">
                                        <li class="bank_name">Banco: <strong>{{$bank_name}}</strong></li>
                                        <li class="account_number">Agência: <strong>{{$branch_number}}</strong></li>
                                        <li class="sort_code">{{$account_type}} : <strong>{{$account_number}}</strong></li>
                                        <li class="iban">{{$reference_name}}: <strong>{{$reference_number}}</strong></li>
                                        <li class="bic">{{$document_name}}: <strong>{{$document_number}}</strong></li>
                                    </ul>
                                    <ul class="wc-bacs-bank-details order_details bacs_details">
                                    </ul>
                                </section>
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
                                                    <strong class="product-quantity">&times; 2</strong>
                                                </td>
                                                <td class="woocommerce-table__product-total product-total">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span class="woocommerce-Price-currencySymbol">R$ </span>198,00
                                                    </span>
                                                </td>
                                            </tr>

                                            <tr class="woocommerce-table__line-item order_item">
                                                <td class="woocommerce-table__product-name product-name">
                                                    <a href="#">Produto 2 - Vermelho</a> <strong class="product-quantity">&times; 1</strong>
                                                </td>

                                                <td class="woocommerce-table__product-total product-total">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span class="woocommerce-Price-currencySymbol">R$ </span>45,00
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>

                                        <tfoot>
                                        <tr>
                                            <th scope="row">Subtotal:</th>
                                            <td>
                                                <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol">R$ </span>208,00
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Frete:</th>
                                            <td>Correio PAC</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Método de pagamento:</th>
                                            <td>Depósito em conta</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Total:</th>
                                            <td>
                                                <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol">R$ </span>208,00
                                                </span>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </section>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script type="text/javascript" src="{{asset('plugins/select2/js/select2.full.min.js')}}?ver=1.0.4"></script>


@endpush