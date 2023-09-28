<?php

namespace App\Filament\Resources\Shop\CategoryResource\RelationManagers;

use Filament\Tables;
use App\Models\Product;
use Illuminate\Support\Str;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Filament\Resources\RelationManagers\RelationManager;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'products';

    protected static ?string $recordTitleAttribute = 'name';

    public function form(Form $form): Form
    {
        return $form
        ->schema([
            Section::make('General Information')
                ->schema([
                    TextInput::make('name')
                        ->unique(ignoreRecord: true)
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(function (\Filament\Forms\Set $set, $state) {
                            $set('slug', Str::slug($state));
                        }),
                    TextInput::make('sku')
                        ->unique(ignoreRecord: true),
                    TextInput::make('slug')->disabled()
                            ->unique(ignoreRecord: true),
                    TextInput::make('model')
                        ->unique(ignoreRecord: true),
                    Select::make('brand_id')
                        ->required()
                        ->label('Brand')
                        ->relationship('brand', 'name')
                        ->createOptionForm([
                            TextInput::make('name')
                                ->unique(ignoreRecord: true),
                            FileUpload::make('logo')
                                ->preserveFilenames(),
                        ]),
                ])
                ->columns(2),
            Section::make('Description and details')
                ->schema([
                    RichEditor::make('description'),
                    RichEditor::make('details')
                ])
                ->columns(2),
            Section::make('Numbers')
                ->schema([
                    TextInput::make('quantity')->required()
                    ->numeric(),
                    TextInput::make('weight')
                    ->numeric(),
                    TextInput::make('price')
                    ->numeric(),
                    TextInput::make('sale_price')
                    ->numeric(),
                    Toggle::make('active')->inline(),
                    Toggle::make('featured')->inline(),
                ])->columns(2)
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sku'),
                TextColumn::make('name')
                    ->description(fn (Product $record): string => $record->description ? Str::limit($record->description, 20, '...') : ''),
                TextColumn::make('brand.name'),
                BadgeColumn::make('categories.name'),
                TextColumn::make('quantity'),
                TextColumn::make('price'),
                TextColumn::make('sale_price'),
                TextColumn::make('active')
                    ->formatStateUsing(fn ($record): string => $record->active == 0 ? 'no' : 'yes'),
                TextColumn::make('featured')
                    ->formatStateUsing(fn ($record): string => $record->featured == 0 ? 'no' : 'yes'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    protected function getTableQuery(): Builder|Relation
    {
        return parent::getTableQuery()->withoutGlobalScopes();
    }

}
