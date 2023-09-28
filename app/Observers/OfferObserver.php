<?php

namespace App\Observers;

use App\Models\Offer;

class OfferObserver
{
    /**
     * Handle the Offer "created" event.
     */
    public function created(Offer $offer): void
    {
        if ($offer->product && $offer->discount_percentage) {
            $offer->product->update(['sale_price' => intval($offer->product->unit_price - (($offer->discount_percentage / 100) * $offer->product->unit_price))]);
        }
    }

    /**
     * Handle the Offer "updated" event.
     */
    public function updated(Offer $offer): void
    {
        if ($offer->product && $offer->discount_percentage) {
            $offer->product->update(['sale_price' => intval($offer->product->unit_price - (($offer->discount_percentage / 100) * $offer->product->unit_price))]);
        }
    }

    /**
     * Handle the Offer "deleted" event.
     */
    public function deleting(Offer $offer): void
    {
        if ($offer->product && $offer->discount_percentage) {
            $offer->product->update(['sale_price' => null]);
        }
    }

    /**
     * Handle the Offer "restored" event.
     */
    public function restored(Offer $offer): void
    {
        //
    }

    /**
     * Handle the Offer "force deleted" event.
     */
    public function forceDeleted(Offer $offer): void
    {
        //
    }
}
