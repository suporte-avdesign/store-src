@extends('frontend.layouts.template-1')
@push('title')
    <title> {{$content->title}} {{$configKeyword->description}} {{config('app.name')}}</title>
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
<body class="page-template-default page page-id-8 woocommerce-register woocommerce-page woocommerce-no-js wrapper-full-width global-cart-design-1 global-search-full-screen global-header-shop mobile-nav-from-left basel-light catalog-mode-off categories-accordion-on global-wishlist-enable basel-top-bar-on basel-ajax-shop-on basel-ajax-search-on enable-sticky-header header-full-width sticky-header-real offcanvas-sidebar-mobile offcanvas-sidebar-tablet wpb-js-composer js-comp-ver-5.6 vc_responsive">
@endpush
@section('content')
    <div class="page-title page-title-default title-size-small title-design-centered color-scheme-light" style="">
        <div class="container">
            <header class="entry-header">
                <h1 class="entry-title">{{$content->title}}</h1>
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
                <article id="post-8" class="post-8 page type-page status-publish hentry">
                    <div class="entry-content">
                        <div class="woocommerce">
                            <div class="row">
                                <form id="form-register" name="register" method="post" class="register woocommerce-checkout" action="{{route('register')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-sm-6">
                                        <div class="row" id="customer_details">
                                            <div class="col-sm-12">
                                                <div class="woocommerce-billing-fields">
                                                    <h3>{{$content->title_detail_user}}</h3>
                                                    <p class="form-row form-row-wide">
                                                        @foreach($profiles as $profile)
                                                            @if($loop->first)
                                                                <input type="radio" class="input-radio" id="profile_{{$profile->id}}" name="register[profile_id]" value="{{$profile->id}}" checked /> <b>{{$profile->name}}</b>
                                                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                            @endif
                                                            @if($loop->last)
                                                                <input type="radio" class="input-radio" id="profile_{{$profile->id}}" name="register[profile_id]" value="{{$profile->id}}" /> <b>{{$profile->name}}</b>
                                                            @endif
                                                        @endforeach
                                                    </p>
                                                    <p class="form-row form-row-wide">
                                                        @foreach($types as $type)
                                                            @if($loop->first)
                                                                <input type="radio" class="input-radio" id="register_type_{{$type->id}}" name="register[type_id]" value="{{$type->id}}" checked /> <b>{{$type->name}}</b>
                                                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                            @endif
                                                            @if($loop->last)
                                                                <input type="radio" class="input-radio" id="register_type_{{$type->id}}" name="register[type_id]"  value="{{$type->id}}" /> <b>{{$type->name}}</b>
                                                            @endif
                                                        @endforeach
                                                    </p>
                                                    <div id="person_legal" style="display:block">
                                                        <p class="form-row form-row-first validate-required">
                                                            <label for="first_name_1" class="">{{constLang('person_legal.first_name')}} <span class="required">*</span></label>
                                                            <span class="woocommerce-input-wrapper">
                                                                <input type="text" class="input-text" id="first_name_1" name="register[first_name_1]" autocomplete="off" value=""/>
                                                            </span>
                                                        </p>
                                                        <p class="form-row form-row-last validate-required">
                                                            <label for="last_name_1">{{constLang('person_legal.last_name')}}&nbsp;<span class="required">*</span></label>
                                                            <span class="woocommerce-input-wrapper">
                                                                <input type="text" class="input-text" id="last_name_1" name="register[last_name_1]" autocomplete="off" value="" />
                                                            </span>
                                                        </p>

                                                        <p class="form-row form-row-first validate-required">
                                                            <label for="document1_1">{{constLang('person_legal.document1')}} <span class="required">*</span></label>
                                                            <span class="woocommerce-input-wrapper">
                                                                <input type="text" class="input-text" id="reg_document1_1" name="register[document1_1]" autocomplete="off" value=""/>
                                                            </span>
                                                        </p>
                                                        <p class="form-row form-row-last validate-required">
                                                            <label for="document2_1">{{constLang('person_legal.document2')}}&nbsp;<span class="required">*</span></label>
                                                            <span class="woocommerce-input-wrapper">
                                                            <input type="text" class="input-text" id="document2_1" name="register[document2_1]" autocomplete="off" value="" />
                                                        </span>
                                                        </p>
                                                    </div>
                                                    <div id="person_physical" style="display: none">
                                                        <p class="form-row form-row-first validate-required">
                                                            <label for="first_name_2" class="">{{constLang('person_physical.first_name')}} <span class="required">*</span></label>
                                                            <span class="woocommerce-input-wrapper">
                                                                <input type="text" class="input-text" id="first_name_2" name="register[first_name_2]" autocomplete="off" value=""/>
                                                            </span>
                                                        </p>
                                                        <p class="form-row form-row-last validate-required">
                                                            <label for="last_name_2">{{constLang('person_physical.last_name')}}&nbsp;<span class="required">*</span></label>
                                                            <span class="woocommerce-input-wrapper">
                                                                <input type="text" class="input-text" id="last_name_2" name="register[last_name_2]" autocomplete="off" value="" />
                                                            </span>
                                                        </p>

                                                        <p class="form-row form-row-first validate-required">
                                                            <label for="document1_2">{{constLang('person_physical.document1')}} <span class="required">*</span></label>
                                                            <span class="woocommerce-input-wrapper">
                                                                <input type="text" class="input-text" id="reg_document1_2" name="register[document1_2]" autocomplete="off" value=""/>
                                                            </span>
                                                        </p>
                                                        <p class="form-row form-row-last validate-required">
                                                            <label for="document2_2">{{constLang('person_physical.document2')}}&nbsp;<span class="required">*</span></label>
                                                            <span class="woocommerce-input-wrapper">
                                                                <input type="text" class="input-text" id="document2_2" name="register[document2_2]" autocomplete="off" value="" />
                                                            </span>
                                                        </p>
                                                    </div>
                                                    <p class="form-row form-row-first validate-required validate-email">
                                                        <label for="reg_email">{{constLang('email')}} <span class="required">*</span></label>
                                                        <span class="woocommerce-input-wrapper">
                                                            <input type="email" class="input-text" id="reg_email" name="register[email]" autocomplete="off" autocomplete="email" value="" />
                                                        </span>
                                                    </p>
                                                    <p class="form-row form-row-last validate-required">
                                                        <label for="reg_date">{{constLang('date_birth')}} &nbsp;<span class="required">*</span></label>
                                                        <span class="woocommerce-input-wrapper">
                                                           <input type="text" class="input-text" id="reg_date" name="register[date]" autocomplete="off" value="" />
                                                        </span>
                                                    </p>
                                                    <p class="form-row form-row-first validate-required">
                                                        <label for="reg_cell">{{constLang('cell')}}/Whatsapp <span class="required">*</span></label>
                                                        <span class="woocommerce-input-wrapper">
                                                            <input type="text" class="input-text" id="reg_cell" name="register[cell]" autocomplete="off" value="" />
                                                        </span>
                                                    </p>
                                                    <p class="form-row form-row-last">
                                                        <label for="reg_phone">{{constLang('other')}} {{constLang('phone')}}<span class="required"></span> </label>
                                                        <span class="woocommerce-input-wrapper">
                                                           <input type="text" class="input-text" id="reg_phone" name="register[phone]" autocomplete="off" value="" />
                                                        </span>
                                                    </p>
                                                    <p class="form-row form-row-first validate-required">
                                                        <label for="reg_password">{{constLang('password')}} <span class="required">*</span></label>
                                                        <span class="woocommerce-input-wrapper">
                                                            <input type="password" class="input-text" id="reg_password" name="register[password]" autocomplete="off" value="" />
                                                        </span>
                                                    </p>
                                                    <p class="form-row form-row-last validate-required">
                                                        <label for="reg_password_confirm">{{constLang('password_confirm')}} <span class="required">*</span></label>
                                                        <span class="woocommerce-input-wrapper">
                                                            <input type="password" class="input-text" id="reg_password_confirm" name="register[password_confirmation]" autocomplete="off" value="" />
                                                        </span>
                                                    </p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--ORDER -->
                                    <div class="col-sm-6">
                                        <div class="row" id="customer_details">
                                            <div class="col-sm-12">
                                                <div class="woocommerce-billing-fields">
                                                    <h3>{{$content->title_detail_address}}</h3>

                                                    <p class="form-row form-row-wide validate-required">
                                                        <label for="address">{{constLang('address')}} <span class="required">*</span></label>
                                                        <span class="woocommerce-input-wrapper">
                                                            <input type="text" class="input-text" id="address" name="address[address]" autocomplete="off" value="" />
                                                        </span>
                                                    </p>

                                                    <p class="form-row form-row-first validate-required">
                                                        <label for="address_number">{{constLang('number')}} <span class="required">*</span></label>
                                                        <span class="woocommerce-input-wrapper">
                                                            <input type="text" class="input-text" id="address_number" name="address[number]" autocomplete="off" value="" />
                                                        </span>
                                                    </p>

                                                    <p class="form-row form-row-last">
                                                        <label for="address_complement">{{constLang('complement')}} <span class="required"></span></label>
                                                        <span class="woocommerce-input-wrapper">
                                                           <input type="text" class="input-text" id="address_complement" name="address[complement]" autocomplete="off" value="" />
                                                        </span>
                                                    </p>
                                                    <p class="form-row form-row-first validate-required">
                                                        <label for="district">{{constLang('district')}} <span class="required">*</span></label>
                                                        <span class="woocommerce-input-wrapper">
                                                            <input type="text" class="input-text" id="district" name="address[district]" autocomplete="off" value="" />
                                                        </span>
                                                    </p>
                                                    <p class="form-row form-row-last validate-required">
                                                        <label for="city">{{constLang('city')}} <span class="required">*</span></label>
                                                        <span class="woocommerce-input-wrapper">
                                                            <input type="text" class="input-text" id="city" name="address[city]" autocomplete="off" value="" />
                                                        </span>
                                                    </p>

                                                    <p class="form-row form-row-first validate-required">
                                                        <label for="zip_code">{{constLang('zip_code')}} &nbsp;<span class="required">*</span></label>
                                                        <span class="woocommerce-input-wrapper">
                                                           <input type="text" class="input-text" id="zip_code" name="address[zip_code]" value="" autocomplete="off" />
                                                        </span>
                                                    </p>

                                                    <p class="form-row form-row-last address-field validate-required validate-state" id="billing_state_field" data-priority="80">
                                                        <label for="state" class="select2-selection__rendered">{{constLang('state')}}<span class="required">*</span></label>
                                                        <span class="woocommerce-input-wrapper">
                                                            <select name="address[state]" id="state" autocomplete="off" class="state_select">
                                                                <option value="">{{constLang('select_state')}}</option>
                                                                @foreach($states as $state)
                                                                    <option value="{{$state->uf}}">{{$state->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </span>
                                                    </p>

                                                </div>

                                                <div class="woocommerce-account-fields">
                                                    <p class="form-row form-row-wide create-account woocommerce-validated">
                                                        <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                                                            <input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="newsletter" type="checkbox" name="newsletter[0]" value="1">
                                                            <span>{{$content->label_newsletter}}</span>
                                                        </label>
                                                    </p>

                                                    <p class="form-row form-row-wide create-account woocommerce-validated">
                                                        <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                                                            <input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox"  id="indicate_transport" type="checkbox" name="transport[indicate]" value="1">
                                                            <span>{{$content->title_indicate_transport}}</span>
                                                        </label>
                                                    </p>

                                                    <div class="indicate_transport" style="display:none">
                                                        <p class="form-row form-row-first validate-required">
                                                            <label for="transport_name" class="">{{$content->label_name_transport}} <span class="required">*</span></label>
                                                            <input type="text" class="input-text" id="transport_name" autocomplete="off" name="transport[name]" value=""/>
                                                        </p>
                                                        <p class="form-row form-row-last validate-required">
                                                            <label for="transport_phone" class="">{{$content->label_phone_transport}} <span class="required">*</span></label>
                                                            <input type="text" class="input-text" id="transport_phone" name="transport[phone]" autocomplete="off" value="" />
                                                        </p>
                                                        <div class="clear"></div>
                                                    </div>
                                                </div>


                                                <div class="text-center">
                                                    <button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="{{$content->title_btn_send}}" data-value="{{$content->title_btn_send}}">{{$content->title_btn_send}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
    var avd_config_register = {!! json_encode([
        "option_indicate_transport" => "yes",
        "register_url" => route('register'),
        "is_register" => "1",
        "debug_mode" => "",
        "csrf_token" => csrf_token(),
        "error_json" => "Json Invalid",
        "i18n_register_error" => constLang('messages.register.account_failure')
    ]) !!}
</script>


<script type="text/javascript" src="{{asset('plugins/account/register.min.js')}}"></script>
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