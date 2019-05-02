@extends('layouts.template-1')
@push('title')
<title> São Roque calçados nome do produto</title>
@endpush
@push('body')
<body class="product-template-default single single-product postid-19656 logged-in woocommerce woocommerce-page woocommerce-no-js wrapper-full-width global-cart-design-1 global-search-full-screen global-header-shop mobile-nav-from-left basel-product-design-default basel-light catalog-mode-off categories-accordion-on global-wishlist-enable basel-top-bar-on basel-ajax-shop-on basel-ajax-search-on enable-sticky-header header-full-width sticky-header-real offcanvas-sidebar-mobile offcanvas-sidebar-tablet wpb-js-composer js-comp-ver-5.6 vc_responsive">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="site-content shop-content-area col-sm-12 content-with-products description-area-before" role="main">
                <div class="single-breadcrumbs-wrapper">
                    <div class="container">
                        <!-- Voltar página anterior -->
                        <a href="javascript:baselThemeModule.backHistory()" class="basel-back-btn basel-tooltip">
                            <span>Voltar</span>
                        </a>
                        <!--breadcrumb -->
                        <nav class="woocVoommerce-breadcrumb">
                            <a href="{{route('home')}}">Home</a>
                            <a href="#">Seção </a>
                            <a href="#">Categoria </a>
                            <span class="breadcrumb-last"> Produto 2</span>
                        </nav>
                        <!-- Anteriores e Próximos -->
                        <div class="basel-products-nav">

                            <div class="product-btn product-prev">
                                <a href="{{route('product', $product_prev)}}">
                                    Produto Anterior<span></span>
                                </a>
                                <div class="wrapper-short">
                                    <div class="product-short">
                                        <a href="{{route('product', $product_prev)}}" class="product-thumb">
                                            <img width="273" height="273"
                                                 src="{{asset('faker/product_photos/img4-f.jpg')}}"
                                                 class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                 alt="" srcset="{{asset('faker/product_photos/img4-f.jpg')}} 273w,
                                                 {{asset('faker/product_photos/img4-f.jpg')}} 546w,
                                                 {{asset('faker/product_photos/img4-f.jpg')}} 235w,
                                                 {{asset('faker/product_photos/img4-f.jpg')}} 768w,
                                                 {{asset('faker/product_photos/img4-f.jpg')}} 803w,
                                                 {{asset('faker/product_photos/img4-f.jpg')}} 266w,
                                                 {{asset('faker/product_photos/img4-f.jpg')}} 219w,
                                                 {{asset('faker/product_photos/img4-f.jpg')}} 263w,
                                                 {{asset('faker/product_photos/img4-f.jpg')}} 526w,
                                                 {{asset('faker/product_photos/img4-f.jpg')}} 870w"
                                                 sizes="(max-width: 273px) 100vw, 273px"
                                            />
                                        </a>
                                        <a href="{{route('product', $product_prev)}}" class="product-title">
                                            Produto 1
                                        </a>
                                        <span class="price">
                                            <del>
                                                <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol">R$ </span>48,00
                                                </span>
                                            </del>
                                            <ins>
                                                <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol">R$ </span>36,00
                                                </span>
                                            </ins>
                                        </span>
                                    </div>
                                </div>
                            </div>



                            <div class="product-btn product-next">
                                <a href="{{route('product', $product_next)}}">Próximo Produto
                                    <span></span>
                                </a>
                                <div class="wrapper-short">
                                    <div class="product-short">
                                        <a href="{{route('product', $product_next)}}" class="product-thumb">
                                            <img width="273" height="273"
                                                 src="{{asset('faker/product_photos/img8-f.jpg')}}"
                                                 class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                 alt="" srcset="{{asset('faker/product_photos/img8-f.jpg')}} 273w,
                                                 {{asset('faker/product_photos/img8-f.jpg')}} 546w,
                                                 {{asset('faker/product_photos/img8-f.jpg')}} 235w,
                                                 {{asset('faker/product_photos/img8-f.jpg')}} 768w,
                                                 {{asset('faker/product_photos/img8-f.jpg')}} 803w,
                                                 {{asset('faker/product_photos/img8-f.jpg')}} 266w,
                                                 {{asset('faker/product_photos/img8-f.jpg')}} 219w,
                                                 {{asset('faker/product_photos/img8-f.jpg')}} 263w,
                                                 {{asset('faker/product_photos/img8-f.jpg')}} 526w,
                                                 {{asset('faker/product_photos/img8-f.jpg')}} 870w"
                                                 sizes="(max-width: 273px) 100vw, 273px"
                                            />
                                        </a>

                                        <a href="{{route('product', $product_next)}}" class="product-title">
                                            Produto  <span>3</span>
                                        </a>
                                        <span class="price">
                                            <span class="woocommerce-Price-amount amount">
                                                <span class="woocommerce-Price-currencySymbol">R$ </span>45,00
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="woocommerce-notices-wrapper"></div>
                </div>
                <!-- produto -->
                <div id="product-19531" class="single-product-page single-product-content product-design-default product-with-attachments post-19531 product type-product status-publish has-post-thumbnail product_cat-woman first instock featured shipping-taxable purchasable product-type-variable has-default-attributes">
                    <div class="container">
                        <div class="row">
                            <!-- com sidbar col-sm-9 -->
                            <div class="product-image-summary col-sm-12">
                                <div class="row">
                                    <!-- Imagens da Galeria -->
                                    <div class="col-sm-6 product-images">
                                        <div class="woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-4 images images row thumbs-position-left image-action-zoom" style="opacity: 0; transition: opacity .25s ease-in-out;">
                                            <div class="col-md-9 col-md-push-3">
                                                <figure class="woocommerce-product-gallery__wrapper owl-carousel">

                                                    <figure data-thumb="{{asset('faker/product_photos/img1-f.jpg')}}" class="woocommerce-product-gallery__image">
                                                        <a href="{{asset('faker/product_photos/img1-f.jpg')}}">
                                                            <img width="870" height="870"
                                                                 src="{{asset('faker/product_photos/img1-f.jpg')}}"
                                                                 class="wp-post-image wp-post-image"
                                                                 alt="Produto 2 - Cor Azul" title="Produto 2 - cor Azul"
                                                                 data-caption=""
                                                                 data-src="{{asset('faker/product_photos/img1-f.jpg')}}"
                                                                 data-large_image="{{asset('faker/product_photos/img1-f.jpg')}}"
                                                                 data-large_image_width="870"
                                                                 data-large_image_height="870"
                                                                 srcset="{{asset('faker/product_photos/img1-f.jpg')}} 870w,
                                                                         {{asset('faker/product_photos/img1-f.jpg')}} 235w,
                                                                         {{asset('faker/product_photos/img1-f.jpg')}} 768w,
                                                                         {{asset('faker/product_photos/img1-f.jpg')}} 803w,
                                                                         {{asset('faker/product_photos/img1-f.jpg')}} 266w,
                                                                         {{asset('faker/product_photos/img1-f.jpg')}} 219w,
                                                                         {{asset('faker/product_photos/img1-f.jpg')}} 263w,
                                                                         {{asset('faker/product_photos/img1-f.jpg')}} 526w"
                                                                 sizes="(max-width: 870px) 100vw, 870px"
                                                            />
                                                        </a>
                                                    </figure>

                                                    <figure data-thumb="{{asset('faker/product_photos/img1-l.jpg')}}" class="woocommerce-product-gallery__image">
                                                        <a href="{{asset('faker/product_photos/img1-l.jpg')}}">
                                                            <img width="870" height="870"
                                                                 src="{{asset('faker/product_photos/img1-l.jpg')}}"
                                                                 class="wp-post-image wp-post-image"
                                                                 alt="Produto 2 - Cor Azul" title="Produto 2 - cor Azul"
                                                                 data-caption=""
                                                                 data-src="{{asset('faker/product_photos/img1-l.jpg')}}"
                                                                 data-large_image="{{asset('faker/product_photos/img1-l.jpg')}}"
                                                                 data-large_image_width="870"
                                                                 data-large_image_height="870"
                                                                 srcset="{{asset('faker/product_photos/img1-l.jpg')}} 870w,
                                                                         {{asset('faker/product_photos/img1-l.jpg')}} 235w,
                                                                         {{asset('faker/product_photos/img1-l.jpg')}} 768w,
                                                                         {{asset('faker/product_photos/img1-l.jpg')}} 803w,
                                                                         {{asset('faker/product_photos/img1-l.jpg')}} 266w,
                                                                         {{asset('faker/product_photos/img1-l.jpg')}} 219w,
                                                                         {{asset('faker/product_photos/img1-l.jpg')}} 263w,
                                                                         {{asset('faker/product_photos/img1-l.jpg')}} 526w"
                                                                 sizes="(max-width: 870px) 100vw, 870px"
                                                            />
                                                        </a>
                                                    </figure>

                                                    <figure data-thumb="{{asset('faker/product_photos/img1-s.jpg')}}" class="woocommerce-product-gallery__image">
                                                        <a href="{{asset('faker/product_photos/img1-s.jpg')}}">
                                                            <img width="870" height="870"
                                                                 src="{{asset('faker/product_photos/img1-s.jpg')}}"
                                                                 class="wp-post-image wp-post-image"
                                                                 alt="Produto 2 - Cor Azul" title="Produto 2 - cor Azul"
                                                                 data-caption=""
                                                                 data-src="{{asset('faker/product_photos/img1-s.jpg')}}"
                                                                 data-large_image="{{asset('faker/product_photos/img1-s.jpg')}}"
                                                                 data-large_image_width="870"
                                                                 data-large_image_height="870"
                                                                 srcset="{{asset('faker/product_photos/img1-s.jpg')}} 870w,
                                                                         {{asset('faker/product_photos/img1-s.jpg')}} 235w,
                                                                         {{asset('faker/product_photos/img1-s.jpg')}} 768w,
                                                                         {{asset('faker/product_photos/img1-s.jpg')}} 803w,
                                                                         {{asset('faker/product_photos/img1-s.jpg')}} 266w,
                                                                         {{asset('faker/product_photos/img1-s.jpg')}} 219w,
                                                                         {{asset('faker/product_photos/img1-s.jpg')}} 263w,
                                                                         {{asset('faker/product_photos/img1-s.jpg')}} 526w"
                                                                 sizes="(max-width: 870px) 100vw, 870px"
                                                            />
                                                        </a>
                                                    </figure>

                                                </figure>



                                                <div class="basel-show-product-gallery-wrap">
                                                    <a href="#" class="basel-show-product-gallery basel-tooltip">Clique para Ampliar</a>
                                                </div>

                                            </div>
                                            <div class="col-md-3 col-md-pull-9">
                                                <div class="thumbnails"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Descrição do produto -->
                                    <div class="col-sm-6 summary entry-summary">
                                        <div class="summary-inner ">
                                            <div class="basel-scroll-content">
                                                <h1 itemprop="name" class="product_title entry-title">Produto 2</h1>
                                                <p class="price">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span class="woocommerce-Price-currencySymbol">R$ </span>59,00
                                                    </span>
                                                </p>

                                                <div class="woocommerce-product-details__short-description">
                                                    <p>Descrição curta do produto.</p>
                                                </div>
                                                <h5 class="widget-title">Exemplo venda Varejo</h5>
                                                <form class="variations_form cart" method="post" enctype="multipart/form-data" data-product_id="19531" data-product_variations='{{$product_variations}}'>

                                                    <table class="variations" cellspacing="0">
                                                        <tbody>
                                                        <tr>
                                                            <td class="label"><label for="pa_color">Cores</label></td>
                                                            <td class="value with-swatches">
                                                                <div class="swatches-select" data-id="pa_color">
                                                                    <div class="basel-swatch basel-tooltip  colored-swatch swatch-size-" data-value="amarelo"  style="background-color:#eded55">Amarelo</div>
                                                                    <div class="basel-swatch basel-tooltip  colored-swatch swatch-size-" data-value="branco"  style="background-color:#ffffff">Branco</div>
                                                                    <div class="basel-swatch basel-tooltip  colored-swatch swatch-size-" data-value="azul"  style="background-color:#769ec1">Azul</div>
                                                                </div>
                                                                <select id="pa_color" class="" name="attribute_pa_color" data-attribute_name="attribute_pa_color" data-show_option_none="yes">
                                                                    <option value="">Selecione a Opção</option>
                                                                    <option value="amarelo" >Amarelo</option>
                                                                    <option value="branco" >Branco</option>
                                                                    <option value="azul" >Azul</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="label"><label for="pa_size">Tamanhos</label></td>
                                                            <td class="value with-swatches">
                                                                <div class="swatches-select" data-id="pa_size">
                                                                    <div class="basel-swatch basel-tooltip  text-only swatch-size-" data-value="33"  style="">33</div>
                                                                    <div class="basel-swatch basel-tooltip  text-only swatch-size-" data-value="34"  style="">34</div>
                                                                    <div class="basel-swatch basel-tooltip  text-only swatch-size-" data-value="35"  style="">35</div>
                                                                </div>


                                                                <select id="pa_size" class="" name="attribute_pa_size" data-attribute_name="attribute_pa_size" data-show_option_none="yes">
                                                                    <option value="">Selecione a Opção</option>
                                                                    <option value="33" >33</option>
                                                                    <option value="34" >34</option>
                                                                    <option value="35" >35</option>
                                                                </select>
                                                                <a class="reset_variations" href="#">Limpar</a>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>


                                                    <div class="single_variation_wrap">
                                                        <div class="woocommerce-variation single_variation"></div>
                                                        <div class="woocommerce-variation-add-to-cart variations_button">
                                                            <div class="quantity">
                                                                <input type="button" value="-" class="minus" />
                                                                <label class="screen-reader-text" for="quantity_5cba02707fe6e">Quantidade</label>
                                                                <input
                                                                    type="number"
                                                                    id="quantity_5cba02707fe6e"
                                                                    class="input-text qty text"
                                                                    step="1"
                                                                    min="1"
                                                                    max=""
                                                                    name="quantity"
                                                                    value="1"
                                                                    title="Qtd"
                                                                    size="4"
                                                                    pattern="[0-9]*"
                                                                    inputmode="numeric"
                                                                    aria-labelledby="Noose fit ripped jeans quantity" />
                                                                <input type="button" value="+" class="plus" />
                                                            </div>

                                                            <button type="submit" class="single_add_to_cart_button button alt">Adicionar</button>
                                                            <input type="hidden" name="add-to-cart" value="19531" />
                                                            <input type="hidden" name="product_id" value="19531" />
                                                            <input type="hidden" name="variation_id" class="variation_id" value="0" />
                                                            <input type="hidden" name="_token" value="{{csrf_token()}}" />
                                                        </div>
                                                    </div>


                                                </form>

                                                <!-- Venda atacado -->
                                                <div id="basel-woocommerce-layered-nav-17" class="filter-widget widget-count-4  basel-woocommerce-layered-nav">
                                                    <h5 class="widget-title">Exemplo Venda Caixa</h5>
                                                    <div class="basel-scroll">
                                                        <ul class="show-labels-on swatches-normal swatches-display-inline basel-scroll-content">
                                                            <li class="wc-layered-nav-term  with-swatch-text">
                                                                <a href="javascript:void(0)">33</a>
                                                                <span class="count">(1)</span>
                                                            </li>
                                                            <li class="wc-layered-nav-term  with-swatch-text">
                                                                <a href="javascript:void(0)">34</a>
                                                                <span class="count">(1)</span>
                                                            </li>
                                                            <li class="wc-layered-nav-term  with-swatch-text">
                                                                <a href="javascript:void(0)">35</a>
                                                                <span class="count">(2)</span>
                                                            </li>
                                                            <li class="wc-layered-nav-term  with-swatch-text">
                                                                <a href="javascript:void(0)">36</a>
                                                                <span class="count">(2)</span>
                                                            </li>
                                                            <li class="wc-layered-nav-term  with-swatch-text">
                                                                <a href="javascript:void(0)">37</a>
                                                                <span class="count">(1)</span>
                                                            </li>
                                                            <li class="wc-layered-nav-term  with-swatch-text">
                                                                <a href="javascript:void(0)">38</a>
                                                                <span class="count">(2)</span>
                                                            </li>
                                                            <li class="wc-layered-nav-term  with-swatch-text">
                                                                <a href="javascript:void(0)">39</a>
                                                                <span class="count">(2)</span>
                                                            </li>
                                                            <li class="wc-layered-nav-term  with-swatch-text">
                                                                <a href="javascript:void(0)">40</a>
                                                                <span class="count">(1)</span>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </div>
                                                <form class="cart grouped_form">
                                                    <table cellspacing="0" class="woocommerce-grouped-product-list group_table">
                                                        <tbody>
                                                        <tr id="product-23297" class="woocommerce-grouped-product-list-item post-23297 product type-product status-publish has-post-thumbnail product_cat-lingerie instock shipping-taxable purchasable product-type-simple">
                                                            <td class="woocommerce-grouped-product-list-item__quantity">
                                                                <div class="quantity">
                                                                    <input type="button" value="-" class="minus">
                                                                    <label class="screen-reader-text" for="quantity_5cbf0639a0370">Quantidade</label>
                                                                    <input type="number" id="quantity_5cbf0639a0370" class="input-text qty text" step="1" min="0" max="12" name="quantity[23297]" value="0" title="Qtd" size="4" pattern="[0-9]*" inputmode="numeric" aria-labelledby="Amarelo">
                                                                    <input type="button" value="+" class="plus">
                                                                </div>
                                                            </td>
                                                            <td class="woocommerce-grouped-product-list-item__label">
                                                                <label for="product-23297"><a href="#">Amarelo</a></label>
                                                            </td>
                                                            <td class="woocommerce-grouped-product-list-item__price">
                                                                <span class="woocommerce-Price-amount amount">
                                                                    <span class="woocommerce-Price-currencySymbol">R$ </span>160,00
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        <tr id="product-23298" class="woocommerce-grouped-product-list-item post-23298 product type-product status-publish has-post-thumbnail product_cat-lingerie instock shipping-taxable purchasable product-type-simple">
                                                            <td class="woocommerce-grouped-product-list-item__quantity">
                                                                <div class="quantity">
                                                                    <input type="button" value="-" class="minus">
                                                                    <label class="screen-reader-text" for="quantity_5cbf0639a0370">Quantidade</label>
                                                                    <input type="number" id="quantity_5cbf0639a0370" class="input-text qty text" step="1" min="0" max="12" name="quantity[23298]" value="0" title="Qtd" size="4" pattern="[0-9]*" inputmode="numeric" aria-labelledby="Branco">
                                                                    <input type="button" value="+" class="plus">
                                                                </div>
                                                            </td>
                                                            <td class="woocommerce-grouped-product-list-item__label">
                                                                <label for="product-23298"><a href="#">Branco</a></label>
                                                            </td>
                                                            <td class="woocommerce-grouped-product-list-item__price">
                                                                <span class="woocommerce-Price-amount amount">
                                                                    <span class="woocommerce-Price-currencySymbol">R$ </span>160,00
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        <tr id="product-23299" class="woocommerce-grouped-product-list-item post-23299 product type-product status-publish has-post-thumbnail product_cat-lingerie instock shipping-taxable purchasable product-type-simple">
                                                            <td class="woocommerce-grouped-product-list-item__quantity">
                                                                <div class="quantity">
                                                                    <input type="button" value="-" class="minus">
                                                                    <label class="screen-reader-text" for="quantity_5cbf0639a0370">Quantidade</label>
                                                                    <input type="number" id="quantity_5cbf0639a0370" class="input-text qty text" step="1" min="0" max="12" name="quantity[23299]" value="0" title="Qtd" size="4" pattern="[0-9]*" inputmode="numeric" aria-labelledby="Azul">
                                                                    <input type="button" value="+" class="plus">
                                                                </div>
                                                            </td>
                                                            <td class="woocommerce-grouped-product-list-item__label">
                                                                <label for="product-23299"><a href="#">Azul</a></label>
                                                            </td>
                                                            <td class="woocommerce-grouped-product-list-item__price">
                                                                <span class="woocommerce-Price-amount amount">
                                                                    <span class="woocommerce-Price-currencySymbol">R$ </span>160,00
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </form>


                                                <!-- Lista de Desejo -->
                                                <div class="yith-wcwl-add-to-wishlist add-to-wishlist-19531">
                                                    <div class="yith-wcwl-add-button show" style="display:block">
                                                        <a href="{{route('wishlist.store')}}" rel="nofollow" data-product-id="19531" data-product-type="variable" class="add_to_wishlist" >
                                                            Adicionar a lista de desejo
                                                        </a>
                                                        <img src="{{asset('themes/images/loader/wpspin_light.gif')}}" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" />
                                                    </div>

                                                    <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;">
                                                        <span class="feedback">Produto adicionado!</span>
                                                        <a href="https://demo.xtemos.com/basel/wishlist/" rel="nofollow">
                                                            Ver lista de desejo
                                                        </a>
                                                    </div>

                                                    <div class="yith-wcwl-wishlistexistsbrowse hide" style="display:none">
                                                        <span class="feedback">O produto já está na lista de desejos!</span>
                                                        <a href="https://demo.xtemos.com/basel/wishlist/" rel="nofollow">
                                                            Ver lista de desejo
                                                        </a>
                                                    </div>

                                                    <div style="clear:both"></div>
                                                    <div class="yith-wcwl-wishlistaddresponse"></div>
                                                </div>

                                                <div class="clear"></div>

                                                <!-- Compare-->
                                                <div class="compare-btn-wrapper">
                                                    <a class="basel-compare-btn button" href="{{route('compare')}}" data-added-text="Ver Produtos" data-id="19531">Compare</a>
                                                </div>

                                                <!-- Outros-->
                                                <div class="product_meta">
                                                    <span class="sku_wrapper">SKU: <span class="sku">N/F</span></span>
                                                    <span class="posted_in">Categoria: <a href="#" rel="tag">Feminino</a></span>
                                                </div>

                                                <div class="product-share">
                                                    <span class="share-title">Compartilhar</span>

                                                    <ul class="social-icons text-left icons-design-default icons-size-small social-share ">
                                                        <li class="social-facebook"><a href="#" target="_blank" class=""><i class="fa fa-facebook"></i><span class="basel-social-icon-name">Facebook</span></a></li>
                                                        <li class="social-twitter"><a href="#" target="_blank" class=""><i class="fa fa-twitter"></i><span class="basel-social-icon-name">Twitter</span></a></li>
                                                        <li class="social-google"><a href="#" target="_blank" class=""><i class="fa fa-google-plus"></i><span class="basel-social-icon-name">Google</span></a></li>
                                                        <li class="social-email"><a href="#" target="_blank" class=""><i class="fa fa-envelope"></i><span class="basel-social-icon-name">Email</span></a></li>
                                                        <li class="social-pinterest"><a href="#" target="_blank" class=""><i class="fa fa-pinterest"></i><span class="basel-social-icon-name">Pinterest</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- .summary -->
                            </div>

                            <!-- include('products.includes.sidber-1') -->

                        </div>
                    </div>
                    <div class="container"></div>
                    <!-- include('products.includes.tabs-1') -->
                </div><!-- #produto -->
            </div>
            <div class="clearfix"></div>
            <!-- include('products.includes.related-1') -->
        </div> <!-- fim row -->
    </div> <!-- fim container -->
@endsection

@push('scripts')
<script type="application/ld+json">{!! json_encode($schema_org) !!}</script>
<script type="text/javascript" src="{{asset('plugins/zoom/js/jquery.zoom.min.js')}}?ver=1.7.21"></script>
<script type="text/javascript">
    var wc_single_product_params = {!! json_encode([
        "i18n_required_rating_text" => "Por favor, selecione uma classificação",
        "review_rating_required" => "yes",
        "flexslider" => array(
            "rtl" => false,
            "animation" => "slide",
            "smoothHeight" => true,
            "directionNav" => false,
            "controlNav" => "thumbnails",
            "slideshow" => false,
            "animationSpeed" => 500,
            "animationLoop" => false,
            "allowOneSlide" => false
        ),
        "zoom_enabled" => "1",
        "zoom_options" => [],
        "photoswipe_enabled" => "",
        "photoswipe_options" => array(
            "shareEl" => false,
            "closeOnScroll" => false,
            "history" => false,
            "hideAnimationDuration" => 0,
            "showAnimationDuration" => 0
        ),
        "flexslider_enabled" => ""
    ]) !!}}
</script>
<script type="text/javascript" src="{{asset('plugins/product/js/single-product.min.js')}}?ver=3.5.2"></script>
<script type="text/javascript" src="{{asset('banners')}}?ver=4.9.8"></script>
@endpush
