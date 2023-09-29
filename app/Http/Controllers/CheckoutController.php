<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderDetailsRequest;
use App\Services\OrderService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct(private OrderService $orderService)
    {
    }

    public function get(Request $request)
    {
        if ($request->query('payment_type') == 'paypal') {
            return view('site.pages.paypal_checkout');
        } else if ($request->query('payment_type') == 'card') {
            return view('site.pages.paymob_checkout');
        } else {
            return back()->with('payment_type_warning', 'payment type specified is not available at the moment.');
        }
    }

    public function placePaymobOrder(StoreOrderDetailsRequest $request)
    {
        $order = $this->orderService->store($request->validated());

        if ($order) {
            $paymentToken = PayMobPaymentController::handlePayment($order);
            return view('site.pages.paymob_iframe', ['token' => $paymentToken]);
        }

        return back()->with('message', 'An error occured during checkout.');
    }

    public function placePayPalOrder(StoreOrderDetailsRequest $request)
    {
        $order = $this->orderService->store($request->validated());

        if ($order) {
            return PayPalPaymentController::handlePayment($order);
        }

        return back()->with('message', 'An error occured during checkout.');
    }
}
