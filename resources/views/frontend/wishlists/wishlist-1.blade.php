@extends('frontend.layouts.template-1')
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

                        @include('frontend.wishlists.wishlist-1-form')

                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
@endsection