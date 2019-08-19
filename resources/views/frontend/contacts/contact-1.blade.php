@extends('frontend.layouts.template-1')
@push('title')
<title> Fale Conosco - {{config('app.name')}}</title>
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
                <h1 class="entry-title">{{constLang('messages.checkouts.title')}}</h1>
                <div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
                    <a href="{{route('home')}}" rel="v:url" property="v:title">Home</a> &raquo;
                    <span class="current">{{constLang('messages.checkouts.title')}}</span>
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
                                                                <a href="#sobre-compras" data-vc-tabs data-vc-container=".vc_tta">
                                                                    <span class="vc_tta-title-text">Sobre Compras</span>
                                                                </a>
                                                            </li>
                                                            <li class="vc_tta-tab" data-vc-tab>
                                                                <a href="#termos-condicoes" data-vc-tabs data-vc-container=".vc_tta">
                                                                    <span class="vc_tta-title-text">Termos</span>
                                                                </a>
                                                            </li>
                                                            <li class="vc_tta-tab" data-vc-tab>
                                                                <a href="#politica-de-privacidade" data-vc-tabs data-vc-container=".vc_tta">
                                                                    <span class="vc_tta-title-text">Privacidade</span>
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
                                                                        <a href="#sobre-compras" data-vc-accordion data-vc-container=".vc_tta-container">
                                                                            <span class="vc_tta-title-text">Sobre Compras</span>
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                                <div class="vc_tta-panel-body">
                                                                    <div id="1234" class="vc_toggle vc_toggle_arrow vc_toggle_color_grey vc_toggle_size_md vc_toggle_active">
                                                                        <div class="vc_toggle_title">
                                                                            <h4><strong>Pergunta sobre compra 1?</strong></h4><i class="vc_toggle_icon"></i>
                                                                        </div>
                                                                        <div class="vc_toggle_content">
                                                                            <p>Resposta sobre compra 1</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="vc_toggle vc_toggle_arrow vc_toggle_color_grey vc_toggle_size_md">
                                                                        <div class="vc_toggle_title">
                                                                            <h4><strong>Pergunta sobre compra 2?</strong></h4><i class="vc_toggle_icon"></i>
                                                                        </div>
                                                                        <div class="vc_toggle_content">
                                                                            <p>Resposta sobre compra 2</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="vc_toggle vc_toggle_arrow vc_toggle_color_grey vc_toggle_size_md">
                                                                        <div class="vc_toggle_title">
                                                                            <h4><strong>Pergunta sobre compra 2?</strong></h4><i class="vc_toggle_icon"></i>
                                                                        </div>
                                                                        <div class="vc_toggle_content">
                                                                            <p>Resposta sobre compra 3</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- TERMOS & CONDIÇÕES -->
                                                            <div class="vc_tta-panel" id="termos-condicoes" data-vc-content=".vc_tta-panel-body">
                                                                <div class="vc_tta-panel-heading">
                                                                    <h4 class="vc_tta-panel-title">
                                                                        <a href="#termos-condicoes" data-vc-accordion data-vc-container=".vc_tta-container">
                                                                            <span class="vc_tta-title-text">Termos & Condições</span>
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                                <div id="12345" class="vc_toggle vc_toggle_arrow vc_toggle_color_grey vc_toggle_size_md vc_toggle_active">
                                                                    <div class="vc_toggle_title">
                                                                        <h4><strong>Titulo 1?</strong></h4><i class="vc_toggle_icon"></i>
                                                                    </div>
                                                                    <div class="vc_toggle_content">
                                                                        <p>Conteudo titulo 1</p>
                                                                    </div>
                                                                </div>
                                                                <div class="vc_toggle vc_toggle_arrow vc_toggle_color_grey vc_toggle_size_md">
                                                                    <div class="vc_toggle_title">
                                                                        <h4><strong>Titulo 2?</strong></h4><i class="vc_toggle_icon"></i>
                                                                    </div>
                                                                    <div class="vc_toggle_content">
                                                                        <p>Conteudo titulo 2</p>
                                                                    </div>
                                                                </div>
                                                                <div class="vc_toggle vc_toggle_arrow vc_toggle_color_grey vc_toggle_size_md">
                                                                    <div class="vc_toggle_title">
                                                                        <h4><strong>Titulo 3?</strong></h4><i class="vc_toggle_icon"></i>
                                                                    </div>
                                                                    <div class="vc_toggle_content">
                                                                        <p>Conteudo titulo 3</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- POLÍTICA DE PRIVACIDADE -->
                                                            <div class="vc_tta-panel" id="politica-de-privacidade" data-vc-content=".vc_tta-panel-body">
                                                                <div class="vc_tta-panel-heading">
                                                                    <h4 class="vc_tta-panel-title"><a href="#politica-de-privacidade" data-vc-accordion data-vc-container=".vc_tta-container"><span class="vc_tta-title-text">Privacy Policy</span></a></h4></div>
                                                                <div class="vc_tta-panel-body">
                                                                    <div id="14348" class="vc_toggle vc_toggle_arrow vc_toggle_color_grey vc_toggle_size_md">
                                                                        <div class="vc_toggle_title">
                                                                            <h4><strong>Titulo 1?</strong></h4><i class="vc_toggle_icon"></i>
                                                                        </div>
                                                                        <div class="vc_toggle_content">
                                                                            <p>Conteudo titulo 1</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="vc_toggle vc_toggle_arrow vc_toggle_color_grey vc_toggle_size_md">
                                                                        <div class="vc_toggle_title">
                                                                            <h4><strong>Titulo 1?</strong></h4><i class="vc_toggle_icon"></i>
                                                                        </div>
                                                                        <div class="vc_toggle_content">
                                                                            <p>Conteudo titulo 1</p>
                                                                        </div>
                                                                    </div>
                                                                    <div id="15348" class="vc_toggle vc_toggle_arrow vc_toggle_color_grey vc_toggle_size_md vc_toggle_active">
                                                                        <div class="vc_toggle_title">
                                                                            <h4><strong>Titulo 1?</strong></h4><i class="vc_toggle_icon"></i>
                                                                        </div>
                                                                        <div class="vc_toggle_content">
                                                                            <p>Conteudo titulo 1</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="vc_toggle vc_toggle_arrow vc_toggle_color_grey vc_toggle_size_md">
                                                                        <div class="vc_toggle_title">
                                                                            <h4><strong>Titulo 1?</strong></h4><i class="vc_toggle_icon"></i>
                                                                        </div>
                                                                        <div class="vc_toggle_content">
                                                                            <p>Conteudo titulo 1</p>
                                                                        </div>
                                                                    </div>
                                                                    <div id="271806" class="vc_toggle vc_toggle_arrow vc_toggle_color_grey vc_toggle_size_md">
                                                                        <div class="vc_toggle_title">
                                                                            <h4><strong>Titulo 1?</strong></h4><i class="vc_toggle_icon"></i>
                                                                        </div>
                                                                        <div class="vc_toggle_content">
                                                                            <p>Conteudo titulo 1</p>
                                                                        </div>
                                                                    </div>
                                                                    <div id="337089" class="vc_toggle vc_toggle_arrow vc_toggle_color_grey vc_toggle_size_md">
                                                                        <div class="vc_toggle_title">
                                                                            <h4><strong>Titulo 1?</strong></h4><i class="vc_toggle_icon"></i>
                                                                        </div>
                                                                        <div class="vc_toggle_content">
                                                                            <p>Conteudo titulo 1</p>
                                                                        </div>
                                                                    </div>
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
                                                <div class="title-subtitle  font-default subtitle-style-default woodmart-font-weight-">INFORMATION ABOUT US</div>
                                                <div class="liner-continer"> <span class="left-line"></span>
                                                    <h4 class="woodmart-title-container title  woodmart-font-weight-">CONTACT US FOR ANY QUESTIONS</h4> <span class="right-line"></span></div>
                                            </div>
                                            <div class="screen-reader-response"></div>
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
                                                    <button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="content send" data-value="content send">content send</button>
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
<script type='text/javascript'>
    var avd_config_contact = {!! json_encode([
        "contact_url" => route('contact'),
        "is_contact" => "1",
        "debug_mode" => "",
        "csrf_token" => csrf_token(),
        "error_json" => "Json Invalid",
        "i18n_contact_error" => constLang('messages.register.account_failure')
    ]) !!}
</script>
<script type='text/javascript'>
    jQuery( document ).ready(function($) {
        $("#contact_phone").mask('(99)9999-9999?9');
    });

</script>
<script type="text/javascript">

    jQuery('#subject-contact').select2({
        placeholder: "Selecione um"
    });

    jQuery( function( $ ) {

        // avd_config_contact é necessário para continuar, garantir que o objeto existe
        if ( typeof avd_config_contact === 'undefined' ) {
            return false;
        }

        $.blockUI.defaults.overlayCSS.cursor = 'default';

        var avd_contact_form = {
            updateTimer: false,
            dirtyInput: false,
            xhr: false,
            $contact_form: $( 'form.contact' ),
            init: function() {
                $( document.body ).bind( 'update_contact', this.update_contact );
                $( document.body ).bind( 'init_contact', this.init_contact );
                // Prevent HTML5 validation which can conflict.
                this.$contact_form.attr( 'novalidate', 'novalidate' );

                // Form submission
                this.$contact_form.on( 'submit', this.submit );

                // Inline validation
                this.$contact_form.on( 'input validate change', '.input-text, select, input:checkbox', this.validate_field );

                // Manual trigger
                this.$contact_form.on( 'update', this.trigger_update_contact );
                // Update on page load
                if ( avd_config_contact.is_contact === '1' ) {
                    $( document.body ).trigger( 'init_contact' );
                }
            },

            init_contact: function() {
                $( document.body ).trigger( 'update_contact' );
            },
            maybe_input_changed: function( e ) {
                if ( avd_contact_form.dirtyInput ) {
                    avd_contact_form.input_changed( e );
                }
            },
            input_changed: function( e ) {
                avd_contact_form.dirtyInput = e.target;
            },
            queue_update_contact: function( e ) {
                var code = e.keyCode || e.which || 0;

                if ( code === 9 ) {
                    return true;
                }

                avd_contact_form.dirtyInput = this;
                avd_contact_form.reset_update_contact_timer();
            },
            trigger_update_contact: function() {
                avd_contact_form.reset_update_contact_timer();
                avd_contact_form.dirtyInput = false;
                $( document.body ).trigger( 'update_contact' );
            },
            reset_update_contact_timer: function() {
                clearTimeout( avd_contact_form.updateTimer );
            },
            is_valid_json: function( raw_json ) {
                try {
                    var json = $.parseJSON( raw_json );

                    return ( json && 'object' === typeof json );
                } catch ( e ) {
                    return false;
                }
            },
            validate_field: function( e ) {
                var $this             = $( this ),
                    $parent           = $this.closest( '.form-row' ),
                    validated         = true,
                    validate_required = $parent.is( '.validate-required' ),
                    validate_email    = $parent.is( '.validate-email' ),
                    event_type        = e.type;

                if ( 'input' === event_type ) {
                    $parent.removeClass( 'woocommerce-invalid woocommerce-invalid-required-field woocommerce-invalid-email woocommerce-validated' );
                }

                if ( 'validate' === event_type || 'change' === event_type ) {

                    if ( validate_required ) {
                        if ( 'checkbox' === $this.attr( 'type' ) && ! $this.is( ':checked' ) ) {
                            $parent.removeClass( 'woocommerce-validated' ).addClass( 'woocommerce-invalid woocommerce-invalid-required-field' );
                            validated = false;
                        } else if ( $this.val() === '' ) {
                            $parent.removeClass( 'woocommerce-validated' ).addClass( 'woocommerce-invalid woocommerce-invalid-required-field' );
                            validated = false;
                        }
                    }

                    if ( validate_email ) {
                        if ( $this.val() ) {
                            /* https://stackoverflow.com/questions/2855865/jquery-validate-e-mail-address-regex */
                            var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);

                            if ( ! pattern.test( $this.val()  ) ) {
                                $parent.removeClass( 'woocommerce-validated' ).addClass( 'woocommerce-invalid woocommerce-invalid-email' );
                                validated = false;
                            }
                        }
                    }

                    if ( validated ) {
                        $parent.removeClass( 'woocommerce-invalid woocommerce-invalid-required-field woocommerce-invalid-email' ).addClass( 'woocommerce-validated' );
                    }
                }
            },
            update_contact: function( event, args ) {
                // Tempo limite pequeno para evitar várias solicitações quando vários campos são atualizados ao mesmo tempo
                avd_contact_form.reset_update_contact_timer();
                avd_contact_form.updateTimer = setTimeout( avd_contact_form.update_contact_action, '5', args );
            },
            update_contact_action: function( args ) {

                if ( avd_contact_form.xhr ) {
                    avd_contact_form.xhr.abort();
                }

                if ( $( 'form.contact' ).length === 0 ) {
                    return;
                }

                var data = {
                    post_data: $( 'form.contact' ).serialize()
                };
            },
            submit: function() {
                avd_contact_form.reset_update_contact_timer();
                var $form = $( this );

                if ( $form.is( '.processing' ) ) {
                    return false;
                }

                // Acionar um manipulador para permitir que gateways manipulem o checkout, se necessário
                if ( $form.triggerHandler( 'checkout_place_order' ) !== false) {

                    $form.addClass( 'processing' );

                    var form_data = $form.data();

                    if ( 1 !== form_data['blockUI.isBlocked'] ) {
                        $form.block({
                            message: null,
                            overlayCSS: {
                                background: '#fff',
                                opacity: 0.6
                            }
                        });
                    }

                    // ajaxSetup is global, but we use it to ensure JSON is valid once returned.
                    $.ajaxSetup( {
                        dataFilter: function( raw_response, dataType ) {
                            // We only want to work with JSON
                            if ( 'json' !== dataType ) {
                                return raw_response;
                            }

                            if ( avd_contact_form.is_valid_json( raw_response ) ) {
                                return raw_response;
                            } else {
                                // Attempt to fix the malformed JSON
                                var maybe_valid_json = raw_response.match( /{"result.*}/ );

                                if ( null === maybe_valid_json ) {
                                    console.log( 'Unable to fix malformed JSON' );
                                } else if ( avd_contact_form.is_valid_json( maybe_valid_json[0] ) ) {
                                    console.log( 'Fixed malformed JSON. Original:' );
                                    console.log( raw_response );
                                    raw_response = maybe_valid_json[0];
                                } else {
                                    console.log( 'Unable to fix malformed JSON' );
                                }
                            }

                            return raw_response;
                        }
                    } );

                    $.ajax({
                        type:		'POST',
                        url:		avd_config_contact.contact_url,
                        data:		$form.serialize(),
                        dataType:   'json',
                        beforeSend: function(){
                            console.log( this.data );
                        },
                        success:	function( result ) {
                            try {

                                if ( 'success' === result.result ) {

                                    avd_contact_form.$contact_form.html( '<div class="return-contact">'+result.success+'</div>' );

                                } else if ( 'redirect' === result.result ) {

                                    if ( -1 === result.redirect.indexOf( 'https://' ) || -1 === result.redirect.indexOf( 'http://' ) ) {
                                        window.location = result.redirect;
                                    } else {
                                        window.location = decodeURI( result.redirect );
                                    }

                                } else if ( 'failure' === result.result ) {
                                    avd_contact_form.submit_error( result.message );

                                } else {

                                    throw avd_config_contact.error_json
                                }

                            } catch( err ) {
                                // Reload page
                                if ( true === result.reload ) {
                                    window.location.reload();
                                    return;
                                }

                                // Trigger update in case we need a fresh nonce
                                if ( true === result.refresh ) {
                                    $( document.body ).trigger( 'update_contact' );
                                }

                                // Add new errors
                                if ( result.message ) {
                                    avd_contact_form.submit_error( result.message );

                                } else {
                                    avd_contact_form.submit_error( '<div class="woocommerce-error">' + avd_config_contact.i18n_contact_error + '</div>' );

                                }
                            }
                        },

                        error:	function( jqXHR ) {

                            if (jqXHR.status == 422) {
                                var obj = $.parseJSON(jqXHR.responseText), message = '';
                                $.each( obj, function( key, value ) {

                                    if (key == 'errors') {
                                        $.each(obj[key], function(i, error) {
                                            message += '<li>'+error+'</li>';
                                        });
                                    }
                                });
                            }

                            avd_contact_form.submit_error( '<ul class="woocommerce-error">' + message + '</ul>' );
                            setTimeout(function(){ $(".return-contact").hide(); }, 8000);
                        }
                    });
                }

                return false;
            },
            submit_error: function( error_message ) {
                $( '.return-contact, .woocommerce-error, .woocommerce-message' ).remove();
                avd_contact_form.$contact_form.prepend( '<div class="return-contact">' + error_message + '</div>' );
                avd_contact_form.$contact_form.removeClass( 'processing' ).unblock();
                avd_contact_form.$contact_form.find( '.input-text, select, input:checkbox' ).trigger( 'validate' ).blur();
                avd_contact_form.scroll_to_notices();
                $( document.body ).trigger( 'contact_error' );
            },
            return_success: function (message) {
                alert('pegou');
                $( '.return-contact, .woocommerce-error, .woocommerce-message' ).remove();
                avd_contact_form.$contact_form.html( '<div class="return-contact">'+message+'</div>' );
            },
            scroll_to_notices: function() {
                var scrollElement = $( '.return-contact' );

                if ( ! scrollElement.length ) {
                    scrollElement = $( '.form.contact' );
                }
                $.scroll_to_notices( scrollElement );
            }

        };



        avd_contact_form.init();
    });




</script>


@endpush

