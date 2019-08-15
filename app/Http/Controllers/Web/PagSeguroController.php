<?php

namespace AVD\Http\Controllers\Web;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;

use AVD\Http\Controllers\Controller;
use AVD\Http\Requests\Web\PagSeguroCreditRequest as CreditRequest;

use AVD\Interfaces\Web\CartInterface as InterCart;
use AVD\Interfaces\Web\UserInterface as InterUser;
use AVD\Interfaces\Web\OrderInterface as InterOrder;
use AVD\Interfaces\Web\PaymentCardInterface as InterCard;
use AVD\Interfaces\Web\PaymentBilletInterface as InterBillet;
use AVD\Interfaces\Web\OrderItemInterface as InterOrderItems;
use AVD\Interfaces\Web\OrderShippingInterface as InterOrderShipping;




use AVD\Services\Web\FreightService;
use AVD\Services\Web\PagSeguroServicesInterface as ServicePagSeguro;



class PagSeguroController extends Controller
{
    /**
     * @var string
     */
    private $view = 'frontend.pagseguro';

    public function __construct(
        InterUser $interUser,
        InterCard $interCard,
        InterCart $interCart,
        InterOrder $interOrder,
        InterBillet $interBillet,
        FreightService $freightService,
        InterOrderItems $interOrderItems,
        ServicePagSeguro $servicePagSeguro,
        InterOrderShipping $interOrderShipping)
    {
        $this->middleware('auth');

        $this->interUser = $interUser;
        $this->interCard = $interCard;
        $this->interCart = $interCart;
        $this->interOrder = $interOrder;
        $this->interBillet = $interBillet;
        $this->freightService = $freightService;
        $this->interOrderItems = $interOrderItems;
        $this->servicePagSeguro = $servicePagSeguro;
        $this->interOrderShipping = $interOrderShipping;
    }

    /**
     * Gerar Code Session
     * @return mixed
     */
    public function transparenteCode()
    {
      return $this->servicePagSeguro->getSessionId();
    }

    /**
     * Payment: Card
     *
     * @param CreditRequest $request
     * @return Json
     */
    public function cardTransaction(CreditRequest $request)
    {
        try{
            DB::beginTransaction();

            $response = $this->servicePagSeguro->paymentCredCard($request);
            if ($response->error) {
                $out = array(
                    'success' => false ,
                    'error' => $response->error
                );
            } else {


                $user = auth()->user();

                $code = $response->code;
                $price = $request->price;
                $status = $response->status;
                $payment = $request->payment_method;
                $shipping = $request->shipping_method;
                $reference = $response->reference;

                $cart = collect($this->interCart->getAll());
                $freight = $this->calacular($cart, $user, $price, $request->shipping_method);

                $company = array('name' => 'PagSeguro', 'slug' => 'pagseguro');
                $company = typeJson($company);
                $order = $this->interOrder->create($cart, $freight, $payment, $shipping, $company, $status, $reference, $code);

                $orderItems = $this->interOrderItems->create($cart, $order->id);

                if ($request->order_comments) {
                    $orderNote = $this->interOrderNote->create($order->id, $request->order_comments);
                }
                # Transporte indicado pelo cliente
                if (!empty($request->indicate)) {
                    $shipping = [
                        'order_id' => $order->id,
                        'user_id' => auth()->id(),
                        'config_shipping_id' => $request->shipping_method,
                        'indicate' => $request->indicate,
                        'name' => $request->name,
                        'phone' => $request->phone
                    ];
                } else {
                    $shipping = [
                        'order_id' => $order->id,
                        'user_id' => auth()->id(),
                        'config_shipping_id' => $request->shipping_method
                    ];
                }

                $orderShipping = $this->interOrderShipping->create($shipping, $order->id);

                $holder = $request->holder;
                if ($holder == 1) {
                    $card_document = $user->document1;
                    $card_phone = $user->phone == null ? $user->cell : $user->phone;
                    $card_birth_date = $user->date;
                } else {
                    $card_document = $request->doc_type == 1 ? $request->holderCNPJ : $request->holderCPF;
                    $card_phone = $request->holderPhone;
                    $card_birth_date = $request->holderBirthDate;
                }

                $installments = explode('|', $request->installments);
                $installmentQuantity = $installments[0];
                $installmentValue = number_format($installments[1], 2, '.', '');

                $input = [
                    'order_id' => $order->id,
                    'user_id' => auth()->id(),
                    'company_name' => $request->company_name,
                    'method_payment' => 3,
                    'status' => $status,
                    'status_label' => config("pagseguro.return.{$status}.label"),
                    'brand' => $request->brandName,
                    'card_name' => $request->holderName,
                    'card_document' => $card_document,
                    'card_phone' => $card_phone,
                    'card_birth_date' => $card_birth_date,
                    'card_number' => $request->cardNumber,
                    'date_month' => $request->cardExpiryMonth,
                    'date_year' => $request->cardExpiryYear,
                    'card_cvv' => $request->cardCVV,
                    'parcels' => $installmentQuantity,
                    'parcels_value' => $installmentValue,
                    'reference' => $response->reference,
                    'code' => $response->code,
                    'reference' => $response->reference,
                    'value' => $order->total,
                    'date' => date('Ymd')
                ];

                $create = $this->interCard->create($input);

                $remove = $this->interCart->destroy();

                DB::commit();

                $out = array(
                    'success' => true,
                    'status' =>  $response->status,
                    'redirect' => route('order.received', ['reference' => $order->reference, 'token' => $order->token]),
                );
            }

            return response()->json($out);

        } catch(\Exception $e){
            DB::rollback();
            return $e->getMessage();
        }

    }

    /**
     * Payment: Billet
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function billet(Request $request)
    {
        try{
            DB::beginTransaction();

            $response = $this->servicePagSeguro->paymentBillet($request);
            if ($response->error) {
                $out = array(
                    'success' => false ,
                    'error' => $response->error
                );
            } else {
                $user = auth()->user();
                $code = $response->code;
                $price = $request->price;
                $status = $response->status;
                $payment = $request->payment_method;
                $shipping = $request->shipping_method;
                $reference = $response->reference;

                $cart = collect($this->interCart->getAll());

                $freight = $this->calacular($cart, $user, $price, $request->shipping_method);

                $company = array('name' => 'PagSeguro', 'slug' => 'pagseguro');
                $company = typeJson($company);
                $order = $this->interOrder->create($cart, $freight, $payment, $shipping, $company, $status, $reference, $code);

                $orderItems = $this->interOrderItems->create($cart, $order->id);

                if ($request->order_comments) {
                    $orderNote = $this->interOrderNote->create($order->id, $request->order_comments);
                }
                # Transporte indicado pelo cliente
                if (!empty($request->indicate)) {
                    $shipping = [
                        'order_id' => $order->id,
                        'user_id' => auth()->id(),
                        'config_shipping_id' => $request->shipping_method,
                        'indicate' => $request->indicate,
                        'name' => $request->name,
                        'phone' => $request->phone
                    ];
                } else {
                    $shipping = [
                        'order_id' => $order->id,
                        'user_id' => auth()->id(),
                        'config_shipping_id' => $request->shipping_method
                    ];
                }

                $orderShipping = $this->interOrderShipping->create($shipping, $order->id);

                $remove = $this->interCart->destroy();

                $toDay = Date::today();
                $date_pay = $toDay->copy()->addDays(3);
                $input = [
                    'order_id' => $order->id,
                    'user_id' => auth()->id(),
                    'company_name' => $request->company_name,
                    'method_payment' => 2,
                    'status' => $status,
                    'status_label' => config("pagseguro.return.{$status}.label"),
                    'reference' => $response->reference,
                    'code' => $response->code,
                    'link' => $response->payment_link,
                    'value' => $order->total,
                    'date' => date('Ymd')
                    //'date_pay' => date('Y-m-d', strtotime($date_pay))
                ];

                $create = $this->interBillet->create($input);

                $out = array(
                    'success' => true,
                    'redirect' => route('order.received', ['reference' => $order->reference, 'token' => $order->token])
                );
            }


            DB::commit();

            return response()->json($out);

        } catch(\Exception $e){
            DB::rollback();
            return $e->getMessage();
        }

    }

    /**
     * Calcular Frete
     *
     * @param $cart
     * @param $user
     * @param $price
     * @param $shipping_method
     * @return \Illuminate\Http\Response
     */
    private function calacular($cart, $user, $price, $shipping_method) {

        if ($shipping_method == 4) {
            $dataForm = [
                "price" => $price,
                "postcode" => 0,
                "city" => 0,
                "state" => 0,
                "selected" => (int)$shipping_method,
                "country" => 'BR',
            ];
        } else {
            $address = $user->adresses()->orderBy('id','desc')->first();
            $dataForm = [
                "price" => $price,
                "postcode" => $address->zip_code,
                "city" => $address->city,
                "state" => $address->state,
                "selected" => (int)$shipping_method,
                "country" => 'BR',
            ];
        }

        $freight = $this->freightService->calculate($dataForm, $cart, 'checkout');
        return $freight;
    }


    /**************************************************************************************************************/
    /*                                          T E S T E S                                                       */
    /**************************************************************************************************************/
    public function pagseguro()
    {
        $code = $this->servicePagSeguro->generate();

        $urlRedirect = config('pagseguro.url_redirect_after_request').$code;

        return redirect()->away($urlRedirect);

    }

    public function lightbox()
    {
        return view("{$this->view}.lightbox-1");
    }

    public function lightboxCode()
    {
        return $this->servicePagSeguro->generate();
    }

    public function transparente()
    {
        return view("{$this->view}.transparent-1");
    }

    public function card()
    {
        return view("{$this->view}.card-1");
    }

    public function button()
    {
        return view("{$this->view}.button-1");
    }




}
