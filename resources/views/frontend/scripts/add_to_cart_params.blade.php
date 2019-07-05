<script type="text/javascript">
    var wc_add_to_cart_params = {!! json_encode([
            "ajax_url" => route('cart.add'),
            "wc_ajax_url" => route('cart.remove')."/?wc-ajax=%%endpoint%%",
            "i18n_view_cart" => "Ver Carrrinho",
            "cart_url" => route('cart'),
            "is_cart" => "",
            "cart_redirect_after_add" => "no",
            "loader" => "Aguarde",
            "csrf_token" => csrf_token()
        ]) !!};
</script>
