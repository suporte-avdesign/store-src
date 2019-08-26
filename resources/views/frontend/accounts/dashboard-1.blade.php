@extends('frontend.layouts.template-1')
@push('title')
<title>{{$content->title}} {{config('app.name')}}</title>
@endpush
@push('styles')
<link rel="stylesheet" id="select2-css"  href="{{asset('plugins/select2/css/select2.css')}}" type="text/css" media="all" />
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

                                <!-- .basel-my-account-sidebar -->
                                <div class="woocommerce-MyAccount-content">
                                    <p>
                                        <strong>{{$content->dashboard->text_salutation}}</strong>
                                    </p>
                                    <p>{{$content->dashboard->text}}</p>

                                    <div class="basel-my-account-links">
                                        <div class="dashboard-link">
                                            <a href="{{route('account')}}">{{$content->sidebar->dashboard}}</a>
                                        </div>
                                        <div class="orders-link">
                                            <a href="{{route('account.order')}}">{{$content->sidebar->orders}}</a>
                                        </div>
                                        <div class="edit-address-link">
                                            <a href="{{route('account.address')}}">{{$content->sidebar->address}}</a>
                                        </div>
                                        <div class="edit-account-link">
                                            <a href="{{route('account.profile')}}">{{$content->sidebar->profile}}</a>
                                        </div>
                                        <div class="logout-link">
                                            <a href="javascript:logoutUser('{{route('logout')}}', '{{ csrf_token() }}');">{{$content->sidebar->logout}}</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
@endsection