<?php

namespace AdminKit\Localizations\UI\Filament\Filters;

use AdminKit\Core\DTO\LocaleData;
use Filament\Forms\Components\Select;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class NotTranslatedFilter extends Filter
{
    public static function make(?string $name = null): static
    {
        return parent::make('not-translated')
            ->form([
                Select::make('lang')
                    ->label(__('admin-kit-localizations::localizations.filter-not-translated'))
                    ->options(LocaleData::makeCollection()
                        ->mapWithKeys(fn (LocaleData $locale) => [$locale->code => $locale->native])
                        ->toArray()
                    ),
            ])
            ->query(function (Builder $query, array $data): Builder {
                return $query
                    ->when(
                        $data['lang'],
                        fn (Builder $query, $date): Builder => $query->whereNull('content->'.$data['lang'])
                    );
            });
    }
}
