<?php

namespace AVD\Repositories\Web;


use AVD\Models\Web\Order as Model;
use AVD\Interfaces\Web\OrderInterface;


class OrderRepository implements OrderInterface
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

    public function setToken($token)
    {
        return $this->model->where('token', $token)->firstOrFail();
    }

    /**
     * Create
     *
     * @param  array $input
     * @return mixed
     */
    public function create($cart, $freight, $dataForm, $company)
    {
        $qty=0;
        $price_cash=0;
        $price_card=0;
        foreach ($cart as $item) {
            $qty += $item->quantity;
            $price_cash += $item->price_cash * $item->quantity;
            $price_card += $item->price_card * $item->quantity;
        }

        if ($dataForm['payment_method'] == 'cash') {
            $total = $price_cash+$freight->valor;
            $subtotal = $price_cash;
            $form_payment_id = 1;
        } elseif ($dataForm['payment_method'] == 'billet') {
            $total = $price_cash+$freight->valor;
            $subtotal = $price_cash;
            $form_payment_id = 2;
        } elseif ($dataForm['payment_method'] == 'credit') {
            $total = $price_card+$freight->valor;
            $subtotal = $price_card;
            $form_payment_id = 3;
        } elseif ($dataForm['payment_method'] == 'debit') {
            $total = $price_card+$freight->valor;
            $subtotal = $price_card;
            $form_payment_id = 4;
        }

        $input = [
            'user_id' => auth()->id(),
            'config_form_payment_id' => (int)$form_payment_id,
            'config_status_payment_id' => 3,
            'company' => $company->name,
            'status_label' => config("{$company->slug}.status.3"),
            'qty' => $qty,
            'percent' => 0,
            'price_card' => $price_card,
            'price_cash' => $price_cash,
            'subtotal' => $subtotal,
            'total' => $total,
            'coupon' => null,
            'discount' => 0,
            'freight' => $freight->valor,
            'tax' => 0,
            'ip' => $_SERVER['REMOTE_ADDR'],
            'code' => strtoupper(uniqid(date('YmdHsi'))),
            'token' => csrf_token()
        ];

        return $this->model->create($input);
    }




}