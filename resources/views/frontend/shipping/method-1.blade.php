<div class="cart_totals calculated_shipping">
    <h2>{{constLang('messages.cart.total')}}</h2>
    <table cellspacing="0" class="shop_table shop_table_responsive">
        <tr class="cart-subtotal">
            <th>{{constLang('subtotal')}}</th>
            <td data-title="{{constLang('subtotal')}}">
                <span class="woocommerce-Price-amount amount">
                    <span class="woocommerce-Price-currencySymbol">{{constLang('currency')}} </span>
                    {{setReal($total['price_cash'])}}
                </span>
            </td>
        </tr>
        <tr class="woocommerce-shipping-totals shipping">
            <th>{{constLang('messages.shipping.method')}}</th>
            <td data-title="{{constLang('messages.shipping.method')}}">
                <form class="woocommerce-shipping-calculator" action="{{route('shipping.calculator')}}" method="post">
                    @csrf
                    <ul id="shipping_method" class="woocommerce-shipping-methods">
                        @foreach($configShipping as $method)
                            @php
                                ($method->tax == 0 ? $in_store = 1 : $in_store = 0);
                            @endphp
                            <li>
                                <input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_legacy_flat_rate" value="{{$method->id}}" class="shipping_method" @if($method->id == $selected) checked @endif/>
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

                    @if($tax == '0.00')
                        <button type="button" class="shipping-calculator-button btn-color-black">
                            {{constLang('messages.shipping.freight_calculator')}}
                        </button>
                    @endif
                    <section class="shipping-calculator-form" style="display:none;">
                        <p class="form-row form-row-wide hide" id="calc_shipping_country_field">
                            <select name="calc_shipping_country" id="calc_shipping_country" class="country_to_state country_select" rel="calc_shipping_state">
                                <option value="BR" selected>Brasil</option>
                            </select>
                        </p>

                        <p class="form-row form-row-wide">
                            <input type="radio" class="input-radio" id="price_cash" name="price" value="price_cash" checked /> <b>{{constLang('cash')}}</b>
                            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <input type="radio" class="input-radio" id="price_card" name="price" value="price_card" /> <b>{{constLang('card')}}</b>
                        </p>


                        <p class="form-row form-row-wide" id="calc_shipping_state_field">
                    <span>
                        <select name="calc_shipping_state" class="state_select" id="calc_shipping_state" placeholder="{{constLang('state')}}">
                            <option value="">{{constLang('select_state')}}</option>
                            @foreach($states as $state)
                                <option value="{{$state->uf}}">{{$state->name}}</option>
                            @endforeach
                        </select>
                    </span>
                        </p>
                        <p class="form-row form-row-wide" id="calc_shipping_city_field">
                            <input type="text" class="input-text" value="" placeholder="{{constLang('city')}}" name="calc_shipping_city" id="calc_shipping_city" />
                        </p>

                        <p class="form-row form-row-wide" id="calc_shipping_postcode_field">
                            <input type="text" class="input-text" value="" placeholder="{{constLang('zip_code')}}" name="calc_shipping_postcode" id="calc_shipping_postcode" />
                        </p>

                        <p><button type="submit" name="calc_shipping" value="1" class="button">{{constLang('messages.shipping.update')}}</button></p>
                        <input type="hidden" id="woocommerce-shipping-calculator-nonce" name="woocommerce-shipping-calculator-nonce" value="{{numLetter('cart_'.time(),'leter')}}" />
                        <input type="hidden" name="http_referer" value="{{route('cart')}}" />
                        <div id="error-freight"></div>

                    </section>
                </form>
            </td>
        </tr>
        <tr class="order-total">
            <th>{{constLang('total')}}</th>
            <td data-title="{{constLang('total')}}">
                <strong>
                    <span class="woocommerce-Price-amount amount">
                        <span class="woocommerce-Price-currencySymbol">{{constLang('currency')}} </span>
                        {{setReal($total['price_cash'] + $tax)}}
                    </span>
                </strong>
            </td>
        </tr>
    </table>
    <div class="wc-proceed-to-checkout">
        <a href="{{route('checkout')}}" class="checkout-button button alt wc-forward">{{constLang('messages.checkouts.btn_checkout')}}</a>
    </div>
</div>
<script type="text/javascript" src="{{asset('plugins/jquery-maskedinput/jquery.maskedinput.min.js')}}"></script>
<script type='text/javascript'>
    jQuery( document ).ready(function($) {
        $("#calc_shipping_postcode").mask('99999-999');
    });
</script>
