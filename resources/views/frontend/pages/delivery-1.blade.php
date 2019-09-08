@extends('frontend.layouts.template-1')
@push('title')
<title>Sobre Entregas - {{config('app.name')}}</title>
@endpush
@push('styles')
<link rel="stylesheet" id="pages" href="{{asset('themes/css/pages.min.css')}}" type="text/css" media="all" />
@endpush
@push('body')
<body class="page-template-default page page-id-29116 woocommerce-no-js wrapper-full-width global-cart-design-1 global-search-full-screen global-header-shop mobile-nav-from-left basel-light catalog-mode-off categories-accordion-on global-wishlist-enable basel-top-bar-on basel-ajax-shop-on basel-ajax-search-on enable-sticky-header header-full-width sticky-header-real offcanvas-sidebar-mobile offcanvas-sidebar-tablet wpb-js-composer js-comp-ver-5.6 vc_responsive">
@endpush
@section('content')
    <div class="page-title page-title-default title-size-small title-design-centered color-scheme-light" style="">
        <div class="container">
            <header class="entry-header">
                <h1 class="entry-title">Sobre Entregas</h1>
                <div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
                    <a href="{{route('home')}}" rel="v:url" property="v:title">Home</a> &raquo;
                    <span class="current">Sobre Entregas</span>
                </div>
            </header>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="site-content col-sm-12" role="main">
                <article id="post-29116" class="post-29116 page type-page status-publish hentry">
                    <div class="entry-content">
                        <div class="vc_row-full-width vc_clearfix"></div>

                        @foreach($deliveries as $delivery)
                            @if ($loop->first)
                                <div class="vc_row wpb_row vc_row-fluid">
                                    <div class="wpb_column vc_column_container vc_col-sm-12">
                                        <div class="vc_column-inner vc_custom_1544619451936">
                                            <div class="wpb_wrapper">
                                                <div id="basel-5c10fc87b36fc" class="basel-text-block-wrapper  basel-text-block-size-custom basel-text-block-width-100 color-scheme- text-center vc_custom_1544617103511">
                                                    <div class="basel-text-block  font-primary basel-font-weight-600">
                                                        {{$delivery->title}}
                                                    </div>
                                                </div>
                                            </div>
                                            <p>{!! nl2br($delivery->description) !!}</p>
                                        </div>
                                    </div>
                                </div>
                            @else

                                <div class="vc_row wpb_row vc_row-fluid vc_custom_1544620472512 vc_row-has-fill">
                                    <div class="wpb_column vc_column_container vc_col-sm-12">
                                        <div class="vc_column-inner vc_custom_1544619171513">
                                            <div class="wpb_wrapper">
                                                <div id="basel-5c10e9c17b07b" class="basel-text-block-wrapper  basel-text-block-size-custom basel-text-block-width-100 color-scheme- text-left vc_custom_1544612294327">
                                                    <div class="basel-text-block  font-primary basel-font-weight-600">
                                                        <span class="color-primary">{{$loop->index}}.</span> {{$delivery->title}}
                                                    </div>
                                                </div>
                                                <div class="wpb_text_column wpb_content_element vc_custom_1544607363238">
                                                    <div class="wpb_wrapper">
                                                        <p>{!! nl2br($delivery->description) !!}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endif
                        @endforeach

                    </div>
                </article>
            </div>
        </div>
    </div>
@endsection