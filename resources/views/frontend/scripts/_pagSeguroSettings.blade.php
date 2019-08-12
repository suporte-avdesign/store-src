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
        "required_name" => "O nome é obrigatŕio",
        "required_number" => "O número é obrigatŕio",
        "required_cvv" => "O código de segurança é obrigatŕio",
        "required_installment" => "O número de parcelas é obrigatŕio",

    ]) !!};
</script>