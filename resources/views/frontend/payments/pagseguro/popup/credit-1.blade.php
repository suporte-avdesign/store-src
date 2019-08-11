<div class="vc_row wpb_row vc_inner vc_row-fluid avd_custom_popup_payment vc_row-o-equal-height vc_row-flex">
    <div class="wpb_column vc_column_container vc_col-sm-8">
        <div class="vc_column-inner avd_custom_popup_payment_inner">
            <div class="wpb_wrapper">
                <div class="title-wrapper  basel-title-color-default basel-title-style-default basel-title-size-small text-left ">
                    <div class="images">

                        <img id="visa" src="{{asset('themes/images/payment/visa.gif')}}" alt="Visa" />
                        <img id="mastercard" src="{{asset('themes/images/payment/master.gif')}}" alt="Mastercard" />
                        <img id="diners" src="{{asset('themes/images/payment/diners.gif')}}" alt=" Diners Club" />
                        <img id="hipercard" src="{{asset('themes/images/payment/hipercard.gif')}}" alt="Hipercard" />
                        <img id="amex" src="{{asset('themes/images/payment/amex.gif')}}" alt="American Express" />
                        <img id="elo" src="{{asset('themes/images/payment/elo.gif')}}" alt="ELO" >
                    </div>
                    <div class="liner-continer" style="margin-top: 10px"> <span class="left-line"></span>
                        <h4 class="title"> {{constLang('messages.payments.title_credit')}}
                            <span class="title-separator"><span></span></span>
                        </h4>
                        <span class="right-line"></span>
                    </div>
                </div>
                <div class="">
                    <form id="form-pagseguro" class="form">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label>Número do Cartão<span class="required">*</span></label>
                                <span class="card-number">
                                    <input type="text" class="input-text" placeholder="0000 0000 0000 0000" name="cardNumber" id="cardNumber" value="" size="19" style="width: 160px" />
                                </span>
                                <p id="erro-card-number" style="color: red"></p>
                            </div>

                            <div class="col-md-3">
                                <label>Ano de expiração</label>
                                <select name="cardExpiryMonth" id="cardExpiryMonth" autocomplete="off" class="month_select">
                                    <option value="01" selected>01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Mês de expiração</label>
                                <select name="cardExpiryYear" id="cardExpiryYear" autocomplete="off" class="year_select">
                                    <option value="2019">2019</option><option value="2020">2020</option><option value="2021">2021</option><option value="2022">2022</option><option value="2023">2023</option><option value="2024">2024</option><option value="2025">2025</option><option value="2026">2026</option><option value="2027">2027</option><option value="2028">2028</option><option value="2029">2029</option><option value="2030">2030</option><option value="2031">2031</option><option value="2032">2032</option><option value="2033">2033</option><option value="2034">2034</option><option value="2035">2035</option><option value="2036">2036</option><option value="2037">2037</option><option value="2038">2038</option>
                                </select>

                            </div>

                            <div class="col-md-8">
                                <p style="margin-top: 30px">
                                <label>Nome (Exatamente como impresso no cartão) <span class="required">*</span></label>
                                   <span class="card_name">
                                       <input type="text" name="cardName" id="cardName" value="" size="40" class="input-text"/>
                                   </span>
                                </p>
                                <p id="erro-card-name" style="color: red"></p>
                            </div>
                            <div class="col-md-4">
                                <p style="margin-top: 30px">
                                <label>Código de Segurança <span class="required">*</span></label>
                                    <span class="">
                                        <input type="text" placeholder="000" name="cardCVV" id="cardCVV" value="" size="3" class="in" style="width: 60px"/>
                                    </span>
                                    <a href="javascript:void(0)" title="Os 3 últimos números atrás do cartão"><i class="fa fa-question-circle"></i></a>
                                    <span style="margin-left: 10px"><img src="{{asset('themes/images/payment/securitycode.gif')}}" /></span>
                                </p>
                                <p id="erro-card-cvv" style="color: red"></p>
                            </div>


                            <div class="col-md-12">
                                <p style="margin-top: 10px">
                                    <label id="label1">Parcelamento (Digite os dados do seu cartão) <span class="required">*</span></label>
                                    <select name="installmentQuantity" id="installmentQuantity" autocomplete="off" class=""></select>
                                </p>
                            </div>

                        </div>

                        <input type="hidden" name="brandName" value="" />
                        <input type="hidden" name="cardToken" value="" />
                        <input type="hidden" id="senderHash" name="senderHash" value="" />
                    </form>

                    <div id="return-payment" class="woocommerce-notices-wrapper" style="display: none"></div>
                    <div class="text-right">
                        <p style="margin-top: 20px">
                            <button type="button" value="{{constLang('messages.payments.btn_card')}}" class="btn-payment-card btn btn-color-primary">{{constLang('messages.payments.btn_card')}}</button>
                        </p>
                    </div>



                    <div class="footer-payment-card">

                        <p class="payment-look text-left">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"width="30" height="30" viewBox="0 0 172 172" style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#666666"><path d="M86,11.46667c-22.09818,0 -40.13333,18.03515 -40.13333,40.13333v11.46667h-11.46667c-6.33533,0 -11.46667,5.13133 -11.46667,11.46667v68.8c0,6.33533 5.13133,11.46667 11.46667,11.46667h49.19245l32.68672,-52.26067c3.268,-5.49827 9.21777,-8.90235 15.5875,-8.90235c6.36973,0 12.32523,3.40981 15.5875,8.90235l1.6125,2.58672v-30.59271c0,-6.33533 -5.13133,-11.46667 -11.46667,-11.46667h-11.46667v-11.46667c0,-21.37626 -16.99027,-38.59356 -38.09531,-39.71901c-0.64841,-0.26118 -1.33911,-0.4016 -2.03802,-0.41432zM86,22.93333c15.90235,0 28.66667,12.76431 28.66667,28.66667v11.46667h-57.33333v-11.46667c0,-15.90235 12.76431,-28.66667 28.66667,-28.66667zM131.85547,105.10364c-2.48253,0 -4.61999,1.37511 -5.77813,3.38177l-33.24661,53.14531c-0.688,1.06067 -1.09739,2.31412 -1.09739,3.67292c0,3.698 2.99836,6.69636 6.69636,6.69636h33.43698h33.43698c3.698,0 6.69636,-2.99836 6.69636,-6.69636c0,-1.3588 -0.40912,-2.61225 -1.10859,-3.67292l-33.24662,-53.14531c-1.1524,-2.00667 -3.30679,-3.38177 -5.78932,-3.38177zM126.13333,126.13333h11.46667l-0.94062,22.93333h-9.57422zM131.88906,152.50442c3.57187,0 5.71094,1.91637 5.71094,5.19583c0,3.22213 -2.14481,5.12865 -5.71094,5.12865c-3.60053,0 -5.75573,-1.90652 -5.75573,-5.12865c0,-3.27947 2.15519,-5.19583 5.75573,-5.19583z"></path></g></g></svg>
                            Você está em um ambiente seguro
                        </p>
                    </div>



                </div>
            </div>
        </div>
    </div>

    @include('frontend.payments.pagseguro.contacts-1')

</div>


<script src="{{config('pagseguro.url_transparent_js')}}"></script>
@include('frontend.scripts._pagSeguroSettings')
<script>
    (function ( $ ) {

        $(".btn-payment-card").click(function () {
            if (validateCard() == 0) {
                setSessionCreditId();
            }
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
                url: "{{route('pagseguro.transparente.code')}}",
                method: "POST",
                data: data,
                beforeSend: startPreloaderPS(cls)
            }).done(function (data) {
                console.log(data);

                PagSeguroDirectPayment.setSessionId(data);

                getBrand(btn, cls);

            }).fail(function () {
                console.log(_pagSeguroSettings.text_error);
                stopPreloaderPS(btn, cls);
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
                },
                error: function (response) {
                    console.log(response);
                    stopPreloaderPS(btn, cls);
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
        getInstallments = function (brandName,btn, cls) {

            var text_interest_true = ' (sem juros)';
            var text_interest_false = ' (com juros)';
            var text_currency = 'x de R$ ';
            var text_option = '';
            PagSeguroDirectPayment.getInstallments({
                amount: 118.80,
                maxInstallmentNoInterest: 2,
                brand: brandName,
                success: function(response){
                    var obj = response.installments,
                        data = obj[brandName];
                    if (data.length > 0){
                        //console.log(data);
                        var option = '<option>Selecione</option>';
                        $.each(data, function(index, value){
                            if (index === 0) {
                                text_option = value.quantity+text_currency+value.totalAmount+text_interest_true
                            } else {
                                if (value.interestFree == true) {
                                    text_option = value.quantity+text_currency+value.installmentAmount+text_interest_true
                                } else {
                                    text_option = value.quantity+text_currency+value.installmentAmount+text_interest_false
                                }
                            }
                            option += '<option value="'+value.quantity+'">'+text_option+'</option>';
                        })
                        $('#label1').html('<span>Parcelamento</span>');
                        $('#installmentQuantity').show();
                        $('#installmentQuantity').html(option);


                    }else{
                        $('#label1').html('<span>Não Parcelamos</span>');
                        $('#installmentQuantity').hide();
                    }

                    createCredCardToken(brandName,btn,cls);
                },
                error: function(response) {
                    stopPreloaderPS(btn, cls);
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

        createCredCardToken = function (brandName,btn,cls) {
            var cardCVV =  $('input[name=cardCVV]').val(),
                cardExpiryMonth = $("#cardExpiryMonth option:selected").val(),
                cardExpiryYear = $("#cardExpiryYear option:selected").val();

            PagSeguroDirectPayment.createCardToken({
                cardNumber: $('input[name=cardNumber]').val().replace(/ /g, ''),
                brand: brandName,
                //brand: $('input[name=brandName]').val(),
                cvv: cardCVV,
                expirationMonth: cardExpiryMonth,
                expirationYear: cardExpiryYear,
                success: function (response) {
                    //console.log(response);
                    $('input[name=cardToken]').val(response.card.token);
                    //createTransactionCard(btn,cls);

                },
                error: function (response) {
                    console.log(response);
                    stopPreloaderPS(btn,cls)
                },
                complete: function (response) {
                    //console.log(response);

                }
            });

        }

        createTransactionCard = function (btn,cls) {
            var senderHash = PagSeguroDirectPayment.getSenderHash();
            $('#senderHash').val(senderHash);
            var data = $('#form-pagseguro').serialize();
            $.ajax({
                url: "{{route('pagseguro.card.transaction')}}",
                method: "POST",
                data: data,
            }).done(function (code) {
                //console.log(code);
                $(".message-return").html("Seu pagamento foi realizado com sucesso! Código da Transação: "+code);

            }).fail(function () {
                console.log(_pagSeguroSettings.text_error);
                stopPreloaderPS(btn,cls);
            }).always(function () {
                stopPreloaderPS(btn,cls);
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

        /**************************************************************************************************************/
        /*                                     P R E L O A D E R                                                      */
        /**************************************************************************************************************/

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
</script>

<script type="text/javascript" src="{{asset('plugins/jquery-maskedinput/jquery.maskedinput.min.js')}}"></script>
<script type='text/javascript'>
    jQuery( document ).ready(function($) {
        $("#cardNumber").mask('9999 9999 9999 9999');
        $("#cardExpiryMonth").mask('99');
        $("#cardExpiryYear").mask('9999');
        $("#cardCVV").mask('999');
    });
</script>
