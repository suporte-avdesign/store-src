@if ($quantity === 0)
    <div class="widget_shopping_cart_content">
        <p class="woocommerce-mini-cart__empty-message empty">Nenhum produto no carrinho.</p>
    </div>
@else
    <div class="widget_shopping_cart_content">
        <ul class="woocommerce-mini-cart cart_list product_list_widget ">
            <li class="woocommerce-mini-cart-item mini_cart_item">
                <a href="{{route('cart.remove')}}?remove_item=00a2829b91a876cd2c81122e0ccbd76d&_wpnonce=194ce587c0" class="remove remove_from_cart_button" aria-label="Remover este item" data-product_id="19531" data-cart_item_key="00a2829b91a876cd2c81122e0ccbd76d" data-product_sku="">&times;</a>
                <a href="#">
                    <img width="273" height="273" src="{{asset('faker/product_photos/img5-f.jpg')}}?ver=1.0.0" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" />
                    Produto 1
                </a>
                <span class="quantity">2 &times;
                <span class="woocommerce-Price-amount amount">
                    <span class="woocommerce-Price-currencySymbol">R$ </span>86,00
                </span>
            </span>
            </li>
        </ul>
        <!-- end product list -->
        <p class="woocommerce-mini-cart__total total">
            <strong>Subtotal:</strong>
            <span class="woocommerce-Price-amount amount">
                <span class="woocommerce-Price-currencySymbol">R$ </span>{{$total}}
            </span>
        </p>
        <p class="woocommerce-mini-cart__buttons buttons">
            <a href="{{route('cart')}}" class="button btn-cart wc-forward">Ver Carrinho</a>
            <a href="{{route('checkout')}}" class="button checkout wc-forward">Finalizar</a>
        </p>

@endif









