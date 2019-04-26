<div id="payment" class="woocommerce-checkout-payment">
    <!-- PAYMENT -->
    <ul class="wc_payment_methods payment_methods methods">
        <li class="wc_payment_method payment_method_bacs">
            <input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="bacs"  checked='checked' data-order_button_text=""/>

            <label for="payment_method_bacs">Depósito em conta</label>
            <div class="payment_box payment_method_bacs" >
                <p>Faça seu pagamento diretamente em nossa conta bancária. Por favor, use o número do pedido como referência de pagamento. Seu pedido não será enviado até que os fundos sejam liberados em nossa conta.</p>
            </div>
        </li>
        <li class="wc_payment_method payment_method_cod">
            <input id="payment_method_cod" type="radio" class="input-radio" name="payment_method" value="cod"  data-order_button_text=""/>
            <label for="payment_method_cod">Cartão de Crédito em 3X sem juros</label>
            <div class="payment_box payment_method_cod" style="display:none;">
                <p>Seus dados pessoais serão usados ​​para processar seu pagamento</p>
            </div>
        </li>
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
            <div class="woocommerce-terms-and-conditions" style="display: none; max-height: 200px; overflow: auto;"><h4><b>Terms and Conditions</b></h4>
                <p>Texto 1</p>
                <p>Texto 2</p>
                <p>Texto 3</p>
            </div>
            <p class="form-row validate-required">
                <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                    <input type="checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" name="terms"  id="terms"/>
                    <span class="woocommerce-terms-and-conditions-checkbox-text">Li e aceito os
                        <a href="#" class="woocommerce-terms-and-conditions-link" target="_blank">termos e condições</a> do site
                    </span>
                    <span class="required"> *</span>
                </label>
                <input type="hidden" name="terms-field" value="1" />
            </p>
        </div>

        <button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="Finalizar Pedido" data-value="Finalizar Pedido">Finalizar Pedido</button>

        <input type="hidden" id="woocommerce-process-checkout-nonce" name="woocommerce-process-checkout-nonce" value="754af0147e" />
        <input type="hidden" name="_wp_http_referer" value="/basel/checkout/"/>
    </div>
</div>
