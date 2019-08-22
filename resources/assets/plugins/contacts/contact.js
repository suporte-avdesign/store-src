jQuery( function( $ ) {

    $('#subject-contact').select2({
        placeholder: avd_config_contact.placeholder_subject
    });

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
                                avd_contact_form.scroll_to_notices();

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


