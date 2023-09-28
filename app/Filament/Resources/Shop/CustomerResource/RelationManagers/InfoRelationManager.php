<?php

namespace App\Filament\Resources\Shop\CustomerResource\RelationManagers;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Monarobase\CountryList\CountryListFacade as Countries;


class InfoRelationManager extends RelationManager
{
    protected static string $relationship = 'info';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('city')
                    ->maxLength(25),
                Select::make('country')
                    ->options(Countries::getList(app()->getLocale())),
                TextInput::make('phone_number')
                    ->numeric()
                    ->minLength(11)
                    ->maxLength(11),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('city')
            ->columns([
                TextColumn::make('city'),
                TextColumn::make('country'),
                TextColumn::make('phone_number')
                    ->copyable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
}
