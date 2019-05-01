<div class="basel-my-account-sidebar">
    <h3 class="woocommerce-MyAccount-title entry-title">Meu Perfil</h3>
    <nav class="woocommerce-MyAccount-navigation">
        <ul>
            <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--dashboard is-active">
                <a href="{{route('account')}}">Painel</a>
            </li>
            <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--orders is-active">
                <a href="{{route('account.order')}}">Pedidos</a>
            </li>
            <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--downloads">
                <a href="#">Downloads</a>
            </li>
            <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--edit-address">
                <a href="#">Endereço de Entrega</a>
            </li>
            <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--edit-account">
                <a href="{{route('account.profile')}}">Perfil da Conta</a>
            </li>
            <li class="wishlist-account-element is-active">
                <a href="{{route('account.wishlist')}}">Lista de Desejo</a>
            </li>
            <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--customer-logout">
                <a href="#">Sair</a>
            </li>
        </ul>
    </nav>
</div>