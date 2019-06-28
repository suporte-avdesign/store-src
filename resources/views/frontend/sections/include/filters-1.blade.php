@if (count($categories) >= 1)
    <div class="filters-area">
        <div class="filters-inner-area row">
            <div id="BASEL_Widget_Sorting" class="filter-widget widget-count-4 col-xs-12 col-sm-6 col-md-3">
                <h5 class="widget-title">{{constLang('orderby')}}:</h5>
                <form class="woocommerce-ordering with-list" method="get">
                    <ul>
                        <li>
                            <a href="{{url(setRoute('category').$slug)}}/?orderby=Padrão" data-order="order-desc" @if($orderby == 'menu_order') class="selected-order" @endif>Padrão</a>
                        </li>
                        <li>
                            <a href="{{url(setRoute('category').$slug)}}/?orderby=Mais Popular" data-order="popularity" @if($orderby == 'Popular') class="selected-order" @endif>Mais Popular</a>
                        </li>
                        <li>
                            <a href="{{url(setRoute('category').$slug)}}/?orderby=Classificação" data-order="rating" @if($orderby == 'Classificação') class="selected-order" @endif>Classificação</a>
                        </li>
                        <li>
                            <a href="{{url(setRoute('category').$slug)}}/?orderby=Novidade" data-order="date" @if($orderby == 'Novidade') class="selected-order" @endif>Novidade</a>
                        </li>
                        <li>
                            <a href="{{url(setRoute('category').$slug)}}/?orderby=Preço Baixo" data-order="price-min" @if($orderby == 'price') class="selected-order" @endif>Preço: baixo para alto</a>
                        </li>
                        <li>
                            <a href="{{url(setRoute('category').$slug)}}/?orderby=Preço Alto" data-order="price-max" @if($orderby == 'price-desc') class="selected-order" @endif>Preço: alto para baixo</a>
                        </li>
                    </ul>
                    <input type="hidden" name="infinit_scrolling" value="" />
                </form>
            </div>
            <div id="BASEL_Widget_Price_Filter" class="filter-widget widget-count-4 col-xs-12 col-sm-6 col-md-3">
                <h5 class="widget-title">Filtrar por preço</h5>
                <div class="basel-price-filter">
                    <ul>
                        <li>
                            <a rel="nofollow" href="{{url(setRoute('category').$slug)}}/" class="">Todos</a>
                        </li>
                        <li>
                            <a rel="nofollow" href="{{url(setRoute('category').$slug)}}/?min_price=0&max_price=20" @if(isset($min_price) && $min_price  == 0) class="current-state" @endif>
                                <span class="woocommerce-Price-amount amount">
                                    <span class="woocommerce-Price-currencySymbol">R$ </span>0.00
                                </span> -
                                <span class="woocommerce-Price-amount amount">
                                    <span class="woocommerce-Price-currencySymbol">R$ </span>20,00
                                </span>
                            </a>
                        </li>
                        <li>
                            <a rel="nofollow" href="{{url(setRoute('category').$slug)}}/?min_price=20&max_price=30" @if($max_price == 30) class="current-state" @endif>
                                <span class="woocommerce-Price-amount amount">
                                    <span class="woocommerce-Price-currencySymbol">R$ </span>20,00
                                </span> -
                                <span class="woocommerce-Price-amount amount">
                                    <span class="woocommerce-Price-currencySymbol">R$ </span>30,00
                                </span>
                            </a>
                        </li>
                        <li>
                            <a rel="nofollow" href="{{url(setRoute('category').$slug)}}/?min_price=30&max_price=45" @if($max_price == 45) class="current-state" @endif>
                                <span class="woocommerce-Price-amount amount">
                                    <span class="woocommerce-Price-currencySymbol">R$ </span>30,00
                                </span> -
                                <span class="woocommerce-Price-amount amount">
                                    <span class="woocommerce-Price-currencySymbol">R$ </span>45,00
                                </span>
                            </a>
                        </li>
                        <li>
                            <a rel="nofollow" href="{{url(setRoute('category').$slug)}}/?min_price=45&max_price=60" @if($min_price == 45) class="current-state" @endif>
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
                        <li class="wc-layered-nav-term  with-swatch-color @if($filter_color == 'Preto') chosen @endif">
                            <a href="{{url(setRoute('category').$slug)}}/?filter_color=Preto">
                                <div class="filter-swatch">
                                    <span style="background-color: #0a0a0a;"></span>
                                </div>Preto
                            </a>
                            <span class="count">(26)</span>
                        </li>
                        <li class="wc-layered-nav-term  with-swatch-color @if($filter_color == 'Branco') chosen @endif">
                            <a href="{{url(setRoute('category').$slug)}}/?filter_color=Branco">
                                <div class="filter-swatch">
                                    <span style="background-color: #ffffff;"></span>
                                </div>Branco
                            </a>
                            <span class="count">(13)</span>
                        </li>
                        <li class="wc-layered-nav-term  with-swatch-color @if($filter_color == 'Marrom') chosen @endif">
                            <a href="{{url(setRoute('category').$slug)}}/?filter_color=Marrom">
                                <div class="filter-swatch">
                                    <span style="background-color: #ba6d09;"></span>
                                </div>Marrom
                            </a>
                            <span class="count">(24)</span>
                        </li>
                        <li class="wc-layered-nav-term  with-swatch-color @if($filter_color == 'Amarelo') chosen @endif">
                            <a href="{{url(setRoute('category').$slug)}}/?filter_color=Amarelo">
                                <div class="filter-swatch">
                                    <span style="background-color: #eded55;"></span>
                                </div>Amarelo
                            </a>
                            <span class="count">(13)</span>
                        </li>
                        <li class="wc-layered-nav-term with-swatch-color @if($filter_color == 'Vermelho') chosen @endif">
                            <a href="{{url(setRoute('category').$slug)}}/?filter_color=Vermelho">
                                <div class="filter-swatch">
                                    <span style="background-color: #dd3333;"></span>
                                </div>Vermelho
                            </a>
                            <span class="count">(3)</span>
                        </li>
                        <li class="wc-layered-nav-term  with-swatch-color @if($filter_color == 'Verde') chosen @endif">
                            <a href="{{url(setRoute('category').$slug)}}/?filter_color=Verde">
                                <div class="filter-swatch">
                                    <span style="background-color: #61a058;"></span>
                                </div>Verde
                            </a>
                            <span class="count">(20)</span>
                        </li>
                        <li class="wc-layered-nav-term  with-swatch-color @if($filter_color == 'Azul') chosen @endif">
                            <a href="{{url(setRoute('category').$slug)}}/?filter_color=Azul">
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
                <h5 class="widget-title">Filtrar por tamanho</h5>
                <div class="basel-scroll">
                    <ul class="show-labels-on swatches-normal swatches-display-inline basel-scroll-content">
                        <li class="wc-layered-nav-term  with-swatch-text @if($filter_size == '33') chosen @endif">
                            <a href="{{url(setRoute('category').$slug)}}/?filter_size=33">33</a>
                            <span class="count">(9)</span>
                        </li>
                        <li class="wc-layered-nav-term  with-swatch-text @if($filter_size == '34') chosen @endif">
                            <a href="{{url(setRoute('category').$slug)}}/?filter_size=34">34</a>
                            <span class="count">(14)</span>
                        </li>
                        <li class="wc-layered-nav-term  with-swatch-text" @if($filter_size == '35') chosen @endif">
                            <a href="{{url(setRoute('category').$slug)}}/?filter_size=35">35</a>
                            <span class="count">(12)</span>
                        </li>
                        <li class="wc-layered-nav-term  with-swatch-text @if($filter_size == '36') chosen @endif">
                            <a href="{{url(setRoute('category').$slug)}}/?filter_size=36">36</a>
                            <span class="count">(9)</span>
                        </li>
                        <li class="wc-layered-nav-term  with-swatch-text" @if($filter_size == '37') chosen @endif">
                            <a href="{{url(setRoute('category').$slug)}}/?filter_size=37">37</a>
                            <span class="count">(7)</span>
                        </li>
                        <li class="wc-layered-nav-term  with-swatch-text @if($filter_size == '38') chosen @endif">
                            <a href="{{url(setRoute('category').$slug)}}/?filter_size=38">38</a>
                            <span class="count">(34)</span>
                        </li>
                        <li class="wc-layered-nav-term  with-swatch-text @if($filter_size == '39') chosen @endif">
                            <a href="{{url(setRoute('category').$slug)}}/?filter_size=39">39</a>
                            <span class="count">(14)</span>
                        </li>
                        <li class="wc-layered-nav-term  with-swatch-text @if($filter_size == '40') chosen @endif">
                            <a href="{{url(setRoute('category').$slug)}}/?filter_size=40">40</a>
                            <span class="count">(24)</span>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="basel-active-filters">
        @isset($_pjax)
            <div class="basel-clear-filters-wrapp">
                <a class="basel-clear-filters" href="{{url(setRoute('category').$slug)}}/">Cancelar Filtro</a>
            </div>
        @endif
        <div class="widget woocommerce widget_layered_nav_filters">
            <ul>
                @if($orderby)
                <li class="chosen">
                    <a rel="nofollow" aria-label="Remover Filtro" href="{{url(setRoute('category').$slug)}}/{{$parameter}}">{{$orderby}}</a>
                </li>
                @endif
                @if($filter_color)
                    <li class="chosen">
                        <a rel="nofollow" aria-label="Remover Filtro" href="{{url(setRoute('category').$slug)}}/{{$parameter}}">Cor: {{$filter_color}}</a>
                    </li>
                @endif
                @if($filter_size)
                    <li class="chosen">
                        <a rel="nofollow" aria-label="Remover Filtro" href="{{url(setRoute('category').$slug)}}/{{$parameter}}">Tam: {{$filter_size}}</a>
                    </li>
                @endif
                @if($max_price)
                    <li class="chosen">
                        <a rel="nofollow" aria-label="Remover Filtro" href="{{url(setRoute('category').$slug)}}/{{$parameter}}">Preço de
                            <span class="woocommerce-Price-amount amount">
                                <span class="woocommerce-Price-currencySymbol">R$ </span>{{$min_price}},00
                            </span> à
                            <span class="woocommerce-Price-amount amount">
                                <span class="woocommerce-Price-currencySymbol">R$ </span>{{$max_price}},00
                            </span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
@endif