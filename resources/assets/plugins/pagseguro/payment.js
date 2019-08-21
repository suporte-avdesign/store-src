(function ( $ ) {

    /**************************************************************************************************************/
    /*                                       C A R D - C E D I T                                                  */
    /**************************************************************************************************************/


    $(".btn-payment-card").click(function () {
        var btn = _pagSeguroSettings.btn_card,
            cls = _pagSeguroSettings.class_card;
        createCredCardToken(btn, cls);
        return false;
    });


    /**
     * Passo 1: Gerando uma sessão
     */
    setSessionCreditId = function () {
        var data = $('#form-pagseguro').serialize(),
            btn = _pagSeguroSettings.btn_card,
            cls = _pagSeguroSettings.class_card;
        $.ajax({
            url: _pagSeguroSettings.ajax_transparente,
            method: "POST",
            data: data,
            //beforeSend: startPreloaderPS()
        }).done(function (data) {
            console.log(data);
            PagSeguroDirectPayment.setSessionId(data);
            getBrand(btn, cls);
        }).fail(function (error) {
            console.log(error);
            errorPayment(btn, cls, _pagSeguroSettings.error_session);
        }).always(function () {

        });
    }

    /**
     * Passo 2: Varificar a Bandeira do Cartão
     */
    getBrand = function (btn, cls) {
        PagSeguroDirectPayment.getBrand({
            cardBin: $('input[name=cardNumber]').val().replace(/ /g, ''),
            success: function (response) {
                //console.log(response.brand.name);
                $('input[name=brandName]').val(response.brand.name);
                getInstallments(response.brand.name, btn, cls);
                var brand = $("#"+response.brand.name).attr('src');
                $("#img_brand").html('<img src="'+brand +'" alt="'+response.brand.name+'"/>');
            },
            error: function (response) {
                $("#img_brand").html('');
                errorPayment(btn, cls, _pagSeguroSettings.error_card_number);
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
    getInstallments = function (brandName, btn, cls) {

        var text_interest_true = ' '+_pagSeguroSettings.interest_true;
        var text_interest_false = ' '+_pagSeguroSettings.interest_false;
        var text_currency = _pagSeguroSettings.currency_x+' ';
        var text_option = '';
        PagSeguroDirectPayment.getInstallments({
            amount: $('input[name=amount]').val(),
            maxInstallmentNoInterest: $('input[name=maxInstallment]').val(),
            brand: brandName,
            success: function(response){
                var obj = response.installments,
                    data = obj[brandName];
                console.log(data);
                if (data.length > 0){
                    $("#label1").text(_pagSeguroSettings.select_installments);
                    var option = [];
                    $.each(data, function(index, value){
                        var rst = value.totalAmount.toFixed(2);
                        var rs  = value.installmentAmount.toFixed(2);
                        if (index === 0) {
                            text_option = value.quantity+text_currency+rst.replace('.',',')+text_interest_true;
                        } else {
                            if (value.interestFree == true) {
                                text_option = value.quantity+text_currency+rs.replace('.',',')+text_interest_true;
                            } else {
                                text_option = value.quantity+text_currency+rs.replace('.',',')+text_interest_false;
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
                errorPayment(btn, cls, _pagSeguroSettings.error_method);
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
                errorPayment(btn, cls, _pagSeguroSettings.error_card_token);
            },
            complete: function (response) {
                console.log(response);
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
        }).done(function (response) {
            stopPreloaderPS(btn, cls);
            if (response.success == true) {
                window.location= response.redirect;

            } else {
                errorPayment(btn, cls, _pagSeguroSettings.text_error);
            }

        }).fail(function (jqXHR) {

            stopPreloaderPS(btn, cls);

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
            $("#return-payment").show();
            $("#return-payment").html('<ul class="woocommerce-error">' + message + '</ul>');
            setTimeout(function(){ $("#return-payment").hide(); }, 6000);

        }).always(function () {
            stopPreloaderPS(btn, cls);
        });
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
            errorPayment(btn, cls, _pagSeguroSettings.error_session);
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
            if (response.success == true) {
                window.location=response.redirect;
            } else {
                errorPayment(btn, cls, _pagSeguroSettings.text_error);
            }
        }).fail(function () {
            errorPayment(btn, cls, _pagSeguroSettings.text_error);
        }).always(function () {
            stopPreloaderPS(btn,cls);
        });
    }

    errorPayment = function (btn, cls, message) {
        stopPreloaderPS(btn, cls);
        $("#return-payment").show();
        $("#return-payment").html('<ul class="woocommerce-error"><li>' + message + '</li></ul>');
        setTimeout(function(){ $("#return-payment").hide(); }, 6000);
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