<?php

namespace AVD\Http\Middleware;

use AVD\Interfaces\Web\CartInterface as InterCart;
use Closure;


class CkeckItemsCart
{
    /**
     * @var InterCart
     */
    private $interCart;

    public function __construct(InterCart $interCart)
    {
        $this->interCart = $interCart;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->interCart->totalItems() === 0) {
            return redirect()->route('cart');

        }


        return $next($request);
    }
}
