<?php

namespace App\Http\Controllers;

use App\Models\Order;

class AccountController extends Controller
{
    public function getOrders()
    {
        $orders = Order::where('user_id', auth()->id())
            ->where('status', '!=', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('site.pages.account.orders', compact('orders'));
    }
}
