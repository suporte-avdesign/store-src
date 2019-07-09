<div class="basel-my-account-sidebar">
    <h3 class="woocommerce-MyAccount-title entry-title">Meu Perfil</h3>
    <nav class="woocommerce-MyAccount-navigation">
        <ul>
            <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--dashboard @if($sidebar == 'dashboard') is-active @endif">
                <a href="{{route('account')}}">Painel</a>
            </li>
            <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--orders @if($sidebar == 'orders') is-active @endif">
                <a href="{{route('account.order')}}">Pedidos</a>
            </li>
            <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--downloads @if($sidebar == 'downloads') is-active @endif">
                <a href="#">Downloads</a>
            </li>
            <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--edit-address @if($sidebar == 'address') is-active @endif">
                <a href="{{route('account.address')}}">Endereço de Entrega</a>
            </li>
            <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--edit-account @if($sidebar == 'profile') is-active @endif">
                <a href="{{route('account.profile')}}">Perfil da Conta</a>
            </li>
            <li class="wishlist-account-element @if($sidebar == 'wishlist') is-active @endif">
                <a href="{{route('account.wishlist')}}">Lista de Desejo</a>
            </li>
            <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--customer-logout">
                <a href="javascript:logoutUser('{{route('logout')}}', '{{ csrf_token() }}');">Sair</a>
            </li>
        </ul>
    </nav>
</div>