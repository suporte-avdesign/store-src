<div class="vc_row wpb_row vc_inner vc_row-fluid avd_custom_popup_payment vc_row-o-equal-height vc_row-flex">
    <div class="wpb_column vc_column_container vc_col-sm-8">
        <div class="vc_column-inner avd_custom_popup_payment_inner">
            <div class="wpb_wrapper">
                <div class="title-wrapper  basel-title-color-default basel-title-style-default basel-title-size-small text-left ">

                    <form id="form-pagseguro" class="form">
                        @csrf
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
                        <input type="hidden" id="value" name="value" value="{{$value}}" />
                        <input type="hidden" id="extraAmount" name="extraAmount" value="{{$extraAmount}}" />
                    </form>

                </div>
                <div id="div-billet" lang="pt-BR">
                    <div class="screen-reader-response"></div>

                    <div class="row">
                        <div class="col-md-3">
                            <img  src="{{asset('themes/images/payment/icon-pag-boleto.png')}}" alt="{{constLang('messages.payments.title_billet')}}" width="200px">
                        </div>
                        <div class="col-md-9">
                            <div class="info">
                                <table style="margin-bottom: 10px">
                                    <thead>
                                    <tr>
                                        <th>Pedido</th>
                                        <th>Frete</th>
                                        <th>Total</th>
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
                                <ul>
                                    <li><strong>Data de vencimento:</strong> verifique a data de vencimento do boleto, que é de 3 dias úteis após ser gerado. Caso o pagamento não seja realizado dentro desse prazo, o boleto perderá sua validade e o pedido será cancelado. IMPORTANTE: Se a data do vencimento for em um domingo, você poderá realizar o pagamento no próximo dia útil. </li>
                                    <li><strong>Prazo de entrega</strong>: é contado a partir do momento em que seu pedido é postado nos Correios.</li>
                                    <li><strong>Pagamento:</strong> pode ser feito pela internet ou telefone, utilizando o código de barras, ou diretamente em bancos, lotéricas e correios, apresentando o boleto impresso.</li>
                                </ul>
                                <strong>Atenção:</strong>
                                <ul>
                                    <li>Não será enviado uma cópia impressa do boleto para seu endereço.</li>
                                    <li>Desabilite o recurso anti pop-up caso você use.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div id="return-payment" class="woocommerce-notices-wrapper" style="display: none"></div>
                    </div>

                    <br>

                    <div class="text-right">
                        <p>
                            <button type="button" value="{{constLang('messages.payments.btn_billet')}}" class="btn-payment-billet btn btn-color-primary">{{constLang('messages.payments.btn_billet')}}</button>
                        </p>
                    </div>

                    <div class="footer-payment-card">

                        <p class="payment-look text-left">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"width="30" height="30" viewBox="0 0 172 172" style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#666666"><path d="M86,11.46667c-22.09818,0 -40.13333,18.03515 -40.13333,40.13333v11.46667h-11.46667c-6.33533,0 -11.46667,5.13133 -11.46667,11.46667v68.8c0,6.33533 5.13133,11.46667 11.46667,11.46667h49.19245l32.68672,-52.26067c3.268,-5.49827 9.21777,-8.90235 15.5875,-8.90235c6.36973,0 12.32523,3.40981 15.5875,8.90235l1.6125,2.58672v-30.59271c0,-6.33533 -5.13133,-11.46667 -11.46667,-11.46667h-11.46667v-11.46667c0,-21.37626 -16.99027,-38.59356 -38.09531,-39.71901c-0.64841,-0.26118 -1.33911,-0.4016 -2.03802,-0.41432zM86,22.93333c15.90235,0 28.66667,12.76431 28.66667,28.66667v11.46667h-57.33333v-11.46667c0,-15.90235 12.76431,-28.66667 28.66667,-28.66667zM131.85547,105.10364c-2.48253,0 -4.61999,1.37511 -5.77813,3.38177l-33.24661,53.14531c-0.688,1.06067 -1.09739,2.31412 -1.09739,3.67292c0,3.698 2.99836,6.69636 6.69636,6.69636h33.43698h33.43698c3.698,0 6.69636,-2.99836 6.69636,-6.69636c0,-1.3588 -0.40912,-2.61225 -1.10859,-3.67292l-33.24662,-53.14531c-1.1524,-2.00667 -3.30679,-3.38177 -5.78932,-3.38177zM126.13333,126.13333h11.46667l-0.94062,22.93333h-9.57422zM131.88906,152.50442c3.57187,0 5.71094,1.91637 5.71094,5.19583c0,3.22213 -2.14481,5.12865 -5.71094,5.12865c-3.60053,0 -5.75573,-1.90652 -5.75573,-5.12865c0,-3.27947 2.15519,-5.19583 5.75573,-5.19583z"></path></g></g></svg>
                            {{constLang('safe_environment')}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTACTS -->
    @include('frontend.payments.pagseguro.contacts-1')
</div>
@include('frontend.scripts._pagSeguroSettings')
<script src="{{config('pagseguro.url_transparent_js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/pagseguro/payment.min.js')}}?v=1"></script>





