<div class="login-form-side">
    <div class="widget-heading">
        <h3 class="widget-title">Login</h3>
        <a href="#" class="widget-close">{{constLang('close')}}</a>
    </div>

    <div id="return-form_login_sidbar"></div>

    <div class="login-form">

        <form id="form_login_sidbar" method="post" class="login woocommerce-form woocommerce-form-login" action="{{ route('login') }}">
            @csrf
            <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide form-row-username">
                <label for="user_email">{{constLang('email')}}<span class="required">*</span></label>
                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="user[email]" id="user_email" autocomplete="email" value="">
            </p>
            <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide form-row-password">
                <label for="user_password">{{constLang('password')}}&nbsp;<span class="required">*</span></label>
                <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="user[password]" id="user_password"
                >
            </p>


            <p class="form-row">
                <input type="hidden" name="form" value="sidbar">
                <button type="button" id="form_login_sidbar-submit" onclick="postFormJson('form_login_sidbar')" class="button woocommerce-Button" name="login" value="Log in">Entrar</button>
            </p>

            <div class="login-form-footer">
                <a href="{{route('password.update')}}" class="woocommerce-LostPassword lost_password">Perdeu sua senha?</a>
                <label for="rememberme" class="remember-me-label inline">
                    <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="user[remember]" id="remember" type="checkbox"> <span>Lembre de mim</span>
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

    </div>

    <div class="register-question">
        <span class="create-account-text">Ainda não tem conta?</span>
        <a class="btn btn-style-link" href="{{route('register')}}">CADASTRE-SE</a>
    </div>
</div>