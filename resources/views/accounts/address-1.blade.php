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

                                    <p>Os seguintes endereços serão usados ​​na página de checkout por padrão.</p>

                                    <form method="post" action="{{route('address.update')}}">
                                        @csrf
                                        @method('PUT')
                                        <div class="woocommerce-billing-fields__field-wrapper">
                                            <p class="form-row form-row-wide address-field update_totals_on_change validate-required" id="billing_country_field" data-priority="40">
                                                <label for="billing_country" class="">País <abbr class="required" title="required">*</abbr></label>
                                                <span class="woocommerce-input-wrapper">
                                                    <select name="billing_country" id="billing_country" class="country_to_state country_select " autocomplete="country">
                                                        <option value="BR" selected>Brasil</option>
                                                    </select>
                                                    <noscript>
                                                        <button type="submit" name="woocommerce_checkout_update_totals" value="Atualizar País">Atualizar País</button>
                                                    </noscript>
                                                </span>
                                            </p>
                                            <p class="form-row form-row-wide address-field validate-required" id="billing_address_1_field" data-priority="50">
                                                <label for="billing_address_1" class="">Endereço <abbr class="required" title="required">*</abbr></label>
                                                <span class="woocommerce-input-wrapper">
                                                    <input type="text" class="input-text " name="billing_address_1" id="billing_address_1" placeholder="Número da casa e nome da rua"  value="" autocomplete="address-line1" />
                                                </span>
                                            </p>
                                            <p class="form-row form-row-wide address-field" id="billing_address_2_field" data-priority="60">
                                                <label for="billing_address_2" class="screen-reader-text">Complemento <span class="optional">(opcional)</span></label>
                                                <span class="woocommerce-input-wrapper">
                                                    <input type="text" class="input-text " name="billing_address_2" id="billing_address_2" placeholder="Complemento (opcional)"  value="" autocomplete="address-line2" />
                                                </span>
                                            </p>
                                            <p class="form-row form-row-wide address-field validate-required" id="billing_city_field" data-priority="70">
                                                <label for="billing_city" class="">Cidade <abbr class="required" title="required">*</abbr></label>
                                                <span class="woocommerce-input-wrapper">
                                                    <input type="text" class="input-text" name="billing_city" id="billing_city" placeholder=""  value="" autocomplete="address-level2" />
                                                </span>
                                            </p>
                                            <p class="form-row form-row-wide address-field validate-required validate-state" id="billing_state_field" data-priority="80">
                                                <label for="billing_state" class="">Estado <abbr class="required" title="required">*</abbr></label>
                                                <span class="woocommerce-input-wrapper">
                                                    <select name="billing_state" id="billing_state" class="state_select " autocomplete="address-level1" data-placeholder="">
                                                        <option value="">Selecione o Estado</option>
                                                        <option value="AC">Acre</option>
                                                        <option value="AL">Alagoas</option>
                                                        <option value="AP">Amapá</option>
                                                        <option value="AM">Amazonas</option>
                                                        <option value="BA">Bahia</option>
                                                        <option value="CE">Ceará</option>
                                                        <option value="DF">Distrito Federal</option>
                                                        <option value="ES">Espírito Santo</option>
                                                        <option value="GO">Goiás</option>
                                                        <option value="MA">Maranhão</option>
                                                        <option value="MT">Mato Grosso</option>
                                                        <option value="MS">Mato Grosso do Sul</option>
                                                        <option value="MG">Minas Gerais</option>
                                                        <option value="PA">Pará</option>
                                                        <option value="PB">Paraíba</option>
                                                        <option value="PR">Paraná</option>
                                                        <option value="PE">Pernambuco</option>
                                                        <option value="PI">Piauí</option>
                                                        <option value="RJ">Rio de Janeiro</option>
                                                        <option value="RN">Rio Grande do Norte</option>
                                                        <option value="RS">Rio Grande do Sul</option>
                                                        <option value="RO">Rondônia</option>
                                                        <option value="RR">Roraima</option>
                                                        <option value="SC">Santa Catarina</option>
                                                        <option value="SP">São Paulo</option>
                                                        <option value="SE">Sergipe</option>
                                                        <option value="TO">Tocantins</option>
                                                    </select>
                                                </span>
                                            </p>
                                            <p class="form-row form-row-wide address-field validate-required validate-postcode" id="billing_postcode_field" data-priority="90">
                                                <label for="billing_postcode" class="">CEP <abbr class="required" title="required">*</abbr></label>
                                                <span class="woocommerce-input-wrapper">
                                                    <input type="text" class="input-text " name="billing_postcode" id="billing_postcode" placeholder=""  value="" autocomplete="postal-code" />
                                                </span>
                                            </p>

                                            <p>
                                                <button type="submit" class="button" name="save_address" value="Save address">Savar Endereço</button>
                                                <input type="hidden" id="woocommerce-edit-address-nonce" name="woocommerce-edit-address-nonce" value="1eebd43f67">
                                                <input type="hidden" name="_wp_http_referer" value="/basel/my-account/edit-address/shipping/">
                                                <input type="hidden" name="action" value="edit_address">
                                            </p>

                                        </div>

                                        <div class="woocommerce-notices-wrapper">
                                            <div class="woocommerce-message" role="alert">
                                                Endereço alterado com sucesso.
                                            </div>
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