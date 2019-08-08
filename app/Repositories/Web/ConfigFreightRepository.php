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

    public function pac($postcode, $submit)
    {
        $frete = new PrecoPrazo();
        $frete->setCodigoServico(Data::PAC)
            ->setCodigoEmpresa(config('company.post_code')) # opcional
            ->setSenha(config('company.post_password')) # opcional
            ->setCepOrigem(config('company.post_origin')) # apenas numeros, sem hifen(-)
            ->setCepDestino($postcode) # apenas numeros, sem hifen(-)
            ->setValorDeclarado(setReal($submit->valor_declarado)) # não obrigatorio
            ->setComprimento($submit->comprimento) # obrigatorio
            ->setAltura($submit->altura)      # obrigatorio
            ->setLargura($submit->largura)     # obrigatorio
            ->setDiametro(30)    # obrigatorio
            ->setPeso($submit->peso);      # obrigatorio

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
        $frete = new PrecoPrazo();
        $frete->setCodigoServico(Data::PAC)
            ->setCodigoEmpresa(config('company.post_code')) # opcional
            ->setSenha(config('company.post_password')) # opcional
            ->setCepOrigem(config('company.post_origin')) # apenas numeros, sem hifen(-)
            ->setCepDestino($postcode) # apenas numeros, sem hifen(-)
            ->setValorDeclarado(setReal($submit->valor_declarado)) # não obrigatorio
            ->setComprimento($submit->comprimento) # obrigatorio
            ->setAltura($submit->altura)      # obrigatorio
            ->setLargura($submit->largura)     # obrigatorio
            ->setDiametro(30)    # obrigatorio
            ->setPeso($submit->peso);      # obrigatorio

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