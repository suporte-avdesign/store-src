<div id="payment" class="woocommerce-checkout-payment">
    @if(is_string($freight->error))
        <div class="woocommerce-notices-wrapper">
            <ul class="woocommerce-error" role="alert">
                <li>{{$freight->error}}</li>
            </ul>
        </div>
    @else
        <ul class="wc_payment_methods payment_methods methods">
            @foreach($configPayment as $payment)
                @if($payment->method == 'cash')
                    <li class="wc_payment_method payment_method_cash">
                        <input id="payment_method_cash" type="radio" class="input-radio" name="payment_method" value="{{$payment->method}}" @if($payment_selected == $payment->method) checked="checked" @endif data-order_button_text=""/>
                        <label for="payment_method_cash">{{$payment->label}}</label>
                        <div class="payment_box payment_method_cash" >
                            <p>{{$payment->description}}</p>
                        </div>
                    </li>
                @elseif($payment->method == 'billet')
                    <li class="wc_payment_method payment_method_billet">
                        <input id="payment_method_billet" type="radio" class="input-radio" name="payment_method" value="{{$payment->method}}" @if($payment_selected == $payment->method) checked="checked" @endif data-order_button_text=""/>
                        <label for="payment_method_billet">{{$payment->label}}</label>
                        <div class="payment_box payment_method_billet" style="display:none;">
                            <p>{{$payment->description}}</p>
                        </div>
                    </li>
                @elseif($payment->method == 'credit')
                    <li class="wc_payment_method payment_method_credit">
                        <input id="payment_method_credit" type="radio" class="input-radio" name="payment_method" value="{{$payment->method}}" @if($payment_selected == $payment->method) checked="checked" @endif data-order_button_text=""/>
                        <label for="payment_method_credit">{{$payment->label}}</label>
                        <div class="payment_box payment_method_credit" style="display:none;">
                            <p>{{$payment->description}}</p>
                        </div>
                    </li>
                @elseif($payment->method == 'debit')
                    <li class="wc_payment_method payment_method_debit">
                        <input id="payment_method_debit" type="radio" class="input-radio" name="payment_method" value="{{$payment->method}}" @if($payment_selected == $payment->method) checked="checked" @endif data-order_button_text=""/>
                        <label for="payment_method_debit">{{$payment->label}}</label>
                        <div class="payment_box payment_method_debit" style="display:none;">
                            <p>{{$payment->description}}</p>
                        </div>
                    </li>
                @endif


            @endforeach
        </ul>
        <div class="form-row place-order">
            <noscript>
                Como o seu navegador não suporta JavaScript ou está desativado, certifique-se de clicar no botão abaixo antes de colocar a sua encomenda. Você pode ser cobrado mais do que o valor indicado acima, se você não o fizer.
                <br/>
                <button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="Update totals">Atualizar Total</button>
            </noscript>

            <div class="woocommerce-terms-and-conditions-wrapper">
                <div class="woocommerce-privacy-policy-text">
                    <p>Seus dados pessoais serão usados ​​para processar seu pedido, apoiar sua experiência em todo o site e para outros fins descritos em nossa
                        <a href="#" class="woocommerce-privacy-policy-link" target="_blank">política de privacidade</a>.
                    </p>
                </div>
                <div class="woocommerce-terms-and-conditions" style="display: none; max-height: 200px; overflow: auto;">
                    @foreach($termsConditions as $terms)
                        <h4>{{$terms->title}}</h4>
                        {!! $terms->description !!}
                    @endforeach
                </div>
                <p class="form-row validate-required">
                    <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                        <input type="checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" name="terms[conditions]"  id="terms"/>
                        <span class="woocommerce-terms-and-conditions-checkbox-text">Li e aceito os
                            <a href="#" class="woocommerce-terms-and-conditions-link" target="_blank">termos e condições</a> do site
                        </span>
                        <span class="required"> *</span>
                    </label>
                    <input type="hidden" name="terms-field" value="1" />
                </p>
            </div>

            <button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="Finalizar Pedido" data-value="Finalizar Pedido">Finalizar Pedido</button>
            <input type="hidden" name="http_referer" value="checkout"/>
        </div>
   @endif

</div>


