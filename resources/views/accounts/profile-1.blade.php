@extends('layouts.template-1')
@push('title')
<title> Seu Carrinho - {{config('app.name')}}</title>
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
                <h1 class="entry-title">Minha Conta</h1>
                <div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
                    <a href="{{route('home')}}" rel="v:url" property="v:title">Home</a> &raquo;
                    <span class="current">Minha Conta</span>
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

                                @include('accounts.sidebar.sidebar-1')

                                <div class="woocommerce-MyAccount-content">

                                    <form class="woocommerce-EditAccountForm edit-account" action="" method="post">
                                        @csrf
                                        @method('PUT')

                                        <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
                                            <label for="account_first_name">Nome <span class="required">*</span></label>
                                            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_first_name" id="account_first_name" autocomplete="given-name" value="Nome" />
                                        </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
                                            <label for="account_last_name">CPF <span class="required">*</span></label>
                                            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name" id="account_last_name" autocomplete="family-name" value="CPF" />
                                        </p>
                                        <div class="clear"></div>

                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label for="account_display_name">Display name&nbsp;<span class="required">*</span></label>
                                            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_display_name" id="account_display_name" value="nome_cliente" />
                                            <span><em>Será assim que o seu nome será exibido na seção da conta e nos comentários</em></span>
                                        </p>
                                        <div class="clear"></div>

                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label for="account_email">Email&nbsp;<span class="required">*</span></label>
                                            <input type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email" id="account_email" autocomplete="email" value="teste@teste.com" />
                                        </p>

                                        <fieldset>
                                            <legend>Alterar Senga</legend>

                                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                <label for="password_current">Senha Atual (deixe em branco para deixar inalterado)</label>
                                                <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_current" id="password_current" autocomplete="off" />
                                            </p>
                                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                <label for="password_1">Nova Senha (deixe em branco para deixar inalterado)</label>
                                                <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_1" id="password_1" autocomplete="off" />
                                            </p>
                                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                <label for="password_2">Confirme a nova senha</label>
                                                <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_2" id="password_2" autocomplete="off" />
                                            </p>
                                        </fieldset>
                                        <div class="clear"></div>

                                        <p>
                                            <input type="hidden" id="save-account-details-nonce" name="save-account-details-nonce" value="1473860dde" />
                                            <input type="hidden" name="_wp_http_referer" value="/basel/my-account/edit-account/" />
                                            <button type="submit" class="woocommerce-Button button" name="save_account_details" value="Save changes">Salvar Alteração</button>
                                            <input type="hidden" name="action" value="save_account_details" />
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