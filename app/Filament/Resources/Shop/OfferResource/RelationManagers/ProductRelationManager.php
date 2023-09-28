<?php

namespace App\Filament\Resources\Shop\OfferResource\RelationManagers;

use App\Models\Product;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\Str;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class ProductRelationManager extends RelationManager
{
    protected static string $relationship = 'product';

    protected static ?string $recordTitleAttribute = 'name';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->toggleable(),
                ImageColumn::make('images')
                    ->toggleable(),
                TextColumn::make('name')
                    ->description(fn (Product $record): string => $record->description ? Str::limit(strip_tags($record->description), 20, '...') : ''),
                TextColumn::make('ratings_count')->counts('ratings')
                    ->toggleable(),
                TextColumn::make('brand.name'),
                TextColumn::make('categories.name')
                    ->badge()
                    ->toggleable(),
                TextColumn::make('qty')
                    ->toggleable(),
                TextColumn::make('unit_price')
                    ->toggleable(),
                TextColumn::make('sale_price')
                    ->toggleable(),
                ToggleColumn::make('active')
                    ->toggleable(),
                ToggleColumn::make('featured')
                    ->toggleable(),
            ]);
    }
}
