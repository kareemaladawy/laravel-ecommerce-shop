<?php

namespace App\Filament\Resources\Shop;

use App\Filament\Resources\Shop\OfferResource\Pages;
use App\Filament\Resources\Shop\OfferResource\RelationManagers;
use App\Filament\Resources\Shop\OfferResource\RelationManagers\ProductRelationManager;
use App\Models\Offer;
use App\Models\Product;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;


class OfferResource extends Resource
{
    protected static ?string $model = Offer::class;

    protected static ?string $slug = 'shop/offers';

    protected static ?string $navigationGroup = 'Shop';

    protected static ?string $navigationIcon = 'heroicon-s-rectangle-stack';

    protected static ?int $navigationSort = 7;

    public static function getGloballySearchableAttributes(): array
    {
        return ['discount_percentage', 'product.name'];
    }

    public static function getGlobalSearchResultDetails($record): array
    {
        return [
            'Product' => $record->product?->name,
            'Discount Percentage' => $record->discount_percentage,
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('image')
                    ->required()
                    ->columnSpanFull()
                    ->placeholder('Preferred Size: 690x255'),
                Select::make('product_id')
                    ->required()
                    ->relationship('product', 'name')
                    ->options(Product::all()->pluck('name', 'id'))
                    ->searchable(),
                TextInput::make('discount_percentage')
                    ->required()
                    ->numeric()
                    ->inputMode('decimal')
                    ->maxValue(100)
                    ->minValue(0)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image'),
                TextColumn::make('product.name'),
                TextColumn::make('discount_percentage')
            ])
            ->actions([
                Tables\Actions\EditAction::make()->iconButton(),
                Tables\Actions\DeleteAction::make()->iconButton(),
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

    public static function getRelations(): array
    {
        return [
            ProductRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOffers::route('/'),
            'create' => Pages\CreateOffer::route('/create'),
            'edit' => Pages\EditOffer::route('/{record}/edit'),
        ];
    }
}
