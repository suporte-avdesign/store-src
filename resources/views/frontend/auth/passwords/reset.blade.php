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
                                @error('password')
                                    <div class="woocommerce-notices-wrapper">
                                        <ul class="woocommerce-error" role="alert">
                                            <li><strong>{{ $message }}</strong></li>
                                        </ul>
                                    </div>
                                @enderror

                                @error('email')
                                    <div class="woocommerce-notices-wrapper">
                                        <ul class="woocommerce-error" role="alert">
                                            <li><strong>{{ $message }}</strong></li>
                                        </ul>
                                    </div>
                                @enderror
                                <form method="post" action="{{ route('password.update') }}" class="lost_reset_password">
                                    @csrf

                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <h3>{{$content->text_info}}</h3>

                                    <p class="form-row form-row-first">
                                        <label for="email">{{$content->email}}&nbsp;<span class="required">*</span></label>
                                        <input id="email" type="email" class="input-text @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                    </p>

                                    <p class="form-row form-row-first">
                                        <label for="password">{{$content->label}}&nbsp;<span class="required">*</span></label>
                                        <input id="password" type="password" class="input-text @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    </p>

                                    <p class="form-row form-row-last">
                                        <label for="password-confirm">{{$content->confirm}}&nbsp;<span class="required">*</span></label>
                                        <input id="password-confirm" type="password" class="input-text" name="password_confirmation" required autocomplete="new-password">
                                    </p>

                                    <div class="clear"></div>

                                    <p class="woocommerce-form-row form-row">
                                        <input type="hidden" name="wc_reset_password" value="true" />
                                        <button type="submit" class="button" value="{{$content->btn_send}}">{{$content->btn_send}}</button>
                                    </p>
                                </form>
                            </div>
                        </div>

                    </article>
                </div>
            </div>
        </div>
    </div>
@endsection