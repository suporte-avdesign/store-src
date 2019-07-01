<!--
-1 x 2 = <div class="clearfix visible-xs-block"></div>
-! x 3 = <div class="clearfix visible-sm-block"></div>
-1 x 4 = <div class="clearfix visible-md-block visible-lg-block"></div>
-->
<!-- PRODUTO 1 first select options -->
@forelse($categories as $category)
    @forelse($category->products as $product)
        <!-- Prices Offers -->
        @if($configProduct->view_prices == 1)
            @foreach($product->prices as $price)
                @php
                    if ($product->offer == 1) {
                        if ($price->profile == $configProduct->price_default) {
                            $price_cash_percent = floatval($price->price_cash_percent);
                            $price_card_percent = floatval($price->price_card_percent);
                            $profile_default_name = $price->profile;
                            $price_default_cash = setReal($price->offer_cash);
                            $price_default_card = setReal($price->offer_card);
                        } else {
                            $price_cash_percent = floatval($price->price_cash_percent);
                            $price_card_percent = floatval($price->price_card_percent);
                            $profile_other_name = $price->profile;
                            $price_other_cash = setReal($price->offer_cash);
                            $price_other_card = setReal($price->offer_card);
                        }
                    } else {
                        if ($price->profile == $configProduct->price_default) {
                            $profile_default_name = $price->profile;
                            $price_default_cash = setReal($price->price_cash);
                            $price_default_card = setReal($price->price_card);
                        } else {
                            $profile_other_name = $price->profile;
                            $price_other_cash = setReal($price->price_cash);
                            $price_other_card = setReal($price->price_card);
                        }
                    }
                @endphp
            @endforeach
        @endif

        @if (count($product->images) >= 1)
            @foreach($product->images()->where('active', constLang('active_true'))->orderBy('cover', 'desc')->limit(1)->get() as $color)
                @php
                    $alt_colors    = 'texto alt';
                    $src_colors    = $photoUrl.$color->image;
                    $srcset_colors = $photoUrl.$color->image.' 370w,'.$photoUrl.$color->image.' 100w,'.$photoUrl.$color->image.' 800w,'.$photoUrl.$color->image.' 1000w,';
                @endphp
                @foreach($color->positions()->where('active', constLang('active_true'))->orderBy('order')->limit(1)->get() as $position)
                    @php
                        $alt_position    = 'texto alt';
                        $src_position    = $photoUrl.$position->image;
                        $srcset_position = $photoUrl.$position->image.' 370w,'.$photoUrl.$position->image.' 100w,'.$photoUrl.$position->image.' 800w,'.$photoUrl.$position->image.' 1000w,';
                    @endphp
                @endforeach <!-- /positions -->
            @endforeach  <!-- /colors -->
            <div class="product-grid-item basel-hover-alt product  col-xs-6 col-sm-4 col-md-3 @if($loop->first) first @endif post-1001 type-product status-publish has-post-thumbnail product_cat-bags product_tag-new product_tag-whte instock featured shipping-taxable purchasable product-type-variable has-default-attributes" data-loop="13" data-id="1001">
                <div class="product-element-top">
                    @if($product->offer == 1)
                        <div class="product-labels labels-rounded">
                            <span class="onsale product-label">-{{$price_cash_percent}}%</span>
                        </div>
                    @else
                        @if($product->new == 1)
                            <div class="product-labels labels-rounded">
                                <span class="new product-label">{{constLang('new')}}</span>
                            </div>
                        @endif
                    @endif
                    <a href="{{url(setRoute('color').$color->slug)}}">
                        <img width="273" height="273" alt="{{$alt_colors}}" src="{{$src_colors}}" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" srcset="{{$srcset_colors}}" sizes="(max-width: 273px) 100vw, 273px" />
                    </a>
                    @if (count($color->positions) >= 1)
                        @if($configSite->image_positions == 1)
                            <div class="hover-img">
                                <a href="{{url(setRoute('color').$color->slug)}}">
                                    <img width="273" height="273" src="{{$src_position}}" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="{{$alt_position}}" srcset="{{$srcset_position}}" sizes="(max-width: 273px) 100vw, 273px" />
                                </a>
                            </div>
                        @endif
                    @endif
                    <div class="basel-buttons">
                            <div class="clear"></div>
                            @if($configProduct->wishlist == 1)
                                <div class="yith-wcwl-add-to-wishlist add-to-wishlist-1001">
                                    <div class="yith-wcwl-add-button show">
                                        <a href="{{route('wishlist.store')}}?infinit_scrolling&add_to_wishlist=1001" rel="nofollow" data-product-id="1001" data-product-type="variable" class="add_to_wishlist">
                                            {{constLang('messages.wishlist.add')}}
                                        </a>
                                        <img src="{{asset('themes/images/loader/wpspin_light.gif')}}" class="ajax-loading" alt="carregando" width="16" height="16" style="visibility:hidden"/>
                                    </div>

                                    <div class="yith-wcwl-wishlistaddedbrowse hide">
                                        <span class="feedback">{{constLang('added')}} {{constLang('product')}}!</span>
                                        <a href="{{route('wishlist')}}" rel="nofollow">{{constLang('messages.wishlist.view')}}</a>
                                    </div>

                                    <div class="yith-wcwl-wishlistexistsbrowse hide">
                                        <span class="feedback">{{constLang('messages.wishlist.added')}}</span>
                                        <a href="{{route('wishlist')}}" rel="nofollow">{{constLang('messages.wishlist.view')}}</a>
                                    </div>

                                    <div style="clear:both"></div>
                                    <div class="yith-wcwl-wishlistaddresponse"></div>
                                </div>
                            @endif
                            @if($configProduct->compare == 1)
                                <div class="basel-compare-btn product-compare-button">
                                    <a class="button" href="{{route('compare')}}" data-added-text="{{constLang('compare')}} {{constLang('product')}}" data-id="1001">{{constLang('compare')}}</a>
                                </div>
                            @endif
                            @if($configProduct->quickview == 1)
                                <div class="quick-view">
                                    <a href="{{url(setRoute('color').$color->slug)}}" class="open-quick-view" data-id="{{$product->id}}">{{constLang('quick_view')}}</a>
                                </div>
                            @endif
                        </div>
                </div>
                <h3 class="product-title"><a href="{{url(setRoute('color').$color->slug)}}">{{$product->name}} </a></h3>

                @include('frontend.sections.include.prices-1')
            </div>
            @if(($loop->iteration % 2) == 0)
                <div class="clearfix visible-xs-block"></div>
            @endif
            @if(($loop->iteration % 3) == 0)
                <div class="clearfix visible-sm-block"></div>
            @endif
            @if(($loop->iteration % 4) == 0)
                <div class="clearfix visible-md-block visible-lg-block"></div>
            @endif
        @endif <!-- count $category->products -->
    @empty <!-- /product -->

    @endforelse <!-- /products -->
@empty <!-- category -->

@endforelse <!-- /category -->
