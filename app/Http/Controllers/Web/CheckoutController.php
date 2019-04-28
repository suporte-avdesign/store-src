<?php

namespace AVD\Http\Controllers\Web;

use Illuminate\Http\Request;
use AVD\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('checkouts.checkout-1');
    }

    public function endpoint(Request $request)
    {
        $ac = $request->input('ajax');
        if ($ac == 'update_order_review') {

            $shipping_method = $request->input('shipping_method');
            $method = $shipping_method[0];

            ($method == null ? $method = 'legacy_flat_rate' : $method = $method);


            $order = view('checkouts.checkout-1-order', compact('method'))->render();
            $payment = view('checkouts.checkout-1-payment')->render();

            $out = array(
                "result" => "success",
                "messages" => "",
                "reload" => "false",
                "fragments" => array(
                    ".woocommerce-checkout-review-order-table" => $order,
                    ".woocommerce-checkout-payment" => $payment
                )
            );

            return response()->json($out);

        }

        if ($ac == "apply_coupon") {

            $message = 'Por favor insira um código de cupom válido.';

            return view('messages.message-1-error', compact('message'));
        }


    }

    public function login(Request $request)
    {

        $login = $request->input('login');

        if (isset($login)) {
            $username = $request->input('username');
            $password = $request->input('password');
            $error = 'login';
        }


        return view('checkouts.checkout-1', compact('error'));

    }

    public function store(Request $request)
    {
        $result = rand(1,2);
        if ($result == 2) {
            $terms = $request->input('terms');
            // Error
            $message = "Preencha os campos vazios {$result}";
            if (empty($terms)) {
                $message = 'Por favor ler e aceitar os termos e condições para prosseguir com o seu pedido.';
            }
            $messages = view('messages.message-1-error', compact('message'))->render();
            $out = array(
                "result" => "failure",
                "messages" => $messages,
                "refresh" => false,
                "reload" => true
            );
        } else {
            $id = intValue(12345);
            $order_name = 'pedido-recebido';
            $out = array(
                "result" => "success",
                "redirect" => route('checkout.received', [$order_name, $id])
            );
        }


        return response()->json($out);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($order, $id)
    {

        $bank_name = 'BRADESCO';
        $account_type = 'Conta Corrente';
        $account_name = config('app.name');
        $branch_number = "841";
        $account_number = "10168-0";
        $document_name = "CNPJ";
        $document_number = "65.590.366/0001-03";
        $reference_name = "Referencia";
        $reference_number = $id;



        return view('checkouts.checkout-1-received', compact(
            'bank_name',
            'account_type',
            'account_name',
            'branch_number',
            'account_number',
            'document_name',
            'document_number',
            'reference_name',
            'reference_number'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
