@extends('frontend.layouts.template-1')
@push('title')
<title> {{$content->title}} - {{config('app.name')}}</title>
    <meta name="description" content="{{$configKeyword->description}} , {{$configKeyword->genders}}">
    <meta name="keywords" content="{{$configKeyword->keywords}},{{$configKeyword->categories}},{{$configKeyword->genders}}">
@push('styles')
<link rel="stylesheet" id="select2-css"  href="{{asset('plugins/select2/css/select2.css')}}" type="text/css" media="all" />
<link rel="stylesheet" id="js_composer_front" href="{{asset('plugins/js_composer/css/js_composer_tta.min.css')}}" type="text/css" media="all" />
<style>
    .vc_custom_1451149853822 {
        margin-top: 30px!important;
        margin-bottom: 30px!important
    }
    .vc_custom_1434813322976 {
        padding-right: 50px!important
    }

    .vc_custom_1450202410260 {
        margin-top: 30px!important;
        border-top-width: 5px!important;
        border-right-width: 5px!important;
        border-bottom-width: 5px!important;
        border-left-width: 5px!important;
        padding-top: 20px!important;
        padding-right: 20px!important;
        padding-bottom: 10px!important;
        padding-left: 20px!important;
        border-left-color: #f4f4f4!important;
        border-left-style: solid!important;
        border-right-color: #f4f4f4!important;
        border-right-style: solid!important;
        border-top-color: #f4f4f4!important;
        border-top-style: solid!important;
        border-bottom-color: #f4f4f4!important;
        border-bottom-style: solid!important
    }
</style>
@endpush
@endpush
@push('body')
<body class="page-template-default page page-id-456 woocommerce-no-js wrapper-full-width global-cart-design-1 global-search-full-screen global-header-shop mobile-nav-from-left basel-light catalog-mode-off categories-accordion-on global-wishlist-enable basel-top-bar-on basel-ajax-shop-on basel-ajax-search-on enable-sticky-header header-full-width sticky-header-real offcanvas-sidebar-mobile offcanvas-sidebar-tablet wpb-js-composer js-comp-ver-5.6 vc_responsive">
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
                    <article id="post-314" class="post-314 page type-page status-publish hentry">
                        <div class="entry-content">
                            <div class="vc_row wpb_row vc_row-fluid vc_custom_1451149853822">
                                <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-6 vc_col-md-6">
                                    <div class="vc_column-inner vc_custom_1434813322976">
                                        <div class="wpb_wrapper">
                                            <div class="vc_tta-container" data-vc-action="collapse">
                                                <div class="vc_general vc_tta vc_tta-tabs vc_tta-color-white vc_tta-style-classic vc_tta-shape-rounded vc_tta-spacing-1 vc_tta-o-no-fill vc_tta-tabs-position-top vc_tta-controls-align-left">
                                                    <div class="vc_tta-tabs-container">
                                                        <ul class="vc_tta-tabs-list">
                                                            <li class="vc_tta-tab vc_active" data-vc-tab>
                                                                <a href="#faqs" data-vc-tabs data-vc-container=".vc_tta">
                                                                    <span class="vc_tta-title-text">Perguntas Frequentes</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="vc_tta-panels-container">
                                                        <div class="vc_tta-panels">
                                                            <!-- SOBRE COMPRAS -->
                                                            <div class="vc_tta-panel vc_active" id="sobre-compras" data-vc-content=".vc_tta-panel-body">
                                                                <div class="vc_tta-panel-heading">
                                                                    <h4 class="vc_tta-panel-title">
                                                                        <a href="#faqs" data-vc-accordion data-vc-container=".vc_tta-container">
                                                                            <span class="vc_tta-title-text">Perguntas Frequentes</span>
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                                <div class="vc_tta-panel-body">
                                                                    @foreach($faqs as $faq)
                                                                        <div id="{{$faq->id}}" class="vc_toggle vc_toggle_arrow vc_toggle_color_black vc_toggle_size_md @if ($loop->first)vc_toggle_active @endif">
                                                                            <div class="vc_toggle_title">
                                                                                <h4><strong>{{$faq->question}}</strong></h4><i class="vc_toggle_icon"></i>
                                                                            </div>
                                                                            <div class="vc_toggle_content">
                                                                                <p>{{$faq->response}}</p>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-6 vc_col-md-6">
                                    <div class="vc_column-inner vc_custom_1496927688909">
                                        <div class="wpb_wrapper">
                                            <div id="wd-5d4998148dfc6" class="title-wrapper  woodmart-title-color-default woodmart-title-style-default woodmart-title-width-100 text-left woodmart-title-size-default ">
                                                <div class="title-subtitle  font-default subtitle-style-default woodmart-font-weight-"><strong>{{strtoupper($content->title)}}</strong></div>
                                                <div class="liner-continer"> <span class="left-line"></span>
                                                    <h4 class="woodmart-title-container title  woodmart-font-weight-">{{strtoupper($content->sub_title)}}</h4> <span class="right-line"></span></div>
                                            </div>

                                            <form id="form-contact" name="contact" method="post" class="contact woocommerce-checkout" action="{{route('contact')}}" novalidate="novalidate">
                                                <div style="display: none;">
                                                    @csrf
                                                </div>
                                                <div class="row" style="margin-bottom: 20px;">
                                                    <div class="form-row validate-required col-md-6">
                                                        <label>{{constLang('subject')}}</label>
                                                        <select name="contact[subject_id]" id="subject-contact" class="select">
                                                            @foreach($configSubject as $subject)
                                                                <option value="{{$subject->id}}">{{$subject->label}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-row validate-required col-md-6">
                                                        <label>{{constLang('name')}} <span class="required">*</span></label>
                                                            <input type="text" name="contact[name]" id="contact_name" size="40" class="input-text" />
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="row" style="margin-bottom: 20px;">
                                                    <div class="form-row validate-required validate-email col-md-6">
                                                        <label>{{constLang('email')}}</label>
                                                        <input type="email" name="contact[email]" id="contact_email" value="" size="40" class="input-text" />
                                                    </div>
                                                    <div class="form-row validate-required col-md-6">
                                                        <label>{{constLang('phone')}} <span class="required">*</span></label>
                                                        <input type="text" name="contact[phone]" id="contact_phone" value="" size="40" class="input-text" />
                                                    </div>
                                                </div>

                                                <div class="row" style="margin-bottom: 20px;">
                                                    <div class="form-row validate-required col-md-12">
                                                        <label>{{constLang('message')}}</label>
                                                        <textarea name="contact[message]" id="contact_message" cols="40" rows="10" class="textarea"></textarea>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="{{$content->btn_send}}" data-value="{{$content->btn_send}}">{{$content->btn_send}}</button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="vc_row-full-width vc_clearfix"></div>
                        </div>
                    </article>
                </div>
            </div>
        </div>

@endsection
@push('scripts')
<script type="text/javascript" src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/jquery-maskedinput/jquery.maskedinput.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/contacts/contact.min.js')}}"></script>
<script type='text/javascript'>
    var avd_config_contact = {!! json_encode($content) !!};
</script>
<script type='text/javascript'>
    jQuery( document ).ready(function($) {
        $("#contact_phone").mask('(99)9999-9999?9');
    });

</script>
@endpush

