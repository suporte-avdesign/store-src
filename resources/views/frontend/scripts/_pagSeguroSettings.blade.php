<script type='text/javascript'>
    var _pagSeguroSettings = {!! json_encode([
        "ajax_billet" => route('pagseguro.billet'),
        "ajax_transparente" => route('pagseguro.transparente.code'),
        "ajax_transaction" => route('pagseguro.card.transaction'),
        "btn_billet" => constLang('messages.payments.btn_billet'),
        "btn_card" => constLang('messages.payments.btn_card'),
        "text_loading" => constLang('loader'),
        "text_error" => constLang('error_server1'),
        "class_billet" => ".btn-payment-billet",
        "class_card" => ".btn-payment-card",
        "class_loading" => "single_add_to_cart_button loading",
        "interest_true" => "(sem juros)",
        "interest_false" => "(com juros)",
        "select_installments" => "Selecione o número de parcelas",
        "error_method" => "Método de pagamento inválido",
        "error_card_token" => "Os dados do cartão estão inválido",
        "error_session" => "Sua sessão expirou, atualize a página",
        "error_brend" => "Digite um número de cartão válido",
        "currency_x" => "x de R$",
        "profile" => auth()->user()->profile_id
    ]) !!};
</script>