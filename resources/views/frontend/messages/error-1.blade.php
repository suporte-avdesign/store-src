<div class="woocommerce-Message woocommerce-Message--info woocommerce-info">
    @if($message == 'account_inactive')
        <p>{{constLang('messages.register.account_inactive')}}</p>
    @elseif($message == 'no_account')
        <p>{{constLang('messages.register.no_account')}}</p>
    @elseif($message == 'attempts_limit')
        <p>{{constLang('messages.login.attempts_limit')}}</p>
    @elseif($message == 'error_freight')
        <p>{{$error}}</p>
    @elseif($message == 'apply_coupon')
        <p>{{$error}}</p>
    @elseif($message == 'token_expired')
        <p>{{$error}}</p>
    @endif

</div>