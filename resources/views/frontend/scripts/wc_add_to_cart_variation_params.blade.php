<script type='text/javascript'>
    var wc_add_to_cart_variation_params = {!! json_encode([
        "wc_ajax_url" => route('cart.remove')."?wc-ajax=%%endpoint%%",
        "i18n_no_matching_variations_text" => "Desculpe, nenhum produto corresponde à sua seleção. Escolha uma combinação diferente.",
        "i18n_make_a_selection_text" => "Selecione a cor, o tamanho e a quantidade antes de prosseguir.",
        "i18n_unavailable_text" => "Desculpe, este produto não está disponível. Escolha uma combinação diferente."
    ]) !!};
</script>