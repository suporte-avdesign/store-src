@extends('frontend.layouts.template-1')
@push('title')
<title>{{constLang('my_account')}} {{$configKeyword->description}} {{config('app.name')}}</title>
    <meta name="description" content="{{$configKeyword->description}} , {{$configKeyword->genders}}">
    <meta name="keywords" content="{{$configKeyword->keywords}},{{$configKeyword->categories}},{{$configKeyword->genders}}">
@endpush
@push('styles')
<link rel="stylesheet" id="select2-css"  href="{{asset('plugins/select2/css/select2.css')}}" type="text/css" media="all" />
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
                    <span class="current">{{constLang('my_account')}}</span>
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

                                <!-- .basel-my-account-sidebar -->
                                <div class="woocommerce-MyAccount-content">

                                    <p>Olá
                                        <strong>@if($user->type_id == 1) {{$user->last_name}} @else {{$user->first_name}} @endif</strong>
                                        (não é  <strong>@if($user->type_id == 1) {{$user->last_name}} @else {{$user->first_name}} @endif</strong>?
                                        <a href="{{route('logout')}}">Sair da conta</a>)
                                    </p>

                                    <p>No painel da sua conta, você pode visualizar seus
                                        <a href="#">pedidos recentes</a>
                                            , gerenciar seus
                                        <a href="#">
                                            endereços de entrega
                                        </a>
                                        , e
                                        <a href="#">
                                            editar sua senha
                                        </a>
                                        .
                                    </p>

                                    <div class="basel-my-account-links">
                                        <div class="dashboard-link">
                                            <a href="{{route('account')}}">Painel</a>
                                        </div>
                                        <div class="orders-link">
                                            <a href="#">Pedidos</a>
                                        </div>
                                        <div class="downloads-link">
                                            <a href="#">Downloads</a>
                                        </div>
                                        <div class="edit-address-link">
                                            <a href="#">Endereço</a>
                                        </div>
                                        <div class="edit-account-link">
                                            <a href="#">Detalhes da conta</a>
                                        </div>
                                        <div class="wishlist-link">
                                            <a href="#">Lista de Desejo</a></li>
                                        </div>
                                        <div class="logout-link">
                                            <a href="javascript:logoutUser('{{route('logout')}}', '{{ csrf_token() }}');">Sair</a>
                                        </div>
                                    </div>
                                    <div class="woocommerce-notices-wrapper">
                                        <div class="woocommerce-message" role="alert">
                                            Você agora está logado como
                                            <strong>@if($user->type_id == 1) {{$user->last_name}} @else {{$user->first_name}} @endif</strong>
                                        </div>
                                    </div>
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
<script type="text/javascript" src="{{asset('themes/js/functions.min.js')}}"></script>
@endpush