<footer class="footer-container color-scheme-light">

    <div class="container main-footer">
        <aside class="footer-sidebar widget-area row" role="complementary">

            <div class="footer-column footer-column-1 col-md-12 col-sm-12">
                <div id="text-17" class="footer-widget widget_text">
                    <div class="textwidget">
                        <p style="text-align:center; margin-bottom:0px;">
                            <img src="{{asset('themes/images/logo-white.png')}}" alt="{{env('APP_NAME')}}" title="{{env('APP_NAME')}}" style="max-width:300px;" />
                        </p>
                        <!--include('social.social-1')-->
                        <br>
                    </div>
                </div>
            </div>

            <div class="clearfix visible-lg-block"></div>

            <div class="footer-column footer-column-2 col-md-2 col-sm-6">
                <div id="text-18" class="footer-widget widget_text">
                    <h5 class="widget-title">Minha Conta</h5>
                    <div class="textwidget">
                        <ul class="menu">
                            <li><a href="{{route('account')}}">Minha Conta</a></li>
                            <li><a href="{{route('account.order')}}">Histórico dos pedidos</a></li>
                            <li><a href="{{route('account.address')}}">Endereço de entrega</a></li>
                            <li><a href="{{route('login')}}">Login</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-column footer-column-3 col-md-2 col-sm-6">
                <div id="text-19" class="footer-widget widget_text">
                    <h5 class="widget-title">Informações</h5>
                    <div class="textwidget">
                        <ul class="menu">
                            <li><a href="{{route('privacy-policy')}}">Compras no Atacado</a></li>
                            <li><a href="{{route('privacy-policy')}}">Trocas e Devoluções</a></li>
                            <li><a href="{{route('privacy-policy')}}">Forma de Pagamento</a></li>
                            <li><a href="{{route('privacy-policy')}}">Sobre Entregas</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clearfix visible-sm-block"></div>

            <div class="footer-column footer-column-4 col-md-2 col-sm-6">
                <div id="text-20" class="footer-widget widget_text">
                    <h5 class="widget-title">Outros</h5>
                    <div class="textwidget">
                        <ul class="menu">
                            <li><a href="{{route('login')}}">Cadastre-se</a></li>
                            <li><a href="{{route('contact')}}">Fale Conosco</a></li>
                            <li><a href="{{route('privacy-policy')}}">Política de Privacidade</a></li>
                            <li><a href="{{route('terms-conditions')}}">Termos e Condições</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="footer-column footer-column-5 col-md-2 col-sm-6">
                <div id="text-21" class="footer-widget widget_text">
                    <h5 class="widget-title">Horários</h5>
                    <div class="textwidget">
                        <ul class="menu">
                            <li><a href="javascript:void(0)">De Segunda a Sexta Feira</a></li>
                            <li><a href="javascript:void(0)">das 07:00hs as 17:30hs</a></li>
                            <li><span>&nbsp;</span></li>
                            <li><a href="javascript:void(0)">Sábado das 07:30 as 12:00hs</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-column footer-column-6 col-md-4 col-sm-12">
                <div id="text-22" class="footer-widget widget_text">
                    <h5 class="widget-title">Sobre a Loja</h5>
                    <div class="textwidget">
                        <p>LOJA - Distribuidora de calçados desde 2012. Vendemos mais de 1000 produtos de marca em nosso site.</p>
                        <div style="line-height: 2;">
                            <i class="fa fa-location-arrow" style="width: 15px; text-align: center; margin-right: 4px; color: #ffffff;"></i> {{env('ADDRESS')}}
                            <br>
                            <i class="fa fa-mobile" style="width: 15px; text-align: center; margin-right: 4px; color: #ffffff;"></i> {{env('PHONE')}}
                            <br>
                            <p><i class="fa fa-whatsapp" style="width: 15px; text-align: center; marright-columnsight: 4px; color: #ffffff;"></i> WhatsApp: {{env('WHATSAPP')}}<br></p>
                        </div>
                        <br>
                        <p><img width="100px" src="{{asset('themes/images/payments.png')}}"></p>
                    </div>
                </div>
            </div>
        </aside>
        <!-- .footer-sidebar -->
    </div>

     <div class="copyrights-wrapper copyrights-centered">
        <div class="container">
            <div class="min-footer">
                <div class="col-left">
                    Copyright <i class="fa fa-copyright"></i> {{config('app.name')}} 2012 / @php echo date('Y'); @endphp -Todos os direitos reservados.  Projeto
                    <a href="https://www.avdesign.com.br" target="_blank">
                        <img src="{{asset('themes/images/av-design.png')}}" width="50px;">
                    </a>
                </div>
            </div>
        </div>
    </div>

</footer>