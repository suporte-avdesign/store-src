<div class="basel-products-nav">

    @forelse($category->products()->where('id', '<', $product->id)->get() as $previous)
        @if ($loop->last)
            @foreach($previous->images as $prevcolor)
                @if ($loop->first)
                    <div class="product-btn product-prev">
                        <a href="{{url(setRoute('color').$prevcolor->slug)}}">
                            {{constLang('product')}} {{constLang('previous')}}<span></span>
                        </a>
                        <div class="wrapper-short">
                            <div class="product-short">
                                <a href="{{url(setRoute('color').$prevcolor->slug)}}" class="product-thumb">
                                    <img width="100" height="100"
                                         src="{{asset($path['T'].$prevcolor->image)}}"
                                         class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                         alt="" srcset="{{asset($path['T'].$prevcolor->image)}} 100w,
                                                        {{asset($path['N'].$prevcolor->image)}} 370w,
                                                        {{asset($path['G'].$prevcolor->image)}} 800w,
                                                        {{asset($path['Z'].$prevcolor->image)}} 1000w"
                                         sizes="(max-width: 100px) 100vw, 100px"
                                    />
                                </a>
                                <a href="{{url(setRoute('color').$prevcolor->slug)}}" class="product-title">
                                    {{$previous->name}}
                                </a>
                                <span class="price">
                                    @foreach($previous->prices as $prevprice)
                                        @if($prevprice->profile == $configProduct->price_default)
                                            @if($product->offer == 1)
                                                <del>
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span class="woocommerce-Price-currencySymbol">R$ </span>{{setReal($prevprice->price_cash)}}
                                                    </span>
                                                </del>
                                                <ins>
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span class="woocommerce-Price-currencySymbol">R$ </span>{{setReal($prevprice->offer_cash)}}
                                                    </span>
                                                </ins>
                                            @else
                                                <ins>
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span class="woocommerce-Price-currencySymbol">R$ </span>{{setReal($prevprice->price_cash)}}
                                                    </span>
                                                </ins>
                                                <ins>
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span class="woocommerce-Price-currencySymbol">R$ </span>{{setReal($prevprice->price_card)}}
                                                    </span>
                                                </ins>
                                            @endif
                                        @endif
                                    @endforeach
                                </span>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    @empty
    @endforelse

    @forelse($category->products()->where('id', '>', $product->id)->get() as $next)
        @if ($loop->first)
            @foreach($next->images as $nextcolor)
                @if ($loop->last)
                    <div class="product-btn product-next">
                        <a href="{{url(setRoute('color').$nextcolor->slug)}}">
                            {{constLang('next')}} {{constLang('product')}}<span></span>
                        </a>
                        <div class="wrapper-short">
                            <div class="product-short">
                                <a href="{{url(setRoute('color').$nextcolor->slug)}}" class="product-thumb">
                                    <img width="100" height="100"
                                         src="{{asset($path['T'].$nextcolor->image)}}"
                                         class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                         alt="" srcset="{{asset($path['T'].$nextcolor->image)}} 100w,
                                                        {{asset($path['N'].$nextcolor->image)}} 370w,
                                                        {{asset($path['G'].$nextcolor->image)}} 800w,
                                                        {{asset($path['T'].$nextcolor->image)}} 1000w"
                                         sizes="(max-width: 100px) 100vw, 100px"
                                    />
                                </a>

                                <a href="{{url(setRoute('color').$nextcolor->slug)}}" class="product-title">
                                    {{$next->name}}<span></span>
                                </a>
                                <span class="price">
                                    @foreach($next->prices as $nextprice)
                                        @if($nextprice->profile == $configProduct->price_default)
                                            @if($product->offer == 1)
                                                <del>
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span class="woocommerce-Price-currencySymbol">R$ </span>{{setReal($nextprice->price_cash)}}
                                                    </span>
                                                </del>
                                                <ins>
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span class="woocommerce-Price-currencySymbol">R$ </span>{{setReal($nextprice->offer_cash)}}
                                                    </span>
                                                </ins>
                                            @else
                                                <ins>
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span class="woocommerce-Price-currencySymbol">R$ </span>{{setReal($nextprice->price_cash)}}
                                                    </span>
                                                </ins>
                                                <ins>
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span class="woocommerce-Price-currencySymbol">R$ </span>{{setReal($nextprice->price_card)}}
                                                    </span>
                                                </ins>
                                            @endif
                                        @endif
                                    @endforeach
                                </span>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    @empty
    @endforelse
</div>