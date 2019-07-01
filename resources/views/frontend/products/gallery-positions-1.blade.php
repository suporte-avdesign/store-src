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

                @forelse($data->positions as $position)
                    <figure data-thumb="{{asset($path['N'].$position->image)}}" class="woocommerce-product-gallery__image">
                        <a href="{{asset($path['G'].$position->image)}}">
                            <img width="870" height="870"
                                 src="{{asset($path['G'].$position->image)}}"
                                 class="wp-post-image wp-post-image"
                                 alt="{{$product->name}} - {{$position->color}}"
                                 title="{{$product->name}} - {{$position->color}}"
                                 data-caption=""
                                 data-src="{{asset($path['G'].$position->image)}}"
                                 data-large_image="{{asset($path['Z'].$position->image)}}"
                                 data-large_image_width="870"
                                 data-large_image_height="870"
                                 srcset="{{asset($path['G'].$position->image)}} 870w,
                                     {{asset($path['N'].$position->image)}} 370w,
                                     {{asset($path['T'].$position->image)}} 100w,
                                     {{asset($path['Z'].$position->image)}} 1000w"
                                 sizes="(max-width: 870px) 100vw, 870px"
                            />
                        </a>
                    </figure>
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
