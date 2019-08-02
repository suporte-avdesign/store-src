<table class="shop_table woocommerce-checkout-review-order-table">
    <thead>
    <tr>
        <th class="product-name">{{constLang('product')}}</th>
        <th class="product-total">{{constLang('total')}}</th>
    </tr>
    </thead>
    <tbody>
    @php
        $quantity   = 0;
        $total_cash = 0;
        $total_card = 0;
    @endphp
    @foreach($cart as $item)
        @php
            $quantity   += $item->quantity;
            $total_cash += $item->price_cash * $item->quantity;
            $total_card += $item->price_card * $item->quantity
        @endphp
        <tr class="cart_item">
            @if($item->kit == 1)
                <td class="product-name">{{$item->name}}&nbsp;<strong class="product-quantity">&times; {{$item->quantity}} {{$item->kit_name}}</strong></td>
            @else
                <td class="product-name">{{$item->name}}&nbsp;<strong class="product-quantity">&times; {{$item->quantity}} {{$item->measure}}</strong></td>
            @endif

            <td class="product-total">
                <span class="woocommerce-Price-amount amount">
                    <span class="woocommerce-Price-currencySymbol">{{constLang('currency')}} </span>{{setReal($item->price_cash * $item->quantity)}}
                </span>
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr class="cart-subtotal">
        <th>{{constLang('subtotal')}} {{constLang('cash')}}</th>
        <td>
            <span class="woocommerce-Price-amount amount">
                <span class="woocommerce-Price-currencySymbol">{{constLang('currency')}} </span>{{setReal($total_cash)}}
            </span>
        </td>
    </tr>
    <tr class="cart-subtotal">
        <th>{{constLang('subtotal')}} {{constLang('card')}}</th>
        <td>
            <span class="woocommerce-Price-amount amount">
                <span class="woocommerce-Price-currencySymbol">{{constLang('currency')}} </span>{{setReal($total_card)}}
            </span>
        </td>
    </tr>
    <tr class="woocommerce-shipping-totals shipping">
        <th>{{constLang('message.shipping.freight')}}</th>
        <td data-title="{{constLang('message.shipping.freight')}}">
            <ul id="shipping_method" class="woocommerce-shipping-methods">
                @foreach($configShipping as $method)
                    <li>
                        <input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_{{$method->id}}" value="{{$method->id}}" class="shipping_method" @if($method_selected == $method->id) checked @endif/>
                        @if($method->tax_unique != '0.00')
                            <label for="shipping_method_{{$method->id}}">{{$method->name}}</label>
                            <p>{{$method->description}} {{constLang('currency')}} {{setReal($method->tax_unique)}}</p>

                        @elseif($method->tax == 0)
                            <label for="shipping_method_{{$method->id}}">{{$method->name}}</label>
                            <p>{{constLang('currency')}} 0,00</p>
                        @else
                            <label for="shipping_method_{{$method->id}}">{{$method->name}} </label>
                        @endif
                    </li>
                @endforeach
            </ul>
        </td>
    </tr>
    <tr class="order-total">
        <th>{{constLang('cash')}}</th>
        <td>
            <strong>
                <span class="woocommerce-Price-amount amount">
                    <span class="woocommerce-Price-currencySymbol">{{constLang('currency')}} </span>{{setReal($total_cash)}}
                </span>
            </strong>
        </td>
    </tr>
    <tr class="order-total">
        <th>{{constLang('card')}}</th>
        <td>
            <strong>
                <span class="woocommerce-Price-amount amount">
                    <span class="woocommerce-Price-currencySymbol">{{constLang('currency')}} </span>{{setReal($total_card)}}
                </span>
            </strong>
        </td>
    </tr>
    @auth
    @if($freight->error != 0)
        <tr class="freight">
            <th>{{constLang('error')}}</th>
            <td> {{$freight->error}} </td>
        </tr>
    @else
        <tr class="freight">
            <th>{{constLang('messages.shipping.freight')}}</th>
            <td>
                <strong>
                    <span class="woocommerce-Price-amount amount">
                        <span class="woocommerce-Price-currencySymbol">{{constLang('currency')}} </span>{{setReal($freight->valor)}}
                    </span>
                </strong>
            </td>
        </tr>
    @endif
    @endauth

    </tfoot>
</table>
