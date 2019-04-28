@extends('layouts.template-1')
@push('title')
<title>Página não encontrada {{config('app.name')}}</title>
@endpush

@push('body')
<body class="error404 logged-in woocommerce-no-js wrapper-full-width global-cart-design-1 global-search-full-screen global-header-shop mobile-nav-from-left basel-light catalog-mode-off categories-accordion-on global-wishlist-enable basel-top-bar-on basel-ajax-shop-on basel-ajax-search-on enable-sticky-header header-full-width sticky-header-real offcanvas-sidebar-mobile offcanvas-sidebar-tablet wpb-js-composer js-comp-ver-5.6 vc_responsive">
@endpush
@section('content')
    <div class="container">
        <div class="row">
            <div class="site-content col-md-12" role="main">
                <header class="page-header">
                    <h3 class="page-title">NÃO ENCONTRADO</h3>
                </header>
                <div class="page-wrapper">
                    <div class="page-content">
                        <h3>ISSO É UM POUCO EMBARAÇOSO, NÃO É?</h3>
                        <h6>Parece que nada foi encontrado neste local. Talvez tente uma pesquisa?</h6>
                        <form role="search" method="get" id="searchform" class="searchform" action="#">
                            <div>
                                <label class="screen-reader-text" for="s"></label>
                                <input type="text" placeholder="Pesquisar produtos" value="" name="s" id="s" />
                                <input type="hidden" name="post_type" id="post_type" value="product">
                                <button type="submit" id="searchsubmit">Pesquisa</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection