<html>
<head>
    <title>PagSeguro Card</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2>Pagamento com Cartão</h2>

    <form id="form-pagseguro" method="post" action="{{route('pagseguro.transparente')}}">
        @csrf
        <div class="form-group">
            <label>Número do Cartão</label>
            <input type="text" class="form-control" placeholder="Número do Cartão" name="cardNumber" id="cardNumber" value="" required />
        </div>
        <div class="form-group">
            <label>Mês de Espiração</label>
            <input type="text" class="form-control" placeholder="Mês de Espiração" name="cardExpiryMonth" id="cardExpiryMonth" value="" required />
        </div>
        <div class="form-group">
            <label>Ano de Espiração</label>
            <input type="text" class="form-control" placeholder="Ano de Espiração" name="cardExpiryYear" id="cardExpiryYear" value="" required/>
        </div>
        <div class="form-group">
            <label>Código de Segurança</label>
            <input type="text" class="form-control" placeholder="Código de Segurança" name="cardCVV" id="cardCVV" value="" required/>
        </div>
        <div class="preloader-pagseguro" style="display: none">Aguarde...</div>
        <div class="form-group">
            <button type="submit" id="btn-submit" class="btn btn-default">Enviar Agora</button>
        </div>
        <input type="hidden" name="brandName" value="" />
        <input type="hidden" name="cardToken" value="" />
        <input type="hidden" id="senderHash" name="senderHash" value="" />
    </form>
    <div class="message-return"></div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{config('pagseguro.url_transparent_js')}}"></script>

<script>

    $(function () {


        $("#form-pagseguro").submit(function () {
            setSessionId();
            return false;
        })

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

                getBrand();
                startPreloaderPS();

            }).fail(function () {
                console.log('Erro inesperado, tentar novamente mais tarde!');
                stopPreloaderPS();
            }).always(function () {
                stopPreloaderPS();
            });
        }

        getBrand = function () {
            PagSeguroDirectPayment.getBrand({

                cardBin: $('input[name=cardNumber]').val().replace(/ /g, ''),

                success: function (response) {
                    //console.log(response.brand.name);
                    $('input[name=brandName]').val(response.brand.name);
                    createCredCardToken(response.brand.name);

                },
                error: function (response) {
                    console.log(response);
                },
                complete: function (response) {
                    //console.log(response);
                }
            });
        }
        
        
        createCredCardToken = function (brandName) {
            PagSeguroDirectPayment.createCardToken({
                cardNumber: $('input[name=cardNumber]').val().replace(/ /g, ''),
                brand: brandName,
                //brand: $('input[name=brandName]').val(),
                cvv: $('input[name=cardCVV]').val(),
                expirationMonth: $('input[name=cardExpiryMonth]').val(),
                expirationYear: $('input[name=cardExpiryYear]').val(),
                success: function (response) {
                    //console.log(response);
                    $('input[name=cardToken]').val(response.card.token);
                    createTransactionCard();

                },
                error: function (response) {
                    console.log(response);
                    stopPreloaderPS()
                },
                complete: function (response) {
                    //console.log(response);
                    stopPreloaderPS()
                }
            });

        }

        createTransactionCard = function () {
            var senderHash = PagSeguroDirectPayment.getSenderHash();
            $('#senderHash').val(senderHash);
            var data = $('#form-pagseguro').serialize();
            $.ajax({
                url: "{{route('pagseguro.card.transaction')}}",
                method: "POST",
                data: data,
                beforeSend: startPreloaderPS()
            }).done(function (code) {
                //console.log(code);
                $(".message-return").html("Seu pagamento foi realizado com sucesso! Código da Transação: "+code);

            }).fail(function () {
                console.log('Erro inesperado, tentar novamente mais tarde!');
                stopPreloaderPS();
            }).always(function () {
                stopPreloaderPS();
            });
        }

        startPreloaderPS = function () {
            $(".preloader-pagseguro").show();
            $("#btn-submit").addClass('disabled');
        }

        stopPreloaderPS = function () {
            $(".preloader-pagseguro").hide();
            $("#btn-submit").removeClass('disabled');
        }



    });
</script>

</body>
</html>