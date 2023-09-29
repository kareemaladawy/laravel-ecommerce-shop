<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InsureCartNotEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (\Cart::session(auth()->id())->isEmpty()) {
            return redirect()->route('cart.index')->with('empty_cart_warning', 'Cannot checkout with an empty cart');
        }

        return $next($request);
    }
}
