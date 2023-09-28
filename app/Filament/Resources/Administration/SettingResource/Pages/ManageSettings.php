<?php

namespace App\Filament\Resources\Administration\SettingResource\Pages;

use App\Filament\Resources\Administration\SettingResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSettings extends ManageRecords
{
    protected static string $resource = SettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
