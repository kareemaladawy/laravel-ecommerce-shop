<?php

namespace App\Filament\Resources\Shop\CategoryResource\Pages;

use App\Filament\Resources\Shop\CategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

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
            'In Menu' => Tab::make('In Menu')
                ->modifyQueryUsing(function ($query) {
                    return $query->where('menu', true);
                }),
            'Not In Menu' => Tab::make('Not In Menu')
                ->modifyQueryUsing(function ($query) {
                    return $query->where('menu', false);
                }),
            'Featured' => Tab::make('Featured')
                ->modifyQueryUsing(function ($query) {
                    return $query->where('featured', true);
                }),
            'Not Featured' => Tab::make('Not Featured')
                ->modifyQueryUsing(function ($query) {
                    return $query->where('featured', false);
                }),
        ];
    }
}
