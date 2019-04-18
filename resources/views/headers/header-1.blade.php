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
            <div class="main-nav site-navigation basel-navigation menu-left" role="navigation">
                <div class="menu-main-navigation-container"><ul id="menu-main-navigation" class="menu"><li id="menu-item-19422" class="dropdown-scroll menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-19422 menu-item-design-sized item-event-hover menu-item-has-children"><a href="https://demo.xtemos.com/basel/">Home</a>
                            <div class="sub-menu-dropdown color-scheme-dark">

                                <div class="container">
                                    <div class="vc_row wpb_row vc_row-fluid col-five vc_custom_1475533876817"><div class="wpb_column vc_column_container vc_col-sm-2 color-scheme-dark"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1487879314225" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/"><strong><span style="color: #1aada3;">1.</span> HOME DEFAULT</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1511344750662"><a href="https://demo.xtemos.com/basel/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/prev-main.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1487879330860" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/furniture/"><strong><span style="color: #1aada3;">2.</span> Furniture store</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1487879340170"><a href="https://demo.xtemos.com/basel/furniture/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/prev-furniture.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1521125735460" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-fashion-new/"><strong><span style="color: #1aada3;">3.</span> Fashion 4.0</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1521125450949"><a href="https://demo.xtemos.com/basel/home-fashion-new/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2017/11/basel-fashion-new-preview.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1497366060747" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-beer"><strong><span style="color: #1aada3;">4.</span> Beer</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1497366048454"><a href="https://demo.xtemos.com/basel/home-beer" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/beer-preview.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1505233042256" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-fashion-flat/"><strong><span style="color: #1aada3;">5.</span> Fashion Flat</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1484179872282"><a href="https://demo.xtemos.com/basel/home-fashion-flat/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/fashion-flat.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div></div><div class="vc_row wpb_row vc_row-fluid col-five vc_custom_1476734232282"><div class="wpb_column vc_column_container vc_col-sm-2 color-scheme-dark"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1505233031603" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-sushi/"><strong><span style="color: #1aada3;">6. </span>Sushi</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1494340426796"><a href="https://demo.xtemos.com/basel/home-sushi/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/prev-sushi.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1505232776768" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-medical"><strong><span style="color: #1aada3;">7.</span> Medical</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1502548857766"><a href="https://demo.xtemos.com/basel/home-medical" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/prev-medical.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1505232782803" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-lingerie/"><strong><span style="color: #1aada3;">8.</span> Lingerie store</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1484179846825"><a href="https://demo.xtemos.com/basel/home-lingerie/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/menu-lingerie.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1505232788620" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-electronics/"><strong><span style="color: #1aada3;">9.</span> Electronics</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1484179850350"><a href="https://demo.xtemos.com/basel/home-electronics/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/menu-electronics.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1507713220973" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-bakery"><strong><span style="color: #1aada3;">10.</span> Bakery</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1505227180245"><a href="https://demo.xtemos.com/basel/home-bakery" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/bakery-preview.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-2 vc_hidden-lg vc_hidden-md vc_hidden-sm vc_hidden-xs"><div class="vc_column-inner"><div class="wpb_wrapper"></div></div></div></div><div class="vc_row wpb_row vc_row-fluid col-five vc_custom_1476734429377"><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1505232761917" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-organic/"><strong><span style="color: #1aada3;">11.</span> Organic shop</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1484179875277"><a href="https://demo.xtemos.com/basel/home-organic/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/menu-organic.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-2 color-scheme-dark"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1489510829487" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-cosmetics/"><strong><span style="color: #1aada3;">12.</span> Cosmetics</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1484179853637"><a href="https://demo.xtemos.com/basel/home-cosmetics/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/menu-cosmetics.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1489510835078" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-wine/"><strong><span style="color: #1aada3;">13.</span> Wine store</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1484179833512"><a href="https://demo.xtemos.com/basel/home-wine/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/menu-wine.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1489510842527" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-food/"><strong><span style="color: #1aada3;">14.</span> Food</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1484179856919"><a href="https://demo.xtemos.com/basel/home-food/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/food-menu.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1507713414438" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-hookahs"><strong><span style="color: #1aada3;">15.</span> Hookahs</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1491314522805"><a href="https://demo.xtemos.com/basel/home-hookahs" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/hookahs-posters.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper"></div></div></div></div><div class="vc_row wpb_row vc_row-fluid col-five vc_custom_1480368580966"><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1489510853614" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-sport/"><strong><span style="color: #1aada3;">16.</span> SPORT SHOP</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1484179839315"><a href="https://demo.xtemos.com/basel/home-sport/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/Home-sport-–-Xtemos-New.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-2 color-scheme-dark"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1489510858878" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-shoes"><strong><span style="color: #1aada3;">17.</span> Shoes store</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1484179842827"><a href="https://demo.xtemos.com/basel/home-shoes" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/menu-shoes.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1489510865027" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-flat-full-width/"><strong><span style="color: #1aada3;">18.</span> Flat full-width</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1484179836454"><a href="https://demo.xtemos.com/basel/home-flat-full-width/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/menu-1.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1507713407333" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-dark"><strong><span style="color: #1aada3;">19.</span> Dark version</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1487879356791"><a href="https://demo.xtemos.com/basel/home-dark" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/menu-dark.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1505227232397" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-cars/"><strong><span style="color: #1aada3;">20.</span> Cars</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1484596614922"><a href="https://demo.xtemos.com/basel/home-cars/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/menu-cars.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div></div><div class="vc_row wpb_row vc_row-fluid col-five vc_custom_1481570312586"><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1489511338136" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-coffee/"><strong><span style="color: #1aada3;">21.</span> Coffee</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1484179820702"><a href="https://demo.xtemos.com/basel/home-coffee/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/menu-3.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1489511350239" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-parallax/"><strong><span style="color: #1aada3;">22.</span> Parallax</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1487879596250"><a href="https://demo.xtemos.com/basel/home-parallax/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/menu-parallax.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1507713397750" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-posters/"><strong><span style="color: #1aada3;">23.</span> Posters</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1489510676714"><a href="https://demo.xtemos.com/basel/home-posters/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/prev-posters.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1489511361162" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-minimalist/"><strong><span style="color: #1aada3;">24.</span> Minimalist</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1484179804439"><a href="https://demo.xtemos.com/basel/home-minimalist/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/menu-minimalist.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1505227238339" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-fashion/"><strong><span style="color: #1aada3;">25.</span> Fashion store</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1484179860005"><a href="https://demo.xtemos.com/basel/home-fashion/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/prev-fashion.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper"></div></div></div></div><div class="vc_row wpb_row vc_row-fluid col-five vc_custom_1480368595821"><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1489511373113" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-jewellery/"><strong><span style="color: #1aada3;">26.</span> Jewellery</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1484179827037"><a href="https://demo.xtemos.com/basel/home-jewellery/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/jewellery-menu.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1489511379278" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-landing/"><strong><span style="color: #1aada3;">27.</span> LANDING</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1484179794109"><a href="https://demo.xtemos.com/basel/home-landing/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/landing-menu.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1497366106021" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-games/"><strong><span style="color: #1aada3;">28.</span> Games</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1489510728211"><a href="https://demo.xtemos.com/basel/home-games/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/prev-games.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1507713389638" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/hero-slider/"><strong><span style="color: #1aada3;">29.</span> HERO SLIDER</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1484179807695"><a href="https://demo.xtemos.com/basel/hero-slider/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/prev-slider.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1505227244721" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-portfolio/"><strong><span style="color: #1aada3;">30.</span> Portfolio</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1484179817344"><a href="https://demo.xtemos.com/basel/home-portfolio/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/menu-portfolio.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div></div><div class="vc_row wpb_row vc_row-fluid col-five vc_custom_1480368595821"><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1489511413562" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-flowers/"><strong><span style="color: #1aada3;">31.</span> Flowers</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1484179801241"><a href="https://demo.xtemos.com/basel/home-flowers/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/prev-flovers.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1489511419135" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-corporate/"><strong><span style="color: #1aada3;">32.</span> CORPORATE</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1484179725983"><a href="https://demo.xtemos.com/basel/home-corporate/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/corpo-menu.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1489511425520" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-agency/"><strong><span style="color: #1aada3;">33.</span> AGENCY</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1484179713487"><a href="https://demo.xtemos.com/basel/home-agency/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/agency-menu.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1491314546352" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-construction/"><strong><span style="color: #1aada3;">34.</span> CONSTRUCTION</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1491314537651"><a href="https://demo.xtemos.com/basel/home-construction/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/menu-construction.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1505227251234" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-marketplace/"><strong><span style="color: #1aada3;">35.</span> marketplace</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1484179810834"><a href="https://demo.xtemos.com/basel/home-marketplace/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/market-menu.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div></div><div class="vc_row wpb_row vc_row-fluid col-five vc_custom_1480368595821"><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1497366123243" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-pets/"><strong><span style="color: #1aada3;">36.</span> Pets</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1489510578999"><a href="https://demo.xtemos.com/basel/home-pets/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/prev-pets.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1505227279919" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-bicycle/"><strong><span style="color: #1aada3;">37.</span> Bicycle store</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1484179797854"><a href="https://demo.xtemos.com/basel/home-bicycle/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/prev-bicicle.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1505227272499" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/?rtl"><strong><span style="color: #1aada3;">38.</span> RTL Ready</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1484179814135"><a href="https://demo.xtemos.com/basel/?rtl" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/prev-main-rtl.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1507713381542" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/watch-demo/"><strong><span style="color: #1aada3;">39.</span> Watches</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1484179768332"><a href="https://demo.xtemos.com/basel/watch-demo/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/prev-watch.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-2"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1521125357348" >
                                                        <div class="wpb_wrapper">
                                                            <h5 style="text-align: center;"><a style="color: #1b1919; text-transform: uppercase; letter-spacing: 0.3px;" href="https://demo.xtemos.com/basel/home-lighting/"><strong><span style="color: #1aada3;">40.</span> Lighting</strong></a></h5>

                                                        </div>
                                                    </div>
                                                    <div class="vc_custom_1507713512513"><a href="https://demo.xtemos.com/basel/home-lighting/" class="vc_single_image-wrapper vc_box_border_grey"><img class="basel-lasy-image" data-blazy-src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/preview-lighting.jpg" src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/demos_placeholder.png" /></a></div></div></div></div></div><style type="text/css" data-type="vc_shortcodes-custom-css">.vc_custom_1475533876817{margin-bottom: 0px !important;}.vc_custom_1476734232282{margin-bottom: 0px !important;}.vc_custom_1476734429377{margin-bottom: 0px !important;}.vc_custom_1480368580966{margin-bottom: 0px !important;}.vc_custom_1481570312586{margin-bottom: 0px !important;}.vc_custom_1480368595821{margin-bottom: 0px !important;}.vc_custom_1480368595821{margin-bottom: 0px !important;}.vc_custom_1480368595821{margin-bottom: 0px !important;}.vc_custom_1487879314225{margin-bottom: 10px !important;}.vc_custom_1511344750662{margin-bottom: 35px !important;}.vc_custom_1487879330860{margin-bottom: 10px !important;}.vc_custom_1487879340170{margin-bottom: 35px !important;}.vc_custom_1521125735460{margin-bottom: 10px !important;}.vc_custom_1521125450949{margin-bottom: 35px !important;}.vc_custom_1497366060747{margin-bottom: 10px !important;}.vc_custom_1497366048454{margin-bottom: 35px !important;}.vc_custom_1505233042256{margin-bottom: 10px !important;}.vc_custom_1484179872282{margin-bottom: 35px !important;}.vc_custom_1505233031603{margin-bottom: 10px !important;}.vc_custom_1494340426796{margin-bottom: 0px !important;}.vc_custom_1505232776768{margin-bottom: 10px !important;}.vc_custom_1502548857766{margin-bottom: 35px !important;}.vc_custom_1505232782803{margin-bottom: 10px !important;}.vc_custom_1484179846825{margin-bottom: 35px !important;}.vc_custom_1505232788620{margin-bottom: 10px !important;}.vc_custom_1484179850350{margin-bottom: 35px !important;background-color: rgba(255,255,255,0.1) !important;*background-color: rgb(255,255,255) !important;}.vc_custom_1507713220973{margin-bottom: 10px !important;}.vc_custom_1505227180245{margin-bottom: 35px !important;}.vc_custom_1505232761917{margin-bottom: 10px !important;}.vc_custom_1484179875277{margin-bottom: 35px !important;}.vc_custom_1489510829487{margin-bottom: 10px !important;}.vc_custom_1484179853637{margin-bottom: 35px !important;}.vc_custom_1489510835078{margin-bottom: 10px !important;}.vc_custom_1484179833512{margin-bottom: 35px !important;}.vc_custom_1489510842527{margin-bottom: 10px !important;}.vc_custom_1484179856919{margin-bottom: 35px !important;}.vc_custom_1507713414438{margin-bottom: 10px !important;}.vc_custom_1491314522805{margin-bottom: 35px !important;}.vc_custom_1489510853614{margin-bottom: 10px !important;}.vc_custom_1484179839315{margin-bottom: 35px !important;}.vc_custom_1489510858878{margin-bottom: 10px !important;}.vc_custom_1484179842827{margin-bottom: 35px !important;}.vc_custom_1489510865027{margin-bottom: 10px !important;}.vc_custom_1484179836454{margin-bottom: 35px !important;}.vc_custom_1507713407333{margin-bottom: 10px !important;}.vc_custom_1487879356791{margin-bottom: 35px !important;}.vc_custom_1505227232397{margin-bottom: 10px !important;}.vc_custom_1484596614922{margin-bottom: 35px !important;}.vc_custom_1489511338136{margin-bottom: 10px !important;}.vc_custom_1484179820702{margin-bottom: 35px !important;}.vc_custom_1489511350239{margin-bottom: 10px !important;}.vc_custom_1487879596250{margin-bottom: 35px !important;}.vc_custom_1507713397750{margin-bottom: 10px !important;}.vc_custom_1489510676714{margin-bottom: 35px !important;}.vc_custom_1489511361162{margin-bottom: 10px !important;}.vc_custom_1484179804439{margin-bottom: 35px !important;}.vc_custom_1505227238339{margin-bottom: 10px !important;}.vc_custom_1484179860005{margin-bottom: 35px !important;}.vc_custom_1489511373113{margin-bottom: 10px !important;}.vc_custom_1484179827037{margin-bottom: 35px !important;}.vc_custom_1489511379278{margin-bottom: 10px !important;}.vc_custom_1484179794109{margin-bottom: 35px !important;}.vc_custom_1497366106021{margin-bottom: 10px !important;}.vc_custom_1489510728211{margin-bottom: 35px !important;}.vc_custom_1507713389638{margin-bottom: 10px !important;}.vc_custom_1484179807695{margin-bottom: 35px !important;}.vc_custom_1505227244721{margin-bottom: 10px !important;}.vc_custom_1484179817344{margin-bottom: 35px !important;}.vc_custom_1489511413562{margin-bottom: 10px !important;}.vc_custom_1484179801241{margin-bottom: 35px !important;}.vc_custom_1489511419135{margin-bottom: 10px !important;}.vc_custom_1484179725983{margin-bottom: 35px !important;}.vc_custom_1489511425520{margin-bottom: 10px !important;}.vc_custom_1484179713487{margin-bottom: 35px !important;}.vc_custom_1491314546352{margin-bottom: 10px !important;}.vc_custom_1491314537651{margin-bottom: 35px !important;}.vc_custom_1505227251234{margin-bottom: 10px !important;}.vc_custom_1484179810834{margin-bottom: 35px !important;}.vc_custom_1497366123243{margin-bottom: 10px !important;}.vc_custom_1489510578999{margin-bottom: 35px !important;}.vc_custom_1505227279919{margin-bottom: 10px !important;}.vc_custom_1484179797854{margin-bottom: 35px !important;}.vc_custom_1505227272499{margin-bottom: 10px !important;}.vc_custom_1484179814135{margin-bottom: 35px !important;}.vc_custom_1507713381542{margin-bottom: 10px !important;}.vc_custom_1484179768332{margin-bottom: 0px !important;}.vc_custom_1521125357348{margin-bottom: 10px !important;}.vc_custom_1507713512513{margin-bottom: 35px !important;}</style>
                                </div>

                            </div>
                            <style type="text/css">.menu-item-19422 > .sub-menu-dropdown {min-height: 10px; width: 1125px; }</style></li>
                        <li id="menu-item-19427" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item current_page_item menu-item-19427 menu-item-design-full-width item-event-hover item-with-label item-label-sale menu-item-has-children"><a href="https://demo.xtemos.com/basel/shop/">Shop<span class="menu-label menu-label-sale">Sale</span></a>
                            <div class="sub-menu-dropdown color-scheme-dark">

                                <div class="container">
                                    <div class="vc_row wpb_row vc_row-fluid menu-shop-full-width vc_custom_1479204564519 vc_row-o-equal-height vc_row-o-content-top vc_row-flex"><div class="wpb_column has-border vc_column_container vc_col-sm-9 vc_col-has-fill"><div class="vc_column-inner vc_custom_1480366259560"><div class="wpb_wrapper"><div class="vc_row wpb_row vc_inner vc_row-fluid vc_custom_1474656058991"><div class="wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner vc_custom_1446742142663"><div class="wpb_wrapper">
                                                                    <div class="wpb_text_column wpb_content_element vc_custom_1502700496580" >
                                                                        <div class="wpb_wrapper">
                                                                            <ul class="sub-menu">
                                                                                <li><a href="https://demo.xtemos.com/basel/product-category/woman/">Shop Styles</a>
                                                                                    <ul class="sub-sub-menu">
                                                                                        <li><a href="https://demo.xtemos.com/basel/shop/?shopmasonryalt">Masonry grid</a></li>
                                                                                        <li class="item-with-label item-label-new"><a href="https://demo.xtemos.com/basel/shop/?shop_alt">Alternative shop</a></li>
                                                                                        <li><a href="https://demo.xtemos.com/basel/shop/?shophover1">Default style</a></li>
                                                                                        <li><a href="https://demo.xtemos.com/basel/shop/?shophover2">Button on hover</a></li>
                                                                                        <li><a href="https://demo.xtemos.com/basel/shop/?shophover3">Button hover alt</a></li>
                                                                                        <li><a href="https://demo.xtemos.com/basel/shop/?shophover4">Hover info</a></li>
                                                                                        <li><a href="https://demo.xtemos.com/basel/shop/?shophover6">Standard button</a></li>
                                                                                        <li class="item-with-label item-label-new"><a href="https://demo.xtemos.com/basel/shop/?shophover8">Quick shop products <span class="menu-label menu-label-new">NEW</span></a></li>
                                                                                        <li class="item-with-label item-label-hot"><a href="https://demo.xtemos.com/basel/shop/?list_view">Grid/List switcher <span class="menu-label menu-label-hot">HOT</span></a></li>
                                                                                    </ul>
                                                                                </li>
                                                                            </ul>

                                                                        </div>
                                                                    </div>
                                                                </div></div></div><div class="wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner vc_custom_1446742137800"><div class="wpb_wrapper">
                                                                    <div class="wpb_text_column wpb_content_element vc_custom_1475612615663" >
                                                                        <div class="wpb_wrapper">
                                                                            <ul class="sub-menu">
                                                                                <li><a href="https://demo.xtemos.com/basel/shop/woman/jur-detail-jacket/">Product Pages</a>
                                                                                    <ul class="sub-sub-menu">
                                                                                        <li class="item-with-label"><a href="https://demo.xtemos.com/basel/shop/man/coloured-jacket-basic/">Default style</a></li>
                                                                                        <li class="item-with-label"><a href="https://demo.xtemos.com/basel/shop/man/coloured-jacket-basic/?productalt">Alternative style</a></li>
                                                                                        <li class="item-with-label item-label-new"><a href="https://demo.xtemos.com/basel/shop/other/new-brands/yomber-jacket-trim/">Compact <span class="menu-label menu-label-new">NEW</span></a></li>
                                                                                        <li class="item-with-label"><a href="https://demo.xtemos.com/basel/shop/woman/virror-detail-cape/?productsticky">Sticky details</a></li>
                                                                                        <li class="item-with-label item-label-hot"><a href="https://demo.xtemos.com/basel/shop/accessories/before-decaf-phone-case/">Extra content <span class="menu-label menu-label-hot">HOT</span></a></li>
                                                                                        <li class="item-with-label"><a href="https://demo.xtemos.com/basel/shop/accessories/bags/ethnic-jacquard-backpack/">Variations images</a></li>
                                                                                        <li class="item-with-label item-label-sale"><a href="https://demo.xtemos.com/basel/shop/accessories/bags/ethnic-jacquard-backpack/">Thumbnails left</a></li>
                                                                                        <li><a href="https://demo.xtemos.com/basel/shop/woman/jur-detail-jacket/?thumbsbottom">Thumbnails bottom</a></li>
                                                                                        <li><a href="https://demo.xtemos.com/basel/shop/woman/virror-detail-cape/?productbg">Product with background</a></li>
                                                                                    </ul>
                                                                                </li>
                                                                            </ul>

                                                                        </div>
                                                                    </div>
                                                                </div></div></div><div class="wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner vc_custom_1446742132151"><div class="wpb_wrapper">
                                                                    <div class="wpb_text_column wpb_content_element vc_custom_1502699626543" >
                                                                        <div class="wpb_wrapper">
                                                                            <ul class="sub-menu">
                                                                                <li><a href="https://demo.xtemos.com/basel/product-category/man/">Product Features</a>
                                                                                    <ul class="sub-sub-menu">
                                                                                        <li><a href="https://demo.xtemos.com/basel/shop/other/sport/y-adidas-ultra-boost/">360° product viewer</a></li>
                                                                                        <li><a href="http://demo.xtemos.com/basel/shop/woman/basic-knit-dress-chest/">Zoom image</a></li>
                                                                                        <li class="item-with-label item-label-new"><a href="https://demo.xtemos.com/basel/shop/accessories/before-decaf-phone-case/">With video</a></li>
                                                                                        <li><a href="https://demo.xtemos.com/basel/shop/woman/gthnic-detail-open-jacket/?imagelarge">Large Image</a></li>
                                                                                        <li class="item-with-label item-label-new"><a href="https://demo.xtemos.com/basel/shop/?infinit_scrolling">Infinit scrolling <span class="menu-label menu-label-new">NEW</span></a></li>
                                                                                        <li><a href="https://demo.xtemos.com/basel/shop/woman/basic-knit-dress-chest/">Variable Product</a></li>
                                                                                        <li><a href="https://demo.xtemos.com/basel/shop/jewellery/yeptum-ring-earrings/">Grouped Product</a></li>
                                                                                        <li><a href="https://demo.xtemos.com/basel/shop/other/flat-brands/yrum-parturt-egestas/">External Product</a></li>
                                                                                        <li><a href="https://demo.xtemos.com/basel/shop/bags/vintage-cinch-backpack/?prodright">Sidebar right</a></li>
                                                                                    </ul>
                                                                                </li>
                                                                            </ul>

                                                                        </div>
                                                                    </div>
                                                                </div></div></div><div class="wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                                    <div class="wpb_text_column wpb_content_element vc_custom_1502699113582" >
                                                                        <div class="wpb_wrapper">
                                                                            <ul class="sub-menu">
                                                                                <li><a href="https://demo.xtemos.com/basel/product-category/man/">Shop Pages</a>
                                                                                    <ul class="sub-sub-menu">
                                                                                        <li><a href="https://demo.xtemos.com/basel/shop/?shop2">2 Columns</a></li>
                                                                                        <li><a href="https://demo.xtemos.com/basel/shop/?shop3">3 Columns</a></li>
                                                                                        <li><a href="https://demo.xtemos.com/basel/shop/?shop4">4 Columns</a></li>
                                                                                        <li><a href="https://demo.xtemos.com/basel/shop/?shop6">6 Columns</a></li>
                                                                                        <li><a href="https://demo.xtemos.com/basel/shop/?shopleft">Sidebar Left</a></li>
                                                                                        <li><a href="https://demo.xtemos.com/basel/shop/?shopright">Sidebar Right</a></li>
                                                                                        <li><a href="https://demo.xtemos.com/basel/shop/?shopfullwidth">Full width</a></li>
                                                                                        <li><a href="https://demo.xtemos.com/basel/product-category/shoes/">Category banner</a></li>
                                                                                        <li class="item-with-label item-label-new"><a href="https://demo.xtemos.com/basel/shop/?rtl">RTL Shop page <span class="menu-label menu-label-new">NEW</span></a></li>
                                                                                    </ul>
                                                                                </li>
                                                                            </ul>

                                                                        </div>
                                                                    </div>
                                                                </div></div></div></div><div class="vc_row wpb_row vc_inner vc_row-fluid vc_custom_1474894251362"><div class="wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner vc_custom_1474656302067"><div class="wpb_wrapper">
                                                                    <div class="wpb_text_column wpb_content_element vc_custom_1479204795229 has-border" >
                                                                        <div class="wpb_wrapper">
                                                                            <h5 style="text-transform: uppercase; font-weight: bold; margin-bottom: 5px;"><i class="fa fa-truck" style="margin-right: 7px; font-size: 14px;"></i>Free Shipping</h5>
                                                                            <p>Free for $50+ orders</p>

                                                                        </div>
                                                                    </div>
                                                                </div></div></div><div class="wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner vc_custom_1474656297012"><div class="wpb_wrapper">
                                                                    <div class="wpb_text_column wpb_content_element vc_custom_1479204799674 has-border" >
                                                                        <div class="wpb_wrapper">
                                                                            <h5 style="text-transform: uppercase; font-weight: bold; margin-bottom: 5px;"><i class="fa fa-phone" style="margin-right: 7px; font-size: 14px;"></i>Buyer Support</h5>
                                                                            <p>Get in touch 24/7</p>

                                                                        </div>
                                                                    </div>
                                                                </div></div></div><div class="wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner vc_custom_1474656291867"><div class="wpb_wrapper">
                                                                    <div class="wpb_text_column wpb_content_element vc_custom_1479204804099 has-border" >
                                                                        <div class="wpb_wrapper">
                                                                            <h5 style="text-transform: uppercase; font-weight: bold; margin-bottom: 5px;"><i class="fa fa-support" style="margin-right: 7px; font-size: 14px;"></i>Total Security</h5>
                                                                            <p>Secure checkout</p>

                                                                        </div>
                                                                    </div>
                                                                </div></div></div><div class="wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner vc_custom_1474656282948"><div class="wpb_wrapper">
                                                                    <div class="wpb_text_column wpb_content_element vc_custom_1479204808986 has-border" >
                                                                        <div class="wpb_wrapper">
                                                                            <h5 style="text-transform: uppercase; font-weight: bold; margin-bottom: 5px;"><i class="fa fa-reply" style="margin-right: 7px; font-size: 14px;"></i>RETURN POLICY</h5>
                                                                            <p>14 days ago</p>

                                                                        </div>
                                                                    </div>
                                                                </div></div></div></div></div></div></div><div class="wpb_column hide-pag vc_column_container vc_col-sm-3 color-scheme-dark"><div class="vc_column-inner vc_custom_1475581999943"><div class="wpb_wrapper">				<div id="carousel-139" class="vc_carousel_container " data-owl-carousel data-hide_pagination_control="yes" data-hide_prev_next_buttons="yes" data-desktop="1" data-desktop_small="1" data-tablet="1" data-mobile="2">
                                                        <div class="owl-carousel product-items ">

                                                            <div class="product-item owl-carousel-item">
                                                                <div class="owl-carousel-item-inner">

                                                                    <div class="product-grid-item basel-hover-quick product product-in-carousel post-24254 type-product status-publish has-post-thumbnail product_cat-flat-brands first instock shipping-taxable purchasable product-type-variable has-default-attributes" data-loop="1" data-id="24254">

                                                                        <div class="product-element-top">
                                                                            <a href="https://demo.xtemos.com/basel/shop/other/flat-brands/ybuum-natoq-partnt/">
                                                                                <img width="273" height="348" src="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-526x671.jpg 526w" sizes="(max-width: 273px) 100vw, 273px" />	</a>
                                                                            <div class="hover-img">
                                                                                <a href="https://demo.xtemos.com/basel/shop/other/flat-brands/ybuum-natoq-partnt/">
                                                                                    <img width="273" height="348" src="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-2.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-2.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-2-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-2-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-2-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-2-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-2-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-2-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-2-526x671.jpg 526w" sizes="(max-width: 273px) 100vw, 273px" />				</a>
                                                                            </div>
                                                                            <div class="basel-buttons">

                                                                                <div class="yith-wcwl-add-to-wishlist add-to-wishlist-24254">
                                                                                    <div class="yith-wcwl-add-button show" style="display:block">


                                                                                        <a href="/basel/shop/?infinit_scrolling&#038;add_to_wishlist=24254" rel="nofollow" data-product-id="24254" data-product-type="variable" class="add_to_wishlist" >
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

                                                                                <div class="clear"></div>		<div class="basel-compare-btn product-compare-button"><a class="button" href="https://demo.xtemos.com/basel/compare/" data-added-text="Compare products" data-id="24254">Compare</a></div>					<div class="quick-view">
                                                                                    <a
                                                                                            href="https://demo.xtemos.com/basel/shop/other/flat-brands/ybuum-natoq-partnt/"
                                                                                            class="open-quick-view"
                                                                                            data-id="24254">Quick View</a>
                                                                                </div>
                                                                            </div>

                                                                            <div class="quick-shop-wrapper">
                                                                                <div class="quick-shop-close"><span>Close</span></div>
                                                                                <div class="quick-shop-btn">
                                                                                    <a href="#" class="btn-quick-shop" data-id="24254"><span>Quick shop</span></a>
                                                                                </div>
                                                                                <div class="quick-shop-form">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="swatches-wrapper">
                                                                            <div class="swatches-on-grid"><div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-" style="background-color:#eded55;" data-image-src="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7.jpg" data-image-srcset="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-526x671.jpg 526w" data-image-sizes="(max-width: 870px) 100vw, 870px">Yellow</div><div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-" style="background-color:#61a058;" data-image-src="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7.jpg" data-image-srcset="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-526x671.jpg 526w" data-image-sizes="(max-width: 870px) 100vw, 870px">Green</div><div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-" style="background-color:#769ec1;" data-image-src="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7.jpg" data-image-srcset="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-7-526x671.jpg 526w" data-image-sizes="(max-width: 870px) 100vw, 870px">Blue</div></div></div>
                                                                        <h3 class="product-title"><a href="https://demo.xtemos.com/basel/shop/other/flat-brands/ybuum-natoq-partnt/">Ybuum natoq partnt</a></h3>


                                                                        <span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&pound;</span>572.00</span></span>



                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="product-item owl-carousel-item">
                                                                <div class="owl-carousel-item-inner">

                                                                    <div class="product-grid-item basel-hover-quick product product-in-carousel post-24253 type-product status-publish has-post-thumbnail product_cat-flat-brands instock sale shipping-taxable purchasable product-type-variable has-default-attributes" data-loop="2" data-id="24253">

                                                                        <div class="product-element-top">
                                                                            <a href="https://demo.xtemos.com/basel/shop/other/flat-brands/yam-orci-lacinia/">
                                                                                <div class="product-labels labels-rounded"><span class="onsale product-label">-28%</span></div><img width="273" height="348" src="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-526x671.jpg 526w" sizes="(max-width: 273px) 100vw, 273px" />	</a>
                                                                            <div class="hover-img">
                                                                                <a href="https://demo.xtemos.com/basel/shop/other/flat-brands/yam-orci-lacinia/">
                                                                                    <img width="273" height="348" src="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-2.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-2.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-2-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-2-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-2-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-2-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-2-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-2-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-2-526x671.jpg 526w" sizes="(max-width: 273px) 100vw, 273px" />				</a>
                                                                            </div>
                                                                            <div class="basel-buttons">

                                                                                <div class="yith-wcwl-add-to-wishlist add-to-wishlist-24253">
                                                                                    <div class="yith-wcwl-add-button show" style="display:block">


                                                                                        <a href="/basel/shop/?infinit_scrolling&#038;add_to_wishlist=24253" rel="nofollow" data-product-id="24253" data-product-type="variable" class="add_to_wishlist" >
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

                                                                                <div class="clear"></div>		<div class="basel-compare-btn product-compare-button"><a class="button" href="https://demo.xtemos.com/basel/compare/" data-added-text="Compare products" data-id="24253">Compare</a></div>					<div class="quick-view">
                                                                                    <a
                                                                                            href="https://demo.xtemos.com/basel/shop/other/flat-brands/yam-orci-lacinia/"
                                                                                            class="open-quick-view"
                                                                                            data-id="24253">Quick View</a>
                                                                                </div>
                                                                            </div>

                                                                            <div class="quick-shop-wrapper">
                                                                                <div class="quick-shop-close"><span>Close</span></div>
                                                                                <div class="quick-shop-btn">
                                                                                    <a href="#" class="btn-quick-shop" data-id="24253"><span>Quick shop</span></a>
                                                                                </div>
                                                                                <div class="quick-shop-form">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="swatches-wrapper">
                                                                            <div class="swatches-on-grid"><div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-" style="background-color:#eded55;" data-image-src="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2.jpg" data-image-srcset="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-526x671.jpg 526w" data-image-sizes="(max-width: 870px) 100vw, 870px">Yellow</div><div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-" style="background-color:#dd3333;" data-image-src="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2.jpg" data-image-srcset="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-526x671.jpg 526w" data-image-sizes="(max-width: 870px) 100vw, 870px">Red</div><div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-" style="background-color:#769ec1;" data-image-src="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2.jpg" data-image-srcset="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-2-526x671.jpg 526w" data-image-sizes="(max-width: 870px) 100vw, 870px">Blue</div></div></div>
                                                                        <h3 class="product-title"><a href="https://demo.xtemos.com/basel/shop/other/flat-brands/yam-orci-lacinia/">Yom orci lacinia</a></h3>


                                                                        <span class="price"><del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&pound;</span>799.00</span></del> <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&pound;</span>572.00</span></ins></span>



                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="product-item owl-carousel-item">
                                                                <div class="owl-carousel-item-inner">

                                                                    <div class="product-grid-item basel-hover-quick product product-in-carousel post-24246 type-product status-publish has-post-thumbnail product_cat-flat-brands instock shipping-taxable purchasable product-type-variable has-default-attributes" data-loop="3" data-id="24246">

                                                                        <div class="product-element-top">
                                                                            <a href="https://demo.xtemos.com/basel/shop/other/flat-brands/yus-condntum-sapien/">
                                                                                <img width="273" height="348" src="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-526x671.jpg 526w" sizes="(max-width: 273px) 100vw, 273px" />	</a>
                                                                            <div class="hover-img">
                                                                                <a href="https://demo.xtemos.com/basel/shop/other/flat-brands/yus-condntum-sapien/">
                                                                                    <img width="273" height="348" src="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-2.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" srcset="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-2.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-2-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-2-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-2-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-2-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-2-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-2-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-2-526x671.jpg 526w" sizes="(max-width: 273px) 100vw, 273px" />				</a>
                                                                            </div>
                                                                            <div class="basel-buttons">

                                                                                <div class="yith-wcwl-add-to-wishlist add-to-wishlist-24246">
                                                                                    <div class="yith-wcwl-add-button show" style="display:block">


                                                                                        <a href="/basel/shop/?infinit_scrolling&#038;add_to_wishlist=24246" rel="nofollow" data-product-id="24246" data-product-type="variable" class="add_to_wishlist" >
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

                                                                                <div class="clear"></div>		<div class="basel-compare-btn product-compare-button"><a class="button" href="https://demo.xtemos.com/basel/compare/" data-added-text="Compare products" data-id="24246">Compare</a></div>					<div class="quick-view">
                                                                                    <a
                                                                                            href="https://demo.xtemos.com/basel/shop/other/flat-brands/yus-condntum-sapien/"
                                                                                            class="open-quick-view"
                                                                                            data-id="24246">Quick View</a>
                                                                                </div>
                                                                            </div>

                                                                            <div class="quick-shop-wrapper">
                                                                                <div class="quick-shop-close"><span>Close</span></div>
                                                                                <div class="quick-shop-btn">
                                                                                    <a href="#" class="btn-quick-shop" data-id="24246"><span>Quick shop</span></a>
                                                                                </div>
                                                                                <div class="quick-shop-form">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="swatches-wrapper">
                                                                            <div class="swatches-on-grid"><div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-" style="background-color:#eded55;" data-image-src="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6.jpg" data-image-srcset="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-526x671.jpg 526w" data-image-sizes="(max-width: 870px) 100vw, 870px">Yellow</div><div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-" style="background-color:#dd3333;" data-image-src="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6.jpg" data-image-srcset="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-526x671.jpg 526w" data-image-sizes="(max-width: 870px) 100vw, 870px">Red</div><div class="swatch-on-grid basel-tooltip swatch-has-image swatch-size-" style="background-color:#769ec1;" data-image-src="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6.jpg" data-image-srcset="https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6.jpg 870w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-235x300.jpg 235w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-768x980.jpg 768w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-803x1024.jpg 803w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-266x340.jpg 266w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-219x280.jpg 219w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-263x336.jpg 263w, https://demo.xtemos.com/basel/wp-content/uploads/2016/09/flat-full-width-product-6-526x671.jpg 526w" data-image-sizes="(max-width: 870px) 100vw, 870px">Blue</div></div></div>
                                                                        <h3 class="product-title"><a href="https://demo.xtemos.com/basel/shop/other/flat-brands/yus-condntum-sapien/">Yus condntum sapien</a></h3>


                                                                        <span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&pound;</span>572.00</span></span>



                                                                    </div>

                                                                </div>
                                                            </div>

                                                        </div> <!-- end product-items -->
                                                    </div> <!-- end #carousel-139 -->

                                                </div></div></div></div><style type="text/css" data-type="vc_shortcodes-custom-css">.vc_custom_1479204564519{margin-bottom: 30px !important;padding-top: 0px !important;padding-bottom: 0px !important;}.vc_custom_1480366259560{border-right-width: 1px !important;padding-top: 0px !important;padding-right: 0px !important;padding-bottom: 0px !important;border-right-color: #eaeaea !important;border-right-style: solid !important;}.vc_custom_1475581999943{margin-bottom: 0px !important;padding-right: 20px !important;padding-left: 20px !important;}.vc_custom_1474656058991{margin-top: 0px !important;margin-bottom: 0px !important;padding-top: 0px !important;}.vc_custom_1474894251362{margin-bottom: 0px !important;}.vc_custom_1446742142663{margin-bottom: 0px !important;}.vc_custom_1446742137800{margin-bottom: 0px !important;}.vc_custom_1446742132151{margin-bottom: 0px !important;}.vc_custom_1502700496580{margin-bottom: 10px !important;}.vc_custom_1475612615663{margin-bottom: 10px !important;}.vc_custom_1502699626543{margin-bottom: 10px !important;}.vc_custom_1502699113582{margin-bottom: 10px !important;}.vc_custom_1474656302067{margin-bottom: 0px !important;}.vc_custom_1474656297012{margin-bottom: 0px !important;}.vc_custom_1474656291867{margin-bottom: 0px !important;}.vc_custom_1474656282948{margin-bottom: 0px !important;}.vc_custom_1479204795229{margin-bottom: 0px !important;border-right-width: 1px !important;border-right-color: #e0e0e0 !important;border-right-style: solid !important;}.vc_custom_1479204799674{margin-bottom: 0px !important;border-right-width: 1px !important;border-right-color: #e0e0e0 !important;border-right-style: solid !important;}.vc_custom_1479204804099{margin-bottom: 0px !important;border-right-width: 1px !important;border-right-color: #e0e0e0 !important;border-right-style: solid !important;}.vc_custom_1479204808986{margin-bottom: 0px !important;}</style>
                                </div>

                            </div>
                        </li>
                        <li id="menu-item-22135" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-22135 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/category/lifestyle/">Blog</a>
                            <div class="sub-menu-dropdown color-scheme-dark">

                                <div class="container">

                                    <ul class="sub-menu color-scheme-dark">
                                        <li id="menu-item-19908" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-19908 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/category/lifestyle/?blog1">Blog Default</a></li>
                                        <li id="menu-item-20121" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-20121 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/category/lifestyle/?blog2">Alternative Style</a></li>
                                        <li id="menu-item-20122" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-20122 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/category/lifestyle/?blogfullwidth">Blog Full Width</a></li>
                                        <li id="menu-item-20123" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-20123 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/category/hobbies/?blog3">Small images</a></li>
                                        <li id="menu-item-20124" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-20124 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/category/hobbies/?blog4">Masonry Grid</a></li>
                                        <li id="menu-item-23824" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-23824 menu-item-design-default item-event-hover item-with-label item-label-hot"><a href="https://demo.xtemos.com/basel/category/hobbies/?blogmask">Blog mask<span class="menu-label menu-label-hot">Hot</span></a></li>
                                        <li id="menu-item-20125" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-20125 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/category/hobbies/?blogcol4">4 Columns</a></li>
                                        <li id="menu-item-20127" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-20127 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/posuere-at-mi-a-sem/">Blog Single Post</a></li>
                                        <li id="menu-item-25562" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-25562 menu-item-design-default item-event-hover item-with-label item-label-new"><a href="https://demo.xtemos.com/basel/category/lifestyle/?rtl">Blog RTL<span class="menu-label menu-label-new">New</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li id="menu-item-19904" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-19904 menu-item-design-sized item-event-hover menu-item-has-children"><a href="https://demo.xtemos.com/basel/contact-us-2/">Pages</a>
                            <div class="sub-menu-dropdown color-scheme-dark">

                                <div class="container">
                                    <div class="vc_row wpb_row vc_row-fluid vc_custom_1447326536772"><div class="wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1457906267198" >
                                                        <div class="wpb_wrapper">
                                                            <ul class="sub-menu">
                                                                <li><a href="https://demo.xtemos.com/basel/faqs/">Pages</a>
                                                                    <ul class="sub-sub-menu">
                                                                        <li><a href="https://demo.xtemos.com/basel/faqs/">FaQs</a></li>
                                                                        <li><a href="https://demo.xtemos.com/basel/about-me/">About Me</a></li>
                                                                        <li><a href="https://demo.xtemos.com/basel/our-shop/">Our Shop</a></li>
                                                                        <li><a href="https://demo.xtemos.com/basel/our-service/">Our Service</a></li>
                                                                        <li><a href="https://demo.xtemos.com/basel/our-company/">Our Company</a></li>
                                                                        <li><a href="https://demo.xtemos.com/basel/contact-us-3/">Contact Us</a></li>
                                                                        <li><a href="https://demo.xtemos.com/basel/contact-us-2/">Contact Us 2</a></li>
                                                                        <li><a href="https://demo.xtemos.com/basel/our-gallery/">Our Gallery</a></li>
                                                                    </ul>
                                                                </li>
                                                            </ul>

                                                        </div>
                                                    </div>
                                                </div></div></div><div class="wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1483621673237" >
                                                        <div class="wpb_wrapper">
                                                            <ul class="sub-menu">
                                                                <li><a href="https://demo.xtemos.com/basel/?head1">Headers</a>
                                                                    <ul class="sub-sub-menu">
                                                                        <li><a href="https://demo.xtemos.com/basel/?head1">Header base</a></li>
                                                                        <li><a href="https://demo.xtemos.com/basel/?head2">Simplified</a></li>
                                                                        <li><a href="https://demo.xtemos.com/basel/?head3">With logo center</a></li>
                                                                        <li class="item-with-label item-label-hot"><a href="https://demo.xtemos.com/basel/furniture/">Categories menu <span class="menu-label menu-label-hot">HOT</span></a></li>
                                                                        <li><a href="https://demo.xtemos.com/basel/?head5">Top bar menu</a></li>
                                                                        <li><a href="https://demo.xtemos.com/basel/?head9">Split menu</a></li>
                                                                        <li><a href="https://demo.xtemos.com/basel/watch-demo/?head7">Dark header</a></li>
                                                                        <li class="item-with-label item-label-hot"><a href="https://demo.xtemos.com/basel/home-flowers/?head8">Colored header <span class="menu-label menu-label-hot">HOT</span></a></li>
                                                                    </ul>
                                                                </li>
                                                            </ul>

                                                        </div>
                                                    </div>
                                                </div></div></div><div class="wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1450200825017" >
                                                        <div class="wpb_wrapper">
                                                            <ul class="sub-menu">
                                                                <li><a href="https://demo.xtemos.com/basel/portfolio/">Portfolio</a>
                                                                    <ul class="sub-sub-menu">
                                                                        <li><a href="https://demo.xtemos.com/basel/portfolio/?projects4">Grid 4 Columns</a></li>
                                                                        <li><a href="https://demo.xtemos.com/basel/portfolio/?gridnospace">Grid No Space</a></li>
                                                                        <li><a href="https://demo.xtemos.com/basel/portfolio/?portfoliofullwidth">Grid full width</a></li>
                                                                        <li><a href="https://demo.xtemos.com/basel/portfolio/?portfolio4">Alternative style</a></li>
                                                                        <li><a href="https://demo.xtemos.com/basel/portfolio/?portfolio5">Grid with text</a></li>
                                                                        <li><a href="https://demo.xtemos.com/basel/portfolio/a-fusce-fringilla-scelerisque/">Single Project</a></li>
                                                                        <li><a href="https://demo.xtemos.com/basel/portfolio/mus-enim-ac-mus-mus/">Project Full Width</a></li>
                                                                        <li><a href="https://demo.xtemos.com/basel/portfolio/varius-tempor-arcu-sociosqu/">Project with video</a></li>
                                                                    </ul>
                                                                </li>
                                                            </ul>

                                                        </div>
                                                    </div>
                                                </div></div></div><div class="wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                    <div class="wpb_text_column wpb_content_element vc_custom_1494340633560" >
                                                        <div class="wpb_wrapper">
                                                            <ul class="sub-menu">
                                                                <li><a href="https://demo.xtemos.com/basel/shop/">Shop</a>
                                                                    <ul class="sub-sub-menu">
                                                                        <li><a href="https://demo.xtemos.com/basel/cart/"><i class="fa fa-shopping-cart"></i>Shopping Cart</a></li>
                                                                        <li><a href="https://demo.xtemos.com/basel/checkout/"><i class="fa fa-credit-card"></i>Checkout</a></li>
                                                                        <li><a href="https://demo.xtemos.com/basel/my-account/"><i class="fa fa-user"></i>My Account</a></li>
                                                                        <li><a href="https://demo.xtemos.com/basel/wishlist/view/"><i class="fa fa-heart"></i>Wishlist</a></li>
                                                                        <li><a href="https://demo.xtemos.com/basel/track-order/">Track order</a></li>
                                                                        <li><a href="https://demo.xtemos.com/basel/404404">404 Not Found</a></li>
                                                                        <li><a href="https://demo.xtemos.com/basel/maintenance-page/">Maintenance mode</a></li>
                                                                        <li><a href="https://demo.xtemos.com/basel/maintenance-page-2-2/">Maintenance 2</a></li>
                                                                    </ul>
                                                                </li>
                                                            </ul>

                                                        </div>
                                                    </div>
                                                </div></div></div></div><style type="text/css" data-type="vc_shortcodes-custom-css">.vc_custom_1447326536772{margin-bottom: -35px !important;}.vc_custom_1457906267198{margin-bottom: 0px !important;}.vc_custom_1483621673237{margin-bottom: 0px !important;}.vc_custom_1450200825017{margin-bottom: 0px !important;}.vc_custom_1494340633560{margin-bottom: 1px !important;}</style>
                                </div>

                            </div>
                            <style type="text/css">.menu-item-19904 > .sub-menu-dropdown {min-height: 199px; width: 750px; }</style></li>
                        <li id="menu-item-26107" class="hidden-nav-button menu-item menu-item-type-custom menu-item-object-custom menu-item-26107 menu-item-design-default item-event-hover callto-btn"><a href="https://themeforest.net/item/basel-responsive-ecommerce-theme/14906749?ref=xtemos">purchase</a></li>
                        <li id="menu-item-19907" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-19907 menu-item-design-sized item-event-hover"><a href="https://demo.xtemos.com/basel/features/">Features</a><style type="text/css">.menu-item-19907 > .sub-menu-dropdown {background-image: url(https://demo.xtemos.com/basel/wp-content/uploads/2015/11/menu-baner-1.jpg); }.menu-item-19907 > .sub-menu-dropdown {min-height: 100px; width: 1000px; }</style>
                            <div class="sub-menu-dropdown color-scheme-dark">

                                <div class="container">

                                    <ul class="sub-menu color-scheme-dark">
                                        <li id="menu-item-19913" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-19913 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/recent-products/">WooCommerce</a>
                                            <ul class="sub-sub-menu color-scheme-dark">
                                                <li id="menu-item-19914" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-19914 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/recent-products/">Recent Products</a></li>
                                                <li id="menu-item-19921" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-19921 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/featured-products/">Featured Products</a></li>
                                                <li id="menu-item-22808" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22808 menu-item-design-default item-event-hover item-with-label item-label-hot"><a href="https://demo.xtemos.com/basel/element-products/">Element Products<span class="menu-label menu-label-hot">Hot</span></a></li>
                                                <li id="menu-item-19924" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-19924 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/single-product/">Single Product</a></li>
                                                <li id="menu-item-19929" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-19929 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/products-by-id/">Products by ID</a></li>
                                                <li id="menu-item-19939" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-19939 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/products-category/">Products Category</a></li>
                                                <li id="menu-item-19942" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-19942 menu-item-design-default item-event-hover item-with-label item-label-new"><a href="https://demo.xtemos.com/basel/products-categories/">Products Categories<span class="menu-label menu-label-new">New</span></a></li>
                                                <li id="menu-item-19948" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-19948 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/sale-products/">Sale Products</a></li>
                                                <li id="menu-item-19951" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-19951 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/top-rated/">Top Rated Products</a></li>
                                                <li id="menu-item-26594" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-26594 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/products-widgets/">Products widgets</a></li>
                                            </ul>
                                        </li>
                                        <li id="menu-item-19956" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-19956 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/blog-element/">Xtemos Elements</a>
                                            <ul class="sub-sub-menu color-scheme-dark">
                                                <li id="menu-item-19961" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-19961 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/google-maps/">Google Maps</a></li>
                                                <li id="menu-item-20013" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-20013 menu-item-design-default item-event-hover item-with-label item-label-hot"><a href="https://demo.xtemos.com/basel/banners/">Banners<span class="menu-label menu-label-hot">Hot</span></a></li>
                                                <li id="menu-item-20039" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-20039 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/titles/">Titles</a></li>
                                                <li id="menu-item-20006" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-20006 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/instagram/">Instagram</a></li>
                                                <li id="menu-item-19974" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-19974 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/social-buttons/">Social Buttons</a></li>
                                                <li id="menu-item-19985" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-19985 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/team-member/">Team Member</a></li>
                                                <li id="menu-item-27669" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-27669 menu-item-design-default item-event-hover item-with-label item-label-new"><a href="https://demo.xtemos.com/basel/section-dividers/">Section Dividers<span class="menu-label menu-label-new">New</span></a></li>
                                                <li id="menu-item-19998" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-19998 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/testimonials/">Testimonials</a></li>
                                                <li id="menu-item-19957" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-19957 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/blog-element/">Blog Element</a></li>
                                                <li id="menu-item-27670" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-27670 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/gradients/">Gradients</a></li>
                                            </ul>
                                        </li>
                                        <li id="menu-item-24494" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-24494 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/infobox/">Xtemos Elements</a>
                                            <ul class="sub-sub-menu color-scheme-dark">
                                                <li id="menu-item-24493" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-24493 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/24388-2/">Countdown timer</a></li>
                                                <li id="menu-item-24495" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-24495 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/24324-2/">360 degree view</a></li>
                                                <li id="menu-item-24496" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-24496 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/menu-price/">Menu price</a></li>
                                                <li id="menu-item-24498" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-24498 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/infobox/">Infobox</a></li>
                                                <li id="menu-item-24497" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-24497 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/24297-2/">Pricing tables</a></li>
                                                <li id="menu-item-24514" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-24514 menu-item-design-default item-event-hover item-with-label item-label-hot"><a href="https://demo.xtemos.com/basel/product-ajax-arrows/">Product AJAX arrows<span class="menu-label menu-label-hot">Hot</span></a></li>
                                                <li id="menu-item-24515" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-24515 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/product-load-more/">Product load more</a></li>
                                                <li id="menu-item-24513" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-24513 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/portfolio-element/">Portfolio element</a></li>
                                                <li id="menu-item-25660" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-25660 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/galleries/">Images gallery</a></li>
                                                <li id="menu-item-29035" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-29035 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/list-element/">List element</a></li>
                                            </ul>
                                        </li>
                                        <li id="menu-item-29292" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-29292 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/basel-slider/">Features</a>
                                            <ul class="sub-sub-menu color-scheme-dark">
                                                <li id="menu-item-29293" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-29293 menu-item-design-default item-event-hover item-with-label item-label-new"><a href="https://demo.xtemos.com/basel/basel-slider/">Basel Slider<span class="menu-label menu-label-new">New</span></a></li>
                                                <li id="menu-item-29294" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-29294 menu-item-design-default item-event-hover item-with-label item-label-hot"><a href="https://demo.xtemos.com/basel/product-filters/">Product filters<span class="menu-label menu-label-hot">Hot</span></a></li>
                                                <li id="menu-item-29036" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-29036 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/extra-menu-list/">Extra menu list</a></li>
                                                <li id="menu-item-25711" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-25711 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/ajax-products-tabs/">AJAX products tabs</a></li>
                                                <li id="menu-item-26204" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-26204 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/animated-counter/">Animated counter</a></li>
                                                <li id="menu-item-28561" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-28561 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/timeline/">Timeline</a></li>
                                                <li id="menu-item-29037" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-29037 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/brands-element/">Brands Element</a></li>
                                                <li id="menu-item-20034" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-20034 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/products-slider/">Products Slider</a></li>
                                                <li id="menu-item-29295" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-29295 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/button-with-popup/">Button with popup</a></li>
                                                <li id="menu-item-29297" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-29297 menu-item-design-default item-event-hover"><a href="https://demo.xtemos.com/basel/shop/accessories/london-ampersand-cushion/?stickyaddtocart">Sticky add to cart</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul></div>			</div><!--END MAIN-NAV-->
            <div class="site-logo">
                <div class="basel-logo-wrap">
                    <a href="https://demo.xtemos.com/basel/" class="basel-logo basel-main-logo" rel="home">
                        <img src="https://demo.xtemos.com/basel/wp-content/uploads/2015/08/logo-basel.svg" alt="Basel" />					</a>
                </div>
            </div>
            <div class="right-column">
                <div class="header-links my-account-with-text">
                    <ul>
                        <li class="my-account"><a href="https://demo.xtemos.com/basel/my-account/">My Account</a></li>
                        <li class="logout"><a href="https://demo.xtemos.com/basel/my-account/customer-logout/?_wpnonce=5239b18137">Logout</a></li>
                    </ul>
                </div>
                <div class="search-button basel-search-full-screen">
                    <a href="#">
                        <i class="fa fa-search"></i>
                    </a>
                    <div class="basel-search-wrapper">
                        <div class="basel-search-inner">
                            <span class="basel-close-search">close</span>
                            <form role="search" method="get" id="searchform" class="searchform  basel-ajax-search" action="https://demo.xtemos.com/basel/"  data-thumbnail="1" data-price="1" data-count="5" data-post_type="product">
                                <div>
                                    <label class="screen-reader-text">Search for:</label>
                                    <input type="text" class="search-field" placeholder="Search for products" value="" name="s" id="s" />
                                    <input type="hidden" name="post_type" id="post_type" value="product">
                                    <button type="submit" id="searchsubmit" value="Search">Search</button>

                                </div>
                            </form>
                            <div class="search-results-wrapper"><div class="basel-scroll"><div class="basel-search-results basel-scroll-content"></div></div></div>
                        </div>
                    </div>
                </div>
                <div class="wishlist-info-widget">
                    <a href="https://demo.xtemos.com/basel/wishlist/">
                        Wishlist
                        <span class="wishlist-count">0</span>
                    </a>
                </div>
                <div class="shopping-cart basel-cart-design-1 basel-cart-icon cart-widget-opener">
                    <a href="https://demo.xtemos.com/basel/cart/">
                        <span>Cart (<span>o</span>)</span>
                        <span class="basel-cart-totals">
								<span class="basel-cart-number">0</span>
							<span class="subtotal-divider">/</span>
								<span class="basel-cart-subtotal"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&pound;</span>0.00</span></span>
						</span>
                    </a>
                </div>
                <div class="mobile-nav-icon">
                    <span class="basel-burger"></span>
                </div><!--END MOBILE-NAV-ICON-->
            </div>
        </div>
    </div>

</header>
<!--END MAIN HEADER-->
