<?php

namespace AdminKit\Localizations\UI\Filament\Resources;

use AdminKit\Localizations\Models\Localization;
use AdminKit\Localizations\UI\Filament\Resources\LocalizationResource\Pages;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class LocalizationResource extends Resource
{
    protected static ?string $model = Localization::class;

    protected static ?string $modelLabel = 'Локализация';

    protected static ?string $pluralModelLabel = 'Локализация';

    protected static ?string $navigationGroup = 'Локализация';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        $keys = [];
        foreach (config('admin-kit.locales') as $value) {
            $keys[] = Forms\Components\TextInput::make($value)
                ->label($value)
                ->required();
        }

        return $form
            ->schema(array_merge([
                Card::make([
                    Forms\Components\TextInput::make('key')
                        ->label('Ключ')
                        ->required(),
                ]),
            ], $keys));
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')->label('Ключ')->searchable(),
                Tables\Columns\TextColumn::make('content')->label('Значение'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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
}
