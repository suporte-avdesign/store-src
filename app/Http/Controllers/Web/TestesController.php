<?php

namespace AVD\Http\Controllers\Web;

use Illuminate\Http\Request;
use AVD\Http\Controllers\Controller;
use AVD\Interfaces\Web\SectionInterface as InterSection;

class TestesController extends Controller
{

    /**
     * @var InterSection
     */
    private $interSection;

    public function __construct(InterSection $interSection)
    {
        $this->interSection = $interSection;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = $this->interSection->getMenu();
        return view('testes.checkout', compact('menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function popoups()
    {
        $menu = $this->interSection->getMenu();
        return view('frontend.testes.popoups', compact('menu'));
    }

    public function contato()
    {
        $menu = $this->interSection->getMenu();
        return view('frontend.testes.contato', compact('menu'));
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
