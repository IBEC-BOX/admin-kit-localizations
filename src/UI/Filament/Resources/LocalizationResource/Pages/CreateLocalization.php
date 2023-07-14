<?php

namespace AdminKit\Localizations\UI\Filament\Resources\LocalizationResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use AdminKit\Localizations\UI\Filament\Resources\LocalizationResource;

class CreateLocalization extends CreateRecord
{
    protected static string $resource = LocalizationResource::class;

    protected function getActions(): array
    {
        return [
            //
        ];
    }

    protected function getRedirectUrl(): string
    {
        return LocalizationResource::getUrl();
    }
}
