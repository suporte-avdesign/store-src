<div class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-3 vc_col-md-12 vc_hidden-md vc_hidden-sm vc_col-xs-12 vc_hidden-xs">
    <div class="vc_column-inner">
        <div class="wpb_wrapper">
            @foreach($imageBanner as $banner)
                @if($banner->id == 1)
                    <div class="promo-banner cursor-pointer text-center vertical-alignment-top banner- hover-1 color-scheme-light " onclick="window.location.href='#'">
                        <div class="main-wrapp-img">
                            <div class="banner-image">
                                <img class="promo-banner-image image-2" src="{{$pathBanner.$banner->image}}" width="262" height="256" alt="{{titleImage($banner->image)}}" title="{{titleImage($banner->image)}}" />
                            </div>
                        </div>
                        <!--
                        <div class="wrapper-content-baner">
                            <div class="banner-inner">
                                <p><strong style="background: white; color: #002a6e; padding: 2px 15px 0; line-height: 1.2;">TITULO</strong></p>
                                    <h2 style="margin: -5px 0 10px; font-weight: bold;">Texto</h2>
                                <p>
                            </div>
                        </div>
                        -->
                    </div>
                @endif

                @if($banner->id == 2)
                    <div class="promo-banner cursor-pointer text-center vertical-alignment-top banner- hover-1 color-scheme-light " onclick="window.location.href='#'">
                        <div class="main-wrapp-img">
                            <div class="banner-image">
                                <img class="promo-banner-image image-2" src="{{$pathBanner.$banner->image}}" width="262" height="256" alt="{{titleImage($banner->image)}}" title="{{titleImage($banner->image)}}" />
                            </div>
                        </div>
                        <!--
                        <div class="wrapper-content-baner">
                            <div class="banner-inner">
                                <p><strong style="background: white; color: #002a6e; padding: 2px 15px 0; line-height: 1.2;">TITULO</strong></p>
                                <h2 style="margin: -5px 0 10px; font-weight: bold;">Texto</h2>
                                <p>
                            </div>
                        </div>
                        -->
                    </div>
                @endif

            @endforeach

        </div>
    </div>
</div>
