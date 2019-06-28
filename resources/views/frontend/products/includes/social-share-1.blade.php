<div class="product-share">
    <span class="share-title">{{constLang('share')}}</span>

    <ul class="social-icons text-left icons-design-default icons-size-small social-share ">
        @foreach($social as $share)
            @if($share->active == constLang('active_true'))
                @if($share->name == 'facebook')
                    <li class="social-facebook"><a href="{{$share->share}}{{url('/')}}" rel="nofollow" target="_blank" class=""><i class="fa fa-facebook"></i><span class="basel-social-icon-name">Facebook</span></a></li>
                @endif
                @if($share->name == 'twitter')
                    <li class="social-twitter"><a href="{{$share->share}}{{url('/')}}" rel="nofollow" target="_blank" class=""><i class="fa fa-twitter"></i><span class="basel-social-icon-name">Twitter</span></a></li>
                @endif
                @if($share->name == 'pinterest')
                     <li class="social-pinterest"><a href="{{$share->share}}{{url('/')}}" rel="nofollow" target="_blank" class=""><i class="fa fa-pinterest"></i><span class="basel-social-icon-name">Pinterest</span></a></li>
                @endif
                @if($share->name == 'linkedin')
                    <li class="social-linkedin"><a href="{{$share->share}}{{url('/')}}" rel="nofollow" target="_blank" class=""><i class="fa fa-linkedin"></i><span class="basel-social-icon-name">LinkedIn</span></a></li>
                @endif
            @endif
        @endforeach
    </ul>
</div>
