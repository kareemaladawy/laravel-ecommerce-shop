<?php

namespace App\Observers;

use App\Filament\Resources\Shop\OrderResource;
use App\Models\Admin;
use App\Models\Order;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        Notification::make()
            ->title('New order: ' . $order->number)
            ->body('Order status: ' . $order->status->value . ' | Payment status: ' . $order->payment_status->value)
            ->success()
            ->actions([
                Action::make('view')
                    ->url(OrderResource::getUrl('view', ['record' => $order]))
                    ->button()
                    ->markAsRead(),
            ])
            ->sendToDatabase(Admin::all());
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        Notification::make()
            ->title('Order ' . $order->number . ' updated.')
            ->body('Order status: ' . $order->status->value . ' | Payment status: ' . $order->payment_status->value)
            ->success()
            ->actions([
                Action::make('view')
                    ->url(OrderResource::getUrl('view', ['record' => $order]))
                    ->button()
                    ->markAsRead(),
            ])
            ->sendToDatabase(Admin::all());

        if ($order->status->isProcessing() && $order->payment_status->isCompleted()) {
            foreach ($order->items as $item) {
                $item->product->update(['qty' => ($item->product->qty - $item->qty)]);
            }
        }
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
