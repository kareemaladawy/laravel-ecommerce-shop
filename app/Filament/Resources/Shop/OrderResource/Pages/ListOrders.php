<?php

namespace App\Filament\Resources\Shop\OrderResource\Pages;

use App\Enums\OrderStatus;
use App\Filament\Resources\Shop\OrderResource;
use App\Filament\Resources\Shop\OrderResource\Widgets\OrdersOverview;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            OrdersOverview::class
        ];
    }

    public function getTabs(): array
    {
        return [
            'All' => Tab::make('All'),
            'Pending' => Tab::make('Pending')
                ->modifyQueryUsing(function ($query){
                    return $query->where('status', OrderStatus::PENDING->value);
                }),
            'Processing' => Tab::make('Processing')
                ->modifyQueryUsing(function ($query){
                    return $query->where('status', OrderStatus::PROCESSING->value);
                }),
            'Completed' => Tab::make('Completed')
                ->modifyQueryUsing(function ($query){
                    return $query->where('status', OrderStatus::COMPLETED->value);
                }),
            'Shipped' => Tab::make('Shipped')
                ->modifyQueryUsing(function ($query){
                    return $query->where('status', OrderStatus::SHIPPED->value);
                }),
            'Declined' => Tab::make('Declined')
                ->modifyQueryUsing(function ($query){
                    return $query->where('status', OrderStatus::DECLINED->value);
                }),
            'Cancelled' => Tab::make('Cancelled')
                ->modifyQueryUsing(function ($query){
                    return $query->where('status', OrderStatus::CANCELLED->value);
                }),
        ];
    }
}
