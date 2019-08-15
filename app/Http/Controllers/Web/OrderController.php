<?php

namespace AVD\Http\Controllers\Web;

use Illuminate\Http\Request;
use AVD\Http\Controllers\Controller;

use AVD\Interfaces\Web\OrderInterface as InterOrder;
use AVD\Interfaces\Web\SectionInterface as InterSection;
use AVD\Interfaces\Web\ConfigKeywordInterface as ConfigKeyword;



class OrderController extends Controller
{
    private $view = 'frontend.orders';
    /**
     * @var InterOrder
     */
    private $interOrder;
    private $content;


    public function __construct(
        InterOrder $interOrder,
        InterSection $interSection,
        ConfigKeyword $configKeyword)
    {
        $this->middleware('auth');

        $this->interOrder = $interOrder;
        $this->interSection = $interSection;
        $this->configKeyword = $configKeyword;

        $this->content = array(
            'title_date' => constLang('date'),
            'title_total' => constLang('total'),
            'title_payment' => constLang('payment'),
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
            $infoPayment = $order->paymentCash;
        } elseif ($order->config_form_payment_id == 2) { #Boleto Bancário
            $infoPayment = $order->paymentBillet;
        } elseif ($order->config_form_payment_id == 3) { #Cartão de Crédito
            $infoPayment = $order->paymentCard;
        } elseif ($order->config_form_payment_id == 4) { #Cartão de Débito
            $infoPayment = $order->paymentCard;
        }

        return view("{$this->view}.received.index-1", compact(
            'menu','order','items','content', 'infoPayment',
            'configKeyword', 'configPayment','configShipping'

        ));




    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
