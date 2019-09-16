<?php

namespace AVD\Http\Controllers\Web;

use AVD\Http\Controllers\Controller;

use AVD\Services\Web\FreightService;
use AVD\Interfaces\Web\CartInterface as InterCart;
use AVD\Interfaces\Web\OrderInterface as InterOrder;
use AVD\Interfaces\Web\SectionInterface as InterSection;
use AVD\Http\Requests\Web\OrderRequest as ValidateOrder;
use AVD\Interfaces\Web\PaymentCashInterface as InterCash;
use AVD\Interfaces\Web\OrderNoteInterface as interOrderNote;
use AVD\Interfaces\Web\OrderItemInterface as InterOrderItems;
use AVD\Interfaces\Web\ConfigKeywordInterface as ConfigKeyword;
use AVD\Interfaces\Web\OrderShippingInterface as InterOrderShipping;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    private $view = 'frontend.orders';
    /**
     * @var InterOrder
     */
    private $interOrder;
    private $content;


    public function __construct(
        InterCash $interCash,
        InterCart $interCart,
        InterOrder $interOrder,
        InterSection $interSection,
        ConfigKeyword $configKeyword,
        InterOrderNote $interOrderNote,
        FreightService $freightService,
        InterOrderItems $interOrderItems,
        InterOrderShipping $interOrderShipping)
    {
        $this->middleware('auth');

        $this->interCash = $interCash;
        $this->interCart = $interCart;
        $this->interOrder = $interOrder;
        $this->interSection = $interSection;
        $this->configKeyword = $configKeyword;
        $this->interOrderNote = $interOrderNote;
        $this->freightService  = $freightService;
        $this->interOrderItems = $interOrderItems;
        $this->interOrderShipping = $interOrderShipping;

        $this->content = array(
            'title_date' => constLang('date'),
            'title_total' => constLang('total'),
            'title_payment' => constLang('payment'),
            'title_status' => constLang('status'),
            'title_product' => constLang('product'),
            'title_freight' => constLang('freight'),
            'title_subtotal' => constLang('subtotal'),
            'title_method' => constLang('messages.orders.title_method'),
            'title_thanks' => constLang('messages.orders.title_thanks'),
            'title_number' => constLang('messages.orders.title_number'),
            'title_details' => constLang('messages.orders.title_details'),
            'title_received' => constLang('messages.orders.title_received'),
            'title_print_billet' => constLang('messages.orders.title_print_billet'),
        );

        $this->content = typeJson($this->content);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($reference,$token)
    {
        $menu  = $this->interSection->getMenu();
        $order = $this->interOrder->newOrder($reference,$token);

        $items           = $order->items;
        $content         = $this->content;
        $configPayment   = $order->configFormPayment;
        $configShipping  = $order->configShipping;
        $configKeyword   = $this->configKeyword->random();

        if ($order->config_form_payment_id == 1) {       #Depósito em conta
            $page = 'cash';
            $infoPayment = $order->paymentCash;
        } elseif ($order->config_form_payment_id == 2) { #Boleto Bancário
            $page = 'billet';
            $infoPayment = $order->paymentBillet;
        } elseif ($order->config_form_payment_id == 3) { #Cartão de Crédito
            $page = 'card';
            $infoPayment = $order->paymentCard;
        } elseif ($order->config_form_payment_id == 4) { #Cartão de Débito
            $page = 'card';
            $infoPayment = $order->paymentCard;
        }


        return view("{$this->view}.received.{$page}-1", compact(
            'menu','order','items','content', 'infoPayment',
            'configKeyword', 'configPayment','configShipping'

        ));
    }

    /**
     * Pagamento em dinheiro
     */
    public function paymentCash(ValidateOrder $request)
    {

        try{
            DB::beginTransaction();



                $user = auth()->user();

                $code = 0;
                $price = $request->price;
                $status = 2;
                $payment = $request->payment_method;
                $shipping = $request->shipping_method;

                $uniqid = uniqid(date('YmdHis'));
                $reference = returnNumber($uniqid);


                $cart = collect($this->interCart->getAll());
                $freight = $this->calacular($cart, $user, $price, $request->shipping_method);

                $company = array('name' => 'Bradesco', 'slug' => 'bradesco');
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


                $input = [
                    'order_id' => $order->id,
                    'user_id' => auth()->id(),
                    'company_name' => $request->company_name,
                    'method_payment' => 3,
                    'status' => $status,
                    'status_label' => 'Aguardando',
                    'reference' => $reference,
                    'code' => $code,
                    'value' => $order->total,
                    'date' => date('Ymd')
                ];

                $create = $this->interCash->create($input);

                $remove = $this->interCart->destroy();

                DB::commit();

                $out = array(
                    'success' => true,
                    'status' =>  $status,
                    'redirect' => route('order.received', ['reference' => $order->reference, 'token' => $order->token]),
                );

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





}
