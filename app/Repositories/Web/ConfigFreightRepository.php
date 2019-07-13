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

    public function calculateSedex($postcode, $input)
    {
        $frete = new PrecoPrazo();
        $frete->setCodigoServico(Data::SEDEX)
            ->setCodigoEmpresa(env('CORREIO_CODIGO_EMPRESA')) # opcional
            ->setSenha(env('CORREIO_CODIGO_SENHA')) # opcional
            ->setCepOrigem(env('CORREIO_CODIGO_CEP_ORIGEM')) # apenas numeros, sem hifen(-)
            ->setCepDestino($postcode) # apenas numeros, sem hifen(-)
            ->setValorDeclarado(3.200 ) # não obrigatorio
            ->setComprimento(30) # obrigatorio
            ->setAltura(30)      # obrigatorio
            ->setLargura(30)     # obrigatorio
            ->setDiametro(30)    # obrigatorio
            ->setPeso(3.200 );   # obrigatorio


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

    public function calculatePac($postcode, $input)
    {
        $frete = new PrecoPrazo();
        $frete->setCodigoServico(Data::PAC)
            ->setCodigoEmpresa(env('CORREIO_CODIGO_EMPRESA')) # opcional
            ->setSenha(env('CORREIO_CODIGO_SENHA')) # opcional
            ->setCepOrigem(env('CORREIO_CODIGO_CEP_ORIGEM')) # apenas numeros, sem hifen(-)
            ->setCepDestino($postcode) # apenas numeros, sem hifen(-)
            ->setComprimento(30) # obrigatorio
            ->setAltura(30)      # obrigatorio
            ->setLargura(30)     # obrigatorio
            ->setDiametro(30)    # obrigatorio
            ->setPeso(0.5);      # obrigatorio

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

    public function calculateUser($postcode, $input)
    {
        $user = Auth::user();
        $frete = new PrecoPrazo();
        $frete->setCodigoServico(Data::SEDEX)
            ->setCodigoEmpresa('Codigo')      # opcional
            ->setSenha('Senha')               # opcional
            ->setCepOrigem('44530000')   # apenas numeros, sem hifen(-)
            ->setCepDestino('44600000') # apenas numeros, sem hifen(-)
            ->setComprimento(30)              # obrigatorio
            ->setAltura(30)                   # obrigatorio
            ->setLargura(30)                  # obrigatorio
            ->setDiametro(30)                 # obrigatorio
            ->setPeso(0.5);                   # obrigatorio

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