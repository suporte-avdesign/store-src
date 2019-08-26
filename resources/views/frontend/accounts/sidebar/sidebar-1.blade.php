<div class="basel-my-account-sidebar">
    <h3 class="woocommerce-MyAccount-title entry-title">{{$content->sidebar->title}}</h3>
    <nav class="woocommerce-MyAccount-navigation">
        <ul>
            <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--dashboard @if($sidebar == 'dashboard') is-active @endif">
                <a href="{{route('account')}}">{{$content->sidebar->dashboard}}</a>
            </li>
            <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--orders @if($sidebar == 'orders') is-active @endif">
                <a href="{{route('account.order')}}">{{$content->sidebar->orders}}</a>
            </li>
            <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--edit-address @if($sidebar == 'address') is-active @endif">
                <a href="{{route('account.address')}}">{{$content->sidebar->address}}</a>
            </li>
            <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--edit-account @if($sidebar == 'profile') is-active @endif">
                <a href="{{route('account.profile')}}">{{$content->sidebar->profile}}</a>
            </li>
            <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--customer-logout">
                <a href="javascript:logoutUser('{{route('logout')}}', '{{ csrf_token() }}');">{{$content->sidebar->logout}}</a>
            </li>
        </ul>
    </nav>
</div>