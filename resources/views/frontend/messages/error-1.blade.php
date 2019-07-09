<div class="woocommerce-Message woocommerce-Message--info woocommerce-info">
    @if($message == 'account_inactive')
        <p>{{constLang('messages.register.account_inactive')}}</p>
    @elseif('no_account')
        <p>{{constLang('messages.register.no_account')}}</p>
    @elseif('attempts_limit')
        <p>{{constLang('messages.login.attempts_limit')}}</p>
    @endif

</div>