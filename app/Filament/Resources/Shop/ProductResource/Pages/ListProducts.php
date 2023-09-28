<?php

namespace App\Filament\Resources\Shop\ProductResource\Pages;

use App\Filament\Resources\Shop\ProductResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'All' => Tab::make('All'),
            'Active' => Tab::make('Active')
                ->modifyQueryUsing(function ($query) {
                    return $query->where('active', true);
                }),
            'Featured' => Tab::make('Featured')
                ->modifyQueryUsing(function ($query) {
                    return $query->where('featured', true);
                }),
            'Non Active' => Tab::make('Non Active')
                ->modifyQueryUsing(function ($query) {
                    return $query->where('active', false);
                }),
        ];
    }
}
