<div class="login-form-side">
    <div class="widget-heading">
        <h3 class="widget-title">Login</h3>
        <a href="#" class="widget-close">Fechar</a>
    </div>

    <div class="login-form">
        <form method="post" class="login woocommerce-form woocommerce-form-login " action="{{ route('login') }}">
            @csrf
            <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide form-row-username">
                <label for="username">Nome de usuário ou e-mail<span class="required">*</span></label>
                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="">
            </p>
            <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide form-row-password">
                <label for="password">Senha&nbsp;<span class="required">*</span></label>
                <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password">
            </p>


            <p class="form-row">
                <input type="hidden" id="woocommerce-login-nonce" name="woocommerce-login-nonce" value="ea245efaae">
                <input type="hidden" name="_wp_http_referer" value="/basel/my-account/">
                <button type="submit" class="button woocommerce-Button" name="login" value="Log in">Entrar</button>
            </p>

            <div class="login-form-footer">
                <a href="{{route('password.update')}}" class="woocommerce-LostPassword lost_password">Perdeu sua senha?</a>
                <label for="rememberme" class="remember-me-label inline">
                    <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="remember" id="remember" type="checkbox"> <span>Lembre de mim</span>
                </label>
            </div>

            <span class="social-login-title">OU FAÇA O LOGIN COM</span>
            <div class="basel-social-login">
                <div class="social-login-btn">
                    <a href="{{route('social.auth')}}/?social_auth=facebook" class="btn login-fb-link">Facebook</a>
                </div>
                <div class="social-login-btn">
                    <a href="{{route('social.auth')}}/?social_auth=google" class="btn login-goo-link">Google</a>
                </div>
            </div>


        </form>

    </div>

    <div class="register-question">
        <span class="create-account-text">Ainda não tem conta?</span>
        <a class="btn btn-style-link" href="{{route('register')}}">Crie a sua conta aqui</a>
    </div>
</div>