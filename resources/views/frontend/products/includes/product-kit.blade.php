@php
    foreach($colors as $color) {
        foreach($color->grids as $item) {
            $values[$product->kit_name.'('.$item->units.')'] = explode(',', $item->grid);
            $array[] = collect($item)->toArray();

        }

    }
    foreach ($values as $key1 => $value1) {
        foreach ($value1 as $val1) {
            $grids[$key1][] = explode('/', $val1);
        }
    }

    $sizes = ary_unique($array, 'units');

@endphp
<form class="variations_form cart" method="post" enctype="multipart/form-data" data-product_id="{{$product->id}}" data-product_variations='{{$product_variations}}'>
    <table class="variations" cellspacing="0">
        <tbody>
        <tr>
            <td class="label"><label for="pa_color">{{constLang('colors')}}</label></td>
            <td class="value with-swatches">
                <div class="swatches-select" data-id="pa_color">
                    @foreach($colors as $color)
                        @foreach($color->grids as $size)
                            @php $size_id=$size->id; @endphp
                        @endforeach
                        @if($color->html == '#ffffff' || $color->html == '#FFFFFF')
                            <div class="basel-swatch basel-tooltip  colored-swatch swatch-size-" data-value="{{\Illuminate\Support\Str::slug($color->color).'|'.$size_id}}"  style="background-color:{{$color->html}};border: 2px solid #2a2a2a;">{{$color->color}}</div>
                        @else
                            <div class="basel-swatch basel-tooltip  colored-swatch swatch-size-" data-value="{{\Illuminate\Support\Str::slug($color->color).'|'.$size_id}}"  style="background-color:{{$color->html}}">{{$color->color}}</div>
                        @endif
                    @endforeach
                </div>
                <select id="pa_color" class="" name="attribute_pa_color" data-attribute_name="attribute_pa_color" data-show_option_none="yes">
                    <option value="">Selecione a Opção</option>
                    @foreach($colors as $color)
                        @foreach($color->grids as $size)
                            @php $size_id=$size->id;@endphp
                        @endforeach
                        <option value="{{\Illuminate\Support\Str::slug($color->color).'|'.$size_id}}">{{$color->color}}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            @foreach($grids as $key => $grid)
                <td class="label"><label for="pa_size">{{$key}}</label></td>
            @endforeach
            <td class="basel-woocommerce-layered-nav">
                @foreach($grids as $key => $grid)
                    <div class="basel-scroll">
                        <ul class="show-labels-on swatches-normal swatches-display-inline  basel-scroll-content">
                            @foreach($grid as $key => $value)
                                <li class="wc-layered-nav-term  with-swatch-text">
                                    <a href="javascript:void(0)">{{$value[1]}}</a>
                                    <span class="count">({{$value[0]}})</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </td>
        </tr>
        </tbody>
    </table>

    <div class="single_variation_wrap">
        <div class="woocommerce-variation single_variation"></div>
        <div class="woocommerce-variation-add-to-cart variations_button">
            <div class="quantity">
                <input type="button" value="-" class="minus" />
                <label class="screen-reader-text" for="quantity_5cba02707fe6e">{{constLang('quantity')}}</label>
                <input
                    type="number"
                    id="quantity_{{numLetter(time())}}"
                    class="input-text qty text"
                    step="1"
                    min="1"
                    max=""
                    name="quantity"
                    value="1"
                    title="{{constLang('qty')}}"
                    size="4"
                    pattern="[0-9]*"
                    inputmode="numeric"
                    aria-labelledby="{{$product->name}} {{constLang('quantity')}}" />
                <input type="button" value="+" class="plus" />
            </div>
            <button type="submit" class="single_add_to_cart_button button alt">{{constLang('add')}}</button>
            <input type="hidden" name="add-to-cart" value="{{$product->id}}" />
            <input type="hidden" name="product_id" value="{{$product->id}}" />
            <input type="hidden" name="variation_id" class="variation_id" value="0" />
            <input type="hidden" name="_token" value="{{csrf_token()}}" />
        </div>
    </div>
</form>