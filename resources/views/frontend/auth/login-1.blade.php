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
                                        <div class="u-column1 col-1 col-login">
                                            <h2>Login</h2>

                                            <form method="post" class="login woocommerce-form woocommerce-form-logi">
                                                <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide form-row-username">
                                                    <label for="username">Nome de usuário ou email&nbsp;<span class="required">*</span></label>
                                                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="log_username" id="log_username" autocomplete="username" value="" />
                                                </p>
                                                <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide form-row-password">
                                                    <label for="password">Senha&nbsp;<span class="required">*</span></label>
                                                    <input class="woocommerce-Input woocommerce-Input--text input-text" type="log_password" name="log_password" id="log_password" autocomplete="current-password" />
                                                </p>
                                                <p class="form-row">
                                                    <input type="hidden" id="_woocommerce-login-nonce" name="woocommerce-login-nonce" value="ea245efaae" />
                                                    <input type="hidden" name="_wp_http_referer" value="{{route('login')}}" />
                                                    <button type="submit" class="button woocommerce-Button" name="log_login" value="Login">Login</button>
                                                </p>

                                                <div class="login-form-footer">
                                                    <a href="{{route('password.request')}}" class="woocommerce-LostPassword lost_password">Perdeu a senha?</a>
                                                    <label for="rememberme" class="remember-me-label inline">
                                                        <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" value="forever"/>
                                                        <span>Lembre de mim</span>
                                                    </label>
                                                </div>

                                                <span class="social-login-title">OU FAÇA O LOGIN COM</span>
                                                <div class="basel-social-login">
                                                    <div class="social-login-btn">
                                                        <a href="{{route('social.auth')}}/?social_auth=facebook" class="btn login-fb-link">Facebook</a>
                                                    </div>
                                                    <div class="social-login-btn">
                                                        <a href="{{route('social.auth')}}/?social_auth=google" class="btn login-goo-link">Google</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="u-column2 col-2 col-register">

                                            <h2>Cadastre-se</h2>

                                            <form id="form_reg" method="post" class="woocommerce-form woocommerce-form-register register">
                                                @csrf

                                                <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                                                    <input type="radio" class="input-radio" id="reg_email" name="user[type]" value="1" /> <b>Pessoa Física</b>
                                                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                    <input type="radio" class="input-radio" id="reg_email" name="user[type]" value="1" /> <b>Pessoa Jurídica</b>
                                                </p>


                                                <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                                                    <label for="reg_email">Email &nbsp;<span class="required">*</span></label>
                                                    <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" id="reg_email" name="reg[email]" autocomplete="email" value="" />
                                                </p>


                                                <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                                                    <label for="reg_password">Senha&nbsp;<span class="required">*</span></label>
                                                    <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" id="reg_password" name="reg[password]" autocomplete="new-password" />
                                                </p>

                                                <div class="woocommerce-privacy-policy-text">
                                                    <p>Os seus dados pessoais serão utilizados para apoiar a sua experiência em todo este site, para gerir o acesso à sua conta e para outros fins descritos na página.
                                                        <a href="#" class="woocommerce-privacy-policy-link" target="_blank">política de Privacidade</a>.
                                                    </p>
                                                </div>
                                                <p class="woocommerce-FormRow form-row">
                                                    <button type="button" class="woocommerce-Button button" onclick="registerUser()" value="Cadastre-se">Cadastre-se</button>
                                                </p>

                                            </form>
                                        </div>


                                        <div class="col-2 col-register-text">
                                            <span class="register-or">Ou</span> <h2>Cadastre-se</h2>
                                            <div class="registration-info">
                                                <p style="text-align: center;">O registro para este site permite que você acesse o status e o histórico do seu pedido. Basta preencher os campos abaixo e teremos uma nova conta configurada para você em breve. Só lhe pediremos informações necessárias para tornar o processo de compra mais rápido e fácil.</p>

                                                <div id="spoon-plugin-kncgbdglledmjmpnikebkagnchfdehbm-2" style="display: none;"></div>
                                            </div>
                                            <a href="#" class="btn btn-color-black basel-switch-to-register" data-login="Login" data-register="Cadastre-se">Cadastre-se</a>
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

    !(function($) {

         registerUser = function() {
            var $form = $("#form_reg");
            $.ajax({
                url: $form.attr('action'),
                data: $form.serialize(),
                method: 'POST',
                success: function (data) {

                },
                error: function (data) {
                    console.log('instagram ajax error');
                }
            });
        }

    })(jQuery);
</script>
<script type="text/javascript" src="{{asset('includes/zxcvbn/js/password-strength-meter.min.js')}}"></script>
<script type="text/javascript">
    var wc_password_strength_meter_params = {!! json_encode([
        "min_password_strength" => "3",
        "i18n_password_error" => "Por favor, insira uma senha mais forte.",
        "i18n_password_hint" => "Dica: A senha deve ter pelo menos doze caracteres. Para torná-lo mais forte, use letras maiúsculas e minúsculas, números e símbolos como ! \" ? $ % ^ & )."
    ]) !!}
</script>
@endpush