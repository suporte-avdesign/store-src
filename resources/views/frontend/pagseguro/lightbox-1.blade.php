<html>
<head>
    <title>Pag Seguro Lightbox</title>
</head>
<body>
    <a href="#" class="btn-buy">Finalizar Compra</a>
    {!! csrf_field() !!}



    <div class="message-pagseguro"></div>
    <div class="preloader-pagseguro" style="display: none">Carregando...</div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
        $(function () {
            $(".btn-buy").click(function () {

                var token = $('input[name=_token]').val();
                $.ajax({
                    url: "{{route('pagseguro.lightbox.code')}}",
                    method: "POST",
                    data: {_token: token},
                    beforeSend: startPreloaderPS()
                }).done(function (code) {
                    lightboxPagSeguro(code);
                }).fail(function () {
                    console.log('Erro inesperado, tentar novamente mais tarde!');
                    stopPreloaderPS();
                }).always(function () {
                    stopPreloaderPS();
                });

                return false;
            })

            lightboxPagSeguro = function (code) {
                var isOpenLightBox = PagSeguroLightbox({
                    code: code
                },{
                    success: function (transactionCode) {
                        console.log('Pedido realizado co sucesso!'+transactionCode);
                    },
                    abort: function () {
                        console.log('Compra abortada!');
                    }

                });
                // Se o navegador não suportar lightbox
                if (!isOpenLightBox) {
                    window.location= "{{config('pagseguro.url_redirect_after_request')}}"+code;
                }
            }

            startPreloaderPS = function () {
                $(".preloader-pagseguro").show();
            }

            stopPreloaderPS = function () {
                $(".preloader-pagseguro").hide();
            }


        });
    </script>
    <script src="{{config('pagseguro.url_lightbox')}}"></script>
</body>
</html>