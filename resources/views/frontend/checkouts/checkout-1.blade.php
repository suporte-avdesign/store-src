@extends('frontend.layouts.template-1')
@push('title')
    <title> {{constLang('messages.checkouts.title')}} {{$configKeyword->description}} {{config('app.name')}}</title>
<meta name="description" content="{{$configKeyword->description}} , {{$configKeyword->genders}}">
<meta name="keywords" content="{{$configKeyword->keywords}},{{$configKeyword->categories}},{{$configKeyword->genders}}">
@endpush
@push('styles')
<link rel="stylesheet" id="select2-css"  href="{{asset('plugins/select2/css/select2.css')}}" type="text/css" media="all" />
@endpush
@push('head')
@push('head')
<script type='text/javascript'>
    var _zxcvbnSettings = {!! json_encode(["src" => asset('includes/zxcvbn/js/zxcvbn-async.min.js')]) !!}
</script>
<script type="text/javascript" src="{{asset('includes/zxcvbn/js/zxcvbn-async.min.js')}}"></script>
@endpush
@push('body')
<body class="page-template-default page page-id-8 woocommerce-checkout woocommerce-page woocommerce-no-js wrapper-full-width global-cart-design-1 global-search-full-screen global-header-shop mobile-nav-from-left basel-light catalog-mode-off categories-accordion-on global-wishlist-enable basel-top-bar-on basel-ajax-shop-on basel-ajax-search-on enable-sticky-header header-full-width sticky-header-real offcanvas-sidebar-mobile offcanvas-sidebar-tablet wpb-js-composer js-comp-ver-5.6 vc_responsive">
@endpush
@section('content')
    <div class="page-title page-title-default title-size-small title-design-centered color-scheme-light" style="">
        <div class="container">
            <header class="entry-header">
                <h1 class="entry-title">{{constLang('messages.checkouts.title')}}</h1>
                <div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
                    <a href="{{route('home')}}" rel="v:url" property="v:title">Home</a> &raquo;
                    <span class="current">{{constLang('messages.checkouts.title')}}</span>
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

                            @if ($errors->any())
                                <div class="woocommerce-notices-wrapper">
                                    <ul class="woocommerce-error" role="alert">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @error('inactive')
                                <div class="woocommerce-notices-wrapper">
                                    <ul class="woocommerce-error" role="alert">
                                        <li>
                                            <strong>ERRO</strong>:
                                            {{ $message }}
                                        </li>
                                    </ul>
                                </div>
                            @enderror
                            <!-- FORM LOGIN -->
                            @include('frontend.checkouts.includes.form-login-1')
                            <!-- FORM COUPON -->
                            @include('frontend.coupons.coupon-checkout-1')

                            <div class="row">
                                <form id="form-checkout" name="checkout" method="post" class="checkout woocommerce-checkout" action="{{route('checkout')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-sm-6">
                                        <div class="row" id="customer_details">
                                            <div class="col-sm-12">
                                                @auth
                                                    @include('frontend.checkouts.includes.form-logged-1')
                                                @else
                                                    @include('frontend.checkouts.includes.form-register-1')
                                                @endauth
                                            </div>
                                            <div class="col-sm-12">
                                                @include('frontend.checkouts.includes.additional-fields')
                                            </div>
                                        </div>
                                    </div>

                                    <!--ORDER -->
                                    <div class="col-sm-6">
                                        <div class="checkout-order-review">
                                            <h3 id="order_review_heading">{{constLang('messages.checkouts.detail_order')}}</h3>
                                            <div id="order_review" class="woocommerce-checkout-review-order">
                                                <!-- METHOD -->
                                                @include('frontend.checkouts.includes.order-1')

                                                @include('frontend.checkouts.includes.payment-1')
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </article>

                @include('frontend.payments.pagseguro.credit-1')

            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script type="text/javascript" src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script type="text/javascript">
    var pwsL10n = {!! json_encode([
        "unknown" => constLang('messages.login.pass_unknown'),
        "short" => constLang('messages.login.pass_short'),
        "bad" => constLang('messages.login.pass_bad'),
        "good" => constLang('messages.login.pass_good'),
        "strong" => constLang('messages.login.pass_strong'),
        "mismatch" => constLang('messages.login.pass_mismatch')
    ]) !!}
</script>
<script type="text/javascript" src="{{asset('includes/zxcvbn/js/password-strength-meter.min.js')}}"></script>
<script type="text/javascript">
    var wc_password_strength_meter_params = {!! json_encode([
        "min_password_strength" => "3",
        "i18n_password_error" => constLang('messages.login.password_strong'),
        "i18n_password_hint" => constLang('messages.login.password_hint')
    ]) !!}
</script>



<script type='text/javascript'>
    var wc_country_select_params = {!! json_encode($json_countries) !!}
</script>

<script type="text/javascript" src="{{asset('plugins/address/country-select.min.js')}}"></script>
<script type='text/javascript'>
    var wc_address_i18n_params = {!! json_encode($json_locale) !!}
</script>
<script type="text/javascript" src="{{asset('plugins/address/address-i18n.min.js')}}"></script>


<script type='text/javascript'>
    var wc_checkout_params = {!! json_encode([
        "ajax_url_review" => route('checkout.review'),
        "ajax_coupon" => route('coupon.store')."/?ajax=%%endpoint%%",
        "update_order_review_nonce" => random_string(),
        "apply_coupon_nonce" => random_string(),
        "remove_coupon_nonce" => random_string(),
        "option_guest_checkout" => "yes",
        "option_indicate_transport" => "yes",
        "checkout_url" => route('checkout.store'),
        "is_checkout" => "1",
        "debug_mode" => "",
        "csrf_token" => csrf_token(),
        "i18n_checkout_error" => constLang('messages.checkouts.error')
    ]) !!}
</script>

<script type="text/javascript" src="{{asset('plugins/checkout/checkout.min.js')}}?{{time()}}"></script>
<script type="text/javascript" src="{{asset('plugins/jquery-maskedinput/jquery.maskedinput.min.js')}}"></script>
<script type="text/javascript" src="{{asset('themes/js/functions.min.js')}}"></script>
<script type='text/javascript'>
    jQuery( document ).ready(function($) {
        $("#transport_phone").mask('(99) 9999-9999?9');
        $("#reg_phone").mask('(99)9999-9999?9');
        $("#reg_cell").mask('(99)99999-9999');
        $("#reg_date").mask('99/99/9999');
        $("#reg_document1_1").mask('99.999.999/9999-99');
        $("#reg_document1_2").mask('999.999.999-99');
        $("#zip_code").mask('99999-999');

    });
</script>
@endpush