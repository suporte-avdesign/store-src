<div class="basel-compare-table">
    <div class="basel-compare-row compare-basic">
        <div class="basel-compare-col compare-field"></div>
        <div class="basel-compare-col compare-value" data-title="">
            <div class="compare-basic-content">
                <a href="{{route('compare.remove', [$page, $id])}}" class="basel-compare-remove" data-id="19655">
                    <span class="remove-loader"></span>Remover
                </a>
                <a class="product-image" href="{{route('product', [$product['category'], $product['section'], $product['slug']])}}" target="_blank">
                    <img width="273" height="273"
                         src="{{asset('faker/product_photos/img4-f.jpg')}}"
                         class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                         alt=""
                         srcset="{{asset('faker/product_photos/img4-f.jpg')}} 273w,
                                {{asset('faker/product_photos/img4-f.jpg')}} 546w,
                                {{asset('faker/product_photos/img4-f.jpg')}} 235w,
                                {{asset('faker/product_photos/img4-f.jpg')}} 768w,
                                {{asset('faker/product_photos/img4-f.jpg')}} 803w,
                                {{asset('faker/product_photos/img4-f.jpg')}} 266w,
                                {{asset('faker/product_photos/img4-f.jpg')}} 219w,
                                {{asset('faker/product_photos/img4-f.jpg')}} 263w,
                                {{asset('faker/product_photos/img4-f.jpg')}} 526w,
                                {{asset('faker/product_photos/img4-f.jpg')}} 870w"
                         sizes="(max-width: 273px) 100vw, 273px"
                    />
                </a>
                <h4 class="product-title">
                    <a href="{{route('product', [$product['category'], $product['section'], $product['slug']])}}" target="_blank">Produto 3</a>
                </h4>

                @include('ratings.rating-1')

                <div class="price">
                                            <span class="woocommerce-Price-amount amount">
                                                <span class="woocommerce-Price-currencySymbol">R$ </span>12,00
                                            </span> &ndash;
                    <span class="woocommerce-Price-amount amount">
                                                <span class="woocommerce-Price-currencySymbol">R$ </span>15,00
                                            </span>
                </div>
                <a href="{{route('product', [$product['category'], $product['section'], $product['slug']])}}" data-quantity="1" class="button product_type_variable add_to_cart_button add-to-cart-loop" data-product_id="19655" data-product_sku="" aria-label="Selecione as opções para o produto 3" rel="nofollow">
                    <span>Selecione as opções</span>
                </a>
            </div>
        </div>

    </div>
    <div class="basel-compare-row compare-description">
        <div class="basel-compare-col compare-field">Descrição</div>

        <div class="basel-compare-col compare-value" data-title="Descrição">
            Descrição do  produto 3
        </div>
    </div>
    <div class="basel-compare-row compare-sku">
        <div class="basel-compare-col compare-field">Sku</div>

        <div class="basel-compare-col compare-value" data-title="Sku"></div>
    </div>
    <div class="basel-compare-row compare-availability">
        <div class="basel-compare-col compare-field">Disponibilidade</div>

        <div class="basel-compare-col compare-value" data-title="Disponibilidade">
            <p class="stock in-stock">Em Estoque</p>
        </div>
    </div>
    <div class="compare-loader"></div>
</div>