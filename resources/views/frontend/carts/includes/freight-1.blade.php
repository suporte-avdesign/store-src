<tr class="woocommerce-shipping-totals shipping">
    <th>{{constLang('messages.shipping.freight')}}</th>
    <td data-title="{{constLang('messages.shipping.freight')}}">
        <ul id="shipping_method" class="woocommerce-shipping-methods">
            <li>
                <input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_legacy_flat_rate" value="legacy_flat_rate" class="shipping_method"  checked="checked"/>
                <label for="shipping_method_0_legacy_flat_rate">Taxa fixa:
                    <span class="woocommerce-Price-amount amount">
                        <span class="woocommerce-Price-currencySymbol">R$ </span>12.00
                    </span>
                </label>
            </li>
            <li>
                <input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_legacy_free_shipping" value="legacy_free_shipping" class="shipping_method"/>
                <label for="shipping_method_0_legacy_free_shipping">Frete grátis:
                    <span class="woocommerce-Price-amount amount">
                        <span class="woocommerce-Price-currencySymbol">R$ </span>0.00
                    </span>
                </label>
            </li>
            <li>
                <input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_legacy_local_delivery" value="legacy_local_delivery" class="shipping_method"/>
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
                            <option value="">{{constLang('select_state')}}</option>
                            @foreach($states as $state)
                                <option value="{{$state->uf}}">{{$state->name}}</option>
                            @endforeach
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
                <input type="hidden" name="_wp_http_referer" value="/basel/cart/" />
                <input type="hidden" name="_token" value="{{csrf_token()}}" />
            </section>
        </form>

    </td>
</tr>