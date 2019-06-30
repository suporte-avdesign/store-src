<!--MAIN-NAV-->
<div class="main-nav site-navigation basel-navigation menu-left" role="navigation">
    <div class="menu-main-navigation-container">
        <ul id="menu-main-navigation" class="menu">
            @forelse($menu as $section)
                <li id="menu-item-{{$section->id}}" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-{{$section->id}} menu-item-design-default item-event-hover iitem-with-label item-label-hot">
                    <a href="{{url(setRoute('section').$section->slug)}}">{{$section->name}} <!--<span class="menu-label menu-label-hot">Em ofertas</span>--></a>
                    <div class="sub-menu-dropdown color-scheme-dark">
                        <div class="container">
                            <ul class="sub-menu color-scheme-dark">
                                @forelse($section->categories as $category)
                                    <li id="menu-item-{{$category->id}}" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-{{$category->id}} menu-item-design-default item-event-hover item-with-label item-label-new">
                                        <a href="{{url(setRoute('category').$category->slug)}}">{{$category->name}} <!--<span class="menu-label menu-label-new">Novos</span>--></a>
                                    </li>
                                @empty
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </li>
            @empty
            @endforelse
            <li id="menu-item-26107" class="hidden-nav-button menu-item menu-item-type-custom menu-item-object-custom menu-item-26107 menu-item-design-default item-event-hover callto-btn">
                <a href="#">Black Friday</a>
            </li>

            <li id="menu-item-26107" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-26107 menu-item-design-default item-event-hover callto-btn">
                <button type="button" id="btn-retail" class="submit minus">Varejo</button>
            </li>
        </ul>



    </div>
</div>
<!--END MAIN-NAV-->
