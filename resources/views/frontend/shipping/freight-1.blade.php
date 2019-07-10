<tr class="woocommerce-shipping-totals shipping">
    <th>{{constLang('messages.shipping.freight')}}</th>
    <td data-title="{{constLang('messages.shipping.freight')}}">

        <form class="woocommerce-shipping-calculator" action="{{route('shipping.calculator')}}" method="post">
            @csrf
            <ul id="shipping_method" class="woocommerce-shipping-methods">
                @foreach($configShipping as $method)

                    <li>
                        <input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_legacy_flat_rate" value="{{$method->id}}" class="shipping_method" @if($loop->first) checked @endif/>
                        @if($method->tax_unique != '0.00')
                            <label for="shipping_method_0_legacy_flat_rate">{{$method->name}}</span> {{constLang('currency')}} {{setReal($method->tax_unique)}}</label>
                            <p>{{$method->description}}</p>
                        @elseif($method->tax == 0)
                            <label for="shipping_method_0_legacy_flat_rate">{{$method->name}}</span> {{constLang('currency')}} 0,00</label>
                        @else
                            <label for="shipping_method_0_legacy_flat_rate">{{$method->name}}</span> </label>
                        @endif
                    </li>
                @endforeach
            </ul>
            <p class="woocommerce-shipping-destination">
                <strong>{{constLang('messages.shipping.send_text')}}</strong>.
            </p>
            <p><button type="button" class="shipping-calculator-button btn-color-black">Calcular Frete</button></p>



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
                <input type="hidden" id="woocommerce-shipping-calculator-nonce" name="woocommerce-shipping-calculator-nonce" value="{{numLetter('cart_'.time(),'leter')}}" />
                <input type="hidden" name="http_referer" value="{{route('cart')}}" />
            </section>
        </form>

    </td>
</tr>