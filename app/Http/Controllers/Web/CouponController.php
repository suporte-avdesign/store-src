<?php

namespace AVD\Http\Controllers\Web;

use Illuminate\Http\Request;
use AVD\Http\Controllers\Controller;

class CouponController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ac = $request->input('ajax');
        if ($ac == "apply_coupon") {

            //$message = 'apply_coupon';
            $message = constLang('messages.coupons.validate');

            return view('frontend.coupons.error-1', compact('message'));
        }

    }


}
