<?php

namespace App\Filament\Resources\Shop\CustomerResource\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class CustomersOverview extends BaseWidget
{
    protected static ?int $sort = 0;

    protected function getStats(): array
    {
        return [
            Stat::make('Total customers', User::count()),
            Stat::make('New customers', User::new()->count()),
        ];
    }
}
