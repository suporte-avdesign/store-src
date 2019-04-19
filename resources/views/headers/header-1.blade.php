<div class="mobile-nav">
    <form role="search" method="get" id="searchform" class="searchform  basel-ajax-search" action="{{route('product.search')}}/" data-thumbnail="1" data-price="1" data-count="5" data-post_type="product">
        <div>
            <label class="screen-reader-text">Buscar produtos:</label>
            <input type="text" class="search-field" placeholder="Buscar produtos" value="" name="s" id="s" />
            <input type="hidden" name="post_type" id="post_type" value="product">
            <button type="submit" id="searchsubmit" value="Search">Busca</button>

        </div>
    </form>
    <div class="search-results-wrapper">
        <div class="basel-scroll">
            <div class="basel-search-results basel-scroll-content"></div>
        </div>
    </div>
    <div class="menu-mobile-nav-container">
        <ul id="menu-mobile-nav" class="site-mobile-menu">
            <li id="menu-item-21215" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-21215 menu-item-design-default item-event-hover">
                <a href="#">Home</a>
            </li>

            <li id="menu-item-21220" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children current-menu-item current_page_item menu-item-21220 menu-item-design-default item-event-hover">
                <a href="#">Feminino</a>
                <div class="sub-menu-dropdown color-scheme-dark">
                    <div class="container">
                        <ul class="sub-menu color-scheme-dark">
                            <li id="menu-item-22144" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item current_page_item menu-item-22144 menu-item-design-default item-event-hover">
                                <a href="#">Categoria 1</a>
                            </li>
                            <li id="menu-item-22147" class="menu-item menu-item-type-post_type menu-item-object-product menu-item-22147 menu-item-design-default item-event-hover">
                                <a href="#">Cetegoria 2</a>
                            </li>
                            <li id="menu-item-22145" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22145 menu-item-design-default item-event-hover">
                                <a href="#">Categoria 3</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>

            <li id="menu-item-12120" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children current-menu-item current_page_item menu-item-12120 menu-item-design-default item-event-hover">
                <a href="#">Masculino</a>
                <div class="sub-menu-dropdown color-scheme-dark">
                    <div class="container">
                        <ul class="sub-menu color-scheme-dark">
                            <li id="menu-item-12144" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item current_page_item menu-item-12144 menu-item-design-default item-event-hover">
                                <a href="#">Categoria 1</a>
                            </li>
                            <li id="menu-item-12147" class="menu-item menu-item-type-post_type menu-item-object-product menu-item-12147 menu-item-design-default item-event-hover">
                                <a href="#">Cetegoria 2</a>
                            </li>
                            <li id="menu-item-12145" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-12145 menu-item-design-default item-event-hover">
                                <a href="#">Categoria 3</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>

            <li id="menu-item-46460" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children current-menu-item current_page_item menu-item-46460 menu-item-design-default item-event-hover">
                <a href="#">Infantil</a>
                <div class="sub-menu-dropdown color-scheme-dark">
                    <div class="container">
                        <ul class="sub-menu color-scheme-dark">
                            <li id="menu-item-46144" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item current_page_item menu-item-46144 menu-item-design-default item-event-hover">
                                <a href="#">Categoria 1</a>
                            </li>
                            <li id="menu-item-46147" class="menu-item menu-item-type-post_type menu-item-object-product menu-item-46147 menu-item-design-default item-event-hover">
                                <a href="#">Cetegoria 2</a>
                            </li>
                            <li id="menu-item-46145" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-46145 menu-item-design-default item-event-hover">
                                <a href="#">Categoria 3</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>


            <li id="menu-item-27318" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-27318 menu-item-design-default item-event-hover">
                <a href="#">Minha Conta</a>
                <div class="sub-menu-dropdown color-scheme-dark">
                    <div class="container">
                        <ul class="sub-menu color-scheme-dark">
                            <li id="menu-item-22149" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22149 menu-item-design-default item-event-hover">
                                <a href="#">Logar</a>
                            </li>
                            <li id="menu-item-22150" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22150 menu-item-design-default item-event-hover">
                                <a href="#">Meus Pedidos</a>
                            </li>
                            <li id="menu-item-22152" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22152 menu-item-design-default item-event-hover">
                                <a href="#">Lista de Desejo</a>
                            </li>
                            <li id="menu-item-22154" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22154 menu-item-design-default item-event-hover">
                                <a href="#">Alterar Senha</a>
                            </li>
                            <li id="menu-item-27153" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-27153 menu-item-design-default item-event-hover">
                                <a href="#">Alterar Dados</a>
                            </li>
                            <li id="menu-item-22151" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22151 menu-item-design-default item-event-hover">
                                <a href="#">Endereço de Entrega</a>
                            </li>
                            <li id="menu-item-22156" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22156 menu-item-design-default item-event-hover">
                                <a href="#">Sair da Conta</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <li id="menu-item-21217" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-21217 menu-item-design-default item-event-hover">
                <a href="https://demo.xtemos.com/basel/cart/">Carrinho</a>
            </li>
        </ul>
    </div>
    <div class="header-links my-account-with-text">
        <ul>
            <li class="wishlist"><a href="#">Contato</a></li>
            <li class="my-account"><a href="#">Cadastre-se</a></li>
            <li class="logout"><a href="#">FAQ</a></li>
        </ul>
    </div>
</div>
<!--END MOBILE-NAV-->

@include('headers.tops.top-1')

<!-- HEADER -->
<header class="main-header header-has-no-bg header-shop icons-design-line color-scheme-dark">
    <div class="container">
        <div class="wrapp-header">

            <!--MAIN-NAV-->
            <div class="main-nav site-navigation basel-navigation menu-left" role="navigation">
                <div class="menu-main-navigation-container">
                    <ul id="menu-main-navigation" class="menu">
                        <li id="menu-item-19422" class="menu-item menu-item-type-post_type current-menu-item current_page_item menu-item-object-page menu-item-home menu-item-19422 menu-item-design-sized item-event-hover">
                            <a href="#">Home</a>
                        </li>

                        <li id="menu-item-22134" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-22134 menu-item-design-default item-event-hover iitem-with-label item-label-hot">
                            <a href="#">Feminino <span class="menu-label menu-label-hot">Em ofertas</span></a>
                            <div class="sub-menu-dropdown color-scheme-dark">
                                <div class="container">
                                    <ul class="sub-menu color-scheme-dark">
                                        <li id="menu-item-18908" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-19908 menu-item-design-default item-event-hover">
                                            <a href="#">Categoria 1</a>
                                        </li>
                                        <li id="menu-item-24121" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-24121 menu-item-design-default item-event-hover item-with-label item-label-new">
                                            <a href="#">Categoria 2 <span class="menu-label menu-label-new">Novos</span></a>
                                        </li>
                                        <li id="menu-item-25122" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-25122 menu-item-design-default item-event-hover">
                                            <a href="#">Categoria 3</a>
                                        </li>
                                        <li id="menu-item-26123" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-26123 menu-item-design-default item-event-hover item-with-label item-label-hot">
                                            <a href="#">Categoria 4 <span class="menu-label menu-label-hot">Saldão</span></a>
                                        </li>
                                        <li id="menu-item-27124" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-27124 menu-item-design-default item-event-hover">
                                            <a href="#">Categoria 5</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>

                        <li id="menu-item-22135" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-22135 menu-item-design-default item-event-hover item-with-label item-label-new">
                            <a href="#">Masculino <span class="menu-label menu-label-new">Lançamentos</span></a>
                            <div class="sub-menu-dropdown color-scheme-dark">
                                <div class="container">
                                    <ul class="sub-menu color-scheme-dark">
                                        <li id="menu-item-19908" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-19908 menu-item-design-default item-event-hover">
                                            <a href="#">Categoria 1</a>
                                        </li>
                                        <li id="menu-item-20121" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-20121 menu-item-design-default item-event-hover item-with-label item-label-new">
                                            <a href="#">Categoria 2 <span class="menu-label menu-label-new">New</span></a>
                                        </li>
                                        <li id="menu-item-20122" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-20122 menu-item-design-default item-event-hover">
                                            <a href="#">Categoria 3</a>
                                        </li>
                                        <li id="menu-item-20123" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-20123 menu-item-design-default item-event-hover item-with-label item-label-hot">
                                            <a href="#">Categoria 4 <span class="menu-label menu-label-hot">Saldão</span></a>
                                        </li>
                                        <li id="menu-item-20124" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-20124 menu-item-design-default item-event-hover">
                                            <a href="#">Categoria 5</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>

                        <li id="menu-item-22126" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-22126 menu-item-design-default item-event-hover item-with-label item-label-new">
                            <a href="#">Infantil <span class="menu-label menu-label-new">Lançamentos</span></a>
                            <div class="sub-menu-dropdown color-scheme-dark">
                                <div class="container">
                                    <ul class="sub-menu color-scheme-dark">
                                        <li id="menu-item-19911" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-19911 menu-item-design-default item-event-hover">
                                            <a href="#">Categoria 1</a>
                                        </li>
                                        <li id="menu-item-27121" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-27121 menu-item-design-default item-event-hover">
                                            <a href="#">Categoria 2</a>
                                        </li>
                                        <li id="menu-item-20145" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-20145 menu-item-design-default item-event-hover">
                                            <a href="#">Categoria 3</a>
                                        </li>
                                        <li id="menu-item-20172" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-20172 menu-item-design-default item-event-hover">
                                            <a href="#">Categoria 4 </a>
                                        </li>
                                        <li id="menu-item-20173" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-20173 menu-item-design-default item-event-hover">
                                            <a href="#">Categoria 5</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>


                        <li id="menu-item-26107" class="hidden-nav-button menu-item menu-item-type-custom menu-item-object-custom menu-item-26107 menu-item-design-default item-event-hover callto-btn">
                            <a href="#">Black Friday</a>
                        </li>

                    </ul>
                </div>
            </div>
            <!--END MAIN-NAV-->


            <div class="site-logo">
                <div class="basel-logo-wrap">
                    <a href="#" class="basel-logo basel-main-logo" rel="home">
                        <img src="{{asset('themes/images/logo.png')}}" alt="" />
                    </a>
                </div>
            </div>


            @include('headers/columns/right-column-1')

        </div>
    </div>
</header>
<!--END MAIN HEADER-->
