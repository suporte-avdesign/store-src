<html>
    <head>
        <title>Botão PagSeguro</title>
    </head>
    <body>

        <!-- INICIO FORMULARIO BOTAO PAGSEGURO -->
        <form action="https://pagseguro.uol.com.br/checkout/v2/cart.html?action=add" method="post" onsubmit="PagSeguroLightbox(this); return false;">
            <!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
            <input type="hidden" name="itemCode" value="7DD4ADD644441E2BB456FFBCBA5439CA" />
            <input type="hidden" name="iot" value="button" />
            <input type="image" src="https://stc.pagseguro.uol.com.br/public/img/botoes/pagamentos/209x48-pagar-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
        </form>
        <script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>
        <!-- FINAL FORMULARIO BOTAO PAGSEGURO -->

    </body>
</html>
