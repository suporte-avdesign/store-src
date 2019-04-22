<title>Nome do Produto</title>

<div class="page-title page-title-default title-size-small title-design-centered color-scheme-light without-title title-shop" style="">
    <div class="container">
        <div class="nav-shop">

            <a href="#" class="basel-show-categories">Categorias</a>
            <ul class="basel-product-categories">
                <li class="cat-link shop-all-link">
                    <a href="#">Todos</a>
                </li>
                <li class="cat-item cat-item-163 wc-default-cat">
                    <a class="pf-value" href="#" data-val="categoria-1" data-title="Categoria 1">Categoria 1</a>
                </li>
                <li class="cat-item cat-item-58">
                    <a class="pf-value" href="#" data-val="bags" data-title="Categoria 2">Categoria 2</a>
                </li>
                <li class="cat-item cat-item-63 ">
                    <a class="pf-value" href="#" data-val="accessories" data-title="Categoria 3">Categoria 3</a>
                </li>
                <li class="cat-item cat-item-64 ">
                    <a class="pf-value" href="#" data-val="other" data-title="Outras">Outras</a>
                    <ul class='children'>
                        <li class="cat-item cat-item-160 ">
                            <a class="pf-value" href="#" data-val="bakery" data-title="Categoria 1">Categotia 1</a>
                        </li>
                        <li class="cat-item cat-item-158 ">
                            <a class="pf-value" href="#" data-val="beer" data-title="Categoria 2">Categoria 2</a>
                        </li>
                        <li class="cat-item cat-item-99 ">
                            <a class="pf-value" href="#" data-val="flowers" data-title="Categoria">Categoria 3</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>



<div class="container">
    <div class="row">
        <div class="site-content shop-content-area col-sm-12 content-with-products description-area-before" role="main">

            @include('categories.category-1-breadcrumb')

            @include('categories.category-1-filters')


            <div class="basel-shop-loader"></div>


            <div class="products elements-grid basel-products-holder  basel-spacing- products-spacing- pagination-pagination row grid-columns-4" data-min_price="560" data-max_price="" data-source="main_loop">

            @include('categories.category-1-products')

</div>
</div>
</div> <!-- end row -->
</div> <!-- end container -->
