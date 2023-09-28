<?php

namespace App\Filament\Resources\Shop;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Filament\Resources\Shop\OrderResource\Pages;
use App\Filament\Resources\Shop\OrderResource\Widgets\OrdersOverview;
use App\Models\Order;
use App\Models\OrderItem;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $slug = 'shop/orders';

    protected static ?string $recordTitleAttribute = 'number';

    protected static ?string $navigationGroup = 'Shop';

    protected static ?string $navigationIcon = 'heroicon-s-shopping-bag';

    protected static ?int $navigationSort = 1;

    public static function getGlobalSearchResultUrl($record): string
    {
        return OrderResource::getUrl('view', ['record' => $record]);
    }

    public static function getGlobalSearchResultDetails($record): array
    {
        return [
            'Customer' => $record->customer?->full_name,
            'Status' => $record->status,
            'Payment Status' => $record->payment_status,
            'Date' => $record->updated_at->format('d M Y, h:i A'),
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('status')
                    ->options(OrderStatus::options())
                    ->selectablePlaceholder(false),
                Select::make('payment_status')
                    ->options(PaymentStatus::options())
                    ->selectablePlaceholder(false),
                Select::make('payment_method')
                    ->options(PaymentMethod::options())
                    ->selectablePlaceholder(false),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Order information')
                    ->schema([
                        TextEntry::make('number'),
                        TextEntry::make('status')->badge(),
                    ])->columns(2)->collapsible(),
                Section::make('Payment information')
                    ->schema([
                        TextEntry::make('payment_status')->badge(),
                        TextEntry::make('payment_method')->badge(),
                        TextEntry::make('grand_total')
                            ->money(fn (Order $record) => $record->currency),
                        TextEntry::make('currency'),
                    ])->columns(4)->collapsible(),
                Section::make('Billing information')
                    ->schema([
                        TextEntry::make('first_name'),
                        TextEntry::make('last_name'),
                        TextEntry::make('customer.email'),
                        TextEntry::make('phone_number')->badge()->color('info'),
                        TextEntry::make('notes'),
                        Section::make('Address information')
                            ->schema([
                                TextEntry::make('apartment'),
                                TextEntry::make('floor'),
                                TextEntry::make('street'),
                                TextEntry::make('building'),
                                TextEntry::make('city'),
                                TextEntry::make('state'),
                                TextEntry::make('country'),
                                TextEntry::make('postal_code'),
                            ])->columns(4)->collapsible(),
                    ])->columns(3)->collapsible(),
                Section::make('Order items')
                    ->schema([
                        RepeatableEntry::make('items')
                            ->schema([
                                TextEntry::make('name'),
                                TextEntry::make('attributes')->listWithLineBreaks(),
                                TextEntry::make('price')->money(fn (OrderItem $record) => $record->order->currency),
                                TextEntry::make('qty'),
                            ])
                            ->columns(4)
                    ])->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('number')
                    ->toggleable(),
                TextColumn::make('status')
                    ->badge()
                    ->toggleable(),
                TextColumn::make('payment_status')
                    ->badge()
                    ->toggleable(),
                TextColumn::make('payment_method')
                    ->toggleable(),
                TextColumn::make('grand_total')
                    ->money(fn (Order $record) => $record->currency)
                    ->toggleable(),
                TextColumn::make('currency')
                    ->toggleable(),
            ])
            ->actions([
                Action::make('Download Invoice')
                    ->icon('heroicon-o-document-arrow-down')
                    ->iconButton()
                    ->color('success')
                    ->url(fn (Order $record) => route('order.invoice', $record))
                    ->openUrlInNewTab(),
                Tables\Actions\ViewAction::make()->iconButton(),
                Tables\Actions\EditAction::make()->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getWidgets(): array
    {
        return [
            OrdersOverview::class
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
