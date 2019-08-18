<div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
    @if($message == 'success_login')
        <p>{{constLang('messages.login.success')}}  </p>

    @elseif($message == 'response_freight')
        <p>{{$note}}</p>
        <p>{{$value}}</p>
        <p>{{$days}}</p>
        <p>{{$delivery}}</p>
    @endif
</div>