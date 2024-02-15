<?php

namespace AdminKit\Localizations\UI\Filament\Resources\LocalizationResource\Pages;

use AdminKit\Localizations\Traits\LocalizationFiles;
use AdminKit\Localizations\UI\Filament\Resources\LocalizationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLocalization extends EditRecord
{
    use LocalizationFiles;

    protected static string $resource = LocalizationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function beforeSave(): void
    {
        $this->addLocalization(
            $this->data['key'],
            $this->data['content']
        );
    }
}
