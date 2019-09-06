@extends('frontend.layouts.template-1')
@push('title')
<title>{{$content->title}} {{config('app.name')}}</title>
    <meta name="description" content="{{$configKeyword->description}} , {{$configKeyword->genders}}">
    <meta name="keywords" content="{{$configKeyword->keywords}},{{$configKeyword->categories}},{{$configKeyword->genders}}">
@endpush
@push('body')
<body class="page-template-default page page-id-9 woocommerce-account woocommerce-page woocommerce-lost-password woocommerce-no-js wrapper-full-width global-cart-design-1 global-search-full-screen global-header-shop mobile-nav-from-left basel-light catalog-mode-off categories-accordion-on global-wishlist-enable basel-top-bar-on basel-ajax-shop-on basel-ajax-search-on enable-sticky-header header-full-width sticky-header-real offcanvas-sidebar-mobile offcanvas-sidebar-tablet sticky-toolbar-on wpb-js-composer js-comp-ver-5.7 vc_responsive">
@endpush
@section('content')
    <div class="main-page-wrapper">
        <div class="page-title page-title-default title-size-small title-design-centered color-scheme-light" style="">
            <div class="container">
                <header class="entry-header">
                    <div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
                        <a href="{{route('home')}}" rel="v:url" property="v:title">Home</a>
                        &raquo; <span class="current">{{$content->title}}</span>
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
                                @if (session('status'))
                                    <div class="woocommerce-notices-wrapper">
                                        <div class="woocommerce-message" role="alert">
                                            {{ session('status') }}
                                        </div>
                                        <p>{{$content->text_success}}</p>
                                    </div>
                                @else

                                    @if ($errors->has('email'))
                                        <div class="woocommerce-notices-wrapper">
                                            <ul class="woocommerce-error" role="alert">
                                                <li><strong>{{ $errors->first('email') }}</strong></li>
                                            </ul>
                                        </div>
                                    @endif

                                    <form method="post" action="{{ route('password.email') }}" class="woocommerce-ResetPassword lost_reset_password">
                                            @csrf
                                            <p>{{$content->text_info}}</p>
                                            <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
                                                <label for="user_login">{{$content->label}}</label>
                                                <input class="woocommerce-Input woocommerce-Input--text input-text" type="text" name="email" id="email" autocomplete="email" />
                                            </p>
                                            <div class="clear"></div>
                                            <p class="woocommerce-form-row form-row">
                                                <button type="submit" class="woocommerce-Button button" value="{{$content->btn_send}}">{{$content->btn_send}}</button>
                                            </p>
                                        </form>

                                @endif
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
@endsection