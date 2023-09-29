<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Srmklive\PayPal\Services\ExpressCheckout;


class PayPalPaymentController extends Controller
{
    public static function handlePayment(Order $order)
    {
        $data = [];
        $data['items'] = [];

        foreach ($order->items as $item) {
            array_push($data['items'], [
                'name' => $item->name,
                'price' => $item->price,
                'desc' => strip_tags($item->description),
                'attributes' => $item->attributes,
                'qty' => $item->qty
            ]);
        }

        $data['invoice_id'] = $order->number;
        $data['invoice_description'] = 'Order #' . $order->number;
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');
        $data['subtotal'] = \Cart::session(auth()->id())->getSubTotal();
        if (config('settings.shipping_cost.value') > 0) {
            $data['shipping'] = config('settings.shipping_cost.value');
            $data['total'] = \Cart::session(auth()->id())->getSubTotal() + config('settings.shipping_cost.value');
        } else {
            $data['total'] = \Cart::session(auth()->id())->getSubTotal();
        }

        try {
            $provider = new ExpressCheckout(config('paypal'));
            $response = $provider->setExpressCheckout($data);
        } catch (\Exception $e) {
            return url()->previous()->with('message', $e);
        }

        return redirect()->intended($response['paypal_link']);
    }

    public function successPayment(Request $request)
    {
        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            DB::transaction(function () use ($response) {
                $order = Order::where('number', $response['INVNUM'])->first();
                $order->update([
                    'status' => OrderStatus::PROCESSING->value,
                    'payment_status' => PaymentStatus::COMPLETED->value,
                    'payment_method' => 'PayPal',
                    'currency' => $response['CURRENCYCODE']
                ]);

                \Cart::session(auth()->id())->clear();
            });

            return to_route('account.orders')->with('INVNUM', $response['INVNUM']);
        }

        return to_route('checkout.index')->with('message', 'An error occured during payment.');
    }

    public function cancelPayment()
    {
        return to_route('checkout.index')->with('message', 'Payment got cancelled.');
    }
}
