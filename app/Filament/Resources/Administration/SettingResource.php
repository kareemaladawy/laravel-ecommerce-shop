<?php

namespace App\Filament\Resources\Administration;

use App\Filament\Resources\Administration\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;


class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $recordTitleAttribute = 'key';

    protected static ?string $navigationIcon = 'heroicon-s-adjustments-horizontal';

    protected static ?string $navigationGroup = 'Administration';

    public static function getGloballySearchableAttributes(): array
    {
        return ['key', 'value'];
    }

    public static function getGlobalSearchResultDetails($record): array
    {
        return [
            'Value' => $record->value,
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('key'),
                TextInput::make('value'),
                FileUpload::make('attachment')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key')
                    ->searchable()
                    ->copyable(),
                TextColumn::make('value')
                    ->searchable()
                    ->copyable(),
                ImageColumn::make('attachment')
            ])
            ->actions([
                Tables\Actions\EditAction::make()->iconButton(),
                Tables\Actions\DeleteAction::make()->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSettings::route('/'),
        ];
    }
}
