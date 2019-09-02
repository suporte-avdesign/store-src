@extends('frontend.layouts.template-1')
@push('title')
<title> {{$content->sidebar->address}} - {{config('app.name')}}</title>
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
                                    <div class="woocommerce-notices-wrapper"></div>
                                    <form id="form-address" method="post" class="address" action="{{route('address.update')}}">
                                        <div style="display: none">
                                            @method('put')
                                            @csrf
                                        </div>
                                        <h3>{{$content->sidebar->address}}</h3>
                                        <p>{{$content->address->text_details}}</p>
                                        <div class="woocommerce-address-fields">
                                            <div class="woocommerce-address-fields__field-wrapper">
                                                @if(!empty($transport))
                                                    @include('frontend.accounts.transport.yes')
                                                @else
                                                    @include('frontend.accounts.transport.not')
                                                @endif
                                                <p class="form-row form-row-wide validate-required">
                                                    <label for="address" class="">{{constLang('address')}}&nbsp;<abbr class="required" title="{{constLang('required')}}">*</abbr></label>
                                                    <span class="woocommerce-input-wrapper">
                                                        <input type="text" class="input-text " name="address[address]" id="address" value="{{$address->address}}">
                                                    </span>
                                                </p>
                                                <p class="form-row form-row-first validate-required">
                                                    <label for="number" class="">{{constLang('number')}}&nbsp;<abbr class="required" title="{{constLang('required')}}">*</abbr></label>
                                                    <span class="woocommerce-input-wrapper">
                                                        <input type="text" class="input-text" name="address[number]" id="number" value="{{$address->number}}">
                                                    </span>
                                                </p>
                                                <p class="form-row form-row-last">
                                                    <label for="complement" class="">{{constLang('complement')}}&nbsp;<abbr class="required"></abbr>({{constLang('optional')}})</label>
                                                    <span class="woocommerce-input-wrapper">
                                                        <input type="text" class="input-text" name="address[complement]" id="complement" value="{{$address->complement}}">
                                                    </span>
                                                </p>
                                                <p class="form-row form-row-first validate-required">
                                                    <label for="district" class="">{{constLang('district')}}&nbsp;<abbr class="required" title="{{constLang('required')}}">*</abbr></label>
                                                    <span class="woocommerce-input-wrapper">
                                                        <input type="text" class="input-text" name="address[district]" id="district" value="{{$address->district}}">
                                                    </span>
                                                </p>
                                                <p class="form-row form-row-last validate-required">
                                                    <label for="city" class="">{{constLang('city')}}&nbsp;<abbr class="required" title="{{constLang('required')}}">*</abbr></label>
                                                    <span class="woocommerce-input-wrapper">
                                                        <input type="text" class="input-text" name="address[city]" id="city" value="{{$address->city}}">
                                                    </span>
                                                </p>
                                                <p class="form-row form-row-first validate-required">
                                                    <label for="zip_code" class="">{{constLang('zip_code')}}&nbsp;<abbr class="required" title="{{constLang('required')}}">*</abbr></label>
                                                    <span class="woocommerce-input-wrapper">
                                                        <input type="text" class="input-text" name="address[zip_code]" id="zip_code" value="{{$address->zip_code}}">
                                                    </span>
                                                </p>
                                                <p class="form-row form-row-last validate-required">
                                                    <label for="state" class="">{{constLang('state')}}&nbsp;<abbr class="required" title="{{constLang('required')}}">*</abbr></label>
                                                    <span class="woocommerce-input-wrapper">
                                                        <select name="address[state]" id="state" class="state_select " autocomplete="address-level1" data-placeholder="">
                                                            @foreach($states as $state)
                                                                <option value="{{$state->uf}}" @if($address->state == $state->uf) selected @endif>{{$state->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </span>
                                                </p>
                                            </div>
                                            <p class="form-row form-row-wide">
                                                <button type="submit" class="button" name="save_address" value="save_address">{{$content->address->btn_submit}}</button>
                                            </p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script type="text/javascript" src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script type='text/javascript'>
    var wc_country_select_params = {!! json_encode($json_countries) !!}
</script>

<script type="text/javascript" src="{{asset('plugins/address/country-select.min.js')}}"></script>
<script type='text/javascript'>
    var wc_address_i18n_params = {!! json_encode($json_locale) !!}
</script>
<script type="text/javascript" src="{{asset('plugins/address/address-i18n.min.js')}}"></script>
<script type='text/javascript'>
    var avd_config_address = {!! json_encode([
        "option_indicate_transport" => "yes",
        "address_url" => route('address.update'),
        "is_address" => "1",
        "debug_mode" => "",
        "csrf_token" => csrf_token(),
        "error_json" => "Json Invalid",
        "i18n_address_error" => $content->messages->change_error
    ]) !!}
</script>
<script type="text/javascript" src="{{asset('plugins/account/address.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/jquery-maskedinput/jquery.maskedinput.min.js')}}"></script>
<script type='text/javascript'>
    jQuery( document ).ready(function($) {
        $("#transport_phone").mask('(99)9999-9999?9');
        $("#zip_code").mask('99999-999');
    });
</script>
@endpush
