<?php

namespace AdminKit\Localizations\UI\Filament\Resources\LocalizationResource\Pages;

use AdminKit\Localizations\UI\Filament\Resources\LocalizationResource;
use AdminKit\Localizations\UI\Filament\Resources\Widgets\LocalizationFiles;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLocalization extends ListRecords
{
    protected static string $resource = LocalizationResource::class;

    protected function getFooterWidgets(): array
    {
        return [
            LocalizationFiles::class,
        ];
    }

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
