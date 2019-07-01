<div class="col-sm-6 product-images">
    <div class="woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-4 images images row thumbs-position-left image-action-zoom" style="opacity: 0; transition: opacity .25s ease-in-out;">
        <div class="col-md-9 col-md-push-3">
            <figure class="woocommerce-product-gallery__wrapper owl-carousel">

                <figure data-thumb="{{asset($path['N'].$data->image)}}" class="woocommerce-product-gallery__image">
                    <a href="{{asset($path['G'].$data->image)}}">
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
                    </a>
                </figure>

                @forelse($colors as $color)
                    @if($color->id != $data->id)
                        <figure data-thumb="{{asset($path['N'].$color->image)}}" class="woocommerce-product-gallery__image">
                            <a href="{{asset($path['G'].$color->image)}}">
                                <img width="870" height="870"
                                     src="{{asset($path['G'].$color->image)}}"
                                     class="wp-post-image wp-post-image"
                                     alt="{{$product->name}} - {{$color->color}}"
                                     title="{{$product->name}} - {{$color->color}}"
                                     data-caption=""
                                     data-src="{{asset($path['G'].$color->image)}}"
                                     data-large_image="{{asset($path['Z'].$color->image)}}"
                                     data-large_image_width="870"
                                     data-large_image_height="870"
                                     srcset="{{asset($path['G'].$color->image)}} 870w,
                                         {{asset($path['N'].$color->image)}} 370w,
                                         {{asset($path['T'].$color->image)}} 100w,
                                         {{asset($path['Z'].$color->image)}} 1000w"
                                     sizes="(max-width: 870px) 100vw, 870px"
                                />
                            </a>
                        </figure>
                    @endif
                @empty
                @endforelse
            </figure>



            <div class="basel-show-product-gallery-wrap">
                <a href="#" class="basel-show-product-gallery basel-tooltip">{{constLang('messages.colors.btn_zoom')}}</a>
            </div>

        </div>
        <div class="col-md-3 col-md-pull-9">
            <div class="thumbnails"></div>
        </div>
    </div>
</div>
