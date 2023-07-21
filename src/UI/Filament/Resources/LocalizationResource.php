<?php

namespace AdminKit\Localizations\UI\Filament\Resources;

use AdminKit\Core\Facades\AdminKit;
use AdminKit\Localizations\Models\Localization;
use AdminKit\Localizations\UI\Filament\Resources\LocalizationResource\Pages;
use AdminKit\Localizations\UI\Filament\Resources\Widgets\LocalizationInformer;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class LocalizationResource extends Resource
{
    protected static ?string $model = Localization::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        $keys = [];
        foreach (config('admin-kit.locales') as $value) {
            $keys[] = Forms\Components\TextInput::make("content.$value")
                ->label($value)
                ->required(config('app.locale') === $value);
        }

        return $form
            ->schema([
                Card::make([
                    Forms\Components\TextInput::make('key')
                        ->label('Ключ')
                        ->required(),
                ]),
                Card::make($keys),
            ]);
    }

    public static function table(Table $table): Table
    {
        $columns = [];
        foreach (AdminKit::locales() as $locale) {
            $columns[] = Tables\Columns\TextInputColumn::make("content.$locale")
                ->getStateUsing(fn (Localization $record) => $record->getTranslation('content', $locale))
                ->label($locale);
        }

        return $table
            ->columns([
                TextColumn::make('key')->label('Ключ')->searchable(),
                ...$columns,
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

    public static function getLabel(): ?string
    {
        return __('admin-kit-localizations::localizations.resource.label');
    }

    public static function getPluralLabel(): ?string
    {
        return __('admin-kit-localizations::localizations.resource.plural_label');
    }

    protected static function getNavigationGroup(): string
    {
        return __('admin-kit-localizations::localizations.resource.plural_label');
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

    public static function getWidgets(): array
    {
        return [
            LocalizationInformer::class,
        ];
    }
}
