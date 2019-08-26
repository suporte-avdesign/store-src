jQuery( function( $ ) {

    if ( typeof avd_config_address === 'undefined' ) {
        return false;
    }

    $.blockUI.defaults.overlayCSS.cursor = 'default';

    var avd_address_form = {
        updateTimer: false,
        dirtyInput: false,
        xhr: false,
        $address_form: $( 'form.address' ),
        init: function() {
            $( document.body ).bind( 'update_address', this.update_address );
            $( document.body ).bind( 'init_address', this.init_address );


            // Prevent HTML5 validation which can conflict.
            this.$address_form.attr( 'novalidate', 'novalidate' );

            // Form submission
            this.$address_form.on( 'submit', this.submit );

            // Inline validation
            this.$address_form.on( 'input validate change', '.input-text, select, input:checkbox', this.validate_field );

            // Manual trigger
            this.$address_form.on( 'update', this.trigger_update_address );
            // Update on page load
            if ( avd_config_address.is_address === '1' ) {
                $( document.body ).trigger( 'init_address' );
            }


            if ( avd_config_address.option_indicate_transport === 'yes' ) {
                $( 'input#indicate_transport' ).change( this.toggle_indicate_transport ).change();
            }
        },
        toggle_indicate_transport: function() {
            $( 'div.indicate_transport' ).hide();

            if ( $( this ).is( ':checked' ) ) {
                $( 'div.indicate_transport' ).slideDown();
            }
        },
        init_address: function() {
            $( document.body ).trigger( 'update_address' );
        },
        maybe_input_changed: function( e ) {
            if ( avd_address_form.dirtyInput ) {
                avd_address_form.input_changed( e );
            }
        },
        input_changed: function( e ) {
            avd_address_form.dirtyInput = e.target;
        },
        queue_update_address: function( e ) {
            var code = e.keyCode || e.which || 0;

            if ( code === 9 ) {
                return true;
            }

            avd_address_form.dirtyInput = this;
            avd_address_form.reset_update_address_timer();
        },
        trigger_update_address: function() {
            avd_address_form.reset_update_address_timer();
            avd_address_form.dirtyInput = false;
            $( document.body ).trigger( 'update_address' );
        },
        reset_update_address_timer: function() {
            clearTimeout( avd_address_form.updateTimer );
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
                //validate_email    = $parent.is( '.validate-email' ),
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

            }
        },
        update_address: function( event, args ) {
            // Tempo limite pequeno para evitar várias solicitações quando vários campos são atualizados ao mesmo tempo
            avd_address_form.reset_update_address_timer();
            avd_address_form.updateTimer = setTimeout( avd_address_form.update_address_action, '5', args );
        },
        update_address_action: function( args ) {

            if ( avd_address_form.xhr ) {
                avd_address_form.xhr.abort();
            }

            if ( $( 'form.address' ).length === 0 ) {
                return;
            }

            var data = {
                _token:  avd_config_address.csrf_token,
                post_data: $( 'form.address' ).serialize()
            };
        },
        submit: function() {
            avd_address_form.reset_update_address_timer();
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

                        if ( avd_address_form.is_valid_json( raw_response ) ) {
                            return raw_response;
                        } else {
                            // Attempt to fix the malformed JSON
                            var maybe_valid_json = raw_response.match( /{"result.*}/ );

                            if ( null === maybe_valid_json ) {
                                console.log( 'Unable to fix malformed JSON' );
                            } else if ( avd_address_form.is_valid_json( maybe_valid_json[0] ) ) {
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
                    url:		avd_config_address.address_url,
                    data:		$form.serialize(),
                    dataType:   'json',
                    beforeSend: function(){
                        console.log( this.data );
                    },
                    success:	function( result ) {
                        try {

                            if ( 'success' === result.result ) {

                                avd_address_form.$address_form.prepend( '<div class="return-address">'+result.success+'</div>' );
                                avd_address_form.$address_form.removeClass( 'processing' ).unblock();
                                avd_address_form.scroll_to_notices();
                                setTimeout(function(){ $(".return-address").hide(); }, 10000);

                            } else if ( 'redirect' === result.result ) {
                                avd_address_form.$address_form.prepend( '<div class="return-address">'+result.message+'</div>' );
                                avd_address_form.$address_form.removeClass( 'processing' ).unblock();
                                avd_address_form.scroll_to_notices();

                                setTimeout(function(){

                                    if ( -1 === result.redirect.indexOf( 'https://' ) || -1 === result.redirect.indexOf( 'http://' ) ) {
                                        window.location = result.redirect;
                                    } else {
                                        window.location = decodeURI( result.redirect );
                                    }

                                    }, 6000);

                            }  else {
                                avd_address_form.$address_form.prepend( '<div class="return-address">'+result.message+'</div>' );
                                avd_address_form.$address_form.removeClass( 'processing' ).unblock();
                                avd_address_form.scroll_to_notices();
                                setTimeout(function(){ $(".return-address").hide(); }, 10000);
                            }

                        } catch( err ) {
                            // Reload page
                            if ( true === result.reload ) {
                                window.location.reload();
                                return;
                            }

                            // Trigger update in case we need a fresh nonce
                            if ( true === result.refresh ) {
                                $( document.body ).trigger( 'update_address' );
                            }

                            // Add new errors
                            if ( result.message ) {
                                avd_address_form.submit_error( result.message );

                            } else {
                                avd_address_form.submit_error( '<div class="woocommerce-error">' + avd_config_address.i18n_address_error + '</div>' );

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

                        avd_address_form.submit_error( '<ul class="woocommerce-error">' + message + '</ul>' );
                        setTimeout(function(){ $(".return-address").hide(); }, 8000);
                    }
                });
            }

            return false;
        },
        submit_error: function( error_message ) {
            $( '.return-address, .woocommerce-error, .woocommerce-message' ).remove();
            avd_address_form.$address_form.prepend( '<div class="return-address">' + error_message + '</div>' );
            avd_address_form.$address_form.removeClass( 'processing' ).unblock();
            avd_address_form.$address_form.find( '.input-text, select, input:checkbox' ).trigger( 'validate' ).blur();
            avd_address_form.scroll_to_notices();
            $( document.body ).trigger( 'address_error' );
        },
        scroll_to_notices: function() {
            var scrollElement = $( '.return-address' );

            if ( ! scrollElement.length ) {
                scrollElement = $( '.form.address' );
            }
            $.scroll_to_notices( scrollElement );
        }

    };

    avd_address_form.init();
});
