<?php

namespace App\Filament\Resources\Shop\CustomerResource\Pages;

use App\Filament\Resources\Shop\CustomerResource;
use App\Filament\Resources\Shop\CustomerResource\Widgets\CustomersOverview;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;


class ListUsers extends ListRecords
{
    protected static string $resource = CustomerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\createAction::make()
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            CustomersOverview::class
        ];
    }
}
