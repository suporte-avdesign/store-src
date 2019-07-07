@extends('frontend.layouts.template-1')
@push('title')
<title>Login / Cadastro - {{config('app.name')}}</title>
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
                        &raquo; <span class="current">Minha Conta</span>
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
                                        @if (session('success'))
                                            <div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
                                                {{session('success')}}
                                            </div>
                                        @endif

                                        @if (session('error'))
                                            <div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
                                                {{session('error')}}
                                            </div>
                                        @endif

                                        <div class="u-column1 col-1 col-login">
                                            <h2>Login</h2>

                                            <form method="post" class="login woocommerce-form woocommerce-form-logi">
                                                <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide form-row-username">
                                                    <label for="username">Nome de usuário ou email&nbsp;<span class="required">*</span></label>
                                                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="log_username" id="log_username" autocomplete="username" value="" />
                                                </p>
                                                <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide form-row-password">
                                                    <label for="password">{{constLang('password')}}&nbsp;<span class="required">*</span></label>
                                                    <input class="woocommerce-Input woocommerce-Input--text input-text" type="log_password" name="log_password" id="log_password" autocomplete="current-password" />
                                                </p>
                                                <p class="form-row">
                                                    <input type="hidden" id="_woocommerce-login-nonce" name="woocommerce-login-nonce" value="ea245efaae" />
                                                    <input type="hidden" name="_wp_http_referer" value="{{route('login')}}" />
                                                    <button type="submit" class="button woocommerce-Button" name="log_login" value="Login">Login</button>
                                                </p>

                                                <div class="login-form-footer">
                                                    <a href="{{route('password.request')}}" class="woocommerce-LostPassword lost_password">{{constLang('password_lost')}}</a>
                                                    <label for="rememberme" class="remember-me-label inline">
                                                        <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" value="forever"/>
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

                                        <div class="u-column2 col-2 col-register">

                                            <h2>{{constLang('register')}}</h2>

                                            <form id="form_reg" method="post" action="{{route('register')}}" class="woocommerce-form woocommerce-form-register register">
                                                @csrf

                                                <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
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


                                                <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                                                    @foreach($types as $type)
                                                        @if($loop->first)
                                                            <input type="radio" class="input-radio" id="register_type_{{$type->id}}" name="register[type_id]" value="{{$type->id}}" checked /> <b>{{$type->name}}</b>
                                                            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                        @endif
                                                        @if($loop->last)
                                                            <input type="radio" class="input-radio" id="register_type_{{$type->id}}" name="register[type_id]" value="{{$type->id}}" /> <b>{{$type->name}}</b>
                                                        @endif
                                                    @endforeach
                                                </p>

                                                <div id="person_legal" style="display:block">
                                                    <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                                                        <label for="first_name_1">{{constLang('person_legal.first_name')}} &nbsp;<span class="required">*</span></label>
                                                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" id="first_name_1" name="register[first_name_1]" value="" />
                                                    </p>
                                                    <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                                                        <label for="last_name_1">{{constLang('person_legal.last_name')}} &nbsp;<span class="required">*</span></label>
                                                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" id="last_name_1" name="register[last_name_1]" value="" />
                                                    </p>
                                                    <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                                                        <label for="document1_1">{{constLang('person_legal.document1')}} &nbsp;<span class="required">*</span></label>
                                                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" id="reg_document1_1" name="register[document1_1]" value="" />
                                                    </p>
                                                    <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                                                        <label for="document2_1">{{constLang('person_legal.document2')}} &nbsp;<span class="required">*</span></label>
                                                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" id="document2_1" name="register[document2_1]" value="" />
                                                    </p>
                                                </div>

                                                <div id="person_physical" style="display: none">
                                                    <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                                                        <label for="first_name_2">{{constLang('person_physical.first_name')}} &nbsp;<span class="required">*</span></label>
                                                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" id="first_name_2" name="register[first_name_2]" value="" />
                                                    </p>
                                                    <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                                                        <label for="last_name_2">{{constLang('person_physical.last_name')}} &nbsp;<span class="required">*</span></label>
                                                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" id="last_name_2" name="register[last_name_2]" value="" />
                                                    </p>
                                                    <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                                                        <label for="document1_2">{{constLang('person_physical.document1')}} &nbsp;<span class="required">*</span></label>
                                                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" id="reg_document1_2" name="register[document1_2]" value="" />
                                                    </p>
                                                    <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                                                        <label for="document2_2">{{constLang('person_physical.document2')}} &nbsp;<span class="required">*</span></label>
                                                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" id="document2_2" name="register[document2_2]" value="" />
                                                    </p>
                                                </div>

                                                <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                                                    <label for="reg_date">{{constLang('date_birth')}} &nbsp;<span class="required">*</span></label>
                                                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" id="reg_date" name="register[date]" value="" />
                                                </p>
                                                <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                                                    <label for="reg_cell">{{constLang('cell')}}/Whatsapp <span class="required">*</span></label>
                                                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" id="reg_cell" name="register[cell]" value="" />
                                                </p>
                                                <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                                                    <label for="reg_phone">{{constLang('other')}} {{constLang('phone')}}</label>
                                                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" id="reg_phone" name="register[phone]" value="" />
                                                </p>
                                                <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                                                    <label for="reg_email">{{constLang('email')}} <span class="required">*</span></label>
                                                    <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" id="reg_email" name="register[email]" autocomplete="email" value="" />
                                                </p>
                                                <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                                                    <label for="reg_password">{{constLang('password')}}&nbsp;<span class="required">*</span></label>
                                                    <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" id="reg_password" name="register[password]" value=""/>
                                                </p>
                                                <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                                                    <label for="reg_password_confirm">{{constLang('password_confirm')}} &nbsp;<span class="required">*</span></label>
                                                    <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" id="reg_password_confirm" name="register[password_confirmation]" value="" />
                                                </p>

                                                <div class="login-form-footer">
                                                    <label for="newsletter" class="remember-me-label inline">
                                                        <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="register[newsletter]" type="checkbox" value="1" checked/>
                                                        <span>{{constLang('messages.newsletter.register')}}</span>
                                                    </label>
                                                </div>

                                                <div id="return-form_reg"></div>

                                                <p class="woocommerce-FormRow form-row">
                                                    <button type="button" id="form_reg-submit" class="woocommerce-Button button" onclick="postFormJson('form_reg')" value="{{constLang('send')}}">{{constLang('send')}}</button>
                                                </p>

                                            </form>
                                        </div>


                                        <div class="col-2 col-register-text">
                                            <span class="register-or">{{constLang('or')}}</span> <h2>{{constLang('registry')}}</h2>
                                            <div class="registration-info">
                                                <p style="text-align: center;">{{constLang('messages.register.new_register')}}</p>

                                                <div id="spoon-plugin-kncgbdglledmjmpnikebkagnchfdehbm-2" style="display: none;"></div>
                                            </div>
                                            <a href="#" class="btn btn-color-black basel-switch-to-register" data-login="Login" data-register="{{constLang('registry')}}">{{constLang('registry')}}</a>
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
<script type="text/javascript" src="{{asset('themes/js/functions.min.js')}}"></script>
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