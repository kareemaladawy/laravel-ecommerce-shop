<?php

namespace App\Filament\Resources\Shop\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Attribute;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;

class AttributesRelationManager extends RelationManager
{
    protected static string $relationship = 'attributes';

    protected static ?string $recordTitleAttribute = 'value';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('attribute_id')
                    ->label('Attribute')
                    ->required()
                    ->relationship('attribute', 'name')
                    ->createOptionForm([
                        TextInput::make('name'),
                    ]),
                Forms\Components\TextInput::make('value')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->placeholder('Leave empty if this attribute is default.')
                    ->numeric(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('attribute_id')
                    ->label('Name')
                    ->formatStateUsing(fn (string $state, $record): string => Attribute::find($record->attribute_id)->name),
                Tables\Columns\TextColumn::make('value'),
                Tables\Columns\TextColumn::make('price')->placeholder('default'),
                Tables\Columns\TextColumn::make('qty'),
            ])->defaultSort('attribute_id')
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
