<?php

namespace App\Filament\Resources\Shop\CategoryResource\RelationManagers;

use Filament\Tables;
use App\Models\Category;
use Illuminate\Support\Str;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Resources\RelationManagers\RelationManager;

class ChildrenRelationManager extends RelationManager
{
    protected static string $relationship = 'children';

    protected static ?string $recordTitleAttribute = 'name';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->unique(ignoreRecord: true),
                FileUpload::make('image')
                    ->preserveFilenames(),
                MarkdownEditor::make('description')->columnSpanFull(),
                Toggle::make('menu'),
                Toggle::make('featured')
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->description(fn (Category $record): string => $record->description ? Str::limit($record->description, 20, '...') : ''),
                ImageColumn::make('image')
                    ->extraImgAttributes(['title' => 'image/attachment']),
                ToggleColumn::make('menu'),
                ToggleColumn::make('featured')
            ])
            ->filters([
                //
            ])
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
