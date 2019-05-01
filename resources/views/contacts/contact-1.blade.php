@extends('layouts.template-1')
@push('title')
<title> Fale Conosco - {{config('app.name')}}</title>
@endpush
@push('body')
<body class="page-template-default page page-id-456 woocommerce-no-js wrapper-full-width global-cart-design-1 global-search-full-screen global-header-shop mobile-nav-from-left basel-light catalog-mode-off categories-accordion-on global-wishlist-enable basel-top-bar-on basel-ajax-shop-on basel-ajax-search-on enable-sticky-header header-full-width sticky-header-real offcanvas-sidebar-mobile offcanvas-sidebar-tablet wpb-js-composer js-comp-ver-5.6 vc_responsive">
@endpush
@section('content')
    <div class="container">
        <div class="row">
            <div class="site-content col-sm-12" role="main">
                <article id="post-456" class="post-456 page type-page status-publish hentry">
                    <div class="entry-content">
                        <div class="vc_row-full-width vc_clearfix"></div>
                        <div data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row wpb_row vc_row-fluid vc_custom_1451151413064 vc_row-has-fill">
                            <div class="wpb_column vc_column_container vc_col-sm-6">
                                <div class="vc_column-inner vc_custom_1438787474201">
                                    <div class="wpb_wrapper">
                                        <div class="title-wrapper  basel-title-color-default basel-title-style-bordered basel-title-size-default text-left vc_custom_1449331484859">
                                            <div class="liner-continer"> <span class="left-line"></span>
                                                <h4 class="title"><strong>FALE CONOSCO POR E-MAIL</strong>
                                                    <span class="title-separator"><span></span></span>
                                                </h4>
                                                <span class="right-line"></span>
                                            </div>
                                            <div class="wpb_text_column wpb_content_element vc_custom_1449332109988">
                                                <div class="wpb_wrapper">
                                                    <p>Você pode enviar um e-mail pra gente sobre o assunto de seu interesse</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div role="form" class="wpcf7" id="wpcf7-f4-p456-o1" lang="en-US" dir="ltr">
                                            <div class="screen-reader-response"></div>
                                            <form action="{{route('contact.store')}}" method="post" class="wpcf7-form" novalidate="novalidate">
                                                @csrf
                                                <div style="display: none;">
                                                    <input type="hidden" name="_wpcf7" value="4" />
                                                    <input type="hidden" name="_wpcf7_version" value="5.0.5" />
                                                    <input type="hidden" name="_wpcf7_locale" value="en_US" />
                                                    <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f4-p456-o1" />
                                                    <input type="hidden" name="_wpcf7_container_post" value="456" />
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <p>
                                                            <label>Seu nome (obrigatório)</label>
                                                            <span class="wpcf7-form-control-wrap your-name">
                                                                <input type="text" name="your-name" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" />
                                                            </span>
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>
                                                            <label>Seu email (obrigatório)</label>
                                                            <span class="wpcf7-form-control-wrap your-email">
                                                                <input type="email" name="your-email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false" />
                                                            </span>
                                                        </p>
                                                    </div>
                                                </div>
                                                <p>
                                                    <label>Assunto</label>
                                                    <span class="wpcf7-form-control-wrap your-subject">
                                                        <input type="text" name="your-subject" value="" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" />
                                                    </span>
                                                </p>
                                                <p>
                                                    <label>Mensagem</label> <span class="wpcf7-form-control-wrap your-message">
                                                        <textarea name="your-message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false"></textarea>
                                                    </span>
                                                </p>
                                                <p>
                                                    <input type="submit" value="ENVIAR MENSAGEM" class="wpcf7-form-control wpcf7-submit btn btn-color-primary" />
                                                </p>
                                                <div class="wpcf7-response-output wpcf7-display-none"></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wpb_column vc_column_container vc_col-sm-6">
                                <div class="vc_column-inner vc_custom_1438787483391">
                                    <div class="wpb_wrapper">
                                        <div class="title-wrapper  basel-title-color-default basel-title-style-bordered basel-title-size-default text-left vc_custom_1449332119048">
                                            <div class="liner-continer"> <span class="left-line"></span>
                                                <h4 class="title"><strong>CONTATOS</strong>
                                                    <span class="title-separator"><span></span></span>
                                                </h4> <span class="right-line"></span>
                                            </div>
                                        </div>
                                        <div class="vc_row wpb_row vc_inner vc_row-fluid vc_custom_1451151064538">
                                            <div class="wpb_column vc_column_container vc_col-sm-6">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element">
                                                            <div class="wpb_wrapper">
                                                                <p></p>
                                                                <p>
                                                                    <span class="vc_icon_element-icon icon-phone icons" style="float: left; font-size: 38px;"></span>
                                                                    {{env('PHONE')}}<br> &nbsp;&nbsp;WhatsApp: (11) 98586-6847
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="wpb_text_column wpb_content_element">
                                                            <div class="wpb_wrapper">
                                                                <p></p>
                                                                <p>
                                                                    <span class="vc_icon_element-icon icon-location-pin icons" style="float: left; font-size: 38px;"> </span>
                                                                    Rua Cavalheiro, 179 <br> Brás - São Paulo
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-6">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element">
                                                            <div class="wpb_wrapper">
                                                                <p>
                                                                    <span class="vc_icon_element-icon icon-clock icons" style="float: left; font-size: 38px;"> </span>
                                                                    &nbsp;Segunda a Sexta Feira<br> das 07:00hs as 17:30hs<br> &nbsp;Sábado das 07:30 as 12:00hs
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="wpb_text_column wpb_content_element">
                                                            <div class="wpb_wrapper">
                                                                <p>
                                                                    <span class="vc_icon_element-icon icon-envelope icons" style="float: left; font-size: 28px;"> </span>
                                                                    &nbsp; contato@saoroquecalcados.com.br
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- include('social.social-2') -->

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