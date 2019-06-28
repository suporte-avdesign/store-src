<title>{{constLang('messages.products.name')}}</title>

<div class="container">
    <div class="row">
        <div class="site-content shop-content-area col-sm-12 content-with-products description-area-before" role="main">

            @include('frontend.categories.include.breadcrumb-1')
            @include('frontend.categories.include.filters-1')

            <div class="basel-shop-loader"></div>

            <div class="products elements-grid basel-products-holder  basel-spacing- products-spacing- pagination-pagination row grid-columns-4" data-min_price="560" data-max_price="" data-source="main_loop">

                @include('frontend.categories.list-products-1')

            </div>
        </div>
    </div> <!-- end row -->
</div> <!-- end containe
r