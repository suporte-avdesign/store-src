<div id="yith-wcwl-messages"></div>
<div class="wishlist-wrapper">
    <form id="yith-wcwl-form" action="{{route('wishlist')}}/" method="post" class="woocommerce">

        <input type="hidden" id="yith_wcwl_form_nonce" name="yith_wcwl_form_nonce" alue="78590294cc" />
        <input type="hidden" name="_wp_http_referer" value="/basel/wishlist/" />
        <table class="shop_table_responsive shop_table cart wishlist_table" data-pagination="no" data-per-page="5" data-page="1" data-id="" data-token="">
            <thead>
            <tr>
                <th class="product-remove"></th>
                <th class="product-thumbnail"></th>
                <th class="product-name">
                    <span class="nobr">Produto</span>
                </th>
                <th class="product-price">
                    <span class="nobr">Preço Unitário</span>
                </th>
                <th class="product-stock-status">
                    <span class="nobr">Estoque</span>
                </th>
                <th class="product-add-to-cart"></th>
            </tr>
            </thead>

            <tbody>
            <tr id="yith-wcwl-row-19515" data-row-id="19515">
                <td class="product-remove">
                    <div>
                        <a href="{{route('wishlist.remove')}}?remove_from_wishlist=19515&wishlist_token={{csrf_token()}}" class="remove remove_from_wishlist" title="Remove this product">&times;</a>
                    </div>
                </td>
                <td class="product-thumbnail">
                    <a href="{{route('product', [$product['category'], $product['section'], $product['slug']])}}/?cor=preto-amarelo">
                        <img width="273" height="273"
                             src="{{asset('faker/product_photos/img4-f.jpg')}}"
                             class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                             alt="" srcset="{{asset('faker/product_photos/img4-f.jpg')}} 273w,
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
                </td>
                <td class="product-name" data-title="Produto">
                    <a href="{{route('product', [$product['category'], $product['section'], $product['slug']])}}/?cor=preto-amarelo">Produto 2 - Preto/Amarelo</a>
                </td>

                <td class="product-price" data-title="Preço und">
                        <span class="woocommerce-Price-amount amount">
                            <span class="woocommerce-Price-currencySymbol">R$ </span>47,00
                        </span>
                </td>

                <td class="product-stock-status" data-title="Estoque Status">
                    <span class="wishlist-in-stock">Em Estoque</span>
                </td>

                <td class="product-add-to-cart">
                    <a href="{{route('wishlist.cart')}}?remove_from_wishlist_after_add_to_cart=19515" data-quantity="1" class="button product_type_variable add_to_cart_button add_to_cart button alt" data-product_id="19515" data-product_sku="" aria-label="Select options for &ldquo;Basic knit dress chest&rdquo;" rel="nofollow"> Selecione as Opções</a>
                </td>
            </tr>
            </tbody>


            <tfoot>
            <tr>
                <td colspan="6"></td>
            </tr>
            </tfoot>

        </table>

        <input type="hidden" id="yith_wcwl_edit_wishlist" name="yith_wcwl_edit_wishlist" value="782757cc30" /><input type="hidden" name="_wp_http_referer" value="/basel/wishlist/" />
        <input type="hidden" value="" name="wishlist_id" id="wishlist_id">


    </form>

</div><!-- .wishlist-wrapper -->
