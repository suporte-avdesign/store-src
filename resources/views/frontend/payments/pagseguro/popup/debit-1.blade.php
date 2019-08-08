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
    <div class="wpb_column vc_column_container vc_col-sm-4 vc_col-has-fill">
        <div class="vc_column-inner avd_custom_popup_payment_inner_info">
            <div class="wpb_wrapper">
                <div class="title-wrapper  basel-title-color-white basel-title-style-default basel-title-size-small text-left ">
                    <div class="liner-continer"> <span class="left-line"></span>
                        <h4 class="title">{{strtoupper(constLang('contacts'))}}
                            <span class="title-separator"><span></span></span>
                        </h4>
                        <span class="right-line"></span>
                    </div>
                </div>
                <div class=" basel-info-box2 text-left icon-alignment-left box-style-base color-scheme-light  with-animation " onclick="">
                    <div class="box-icon-wrapper">
                        <div class="info-box-icon">
                            <div class="info-svg-wrapper" style="width: 30px;height: 30px;">
                                <svg version="1.1" id="svg-5711" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="64px" height="64px" viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve"><g><rect x="1" y="13" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-miterlimit="10" width="62" height="37" /><polyline fill="none" stroke="#FFFFFF" stroke-width="2" stroke-miterlimit="10" points="1,13 32,33 63,13" /></g></svg>
                            </div>
                        </div>
                    </div>
                    <div class="info-box-content">
                        <div class="info-box-inner">
                            <p>
                                {{config('company.address')}}<br>
                                {{config('company.distric')}}<br>
                                {{config('company.city')}} - {{config('company.state')}}
                            </p>
                        </div>
                    </div>
                </div>
                <div class=" basel-info-box2 text-left icon-alignment-left box-style-base color-scheme-light  with-animation " onclick="">
                    <div class="box-icon-wrapper">
                        <div class="info-box-icon">
                            <div class="payment-contact info-svg-wrapper" style="width: 30px;height: 30px;">
                                <svg version="1.1" id="svg-8840" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="64px" height="64px" viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve"><g><path fill="none" stroke="#FFFFFF" stroke-width="2" stroke-miterlimit="10" d="M53.92,10.081c12.107,12.105,12.107,31.732,0,43.838c-12.106,12.108-31.734,12.108-43.84,0c-12.107-12.105-12.107-31.732,0-43.838C22.186-2.027,41.813-2.027,53.92,10.081z" /><polyline fill="none" stroke="#FFFFFF" stroke-width="2" stroke-miterlimit="10" points="32,12 32,32 41,41" /><line fill="none" stroke="#FFFFFF" stroke-width="2" stroke-miterlimit="10" x1="4" y1="32" x2="8" y2="32" /><line fill="none" stroke="#FFFFFF" stroke-width="2" stroke-miterlimit="10" x1="56" y1="32" x2="60" y2="32" /><line fill="none" stroke="#FFFFFF" stroke-width="2" stroke-miterlimit="10" x1="32" y1="60" x2="32" y2="56" /><line fill="none" stroke="#FFFFFF" stroke-width="2" stroke-miterlimit="10" x1="32" y1="8" x2="32" y2="4" /></g></svg>
                            </div>
                        </div>
                    </div>
                    <div class="info-box-content">
                        <div class="info-box-inner">
                            <p>
                                {{config('company.monday_to_friday')}}<br>
                                {{config('company.monday_to_friday_horary')}}<br>
                                {{config('company.saturday')}}<br>
                                {{config('company.saturday_horary')}}
                            </p>
                        </div>
                    </div>
                </div>
                <div class=" basel-info-box2 text-left icon-alignment-left box-style-base color-scheme-light  with-animation " onclick="">
                    <div class="box-icon-wrapper">
                        <div class="info-box-icon">
                            <div class="info-svg-wrapper" style="width: 30px;height: 30px;">
                                <svg version="1.1" id="svg-8433" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="64px" height="64px" viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve"><polygon fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linejoin="bevel" stroke-miterlimit="10" points="1,30 63,1 23,41" /><polygon fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linejoin="bevel" stroke-miterlimit="10" points="34,63 63,1 23,41" /></svg>
                            </div>
                        </div>
                    </div>
                    <div class="info-box-content">
                        <div class="info-box-inner">
                            <p>
                                <a href="{{route('contact')}}" target="_blank">{{config('company.email')}}</a><br>
                            </p>
                        </div>
                    </div>
                </div>
                <div class=" basel-info-box2 text-left icon-alignment-left box-style-base color-scheme-light  with-animation " onclick="">
                    <div class="info-box-icon">
                        <div class="info-svg-wrapper" style="width: 30px;height: 30px;"></div>
                    </div>
                    <div class="info-box-content">
                        <div class="info-box-inner">
                            <p>
                                {{config('company.phone')}} / {{config('company.phone2')}}<br>
                                {{config('company.whatsapp')}}<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"width="32" height="32"viewBox="0 0 172 172"style=" fill:#000000;"><g fill="none" fill-rule="none" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none" fill-rule="nonzero"></path><g fill="#ffffff" fill-rule="evenodd"><g id="surface1"><path d="M131.70849,40.33349c-12.13574,-12.13574 -28.26074,-18.83349 -45.43555,-18.83349c-35.39941,0 -64.22705,28.80664 -64.22705,64.20606c-0.021,11.31689 2.93945,22.36084 8.56641,32.10303l-9.11231,33.27881l34.05567,-8.94433c9.36426,5.12305 19.94629,7.81055 30.69629,7.83154h0.02099c35.39942,0 64.20606,-28.80664 64.22705,-64.22705c0,-17.15381 -6.67676,-33.27881 -18.79151,-45.41455zM86.27295,139.12012h-0.02099c-9.57422,0 -18.98047,-2.58252 -27.16894,-7.43262l-1.95264,-1.15479l-20.21923,5.29102l5.39599,-19.69433l-1.25977,-2.01562c-5.35401,-8.50342 -8.16748,-18.32959 -8.16748,-28.40771c0,-29.41553 23.95654,-53.35108 53.41406,-53.35108c14.25634,0 27.65185,5.56397 37.72998,15.64209c10.07813,10.09912 15.62109,23.49462 15.62109,37.75097c0,29.43653 -23.95654,53.37207 -53.37207,53.37207zM115.54151,99.14356c-1.5957,-0.79785 -9.49023,-4.68213 -10.95996,-5.20703c-1.46972,-0.5459 -2.54053,-0.79785 -3.61133,0.79785c-1.0708,1.6167 -4.13623,5.22803 -5.08105,6.29883c-0.92383,1.04981 -1.86865,1.19678 -3.46435,0.39893c-1.6167,-0.79785 -6.78174,-2.49854 -12.9126,-7.97852c-4.76611,-4.24121 -7.99951,-9.51123 -8.92334,-11.10693c-0.94483,-1.6167 -0.10498,-2.47754 0.69287,-3.27539c0.73486,-0.71387 1.6167,-1.86866 2.41455,-2.81348c0.79785,-0.92383 1.0708,-1.5957 1.6167,-2.66651c0.5249,-1.0708 0.25195,-2.01562 -0.14697,-2.81347c-0.39893,-0.79785 -3.61133,-8.71338 -4.95508,-11.92578c-1.30176,-3.12842 -2.62451,-2.6875 -3.61133,-2.75049c-0.92383,-0.04199 -1.99463,-0.04199 -3.06543,-0.04199c-1.0708,0 -2.81348,0.39892 -4.2832,2.01563c-1.46973,1.5957 -5.60596,5.47998 -5.60596,13.37451c0,7.89453 5.75293,15.53711 6.55078,16.60791c0.79785,1.0498 11.3169,17.25879 27.4209,24.20849c3.82129,1.65869 6.80273,2.64551 9.1333,3.38037c3.84229,1.21778 7.34864,1.04981 10.12012,0.65088c3.08642,-0.46192 9.49023,-3.88428 10.83398,-7.64258c1.32275,-3.73731 1.32275,-6.94971 0.92383,-7.62158c-0.39893,-0.67187 -1.46973,-1.0708 -3.08643,-1.88965z"></path></g></g></g></svg>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
