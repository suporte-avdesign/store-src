@extends('frontend.layouts.template-1')
@push('title')
<title> {{$content->sidebar->profile}}- {{config('app.name')}}</title>
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

                                    <form id="form-profile" class="profile edit-account" action="{{route('account.profile')}}" method="post">
                                        <div style="display: none">
                                            @method('put')
                                            @csrf
                                            <input type="hidden" name="register[profile_id]" value="{{$user->profile_id}}"/>
                                        </div>
                                        <h3>{{$content->sidebar->profile}}</h3>

                                        <p class="form-row form-row-wide" style="margin-left: 20px">
                                            <label class="newsletter checkbox">
                                                <input class="input-checkbox"  id="newsletter" type="checkbox" name="register[newsletter]" value="1" @if($user->newsletter == 1) checked @endif>
                                                <span>{{$content->newsletter->text}}</span>
                                            </label>
                                        </p>

                                        <p class="form-row form-row-wide">
                                            @foreach($types as $type)
                                                @if($loop->first)
                                                    <input type="radio" class="input-radio" id="register_type_{{$type->id}}" name="register[type_id]" value="{{$type->id}}" @if($user->type_id == 1) checked @endif />
                                                    <b>{{$type->name}}</b>
                                                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                @endif
                                                @if($loop->last)
                                                    <input type="radio" class="input-radio" id="register_type_{{$type->id}}" name="register[type_id]"  value="{{$type->id}}" @if($user->type_id == 2) checked @endif />
                                                        <b>{{$type->name}}</b>
                                                @endif
                                            @endforeach
                                        </p>

                                        @include('frontend.accounts.profiles.person-legal')
                                        @include('frontend.accounts.profiles.person-physical')

                                        <p class="form-row form-row-first validate-required">
                                            <label for="register_cell">{{constLang('cell')}}/Whatsapp <span class="required">*</span></label>
                                            <span class="woocommerce-input-wrapper">
                                                <input type="text" class="input-text" id="register_cell" name="register[cell]" value="{{$user->cell}}" />
                                            </span>
                                        </p>
                                        <p class="form-row form-row-last">
                                            <label for="register_phone">{{constLang('other')}} {{constLang('phone')}}<span class="required"></span> </label>
                                            <span class="woocommerce-input-wrapper">
                                               <input type="text" class="input-text" id="register_phone" name="register[phone]" value="{{$user->phone}}" />
                                            </span>
                                        </p>


                                        <p class="form-row form-row-first validate-required validate-email">
                                            <label for="register_email">{{constLang('email')}} <span class="required">*</span></label>
                                            <span class="woocommerce-input-wrapper">
                                                <input type="email" class="input-text" id="register_email" name="register[email]" value="{{$user->email}}" />
                                            </span>
                                        </p>

                                        <p class="form-row form-row-last validate-required">
                                            <label for="register_date">{{constLang('date_birth')}}<span class="required">*</span> </label>
                                            <span class="woocommerce-input-wrapper">
                                               <input type="text" class="input-text" id="register_date" name="register[date]" value="{{$user->date}}" />
                                            </span>
                                        </p>


                                        <fieldset>
                                            <legend>{{$content->profile->update_password}}</legend>
                                            <p class="form-row form-row-wide">
                                                <label for="reg_password_current">{{constLang('password_current')}} {{$content->profile->text_change_password}}</label>
                                                <input type="password" class="input-text" name="register[password_current]" id="account_password_current" />
                                            </p>
                                            <p id="validate_password" class="form-row form-row-wide">
                                                <label for="new_password">{{constLang('password_new')}} {{$content->profile->text_change_password}}</label>
                                                <input type="password" class="input-text" id="new_password" name="register[password]" />
                                            </p>
                                            <p id="validate_confirm" class="form-row form-row-wide">
                                                <label for="reg_password_confirm">{{constLang('password_confirm')}} <span class="required">*</span></label>
                                                <input type="password" class="input-text" id="reg_password_confirm" name="register[password_confirmation]" />
                                            </p>
                                        </fieldset>
                                        <div class="clear"></div>

                                        <p>
                                            <button type="submit" class="woocommerce-Button button" name="save_account_details" value="{{$content->profile->btn_submit}}">{{$content->profile->btn_submit}}</button>
                                        </p>
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
<script type='text/javascript'>
    var avd_config_profile = {!! json_encode([
        "profile_url" => route('account.profile'),
        "is_profile" => "1",
         "option_change_password" => "yes",
        "csrf_token" => csrf_token(),
        "error_json" => "Json Invalid",
        "i18n_profile_error" => $content->messages->change_error
    ]) !!}
</script>
<script type="text/javascript" src="{{asset('plugins/account/profile.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/jquery-maskedinput/jquery.maskedinput.min.js')}}"></script>
<script type='text/javascript'>
    jQuery( document ).ready(function($) {
        $("#register_phone").mask('(99)9999-9999?9');
        $("#register_cell").mask('(99)99999-9999');
        $("#register_date").mask('99/99/9999');
        $("#reg_document1_1").mask('99.999.999/9999-99');
        $("#reg_document1_2").mask('999.999.999-99');
    });
</script>
@endpush