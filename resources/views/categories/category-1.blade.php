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

                        <!-- PRODUTO 1 first select options -->
                        <div class="product-grid-item basel-hover-alt product  col-xs-6 col-sm-4 col-md-3 first  post-1001 type-product status-publish has-post-thumbnail product_cat-bags product_tag-new product_tag-whte first instock featured shipping-taxable purchasable product-type-variable has-default-attributes" data-loop="1" data-id="1001">
                            <div class="product-element-top">
                                <a href="#">
                                    <img width="273" height="273" src="{{asset('faker/product_photos/img1-f.jpg')}}"
                                         class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                         alt=""
                                         srcset="{{asset('faker/product_photos/img1-f.jpg')}} 870w,
                                                 {{asset('faker/product_photos/img1-f.jpg')}} 235w,
                                                 {{asset('faker/product_photos/img1-f.jpg')}} 768w,
                                                 {{asset('faker/product_photos/img1-f.jpg')}} 803w,
                                                 {{asset('faker/product_photos/img1-f.jpg')}} 266w,
                                                 {{asset('faker/product_photos/img1-f.jpg')}} 219w,
                                                 {{asset('faker/product_photos/img1-f.jpg')}} 263w,
                                                 {{asset('faker/product_photos/img1-f.jpg')}} 526w"
                                         sizes="(max-width: 273px) 100vw, 273px" />
                                </a>
                                <div class="hover-img">
                                    <a href="{{url('product')}}/categoria/secao/produto-1001">
                                        <img width="273" height="273" src="{{asset('faker/product_photos/img1-l.jpg')}}"
                                             class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                             alt=""
                                             srcset="{{asset('faker/product_photos/img1-l.jpg')}} 870w,
                                                     {{asset('faker/product_photos/img1-l.jpg')}} 235w,
                                                     {{asset('faker/product_photos/img1-l.jpg')}} 768w,
                                                     {{asset('faker/product_photos/img1-l.jpg')}} 803w,
                                                     {{asset('faker/product_photos/img1-l.jpg')}} 266w,
                                                     {{asset('faker/product_photos/img1-l.jpg')}} 219w,
                                                     {{asset('faker/product_photos/img1-l.jpg')}} 263w,
                                                     {{asset('faker/product_photos/img1-l.jpg')}} w"
                                             sizes="(max-width: 273px) 100vw, 273px" />
                                    </a>
                                </div>
                                <div class="basel-buttons">

                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-1001">
                                        <div class="yith-wcwl-add-button show">
                                            <a href="{{route('wishlist.store')}}?infinit_scrolling&add_to_wishlist=1001" rel="nofollow" data-product-id="1001" data-product-type="variable" class="add_to_wishlist">
                                                Adicionar a lista de desejos
                                            </a>
                                            <img src="{{asset('themes/images/loader/wpspin_light.gif')}}" class="ajax-loading" alt="carregando" width="16" height="16" style="visibility:hidden"/>
                                        </div>

                                        <div class="yith-wcwl-wishlistaddedbrowse hide">
                                            <span class="feedback">Produto Adicionado!</span>
                                            <a href="{{route('wishlist')}}" rel="nofollow">Ver lista de desejos</a>
                                        </div>

                                        <div class="yith-wcwl-wishlistexistsbrowse hide">
                                            <span class="feedback">O produto já está na lista de desejos!</span>
                                            <a href="{{route('wishlist')}}" rel="nofollow">Ver lista de desejos</a>
                                        </div>

                                        <div style="clear:both"></div>
                                        <div class="yith-wcwl-wishlistaddresponse"></div>

                                    </div>

                                    <div class="clear"></div>

                                    <div class="basel-compare-btn product-compare-button">
                                        <a class="button" href="{{route('compare')}}" data-added-text="Compare Produtos" data-id="1001">Compare</a></div>
                                    <div class="quick-view">
                                        <a href="{{url('product.show')}}" class="open-quick-view" data-id="1001">Vusualização Rapida</a>
                                    </div>
                                </div>
                            </div>
                            <h3 class="product-title">
                                <a href="{{url('product')}}/categoria/secao/produto-1001">Produto 1</a>
                            </h3>
                            <div class="wrap-price">
                                <div class="wrapp-swap">
                                    <div class="swap-elements">
                                        <!-- Avaliação -->
                                        <div class="star-rating">
                                            <span style="width:80%">Avaliado <strong class="rating">4</strong> fora de 5</span>
                                        </div>

                                        <span class="price">
                                            <span class="woocommerce-Price-amount amount">
                                                <span class="woocommerce-Price-currencySymbol">R$ </span>12,00
                                            </span> &ndash;
                                            <span class="woocommerce-Price-amount amount">
                                                <span class="woocommerce-Price-currencySymbol">R$ </span>15,00
                                            </span>
                                        </span>
                                        <!-- redireciona para selecionar as opções -->
                                        <div class="btn-add">
                                            <a href="{{url('product')}}/categoria/secao/produto-1001"
                                               data-quantity="1" class="button product_type_variable add_to_cart_button"
                                               data-product_id="1001"
                                               data-product_sku=""
                                               aria-label="Selecione as opções do produto 1" rel="nofollow">Selecione as opções
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- OPÇÃO DE CORES -->
                                <div class="swatches-on-grid">
                                    <div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-"
                                         style="background-color:#eded55;"
                                         data-image-src="{{asset('faker/product_photos/img2-l.jpg')}}"
                                         data-image-srcset="{{asset('faker/product_photos/img2-f.jpg')}} 870w,
                                                            {{asset('faker/product_photos/img2-f.jpg')}} 235w,
                                                            {{asset('faker/product_photos/img2-f.jpg')}} 768w,
                                                            {{asset('faker/product_photos/img2-f.jpg')}} 803w,
                                                            {{asset('faker/product_photos/img2-f.jpg')}} 266w,
                                                            {{asset('faker/product_photos/img2-f.jpg')}} 219w,
                                                            {{asset('faker/product_photos/img2-f.jpg')}} 263w,
                                                            {{asset('faker/product_photos/img2-f.jpg')}} 526w"
                                         data-image-sizes="(max-width: 870px) 100vw, 870px">Azul
                                    </div>
                                    <div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-"
                                         style="background-color:#769ec1;"
                                         data-image-src="{{asset('faker/product_photos/img1-f.jpg')}}"
                                         data-image-srcset="{{asset('faker/product_photos/img1-f.jpg')}} 870w,
                                                            {{asset('faker/product_photos/img1-f.jpg')}} 235w,
                                                            {{asset('faker/product_photos/img1-f.jpg')}} 768w,
                                                            {{asset('faker/product_photos/img1-f.jpg')}} 803w,
                                                            {{asset('faker/product_photos/img1-f.jpg')}} 266w,
                                                            {{asset('faker/product_photos/img1-f.jpg')}} 219w,
                                                            {{asset('faker/product_photos/img1-f.jpg')}} 263w,
                                                            {{asset('faker/product_photos/img1-f.jpg')}} 526w"
                                         data-image-sizes="(max-width: 870px) 100vw, 870px">Azul                              </div>
                                </div>
                            </div>

                        </div>

                        <!-- PRODUTO 2 select options New-->
                        <div class="product-grid-item basel-hover-alt product  col-xs-6 col-sm-4 col-md-3 post-1002 type-product status-publish has-post-thumbnail product_cat-shoes instock featured shipping-taxable purchasable product-type-variable has-default-attributes" data-loop="2" data-id="1002">

                            <div class="product-element-top">

                                <div class="product-labels labels-rounded">
                                    <span class="new product-label">Novo</span>
                                </div>

                                <a href="#">
                                    <img width="273" height="273" src="{{asset('faker/product_photos/img3-f.jpg')}}"
                                         class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                         alt=""
                                         srcset="{{asset('faker/product_photos/img3-f.jpg')}} 870w,
                                                 {{asset('faker/product_photos/img3-f.jpg')}} 235w,
                                                 {{asset('faker/product_photos/img3-f.jpg')}} 768w,
                                                 {{asset('faker/product_photos/img3-f.jpg')}} 803w,
                                                 {{asset('faker/product_photos/img3-f.jpg')}} 266w,
                                                 {{asset('faker/product_photos/img3-f.jpg')}} 219w,
                                                 {{asset('faker/product_photos/img3-f.jpg')}} 263w,
                                                 {{asset('faker/product_photos/img3-f.jpg')}} 526w"
                                         sizes="(max-width: 273px) 100vw, 273px" />
                                </a>
                                <div class="hover-img">
                                    <a href="{{url('product')}}/categoria/secao/produto-1002">
                                        <img width="273" height="273" src="{{asset('faker/product_photos/img3-l.jpg')}}"
                                             class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                             alt=""
                                             srcset="{{asset('faker/product_photos/img3-l.jpg')}} 870w,
                                                     {{asset('faker/product_photos/img3-l.jpg')}} 235w,
                                                     {{asset('faker/product_photos/img3-l.jpg')}} 768w,
                                                     {{asset('faker/product_photos/img3-l.jpg')}} 803w,
                                                     {{asset('faker/product_photos/img3-l.jpg')}} 266w,
                                                     {{asset('faker/product_photos/img3-l.jpg')}} 219w,
                                                     {{asset('faker/product_photos/img3-l.jpg')}} 263w,
                                                     {{asset('faker/product_photos/img3-l.jpg')}} w"
                                             sizes="(max-width: 273px) 100vw, 273px" />
                                    </a>
                                </div>
                                <div class="basel-buttons">
                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-1002">
                                        <div class="yith-wcwl-add-button show">
                                            <a href="{{route('wishlist.store')}}?infinit_scrolling&add_to_wishlist=1002" rel="nofollow" data-product-id="1002" data-product-type="variable" class="add_to_wishlist">
                                                Adicionar a lista de desejos
                                            </a>
                                            <img src="{{asset('themes/images/loader/wpspin_light.gif')}}" class="ajax-loading" alt="carregando" width="16" height="16" style="visibility:hidden"/>
                                        </div>

                                        <div class="yith-wcwl-wishlistaddedbrowse hide">
                                            <span class="feedback">Produto Adicionado!</span>
                                            <a href="{{route('wishlist')}}" rel="nofollow">Ver lista de desejos</a>
                                        </div>

                                        <div class="yith-wcwl-wishlistexistsbrowse hide">
                                            <span class="feedback">O produto já está na lista de desejos!</span>
                                            <a href="{{route('wishlist')}}" rel="nofollow">Ver lista de desejos</a>
                                        </div>

                                        <div style="clear:both"></div>
                                        <div class="yith-wcwl-wishlistaddresponse"></div>

                                    </div>

                                    <div class="clear"></div>

                                    <div class="basel-compare-btn product-compare-button">
                                        <a class="button" href="{{route('compare')}}" data-added-text="Compare Produtos" data-id="1002">Compare</a></div>
                                    <div class="quick-view">
                                        <a href="{{url('product.show')}}" class="open-quick-view" data-id="1002">Vusualização Rapida</a>
                                    </div>
                                </div>
                            </div>
                            <h3 class="product-title">
                                <a href="{{url('product')}}/categoria/secao/produto-1002">Produto 2</a>
                            </h3>

                            <div class="wrap-price">
                                <div class="wrapp-swap">
                                    <div class="swap-elements">
                                        <!-- Avaliação -->
                                        <div class="star-rating">
                                            <span style="width:80%">Avaliado <strong class="rating">4</strong> fora de 5</span>
                                        </div>

                                        <span class="price">
                                            <span class="woocommerce-Price-amount amount">
                                                <span class="woocommerce-Price-currencySymbol">R$ </span>12,00
                                            </span> &ndash;
                                            <span class="woocommerce-Price-amount amount">
                                                <span class="woocommerce-Price-currencySymbol">R$ </span>15,00
                                            </span>
                                        </span>
                                        <!-- redireciona para selecionar as opções -->
                                        <div class="btn-add">
                                            <a href="{{url('product')}}/categoria/secao/produto-1002"
                                               data-quantity="1" class="button product_type_variable add_to_cart_button"
                                               data-product_id="1002"
                                               data-product_sku=""
                                               aria-label="Selecione as opções do produto 1" rel="nofollow">Selecione as opções
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- OPÇÃO DE CORES -->
                                <div class="swatches-on-grid">
                                    <div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-"
                                         style="background-color:#000000;"
                                         data-image-src="{{asset('faker/product_photos/img4-l.jpg')}}"
                                         data-image-srcset="{{asset('faker/product_photos/img4-f.jpg')}} 870w,
                                                            {{asset('faker/product_photos/img4-f.jpg')}} 235w,
                                                            {{asset('faker/product_photos/img4-f.jpg')}} 768w,
                                                            {{asset('faker/product_photos/img4-f.jpg')}} 803w,
                                                            {{asset('faker/product_photos/img4-f.jpg')}} 266w,
                                                            {{asset('faker/product_photos/img4-f.jpg')}} 219w,
                                                            {{asset('faker/product_photos/img4-f.jpg')}} 263w,
                                                            {{asset('faker/product_photos/img4-f.jpg')}} 526w"
                                         data-image-sizes="(max-width: 870px) 100vw, 870px">Preto
                                    </div>
                                    <div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-"
                                         style="background-color:#ffffff;"
                                         data-image-src="{{asset('faker/product_photos/img3-f.jpg')}}"
                                         data-image-srcset="{{asset('faker/product_photos/img3-f.jpg')}} 870w,
                                                            {{asset('faker/product_photos/img3-f.jpg')}} 235w,
                                                            {{asset('faker/product_photos/img3-f.jpg')}} 768w,
                                                            {{asset('faker/product_photos/img3-f.jpg')}} 803w,
                                                            {{asset('faker/product_photos/img3-f.jpg')}} 266w,
                                                            {{asset('faker/product_photos/img3-f.jpg')}} 219w,
                                                            {{asset('faker/product_photos/img3-f.jpg')}} 263w,
                                                            {{asset('faker/product_photos/img3-f.jpg')}} 526w"
                                        data-image-sizes="(max-width: 870px) 100vw, 870px">Branco
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!--  Separação visible-xs-block-->
                        <div class="clearfix visible-xs-block"></div>




                        <!-- PRODUTO 3 add cart-->
                        <div class="product-grid-item basel-hover-alt product  col-xs-6 col-sm-4 col-md-3 post-1003 type-product status-publish has-post-thumbnail product_cat-woman instock shipping-taxable purchasable product-type-variable has-default-attributes" data-loop="3" data-id="1003">

                            <div class="product-element-top">

                                <a href="#">
                                    <img width="273" height="273" src="{{asset('faker/product_photos/img5-f.jpg')}}"
                                         class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                         alt=""
                                         srcset="{{asset('faker/product_photos/img5-f.jpg')}} 870w,
                                                 {{asset('faker/product_photos/img5-f.jpg')}} 235w,
                                                 {{asset('faker/product_photos/img5-f.jpg')}} 768w,
                                                 {{asset('faker/product_photos/img5-f.jpg')}} 803w,
                                                 {{asset('faker/product_photos/img5-f.jpg')}} 266w,
                                                 {{asset('faker/product_photos/img5-f.jpg')}} 219w,
                                                 {{asset('faker/product_photos/img5-f.jpg')}} 263w,
                                                 {{asset('faker/product_photos/img5-f.jpg')}} 526w"
                                         sizes="(max-width: 273px) 100vw, 273px" />
                                </a>
                                <div class="hover-img">
                                    <a href="{{url('product')}}/categoria/secao/produto-1003">
                                        <img width="273" height="273" src="{{asset('faker/product_photos/img5-l.jpg')}}"
                                             class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                             alt=""
                                             srcset="{{asset('faker/product_photos/img5-l.jpg')}} 870w,
                                                    {{asset('faker/product_photos/img5-l.jpg')}} 235w,
                                                    {{asset('faker/product_photos/img5-l.jpg')}} 768w,
                                                    {{asset('faker/product_photos/img5-l.jpg')}} 803w,
                                                    {{asset('faker/product_photos/img5-l.jpg')}} 266w,
                                                    {{asset('faker/product_photos/img5-l.jpg')}} 219w,
                                                    {{asset('faker/product_photos/img5-l.jpg')}} 263w,
                                                    {{asset('faker/product_photos/img5-l.jpg')}} w"
                                             sizes="(max-width: 273px) 100vw, 273px" />
                                    </a>
                                </div>
                                <div class="basel-buttons">
                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-1003">
                                        <div class="yith-wcwl-add-button show">
                                            <a href="{{route('wishlist.store')}}?infinit_scrolling&add_to_wishlist=1003" rel="nofollow" data-product-id="1003" data-product-type="variable" class="add_to_wishlist">
                                                Adicionar a lista de desejos
                                            </a>
                                            <img src="{{asset('themes/images/loader/wpspin_light.gif')}}" class="ajax-loading" alt="carregando" width="16" height="16" style="visibility:hidden"/>
                                        </div>

                                        <div class="yith-wcwl-wishlistaddedbrowse hide">
                                            <span class="feedback">Produto Adicionado!</span>
                                            <a href="{{route('wishlist')}}" rel="nofollow">Ver lista de desejos</a>
                                        </div>

                                        <div class="yith-wcwl-wishlistexistsbrowse hide">
                                            <span class="feedback">O produto já está na lista de desejos!</span>
                                            <a href="{{route('wishlist')}}" rel="nofollow">Ver lista de desejos</a>
                                        </div>

                                        <div style="clear:both"></div>
                                        <div class="yith-wcwl-wishlistaddresponse"></div>

                                    </div>

                                    <div class="clear"></div>

                                    <div class="basel-compare-btn product-compare-button">
                                        <a class="button" href="{{route('compare')}}" data-added-text="Compare Produtos" data-id="1003">Compare</a>
                                    </div>
                                    <div class="quick-view">
                                        <a href="{{url('product.show')}}" class="open-quick-view" data-id="1003">Vusualização Rapida</a>
                                    </div>
                                </div>
                            </div>
                            <h3 class="product-title">
                                <a href="{{url('product')}}/categoria/secao/produto-1003">Produto 3</a></h3>

                            <div class="wrap-price">
                                <div class="wrapp-swap">
                                    <div class="swap-elements">
                                        <!-- Avaliação -->
                                        <div class="star-rating">
                                            <span style="width:80%">Avaliado <strong class="rating">4</strong> fora de 5</span>
                                        </div>

                                        <span class="price">
                                            <span class="woocommerce-Price-amount amount">
                                                <span class="woocommerce-Price-currencySymbol">R$ </span>12,00
                                            </span> &ndash;
                                            <span class="woocommerce-Price-amount amount">
                                                <span class="woocommerce-Price-currencySymbol">R$ </span>15,00
                                            </span>
                                        </span>
                                        <!-- Adiciona ao carrinho -->
                                        <div class="btn-add">
                                            <a href="/basel/shop/?infinit_scrolling&amp;add-to-cart=1003"
                                               data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart basel-tooltip"
                                               data-product_id="1003"
                                               data-product_sku=""
                                               aria-label="Adicione o produto 3 ao seu carrinho " rel="nofollow">
                                                <span class="basel-tooltip-label">Adicionar ao carrinho</span>Adicionar
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <!--  Separação visible-sm-block-->
                        <div class="clearfix visible-sm-block"></div>

                        <!-- PRODUTO 4 add cart onsale last-->
                        <div class="product-grid-item basel-hover-alt product  col-xs-6 col-sm-4 col-md-3 post-1004 type-product status-publish has-post-thumbnail product_cat-woman instock shipping-taxable purchasable has-default-attributes" data-loop="4" data-id="1004">

                            <div class="product-element-top">
                                <div class="product-labels labels-rounded">
                                    <span class="onsale product-label">-29%</span>
                                </div>

                                <a href="#">
                                    <img width="273" height="273" src="{{asset('faker/product_photos/img6-f.jpg')}}"
                                         class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                         alt=""
                                         srcset="{{asset('faker/product_photos/img6-f.jpg')}} 870w,
                                                 {{asset('faker/product_photos/img6-f.jpg')}} 235w,
                                                 {{asset('faker/product_photos/img6-f.jpg')}} 768w,
                                                 {{asset('faker/product_photos/img6-f.jpg')}} 803w,
                                                 {{asset('faker/product_photos/img6-f.jpg')}} 266w,
                                                 {{asset('faker/product_photos/img6-f.jpg')}} 219w,
                                                 {{asset('faker/product_photos/img6-f.jpg')}} 263w,
                                                 {{asset('faker/product_photos/img6-f.jpg')}} 526w"
                                         sizes="(max-width: 273px) 100vw, 273px" />
                                </a>
                                <div class="hover-img">
                                    <a href="{{url('product')}}/categoria/secao/produto-1003">
                                        <img width="273" height="273" src="{{asset('faker/product_photos/img6-l.jpg')}}"
                                             class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                             alt=""
                                             srcset="{{asset('faker/product_photos/img6-l.jpg')}} 870w,
                                                    {{asset('faker/product_photos/img6-l.jpg')}} 235w,
                                                    {{asset('faker/product_photos/img6-l.jpg')}} 768w,
                                                    {{asset('faker/product_photos/img6-l.jpg')}} 803w,
                                                    {{asset('faker/product_photos/img6-l.jpg')}} 266w,
                                                    {{asset('faker/product_photos/img6-l.jpg')}} 219w,
                                                    {{asset('faker/product_photos/img6-l.jpg')}} 263w,
                                                    {{asset('faker/product_photos/img6-l.jpg')}} w"
                                             sizes="(max-width: 273px) 100vw, 273px" />
                                    </a>
                                </div>
                                <div class="basel-buttons">
                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-1004">
                                        <div class="yith-wcwl-add-button show">
                                            <a href="{{route('wishlist.store')}}?infinit_scrolling&add_to_wishlist=1004" rel="nofollow" data-product-id="1004" data-product-type="variable" class="add_to_wishlist">
                                                Adicionar a lista de desejos
                                            </a>
                                            <img src="{{asset('themes/images/loader/wpspin_light.gif')}}" class="ajax-loading" alt="carregando" width="16" height="16" style="visibility:hidden"/>
                                        </div>

                                        <div class="yith-wcwl-wishlistaddedbrowse hide">
                                            <span class="feedback">Produto Adicionado!</span>
                                            <a href="{{route('wishlist')}}" rel="nofollow">Ver lista de desejos</a>
                                        </div>

                                        <div class="yith-wcwl-wishlistexistsbrowse hide">
                                            <span class="feedback">O produto já está na lista de desejos!</span>
                                            <a href="{{route('wishlist')}}" rel="nofollow">Ver lista de desejos</a>
                                        </div>

                                        <div style="clear:both"></div>
                                        <div class="yith-wcwl-wishlistaddresponse"></div>

                                    </div>

                                    <div class="clear"></div>

                                    <div class="basel-compare-btn product-compare-button">
                                        <a class="button" href="{{route('compare')}}" data-added-text="Compare Produtos" data-id="1004">Compare</a>
                                    </div>
                                    <div class="quick-view">
                                        <a href="{{url('product.show')}}" class="open-quick-view" data-id="1004">Vusualização Rapida</a>
                                    </div>
                                </div>
                            </div>
                            <h3 class="product-title">
                                <a href="{{url('product')}}/categoria/secao/produto-1004">Produto 4</a>
                            </h3>

                            <div class="wrap-price">
                                <div class="wrapp-swap">
                                    <div class="swap-elements">
                                        <!-- Avaliação -->
                                        <div class="star-rating">
                                            <span style="width:80%">Avaliado <strong class="rating">4</strong> fora de 5</span>
                                        </div>

                                        <span class="price">
                                            <span class="woocommerce-Price-amount amount">
                                                <span class="woocommerce-Price-currencySymbol">R$ </span>12,00
                                            </span> &ndash;
                                            <span class="woocommerce-Price-amount amount">
                                                <span class="woocommerce-Price-currencySymbol">R$ </span>15,00
                                            </span>
                                        </span>
                                        <!-- Adiciona ao carrinho -->
                                        <div class="btn-add">
                                            <a href="/basel/shop/?infinit_scrolling&amp;add-to-cart=1004"
                                               data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart basel-tooltip"
                                               data-product_id="1004"
                                               data-product_sku=""
                                               aria-label="Adicione o produto 4 ao seu carrinho " rel="nofollow">
                                                <span class="basel-tooltip-label">Adicionar ao carrinho</span>Adicionar
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix visible-xs-block"></div>
                        <div class="clearfix visible-md-block visible-lg-block"></div>

                        <!-- PRODUTO 5 add cart onsale first-->
                        <div class="product-grid-item basel-hover-alt product  col-xs-6 col-sm-4 col-md-3 first  post-19730 type-product status-publish has-post-thumbnail product_cat-accessories product_tag-basic product_tag-new first instock featured shipping-taxable purchasable product-type-variable has-default-attributes" data-loop="5" data-id="19730">

                            <div class="product-element-top">
                                <a href="https://demo.xtemos.com/basel/shop/accessories/before-decaf-phone-case/">
                                    <img width="273" height="348" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-21.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-21.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-21-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-21-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-21-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-21-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-21-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-21-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-21-526x671.jpg 526w" sizes="(max-width: 273px) 100vw, 273px" />	</a>
                                <div class="hover-img">
                                    <a href="https://demo.xtemos.com/basel/shop/accessories/before-decaf-phone-case/">
                                        <img width="273" height="348" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-22.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-22.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-22-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-22-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-22-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-22-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-22-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-22-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-22-526x671.jpg 526w" sizes="(max-width: 273px) 100vw, 273px" />				</a>
                                </div>
                                <div class="basel-buttons">

                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-19730">
                                        <div class="yith-wcwl-add-button show" style="display:block">


                                            <a href="/basel/shop/?infinit_scrolling&#038;add_to_wishlist=19730" rel="nofollow" data-product-id="19730" data-product-type="variable" class="add_to_wishlist" >
                                                Add to Wishlist</a>
                                            <img src="https://demo.xtemos.com/basel/wp-content/plugins/yith-woocommerce-wishlist/assets/images/wpspin_light.gif" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" />
                                        </div>

                                        <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;">
                                            <span class="feedback">Product added!</span>
                                            <a href="https://demo.xtemos.com/basel/wishlist/" rel="nofollow">
                                                Browse Wishlist	        </a>
                                        </div>

                                        <div class="yith-wcwl-wishlistexistsbrowse hide" style="display:none">
                                            <span class="feedback">The product is already in the wishlist!</span>
                                            <a href="https://demo.xtemos.com/basel/wishlist/" rel="nofollow">
                                                Browse Wishlist	        </a>
                                        </div>

                                        <div style="clear:both"></div>
                                        <div class="yith-wcwl-wishlistaddresponse"></div>

                                    </div>

                                    <div class="clear"></div>		<div class="basel-compare-btn product-compare-button"><a class="button" href="https://demo.xtemos.com/basel/compare/" data-added-text="Compare products" data-id="19730">Compare</a></div>					<div class="quick-view">
                                        <a
                                                href="https://demo.xtemos.com/basel/shop/accessories/before-decaf-phone-case/"
                                                class="open-quick-view"
                                                data-id="19730">Quick View</a>
                                    </div>
                                </div>
                            </div>
                            <h3 class="product-title"><a href="https://demo.xtemos.com/basel/shop/accessories/before-decaf-phone-case/">Before decaf phone case</a></h3>

                            <div class="wrap-price">
                                <div class="wrapp-swap">
                                    <div class="swap-elements">

                                        <span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&pound;</span>49.00</span></span>
                                        <div class="btn-add">
                                            <a href="https://demo.xtemos.com/basel/shop/accessories/before-decaf-phone-case/" data-quantity="1" class="button product_type_variable add_to_cart_button" data-product_id="19730" data-product_sku="" aria-label="Select options for &ldquo;Before decaf phone case&rdquo;" rel="nofollow">Select options</a>			</div>
                                    </div>
                                </div>
                            </div>



                        </div>

                        <!-- PRODUTO 6 add cart New -->
                        <div class="product-grid-item basel-hover-alt product  col-xs-6 col-sm-4 col-md-3 post-19667 type-product status-publish has-post-thumbnail product_cat-jewellery instock shipping-taxable purchasable product-type-simple" data-loop="6" data-id="19667">

                            <div class="product-element-top">
                                <a href="https://demo.xtemos.com/basel/shop/jewellery/black-sphere-and-beads/">
                                    <img width="273" height="348" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/jewelry-6.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/jewelry-6.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/jewelry-6-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/jewelry-6-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/jewelry-6-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/jewelry-6-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/jewelry-6-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/jewelry-6-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/jewelry-6-526x671.jpg 526w" sizes="(max-width: 273px) 100vw, 273px" />	</a>
                                <div class="hover-img">
                                    <a href="https://demo.xtemos.com/basel/shop/jewellery/black-sphere-and-beads/">
                                        <img width="273" height="348" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/jewelry-14.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/jewelry-14.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/jewelry-14-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/jewelry-14-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/jewelry-14-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/jewelry-14-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/jewelry-14-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/jewelry-14-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/jewelry-14-526x671.jpg 526w" sizes="(max-width: 273px) 100vw, 273px" />				</a>
                                </div>
                                <div class="basel-buttons">

                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-19667">
                                        <div class="yith-wcwl-add-button show" style="display:block">


                                            <a href="/basel/shop/?infinit_scrolling&#038;add_to_wishlist=19667" rel="nofollow" data-product-id="19667" data-product-type="simple" class="add_to_wishlist" >
                                                Add to Wishlist</a>
                                            <img src="https://demo.xtemos.com/basel/wp-content/plugins/yith-woocommerce-wishlist/assets/images/wpspin_light.gif" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" />
                                        </div>

                                        <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;">
                                            <span class="feedback">Product added!</span>
                                            <a href="https://demo.xtemos.com/basel/wishlist/" rel="nofollow">
                                                Browse Wishlist	        </a>
                                        </div>

                                        <div class="yith-wcwl-wishlistexistsbrowse hide" style="display:none">
                                            <span class="feedback">The product is already in the wishlist!</span>
                                            <a href="https://demo.xtemos.com/basel/wishlist/" rel="nofollow">
                                                Browse Wishlist	        </a>
                                        </div>

                                        <div style="clear:both"></div>
                                        <div class="yith-wcwl-wishlistaddresponse"></div>

                                    </div>

                                    <div class="clear"></div>		<div class="basel-compare-btn product-compare-button"><a class="button" href="https://demo.xtemos.com/basel/compare/" data-added-text="Compare products" data-id="19667">Compare</a></div>					<div class="quick-view">
                                        <a
                                                href="https://demo.xtemos.com/basel/shop/jewellery/black-sphere-and-beads/"
                                                class="open-quick-view"
                                                data-id="19667">Quick View</a>
                                    </div>
                                </div>
                            </div>
                            <h3 class="product-title"><a href="https://demo.xtemos.com/basel/shop/jewellery/black-sphere-and-beads/">Black sphere and beads</a></h3>

                            <div class="wrap-price">
                                <div class="wrapp-swap">
                                    <div class="swap-elements">

                                        <span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&pound;</span>19.00</span></span>
                                        <div class="btn-add">
                                            <a href="/basel/shop/?infinit_scrolling&#038;add-to-cart=19667" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="19667" data-product_sku="" aria-label="Add &ldquo;Black sphere and beads&rdquo; to your cart" rel="nofollow">Add to cart</a>			</div>
                                    </div>
                                </div>
                            </div>



                        </div>

                        <div class="clearfix visible-xs-block"></div>
                        <div class="clearfix visible-sm-block"></div>

                        <div class="product-grid-item basel-hover-alt product  col-xs-6 col-sm-4 col-md-3 post-19689 type-product status-publish has-post-thumbnail product_cat-accessories product_tag-basic product_tag-black instock featured shipping-taxable purchasable product-type-simple" data-loop="7" data-id="19689">

                            <div class="product-element-top">
                                <a href="https://demo.xtemos.com/basel/shop/accessories/black-umbrella-in-handle/">
                                    <img width="273" height="348" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-14.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-14.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-14-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-14-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-14-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-14-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-14-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-14-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-14-526x671.jpg 526w" sizes="(max-width: 273px) 100vw, 273px" />	</a>
                                <div class="hover-img">
                                    <a href="https://demo.xtemos.com/basel/shop/accessories/black-umbrella-in-handle/">
                                        <img width="273" height="348" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-18.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-18.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-18-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-18-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-18-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-18-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-18-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-18-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-18-526x671.jpg 526w" sizes="(max-width: 273px) 100vw, 273px" />				</a>
                                </div>
                                <div class="basel-buttons">

                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-19689">
                                        <div class="yith-wcwl-add-button show" style="display:block">


                                            <a href="/basel/shop/?infinit_scrolling&#038;add_to_wishlist=19689" rel="nofollow" data-product-id="19689" data-product-type="simple" class="add_to_wishlist" >
                                                Add to Wishlist</a>
                                            <img src="https://demo.xtemos.com/basel/wp-content/plugins/yith-woocommerce-wishlist/assets/images/wpspin_light.gif" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" />
                                        </div>

                                        <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;">
                                            <span class="feedback">Product added!</span>
                                            <a href="https://demo.xtemos.com/basel/wishlist/" rel="nofollow">
                                                Browse Wishlist	        </a>
                                        </div>

                                        <div class="yith-wcwl-wishlistexistsbrowse hide" style="display:none">
                                            <span class="feedback">The product is already in the wishlist!</span>
                                            <a href="https://demo.xtemos.com/basel/wishlist/" rel="nofollow">
                                                Browse Wishlist	        </a>
                                        </div>

                                        <div style="clear:both"></div>
                                        <div class="yith-wcwl-wishlistaddresponse"></div>

                                    </div>

                                    <div class="clear"></div>		<div class="basel-compare-btn product-compare-button"><a class="button" href="https://demo.xtemos.com/basel/compare/" data-added-text="Compare products" data-id="19689">Compare</a></div>					<div class="quick-view">
                                        <a
                                                href="https://demo.xtemos.com/basel/shop/accessories/black-umbrella-in-handle/"
                                                class="open-quick-view"
                                                data-id="19689">Quick View</a>
                                    </div>
                                </div>
                            </div>
                            <h3 class="product-title"><a href="https://demo.xtemos.com/basel/shop/accessories/black-umbrella-in-handle/">Black umbrella in handle</a></h3>

                            <div class="wrap-price">
                                <div class="wrapp-swap">
                                    <div class="swap-elements">
                                        <div class="star-rating"><span style="width:100%">Rated <strong class="rating">5.00</strong> out of 5</span></div>
                                        <span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&pound;</span>99.00</span></span>
                                        <div class="btn-add">
                                            <a href="/basel/shop/?infinit_scrolling&#038;add-to-cart=19689" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="19689" data-product_sku="" aria-label="Add &ldquo;Black umbrella in handle&rdquo; to your cart" rel="nofollow">Add to cart</a>			</div>
                                    </div>
                                </div>
                            </div>



                        </div>

                        <div class="product-grid-item basel-hover-alt product  col-xs-6 col-sm-4 col-md-3 last  post-19564 type-product status-publish has-post-thumbnail product_cat-watches last instock featured shipping-taxable purchasable product-type-simple" data-loop="8" data-id="19564">

                            <div class="product-element-top">
                                <a href="https://demo.xtemos.com/basel/shop/watches/19564/">
                                    <img width="273" height="348" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/watches-2.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/watches-2.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/watches-2-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/watches-2-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/watches-2-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/watches-2-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/watches-2-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/watches-2-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/watches-2-526x671.jpg 526w" sizes="(max-width: 273px) 100vw, 273px" />	</a>
                                <div class="hover-img">
                                    <a href="https://demo.xtemos.com/basel/shop/watches/19564/">
                                        <img width="273" height="348" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/watches-13.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/watches-13.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/watches-13-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/watches-13-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/watches-13-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/watches-13-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/watches-13-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/watches-13-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/watches-13-526x671.jpg 526w" sizes="(max-width: 273px) 100vw, 273px" />				</a>
                                </div>
                                <div class="basel-buttons">

                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-19564">
                                        <div class="yith-wcwl-add-button show" style="display:block">


                                            <a href="/basel/shop/?infinit_scrolling&#038;add_to_wishlist=19564" rel="nofollow" data-product-id="19564" data-product-type="simple" class="add_to_wishlist" >
                                                Add to Wishlist</a>
                                            <img src="https://demo.xtemos.com/basel/wp-content/plugins/yith-woocommerce-wishlist/assets/images/wpspin_light.gif" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" />
                                        </div>

                                        <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;">
                                            <span class="feedback">Product added!</span>
                                            <a href="https://demo.xtemos.com/basel/wishlist/" rel="nofollow">
                                                Browse Wishlist	        </a>
                                        </div>

                                        <div class="yith-wcwl-wishlistexistsbrowse hide" style="display:none">
                                            <span class="feedback">The product is already in the wishlist!</span>
                                            <a href="https://demo.xtemos.com/basel/wishlist/" rel="nofollow">
                                                Browse Wishlist	        </a>
                                        </div>

                                        <div style="clear:both"></div>
                                        <div class="yith-wcwl-wishlistaddresponse"></div>

                                    </div>

                                    <div class="clear"></div>		<div class="basel-compare-btn product-compare-button"><a class="button" href="https://demo.xtemos.com/basel/compare/" data-added-text="Compare products" data-id="19564">Compare</a></div>					<div class="quick-view">
                                        <a
                                                href="https://demo.xtemos.com/basel/shop/watches/19564/"
                                                class="open-quick-view"
                                                data-id="19564">Quick View</a>
                                    </div>
                                </div>
                            </div>
                            <h3 class="product-title"><a href="https://demo.xtemos.com/basel/shop/watches/19564/">Bold metallic watch</a></h3>

                            <div class="wrap-price">
                                <div class="wrapp-swap">
                                    <div class="swap-elements">

                                        <span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&pound;</span>10.00</span></span>
                                        <div class="btn-add">
                                            <a href="/basel/shop/?infinit_scrolling&#038;add-to-cart=19564" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="19564" data-product_sku="" aria-label="Add &ldquo;Bold metallic watch&rdquo; to your cart" rel="nofollow">Add to cart</a>			</div>
                                    </div>
                                </div>
                            </div>



                        </div>

                        <div class="clearfix visible-xs-block"></div>
                        <div class="clearfix visible-md-block visible-lg-block"></div>

                        <div class="product-grid-item basel-hover-alt product  col-xs-6 col-sm-4 col-md-3 first  post-19528 type-product status-publish has-post-thumbnail product_cat-woman product_tag-beautiful first instock shipping-taxable purchasable product-type-variable has-default-attributes" data-loop="9" data-id="19528">

                            <div class="product-element-top">
                                <a href="https://demo.xtemos.com/basel/shop/woman/jur-detail-jacket/">
                                    <img width="273" height="348" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-1-273x348.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-1-273x348.jpg 273w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-1-546x697.jpg 546w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-1-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-1-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-1-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-1-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-1-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-1-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-1-526x671.jpg 526w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-1.jpg 870w" sizes="(max-width: 273px) 100vw, 273px" />	</a>
                                <div class="hover-img">
                                    <a href="https://demo.xtemos.com/basel/shop/woman/jur-detail-jacket/">
                                        <img width="273" height="348" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-3-273x348.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-3-273x348.jpg 273w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-3-546x697.jpg 546w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-3-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-3-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-3-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-3-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-3-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-3-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-3-526x671.jpg 526w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-3.jpg 870w" sizes="(max-width: 273px) 100vw, 273px" />				</a>
                                </div>
                                <div class="basel-buttons">

                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-19528">
                                        <div class="yith-wcwl-add-button show" style="display:block">


                                            <a href="/basel/shop/?infinit_scrolling&#038;add_to_wishlist=19528" rel="nofollow" data-product-id="19528" data-product-type="variable" class="add_to_wishlist" >
                                                Add to Wishlist</a>
                                            <img src="https://demo.xtemos.com/basel/wp-content/plugins/yith-woocommerce-wishlist/assets/images/wpspin_light.gif" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" />
                                        </div>

                                        <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;">
                                            <span class="feedback">Product added!</span>
                                            <a href="https://demo.xtemos.com/basel/wishlist/" rel="nofollow">
                                                Browse Wishlist	        </a>
                                        </div>

                                        <div class="yith-wcwl-wishlistexistsbrowse hide" style="display:none">
                                            <span class="feedback">The product is already in the wishlist!</span>
                                            <a href="https://demo.xtemos.com/basel/wishlist/" rel="nofollow">
                                                Browse Wishlist	        </a>
                                        </div>

                                        <div style="clear:both"></div>
                                        <div class="yith-wcwl-wishlistaddresponse"></div>

                                    </div>

                                    <div class="clear"></div>		<div class="basel-compare-btn product-compare-button"><a class="button" href="https://demo.xtemos.com/basel/compare/" data-added-text="Compare products" data-id="19528">Compare</a></div>					<div class="quick-view">
                                        <a
                                                href="https://demo.xtemos.com/basel/shop/woman/jur-detail-jacket/"
                                                class="open-quick-view"
                                                data-id="19528">Quick View</a>
                                    </div>
                                </div>
                            </div>
                            <h3 class="product-title"><a href="https://demo.xtemos.com/basel/shop/woman/jur-detail-jacket/">Cem and cutwork jacket</a></h3>

                            <div class="wrap-price">
                                <div class="wrapp-swap">
                                    <div class="swap-elements">
                                        <div class="star-rating"><span style="width:80%">Rated <strong class="rating">4.00</strong> out of 5</span></div>
                                        <span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&pound;</span>439.00</span> &ndash; <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&pound;</span>459.00</span></span>
                                        <div class="btn-add">
                                            <a href="https://demo.xtemos.com/basel/shop/woman/jur-detail-jacket/" data-quantity="1" class="button product_type_variable add_to_cart_button" data-product_id="19528" data-product_sku="" aria-label="Select options for &ldquo;Cem and cutwork jacket&rdquo;" rel="nofollow">Select options</a>			</div>
                                    </div>
                                </div>
                                <div class="swatches-on-grid"><div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-" style="background-color:#0a0a0a;" data-image-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-3.jpg" data-image-srcset="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-3.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-3-546x697.jpg 546w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-3-273x348.jpg 273w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-3-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-3-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-3-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-3-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-3-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-3-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-3-526x671.jpg 526w" data-image-sizes="(max-width: 870px) 100vw, 870px">Black</div><div class="swatch-on-grid basel-tooltip swatch-has-image variation-out-of-stock swatch-size-" style="background-color:#eded55;" data-image-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7.jpg" data-image-srcset="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-546x697.jpg 546w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-273x348.jpg 273w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-7-526x671.jpg 526w" data-image-sizes="(max-width: 870px) 100vw, 870px">Yellow</div><div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-" style="background-color:#dd3333;" data-image-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4.jpg" data-image-srcset="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4-546x697.jpg 546w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4-273x348.jpg 273w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/woman-4-526x671.jpg 526w" data-image-sizes="(max-width: 870px) 100vw, 870px">Red</div></div></div>



                        </div>
                        <div class="clearfix visible-sm-block"></div>

                        <div class="product-grid-item basel-hover-alt product  col-xs-6 col-sm-4 col-md-3 post-19659 type-product status-publish has-post-thumbnail product_cat-shoes instock shipping-taxable purchasable product-type-simple" data-loop="10" data-id="19659">

                            <div class="product-element-top">
                                <a href="https://demo.xtemos.com/basel/shop/shoes/hrim-sports-shoes/">
                                    <img width="273" height="348" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/shoes-9.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/shoes-9.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/shoes-9-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/shoes-9-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/shoes-9-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/shoes-9-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/shoes-9-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/shoes-9-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/shoes-9-526x671.jpg 526w" sizes="(max-width: 273px) 100vw, 273px" />	</a>
                                <div class="hover-img">
                                    <a href="https://demo.xtemos.com/basel/shop/shoes/hrim-sports-shoes/">
                                        <img width="273" height="348" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/shoes-18.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/shoes-18.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/shoes-18-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/shoes-18-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/shoes-18-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/shoes-18-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/shoes-18-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/shoes-18-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/shoes-18-526x671.jpg 526w" sizes="(max-width: 273px) 100vw, 273px" />				</a>
                                </div>
                                <div class="basel-buttons">

                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-19659">
                                        <div class="yith-wcwl-add-button show" style="display:block">


                                            <a href="/basel/shop/?infinit_scrolling&#038;add_to_wishlist=19659" rel="nofollow" data-product-id="19659" data-product-type="simple" class="add_to_wishlist" >
                                                Add to Wishlist</a>
                                            <img src="https://demo.xtemos.com/basel/wp-content/plugins/yith-woocommerce-wishlist/assets/images/wpspin_light.gif" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" />
                                        </div>

                                        <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;">
                                            <span class="feedback">Product added!</span>
                                            <a href="https://demo.xtemos.com/basel/wishlist/" rel="nofollow">
                                                Browse Wishlist	        </a>
                                        </div>

                                        <div class="yith-wcwl-wishlistexistsbrowse hide" style="display:none">
                                            <span class="feedback">The product is already in the wishlist!</span>
                                            <a href="https://demo.xtemos.com/basel/wishlist/" rel="nofollow">
                                                Browse Wishlist	        </a>
                                        </div>

                                        <div style="clear:both"></div>
                                        <div class="yith-wcwl-wishlistaddresponse"></div>

                                    </div>

                                    <div class="clear"></div>		<div class="basel-compare-btn product-compare-button"><a class="button" href="https://demo.xtemos.com/basel/compare/" data-added-text="Compare products" data-id="19659">Compare</a></div>					<div class="quick-view">
                                        <a
                                                href="https://demo.xtemos.com/basel/shop/shoes/hrim-sports-shoes/"
                                                class="open-quick-view"
                                                data-id="19659">Quick View</a>
                                    </div>
                                </div>
                            </div>
                            <h3 class="product-title"><a href="https://demo.xtemos.com/basel/shop/shoes/hrim-sports-shoes/">Cen’s dress shoes</a></h3>

                            <div class="wrap-price">
                                <div class="wrapp-swap">
                                    <div class="swap-elements">
                                        <div class="star-rating"><span style="width:100%">Rated <strong class="rating">5.00</strong> out of 5</span></div>
                                        <span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&pound;</span>299.00</span></span>
                                        <div class="btn-add">
                                            <a href="/basel/shop/?infinit_scrolling&#038;add-to-cart=19659" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="19659" data-product_sku="" aria-label="Add &ldquo;Cen’s dress shoes&rdquo; to your cart" rel="nofollow">Add to cart</a>			</div>
                                    </div>
                                </div>
                            </div>



                        </div>
                        <div class="clearfix visible-xs-block"></div>

                        <div class="product-grid-item basel-hover-alt product  col-xs-6 col-sm-4 col-md-3 post-19713 type-product status-publish has-post-thumbnail product_cat-accessories product_tag-classic product_tag-new instock shipping-taxable purchasable product-type-simple" data-loop="11" data-id="19713">

                            <div class="product-element-top">
                                <a href="https://demo.xtemos.com/basel/shop/accessories/classic-square-buckle-belt/">
                                    <img width="273" height="348" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-16.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-16.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-16-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-16-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-16-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-16-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-16-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-16-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-16-526x671.jpg 526w" sizes="(max-width: 273px) 100vw, 273px" />	</a>
                                <div class="hover-img">
                                    <a href="https://demo.xtemos.com/basel/shop/accessories/classic-square-buckle-belt/">
                                        <img width="273" height="348" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-5.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-5.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-5-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-5-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-5-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-5-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-5-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-5-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/accessories-5-526x671.jpg 526w" sizes="(max-width: 273px) 100vw, 273px" />				</a>
                                </div>
                                <div class="basel-buttons">

                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-19713">
                                        <div class="yith-wcwl-add-button show" style="display:block">


                                            <a href="/basel/shop/?infinit_scrolling&#038;add_to_wishlist=19713" rel="nofollow" data-product-id="19713" data-product-type="simple" class="add_to_wishlist" >
                                                Add to Wishlist</a>
                                            <img src="https://demo.xtemos.com/basel/wp-content/plugins/yith-woocommerce-wishlist/assets/images/wpspin_light.gif" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" />
                                        </div>

                                        <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;">
                                            <span class="feedback">Product added!</span>
                                            <a href="https://demo.xtemos.com/basel/wishlist/" rel="nofollow">
                                                Browse Wishlist	        </a>
                                        </div>

                                        <div class="yith-wcwl-wishlistexistsbrowse hide" style="display:none">
                                            <span class="feedback">The product is already in the wishlist!</span>
                                            <a href="https://demo.xtemos.com/basel/wishlist/" rel="nofollow">
                                                Browse Wishlist	        </a>
                                        </div>

                                        <div style="clear:both"></div>
                                        <div class="yith-wcwl-wishlistaddresponse"></div>

                                    </div>

                                    <div class="clear"></div>		<div class="basel-compare-btn product-compare-button"><a class="button" href="https://demo.xtemos.com/basel/compare/" data-added-text="Compare products" data-id="19713">Compare</a></div>					<div class="quick-view">
                                        <a
                                                href="https://demo.xtemos.com/basel/shop/accessories/classic-square-buckle-belt/"
                                                class="open-quick-view"
                                                data-id="19713">Quick View</a>
                                    </div>
                                </div>
                            </div>
                            <h3 class="product-title"><a href="https://demo.xtemos.com/basel/shop/accessories/classic-square-buckle-belt/">Classic Square Buckle Belt</a></h3>

                            <div class="wrap-price">
                                <div class="wrapp-swap">
                                    <div class="swap-elements">
                                        <div class="star-rating"><span style="width:100%">Rated <strong class="rating">5.00</strong> out of 5</span></div>
                                        <span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&pound;</span>115.00</span></span>
                                        <div class="btn-add">
                                            <a href="/basel/shop/?infinit_scrolling&#038;add-to-cart=19713" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="19713" data-product_sku="" aria-label="Add &ldquo;Classic Square Buckle Belt&rdquo; to your cart" rel="nofollow">Add to cart</a>			</div>
                                    </div>
                                </div>
                            </div>



                        </div>

                        <div class="product-grid-item basel-hover-alt product  col-xs-6 col-sm-4 col-md-3 last  post-19614 type-product status-publish has-post-thumbnail product_cat-bags product_tag-bag product_tag-basic last instock shipping-taxable purchasable product-type-variable has-default-attributes" data-loop="12" data-id="19614">

                            <div class="product-element-top">
                                <a href="https://demo.xtemos.com/basel/shop/bags/clutch-printed-bag/">
                                    <img width="273" height="348" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-3.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-3.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-3-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-3-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-3-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-3-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-3-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-3-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-3-526x671.jpg 526w" sizes="(max-width: 273px) 100vw, 273px" />	</a>
                                <div class="hover-img">
                                    <a href="https://demo.xtemos.com/basel/shop/bags/clutch-printed-bag/">
                                        <img width="273" height="348" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-12.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-12.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-12-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-12-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-12-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-12-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-12-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-12-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-12-526x671.jpg 526w" sizes="(max-width: 273px) 100vw, 273px" />				</a>
                                </div>
                                <div class="basel-buttons">

                                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-19614">
                                        <div class="yith-wcwl-add-button show" style="display:block">


                                            <a href="/basel/shop/?infinit_scrolling&#038;add_to_wishlist=19614" rel="nofollow" data-product-id="19614" data-product-type="variable" class="add_to_wishlist" >
                                                Add to Wishlist</a>
                                            <img src="https://demo.xtemos.com/basel/wp-content/plugins/yith-woocommerce-wishlist/assets/images/wpspin_light.gif" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" />
                                        </div>

                                        <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;">
                                            <span class="feedback">Product added!</span>
                                            <a href="https://demo.xtemos.com/basel/wishlist/" rel="nofollow">
                                                Browse Wishlist	        </a>
                                        </div>

                                        <div class="yith-wcwl-wishlistexistsbrowse hide" style="display:none">
                                            <span class="feedback">The product is already in the wishlist!</span>
                                            <a href="https://demo.xtemos.com/basel/wishlist/" rel="nofollow">
                                                Browse Wishlist	        </a>
                                        </div>

                                        <div style="clear:both"></div>
                                        <div class="yith-wcwl-wishlistaddresponse"></div>

                                    </div>

                                    <div class="clear"></div>		<div class="basel-compare-btn product-compare-button"><a class="button" href="https://demo.xtemos.com/basel/compare/" data-added-text="Compare products" data-id="19614">Compare</a></div>					<div class="quick-view">
                                        <a
                                                href="https://demo.xtemos.com/basel/shop/bags/clutch-printed-bag/"
                                                class="open-quick-view"
                                                data-id="19614">Quick View</a>
                                    </div>
                                </div>
                            </div>
                            <h3 class="product-title"><a href="https://demo.xtemos.com/basel/shop/bags/clutch-printed-bag/">Clutch printed bag</a></h3>

                            <div class="wrap-price">
                                <div class="wrapp-swap">
                                    <div class="swap-elements">

                                        <span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&pound;</span>67.00</span></span>
                                        <div class="btn-add">
                                            <a href="https://demo.xtemos.com/basel/shop/bags/clutch-printed-bag/" data-quantity="1" class="button product_type_variable add_to_cart_button" data-product_id="19614" data-product_sku="" aria-label="Select options for &ldquo;Clutch printed bag&rdquo;" rel="nofollow">Select options</a>			</div>
                                    </div>
                                </div>
                                <div class="swatches-on-grid"><div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-" style="background-color:#0a0a0a;" data-image-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-12.jpg" data-image-srcset="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-12.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-12-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-12-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-12-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-12-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-12-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-12-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-12-526x671.jpg 526w" data-image-sizes="(max-width: 870px) 100vw, 870px">Black</div><div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-" style="background-color:#ba6d09;" data-image-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-11.jpg" data-image-srcset="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-11.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-11-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-11-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-11-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-11-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-11-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-11-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-11-526x671.jpg 526w" data-image-sizes="(max-width: 870px) 100vw, 870px">Brown</div><div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-" style="background-color:#61a058;" data-image-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-1.jpg" data-image-srcset="https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-1.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-1-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-1-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-1-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-1-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-1-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-1-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2015/10/bag-1-526x671.jpg 526w" data-image-sizes="(max-width: 870px) 100vw, 870px">Green</div></div></div>



                        </div>
                        <div class="clearfix visible-xs-block"></div>
                        <div class="clearfix visible-sm-block"></div>

                        <div class="clearfix visible-md-block visible-lg-block"></div>
                    </div>

                    <div class="products-footer">
                        <a href="https://demo.xtemos.com/basel/shop/page/2/?infinit_scrolling" rel="nofollow" class="btn basel-load-more basel-products-load-more load-on-scroll">Carregar mais produtos</a>
                    </div>

                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </div>
    <!-- .main-page-wrapper -->








@endsection