<div class="topbar-wrapp color-scheme-light">
    <div class="container">
        <div class="topbar-content">
            <div class="top-bar-left">
                <i class="fa fa-phone-square" style="color:white;" > </i> TELEFONE:
                <span style="margin-left:10px; border-bottom: 1px solid rgba(255,255,255,0.3);">{{ env('PHONE') }}</span>
            </div>
            <div class="top-bar-right">
                <div class="topbar-menu">
                    <div class="menu-top-bar-container">

                        <ul id="menu-top-bar" class="menu">
                            @auth
                                <li id="menu-item-22357" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22357 menu-item-design-default item-event-hover">
                                    <a href="{{route('account')}}"><i class="fa fa-user"></i>Minha Conta</a>
                                </li>
                            @else
                                <li id="menu-item-22357" class="login-side-opener menu-item menu-item-type-post_type menu-item-object-page menu-item-22357 menu-item-design-default item-event-hover">
                                    <a href="#"><i class="fa fa-user"></i>Minha Conta</a>
                                </li>
                            @endauth
                            <li id="menu-item-22845" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22845 menu-item-design-default item-event-hover">
                                <a href="{{route('register')}}"><i class="fa fa-file-text-o"></i>Cadastre-se</a>
                            </li>
                            <!--
                            <li id="menu-item-20484" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-20484 menu-item-design-default item-event-hover">
                                <a href="#"><i class="fa fa-question"></i>FAQ</a>
                            </li>
                            -->
                            <li id="menu-item-20488" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-20488 menu-item-design-default item-event-hover">
                                <a href="{{route('contact')}}"><i class="fa fa-envelope-o"></i>Contato</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

