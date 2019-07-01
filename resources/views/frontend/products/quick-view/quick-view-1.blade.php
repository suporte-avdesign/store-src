<div class="woocommerce-notices-wrapper"></div>
    <div id="product-{{$data->id}}" class="product-quick-view single-product-content post-{{$data->id}} type-product status-publish has-post-thumbnail product_cat-woman product first instock featured shipping-taxable purchasable product-type-variable has-default-attributes">

    <div class="row product-image-summary">
        <div class="col-md-6 col-sm-12 col-xs-12 product-images">
            <div class="images">
                <!-- images gallery colorr/positions-->
                @if(!empty($data->positions) && $configProduct->positions == 1)
                    @include('frontend.products.quick-view.gallery-positions-1')
                @else
                    @include('frontend.products.quick-view.gallery-colors-1')
                @endif

                <script type="text/javascript">

                    jQuery('.product-quick-view .woocommerce-product-gallery__wrapper').addClass('owl-carousel').owlCarousel({
                        rtl: jQuery('body').hasClass('rtl'),
                        items: 1,
                        dots:false,
                        nav: true,
                        navText: false
                    });

                </script>
            </div>
            <a href="{{url(setRoute('color').$data->slug)}}" class="view-details-btn">{{constLang('details_view')}}</a>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12 summary entry-summary">
            <div class="summary-inner basel-scroll">
                <div class="basel-scroll-content">

                    <p itemprop="name" class="entry-title">{{$product->name}}</p>

                    @include('frontend.products.includes.prices-1')

                    @if($data->description != "")
                        <div class="woocommerce-product-details__short-description">
                            <p>{{$data->description}}</p>
                        </div>
                    @endif

                    @if($product->kit == 1)
                        @include('frontend.products.quick-view.includes.product-kit')
                    @else
                        @include('frontend.products.quick-view.includes.product-unit')
                    @endif

                    @if($configSite->social_share == 1)
                        @include('frontend.products.includes.social-share-1')
                    @endif

                </div>
            </div>
        </div><!-- .summary -->
    </div>

</div>
<!-- #product-{{$product->id}} -->
