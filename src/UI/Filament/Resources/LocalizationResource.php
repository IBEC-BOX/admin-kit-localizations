<?php

namespace AdminKit\Localizations\UI\Filament\Resources;

use AdminKit\Core\Facades\AdminKit;
use AdminKit\Localizations\Models\Localization;
use AdminKit\Localizations\UI\Filament\Filters\NotTranslatedFilter;
use AdminKit\Localizations\UI\Filament\Resources\LocalizationResource\Pages;
use AdminKit\Localizations\UI\Filament\Resources\Widgets\LocalizationInformer;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class LocalizationResource extends Resource
{
    protected static ?string $model = Localization::class;

    protected static ?string $navigationIcon = 'heroicon-o-language';

    public static function form(Form $form): Form
    {
        $components = [
            Forms\Components\TextInput::make('key')
                ->label(__('admin-kit-localizations::localizations.key'))
                ->prefixIcon('heroicon-o-key')
                ->unique(ignoreRecord: true)
                ->required()
                ->columnSpanFull(),
        ];

        foreach (AdminKit::locales() as $locale) {
            $components[] = Textarea::make("content.$locale")
                ->label(__('admin-kit-localizations::localizations.translation-content')." ($locale)")
                ->rows(5)
                ->required($locale === app()->getLocale());
        }

        return $form->schema($components);
    }

    public static function table(Table $table): Table
    {
        $columns = [
            TextColumn::make('key')
                ->label(__('admin-kit-localizations::localizations.key'))
                ->size('sm')
                ->limit(30)
                ->searchable(),

            TextColumn::make('content')
                ->searchable(query: function (Builder $query, string $search): Builder {
                    return $query
                        ->where('content', 'ILIKE', "%{$search}%");
                })
                ->label(__('admin-kit-localizations::localizations.preview-in-your-lang', ['lang' => app()->getLocale()]))
                ->icon('heroicon-o-language')
                ->size('sm')
                ->sortable(false)
                ->limit(50),
        ];

        foreach (AdminKit::locales() as $locale) {

            $columns[] = IconColumn::make($locale)
                ->label(strtoupper($locale))
                ->searchable(false)
                ->sortable(false)
                ->getStateUsing(function (Localization $record) use ($locale) {
                    return in_array($locale, array_keys($record->getTranslations('content'))) && ! is_null($record->getTranslation('content', $locale));
                })
                ->boolean();
        }

        return $table
            ->columns($columns)
            ->defaultSort('id', 'desc')
            ->filters([
                NotTranslatedFilter::make(),
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

    public static function getNavigationGroup(): ?string
    {
        if (! config('admin-kit-localizations.navigation_group_enabled')) {
            return null;
        }

        return __('admin-kit-localizations::localizations.resource.navigation_group');
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
