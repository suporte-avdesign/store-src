@extends('frontend.layouts.template-1')
@push('title')
<title> {{$content->orders->title}} - {{config('app.name')}}</title>
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
                                    @if(empty($order))
                                        <div class="woocommerce-Message woocommerce-Message--info woocommerce-info">
                                            {{$content->orders->text_empty_order}}
                                        </div>
                                    @else
                                        <table class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">
                                        <thead>
                                        <tr>
                                            <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-number">
                                                <span class="nobr">{{$content->orders->order}}</span>
                                            </th>
                                            <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-date">
                                                <span class="nobr">{{$content->orders->date}}</span>
                                            </th>
                                            <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-status">
                                                <span class="nobr">{{$content->orders->status}}</span>
                                            </th>
                                            <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-total">
                                                <span class="nobr">{{$content->orders->total}}</span>
                                            </th>
                                            <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-actions">.
                                                <span class="nobr">{{$content->orders->actions}}</span>
                                            </th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                            @foreach($orders as $order)

                                                <tr class="woocommerce-orders-table__row woocommerce-orders-table__row--status-on-hold order">
                                                    <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-number" data-title="{{$content->orders->order}}">
                                                        <a href="{{route('order.view', $order->reference)}}">{{$order->reference}}</a>
                                                    </td>
                                                    <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-date" data-title="{{$content->orders->date}}">
                                                        <time>{{$order->created_at->diffForHumans()}}</time>
                                                    </td>
                                                    <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-status" data-title="{{$content->orders->status}}">
                                                        {{$order->ConfigStatusPayment->label}}
                                                    </td>
                                                    <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-total" data-title="{{$content->orders->total}}">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <span class="woocommerce-Price-currencySymbol">R$ </span>{{setReal($order->total)}}
                                                        </span>
                                                    </td>
                                                    <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-actions" data-title="{{$content->orders->actions}}">
                                                        <a href="{{route('order.view', $order->reference)}}" class="woocommerce-button button view">Ver Ordem</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        </table>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
@endsection