<div class="shop-loop-head">
    <nav class="woocommerce-breadcrumb">
        <a href="{{route('home')}}">Home</a>
        <span class="breadcrumb-last">{{$category->name}}</span>
    </nav>
    <div class="woocommerce-notices-wrapper"></div>
    @if (count($category->products) >= 1)
        <p class="woocommerce-result-count">{{constLang('page')}} 1  {{constLang('of')}} {{count($category->products)}} {{constLang('results')}}</p>
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