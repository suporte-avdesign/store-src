@extends('frontend.layouts.template-1')
@push('title')
<title>Termos e Condições {{config('app.name')}}</title>
@endpush
@push('body')
<body class="page-template-default page page-id-23320 woocommerce-no-js wrapper-full-width global-cart-design-1 global-search-full-screen global-header-shop mobile-nav-from-left basel-light catalog-mode-off categories-accordion-on global-wishlist-enable basel-top-bar-on basel-ajax-shop-on basel-ajax-search-on enable-sticky-header header-full-width sticky-header-real offcanvas-sidebar-mobile offcanvas-sidebar-tablet wpb-js-composer js-comp-ver-5.6 vc_responsive">
@endpush
@section('content')
    <div class="page-title page-title-default title-size-small title-design-centered color-scheme-light" style="">
        <div class="container">
            <header class="entry-header">
                <h1 class="entry-title">Termos e Condições</h1>
                <div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
                    <a href="{{route('home')}}" rel="v:url" property="v:title">Home</a> &raquo;
                    <span class="current">Termos e Condições</span>
                </div>
            </header>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="site-content col-sm-12" role="main">
                <article id="post-23320" class="post-23320 page type-page status-publish hentry">
                    <div class="entry-content">
                        <div class="vc_row wpb_row vc_row-fluid">
                            <div class="wpb_column vc_column_container vc_col-sm-6">
                                <div class="vc_column-inner">
                                    <div class="wpb_wrapper">
                                        <h2 style="font-size: 28px;text-align: left" class="vc_custom_heading">Contrato de Compra e Venda</h2>
                                        <div class="wpb_text_column wpb_content_element">
                                            <div class="wpb_wrapper">
                                                @foreach($contracts as $contract)
                                                    @if ($loop->first)
                                                        <p>{!! nl2br($contract->description) !!}</p>
                                                    @else
                                                        <p><strong>{{$contract->title}}</strong></p>
                                                        <p>{!! nl2br($contract->description) !!}</p>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wpb_column vc_column_container vc_col-sm-6">
                                <div class="vc_column-inner">
                                    <div class="wpb_wrapper">
                                        <h2 style="font-size: 28px;text-align: left" class="vc_custom_heading">Termos e Condições</h2>
                                        <div class="wpb_text_column wpb_content_element vc_custom_1464286424226">
                                            <div class="wpb_wrapper">
                                                @foreach($terms as $term)
                                                    <p><strong>{{$term->title}}</strong></p>
                                                    <p>{!! nl2br($term->description) !!}</p>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="basel-button-wrapper text-center">
                                            <a href="{{route('deliveries')}}" class="btn btn-color-primary btn-style-link btn-size-default">Mais Sobre Entregas</a>
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