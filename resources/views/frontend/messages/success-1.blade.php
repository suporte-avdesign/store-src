<div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
    @if($message == 'user_register')
        <p>{{constLang('messages.register.success_text1')}} <b>{{$email}}</b> </p>
        <p>{{constLang('messages.register.success_text2')}}</p>
        <p>{{constLang('messages.register.success_text3')}}</p>

    @elseif($message == 'success_login')
        <p>{{constLang('messages.login.success')}}  </p>

    @elseif($message == 'response_freight')
        <p>{{$note}}</p>
        <p>{{$value}}</p>
        <p>{{$days}}</p>
        <p>{{$delivery}}</p>
    @endif
</div>