@if (empty($cart))
    <div class="widget_shopping_cart_content">
        <p class="woocommerce-mini-cart__empty-message empty">{{constLang('messages.cart.cart_empty')}}</p>
    </div>
@else
    <div class="widget_shopping_cart_content">
        <ul class="woocommerce-mini-cart cart_list product_list_widget ">
            @foreach($cart as $item)
                <li class="woocommerce-mini-cart-item mini_cart_item">
                    <a href="{{route('cart.remove')}}/?remove_item={{$item->key}}&_wpnonce={{numLetter($item->id, 'leter').numLetter($item->color)}}" class="remove remove_from_cart_button" aria-label="{{constLang('messages.cart.remove_item')}}" data-product_id="{{$item->product_id}}" data-cart_item_key="{{$item->key}}" data-product_sku="">&times;</a>
                    <a href="#">
                        <img width="100" height="100" src="{{asset($photoUrl.$item->image)}}" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="{{$item->name}} {{$item->color}} {{$item->grid}}" />
                        {{$item->name}}
                    </a>

                    <span class="quantity">{{$item->quantity}} &times;
                        <span class="woocommerce-Price-amount amount">
                            <span class="woocommerce-Price-currencySymbol">{{constLang('currency')}} </span>{{setReal($item->price_cash)}}
                        </span>
                    </span>
                    <p><span>{{$item->grid}}</span></p>
                </li>
            @endforeach
        </ul>
        <!-- end product list -->
        <p class="woocommerce-mini-cart__total total">
            <strong>{{constLang('subtotal')}}:</strong>
            <span class="woocommerce-Price-amount amount">
                <span class="woocommerce-Price-currencySymbol">{{constLang('currency')}} </span>{{$total}}
            </span>
        </p>
        <p class="woocommerce-mini-cart__buttons buttons">
            <a href="{{route('cart')}}" class="button btn-cart wc-forward">{{constLang('cart')}}</a>
            <a href="{{route('checkout')}}" class="button checkout wc-forward">{{constLang('messages.checkouts.checkout')}}</a>
        </p>
    </div>

@endif









