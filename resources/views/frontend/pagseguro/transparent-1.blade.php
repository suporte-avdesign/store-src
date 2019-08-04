<html>
<head>
    <title>Pag Seguro Transparente</title>
</head>
<body>

    <form id="form-pagseguro" method="post" action="{{route('pagseguro.transparente')}}">
        @csrf
        <p><a href="#" class="btn-form-payments">Formas de Pagamento</a></p>
        <div class="payment-methods"></div>
        <div class="message-pagseguro"></div>
        <div class="preloader-pagseguro" style="display: none">Carregando...</div>


    </form>





    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{config('pagseguro.url_transparent_js')}}"></script>

    <script>
        $(function () {

            $(".btn-form-payments").click(function () {
                setSessionId();
                return false;
            });

            $(".btn-payment-billet").click(function () {
                setSessionId();
                return false;
            });

            setSessionId = function () {
                var data = $('#form-pagseguro').serialize();
                $.ajax({
                    url: "{{route('pagseguro.transparente.code')}}",
                    method: "POST",
                    data: data,
                    beforeSend: startPreloaderPS()
                }).done(function (data) {
                    console.log(data);

                    PagSeguroDirectPayment.setSessionId(data);

                    getPaymentMethods();


                }).fail(function () {
                    console.log('Erro inesperado, tentar novamente mais tarde!');
                    stopPreloaderPS();
                }).always(function () {
                    stopPreloaderPS();
                });
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
                    },
                    complete: function (response) {
                        //console.log(response);
                        stopPreloaderPS();
                    }
                });
            }


            startPreloaderPS = function () {
                $(".preloader-pagseguro").show();
            }

            stopPreloaderPS = function () {
                $(".preloader-pagseguro").hide();
            }


        });
    </script>

</body>
</html>