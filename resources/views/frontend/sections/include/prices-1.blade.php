<h3 class="product-title"><a href="#">{{constLang('value')}} {{$profile_default_name}} </a></h3>
<p class="price">
    <span class="woocommerce-Price-amount amount">
        <span class="woocommerce-Price-currencySymbol">{{constLang('cash')}} {{constLang('currency')}} </span>
        {{$price_default_cash}}
    </span>
</p>
<p class="price">
    <span class="woocommerce-Price-amount amount">
        <span class="woocommerce-Price-currencySymbol">{{constLang('card')}} {{constLang('currency')}} </span>
        {{$price_default_card}}
    </span>
</p>


<div class="wrap-price">
<!--
                    <div class="wrapp-swap">
                        <div class="swap-elements">
                            <div class="star-rating">
                                <span style="width:80%">{{constLang('rated')}} <strong class="rating">4</strong> {{constLang('in')}} 5</span>
                            </div>
                            <div class="btn-add">
                                <a href="#"
                                   data-quantity="1" class="button product_type_variable add_to_cart_button"
                                   data-product_id="{{$product->id}}"
                                   data-product_sku=""
                                   aria-label="{{constLang('select_options')}}" rel="nofollow">{{constLang('select_options')}}
        </a>
    </div>
</div>
</div>
-->
    <!-- OPTIONS  COLORS -->
    <div class="swatches-on-grid">
        @foreach($product->images()->where('active', constLang('active_true'))->orderBy('cover', 'desc')->get() as $color)
            @php
                $data_src    = $photoUrl.$color->image;
                $data_html   = $color->html;
                $data_color  = $color->color;
                $data_srcset = $photoUrl.$color->image.' 370w,'.$photoUrl.$color->image.' 100w,'.$photoUrl.$color->image.' 800w,'.$photoUrl.$color->image.' 1000w,';
            @endphp
            <div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-"
                 style="background-color:{{$data_html}};"
                 data-image-src="{{$data_src}}"
                 data-image-srcset="{{$data_srcset}}"
                 data-image-sizes="(max-width: 870px) 100vw, 870px">{{$data_color}}
            </div>
        @endforeach
    </div>

</div>
