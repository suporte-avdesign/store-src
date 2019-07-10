var Correios = require('../../../node_modules/node-correios'),
    correios = new Correios();

var args = {
    nCdServico: '40010,41106,40215',
    sCepOrigem: '44530000',
    nVlPeso: '030310000',
    nCdFormato: 1,
    nVlComprimento: 100,
    nVlAltura: 100,
    nVlLargura: 100,
    nVlDiametro: 100,
    nCdEmpresa: 'São Roque',
    sDsSenha: '123452',
    sCdMaoPropria: 'N',
    nVlValorDeclarado: 120.50,
    sCdAvisoRecebimento: 'N'

}
correios.calcPreco(args, function (err, result) {
    console.log(result);

});