
<header class="main-header header-has-no-bg header-simple icons-design-line color-scheme-dark">
    <div class="container">
        <div class="wrapp-header">

            @include('headers.columns.logo-1')

            @include('headers.navs.main-nav-1')


            <div class="right-column">


                <div class="search-button basel-search-full-screen">
                    <a href="#">
                        <i class="fa fa-search"></i>
                    </a>
                    <div class="basel-search-wrapper">
                        <div class="basel-search-inner">
                            <span class="basel-close-search">Fechar</span>
                            <form role="search" method="get" id="_searchform" class="searchform  basel-ajax-search" action="#" data-thumbnail="1" data-price="1" data-count="5" data-post_type="product">
                                <div>
                                    <label class="screen-reader-text">Buscar por 2:</label>
                                    <input type="text" class="search-field" placeholder="Buscar Produtos" value="" name="s" id="_s" />
                                    <input type="hidden" name="_post_type" id="_post_type" value="product">
                                    <button type="submit" id="_searchsubmit" value="Buscar">Buscar</button>
                                </div>
                            </form>
                            <div class="search-results-wrapper">
                                <div class="basel-scroll">
                                    <div class="basel-search-results basel-scroll-content"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wishlist-info-widget">
                    <a href="{{route('wishlist')}}">Lista de Desejo
                        <span class="wishlist-count">0</span>
                    </a>
                </div>
                <div class="shopping-cart basel-cart-design-1 basel-cart-icon cart-widget-opener">
                    <a href="{{route('cart')}}"><span>Carrinho(<span>o</span>)</span>
                        <span class="basel-cart-totals">
                            <span class="basel-cart-number">0</span>
                            <span class="subtotal-divider">/</span>
                            <span class="basel-cart-subtotal">
                                <span class="woocommerce-Price-amount amount">
                                    <span class="woocommerce-Price-currencySymbol">R&#36;</span>0.00
                                </span>
                            </span>
                        </span>
                    </a>
                </div>
                <div class="mobile-nav-icon">
                    <span class="basel-burger"></span>
                </div>
                <!--END MOBILE-NAV-ICON-->
            </div>


        </div>
    </div>
</header>
