(function ( $ ) {
    $( ".select--epiry-month" ).select2({
        placeholder: "Mês",
        allowClear: false
    });
    $( ".select--epiry-year" ).select2({
        placeholder: "Ano",
        allowClear: false
    });
    $( ".select-installments" ).select2({
        placeholder: "Parcelamento",
        allowClear: false
    });

    // Start keyup cardNumber countdown
    var typingTimer,
        doneTypingInterval = 3000;
    //on keyup, start the countdown
    $('#cardNumber').keyup(function() {
        clearTimeout(typingTimer);
        if ($('#cardNumber').val) {
            typingTimer = setTimeout(setSessionCreditId, doneTypingInterval);
        }
    });

    $( ".other_holder" ).click(function() {
        $( "#card-holder" ).toggle( "show" );
    });

    $(".btn-payment-card").click(function () {
        if (validateCard() == 0) {
            var btn = _pagSeguroSettings.btn_card,
                cls = _pagSeguroSettings.class_card;
            createCredCardToken(btn, cls);
        }
        return false;
    });

    /**
     * Passo 1: Gerando uma sessão
     */
    setSessionCreditId = function (btn, cls) {
        var data = $('#form-pagseguro').serialize();
        $.ajax({
            url: _pagSeguroSettings.ajax_transparente,
            method: "POST",
            data: data,
            //beforeSend: startPreloaderPS()
        }).done(function (data) {
            console.log(data);
            PagSeguroDirectPayment.setSessionId(data);
            getBrand();
        }).fail(function () {
            console.log(_pagSeguroSettings.text_error);
        }).always(function () {

        });
    }

    /**
     * Passo 2: Varificar a Bandeira do Cartão
     */
    getBrand = function () {
        PagSeguroDirectPayment.getBrand({
            cardBin: $('input[name=cardNumber]').val().replace(/ /g, ''),
            success: function (response) {
                //console.log(response.brand.name);
                $('input[name=brandName]').val(response.brand.name);
                getInstallments(response.brand.name);
            },
            error: function (response) {
                console.log(response);
            },
            complete: function (response) {
                //console.log(response);
            }
        });
    }

    /**
     * Passo 3: Retorna as opções de parcelamento disponíveis         *
     *
     * @param brandName
     */
    getInstallments = function (brandName) {

        var text_interest_true = ' '+_pagSeguroSettings+interest_true,
            text_interest_false = ' '+_pagSeguroSettings+interest_false,
            text_currency = _pagSeguroSettings+currency_x+' ',
            text_option = '';
        PagSeguroDirectPayment.getInstallments({
            amount: $('input[name=amount]').val(),
            maxInstallmentNoInterest: $('input[name=maxInstallment]').val(),
            brand: brandName,
            success: function(response){
                var obj = response.installments,
                    data = obj[brandName];
                console.log(data);
                if (data.length > 0){

                    var option = [];
                    $.each(data, function(index, value){
                        if (index === 0) {
                            text_option = value.quantity+text_currency+value.totalAmount+text_interest_true;
                        } else {
                            if (value.interestFree == true) {
                                text_option = value.quantity+text_currency+value.installmentAmount+text_interest_true;
                            } else {
                                text_option = value.quantity+text_currency+value.installmentAmount+text_interest_false;
                            }
                        }
                        option.push({
                            id: value.quantity +'|'+ value.installmentAmount,
                            text: text_option
                        });
                    });

                    $(".select-installments").select2({
                        data: option
                    });
                }



                //createCredCardToken(brandName);
            },
            error: function(response) {
                contole.log(response);
            },
            complete: function(response){
                // Callback para todas chamadas.
            }
        });
    }


    /**
     * Passo 4: Utiliza os dados do cartão de crédito para gerar um token.
     * Esse método é necessário somente para o meio de pagamento cartão de crédito.
     *
     * @param brandName
     */

    createCredCardToken = function (btn, cls) {
        var cardCVV =  $('input[name=cardCVV]').val(),
            cardExpiryMonth = $("#cardExpiryMonth option:selected").val(),
            cardExpiryYear = $("#cardExpiryYear option:selected").val();

        PagSeguroDirectPayment.createCardToken({
            cardNumber: $('input[name=cardNumber]').val().replace(/ /g, ''),
            brand: $('input[name=brandName]').val(),
            //brand: $('input[name=brandName]').val(),
            cvv: cardCVV,
            expirationMonth: cardExpiryMonth,
            expirationYear: cardExpiryYear,
            success: function (response) {
                //console.log(response);
                $('input[name=cardToken]').val(response.card.token);
                createTransactionCard(btn, cls);

            },
            error: function (response) {
                console.log(response);
                stopPreloaderPS(btn, cls)
            },
            complete: function (response) {
                //console.log(response);

            }
        });

    }

    createTransactionCard = function (btn, cls) {
        var senderHash = PagSeguroDirectPayment.getSenderHash();
        $('#senderHash').val(senderHash);
        var data = $('#form-pagseguro').serialize();
        $.ajax({
            url: _pagSeguroSettings.ajax_transaction,
            method: "POST",
            data: data,
            beforeSend: startPreloaderPS(cls)
        }).done(function (code) {
            //console.log(code);
            $("#return-payment").html("Seu pagamento foi realizado com sucesso! Código da Transação: "+code);

        }).fail(function (error) {
            console.log(error.responseJSON.message);
            stopPreloaderPS(btn, cls);
        }).always(function () {

        });
    }


    /**
     *  Validação dos Cartões
     */
    validateCard = function () {
        var error = 0,
            html = '',
            cardNumber =  $('input[name=cardNumber]').val(),
            cardName =  $('input[name=cardName]').val(),
            cardCVV =  $('input[name=cardCVV]').val();

        if (cardNumber.length < 19) {
            error = 1;
            $('input[name=cardNumber]').css("border", "red solid 1px");
            html = '<li>'+_pagSeguroSettings.required_number+'</li>';
        }

        if (cardName.length < 6) {
            error = 1;
            $('input[name=cardName]').css("border", "red solid 1px");
            html += '<li>'+_pagSeguroSettings.required_name+'</li>';
        }

        if (cardCVV.length < 3) {
            error = 1;
            $('input[name=cardCVV]').css("border", "red solid 1px");
            html += '<li>'+_pagSeguroSettings.required_cvv+'</li>';
        }

        if (error == 0) {
            $('input[name=cardNumber]').css("border", "rgba(136, 135, 135, 0.25) solid 1px");
            $('input[name=cardName]').css("border", "rgba(136, 135, 135, 0.25) solid 1px");
            $('input[name=cardCVV]').css("border", "rgba(136, 135, 135, 0.25) solid 1px");
        } else {
            $("#return-payment").show();
            $("#return-payment").html('<ul class="woocommerce-error" role="alert">'+html+'</ul>');
            setTimeout(function(){
                $("#return-payment").hide();
            }, 5000);
        }

        return error;
    }

    /**************************************************************************************************************/
    /*                                            B I L L E T                                                     */
    /**************************************************************************************************************/

    $(".btn-payment-billet").click(function () {
        setSessionBilletId();
        return false;
    });

    setSessionBilletId = function () {
        var data = $('#form-pagseguro').serialize(),
            btn = _pagSeguroSettings.btn_billet,
            cls = _pagSeguroSettings.class_billet;
        $.ajax({
            url: _pagSeguroSettings.ajax_transparente,
            method: "POST",
            data: data,
            beforeSend: startPreloaderPS(cls)
        }).done(function (data) {
            //console.log(data);
            PagSeguroDirectPayment.setSessionId(data);
            paymentBillet(btn, cls);

        }).fail(function () {
            //console.log(_pagSeguroSettings.text_error);
            stopPreloaderPS(btn, cls);
        }).always(function () {

        });
    }

    /**
     * Pagamento com boleto
     */
    paymentBillet = function (btn, cls) {
        var senderHash = PagSeguroDirectPayment.getSenderHash();
        $('#senderHash').val(senderHash);
        var data = $('#form-pagseguro').serialize();
        $.ajax({
            url: _pagSeguroSettings.ajax_billet,
            method: "POST",
            data: data
        }).done(function (response) {
            //console.log(response);
            if (response.success)
                window.location=response.redirect;

        }).fail(function () {
            console.log(_pagSeguroSettings.text_error);
            stopPreloaderPS(btn, cls);
        }).always(function () {
            stopPreloaderPS(btn,cls);
        });
    }


    startPreloaderPS = function (cls) {
        $(cls).attr("disabled", true).addClass(_pagSeguroSettings.class_loading).text(_pagSeguroSettings.text_loading);
    }

    stopPreloaderPS = function (btn, cls) {
        $(cls).attr("disabled", false).removeClass(_pagSeguroSettings.class_loading).text(btn);
    }


    /**************************************************************************************************************/
    /*                                       RETURN FORM PAYMENTS                                                 */
    /**************************************************************************************************************/
    /**
     * Retorna as formas de pagamentos
     */
    getPaymentMethods = function () {

        startPreloaderPS();

        PagSeguroDirectPayment.getPaymentMethods({
            success: function (response) {
                console.log(response);
                if (response.error == false) {
                    $.each(response.paymentMethods, function (key, value) {
                        $('.payment-methods').append(key+"<br>");
                    })
                }
            },
            error: function (response) {
                console.log(response);
                stopPreloaderPS();
            },
            complete: function (response) {
                console.log(response);

            }
        });
    }


})( window.jQuery );