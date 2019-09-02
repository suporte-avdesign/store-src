<?php

namespace AVD\Repositories\Web;

use AVD\Models\Web\ConfigFreight as Model;
use AVD\Interfaces\Web\ConfigFreightInterface;

use EscapeWork\Frete\Correios\PrecoPrazo;
use EscapeWork\Frete\Correios\Data;
use EscapeWork\Frete\FreteException;

use Illuminate\Support\Facades\Auth;


class ConfigFreightRepository implements ConfigFreightInterface
{

    public $model;

    /**
     * Create construct.
     *
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Date: 07/01/2019
     *
     * @param $input
     * @return bool
     */
    public function setId($id)
    {
        return $this->model->find($id);
    }

    public function multiplo($postcode, $submit)
    {
        $altura = $submit->altura < MIN_ALTURA ? MIN_ALTURA : $submit->altura;
        $largura = $submit->largura < MIN_LARGURA? MIN_LARGURA: $submit->largura;
        $comprimento = $submit->comprimento < MIN_COMPRIMENTO ? MIN_COMPRIMENTO : $submit->comprimento;
        $raiz_cubica = $submit->raiz_cubica;

        $frete = new PrecoPrazo();
        $frete->setCodigoServico([Data::PAC, Data::SEDEX])
            ->setCodigoEmpresa(config('company.post_code'))    # opcional
            ->setSenha(config('company.post_password'))        # opcional
            ->setCepOrigem(config('company.post_origin'))      # apenas numeros, sem hifen(-)
            ->setCepDestino($postcode)                             # apenas numeros, sem hifen(-)
            ->setValorDeclarado(setReal($submit->valor_declarado)) # não obrigatorio
            ->setComprimento($comprimento)                         # obrigatorio
            ->setAltura($altura)                                   # obrigatorio
            ->setLargura($largura)                                 # obrigatorio
            ->setDiametro($raiz_cubica)                            # obrigatorio
            ->setPeso($submit->peso);                              # obrigatorio

        try {
            $results = $frete->calculate();

            //dd($results);



            /*
             Collection {#423
              #items: array:2 [
                0 => PrecoPrazoResult {#416
                  #attributes: array:12 [
                    "Codigo" => "04510"
                    "Valor" => "125,92"
                    "PrazoEntrega" => "13"
                    "ValorSemAdicionais" => "118,90"
                    "ValorMaoPropria" => "0,00"
                    "ValorAvisoRecebimento" => "0,00"
                    "ValorValorDeclarado" => "7,02"
                    "EntregaDomiciliar" => "S"
                    "EntregaSabado" => "N"
                    "obsFim" => []
                    "Erro" => "0"
                    "MsgErro" => []
                  ]
                }
                1 => PrecoPrazoResult {#425
                  #attributes: array:12 [
                    "Codigo" => "04014"
                    "Valor" => "240,02"
                    "PrazoEntrega" => "8"
                    "ValorSemAdicionais" => "233,00"
                    "ValorMaoPropria" => "0,00"
                    "ValorAvisoRecebimento" => "0,00"
                    "ValorValorDeclarado" => "7,02"
                    "EntregaDomiciliar" => "S"
                    "EntregaSabado" => "N"
                    "obsFim" => []
                    "Erro" => "0"
                    "MsgErro" => []
                  ]
                }
              ]
            }

            */

            foreach ($results as $result) {
                if ( $result->Codigo == '04510' ) {
                    $return['pac']['Valor'] = $result->Valor;
                    $return['pac']['PrazoEntrega'] = $result->PrazoEntrega;
                    $return['pac']['EntregaDomiciliar'] = $result->EntregaDomiciliar;
                } elseif ( $result->Codigo == '04014') {
                    $return['sedex']['Valor'] = $result->Valor;
                    $return['sedex']['PrazoEntrega'] = $result->PrazoEntrega;
                    $return['sedex']['EntregaDomiciliar'] = $result->EntregaDomiciliar;
                }

            }

            return $return;

        }
        catch (FreteException $e) {
            // trate o erro adequadamente (e não escrevendo na tela)
            echo $e->getMessage();
        }
    }


    public function pac($postcode, $submit)
    {

        $altura = $submit->altura < MIN_ALTURA ? MIN_ALTURA : $submit->altura;
        $largura = $submit->largura < MIN_LARGURA? MIN_LARGURA: $submit->largura;
        $comprimento = $submit->comprimento < MIN_COMPRIMENTO ? MIN_COMPRIMENTO : $submit->comprimento;
        $raiz_cubica = $submit->raiz_cubica;

        $frete = new PrecoPrazo();
        $frete->setCodigoServico(Data::PAC)
            ->setCodigoEmpresa(config('company.post_code'))    # opcional
            ->setSenha(config('company.post_password'))        # opcional
            ->setCepOrigem(config('company.post_origin'))      # apenas numeros, sem hifen(-)
            ->setCepDestino($postcode)                             # apenas numeros, sem hifen(-)
            ->setValorDeclarado(setReal($submit->valor_declarado)) # não obrigatorio
            ->setComprimento($comprimento)                         # obrigatorio
            ->setAltura($altura)                                   # obrigatorio
            ->setLargura($largura)                                 # obrigatorio
            ->setDiametro($raiz_cubica)                            # obrigatorio
            ->setPeso($submit->peso);                              # obrigatorio

        try {
            $result = $frete->calculate();

            $result['cServico']['Valor'];
            $result['cServico']['PrazoEntrega'];

            return $result;
        }
        catch (FreteException $e) {
            return [
                'error' => true,
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ];
        }
    }

    public function sedex($postcode, $submit)
    {
        $altura = $submit->altura < MIN_ALTURA ? MIN_ALTURA : $submit->altura;
        $largura = $submit->largura < MIN_LARGURA? MIN_LARGURA: $submit->largura;
        $comprimento = $submit->comprimento < MIN_COMPRIMENTO ? MIN_COMPRIMENTO : $submit->comprimento;
        $raiz_cubica = $submit->raiz_cubica;

        $frete = new PrecoPrazo();
        $frete->setCodigoServico(Data::SEDEX)
            ->setCodigoEmpresa(config('company.post_code'))    # opcional
            ->setSenha(config('company.post_password'))        # opcional
            ->setCepOrigem(config('company.post_origin'))      # apenas numeros, sem hifen(-)
            ->setCepDestino($postcode)                             # apenas numeros, sem hifen(-)
            ->setValorDeclarado(setReal($submit->valor_declarado)) # não obrigatorio
            ->setComprimento($comprimento)                         # obrigatorio
            ->setAltura($altura)                                   # obrigatorio
            ->setLargura($largura)                                 # obrigatorio
            ->setDiametro($raiz_cubica)                            # obrigatorio
            ->setPeso($submit->peso);                              # obrigatorio

        try {
            $result = $frete->calculate();

            $result['cServico']['Valor'];
            $result['cServico']['PrazoEntrega'];

            return $result;
        }
        catch (FreteException $e) {
            return [
                'error' => true,
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ];
        }
    }


}