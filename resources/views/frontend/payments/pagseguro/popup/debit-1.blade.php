<div class="vc_row wpb_row vc_inner vc_row-fluid avd_custom_popup_payment vc_row-o-equal-height vc_row-flex">
    <div class="wpb_column vc_column_container vc_col-sm-8">
        <div class="vc_column-inner avd_custom_popup_payment_inner">
            <div class="wpb_wrapper">
                <div class="row">
                    <div class="col-md-4" style="margin-bottom: 10px">
                        <strong>PAGUE COM:</strong><br>
                        <img id="visa" src="{{asset('themes/images/payment/visa.gif')}}" alt="Visa" />
                        <img id="mastercard" src="{{asset('themes/images/payment/master.gif')}}" alt="Mastercard" />
                    </div>
                    <div class="col-md-8">
                        <table style="margin-bottom: 10px; background-color: #e6e2e2">
                            <thead>
                            <tr>
                                <td><strong>Pedido</strong></td>
                                <td><strong>Frete</strong></td>
                                <td><strong>Total</strong></td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>R$ {{setReal($value)}}</td>
                                <td>R$ {{setReal($freight)}}</td>
                                <td>R$ {{setReal($value+$freight)}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <form id="form-pagseguro">
                        @csrf
                        <div class="col-md-6" style="margin-top: 10px" >
                            <label>Número do Cartão<span class="required">*</span></label>
                            <span class="card-number">
                                <input type="text" class="input-text" placeholder="0000 0000 0000 0000" name="cardNumber" id="cardNumber" value="4111111111111111" size="19" style="width: 160px" />
                            </span>
                            <span id="img_brand"></span>
                        </div>
                        <div class="col-md-3" style="margin-top: 10px">
                            <label>Expiração <span class="required">*</span></label>
                            <select name="cardExpiryMonth" id="cardExpiryMonth" class="select--epiry-month">
                                <option value="">Mês</option>
                                <option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option>
                            </select>
                        </div>
                        <div class="col-md-3" style="margin-top: 10px">
                            <label>Expiração <span class="required">*</span></label>
                            <select name="cardExpiryYear" id="cardExpiryYear" class="select--epiry-year">
                                <option value="2019">2019</option><option value="2020">2020</option><option value="2021">2021</option><option value="2022">2022</option><option value="2023">2023</option><option value="2024">2024</option><option value="2025">2025</option><option value="2026">2026</option><option value="2027">2027</option><option value="2028">2028</option><option value="2029">2029</option><option value="2030" selected>2030</option><option value="2031">2031</option><option value="2032">2032</option><option value="2033">2033</option><option value="2034">2034</option><option value="2035">2035</option><option value="2036">2036</option><option value="2037">2037</option><option value="2038">2038</option>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <p style="margin-top: 10px">
                                <label id="label1">Parcelamento (Digite os dados do seu cartão) <span class="required">*</span></label>
                                <select name="installments" id="installments" class="select-installments" ></select>
                            </p>
                        </div>
                        <div class="col-md-4" style="margin-top: 10px">
                            <p>
                                <label>Código de Segurança <span class="required">*</span></label>
                                <span class="">
                                    <input type="text" placeholder="000" name="cardCVV" id="cardCVV" value="123" size="3" class="in" style="width: 60px"/>
                                </span>
                                <a href="javascript:void(0)" title="Os 3 últimos números atrás do cartão"><i class="fa fa-question-circle"></i></a>
                                <span style="margin-left: 10px"><img src="{{asset('themes/images/payment/securitycode.gif')}}" /></span>
                            </p>
                        </div>
                        <div class="col-md-12" style="margin-top: 10px">
                            <p class="form-row form-row-wide">
                                <input type="radio" class="other_holder input-radio" id="holder_1" name="holder" value="1" checked /> <b>Sou o titular do cartão</b>
                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                <input type="radio" class="other_holder input-radio" id="holder_2" name="holder" value="2" /> <b>Outro Titular</b>
                            </p>
                        </div>
                        <div class="col-md-12">
                            <p>
                                <label>Nome (Exatamente como impresso no cartão) <span class="required">*</span></label>
                                <span class="holder_name">
                                   <input type="text" name="holderName" id="holderName" value="José Comprador" size="40" class="input-text"/>
                               </span>
                            </p>
                        </div>
                        <div  id="card-holder" style="display:none">
                            <div class="col-md-6">
                                <label>Tipo de documento <span class="required">*</span></label>
                                <p class="form-row form-row-wide">
                                    <input type="radio" class="doc_type_cpf input-radio" id="doc_type_1" name="doc_type" value="2" checked /> <b>CPF</b>
                                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <input type="radio" class="doc_type_cnpj input-radio" id="do_type_2" name="doc_type" value="1" /> <b>CNPJ</b>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="holder_cpf">
                                    <label>CPF <span class="required">*</span></label>
                                    <span>
                                       <input type="text" name="holderCPF" id="holderCPF" value="" class="input-text"/>
                                   </span>
                                </p>
                                <p class="holder_cnpj">
                                    <label>CNPJ <span class="required">*</span></label>
                                    <span >
                                       <input type="text" name="holderCNPJ" id="holderCNPJ" value="" class="input-text"/>
                                   </span>
                                </p>

                            </div>
                            <div class="col-md-6">
                                <p>
                                    <label>Data de Nascimento <span class="required">*</span></label>
                                    <span class="holder_birth_date">
                                       <input type="text" name="holderBirthDate" id="holderBirthDate" value="" size="40" class="input-text"/>
                                   </span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p>
                                    <label>DDD com telefone<span class="required">*</span></label>
                                    <span class="holder_phone">
                                       <input type="text" name="holderPhone" id="holderPhone" value="" size="40" class="input-text"/>
                                   </span>
                                </p>
                            </div>
                        </div>

                        <input type="hidden" name="brandName" value="" />
                        <input type="hidden" name="cardToken" value="" />
                        <input type="hidden" id="senderHash" name="senderHash" value="" />
                        <input type="hidden" id="company_name" name="company_name" value="{{$company_name}}" />
                        <input type="hidden" id="shipping_method" name="shipping_method" value="{{$shipping_method}}" />
                        <input type="hidden" id="payment_method" name="payment_method" value="{{$payment_method}}" />
                        <input type="hidden" id="order_comments" name="order_comments" value="{{$order_comments}}" />
                        <input type="hidden" id="indicate" name="indicate" value="{{$indicate}}" />
                        <input type="hidden" id="name" name="name" value="{{$name}}" />
                        <input type="hidden" id="phone" name="phone" value="{{$phone}}" />
                        <input type="hidden" id="freight" name="freight" value="{{$freight}}" />
                        <input type="hidden" id="price" name="price" value="{{$price}}" />
                        <input type="hidden" id="amount" name="amount" value="{{$value+$freight}}" />
                        <input type="hidden" id="extraAmount" name="extraAmount" value="{{$extraAmount}}" />
                        <input type="hidden" id="maxInstallment" name="maxInstallment" value="{{$maxInstallment}}" />
                    </form>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div id="return-payment" class="woocommerce-notices-wrapper" style="display: none"></div>
                    </div>
                    <div class="col-md-4 text-right">
                        <p>
                            <button type="button" value="{{constLang('messages.payments.btn_card')}}" class="btn-payment-card btn btn-color-primary">{{constLang('messages.payments.btn_card')}}</button>
                        </p>
                    </div>
                    <div class="col-md-12">
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
<script type="text/javascript" src="{{asset('plugins/pagseguro/payment.min.js')}}?{{time()}}"></script>
<script type="text/javascript" src="{{asset('plugins/jquery-maskedinput/jquery.maskedinput.min.js')}}"></script>
<script type='text/javascript'>
    jQuery( document ).ready(function($) {
        $("#cardNumber").mask('9999 9999 9999 9999');
        $("#holderCPF").mask('999.999.999-99');
        $("#holderCNPJ").mask('99.999.999/9999-99');
        $("#holderBirthDate").mask('99/99/9999');
        $("#holderPhone").mask('(99)9999-9999?9');
        $("#cardExpiryMonth").mask('99');
        $("#cardExpiryYear").mask('9999-9999?');
        $("#cardCVV").mask('999');
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

        $( ".other_holder" ).click(function() {
            $( "#card-holder" ).toggle( "show" );
        });

        $( ".doc_type" ).click(function() {
            $( "#holderType" ).toggle( "show" );
        });


        $('#card-holder').hide();
        $('.holder_cnpj').hide();

        $('.doc_type_cpf, .doc_type_cnpj').on('click',function(){
                $('.holder_cpf, .holder_cnpj').toggle()
            }
        );
    });
</script>
