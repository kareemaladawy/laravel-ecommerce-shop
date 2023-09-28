<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Invoice;

class InvoiceController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Order $order)
    {
        $customer = new Party([
            'name'    => $order->first_name . ' ' . $order->last_name,
            'custom_fields' => [
                'phone number'  => $order->phone_number,
                'email'         => $order->customer->email,
                'city'    => $order->city,
                'state'   => $order->state,
                'country' => $order->country,
            ],
        ]);

        $seller = new Party([
            'name'          => config('settings.site_name.value'),
            'custom_fields' => [
                'phone number' => config('settings.phone.value'),
                'fax' => config('settings.fax.value')
            ],
        ]);

        $items = [];
        foreach ($order->items as $item) {
            $items[] = (new InvoiceItem())
                ->title($item->name . ' ' . implode(', ', $item->attributes))
                ->pricePerUnit($item->price)
                ->quantity($item->qty);
        }

        $invoice = Invoice::make()
            ->filename($order->number)
            ->series($order->number)
            ->serialNumberFormat('{SERIES}')
            ->status($order->payment_status->value)
            ->seller($seller)
            ->buyer($customer)
            ->currencyCode($order->currency)
            ->currencySymbol(config('settings.currency_symbol.value'))
            ->date(Carbon::parse($order->updated_at))
            ->shipping(config('settings.shipping_cost.value') ?: 0)
            ->addItems($items)
            ->logo('storage/' . config('settings.site_logo.attachment'));

        return $invoice->stream();
    }
}
