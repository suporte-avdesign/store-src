<?php

namespace AVD\Http\Controllers\Web;

use Illuminate\Http\Request;
use AVD\Http\Controllers\Controller;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contacts.contact-1');
    }


    public function store(Request $request)
    {


        $out = array(
            "into" => "#wpcf7-f4-p456-o1",
            "status" => "mail_failed",
            "message" => "Falha no envio de sua mensagem. Por favor, tente mais tarde ou entre em contato com o administrador por outro método."
        );

        //return response()->json($out);

        return view('contacts.contact-1');
    }

}
