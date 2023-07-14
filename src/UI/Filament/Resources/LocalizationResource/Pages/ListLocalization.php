<?php

namespace AdminKit\Localizations\UI\Filament\Resources\LocalizationResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use AdminKit\Localizations\UI\Filament\Resources\LocalizationResource;

class ListLocalization extends ListRecords
{
    protected static string $resource = LocalizationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
