<script type='text/javascript'>
    var wc_cart_fragments_params = {!! json_encode([
        "ajax_url" => route('cart'),
        "wc_ajax_url" => route('cart.fragments'),
        "fragment_name" => "wc_fragments_anselmo_velame",
        "csrf_token" => csrf_token()
    ]) !!};
</script>
