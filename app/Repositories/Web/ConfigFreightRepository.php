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

    public function calculate($input)
    {
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

            dd($result); // debugge o resultado!
        }
        catch (FreteException $e) {
            // trate o erro adequadamente (e não escrevendo na tela)
            echo $e->getMessage();
            echo $e->getCode(); // este código é o código de erro dos correios
            // pode ser usado pra dar mensagens como CEP inválido para o cliente
        }
    }


    public function calculateUser($input)
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

            dd($result); // debugge o resultado!
        }
        catch (FreteException $e) {
            // trate o erro adequadamente (e não escrevendo na tela)
            echo $e->getMessage();
            echo $e->getCode(); // este código é o código de erro dos correios
            // pode ser usado pra dar mensagens como CEP inválido para o cliente
        }
    }


}