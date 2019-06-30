<div class="shop-loop-head">
    <nav class="woocommerce-breadcrumb">
        <a href="{{route('home')}}">{{constLang('home')}}</a>
        <span class="breadcrumb-last">{{$section->name}}</span>
    </nav>
    @if (count($categories) >= 1)
        <div class="woocommerce-notices-wrapper"></div>
        <p class="woocommerce-result-count">{{constLang('page')}} 1  {{constLang('of')}} {{count($section->products)}} {{constLang('results')}}</p>
        <div class="basel-show-sidebar-btn">
            <span class="basel-side-bar-icon"></span>
            <span>{{constLang('show')}} {{constLang('sidebar')}}</span>
        </div>
        <!--
        <div class="basel-filter-buttons">
            <a href="#" class="open-filters">{{constLang('filter')}}</a>
        </div>
        -->
    @else
        <div class="woocommerce-notices-wrapper"></div>
        <p class="woocommerce-result-count">{{constLang('page')}} 0 &ndash; 0 {{constLang('of')}} 0 {{constLang('results')}}</p>
    @endif
</div>