@extends('frontend.layouts.template-1')
@push('title')
<title>{{constLang('login')}} / {{constLang('register')}} : {{$configKeyword->description}} {{config('app.name')}}</title>
    <meta name="description" content="{{$configKeyword->description}} , {{$configKeyword->genders}}">
    <meta name="keywords" content="{{$configKeyword->keywords}},{{$configKeyword->categories}},{{$configKeyword->genders}}">
@endpush
@push('styles')
<link rel="stylesheet" id="select2-css"  href="{{asset('plugins/select2/css/select2.css')}}" type="text/css" media="all" />
@endpush
@push('head')
<script type='text/javascript'>
    var _zxcvbnSettings = {!! json_encode(["src" => asset('includes/zxcvbn/js/zxcvbn-async.min.js')]) !!}
</script>
<script type="text/javascript" src="{{asset('includes/zxcvbn/js/zxcvbn-async.min.js')}}"></script>
@endpush
@push('body')
<body class="page-template-default page page-id-9 woocommerce-account woocommerce-page woocommerce-no-js wrapper-full-width global-cart-design-1 global-search-full-screen global-header-shop mobile-nav-from-left basel-light catalog-mode-off categories-accordion-on global-wishlist-enable basel-top-bar-on basel-ajax-shop-on basel-ajax-search-on enable-sticky-header header-full-width sticky-header-real offcanvas-sidebar-mobile offcanvas-sidebar-tablet wpb-js-composer js-comp-ver-5.6 vc_responsive">
@endpush
@section('content')
    <div class="main-page-wrapper">
        <div class="page-title page-title-default title-size-small title-design-centered color-scheme-light" style="">
            <div class="container">
                <header class="entry-header">
                    <div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
                        <a href="#" rel="v:url" property="v:title">Home</a>
                        &raquo; <span class="current">{{constLang('my_account')}}</span>
                    </div>
                </header>
            </div>
        </div>
        <!-- MAIN CONTENT AREA -->
        <div class="container">
            <div class="row">
                <div class="site-content col-sm-12" role="main">
                    <article id="post-9" class="post-9 page type-page status-publish hentry">
                        <div class="entry-content">
                            <div class="woocommerce">
                                <div class="woocommerce-notices-wrapper"></div>
                                <div class="basel-registration-page basel-register-tabs">
                                    <div class="u-columns col2-set" id="customer_login">

                                        <div class="woocommerce-notices-wrapper">
                                            @if (session('success'))
                                                <ul class="woocommerce-info" role="alert">
                                                    <li>{{session('success')}} </li>
                                                </ul>
                                            @endif
                                            @if (session('error'))
                                                <ul class="woocommerce-error" role="alert">
                                                    <li> {{session('error')}}</li>
                                                </ul>
                                            @endif
                                        </div>


                                        <div class="u-column1 col-1 col-login">

                                            <h2>Login</h2>

                                            <form id="form_login" method="post" action="{{route('login')}}" class="login woocommerce-form woocommerce-form-logi">
                                                @csrf
                                                <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                                                    <label for="page_email">{{constLang('email')}} <span class="required">*</span></label>
                                                    <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" id="page_email" name="page[email]" autocomplete="email" value="" />
                                                </p>
                                                <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide form-row-password">
                                                    <label for="page_password">{{constLang('password')}}&nbsp;<span class="required">*</span></label>
                                                    <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="page[password]" id="page_password" autocomplete="password" />
                                                </p>
                                                <div id="return-form_login"></div>

                                                <p class="form-row">
                                                    <input type="hidden" name="form" value="page">
                                                    <input type="hidden" name="page[redirect]" value="{{route('account')}}">
                                                    <button type="button" id="form_login-submit" class="button woocommerce-Button" onclick="postFormJson('form_login')">{{constLang('login')}}</button>
                                                </p>

                                                <div class="login-form-footer">
                                                    <a href="{{route('password.request')}}" class="woocommerce-LostPassword lost_password">{{constLang('password_lost')}}</a>
                                                    <label for="rememberme" class="remember-me-label inline">
                                                        <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="page[remember]" type="checkbox" value="1" {{ old('remember') ? 'checked' : '' }}/>
                                                        <span>{{constLang('rememberme')}}</span>
                                                    </label>
                                                </div>


                                                <!--
                                                    <span class="social-login-title">{{constLang('messages.login.social_login_title')}}</span>
                                                    <div class="basel-social-login">
                                                        <div class="social-login-btn">
                                                            <a href="{{route('social.auth')}}/?social_auth=facebook" class="btn login-fb-link">Facebook</a>
                                                        </div>
                                                        <div class="social-login-btn">
                                                            <a href="{{route('social.auth')}}/?social_auth=google" class="btn login-goo-link">Google</a>
                                                        </div>
                                                    </div>
                                                 -->

                                            </form>
                                        </div>



                                        <div class="col-2 col-register-text">
                                            <span class="register-or">{{constLang('or')}}</span> <h2>{{constLang('registry')}}</h2>
                                            <div class="registration-info">
                                                <p style="text-align: center;">{{constLang('messages.register.new_register')}}</p>

                                                <div id="spoon-plugin-kncgbdglledmjmpnikebkagnchfdehbm-2" style="display: none;"></div>
                                            </div>
                                            <a href="{{route('register')}}" class="btn btn-color-black" data-login="Login" data-register="{{constLang('registry')}}">{{constLang('registry')}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script type="text/javascript" src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script type="text/javascript">
    var pwsL10n = {!! json_encode([
        "unknown" => "Força da senha desconhecida",
        "short" => "Muito fraca",
        "bad" => "Fraca",
        "good" => "Media",
        "strong" => "Forte",
        "mismatch" => "Incompatibilidade"
    ]) !!}
</script>
<script type="text/javascript" src="{{asset('includes/zxcvbn/js/password-strength-meter.min.js')}}"></script>
<script type="text/javascript">
    var wc_password_strength_meter_params = {!! json_encode([
        "min_password_strength" => "3",
        "i18n_password_error" => "Por favor, insira uma senha mais forte.",
        "i18n_password_hint" => "Dica: A senha deve ter pelo menos doze caracteres. Para torná-lo mais forte, use letras maiúsculas e minúsculas, números e símbolos como ! \" ? $ % ^ & )."
    ]) !!}
</script>
<script type="text/javascript" src="{{asset('plugins/jquery-maskedinput/jquery.maskedinput.min.js')}}"></script>
<script type='text/javascript'>
    jQuery( document ).ready(function($) {
        $("#reg_phone").mask('(99)9999-9999?9');
        $("#reg_cell").mask('(99)99999-9999');
        $("#reg_date").mask('99/99/9999');
        $("#reg_document1_1").mask('99.999.999/9999-99');
        $("#reg_document1_2").mask('999.999.999-99');
    });
</script>
@endpush