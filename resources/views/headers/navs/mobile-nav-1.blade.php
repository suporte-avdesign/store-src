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
                <a href="{{route('cart')}}">Carrinho</a>
            </li>
        </ul>
    </div>
    <div class="header-links my-account-with-text">
        <ul>
            <li class="wishlist">
                <a href="{{route('wishlist')}}">Lista de Desejo</a>
            </li>
            <li class="login-side-opener">
                <a href="{{route('login')}}">Login / Cadastre-se</a>
            </li>
        </ul>
    </div>
</div>
