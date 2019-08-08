<?php

namespace AVD\Http\Controllers\Web;

use Illuminate\Http\Request;
use AVD\Http\Controllers\Controller;

use AVD\Interfaces\Web\SectionInterface as InterSection;

use AVD\Interfaces\Web\OrderInterface as InterOrder;

class PaymentController extends Controller
{
    private $view = 'frontend.payments';
    /**
     * @var InterOrder
     */
    private $interOrder;
    private $content;


    public function __construct(
        InterOrder $interOrder,
        InterSection $interSection)
    {
        $this->interOrder       = $interOrder;
        $this->interSection     = $interSection;

        $this->content = array(
            'title' => constLang('messages.payments.title'),
        );

        $this->content = typeJson($this->content);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($token)
    {
        $menu            = $this->interSection->getMenu();
        $order           = $this->interOrder->setToken($token);
        $items           = $order->items;
        $content         = $this->content;




        $bank_name = 'BRADESCO';
        $account_type = 'Conta Corrente';
        $account_name = config('app.name');
        $branch_number = "841";
        $account_number = "10168-0";
        $document_name = "CNPJ";
        $document_number = "65.590.366/0001-03";
        $reference_name = "Referencia";
        $reference_number = $order->code;

        return view("frontend.testes.popoups", compact(
            'menu','order', 'items','content',
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


        /*
        return view("{$this->view}.payment-1", compact(
            'menu','order', 'items','content',
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
        */
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
