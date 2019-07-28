<div class="woocommerce-form-login-toggle">
    <div class="woocommerce-info">{{constLang('messages.checkouts.title')}}
        <a href="#" class="showlogin">{{constLang('messages.checkouts.login_text')}}</a>
    </div>
</div>
<form method="post" action="{{route('checkout.login')}}" class="login woocommerce-form woocommerce-form-login hidden-form"  style="display:none;">
    @csrf
    <p> {{constLang('messages.checkouts.info')}} </P>
    <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide form-row-username">
        <label for="username">{{constLang('email')}} <span class="required">*</span></label>
        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" id="page_email" name="page[email]"  autocomplete="email" value="" />
    </p>
    <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide form-row-password">
        <label for="password">{{constLang('password')}} <span class="required">*</span></label>
        <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="page[password]" id="page_password" autocomplete="password" />
    </p>

    <p class="form-row">
        <input type="hidden" id="woocommerce-login-nonce" name="woocommerce-login-nonce" value="090cc2b48f" />
        <input type="hidden" name="form" value="page">
        <input type="hidden" name="page[redirect]" value="{{route('checkout.login')}}">
        <button type="submit" class="button woocommerce-Button" name="login" value="{{constLang('login')}}">{{constLang('login')}}</button>
    </p>

    <div class="login-form-footer">
        <a href="{{route('password.request')}}" class="woocommerce-LostPassword lost_password">{{constLang('password_lost')}}</a>
        <label for="rememberme" class="remember-me-label inline">
            <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" value="forever" />
            <span>{{constLang('rememberme')}}</span>
        </label>
    </div>

    <!--
        <span class="social-login-title">{{constLang('messages.login.social_login_title')}}</span>
        <div class="basel-social-login">
            <div class="social-login-btn">
                <a href="{{route('social.auth')}}/?social_auth=facebook" class="btn login-fb-link">Facebook</a>
            </div>
            <div class="social-login-btn">
                <a href="{{route('social.auth')}}/?social_auth=google" class="btn login-goo-link">Google</a>
            </div>
        </div>
     -->
</form>

