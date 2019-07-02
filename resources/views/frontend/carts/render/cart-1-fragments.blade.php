@if (empty($cart))
    <div class="widget_shopping_cart_content">
        <p class="woocommerce-mini-cart__empty-message empty">{{constLang('messages.cart.cart_empty')}}</p>
    </div>
@else
    <div class="widget_shopping_cart_content">
        <ul class="woocommerce-mini-cart cart_list product_list_widget ">

            @foreach($cart as $item)
                <li class="woocommerce-mini-cart-item mini_cart_item">
                    <a href="{{route('cart.remove')}}/?remove_item={{$item->session}}&_wpnonce=194ce587c0" class="remove remove_from_cart_button" aria-label="Remover este item" data-product_id="{{$item->product_id}}" data-cart_item_key="{{$item->session}}" data-product_sku="">&times;</a>
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
            <strong>Subtotal:</strong>
            <span class="woocommerce-Price-amount amount">
                <span class="woocommerce-Price-currencySymbol">{{constLang('currency')}} </span>{{$total}}
            </span>
        </p>
        <p class="woocommerce-mini-cart__buttons buttons">
            <a href="{{route('cart')}}" class="button btn-cart wc-forward">Ver Carrinho</a>
            <a href="{{route('checkout')}}" class="button checkout wc-forward">Finalizar</a>
        </p>
    </div>

@endif









