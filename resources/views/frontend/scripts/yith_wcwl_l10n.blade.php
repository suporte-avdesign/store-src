<script type="text/javascript">
    var yith_wcwl_l10n = {!! json_encode([
        "ajax_url" => route('wishlist.store'),
        "remove_url" => route('wishlist.remove'),
        "redirect_to_cart" => "no",
        "hash" => \Illuminate\Support\Str::slug('wishlist_'.config('app.name'), '-'),
        "multi_wishlist" => "",
        "hide_add_button" => "1",
        "is_user_logged_in" => "",
        "ajax_loader_url" => asset('plugins/yith-wishlist/images/ajax-loader.gif'),
        "remove_from_wishlist_after_add_to_cart" => "yes",
        "csrf_token" => csrf_token(),
        "labels" => array(
            "cookie_disabled" => "Lamentamos, mas esse recurso está disponível somente se os cookies estiverem ativados no seu navegador.",
            "added_to_cart_message" => '<div class="woocommerce-message">Produto adicionado ao carrinho</div>'
        ),
        "actions" => array(
            "add_to_wishlist_action" => "add_to_wishlist",
            "remove_from_wishlist_action" => "remove_from_wishlist",
            "move_to_another_wishlist_action" => "move_to_another_wishlsit",
            "reload_wishlist_and_adding_elem_action" => "reload_wishlist_and_adding_elem"
        )
    ]) !!};
</script>