@extends('frontend.layouts.template-1')
@push('title')
<title> {{$content->orders->title}} - {{config('app.name')}}</title>
@endpush
@push('body')
<body class="page-template-default page page-id-9 logged-in woocommerce-account woocommerce-page woocommerce-no-js wrapper-full-width global-cart-design-1 global-search-full-screen global-header-shop mobile-nav-from-left basel-light catalog-mode-off categories-accordion-on global-wishlist-enable basel-top-bar-on basel-ajax-shop-on basel-ajax-search-on enable-sticky-header header-full-width sticky-header-real offcanvas-sidebar-mobile offcanvas-sidebar-tablet wpb-js-composer js-comp-ver-5.6 vc_responsive">
@endpush
@section('content')
    <div class="page-title page-title-default title-size-small title-design-centered color-scheme-light" style="">
        <div class="container">
            <header class="entry-header">
                <div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
                    <a href="{{route('home')}}" rel="v:url" property="v:title">Home</a> &raquo;
                    <span class="current">{{$content->title}}</span>
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

                                @include('frontend.accounts.sidebar.sidebar-1')

                                <div class="woocommerce-MyAccount-content">
                                    <p>
                                        {{$content->orders->order}}
                                        <mark class="order-number">#{{$order->reference}}</mark> {{ $content->orders->text_created }}
                                        <mark class="order-date">{{$order->created_at->diffForHumans()}}</mark>, {{ $content->orders->text_status }}
                                        <mark class="order-status">{{$order->ConfigStatusPayment->label}}</mark>.
                                    </p>

                                    <section class="woocommerce-order-details">
                                        <h2 class="woocommerce-order-details__title">{{$content->orders->text_details}}</h2>
                                        <table class="woocommerce-table woocommerce-table--order-details shop_table order_details">
                                            <thead>
                                                <tr>
                                                    <th class="woocommerce-table__product-name product-name">{{$content->orders->product}}</th>
                                                    <th class="woocommerce-table__product-table product-total">{{$content->orders->total}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($items as $item)
                                                    <tr class="woocommerce-table__line-item order_item">
                                                        <td class="woocommerce-table__product-name product-name">
                                                            <a href="#">{{$item->name}}</a>
                                                            <strong class="product-quantity">&times; {{$item->quantity}}</strong> -
                                                            @if($order->config_form_payment_id <= 2)
                                                                {{$content->orders->value}}: <strong> {{setReal($item->price_cash)}}</strong>
                                                            @else
                                                                {{$content->orders->value}}: <strong> {{setReal($item->price_card)}}</strong>
                                                            @endif
                                                            <p>
                                                                {{$content->orders->grid}}: <strong>{{$item->grid}}</strong> -
                                                                {{$content->orders->color}}: <strong>{{$item->color}}</strong>
                                                            </p>
                                                        </td>
                                                        <td class="woocommerce-table__product-total product-total">
                                                            <span class="woocommerce-Price-amount amount">
                                                                @if($order->config_form_payment_id <= 2)
                                                                    <span class="woocommerce-Price-currencySymbol">{{constLang('currency')}} </span>
                                                                    {{setReal($item->price_cash * $item->quantity)}}
                                                                @else
                                                                    <span class="woocommerce-Price-currencySymbol">{{constLang('currency')}} </span>
                                                                    {{setReal($item->price_card * $item->quantity)}}
                                                                @endif
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                            <tfoot>
                                            <tr>
                                                <th scope="row">{{$content->orders->subtotal}}:</th>
                                                <td>
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span class="woocommerce-Price-currencySymbol">{{constLang('currency')}} </span>{{setReal($order->subtotal)}}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">{{$content->orders->freight}}:</th>
                                                <td>
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span class="woocommerce-Price-currencySymbol">{{constLang('currency')}} </span>{{setReal($order->freight)}}
                                                    </span>&nbsp;
                                                    <small class="shipped_via">{{$order->configShipping->label}}</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">{{$content->orders->method_payment}}:</th>
                                                <td>{{$order->configShipping->label}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">{{$content->orders->total}}:</th>
                                                <td>
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span class="woocommerce-Price-currencySymbol">{{constLang('currency')}} </span>{{setReal($order->total)}}
                                                    </span>
                                                </td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </section>

                                    <section class="woocommerce-customer-details">
                                        <section class="woocommerce-columns woocommerce-columns--2 woocommerce-columns--addresses col2-set addresses">
                                            <div class="woocommerce-column woocommerce-column--1 woocommerce-column--billing-address col-1">
                                                <h2 class="woocommerce-column__title"> {{$content->sidebar->address}}</h2>
                                                <address>
                                                    {{$name}}<br>
                                                    {{$address->address}}, {{$address->number}}<br>
                                                    @if($address->complement)
                                                        {{$address->complement}}<br>
                                                    @endif
                                                    {{$address->district}} - {{$address->city}}-{{$address->state}}<br>
                                                    {{constLang('zip_code')}}: {{$address->zip_code}}
                                                    <p class="woocommerce-customer-details--phone">{{constLang('phone')}}: {{$user->cell}} {{$user->phone}}</p>
                                                    <p class="woocommerce-customer-details--email">{{constLang('email')}}: {{$user->email}}</p>
                                                </address>
                                            </div>
                                            <div class="woocommerce-column woocommerce-column--2 woocommerce-column--shipping-address col-2">
                                                <h2 class="woocommerce-column__title">{{$content->orders->title_note}}</h2>
                                                <address>
                                                    @foreach($notes as $note)
                                                        @if($note->who === 2)
                                                            <p>{{$note->name}}: {{$note->description}}</p>
                                                        @endif
                                                    @endforeach

                                                    @foreach($shippings as $shipping)
                                                        @if($shipping->indicate === 1)
                                                            <h4>{{$content->orders->text_indicate}}</h4>
                                                            <p>{{constLang('name')}}: {{$shipping->name}}</p>
                                                            <p>{{constLang('phone')}}: {{$shipping->phone}}</p>
                                                        @endif
                                                    @endforeach
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
