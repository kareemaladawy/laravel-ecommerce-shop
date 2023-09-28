<?php

namespace App\Filament\Resources\Shop\OrderResource\Pages;

use App\Filament\Resources\Shop\OrderResource;
use App\Models\Order;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Download Invoice')
                ->icon('heroicon-o-document-arrow-down')
                ->color('success')
                ->url(fn (Order $record) => route('order.invoice', $record))
                ->openUrlInNewTab(),
            Actions\EditAction::make(),
        ];
    }
}
