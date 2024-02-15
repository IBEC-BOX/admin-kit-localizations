<?php

namespace AdminKit\Localizations\UI\Filament\Resources\LocalizationResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use AdminKit\Localizations\Traits\LocalizationFiles;
use AdminKit\Localizations\UI\Filament\Resources\LocalizationResource;

class CreateLocalization extends CreateRecord
{
    use LocalizationFiles;

    protected static string $resource = LocalizationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }

    protected function getRedirectUrl(): string
    {
        return LocalizationResource::getUrl();
    }

    public function beforeCreate(): void
    {
        $this->addLocalization(
            $this->data['key'],
            $this->data['content']
        );
    }
}
