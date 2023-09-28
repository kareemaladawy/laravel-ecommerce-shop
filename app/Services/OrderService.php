<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function store(array $request)
    {
        $order = DB::transaction(function () use ($request) {
            $order = Order::create([
                'number'            =>  'ORD-' . strtoupper(uniqid()),
                'user_id'           =>  auth()->id(),
                'grand_total'       =>  config('settings.shipping_cost.value') > 0 ? \Cart::session(auth()->id())->getSubTotal() + intval(config('settings.shipping_cost.value')) : \Cart::session(auth()->id())->getSubTotal(),
                'status'            =>  OrderStatus::PENDING->value,
                'payment_status'    =>  PaymentStatus::PENDING->value,
                'first_name'        =>  $request['first_name'],
                'last_name'         =>  $request['last_name'],
                'apartment'         =>  $request['apartment'],
                'floor'             =>  $request['floor'],
                'street'            =>  $request['street'],
                'building'          =>  $request['building'],
                'city'              =>  $request['city'],
                'country'           =>  $request['country'],
                'state'             =>  $request['state'],
                'postal_code'       =>  $request['postal_code'],
                'phone_number'      =>  $request['phone_number'],
                'notes'             =>  $request['notes']
            ]);

            foreach (\Cart::session(auth()->id())->getContent()->toArray() as $item) {
                $orderItem = new OrderItem([
                    'product_id'    =>  $item['associatedModel']['id'],
                    'name'          =>  $item['associatedModel']['name'],
                    'description'   =>  $item['associatedModel']['description'],
                    'attributes'    =>  $item['attributes'],
                    'price'         =>  $item['price'],
                    'qty'           =>  $item['quantity']
                ]);

                $order->items()->save($orderItem);
            }

            return $order;
        });

        return $order;
    }
}
