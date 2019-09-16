jQuery( function( $ ) {
    $("#btn_payment_cash").click(function() {
        var data = $('#form-payment-cash').serialize();
        $.ajax({
            url: $('#form-payment-cash').attr('action'),
            method: "POST",
            data: data,
            beforeSend: startPreloaderPS()
        }).done(function (response) {

            if (response.success == true) {
                window.location= response.redirect;

            } else {
                $("#return-payment").html('<ul class="woocommerce-error">' + _pagCash.text_error + '</ul>');
                setTimeout(function(){ $("#return-payment").hide(); }, 6000);
            }

        }).error(function (jqXHR) {

            stopPreloaderPS();

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
            stopPreloaderPS();
        });
    });

    startPreloaderPS = function () {
        $("#btn_payment_cash").attr("disabled", true).addClass(_pagCash.class_loading).text(_pagCash.text_loading);
    }

    stopPreloaderPS = function () {
        $("#btn_payment_cash").attr("disabled", false).removeClass(_pagCash.class_loading).text(_pagCash.btn_cash);
    }
});