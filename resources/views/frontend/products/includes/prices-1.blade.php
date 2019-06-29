@if($product->offer == 1)
    <p class="price">{{constLang('on_offer')}}</p>
    @foreach($product->prices as $price)
        @if($price->profile == $configProduct->price_default)
            <p class="price">
                <span class="woocommerce-Price-currencySymbol">{{constLang('cash')}} </span>
                <del>
                  <span class="woocommerce-Price-currencySymbol">{{constLang('currency')}} </span> {{setReal($price->price_cash)}}
                </del>
                <ins>
                  <span class="woocommerce-Price-currencySymbol">{{constLang('currency')}} </span> {{setReal($price->offer_cash)}}
                </ins>
            </p>
            <p class="price">
                <span class="woocommerce-Price-currencySymbol">{{constLang('card')}} </span>
                <del>
                    <span class="woocommerce-Price-currencySymbol">{{constLang('currency')}} </span> {{setReal($price->price_card)}}
                </del>
                <ins>
                    <span class="woocommerce-Price-currencySymbol">{{constLang('currency')}} </span> {{setReal($price->offer_card)}}
                </ins>
            </p>
        @endif
    @endforeach
@else
    @foreach($product->prices as $price)
        @if($price->profile == $configProduct->price_default)
            <p class="price">
                <span class="woocommerce-Price-currencySymbol">{{constLang('cash')}} {{constLang('currency')}}</span>
                {{$price->price_cash}}
            </p>
            <p class="price">
                <span class="woocommerce-Price-currencySymbol">{{constLang('card')}} {{constLang('currency')}}</span>
                {{$price->price_card}}
            </p>
        @endif
    @endforeach
@endif