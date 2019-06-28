<title>{{constLang('messages.products.name')}}</title>

<div class="page-title page-title-default title-size-small title-design-centered color-scheme-light without-title title-shop" style="">
    <div class="container">
        <div class="nav-shop">

            <a href="#" class="basel-show-categories">{{constLang('categories')}}</a>
            <ul class="basel-product-categories">
                <li class="cat-link shop-all-link">
                    <a href="#">{{constLang('all')}}</a>
                </li>
                @forelse($section->categories as $category)
                    <li class="cat-item cat-item-{{$category->id}} wc-default-cat">
                        <a class="pf-value" href="{{route('category', $category->slug)}}" data-val="{{$category->slug}}" data-title="{{$category->name}}">{{$category->name}}</a>
                    </li>
            @empty
            @endforelse
            <!--include('frontend.sections.include.others-1')-->
            </ul>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="site-content shop-content-area col-sm-12 content-with-products description-area-before" role="main">

            @include('frontend.sections.include.breadcrumb-1')
            @include('frontend.sections.include.filters-1')

            <div class="basel-shop-loader"></div>

            <div class="products elements-grid basel-products-holder  basel-spacing- products-spacing- pagination-pagination row grid-columns-4" data-min_price="560" data-max_price="" data-source="main_loop">

                @include('frontend.sections.list-products-1')

            </div>
        </div>
    </div> <!-- end row -->
</div> <!-- end container -->
