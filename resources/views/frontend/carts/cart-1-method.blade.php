<div class="cart_totals calculated_shipping">
    <h2>Total do carrinho</h2>
    <table cellspacing="0" class="shop_table shop_table_responsive">
        <tr class="cart-subtotal">
            <th>Subtotal</th>
            <td data-title="Subtotal">
                <span class="woocommerce-Price-amount amount">
                    <span class="woocommerce-Price-currencySymbol">R$ </span>47,00
                </span>
            </td>
        </tr>

        <tr class="woocommerce-shipping-totals shipping">
            <th>Frete</th>
            <td data-title="Frete">
                <ul id="shipping_method" class="woocommerce-shipping-methods">
                    <li>
                        <input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_legacy_flat_rate" value="legacy_flat_rate" class="shipping_method" @if($method == 'legacy_flat_rate') checked="checked" @endif />
                        <label for="shipping_method_0_legacy_flat_rate">Taxa fixa:
                            <span class="woocommerce-Price-amount amount">
                                <span class="woocommerce-Price-currencySymbol">R$ </span>12.00
                            </span>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_legacy_free_shipping" value="legacy_free_shipping" class="shipping_method" @if($method == 'legacy_free_shipping') checked="checked" @endif />
                        <label for="shipping_method_0_legacy_free_shipping">Frete grátis:
                            <span class="woocommerce-Price-amount amount">
                                <span class="woocommerce-Price-currencySymbol">R$ </span>0.00
                            </span>
                        </label>
                    </li>
                    <li>
                        <input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_legacy_local_delivery" value="legacy_local_delivery" class="shipping_method" @if($method == 'legacy_local_delivery') checked="checked" @endif />
                        <label for="shipping_method_0_legacy_local_delivery">Entrega local:
                            <span class="woocommerce-Price-amount amount">
                                <span class="woocommerce-Price-currencySymbol">R$ </span>0.00
                            </span>
                        </label>
                    </li>
                </ul>
                <p class="woocommerce-shipping-destination">
                    Estimativa para <strong>Brasil</strong>.
                </p>

                <form class="woocommerce-shipping-calculator" action="{{route('cart.shipping')}}" method="post">

                    <a href="#" class="shipping-calculator-button">Calcular Frete</a>
                    <section class="shipping-calculator-form" style="display:none;">

                        <p class="form-row form-row-wide hide" id="calc_shipping_country_field">
                            <select name="calc_shipping_country" id="calc_shipping_country" class="country_to_state country_select" rel="calc_shipping_state">
                                <option value="BR" selected>Brasil</option>
                            </select>
                        </p>

                        <p class="form-row form-row-wide" id="calc_shipping_state_field">
                            <span>
                                <select name="calc_shipping_state" class="state_select" id="calc_shipping_state" placeholder="Estado">
                                    <option value="">Selecione o Estado</option>
                                    <option value="AC">Acre</option>
                                    <option value="AL">Alagoas</option>
                                    <option value="AP">Amapá</option>
                                    <option value="AM">Amazonas</option>
                                    <option value="BA">Bahia</option>
                                    <option value="CE">Ceará</option>
                                    <option value="DF">Distrito Federal</option>
                                    <option value="ES">Espírito Santo</option>
                                    <option value="GO">Goiás</option>
                                    <option value="MA">Maranhão</option>
                                    <option value="MT">Mato Grosso</option>
                                    <option value="MS">Mato Grosso do Sul</option>
                                    <option value="MG">Minas Gerais</option>
                                    <option value="PA">Pará</option>
                                    <option value="PB">Paraíba</option>
                                    <option value="PR">Paraná</option>
                                    <option value="PE">Pernambuco</option>
                                    <option value="PI">Piauí</option>
                                    <option value="RJ">Rio de Janeiro</option>
                                    <option value="RN">Rio Grande do Norte</option>
                                    <option value="RS">Rio Grande do Sul</option>
                                    <option value="RO">Rondônia</option>
                                    <option value="RR">Roraima</option>
                                    <option value="SC">Santa Catarina</option>
                                    <option value="SP">São Paulo</option>
                                    <option value="SE">Sergipe</option>
                                    <option value="TO">Tocantins</option>
                                </select>
                            </span>
                        </p>
                        <p class="form-row form-row-wide" id="calc_shipping_city_field">
                            <input type="text" class="input-text" value="" placeholder="Cidade" name="calc_shipping_city" id="calc_shipping_city" />
                        </p>

                        <p class="form-row form-row-wide" id="calc_shipping_postcode_field">
                            <input type="text" class="input-text" value="" placeholder="CEP" name="calc_shipping_postcode" id="calc_shipping_postcode" />
                        </p>

                        <p><button type="submit" name="calc_shipping" value="1" class="button">Atualizar</button></p>
                        <input type="hidden" id="woocommerce-shipping-calculator-nonce" name="woocommerce-shipping-calculator-nonce" value="6cedcff10b" />
                        <input type="hidden" name="_http_referer" value="cart" />
                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    </section>
                </form>

            </td>
        </tr>

        <tr class="order-total">
            <th>Total</th>
            <td data-title="Total">
                <strong>
                    <span class="woocommerce-Price-amount amount">
                        <span class="woocommerce-Price-currencySymbol">R$ </span>50,00
                    </span>
                </strong>
            </td>
        </tr>
    </table>

    <div class="wc-proceed-to-checkout">
        <a href="#" class="checkout-button button alt wc-forward">Finalizar Pedido</a>
    </div>
</div>
