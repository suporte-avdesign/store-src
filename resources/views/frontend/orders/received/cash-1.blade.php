<section class="woocommerce-bacs-bank-details">
    <h2 class="wc-bacs-bank-details-heading">Nossos dados bancários</h2>
    <h3 class="wc-bacs-bank-details-account-name">Favorecido: {{$account_name}}</h3>
    <ul class="wc-bacs-bank-details order_details bacs_details">
        <li class="bank_name">Banco: <strong>{{$bank_name}}</strong></li>
        <li class="account_number">Agência: <strong>{{$branch_number}}</strong></li>
        <li class="sort_code">{{$account_type}} : <strong>{{$account_number}}</strong></li>
        <li class="iban">{{$reference_name}}: <strong>{{$reference_number}}</strong></li>
        <li class="bic">{{$document_name}}: <strong>{{$document_number}}</strong></li>
    </ul>
    <ul class="wc-bacs-bank-details order_details bacs_details">
    </ul>
</section>