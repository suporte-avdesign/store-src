jQuery( function( $ ) {

    // avd_config_register é necessário para continuar, garantir que o objeto existe
    if ( typeof avd_config_register === 'undefined' ) {
        return false;
    }

    $.blockUI.defaults.overlayCSS.cursor = 'default';

    var avd_register_form = {
        updateTimer: false,
        dirtyInput: false,
        xhr: false,
        $register_form: $( 'form.register' ),
        init: function() {
            $( document.body ).bind( 'update_register', this.update_register );
            $( document.body ).bind( 'init_register', this.init_register );


            // Prevent HTML5 validation which can conflict.
            this.$register_form.attr( 'novalidate', 'novalidate' );

            // Form submission
            this.$register_form.on( 'submit', this.submit );

            // Inline validation
            this.$register_form.on( 'input validate change', '.input-text, select, input:checkbox', this.validate_field );

            // Manual trigger
            this.$register_form.on( 'update', this.trigger_update_register );
            // Update on page load
            if ( avd_config_register.is_register === '1' ) {
                $( document.body ).trigger( 'init_register' );
            }


            if ( avd_config_register.option_indicate_transport === 'yes' ) {
                $( 'input#indicate_transport' ).change( this.toggle_indicate_transport ).change();
            }
        },
        toggle_indicate_transport: function() {
            $( 'div.indicate_transport' ).hide();

            if ( $( this ).is( ':checked' ) ) {
                // Ensure password is not pre-populated.
                $( '#transport_nome' ).val( '' ).change();
                $( '#transport_phone' ).val( '' ).change();
                $( 'div.indicate_transport' ).slideDown();
            }
        },
        init_register: function() {
            $( document.body ).trigger( 'update_register' );
        },
        maybe_input_changed: function( e ) {
            if ( avd_register_form.dirtyInput ) {
                avd_register_form.input_changed( e );
            }
        },
        input_changed: function( e ) {
            avd_register_form.dirtyInput = e.target;
        },
        queue_update_register: function( e ) {
            var code = e.keyCode || e.which || 0;

            if ( code === 9 ) {
                return true;
            }

            avd_register_form.dirtyInput = this;
            avd_register_form.reset_update_register_timer();
        },
        trigger_update_register: function() {
            avd_register_form.reset_update_register_timer();
            avd_register_form.dirtyInput = false;
            $( document.body ).trigger( 'update_register' );
        },
        reset_update_register_timer: function() {
            clearTimeout( avd_register_form.updateTimer );
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
        update_register: function( event, args ) {
            // Tempo limite pequeno para evitar várias solicitações quando vários campos são atualizados ao mesmo tempo
            avd_register_form.reset_update_register_timer();
            avd_register_form.updateTimer = setTimeout( avd_register_form.update_register_action, '5', args );
        },
        update_register_action: function( args ) {

            if ( avd_register_form.xhr ) {
                avd_register_form.xhr.abort();
            }

            if ( $( 'form.register' ).length === 0 ) {
                return;
            }

            var data = {
                _token:  avd_config_register.csrf_token,
                post_data: $( 'form.register' ).serialize()
            };
        },
        submit: function() {
            avd_register_form.reset_update_register_timer();
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

                        if ( avd_register_form.is_valid_json( raw_response ) ) {
                            return raw_response;
                        } else {
                            // Attempt to fix the malformed JSON
                            var maybe_valid_json = raw_response.match( /{"result.*}/ );

                            if ( null === maybe_valid_json ) {
                                console.log( 'Unable to fix malformed JSON' );
                            } else if ( avd_register_form.is_valid_json( maybe_valid_json[0] ) ) {
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
                    url:		avd_config_register.register_url,
                    data:		$form.serialize(),
                    dataType:   'json',
                    beforeSend: function(){
                        console.log( this.data );
                    },
                    success:	function( result ) {
                        try {

                            if ( 'success' === result.result ) {

                                avd_register_form.$register_form.html( '<div class="return-register">'+result.success+'</div>' );

                            } else if ( 'redirect' === result.result ) {

                                if ( -1 === result.redirect.indexOf( 'https://' ) || -1 === result.redirect.indexOf( 'http://' ) ) {
                                    window.location = result.redirect;
                                } else {
                                    window.location = decodeURI( result.redirect );
                                }

                            } else if ( 'failure' === result.result ) {
                                avd_register_form.submit_error( result.message );

                            } else {

                                throw avd_config_register.error_json
                            }

                        } catch( err ) {
                            // Reload page
                            if ( true === result.reload ) {
                                window.location.reload();
                                return;
                            }

                            // Trigger update in case we need a fresh nonce
                            if ( true === result.refresh ) {
                                $( document.body ).trigger( 'update_register' );
                            }

                            // Add new errors
                            if ( result.message ) {
                                avd_register_form.submit_error( result.message );

                            } else {
                                avd_register_form.submit_error( '<div class="woocommerce-error">' + avd_config_register.i18n_register_error + '</div>' );

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

                        avd_register_form.submit_error( '<ul class="woocommerce-error">' + message + '</ul>' );
                        setTimeout(function(){ $(".return-register").hide(); }, 8000);
                    }
                });
            }

            return false;
        },
        submit_error: function( error_message ) {
            $( '.return-register, .woocommerce-error, .woocommerce-message' ).remove();
            avd_register_form.$register_form.prepend( '<div class="return-register">' + error_message + '</div>' );
            avd_register_form.$register_form.removeClass( 'processing' ).unblock();
            avd_register_form.$register_form.find( '.input-text, select, input:checkbox' ).trigger( 'validate' ).blur();
            avd_register_form.scroll_to_notices();
            $( document.body ).trigger( 'register_error' );
        },
        scroll_to_notices: function() {
            var scrollElement = $( '.return-register' );

            if ( ! scrollElement.length ) {
                scrollElement = $( '.form.register' );
            }
            $.scroll_to_notices( scrollElement );
        }

    };

    var wc_terms_toggle = {
        init: function() {
            $( document.body ).on( 'click', 'a.woocommerce-terms-and-conditions-link', this.toggle_terms );
        },

        toggle_terms: function() {
            if ( $( '.woocommerce-terms-and-conditions' ).length ) {
                $( '.woocommerce-terms-and-conditions' ).slideToggle( function() {
                    var link_toggle = $( '.woocommerce-terms-and-conditions-link' );

                    if ( $( '.woocommerce-terms-and-conditions' ).is( ':visible' ) ) {
                        link_toggle.addClass( 'woocommerce-terms-and-conditions-link--open' );
                        link_toggle.removeClass( 'woocommerce-terms-and-conditions-link--closed' );
                    } else {
                        link_toggle.removeClass( 'woocommerce-terms-and-conditions-link--open' );
                        link_toggle.addClass( 'woocommerce-terms-and-conditions-link--closed' );
                    }
                } );

                return false;
            }
        }
    };

    avd_register_form.init();
    wc_terms_toggle.init();
});
