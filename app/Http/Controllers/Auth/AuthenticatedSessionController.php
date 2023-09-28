<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        if (session()->get(auth()->id() . '_cart')) {
            $cart = session()->get(auth()->id() . '_cart');
            \Cart::session(auth()->id())->add(
                $cart->toArray()
            );
        };

        return redirect()->intended(url()->previous());
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        if (!\Cart::session(auth()->id())->getContent()->isEmpty()) {
            $cart = \Cart::session(auth()->id())->getContent();
            $auth_id = auth()->id();
        }

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if (isset($cart, $auth_id)) {
            session()->put($auth_id . '_cart', $cart);
        }

        return redirect()->intended(url()->previous());
    }
}
