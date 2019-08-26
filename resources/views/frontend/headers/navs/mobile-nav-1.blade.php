<div class="mobile-nav">
    <form role="search" method="get" id="searchform" class="searchform  basel-ajax-search" action="{{url(setRoute('product').'search')}}/" data-thumbnail="1" data-price="1" data-count="5" data-post_type="product">
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
            @forelse($menu as $section)
                <li id="menu-item-{{$section->id}}" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children current-menu-item current_page_item menu-item-{{$section->id}} menu-item-design-default item-event-hover">
                    <a href="{{url(setRoute('section').$section->slug)}}">{{$section->name}}</a>
                    <div class="sub-menu-dropdown color-scheme-dark">
                        <div class="container">
                            <ul class="sub-menu color-scheme-dark">
                                @forelse($section->categories as $category)
                                    <li id="menu-item-{{$category->id}}" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item current_page_item menu-item-{{$category->id}} menu-item-design-default item-event-hover">
                                        <a href="{{url(setRoute('category').$category->slug)}}">{{$category->name}}</a>
                                    </li>
                                @empty
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </li>
            @empty
            @endforelse

            <li id="menu-item-27318" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-27318 menu-item-design-default item-event-hover">
                <a href="#">Minha Conta</a>
                <div class="sub-menu-dropdown color-scheme-dark">
                    <div class="container">
                        <ul class="sub-menu color-scheme-dark">
                            <li id="menu-item-22149" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22149 menu-item-design-default item-event-hover">
                                <a href="{{route('login')}}">Logar</a>
                            </li>
                            <li id="menu-item-22150" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22150 menu-item-design-default item-event-hover">
                                <a href="{{route('account.order')}}">Meus Pedidos</a>
                            </li>
                            <li id="menu-item-22154" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22154 menu-item-design-default item-event-hover">
                                <a href="{{route('account.profile')}}">Alterar Senha</a>
                            </li>
                            <li id="menu-item-27153" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-27153 menu-item-design-default item-event-hover">
                                <a href="{{route('account.profile')}}">Alterar Dados</a>
                            </li>
                            <li id="menu-item-22151" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22151 menu-item-design-default item-event-hover">
                                <a href="{{route('account.address')}}">Endereço de Entrega</a>
                            </li>
                            <li id="menu-item-22156" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22156 menu-item-design-default item-event-hover">
                                <a href="javascript:logoutUser('{{route('logout')}}', '{{ csrf_token() }}');"">Sair da Conta</a>
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
            <li class="register">
                <a href="{{route('register')}}">Cadastre-se</a>
            </li>
            <li class="login-side-opener">
                <a href="{{route('login')}}">Login</a>
            </li>
        </ul>
    </div>
</div>
