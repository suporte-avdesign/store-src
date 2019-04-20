@extends('layouts.template-1')

@push('title')
<title> São Roque calçados categoria/seção</title>
@endpush

@push('body')
<body class="archive post-type-archive post-type-archive-product logged-in woocommerce woocommerce-page woocommerce-no-js wrapper-full-width global-cart-design-1 global-search-full-screen global-header-shop mobile-nav-from-left basel-light catalog-mode-off categories-accordion-on global-wishlist-enable basel-top-bar-on basel-ajax-shop-on basel-ajax-search-on enable-sticky-header header-full-width sticky-header-real offcanvas-sidebar-mobile offcanvas-sidebar-tablet wpb-js-composer js-comp-ver-5.6 vc_responsive">
@endpush

@section('content')



    <div class="clear"></div>

    <div class="main-page-wrapper">

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


        <!-- MAIN CONTENT AREA -->
        <div class="container">
            <div class="row">
                <div class="site-content shop-content-area col-sm-12 content-with-products description-area-before" role="main">
                    <div class="shop-loop-head">
                        <nav class="woocommerce-breadcrumb">
                            <a href="#">Home</a>
                            <span class="breadcrumb-last">Feminino</span>
                        </nav>
                        <div class="woocommerce-notices-wrapper"></div>
                        <p class="woocommerce-result-count">Pagina 1 &ndash; 12 de 307 resultados</p>
                        <div class="basel-show-sidebar-btn">
                            <span class="basel-side-bar-icon"></span>
                            <span>Mostrar barra lateral</span>
                        </div>
                        <div class="basel-filter-buttons">
                            <a href="#" class="open-filters">Filtrar</a>
                        </div>
                    </div>

                    <div class="filters-area">
                        <div class="filters-inner-area row">
                            <div id="BASEL_Widget_Sorting" class="filter-widget widget-count-4 col-xs-12 col-sm-6 col-md-3">
                                <h5 class="widget-title">Ordenar por:</h5>
                                <form class="woocommerce-ordering with-list" method="get">
                                    <ul>
                                        <li>
                                            <a href="{{route('category')}}?orderby=menu_order" data-order="menu_order" @if($orderby == 'menu_order') class="selected-order" @endif>Padrão</a>
                                        </li>
                                        <li>
                                            <a href="{{route('category')}}?orderby=popularity" data-order="popularity" @if($orderby == 'popularity') class="selected-order" @endif>Popular</a>
                                        </li>
                                        <li>
                                            <a href="{{route('category')}}?orderby=rating" data-order="rating" @if($orderby == 'rating') class="selected-order" @endif>Classificação</a>
                                        </li>
                                        <li>
                                            <a href="{{route('category')}}?orderby=date" data-order="date" @if($orderby == 'date') class="selected-order" @endif>Novidade</a>
                                        </li>
                                        <li>
                                            <a href="{{route('category')}}?orderby=price" data-order="price" @if($orderby == 'price') class="selected-order" @endif>Preço: baixo para alto</a>
                                        </li>
                                        <li>
                                            <a href="{{route('category')}}?orderby=price-desc" data-order="price-desc" @if($orderby == 'price-desc') class="selected-order" @endif>Preço: alto para baixo</a>
                                        </li>
                                    </ul>
                                    <input type="hidden" name="infinit_scrolling" value="" />
                                </form>
                            </div>
                            <div id="BASEL_Widget_Price_Filter" class="filter-widget widget-count-4 col-xs-12 col-sm-6 col-md-3">
                                <h5 class="widget-title">Filtrar por preço {{$min_price}}</h5>
                                <div class="basel-price-filter">
                                    <ul>
                                        <li>
                                            <a rel="nofollow" href="{{route('category')}}" class="">Todos</a>
                                        </li>
                                        <li>
                                            <a rel="nofollow" href="{{route('category')}}?min_price=0&max_price=20" @if($max_price == 20) class="current-state" @endif>
                                                <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol">R$ </span>0.00
                                                </span> -
                                                <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol">R$ </span>20,00
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a rel="nofollow" href="{{route('category')}}?min_price=20&#038;max_price=30" @if($max_price == 30) class="current-state" @endif>
                                                <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol">R$ </span>20,00
                                                </span> -
                                                <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol">R$ </span>30,00
                                                </span></a>
                                        </li>
                                        <li>
                                            <a rel="nofollow" href="{{route('category')}}?min_price=30&#038;max_price=45" @if($max_price == 45) class="current-state" @endif>
                                                <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol">R$ </span>30,00
                                                </span> -
                                                <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol">R$ </span>45,00
                                                </span></a>
                                        </li>
                                        <li>
                                            <a rel="nofollow" href="{{route('category')}}?min_price=45&#038;max_price=60" @if($min_price == 45) class="current-state" @endif>
                                                <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol">R$ </span>45,00
                                                </span> +
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div id="basel-woocommerce-layered-nav-16" class="filter-widget widget-count-4 col-xs-12 col-sm-6 col-md-3 basel-woocommerce-layered-nav">
                                <h5 class="widget-title">Filtrar por cor</h5>
                                <div class="basel-scroll">
                                    <ul class="show-labels-on swatches-normal swatches-display-list basel-scroll-content">
                                        <li class="wc-layered-nav-term  with-swatch-color @if($filter_color == 'preto') chosen @endif">
                                            <a href="{{route('category')}}?filter_color=preto">
                                                <div class="filter-swatch">
                                                    <span style="background-color: #0a0a0a;"></span>
                                                </div>Preto
                                            </a>
                                            <span class="count">(26)</span>
                                        </li>
                                        <li class="wc-layered-nav-term  with-swatch-color" @if($filter_color == 'branco') chosen @endif>
                                            <a href="{{route('category')}}?filter_color=branco">
                                                <div class="filter-swatch">
                                                    <span style="background-color: #ffffff;"></span>
                                                </div>Branco
                                            </a>
                                            <span class="count">(13)</span>
                                        </li>
                                        <li class="wc-layered-nav-term  with-swatch-color @if($filter_color == 'marrom') chosen @endif">
                                            <a href="{{route('category')}}?filter_color=marrom">
                                                <div class="filter-swatch">
                                                    <span style="background-color: #ba6d09;"></span>
                                                </div>Marrom
                                            </a>
                                            <span class="count">(24)</span>
                                        </li>
                                        <li class="wc-layered-nav-term  with-swatch-color" @if($filter_color == 'amarelo') chosen @endif>
                                            <a href="{{route('category')}}?filter_color=amarelo">
                                                <div class="filter-swatch">
                                                    <span style="background-color: #eded55;"></span>
                                                </div>Amarelo
                                            </a>
                                            <span class="count">(13)</span>
                                        </li>
                                        <li class="wc-layered-nav-term with-swatch-color" @if($filter_color == 'vermelho') chosen @endif>
                                            <a href="{{route('category')}}?filter_color=vermelho">
                                                <div class="filter-swatch">
                                                    <span style="background-color: #dd3333;"></span>
                                                </div>Vermelho
                                            </a>
                                            <span class="count">(3)</span>
                                        </li>
                                        <li class="wc-layered-nav-term  with-swatch-color"@if($filter_color == 'verde') chosen @endif>
                                            <a href="{{route('category')}}?filter_color=verde">
                                                <div class="filter-swatch">
                                                    <span style="background-color: #61a058;"></span>
                                                </div>Verde
                                            </a>
                                            <span class="count">(20)</span>
                                        </li>
                                        <li class="wc-layered-nav-term  with-swatch-color" @if($filter_color == 'azul') chosen @endif>
                                            <a href="{{route('category')}}?filter_color=azul">
                                                <div class="filter-swatch">
                                                    <span style="background-color: #769ec1;"></span>
                                                </div>Azul
                                            </a>
                                            <span class="count">(24)</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div id="basel-woocommerce-layered-nav-17" class="filter-widget widget-count-4 col-xs-12 col-sm-6 col-md-3 basel-woocommerce-layered-nav">
                                <h5 class="widget-title">Filter by size</h5>
                                <div class="basel-scroll">
                                    <ul class="show-labels-on swatches-normal swatches-display-inline basel-scroll-content">
                                        <li class="wc-layered-nav-term  with-swatch-text"><a href="{{route('category')}}?filter_size=l">L</a>
                                            <span class="count">(9)</span>
                                        </li>
                                        <li class="wc-layered-nav-term  with-swatch-text"><a href="{{route('category')}}?filter_size=m">M</a> <span class="count">(14)</span>
                                        </li>
                                        <li class="wc-layered-nav-term  with-swatch-text"><a href="{{route('category')}}?filter_size=s">S</a> <span class="count">(12)</span></li>
                                        <li class="wc-layered-nav-term  with-swatch-text"><a href="{{route('category')}}?filter_size=xl">XL</a> <span class="count">(9)</span></li>
                                        <li class="wc-layered-nav-term  with-swatch-text"><a href="{{route('category')}}?filter_size=xs">XS</a> <span class="count">(7)</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="basel-active-filters">
                        <div class="basel-clear-filters-wrapp">
                            <a class="basel-clear-filters" href="/basel/shop/">Clear filters</a>
                        </div>
                        <div class="widget woocommerce widget_layered_nav_filters">
                            <ul>
                                <li class="chosen"><a rel="nofollow" aria-label="Remove filter" href="https://demo.xtemos.com/basel/shop/?min_price=420&amp;max_price=560&amp;filter_size=xl">Red</a></li>
                                <li class="chosen"><a rel="nofollow" aria-label="Remove filter" href="https://demo.xtemos.com/basel/shop/?min_price=420&amp;max_price=560&amp;filter_color=red">XL</a></li>
                                <li class="chosen"><a rel="nofollow" aria-label="Remove filter" href="https://demo.xtemos.com/basel/shop/?max_price=560&amp;filter_color=red&amp;filter_size=xl">Min <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">£</span>420.00</span></a></li>
                                <li class="chosen"><a rel="nofollow" aria-label="Remove filter" href="https://demo.xtemos.com/basel/shop/?min_price=420&amp;filter_color=red&amp;filter_size=xl">Max <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">£</span>560.00</span></a></li>
                            </ul>
                        </div>
                    </div>


                    <div class="basel-shop-loader"></div>


                    <div class="products elements-grid basel-products-holder  basel-spacing- products-spacing- pagination-infinit row grid-columns-4" data-min_price="" data-max_price="" data-source="main_loop">

                        @include('categories.category-1-infinit-scrolling')

                    </div>

                    <div class="products-footer">
                        <a href="{{route('category.infinit', [$section, $page, $num])}}/?infinit_scrolling" rel="nofollow" class="btn basel-load-more basel-products-load-more load-on-scroll">Carregar mais produtos</a>
                    </div>

                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </div>
    <!-- .main-page-wrapper -->








@endsection