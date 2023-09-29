<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PayMob\Facades\PayMob;

class PayMobPaymentController extends Controller
{
    public static function handlePayment(Order $order)
    {
        $auth = PayMob::AuthenticationRequest();

        $paymob_order = PayMob::OrderRegistrationAPI([
            'auth_token' => $auth->token,
            'amount_cents' => $order->grand_total * 100,
            'currency' => config('settings.currency_code.value') ?: 'EGP',
            'delivery_needed' => config('settings.delivery_needed.value') ?: false,
            'merchant_order_id' => $order->number,
            'items' => []
        ]);

        $paymentKey = PayMob::PaymentKeyRequest([
            'auth_token' => $auth->token,
            'amount_cents' => $order->grand_total * 100,
            'currency' => 'EGP',
            'order_id' => $paymob_order->id,
            "billing_data" => [
                "first_name" => $order->first_name,
                "last_name" => $order->last_name,
                "email" => auth()->user()->email,
                "apartment" => $order->apartment,
                "floor" => $order->floor,
                "street" => $order->street,
                "building" => $order->building,
                "phone_number" => $order->phone_number,
                "shipping_method" => config('settings.shipping_method.value') ?: "PKG",
                "postal_code" => $order->postal_code,
                "city" => $order->city,
                "state" => $order->state,
                "country" => $order->country
            ]
        ]);

        return $paymentKey->token;
    }

    public function checkoutProcessed(Request $request)
    {
        $request_hmac = $request->hmac;
        $calc_hmac = PayMob::calcHMAC($request);

        if ($request_hmac == $calc_hmac) {
            $order_id = $request->obj['order']['merchant_order_id'];
            $amount_cents = $request->obj['amount_cents'];
            $transaction_id = $request->obj['id'];

            DB::transaction(function () use ($request, $order_id, $transaction_id, $amount_cents) {
                $order = Order::findOrFail($order_id);

                if ($request->obj['success'] == true && ($order->grand_total * 100) == $amount_cents) {
                    $order->update([
                        'payment_status' => PaymentStatus::COMPLETED->value,
                        'payment_method' => 'Card',
                        'transaction_id' => $transaction_id
                    ]);
                } else {
                    $order->update([
                        'payment_status' => PaymentStatus::FAILED->value,
                        'payment_method' => 'Card',
                        'transaction_id' => $transaction_id
                    ]);
                }
            });
        }
    }
}
