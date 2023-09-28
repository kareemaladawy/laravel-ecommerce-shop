<?php

namespace App\Filament\Resources\Shop;

use Filament\Tables;
use App\Models\Category;
use Illuminate\Support\Str;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\MarkdownEditor;
use App\Filament\Resources\Shop\CategoryResource\Pages;
use App\Filament\Resources\Shop\CategoryResource\RelationManagers\ChildrenRelationManager;
use App\Filament\Resources\Shop\CategoryResource\RelationManagers\ProductsRelationManager;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $slug = 'shop/categories';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Shop';

    protected static ?string $navigationIcon = 'heroicon-s-tag';

    protected static ?int $navigationSort = 4;

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'parent.name'];
    }

    public static function getGlobalSearchResultDetails($record): array
    {
        if ($record->parent) {
            return [
                'Parent' => $record->parent->name,
            ];
        }
        return [];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->unique(ignoreRecord: true),
                Select::make('parent_id')
                    ->label('parent')
                    ->options(Category::orderByRaw('-name ASC')->get()->nest()->listsFlattened('name')),
                FileUpload::make('image')
                    ->preserveFilenames(),
                MarkdownEditor::make('description'),
                Toggle::make('menu')->default(true),
                Toggle::make('featured')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->description(fn (Category $record): string => $record->description ? Str::limit($record->description, 20, '...') : ''),
                ImageColumn::make('image')
                    ->toggleable()
                    ->extraImgAttributes(['title' => 'image/attachment']),
                TextColumn::make('slug')
                    ->searchable(),
                TextColumn::make('parent.name')
                    ->toggleable(),
                ToggleColumn::make('menu'),
                ToggleColumn::make('featured'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->iconButton(),
                Tables\Actions\DeleteAction::make()->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScopes();
    }

    public static function getRelations(): array
    {
        return [
            ChildrenRelationManager::class,
            ProductsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
