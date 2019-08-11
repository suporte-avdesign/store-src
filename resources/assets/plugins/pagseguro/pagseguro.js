(function ( $ ) {
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