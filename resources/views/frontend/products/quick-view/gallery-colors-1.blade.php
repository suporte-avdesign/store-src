<div class="woocommerce-product-gallery__wrapper">
    <figure class="woocommerce-product-gallery__image">
        <img width="870" height="870"
             src="{{asset($path['G'].$data->image)}}"
             class="wp-post-image wp-post-image"
             alt="{{$product->name}} - {{$data->color}}"
             title="{{$product->name}} - {{$data->color}}"
             data-caption=""
             data-src="{{asset($path['G'].$data->image)}}"
             data-large_image="{{asset($path['Z'].$data->image)}}"
             data-large_image_width="870"
             data-large_image_height="870"
             srcset="{{asset($path['G'].$data->image)}} 870w,
                     {{asset($path['N'].$data->image)}} 370w,
                     {{asset($path['T'].$data->image)}} 100w,
                     {{asset($path['Z'].$data->image)}} 1000w"
             sizes="(max-width: 870px) 100vw, 870px"
        />
    </figure>

    @forelse($colors as $color)
        @if($color->id != $data->id)
            <figure class="woocommerce-product-gallery__image">
                <img width="870" height="870"
                     src="{{asset($path['G'].$color->image)}}"
                     class="wp-post-image wp-post-image"
                     alt="{{$product->name}} - {{$color->color}}"
                     srcset="{{asset($path['G'].$color->image)}} 870w,
                             {{asset($path['N'].$color->image)}} 370w,
                             {{asset($path['Z'].$color->image)}} 1000w"
                     sizes="(max-width: 870px) 100vw, 870px"
                />
            </figure>
        @endif
    @empty
    @endforelse

</div>
