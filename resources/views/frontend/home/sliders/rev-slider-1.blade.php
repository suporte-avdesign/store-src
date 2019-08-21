<div class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-6 vc_col-md-12 vc_col-xs-12">
    <div class="vc_column-inner">
        <div class="wpb_wrapper">
            <div class="wpb_revslider_element wpb_content_element">
                <link href="https://fonts.googleapis.com/css?family=Open+Sans:800%2C400%2C700%7CHind:600%2C400" rel="stylesheet" property="stylesheet" type="text/css" media="all">
                <div id="rev_slider_31_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-source="gallery" style="margin:0px auto;background:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">
                    <!-- START REVOLUTION SLIDER 5.4.8.1 auto mode -->
                    <div id="rev_slider_31_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.4.8.1">
                        <ul>
                            @foreach($imageSlider as $slide)
                                <li data-index="rs-{{$slide->id}}"
                                    data-transition="fade"
                                    data-slotamount="default"
                                    data-hideafterloop="0"
                                    data-hideslideonmobile="off"
                                    data-easein="default"
                                    data-easeout="default"
                                    data-masterspeed="300"
                                    data-thumb="{{$pathSliderThumb.$slide->image}}"
                                    data-delay="{{$slide->delay}}"
                                    data-rotate="0"
                                    data-saveperformance="off"
                                    data-title="{{titleImage($slide->image)}}"
                                    data-param1=""
                                    data-param2=""
                                    data-param3=""
                                    data-param4=""
                                    data-param5=""
                                    data-param6=""
                                    data-param7=""
                                    data-param8=""
                                    data-param9=""
                                    data-param10=""
                                    data-description="">
                                    <!-- MAIN IMAGE -->
                                    <img src="{{$pathSlider.$slide->image}}"
                                         alt="" title="{{titleImage($slide->image)}}"
                                         data-bgposition="center center"
                                         data-bgfit="cover"
                                         data-bgrepeat="no-repeat"
                                         data-bgparallax="off"
                                         class="rev-slidebg"
                                         data-no-retina>
                                         <!--include('frontend.home.sliders.texts.image-1')-->
                                </li>
                            @endforeach
                        </ul>

                        <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
                    </div>
                </div>
                <!-- END REVOLUTION SLIDER -->
            </div>
        </div>
    </div>
</div>
