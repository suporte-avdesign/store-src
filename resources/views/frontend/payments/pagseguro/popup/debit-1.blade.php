<div class="vc_row wpb_row vc_inner vc_row-fluid avd_custom_popup_payment vc_row-o-equal-height vc_row-flex">
    <div class="wpb_column vc_column_container vc_col-sm-8">
        <div class="vc_column-inner avd_custom_popup_payment_inner">
            <div class="wpb_wrapper">
                <div class="title-wrapper  basel-title-color-default basel-title-style-default basel-title-size-small text-left ">
                    <div class="images">

                        <img id="visa" src="{{asset('themes/images/payment/visa.gif')}}" alt="Visa" />
                        <img id="mastercard" src="{{asset('themes/images/payment/master.gif')}}" alt="Mastercard" />
                    </div>
                    <div class="liner-continer" style="margin-top: 10px"> <span class="left-line"></span>
                        <h4 class="title"> {{constLang('messages.payments.title_debit')}}
                            <span class="title-separator"><span></span></span>
                        </h4>
                        <span class="right-line"></span>
                    </div>
                </div>
                <div role="form" class="wpcf7" id="wpcf7-f20165-p29276-o1" lang="en-US" dir="ltr">
                    <div class="screen-reader-response"></div>
                    <form action="" method="post" class="form">
                            <input type="hidden" name="_wpcf7" value="20165" />
                    </form>

                        <div class="row">
                            <div class="col-md-6">
                                <label>Número do Cartão</label>
                                <span class="card-number">
                                    <input type="text" class="input-text" placeholder="0000 0000 0000 0000" name="cardNumber" id="cardNumber" value="" size="19" style="width: 160px"/>
                                </span>
                                <span id="cart-setected"></span>
                            </div>

                            <div class="col-md-3">
                                <label>Ano de expiração</label>
                                <select name="cardExpiryMonth" id="cardExpiryMonth" autocomplete="off" class="state_select">
                                    <option value="01" selected>01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Mês de expiração</label>
                                <select name="cardExpiryYear" id="cardExpiryYear" autocomplete="off" class="">
                                    <option value="2019">2019</option><option value="2020">2020</option><option value="2021">2021</option><option value="2022">2022</option><option value="2023">2023</option><option value="2024">2024</option><option value="2025">2025</option><option value="2026">2026</option><option value="2027">2027</option><option value="2028">2028</option><option value="2029">2029</option><option value="2030">2030</option><option value="2031">2031</option><option value="2032">2032</option><option value="2033">2033</option><option value="2034">2034</option><option value="2035">2035</option><option value="2036">2036</option><option value="2037">2037</option><option value="2038">2038</option>
                                </select>

                            </div>

                            <div class="col-md-8">
                                <p style="margin-top: 30px">
                                <label>Nome completo (Exatamente como impresso no cartão)</label>

                                   <span class="wpcf7-form-control-wrap your-email">
                                       <input type="text" value="" size="40" class="input-text" required/>
                                   </span>
                                </p>
                            </div>
                            <div class="col-md-4">
                                <p style="margin-top: 30px">
                                <label>Código de Segurança</label>
                                    <span class="">
                                        <input type="text" placeholder="000" name="cardCVV" id="cardCVV" value="" size="3" class="in" style="width: 60px" />
                                    </span>
                                    <a href="javascript:void(0)" title="Os 3 últimos números atrás do cartão"><i class="fa fa-question-circle"></i></a>
                                    <span style="margin-left: 10px"><img src="{{asset('themes/images/payment/securitycode.gif')}}" /></span>
                                </p>
                            </div>

                        </div>
                        <div class="text-right">
                            <input type="submit" value="PAGAR" class="wpcf7-form-control wpcf7-submit btn btn-color-primary" />
                        </div>

                        <div class="footer-payment-card">

                            <p class="payment-look text-left">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"width="30" height="30" viewBox="0 0 172 172" style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#666666"><path d="M86,11.46667c-22.09818,0 -40.13333,18.03515 -40.13333,40.13333v11.46667h-11.46667c-6.33533,0 -11.46667,5.13133 -11.46667,11.46667v68.8c0,6.33533 5.13133,11.46667 11.46667,11.46667h49.19245l32.68672,-52.26067c3.268,-5.49827 9.21777,-8.90235 15.5875,-8.90235c6.36973,0 12.32523,3.40981 15.5875,8.90235l1.6125,2.58672v-30.59271c0,-6.33533 -5.13133,-11.46667 -11.46667,-11.46667h-11.46667v-11.46667c0,-21.37626 -16.99027,-38.59356 -38.09531,-39.71901c-0.64841,-0.26118 -1.33911,-0.4016 -2.03802,-0.41432zM86,22.93333c15.90235,0 28.66667,12.76431 28.66667,28.66667v11.46667h-57.33333v-11.46667c0,-15.90235 12.76431,-28.66667 28.66667,-28.66667zM131.85547,105.10364c-2.48253,0 -4.61999,1.37511 -5.77813,3.38177l-33.24661,53.14531c-0.688,1.06067 -1.09739,2.31412 -1.09739,3.67292c0,3.698 2.99836,6.69636 6.69636,6.69636h33.43698h33.43698c3.698,0 6.69636,-2.99836 6.69636,-6.69636c0,-1.3588 -0.40912,-2.61225 -1.10859,-3.67292l-33.24662,-53.14531c-1.1524,-2.00667 -3.30679,-3.38177 -5.78932,-3.38177zM126.13333,126.13333h11.46667l-0.94062,22.93333h-9.57422zM131.88906,152.50442c3.57187,0 5.71094,1.91637 5.71094,5.19583c0,3.22213 -2.14481,5.12865 -5.71094,5.12865c-3.60053,0 -5.75573,-1.90652 -5.75573,-5.12865c0,-3.27947 2.15519,-5.19583 5.75573,-5.19583z"></path></g></g></svg>
                                Você está em um ambiente seguro
                            </p>
                        </div>


                        <div class="wpcf7-response-output wpcf7-display-none"></div>

                </div>
            </div>
        </div>
    </div>

    @include('frontend.payments.pagseguro.contacts-1')

</div>

@include('frontend.scripts._pagSeguroSettings')

<script type="text/javascript" src="{{asset('plugins/jquery-maskedinput/jquery.maskedinput.min.js')}}"></script>
<script type="text/javascript" src="{{asset('themes/js/functions.min.js')}}"></script>
<script type='text/javascript'>
    jQuery( document ).ready(function($) {
        $("#cardNumber").mask('9999 9999 9999 9999');
        $("#cardExpiryMonth").mask('99');
        $("#cardExpiryYear").mask('9999');
        $("#cardCVV").mask('999');
    });
</script>