<?php

namespace AdminKit\Localizations\UI\Filament\Resources;

use AdminKit\Core\Forms\Components\TranslatableTabs;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use AdminKit\Localizations\Models\Localization;
use AdminKit\Localizations\UI\Filament\Resources\LocalizationResource\Pages;

class LocalizationResource extends Resource
{
    protected static ?string $model = Localization::class;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationIcon = 'heroicon-o-x';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TranslatableTabs::make(fn ($locale) => Forms\Components\Tabs\Tab::make($locale)->schema([
                    Forms\Components\TextInput::make('title')
                        ->label(__('admin-kit-localizations::localizations.resource.title'))
                        ->required($locale === app()->getLocale()),
                ])),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('admin-kit-localizations::localizations.resource.id'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('admin-kit-localizations::localizations.resource.title')),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin-kit-localizations::localizations.resource.created_at')),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('id', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLocalization::route('/'),
            'create' => Pages\CreateLocalization::route('/create'),
            'edit' => Pages\EditLocalization::route('/{record}/edit'),
        ];
    }

    public static function getLabel(): ?string
    {
        return __('admin-kit-localizations::localizations.resource.label');
    }

    public static function getPluralLabel(): ?string
    {
        return __('admin-kit-localizations::localizations.resource.plural_label');
    }
}
